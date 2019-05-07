<?php
/**
 * Template Name: Wide Page
 * Template Post Type: page
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Imagery
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

	<?php
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/content', 'wide-page' );
			endwhile;
		else : // I'm not sure it's possible to have no posts when this page is shown, but WTH.
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>

		</main>
	</div>

<?php
get_footer();