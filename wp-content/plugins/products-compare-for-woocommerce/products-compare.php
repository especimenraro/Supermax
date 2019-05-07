<?php
/**
 * Plugin Name: Products Compare for WooCommerce
 * Plugin URI: https://wordpress.org/plugins/products-compare-for-woocommerce/
 * Description: Allow your users to compare products of your shop by attributes and price.
 * Version: 1.0.13
 * Author: BeRocket
 * Requires at least: 4.0
 * Author URI: http://berocket.com
 * Text Domain: BeRocket_Compare_Products_domain
 * Domain Path: /languages/
 * WC tested up to: 3.5.7
 */
define( "BeRocket_Compare_Products_version", '1.0.13' );
define( "BeRocket_Compare_Products_domain", 'BeRocket_Compare_Products_domain'); 
define( "Compare_Products_TEMPLATE_PATH", plugin_dir_path( __FILE__ ) . "templates/" );
load_plugin_textdomain('BeRocket_Compare_Products_domain', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/');
require_once(plugin_dir_path( __FILE__ ).'includes/admin_notices.php');
require_once(plugin_dir_path( __FILE__ ).'includes/functions.php');
require_once(plugin_dir_path( __FILE__ ).'includes/widget.php');
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
 * Class BeRocket_Compare_Products
 */
class BeRocket_Compare_Products {
    public static $compare_cookie = '';
    public static $compare_products = array();
    public static $info = array( 
        'id'        => 4,
        'version'   => BeRocket_Compare_Products_version,
        'plugin'    => '',
        'slug'      => '',
        'key'       => '',
        'name'      => ''
    );

    /**
     * Defaults values
     */
    public static $defaults = array(
        'br_compare_products_general_settings'  => array(
            'compare_page'                          => '',
            'attributes'                            => array(),
        ),
        'br_compare_products_style_settings'    => array(
            'button'                                => array(
                'bcolor'                                => '999999',
                'bwidth'                                => '0',
                'bradius'                               => '0',
                'fontsize'                              => '16',
                'fcolor'                                => '333333',
                'backcolor'                             => '9999ff',
            ),
            'table'                                 => array(
                'colwidth'                              => '200',
                'imgwidth'                              => '',
                'toppadding'                            => '0',
                'backcolor'                             => 'ffffff',
                'backcolorsame'                         => '',
                'margintop'                             => '',
                'marginbottom'                          => '',
                'marginleft'                            => '',
                'marginright'                           => '',
                'paddingtop'                            => '',
                'paddingbottom'                         => '',
                'paddingleft'                           => '',
                'paddingright'                          => '',
                'top'                                   => '',
                'bottom'                                => '',
                'left'                                  => '',
                'right'                                 => '',
                'bordercolor'                           => '',
                'samecolor'                             => '',
                'samecolorhover'                        => '',
            ),
        ),
        'br_compare_products_text_settings'     => array(
            'compare'                               => 'Compare',
            'add_compare'                           => 'Compare',
            'added_compare'                         => 'Added',
            'attribute'                             => 'Attributes',
            'availability'                          => 'Availability',
        ),
        'br_compare_products_javascript_settings'   => array(
            'before_load'                               => '',
            'after_load'                                => '',
            'fontawesome_frontend_disable'              => '',
            'fontawesome_frontend_version'              => '',
        ),
        'br_compare_products_license_settings'  => array(
            'plugin_key'                            => '',
        ),
    );
    public static $values = array(
        'settings_name' => '',
        'option_page'   => 'br-compare-products',
        'premium_slug'  => 'woocommerce-products-compare',
        'free_slug'     => 'products-compare-for-woocommerce',
    );
    
    function __construct () {
        $compare_cookie = br_get_value_from_array($_COOKIE, 'br_products_compare');
        $compare_cookie = sanitize_text_field($compare_cookie);
        self::$compare_cookie = sanitize_text_field($compare_cookie);
        global $br_wp_query_not_main;
        $br_wp_query_not_main = false;
        register_activation_hook(__FILE__, array( __CLASS__, 'activation' ) );
        add_filter( 'BeRocket_updater_add_plugin', array( __CLASS__, 'updater_info' ) );
        add_filter( 'berocket_admin_notices_rate_stars_plugins', array( __CLASS__, 'rate_stars_plugins' ) );

        if ( ( is_plugin_active( 'woocommerce/woocommerce.php' ) || is_plugin_active_for_network( 'woocommerce/woocommerce.php' ) ) && br_get_woocommerce_version() >= 2.1 ) {
            add_action ( 'woocommerce_after_shop_loop_item', array( __CLASS__, 'get_compare_button' ), 30 );
            add_action ( 'lgv_advanced_after_price', array( __CLASS__, 'get_compare_button' ), 30 );
            add_action ( 'woocommerce_single_product_summary', array( __CLASS__, 'get_compare_button' ), 38 );
            add_action ( 'init', array( __CLASS__, 'init' ) );
            add_action ( 'admin_init', array( __CLASS__, 'admin_init' ) );
            add_action ( 'admin_menu', array( __CLASS__, 'options' ) );
            add_action ( 'wp_head', array( __CLASS__, 'wp_head_style' ) );
            add_filter ( 'the_content', array( __CLASS__, 'compare_page' ) );
            add_action ( "widgets_init", array ( __CLASS__, 'widgets_init' ) );
            add_action( "wp_ajax_br_get_compare_products", array ( __CLASS__, 'listener_products' ) );
            add_action( "wp_ajax_nopriv_br_get_compare_products", array ( __CLASS__, 'listener_products' ) );
            add_action( "wp_ajax_br_get_compare_list", array ( __CLASS__, 'compare_list' ) );
            add_action( "wp_ajax_nopriv_br_get_compare_list", array ( __CLASS__, 'compare_list' ) );
            add_filter( 'plugin_row_meta', array( __CLASS__, 'plugin_row_meta' ), 10, 2 );
            $plugin_base_slug = plugin_basename( __FILE__ );
            add_filter( 'plugin_action_links_' . $plugin_base_slug, array( __CLASS__, 'plugin_action_links' ) );
            add_filter( 'is_berocket_settings_page', array( __CLASS__, 'is_settings_page' ) );
        }
        add_filter('berocket_admin_notices_subscribe_plugins', array(__CLASS__, 'admin_notices_subscribe_plugins'));
    }

    public static function rate_stars_plugins($plugins) {
        $info = get_plugin_data( __FILE__ );
        self::$info['name'] = $info['Name'];
        $plugin = array(
            'id'            => self::$info['id'],
            'name'          => self::$info['name'],
            'free_slug'     => self::$values['free_slug'],
        );
        $plugins[self::$info['id']] = $plugin;
        return $plugins;
    }

    public static function updater_info ( $plugins ) {
        self::$info['slug'] = basename( __DIR__ );
        self::$info['plugin'] = plugin_basename( __FILE__ );
        self::$info = self::$info;
        $info = get_plugin_data( __FILE__ );
        self::$info['name'] = $info['Name'];
        $plugins[] = self::$info;
        return $plugins;
    }
    public static function admin_notices_subscribe_plugins($plugins) {
        $plugins[] = self::$info['id'];
        return $plugins;
    }
    public static function is_settings_page($settings_page) {
        if( ! empty($_GET['page']) && $_GET['page'] == self::$values[ 'option_page' ] ) {
            $settings_page = true;
        }
        return $settings_page;
    }
    public static function plugin_action_links($links) {
		$action_links = array(
			'settings' => '<a href="' . admin_url( 'admin.php?page='.self::$values['option_page'] ) . '" title="' . __( 'View Plugin Settings', 'BeRocket_products_label_domain' ) . '">' . __( 'Settings', 'BeRocket_products_label_domain' ) . '</a>',
		);
		return array_merge( $action_links, $links );
    }
    public static function plugin_row_meta($links, $file) {
        $plugin_base_slug = plugin_basename( __FILE__ );
        if ( $file == $plugin_base_slug ) {
			$row_meta = array(
				'docs'    => '<a href="http://berocket.com/docs/plugin/'.self::$values['premium_slug'].'" title="' . __( 'View Plugin Documentation', 'BeRocket_products_label_domain' ) . '" target="_blank">' . __( 'Docs', 'BeRocket_products_label_domain' ) . '</a>',
				'premium'    => '<a href="http://berocket.com/product/'.self::$values['premium_slug'].'" title="' . __( 'View Premium Version Page', 'BeRocket_products_label_domain' ) . '" target="_blank">' . __( 'Premium Version', 'BeRocket_products_label_domain' ) . '</a>',
			);

			return array_merge( $links, $row_meta );
		}
		return (array) $links;
    }
    public static function widgets_init() {
        register_widget("berocket_compare_products_widget");
    }

    public static function activation () {
        $options = BeRocket_Compare_Products::get_compare_products_option ( 'br_compare_products_general_settings' );
        if ( ! $options['compare_page'] ) {
            $compare_page = array(
                'post_title' => 'Compare',
                'post_content' => '',
                'post_status' => 'publish',
                'post_type' => 'page',
            );

            $post_id = wp_insert_post($compare_page);
            $options = BeRocket_Compare_Products::get_compare_products_option ( 'br_compare_products_general_settings' );
            $options['compare_page'] = $post_id;
            update_option('br_compare_products_general_settings', $options);
        }
    }

    public static function compare_list() {
        set_query_var( 'is_full_screen', true );
        self::br_get_template_part('compare');
        wp_die();
    }

    public static function compare_page ($content) {
        global $wp_query, $br_wp_query_not_main;
        $options = BeRocket_Compare_Products::get_compare_products_option ( 'br_compare_products_general_settings' );
        $page = $options['compare_page'];
        $page_id = @ $wp_query->queried_object->ID;
        if( ! empty( $page_id ) ) {
            $default_language = apply_filters( 'wpml_default_language', NULL );
            $page_id = apply_filters( 'wpml_object_id', $page_id, 'page', true, $default_language );
            if ( $page == @ $page_id && ! @ $br_wp_query_not_main ) {
                ob_start();
                $br_compare_uri = add_query_arg('compare', self::$compare_cookie, get_page_link($page));
                ?>
                <script>
                var br_compare_page = "<?php echo get_page_link($page); ?>";
                var br_compare_uri = "<?php echo $br_compare_uri; ?>";
                jQuery(document).ready(function() {
                    
                });
                </script>
                <?php if( @ $options['addthisID'] ) { ?>
                <div class="addthis_sharing_toolbox" data-url="<?php echo esc_url_raw($br_compare_uri); ?>"></div>
                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=<?php echo esc_html($options['addthisID']); ?>"></script>
                <?php
                }
                self::br_get_template_part('compare');
                $br_wp_query_not_main = true;
                $content .= ob_get_clean();
            }
        }
        return $content;
    }

    public static function init () {
        if( is_admin() ) {
            wp_register_style( 'font-awesome', plugins_url( 'css/font-awesome.min.css', __FILE__ ) );
            wp_enqueue_style( 'font-awesome' );
        } else {
            self::enqueue_fontawesome();
        }
        wp_register_style( 'berocket_compare_products_style', plugins_url( 'css/products_compare.css', __FILE__ ), "", BeRocket_Compare_Products_version );
        wp_enqueue_style( 'berocket_compare_products_style' );
        wp_enqueue_script( 'berocket_jquery_cookie', plugins_url( 'js/jquery.cookie.js', __FILE__ ), array( 'jquery' ), BeRocket_Compare_Products_version );
        wp_enqueue_script( 'berocket_compare_products_script', plugins_url( 'js/products_compare.js', __FILE__ ), array( 'jquery' ), BeRocket_Compare_Products_version );
        wp_enqueue_script( 'jquery-mousewheel', plugins_url( 'js/jquery.mousewheel.min.js', __FILE__ ), array( 'jquery' ), BeRocket_Compare_Products_version );
        $javascript = BeRocket_Compare_Products::get_compare_products_option ( 'br_compare_products_javascript_settings' );
        wp_localize_script(
            'berocket_compare_products_script',
            'the_compare_products_data',
            array(
                'ajax_url'      => admin_url( 'admin-ajax.php' ),
                'user_func'     => $javascript,
                'home_url'      => site_url(),
                'hide_same'     => __( 'Hide attributes with same values', 'BeRocket_Compare_Products_domain' ),
                'show_same'     => __( 'Show attributes with same values', 'BeRocket_Compare_Products_domain' ),
            )
        );
    }

    public static function admin_init () {
        wp_enqueue_script( 'berocket_aapf_widget-colorpicker', plugins_url( 'js/colpick.js', __FILE__ ), array( 'jquery' ) );
        wp_enqueue_script( 'berocket_compare_products_admin_script', plugins_url( 'js/admin.js', __FILE__ ), array( 'jquery' ) );
        wp_register_style( 'berocket_aapf_widget-colorpicker-style', plugins_url( 'css/colpick.css', __FILE__ ) );
        wp_enqueue_style( 'berocket_aapf_widget-colorpicker-style' );
        wp_register_style( 'berocket_compare_products_admin_style', plugins_url( 'css/admin.css', __FILE__ ), "", BeRocket_Compare_Products_version );
        wp_enqueue_style( 'berocket_compare_products_admin_style' );
        register_setting('br_compare_products_general_settings', 'br_compare_products_general_settings', array( __CLASS__, 'sanitize_compare_products_option' ));
        register_setting('br_compare_products_style_settings', 'br_compare_products_style_settings', array( __CLASS__, 'sanitize_compare_products_option' ));
        register_setting('br_compare_products_text_settings', 'br_compare_products_text_settings', array( __CLASS__, 'sanitize_compare_products_option' ));
        register_setting('br_compare_products_javascript_settings', 'br_compare_products_javascript_settings', array( __CLASS__, 'sanitize_compare_products_option' ));
        register_setting('br_compare_products_license_settings', 'br_compare_products_license_settings', array( __CLASS__, 'sanitize_compare_products_option' ));
        add_settings_section( 
            'br_compare_products_general_page',
            'General Settings',
            'br_compare_products_general_callback',
            'br_compare_products_general_settings'
        );

        add_settings_section( 
            'br_compare_products_style_page',
            'Style Settings',
            'br_compare_products_style_callback',
            'br_compare_products_style_settings'
        );

        add_settings_section( 
            'br_compare_products_text_page',
            'Style Settings',
            'br_compare_products_text_callback',
            'br_compare_products_text_settings'
        );

        add_settings_section( 
            'br_compare_products_javascript_page',
            'JavaScript Settings',
            'br_compare_products_javascript_callback',
            'br_compare_products_javascript_settings'
        );

        add_settings_section( 
            'br_compare_products_license_page',
            'License Settings',
            'br_compare_products_license_callback',
            'br_compare_products_license_settings'
        );
    }

    public static function options() {
        add_submenu_page( 'woocommerce', __('Compare Products settings', 'BeRocket_Compare_Products_domain'), __('Compare Products', 'BeRocket_Compare_Products_domain'), 'manage_options', 'br-compare-products', array(
            __CLASS__,
            'option_form'
        ) );
    }
    /**
     * Function add options form to settings page
     *
     * @access public
     *
     * @return void
     */
    public static function option_form() {
        $plugin_info = get_plugin_data(__FILE__, false, true);
        $paid_plugin_info = self::$info;
        include Compare_Products_TEMPLATE_PATH . "settings.php";
    }
    /**
     * Load template
     *
     * @access public
     *
     * @param string $name template name
     *
     * @return void
     */
    public static function br_get_template_part( $name = '' ) {
        $template = '';

        // Look in your_child_theme/woocommerce-filters/name.php
        if ( $name ) {
            $template = locate_template( "woocommerce-compare-products/{$name}.php" );
        }

        // Get default slug-name.php
        if ( ! $template && $name && file_exists( Compare_Products_TEMPLATE_PATH . "{$name}.php" ) ) {
            $template = Compare_Products_TEMPLATE_PATH . "{$name}.php";
        }

        // Allow 3rd party plugin filter template file from their plugin
        $template = apply_filters( 'compare_products_get_template_part', $template, $name );

        if ( $template ) {
            load_template( $template, false );
        }
    }
    public static function get_compare_button() {
        global $product, $wp_query;
        $product_id = br_wc_get_product_id($product);
        $product_id = intval($product_id);
        $default_language = apply_filters( 'wpml_default_language', NULL );
        $product_id = apply_filters( 'wpml_object_id', $product_id, 'product', true, $default_language );
        $options = BeRocket_Compare_Products::get_compare_products_option ( 'br_compare_products_general_settings' );
        $text = BeRocket_Compare_Products::get_compare_products_option ( 'br_compare_products_text_settings' );
        $page_compare = intval($options['compare_page']);
        $button_class = array(
            'add_to_cart_button',
            'button',
            'br_compare_button',
            'br_product_'.$product_id
        );
        if ( self::is_set_cookie($product_id) ) {
            $button_class[] = 'br_compare_added';
        }
        if ( ! empty($options['fast_compare']) ) {
            $button_class[] = 'berocket_product_smart_compare';
        }
        $button_class = implode(' ', $button_class);
        $button_class = esc_html($button_class);
        echo '<a class="'.$button_class.'" data-id="'.$product_id.'" href="'.get_page_link($page_compare).'">
        <i class="fa fa-square-o"></i>
        <i class="fa fa-check-square-o"></i>
        <span class="br_compare_button_text" data-added="'.htmlentities($text['added_compare']).'" data-not_added="'.htmlentities($text['add_compare']).'">'.( self::is_set_cookie($product_id) ? htmlentities($text['added_compare']) : htmlentities($text['add_compare']) ).'</span></a>';
    }
    public static function get_all_compare_products() {
        if ( ! empty(self::$compare_cookie) ) {
            $cookie = self::$compare_cookie;
            $products = explode( ',', $cookie );
            $products_esc = array();
            foreach($products as $product) {
                $products_esc[] = intval($product);
            }
            return $products_esc;
        } else {
            return false;
        }
    }
    public static function is_set_cookie( $id ) {
        if ( ! empty(self::$compare_cookie) ) {
            $cookie = self::$compare_cookie;
            if ( preg_match( "/(^".$id.",)|(,".$id."$)|(,".$id.",)|(^".$id."$)/", $cookie ) ) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public static function listener_products() {
        set_query_var( 'type', 'image' );
        self::br_get_template_part('selected_products');
        wp_die();
    }
    public static function sanitize_compare_products_option( $input ) {
        $default = BeRocket_Compare_Products::$defaults[$input['settings_name']];
        $result = self::recursive_array_set( $default, $input );
        if( count(self::$global_settings) && $input['settings_name'] == 'br_compare_products_javascript_settings' ) {
            $global_options = self::get_global_option();
            foreach(self::$global_settings as $global_setting) {
                if( isset($result[$global_setting]) ) {
                    $global_options[$global_setting] = $result[$global_setting];
                }
            }
            self::save_global_option($global_options);
        }
        return $result;
    }
    public static function recursive_array_set( $default, $options ) {
        foreach( $default as $key => $value ) {
            if( array_key_exists( $key, $options ) ) {
                if( is_array( $value ) ) {
                    if( is_array( $options[$key] ) ) {
                        $result[$key] = self::recursive_array_set( $value, $options[$key] );
                    } else {
                        $result[$key] = self::recursive_array_set( $value, array() );
                    }
                } else {
                    $result[$key] = $options[$key];
                }
            } else {
                if( is_array( $value ) ) {
                    $result[$key] = self::recursive_array_set( $value, array() );
                } else {
                    $result[$key] = '';
                }
            }
        }
        foreach( $options as $key => $value ) {
            if( ! array_key_exists( $key, $result ) ) {
                $result[$key] = $value;
            }
        }
        return $result;
    }
    public static function get_compare_products_option( $option_name ) {
        $options = get_option( $option_name );
        if ( @ $options && is_array ( $options ) ) {
            $options = array_merge( BeRocket_Compare_Products::$defaults[$option_name], $options );
        } else {
            $options = BeRocket_Compare_Products::$defaults[$option_name];
        }
        $global_options = self::get_global_option();
        if( count(self::$global_settings) && $option_name == 'br_compare_products_javascript_settings' ) {
            foreach(self::$global_settings as $global_setting) {
                if( isset($global_options[$global_setting]) ) {
                    $options[$global_setting] = $global_options[$global_setting];
                }
            }
        }
        return $options;
    }
    public static function wp_head_style() {
        $options = BeRocket_Compare_Products::get_compare_products_option ( 'br_compare_products_style_settings' );
        echo '<style>';
        echo '.berocket_compare_widget_start .berocket_compare_widget .berocket_open_compare ,';
        echo '.berocket_compare_widget_toolbar .berocket_compare_widget .berocket_open_compare {';
        echo 'border-color: #'.str_replace( '#', '', $options['button']['bcolor'] ).';';
        echo 'border-width: '.$options['button']['bwidth'].'px;';
        echo 'border-radius: '.$options['button']['bradius'].'px;';
        echo 'font-size: '.$options['button']['fontsize'].'px;';
        echo 'color: #'.str_replace( '#', '', $options['button']['fcolor'] ).';';
        echo 'background-color: #'.str_replace( '#', '', $options['button']['backcolor'] ).';';
        echo '}';
        echo '.berocket_compare_box .br_moved_attr tr td {';
        echo 'background-color: #'.str_replace( '#', '', $options['table']['backcolor'] ).';';
        echo '}';
        echo '.berocket_compare_box .berocket_compare_table_hidden {';
        echo 'background-color: #'.str_replace( '#', '', $options['table']['backcolor'] ).';';
        echo '}';
        echo 'div.berocket_compare_box.berocket_full_screen_box {';
        echo 'background-color: #'.str_replace( '#', '', $options['table']['backcolor'] ).';';
        echo '}';
        echo 'div.berocket_compare_box .berocket_compare_table td {';
        echo 'min-width: '.$options['table']['colwidth'].'px;';
        echo '}';
        echo 'div.berocket_compare_box .br_moved_attr tr td {';
        echo 'min-width: '.$options['table']['colwidth'].'px;';
        echo '}';
        echo '.berocket_compare_box .berocket_compare_table img {';
        echo 'width: '.$options['table']['imgwidth'].'px;';
        echo '}';
        echo '</style>';
    }
    public static $global_settings = array(
        'fontawesome_frontend_disable',
        'fontawesome_frontend_version',
    );
    public static function enqueue_fontawesome($force = false) {
        if( ! wp_style_is('font-awesome-5-compat', 'registered') ) {
            wp_register_style( 'font-awesome', plugins_url( 'css/font-awesome.min.css', __FILE__ ) );
            wp_register_style( 'font-awesome-5', plugins_url( 'css/fontawesome5.min.css', __FILE__ ) );
            wp_register_style( 'font-awesome-5-compat', plugins_url( 'css/fontawesome4-compat.min.css', __FILE__ ) );
        }
        $global_option = self::get_global_option();
        if( empty($global_option['fontawesome_frontend_disable']) ) {
            if( br_get_value_from_array($global_option, 'fontawesome_frontend_version') == 'fontawesome5' ) {
                wp_enqueue_style( 'font-awesome-5' );
            } else {
                wp_enqueue_style( 'font-awesome' );
            }
        } else {
            if( br_get_value_from_array($global_option, 'fontawesome_frontend_version') == 'fontawesome5' ) {
                wp_enqueue_style( 'font-awesome-5-compat' );
            }
        }
    }
    public static function get_global_option() {
        $option = get_option('berocket_framework_option_global');
        if( ! is_array($option) ) {
            $option = array();
        }
        return $option;
    }
    public static function save_global_option($option) {
        $option = update_option('berocket_framework_option_global', $option);
        return $option;
    }
}

new BeRocket_Compare_Products;

berocket_admin_notices::generate_subscribe_notice();

/**
 * Creating admin notice if it not added already
 */
if( ! function_exists('BeRocket_generate_sales_2018') ) {
    function BeRocket_generate_sales_2018($data = array()) {
        if( time() < strtotime('-7 days', $data['end']) ) {
            $close_text = 'hide this for 7 days';
            $nothankswidth = 115;
        } else {
            $close_text = 'not interested';
            $nothankswidth = 90;
        }
        $data = array_merge(array(
            'righthtml'  => '<a class="berocket_no_thanks">'.$close_text.'</a>',
            'rightwidth'  => ($nothankswidth+20),
            'nothankswidth'  => $nothankswidth,
            'contentwidth'  => 400,
            'subscribe'  => false,
            'priority'  => 15,
            'height'  => 50,
            'repeat'  => '+7 days',
            'repeatcount'  => 3,
            'image'  => array(
                'local' => plugin_dir_url( __FILE__ ) . 'images/44p_sale.jpg',
            ),
        ), $data);
        new berocket_admin_notices($data);
    }
    BeRocket_generate_sales_2018(array(
        'start'         => 1529532000,
        'end'           => 1530392400,
        'name'          => 'SALE_LABELS_2018',
        'for_plugin'    => array('id' => 18, 'version' => '2.0', 'onlyfree' => true),
        'html'          => 'Save <strong>$20</strong> with <strong>Premium Product Labels</strong> today!
     &nbsp; <span>Get your <strong class="red">44% discount</strong> now!</span>
     <a class="berocket_button" href="https://berocket.com/product/woocommerce-advanced-product-labels" target="_blank">Save $20</a>',
    ));
    BeRocket_generate_sales_2018(array(
        'start'         => 1530396000,
        'end'           => 1531256400,
        'name'          => 'SALE_MIN_MAX_2018',
        'for_plugin'    => array('id' => 9, 'version' => '2.0', 'onlyfree' => true),
        'html'          => 'Save <strong>$20</strong> with <strong>Premium Min/Max Quantity</strong> today!
     &nbsp; <span>Get your <strong class="red">44% discount</strong> now!</span>
     <a class="berocket_button" href="https://berocket.com/product/woocommerce-minmax-quantity" target="_blank">Save $20</a>',
    ));
    BeRocket_generate_sales_2018(array(
        'start'         => 1531260000,
        'end'           => 1532120400,
        'name'          => 'SALE_LOAD_MORE_2018',
        'for_plugin'    => array('id' => 3, 'version' => '2.0', 'onlyfree' => true),
        'html'          => 'Save <strong>$20</strong> with <strong>Premium Load More Products</strong> today!
     &nbsp; <span>Get your <strong class="red">44% discount</strong> now!</span>
     <a class="berocket_button" href="https://berocket.com/product/woocommerce-load-more-products" target="_blank">Save $20</a>',
    ));
}
