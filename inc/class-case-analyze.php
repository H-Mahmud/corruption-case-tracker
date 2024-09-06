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

        /**
         * Get Average duration by case status from date data table
         * @param string $status case status
         * @return int average date
         */
        public static function get_average_duration_by_status($status)
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

            $total_duration = 0;
            $count = count($results);

            foreach ($results as $row) {
                $total_duration += $row->duration;
            }

            $average_duration = $total_duration / $count;

            return intval($average_duration);
        }

    }
}
