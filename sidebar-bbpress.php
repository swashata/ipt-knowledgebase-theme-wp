<?php
/**
 * The Sidebar containing the main widget areas for bbPress
 *
 * @package iPanelThemes Knowledgebase
 */
?>
<?php if ( is_active_sidebar( 'sidebar-5' ) ) : ?>
	<div id="secondary" class="widget-area col-md-4" role="complementary">
		<?php do_action( 'before_sidebar' ); ?>
		<?php dynamic_sidebar( 'sidebar-5' ); ?>
	</div><!-- #secondary -->
<?php endif; ?>
