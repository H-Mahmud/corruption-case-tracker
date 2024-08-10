<?php
$year = date('Y');
if (isset($_GET['submit_year']) && $_GET['submit_year'] > 1900 && $_GET['submit_year'] < 2099) {
    $year = intval($_GET['submit_year']);
}
?>

<form method="get" class="summery-filter-form">
    <label for="year">
        Filter By year
        <input name="submit_year" type="number" min="1900" max="2099" step="1" value="<?php echo $year; ?>" />
    </label>
    <button class="filter-btn" type="Submit">Filter</button>

</form>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<canvas id="myChart" style="width:100%;max-width:100%"></canvas>

<script>

    <?php
    $case_status = CCT_Utils::get_field_options('case_status');


    $datasets = [];
    foreach ($case_status as $key => $value) {


        $data = CCT_Utils::get_cases_count_by_month($year, $key);
        $color_value = CCT_Utils::get_rand_rgb_value();

        $bg_colors = [];
        $border_colors = [];
        for ($i = 0; $i < 12; $i++) {
            array_push($bg_colors, "rgba($color_value, 0.2)");
            array_push($border_colors, "rgb($color_value)");
        }

        $dataset = array(
            'label' => $value,
            'data' => $data,
            'fill' => false,
            'backgroundColor' => $bg_colors,
            'borderColor' => $border_colors,
            'borderWidth' => 1
        );

        array_push($datasets, $dataset);
    }



    ?>

    const datasets = <?php echo json_encode($datasets); ?>;

    const Utils = {
        months: function (config) {
            const cfg = config || {};
            const count = cfg.count || 12;
            const section = cfg.section;
            const values = [];

            for (let i = 0; i < count; ++i) {
                values.push(new Date(0, i, 1).toLocaleString('default', { month: 'short' }));
            }

            return values.slice(0, section || values.length);
        }
    };


    const labels = Utils.months({ count: 12 });

    const data = {
        datasets: datasets
    };

    const config = {
        type: 'bar',
        data: data,

    };

    new Chart("myChart", config);
</script>
