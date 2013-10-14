<?php
/**
 * Handles everything for the like article thingy
 *
 * Basically handled by the jQuery AJAX
 */

function ipt_kb_like_article_cb() {
	$nonce = isset( $_REQUEST['_wpnonce'] ) ? $_REQUEST['_wpnonce'] : '';
	$post_id = isset( $_REQUEST['post_id'] ) ? $_REQUEST['post_id'] : '';

	if ( '' == $post_id ) {
		die( __( 'Cheatin&#8217; uh?', 'ipt_kb' ) );
	}

	$post_id = (int) $post_id;
	if ( ! wp_verify_nonce( $nonce, 'ipt_kb_like_article_' . $post_id ) ) {
		die( __( 'Cheatin&#8217; uh?', 'ipt_kb' ) );
	}

	if ( isset( $_COOKIE['ipt_kb_like_article_' . $post_id] ) && $_COOKIE['ipt_kb_like_article_' . $post_id] == '1' ) {
		die( __( 'You like it already', 'ipt_kb' ) );
	}

	$old_count = (int) get_post_meta( $post_id, 'ipt_kb_like_article', true );
	update_post_meta( $post_id, 'ipt_kb_like_article', ++$old_count );

	die( __( 'Thank you.', 'ipt_kb' ) );
}

add_action( 'wp_ajax_ipt_kb_like_article', 'ipt_kb_like_article_cb' );
add_action( 'wp_ajax_nopriv_ipt_kb_like_article', 'ipt_kb_like_article_cb' );

// Also the default meta on insert
function ipt_kb_like_article_default_meta( $post_id ) {
	$current = get_post_meta( $post_id, 'ipt_kb_like_article', true );
	$default = 0;

	if ( $current == '' && ! wp_is_post_revision( $post_id ) ) {
		add_post_meta( $post_id, 'ipt_kb_like_article', $default, true );
	}

	return $post_id;
}
add_action( 'wp_insert_post', 'ipt_kb_like_article_default_meta' );

