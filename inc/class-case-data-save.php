<?php
defined('ABSPATH') || exit();
/**
 * Case ACF data store on Custom table by Custom format
 */
class CCT_Case_ACF_Data_Save
{
    /**
     * Singleton Instance
     * @var $_instance object
     */
    private static $_instance;

    /**
     * WordPress Hooks
     */
    private final function __construct()
    {
        add_action('save_post', array($this, 'case_status_period_date_save'), 10, 1);
    }


    /**
     * Save case concluded date data on a custom table table
     * 
     * @param int $post_id
     * @return void
     */
    public function case_status_period_date_save($post_id)
    {
        if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || !current_user_can('edit_post', $post_id))
            return;

        if (isset($_POST['post_type']) && $_POST['post_type'] == 'sanction') {
            update_post_meta($post_id, 'sanction_title', sanitize_text_field($_POST['post_title']));
        }

        if (!isset($_POST['post_type']) || $_POST['post_type'] != 'case')
            return;

        // Store case title in meta for better search performance
        update_post_meta($post_id, 'cct_case_title', sanitize_text_field($_POST['post_title']));

        if (!isset($_POST['acf']))
            return;

        $case_status = $_POST['acf']['field_66a5d36961b65'];
        if (isset($_POST['acf']['field_66d82c35b0042']) && $_POST['acf']['field_66d82c35b0042']) {
            $is_concluded = 'field_66a5d36961b65'; // Case status field so will going to be true
            $start_date_field = 'field_66d82c852304c';
            $end_date_field = 'field_66d82d342304d';
            $this->case_status_period_field_handle($post_id, $case_status, $is_concluded, $start_date_field, $end_date_field, true);
        } else {
            CCT_Custom_Data_Handle::delete_status_date_data($post_id, $case_status);
        }


        $status_attrs = cct_get_status_attr();

        foreach ($status_attrs as $field) {
            $this->case_status_period_field_handle($post_id, 'delay_' . $field['status'], $field['is_delay'], $field['start_date'], $field['end_date']);
        }
    }


    /**
     * Insert delay status date field
     * 
     * @param mixed $post_id case id
     * @param mixed $case_status delay case status
     * @param mixed $is_delay delay field name
     * @param mixed $start start field name
     * @param mixed $end end field name
     * @return int $id;
     */
    public function case_status_period_field_handle($post_id, $case_status, $is_delay, $start, $end, $is_concluded = false)
    {
        if (isset($_POST['acf'][$is_delay]) && $_POST['acf'][$is_delay]) {
            $start_date_obj = DateTime::createFromFormat('Ymd', $_POST['acf'][$start]);
            $start_date = $start_date_obj->format('Y-m-j');

            $end_date_obj = DateTime::createFromFormat('Ymd', $_POST['acf'][$end]);
            $end_date = $end_date_obj->format('Y-m-j');
            return CCT_Custom_Data_Handle::update_case_status_period($post_id, $case_status, $start_date, $end_date, $is_concluded);
        } else {
            CCT_Custom_Data_Handle::delete_status_date_data($post_id, $case_status);
        }

        return 0;
    }


    /**
     * Get Singleton instance of the class
     * 
     * return CCT_Case_ACF_Data_Save
     */
    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new CCT_Case_ACF_Data_Save();
        }
        return self::$_instance;
    }
}

CCT_Case_ACF_Data_Save::getInstance();
