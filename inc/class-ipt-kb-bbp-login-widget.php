<?php
/**
 * bbPress Login Widget
 *
 * Adds a widget which displays the login form
 *
 * Copied from the inbuilt Login widget with extended functionality
 *
 * @package iPanelThemes Knowledgebase
 */

class IPT_KB_BBP_Login_Widget extends WP_Widget {

	/**
	 * bbPress Login Widget
	 *
	 * Registers the login widget
	 *
	 * @since bbPress (r2827)
	 *
	 * @uses apply_filters() Calls 'bbp_login_widget_options' with the
	 *                        widget options
	 */
	public function __construct() {
		$widget_ops = apply_filters( 'bbp_login_widget_options', array(
			'classname'   => 'bbp_widget_login',
			'description' => __( 'A simple login form with optional links to sign-up and lost password pages.', 'bbpress' )
		) );

		parent::__construct( false, __( '(bbPress) Login Widget', 'bbpress' ), $widget_ops );
	}

	/**
	 * Register the widget
	 *
	 * @since bbPress (r3389)
	 *
	 * @uses register_widget()
	 */
	public static function register_widget() {
		register_widget( 'IPT_KB_BBP_Login_Widget' );
	}

	/**
	 * Displays the output, the login form
	 *
	 * @since bbPress (r2827)
	 *
	 * @param mixed $args Arguments
	 * @param array $instance Instance
	 * @uses apply_filters() Calls 'bbp_login_widget_title' with the title
	 * @uses get_template_part() To get the login/logged in form
	 */
	public function widget( $args = array(), $instance = array() ) {

		// Get widget settings
		$settings = $this->parse_settings( $instance );

		// Typical WordPress filter
		$settings['title'] = apply_filters( 'widget_title', $settings['title'], $instance, $this->id_base );

		// bbPress filters
		$settings['title']    = apply_filters( 'bbp_login_widget_title',    $settings['title'],    $instance, $this->id_base );
		$settings['register'] = apply_filters( 'bbp_login_widget_register', $settings['register'], $instance, $this->id_base );
		$settings['lostpass'] = apply_filters( 'bbp_login_widget_lostpass', $settings['lostpass'], $instance, $this->id_base );

		echo $args['before_widget'];

		if ( !empty( $settings['title'] ) ) {
			echo $args['before_title'] . $settings['title'] . $args['after_title'];
		}

		if ( !is_user_logged_in() ) : ?>
			<form method="post" action="<?php bbp_wp_login_action( array( 'context' => 'login_post' ) ); ?>" class="bbp-login-form">
				<fieldset>
					<legend><?php _e( 'Log In', 'bbpress' ); ?></legend>

					<div class="bbp-username form-group">
						<label for="user_login" class="sr-only"><?php _e( 'Username', 'bbpress' ); ?>: </label>
						<div class="input-group">
							<span class="input-group-addon">
								<span class="glyphicon ipt-icon-user"></span>
							</span>
							<input placeholder="<?php _e( 'Username', 'bbpress' ); ?>" class="form-control" type="text" name="log" value="<?php bbp_sanitize_val( 'user_login', 'text' ); ?>" size="20" id="user_login" tabindex="<?php bbp_tab_index(); ?>" />
						</div>
					</div>

					<div class="bbp-password form-group">
						<label for="user_pass" class="sr-only"><?php _e( 'Password', 'bbpress' ); ?>: </label>
						<div class="input-group">
							<span class="input-group-addon">
								<span class="glyphicon ipt-icon-console"></span>
							</span>
							<input placeholder="<?php _e( 'Password', 'bbpress' ); ?>" class="form-control" type="password" name="pwd" value="<?php bbp_sanitize_val( 'user_pass', 'password' ); ?>" size="20" id="user_pass" tabindex="<?php bbp_tab_index(); ?>" />
						</div>
					</div>

					<?php do_action( 'login_form' ); ?>

					<div class="bbp-remember-me checkbox">
						<input type="checkbox" name="rememberme" value="forever" <?php checked( bbp_get_sanitize_val( 'rememberme', 'checkbox' ), true, true ); ?> id="rememberme" tabindex="<?php bbp_tab_index(); ?>" />
						<label for="rememberme"><?php _e( 'Remember Me', 'bbpress' ); ?></label>
					</div>

					<div class="bbp-submit-wrapper btn-group">
						<?php if ( !empty( $settings['lostpass'] ) ) : ?>
							<a href="<?php echo esc_url( $settings['lostpass'] ); ?>" title="<?php esc_attr_e( 'Lost Password', 'bbpress' ); ?>" class="bbp-lostpass-link btn btn-default"><span class="glyphicon ipt-icon-info"></span></a>
						<?php endif; ?>
						<?php if ( !empty( $settings['register'] ) ) : ?>
							<a href="<?php echo esc_url( $settings['register'] ); ?>" title="<?php esc_attr_e( 'Register', 'bbpress' ); ?>" class="bbp-register-link btn btn-default"><span class="glyphicon ipt-icon-signup"></span> <?php _e( 'Register', 'bbpress' ); ?></a>
						<?php endif; ?>
						<button class="btn btn-primary" type="submit" name="user-submit" id="user-submit" tabindex="<?php bbp_tab_index(); ?>" class="button submit user-submit"><span class="glyphicon ipt-icon-switch"></span> <?php _e( 'Log In', 'bbpress' ); ?></button>
					</div>
					<?php bbp_user_login_fields(); ?>
				</fieldset>
			</form>

		<?php else : ?>

			<div class="bbp-logged-in">
				<a href="<?php bbp_user_profile_url( bbp_get_current_user_id() ); ?>" class="submit user-submit thumbnail pull-left"><?php echo get_avatar( bbp_get_current_user_id(), '64' ); ?></a>
				<h4><?php bbp_user_profile_link( bbp_get_current_user_id() ); ?></h4>
				<div class="btn-group">
					<a class="btn btn-default btn-sm" href="<?php bbp_user_profile_edit_url( bbp_get_current_user_id() ); ?>" title="<?php printf( esc_attr__( "Edit Your Profile", 'ipt_kb' ) ); ?>"><span class="glyphicon glyphicon-edit"></span> <?php _e( 'Edit', 'bbpress' ); ?></a>
					<?php bbp_logout_link(); ?>
				</div>

				<div class="clearfix"></div>

				<div class="list-group">
					<a href="<?php bbp_user_profile_url( bbp_get_current_user_id() ); ?>" class="list-group-item bbp-user-forum-role <?php if ( bbp_is_user_home() && bbp_is_single_user_profile() ) echo 'active'; ?>">
						<span class="glyphicon ipt-icon-user4"></span> <?php  printf( __( '%s Forum Role', 'ipt_kb' ), '<span class="badge">' . bbp_get_user_display_role( bbp_get_current_user_id() ) . '</span>' ); ?>
					</a>
					<a href="<?php bbp_user_topics_created_url( bbp_get_current_user_id() ); ?>" class="list-group-item bbp-user-topic-count <?php if ( bbp_is_user_home() && bbp_is_single_user_topics() ) echo 'active'; ?>">
						<span class="glyphicon ipt-icon-bubbles4"></span> <?php printf( __( '%s Topics Started', 'ipt_kb' ), '<span class="badge">' . bbp_get_user_topic_count_raw( bbp_get_current_user_id() ) . '</span>' ); ?>
					</a>
					<a href="<?php bbp_user_replies_created_url( bbp_get_current_user_id() ); ?>" class="list-group-item bbp-user-reply-count <?php if ( bbp_is_user_home() && bbp_is_single_user_replies() ) echo 'active'; ?>">
						<span class="glyphicon ipt-icon-reply"></span> <?php printf( __( '%s Replies Created', 'ipt_kb' ), '<span class="badge">' . bbp_get_user_reply_count_raw( bbp_get_current_user_id() ) . '</span>' ); ?>
					</a>
					<?php if ( bbp_is_favorites_active() ) : ?>
					<a href="<?php bbp_favorites_permalink( bbp_get_current_user_id() ); ?>" class="list-group-item bbp-user-favorite-count <?php if ( bbp_is_user_home() && bbp_is_favorites() ) echo 'active'; ?>" title="<?php printf( esc_attr__( "Your Favorites", 'ipt_kb' ) ); ?>">
						<span class="glyphicon ipt-icon-heart"></span> <?php printf( __( '%s Favorites', 'ipt_kb' ), '<span class="badge">' . count( bbp_get_user_favorites_topic_ids( bbp_get_current_user_id() ) ) . '</span>' ); ?>
					</a>
					<?php endif; ?>
					<?php if ( bbp_is_subscriptions_active() ) : ?>
					<a href="<?php bbp_subscriptions_permalink( bbp_get_current_user_id() ); ?>" class="list-group-item bbp-user-subscribe-count <?php if ( bbp_is_user_home() && bbp_is_subscriptions() ) echo 'active'; ?>" title="<?php printf( esc_attr__( "Your Subscriptions", 'ipt_kb' ) ); ?>">
						<span class="glyphicon ipt-icon-bookmarks"></span> <?php printf( __( '%s Subscriptions', 'ipt_kb' ), '<span class="badge">' . count( bbp_get_user_subscribed_topic_ids( bbp_get_current_user_id() ) ) . '</span>' ); ?>
					</a>
					<?php endif; ?>
				</div>
			</div>

		<?php endif;

		echo $args['after_widget'];
	}

	/**
	 * Update the login widget options
	 *
	 * @since bbPress (r2827)
	 *
	 * @param array $new_instance The new instance options
	 * @param array $old_instance The old instance options
	 */
	public function update( $new_instance, $old_instance ) {
		$instance             = $old_instance;
		$instance['title']    = strip_tags( $new_instance['title'] );
		$instance['register'] = esc_url_raw( $new_instance['register'] );
		$instance['lostpass'] = esc_url_raw( $new_instance['lostpass'] );

		return $instance;
	}

	/**
	 * Output the login widget options form
	 *
	 * @since bbPress (r2827)
	 *
	 * @param $instance Instance
	 * @uses BBP_Login_Widget::get_field_id() To output the field id
	 * @uses BBP_Login_Widget::get_field_name() To output the field name
	 */
	public function form( $instance = array() ) {

		// Get widget settings
		$settings = $this->parse_settings( $instance ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'bbpress' ); ?>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $settings['title'] ); ?>" /></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'register' ); ?>"><?php _e( 'Register URI:', 'bbpress' ); ?>
			<input class="widefat" id="<?php echo $this->get_field_id( 'register' ); ?>" name="<?php echo $this->get_field_name( 'register' ); ?>" type="text" value="<?php echo esc_url( $settings['register'] ); ?>" /></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'lostpass' ); ?>"><?php _e( 'Lost Password URI:', 'bbpress' ); ?>
			<input class="widefat" id="<?php echo $this->get_field_id( 'lostpass' ); ?>" name="<?php echo $this->get_field_name( 'lostpass' ); ?>" type="text" value="<?php echo esc_url( $settings['lostpass'] ); ?>" /></label>
		</p>

		<?php
	}

	/**
	 * Merge the widget settings into defaults array.
	 *
	 * @since bbPress (r4802)
	 *
	 * @param $instance Instance
	 * @uses bbp_parse_args() To merge widget settings into defaults
	 */
	public function parse_settings( $instance = array() ) {
		return bbp_parse_args( $instance, array(
			'title'    => '',
			'register' => '',
			'lostpass' => ''
		), 'login_widget_settings' );
	}
}

function ipt_kb_override_bbp_login_widget() {
	unregister_widget( 'BBP_Login_Widget' );
	register_widget( 'IPT_KB_BBP_Login_Widget' );
}
add_action( 'widgets_init', 'ipt_kb_override_bbp_login_widget', 20 );
