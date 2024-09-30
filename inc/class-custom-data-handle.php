<?php
defined('ABSPATH') || exit();
/**
 * Class to handle custom data related to case post type
 */
class CCT_Custom_Data_Handle
{
    /**
     * Singleton instance of the class
     * @var object
     */
    private static $_instance;

    /**
     * Private constructor to prevent instantiation
     */
    private final function __construct()
    {
        add_action('before_delete_post', array($this, 'case_custom_data_delete'), 10, 1);

    }

    /**
     * Delete Case custom data record on case delete from custom table cb
     *
     * @param int $post_id
     * @return void
     */
    public function case_custom_data_delete($post_id)
    {
        global $wpdb;
        if (empty($post_id) || get_post_status($post_id) === false)
            return;

        $table_name = $wpdb->prefix . 'case_date_data';
        $wpdb->delete(
            $table_name,
            array('post_id' => $post_id),
            array('%d')
        );
    }

    /**
     * Update case status duration period date on custom date table
     * 
     * @param mixed $post_id case id
     * @param mixed $case_status case status
     * @param mixed $start_date case start date 
     * @param mixed $end_date case end date
     * @return bool|int
     */
    public static function update_case_status_period($post_id, $case_status, $start_date, $end_date, $is_concluded = false)
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
        if ($is_concluded) {
            $results = $wpdb->get_row(
                $wpdb->prepare("SELECT id FROM $table_name WHERE post_id=%d", $post_id, $case_status)
            );
        } else {
            $results = $wpdb->get_row(
                $wpdb->prepare("SELECT id FROM $table_name WHERE post_id=%d AND status=%s", $post_id, $case_status)
            );
        }

        if ($results)
            $data_id = $wpdb->update($table_name, $data, ["id" => $results->id]);
        else
            $data_id = $wpdb->insert($table_name, $data, $format);
        return $data_id;
    }

    /**
     * Delete Case Date Data record form custom table
     * 
     * @param int $post_id
     * @param string $case_status
     * @return int | boolean
     */
    public static function delete_status_date_data($post_id, $case_status)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . "case_date_data";
        $data = array(
            "post_id" => $post_id,
            'status' => $case_status
        );

        return $wpdb->delete($table_name, $data);
    }


    /**
     * Get instance of the class
     * 
     * @return self
     */
    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new CCT_Custom_Data_Handle();
        }
        return self::$_instance;
    }
}
CCT_Custom_Data_Handle::getInstance();
