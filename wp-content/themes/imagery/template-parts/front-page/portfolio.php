<?php
/**
 * Template part for displaying portfolio latest posts.
 * @package Imagery
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function imagery_portfolio_section_class( $classes ) {
	
	// Adds a class if the special page
	if ( imagery( 'portfolio_preview_titles' ) == 'display' ) {
		$classes[] = 'show-titles';
	}
	
	return $classes;
}
remove_filter( 'imagery_set_layout_class', 'imagery_blog_section_class' );
add_filter( 'imagery_set_layout_class', 'imagery_portfolio_section_class' );
?>
	<div id="entry-grid"<?php imagery_layout_class(); ?>>
		<?php
			$number = esc_attr( imagery( 'portfolio_posts_number' ) );
			// Getting posts portfolio type
			$args = array(
				'posts_per_page' => $number,
				'post_type' => 'portfolio',
			);
			$query = new WP_Query( $args );
				while ( $query->have_posts() ) :		
					$query->the_post();
					get_template_part( 'template-parts/content', 'preview' );
				endwhile;
			// Reset $post
			wp_reset_postdata();
		?>
	</div>