<?php defined('ABSPATH') || exit();

if (!isset($_GET['summary_by']) || $_GET['summary_by'] !== 'average-delay-duration')
    return;

$statuses = [
    'alleged' => 'Alleged',
    'pending_investigation' => 'Pending Investigation',
    'under_investigation' => 'Under Investigation',
    'indictment_drawn' => 'Indictment Drawn',
    'in_court' => 'In Court',
    'concluded' => 'Concluded',
    'concluded_conviction' => 'Concluded: Conviction',
    'concluded_not_guilty' => 'Concluded: Not Guilty',
    'on_appeal_to_supreme_court' => 'On Appeal to Supreme Court',
];
$data = [];
foreach ($statuses as $status => $label) {
    $data[$label] = CCT_Case_Analyze::get_average_duration('delay_' . $status);
}
?>

<canvas id="averageDurationChart" style="width:100%;max-width:100%"></canvas>

<script>
    const data = {
        datasets: [{
            label: 'Average Delay Duration (days)',
            data: <?php echo json_encode($data); ?>,
        }]
    };

    const config = {
        type: 'bar',
        data: data,

    };


    new Chart("averageDurationChart", config);
</script>
