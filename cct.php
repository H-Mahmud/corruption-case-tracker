<?php
/*
 * Plugin Name:       Corruption Case Tracker
 * Plugin URI:        https://github.com/H-Mahmud/corruption-case-tracker/
 * Description:       The Corruption Case Tracker plugin is an essential tool designed to create an online platform that tracks and presents data on corruption cases in Liberia. This plugin makes vital information accessible to anti-corruption advocates, donor partners, and stakeholders, aiming to bridge the data gap and support integrity-related advocacy.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Dream Developer
 * Author URI:        https://dreamdeveloper.org/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       cct
 * Domain Path:       /languages
 * Requires Plugins:  advanced-custom-fields
 */
defined("ABSPATH") OR exit("No direct script access allowed");

if(!function_exists('cct_home_cb')) {
    add_shortcode('cct-home', 'cct_home_cb');
    function cct_home_cb() {
        ob_start();

        include( plugin_dir_path(__FILE__) . 'templates/cct-home.php');
        
        $content = ob_get_contents();
        ob_clean();

        return $content;
    }
}

if(!function_exists('cct_enqueues')) {
    add_action('wp_enqueue_scripts', 'cct_enqueues');
    function cct_enqueues() {
        wp_enqueue_style('cct-style', plugin_dir_url(__FILE__) . 'assets/cct-style.css', [],time());
    }
}
