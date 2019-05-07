<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Imagery
 */

get_header(); ?>

<?php
function imagery_section_class( $element ) {
	if ( imagery( 'frontpage_posts_columns' ) && 'front_blog' == $element ) {
		$class = 'class="'. esc_attr( imagery( 'frontpage_posts_columns' ) ) . '-columns-grid"';
		echo ' ' . $class;
	}
	if ( imagery( 'frontpage_portfolio_columns' ) && 'front_portfolio' == $element ) {
		$class = 'class="'. esc_attr( imagery( 'frontpage_portfolio_columns' ) ) . '-columns-grid"';
		echo ' ' . $class;
	}
}
?>

<?php
/**
 * Outputs css style for section of the frontpage
 */
function imagery_element_style( $element ) {
	echo ' ' . imagery_get_element_style( $element );
}
/**
 * Returns css style for section of the frontpage
 * getting value from customizer
 */
function imagery_get_element_style( $element ) {

	$element = $element . '_margin';
	
	if ( imagery( $element ) ) {

		// Get style from Customizer
		$style = 'style="margin-bottom: ' . esc_attr( imagery( $element ) ) . 'px;"';

		// Apply filters for child theming
		$style = apply_filters( 'imagery_get_element_style', $style );
		
		// Return style
		return $style;
	}
}
?>

	<div id="primary" class="front-page-content">
		<main id="main" class="site-main">
		
			<?php
			// Get elements from customizer
			$elements = imagery_front_elements_positioning();

			// Loop through elements
			foreach ( $elements as $element ) {
				// Page Content
				if ( 'page_content' == $element ) {
				?>			
					<section id="front-page-content"<?php imagery_element_style( $element ); ?>>
						<?php get_template_part( 'template-parts/front-page/content', 'layout' ); ?>
					</section>
			<?php
				}
				// Blog Section
				if ( 'front_blog' == $element ) {
				?>
					<section id="front-blog"<?php imagery_section_class( $element ); ?><?php imagery_element_style( $element ); ?>>
						<?php get_template_part( 'template-parts/front-page/blog' ); ?>
					</section>
			<?php
				}
				// Portfolio Section
				if ( 'front_portfolio' == $element ) {
				?>
					<section id="front-portfolio"<?php imagery_section_class( $element ); ?><?php imagery_element_style( $element ); ?>>
						<?php get_template_part( 'template-parts/front-page/portfolio' ); ?>
					</section>
			<?php
				}

			} ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();