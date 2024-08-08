<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<canvas id="myChart" style="width:100%;max-width:100%"></canvas>

<script>

    <?php

    // get_cases_count_by_month(2024);
    
    $case_status = cct_get_field_options('case_status');

    $datasets = [];
    foreach ($case_status as $value => $value) {


        $data = get_cases_count_by_month(2024, $value);

        $bg_colors = [];
        $border_colors = [];
        for ($i = 0; $i < 12; $i++) {
            $color_value = cct_get_rand_rgb_color_value();
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
    console.log(datasets);


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


    console.log(labels);
    const data = {
        // labels: labels,
        datasets: datasets
    };

    const config = {
        type: 'bar',
        data: data,

    };

    new Chart("myChart", config);
</script>
