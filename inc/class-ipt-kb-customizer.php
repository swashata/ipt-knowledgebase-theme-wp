<?php

/**
 * Theme Customizer Integration
 *
 * @package    WP KnowledgeBase Theme
 * @subpackage Customizer
 */
class IPT_KB_Customizer {



	public function get_defaults() {
		$defaults = array(
			'navigation' => array(
				'show_login' => false,
				'logged_in_links' => array(), // SDA -> title, icon, link
				'logged_out_links' => array(), // SDA -> title, icon, link
				'search_bar' => false,
				'brand' => 'iPt',
				'image' => '',
			),
			'integration' => array(
				'header' => '',
				'footer' => '',
			),
			'advertisement' => array(
				'below_title' => '',
				'below_authorbox' => '',
			),
		);
		return apply_filters( 'ipt_kb_theme_options', $defaults );
	}
}
