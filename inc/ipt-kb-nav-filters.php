<?php
/**
 * Pluggable APIs
 * This plugin file is loaded after setup theme
 * So any theme can override these
 *
 * Used both by frontend and back end
 *
 * @package iPanelThemes Theme Options
 * @subpackage APIs
 */

if ( ! function_exists( 'ipt_bootstrap_walker_nav_menu_edit_update_fields' ) ) :
/**
 * Saves the newly entered items
 * @param  int $menu_id         menu id
 * @param  int $menu_item_db_id menu item db id
 * @param  array $args          @ignore
 * @return void
 */
function ipt_bootstrap_walker_nav_menu_edit_update_fields( $menu_id, $menu_item_db_id, $args ) {
	$field_ids = array( 'icon' => 'text', 'divider' => 'bool', 'header' => 'bool', 'bsdisabled' => 'bool' );
	$value = '';
	foreach ( $field_ids as $id => $type ) {
		switch ( $type ) {
			case 'text' :
			$value = '';
			if ( isset( $_REQUEST['menu-item-' . $id] ) && is_array( $_REQUEST['menu-item-' . $id] ) ) {
				$value = stripslashes( $_REQUEST['menu-item-' . $id][$menu_item_db_id] );
			}
			break;
			case 'bool' :
			$value = false;
			if ( isset( $_REQUEST['menu-item-' . $id] ) && is_array( $_REQUEST['menu-item-' . $id] ) && isset( $_REQUEST['menu-item-' . $id][$menu_item_db_id] ) ) {
				$value = true;
			}
		}
		update_post_meta( $menu_item_db_id, '_menu_item_' . $id, $value );
	}
}
endif;

if ( ! function_exists( 'ipt_bootstrap_walker_nav_menu_edit_add_fields' ) ) :
/**
 * Add custom fields to $item nav object
 * in order to be used in custom walker
 *
 * @param  stdClass $menu_item Menu Items
 * @return void
 */
function ipt_bootstrap_walker_nav_menu_edit_add_fields( $menu_item ) {
	$field_ids = array( 'icon' => 'text', 'divider' => 'bool', 'header' => 'bool', 'bsdisabled' => 'bool' );
	$value = '';
	foreach ( $field_ids as $id => $type ) {
		switch ( $type ) {
			case 'text' :
			$value = (string) get_post_meta( $menu_item->ID, '_menu_item_' . $id, true );
			break;
			case 'bool' :
			$value = get_post_meta( $menu_item->ID, '_menu_item_' . $id, true );
			if ( $value == '' ) {
				$value = false;
			}
		}
		$menu_item->{$id} = $value;
	}
	return $menu_item;
}
endif;

if ( ! function_exists( 'ipt_bootstrap_walker_nav_menu_edit_filter' ) ) :
/**
 * Use this to define the new walker
 * @param  WP_Nav_Walker $walker  Default Walker class
 * @param  int $menu_id Menu ID
 * @return string          The name of the new walker class
 */
function ipt_bootstrap_walker_nav_menu_edit_filter( $walker, $menu_id ) {
	return 'IPT_Bootstrap_Walker_Nav_Menu_Edit';
}
endif;

if ( ! function_exists( 'ipt_bootstrap_walker_nav_menu_edit_enqueue' ) ) :
/**
 * Enqueue needed scripts given the location
 * @param  string $location URL to the base directory of the theme where predefined files are located
 * @return void
 */
function ipt_bootstrap_walker_nav_menu_edit_enqueue( $location ) {

}
endif;
