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
     * Delete Case custom data record on case delete from custom table
     *
     * @param int $post_id
     * @return void
     */
    function case_custom_data_delete($post_id)
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

/**
 * Save case concluded date data on a custom table table
 * 
 * @param int $post_id
 * @return void
 */
function cct_concluded_data_sav($post_id)
{
    if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || !current_user_can('edit_post', $post_id))
        return;

    if (!isset($_POST['acf']))
        return;

    $case_status = $_POST['acf']['field_66a5d36961b65'];
    if (isset($_POST['acf']['field_66d82c35b0042']) && $_POST['acf']['field_66d82c35b0042']) {
        $start_date_obj = DateTime::createFromFormat('Ymd', $_POST['acf']['field_66d82c852304c']);
        $start_date = $start_date_obj->format('Y-m-j');

        $end_date_obj = DateTime::createFromFormat('Ymd', $_POST['acf']['field_66d82d342304d']);
        $end_date = $end_date_obj->format('Y-m-j');
        CCT_Utils::update_case_status_date($post_id, $case_status, $start_date, $end_date);
    } else {
        CCT_Utils::delete_delay_case_status_date($post_id, $case_status);
    }


    $fields = cct_custom_date_fields();

    foreach ($fields as $field) {
        CCT_Utils::delay_status_date_insert($post_id, 'delay_' . $field['status'], $field['is_delay'], $field['start_date'], $field['end_date']);
    }

}
add_action('save_post', 'cct_concluded_data_sav');

function cct_custom_date_fields()
{
    return $fields = [
        [
            'status' => 'alleged',
            'is_delay' => 'field_66da7dac2cb54',
            'start_date' => 'field_66da7df92cb55',
            'end_date' => 'field_66da7e5e2cb56'
        ],
        [
            'status' => 'pending_investigation',
            'is_delay' => 'field_66da7ecb9a08b',
            'start_date' => 'field_66da7efa9a08c',
            'end_date' => 'field_66da7f1c9a08d'
        ],
        [
            'status' => 'under_investigation',
            'is_delay' => 'field_66dc0c10a8fe2',
            'start_date' => 'field_66dc0c25a8fe3',
            'end_date' => 'field_66dc0c97a8fe4'
        ],
        [
            'status' => 'indictment_drawn',
            'is_delay' => 'field_66dc0cc2f5502',
            'start_date' => 'field_66dc0d1df5503',
            'end_date' => 'field_66dc0d44f5504'
        ],
        [
            'status' => 'in_court',
            'is_delay' => 'field_66dc0d8b5c644',
            'start_date' => 'field_66dc0dae5c645',
            'end_date' => 'field_66dc0dc95c646'
        ],
        [
            'status' => 'concluded',
            'is_delay' => 'field_66dc0e2f83dc0',
            'start_date' => 'field_66dc0e4383dc1',
            'end_date' => 'field_66dc0e5e83dc2'
        ],
        [
            'status' => 'concluded_conviction',
            'is_delay' => 'field_66dc0e7faa64d',
            'start_date' => 'field_66dc0e8eaa64e',
            'end_date' => 'field_66dc0ea6aa64f'
        ],
        [
            'status' => 'concluded_not_guilty',
            'is_delay' => 'field_66dc0ec3bc7f2',
            'start_date' => 'field_66dc0edabc7f3',
            'end_date' => 'field_66dc0efabc7f4'
        ],
        [
            'status' => 'on_appeal_to_supreme_court',
            'is_delay' => 'field_66dc0f2017b31',
            'start_date' => 'field_66dc0f3417b32',
            'end_date' => 'field_66dc0f4b17b33'
        ]
    ];
}

