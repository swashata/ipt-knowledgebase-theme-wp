<?php

/**
 * Template Name: bbPress - Statistics
 *
 * @package bbPress
 * @subpackage Theme
 */

get_header( 'bbpress' ); ?>
	<div id="primary" class="content-area col-md-8">
		<main id="main" class="site-main" role="main">

			<?php do_action( 'bbp_before_main_content' ); ?>
			<?php do_action( 'bbp_template_notices' ); ?>

			<?php while ( have_posts() ) : the_post(); ?>
				<div id="bbp-statistics" class="bbp-statistics">
					<header class="entry-header page-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->
					<div class="entry-content">
						<?php get_the_content() ? the_content() : _e( '<p>Here are the statistics and popular topics of our forums.</p>', 'bbpress' ); ?>
						<div id="bbpress-forums">
							<?php bbp_get_template_part( 'content', 'statistics' ); ?>
							<?php do_action( 'bbp_before_popular_topics' ); ?>
							<?php bbp_set_query_name( 'bbp_popular_topics' ); ?>
							<?php if ( bbp_view_query( 'popular' ) ) : ?>
								<h3><?php _e( 'Popular Topics', 'bbpress' ); ?></h3>
								<?php bbp_get_template_part( 'pagination', 'topics' ); ?>
								<?php bbp_get_template_part( 'loop',       'topics' ); ?>
								<?php bbp_get_template_part( 'pagination', 'topics' ); ?>
							<?php endif; ?>
							<?php bbp_reset_query_name(); ?>
							<?php do_action( 'bbp_after_popular_topics' ); ?>
						</div>
					</div>
				</div><!-- #bbp-statistics -->
			<?php endwhile; // end of the loop. ?>
		<?php do_action( 'bbp_after_main_content' ); ?>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_sidebar( 'bbpress' ); ?>
<?php get_footer(); ?>
