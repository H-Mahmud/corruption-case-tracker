<?php defined('ABSPATH') || exit();

if (!isset($_GET['summary_by']) || $_GET['summary_by'] !== 'amount_of_involved')
    return;

$options = ['case_status' => 'Case Status', 'forms_of_corruption' => 'Forms of Corruption'];

$involved_by = 'case_status';
if (isset($_GET['involved_by']) && array_key_exists($_GET['involved_by'], $options)) {
    $involved_by = $_GET['involved_by'];
}


?>
<form method="get" class="filter-for-year">
    <input type="hidden" name="summary_by" value="amount_of_involved">
    <label for="involvedBy">
        Filter Amount of Involved By
        <select name="involved_by" id="involvedBy">

            <?php foreach ($options as $key => $label) {
                $selected = selected($key, $involved_by);
                echo <<<HTML
                <option value="$key" $selected> $label </option>
                HTML;
            }
            ?>
        </select>
    </label>
    <button class="filter-btn" type="Submit">Filter</button>

</form>

<canvas id="amountOfInvolvedChart" style="width:100%;max-width:100%"></canvas>
<?php if ($involved_by == 'case_status') { ?>
    <script>
        jQuery(document).ready(function ($) {
            <?php

            $case_status = CCT_Utils::get_field_options('case_status');


            $data = [];
            foreach ($case_status as $key => $value) {
                $data[$value] = CCT_Utils::get_case_count_by_meta('case_status', $key);
            }

            ?>
            const data = {
                datasets: [{
                    label: 'Involved',
                    data: <?php echo json_encode($data); ?>,
                }]
            };

            const config = {
                type: 'bar',
                data: data,

            };

            new Chart("amountOfInvolvedChart", config);

        })
    </script>
<?php }

function cct_get_case_involved_count($meta_key, $meta_value)
{
    $args = array(
        'post_type' => 'case',
        'meta_key' => $meta_key,
        'meta_value' => $meta_value,
        'posts_per_page' => -1,
        'fields' => 'ids',
    );

    $query = new WP_Query($args);

    return $query->found_posts;
}


function get_sum_of_involved_by($meta_key, $meta_value)
{
    global $wpdb;

    // // Query to get the sum of 'involved' values grouped by 'case_sector'
    // $query = "
    //             SELECT pm1.meta_value as case_sector, SUM(pm2.meta_value) as total_involved
    //             FROM {$wpdb->posts} as p
    //             JOIN {$wpdb->postmeta} as pm1 ON p.ID = pm1.post_id
    //             JOIN {$wpdb->postmeta} as pm2 ON p.ID = pm2.post_id
    //             WHERE p.post_type = 'case'
    //             AND pm1.meta_key = 'sector_of_the_case'
    //             AND pm2.meta_key = 'amount_involved'
    //             GROUP BY pm1.meta_value
    //         ";

    // $results = $wpdb->get_results($query);

    $query = $wpdb->prepare("
    SELECT SUM(CAST(pm2.meta_value AS SIGNED)) as total_involved
    FROM {$wpdb->posts} as p
    JOIN {$wpdb->postmeta} as pm1 ON p.ID = pm1.post_id
    JOIN {$wpdb->postmeta} as pm2 ON p.ID = pm2.post_id
    WHERE p.post_type = 'case'
    AND pm1.meta_key = %s
    AND pm1.meta_value = %s
    AND pm2.meta_key = 'amount_involved'
     AND pm2.meta_value REGEXP '^-?[0-9]+$' -- Ensure the value is a valid integer
", $meta_key, $meta_value);

    // Get the result
    $result = $wpdb->get_var($query);

    var_dump($result);

    // Return the sum of 'involved' for the specific 'case_sector'
    return $result ? $result : 0;
}

// var_dump(get_sum_of_involved_by('sector_of_the_case', 'health'));

