<?php /* The Silence is Gold!

Plugin Name: Torres Digital ICECoder IDE WP Plugin
Plugin URI: http://torresdigital.com.br/
Description: ❉ This plugin allows the <strong>ICECoder IDE</strong> to be accessed directly through the Wordpress Panel. Simple as that, simple as life should be. Source Code on GitHub https://github.com/icecoder/ICEcoder | ICECoder IDE Site - https://icecoder.net/
Version: 1.o
Author: Torres Digital -Sites → Lojas Virtuais e e-Commerce
Author URI: https://facebook.com/torresdigital */

     /**
        *Torres Digital ICECoder IDE WP Plugin By Torres Digital ! // Source https://extreme-ip-lookup.com/
        *
        */
        add_action('admin_bar_menu', 'add_toolbar_items', 100);
        function add_toolbar_items($admin_bar){
            $admin_bar->add_menu( array(
                'id'    => 'icecoder-ide',
                'title' => ' ❉ ICECoder IDE - Login',
                'href'  => '/wp-content/plugins/torres-digital-icecoder-ide-wp-plugin/ICEcoder/',
                'meta'  => array(
                    'title' => __('ICECoder IDE - Login'),
                    'target' => '_blank',
                    'class' => 'icecoder-ide'
                ),
            ));
            $admin_bar->add_menu( array(
                'id'    => 'icecoder-ide-sub-item',
                'parent' => 'icecoder-ide',
                'title' => 'Torres Digital - facebook',
                'href'  => 'https://www.facebook.com/torresdigital/',
                'meta'  => array(
                    'title' => __('Torres Digital - facebook'),
                    'target' => '_blank',
                    'class' => 'my_menu_item_class'
                ),
            ));
            $admin_bar->add_menu( array(
                'id'    => 'icecoder-ide-second-sub-item',
                'parent' => 'icecoder-ide',
                'title' => 'Torres Digital -Sites → Lojas Virtuais e e-Commerce',
                'href'  => 'https://www.torresdigital.tk/',
                'meta'  => array(
                    'title' => __('Torres Digital -Sites → Lojas Virtuais e e-Commerce'),
                    'target' => '_blank',
                    'class' => 'my_menu_item_class'
                ),
            ));
        }

add_action('admin_bar_menu', 'custom_toolbar_link', 999);

 add_action( 'admin_menu', 'linked_url' );
    function linked_url() {
    add_menu_page( 'linked_url', 'External link', 'read', 'my_slug', '', 'dashicons-text', 1 );
    }

    add_action( 'admin_menu' , 'linkedurl_function' );
    function linkedurl_function() {
    global $menu;
    $menu[1][2] = "http://www.example.com";
    }

/* Style */
function wpse_load_plugin_css() {
    $plugin_url = plugin_dir_url( __FILE__ );

    wp_enqueue_style( 'style', $plugin_url . 'css/style.css' );
    wp_enqueue_style( 'style2', $plugin_url . 'css/style2.css' );

}
add_action( 'wp_enqueue_scripts', 'wpse_load_plugin_css' );

?>
