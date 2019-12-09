<?php
/**
 * Plugin Name:       Your Plugin Name
 * Description:       Your Plugin Description
 * Version:           1.0.0
 * Author:            Dirango
 * Author URI:        https://dirango.com
 */

class YourPlugin
{
    public function __construct()
    {
        add_action('init', array($this, 'initialize_plugin'), 4);
        add_action('wp_enqueue_scripts', array($this, 'initialize_styles'));
        add_action('wp_enqueue_scripts', array($this, 'initialize_scripts'));
    }


    public function initialize_scripts() {
        // enqueue your JS file


        // wp_enqueue_script ( 'mcast_header_slider_script', plugin_dir_url( __FILE__ ) . 'elements/header-slider/dist/js/main.js', null, null, true);
    }

    public function initialize_styles() {
        // enqueue your css file

        // wp_enqueue_style( 'mcast_header_slider_styles',  plugin_dir_url( __FILE__ ) . 'elements/header-slider/dist/css/main.css' );
    }

    public function initialize_plugin()
    {
        // require your element file(s)

        // require_once plugin_dir_path(__FILE__) . '/elements/header-slider/header-slider.php';
    }
}


new YourPlugin();
