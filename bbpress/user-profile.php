<?php

/**
 * User Profile
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

	<?php do_action( 'bbp_template_before_user_profile' ); ?>

	<div id="bbp-user-profile" class="bbp-user-profile">
		<h2 class="entry-title"><?php _e( 'Profile', 'bbpress' ); ?></h2>
		<div class="bbp-user-section">
			<?php if ( bbp_get_displayed_user_field( 'description' ) ) : ?>
			<div class="well well-sm">
				<p class="bbp-user-description"><?php bbp_displayed_user_field( 'description' ); ?></p>
			</div>
			<?php endif; ?>

			<div class="list-group">
				<a href="<?php bbp_user_profile_url(); ?>" class="list-group-item active bbp-user-forum-role"><span class="glyphicon ipt-icon-user4"></span> <?php  printf( __( '%s Forum Role', 'ipt_kb' ), '<span class="badge">' . bbp_get_user_display_role() . '</span>' ); ?></a>
				<a href="<?php bbp_user_topics_created_url(); ?>" class="list-group-item bbp-user-topic-count"><span class="glyphicon ipt-icon-bubbles4"></span> <?php printf( __( '%s Topics Started:', 'ipt_kb' ), '<span class="badge">' . bbp_get_user_topic_count_raw() . '</span>' ); ?></a>
				<a href="<?php bbp_user_replies_created_url(); ?>" class="list-group-item bbp-user-reply-count"><span class="glyphicon ipt-icon-reply"></span> <?php printf( __( '%s Replies Created', 'ipt_kb' ), '<span class="badge">' . bbp_get_user_reply_count_raw() . '</span>' ); ?></a>
				<?php if ( bbp_is_favorites_active() ) : ?>
					<a href="<?php bbp_favorites_permalink(); ?>" class="list-group-item bbp-user-favorite-count"><span class="glyphicon ipt-icon-heart"></span> <?php printf( __( '%s Favorites', 'ipt_kb' ), '<span class="badge">' . count( bbp_get_user_favorites_topic_ids() ) . '</span>' ); ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div><!-- #bbp-author-topics-started -->

	<?php do_action( 'bbp_template_after_user_profile' ); ?>
