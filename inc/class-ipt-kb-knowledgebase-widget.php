<?php
/**
 * A nice social Widget
 * Mainly for the sidebar area
 *
 * But use it whereever you want.
 *
 * @package iPanelThemes Knowledgebase
 */

/**
 * Knowledge Base Widget Class
 *
 * new WordPress Widget format
 * Wordpress 2.8 and above
 * @see http://codex.wordpress.org/Widgets_API#Developing_Widgets
 */
class IPT_KB_KnowledgeBase_Widget extends WP_Widget {

	/**
	 * Constructor
	 *
	 * @return void
	 */
	function IPT_KB_KnowledgeBase_Widget() {
		$widget_ops = array( 'classname' => 'ipt-kb-knowledgebase-widget', 'description' => __( 'Lists all your categories or knowledge bases with the right appearance.', 'ipt_kb' ) );
		$this->WP_Widget( 'ipt-kb-knowledgebase-widget', __( 'Knowledge Base Widget', 'ipt_kb' ), $widget_ops );
	}

	/**
	 * Outputs the HTML for this widget.
	 *
	 * @param array  An array of standard parameters for widgets in this theme
	 * @param array  An array of settings for this widget instance
	 * @return void Echoes it's output
	 */
	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );
		echo $before_widget;

		$title = apply_filters( 'widget_title', $instance['title'] );

		if ( ! isset( $instance['show_sub'] ) ) {
			$instance['show_sub'] = true;
		}

		if ( $title != '' ) {
			echo $before_title;
			echo $title;
			echo $after_title;
		}

		// Get the parent categories
		$main_categories = get_categories( array(
			'taxonomy' => 'category',
			'parent' => 0,
			'hide_empty' => 0,
		) );

		echo '<div class="list-group">';

		foreach ( $main_categories as $cat ) {
			$this->print_main_category( $cat, $instance['show_sub'] );
		}

		echo '</div>';
		echo $after_widget;
	}

	protected function print_main_category( $cat, $print_subcat = true ) {
		// Do the main category
		$this->print_category( $cat );

		// Do the sub categories
		$sub_categories = get_categories( array(
			'taxonomy' => 'category',
			'parent' => $cat->term_id,
			'hide_empty' => 0,
			'number' => '',
		) );

		if ( ! empty( $sub_categories ) && $print_subcat ) {
			foreach ( $sub_categories as $scat ) {
				$this->print_category( $scat, str_repeat( '&nbsp;', 8 ) );
			}
		}
	}

	protected function print_category( $cat, $sep = '' ) {
		$term_meta = get_option( 'ipt_kb_category_meta_' . $cat->term_id, array() );

		echo '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '" class="list-group-item' . ( is_category( $cat->term_id ) || ( is_single() && has_category( $cat->term_id ) ) ? ' active' : '' ) . '">';

		echo '<span class="badge">' . ipt_kb_total_cat_post_count( $cat->term_id ) . '</span>';

		echo $sep;

		$icon_class = 'ipt-books';

		if ( isset( $term_meta['icon_class'] ) && trim( $term_meta['icon_class'] ) != '' ) {
			$icon_class = $term_meta['icon_class'];
		}

		echo '<span class="glyphicon ' . $icon_class . '"></span>&nbsp;';
		echo $cat->name . '</a>';
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
		$updated_instance = $new_instance;
		$updated_instance['title'] = isset( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';
		$updated_instance['show_sub'] = isset( $new_instance['show_sub'] ) && ! empty( $new_instance['show_sub'] ) ? true : false;
		return $updated_instance;
	}

	/**
	 * Displays the form for this widget on the Widgets page of the WP Admin area.
	 *
	 * @param array  An array of the current settings for this widget
	 * @return void Echoes it's output
	 */
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => __( 'Knowledge Bases', 'ipt_kb' ), 'show_sub' => true ) );
		?>
<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><strong><?php _e( 'Title', 'ipt_kb' ) ?></strong></label>
	<input type="text" class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>" id="<?php echo $this->get_field_id( 'title' ); ?>" value="<?php echo esc_html( $instance['title'] ); ?>" />
</p>
<p>
	<input type="checkbox"<?php checked( $instance['show_sub'] ); ?> name="<?php echo $this->get_field_name( 'show_sub' ); ?>" id="<?php echo $this->get_field_id( 'show_sub' ); ?>" value="1" />
	<label for="<?php echo $this->get_field_id( 'show_sub' ); ?>"><?php _e( 'Show sub categories below the parent category (main knowledge bases)', 'ipt_kb' ); ?></label>
</p>
<p class="description">
	<?php _e( 'No other settings necessary. The icon classes you have put on categories and sub categories will be thoroughly used.', 'ipt_kb' ); ?>
</p>
		<?php
	}
}

add_action( 'widgets_init', create_function( '', "register_widget( 'IPT_KB_KnowledgeBase_Widget' );" ) );
