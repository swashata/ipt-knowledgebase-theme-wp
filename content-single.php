<?php
/**
 * @package iPanelThemes Knowledgebase
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header page-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta text-muted">
			<?php ipt_kb_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => __( '<p class="pagination-p">Pages:</p>', 'ipt_kb' ) . '<ul class="pagination">',
				'after'  => '</ul><div class="clearfix"></div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta text-muted well well-sm">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'ipt_kb' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'ipt_kb' ) );

			if ( ! ipt_kb_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was tagged <i class="glyphicon glyphicon-tags"></i>&nbsp;&nbsp;%2$s. <br />Bookmark the <i class="glyphicon glyphicon-bookmark"></i>&nbsp;&nbsp;<a href="%3$s" rel="bookmark">permalink</a>.', 'ipt_kb' );
				} else {
					$meta_text = __( 'Bookmark the <i class="glyphicon glyphicon-bookmark"></i>&nbsp;&nbsp;<a href="%3$s" rel="bookmark">permalink</a>.', 'ipt_kb' );
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was posted in <i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;%1$s and tagged <i class="glyphicon glyphicon-tags"></i>&nbsp;&nbsp;%2$s. <br />Bookmark the <i class="glyphicon glyphicon-bookmark"></i>&nbsp;&nbsp;<a href="%3$s" rel="bookmark">permalink</a>.', 'ipt_kb' );
				} else {
					$meta_text = __( 'This entry was posted in <i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;%1$s. <br />Bookmark the <i class="glyphicon glyphicon-bookmark"></i>&nbsp;&nbsp;<a href="%3$s" rel="bookmark">permalink</a>.', 'ipt_kb' );
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink()
			);
		?>

		<?php edit_post_link( __( 'Edit', 'ipt_kb' ), '<span class="edit-link"><i class="glyphicon glyphicon-edit"></i>&nbsp;&nbsp;', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
