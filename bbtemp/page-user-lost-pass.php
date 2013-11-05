<?php

/**
 * Template Name: bbPress - User Lost Password
 *
 * @package bbPress
 * @subpackage Theme
 */

// No logged in users
bbp_logged_in_redirect();

// Begin Template
get_header( 'bbpress' ); ?>
	<div id="primary" class="content-area col-md-8">
		<main id="main" class="site-main" role="main">

			<?php do_action( 'bbp_before_main_content' ); ?>
			<?php do_action( 'bbp_template_notices' ); ?>

			<?php while ( have_posts() ) : the_post(); ?>
				<div id="bp-lost-pass" class="bbp-lost-pass">
					<header class="entry-header page-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->
					<div class="entry-content">
						<?php the_content(); ?>
						<div id="bbpress-forums">
							<?php bbp_get_template_part( 'form', 'user-lost-pass' ); ?>
						</div>
					</div>
				</div><!-- #bbp-lost-pass -->
			<?php endwhile; // end of the loop. ?>
		<?php do_action( 'bbp_after_main_content' ); ?>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_sidebar( 'bbpress' ); ?>
<?php get_footer(); ?>

