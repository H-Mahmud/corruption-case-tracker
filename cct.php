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
defined("ABSPATH") or exit("No direct script access allowed");

if (!function_exists('get_cct_cases')) {
    function get_cct_cases()
    {
        // Initial query
        $query = array();

        // Set Post type
        $query['post_type'] = 'case';

        // Meta query condition
        $query['meta_query']['relation'] = 'AND';

        if (isset($_GET['case_status']) && !empty($_GET['case_status'])) {
            $case_nature['key'] = 'case_status';
            $case_nature['value'] = $_GET['case_status'];
            $case_nature['compare'] = '=';
            $query['meta_query'][] = $case_nature;
        }


        if (isset($_GET['jurisdiction']) && !empty($_GET['jurisdiction'])) {
            $jurisdiction['key'] = 'jurisdiction';
            $jurisdiction['value'] = $_GET['jurisdiction'];
            $jurisdiction['compare'] = '=';
            $query['meta_query'][] = $jurisdiction;
        }

        if (isset($_GET['sector_of_the_case']) && !empty($_GET['sector_of_the_case'])) {
            $sector_of_the_case['key'] = 'sector_of_the_case';
            $sector_of_the_case['value'] = $_GET['sector_of_the_case'];
            $sector_of_the_case['compare'] = '=';
            $query['meta_query'][] = $sector_of_the_case;
        }


        // echo "<pre>";
        // var_dump($query);
        // echo '</pre>';
        // wp_die();
        return new WP_Query($query);
    }
}

if (!function_exists('cct_get_field_options')) {
    function cct_get_field_options($field_key)
    {
        $field = acf_get_field($field_key);
        if ($field) {
            return $field['choices'];
        }
        return [];
    }
}

if (!function_exists('cct_home_cb')) {
    add_shortcode('cct-home', 'cct_home_cb');
    function cct_home_cb()
    {
        ob_start();

        include (plugin_dir_path(__FILE__) . 'templates/cct-home.php');

        $content = ob_get_contents();
        ob_clean();

        return $content;
    }
}

if (!function_exists('cct_enqueues')) {
    add_action('wp_enqueue_scripts', 'cct_enqueues');
    function cct_enqueues()
    {
        wp_enqueue_style('cct-style', plugin_dir_url(__FILE__) . 'assets/cct-style.css', [], time());
    }
}
