<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package iPanelThemes Knowledgebase
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header" role="banner">
		<nav class="navbar navbar-default navbar-static-top main-navigation" role="navigation" id="site_navigation">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only"><?php _e( 'Toggle navigation', 'ipt_kb' ); ?></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					<?php if ( get_header_image() ) : ?>
					<a class="site-anchor" href="<?php echo home_url( '/' ); ?>">
						<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="">
					</a>
					<?php else : ?>
					<h1 class="site-title"><a class="site-anchor" href="<?php echo home_url( '/' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
					<?php endif; // End header image check. ?>

				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<?php
					wp_nav_menu( array(
						'menu'              => 'primary',
						'theme_location'    => 'primary',
						'depth'             => 2,
						'container'         => '',
						'menu_class'        => 'nav navbar-nav',
						'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
						'walker'            => new wp_bootstrap_navwalker())
					);
					?>
				</div>
			</div>
		</nav>
	</header><!-- #masthead -->

	<div id="content" class="site-content container">

	<?php bbp_breadcrumb( array(
		// HTML
		'before'          => '<ol id="breadcrumbs" class="breadcrumb">',
		'after'           => '</ol>',

		// Separator
		'sep'             => ' ',
		'pad_sep'         => 0,
		'sep_before'      => '',
		'sep_after'       => '',

		// Crumbs
		'crumb_before'    => '<li>',
		'crumb_after'     => '</li>',

		// Current
		'current_before'  => '<span class="text-muted">',
		'current_after'   => '</span>',
	) ); ?>
