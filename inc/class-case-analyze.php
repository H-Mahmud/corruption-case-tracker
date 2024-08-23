<?php
defined('ABSPATH') || exit();
if (!class_exists('CCT_Case_Analyze')) {
    class CCT_Case_Analyze
    {
        public static function count_cases_by_year()
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
    }
}
