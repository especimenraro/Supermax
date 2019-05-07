<?php
/**
 * Displays footer site info
 *
 * @package WordPress
 * @subpackage supermarket-ecommerce
 * @since 1.0
 * @version 1.4
 */

?>

<div class="site-info">
	<p><?php echo esc_html(get_theme_mod('supermarket_ecommerce_footer_copy',__('Ecommerce WordPress Theme By','supermarket-ecommerce'))); ?> <?php supermarket_ecommerce_credit(); ?></p>
</div>