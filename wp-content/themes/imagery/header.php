<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Imagery
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'imagery' ); ?></a>
		
		<?php
			if ( get_theme_mod( 'search_display' ) == 1 ) {
				get_search_form();
			}
			if ( imagery( 'header_position' ) == 'before-menu' ) {
				get_template_part( 'template-parts/header/site', 'media' );
			}
			?>
	
	<header id="masthead" class="site-header wrap-inner">
	
		<?php
			// site branding
			get_template_part( 'template-parts/header/site', 'branding' );
			
			// navigation bar
			get_template_part( 'template-parts/navigation/nav-bar', 'default' );
			?>
			
	</header>
	
		<?php
			if ( imagery( 'header_position' ) == 'after-menu' ) { 
				get_template_part( 'template-parts/header/site', 'media' );
			}
			?>

	<div id="content" class="site-content wrap-inner">