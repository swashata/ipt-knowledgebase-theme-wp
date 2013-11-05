<?php
/**
 * Custom template tags related to bbpress for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package iPanelThemes Knowledgebase
 */

if ( ! function_exists( 'ipt_kb_bbp_list_subforums' ) ) :

/**
 * List subforums or forums
 *
 * Must be called within a loop or be assigned an forum id
 *
 * @param mixed $args The function supports these args:
 *  - forum_id: Forum id. Defaults to ''
 * @uses bbp_forum_get_subforums() To check if the forum has subforums or not
 * @uses bbp_get_forum_permalink() To get forum permalink
 * @uses bbp_get_forum_title() To get forum title
 * @uses bbp_is_forum_category() To check if a forum is a category
 * @uses bbp_get_forum_topic_count() To get forum topic count
 * @uses bbp_get_forum_reply_count() To get forum reply count
 * @return void
 */
function ipt_kb_bbp_list_subforums( $args = array() ) {
	$r = bbp_parse_args( $args, array(
		'forum_id' => '',
	), 'ipt_kb_list_forums' );

	$sub_forums = bbp_forum_get_subforums( $r['forum_id'] );

	if ( ! empty( $sub_forums ) ) {
		foreach ( $sub_forums as $sub_forum ) {
			?>
<li class="<?php if ( bbp_is_forum_category( $sub_forum->ID ) ) echo 'bbp-forum-is-category'; ?> list-group-item  bbp-body ipt_kb_subforum_list">
<?php do_action( 'bbp_theme_before_forum_sub_forums' ); ?>
	<ul id="bbp-forum-<?php bbp_forum_id( $sub_forum->ID ); ?>" <?php bbp_forum_class( $sub_forum->ID ); ?>>
		<li class="bbp-forum-info">
			<span class="pull-left ipt_kb_bbpress_subforum_icon ipt_kb_bbpress_forum_icon">
			<?php if ( bbp_is_forum_category( $sub_forum->ID ) ) : ?>
				<span class="glyphicon ipt-icon-folder-open"></span>
			<?php else : ?>
				<span class="glyphicon ipt-icon-file4"></span>
			<?php endif; ?>
			</span>
			<?php ipt_kb_bbp_forum_title_in_list( $sub_forum->ID ); ?>
			<?php ipt_kb_bbp_forum_description_in_list( $sub_forum->ID ); ?>
			<?php bbp_forum_row_actions(); ?>
		</li>

		<li class="bbp-forum-topic-count">
			<?php bbp_forum_topic_count( $sub_forum->ID ); ?>
		</li>

		<li class="bbp-forum-reply-count">
			<?php bbp_show_lead_topic() ? bbp_forum_reply_count( $sub_forum->ID ) : bbp_forum_post_count( $sub_forum->ID ); ?>
		</li>

		<li class="bbp-forum-freshness">
			<?php ipt_kb_bbp_forum_freshness_in_list( $sub_forum->ID ); ?>
		</li>
	</ul>
	<?php do_action( 'bbp_theme_after_forum_sub_forums' ); ?>
	<div class="clearfix"></div>
</li>
			<?php
		}
	}
}
endif;


if ( ! function_exists( 'ipt_kb_bbp_forum_title_in_list' ) ) :

function ipt_kb_bbp_forum_title_in_list( $forum_id = 0 ) {
	?>
<?php do_action( 'bbp_theme_before_forum_title' ); ?>
<a class="bbp-forum-title" href="<?php bbp_forum_permalink( $forum_id ); ?>"><?php bbp_forum_title( $forum_id ); ?></a>
<?php do_action( 'bbp_theme_after_forum_title' ); ?>
	<?php
}
endif;

if ( ! function_exists( 'ipt_kb_bbp_forum_description_in_list' ) ) :

function ipt_kb_bbp_forum_description_in_list( $forum_id = 0 ) {
	?>
<?php do_action( 'bbp_theme_before_forum_description' ); ?>
<div class="bbp-forum-content <?php echo ( bbp_is_forum_category( $forum_id ) ? 'text-primary' : 'text-muted' ); ?>"><?php bbp_forum_content( $forum_id ); ?></div>
<?php do_action( 'bbp_theme_after_forum_description' ); ?>
	<?php
}
endif;

if ( ! function_exists( 'ipt_kb_bbp_forum_freshness_in_list' ) ) :

function ipt_kb_bbp_forum_freshness_in_list( $forum_id = 0 ) {
	$author_link = bbp_get_author_link( array(
		'post_id' => bbp_get_forum_last_active_id( $forum_id ),
		'type' => 'name'
	) );
	$freshness = bbp_get_author_link( array( 'post_id' => bbp_get_forum_last_active_id( $forum_id ), 'size' => 32, 'type' => 'avatar' ) );
	?>
<?php if ( ! empty( $freshness ) ) : ?>
<span class="pull-left thumbnail">
	<?php echo $freshness; ?>
</span>
<?php endif; ?>
<?php do_action( 'bbp_theme_before_forum_freshness_link' ); ?>
<ul class="list-unstyled ipt_kb_forum_freshness_meta">
	<li class="bbp-topic-freshness-link"><?php bbp_forum_freshness_link( $forum_id ); ?></li>
	<li class="bbp-topic-freshness-author">
		<?php do_action( 'bbp_theme_before_topic_author' ); ?>
		<?php if ( ! empty( $author_link ) ) printf( __( 'by %s', 'ipt_kb' ), $author_link ); ?>
		<?php do_action( 'bbp_theme_after_topic_author' ); ?>
	</li>
</ul>
<?php do_action( 'bbp_theme_after_forum_freshness_link' ); ?>
	<?php
}
endif;

/**
 * Give compatibility with bbPress pencil unread
 */
function ipt_kb_bbppu_dequeue() {
	if ( class_exists( 'bbP_Pencil_Unread' ) )
		wp_dequeue_style( bbP_Pencil_Unread::instance()->prefix );
}
if ( class_exists( 'bbP_Pencil_Unread' ) ) {
	add_action( 'bbp_enqueue_scripts', 'ipt_kb_bbppu_dequeue', 11, 1 );
}

/**
 * Add filter for converting bbpress template notice classes
 */
function ipt_kb_bbp_template_notice_args( $args ) {
	$args['before'] = '<div class="alert alert-info"><p>';
	$args['after'] = '</p></div>';
	return $args;
}
add_filter( 'bbp_after_get_single_forum_description_parse_args', 'ipt_kb_bbp_template_notice_args' );
add_filter( 'bbp_after_get_single_topic_description_parse_args', 'ipt_kb_bbp_template_notice_args' );

/**
 * Add filter for bbPress Topic Pagination
 */
function ipt_kb_bbp_pagination_links( $html ) {
	$new_html = preg_replace_callback( '/<(a|span)([^>]+?)>([^<]+)<\/(a|span)>/is', 'ipt_kb_bbp_pagination_links_cb', $html );
	return '<ul class="pagination pagination-sm">' . $new_html . '</ul>';
}
function ipt_kb_bbp_pagination_links_cb( $matches ) {
	$html = '<li class="';

	// Add proper classes to the HTML li
	if ( strpos( $matches[0], 'current' ) !== FALSE ) {
		$html .= 'active ';
	} elseif ( strpos( $matches[0], 'dots' ) !== FALSE ) {
		$html .= 'disabled ';
	}

	// End the li
	$html .= '">';
	$text = '';

	// Convert &rarr & &larr to icons
	switch ( $matches[3] ) {
		case '&rarr;':
			$text = '<i class="glyphicon glyphicon-forward"></i>';
			break;
		case '&larr;':
			$text = '<i class="glyphicon glyphicon-backward"></i>';
			break;
		default:
			$text = $matches[3];
			break;
	}

	// Finish up the HTML
	$html .= '<' . $matches[1] . $matches[2] . '>' . $text . '</' . $matches[1] . '></li>';

	return $html;
}
function ipt_kb_bbp_remove_before_after_args( $args ) {
	$args['before'] = $args['after'] = '';
	return $args;
}
add_filter( 'bbp_after_get_topic_pagination_parse_args', 'ipt_kb_bbp_remove_before_after_args' );

add_filter( 'bbp_get_forum_pagination_links', 'ipt_kb_bbp_pagination_links' );
add_filter( 'bbp_get_topic_pagination', 'ipt_kb_bbp_pagination_links' );
add_filter( 'bbp_get_topic_pagination_links', 'ipt_kb_bbp_pagination_links' );
add_filter( 'bbp_get_search_pagination_links', 'ipt_kb_bbp_pagination_links' );

/**
 * Add filter for the form control class to bbpdropdown
 */
function ipt_kb_bbp_get_dropdown_filter( $html ) {
	return str_replace( '<select', '<select class="form-control"', $html );
}
add_filter( 'bbp_get_dropdown', 'ipt_kb_bbp_get_dropdown_filter' );
add_filter( 'bbp_get_form_topic_type_dropdown', 'ipt_kb_bbp_get_dropdown_filter' );
add_filter( 'bbp_get_form_topic_status_dropdown', 'ipt_kb_bbp_get_dropdown_filter' );

/**
 * Add filters to subscribe and favorite
 */
function ipt_kb_bbp_toggle_wrap_to_button( $html ) {
	return preg_replace( '/id="([^"]*?)-toggle"/', 'id="$1-toggle" class="btn btn-default"', $html );
}

add_filter( 'bbp_after_get_user_subscribe_link_parse_args', 'ipt_kb_bbp_remove_before_after_args' );
add_filter( 'bbp_get_user_subscribe_link', 'ipt_kb_bbp_toggle_wrap_to_button' );
add_filter( 'bbp_get_user_favorites_link', 'ipt_kb_bbp_toggle_wrap_to_button' );

/**
 * Convert the admin links to toolbar
 */
function ipt_kb_bbp_get_reply_admin_links_args( $args ) {
	$args['before'] = '<ul class="dropdown-menu bbp-admin-links" role="menu">';
	$args['after'] = '</ul>';
	$args['sep'] = "\n";
	return $args;
}
function ipt_kb_bbp_admin_links( $html ) {
	return preg_replace( '/<a([^>]*?)>([^<]*?)<\/a>/si', '<li><a$1>$2</a></li>', $html );
}

function ipt_kb_support_topic_compat( $html ) {
	$matches = array();
	$new_html = $html;
	if ( preg_match( '/<span class="support-select-box">(.*?)<\/span>/is', $html, $matches ) ) {
		$new_html = preg_replace( '/<span class="support-select-box">(.*?)<\/span>/is', '', $html );
		$new_html = '<span class="support-select-box pull-left">' . $matches[1] . '</span>' . $new_html;
	}
	return $new_html;
}

function ipt_kb_support_new_status( $status ) {
	$status['topic-not-resolved'] = array(
		'sb-caption'   => __( 'New Request', 'ipt_kb' ),
		'value'        => 1,
		'prefix-title' => __( '<span class="glyphicon ipt-icon-info2 bstooltip" title="New Request"></span><span class="sr-only"> [New Request] </span>', 'ipt_kb' ),
		'admin_class'  => 'waiting'
	);
	$status['topic-resolved'] = array(
		'sb-caption'   => __( 'Resolved', 'ipt_kb' ),
		'value'        => 2,
		'prefix-title' => __( '<span class="glyphicon ipt-icon-checkmark-circle bstooltip" title="Resolved"></span><span class="sr-only"> [Resolved] </span>', 'buddy-bbpress-support-topic' ),
		'admin_class'  => 'approved'
	);
	$status['topic-processing'] = array(
		'sb-caption'   => __( 'Processing', 'ipt_kb' ),
		'value'        => 3,
		'prefix-title' => __( '<span class="glyphicon ipt-icon-history bstooltip" title="Processing"></span><span class="sr-only"> [Processing] </span>', 'ipt_kb' ),
		'admin_class'  => 'waiting'
	);
	$status['topic-no-solution'] = array(
		'sb-caption'   => __( 'No Solution', 'ipt_kb' ),
		'value'        => 4,
		'prefix-title' => __( '<span class="glyphicon ipt-icon-cancel-circle bstooltip" title="No Solution"></span><span class="sr-only"> [No Solution] </span>', 'ipt_kb' ),
		'admin_class'  => 'spam'
	);
	$status['topic-announcement'] = array(
		'sb-caption'   => __( 'Announcement', 'ipt_kb' ),
		'value'        => 5,
		'prefix-title' => __( '<span class="glyphicon ipt-icon-bullhorn bstooltip" title="Announcement"></span><span class="sr-only"> [Announcement] </span>', 'ipt_kb' ),
		'admin_class'  => 'approved'
	);
	$status['topic-management'] = array(
		'sb-caption'   => __( 'Management Topic', 'ipt_kb' ),
		'value'        => 6,
		'prefix-title' => __( '<span class="glyphicon ipt-icon-user4 bstooltip" title="Announcement"></span><span class="sr-only"> [Management] </span>', 'ipt_kb' ),
		'admin_class'  => 'approved'
	);
	return $status;
}

if ( function_exists( 'bpbbpst_buddypress_init' ) || class_exists( 'BP_bbP_Support_Topic' ) ) {
	add_filter( 'bbp_get_topic_admin_links', 'ipt_kb_support_topic_compat', 20, 1 );
}
if ( class_exists( 'BP_bbP_Support_Topic' ) ) {
	add_filter( 'bpbbpst_available_support_status', 'ipt_kb_support_new_status' );
}

add_filter( 'bbp_after_get_reply_admin_links_parse_args', 'ipt_kb_bbp_get_reply_admin_links_args' );
add_filter( 'bbp_after_get_topic_admin_links_parse_args', 'ipt_kb_bbp_get_reply_admin_links_args' );
add_filter( 'bbp_get_reply_admin_links', 'ipt_kb_bbp_admin_links', 11 );
add_filter( 'bbp_get_topic_admin_links', 'ipt_kb_bbp_admin_links', 11 );

/**
 * Make the tag list look nicer
 */
function ipt_kb_bbp_get_topic_tag_list( $args ) {
	$args['before'] = '<div class="well well-sm"><p><span class="glyphicon ipt-icon-tags"></span> ' . esc_html__( 'Tagged:', 'bbpress' ) . '&nbsp;';
	$args['after'] = '</p></div>';
	return $args;
}
add_filter( 'bbp_after_get_topic_tag_list_parse_args', 'ipt_kb_bbp_get_topic_tag_list' );

/**
 * Filter the logout button link
 */
function ipt_kb_bbp_get_logout_link_filter( $html ) {
	$new_html = preg_replace( '/class=("|\')(.*?)("|\')/i', 'class="$2 btn btn-danger btn-sm"', $html );
	$new_html = preg_replace( '/<a([^>]*?)>([^<]*?)<\/a>/', '<a$1><span class="glyphicon ipt-icon-switch"></span> $2</a>', $new_html );
	return $new_html;
}
add_filter( 'bbp_get_logout_link', 'ipt_kb_bbp_get_logout_link_filter' );

/**
 * Override the bbpress widget
 */
require get_template_directory() . '/inc/class-ipt-kb-bbp-login-widget.php';
