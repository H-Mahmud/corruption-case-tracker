<?php defined('ABSPATH') || exit();

if (!isset($_GET['summary_by']) || $_GET['summary_by'] !== 'governments')
    return;
?>

<canvas id="governmentChart" style="width:100%;max-width:100%"></canvas>

<script>

    <?php
    $governments = CCT_Utils::get_field_options('level_of_government');


    $data = [];
    foreach ($governments as $key => $value) {
        $data[$value] = CCT_Case_Analyze::get_all_cases_count_for_meta('level_of_government', $key);
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


    new Chart("governmentChart", config);
</script>
