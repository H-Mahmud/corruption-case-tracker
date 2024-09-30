<?php
defined('ABSPATH') || exit();

class CCT_Case_Import
{
    private static $_instances;


    private function __construct()
    {
        add_action('wp_ajax_fetch_csv_mapper', array($this, 'fetch_csv_mapper'));
        add_action('wp_ajax_import_csv_data', array($this, 'import_csv_data'));
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
            $options = $this->get_data_mapping_options($item);
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
        <tr>
            <td colspan="2">
                <p>Notice: If the ID column is selected, the case will be updated.</p>
            </td>
        </tr>
        HTML;
    }


    public function get_data_mapping_options($column)
    {
        $fields1 = acf_get_fields('group_66a5d36905afe');
        $fields2 = acf_get_fields('group_66da7dac64b89');

        // Basic Data
        $general_columns = array('ID' => 'ID', 'post_title' => 'Title', 'post_date' => 'Date', );
        $options = '<option selected value="">Select option</option>';
        $i = 0;
        foreach ($general_columns as $key => $label) {
            $selected = $column == $key ? 'selected' : '';
            $options .= <<<HTML
                <option value="$key" $selected>$label</option>
            HTML;
            $i++;
        }

        // ACF Fields
        foreach ($fields1 as $field) {
            $name = $field['name'];
            $label = $field['label'];
            $selected = $column == $name ? 'selected' : '';
            $options .= <<<HTML
                <option value="$name" $selected>$label</option>
            HTML;
        }

        // Delay duration
        $options .= '<optgroup label="Delay Duration">';
        foreach ($fields2 as $field) {
            $name = $field['name'];
            $label = $field['label'];
            $selected = $column == $name ? 'selected' : '';
            $options .= <<<HTML
                <option value="$name" $selected>$label</option>
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


    public function import_csv_data()
    {
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], '_import-csv')) {
            wp_send_json_error('Unauthorized request', 401);
        }

        $csv_data_index = array();
        parse_str($_POST['form_data'], $csv_data_index);

        // Create variable for extra fields
        $csv_id = $csv_data_index['csvId'];
        $is_update = isset($csv_data_index['update']) && $csv_data_index['update'] == 'on' ? true : false;

        // Remove Extra fields
        unset($csv_data_index['csvId']);
        unset($csv_data_index['update']);

        $this->process_import($csv_id, $is_update, $csv_data_index);

        wp_send_json_success('Data imported successfully', 200);
    }

    public function process_import($csv_id, $is_update, $data_index)
    {
        $csv_data = $this->parse_csv_to_array($csv_id);



        for ($i = 1; $i < count($csv_data); $i++) {
            $data = $csv_data[$i];

            $post_data = $this->parse_post_data($data, $data_index);
            $acf_data = $this->parse_acf_fields($data, $data_index);
            $this->import($is_update, $post_data, $acf_data);
        }
    }

    public function parse_csv_to_array($csv_id)
    {
        $file_path = get_attached_file($csv_id);

        if (!file_exists($file_path)) {
            wp_send_json_error('File not found', 400);
        }

        $csv_file = fopen($file_path, 'r');

        if (!$csv_file) {
            wp_send_json_error('Failed to read the CSV file.', 500);
        }

        $csv_data = [];

        while (($row = fgetcsv($csv_file)) !== false) {
            $csv_data[] = $row;
        }

        fclose($csv_file);

        return $csv_data;
    }

    public function parse_post_data(array $data, array $data_index)
    {
        $post_data = [];
        $columns = [
            'ID',
            'post_title',
            'post_date',
        ];

        foreach ($columns as $column) {
            if (array_search($column, $data_index) !== false) {
                $index = array_search($column, $data_index);
                $post_data[$column] = $data[$index];

            }
        }
        return $post_data;
    }


    public function parse_acf_fields($data, $data_index)
    {
        $acf_data = [];
        $post_data_columns = [
            'ID',
            'post_title',
            'post_date',
        ];

        foreach ($data_index as $index => $column) {
            if ($column && !in_array($column, $post_data_columns)) {
                $acf_data[$column] = $data[$index];

            }
        }
        return $acf_data;
    }

    public function import($is_update, $post_data, $acf_data)
    {
        $post_id = $post_data['ID'];
        $post_data['post_type'] = 'case';
        $post_data['post_status'] = 'publish';
        $post_id = wp_insert_post($post_data);

        foreach ($acf_data as $key => $value) {
            update_field($key, $value, $post_id);
        }
    }


    public static function getInstance()
    {
        if (!isset(self::$_instances)) {
            self::$_instances = new CCT_Case_Import();
        }
        return self::$_instances;
    }

}

CCT_Case_Import::getInstance();
