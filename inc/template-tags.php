<?php
/**
 * Template helpers.
 *
 * @package Northfield_Home_Health
 */

defined( 'ABSPATH' ) || exit;

/**
 * Default site structure (matches the original site's URLs).
 * Used for menu fallbacks and homepage links before menus/pages exist.
 *
 * @return array
 */
function nhh_default_nav() {
	return array(
		array( 'Home', '' ),
		array(
			'About Us',
			'home-health-care-about-us',
			array(
				array( 'Mission Statement', 'home-health-care-about-us/mission-statement' ),
				array( 'Core Values', 'home-health-care-about-us/core-values' ),
				array( 'Quality of Service', 'home-health-care-about-us/quality-of-service' ),
				array( 'Testimonials', 'home-health-care-about-us/testimonials' ),
				array( 'Meet Our Staff', 'home-health-care-meet-our-staff' ),
				array( 'Insurance Accepted', 'home-health-care-insurance-accepted' ),
			),
		),
		array(
			'Services',
			'home-health-care-services',
			array(
				array( 'Medical Services', 'home-health-care-services/medical-services' ),
				array( 'Non Medical Services', 'home-health-care-services/non-medical-services' ),
				array( 'Specialty Programs', 'home-health-care-services/specialty-programs' ),
			),
		),
		array( 'Careers', 'home-health-care-careers' ),
		array( 'Resources', 'home-health-care-resources' ),
		array( 'Contact Us', 'home-health-care-contact-us' ),
	);
}

/**
 * URL for a page by path, falling back to a pretty URL.
 *
 * @param string $path Page path (e.g. "home-health-care-services/medical-services").
 * @return string
 */
function nhh_page_url( $path ) {
	if ( '' === $path ) {
		return home_url( '/' );
	}
	$page = get_page_by_path( $path );
	if ( $page ) {
		return get_permalink( $page );
	}
	return home_url( '/' . trailingslashit( $path ) );
}

/**
 * Digits-only telephone link.
 *
 * @param string $number Phone number.
 * @return string
 */
function nhh_tel( $number ) {
	return 'tel:' . preg_replace( '/[^0-9+]/', '', $number );
}

/**
 * Theme image URL.
 *
 * @param string $file File relative to /images.
 * @return string
 */
function nhh_img( $file ) {
	return NHH_URI . '/images/' . ltrim( $file, '/' );
}

/**
 * Generic logo: inline SVG mark (house + heart) with the company name as text.
 *
 * @param string $variant "header" or "footer" (white).
 */
function nhh_logo_markup( $variant = 'header' ) {
	$name    = nhh_option( 'logo_name' );
	$tagline = nhh_option( 'logo_tagline' );
	printf(
		'<a href="%1$s" class="site-logo site-logo--%2$s" rel="home"><svg class="site-logo__mark" viewBox="0 0 64 60" aria-hidden="true" focusable="false"><path d="M6 30 32 7l26 23" fill="none" stroke="currentColor" stroke-width="5.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M13 27v26a3 3 0 0 0 3 3h32a3 3 0 0 0 3-3V27" fill="none" stroke="currentColor" stroke-width="5.5" stroke-linejoin="round"/><path class="site-logo__heart" d="M32 49s-11-6.6-11-14c0-4 3-6.8 6.4-6.8 2 0 3.6.9 4.6 2.4 1-1.5 2.6-2.4 4.6-2.4 3.4 0 6.4 2.8 6.4 6.8 0 7.4-11 14-11 14Z"/></svg><span class="site-logo__text"><span class="site-logo__name">%3$s</span><span class="site-logo__tag">%4$s</span></span><span class="screen-reader-text">%5$s</span></a>',
		esc_url( home_url( '/' ) ),
		esc_attr( $variant ),
		esc_html( $name ),
		esc_html( $tagline ),
		esc_html( get_bloginfo( 'name' ) )
	);
}

/**
 * Site logo (custom logo or the generic text logo).
 */
function nhh_logo() {
	if ( has_custom_logo() ) {
		the_custom_logo();
		return;
	}
	nhh_logo_markup( 'header' );
}

/**
 * Primary menu fallback (before a menu is assigned).
 */
function nhh_primary_menu_fallback() {
	echo '<ul id="primary-menu" class="menu">';
	foreach ( nhh_default_nav() as $item ) {
		$has_kids = ! empty( $item[2] );
		$current  = untrailingslashit( nhh_page_url( $item[1] ) ) === untrailingslashit( home_url( add_query_arg( array() ) ) );
		printf(
			'<li class="menu-item%1$s%2$s"><a href="%3$s">%4$s%5$s</a>',
			$has_kids ? ' menu-item-has-children' : '',
			$current ? ' current-menu-item' : '',
			esc_url( nhh_page_url( $item[1] ) ),
			esc_html( $item[0] ),
			$has_kids ? '<span class="submenu-caret" aria-hidden="true"></span>' : ''
		);
		if ( $has_kids ) {
			echo '<ul class="sub-menu">';
			foreach ( $item[2] as $child ) {
				printf( '<li class="menu-item"><a href="%1$s">%2$s</a></li>', esc_url( nhh_page_url( $child[1] ) ), esc_html( $child[0] ) );
			}
			echo '</ul>';
		}
		echo '</li>';
	}
	echo '</ul>';
}

/**
 * Footer menu fallback (top-level items only).
 */
function nhh_footer_menu_fallback() {
	echo '<ul class="menu">';
	foreach ( nhh_default_nav() as $item ) {
		printf( '<li class="menu-item"><a href="%1$s">%2$s</a></li>', esc_url( nhh_page_url( $item[1] ) ), esc_html( $item[0] ) );
	}
	echo '</ul>';
}

/**
 * Homepage hero slide URLs (Customizer overrides, else bundled images).
 *
 * @return array
 */
function nhh_hero_slides() {
	$alts   = array( 'smiling nurse talking with an elderly woman', 'caregiver helping an elderly couple with a colouring activity', 'smiling elderly woman at home' );
	$slides = array();
	for ( $i = 1; $i <= 3; $i++ ) {
		$custom   = nhh_option( 'hero_slide_' . $i );
		$slides[] = array(
			'src' => $custom ? $custom : nhh_img( 'slider/' . $i . '.jpg' ),
			'alt' => $alts[ $i - 1 ],
		);
	}
	return $slides;
}

/**
 * Simple breadcrumbs: Home » Ancestors » Current.
 */
function nhh_breadcrumbs() {
	if ( is_front_page() ) {
		return;
	}
	$sep   = ' <span class="sep">&raquo;</span> ';
	$crumbs = array( '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'northfield-home-health' ) . '</a>' );

	if ( is_page() ) {
		foreach ( array_reverse( get_post_ancestors( get_the_ID() ) ) as $ancestor ) {
			$crumbs[] = '<a href="' . esc_url( get_permalink( $ancestor ) ) . '">' . esc_html( get_the_title( $ancestor ) ) . '</a>';
		}
		$crumbs[] = '<span class="breadcrumb_last" aria-current="page">' . esc_html( get_the_title() ) . '</span>';
	} elseif ( is_singular() ) {
		$cats = get_the_category();
		if ( $cats ) {
			$crumbs[] = '<a href="' . esc_url( get_category_link( $cats[0] ) ) . '">' . esc_html( $cats[0]->name ) . '</a>';
		}
		$crumbs[] = '<span class="breadcrumb_last" aria-current="page">' . esc_html( get_the_title() ) . '</span>';
	} else {
		$crumbs[] = '<span class="breadcrumb_last" aria-current="page">' . esc_html( nhh_archive_title() ) . '</span>';
	}

	echo '<nav class="breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumb', 'northfield-home-health' ) . '"><p>' . implode( $sep, $crumbs ) . '</p></nav>'; // phpcs:ignore WordPress.Security.EscapeOutput -- escaped above.
}

/**
 * Title for the inner-page banner.
 *
 * @return string
 */
function nhh_archive_title() {
	if ( is_home() ) {
		$blog = get_option( 'page_for_posts' );
		return $blog ? get_the_title( $blog ) : __( 'News', 'northfield-home-health' );
	}
	if ( is_search() ) {
		/* translators: %s: search query */
		return sprintf( __( 'Search: %s', 'northfield-home-health' ), get_search_query() );
	}
	if ( is_404() ) {
		return __( 'Page Not Found', 'northfield-home-health' );
	}
	if ( is_archive() ) {
		return wp_strip_all_tags( get_the_archive_title() );
	}
	return get_the_title();
}

/**
 * Inner page banner image URL (featured image, else parent's, else default).
 *
 * @return string
 */
function nhh_banner_image() {
	if ( is_singular() ) {
		$id = get_queried_object_id();
		if ( has_post_thumbnail( $id ) ) {
			return get_the_post_thumbnail_url( $id, 'nhh-banner' );
		}
		foreach ( get_post_ancestors( $id ) as $ancestor ) {
			if ( has_post_thumbnail( $ancestor ) ) {
				return get_the_post_thumbnail_url( $ancestor, 'nhh-banner' );
			}
		}
	}
	return nhh_img( 'inner-banner.jpg' );
}
