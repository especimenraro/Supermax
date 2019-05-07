<?php

/**
 * This file is used to markup the "Getting Started" section on the dashboard page.
 *
 * @package Imagery
 */

// Links that are used on this page.
$getting_started_links = array(
    'demo' => 'http://demo.dinevthemes.com/imagery/',
    'docs' => 'http://dinevthemes.com/documentation-category/imagery-theme-doc/',
	'premium' => 'http://dinevthemes.com/themes/imagery-pro/',
	'portfolio_post_type' => 'https://wordpress.org/plugins/portfolio-post-type/',
	'photography_portfolio' => 'https://wordpress.org/plugins/photography-portfolio/',
	'wpforms' => 'https://wordpress.org/plugins/wpforms-lite/',
	'atomic_blocks' => 'https://wordpress.org/plugins/atomic-blocks/',
	'coblocks' => 'https://wordpress.org/plugins/coblocks/',
	'gallery_block' => 'https://wordpress.org/plugins/block-gallery/',
);

?>

<div class="tab-section">
    <h3 class="section-title"><?php esc_html_e( 'Recommended plugins', 'imagery' ); ?></h3>
	
	<p><?php esc_html_e( 'This theme offers basic support for portfolio plugins:', 'imagery' ); ?></p>
<ul>
	<li>
	<?php
        // Display link to plugin page.
        printf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( $getting_started_links['portfolio_post_type'] ), esc_html__( 'Portfolio Post Type', 'imagery' ) );
    ?>
	</li>
	<li>
	<?php
        // Display link to plugin page.
        printf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( $getting_started_links['photography_portfolio'] ), esc_html__( 'Easy Photography Portfolio', 'imagery' ) );
    ?>
	</li>
	<li>
	<?php
        // Display link to plugin page.
        printf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( $getting_started_links['wpforms'] ), esc_html__( 'Contact Form by WPForms', 'imagery' ) );
    ?>
	</li>
</ul>

    <p><?php esc_html_e( 'This theme comes with basic Gutenberg editor support and also supports plugins with additional Gutenberg editor blocks:', 'imagery' ); ?></p>
<ul>
	<li>
		<?php
        // Display link to plugin page.
        printf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( $getting_started_links['atomic_blocks'] ), esc_html__( 'Atomic Blocks', 'imagery' ) );
		?>
	</li>
	<li>
		<?php
        // Display link to plugin page.
        printf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( $getting_started_links['coblocks'] ), esc_html__( 'Page Builder Gutenberg Blocks – CoBlocks', 'imagery' ) );
		?>
	</li>
	<li>
		<?php
        // Display link to plugin page.
        printf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( $getting_started_links['gallery_block'] ), esc_html__( 'Block Gallery – Photo Gallery', 'imagery' ) );
		?>
	</li>
</ul>
</div><!-- .tab-section -->

<div class="tab-section">
    <h3 class="section-title"><?php esc_html_e( 'Front Page Setup', 'imagery' ); ?></h3>

    <p><?php esc_html_e( 'Create a new by going to Pages > Add New. Give your page a name (Title field).', 'imagery' ); ?></p>
	<p><?php esc_html_e( 'In the same way create a blank page for the Blog Page.', 'imagery' ); ?></p>
	<p><?php esc_html_e( 'Now you can go to Appearance > Customize > Static Front Page and choose your new created Page as your Front Page.', 'imagery' ); ?></p>

</div><!-- .tab-section -->

<div class="tab-section">
    <h3 class="section-title"><?php esc_html_e( 'Theme Options', 'imagery' ); ?></h3>

    <p><?php esc_html_e( 'You can use of the Customizer to provide you with the theme options. Press the button below to open the Customizer and start making changes.', 'imagery' ); ?></p>

    <p><a href="<?php echo wp_customize_url(); // WPCS: XSS OK. ?>" class="button" target="_blank"><?php esc_html_e( 'Customize Theme', 'imagery' ); ?></a></p>
</div><!-- .tab-section -->

<div class="tab-section">
    <h3 class="section-title"><?php esc_html_e( 'Demo Website', 'imagery' ); ?></h3>

    <p><?php esc_html_e( 'You can recreate the demo website. All you need is following short instructions from theme docs. Please note, a file for importing demo-content may be offered only premium users.', 'imagery' ); ?></p>

    <p>
	<?php
        // Display link to premium version of the theme.
        printf( '<a href="%1$s" class="button" target="_blank">%2$s</a>', esc_url( $getting_started_links['premium'] ), esc_html__( 'Get Premium', 'imagery' ) );
    ?>
	<?php
        // Display link to theme's documentation.
        printf( '<a href="%1$s" class="button" target="_blank">%2$s</a>', esc_url( $getting_started_links['docs'] ), esc_html__( 'Documentation', 'imagery' ) );
    ?>
    <?php
        // Display a link to the demo website.
        printf( '<a href="%1$s" class="demo-button" target="_blank">%2$s</a>', esc_url( $getting_started_links['demo'] ), esc_html__( 'View Demo', 'imagery' ) );
    ?>
    </p>
</div><!-- .tab-section -->
