<?php defined('ABSPATH') || exit();

class CCT_Case_Export
{
    private static $_instance = null;

    private function __construct()
    {
        $this->cct_data_export();
    }

    public function cct_data_export()
    {
        $query = $this->get_export_query();

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


    public function get_export_query()
    {


        // $args = array(
        //     'post_type' => 'case',
        //     'posts_per_page' => -1,
        //     // 'meta_query' => array(
        //     //     array(
        //     //         'key' => $meta_key,
        //     //         'value' => $meta_value,
        //     //     ),
        //     // ),
        // );


        $query['post_type'] = 'case';
        $query['meta_query']['relation'] = 'AND';

        // Filter Query By Post Meta
        $meta_query_filter = array('relation' => 'AND');

        $case_status_filter = $this->get_filter('case_status');
        $case_status_filter && array_push($meta_query_filter, $case_status_filter);

        $jurisdiction_filter = $this->get_filter('jurisdiction');
        $jurisdiction_filter && array_push($meta_query_filter, $jurisdiction_filter);

        $section_filter = $this->get_filter('sector_of_the_case');
        $section_filter && array_push($meta_query_filter, $section_filter);

        $level_of_government_filter = $this->get_filter('level_of_government');
        $level_of_government_filter && array_push($meta_query_filter, $level_of_government_filter);

        // $forms_of_corruption_filter = $this->get_filter('forms_of_corruption');
        $forms_of_corruption_filter = isset($_GET['forms_of_corruption']);
        $forms_of_corruption_filter && array_push($meta_query_filter, [
            'key' => 'forms_of_corruption',
            'value' => $_GET['forms_of_corruption'],
            'compare' => 'LIKE',
        ]);


        $query['meta_query'][] = $meta_query_filter;

        return new WP_Query($query);
    }


    public function get_filter($key)
    {
        if (!isset($_GET[$key]) || empty($_GET[$key]))
            return false;

        $value = $_GET[$key];

        return [
            'key' => $key,
            'value' => $value,
            'compare' => '=',
        ];

    }

    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new CCT_Case_Export();
        }
        return self::$_instance;
    }
}
