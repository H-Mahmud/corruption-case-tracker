<?php defined('ABSPATH') || exit();

if (!isset($_GET['summary_by']) || $_GET['summary_by'] !== 'months')
    return;
?>
<form method="get" class="summary-filter-form">
    <label for="year">
        Filter By year
        <input name="submit_year" type="number" min="1900" max="2099" step="1" value="<?php echo $year; ?>" />
    </label>
    <button class="filter-btn" type="Submit">Filter</button>

</form>

<canvas id="myChart" style="width:100%;max-width:100%"></canvas>

<script>

    <?php
    $case_status = CCT_Utils::get_field_options('case_status');


    $datasets = [];
    foreach ($case_status as $key => $value) {


        $data = CCT_Utils::get_cases_count_by_month($year, $key);
        $color_value = CCT_Utils::get_status_color($key);

        $bg_colors = [];
        $border_colors = [];
        for ($i = 0; $i < 12; $i++) {
            array_push($bg_colors, $color_value . '33');
            array_push($border_colors, $color_value);
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
