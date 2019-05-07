<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Imagery
 */

/**
 * Set up the WordPress core custom header feature.
 */
function imagery_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'imagery_custom_header_args', array(
		'default-image'          => '',
		'header-text'            => false,
		'width'                  => 2000,
		'height'                 => 1200,
		'flex-height'            => true,
		'video'              	 => true,
	) ) );
}
add_action( 'after_setup_theme', 'imagery_custom_header_setup' );