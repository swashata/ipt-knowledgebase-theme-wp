<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package iPanelThemes Knowledgebase
 */

get_header();

$cat_id = get_query_var( 'cat' );
$cat = get_category( $cat_id );
$term_meta = get_option( 'ipt_kb_category_meta_' . $cat_id, array() );
$sub_categories = get_categories( array(
	'taxonomy' => 'category',
	'parent' => $cat->term_id,
	'hide_empty' => 0,
	'number' => '',
) );
?>

	<section id="primary" class="content-area<?php if ( $cat->parent != '0' || empty( $sub_categories ) ) echo ' col-md-8'; ?>">
		<?php get_search_form(); ?>
		<main id="main" class="site-main <?php echo ( $cat->parent == '0' ? 'ipt-kb-parent' : 'ipt-kb-child' ); ?>" role="main">
			<?php if ( $cat->parent == '0' && ! empty( $sub_categories ) ) : ?>
			<?php get_template_part( 'category-templates/category', 'parent' ); // This is a parent category ?>
			<?php else : ?>
			<?php get_template_part( 'category-templates/category', 'child' ); // This is a parent category ?>
			<?php endif; ?>
		</main><!-- #main -->
	</section><!-- #primary -->

<?php if ( $cat->parent != '0' || empty( $sub_categories ) ) get_sidebar(); ?>
<?php get_footer(); ?>
