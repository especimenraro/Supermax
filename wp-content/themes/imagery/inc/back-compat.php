<?php
/**
 * Imagery back compat functionality
 *
 * Prevents Imagery from running on WordPress versions prior to 4.7,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.7.
 *
 * @author WordPress.org <http://wordpress.org>
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Prevent switching to Imagery on old versions of WordPress.
 *
 * Switches to the default theme.
 */
function imagery_switch_theme() {
	switch_theme( WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'imagery_upgrade_notice' );
}
add_action( 'after_switch_theme', 'imagery_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 * @global string $wp_version WordPress version.
 */
function imagery_upgrade_notice() {
	$message = sprintf( __( 'Imagery requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'imagery' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.7.
 * @global string $wp_version WordPress version.
 */
function imagery_customize() {
	wp_die( sprintf( __( 'Imagery requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'imagery' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'imagery_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.7.
 * @global string $wp_version WordPress version.
 */
function imagery_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'Imagery requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'imagery' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'imagery_preview' );
