<?php
/*
Template Name: Knowledge Base Page
*/
/**
 * Page Template for the Knowledge Base Page
 *
 * Publish a page and put this as a static front-page
 *
 * @package iPanelThemes Knowledgebase
 */

get_header();

$main_categories = get_categories( array(
	'taxonomy' => 'category',
	'parent' => 0,
	'hide_empty' => 0,
) );
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php get_search_form(); ?>

			<div class="row kb-home-cat-row">
				<?php $cat_iterator = 0; foreach ( $main_categories as $cat ) : ?>
				<?php $term_meta = get_option( 'ipt_kb_category_meta_' . $cat->term_id, array() ); ?>
				<?php $term_link = esc_url( get_term_link( $cat ) ); ?>
				<?php $pcat_totals = ipt_kb_total_cat_post_count( $cat->term_id ); ?>
				<div class="col-md-6">
					<div class="col-sm-4 hidden-xs">
						<?php if ( isset( $term_meta['image_url'] ) && '' != $term_meta['image_url'] ) : ?>
						<p class="text-center">
							<a href="<?php echo $term_link; ?>">
							<img class="img-circle" src="<?php echo esc_attr( $term_meta['image_url'] ); ?>" alt="<?php echo esc_attr( $cat->name ); ?>" />
							</a>
						</p>
						<?php endif; ?>
						<div class="caption">
						<?php if ( isset( $term_meta['support_forum'] ) && '' != $term_meta['support_forum'] ) : ?>
							<p class="text-center"><a class="btn btn-default btn-block" href="<?php echo esc_url( $term_meta['support_forum'] ); ?>">
								<i class="glyphicon ipt-icon-support"></i> <?php _e( 'Get support', 'ipt_kb' ); ?>
							</a></p>
						<?php endif; ?>
						</div>
					</div>
					<div class="col-sm-8">
						<h2 class="knowledgebase-title"><a data-placement="bottom" data-popt="kb-homepage-popover-<?php echo $cat->term_id; ?>" title="<?php echo esc_attr( $cat->name ); ?>" href="#" class="btn btn-default btn-sm text-muted ipt-kb-popover"><i class="glyphicon ipt-icon-paragraph-justify2"></i></a> <?php echo $cat->name; ?></h2>
						<div class="ipt-kb-popover-target" id="kb-homepage-popover-<?php echo $cat->term_id; ?>">
							<?php echo wpautop( $cat->description ); ?>
							<p class="text-right">
								<?php if ( isset( $term_meta['support_forum'] ) && '' != $term_meta['support_forum'] ) : ?>
								<a class="btn btn-default" href="<?php echo esc_url( $term_meta['support_forum'] ); ?>">
									<i class="glyphicon ipt-icon-support"></i> <?php _e( 'Get support', 'ipt_kb' ); ?>
								</a>
								<?php endif; ?>
								<a href="<?php echo $term_link; ?>" class="btn btn-info">
									<i class="glyphicon ipt-icon-link"></i> <?php _e( 'Browse all', 'ipt_kb' ); ?>
								</a>
							</p>
						</div>
						<div class="visible-xs">
							<?php if ( isset( $term_meta['image_url'] ) && '' != $term_meta['image_url'] ) : ?>
							<p class="text-center">
								<a href="<?php echo $term_link; ?>">
								<img class="img-circle" src="<?php echo esc_attr( $term_meta['image_url'] ); ?>" alt="<?php echo esc_attr( $cat->name ); ?>" />
								</a>
							</p>
							<?php endif; ?>
							<div class="caption">
							<?php if ( isset( $term_meta['support_forum'] ) && '' != $term_meta['support_forum'] ) : ?>
								<p class="text-center"><a class="btn btn-default btn-block" href="<?php echo esc_url( $term_meta['support_forum'] ); ?>">
									<i class="glyphicon ipt-icon-support"></i> <?php _e( 'Get support', 'ipt_kb' ); ?>
								</a></p>
							<?php endif; ?>
							</div>
						</div>
						<?php $sub_categories = get_categories( array(
							'taxonomy' => 'category',
							'parent' => $cat->term_id,
							'hide_empty' => 0,
							'number' => '5',
						) ); ?>
						<div class="list-group">
							<?php if ( ! empty( $sub_categories ) ) : ?>
							<?php foreach ( $sub_categories as $scat ) : ?>
							<?php $sterm_meta = get_option( 'ipt_kb_category_meta_' . $scat->term_id, array() ); ?>
							<a href="<?php echo esc_url( get_term_link( $scat, 'category' ) ); ?>" class="list-group-item">
								<span class="badge"><?php echo $scat->count; ?></span>
								<?php if ( isset( $sterm_meta['icon_class'] ) && '' != $sterm_meta['icon_class'] ) : ?>
								<i class="glyphicon <?php echo esc_attr( $sterm_meta['icon_class'] ); ?>"></i>
								<?php else : ?>
								<i class="glyphicon ipt-icon-books"></i>
								<?php endif; ?>
								<?php echo $scat->name; ?>

							</a>
							<?php endforeach; ?>
							<?php else : ?>
							<?php $cat_posts = new WP_Query( array(
								'posts_per_page' => get_option( 'posts_per_page', 5 ),
								'cat' => $cat->term_id,
							) ); ?>
							<?php if ( $cat_posts->have_posts() ) : ?>
							<?php while ( $cat_posts->have_posts() ) : $cat_posts->the_post(); ?>
								<?php get_template_part( 'category-templates/content', 'popular' ); ?>
							<?php endwhile; ?>
							<?php else : ?>
								<?php get_template_part( 'category-templates/no-result' ); ?>
							<?php endif; ?>
							<?php wp_reset_query(); ?>
							<?php endif; ?>
						</div>
						<p class="text-right">
							<a href="<?php echo $term_link; ?>" class="btn btn-default">
								<i class="glyphicon ipt-icon-link"></i> <?php printf( _n( 'Browse %d article', 'Browse all %d articles', $pcat_totals, 'ipt_kb' ), $pcat_totals ); ?>
							</a>
						</p>
					</div>
				</div>
				<?php $cat_iterator++; if ( $cat_iterator % 2 == 0 ) echo '<div class="clearfix"></div>'; ?>
				<?php endforeach; ?>
				<div class="clearfix"></div>
			</div>


			<div class="row kb-home-panels">
				<?php
				// Remove the filter from the Posts Order By Plugin
				if ( function_exists( 'CPTOrderPosts' ) ) {
					remove_filter( 'posts_orderby', 'CPTOrderPosts', 99, 2 );
				}
				// Recent posts
				$recent_posts = new WP_Query( array(
					'post_type' => 'post',
					'posts_per_page' => get_option( 'posts_per_page', 5 ),
					'order' => 'DESC',
					'orderby' => 'date',
				) );
				?>
				<div class="col-md-6">
					<div class="panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="glyphicon glyphicon-calendar"></i>&nbsp;&nbsp;<?php _e( 'Recent articles', 'ipt_kb' ); ?></h3>
						</div>
						<div class="panel-body">
							<div class="list-group">
								<?php if ( $recent_posts->have_posts() ) : ?>
									<?php while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>
									<?php get_template_part( 'category-templates/content', 'date' ); ?>
									<?php endwhile; ?>
								<?php else : ?>
									<?php get_template_part( 'category-templates/no-result' ); ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
				<?php wp_reset_query(); ?>

				<?php
				// Popular posts
				// Prep the arguments
				$args = array(
					'post_type' => 'post',
					'posts_per_page' => get_option( 'posts_per_page', 5 ),
					'order' => 'DESC',
					'meta_key' => 'ipt_kb_like_article',
					'orderby' => 'meta_value_num',
				);

				// Filter it for further customizability
				$args = apply_filters( 'ipt_kb_popular_posts_args', $args );

				// Build our custom query
				$popular_query = new WP_Query( $args );
				?>
				<div class="col-md-6">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="glyphicon glyphicon-fire"></i>&nbsp;&nbsp;<?php _e( 'Popular articles', 'ipt_kb' ); ?></h3>
						</div>
						<div class="panel-body">
							<div class="list-group">
								<?php if ( $popular_query->have_posts() ) : ?>
									<?php while ( $popular_query->have_posts() ) : $popular_query->the_post(); ?>
									<?php get_template_part( 'category-templates/content', 'popular' ); ?>
									<?php endwhile; ?>
								<?php else : ?>
									<?php get_template_part( 'category-templates/no-result' ); ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php wp_reset_query(); ?>
			<?php
			// Add the filter from the Posts Order By Plugin
			if ( function_exists( 'CPTOrderPosts' ) ) {
				add_filter( 'posts_orderby', 'CPTOrderPosts', 99, 2 );
			}
			?>

			<?php // Finally add the actual page content ?>
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="entry-content">
							<?php the_content(); ?>
							<?php
								wp_link_pages( array(
									'before' => __( '<p class="pagination-p">Pages:</p>', 'ipt_kb' ) . '<ul class="pagination">',
									'after'  => '</ul><div class="clearfix"></div>',
								) );
							?>
						</div><!-- .entry-content -->
					</article>
				<?php endwhile; ?>
			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>
