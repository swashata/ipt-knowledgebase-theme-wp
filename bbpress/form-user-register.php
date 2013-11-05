<?php

/**
 * User Registration Form
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<form class="form-horizontal" method="post" action="<?php bbp_wp_login_action( array( 'context' => 'login_post' ) ); ?>" class="bbp-login-form">
	<div class="bbp-form">
		<h3><?php _e( 'Create an Account', 'bbpress' ); ?></h3>

		<div class="alert alert-info">
			<p><?php _e( 'Your username must be unique, and cannot be changed later.', 'bbpress' ) ?></p>
			<p><?php _e( 'We use your email address to email you a secure password and verify your account.', 'bbpress' ) ?></p>

		</div>

		<div class="bbp-username form-group">
			<label class="col-sm-4" for="user_login"><?php _e( 'Username', 'bbpress' ); ?>: </label>
			<div class="col-sm-8"><input class="form-control" type="text" name="user_login" value="<?php bbp_sanitize_val( 'user_login' ); ?>" size="20" id="user_login" tabindex="<?php bbp_tab_index(); ?>" /></div>
		</div>

		<div class="bbp-email form-group">
			<label class="col-sm-4" for="user_email"><?php _e( 'Email', 'bbpress' ); ?>: </label>
			<div class="col-sm-8"><input class="form-control" type="text" name="user_email" value="<?php bbp_sanitize_val( 'user_email' ); ?>" size="20" id="user_email" tabindex="<?php bbp_tab_index(); ?>" /></div>
		</div>

		<?php do_action( 'register_form' ); ?>

		<div class="bbp-submit-wrapper">
			<button type="submit" class="btn btn-lg btn-primary" tabindex="<?php bbp_tab_index(); ?>" name="user-submit" class="button submit user-submit"><span class="glyphicon ipt-icon-signup"></span> <?php _e( 'Register', 'bbpress' ); ?></button>
			<?php bbp_user_register_fields(); ?>
		</div>
	</div>
</form>
