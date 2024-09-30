<?php defined('ABSPATH') || exit();

if (!isset($_GET['summary_by']) || $_GET['summary_by'] !== 'sectors')
    return;
?>

<canvas id="sectorChart" style="width:100%;max-width:100%"></canvas>

<script>

    <?php
    $case_sector = cct_get_choices('sector_of_the_case');


    $data = [];
    foreach ($case_sector as $key => $value) {
        $data[$value] = CCT_Case_Analyze::get_all_cases_count_for_meta('sector_of_the_case', $key);
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


    new Chart("sectorChart", config);
</script>
