<?php
$year = date('Y');
if (isset($_GET['submit_year']) && $_GET['submit_year'] > 1900 && $_GET['submit_year'] < 2099) {
    $year = intval($_GET['submit_year']);
}
?>

<form method="get" style="max-width: 420px; margin-left: 0;">
    <label for="summaryBy"> Summary By</label>

    <select name="summary_by" id="summaryBy">
        <option value="year">Years</option>
        <option value="months">Months</option>
        <option value="sectors">Sectors</option>
        <option value="statuses">Statuses</option>
        <option value="governments">Governments</option>
        <option value="jurisdictions">Jurisdictions</option>
        <option value="average_cases_delay_durations">Average Cases Delay Durations</option>
    </select>
    <button class="filter-btn" type="Submit">Filter</button>
</form>
<div class="cct-summary">
    <?php include_once CCT_PLUGIN_DIR_PATH . 'templates/summary/months.php'; ?>
</div>
