<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package iPanelThemes Knowledgebase
 */
?>
	<div id="secondary" class="widget-area col-md-4" role="complementary">
		<?php do_action( 'before_sidebar' ); ?>
		<?php if ( is_singular( 'post' ) || is_category() ) : ?>
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
		<?php else : ?>
		<?php dynamic_sidebar( 'sidebar-4' ); ?>
		<?php endif; ?>
	</div><!-- #secondary -->
