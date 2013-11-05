<?php

/**
 * Replies Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php do_action( 'bbp_template_before_replies_loop' ); ?>

<ul id="topic-<?php bbp_topic_id(); ?>-replies" class="forums bbp-replies list-group">
	<li class="bbp-header list-group-item active">
		<div class="bbp-reply-author"><?php  _e( 'Author',  'bbpress' ); ?></div><!-- .bbp-reply-author -->
		<div class="bbp-reply-content">
			<?php if ( !bbp_show_lead_topic() ) : ?>
				<?php _e( 'Posts', 'bbpress' ); ?>
				<div class="btn-group pull-right bbp-topic-action">
					<?php bbp_user_subscribe_link(); ?>
					<?php bbp_user_favorites_link(); ?>
				</div>
			<?php else : ?>
				<?php _e( 'Replies', 'bbpress' ); ?>
			<?php endif; ?>
		</div><!-- .bbp-reply-content -->
	</li><!-- .bbp-header -->

	<?php if ( bbp_thread_replies() ) : ?>
	<li class="bbp-body">
			<?php bbp_list_replies(); ?>
	</li><!-- .bbp-body -->
	<?php else : ?>
	<?php while ( bbp_replies() ) : bbp_the_reply(); ?>
	<li class="list-group-item">
		<?php bbp_get_template_part( 'loop', 'single-reply' ); ?>
	</li>
	<?php endwhile; ?>
	<?php endif; ?>

	<li class="bbp-footer list-group-item active">
		<div class="bbp-reply-author"><?php  _e( 'Author',  'bbpress' ); ?></div>
		<div class="bbp-reply-content">
			<?php if ( !bbp_show_lead_topic() ) : ?>
				<?php _e( 'Posts', 'bbpress' ); ?>
			<?php else : ?>
				<?php _e( 'Replies', 'bbpress' ); ?>
			<?php endif; ?>
		</div><!-- .bbp-reply-content -->
	</li><!-- .bbp-footer -->
</ul><!-- #topic-<?php bbp_topic_id(); ?>-replies -->

<?php do_action( 'bbp_template_after_replies_loop' ); ?>
