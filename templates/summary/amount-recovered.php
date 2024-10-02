<?php defined('ABSPATH') || exit();

if (!isset($_GET['summary_by']) || $_GET['summary_by'] !== 'amount_recovered')
    return;

$options = [
    'sector_of_the_case' => 'Sector of the Case',
    'jurisdiction' => 'Jurisdiction',
    'case_status' => 'Case Status',
    'level_of_government' => 'Government Level',
    'forms_of_corruption' => 'Forms of Corruption'
];

$recovered_by = 'case_status';
if (isset($_GET['recovered_by']) && array_key_exists($_GET['recovered_by'], $options)) {
    $recovered_by = sanitize_key($_GET['recovered_by']);
}

$involved_amount_key = 'amount_recovered_usd';
$currency = 'USD';
if (isset($_GET['currency']) && $_GET['currency'] == 'LRD') {
    $involved_amount_key = 'amount_recovered_lrd';
    $currency = 'LRD';
}

$compare = '=';
if ($recovered_by == 'forms_of_corruption' || $recovered_by == 'sector_of_the_case') {
    $compare = 'LIKE';
}
?>
<form method="get" class="filter-for-year">
    <input type="hidden" name="summary_by" value="amount_recovered">
    <label for="recoveredBy">
        Filter Amount Recovered By
        <select name="recovered_by" id="recoveredBy">
            <?php foreach ($options as $key => $label) {
                $selected = selected($key, $recovered_by);
                echo <<<HTML
                <option value="$key" $selected> $label </option>
                HTML;
            }
            ?>
        </select>
    </label>
    <label for="currency">
        Currency
        <select name="currency" id="currency">
            <option value="USD" <?php selected($currency, 'USD'); ?>>USD</option>
            <option value="LRD" <?php selected($currency, 'LRD'); ?>>LRD</option>
        </select>
    </label>
    <button class="filter-btn" type="Submit">Filter</button>
</form>

<canvas id="amountRecoveredChart" style="width:100%;max-width:100%"></canvas>
<script>
    jQuery(document).ready(function ($) {
        <?php
        $chart_show_by = cct_get_choices($recovered_by);
        $data = [];
        foreach ($chart_show_by as $key => $value) {
            $data[$value] = CCT_Case_Analyze::get_amount_involved(
                $recovered_by,
                cct_meta_query_value($key, $compare),
                $involved_amount_key,
                $compare
            );
        }
        ?>
        const data = {
            datasets: [{
                label: 'Amount (<?php echo $currency; ?>)',
                data: <?php echo json_encode($data); ?>,
            }]
        };
        const config = {
            type: 'bar',
            data: data,
        };

        new Chart("amountRecoveredChart", config);
    })
</script>
