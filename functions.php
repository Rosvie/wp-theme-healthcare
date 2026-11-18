<?php
/**
 * Northfield Home Health theme functions.
 *
 * @package Northfield_Home_Health
 */

defined( 'ABSPATH' ) || exit;

define( 'NHH_VERSION', '1.0.0' );
define( 'NHH_DIR', get_template_directory() );
define( 'NHH_URI', get_template_directory_uri() );

require NHH_DIR . '/inc/icons.php';
require NHH_DIR . '/inc/template-tags.php';
require NHH_DIR . '/inc/customizer.php';
require NHH_DIR . '/inc/contact-form.php';

/**
 * Theme setup.
 */
function nhh_setup() {
	load_theme_textdomain( 'northfield-home-health', NHH_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 90,
			'width'       => 349,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);
	add_theme_support( 'editor-styles' );
	add_editor_style( array( nhh_fonts_url(), 'assets/editor-style.css' ) );

	add_image_size( 'nhh-banner', 1920, 600, true );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'northfield-home-health' ),
			'footer'  => __( 'Footer Menu', 'northfield-home-health' ),
		)
	);
}
add_action( 'after_setup_theme', 'nhh_setup' );

/**
 * Content width.
 */
function nhh_content_width() {
	$GLOBALS['content_width'] = 1100;
}
add_action( 'after_setup_theme', 'nhh_content_width', 0 );

/**
 * Google Fonts URL (Poppins + Roboto Slab, as on the original site).
 */
function nhh_fonts_url() {
	return 'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto+Slab:wght@400;500;600;700&display=swap';
}

/**
 * Enqueue front-end assets.
 */
function nhh_assets() {
	wp_enqueue_style( 'nhh-fonts', nhh_fonts_url(), array(), null );
	wp_enqueue_style( 'nhh-style', NHH_URI . '/css/style.css', array( 'nhh-fonts' ), NHH_VERSION );
	wp_enqueue_style( 'nhh-media', NHH_URI . '/css/media.css', array( 'nhh-style' ), NHH_VERSION );
	wp_enqueue_script( 'nhh-theme', NHH_URI . '/js/theme.js', array(), NHH_VERSION, array( 'strategy' => 'defer', 'in_footer' => true ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'nhh_assets' );

/**
 * Preconnect to Google Fonts.
 */
function nhh_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array( 'href' => 'https://fonts.googleapis.com' );
		$urls[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'nhh_resource_hints', 10, 2 );

/**
 * Widget areas (footer extras, page sidebar).
 */
function nhh_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Page Sidebar', 'northfield-home-health' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Shown beside content on inner pages when it has widgets.', 'northfield-home-health' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'nhh_widgets_init' );

/**
 * Add a dropdown toggle marker to menu items with children.
 */
function nhh_nav_menu_item_title( $title, $item, $args, $depth ) {
	if ( isset( $args->theme_location ) && 'primary' === $args->theme_location && 0 === $depth && in_array( 'menu-item-has-children', (array) $item->classes, true ) ) {
		$title .= '<span class="submenu-caret" aria-hidden="true"></span>';
	}
	return $title;
}
add_filter( 'nav_menu_item_title', 'nhh_nav_menu_item_title', 10, 4 );

/**
 * Body classes.
 */
function nhh_body_classes( $classes ) {
	if ( ! is_front_page() ) {
		$classes[] = 'inner-page';
	}
	return $classes;
}
add_filter( 'body_class', 'nhh_body_classes' );

/**
 * Shorter excerpts.
 */
add_filter(
	'excerpt_length',
	function () {
		return 30;
	}
);

/**
 * Flag JS support early so scroll-reveal elements start hidden without a flash.
 */
function nhh_js_class() {
	echo "<script>document.documentElement.classList.add('js');</script>\n";
}
add_action( 'wp_head', 'nhh_js_class', 0 );
