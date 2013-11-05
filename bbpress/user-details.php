<?php

/**
 * User Details
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

	<?php do_action( 'bbp_template_before_user_details' ); ?>

	<div id="bbp-single-user-details">
		<div id="bbp-user-avatar">

			<span class='vcard'>
				<a class="url fn n" href="<?php bbp_user_profile_url(); ?>" title="<?php bbp_displayed_user_field( 'display_name' ); ?>" rel="me">
					<?php echo get_avatar( bbp_get_displayed_user_field( 'user_email', 'raw' ), apply_filters( 'bbp_single_user_details_avatar_size', 150 ) ); ?>
				</a>
			</span>

		</div><!-- #author-avatar -->

		<div id="bbp-user-navigation">
			<ul class="nav nav-pills nav-stacked">
				<li class="<?php if ( bbp_is_single_user_profile() ) :?>active<?php endif; ?>">
					<a class="url fn n" href="<?php bbp_user_profile_url(); ?>" title="<?php printf( esc_attr__( "%s's Profile", 'bbpress' ), bbp_get_displayed_user_field( 'display_name' ) ); ?>" rel="me"><span class="vcard bbp-user-profile-link"><span class="glyphicon ipt-icon-user4"></span> <?php _e( 'Profile', 'bbpress' ); ?></span></a>
				</li>

				<li class="<?php if ( bbp_is_single_user_topics() ) :?>active<?php endif; ?>">
					<a href="<?php bbp_user_topics_created_url(); ?>" title="<?php printf( esc_attr__( "%s's Topics Started", 'bbpress' ), bbp_get_displayed_user_field( 'display_name' ) ); ?>"><span class='bbp-user-topics-created-link'><span class="glyphicon ipt-icon-bubbles4"></span> <?php _e( 'Topics Started', 'bbpress' ); ?></span></a>
				</li>

				<li class="<?php if ( bbp_is_single_user_replies() ) :?>active<?php endif; ?>">
					<a href="<?php bbp_user_replies_created_url(); ?>" title="<?php printf( esc_attr__( "%s's Replies Created", 'bbpress' ), bbp_get_displayed_user_field( 'display_name' ) ); ?>"><span class='bbp-user-replies-created-link'><span class="glyphicon ipt-icon-reply"></span> <?php _e( 'Replies Created', 'bbpress' ); ?></span></a>
				</li>

				<?php if ( bbp_is_favorites_active() ) : ?>
					<li class="<?php if ( bbp_is_favorites() ) :?>active<?php endif; ?>">
						<a href="<?php bbp_favorites_permalink(); ?>" title="<?php printf( esc_attr__( "%s's Favorites", 'bbpress' ), bbp_get_displayed_user_field( 'display_name' ) ); ?>"><span class="bbp-user-favorites-link"><span class="glyphicon ipt-icon-heart"></span> <?php _e( 'Favorites', 'bbpress' ); ?></span></a>
					</li>
				<?php endif; ?>

				<?php if ( bbp_is_user_home() || current_user_can( 'edit_users' ) ) : ?>

					<?php if ( bbp_is_subscriptions_active() ) : ?>
						<li class="<?php if ( bbp_is_subscriptions() ) :?>active<?php endif; ?>">
							<a href="<?php bbp_subscriptions_permalink(); ?>" title="<?php printf( esc_attr__( "%s's Subscriptions", 'bbpress' ), bbp_get_displayed_user_field( 'display_name' ) ); ?>"><span class="bbp-user-subscriptions-link"><span class="glyphicon ipt-icon-bookmarks"></span> <?php _e( 'Subscriptions', 'bbpress' ); ?></span></a>
						</li>
					<?php endif; ?>

					<li class="<?php if ( bbp_is_single_user_edit() ) :?>active<?php endif; ?>">
						<a href="<?php bbp_user_profile_edit_url(); ?>" title="<?php printf( esc_attr__( "Edit %s's Profile", 'bbpress' ), bbp_get_displayed_user_field( 'display_name' ) ); ?>"><span class="bbp-user-edit-link"><span class="glyphicon glyphicon-edit"></span> <?php _e( 'Edit', 'bbpress' ); ?></span></a>
					</li>

				<?php endif; ?>

			</ul>
		</div><!-- #bbp-user-navigation -->
	</div><!-- #bbp-single-user-details -->

	<?php do_action( 'bbp_template_after_user_details' ); ?>
