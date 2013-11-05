<?php

/**
 * Search
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<form role="search" method="get" id="bbp-search-form" action="<?php bbp_search_url(); ?>">
	<label class="screen-reader-text hidden" for="bbp_search"><?php _e( 'Search for:', 'bbpress' ); ?></label>
	<input type="hidden" name="action" value="bbp-search-request" />
	<div class="form-group">
		<div class="input-group">
			<input class="form-control" tabindex="<?php bbp_tab_index(); ?>" type="text" value="<?php echo esc_attr( bbp_get_search_terms() ); ?>" name="bbp_search" id="bbp_search" placeholder="<?php printf( __( 'Search %s&hellip;', 'ipt_kb' ), bbp_get_forum_archive_title() ); ?>" />
			<span class="input-group-btn"><button type="submit" class="btn btn-default"><span class="ipt-icon-search"></span></button></span>
		</div>
	</div>
</form>
