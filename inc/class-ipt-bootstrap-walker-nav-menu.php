<?php
/**
 * The Advanced Bootstrap NavWalker class
 */
if ( ! class_exists( 'IPT_Bootstrap_Walker_Nav_Menu' ) ) :
	/**
	 * The Navigation Menu Walker Class
	 *
	 * @package iPanelThemes
	 * @subpackage Walker Nav
	 */
	class IPT_Bootstrap_Walker_Nav_Menu extends Walker_Nav_Menu {
		/**
		 * Starts the list before the elements are added.
		 *
		 * It takes care of dropdown-menu and dropdown-submenu classes
		 *
		 * @see Walker::start_lvl()
		 *
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   An array of arguments. @see wp_nav_menu()
		 */
		function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat( "\t", $depth );

			$class = 'dropdown-menu';

			if ( $depth == 0 ) {
				$class .= ' dropdown-menu-right';
			}
			$output .= "\n$indent<ul role=\"menu\" class=\"$class\">\n";
		}

		/**
		 * Start the element output.
		 *
		 * @see Walker::start_el()
		 *
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item   Menu item data object.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   An array of arguments. @see wp_nav_menu()
		 * @param int    $id     Current item ID.
		 */
		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

			$class_names = '';
			$li_atts = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			$li_atts .= ' role="presentation"';
			// Check for dropdown header
			if ( $depth > 0 && isset( $item->header ) && $item->header == true ) {
				$classes[] = "dropdown-header";

			// Check for disabled
			} else if ( isset( $item->bsdisabled ) && $item->bsdisabled == true ) {
				$classes[] = "disabled";
				$item->url = '#';
			}

			/**
			 * Filter the CSS class(es) applied to a menu item's <li>.
			 *
			 * @since 3.0.0
			 *
			 * @see wp_nav_menu()
			 *
			 * @param array  $classes The CSS classes that are applied to the menu item's <li>.
			 * @param object $item    The current menu item.
			 * @param array  $args    An array of wp_nav_menu() arguments.
			 */
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

			// Add dropdown class if it has children
			if ( in_array( 'menu-item-has-children', $classes ) ) {
				$class_names .= ' dropdown';
				if ( $depth === 0 ) {
					$class_names .= ' dropdown-split-left';
				} else {
					$class_names .= ' dropdown-submenu';
				}
			}

			// Add the active class
			if ( in_array( 'current-menu-item', $classes ) || in_array( 'current-menu-ancestor', $classes ) ) {
				$class_names .= ' active';
			}

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			/**
			 * Filter the ID applied to a menu item's <li>.
			 *
			 * @since 3.0.1
			 *
			 * @see wp_nav_menu()
			 *
			 * @param string $menu_id The ID that is applied to the menu item's <li>.
			 * @param object $item    The current menu item.
			 * @param array  $args    An array of wp_nav_menu() arguments.
			 */
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';


			$output .= $indent . '<li' . $id . $class_names . $li_atts .'>';

			$atts = array();
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
			$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
			$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
			$atts['role']   = 'menuitem';
			$atts['tabindex'] = '-1';

			/**
			 * Filter the HTML attributes applied to a menu item's <a>.
			 *
			 * @since 3.6.0
			 *
			 * @see wp_nav_menu()
			 *
			 * @param array $atts {
			 *     The HTML attributes applied to the menu item's <a>, empty strings are ignored.
			 *
			 *     @type string $title  Title attribute.
			 *     @type string $target Target attribute.
			 *     @type string $rel    The rel attribute.
			 *     @type string $href   The href attribute.
			 * }
			 * @param object $item The current menu item.
			 * @param array  $args An array of wp_nav_menu() arguments.
			 */
			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$item_output = $args->before;

			// Add the anchor only if it's value is not set as # and it is not header
			if (
					// Is it a disabled item? Then print the anchor anyway
					( isset( $item->bsdisabled ) && $item->bsdisabled == true ) ||
					// If it is a header, then print only if the anchor is not #
					( ( isset( $item->header ) || $item->header == true ) && $item->url != '#' ) ||
					// Not disabled, not header
					( ( ! isset( $item->header ) || $item->header == false ) && ( ! isset( $item->bsdisabled ) || $item->bsdisabled == false ) )
				) {
				$item_output .= '<a'. $attributes .'>';
				// Add icon
				if ( isset( $item->icon ) ) {
					$item_output .= $this->add_icon( $item->icon );
				}
				/** This filter is documented in wp-includes/post-template.php */
				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
				$item_output .= '</a>';
			// But still always add the icon and the title
			} else {
				// Add icon
				if ( isset( $item->icon ) ) {
					$item_output .= $this->add_icon( $item->icon );
				}
				$item_output .= apply_filters( 'the_title', $item->title, $item->ID );
			}

			$item_output .= $args->after;

			/**
			 * Now check if the item has children
			 * If so then add a split button
			 */
			if ( in_array( 'menu-item-has-children', $classes ) && $depth == 0 ) {
				$item_output .= '</li><li class="dropdown dropdown-split-right">';
				$item_output .= '<a href="#" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true"><i class="fa fa-caret-down"></i></a>';
			}

			/**
			 * Filter a menu item's starting output.
			 *
			 * The menu item's starting output only includes $args->before, the opening <a>,
			 * the menu item's title, the closing </a>, and $args->after. Currently, there is
			 * no filter for modifying the opening and closing <li> for a menu item.
			 *
			 * @since 3.0.0
			 *
			 * @see wp_nav_menu()
			 *
			 * @param string $item_output The menu item's starting HTML output.
			 * @param object $item        Menu item data object.
			 * @param int    $depth       Depth of menu item. Used for padding.
			 * @param array  $args        An array of wp_nav_menu() arguments.
			 */
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}

		/**
		 * Ends the element output, if needed.
		 *
		 * @see Walker::end_el()
		 *
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item   Page data object. Not used.
		 * @param int    $depth  Depth of page. Not Used.
		 * @param array  $args   An array of arguments. @see wp_nav_menu()
		 */
		function end_el( &$output, $item, $depth = 0, $args = array() ) {
			$output .= "</li>\n";
			// Add the divider if needed
			if ( $depth > 0 && $item->divider ) {
				$output .= "<li role=\"presentation\" class=\"divider\"></li>\n";
			}
		}

		public static function fallback( $args ) {
			if ( current_user_can( 'manage_options' ) ) {

				extract( $args );

				$fb_output = null;

				if ( $container ) {
					$fb_output = '<' . $container;

					if ( $container_id )
						$fb_output .= ' id="' . $container_id . '"';

					if ( $container_class )
						$fb_output .= ' class="' . $container_class . '"';

					$fb_output .= '>';
				}

				$fb_output .= '<ul';

				if ( $menu_id )
					$fb_output .= ' id="' . $menu_id . '"';

				if ( $menu_class )
					$fb_output .= ' class="' . $menu_class . '"';

				$fb_output .= '>';
				$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
				$fb_output .= '</ul>';

				if ( $container )
					$fb_output .= '</' . $container . '>';

				echo $fb_output;
			}
		}

		private function add_icon( $icon ) {
			if ( empty( $icon ) || 'none' == $icon ) {
				//return '';
			}
			return ' <i class="' . esc_attr( $icon ) . '"></i> ';
		}
	}
endif;
