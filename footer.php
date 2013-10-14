<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package iPanelThemes Knowledgebase
 */
?>

	</div><!-- #content -->
	<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="container">
		<div class="row">
			<div class="col-md-8" id="footer-widget-1">
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
			</div>
			<div class="col-md-4" id="footer-widget-2">
				<?php dynamic_sidebar( 'sidebar-3' ); ?>
			</div>
		</div>
	</div>
		<div class="site-info">
			<p class="copyright text-muted">
				<a href="http://wordpress.org/" rel="generator"><?php printf( __( 'Proudly powered by %s', 'ipt_kb' ), 'WordPress' ); ?></a>
				<span class="sep"> | </span>
				<?php printf( __( 'Theme: %1$s by %2$s.', 'ipt_kb' ), 'WP Knowledge Base', '<a href="http://ipanelthemes.com/" rel="designer">iPanelThemes.com</a>' ); ?>
			</p>
			<?php do_action( 'ipt_kb_credits' ); ?>
		</div><!-- .site-info -->
		<?php wp_footer(); ?>
	</footer><!-- #colophon -->
</div><!-- #page -->

</body>
</html>
