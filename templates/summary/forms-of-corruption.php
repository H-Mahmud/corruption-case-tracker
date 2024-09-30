<?php defined('ABSPATH') || exit();

if (!isset($_GET['summary_by']) || $_GET['summary_by'] !== 'forms_of_corruption')
    return;
?>

<canvas id="formsOfCorruptionChart" style="width:100%;max-width:100%"></canvas>

<script>
    <?php
    $forms_of_corruption = cct_get_choices('forms_of_corruption');

    $data = [];
    foreach ($forms_of_corruption as $key => $value) {
        $data[$value] = cct_get_form_of_corruption_count('forms_of_corruption', $key);
    }

    ?>
    const data = {
        datasets: [{
            label: '',
            data: <?php echo json_encode($data); ?>,
        }]
    };

    const config = {
        type: 'bar',
        data: data,

    };

    new Chart("formsOfCorruptionChart", config);
</script>

<?php

function cct_get_form_of_corruption_count($meta_key, $meta_value)
{
    $args = array(
        'post_type' => 'case',
        'meta_key' => $meta_key,
        'meta_value' => $meta_value,
        'meta_compare' => 'LIKE',
        'posts_per_page' => -1,
        'fields' => 'ids',
    );

    $query = new WP_Query($args);

    return $query->found_posts;
}
