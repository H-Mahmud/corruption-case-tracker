<?php
defined('ABSPATH') || exit();
/**
 * Class to analyze cases data purpose present on chart
 * 
 */
class CCT_Case_Analyze
{
    /**
     * Get all cases count by year
     *
     * @return int[]
     */
    public static function get_all_cases_count()
    {
        global $wpdb;
        $results = $wpdb->get_results("
                SELECT YEAR(post_date) as year, COUNT(*) as count 
                FROM {$wpdb->posts}
                WHERE post_type = 'case' AND post_status = 'publish'
                GROUP BY YEAR(post_date)
                ORDER BY YEAR(post_date) DESC
            ");

        $year_counts = array();
        foreach ($results as $result) {
            $year_counts[$result->year] = (int) $result->count;
        }

        return $year_counts;
    }


    /**
     * Get Average case duration by case status
     * Retrieve all case duration data from case_date_data table
     * 
     * @param string $status case status
     * @return int average duration
     */
    public static function get_average_duration($status)
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'case_date_data';
        $query = $wpdb->prepare(
            "
            SELECT
                DATEDIFF(end_date, start_date) AS duration
            FROM
                $table_name
            WHERE
                status = %s
            ",
            $status
        );

        $results = $wpdb->get_results($query);
        if (empty($results))
            return 0;

        $count = count($results);
        $total_duration = 0;

        foreach ($results as $row) {
            $total_duration += $row->duration;
        }

        $average_duration = $total_duration / $count;

        return intval($average_duration);
    }


    /**
     * Cases count by moth for a year
     * 
     * @param int $year full year
     * @return array case count by month
     */
    public static function get_cases_count_for_year($year)
    {
        global $wpdb;
        $results = $wpdb->get_results($wpdb->prepare("
        SELECT 
            MONTHNAME(p.post_date) AS month_name, 
            COUNT(*) AS post_count 
        FROM 
            $wpdb->posts p 
        WHERE 
            p.post_type = 'case' 
            AND p.post_status = 'publish' 
            AND YEAR(p.post_date) = %d 
        GROUP BY 
            MONTH(p.post_date)
        ORDER BY 
            MONTH(p.post_date)
    ", $year), OBJECT_K);

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


    /**
     * Get total case count for post meta
     * 
     * @param string $meta_key
     * @param string $meta_value
     * @return int|mixed
     */
    public static function get_all_cases_count_for_meta($meta_key, $meta_value, $compare = '=')
    {
        $args = array(
            'post_type' => 'case',
            'meta_key' => $meta_key,
            'meta_value' => $meta_value,
            'meta_compare' => $compare,
            'posts_per_page' => -1,
            'fields' => 'ids',
        );

        $query = new WP_Query($args);

        return $query->found_posts;
    }



    /**
     * Get total amount involved for given case meta
     * 
     * @param string $meta_key case meta key
     * @param string $meta_value case meta value
     * @param string $involved_key meta key for amount involved
     * @param string $value_compare operator for comparing meta values. Default is '='.
     * @return int total amount involved
     */
    public static function get_amount_involved($meta_key, $meta_value, $involved_key, $value_compare = '=')
    {
        global $wpdb;
        $query = $wpdb->prepare("
        SELECT SUM(pm2.meta_value) as total_involved
        FROM {$wpdb->posts} as p
        JOIN {$wpdb->postmeta} as pm1 ON p.ID = pm1.post_id
        JOIN {$wpdb->postmeta} as pm2 ON p.ID = pm2.post_id
        WHERE p.post_type = 'case'
        AND p.post_status = 'publish'
        AND pm1.meta_key = %s
        AND pm1.meta_value $value_compare %s
        AND pm2.meta_key = %s
    ", $meta_key, $meta_value, $involved_key);

        $result = $wpdb->get_var($query);
        return $result ? $result : 0;
    }
}

