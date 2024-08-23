<?php defined('ABSPATH') || exit();

if (!isset($_GET['summary_by']) || $_GET['summary_by'] !== 'statuses')
    return;
?>

<canvas id="statusesChart" style="width:100%;max-width:100%"></canvas>

<script>

    <?php
    $case_status = CCT_Utils::get_field_options('case_status');


    $data = [];
    foreach ($case_status as $key => $value) {
        $data[$value] = CCT_Utils::get_case_count_by_meta('case_status', $key);
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