<?php
if (!class_exists('CCT_Utils')) {
    class CCT_Utils
    {

        /**
         * Summary of get_field_options
         * 
         * Get ACF meta field dropdown options
         * 
         * @param string $field_key meta key
         * @return array
         */
        public static function get_field_options($field_key)
        {
            $field = acf_get_field($field_key);
            if ($field) {
                return $field['choices'];
            }
            return [];
        }


        /**
         * Generate Random RGBA colors
         * 
         * @return string
         */
        public static function get_rand_rgb_value()
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
         * Summary of get_cases_count_by_month
         * 
         * Cases count by month for a year selected by case status
         * 
         * @param int $year full year
         * @param string $status case status
         * @return array
         */
        public static function get_cases_count_by_month($year, $status)
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


        public static function get_status_color($status)
        {
            $statuses_color = [
                'alleged' => '#FF5733',             // Bright Red
                'pending_investigation' => '#33FF57', // Bright Green
                'under_investigation' => '#3357FF',   // Bright Blue
                'concluded' => '#FF33A8'             // Bright Pink
            ];

            return $statuses_color[$status];
        }
    }
}