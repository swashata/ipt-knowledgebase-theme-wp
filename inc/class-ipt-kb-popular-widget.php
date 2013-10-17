<?php
/**
 * A popular articles widget
 * Shows articles based on the "like" thingy
 *
 * Mainly for the sidebar area
 *
 * But use it whereever you want.
 *
 * @package iPanelThemes Knowledgebase
 */

/**
 * new WordPress Widget format
 * Wordpress 2.8 and above
 * @see http://codex.wordpress.org/Widgets_API#Developing_Widgets
 */
class IPT_KB_Popular_Widget extends WP_Widget {

	/**
	 * Constructor
	 *
	 * @return void
	 */
	function IPT_KB_Popular_Widget() {
		$widget_ops = array( 'classname' => 'ipt-kb-popular-widget', 'description' => __( 'Shows articles or posts based on the user likes.', 'ipt_kb' ) );
		$this->WP_Widget( 'ipt-kb-popular-widget', __( 'Popular Knowledge Base Articles', 'ipt_kb' ), $widget_ops );
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

		if ( $title != '' ) {
			echo $before_title;
			echo $title;
			echo $after_title;
		}

		// Remove the filter from the Posts Order By Plugin
		if ( function_exists( 'CPTOrderPosts' ) ) {
			remove_filter( 'posts_orderby', 'CPTOrderPosts', 99, 2 );
		}

		// Get the articles
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => $instance['number'],
			'meta_key' => 'ipt_kb_like_article',
			'meta_value' => '0',
			'meta_compare' => '>',
			'orderby' => 'meta_value_num',
			'order' => 'DESC',
		);
		$args = apply_filters( 'ipt_kb_popular_widget_query_args', $args );

		$popular_posts = new WP_Query( $args );

		echo '<div class="list-group">';
		if ( $popular_posts->have_posts() ) {
			while ( $popular_posts->have_posts() ) {
				$popular_posts->the_post();
				get_template_part( 'category-templates/content', 'popular' );
			}
		} else {
			get_template_part( 'category-templates/no-result' );
		}
		echo '</div>';
		wp_reset_query();

		// Add the filter from the Posts Order By Plugin
		if ( function_exists( 'CPTOrderPosts' ) ) {
			add_filter( 'posts_orderby', 'CPTOrderPosts', 99, 2 );
		}

		echo $after_widget;
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
		$updated_instance['number'] = isset( $new_instance['number'] ) ? (int) strip_tags( $new_instance['number'] ) : '';
		$updated_instance['number'] = $updated_instance['number'] <= 0 ? 10 : $updated_instance['number'];
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
			'title' => __( 'Popular Articles', 'ipt_kb' ),
			'number' => '10',
		) );
		?>
<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><strong><?php _e( 'Title', 'ipt_kb' ) ?></strong></label>
	<input type="text" class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>" id="<?php echo $this->get_field_id( 'title' ); ?>" value="<?php echo esc_html( $instance['title'] ); ?>" />
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'number' ); ?>"><strong><?php _e( 'Number of articles', 'ipt_kb' ) ?></strong></label>
	<input type="text" class="widefat" name="<?php echo $this->get_field_name( 'number' ); ?>" id="<?php echo $this->get_field_id( 'number' ); ?>" value="<?php echo esc_html( $instance['number'] ); ?>" />
</p>
		<?php
	}
}

add_action( 'widgets_init', create_function( '', "register_widget( 'IPT_KB_Popular_Widget' );" ) );
