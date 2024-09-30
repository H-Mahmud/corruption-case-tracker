<?php
if (!class_exists('CCT_Utils')) {
    class CCT_Utils
    {
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


        public static function get_status_color($status)
        {

            $statuses_color = [
                'alleged' => '#FF5733',             // Bright Red
                // 'pending_investigation' => '#ffc552', // Bright Orange
                'under_investigation' => '#3357FF',   // Bright Blue
                'indictment_drawn' => '#33C3FF', // Magenta
                'trial_court' => '#C70039', // Rich Red
                'concluded_via_settlement' => '#52ff63',             // Bright Green
                'concluded_via_dismissal' => '#5263ff',             // Bright Green
                'concluded_guilty' => '#900C3F', // Deep Maroon
                'concluded_not_guilty' => '#3498DB', // Bright Blue
                'on_appeal_to_supreme_court' => '#8E44AD', // Strong Purple

                // 'private_sector' => '#FFB533', // Warm Orange
                // 'civil_society' => '#2E86C1',  // Vibrant Blue
                // 'telecommunications' => '#2980B9', // Deep Sky Blue
                // 'non_profit' => '#A569BD', // Light Purple
            ];

            return $statuses_color[$status] ?? '';
        }


        /**
         * Update case status date on custom date table
         * @param mixed $post_id case id
         * @param mixed $case_status case status
         * @param mixed $start_date case start date 
         * @param mixed $end_date case end date
         * @return bool|int
         */
        public static function update_case_status_date($post_id, $case_status, $start_date, $end_date)
        {
            global $wpdb;
            $table_name = $wpdb->prefix . 'case_date_data';

            $data = array(
                'post_id' => $post_id,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'status' => $case_status
            );

            $format = array('%d', '%s', '%s', '%s');

            $results = $wpdb->get_row($wpdb->prepare("SELECT id FROM $table_name WHERE post_id=%d", $post_id));

            if ($results)
                $data_id = $wpdb->update($table_name, $data, array("id" => $results->id));
            else
                $data_id = $wpdb->insert($table_name, $data, $format);
            return $data_id;
        }


        /**
         * Update Delay case status date on custom date table
         * @param mixed $post_id case id
         * @param mixed $case_status case status
         * @param mixed $start_date case start date 
         * @param mixed $end_date case end date
         * @return bool|int
         */
        public static function update_delay_case_status_date($post_id, $case_status, $start_date, $end_date)
        {
            global $wpdb;
            $table_name = $wpdb->prefix . 'case_date_data';

            $data = array(
                'post_id' => $post_id,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'status' => $case_status
            );

            $format = array('%d', '%s', '%s', '%s');

            $results = $wpdb->get_row($wpdb->prepare("SELECT id FROM $table_name WHERE post_id=%d AND status=%s", $post_id, $case_status));

            if ($results)
                $data_id = $wpdb->update($table_name, $data, ["id" => $results->id]);
            else
                $data_id = $wpdb->insert($table_name, $data, $format);
            return $data_id;
        }

        public static function delete_delay_case_status_date($post_id, $case_status)
        {
            global $wpdb;
            $table_name = $wpdb->prefix . "case_date_data";
            $data = array(
                "post_id" => $post_id,
                'status' => $case_status
            );

            $wpdb->delete($table_name, $data);
        }

        /**
         * Insert delay status date field
         * @param mixed $post_id case id
         * @param mixed $case_status delay case status
         * @param mixed $is_delay delay field name
         * @param mixed $start start field name
         * @param mixed $end end field name
         * @return int $id;
         */
        public static function delay_status_date_insert($post_id, $case_status, $is_delay, $start, $end)
        {
            if (isset($_POST['acf'][$is_delay]) && $_POST['acf'][$is_delay]) {
                $start_date_obj = DateTime::createFromFormat('Ymd', $_POST['acf'][$start]);
                $start_date = $start_date_obj->format('Y-m-j');

                $end_date_obj = DateTime::createFromFormat('Ymd', $_POST['acf'][$end]);
                $end_date = $end_date_obj->format('Y-m-j');
                return CCT_Utils::update_delay_case_status_date($post_id, $case_status, $start_date, $end_date);
            } else {
                CCT_Utils::delete_delay_case_status_date($post_id, $case_status);
            }

            return 0;
        }
    }
}
