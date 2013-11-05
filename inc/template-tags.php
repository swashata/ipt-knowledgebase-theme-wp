<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package iPanelThemes Knowledgebase
 */

if ( ! function_exists( 'ipt_kb_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function ipt_kb_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Give compatibility for wp-pagenavi
	if ( function_exists( 'wp_pagenavi' ) && ! is_single() ) {
		$wp_pagenavi = wp_pagenavi( array(
			'echo' => false,
		) );

		$wp_pagenavi = str_replace( array(
			"<div class='wp-pagenavi'>",
			'</div>',
			"<span class='pages'>",
			'</span>',
			"<span class='current'>",
			'<a href=',
			'</a>',
			"<span class='extend'>",
			/* translator: Translate it to the output of WP PageNavi for your lang */
			__( '&laquo; First', 'ipt_kb' ),
			/* translator: Translate it to the output of WP PageNavi for your lang */
			__( 'Last &raquo;', 'ipt_kb' ),
			'&laquo;',
			'&raquo;',
		), array(
			'<ul class="pagination">',
			'</ul>',
			'<li class="disabled"><span>',
			'</span></li>',
			'<li class="active"><span>',
			'<li><a href=',
			'</a></li>',
			'<li class="disabled"><span>',
			'<i class="glyphicon glyphicon-fast-backward"></i>',
			'<i class="glyphicon glyphicon-fast-forward"></i>',
			'<i class="glyphicon glyphicon-backward"></i>',
			'<i class="glyphicon glyphicon-forward"></i>',
		), $wp_pagenavi );

		echo $wp_pagenavi;
		return;
	}

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( true, '', true );
		$next = get_adjacent_post( true, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';

	// Add support with bootstrap pager
	$nav_class .= ' pager';

	?>
	<ul role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
		<li class="screen-reader-text"><?php _e( 'Post navigation', 'ipt_kb' ); ?></li>
	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<li class="nav-previous previous">%link</li>', '<span class="meta-nav">' . _x( '<span class="glyphicon glyphicon-arrow-left"></span>', 'Previous post link', 'ipt_kb' ) . '</span> %title', true ); ?>
		<?php next_post_link( '<li class="nav-next next">%link</li>', '%title <span class="meta-nav">' . _x( '<span class="glyphicon glyphicon-arrow-right"></span>', 'Next post link', 'ipt_kb' ) . '</span>', true ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<li class="nav-previous previous"><?php next_posts_link( __( '<span class="meta-nav"><span class="glyphicon glyphicon-arrow-left"></span></span> Older posts', 'ipt_kb' ) ); ?></li>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<li class="nav-next next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav"><span class="glyphicon glyphicon-arrow-right"></span></span>', 'ipt_kb' ) ); ?></li>
		<?php endif; ?>

	<?php endif; ?>

	</ul><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
}
endif; // ipt_kb_content_nav

if ( ! function_exists( 'ipt_kb_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function ipt_kb_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	global $post;

	$panel_class = 'panel-default';
	if ( $comment->user_id === $post->post_author ) {
		$panel_class = 'panel-info';
	}

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body well well-sm">
			<?php _e( 'Pingback:', 'ipt_kb' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'ipt_kb' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body panel <?php echo esc_attr( $panel_class ); ?>">
			<div class="panel-heading comment-meta">
				<div class="comment-author vcard pull-left">
					<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
					<?php printf( __( '%s <span class="says">says:</span>', 'ipt_kb' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author -->
				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation text-warning pull-right"><?php _e( 'Your comment is awaiting moderation.', 'ipt_kb' ); ?></p>
				<?php endif; ?>
				<div class="clearfix"></div>
			</div>

			<div class="comment-content panel-body">
				<?php comment_text(); ?>
			</div>

			<div class="panel-footer">
				<div class="pull-right">
					<?php
						comment_reply_link( array_merge( $args, array(
							'add_below' => 'div-comment',
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'before'    => '<div class="reply text-right">',
							'after'     => '</div>',
							'reply_text'=> __( '<i class="glyphicon ipt-icon-reply"></i>&nbsp;&nbsp;Reply', 'ipt_kb' ),
						) ) );
					?>
				</div>
				<div class="comment-metadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<i class="glyphicon glyphicon-calendar"></i>&nbsp;&nbsp;<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'ipt_kb' ), get_comment_date(), get_comment_time() ); ?>
						</time>
					</a>
					<?php edit_comment_link( __( 'Edit', 'ipt_kb' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-metadata -->
				<div class="clearfix"></div>
			</div>
		</article><!-- .comment-body -->

	<?php
	endif;
}
endif; // ends check for ipt_kb_comment()

if ( ! function_exists( 'ipt_kb_the_attached_image' ) ) :
/**
 * Prints the attached image with a link to the next attached image.
 */
function ipt_kb_the_attached_image() {
	$post                = get_post();
	$attachment_size     = apply_filters( 'ipt_kb_attachment_size', array( 1200, 1200 ) );
	$next_attachment_url = wp_get_attachment_url();

	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the
	 * URL of the next adjacent image in a gallery, or the first image (if
	 * we're looking at the last image in a gallery), or, in a gallery of one,
	 * just the link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

if ( ! function_exists( 'ipt_kb_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function ipt_kb_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) )
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( __( '<span class="posted-on"><i class="glyphicon glyphicon-calendar"></i> Posted on %1$s</span><span class="byline"> by %2$s</span>', 'ipt_kb' ),
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		),
		sprintf( '<span class="author vcard"><i class="glyphicon glyphicon-user"></i> <a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category
 */
function ipt_kb_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so ipt_kb_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so ipt_kb_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in ipt_kb_categorized_blog
 */
function ipt_kb_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'ipt_kb_category_transient_flusher' );
add_action( 'save_post',     'ipt_kb_category_transient_flusher' );

/**
 * Show a "This article was helpful" button below articles
 * @return void
 */
function ipt_kb_like_article() {
	global $post;
	$total_count = (int) get_post_meta( $post->ID, 'ipt_kb_like_article', true );
	$did_already = false;
	$text = __( 'This article was helpful', 'ipt_kb' );
	if ( isset( $_COOKIE['ipt_kb_like_article_' . $post->ID] ) && $_COOKIE['ipt_kb_like_article_' . $post->ID] == '1' ) {
		$did_already = true;
		$text = __( 'You like it already', 'ipt_kb' );
	}
	?>
<p class="hidden-xs">
	<span class="ipt_kb_like_article_info pull-right text-info"><i class="glyphicon glyphicon-fire"></i>&nbsp;&nbsp;<?php printf( _n( '%d person found this article useful', '%d people found this article useful', $total_count, 'ipt_kb' ), $total_count ); ?></span>
	<button<?php if ( $did_already ) echo ' disabled="disabled"'; ?> type="button" data-loading-text="<?php _e( 'Please wait', 'ipt_kb' ); ?>" class="btn btn-success ipt_kb_like_article" data-postid="<?php echo $post->ID; ?>" data-nonce="<?php echo wp_create_nonce( 'ipt_kb_like_article_' . $post->ID ); ?>">
		<i class="glyphicon glyphicon-thumbs-up"></i> <span class="text"><?php echo $text; ?></span>
	</button>
</p>
<p class="visible-xs">
	<button<?php if ( $did_already ) echo ' disabled="disabled"'; ?> type="button" data-loading-text="<?php _e( 'Please wait', 'ipt_kb' ); ?>" class="btn btn-success btn-block ipt_kb_like_article" data-postid="<?php echo $post->ID; ?>" data-nonce="<?php echo wp_create_nonce( 'ipt_kb_like_article_' . $post->ID ); ?>">
		<i class="glyphicon glyphicon-thumbs-up"></i> <span class="text"><?php echo $text; ?></span>
	</button>
</p>
<p class="ipt_kb_like_article_info text-info text-center visible-xs"><i class="glyphicon glyphicon-fire"></i>&nbsp;&nbsp;<?php printf( _n( '%d person found this article useful', '%d people found this article useful', $total_count, 'ipt_kb' ), $total_count ); ?></p>
	<?php
}

if ( ! function_exists( 'ipt_kb_breadcrumb' ) ) :
/**
 * A custom breadcrumb for bootstrap
 */
function ipt_kb_breadcrumb() {
	$post_loop = false;
	?>
<ol id="breadcrumbs" class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">
	<?php if ( is_front_page() ) : ?>
	<li class="active" typeof="v:Breadcrumb">
		<span property="v:title"><?php _e('Home', 'ipt_kb'); ?></span>
	</li>
	<?php else : ?>
	<li typeof="v:Breadcrumb">
		<a rel="v:url" property="v:title" href="<?php echo home_url( '/' ); ?>"><?php _e('Home', 'ipt_kb'); ?></a>
	</li>
	<?php endif; ?>

	<?php if ( is_attachment() ) : the_post(); global $post; $post_loop = true; ?>
		<?php $parent_id = $post->post_parent; ?>
		<?php if ( ! empty( $parent_id ) ) : ?>
			<li typeof="v:Breadcrumb">
				<a rel="v:url" property="v:title" href="<?php echo esc_attr( get_permalink( $parent_id ) ); ?>"><?php echo get_the_title( $parent_id ); ?></a>
			</li>
		<?php endif; ?>
		<li class="active" typeof="v:Breadcrumb">
			<span property="v:title"><?php the_title(); ?></span>
		</li>
	<?php elseif ( is_singular( 'post' ) ) : the_post(); global $post; $post_loop = true; ?>
		<?php $category = get_the_category(); ?>
		<?php $clink = get_category_link( $category[0]->term_id ); ?>
		<?php if ( $category[0]->parent != '0' ) : ?>
			<?php $cat_stack = array(); ?>
			<?php $pcat_id = $category[0]->parent; ?>
			<?php do {
				$pcat = get_category( $pcat_id );
				$cat_stack[] = array(
					'title' => $pcat->name,
					'link' => get_category_link( $pcat->term_id ),
				);
				$pcat_id = $pcat->parent;
			} while( $pcat_id != '0' ); ?>
			<?php while ( $parent_cat = array_pop( $cat_stack ) ) : ?>
				<li typeof="v:Breadcrumb">
					<a rel="v:url" property="v:title" href="<?php echo esc_attr( $parent_cat['link'] ); ?>"><?php echo $parent_cat['title']; ?></a>
				</li>
			<?php endwhile; ?>
		<?php endif; ?>
		<li typeof="v:Breadcrumb">
			<a rel="v:url" property="v:title" href="<?php echo esc_attr( $clink ); ?>"><?php echo $category[0]->name; ?></a>
		</li>
		<li class="active" typeof="v:Breadcrumb">
			<span property="v:title"><?php the_title(); ?></span>
		</li>
	<?php elseif ( is_page() && ! is_front_page() ) : the_post(); global $post; $post_loop = true; ?>
		<?php
		$parent_id = $post->post_parent;
		$parent_pages = array();
		while ( $parent_id ) {
			$parent_pages[] = get_page( $parent_id );
			$parent_id = $parent_pages[count( $parent_pages )-1]->post_parent;
		}
		$parent_pages = array_reverse( $parent_pages );
		?>
		<?php if ( ! empty( $parent_pages ) ) : ?>
		<?php foreach ( $parent_pages as $parent ) : ?>
		<li typeof="v:Breadcrumb">
			<a rel="v:url" property="v:title" href="<?php echo get_permalink($parent->ID); ?>"><?php echo get_the_title( $parent->ID ); ?></a>
		</li>
		<?php endforeach; ?>
		<?php endif; ?>
		<li typeof="v:Breadcrumb" class="active">
			<span property="v:title"><?php the_title(); ?></span>
		</li>
	<?php elseif ( is_category() ) : ?>
		<?php $cat_id = get_query_var( 'cat' ); ?>
		<?php $cat = get_category( $cat_id ); ?>
		<?php if ( $cat->parent != '0' ) : ?>
			<?php $cat_stack = array(); ?>
			<?php $pcat_id = $cat->parent; ?>
			<?php do {
				$pcat = get_category( $pcat_id );
				$cat_stack[] = array(
					'title' => $pcat->name,
					'link' => get_category_link( $pcat->term_id ),
				);
				$pcat_id = $pcat->parent;
			} while( $pcat_id != '0' ); ?>
			<?php while ( $parent_cat = array_pop( $cat_stack ) ) : ?>
				<li typeof="v:Breadcrumb">
					<a rel="v:url" property="v:title" href="<?php echo esc_attr( $parent_cat['link'] ); ?>"><?php echo $parent_cat['title']; ?></a>
				</li>
			<?php endwhile; ?>
		<?php endif; ?>
		<li typeof="v:Breadcrumb" class="active">
			<span property="v:title"><?php single_cat_title(); ?></span>
		</li>
		<?php elseif ( is_tag() ) : ?>
			<li typeof="v:Breadcrumb" class="active">
				<span property="v:title"><?php single_tag_title(); ?></span>
			</li>
		<?php elseif ( is_tax() ) : ?>
			<?php global $wp_query; $term = $wp_query->get_queried_object(); ?>
			<li typeof="v:Breadcrumb" class="active">
				<span property="v:title"><?php echo $term->name; ?></span>
			</li>
		<?php elseif ( is_author() ) : the_post(); global $post; $post_loop = true; ?>
			<li typeof="v:Breadcrumb" class="active">
				<span property="v:title"><?php the_author(); ?></span>
			</li>
		<?php elseif(is_day() || is_date() || is_month() || is_year() || is_time()) : ?>
			<?php if(is_year()) : ?>
			<li typeof="v:Breadcrumb" class="active">
				<span property="v:title"><?php echo get_the_date('Y'); ?></span>
			</li>
			<?php elseif(is_month()) : ?>
			<li typeof="v:Breadcrumb" class="active">
				<span property="v:title"><?php echo get_the_date('F Y'); ?></span>
			</li>
			<?php elseif(is_day()) : ?>
			<li typeof="v:Breadcrumb" class="active">
				<li property="v:title"><?php echo get_the_date(); ?></span>
			</li>
			<?php else : ?>
			<li typeof="v:Breadcrumb" class="active">
				<span property="v:title"><?php echo get_the_time(); ?></span>
			</li>
			<?php endif; ?>
		<?php elseif ( is_search() ) : ?>
			<li typeof="v:Breadcrumb" class="active">
				<span property="v:title"><?php _e( 'Search result', 'ipt_kb' ); ?></span>
			</li>
		<?php elseif ( is_404() ) : ?>
			<li typeof="v:Breadcrumb" class="active">
				<span property="v:title"><?php _e( 'Error 404 - Not found', 'ipt_kb' ); ?></span>
			</li>
		<?php elseif ( ! is_home() && ! is_front_page() ) : ?>
			<li typeof="v:Breadcrumb" class="active">
				<span property="v:title"><?php _e( 'Archive', 'ipt_kb' ); ?></span>
			</li>
		<?php elseif ( is_home() && ! is_front_page() ) : ?>
			<li typeof="v:Breadcrumb" class="active">
				<span property="v:title"><?php _e( 'Blog', 'ipt_kb' ); ?></span>
			</li>
		<?php endif; ?>
	<?php if($post_loop) rewind_posts(); ?>
</ol>
<?php
}
endif;

if ( ! function_exists( 'ipt_kb_comment_form' ) ) :

/**
 * Our own comment template
 * It is derived from WP 3.6 comment template
 */
function ipt_kb_comment_form( $args = array(), $post_id = null ) {
	if ( null === $post_id )
		$post_id = get_the_ID();
	else
		$id = $post_id;

	$commenter = wp_get_current_commenter();
	$user = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';

	if ( ! isset( $args['format'] ) )
		$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';

	$req      = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$html5    = 'html5' === $args['format'];
	$fields   =  array(
		'author' => '<div class="form-group comment-form-author">' . '<label class="sr-only control-label" for="author">' . __( 'Name', 'ipt_kb' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
		            '<div class="input-group"><span class="input-group-addon"><span class="glyphicon ipt-icon-user"></span></span><input placeholder="' . __( 'Name', 'ipt_kb' ) . ( $req ? ' *' : '' ) . '" class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div></div>',
		'email'  => '<div class="form-group comment-form-email"><label class="sr-only control-label" for="email">' . __( 'Email', 'ipt_kb' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
		            '<div class="input-group"><span class="input-group-addon"><span class="glyphicon ipt-icon-mail"></span></span><input placeholder="' . __( 'Email', 'ipt_kb' ) . ( $req ? ' *' : '' ) . '" class="form-control" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div></div>',
		'url'    => '<div class="form-group comment-form-url"><label class="sr-only control-label" for="url">' . __( 'Website', 'ipt_kb' ) . '</label> ' .
		            '<div class="input-group"><span class="input-group-addon"><span class="glyphicon ipt-icon-link"></span></span><input placeholder="' . __( 'Website', 'ipt_kb' ) . '" class="form-control" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div></div>',
	);

	$required_text = sprintf( ' ' . __( 'Required fields are marked %s', 'ipt_kb' ), '<span class="required">*</span>' );
	$defaults = array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'        => '<div class="comment-form-comment form-group"><label class="sr-only control-label" for="comment">' . _x( 'Comment', 'noun', 'ipt_kb' ) . '</label><textarea placeholder="' . _x( 'Comment', 'noun', 'ipt_kb' ) . '" class="form-control" id="comment" name="comment" rows="6" aria-required="true"></textarea></div>',
		'must_log_in'          => '<p class="must-log-in alert alert-danger">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'ipt_kb' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'logged_in_as'         => '<p class="logged-in-as alert alert-success">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'ipt_kb' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'comment_notes_before' => '<p class="comment-notes alert alert-info">' . __( 'Your email address will not be published.', 'ipt_kb' ) . ( $req ? $required_text : '' ) . '</p>',
		'comment_notes_after'  => '<p class="form-allowed-tags well well-sm">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'title_reply'          => __( 'Leave a Reply', 'ipt_kb' ),
		'title_reply_to'       => __( 'Leave a Reply to %s', 'ipt_kb' ),
		'cancel_reply_link'    => __( 'Cancel reply', 'ipt_kb' ),
		'label_submit'         => __( 'Post Comment', 'ipt_kb' ),
		'format'               => 'xhtml',
	);

	$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

	?>
		<?php if ( comments_open( $post_id ) ) : ?>
			<?php do_action( 'comment_form_before' ); ?>
			<div id="respond" class="comment-respond">
				<span class="pull-right"><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></span>
				<h3 id="reply-title" class="comment-reply-title"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?></h3>
				<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
					<?php echo $args['must_log_in']; ?>
					<?php do_action( 'comment_form_must_log_in_after' ); ?>
				<?php else : ?>
					<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>" class="comment-form form-horizontal"<?php echo $html5 ? ' novalidate' : ''; ?>>
						<?php do_action( 'comment_form_top' ); ?>
						<?php if ( is_user_logged_in() ) : ?>
							<?php echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ); ?>
							<?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
							<?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?>
						<?php else : ?>
							<?php echo $args['comment_notes_before']; ?>
							<?php
							do_action( 'comment_form_before_fields' );
							?>
							<div class="col-sm-5">
								<?php
								foreach ( (array) $args['fields'] as $name => $field ) {
									echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
								}
								?>
							</div>
							<div class="col-sm-7">
								<?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?>
							</div>
							<div class="clearfix"></div>
							<div class="col-sm-12">
								<?php do_action( 'comment_form_after_fields' ); ?>
							</div>
							<div class="clearfix"></div>
						<?php endif; ?>

						<?php echo $args['comment_notes_after']; ?>
						<p class="form-submit text-right">
							<button name="submit" class="btn btn-lg btn-primary" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>"><?php echo $args['label_submit']; ?></button>
							<?php comment_id_fields( $post_id ); ?>
						</p>
						<?php do_action( 'comment_form', $post_id ); ?>
					</form>
				<?php endif; ?>
			</div><!-- #respond -->
			<?php do_action( 'comment_form_after' ); ?>
		<?php else : ?>
			<?php do_action( 'comment_form_comments_closed' ); ?>
		<?php endif; ?>
	<?php
}

endif;

if ( ! function_exists( 'ipt_kb_total_cat_post_count' ) ) :

/**
 * Simple function to get category post count including all subcategories
 *
 * @link http://wordpress.stackexchange.com/a/91551 Stackexchange
 * @param  int $cat_id Category ID
 * @return int         Total post count
 */
function ipt_kb_total_cat_post_count( $cat_id ) {
	$q = new WP_Query( array(
		'nopaging' => true,
		'tax_query' => array(
			array(
				'taxonomy' => 'category',
				'field' => 'id',
				'terms' => $cat_id,
				'include_children' => true,
			),
		),
		'fields' => 'ids',
	) );
	return $q->post_count;
}

endif;

if ( ! function_exists( 'ipt_kb_author_meta' ) ) :

/**
 * Put a nice little box about the author meta
 * @param  int $author_id The ID of the author
 * @return void
 */
function ipt_kb_author_meta( $author_id = null ) {
	// Check for the author_id
	if ( $author_id === null ) {
		// There are two possibilities
		// 1. It is a single post/page
		// 2. It is author archive page
		if ( is_singular() ) {
			$author_id = get_the_author_meta( 'ID' );
		} elseif ( is_author() ) {
			the_post();
			$author_id = get_the_author_meta( 'ID' );
			rewind_posts();
		}
	}

	// Double check the author ID before progressing
	if ( $author_id == null ) {
		return;
	}

	// We are here, so we are good to go
	$display_name = get_the_author_meta( 'display_name', $author_id );
	$total_posts = count_user_posts( $author_id );
	$bio = get_the_author_meta( 'description', $author_id );
	$archive = get_author_posts_url( $author_id );
	$buttons = array(
		'user_url' => array(
			'title' => __( 'Website', 'ipt_kb' ),
			'icon' => 'ipt-icon-home',
		),
		// Some compatibility with WordPress SEO
		'facebook' => array(
			'title' => __( 'Facebook', 'ipt_kb' ),
			'icon' => 'ipt-icon-facebook',
		),
		'twitter' => array(
			'title' => __( 'Twitter', 'ipt_kb' ),
			'icon' => 'ipt-icon-twitter',
		),
		'googleplus' => array(
			'title' => __( 'Google+', 'ipt_kb' ),
			'icon' => 'ipt-icon-google-plus',
		),
	);

	// Filter for extensibility
	$buttons = apply_filters( 'ipt_kb_author_meta_buttons', $buttons );

	// Print the metabox
	?>
<div class="well author-meta">
	<div class="author-avatar text-center pull-left">
		<a href="<?php echo $archive; ?>"><?php echo get_avatar( $author_id, $size = '96' ); ?></a>
	</div>
	<h4 class="author-meta-title">
		<?php
		/* translator: %1$s -> Author Name, %2$s -> author posts link, %3$s -> Author display_name, %4$s -> article/articles */
		printf( __( '%1$s has written <a href="%2$s">%3$s</a> %4$s', 'ipt_kb' ), $display_name, $archive, $total_posts, _n( 'article', 'articles', $total_posts, 'ipt_kb' ) );
		?>
	</h4>
	<div class="author-meta-bio">
		<?php echo wpautop( $bio ); ?>
	</div>
	<div class="author-meta-buttons text-right">
		<div class="btn-group">
			<?php foreach ( $buttons as $meta_key => $button ) : ?>
				<?php $link = get_the_author_meta( $meta_key, $author_id ); ?>
				<?php if ( ! empty( $link ) ) : ?>
					<?php if ( $meta_key == 'twitter' ) $link = 'https://twitter.com/' . $link; ?>
					<a href="<?php echo esc_url( $link ); ?>" class="btn btn-info bstooltip" title="<?php echo esc_attr( $button['title'] ); ?>"><span class="glyphicon <?php echo esc_attr( $button['icon'] ); ?>"></span></a>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
	<?php
}
endif;

/**
 * Add filter to the password form
 */
function ipt_kb_the_password_form_filter( $html ) {
	// Get the post ID
	if ( ! preg_match( '<label for="([^\'"]+?)">', $html, $matches ) ) {
		return $html;
	}

	$label = $matches[1];
	$output = '<div class="alert well-sm alert-danger"><p>' . __( 'This content is password protected. To view it please enter your password below:', 'ipt_kb' ) . '</p></div>
	<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form" method="post">
	<div class="form-group"><label for="' . $label . '">' . __( 'Password:', 'ipt_kb' ) . '</label><input class="form-control" name="post_password" id="' . $label . '" type="password" /></div> <button class="btn btn-default" type="submit" name="Submit">' . esc_attr__( 'Submit' ) . '</button>
	</form>
	';
	return $output;
}
add_filter( 'the_password_form', 'ipt_kb_the_password_form_filter' );
