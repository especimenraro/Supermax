<?php
/**
 * Displays header media
 *
 * @package Imagery
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
	<?php
		if ( imagery( 'header_frontpage_only' ) == 1 && ! is_front_page() ) { 
			return;
		}
	
		if ( imagery( 'header_display' ) == 'header-box' ) { 
			$class = 'wrap-inner';
		} else {
			$class = '';
		}
		?>

<div class="custom-header<?php if ( $class ) { echo esc_attr( ' ' . $class ); } ?>">

	<div class="custom-header-media">
		<?php the_custom_header_markup(); ?>
	</div>

</div>
