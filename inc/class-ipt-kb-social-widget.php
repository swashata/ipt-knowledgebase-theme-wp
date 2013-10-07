<?php
/**
 * A nice social Widget
 * Mainly for the footer area
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
class IPT_KB_Social_Widget extends WP_Widget {

	public $default_settings = array();
	public $settings_helper = array();

	/**
	 * Constructor
	 *
	 * @return void
	 **/
	function IPT_KB_Social_Widget() {
		$default_settings = array(
			'title' => __( 'Stay <span>Connected</span>', 'ipt_kb' ),
			'links' => array(
				'facebook' => '',
				'twitter' => '',
				'gplus' => '',
				'youtube' => '',
				'vimeo' => '',
				'pinterest' => '',
			),
		);
		$settings_helper = array(
			'social_titles' => array(
				'facebook' => __( 'Facebook', 'ipt_kb' ),
    			'twitter' => __( 'Twitter', 'ipt_kb' ),
    			'gplus' => __( 'Google Plus', 'ipt_kb' ),
    			'youtube' => __( 'Youtube', 'ipt_kb' ),
    			'vimeo' => __( 'Vimeo', 'ipt_kb' ),
    			'pinterest' => __( 'Pinterest', 'ipt_kb' ),
			),
			'social_classes' => array(
				'facebook' => 'ipt-facebook',
    			'twitter' => 'ipt-twitter',
    			'gplus' => 'ipt-google-plus',
    			'youtube' => 'ipt-youtube',
    			'vimeo' => 'ipt-vimeo',
    			'pinterest' => 'ipt-pinterest',
			),
		);
		$this->default_settings = apply_filters( 'ipt_kb_social_widget_defaults', $default_settings );
		$this->settings_helper = apply_filters( 'ipt_kb_social_widget_settings_helper', $settings_helper );
		$widget_ops = array( 'classname' => 'ipt-kb-social-widget', 'description' => __( 'A nice looking social widget for the footer small area.', 'ipt_kb' ) );
		$this->WP_Widget( 'ipt-kb-social-widget', __( 'Social Widget', 'ipt_kb' ), $widget_ops );
	}

	/**
	 * Outputs the HTML for this widget.
	 *
	 * @param array  An array of standard parameters for widgets in this theme
	 * @param array  An array of settings for this widget instance
	 * @return void Echoes it's output
	 **/
	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );
		echo $before_widget;

		if ( $instance['title'] != '' ) {
			echo $before_title;
			echo $instance['title'];
			echo $after_title;
		}

		echo '<ul class="ipt-kb-social-ul">';

		foreach ( $instance['links'] as $l_key => $lval ) {
			if ( trim( $lval ) != '' ) {
				echo '<li class="' . esc_attr( $l_key ) . '"><a href="' . esc_url( $lval ) . '" class="bstooltip" title="' . esc_attr( $this->settings_helper['social_titles'][$l_key] ) . '" data-toggle="tooltip">';
				echo '<i class="glyphicon ' . $this->settings_helper['social_classes'][$l_key] . '"></i>';
				echo '</a></li>';
			}
		}
		echo '</ul>';

		echo $after_widget;
	}

	/**
	 * Deals with the settings when they are saved by the admin. Here is
	 * where any validation should be dealt with.
	 *
	 * @param array  An array of new settings as submitted by the admin
	 * @param array  An array of the previous settings
	 * @return array The validated and (if necessary) amended settings
	 **/
	function update( $new_instance, $old_instance ) {
		$updated_instance = $this->default_settings;
		$updated_instance['title'] = $new_instance['title'];
		foreach ( $updated_instance['links'] as $l_key => $lval ) {
			if ( isset( $new_instance[$l_key] ) ) {
				$updated_instance['links'][$l_key] = $new_instance[$l_key];
			}
		}
		return $updated_instance;
	}

	/**
	 * Displays the form for this widget on the Widgets page of the WP Admin area.
	 *
	 * @param array  An array of the current settings for this widget
	 * @return void Echoes it's output
	 **/
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, $this->default_settings );
		?>
<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><strong><?php _e( 'Title', 'ipt_kb' ) ?></strong></label>
	<input type="text" class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>" id="<?php echo $this->get_field_id( 'title' ); ?>" value="<?php echo esc_html( $instance['title'] ); ?>" />
</p>
<table class="form-table">
	<?php foreach ( $instance['links'] as $l_key => $lval ) : ?>
	<tr>
		<th scope="row">
			<label for="<?php echo $this->get_field_id( $l_key ); ?>"><?php echo $this->settings_helper['social_titles'][$l_key]; ?></label>
		</th>
		<td>
			<input type="text" class="regular-text code" name="<?php echo $this->get_field_name( $l_key ); ?>" id="<?php echo $this->get_field_id( $l_key ); ?>" value="<?php echo esc_html( $lval ); ?>" />
		</td>
	</tr>
	<?php endforeach; ?>
</table>
		<?php
		// display field names here using:
		// $this->get_field_id( 'option_name' ) - the CSS ID
		// $this->get_field_name( 'option_name' ) - the HTML name
		// $instance['option_name'] - the option value
	}
}

add_action( 'widgets_init', create_function( '', "register_widget( 'IPT_KB_Social_Widget' );" ) );
