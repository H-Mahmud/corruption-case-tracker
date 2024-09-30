<?php
if (!class_exists('CCT_Utils')) {
    class CCT_Utils
    {

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
