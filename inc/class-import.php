<?php
defined('ABSPATH') || exit();

class CCT_Import_Cases
{
    private static $_instances;


    private function __construct()
    {
        add_action('wp_ajax_fetch_csv_mapper', array($this, 'fetch_csv_mapper'));
    }

    public function fetch_csv_mapper()
    {
        $this->validate_request();

        $csv_id = $_POST['csvId'];

        $file_path = get_attached_file($csv_id);
        if (!file_exists($file_path))
            wp_send_json_error(['message' => 'File not found',], 400);



        $csvFile = fopen($file_path, 'r');
        ;
        if (!$csvFile)
            wp_send_json_error(['message' => 'Failed to read the CSV file.'], 500);

        $data = [];
        for ($i = 0; $i < 2 && ($row = fgetcsv($csvFile)) !== false; $i++) {
            $data[] = $row;
        }
        fclose($csvFile);

        if (empty($data))
            wp_send_json_error(['message' => 'Empty file no data found'], 400);

        echo $this->data_mapping_form($data, $csv_id);
        die();
    }

    public function data_mapping_form($data, $csv_id)
    {
        $form_content = '';
        foreach ($data[0] as $key => $item) {
            $example = $data[1][$key];
            $options = $this->get_data_mapping_options();
            $form_content .= <<<HTML
            <tr>
                <th>
                    <label for="$item">$item</label> <br/>
                    <p class="description">Sample: $example</p>
                </th>
                <td>
                    <select name="$key">
                    $options
                    </select>
                </td>
            </tr>
           HTML;
        }
        return $form_content .= <<<HTML
        <tr>
            <td colspan="2">
                <input type="hidden" name="csvId" value="$csv_id" />
            <button class="button button-primary" type="submit">Submit</button>
        </tr>
        HTML;
    }


    public function get_data_mapping_options()
    {
        $fields1 = acf_get_fields('group_66a5d36905afe');
        $fields2 = acf_get_fields('group_66da7dac64b89');

        // Basic Data
        $general_columns = array('post_id' => 'ID', 'post_title' => 'Title', 'post_date' => 'Date', );
        $options = '<option selected value="">Select option</option>';
        foreach ($general_columns as $key => $label) {
            $options .= <<<HTML
                <option name="$key">$label</option>
            HTML;
        }

        // ACF Fields
        foreach ($fields1 as $field) {
            $name = $field['name'];
            $label = $field['label'];
            $options .= <<<HTML
                <option name="$name">$label</option>
            HTML;
        }

        // Delay duration
        $options .= '<optgroup label="Delay Duration">';
        foreach ($fields2 as $field) {
            $name = $field['name'];
            $label = $field['label'];
            $options .= <<<HTML
                <option name="$name">$label</option>
            HTML;
        }
        $options .= '</optgroup>';

        return $options;
    }


    /**
     * Verify Data Import Request
     *
     */
    public function validate_request()
    {
        // Verify nonce
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], '_import-csv')) {
            wp_send_json_error(array(
                'message' => 'Unauthorized request',
            ), 401); // Unauthorized
        }

        // Verify CSV ID
        if (!isset($_POST['csvId']) || empty($_POST['csvId'])) {
            wp_send_json_error(array(
                'message' => 'CSV file is not defined',
            ), 400); // Bad Request
        }
    }



    public static function getInstance()
    {
        if (!isset(self::$_instances)) {
            self::$_instances = new CCT_Import_Cases();
        }
        return self::$_instances;
    }

}

CCT_Import_Cases::getInstance();
