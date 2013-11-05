<?php

/**
 * bbPress User Profile Edit Part
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<form id="bbp-your-profile" class="form-horizontal" action="<?php bbp_user_profile_edit_url( bbp_get_displayed_user_id() ); ?>" method="post" enctype="multipart/form-data">

	<h2 class="entry-title"><?php _e( 'Name', 'bbpress' ) ?></h2>

	<?php do_action( 'bbp_user_edit_before' ); ?>

	<div class="bbp-form">

		<?php do_action( 'bbp_user_edit_before_name' ); ?>

		<div class="form-group">
			<label class="col-sm-4" for="first_name"><?php _e( 'First Name', 'bbpress' ) ?></label>
			<div class="col-sm-8"><input class="form-control" type="text" name="first_name" id="first_name" value="<?php bbp_displayed_user_field( 'first_name', 'edit' ); ?>" class="regular-text" tabindex="<?php bbp_tab_index(); ?>" /></div>
		</div>

		<div class="form-group">
			<label class="col-sm-4" for="last_name"><?php _e( 'Last Name', 'bbpress' ) ?></label>
			<div class="col-sm-8"><input class="form-control" type="text" name="last_name" id="last_name" value="<?php bbp_displayed_user_field( 'last_name', 'edit' ); ?>" class="regular-text" tabindex="<?php bbp_tab_index(); ?>" /></div>
		</div>

		<div class="form-group">
			<label class="col-sm-4" for="nickname"><?php _e( 'Nickname', 'bbpress' ); ?></label>
			<div class="col-sm-8"><input class="form-control" type="text" name="nickname" id="nickname" value="<?php bbp_displayed_user_field( 'nickname', 'edit' ); ?>" class="regular-text" tabindex="<?php bbp_tab_index(); ?>" /></div>
		</div>

		<div class="form-group">
			<label class="col-sm-4" for="display_name"><?php _e( 'Display Name', 'bbpress' ) ?></label>
			<div class="col-sm-8">
				<?php ob_start(); ?>
				<?php bbp_edit_user_display_name(); ?>
				<?php $usr_ddn = ob_get_clean(); ?>
				<?php echo str_replace( '<select', '<select class="form-control"', $usr_ddn ); ?>
			</div>
		</div>

		<?php do_action( 'bbp_user_edit_after_name' ); ?>

	</div>

	<h2 class="entry-title"><?php _e( 'Contact Info', 'bbpress' ) ?></h2>

	<div class="bbp-form">
		<?php do_action( 'bbp_user_edit_before_contact' ); ?>

		<div class="form-group">
			<label class="col-sm-4" for="url"><?php _e( 'Website', 'bbpress' ) ?></label>
			<div class="col-sm-8"><input class="form-control" type="text" name="url" id="url" value="<?php bbp_displayed_user_field( 'user_url', 'edit' ); ?>" class="regular-text code" tabindex="<?php bbp_tab_index(); ?>" /></div>
		</div>

		<?php foreach ( bbp_edit_user_contact_methods() as $name => $desc ) : ?>
			<div class="form-group">
				<label class="col-sm-4" for="<?php echo esc_attr( $name ); ?>"><?php echo apply_filters( 'user_' . $name . '_label', $desc ); ?></label>
				<div class="col-sm-8"><input class="form-control" type="text" name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $name ); ?>" value="<?php bbp_displayed_user_field( $name, 'edit' ); ?>" class="regular-text" tabindex="<?php bbp_tab_index(); ?>" /></div>
			</div>
		<?php endforeach; ?>

		<?php do_action( 'bbp_user_edit_after_contact' ); ?>

	</div>

	<h2 class="entry-title"><?php bbp_is_user_home_edit() ? _e( 'About Yourself', 'bbpress' ) : _e( 'About the user', 'bbpress' ); ?></h2>

	<div class="bbp-form">
		<?php do_action( 'bbp_user_edit_before_about' ); ?>

		<div class="form-group">
			<label class="col-sm-4" for="description"><?php _e( 'Biographical Info', 'bbpress' ); ?></label>
			<div class="col-sm-8"><textarea class="form-control" name="description" id="description" rows="5" cols="30" tabindex="<?php bbp_tab_index(); ?>"><?php bbp_displayed_user_field( 'description', 'edit' ); ?></textarea></div>
		</div>

		<?php do_action( 'bbp_user_edit_after_about' ); ?>
	</div>

	<h2 class="entry-title"><?php _e( 'Account', 'bbpress' ) ?></h2>

	<div class="bbp-form">
		<?php do_action( 'bbp_user_edit_before_account' ); ?>

		<div class="form-group">
			<label class="col-sm-4" for="user_login"><?php _e( 'Username', 'bbpress' ); ?></label>
			<div class="col-sm-8"><input class="form-control" type="text" name="user_login" id="user_login" value="<?php bbp_displayed_user_field( 'user_login', 'edit' ); ?>" disabled="disabled" class="regular-text" tabindex="<?php bbp_tab_index(); ?>" /></div>
		</div>

		<div class="form-group">
			<label class="col-sm-4" for="email"><?php _e( 'Email', 'bbpress' ); ?></label>
			<div class="col-sm-8"><input class="form-control" type="text" name="email" id="email" value="<?php bbp_displayed_user_field( 'user_email', 'edit' ); ?>" class="regular-text" tabindex="<?php bbp_tab_index(); ?>" /></div>
		</div>
		<?php
		// Handle address change requests
		$new_email = get_option( bbp_get_displayed_user_id() . '_new_email' );
		if ( !empty( $new_email ) && $new_email !== bbp_get_displayed_user_field( 'user_email', 'edit' ) ) : ?>
			<p class="alert alert-info">
				<?php printf( __( 'There is a pending email address change to <code>%1$s</code>. <a class="btn btn-sm btn-danger" href="%2$s">Cancel</a>', 'bbpress' ), $new_email['newemail'], esc_url( self_admin_url( 'user.php?dismiss=' . bbp_get_current_user_id()  . '_new_email' ) ) ); ?>
			</p>
		<?php endif; ?>

		<div id="password" class="form-group">
			<label class="col-sm-4" for="pass1"><?php _e( 'New Password', 'bbpress' ); ?></label>
			<div class="bbp-form password col-sm-8">
				<p><input class="form-control" type="password" name="pass1" id="pass1" size="16" value="" autocomplete="off" tabindex="<?php bbp_tab_index(); ?>" /></p>
				<p class="alert alert-info"><?php _e( 'If you would like to change the password type a new one. Otherwise leave this blank.', 'bbpress' ); ?></p>

				<p><input class="form-control" type="password" name="pass2" id="pass2" size="16" value="" autocomplete="off" tabindex="<?php bbp_tab_index(); ?>" /></p>
				<p class="alert alert-warning"><?php _e( 'Type your new password again.', 'bbpress' ); ?></p>

				<div class="well well-sm"><p class="text-primary" id="pass-strength-result"><?php _e( 'Strength indicator', 'bbpress' ); ?></p></div>
				<p class="alert alert-info indicator-hint"><?php _e( 'Your password should be at least ten characters long. Use upper and lower case letters, numbers, and symbols to make it even stronger.', 'bbpress' ); ?></p>
			</div>
		</div>

		<?php do_action( 'bbp_user_edit_after_account' ); ?>
	</div>

	<?php if ( current_user_can( 'edit_users' ) && ! bbp_is_user_home_edit() ) : ?>

		<h2 class="entry-title"><?php _e( 'User Role', 'bbpress' ) ?></h2>

		<div class="bbp-form">
			<?php do_action( 'bbp_user_edit_before_role' ); ?>

			<?php if ( is_multisite() && is_super_admin() && current_user_can( 'manage_network_options' ) ) : ?>
				<div class="form-group">
					<label class="col-sm-4" for="super_admin"><?php _e( 'Network Role', 'bbpress' ); ?></label>
					<div class="checkbox col-sm-8">
						<input class="checkbox" type="checkbox" id="super_admin" name="super_admin"<?php checked( is_super_admin( bbp_get_displayed_user_id() ) ); ?> tabindex="<?php bbp_tab_index(); ?>" />
						<label for="super_admin"><?php _e( 'Grant this user super admin privileges for the Network.', 'bbpress' ); ?></label>
					</div>
				</div>
			<?php endif; ?>

			<?php bbp_get_template_part( 'form', 'user-roles' ); ?>
			<?php do_action( 'bbp_user_edit_after_role' ); ?>
		</div>

	<?php endif; ?>

	<?php do_action( 'bbp_user_edit_after' ); ?>

	<div class="submit text-right">
		<?php bbp_edit_user_form_fields(); ?>
		<button class="btn btn-primary btn-lg" type="submit" tabindex="<?php bbp_tab_index(); ?>" id="bbp_user_edit_submit" name="bbp_user_edit_submit" class="button submit user-submit"><?php bbp_is_user_home_edit() ? _e( 'Update Profile', 'bbpress' ) : _e( 'Update User', 'bbpress' ); ?></button>
	</div>

</form>
