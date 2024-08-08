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

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $query['posts_per_page'] = 10;
        $query['paged'] = $paged;


        $query['meta_query']['relation'] = 'AND';
        // Meta query condition by condition
        $meta_query_and = array('relation' => 'AND');
        $meta_query_or = array('relation' => 'OR');

        if (isset($_GET['case_status']) && !empty($_GET['case_status'])) {

            $case_nature = array(
                'key' => 'case_status',
                'value' => $_GET['case_status'],
                'compare' => '=',
            );

            array_push($meta_query_and, $case_nature);
        }


        if (isset($_GET['jurisdiction']) && !empty($_GET['jurisdiction'])) {

            $jurisdiction = array(
                'key' => 'jurisdiction',
                'value' => $_GET['jurisdiction'],
                'compare' => '=',
            );

            array_push($meta_query_and, $jurisdiction);
        }

        if (isset($_GET['sector_of_the_case']) && !empty($_GET['sector_of_the_case'])) {

            $sector_of_the_case = array(
                'key' => 'sector_of_the_case',
                'value' => $_GET['sector_of_the_case'],
                'compare' => '=',
            );

            array_push($meta_query_and, $sector_of_the_case);
        }


        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $query['s'] = $_GET['search'];

            $nature_of_the_case = array(
                'key' => 'nature_of_the_case',
                'value' => $_GET['search'],
                'compare' => 'LIKE',
            );

            $summary_of_the_case = array(
                'key' => 'summary_of_the_case',
                'value' => $_GET['search'],
                'compare' => 'LIKE',
            );

            // $query['cct-search'] = true;


            array_push($meta_query_or, $nature_of_the_case, $summary_of_the_case);
            // array_push($meta_query_or, $summary_of_the_case);

        }

        $query['meta_query'][] = $meta_query_and;
        // $query['meta_query'][] = $meta_query_or;
        // $query['meta_query'][] = $meta_query_or;



        // echo "<pre>";
        // var_dump($query);
        // echo '</pre>';
        // wp_die();
        return new WP_Query($query);
    }
}


function cct_cases_where($where, $query)
{
    global $wpdb;

    // return $where;

    if ($query->get('cct-search') && !is_admin()) {
        // Search term
        $search_term = $query->get('search');

        // Add the OR conditions to the WHERE clause
        $where .= " OR ({$wpdb->postmeta}.meta_key = 'nature_of_the_case' AND {$wpdb->postmeta}.meta_value LIKE '%" . esc_sql($wpdb->esc_like($search_term)) . "%')";
        $where .= " OR ({$wpdb->postmeta}.meta_key = 'summary_of_the_case' AND {$wpdb->postmeta}.meta_value LIKE '%" . esc_sql($wpdb->esc_like($search_term)) . "%')";
    }

    return $where;
}
add_filter('posts_where', 'cct_cases_where', 10, 2);

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
