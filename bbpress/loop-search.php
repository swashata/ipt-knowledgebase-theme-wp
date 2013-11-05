<?php

/**
 * Search Loop
 *
 * @package bbPress
 * @subpackage Theme
*/

?>

<?php do_action( 'bbp_template_before_search_results_loop' ); ?>

<ul id="bbp-search-results" class="forums bbp-search-results list-group">
	<li class="bbp-header list-group-item active">
		<div class="bbp-search-author"><?php  _e( 'Author',  'bbpress' ); ?></div><!-- .bbp-reply-author -->
		<div class="bbp-search-content">
			<?php _e( 'Search Results', 'bbpress' ); ?>
		</div><!-- .bbp-search-content -->
	</li><!-- .bbp-header -->

	<?php while ( bbp_search_results() ) : bbp_the_search_result(); ?>
	<li class="bbp-body list-group-item">
		<?php bbp_get_template_part( 'loop', 'search-' . get_post_type() ); ?>
	</li>
	<?php endwhile; ?>

	<li class="bbp-footer list-group-item">
		<div class="bbp-search-author"><?php  _e( 'Author',  'bbpress' ); ?></div>
		<div class="bbp-search-content">
			<?php _e( 'Search Results', 'bbpress' ); ?>
		</div><!-- .bbp-search-content -->
	</li><!-- .bbp-footer -->

</ul><!-- #bbp-search-results -->

<?php do_action( 'bbp_template_after_search_results_loop' ); ?>
