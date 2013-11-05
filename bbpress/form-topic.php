<?php

/**
 * New/Edit Topic
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php if ( !bbp_is_single_forum() ) : ?>
<div id="bbpress-forums">
<?php endif; ?>

<?php if ( bbp_is_topic_edit() ) : ?>
	<?php bbp_topic_tag_list( bbp_get_topic_id() ); ?>
	<?php bbp_single_topic_description( array( 'topic_id' => bbp_get_topic_id() ) ); ?>
<?php endif; ?>

<?php if ( bbp_current_user_can_access_create_topic_form() ) : ?>
	<div id="new-topic-<?php bbp_topic_id(); ?>" class="bbp-topic-form">
		<form id="new-post" class="bbp-form" name="new-post" method="post" action="<?php the_permalink(); ?>">
			<?php do_action( 'bbp_theme_before_topic_form' ); ?>

			<h3>
				<?php
					if ( bbp_is_topic_edit() )
						printf( __( 'Now Editing &ldquo;%s&rdquo;', 'bbpress' ), bbp_get_topic_title() );
					else
						bbp_is_single_forum() ? printf( __( 'Create New Topic in &ldquo;%s&rdquo;', 'bbpress' ), bbp_get_forum_title() ) : _e( 'Create New Topic', 'bbpress' );
				?>
			</h3>
			<?php do_action( 'bbp_theme_before_topic_form_notices' ); ?>

			<?php if ( !bbp_is_topic_edit() && bbp_is_forum_closed() ) : ?>
				<div class="alert alert-success">
					<p><?php _e( 'This forum is marked as closed to new topics, however your posting capabilities still allow you to do so.', 'bbpress' ); ?></p>
				</div>
			<?php endif; ?>

			<?php if ( current_user_can( 'unfiltered_html' ) ) : ?>
				<div class="alert alert-success">
					<p><?php _e( 'Your account has the ability to post unrestricted HTML content.', 'bbpress' ); ?></p>
				</div>
			<?php endif; ?>

			<?php do_action( 'bbp_template_notices' ); ?>

				<div>

					<?php bbp_get_template_part( 'form', 'anonymous' ); ?>

					<?php do_action( 'bbp_theme_before_topic_form_title' ); ?>

					<div class="form-group">
						<label for="bbp_topic_title"><?php printf( __( 'Topic Title (Maximum Length: %d):', 'bbpress' ), bbp_get_title_max_length() ); ?></label>
						<div class="input-group">
							<span class="input-group-addon">
								<span class="glyphicon ipt-icon-ticket" style="font-size: 24px;"></span>
							</span>
							<input class="form-control input-lg" type="text" id="bbp_topic_title" value="<?php bbp_form_topic_title(); ?>" tabindex="<?php bbp_tab_index(); ?>" size="40" name="bbp_topic_title" maxlength="<?php bbp_title_max_length(); ?>" />
						</div>
					</div>

					<?php do_action( 'bbp_theme_after_topic_form_title' ); ?>

					<?php do_action( 'bbp_theme_before_topic_form_content' ); ?>

					<?php bbp_the_content( array( 'context' => 'topic' ) ); ?>

					<?php do_action( 'bbp_theme_after_topic_form_content' ); ?>

					<?php if ( ! ( bbp_use_wp_editor() || current_user_can( 'unfiltered_html' ) ) ) : ?>
						<div class="well well-sm">
							<p><?php _e( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:','bbpress' ); ?><br />
							<code><?php bbp_allowed_tags(); ?></code></p>
						</div>
					<?php endif; ?>

					<?php if ( bbp_allow_topic_tags() && current_user_can( 'assign_topic_tags' ) ) : ?>
						<?php do_action( 'bbp_theme_before_topic_form_tags' ); ?>
						<div class="form-group">
							<label for="bbp_topic_tags"><?php _e( 'Topic Tags:', 'bbpress' ); ?></label>
							<div class="input-group">
								<span class="input-group-addon">
									<span class="glyphicon ipt-icon-tags"></span>
								</span>
								<input type="text" class="form-control" value="<?php bbp_form_topic_tags(); ?>" tabindex="<?php bbp_tab_index(); ?>" size="40" name="bbp_topic_tags" id="bbp_topic_tags" <?php disabled( bbp_is_topic_spam() ); ?> />
							</div>
						</div>
						<?php do_action( 'bbp_theme_after_topic_form_tags' ); ?>

					<?php endif; ?>

					<?php if ( !bbp_is_single_forum() ) : ?>
						<?php do_action( 'bbp_theme_before_topic_form_forum' ); ?>
						<div class="form-group">
							<label for="bbp_forum_id"><?php _e( 'Forum:', 'bbpress' ); ?></label><br />
							<?php
								bbp_dropdown( array(
									'show_none' => __( '(No Forum)', 'bbpress' ),
									'selected'  => bbp_get_form_topic_forum()
								) );
							?>
						</div>
						<?php do_action( 'bbp_theme_after_topic_form_forum' ); ?>
					<?php endif; ?>

					<?php if ( current_user_can( 'moderate' ) ) : ?>
						<div class="row">
							<div class="col-sm-6">
								<?php do_action( 'bbp_theme_before_topic_form_type' ); ?>

								<div class="form-group">
									<label for="bbp_stick_topic"><?php _e( 'Topic Type:', 'bbpress' ); ?></label><br />
									<?php bbp_form_topic_type_dropdown(); ?>
								</div>

								<?php do_action( 'bbp_theme_after_topic_form_type' ); ?>
							</div>

							<div class="col-sm-6">
								<?php do_action( 'bbp_theme_before_topic_form_status' ); ?>

								<div class="form-group">
									<label for="bbp_topic_status"><?php _e( 'Topic Status:', 'bbpress' ); ?></label><br />
									<?php bbp_form_topic_status_dropdown(); ?>
								</div>

								<?php do_action( 'bbp_theme_after_topic_form_status' ); ?>
							</div>
						</div>
					<?php endif; ?>

					<?php if ( bbp_is_subscriptions_active() && !bbp_is_anonymous() && ( !bbp_is_topic_edit() || ( bbp_is_topic_edit() && !bbp_is_topic_anonymous() ) ) ) : ?>
						<?php do_action( 'bbp_theme_before_topic_form_subscriptions' ); ?>

						<div class="checkbox">
							<input name="bbp_topic_subscription" id="bbp_topic_subscription" type="checkbox" value="bbp_subscribe" <?php bbp_form_topic_subscribed(); ?> tabindex="<?php bbp_tab_index(); ?>" />
							<?php if ( bbp_is_topic_edit() && ( bbp_get_topic_author_id() !== bbp_get_current_user_id() ) ) : ?>
								<label for="bbp_topic_subscription"><?php _e( 'Notify the author of follow-up replies via email', 'bbpress' ); ?></label>
							<?php else : ?>
								<label for="bbp_topic_subscription"><?php _e( 'Notify me of follow-up replies via email', 'bbpress' ); ?></label>
							<?php endif; ?>
						</div>

						<?php do_action( 'bbp_theme_after_topic_form_subscriptions' ); ?>
					<?php endif; ?>

					<?php if ( bbp_allow_revisions() && bbp_is_topic_edit() ) : ?>
						<?php do_action( 'bbp_theme_before_topic_form_revisions' ); ?>
						<div class="checkbox">
							<input name="bbp_log_topic_edit" id="bbp_log_topic_edit" type="checkbox" value="1" <?php bbp_form_topic_log_edit(); ?> tabindex="<?php bbp_tab_index(); ?>" />
							<label for="bbp_log_topic_edit"><?php _e( 'Keep a log of this edit:', 'bbpress' ); ?></label><br />
						</div>

						<div class="form-group">
							<label for="bbp_topic_edit_reason"><?php printf( __( 'Optional reason for editing:', 'bbpress' ), bbp_get_current_user_name() ); ?></label><br />
							<input class="form-control" type="text" value="<?php bbp_form_topic_edit_reason(); ?>" tabindex="<?php bbp_tab_index(); ?>" size="40" name="bbp_topic_edit_reason" id="bbp_topic_edit_reason" />
						</div>

						<?php do_action( 'bbp_theme_after_topic_form_revisions' ); ?>
					<?php endif; ?>

					<?php do_action( 'bbp_theme_before_topic_form_submit_wrapper' ); ?>

					<div class="bbp-submit-wrapper">

						<?php do_action( 'bbp_theme_before_topic_form_submit_button' ); ?>

						<button type="submit" class="btn btn-primary btn-lg" tabindex="<?php bbp_tab_index(); ?>" id="bbp_topic_submit" name="bbp_topic_submit" class="button submit"><?php _e( 'Submit', 'bbpress' ); ?></button>

						<?php do_action( 'bbp_theme_after_topic_form_submit_button' ); ?>

					</div>

					<?php do_action( 'bbp_theme_after_topic_form_submit_wrapper' ); ?>

				</div>

				<?php bbp_topic_form_fields(); ?>

			<?php do_action( 'bbp_theme_after_topic_form' ); ?>

		</form>
	</div>

<?php elseif ( bbp_is_forum_closed() ) : ?>

	<div id="no-topic-<?php bbp_topic_id(); ?>" class="bbp-no-topic">
		<div class="alert alert-warning">
			<p><?php printf( __( 'The forum &#8216;%s&#8217; is closed to new topics and replies.', 'bbpress' ), bbp_get_forum_title() ); ?></p>
		</div>
	</div>

<?php else : ?>

	<div id="no-topic-<?php bbp_topic_id(); ?>" class="bbp-no-topic">
		<div class="alert alert-warning">
			<p><?php is_user_logged_in() ? _e( 'You cannot create new topics.', 'bbpress' ) : _e( 'You must be logged in to create new topics.', 'bbpress' ); ?></p>
		</div>
	</div>

<?php endif; ?>

<?php if ( !bbp_is_single_forum() ) : ?>
</div>
<?php endif; ?>
