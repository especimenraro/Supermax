<?php
/**
 * Template part for displaying Attachment file
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Imagery
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="page-header">
		<div>
			<?php
				the_title( '<h1 class="entry-title">', '</h1>' );
					if( has_excerpt() ):
						the_excerpt();
					endif;

					if ( $post->post_mime_type == 'image/jpeg' ) : ?>
						<div class="entry-meta">
							<?php imagery_posted_on(); ?>
						</div>
			<?php
					endif; ?>
		</div>
	</header>
<?php
	if ( $post->post_mime_type == 'image/jpeg' ) :
	// attached file is a photo
?>
	<div class="single-featured-image-header">
			<?php imagery_attachment(); ?>
	</div>

	<div class="entry-content">

		<div class="attachment-description">
			<?php
				$description = $post->post_content;
				echo '<p>' . esc_attr( $description ) . '</p>';
			?>
		</div>
		<div class="attachment-exif-data">
			<ul>
			<?php
				$meta = wp_get_attachment_metadata($id);
				
				echo '<li>';
				esc_attr_e( 'Dimensions:', 'imagery' );
				echo ' ' . esc_html( $meta[width] . ' x ' . $meta[height] );
				echo '</li>';
				
				echo '<li>';
				esc_attr_e( 'Camera:', 'imagery' );
				echo ' ' . esc_html( $meta[image_meta][camera] );
				echo '</li>';
				
				echo '<li>';
				esc_attr_e( 'Focal length:', 'imagery' );
				echo ' ' . esc_html( $meta[image_meta][focal_length] );
				echo '</li>';
				
				echo '<li>';
				esc_attr_e( 'Aperture:', 'imagery' );
				echo ' ' . esc_html( $meta[image_meta][aperture] );
				echo '</li>';
				
				echo '<li>';
				esc_attr_e( 'ISO:', 'imagery' );
				echo ' ' . esc_html( $meta[image_meta][iso] );
				echo '</li>';
				
				echo '<li>';
				esc_attr_e( 'Shutter speed:', 'imagery' );
				echo ' ' . esc_html( $meta[image_meta][shutter_speed] );
				echo '</li>';
				
				$timestamped = $meta[image_meta][created_timestamp];
				$created_timestamp = date("F j, Y, g:i a", $timestamped);
				
				echo '<li>';
				esc_attr_e( 'Time Stamp:', 'imagery' );
				echo ' ' . esc_html( $created_timestamp );
				echo '</li>';
			?>
			</ul>
		</div>
		<p class='image-download-meta'>
			<?php
					$image = wp_get_attachment_image_src( get_the_ID(), 'full' );
					$image_size = $image_size . ' (' . $image[1] . 'x' . $image[2] . ' px)';
					echo '<a href="' . esc_url( $image[0] ) . '" download>' . esc_html__( 'Download Full size', 'imagery' ) . '</a>' . esc_html( $image_size );
			?>
		</p>
	</div><!-- .entry-content -->
<?php
	endif;
	// attached file is not a photo
	if ( $post->post_mime_type != 'image/jpeg' ) :
?>
	<div class="entry-content">
		<?php imagery_attachment(); ?>
	</div><!-- .entry-content -->
<?php
	endif;
?>	
	<footer class="entry-footer">
		<?php imagery_entry_footer(); ?>
	</footer>
	
</article><!-- #post-<?php the_ID(); ?> -->
