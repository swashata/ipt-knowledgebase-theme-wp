<?php

/**
 * Anonymous User
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php if ( bbp_is_anonymous() || ( bbp_is_topic_edit() && bbp_is_topic_anonymous() ) || ( bbp_is_reply_edit() && bbp_is_reply_anonymous() ) ) : ?>

	<?php do_action( 'bbp_theme_before_anonymous_form' ); ?>
	<h4><?php ( bbp_is_topic_edit() || bbp_is_reply_edit() ) ? _e( 'Author Information', 'bbpress' ) : _e( 'Your information:', 'bbpress' ); ?></h4>
	<div class="bbp-form row">
		<?php do_action( 'bbp_theme_anonymous_form_extras_top' ); ?>

		<div class="form-group col-sm-4">
			<label class="sr-only" for="bbp_anonymous_author"><?php _e( 'Name (required):', 'bbpress' ); ?></label><br />
			<input placeholder="<?php esc_attr_e( 'Name (required):', 'bbpress' ); ?>" class="form-control" type="text" id="bbp_anonymous_author"  value="<?php bbp_is_topic_edit() ? bbp_topic_author()       : bbp_is_reply_edit() ? bbp_reply_author()       : bbp_current_anonymous_user_data( 'name' );    ?>" tabindex="<?php bbp_tab_index(); ?>" size="40" name="bbp_anonymous_name" />
		</div>

		<div class="form-group col-sm-4">
			<label class="sr-only" for="bbp_anonymous_email"><?php _e( 'Mail (will not be published) (required):', 'bbpress' ); ?></label><br />
			<input placeholder="<?php esc_attr_e( 'Mail (will not be published) (required):', 'bbpress' ); ?>" class="form-control" type="text" id="bbp_anonymous_email"   value="<?php bbp_is_topic_edit() ? bbp_topic_author_email() : bbp_is_reply_edit() ? bbp_reply_author_email() : bbp_current_anonymous_user_data( 'email' );   ?>" tabindex="<?php bbp_tab_index(); ?>" size="40" name="bbp_anonymous_email" />
		</div>

		<div class="form-group col-sm-4">
			<label class="sr-only" for="bbp_anonymous_website"><?php _e( 'Website:', 'bbpress' ); ?></label><br />
			<input placeholder="<?php esc_attr_e( 'Website:', 'bbpress' ); ?>" class="form-control" type="text" id="bbp_anonymous_website" value="<?php bbp_is_topic_edit() ? bbp_topic_author_url()   : bbp_is_reply_edit() ? bbp_reply_author_url()   : bbp_current_anonymous_user_data( 'website' ); ?>" tabindex="<?php bbp_tab_index(); ?>" size="40" name="bbp_anonymous_website" />
		</div>

		<?php do_action( 'bbp_theme_anonymous_form_extras_bottom' ); ?>

	</div>

	<?php do_action( 'bbp_theme_after_anonymous_form' ); ?>

<?php endif; ?>
