<?php

/**
 * Split Topic
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div id="bbpress-forums">
	<?php if ( is_user_logged_in() && current_user_can( 'edit_topic', bbp_get_topic_id() ) ) : ?>
		<div id="split-topic-<?php bbp_topic_id(); ?>" class="bbp-topic-split">
			<form id="split_topic" name="split_topic" method="post" action="<?php the_permalink(); ?>">

				<div class="bbp-form">

					<h3><?php printf( __( 'Split topic "%s"', 'bbpress' ), bbp_get_topic_title() ); ?></h3>

						<div class="alert alert-info">
							<p><?php _e( 'When you split a topic, you are slicing it in half starting with the reply you just selected. Choose to use that reply as a new topic with a new title, or merge those replies into an existing topic.', 'bbpress' ); ?></p>
						</div>

						<div class="alert alert-warning">
							<p><?php _e( 'If you use the existing topic option, replies within both topics will be merged chronologically. The order of the merged replies is based on the time and date they were posted.', 'bbpress' ); ?></p>
						</div>

						<h4><?php _e( 'Split Method', 'bbpress' ); ?></h4>

						<div class="radio">
							<input name="bbp_topic_split_option" id="bbp_topic_split_option_reply" type="radio" checked="checked" value="reply" tabindex="<?php bbp_tab_index(); ?>" />
							<label for="bbp_topic_split_option_reply"><?php printf( __( 'New topic in <strong>%s</strong> titled:', 'bbpress' ), bbp_get_forum_title( bbp_get_topic_forum_id( bbp_get_topic_id() ) ) ); ?></label>
						</div>
						<div class="form-group">
							<input class="form-control" type="text" id="bbp_topic_split_destination_title" value="<?php printf( __( 'Split: %s', 'bbpress' ), bbp_get_topic_title() ); ?>" tabindex="<?php bbp_tab_index(); ?>" size="35" name="bbp_topic_split_destination_title" />
						</div>

						<?php if ( bbp_has_topics( array( 'show_stickies' => false, 'post_parent' => bbp_get_topic_forum_id( bbp_get_topic_id() ), 'post__not_in' => array( bbp_get_topic_id() ) ) ) ) : ?>
							<div class="radio">
								<input name="bbp_topic_split_option" id="bbp_topic_split_option_existing" type="radio" value="existing" tabindex="<?php bbp_tab_index(); ?>" />
								<label for="bbp_topic_split_option_existing"><?php _e( 'Use an existing topic in this forum:', 'bbpress' ); ?></label>
							</div>
							<div class="form-group">
								<?php
								bbp_dropdown( array(
									'post_type'   => bbp_get_topic_post_type(),
									'post_parent' => bbp_get_topic_forum_id( bbp_get_topic_id() ),
									'selected'    => -1,
									'exclude'     => bbp_get_topic_id(),
									'select_id'   => 'bbp_destination_topic',
									'none_found'  => __( 'No other topics found!', 'bbpress' )
								) );
								?>
							</div>
						<?php endif; ?>


							<h4><?php _e( 'Topic Extras', 'bbpress' ); ?></h4>

							<?php if ( bbp_is_subscriptions_active() ) : ?>
							<div class="checkbox">
								<input name="bbp_topic_subscribers" id="bbp_topic_subscribers" type="checkbox" value="1" checked="checked" tabindex="<?php bbp_tab_index(); ?>" />
								<label for="bbp_topic_subscribers"><?php _e( 'Copy subscribers to the new topic', 'bbpress' ); ?></label><br />
							</div>
							<?php endif; ?>
							<div class="checkbox">
							<input name="bbp_topic_favoriters" id="bbp_topic_favoriters" type="checkbox" value="1" checked="checked" tabindex="<?php bbp_tab_index(); ?>" />
							<label for="bbp_topic_favoriters"><?php _e( 'Copy favoriters to the new topic', 'bbpress' ); ?></label><br />
							</div>
							<?php if ( bbp_allow_topic_tags() ) : ?>
							<div class="checkbox">
								<input name="bbp_topic_tags" id="bbp_topic_tags" type="checkbox" value="1" checked="checked" tabindex="<?php bbp_tab_index(); ?>" />
								<label for="bbp_topic_tags"><?php _e( 'Copy topic tags to the new topic', 'bbpress' ); ?></label><br />
							</div>
							<?php endif; ?>

						<div class="alert alert-danger">
							<p><?php _e( '<strong>WARNING:</strong> This process cannot be undone.', 'bbpress' ); ?></p>
						</div>

						<div class="bbp-submit-wrapper">
							<button class="btn btn-lg btn-primary" type="submit" tabindex="<?php bbp_tab_index(); ?>" id="bbp_merge_topic_submit" name="bbp_merge_topic_submit" class="button submit"><?php _e( 'Submit', 'bbpress' ); ?></button>
						</div>

					<?php bbp_split_topic_form_fields(); ?>

				</div>
			</form>
		</div>

	<?php else : ?>

		<div id="no-topic-<?php bbp_topic_id(); ?>" class="bbp-no-topic">
			<div class="entry-content alert alert-danger"><?php is_user_logged_in() ? _e( 'You do not have the permissions to edit this topic!', 'bbpress' ) : _e( 'You cannot edit this topic.', 'bbpress' ); ?></div>
		</div>

	<?php endif; ?>

</div>
