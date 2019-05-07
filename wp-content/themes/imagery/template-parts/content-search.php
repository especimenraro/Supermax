<?php
/**
 * Template part for displaying search results
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Imagery
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php
				if ( get_the_title() ) {
					the_title( sprintf( '<h2 class="title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
				} else { ?>
				<h2 class="title"><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php esc_html_e( 'Untitled', 'imagery' ); ?></a></h2>
		<?php
				} ?>
		<?php if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php imagery_posted_on(); ?>
				</div>
		<?php endif; ?>
	</header>
		
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
		
	<footer class="entry-footer">
		<?php imagery_entry_footer(); ?>
	</footer>
		
</article>
