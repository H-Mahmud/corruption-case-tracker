<?php defined('ABSPATH') || exit();

if (!isset($_GET['summary_by']) || $_GET['summary_by'] !== 'amount_of_involved')
    return;

$options = [
    'sector_of_the_case' => 'Sector of the Case',
    'jurisdiction' => 'Jurisdiction',
    'case_status' => 'Case Status',
    'level_of_government' => 'Government Level',
    'forms_of_corruption' => 'Forms of Corruption'
];

$involved_by = 'case_status';
if (isset($_GET['involved_by']) && array_key_exists($_GET['involved_by'], $options)) {
    $involved_by = sanitize_key($_GET['involved_by']);
}

$involved_amount_key = 'amount_involved_usd';
$currency = 'USD';
if (isset($_GET['currency']) && $_GET['currency'] === 'LRD') {
    $involved_amount_key = 'amount_involved_lrd';
    $currency == 'LRD';
}

$compare = '=';
if ($involved_by == 'forms_of_corruption' || $involved_by == 'sector_of_the_case') {
    $compare = 'LIKE';
}
?>
<form method="get" class="filter-for-year">
    <input type="hidden" name="summary_by" value="amount_of_involved">
    <label for="involvedBy">
        Filter Amount of Involved By
        <select name="involved_by" id="involvedBy">
            <?php foreach ($options as $key => $label) {
                $selected = selected($key, $involved_by);
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

<canvas id="amountOfInvolvedChart" style="width:100%;max-width:100%"></canvas>
<script>
    jQuery(document).ready(function ($) {
        <?php
        $chart_show_by = cct_get_choices($involved_by);
        $data = [];
        foreach ($chart_show_by as $key => $value) {
            $data[$value] = CCT_Case_Analyze::get_amount_involved(
                $involved_by,
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

        new Chart("amountOfInvolvedChart", config);
    })
</script>
<?php
function cct_meta_query_value($value, $compare)
{
    if ($compare === 'LIKE') {
        return '%' . $value . '%';
    } else {
        return $value;
    }
}
