<?php defined('ABSPATH') || exit();

class CCT_Data_Export
{
    private static $_instance = null;

    private function __construct()
    {
        $this->cct_data_export();
    }

    public function cct_data_export()
    {
        ;

        $args = array(
            'post_type' => 'case',
            'posts_per_page' => -1,
            // 'meta_query' => array(
            //     array(
            //         'key' => $meta_key,
            //         'value' => $meta_value,
            //     ),
            // ),
        );

        $query = new WP_Query($args);

        // Get WordPress uploads directory
        $upload_dir = wp_upload_dir();
        $csv_file = $upload_dir['basedir'] . '/cases-export.csv';
        $csv_url = $upload_dir['baseurl'] . '/cases-export.csv';

        // Open the CSV file, if it exists, clear it, otherwise create a new one
        $file = fopen($csv_file, 'w');

        if ($file === false) {
            echo 'Error opening the file';
            return;
        }

        // Define the CSV columns
        $csv_columns = array('ID', 'post_title', 'post_date');
        $metadata_columns = [];

        $fields = acf_get_fields('group_66a5d36905afe');

        foreach ($fields as $field) {
            $metadata_columns[] = $field['name'];
        }

        $fields2 = acf_get_fields('group_66da7dac64b89');
        foreach ($fields2 as $field) {
            $metadata_columns[] = $field['name'];
        }

        $csv_columns = array_merge($csv_columns, $metadata_columns);

        // Add column headers to CSV
        fputcsv($file, $csv_columns);

        // Loop through the posts and add them to the CSV
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();

                // Get post metadata
                $metadata = [];
                foreach ($fields as $field) {
                    $metadata[] = is_string(get_field($field['name'])) ? get_field($field['name']) : '';
                }

                foreach ($fields2 as $field) {
                    $metadata[] = is_string(get_field($field['name'])) ? get_field($field['name']) : '';
                }

                // Prepare row data
                $row_data = array(
                    get_the_ID(),
                    get_the_title(),
                    get_the_date('Y-m-d H:i:s'),
                );

                $row_data = array_merge($row_data, $metadata);

                // Write the row to the CSV file
                fputcsv($file, $row_data);
            }
        }

        // Close the file
        fclose($file);

        // Reset post data
        wp_reset_postdata();

        // Output a button linking to the CSV file
        echo '<a href="' . esc_url($csv_url) . '" class="button">Download CSV</a>';
    }

    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new CCT_Data_Export();
        }
        return self::$_instance;
    }
}
