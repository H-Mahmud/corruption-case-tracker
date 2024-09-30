<?php defined('ABSPATH') || exit();

if (!isset($_GET['summary_by']) || $_GET['summary_by'] !== 'months')
    return;

$year = date('Y');
if (isset($_GET['submit_year']) && $_GET['submit_year'] > 1900 && $_GET['submit_year'] < 2099) {
    $year = intval($_GET['submit_year']);
}
?>
<form method="get" class="filter-for-year">
    <input type="hidden" name="summary_by" value="months">
    <label for="year">
        Filter by Year
        <input name="submit_year" type="number" min="1900" max="2099" step="1" value="<?php echo $year; ?>" />
    </label>
    <button class="filter-btn" type="Submit">Filter</button>

</form>

<canvas id="monthChart" style="width:100%;max-width:100%"></canvas>

<script>
    jQuery(document).ready(function ($) {


        const data = {
            datasets: [{
                label: '',
                data: <?php echo json_encode(CCT_Case_Analyze::get_cases_count_for_year($year)); ?>,
            }]
        };


        const config = {
            type: 'bar',
            data: data,
        };
        new Chart("monthChart", config);

    })
</script>
