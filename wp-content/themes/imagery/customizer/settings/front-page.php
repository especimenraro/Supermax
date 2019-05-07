<?php
/**
 * @package Imagery
 */
function imagery_customizer_frontpage_section( $options ) {
	/**
	 *	Panel.
	 *--------------------------------------------------------------*/
	$options[] = array(
		  'slug'        => 'front_page_settings',
		  'opt_type'    => 'panel',
		  'name'        => esc_html__( 'Front Page Sections', 'imagery' ),
		  'description' => esc_html__( 'As the front page should be assigned a static page with default template.', 'imagery' ),
		  'priority'    => 102,
	);
	
	/**
	 *	Section.
	 *--------------------------------------------------------------*/
	$options[] = array(
		  'slug'        => 'sections_order',
		  'opt_type'    => 'section',
		  'name'        => esc_html__( 'Visibility & Sorting', 'imagery' ),
		  'panel'       => 'front_page_settings',
	);
	
	# Options.
	$options[] = array(
		  'slug'        => 'front_sortable',
		  'opt_type'    => 'sortable',
		  'choices'	   	=> imagery_front_elements(),
		  'name'        => esc_html__( 'Set the visibility and order of the sections.', 'imagery' ),
		  'description' => esc_html__( 'Drag and drop to sort sections of the front page. To show or hide the section by clicking on the eye icon.', 'imagery' ),
		  'default'     => array( 'page_content', 'front_blog', 'front_portfolio' ),
		  'section'     => 'sections_order',
		  'transport'   => 'refresh',
	);

	/**
	 *	Section.
	 *--------------------------------------------------------------*/
	$options[] = array(
		  'slug'        => 'section_content',
		  'opt_type'    => 'section',
		  'name'        => esc_html__( 'Page Content', 'imagery' ),
		  'panel'       => 'front_page_settings',
	);
	
	/**
	 *	Options.
	 *--------------------------------------------------------------*/
	
	# Page Header.
	$post_settings = array(
		  'hide_frontpage_header' => esc_html__( 'Hide Page Header', 'imagery' ),
	);
	foreach( $post_settings as $key => $name ) {
		$options[] = array(
			  'slug'        => $key,
			  'opt_type'    => 'checkbox',
			  'name'        => $name,
			  'default'     => 0,
			  'section'     => 'section_content',
		);
	}
	
	# Margin Bottom.
	$options[] = array(
		  'slug'        => 'page_content_margin',
		  'opt_type'    => 'slider_control',
		  'name'        => esc_html__( 'Margin bottom (px)', 'imagery' ),
		  'description' => esc_html__( 'Set the height of white space at the bottom after the section.', 'imagery' ),
		  'input_attrs' => array(
					'min' => 0,
					'max' => 310,
					'step' => 5,
					),
		  'default'     => 0,
		  'section'     => 'section_content',
		  'transport'   => 'refresh',
	);
	
	/**
	 *	Section.
	 *--------------------------------------------------------------*/
	$options[] = array(
		  'slug'        => 'section_frontpage_blog',
		  'opt_type'    => 'section',
		  'name'        => esc_html__( 'Blog Section', 'imagery' ),
		  'panel'       => 'front_page_settings',
	);
	
	/**
	 *	Options.
	 *--------------------------------------------------------------*/
	 
	# Posts Number.
	$options[] = array(
		  'slug'        => 'blog_posts_number',
		  'opt_type'    => 'number',
		  'name'        => esc_html__( 'Posts Number', 'imagery' ),
		  'input_attrs' => array(
					'min' => 0,
					'max' => 999,
					'step' => 1,
					),
		  'default'     => 6,
		  'section'     => 'section_frontpage_blog',
		  'transport'   => 'refresh',
	);
	 
	# Grid Columns.
	$options[] = array(
		  'slug'        => 'frontpage_posts_columns',
		  'opt_type'    => 'radio',
		  'section'     => 'section_frontpage_blog',
		  'default'     => 'two',
		  'name'        => esc_html__( 'Grid Columns', 'imagery' ),
		  //'description' => esc_html__( 'Applies to all post type.', 'imagery' ),
		  'choices'     => array(
			  'two'           => esc_html__( '2 Columns', 'imagery' ),
			  'three'       => esc_html__( '3 Columns', 'imagery' ),
		)
	);

	# Margin Bottom.
	$options[] = array(
		  'slug'        => 'front_blog_margin',
		  'opt_type'    => 'slider_control',
		  'name'        => esc_html__( 'Margin bottom (px)', 'imagery' ),
		  'description' => esc_html__( 'Set the height of white space at the bottom after the section.', 'imagery' ),
		  'input_attrs' => array(
					'min' => 0,
					'max' => 310,
					'step' => 5,
					),
		  'default'     => 0,
		  'section'     => 'section_frontpage_blog',
		  'transport'   => 'refresh',
	);
	
	/**
	 *	Section.
	 *--------------------------------------------------------------*/
	$options[] = array(
		  'slug'        => 'section_frontpage_portfolio',
		  'opt_type'    => 'section',
		  'name'        => esc_html__( 'Portfolio Section', 'imagery' ),
		  'description' => esc_html__( 'The use of these options requires the activation of the plugin named Portfolio Post Type by Devin Price.', 'imagery' ),
		  'panel'       => 'front_page_settings',
	);
	
	/**
	 *	Options.
	 *--------------------------------------------------------------*/
	 
	# Posts Number.
	$options[] = array(
		  'slug'        => 'portfolio_posts_number',
		  'opt_type'    => 'number',
		  'name'        => esc_html__( 'Posts Number', 'imagery' ),
		  'input_attrs' => array(
					'min' => 0,
					'max' => 999,
					'step' => 1,
					),
		  'default'     => 6,
		  'section'     => 'section_frontpage_portfolio',
		  'transport'   => 'refresh',
	);
 
	# Grid Columns.
	$options[] = array(
		  'slug'        => 'frontpage_portfolio_columns',
		  'opt_type'    => 'radio',
		  'section'     => 'section_frontpage_portfolio',
		  'default'     => 'two',
		  'name'        => esc_html__( 'Grid Columns', 'imagery' ),
		  //'description' => esc_html__( 'Applies to all post type.', 'imagery' ),
		  'choices'     => array(
			  'two'           => esc_html__( '2 Columns', 'imagery' ),
			  'three'       => esc_html__( '3 Columns', 'imagery' ),
		)
	);
	 
	# Margin Bottom.
	$options[] = array(
		  'slug'        => 'front_portfolio_margin',
		  'opt_type'    => 'slider_control',
		  'name'        => esc_html__( 'Margin bottom (px)', 'imagery' ),
		  'description' => esc_html__( 'Set the height of white space at the bottom after the section.', 'imagery' ),
		  'input_attrs' => array(
					'min' => 0,
					'max' => 310,
					'step' => 5,
					),
		  'default'     => 0,
		  'section'     => 'section_frontpage_portfolio',
		  'transport'   => 'refresh',
	);
	
	return $options;
}
add_filter( 'imagery_settings_input', 'imagery_customizer_frontpage_section' );