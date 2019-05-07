<?php
/**
 * @package Imagery
 */
function imagery_customizer_add_colors( $options ) {

	/**
	 *	Options.
	 *---------------------------------------------------------*/
	 
	# Dark Mode.
	$options[] = array(
		  'slug'        => 'dark_mode',
		  'opt_type'    => 'toogle_switch',
		  'name'        => esc_html__( 'Dark Mode', 'imagery' ),
		  'default'     => 0,
		  'section'     => 'colors',
		  'transport'   => 'refresh',
	);
	 
	# Body Color.
	$options[] = array(
		  'slug'        => 'primary_color',
		  'opt_type'    => 'color',
		  'name'        => esc_html__( 'Primary color', 'imagery' ),
		  'description' => esc_html__( 'Applies to most design elements, body text, and headings.', 'imagery' ),
		  'default'     => '#2b2b2b',
		  'section'     => 'colors',
		  'transport'   => 'postMessage',
		  'js_mod'      => 'css_output',
		  'css_output'  => array(
				array( 
					'class' => 'body, mark, label, body a, .main-navigation a, .search-icon:before, .no-thumbnail .title, .no-thumbnail .sticky-post, .infinite-scroll #infinite-handle button:hover, .infinite-scroll #infinite-handle button:focus, blockquote p, .gallery-caption, input, select, textarea, h1, h2, h3, h4, h5, h6, .page-numbers a, .page-numbers span',
					'style' => 'color'
				         ),
				array( 
					'class' => '.single-post .nav-links',
					'style' => 'border-color'
				         )
				)
	);
	
	# Accent Color.
	$options[] = array(
		  'slug'        => 'accent_color',
		  'opt_type'    => 'color',
		  'name'        => esc_html__( 'Link text color', 'imagery' ),
		  'default'     => '#2c2c2c',
		  'section'     => 'colors',
		  'transport'   => 'refresh',
		  'js_mod'      => 'css_output',
		  'css_output'  => array(
			array(
				  'class' => '.entry-content a, a.comment-reply-link, .edit-link a',
				  'style' => 'color'
			),
			array(
				  'class' => '.entry-content a',
				  'style' => 'border-color'
			)
		)
	);

	# Hover Color.
	$options[] = array(
		  'slug'        => 'hover_color',
		  'opt_type'    => 'color',
		  'name'        => esc_html__( 'Link text color on hover', 'imagery' ),
		  'default'     => '#000',
		  'section'     => 'colors',
		  'transport'   => 'refresh',
		  'js_mod'      => 'css_output',
		  'css_output'  => array(
			array(
				  'class' => '.entry-content a:hover, .main-navigation li:hover > a, .main-navigation li.focus > a',
				  'style' => 'color'
			),
			array(
				  'class' => '.entry-content a:hover',
				  'style' => 'border-color'
			)
		)
	);
	
	# Secondary Color.
	$options[] = array(
		  'slug'        => 'secondary_color',
		  'opt_type'    => 'color',
		  'name'        => esc_html__( 'Meta text color', 'imagery' ),
		  'description' => esc_html__( 'Is applied to the to the secondary design elements, and meta text about the publication, such as date, author, etc..', 'imagery' ),
		  'default'     => '#b2b2b2',
		  'section'     => 'colors',
		  'transport'   => 'postMessage',
		  'js_mod'      => 'css_output',
		  'css_output'  => array(
			array(
				  'class' => '.entry-meta *, .entry-footer *, .comment-metadata time, .site-info, .site-info a, .meta-nav, .main-navigation .current-menu-item > a, .main-navigation .current-menu-ancestor > a, .wp-caption-text',
				  'style' => 'color'
			)
		)
	);
	
	# Buttons color.
	$options[] = array(
		  'slug'        => 'button_color',
		  'opt_type'    => 'color',
		  'name'        => esc_html__( 'Buttons color', 'imagery' ),
		  'default'     => '#2c2c2c',
		  'section'     => 'colors',
		  'transport'   => 'postMessage',
		  'js_mod'      => 'css_output',
		  'css_output'  => array(
			array(
				  'class' => 'button, input[type="button"], input[type="submit"], .button, .page-numbers span.current, .social-navigation a:hover',
				  'style' => 'background-color'
			),
			array(
				  'class' => '.social-navigation a',
				  'style' => 'fill'
			),
			array(
				  'class' => '.page-numbers span.current',
				  'style' => 'border-color'
			)
		)
	);
	
	# Button color on hover.
	$options[] = array(
		  'slug'        => 'button_hover_color',
		  'opt_type'    => 'color',
		  'name'        => esc_html__( 'Button color on hover', 'imagery' ),
		  'default'     => '#b2b2b2',
		  'section'     => 'colors',
		  'transport'   => 'refresh',
		  'js_mod'      => 'css_output',
		  'css_output'  => array(
			array(
				  'class' => 'button:hover, input[type="button"]:hover, input[type="submit"]:hover, .button:hover',
				  'style' => 'background-color'
			)
		)
	);
	
	# Additional Color.
	$options[] = array(
		  'slug'        => 'additional_color',
		  'opt_type'    => 'color',
		  'name'        => esc_html__( 'Additional Color', 'imagery' ),
		  'description' => esc_html__( 'Applies to the fill color of some design elements.', 'imagery' ),
		  'default'     => '#dedede',
		  'section'     => 'colors',
		  'transport'   => 'postMessage',
		  'js_mod'      => 'css_output',
		  'css_output'  => array(
			array(
				  'class' => '.no-thumbnail .overlay-wrap, .page-numbers a, .page-numbers span, tbody > tr:nth-child(odd), pre, .comment-reply-link, .edit-link, mark, ins, code, .social-navigation a',
				  'style' => 'background-color'
			),
			array(
				  'class' => '.page-numbers a, .page-numbers span',
				  'style' => 'border-color'
			)
		)
	);

	return $options;
}
add_filter( 'imagery_settings_input', 'imagery_customizer_add_colors' );