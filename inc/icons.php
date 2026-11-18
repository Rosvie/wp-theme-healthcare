<?php
/**
 * Inline SVG icon set.
 *
 * @package Northfield_Home_Health
 */

defined( 'ABSPATH' ) || exit;

/**
 * Return an inline SVG icon.
 *
 * @param string $name  Icon name.
 * @param string $class Extra CSS class.
 * @return string
 */
function nhh_icon( $name, $class = '' ) {
	$icons = array(
		'arrow'    => '<svg viewBox="0 0 16 10" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M1 5h13M10 1l4 4-4 4"/></svg>',
		'envelope' => '<svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"><path d="M6 18 24 6l18 12v22a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2Z"/><path d="M6 18l18 13 18-13"/><path d="M6 40l14-11M42 40 28 29"/><path d="M13 22V12h22v10" /><path d="M24 13.5c-1.4-2-5-1.4-5 1.4 0 2.4 5 5.6 5 5.6s5-3.2 5-5.6c0-2.8-3.6-3.4-5-1.4Z"/></svg>',
		'map'      => '<svg viewBox="0 0 48 56" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"><path d="M4 18l12-5 16 6 12-5v36l-12 5-16-6-12 5Z"/><path d="M16 13v36M32 19v36"/><path d="M24 4c-4.4 0-8 3.4-8 7.8C16 18 24 26 24 26s8-8 8-14.2C32 7.4 28.4 4 24 4Z" fill="#0b356a"/><circle cx="24" cy="12" r="3"/></svg>',
		'calendar' => '<svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linejoin="round"><rect x="6" y="10" width="46" height="42" rx="4"/><path d="M6 22h46M16 5v10M26 5v10M36 5v10M46 5v10"/><path d="M14 30h6M24 30h6M34 30h6M14 38h6M24 38h6M14 46h6"/><circle cx="48" cy="48" r="11" fill="#fff"/><path d="M48 42v6l4 3"/></svg>',
		'hands'    => '<svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M32 22c-2-3.6-8-3-8 1.6 0 4 8 9.4 8 9.4s8-5.4 8-9.4c0-4.6-6-5.2-8-1.6Z"/><path d="M32 6l13 5v9c0 2.4-.6 4.6-1.6 6.6M32 6l-13 5v9c0 2.4.6 4.6 1.6 6.6"/><path d="M6 34l8 4 8 10c1.6 2 4.4 2.2 6.2.6M14 38l6-2c2-.6 4 .6 4.6 2.4L26 44"/><path d="M58 34l-8 4-8 10c-1.6 2-4.4 2.2-6.2.6M50 38l-6-2c-2-.6-4 .6-4.6 2.4L38 44"/><path d="M4 52l8-6M60 52l-8-6"/></svg>',
		'users'    => '<svg viewBox="0 0 64 48" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linejoin="round"><circle cx="32" cy="14" r="8"/><path d="M18 44c0-9 6.3-15 14-15s14 6 14 15Z"/><circle cx="13" cy="18" r="6"/><path d="M2 42c0-7 4.5-11 11-11 2.4 0 4.6.6 6.4 1.8"/><circle cx="51" cy="18" r="6"/><path d="M62 42c0-7-4.5-11-11-11-2.4 0-4.6.6-6.4 1.8"/></svg>',
		'heart'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linejoin="round"><path d="M12 20s-8-5-8-10.4C4 6.5 6.4 4.4 9 4.4c1.4 0 2.4.6 3 1.6.6-1 1.6-1.6 3-1.6 2.6 0 5 2.1 5 5.2C20 15 12 20 12 20Z"/></svg>',
		'facebook' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M13.5 21v-7.6h2.6l.4-3h-3V8.5c0-.9.3-1.5 1.5-1.5H16.6V4.3c-.3 0-1.2-.1-2.3-.1-2.3 0-3.8 1.4-3.8 3.9v2.3H8v3h2.5V21Z"/></svg>',
		'linkedin' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M6.9 8.8H4V19h2.9ZM5.4 4.2a1.7 1.7 0 1 0 0 3.4 1.7 1.7 0 0 0 0-3.4ZM20 13.3c0-2.8-.6-4.8-3.8-4.8-1.6 0-2.6.8-3 1.6h-.1V8.8h-2.8V19h2.9v-5c0-1.3.3-2.6 1.9-2.6s1.6 1.5 1.6 2.7V19H20Z"/></svg>',
		'chevron'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M6 15l6-6 6 6"/></svg>',
	);

	if ( ! isset( $icons[ $name ] ) ) {
		return '';
	}

	$svg = $icons[ $name ];
	return str_replace( '<svg ', '<svg class="icon icon-' . esc_attr( $name ) . ( $class ? ' ' . esc_attr( $class ) : '' ) . '" aria-hidden="true" focusable="false" ', $svg );
}

/**
 * Allowed tags for echoing icons through wp_kses.
 */
function nhh_svg_kses() {
	$common = array(
		'fill'            => true,
		'stroke'          => true,
		'stroke-width'    => true,
		'stroke-linecap'  => true,
		'stroke-linejoin' => true,
		'd'               => true,
	);
	return array(
		'svg'    => array(
			'class'       => true,
			'viewbox'     => true,
			'fill'        => true,
			'stroke'      => true,
			'stroke-width' => true,
			'stroke-linecap' => true,
			'stroke-linejoin' => true,
			'aria-hidden' => true,
			'focusable'   => true,
		),
		'path'   => $common,
		'circle' => $common + array( 'cx' => true, 'cy' => true, 'r' => true ),
		'rect'   => $common + array( 'x' => true, 'y' => true, 'width' => true, 'height' => true, 'rx' => true ),
	);
}

/**
 * Echo an icon.
 *
 * @param string $name  Icon name.
 * @param string $class Extra CSS class.
 */
function nhh_the_icon( $name, $class = '' ) {
	echo wp_kses( nhh_icon( $name, $class ), nhh_svg_kses() );
}
