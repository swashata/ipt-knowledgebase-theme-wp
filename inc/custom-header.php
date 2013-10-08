<?php
/**
 * Implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * @package iPanelThemes Knowledgebase
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * @uses ipt_kb_header_style()
 * @uses ipt_kb_admin_header_style()
 * @uses ipt_kb_admin_header_image()
 *
 * @package iPanelThemes Knowledgebase
 */
function ipt_kb_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'ipt_kb_custom_header_args', array(
		'default-image'          => get_template_directory_uri() . '/logo.png',
		'default-text-color'     => '777',
		'width'                  => 200,
		'height'                 => 50,
		'flex-height'            => false,
		'flex-width'             => false,
		'header-text'            => false,
		'admin-head-callback'    => 'ipt_kb_admin_header_style',
		'admin-preview-callback' => 'ipt_kb_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'ipt_kb_custom_header_setup' );

if ( ! function_exists( 'ipt_kb_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see ipt_kb_custom_header_setup().
 */
function ipt_kb_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		#headimg h1 {
			font-size: 18px;
		}
		#headimg h1 a {
			color: #777;
		}
		#headimg img {
			border: 0 none;
		}
	</style>
<?php
}
endif; // ipt_kb_admin_header_style

if ( ! function_exists( 'ipt_kb_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see ipt_kb_custom_header_setup().
 */
function ipt_kb_admin_header_image() {
?>
	<div id="headimg">
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php else : ?>
		<h1 class="displaying-header-text"><a id="name" onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<?php endif; ?>
	</div>
<?php
}
endif; // ipt_kb_admin_header_image
