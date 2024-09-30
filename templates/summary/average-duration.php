<?php defined('ABSPATH') || exit();

if (!isset($_GET['summary_by']) || $_GET['summary_by'] !== 'average-duration')
    return;


$statuses = [
    'concluded' => 'Concluded',
    'concluded_conviction' => 'Concluded: Conviction',
    'concluded_not_guilty' => 'Concluded: Not Guilty',
];

$data = [];
foreach ($statuses as $status => $label) {
    $data[$label] = CCT_Case_Analyze::get_average_duration($status);
}
?>

<canvas id="averageDurationChart" style="width:100%;max-width:100%"></canvas>

<script>
    const data = {
        datasets: [{
            label: 'Average Duration (days)',
            data: <?php echo json_encode($data); ?>,
        }]
    };

    const config = {
        type: 'bar',
        data: data,

    };


    new Chart("averageDurationChart", config);
</script>
