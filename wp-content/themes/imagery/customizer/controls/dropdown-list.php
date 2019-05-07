<?php
/**
 * Button style.
 */
function imagery_button_class() {
	$output = array(
		  ''       => esc_html__( 'default', 'imagery' ),
		  'secondary '       => esc_html__( 'gray', 'imagery' ),
		  'success '       => esc_html__( 'green', 'imagery' ),
		  'alert '       => esc_html__( 'red', 'imagery' ),
		  'warning '       => esc_html__( 'orange', 'imagery' ),
		  'hollow '       => esc_html__( 'hollow', 'imagery' ),
		  'secondary hollow '       => esc_html__( 'gray hollow', 'imagery' ),
		  'success hollow '       => esc_html__( 'green hollow', 'imagery' ),
		  'alert hollow '       => esc_html__( 'red hollow', 'imagery' ),
		  'warning hollow '       => esc_html__( 'orange hollow', 'imagery' ),
	);
	return $output;
}

/**
 * Category List.
 */
function imagery_customizer_category_list( $args = array() ) {
	$args = wp_parse_args( $args, array( 'hide_empty' => 1 ) );
	$cats = get_categories( $args );
	$output = array();
	$output[''] = esc_html__( '&mdash; Select &mdash;', 'imagery' );
	foreach( $cats as $cat ) {
		$output[$cat->term_id] = sprintf('%s (%s)', $cat->name, $cat->count );
	}
	return $output;
}

/**
 * Tag List.
 */
function imagery_customizer_tag_list( $args = array() ) {
	$args = wp_parse_args( $args, array( 'hide_empty' => 1 ) );
	$tags = get_tags( $args );
	$output = array();
	$output[''] = esc_html__( '&mdash; Select &mdash;', 'imagery' );
	foreach( $tags as $tag ) {
		$output[$tag->term_id] = sprintf('%s (%s)', $tag->name, $tag->count );
	}
	return $output;
}

/**
 * Post Formats.
 */
function imagery_customizer_post_format() {
	$output = array(
		  'post-format-video'       => esc_html__( 'Video', 'imagery' ),
		  'post-format-audio'       => esc_html__( 'Audio', 'imagery' ),
		  'post-format-image'       => esc_html__( 'Image', 'imagery' ),
	);
	return $output;
}

/**
 * Featured Cat Layout.
 */
function imagery_customizer_featured_category_layout() {
	$output = array(
		  'boxed'       => esc_html__( 'Post Boxed', 'imagery' ),
		  'metro'       => esc_html__( 'Metro Box', 'imagery' ),
	);
	return $output;
}

/**
 * Number Post.
 */
function imagery_number_post() {
	$output = array(
		  '3'       => '3',
		  '4'       => '4',
		  '6'       => '6',
		  '9'       => '9',
		  '10'     => '10',
	);
	return $output;
}

/**
 * Number Length.
 */
function imagery_number_length() {
	$output = array(
		  '5'       => '5',
		  '7'       => '7',
		  '9'       => '9',
		  '12'       => '12',
	);
	return $output;
}

/**
 * Font weight list.
 */
function imagery_customizer_font_weight_list() {
	$output = array(
			'100'       => esc_html__( 'Ultra Light', 'imagery' ),
			'200'       => esc_html__( 'Light', 'imagery' ),
			'300'       => esc_html__( 'Book', 'imagery' ),
			'400'       => esc_html__( 'Regular', 'imagery' ),
			'500'       => esc_html__( 'Medium', 'imagery' ),
			'600'       => esc_html__( 'Semi-Bold', 'imagery' ),
			'700'       => esc_html__( 'Bold', 'imagery' ),
			'800'       => esc_html__( 'Extra Bold', 'imagery' ),
			'900'       => esc_html__( 'Ultra Bold', 'imagery' )
	);
	return $output;
}

/**
 * Font size list for main text.
 */
function imagery_content_font_size_list() {
	$output = array(
		  	'12'       => esc_html__( '12px', 'imagery' ),
		  	'14'       => esc_html__( '14px', 'imagery' ),
		  	'16'       => esc_html__( '16px', 'imagery' ),
		  	'18'       => esc_html__( '18px', 'imagery' ),
		  	'20'       => esc_html__( '20px', 'imagery' ),
		  	'22'       => esc_html__( '22px', 'imagery' ),
		  	'24'       => esc_html__( '24px', 'imagery' ),
	);
	return $output;
}

/**
 * Font size list for headings.
 */
function imagery_heading_font_size_list() {
	$output = array(
		  	'18'       => esc_html__( '18px', 'imagery' ),
		  	'20'       => esc_html__( '20px', 'imagery' ),
		  	'22'       => esc_html__( '22px', 'imagery' ),
		  	'24'       => esc_html__( '24px', 'imagery' ),
		  	'28'       => esc_html__( '28px', 'imagery' ),
		  	'30'       => esc_html__( '30px', 'imagery' ),
		  	'32'       => esc_html__( '32px', 'imagery' ),
		  	'34'       => esc_html__( '34px', 'imagery' ),
		  	'36'       => esc_html__( '36px', 'imagery' ),
		  	'38'       => esc_html__( '38px', 'imagery' ),
		  	'40'       => esc_html__( '40px', 'imagery' ),
		  	'42'       => esc_html__( '42px', 'imagery' ),
		  	'46'       => esc_html__( '46px', 'imagery' ),
		  	'48'       => esc_html__( '48px', 'imagery' ),
		  	'50'       => esc_html__( '50px', 'imagery' ),
	);
	return $output;
}

/**
 * Font size list for elements.
 */
function imagery_element_font_size_list() {
	$output = array(
		  	'10'       => esc_html__( '10px', 'imagery' ),
		  	'12'       => esc_html__( '12px', 'imagery' ),
		  	'14'       => esc_html__( '14px', 'imagery' ),
		  	'16'       => esc_html__( '16px', 'imagery' ),
		  	'18'       => esc_html__( '18px', 'imagery' ),
		  	'20'       => esc_html__( '20px', 'imagery' ),
	);
	return $output;
}

/**
 * Font size list for main menu.
 */
function imagery_menu_font_size_list() {
	$output = array(
		  	'14'       => esc_html__( '14px', 'imagery' ),
		  	'16'       => esc_html__( '16px', 'imagery' ),
		  	'18'       => esc_html__( '18px', 'imagery' ),
		  	'20'       => esc_html__( '20px', 'imagery' ),
	);
	return $output;
}

/**
 * Number Line Height.
 */
function imagery_line_height() {
	$output = array(
		  '.5'      => '0.5',
		  '1'       => '1',
		  '1.5'     => '1.5',
		  '1.75'    => '1.75',
	);
	return $output;
}