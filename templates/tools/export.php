<?php
$fields = acf_get_fields('group_66a5d36905afe');
// $fields2 = acf_get_fields('group_66da7dac64b89');


if (isset($_GET['export-begin']) && $_GET['export-begin'] == 'true') {
    $post_type = 'case';

    $args = array(
        'post_type' => $post_type,
        'posts_per_page' => -1, // Get all posts
        // 'meta_query' => array(
        //     array(
        //         'key' => $meta_key,
        //         'value' => $meta_value,
        //     ),
        // ),
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        // Set CSV headers
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=posts-export.csv');

        // Open the output stream
        $output = fopen('php://output', 'w');

        // Define the CSV columns (adjust according to your needs)
        $csv_columns = array('post_id', 'post_title', 'post_date', );

        $metadata_columns = [];
        foreach ($fields as $field) {
            $metadata_columns[] = $field['name'];
        }

        $csv_columns = array_merge($csv_columns, $metadata_columns);

        fputcsv($output, $csv_columns);

        // Loop through the posts
        while ($query->have_posts()) {
            $query->the_post();

            $metadata = [];
            foreach ($fields as $field) {
                $metadata[] = is_string(get_field($field['name'])) ? get_field($field['name']) : '';
            }

            // Prepare the data for CSV
            $row_data = array(
                get_the_ID(),
                get_the_title(),
                get_the_date(),
            );

            $row_data = array_merge($row_data, $metadata);


            // Output the row to the CSV
            fputcsv($output, $row_data);
        }

        // Close the output stream
        fclose($output);
        exit;
    } else {
        echo 'No posts found';
    }
} else {
    // Show the export button
    ?>
    <div class="wrap">
        <h2>Export Posts to CSV</h2>
        <form method="get" action="">
            <input type="hidden" name="post_type" value="case">
            <input type="hidden" name="page" value="tools">
            <input type="hidden" name="tab" value="export">
            <input type="hidden" name="export-begin" value="true">
            <button type="submit" class="button button-primary">Export Posts</button>
        </form>
    </div>
    <?php
}
