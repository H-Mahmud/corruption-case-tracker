<?php defined('ABSPATH') || exit();

if (!isset($_GET['summary_by']) || $_GET['summary_by'] !== 'statuses')
    return;
?>

<canvas id="statusesChart" style="width:100%;max-width:100%"></canvas>

<script>

    <?php
    $chart_show_by = cct_get_choices('case_status');


    $data = [];
    foreach ($chart_show_by as $key => $value) {
        $data[$value] = CCT_Case_Analyze::get_all_cases_count_for_meta('case_status', $key);
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


    new Chart("statusesChart", config);
</script>
