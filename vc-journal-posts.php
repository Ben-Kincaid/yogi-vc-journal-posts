<?php

/**
 * Plugin Name:       Journal Posts
 * Description:       Display list of posts
 * Version:           0.0.1
 * Author:            Dirango
 * Author URI:        https://dirango.com
 */

class VCJournalPosts
{
    public function __construct()
    {
        add_action('init', array($this, 'initialize_plugin'), 4);
        add_action('wp_enqueue_scripts', array($this, 'initialize_styles'));
        add_action('wp_enqueue_scripts', array($this, 'initialize_scripts'));




        add_action('wp_enqueue_scripts', array($this, 'load_dashicons'));
    }

    public function load_dashicons()
    {
        wp_enqueue_style('dashicons');
    }

    public function initialize_scripts()
    {
        // enqueue your JS file


        // wp_enqueue_script ( 'mcast_header_slider_script', plugin_dir_url( __FILE__ ) . 'elements/header-slider/dist/js/main.js', null, null, true);
    }

    public function initialize_styles()
    {
        // enqueue your css file

        wp_enqueue_style('vc-journal-posts-styles',  plugin_dir_url(__FILE__) . 'elements/journal-posts/dist/css/main.css');
    }

    public function initialize_plugin()
    {
        // require your element file(s)

        require_once plugin_dir_path(__FILE__) . '/elements/journal-posts/journal-posts-config.php';
    }
}


new VCJournalPosts();
