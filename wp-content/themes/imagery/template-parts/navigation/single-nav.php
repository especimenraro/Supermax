<?php
/**
 * Single Post Navigation
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
	if ( get_post_type() == 'post' || get_post_type() == 'portfolio' ) :
		// Previous/next post navigation.
		the_post_navigation( array(
				'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Next', 'imagery' ) . '</span> ' .
					'<span class="screen-reader-text">' . esc_html__( 'Next post:', 'imagery' ) . '</span> ' .
					'<span class="post-title">%title</span>',
				'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Previous', 'imagery' ) . '</span> ' .
					'<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'imagery' ) . '</span> ' .
					'<span class="post-title">%title</span>',
		) );
	endif;