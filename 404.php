<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package iPanelThemes Knowledgebase
 */

get_header();

$recent_posts = new WP_Query( array(
	'posts_per_page' => get_option( 'posts_per_page' ),
) );

$main_categories = get_categories( array(
	'taxonomy' => 'category',
	'parent' => 0,
	'hide_empty' => 0,
) );
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'ipt_kb' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'ipt_kb' ); ?></p>

					<?php get_search_form(); ?>

					<div class="row">
						<div class="col-md-6">
							<div class="panel panel-info">
								  <div class="panel-heading">
										<h3 class="panel-title"><?php _e( 'Recently Published Articles', 'ipt_kb' ); ?></h3>
								  </div>
								  <div class="panel-body">
										<div class="list-group">
											<?php if ( $recent_posts->have_posts() ) : ?>
												<?php while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>
												<?php get_template_part( 'category-templates/content', 'popular' ); ?>
												<?php endwhile; ?>
											<?php else : ?>
												<?php get_template_part( 'category-templates/no-result' ); ?>
											<?php endif; ?>
											<?php wp_reset_query(); ?>
										</div>
								  </div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="panel panel-success">
								  <div class="panel-heading">
										<h3 class="panel-title"><?php _e( 'Knowledge Base', 'ipt_kb' ); ?></h3>
								  </div>
								  <div class="panel-body">
										<div class="list-group">
											<?php foreach( $main_categories as $cat ) : ?>
											<a rel="bookmark" class="list-group-item kb-list-date kb-post-list" href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">
											<span class="badge"><?php echo ipt_kb_total_cat_post_count( $cat->term_id ); ?></span>
											<?php echo $cat->name; ?>
											</a>
											<?php endforeach; ?>
										</div>
								  </div>
							</div>
						</div>
					</div>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
