<?php
/**
 * @package iPanelThemes Knowledgebase
 */
global $term_meta, $cat, $cat_id, $wp_query;

// Check if the current category is not a first level category
// This will happen if the current category does not have any child
// If this is the case, then we simply show all it's posts
// Instead of the nice knowledgebase type things
if ( $cat->parent != '0' ) {
	$parent_cat = get_category( $cat->parent );
	while ( $parent_cat->parent != '0' ) {
		$parent_cat = get_category( $parent_cat->parent );
	}
	$pterm_meta = get_option( 'ipt_kb_category_meta_' . $parent_cat->term_id, array() );
} else {
	$pterm_meta = $term_meta;
}
$pcat_totals = ipt_kb_total_cat_post_count( $cat_id );
?>
		<?php if ( have_posts() ) : ?>

			<header class="kb-parent-category-header">
				<div class="col-sm-3 col-lg-2 kb-subcat-icon hidden-xs">
					<p class="text-center">
						<a href="<?php echo esc_url( get_category_link( $cat ) ); ?>" class="thumbnail">
								<?php if ( isset( $term_meta['icon_class'] ) && '' != $term_meta['icon_class'] ) : ?>
								<i class="glyphicon <?php echo esc_attr( $term_meta['icon_class'] ); ?>"></i>
								<?php else : ?>
								<i class="glyphicon ipt-icon-books"></i>
								<?php endif; ?>
						</a>
					</p>
					<div class="caption">
					<?php if ( isset( $pterm_meta['support_forum'] ) && $pterm_meta['support_forum'] != '' ) : ?>
						<p class="text-center"><a class="btn btn-default btn-block" href="<?php echo esc_url( $pterm_meta['support_forum'] ); ?>">
							<i class="glyphicon ipt-icon-support"></i> <?php _e( 'Support', 'ipt_kb' ); ?>
						</a></p>
					<?php endif; ?>
					</div>
				</div>
				<div class="col-sm-9 col-lg-10">
					<h1 class="page-title kb-scat-title">
						<span class="pull-right label label-info"><?php printf( _n( '%d article', '%d articles', $pcat_totals, 'ipt_kb' ), $pcat_totals ); ?></span>
						<?php single_cat_title(); ?>
						<?php if ( $wp_query->max_num_pages > 1 && isset( $wp_query->query_vars['paged'] ) && $wp_query->query_vars['paged'] != 0 ) : ?>
							<small class="text-muted"><?php printf( __( 'Page %1$d / %2$d', 'ipt_kb' ), $wp_query->query_vars['paged'], $wp_query->max_num_pages ); ?></small>
						<?php endif; ?>
					</h1>
					<div class="col-sm-3 col-lg-2 kb-subcat-icon visible-xs">
						<p class="text-center">
							<a href="<?php echo esc_url( get_category_link( $cat ) ); ?>" class="thumbnail">
									<?php if ( isset( $term_meta['icon_class'] ) && '' != $term_meta['icon_class'] ) : ?>
									<i class="glyphicon <?php echo esc_attr( $term_meta['icon_class'] ); ?>"></i>
									<?php else : ?>
									<i class="glyphicon ipt-icon-books"></i>
									<?php endif; ?>
							</a>
						</p>
						<div class="caption">
						<?php if ( isset( $pterm_meta['support_forum'] ) && $pterm_meta['support_forum'] != '' ) : ?>
							<p class="text-center"><a class="btn btn-default btn-block" href="<?php echo esc_url( $pterm_meta['support_forum'] ); ?>">
								<i class="glyphicon ipt-icon-support"></i> <?php _e( 'Support', 'ipt_kb' ); ?>
							</a></p>
						<?php endif; ?>
						</div>
					</div>
					<?php
						// Show an optional term description.
						$term_description = term_description();
						if ( ! empty( $term_description ) ) :
							printf( '<div class="taxonomy-description well well-sm">%s</div>', $term_description );
						endif;
					?>
				</div>
				<div class="clearfix"></div>
			</header><!-- .page-header -->

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content' ); ?>
			<?php endwhile; ?>
			<?php ipt_kb_content_nav( 'nav-below' ); ?>
		<?php else : ?>

			<?php get_template_part( 'no-results', 'archive' ); ?>

		<?php endif; ?>

