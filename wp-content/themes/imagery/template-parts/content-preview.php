<?php
/**
 * Template part for displaying post preview for Home and Archive page
 * Using post_class() here to add special class 'post-preview'
 * @see imagery_post_classes()
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Imagery
 */
 
?>

<a href="<?php esc_url( the_permalink() ); ?>" <?php post_class(); ?> title="<?php the_title_attribute(); ?>">
	
	<div class="preview-image"<?php imagery_hover_bg(); ?>>
		<?php the_post_thumbnail( 'imagery-preview-image' ); ?>
		<div class="overlay-wrap"></div>
	</div>
	
	<header class="preview-header">
		<?php
				if ( is_sticky() ) : ?>
				<span class="sticky-post"><?php esc_html_e( 'Sticky', 'imagery' ); ?></span>
		<?php
				endif; ?>
		<?php
				if ( get_the_title() ) {
					the_title( '<h2 class="title">', '</h2>' );
				} else { ?>
				<h2 class="title"><?php esc_html_e( 'Untitled', 'imagery' ); ?></h2>
		<?php
				} ?>
	</header>
			
</a>