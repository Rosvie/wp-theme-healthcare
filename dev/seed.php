<?php
/**
 * Demo content loader (run with: wp eval-file .../dev/seed.php).
 * Creates the pages, menus and settings shown in the screenshots. Safe to re-run:
 * existing pages are updated in place.
 *
 * @package Northfield_Home_Health
 */

if ( ! defined( 'WP_CLI' ) ) {
	exit;
}

$content_dir = __DIR__ . '/content/';

// path => array( title, menu_order ). Parents are inferred from the path.
$pages = array(
	'home'                                         => array( 'Home', 0 ),
	'home-health-care-about-us'                    => array( 'About Us', 1 ),
	'home-health-care-about-us/mission-statement'  => array( 'Mission Statement', 1 ),
	'home-health-care-about-us/core-values'        => array( 'Core Values', 2 ),
	'home-health-care-about-us/quality-of-service' => array( 'Quality of Service', 3 ),
	'home-health-care-about-us/testimonials'       => array( 'Testimonials', 4 ),
	'home-health-care-meet-our-staff'              => array( 'Meet Our Staff', 2 ),
	'home-health-care-insurance-accepted'          => array( 'Insurance Accepted', 3 ),
	'home-health-care-services'                    => array( 'Services', 4 ),
	'home-health-care-services/medical-services'   => array( 'Medical Services', 1 ),
	'home-health-care-services/non-medical-services' => array( 'Non Medical Services', 2 ),
	'home-health-care-services/specialty-programs' => array( 'Specialty Programs', 3 ),
	'home-health-care-careers'                     => array( 'Careers', 5 ),
	'home-health-care-resources'                   => array( 'Resources', 6 ),
	'home-health-care-contact-us'                  => array( 'Contact Us', 7 ),
	'home-health-care-set-an-appointment'          => array( 'Set an Appointment', 8 ),
	'home-health-care-send-your-referrals'         => array( 'Send Your Referrals', 9 ),
	'privacy-policy'                               => array( 'Privacy Policy', 10 ),
);

$ids = array();
foreach ( $pages as $path => $page ) {
	list( $title, $order ) = $page;
	$file    = $content_dir . str_replace( '/', '__', $path ) . '.html';
	$content = file_exists( $file ) ? file_get_contents( $file ) : ''; // phpcs:ignore WordPress.WP.AlternativeFunctions
	$parts   = explode( '/', $path );
	$slug    = array_pop( $parts );
	$parent  = $parts ? $ids[ implode( '/', $parts ) ] : 0;

	$data = array(
		'post_type'    => 'page',
		'post_status'  => 'publish',
		'post_title'   => $title,
		'post_name'    => $slug,
		'post_content' => $content,
		'post_parent'  => $parent,
		'menu_order'   => $order,
	);

	$existing = get_page_by_path( $path );
	if ( $existing ) {
		$data['ID'] = $existing->ID;
		wp_update_post( $data );
		$ids[ $path ] = $existing->ID;
	} else {
		$ids[ $path ] = wp_insert_post( $data );
	}
}

// Banner (featured) images. Child pages inherit their parent's banner.
require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

$banners = array(
	'about'     => array( 'home-health-care-about-us' ),
	'staff'     => array( 'home-health-care-meet-our-staff', 'home-health-care-insurance-accepted' ),
	'services'  => array( 'home-health-care-services' ),
	'careers'   => array( 'home-health-care-careers' ),
	'contact'   => array( 'home-health-care-contact-us', 'home-health-care-set-an-appointment', 'home-health-care-send-your-referrals' ),
	'resources' => array( 'home-health-care-resources' ),
);
foreach ( $banners as $key => $paths ) {
	$existing = get_posts(
		array(
			'post_type'   => 'attachment',
			'post_status' => 'inherit',
			'meta_key'    => '_nhh_demo_image', // phpcs:ignore WordPress.DB.SlowDBQuery
			'meta_value'  => $key, // phpcs:ignore WordPress.DB.SlowDBQuery
			'numberposts' => 1,
			'fields'      => 'ids',
		)
	);
	$attachment_id = $existing ? $existing[0] : 0;

	if ( ! $attachment_id ) {
		$source = __DIR__ . '/demo-images/' . $key . '.jpg';
		if ( ! file_exists( $source ) ) {
			continue;
		}
		$tmp = wp_tempnam( $key . '.jpg' );
		copy( $source, $tmp );
		$attachment_id = media_handle_sideload( array( 'name' => 'banner-' . $key . '.jpg', 'tmp_name' => $tmp ), 0 );
		if ( is_wp_error( $attachment_id ) ) {
			WP_CLI::warning( "Banner {$key}: " . $attachment_id->get_error_message() );
			continue;
		}
		update_post_meta( $attachment_id, '_nhh_demo_image', $key );
	}

	foreach ( $paths as $path ) {
		set_post_thumbnail( $ids[ $path ], $attachment_id );
	}
}

// Reading & privacy settings.
update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $ids['home'] );
update_option( 'wp_page_for_privacy_policy', $ids['privacy-policy'] );
update_option( 'blogname', 'Northfield Home Health Services, Inc.' );
update_option( 'blogdescription', 'Compassionate Home Health Care' );

// Remove default sample content and sidebar widgets.
$sample = get_page_by_path( 'hello-world', OBJECT, 'post' );
if ( $sample ) {
	wp_delete_post( $sample->ID, true );
}
$sample = get_page_by_path( 'sample-page' );
if ( $sample ) {
	wp_delete_post( $sample->ID, true );
}
update_option( 'sidebars_widgets', array( 'wp_inactive_widgets' => array(), 'array_version' => 3 ) );

// Menus (rebuilt from scratch each run).
$add_item = function ( $menu_id, $page_id, $parent = 0 ) {
	return wp_update_nav_menu_item(
		$menu_id,
		0,
		array(
			'menu-item-object-id' => $page_id,
			'menu-item-object'    => 'page',
			'menu-item-type'      => 'post_type',
			'menu-item-status'    => 'publish',
			'menu-item-parent-id' => $parent,
		)
	);
};
$fresh_menu = function ( $name ) {
	$menu = wp_get_nav_menu_object( $name );
	if ( $menu ) {
		wp_delete_nav_menu( $menu->term_id );
	}
	return wp_create_nav_menu( $name );
};

$primary = $fresh_menu( 'Primary Menu' );
$add_item( $primary, $ids['home'] );
$about = $add_item( $primary, $ids['home-health-care-about-us'] );
foreach ( array( 'mission-statement', 'core-values', 'quality-of-service', 'testimonials' ) as $child ) {
	$add_item( $primary, $ids[ 'home-health-care-about-us/' . $child ], $about );
}
$add_item( $primary, $ids['home-health-care-meet-our-staff'], $about );
$add_item( $primary, $ids['home-health-care-insurance-accepted'], $about );
$services = $add_item( $primary, $ids['home-health-care-services'] );
foreach ( array( 'medical-services', 'non-medical-services', 'specialty-programs' ) as $child ) {
	$add_item( $primary, $ids[ 'home-health-care-services/' . $child ], $services );
}
foreach ( array( 'home-health-care-careers', 'home-health-care-resources', 'home-health-care-contact-us' ) as $path ) {
	$add_item( $primary, $ids[ $path ] );
}

$footer = $fresh_menu( 'Footer Menu' );
foreach ( array( 'home', 'home-health-care-about-us', 'home-health-care-services', 'home-health-care-careers', 'home-health-care-resources', 'home-health-care-contact-us' ) as $path ) {
	$add_item( $footer, $ids[ $path ] );
}

set_theme_mod( 'nav_menu_locations', array( 'primary' => $primary, 'footer' => $footer ) );

WP_CLI::success( sprintf( 'Demo content loaded: %d pages, 2 menus.', count( $ids ) ) );
