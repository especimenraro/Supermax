<?php
/**
 * @package Imagery
 */
function imagery_customizer_menu_bar( $options ) {
	/**
	 *	Add section.
	 *--------------------------------------------------------------*/
	$options[] = array(
		  'slug'        => 'menu_bar',
		  'opt_type'    => 'section',
		  'name'        => esc_html__( 'Menu Bar', 'imagery' ),
		  'priority'    => 101,
	);

	/**
	 *	Options.
	 *--------------------------------------------------------------*/
	# Search icon.
	$options[] = array(
		  'slug'        => 'search_display',
		  'opt_type'    => 'toogle_switch',
		  'name'        => esc_html__( 'Add search icon', 'imagery' ),
		  'default'     => 0,
		  'section'     => 'menu_bar',
		  'transport'   => 'refresh',
	);

	return $options;
}
add_filter( 'imagery_settings_input', 'imagery_customizer_menu_bar' );