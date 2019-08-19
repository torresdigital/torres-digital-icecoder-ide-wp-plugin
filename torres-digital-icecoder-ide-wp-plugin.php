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
                'id'    => 'my-sub-item',
                'parent' => 'my-item',
                'title' => 'My Sub Menu Item',
                'href'  => '#',
                'meta'  => array(
                    'title' => __('My Sub Menu Item'),
                    'target' => '_blank',
                    'class' => 'my_menu_item_class'
                ),
            ));
            $admin_bar->add_menu( array(
                'id'    => 'my-second-sub-item',
                'parent' => 'my-item',
                'title' => 'My Second Sub Menu Item',
                'href'  => '#',
                'meta'  => array(
                    'title' => __('My Second Sub Menu Item'),
                    'target' => '_blank',
                    'class' => 'my_menu_item_class'
                ),
            ));
        }

/* Style */
function wpse_load_plugin_css() {
    $plugin_url = plugin_dir_url( __FILE__ );

    wp_enqueue_style( 'style', $plugin_url . 'css/style.css' );
    wp_enqueue_style( 'style2', $plugin_url . 'css/style2.css' );

}
add_action( 'wp_enqueue_scripts', 'wpse_load_plugin_css' );

?>
