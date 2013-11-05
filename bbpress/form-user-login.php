<?php

/**
 * User Login Form
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<form class="form-horizontal" method="post" action="<?php bbp_wp_login_action( array( 'context' => 'login_post' ) ); ?>" class="bbp-login-form">
	<div class="bbp-form">
		<h3><?php _e( 'Log In', 'bbpress' ); ?></h3>

		<div class="bbp-username form-group">
			<label class="col-sm-4" for="user_login"><?php _e( 'Username', 'bbpress' ); ?>: </label>
			<div class="col-sm-8"><input class="form-control" type="text" name="log" value="<?php bbp_sanitize_val( 'user_login', 'text' ); ?>" size="20" id="user_login" tabindex="<?php bbp_tab_index(); ?>" /></div>
		</div>

		<div class="bbp-password form-group">
			<label class="col-sm-4" for="user_pass"><?php _e( 'Password', 'bbpress' ); ?>: </label>
			<div class="col-sm-8"><input class="form-control" type="password" name="pwd" value="<?php bbp_sanitize_val( 'user_pass', 'password' ); ?>" size="20" id="user_pass" tabindex="<?php bbp_tab_index(); ?>" /></div>
		</div>

		<?php do_action( 'login_form' ); ?>

		<div class="bbp-remember-me checkbox">
			<input type="checkbox" name="rememberme" value="forever" <?php checked( bbp_get_sanitize_val( 'rememberme', 'checkbox' ) ); ?> id="rememberme" tabindex="<?php bbp_tab_index(); ?>" />
			<label for="rememberme"><?php _e( 'Keep me signed in', 'bbpress' ); ?></label>
		</div>

		<div class="bbp-submit-wrapper">
			<button type="submit" class="btn btn-primary btn-lg" tabindex="<?php bbp_tab_index(); ?>" name="user-submit" class="button submit user-submit"><span class="glyphicon ipt-icon-switch"></span> <?php _e( 'Log In', 'bbpress' ); ?></button>
			<?php bbp_user_login_fields(); ?>
		</div>
	</div>
</form>
