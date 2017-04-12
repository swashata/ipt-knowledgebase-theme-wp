<?php
/**
 * iPanelThemes Knowledgebase functions and definitions
 *
 * @package iPanelThemes Knowledgebase
 */

/**
 * Set the version
 */
global $ipt_kb_version, $ipt_theme_op_settings;
$ipt_kb_version = '1.7.0';
if ( ! is_array( $ipt_theme_op_settings ) ) {
	$ipt_theme_op_settings = array();
}

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'ipt_kb_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function ipt_kb_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on iPanelThemes Knowledgebase, use a find and replace
	 * to change 'ipt_kb' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'ipt_kb', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'ipt_kb' ),
	) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'ipt_kb_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Disable the admin bar
	//add_filter( 'show_admin_bar', '__return_false' );

	// Add post thumbnail
	add_theme_support( 'post-thumbnails', array( 'post' ) );

	// Add new theme title-tag WP4.1
	add_theme_support( 'title-tag' );

	add_image_size( 'ipt_kb_medium', 256, 128, true );
	add_image_size( 'ipt_kb_large', 9999, 200, true );

	// Add HTML5
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form' ) );
}
endif; // ipt_kb_setup
add_action( 'after_setup_theme', 'ipt_kb_setup' );

/**
 * Backward compatibility
 */
if ( ! function_exists( '_wp_render_title_tag' ) ) :
    function ipt_kb_render_title() {
?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
    }
    add_action( 'wp_head', 'ipt_kb_render_title' );
endif;

/**
 * Register widgetized area and update sidebar with default widgets
 */
if ( ! function_exists( 'ipt_kb_widgets_init' ) ) :
function ipt_kb_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Knowledge Base Sidebar', 'ipt_kb' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Shows up only on category archive pages and single posts.', 'ipt_kb' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s panel panel-default">',
		'after_widget'  => '</div></aside>',
		'before_title'  => '<div class="panel-heading"><h3 class="widget-title panel-title">',
		'after_title'   => '</h3></div><div class="panel-body">',
	) );
	register_sidebar( array(
		'name'          => __( 'General Sidebar', 'ipt_kb' ),
		'id'            => 'sidebar-4',
		'description'   => __( 'Shows up everywhere except the category archive pages and single posts.', 'ipt_kb' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s panel panel-default">',
		'after_widget'  => '</div></aside>',
		'before_title'  => '<div class="panel-heading"><h3 class="widget-title panel-title">',
		'after_title'   => '</h3></div><div class="panel-body">',
	) );
	register_sidebar( array(
		'name'          => __( 'bbPress Sidebar', 'ipt_kb' ),
		'id'            => 'sidebar-5',
		'description'   => __( 'Shows up on bbPress forums and topics.', 'ipt_kb' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s panel panel-default">',
		'after_widget'  => '</div></aside>',
		'before_title'  => '<div class="panel-heading"><h3 class="widget-title panel-title">',
		'after_title'   => '</h3></div><div class="panel-body">',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Large', 'ipt_kb' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Small', 'ipt_kb' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
endif;
add_action( 'widgets_init', 'ipt_kb_widgets_init' );

/**
 * Fix for empty widget title
 *
 * As we are using panels
 */
if ( ! function_exists( 'ipt_kb_widget_title_filter' ) ) :
function ipt_kb_widget_title_filter( $title = '' ) {
	if ( $title == '' ) {
		return ' ';
	}
	return $title;
}
endif;
add_filter( 'widget_title', 'ipt_kb_widget_title_filter' );

/**
 * Enqueue scripts and styles
 */
if ( ! function_exists( 'ipt_kb_scripts' ) ) :
function ipt_kb_scripts() {
	global $ipt_kb_version;

	// Fonts from Google Webfonts
	wp_enqueue_style( 'ipt_kb-fonts', '//fonts.googleapis.com/css?family=Oswald|Roboto:400,400italic,700,700italic', array(), $ipt_kb_version );

	// Main stylesheet
	wp_enqueue_style( 'ipt_kb-style', get_stylesheet_uri(), array(), $ipt_kb_version );

	// Bootstrap
	wp_enqueue_style( 'ipt_kb-bootstrap', get_template_directory_uri() . '/lib/bootstrap/css/bootstrap.min.css', array(), $ipt_kb_version );
	wp_enqueue_style( 'ipt_kb-bootstrap-theme', get_template_directory_uri() . '/lib/bootstrap/css/bootstrap-theme.min.css', array(), $ipt_kb_version );

	// Icomoon
	wp_enqueue_style( 'ipt-kb-icomoon', get_template_directory_uri() . '/lib/icomoon/style.css', array(), $ipt_kb_version );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/lib/fontawesome/css/font-awesome.min.css', array(), $ipt_kb_version );

	// Now the JS
	wp_enqueue_script( 'ipt_kb-bootstrap', get_template_directory_uri() . '/lib/bootstrap/js/bootstrap.min.js', array( 'jquery' ), $ipt_kb_version );
	wp_enqueue_script( 'ipt_kb-bootstrap-jq', get_template_directory_uri() . '/js/jquery.ipt-kb-bootstrap.js', array( 'jquery' ), $ipt_kb_version );

	wp_enqueue_script( 'ipt_kb-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), $ipt_kb_version, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'ipt_kb-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), $ipt_kb_version );
	}

	// Load the sticky kit
	wp_enqueue_script( 'ipt-kb-sticky-kit', get_template_directory_uri() . '/lib/sticky-kit/jquery.sticky-kit.min.js', array( 'jquery' ), $ipt_kb_version );

	// Load the theme js
	wp_enqueue_script( 'ipt-kb-js', get_template_directory_uri() . '/js/ipt-kb.js', array( 'jquery' ), $ipt_kb_version );
	wp_localize_script( 'ipt-kb-js', 'iptKBJS', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'ajax_error' => __( 'Oops, some problem to connect. Try again?', 'ipt_kb' ),
	) );
}
endif;
add_action( 'wp_enqueue_scripts', 'ipt_kb_scripts' );

/**
 * Add compatibility with the EBS Plugin
 * For the latest version only
 *
 * @link http://wordpress.org/plugins/easy-bootstrap-shortcodes/
 *
 * @param  boolean $value The value of the filter
 * @return boolean        True to disable frontend enqueue and settings page
 */
function ipt_kb_ebs_compat( $value ) {
	return true;
}
add_filter( 'ebs_custom_option', 'ipt_kb_ebs_compat' );

/**
 * Add compatibility with older versions of EBS plugin
 *
 * Removes the stylesheets/javscripts
 */
function ipt_kb_ebs_remove_enqueue() {
	wp_deregister_style( 'bootstrap' );
	wp_deregister_style( 'bootstrap-icon' );
	wp_deregister_script( 'bootstrap' );
}
add_action( 'wp_enqueue_scripts', 'ipt_kb_ebs_remove_enqueue', 11 );

/**
 * Add the excerpt hellip
 * @param  string $more Default more
 * @return string       new more
 */
function ipt_kb_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'ipt_kb_excerpt_more' );
/**
 * Add filter to comment reply link to convert into bootstrap button
 * @param  string $comment_reply_link default comment reply link
 * @param  stdObj $post               $post
 * @return string                     new reply link
 */
if ( ! function_exists( 'ipt_kb_comment_reply_filter' ) ) :
function ipt_kb_comment_reply_filter( $comment_reply_link, $post = null ) {
	$new = preg_replace( '/<a(.*?)class=\'(.*?)\'/', '<a$1class=\'$2 btn btn-info btn-sm\'', $comment_reply_link );
	return $new;
}
endif;
add_filter( 'comment_reply_link', 'ipt_kb_comment_reply_filter', 10, 2 );
/**
 * Add filter to cancel comment reply link to convert into bootstrap button
 * @param  string $comment_reply_link default comment reply link
 * @param  stdObj $post               $post
 * @return string                     new reply link
 */
if ( ! function_exists( 'ipt_kb_cancel_comment_reply_filter' ) ) :
function ipt_kb_cancel_comment_reply_filter( $cancel_comment_reply_link, $post = null ) {
	$new = str_replace( '<a', '<a class="btn btn-danger btn-sm"', $cancel_comment_reply_link );
	return $new;
}
endif;
add_filter( 'cancel_comment_reply_link', 'ipt_kb_cancel_comment_reply_filter', 10, 2 );

/**
 * Add filter to properly display wp_link_pages using bootstrap
 * @param  string $link original link html
 * @return string       Modified link html
 */
if ( ! function_exists( 'ipt_kb_link_pages' ) ) :
function ipt_kb_link_pages( $link ) {
	$return = $link;
	if ( is_numeric( $link ) ) {
		// Add the disabled
		$return = '<li class="active"><a href="javascript:;">' . $link . '</a></li>';
	} else {
		$return = '<li>' . $link . '</li>';
	}
	return $return;
}
endif;
add_filter( 'wp_link_pages_link', 'ipt_kb_link_pages' );

/**
 * Include the TGM Plugin Activation
 */
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'ipt_kb_required_plugins' );

if ( ! function_exists( 'ipt_kb_required_plugins' ) ) :
function ipt_kb_required_plugins() {
	if ( function_exists( 'tgmpa' ) ) {
		$plugins = array();

		// Easy Bootstrap shortcode
		$plugins[] = array(
			'name' => 'Bootstrap Shortcodes for WordPress',
			'slug' => 'bootstrap-3-shortcodes',
			'required' => false,
			'version' => '3.3.10',
		);

		// bbPress
		$plugins[] = array(
			'name' => 'bbPress',
			'slug' => 'bbpress',
			'required' => false,
			'version' => '2.5.5',
		);

		// Category Order and Taxonomy Terms Order
		$plugins[] = array(
			'name' => 'Category Order and Taxonomy Terms Order',
			'slug' => 'taxonomy-terms-order',
			'required' => false,
			'version' => '1.4.1',
		);

		// Post Types Order
		$plugins[] = array(
			'name' => 'Post Types Order',
			'slug' => 'post-types-order',
			'required' => false,
			'version' => '1.7.7',
		);

		// SyntaxHighlighter Evolved
		$plugins[] = array(
			'name' => 'SyntaxHighlighter Evolved',
			'slug' => 'syntaxhighlighter',
			'required' => false,
			'version' => '3.1.11',
		);


		$config = array(
			'id'           => 'ipt_kb',                 // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
		);

		tgmpa( $plugins, $config );
	}
}
endif;

/**
 * Modify the options plugin
 */
if ( ! function_exists( 'ipt_kb_theme_extended_ops' ) ) :
function ipt_kb_theme_extended_ops( $defaults ) {
	if ( ! is_array( $defaults ) ) {
		$defaults = array();
	}

	$defaults['ads'] = array(
		'below_title' => '',
		'below_authorbox' => '',
	);

	return $defaults;
}
endif;
add_filter( 'ipt_theme_op_default_settings', 'ipt_kb_theme_extended_ops' );

if ( class_exists( 'IPT_Theme_Op_Admin' ) ) :

if ( ! function_exists( 'ipt_kb_extended_admin_tabs' ) ) :
function ipt_kb_extended_admin_tabs( $tabs ) {
	$tabs[] = array(
		'id'            => 'advertisement',
		'label'         => __( '<i class="ipticm ipt-icomoon-bullhorn"></i> Advertisement', 'ipt_kb' ),
		'callback'      => 'ipt_kb_admin_advertisement',
		'scroll'        => false,
		'classes'       => array(),
		'has_inner_tab' => false,
	);
	return $tabs;
}
endif;
add_filter( 'ipt_theme_op_admin_tabs', 'ipt_kb_extended_admin_tabs', 20, 1 );

if ( ! function_exists( 'ipt_kb_admin_advertisement' ) ) :
function ipt_kb_admin_advertisement() {
	global $ipt_theme_op_settings;
	$op = $ipt_theme_op_settings['ads'];
	$ui = IPT_Theme_Op_Admin::$instance->ui;
	?>
<table class="form-table">
	<tbody>
		<tr>
			<th>
				<?php $ui->generate_label( 'ads[below_title]', __( 'Below Title Advertisement', 'ipt_thm' ) ); ?>
			</th>
			<td>
				<?php $ui->textarea( 'ads[below_title]', $op['below_title'], __( 'Disabled', 'ipt_thm' ), 'fit', 'normal', array( 'code' ) ); ?>
			</td>
			<td>
				<?php $ui->help( __( 'Enter the ad code (RAW HTML) that will be displayed below title.', 'ipt_thm' ) ); ?>
			</td>
		</tr>
		<tr>
			<th>
				<?php $ui->generate_label( 'ads[below_authorbox]', __( 'Below Authorbox Advertisement', 'ipt_thm' ) ); ?>
			</th>
			<td>
				<?php $ui->textarea( 'ads[below_authorbox]', $op['below_authorbox'], __( 'Disabled', 'ipt_thm' ), 'fit', 'normal', array( 'code' ) ); ?>
			</td>
			<td>
				<?php $ui->help( __( 'Enter the ad code (RAW HTML) that will be displayed beside the authorbox.', 'ipt_thm' ) ); ?>
			</td>
		</tr>
	</tbody>
</table>
	<?php
}
endif;

endif;

if ( ! function_exists( 'ipt_kb_theme_ops_tabs' ) ) :
function ipt_kb_theme_ops_tabs( $tabs ) {
	$new_tabs = array();
	foreach ( $tabs as $tab ) {
		if ( in_array( $tab['id'], array( 'ipt_navigation', 'ipt_integration' ) ) ) {
			$new_tabs[] = $tab;
		}
	}
	return $new_tabs;
}
endif;
add_filter( 'ipt_theme_op_admin_tabs', 'ipt_kb_theme_ops_tabs' );

if ( ! function_exists( 'ipt_kb_theme_op_name' ) ) :
function ipt_kb_theme_op_name( $name ) {
	return __( 'Knowledge Base Theme', 'ipt_kb' );
}
endif;
add_filter( 'ipt_theme_op_active_theme_name', 'ipt_kb_theme_op_name' );

if ( ! function_exists( 'ipt_kb_theme_op_version' ) ) :
function ipt_kb_theme_op_version( $v ) {
	global $ipt_kb_version;
	return $ipt_kb_version;
}
endif;
add_filter( 'ipt_theme_op_active_theme_version', 'ipt_kb_theme_op_version' );

if ( ! function_exists( 'ipt_kb_op_theme_meta' ) ) :
function ipt_kb_op_theme_meta( $links ) {
	$links['documentation']['link'] = 'http://ipanelthemes.com/kb/wp-knowledge-base-theme/';
	$links['support']['link'] = 'https://wordpress.org/support/theme/wp-knowledge-base';
	return $links;
}
endif;
add_filter( 'ipt_theme_op_active_theme_meta', 'ipt_kb_op_theme_meta' );

/**
 * Include the walker class for bootstrap nav menu
 */
require get_template_directory() . '/inc/class-ipt-bootstrap-walker-nav-menu.php';

/**
 * Plug our Walker for editing the nav menu
 */
require get_template_directory() . '/inc/class-ipt-bootstrap-walker-nav-menu-edit.php';
require get_template_directory() . '/inc/ipt-kb-nav-filters.php';
// Add custom fields to menu
add_action( 'wp_setup_nav_menu_item', 'ipt_bootstrap_walker_nav_menu_edit_add_fields' );

// Save custom fields from menu
add_action( 'wp_update_nav_menu_item', 'ipt_bootstrap_walker_nav_menu_edit_update_fields', 10, 3 );

// Change the edit menu walker
add_filter( 'wp_edit_nav_menu_walker', 'ipt_bootstrap_walker_nav_menu_edit_filter', 20, 2 );
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load custom category fields
 */
require get_template_directory() . '/inc/category-fields.php';

/**
 * Load the KB Like Article Thingy
 */
require get_template_directory() . '/inc/ipt-kb-like-article.php';

/**
 * Load the Affix Widget
 */
require get_template_directory() . '/inc/class-ipt-kb-affix-widget.php';

/**
 * Load the Social Widget
 */
require get_template_directory() . '/inc/class-ipt-kb-social-widget.php';

/**
 * Load the Knowledge Base Widget
 */
require get_template_directory() . '/inc/class-ipt-kb-knowledgebase-widget.php';

/**
 * Load the Popular Articles Widget
 */
require get_template_directory() . '/inc/class-ipt-kb-popular-widget.php';

/**
 * Load the bbPress functions
 */
if ( function_exists( 'bbpress' ) ) {
	require get_template_directory() . '/inc/bbpress.php';
}
