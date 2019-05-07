<?php
/**
 * @package foodica
 */

/**
 * Add sections and controls to the customizer.
 */
function foodica_customizer_add_sections_and_options( $wp_customize ) {

    $wp_customize->add_setting( 'footer-background-color', array(
        'default' => '#EFF4F7',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control(
        $wp_customize,
        'footer-background-color',
        array(
            'label' => __( 'Footer Menu Background Color', 'foodica' ),
            'priority' => 0,
            'section' => 'colors',
            'settings' => 'footer-background-color'
        )
    ) );
}
add_action( 'customize_register', 'foodica_customizer_add_sections_and_options' );

/**
 * Print customizer css.
 */
function foodica_customizer_display_css() {
    $styles = array();

    if ( '#EFF4F7' != ( $header_background_color = get_theme_mod( 'footer-background-color', '#EFF4F7' ) ) ) {
        $styles[] = array(
            'selectors' => '.footer-menu',
            'declarations' => array(
                'background-color' => $header_background_color
            )
        );
    }

    if ( empty( $styles ) ) return;
    ?>

    <style type="text/css">

        <?php
        foreach ( $styles as $rule ) {
            echo $rule['selectors'] . ' {';

            foreach ( $rule['declarations'] as $property => $value ) {
                $value = esc_attr($value);
                echo "{$property}:{$value};\n";
            }

            echo '}';
        }
        ?>

    </style>

    <?php
}
add_action( 'wp_head', 'foodica_customizer_display_css', 20 );
