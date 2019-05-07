<?php

/**
 * This file is used to markup the sidebar on the dashboard page.
 * @package Imagery
 */

// Links that are used on this page.
$sidebar_links = array(
    'premium' => 'http://dinevthemes.com/themes/imagery-pro/',
);

?>

<div class="tab-section">
    <h4 class="section-title"><?php esc_html_e( 'Get Much More', 'imagery' ); ?></h4>

    <p><?php esc_html_e( 'More features and one-on-one support you will get with the premium version of the theme.', 'imagery' ); ?></p>

    <p>
    <?php
        // Display link to the Premium.
        printf( '<a href="%1$s"  class="button button-primary" target="_blank">%2$s</a>', esc_url( $sidebar_links['premium'] ), esc_html__( 'Get Premium', 'imagery' ) );
    ?>
    </p>
</div><!-- .tab-section -->
