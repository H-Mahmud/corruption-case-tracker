<?php defined('ABSPATH') || exit();

if (isset($_GET['summary_by']) && $_GET['summary_by'] !== 'years')
    return;
?>

<canvas id="yearChart" style="width:100%;max-width:100%"></canvas>
<script>
    jQuery(document).ready(function () {

        const data = {
            datasets: [{
                label: '',
                data: <?php echo json_encode(CCT_Case_Analyze::get_all_cases_count()); ?>,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        };

        const config = {
            type: 'line',
            data: data,

        };

        new Chart("yearChart", config);
    })
</script>
