<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package iPanelThemes Knowledgebase
 */

get_header(); ?>

	<section id="primary" class="content-area col-md-8">
		<main id="main" class="site-main" role="main">
		<?php get_search_form(); ?>
		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'ipt_kb' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'search' ); ?>

			<?php endwhile; ?>

			<?php ipt_kb_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'search' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
