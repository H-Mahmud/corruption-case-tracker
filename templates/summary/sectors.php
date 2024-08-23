<?php defined('ABSPATH') || exit();

if (!isset($_GET['summary_by']) || $_GET['summary_by'] !== 'sectors')
    return;
?>

<canvas id="sectorChart" style="width:100%;max-width:100%"></canvas>

<script>

    <?php
    $case_sector = CCT_Utils::get_field_options('sector_of_the_case');


    $data = [];
    foreach ($case_sector as $key => $value) {
        $data[$value] = CCT_Utils::get_case_count_by_meta('sector_of_the_case', $key);
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
