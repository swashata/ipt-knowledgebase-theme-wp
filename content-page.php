<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package iPanelThemes Knowledgebase
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header page-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
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
	<?php edit_post_link( __( 'Edit', 'ipt_kb' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
</article><!-- #post-## -->
