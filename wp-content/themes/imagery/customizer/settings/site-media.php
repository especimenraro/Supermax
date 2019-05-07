<?php
/**
 * @package Imagery
 */
function imagery_customizer_header( $options ) {
	/**
	 *	Add Panel.
	 *---------------------------------------------------------*/
	$options[] = array(
		  	'slug'        => 'header_panel',
			'opt_type'    => 'panel',
			'name'        => esc_html__( 'Site Header', 'imagery' ),
			'description' => esc_html__( 'You can configure options to show media content in the header.', 'imagery' ),
			'priority'    => 60
	);

	/**
	 *	Add Section.
	 *--------------------------------------------------------------*/
	# Header Options.
	$options[] = array(
		  'slug'        => 'section_header',
		  'opt_type'    => 'section',
		  'name'        => esc_html__( 'Header Options', 'imagery' ),
		  'description' => esc_html__( 'Additional settings for the display of header media.', 'imagery' ),
		  'panel'       => 'header_panel',
	);

	/**
	 *	Add Options.
	 *--------------------------------------------------------------*/

	# Show only on.
	$post_settings = array(
		  'header_frontpage_only'      => esc_html__( 'Show on front page only', 'imagery' ),
	);
	foreach( $post_settings as $key => $name ) {
		$options[] = array(
			  'slug'        => $key,
			  'opt_type'    => 'checkbox',
			  'name'        => $name,
			  'description' => esc_html__( 'Check the box if you want a header media content to show on the front page only.', 'imagery' ),
			  'default'     => 0,
			  'section'     => 'section_header',
			  'priority' => 10
		);
	}
	
	# Display position.
	$options[] = array(
		  'slug'        => 'header_position',
		  'opt_type'    => 'radio',
		  'section'     => 'section_header',
		  'default'     => 'after-menu',
		  'name'        => esc_html__( 'Where to show?', 'imagery' ),
		  'choices'     => array(
			  'before-menu'      => esc_html__( 'Above the main menu', 'imagery' ),
			  'after-menu'       => esc_html__( 'Under the main menu', 'imagery' ),
		)
	);
	
	# Display only.
	$options[] = array(
		  'slug'        => 'header_display',
		  'opt_type'    => 'radio',
		  'section'     => 'section_header',
		  'default'     => 'header-box',
		  'name'        => esc_html__( 'The way to show', 'imagery' ),
		  'choices'     => array(
			  'header-wide'      => esc_html__( 'Wide', 'imagery' ),
			  'header-box'       => esc_html__( 'Boxed', 'imagery' ),
		)
	);

	return $options;
}
add_filter( 'imagery_settings_input', 'imagery_customizer_header' );