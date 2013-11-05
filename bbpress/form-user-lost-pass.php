<?php

/**
 * User Lost Password Form
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<form class="form-horizontal" method="post" action="<?php bbp_wp_login_action( array( 'action' => 'lostpassword', 'context' => 'login_post' ) ); ?>" class="bbp-login-form">
	<div class="bbp-form">
		<h3><?php _e( 'Lost Password', 'bbpress' ); ?></h3>

		<div class="bbp-username form-group">
			<label class="col-sm-4" for="user_login" class="hide"><?php _e( 'Username or Email', 'bbpress' ); ?>: </label>
			<div class="col-sm-8"><input class="form-control" type="text" name="user_login" value="" size="20" id="user_login" tabindex="<?php bbp_tab_index(); ?>" /></div>
		</div>

		<?php do_action( 'login_form', 'resetpass' ); ?>

		<div class="bbp-submit-wrapper">
			<button class="btn btn-primary btn-lg" type="submit" tabindex="<?php bbp_tab_index(); ?>" name="user-submit" class="button submit user-submit"><span class="glyphicon ipt-icon-mail3"></span> <?php _e( 'Reset My Password', 'bbpress' ); ?></button>
			<?php bbp_user_lost_pass_fields(); ?>
		</div>
	</div>
</form>
