<?php
/**
 * iPanelThemes Knowledgebase functions and definitions
 *
 * @package iPanelThemes Knowledgebase
 */

/**
 * Set the version
 */
global $ipt_kb_version;
$ipt_kb_version = '1.6.0';

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

	add_image_size( 'ipt_kb_medium', 256, 128, true );
	add_image_size( 'ipt_kb_large', 9999, 200, true );

	// Add HTML5
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form' ) );
}
endif; // ipt_kb_setup
add_action( 'after_setup_theme', 'ipt_kb_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
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
add_action( 'widgets_init', 'ipt_kb_widgets_init' );

/**
 * Fix for empty widget title
 *
 * As we are using panels
 */
function ipt_kb_widget_title_filter( $title = '' ) {
	if ( $title == '' ) {
		return ' ';
	}
	return $title;
}
add_filter( 'widget_title', 'ipt_kb_widget_title_filter' );

/**
 * Enqueue scripts and styles
 */
function ipt_kb_scripts() {
	global $ipt_kb_version;

	// Fonts from Google Webfonts
	wp_enqueue_style( 'ipt_kb-fonts', '//fonts.googleapis.com/css?family=Oswald|Roboto:400,400italic,700,700italic', array(), $ipt_kb_version );

	// Main stylesheet
	wp_enqueue_style( 'ipt_kb-style', get_stylesheet_uri(), array(), $ipt_kb_version );

	// Bootstrap
	wp_enqueue_style( 'ipt_kb-bootstrap', get_stylesheet_directory_uri() . '/lib/bootstrap/css/bootstrap.min.css', array(), $ipt_kb_version );
	wp_enqueue_style( 'ipt_kb-bootstrap-theme', get_stylesheet_directory_uri() . '/lib/bootstrap/css/bootstrap-theme.min.css', array(), $ipt_kb_version );

	// Icomoon
	wp_enqueue_style( 'ipt_kb-icomoon', get_stylesheet_directory_uri() . '/lib/icomoon/style.css', array(), $ipt_kb_version );

	// Now the JS
	wp_enqueue_script( 'ipt_kb-bootstrap', get_stylesheet_directory_uri() . '/lib/bootstrap/js/bootstrap.min.js', array( 'jquery' ), $ipt_kb_version );
	wp_enqueue_script( 'ipt_kb-bootstrap-jq', get_stylesheet_directory_uri() . '/lib/bootstrap/js/jquery.ipt-kb-bootstrap.js', array( 'jquery' ), $ipt_kb_version );

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
function ipt_kb_comment_reply_filter( $comment_reply_link, $post = null ) {
	$new = preg_replace( '/<a(.*?)class=\'(.*?)\'/', '<a$1class=\'$2 btn btn-info btn-sm\'', $comment_reply_link );
	return $new;
}
add_filter( 'comment_reply_link', 'ipt_kb_comment_reply_filter', 10, 2 );
/**
 * Add filter to cancel comment reply link to convert into bootstrap button
 * @param  string $comment_reply_link default comment reply link
 * @param  stdObj $post               $post
 * @return string                     new reply link
 */
function ipt_kb_cancel_comment_reply_filter( $cancel_comment_reply_link, $post = null ) {
	$new = str_replace( '<a', '<a class="btn btn-danger btn-sm"', $cancel_comment_reply_link );
	return $new;
}
add_filter( 'cancel_comment_reply_link', 'ipt_kb_cancel_comment_reply_filter', 10, 2 );

/**
 * Add filter to properly display wp_link_pages using bootstrap
 * @param  string $link original link html
 * @return string       Modified link html
 */
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
add_filter( 'wp_link_pages_link', 'ipt_kb_link_pages' );

/**
 * Include the walker class for bootstrap nav menu
 */
require get_template_directory() . '/inc/wp_bootstrap_navwalker.php';

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
