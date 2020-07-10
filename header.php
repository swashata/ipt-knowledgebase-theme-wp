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
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,400i,500,500i,600,700&display=swap" rel="stylesheet">
<link href="<?php echo get_bloginfo('template_directory');?>/lib/fontawesome/css/all.css" rel="stylesheet">
<meta name="description" content=".............">
<meta name="keywords" content="................">
<meta name="google-site-verification" content="............">
<meta name="google" content="notranslate" />
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<?php wp_head(); ?>
<?php echo $ipt_theme_op_settings['integration']['header']; ?>



</head>


	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<!------ Include the above in your HEAD tag ---------->

	<div id="wrapper">

	        <!-- Sidebar -->
	        <div id="sidebar-wrapper">
	            <nav id="spy">
	                <ul class="sidebar-nav nav">

										<?php if ( of_get_option( 'link_1' ) ) { ?>
											<li class="sidebar-brand">
									  <a href="<?php echo of_get_option( 'link_1', '' ); ?>" title="<?php echo of_get_option( 'desc_1', '' ); ?>"><?php echo of_get_option( 'desc_1', '' ); ?></a>
										</li>
										<?php } ?>
										<?php if ( of_get_option( 'link_2' ) ) { ?>
											<li class="sidebar-brand">
									  <a href="<?php echo of_get_option( 'link_2', '' ); ?>" title="<?php echo of_get_option( 'desc_2', '' ); ?>"><?php echo of_get_option( 'desc_2', '' ); ?></a>
										</li>
										<?php } ?>
										<?php if ( of_get_option( 'link_3' ) ) { ?>
											<li class="sidebar-brand">
									  <a href="<?php echo of_get_option( 'link_3', '' ); ?>" title="<?php echo of_get_option( 'desc_3', '' ); ?>"><?php echo of_get_option( 'desc_3', '' ); ?></a>
										</li>
										<?php } ?>
										<?php if ( of_get_option( 'link_4' ) ) { ?>
											<li class="sidebar-brand">
									  <a href="<?php echo of_get_option( 'link_4', '' ); ?>" title="<?php echo of_get_option( 'desc_4', '' ); ?>"><?php echo of_get_option( 'desc_4', '' ); ?></a>
										</li>
										<?php } ?>
										<?php if ( of_get_option( 'link_5' ) ) { ?>
											<li class="sidebar-brand">
										<a href="<?php echo of_get_option( 'link_5', '' ); ?>" title="<?php echo of_get_option( 'desc_5', '' ); ?>"><?php echo of_get_option( 'desc_5', '' ); ?></a>
										</li>
										<?php } ?>
										<?php if ( of_get_option( 'link_6' ) ) { ?>
											<li class="sidebar-brand">
									  <a href="<?php echo of_get_option( 'link_6', '' ); ?>" title="<?php echo of_get_option( 'desc_6', '' ); ?>"><?php echo of_get_option( 'desc_6', '' ); ?></a>
										</li>
										<?php } ?>
										<?php if ( of_get_option( 'link_7' ) ) { ?>
											<li class="sidebar-brand">
									  <a href="<?php echo of_get_option( 'link_7', '' ); ?>" title="<?php echo of_get_option( 'desc_7', '' ); ?>"><?php echo of_get_option( 'desc_7', '' ); ?></a>
										</li>
										<?php } ?>
										<?php if ( of_get_option( 'link_8' ) ) { ?>
											<li class="sidebar-brand">
									  <a href="<?php echo of_get_option( 'link_8', '' ); ?>" title="<?php echo of_get_option( 'desc_8', '' ); ?>"><?php echo of_get_option( 'desc_8', '' ); ?></a>
										</li>
										<?php } ?>

										 <?php wp_list_categories(); ?>

										 <?php if ( of_get_option( 'detay_1' ) ) { ?>
 										<div class="netizdetay">
 										<?php echo of_get_option( 'detay_1', '' ); ?>
 										</div>
 										<?php } ?>
	                </ul>
	            </nav>
	        </div>




<body <?php body_class(); ?>>
	<div id="main">
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>



	<header id="masthead" class="site-header" role="banner">


		<nav class="navbar-default navbar-fixed-top main-navigation" role="navigation" id="site_navigation">

			<div style="background:#111;" class="visible-lg">
		<div class="container ustmenu">
			<div class="row">
				<div class="col-md-2" style="padding-top:11px; font-size:13px; color:#fff;">
					<?php echo current_time( 'F j, Y' ); ?>
				</div>
				<div class="col-md-10 hidden-xs" style="text-align:right;">
					<?php
					wp_nav_menu( array(
						'menu'              => 'primaryust',
						'theme_location'    => 'primaryust',
						'depth'             => 4,
						'container'         => '',
						'menu_class'        => 'nav navbar-nav',
						'fallback_cb'       => 'IPT_Bootstrap_Walker_Nav_Menu::fallback',
						'walker'            => new IPT_Bootstrap_Walker_Nav_Menu())
					);
					?>
				</div>
			</div>
		</div>
	</div>

			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<div style="margin-top:12px;">
					<a id="menu-toggle" href="#" style="float:left; padding:15px;" class="glyphicon glyphicon-align-justify btn-menu toggle">
					</a>
				</div>


					<?php if ( isset( $ipt_theme_op_settings ) && $ipt_theme_op_settings['navigation']['search_bar'] == true ) : ?>

					<?php endif; ?>
					<?php if ( isset( $ipt_theme_op_settings ) && $ipt_theme_op_settings['navigation']['show_login'] == true ) : ?>
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#site-navbar-user">
						<span class="sr-only"><?php _e( 'Toggle User', 'ipt_mst' ); ?></span>
						<i class="ipticm ipt-icomoon-user"></i>
					</button>
					<?php endif; ?>
					<div style="margin-top:15px;">
					<a class="navbar-brand" href="<?php echo home_url( '/' ); ?>">
						<?php if ( get_header_image() ) : ?>
						<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="">
						<?php else : ?>
						<?php bloginfo( 'name' ); ?>
						<?php endif; // End header image check. ?>
					</a>
					</div>
					<div style="margin-top:15px;">
								<?php get_search_form(); ?>
								</div>
				</div>

				<!-- Dynamic Login Buttons -->
				<?php ipt_kb_navbar_login(); ?>
				<!-- /.navbar-dynamic -->

				<!-- Search bar -->

				<!-- /.navbar-form -->
			</div>
		</nav>
	</header><!-- #masthead -->

	<div id="content" class="site-content container">

		<div style="min-height:40px;" class="visible-lg">
		</div>

		<div class="row py-2" style="margin-bottom:20px;">
 			 <!--Breaking box-->
 			 <div class="col-1 col-md-3 col-lg-2 py-1 pr-md-0 mb-md-1">
 					 <div class="d-inline-block d-md-block text-white text-center breaking-caret py-1 px-2" style="background:red; border-radius:3px;  padding-top:5px; padding-bottom:5px; color:#fff;">
 							 <span class="fas fa-bolt" title="Yeni"></span>
 							 <span class="d-none d-md-inline-block">Yeni</span>
 					 </div>
 			 </div>
 			 <!--Breaking content-->
 			 <div class="col-11 col-md-9 col-lg-10 pl-1 pl-md-2">
 					 <div class="breaking-box pt-2 pb-1" style="margin-top:5px;">
 							 <!--marque-->
 							 <marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseleave="this.start();">
 								 <?php query_posts('showposts=10'); ?>
 <?php while (have_posts()) : the_post(); ?>
 								 <a class="h6 font-weight-light" style="margin-right:30px;" href="<?php the_permalink() ?>">
 									 <?php the_title(); ?>
 								 </a>
 <?php endwhile;?>
 							 </marquee>
 					 </div>
 			 </div>
 	 </div>

 <?php
 wp_reset_query();?>
