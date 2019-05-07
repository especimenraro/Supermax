<?php
// Define links.
$review_link = '<a href="https://wordpress.org/support/theme/imagery/reviews/#new-post" target="_blank">' . esc_html__( 'review', 'imagery' ) . '</a>';
?>

<div class="tab-section">
    <p><?php esc_html_e( 'Do you like the theme? I would love your help. There are ways in which you can help:', 'imagery' ); ?></p>
</div><!-- .tab-section -->

<div class="tab-section action-section">
    <h3 class="section-title"><?php esc_html_e( 'Share', 'imagery' ); ?></h3>

    <p><?php esc_html_e( 'Do you have Instagram, Facebook, Twitter or any other social profile? It would be great if you could share Imagery with anyone you know.', 'imagery' ); ?></p>
</div><!-- .tab-section -->

<div class="tab-section action-section">
    <h3 class="section-title"><?php esc_html_e( 'Rate', 'imagery' ); ?></h3>

    <p>
	   <?php
            /* translators: %s is a placeholders that will be replaced by variables passed as an argument. */
            printf( esc_html__( 'I will appreciate if you find a few minutes and leave a five stars %s. It is important for me, as we see it as a feedback and support from you.', 'imagery' ), $review_link ); // WPCS: XSS OK.
       ?>
	</p>
</div><!-- .tab-section -->

<div class="tab-section action-section">
    <h3 class="section-title"><?php esc_html_e( 'Write', 'imagery' ); ?></h3>
    <p><?php esc_html_e( 'Do you like to blog? We would be very happy if you could write a blog post about WordPress blog themes and mention Imagery theme.', 'imagery' ); ?></p>
</div><!-- .tab-section -->
