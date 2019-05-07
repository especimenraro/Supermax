<?php
/**
 * @package Imagery
 */

function imagery_customizer_site_title( $options ) {
	/**
	 *	Add Options.
	 *--------------------------------------------------------------*/
	 
	# Logo Image Height.
	$options[] = array(
		  'slug'        => 'logo_image_size',
		  'opt_type'    => 'slider_control',
		  'name'        => esc_html__( 'Logo Image Size', 'imagery' ),
		  'input_attrs' => array(
					'min' => 25,
					'max' => 200,
					'step' => 5,
					),
		  'default'     => '',
		  'section'     => 'title_tagline',
		  'priority' => 9,
		  'transport'   => 'refresh',
		  'js_mod'      => 'css_output',
		  'css_output'  => array( array( 'class' => 'img.custom-logo', 'style' => 'max-height', 'mix' => 'px' ) ),
	);	 
	 
	# Disable Title.
	$post_settings = array(
		  'site_title_hide'      => esc_html__( 'Hide Site Title', 'imagery' ),
	);
	foreach( $post_settings as $key => $name ) {
		$options[] = array(
			  'slug'        => $key,
			  'opt_type'    => 'checkbox',
			  'name'        => $name,
			  // 'description'        => esc_html__( 'If there is no logo, display the Site Title on the Menu Bar.', 'imagery' ),
			  'default'     => 0,
			  'section'     => 'title_tagline',
			  'priority' => 10
		);
	}
	# Disable Tagline.
	$post_settings = array(
		  'site_tagline_hide'      => esc_html__( 'Hide Tagline', 'imagery' ),
	);
	foreach( $post_settings as $key => $name ) {
		$options[] = array(
			  'slug'        => $key,
			  'opt_type'    => 'checkbox',
			  'name'        => $name,
			  // 'description'        => esc_html__( 'If there is no logo, display the Tagline on the Menu Bar.', 'imagery' ),
			  'default'     => 0,
			  'section'     => 'title_tagline',
			  'priority' => 20
		);
	}

	return $options;
}
add_filter( 'imagery_settings_input', 'imagery_customizer_site_title' );