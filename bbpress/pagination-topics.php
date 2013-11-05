<?php

/**
 * Pagination for pages of topics (when viewing a forum)
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php do_action( 'bbp_template_before_pagination_loop' ); ?>

<div class="bbp-pagination well well-sm">
	<div class="bbp-pagination-count text-primary">
		<?php bbp_forum_pagination_count(); ?>
	</div>

	<div class="bbp-pagination-links">
		<?php bbp_forum_pagination_links(); ?>
	</div>
</div>

<?php do_action( 'bbp_template_after_pagination_loop' ); ?>
<?php if ( bbp_current_user_can_access_create_topic_form() && ! bbp_is_topic_edit() && bbp_is_single_forum() ) : ?>
<a href="#new-topic-<?php bbp_topic_id(); ?>" class="btn btn-info pull-left"><span class="glyphicon ipt-icon-ticket"></span> <?php _e( 'New Topic', 'ipt_kb' ); ?></a>
<?php endif; ?>
<div class="clearfix"></div>
