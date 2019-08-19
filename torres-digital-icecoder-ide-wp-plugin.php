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
                'title' => 'My Sub Menu Item',
                'href'  => '#',
                'meta'  => array(
                    'title' => __('My Sub Menu Item'),
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



/*
* add a group of links under a parent link
*/

// Add a parent shortcut link

function custom_toolbar_link($wp_admin_bar) {
    $args = array(
        'id' => 'wpbeginner',
        'title' => 'WPBeginner',
        'href' => 'https://www.wpbeginner.com',
        'meta' => array(
            'class' => 'wpbeginner',
            'title' => 'Visit WPBeginner'
            )
    );
    $wp_admin_bar->add_node($args);

// Add the first child link

    $args = array(
        'id' => 'wpbeginner-guides',
        'title' => 'WPBeginner Guides',
        'href' => 'https://www.wpbeginner.com/category/beginners-guide/',
        'parent' => 'wpbeginner',
        'meta' => array(
            'class' => 'wpbeginner-guides',
            'title' => 'Visit WordPress Beginner Guides'
            )
    );
    $wp_admin_bar->add_node($args);

// Add another child link
$args = array(
        'id' => 'wpbeginner-tutorials',
        'title' => 'WPBeginner Tutorials',
        'href' => 'https://www.wpbeginner.com/category/wp-tutorials/',
        'parent' => 'wpbeginner',
        'meta' => array(
            'class' => 'wpbeginner-tutorials',
            'title' => 'Visit WPBeginner Tutorials'
            )
    );
    $wp_admin_bar->add_node($args);

// Add a child link to the child link

$args = array(
        'id' => 'wpbeginner-themes',
        'title' => 'WPBeginner Themes',
        'href' => 'https://www.wpbeginner.com/category/wp-themes/',
        'parent' => 'wpbeginner-tutorials',
        'meta' => array(
            'class' => 'wpbeginner-themes',
            'title' => 'Visit WordPress Themes Tutorials on WPBeginner'
            )
    );
    $wp_admin_bar->add_node($args);

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
