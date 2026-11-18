<?php
/**
 * Customizer settings: contact details, social links, hero banner.
 *
 * @package Northfield_Home_Health
 */

defined( 'ABSPATH' ) || exit;

/**
 * Default values for every theme option.
 *
 * @return array
 */
function nhh_defaults() {
	return array(
		'phone'          => '555-555-0123',
		'fax'            => '555-555-0124',
		'email'          => 'info@example.com',
		'address_1'      => '123 Main Street, Suite 200',
		'address_2'      => 'Springfield, Massachusetts 01101',
		'facebook'       => 'https://www.facebook.com/',
		'linkedin'       => 'https://www.linkedin.com/',
		'referral_label' => 'Send Your Referrals',
		'referral_url'   => 'mailto:info@example.com',
		'map_embed'      => 'https://maps.google.com/maps?q=Springfield%2C%20MA&z=13&output=embed',
		'hero_kicker'    => '"Home Is Where',
		'hero_heading'   => 'The Heart Is, and that’s where we are.”',
		'hero_text'      => 'Bringing healing to where it matters most.',
		'hero_btn_label' => 'Find Out More',
		'hero_btn_url'   => '',
		'hero_slide_1'   => '',
		'hero_slide_2'   => '',
		'hero_slide_3'   => '',
		'contact_to'     => '',
		'logo_name'      => 'Northfield',
		'logo_tagline'   => 'Home Health Services, Inc.',
	);
}

/**
 * Get a theme option with its default.
 *
 * @param string $key Option key.
 * @return string
 */
function nhh_option( $key ) {
	$defaults = nhh_defaults();
	$default  = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
	return get_theme_mod( 'nhh_' . $key, $default );
}

/**
 * Register Customizer panels, sections and controls.
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function nhh_customize_register( $wp_customize ) {
	$defaults = nhh_defaults();

	$wp_customize->add_panel(
		'nhh_panel',
		array(
			'title'    => __( 'Northfield Theme Options', 'northfield-home-health' ),
			'priority' => 30,
		)
	);

	$sections = array(
		'nhh_contact' => __( 'Contact Details', 'northfield-home-health' ),
		'nhh_social'  => __( 'Logo, Social & Header Button', 'northfield-home-health' ),
		'nhh_hero'    => __( 'Homepage Banner', 'northfield-home-health' ),
	);
	foreach ( $sections as $id => $title ) {
		$wp_customize->add_section( $id, array( 'title' => $title, 'panel' => 'nhh_panel' ) );
	}

	$fields = array(
		'logo_name'      => array( 'nhh_social', __( 'Logo name (used when no custom logo is set)', 'northfield-home-health' ), 'text', 'sanitize_text_field' ),
		'logo_tagline'   => array( 'nhh_social', __( 'Logo tagline', 'northfield-home-health' ), 'text', 'sanitize_text_field' ),
		'phone'          => array( 'nhh_contact', __( 'Phone', 'northfield-home-health' ), 'text', 'sanitize_text_field' ),
		'fax'            => array( 'nhh_contact', __( 'Fax', 'northfield-home-health' ), 'text', 'sanitize_text_field' ),
		'email'          => array( 'nhh_contact', __( 'Email', 'northfield-home-health' ), 'email', 'sanitize_email' ),
		'address_1'      => array( 'nhh_contact', __( 'Address line 1', 'northfield-home-health' ), 'text', 'sanitize_text_field' ),
		'address_2'      => array( 'nhh_contact', __( 'Address line 2', 'northfield-home-health' ), 'text', 'sanitize_text_field' ),
		'map_embed'      => array( 'nhh_contact', __( 'Google Maps embed URL', 'northfield-home-health' ), 'url', 'esc_url_raw' ),
		'contact_to'     => array( 'nhh_contact', __( 'Contact form recipient (blank = Email above)', 'northfield-home-health' ), 'email', 'sanitize_email' ),
		'facebook'       => array( 'nhh_social', __( 'Facebook URL', 'northfield-home-health' ), 'url', 'esc_url_raw' ),
		'linkedin'       => array( 'nhh_social', __( 'LinkedIn URL', 'northfield-home-health' ), 'url', 'esc_url_raw' ),
		'referral_label' => array( 'nhh_social', __( 'Header button label', 'northfield-home-health' ), 'text', 'sanitize_text_field' ),
		'referral_url'   => array( 'nhh_social', __( 'Header button link', 'northfield-home-health' ), 'text', 'nhh_sanitize_link' ),
		'hero_kicker'    => array( 'nhh_hero', __( 'Small heading', 'northfield-home-health' ), 'text', 'sanitize_text_field' ),
		'hero_heading'   => array( 'nhh_hero', __( 'Main heading', 'northfield-home-health' ), 'textarea', 'sanitize_text_field' ),
		'hero_text'      => array( 'nhh_hero', __( 'Text', 'northfield-home-health' ), 'text', 'sanitize_text_field' ),
		'hero_btn_label' => array( 'nhh_hero', __( 'Button label', 'northfield-home-health' ), 'text', 'sanitize_text_field' ),
		'hero_btn_url'   => array( 'nhh_hero', __( 'Button link (blank = About Us page)', 'northfield-home-health' ), 'text', 'nhh_sanitize_link' ),
	);

	foreach ( $fields as $key => $f ) {
		$wp_customize->add_setting(
			'nhh_' . $key,
			array(
				'default'           => $defaults[ $key ],
				'sanitize_callback' => $f[3],
			)
		);
		$wp_customize->add_control(
			'nhh_' . $key,
			array(
				'section' => $f[0],
				'label'   => $f[1],
				'type'    => $f[2],
			)
		);
	}

	for ( $i = 1; $i <= 3; $i++ ) {
		$wp_customize->add_setting(
			'nhh_hero_slide_' . $i,
			array(
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'nhh_hero_slide_' . $i,
				array(
					/* translators: %d: slide number */
					'label'   => sprintf( __( 'Slide image %d', 'northfield-home-health' ), $i ),
					'section' => 'nhh_hero',
				)
			)
		);
	}
}
add_action( 'customize_register', 'nhh_customize_register' );

/**
 * Sanitize a link that may be a URL, mailto: or tel:.
 *
 * @param string $value Raw value.
 * @return string
 */
function nhh_sanitize_link( $value ) {
	return esc_url_raw( trim( $value ), array( 'http', 'https', 'mailto', 'tel' ) );
}
