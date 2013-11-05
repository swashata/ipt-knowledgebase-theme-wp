<?php

/**
 * Forums Loop - Single Forum
 *
 * @package bbPress
 * @subpackage Theme
 */

?>
<li class="<?php if ( bbp_is_forum_category() ) echo 'bbp-forum-is-category'; ?> list-group-item bbp-body">
	<ul id="bbp-forum-<?php bbp_forum_id(); ?>" <?php bbp_forum_class(); ?>>
		<li class="bbp-forum-info">
			<span class="pull-left ipt_kb_bbpress_forum_icon">
			<?php if ( bbp_is_forum_category() ) : ?>
				<span class="glyphicon ipt-icon-folder-open"></span>
			<?php else : ?>
				<span class="glyphicon ipt-icon-file4"></span>
			<?php endif; ?>
			</span>
			<?php ipt_kb_bbp_forum_title_in_list(); ?>
			<?php ipt_kb_bbp_forum_description_in_list(); ?>
			<?php bbp_forum_row_actions(); ?>
		</li>

		<li class="bbp-forum-topic-count">
			<?php bbp_forum_topic_count(); ?>
		</li>

		<li class="bbp-forum-reply-count">
			<?php bbp_show_lead_topic() ? bbp_forum_reply_count() : bbp_forum_post_count(); ?>
		</li>

		<li class="bbp-forum-freshness">
			<?php ipt_kb_bbp_forum_freshness_in_list(); ?>
		</li>
	</ul>
	<div class="clearfix"></div>
</li>
<!-- #bbp-forum-<?php bbp_forum_id(); ?> -->

<!-- Start the subforum -->
<?php do_action( 'bbp_theme_before_forum_sub_forums' ); ?>
<?php ipt_kb_bbp_list_subforums(); ?>
<?php do_action( 'bbp_theme_after_forum_sub_forums' ); ?>
<!-- End subforum -->
