<?php

/**
 * Password Protected
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div id="bbpress-forums">
	<div class="bbp-form" id="bbp-protected">
		<h4><?php _e( 'Protected', 'bbpress' ); ?></h4>
		<?php echo get_the_password_form(); ?>
	</div>
</div>
