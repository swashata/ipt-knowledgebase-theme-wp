<?php
/**
 * The Affix Widget for extending single articles on knowledgebase
 *
 * Inspired by twitter affix
 * But implemented using Sticky Kit jQuery
 *
 * @package iPanelThemes Knowledgebase
 */

class IPT_KB_Affix_Widget extends WP_Widget {
	/**
	 * Separator string
	 */
	const SEP = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

	protected $parent_cat;
	protected $current_cat;

	/**
	 * The static array which will hold the h2's & h3's from the current post
	 * @var array
	 */
	public static $toc = array();

	/**
	 * Constructor
	 *
	 * @return void
	 */
	function IPT_KB_Affix_Widget() {
		$widget_ops = array( 'classname' => 'ipt_kb_affix', 'description' => __( 'An affix widget for displaying on the sidebar of the single articles.', 'ipt_kb' ) );
		$this->WP_Widget( 'ipt_kb_affix', __( 'Affix Widget', 'ipt_kb' ), $widget_ops );
	}

	/**
	 * Outputs the HTML for this widget.
	 *
	 * @param array  An array of standard parameters for widgets in this theme
	 * @param array  An array of settings for this widget instance
	 * @return void Echoes it's output
	 */
	function widget( $args, $instance ) {
		// This widget is supposed to work only on single post type pages
		// So check and exit on all other pages
		if ( ! is_single() && ! is_category() ) {
			return;
		}

		// Extrack the default things
		extract( $args, EXTR_SKIP );

		// Get the right category
		$cat_id = null;

		if ( is_single() ) {
			$post_cats = get_the_category();

			if ( ! empty( $post_cats ) ) {
				$cat_id = $post_cats[0]->term_id;
			}
		} else {
			$cat_id = get_query_var( 'cat' );
		}

		if ( $cat_id === null ) {
			return;
		}

		// At this point we do have a valid category
		// Now let's check if this is the parent
		$current_cat = get_category( $cat_id );
		if ( $current_cat->parent != '0' ) {
			$parent_cat = get_category( $current_cat->parent );
			while ( $parent_cat->parent != '0' ) {
				$parent_cat = get_category( $parent_cat->parent );
			}
		} else {
			// Current category is parent
			$parent_cat = get_category( $cat_id );
		}

		// Store the parent and current category
		$this->parent_cat = $parent_cat;
		$this->current_cat = $current_cat;

		$sub_categories = get_categories( array(
			'taxonomy' => 'category',
			'parent' => $parent_cat->term_id,
			'hide_empty' => 0,
			'number' => '',
		) );

		$term_meta = get_option( 'ipt_kb_category_meta_' . $parent_cat->term_id, array() );

		echo $before_widget;
		echo $before_title;
		echo $parent_cat->name; // Can set this with a widget option, or omit altogether
		echo $after_title;
		?>

<!-- Stick it or not -->
<?php if ( isset( $instance['dontfix'] ) && $instance['dontfix'] == true ) : ?>
<input type="hidden" class="dontfix" value="1" />
<?php endif; ?>
<!-- Search form -->
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="hidden" name="cat" value="<?php echo $parent_cat->term_id; ?>" />
	<div class="form-group">
		<div class="input-group input-group-sm">
			<input type="search" class="search-field form-control" placeholder="<?php _e( 'Search&hellip;', 'ipt_kb' ) ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" />
			<span class="input-group-btn"><button type="submit" class="btn btn-default"><span class="ipt-icon-search"></span></button></span>
		</div>
	</div>
</form>

<!-- TOC for single posts -->
<?php if ( is_single() ) : ?>
<?php $this->print_toc(); ?>
<?php endif; ?>

<!-- Get support -->
<?php if ( isset( $term_meta['support_forum'] ) && '' != $term_meta['support_forum'] ) : ?>
<p>
	<a href="<?php echo esc_url( $term_meta['support_forum'] ); ?>" class="btn btn-block btn-default">
		<i class="glyphicon ipt-icon-support"></i> <?php _e( 'Get support', 'ipt_kb' ); ?>
	</a>
</p>
<?php endif; ?>

<!-- Category Listing -->
<div class="list-group">
	<?php if ( empty( $sub_categories ) ) : ?>
		<?php $this->print_post_for_cat( $parent_cat->term_id ); ?>
	<?php else : ?>
		<?php // Loop through all subcategories ?>
		<?php foreach ( $sub_categories as $scat ) : ?>
		<?php $this->print_cat( $scat ); ?>
		<?php endforeach; ?>
	<?php endif; ?>
</div>
		<?php
		echo $after_widget;
	}

	protected function print_toc() {
		global $post;

		if ( ! is_single() ) {
			return;
		}

		$post_id = $post->ID;

		if ( ! isset( self::$toc[$post_id] ) || empty( self::$toc[$post_id] ) ) {
			return;
		}



		$collapse_state = ' in';
		if ( isset( $_COOKIE['ipt_kb_toc'] ) && $_COOKIE['ipt_kb_toc'] == '0' ) {
			$collapse_state = '';
		}
		?>
<div class="text-muted ipt-kb-toc">
	<a href="#ipt-kb-toc-scrollspy" title="<?php esc_attr_e( 'Click to show/hide table of contents.', 'ipt_kb' ); ?>" class="bstooltip pull-right btn btn-xs btn-default accordion-toggle ipt-kb-sub-toc-toggle" data-toggle="collapse"><i class="glyphicon ipt-icon-menu"></i></a>
	<h4>
		<?php _e( 'Table of Contents', 'ipt_kb' ); ?>
	</h4>
	<div class="clearfix"></div>
</div>
<nav id="ipt-kb-toc-scrollspy" class="collapse<?php echo $collapse_state; ?>">
	<ul class="nav">
		<?php foreach ( self::$toc[$post_id] as $id => $data ) : ?>
			<li><?php $separator = $this->get_separator_string( $data['type'] - 2 ); ?>
			<a href="#<?php echo esc_attr( $id ); ?>"><?php echo $separator; ?><?php echo $data['text']; ?></a></li>
		<?php endforeach; ?>
	</ul>
</nav>

		<?php
	}

	protected function print_cat( $cat ) {
		$sterm_meta = get_option( 'ipt_kb_category_meta_' . $cat->term_id, array() );
		$btn_class = '';

		// Test for Single & category archive
		$do_posts = false;
		if ( ( is_single() && in_category( $cat->term_id ) ) || $cat->term_id == $this->current_cat->term_id ) {
			$btn_class = 'active-cat';
			$do_posts = true;
		}
		?>
<?php if ( $do_posts ) : ?>
<div class="list-group-item <?php echo $btn_class; ?>">
<a href="#ipt-kb-affix-active-post" title="<?php esc_attr_e( 'Click to show/hide articles under this category.', 'ipt_kb' ); ?>" class="bstooltip accordion-toggle pull-right btn btn-default btn-xs text-center ipt-kb-sub-cat-toggle" data-toggle="collapse">
	<i class="glyphicon ipt-icon-enter"></i>
</a>
<?php if ( isset( $sterm_meta['icon_class'] ) && '' != $sterm_meta['icon_class'] ) : ?>
<i class="glyphicon <?php echo esc_attr( $sterm_meta['icon_class'] ); ?>"></i>
<?php else : ?>
<i class="glyphicon ipt-icon-books"></i>
<?php endif; ?>
<?php echo $cat->name; ?>
</div>
<?php else : ?>
<a href="<?php echo get_category_link( $cat ); ?>" class="list-group-item <?php echo $btn_class; ?>">
<?php if ( isset( $sterm_meta['icon_class'] ) && '' != $sterm_meta['icon_class'] ) : ?>
<i class="glyphicon <?php echo esc_attr( $sterm_meta['icon_class'] ); ?>"></i>
<?php else : ?>
<i class="glyphicon ipt-icon-books"></i>
<?php endif; ?>
<?php echo $cat->name; ?>
</a>
<?php endif; ?>
		<?php
		if ( $do_posts ) {
			$collapse_state = ' in';
			if ( isset( $_COOKIE['ipt_kb_active_post'] ) && $_COOKIE['ipt_kb_active_post'] == '0' ) {
				$collapse_state = '';
			}
			echo '<div id="ipt-kb-affix-active-post" class="collapse' . $collapse_state . '">';
			$this->print_post_for_cat( $cat->term_id, 1 );
			echo '</div>';
		}
	}

	protected function print_post_for_cat( $cat_id, $sep_mul = 0 ) {
		$separator = $this->get_separator_string( $sep_mul );
		if ( is_single() ) {
			global $post;
			$o_post_id = $post->ID;
		}

		$custom_posts = new WP_Query( array(
			'cat' => $cat_id,
			'posts_per_page' => -1,
		) );

		if ( $custom_posts->have_posts() ) {
			while ( $custom_posts->have_posts() ) {
				$custom_posts->the_post();
				$btn_class = '';
				$post_id = get_the_ID();
				if ( is_single() && $post_id == $o_post_id ) {
					$btn_class = 'active';
				}
				?>
<a href="<?php the_permalink(); ?>" class="list-group-item <?php echo $btn_class; ?>"><?php echo $separator; ?><?php the_title(); ?></a>
				<?php
			}
		} else {
			?>
<div class="list-group-item text-muted">
	<?php _e( 'No articles found.', 'ipt_kb' ); ?>
</div>
			<?php
		}
		wp_reset_query();
	}

	protected function get_separator_string( $sep_mul = 0 ) {
		if ( $sep_mul < 0 ) {
			$sep_mul = 0;
		}
		$sep_mul = (int) $sep_mul;
		return str_repeat( self::SEP, $sep_mul );
	}

	/**
	 * Deals with the settings when they are saved by the admin. Here is
	 * where any validation should be dealt with.
	 *
	 * @param array  An array of new settings as submitted by the admin
	 * @param array  An array of the previous settings
	 * @return array The validated and (if necessary) amended settings
	 */
	function update( $new_instance, $old_instance ) {

		// update logic goes here
		$updated_instance = array();
		if ( isset( $new_instance['dontfix'] ) ) {
			$updated_instance['dontfix'] = true;
		} else {
			$updated_instance['dontfix'] = false;
		}
		return $updated_instance;
	}

	/**
	 * Displays the form for this widget on the Widgets page of the WP Admin area.
	 *
	 * @param array  An array of the current settings for this widget
	 * @return void Echoes it's output
	 */
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array(
			'dontfix' => false,
		) );
		?>
<p>
	<label for="<?php echo $this->get_field_id( 'dontfix' ); ?>"><?php _e ( 'Do not make the widget sticky', 'ipt_kb' ); ?></label>
	<input type="checkbox" name="<?php echo $this->get_field_name( 'dontfix' ); ?>" id="<?php echo $this->get_field_id( 'dontfix' ); ?>"<?php if ( $instance['dontfix'] == true ) echo ' checked="checked"'; ?> />
</p>
<p class="description"><?php _e( 'No other configuration necessary. Just activate and enjoy. Neat?', 'ipt_kb' ); ?></p>
		<?php
	}
}

add_action( 'widgets_init', create_function( '', "register_widget( 'IPT_KB_Affix_Widget' );" ) );

/**
 * TOC content filter
 *
 * Used to generate the scrollspy
 * @param  [type] $content [description]
 * @return [type]          [description]
 */
function ipt_kb_toc_content_filter( $content ) {
	// Not applicable if not in single pages
	if ( ! is_single() ) {
		return $content;
	}

	// Reset the toc array
	// We do not know how many times it is going to get called
	global $post;

	IPT_KB_Affix_Widget::$toc[$post->ID] = array();

	// Call the preg callback
	$new = preg_replace_callback( '/<h([2-4])(.*?)>(.*?)<\/h/s', 'ipt_kb_toc_preg_callback', $content );

	// Return it
	return $new;
}
add_filter( 'the_content', 'ipt_kb_toc_content_filter', 99 );

function ipt_kb_toc_preg_callback( $matches ) {
	// Create the toc array for this post
	// Although this should be created, but still
	global $post;
	$post_id = $post->ID;
	if ( ! isset( IPT_KB_Affix_Widget::$toc[$post_id] ) ) {
		IPT_KB_Affix_Widget::$toc[$post_id] = array();
	}

	// Check for existing ID, if present, then we do not need to convert it
	//
	$new_id_match = array();
	$new_id = '';
	if ( preg_match( '/id="(.*?)"/i', $matches[0], $new_id_match ) ) {
		$new_id = $new_id_match[1];
		$return = $matches[0];
	} else {
		$new_id = 'ipt_kb_toc_' . $post_id . '_' . count( IPT_KB_Affix_Widget::$toc[$post_id] );
		$return = '<h' . $matches[1] . ' id="' . esc_attr( $new_id ) . '"' . $matches[2] . '>' . $matches[3] . '</h';
	}



	if ( ! isset( IPT_KB_Affix_Widget::$toc[$post_id][$new_id] ) ) {
		IPT_KB_Affix_Widget::$toc[$post_id][$new_id] = array(
			'type' => $matches[1],
			'text' => trim( rtrim( strip_shortcodes( strip_tags( $matches[3] ) ), ':.;' ) ),
		);
	}

	return $return;
}

