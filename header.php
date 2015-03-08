<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package iPanelThemes Knowledgebase
 */
global $ipt_theme_op_settings;
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
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only"><?php _e( 'Toggle navigation', 'ipt_mst' ); ?></span>
						<i class="ipticm ipt-icomoon-menu2"></i>
					</button>
					<?php if ( isset( $ipt_theme_op_settings ) && $ipt_theme_op_settings['navigation']['search_bar'] == true ) : ?>
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#site-navbar-search">
						<span class="sr-only"><?php _e( 'Toggle search', 'ipt_mst' ); ?></span>
						<i class="ipticm ipt-icomoon-search"></i>
					</button>
					<?php endif; ?>
					<?php if ( isset( $ipt_theme_op_settings ) && $ipt_theme_op_settings['navigation']['show_login'] == true ) : ?>
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#site-navbar-user">
						<span class="sr-only"><?php _e( 'Toggle User', 'ipt_mst' ); ?></span>
						<i class="ipticm ipt-icomoon-user"></i>
					</button>
					<?php endif; ?>
					<a class="navbar-brand" href="<?php echo home_url( '/' ); ?>">
						<?php if ( function_exists( 'ipt_theme_op_navigation_brand' ) ) : ?>
						<?php ipt_theme_op_navigation_brand(); ?>
						<?php endif; ?>
					</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-left navbar-ex1-collapse">
					<?php
					wp_nav_menu( array(
						'menu'              => 'primary',
						'theme_location'    => 'primary',
						'depth'             => 4,
						'container'         => '',
						'menu_class'        => 'nav navbar-nav',
						'fallback_cb'       => 'IPT_Bootstrap_Walker_Nav_Menu::fallback',
						'walker'            => new IPT_Bootstrap_Walker_Nav_Menu())
					);
					?>
				</div>

				<!-- Dynamic Login Buttons -->
				<?php ipt_kb_navbar_login(); ?>
				<!-- /.navbar-dynamic -->

				<!-- Search bar -->
				<?php ipt_kb_navbar_search(); ?>
				<!-- /.navbar-form -->
			</div>
		</nav>
	</header><!-- #masthead -->

	<div id="content" class="site-content container">

	<?php ipt_kb_breadcrumb(); ?>
