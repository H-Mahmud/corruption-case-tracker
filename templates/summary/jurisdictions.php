<?php defined('ABSPATH') || exit();

if (!isset($_GET['summary_by']) || $_GET['summary_by'] !== 'jurisdictions')
    return;
?>

<canvas id="jurisdictionChart" style="width:100%;max-width:100%"></canvas>

<script>

    <?php
    $jurisdictions = CCT_Utils::get_field_options('jurisdiction');


    $data = [];
    foreach ($jurisdictions as $key => $value) {
        $data[$value] = CCT_Case_Analyze::get_all_cases_count_for_meta('jurisdiction', $key);
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


    new Chart("jurisdictionChart", config);
</script>
