<?php
/**
 * Template part for displaying the Theme credits.
 * @package Imagery
 */

?>
<a href="<?php echo esc_url( 'http://wordpress.org/' ); ?>">
	<?php
		/* translators: Theme CMS name. */
		esc_html_e( 'WordPress', 'imagery' );
	?>
</a>
<?php echo esc_html__( 'theme by', 'imagery' ); ?>
<a href="<?php echo esc_url( 'http://dinevthemes.com/' ); ?>">
	<?php
		/* translators: Theme developer name. */
		esc_html_e( 'DinevThemes', 'imagery' );
	?>
</a>