<?php

/**
 * User Roles Profile Edit Part
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div class="form-group">
	<label class="col-sm-4" for="role"><?php _e( 'Blog Role', 'bbpress' ) ?></label>
	<div class="col-sm-8">
		<?php ob_start(); ?>
		<?php bbp_edit_user_blog_role(); ?>
		<?php $usr_ddn = ob_get_clean(); ?>
		<?php echo str_replace( '<select', '<select class="form-control"', $usr_ddn ); ?>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-4" for="forum-role"><?php _e( 'Forum Role', 'bbpress' ) ?></label>
	<div class="col-sm-8">
		<?php ob_start(); ?>
		<?php bbp_edit_user_forums_role(); ?>
		<?php $usr_ddn = ob_get_clean(); ?>
		<?php echo str_replace( '<select', '<select class="form-control"', $usr_ddn ); ?>
	</div>
</div>
