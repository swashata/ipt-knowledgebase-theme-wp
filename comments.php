<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to ipt_kb_comment() which is
 * located in the inc/template-tags.php file.
 *
 * @package iPanelThemes Knowledgebase
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

	<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h4 class="comments-title">
			<?php
				printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'ipt_kb' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h4>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<ul id="comment-nav-above" class="comment-navigation pager" role="navigation">
			<li class="screen-reader-text sr-only"><?php _e( 'Comment navigation', 'ipt_kb' ); ?></li>
			<li class="nav-previous previous"><?php previous_comments_link( __( '&larr; Older Comments', 'ipt_kb' ) ); ?></li>
			<li class="nav-next next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'ipt_kb' ) ); ?></li>
		</ul><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ol class="comment-list">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use ipt_kb_comment() to format the comments.
				 * If you want to override this in a child theme, then you can
				 * define ipt_kb_comment() and that will be used instead.
				 * See ipt_kb_comment() in inc/template-tags.php for more.
				 */
				wp_list_comments( array(
					'callback' => 'ipt_kb_comment' ,
					'style' => 'ol',
					'format' => 'html5',
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<ul id="comment-nav-below pager" class="comment-navigation" role="navigation">
			<li class="screen-reader-text sr-only"><?php _e( 'Comment navigation', 'ipt_kb' ); ?></li>
			<li class="nav-previous previous"><?php previous_comments_link( __( '&larr; Older Comments', 'ipt_kb' ) ); ?></li>
			<li class="nav-next next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'ipt_kb' ) ); ?></li>
		</ul><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<div class="alert alert-danger">
			<p class="no-comments"><?php _e( 'Comments are closed.', 'ipt_kb' ); ?></p>
		</div>
	<?php endif; ?>

	<?php // Here we are just going to use our own comment form ?>
	<?php // It indeed is derived from latest comment-template.php comment_form ?>
	<?php ipt_kb_comment_form(); ?>

</div><!-- #comments -->
