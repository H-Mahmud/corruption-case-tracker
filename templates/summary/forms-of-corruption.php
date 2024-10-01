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
        $data[$value] = CCT_Case_Analyze::get_all_cases_count_for_meta('forms_of_corruption', $key, 'LIKE');
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
