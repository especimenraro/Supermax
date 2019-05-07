<?php
/**
 * Template part for displaying content of the single post or the page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Imagery
 */

?>

<?php
	if ( ! is_singular() && ! is_search() ) {
		get_template_part( 'template-parts/content', 'preview' );
	} elseif ( is_search() ) {
		get_template_part( 'template-parts/content', 'search' );
	} else {
			if ( is_singular() ) {
				$header_class = 'page-header';
			} else {
				$header_class = 'entry-header';
			}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php
			/*
			 * If a single post of the image format, show here the featured image.
			 * Using get_queried_object_id() here since the $post global may not be set before a call to the_post().
			 */
			if ( is_singular() && has_post_format( 'image' ) && has_post_thumbnail( get_queried_object_id() ) ) :
				echo '<div class="single-featured-image-header">' . get_the_post_thumbnail( get_queried_object_id(), 'imagery-featured-image' ) . '</div>';
			endif;
		?>

		<header class="<?php echo esc_attr( $header_class ); ?>">
			<div>
				<?php
					if ( is_singular() ) :
						the_title( '<h1 class="entry-title">', '</h1>' );
						if( has_excerpt() ):
							the_excerpt();
						endif;
					else :
						the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					endif;

					if ( 'post' === get_post_type() ) : ?>
						<div class="entry-meta">
							<?php imagery_posted_on(); ?>
						</div>
				<?php
					endif; ?>
			</div>
		</header>
	
		<?php
			/*
			 * If a standard post or page, and single, show here the featured image.
			 * Using get_queried_object_id() here since the $post global may not be set before a call to the_post().
			 */
			if ( is_singular() && ! has_post_format( 'image' ) && has_post_thumbnail( get_queried_object_id() ) ) :
				echo '<div class="single-featured-image-header">' . get_the_post_thumbnail( get_queried_object_id(), 'imagery-featured-image' ) . '</div>';
			endif;
		?>

		<div class="entry-content">
				<?php
					the_content( sprintf(
							/* translators: %s: Name of current post. Only visible to screen readers */
							esc_html__( 'Continue reading%s', 'imagery' ),
							'<span class="screen-reader-text">' . get_the_title() . '</span>'
					) );

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'imagery' ),
						'after'  => '</div>',
					) );
				?>
		</div>

	<footer class="entry-footer">
		<?php imagery_entry_footer(); ?>
	</footer>
	
</article>

<?php
	} ?>