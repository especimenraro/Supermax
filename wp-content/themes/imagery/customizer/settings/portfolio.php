<?php
/**
 * @package Imagery
 */
function imagery_portfolio_posts( $options ) {
	/**
	 *	Add Section.
	 *--------------------------------------------------------------*/	
	$options[] = array(
		  'slug'        => 'portfolio_posts',
		  'opt_type'    => 'section',
		  'name'        => esc_html__( 'Portfolio Posts', 'imagery' ),
		  'description' => esc_html__( 'If you have enabled the portfolio plugin and you have portfolio posts, then you can set options here for displaying portfolio posts.', 'imagery' ),
		  'priority'    => 109,
	);
	
	/**
	 * Options.
	 *--------------------------------------------------------------*/

	# Title.
	$options[] = array(
		  'slug'        => 'portfolio_page_title',
		  'opt_type'    => 'text',
		  'name'        => esc_html__( 'Portfolio page Title', 'imagery' ),
		  'default'     => esc_html__( 'My Portfolio', 'imagery' ),
		  'section'     => 'portfolio_posts',
		  'transport'   => 'refresh',
	);

	# Intro text.
	$options[] = array(
		  'slug'        => 'portfolio_page_description',
		  'opt_type'    => 'textarea',
		  'name'        => esc_html__( 'Portfolio page Description', 'imagery' ),
		  'default'     => '',
		  'section'     => 'portfolio_posts',
		  'transport'   => 'refresh',
	);
	
	# Portfolio grid.
	$options[] = array(
		  'slug'        => 'portfolio_posts_columns',
		  'opt_type'    => 'radio',
		  'section'     => 'portfolio_posts',
		  'default'     => 'two',
		  'name'        => esc_html__( 'Grid Columns', 'imagery' ),
		  'choices'     => array(
			  'two'           => esc_html__( '2 Columns', 'imagery' ),
			  'three'       => esc_html__( '3 Columns', 'imagery' ),
		)
	);
	
	# Preview Titles.
	$options[] = array(
		  'slug'        => 'portfolio_preview_titles',
		  'opt_type'    => 'text_radio_button',
		  'choices'		=> array(
							'display' => esc_html__( 'Yes', 'imagery' ),
							'hidden' => esc_html__( 'No', 'imagery' )
						),
		  'name'        => esc_html__( 'Show titles of posts preview', 'imagery' ),
		  'default'     => 'hidden',
		  'section'     => 'portfolio_posts',
		  'transport'   => 'refresh',
		  'sanitize_cb' => 'imagery_text_sanitization',
	);
	
	return $options;
}
add_filter( 'imagery_settings_input', 'imagery_portfolio_posts' );