<?php
/**
 * Main functions Imagery Theme Customizer
 */

function imagery_define_constants() {
	if( ! defined( 'IMAGERY_ADMIN_DIR' ) ) {
		define( 'IMAGERY_ADMIN_DIR', trailingslashit( get_template_directory() . '/customizer' ) );
	}
	if( ! defined( 'IMAGERY_ADMIN_URI' ) ) {
		define( 'IMAGERY_ADMIN_URI', trailingslashit( get_template_directory_uri() . '/customizer/assets' ) );
	}
}
add_action( 'init', 'imagery_define_constants' );

/**
 * 	Modify default sections.
 */
function imagery_customizer_modify_sections( $wp_customize ) {
	$wp_customize->get_section( 'static_front_page' )->priority  	= 100;
	$wp_customize->get_control( 'background_color'  )->section   	= 'background_image';
	$wp_customize->get_section( 'background_image'  )->title     	= esc_html__( 'Site Background', 'imagery' );
	$wp_customize->get_section('header_image')->panel 				= 'header_panel'; // Add Panel
	$wp_customize->get_section( 'header_image'  )->title     		= esc_html__( 'Header Media', 'imagery' );
}
add_action( 'customize_register', 'imagery_customizer_modify_sections' );

/**
 * 	Register JS control types.
 */
function imagery_js_control_type( $wp_customize ) {
	$wp_customize->register_control_type( 'Imagery_Sortable_Control' );
}
add_action( 'customize_register', 'imagery_js_control_type' );

/**
 * 	Load files.
 */
function imagery_admin_files() {
	// Customizer
	require_once( IMAGERY_ADMIN_DIR . 'customizer.php' );

	// Custom Controls
	// Array of setting partials
	$control_files = array(
			'dropdown-list',
			'extra-custom-controls',
	);

	// Loop through and include setting files
	foreach ( $control_files as $file ) {
		require_once( IMAGERY_ADMIN_DIR .'/controls/'. $file .'.php' );
	}

	// Settings
	// Array of setting partials
	$setting_files = array(
			'blog',
			'colors',
			'fonts',
			'front-page',
			'menu-bar',
			'portfolio',
			'site-identity',
			'site-media',
	);

	// Loop through and include setting files
	foreach ( $setting_files as $file ) {
		require_once( IMAGERY_ADMIN_DIR .'/settings/'. $file .'.php' );
	}

	// Helper
	// Array of setting partials
	$helper_files = array(
			'extra-custom-controls',
	);

	// Loop through and include setting files
	foreach ( $helper_files as $file ) {
		require_once( IMAGERY_ADMIN_DIR .'/controls/helper/'. $file .'.php' );
	}
}
add_action( 'init', 'imagery_admin_files' );

/**
 * 	Get default values.
 */
function imagery_option_defaults( $key = 'all' ) {
	$defaults = apply_filters( 'imagery_option_defaults', array() );
	if( 'all' != $key ) {
		return isset( $defaults[$key] ) ? $defaults[$key] : NULL;
	}
	return $defaults;
}

/**
 * 	Retrieve and display value.
 * 	Replacement: get_theme_mod( $key ) - imagery( $key )
 */
function imagery( $key = '', $default = null, $echo = false ) {
	$value  = get_theme_mod( $key, $default );
	$output = ( $value != $default ) ? $value : imagery_option_defaults( $key );
	if( $echo ) {
		echo $output;
	}
	else {
		return $output;
	}
}