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

/**
 * Generate Random RGBA colors
 * 
 * @return string
 */
function cct_get_rand_rgb_color_value()
{
    // Generate three random values between 0 and 255
    $r = rand(0, 255);
    $g = rand(0, 255);
    $b = rand(0, 255);

    // Calculate the luminance of the color to check contrast
    $luminance = (0.2126 * $r + 0.7152 * $g + 0.0722 * $b) / 255;

    // If the luminance is too high (too bright) or too low (too dark), adjust the color
    if ($luminance > 0.8) {
        // If too bright, make it darker
        $r = max(0, $r - 128);
        $g = max(0, $g - 128);
        $b = max(0, $b - 128);
    } elseif ($luminance < 0.2) {
        // If too dark, make it brighter
        $r = min(255, $r + 128);
        $g = min(255, $g + 128);
        $b = min(255, $b + 128);
    }

    return sprintf("%d, %d, %d", $r, $g, $b);
}

/**
 * Count Case post for full year
 * @param mixed $year
 * @return int[]
 */
function get_cases_count_by_month($year, $status)
{
    global $wpdb;

    $results = $wpdb->get_results($wpdb->prepare("
        SELECT 
            MONTHNAME(p.post_date) AS month_name, 
            COUNT(*) AS post_count 
        FROM 
            $wpdb->posts p 
        INNER JOIN 
            $wpdb->postmeta pm ON p.ID = pm.post_id 
        WHERE 
            p.post_type = 'case' 
            AND p.post_status = 'publish' 
            AND pm.meta_key = 'case_status' 
            AND pm.meta_value = '%s' 
            AND YEAR(p.post_date) = %d 
        GROUP BY 
            MONTH(p.post_date)
        ORDER BY 
            MONTH(p.post_date)
    ", $status, $year), OBJECT_K);

    $months = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December'
    ];

    $month_counts = array_fill_keys($months, 0);

    foreach ($results as $month_name => $result) {
        $month_counts[$month_name] = $result->post_count;
    }

    return $month_counts;
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

if (!function_exists('cct_summery_cb')) {
    add_shortcode('cct-summery', 'cct_summery_cb');
    function cct_summery_cb()
    {
        ob_start();

        include (plugin_dir_path(__FILE__) . 'templates/cct-summery.php');

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
        // wp_enqueue_script('cct-script', plugin_dir_url(__FILE__) . 'assets/cct.bundle.js', [], time());
    }
}
