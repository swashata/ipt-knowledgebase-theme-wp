<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package iPanelThemes Knowledgebase
 */
?>
	<div id="secondary" class="widget-area col-md-4" role="complementary">
		<?php if ( of_get_option( 'reklam_8' ) ) { ?>
		<div class="reklamnet">
		<?php echo of_get_option( 'reklam_8', '' ); ?>
		</div>
		<?php } ?>
		<?php do_action( 'before_sidebar' ); ?>
		<?php if ( is_singular( 'post' ) || is_category() ) : ?>
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
		<?php else : ?>
		<?php dynamic_sidebar( 'sidebar-4' ); ?>
		<?php endif; ?>
		<?php if ( of_get_option( 'reklam_9' ) ) { ?>
		<div class="reklamnet">
		<?php echo of_get_option( 'reklam_9', '' ); ?>
		</div>
		<?php } ?>
	</div><!-- #secondary -->
