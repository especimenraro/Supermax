<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Imagery
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function imagery_body_classes( $classes ) {
    /* using mobile browser */
    if ( wp_is_mobile() ){
        $classes[] = 'wp-is-mobile';
    }
    else{
        $classes[] = 'wp-is-not-mobile';
    }	
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	// Adds a class the grid mode for blog page
	if ( is_home() ) { // ! is_singular() && ! is_search()
		$classes[] = esc_html( imagery( 'home_posts_columns' ) ) . '-columns-grid';
	}
	// Adds a class the grid mode for archives/categories
	if ( is_archive() && ! is_post_type_archive( 'portfolio' ) ) { // ! is_singular() && ! is_search()
		$classes[] = esc_html( imagery( 'archive_posts_columns' ) ) . '-columns-grid';
	}
	// Adds a class the grid mode for portfolio archive
	if ( is_post_type_archive( 'portfolio' ) ) { // ! is_singular() && ! is_search()
		$classes[] = esc_html( imagery( 'portfolio_posts_columns' ) ) . '-columns-grid';
	}
	// Adds a class if the front-page
	if ( is_front_page() ) {
		$classes[] = 'front-page';
	}
	// Add short class to body if wide page template
	if ( is_page_template( 'templates/wide-page-template.php' ) ) {
		$classes[] = 'wide-page';
	}
	// Adds a class if the customizer preview
	if ( is_customize_preview() ) {
		$classes[] = 'customizer-preview';
	}
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}
	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	// Adds a class for alt mode
	if ( get_theme_mod( 'alt_mode' ) ) {
		$classes[] = 'alt-mode';
	}
	// Dark Mode prepared style
	if ( get_theme_mod( 'dark_mode' ) ) {
		$classes[] = 'dark-mode';
	}
	// Check whether we want the alt nav
	if ( get_theme_mod( 'imagery_alt_nav' ) ) {
		$classes[] = 'show-alt-nav';
	}	
	// Add short class to body if resume page template
	if ( is_page_template( 'page-templates/wide-page-template.php' ) ) {
		$classes[] = 'wide-page';
	}
	return $classes;
}
add_filter( 'body_class', 'imagery_body_classes' );

/**
 * Adds custom classes to the array of post classes.
 *
 * @param array $classes Classes for the article element.
 * @return array
 */
function imagery_post_classes( $classes ) {
	$classes[] = ( has_post_thumbnail() ? 'has-thumbnail' : 'no-thumbnail' );
	
	// Adds a class if the special page
	if ( ( get_post_type() == 'post' OR get_post_type() == 'portfolio' ) && ( is_front_page() || is_home() || is_archive() ) ) {
		$classes[] = 'post-preview';
	}
	
	return $classes;
}
add_action( 'post_class', 'imagery_post_classes' );

/**
 * Display the classes for the div.
 *
 * @param string|array $class
 * One or more classes to add to the class list.
 */
function imagery_layout_class( $classes = '' ) {
	// Separates classes with a single space
	echo 'class="' . join( ' ', imagery_set_layout_class( $classes ) ) . '"';
}

/**
 * Adds custom classes to the array of layout classes.
 *
 * @param array $classes Classes for the div element.
 * @return array
 */
function imagery_set_layout_class( $class = '' ) {

	// Define classes array
	$classes = array();

	// Grid classes
	if ( is_front_page() || is_home() || is_archive() ) {
		$classes[] = 'post-grid';
	}

	// Add columns for grid style entries
	if ( get_post_type() == 'post' && imagery( 'preview_titles' ) == 'display' ) {
		$classes[] = 'show-titles';
	}
	
	// Add columns for grid style entries
	if ( get_post_type() == 'portfolio' && imagery( 'portfolio_preview_titles' ) == 'display' ) {
		$classes[] = 'show-titles';
	}
	
	$classes = array_map( 'esc_attr', $classes );

	// Apply filters to entry post class for child theming
	$classes = apply_filters( 'imagery_set_layout_class', $classes );

	// Classes array
	return array_unique( $classes );
}

/**
 * Extracting the first's image of post
 * @see imagery_hover_bg()
 * @see imagery_hover_class()
 */
if ( ! function_exists( 'imagery_catch_image' ) ) :
	function imagery_catch_image() {
  		global $post, $posts;
  		ob_start();
  		ob_end_clean();
		$first_img = '';
  		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);

			if ( 0 != $output ) {
				$first_img = $matches [1][0];
			}

   		return $first_img;
	}
endif;

/**
 * Post preview background image
 */
if ( ! function_exists( 'imagery_hover_bg' ) ) :
	function imagery_hover_bg() {	
		if ( imagery_catch_image() && has_post_thumbnail() && has_post_format('image') ) {
			echo ' ';
			echo 'style="background-image: url(' . esc_url( imagery_catch_image() ) . ' );"';
		}
	}
endif;

/**
 * Adds custom classes to the array of post classes.
 * For to change images when hover
 * Post preview background image
 */
function imagery_hover_class( $classes ) {		
	if ( imagery_catch_image() && has_post_thumbnail() && has_post_format('image') ) {
		$classes[] = 'hover-bg';
	}
	return $classes;
}
add_action( 'post_class', 'imagery_hover_class' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function imagery_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'imagery_pingback_header' );

/**
 * The frontpage or not.
 */
function imagery_is_frontpage() {
	return ( is_front_page() && ! is_home() );
}

/**
 * Return an alternative title, without prefix
 * for every type used in the get_the_archive_title().
 */
function imagery_remove_archive_title_prefix( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '#', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_year() ) {
        $title = get_the_date( 'Y' );
    } elseif ( is_month() ) {
        $title = get_the_date( 'F Y' );
    } elseif ( is_day() ) {
        $title = get_the_date( get_option( 'date_format' ) );
    } elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
        $title = esc_html( _x( 'Images', 'post format archive title', 'imagery' ) );
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    } else {
        $title = __( 'Archives', 'imagery' );
    }
    return $title;
}
add_filter( 'get_the_archive_title', 'imagery_remove_archive_title_prefix' );