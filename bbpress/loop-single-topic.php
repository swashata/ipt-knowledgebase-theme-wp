<?php

/**
 * Topics Loop - Single
 *
 * @package bbPress
 * @subpackage Theme
 */

?>
<li class="list-group-item bbp-body bbp-topic-list-group-item">
	<ul id="bbp-topic-<?php bbp_topic_id(); ?>" <?php bbp_topic_class(); ?>>
		<li class="bbp-topic-title">
			<?php if ( bbp_is_topic_sticky() || bbp_is_topic_super_sticky() ) : ?>
			<span class="pull-left bbp-sticky-icon bbp-topic-icon text-muted">
				<span class="glyphicon ipt-icon-pushpin"></span>
			</span>
			<?php elseif ( bbp_is_topic_closed() ) : ?>
			<span class="pull-left bbp-sticky-icon bbp-topic-icon text-muted">
				<span class="glyphicon ipt-icon-bubbles3"></span>
			</span>
			<?php else : ?>
			<span class="pull-left bbp-sticky-icon bbp-topic-icon text-muted">
				<span class="glyphicon ipt-icon-bubbles4"></span>
			</span>
			<?php endif; ?>
			<?php if ( bbp_is_user_home() ) : ?>
				<?php if ( bbp_is_favorites() ) : ?>
					<span class="bbp-topic-action pull-right">
						<?php do_action( 'bbp_theme_before_topic_favorites_action' ); ?>
						<?php bbp_user_favorites_link( array( 'before' => '', 'favorite' => '+', 'favorited' => '<span class="glyphicon glyphicon-remove"></span>' ) ); ?>
						<?php do_action( 'bbp_theme_after_topic_favorites_action' ); ?>
					</span>
				<?php elseif ( bbp_is_subscriptions() ) : ?>
					<span class="bbp-topic-action pull-right">
						<?php do_action( 'bbp_theme_before_topic_subscription_action' ); ?>
						<?php bbp_user_subscribe_link( array( 'before' => '', 'subscribe' => '+', 'unsubscribe' => '<span class="glyphicon glyphicon-remove"></span>' ) ); ?>
						<?php do_action( 'bbp_theme_after_topic_subscription_action' ); ?>
					</span>
				<?php endif; ?>
			<?php endif; ?>

			<?php do_action( 'bbp_theme_before_topic_title' ); ?>

			<a class="bbp-topic-permalink" href="<?php bbp_topic_permalink(); ?>"><?php bbp_topic_title(); ?></a>

			<?php do_action( 'bbp_theme_after_topic_title' ); ?>

			<?php do_action( 'bbp_theme_before_topic_meta' ); ?>

			<div>
				<div class="pull-right bbp-topic-pagination-wrapper">
					<?php bbp_topic_pagination(); ?>
				</div>

				<p class="bbp-topic-meta text-muted">
					<?php do_action( 'bbp_theme_before_topic_started_by' ); ?>
					<span class="bbp-topic-started-by"><?php printf( __( 'Started by: %1$s', 'bbpress' ), bbp_get_topic_author_link( array( 'size' => '14' ) ) ); ?></span>
					<?php do_action( 'bbp_theme_after_topic_started_by' ); ?>
					<?php if ( !bbp_is_single_forum() || ( bbp_get_topic_forum_id() !== bbp_get_forum_id() ) ) : ?>
						<?php do_action( 'bbp_theme_before_topic_started_in' ); ?>
						<span class="bbp-topic-started-in"><?php printf( __( 'in: <a href="%1$s">%2$s</a>', 'bbpress' ), bbp_get_forum_permalink( bbp_get_topic_forum_id() ), bbp_get_forum_title( bbp_get_topic_forum_id() ) ); ?></span>
						<?php do_action( 'bbp_theme_after_topic_started_in' ); ?>
					<?php endif; ?>
				</p>
			</div>

			<?php do_action( 'bbp_theme_after_topic_meta' ); ?>

			<?php bbp_topic_row_actions(); ?>
			<div class="clearfix"></div>
		</li>

		<li class="bbp-topic-voice-count"><?php bbp_topic_voice_count(); ?></li>

		<li class="bbp-topic-reply-count"><?php bbp_show_lead_topic() ? bbp_topic_reply_count() : bbp_topic_post_count(); ?></li>

		<li class="bbp-topic-freshness">
			<?php $freshness_avatar = bbp_get_author_link( array( 'post_id' => bbp_get_topic_last_active_id(), 'size' => 32, 'type' => 'avatar' ) ); ?>
			<?php if ( ! empty( $freshness_avatar ) ) : ?>
			<span class="pull-left thumbnail">
				<?php echo $freshness_avatar; ?>
			</span>
			<?php endif; ?>
			<?php do_action( 'bbp_theme_before_topic_freshness_link' ); ?>
			<ul class="list-unstyled ipt_kb_topic_freshness_meta">
				<li class="bbp-topic-freshness-link"><?php bbp_topic_freshness_link(); ?></li>
				<li class="bbp-topic-freshness-author">
					<?php do_action( 'bbp_theme_before_topic_freshness_author' ); ?>
					<?php $author_link = bbp_get_author_link( array(
						'post_id' => bbp_get_topic_last_active_id(),
						'type' => 'name',
					) ); ?>
					<?php if ( ! empty( $author_link ) ) printf( __( 'by %s', 'ipt_kb' ), $author_link ); ?>
					<?php do_action( 'bbp_theme_after_topic_freshness_author' ); ?>
				</li>
			</ul>
			<?php do_action( 'bbp_theme_after_topic_freshness_link' ); ?>
		</li>

	</ul><!-- #bbp-topic-<?php bbp_topic_id(); ?> -->
</li>
