<?php
$year = date('Y');
if (isset($_GET['submit_year']) && $_GET['submit_year'] > 1900 && $_GET['submit_year'] < 2099) {
    $year = intval($_GET['submit_year']);
}
?>

<form method="get" style="max-width: 420px; margin-left: 0;">
    <label for="summaryBy"> Summary By</label>

    <select name="summary_by" id="summaryBy">
        <?php $summary_by = isset($_GET['summary_by']) ? $_GET['summary_by'] : ''; ?>
        <option value="years" <?php selected($summary_by, 'years'); ?>>Years</option>
        <option value="months" <?php selected($summary_by, 'months'); ?>>Months</option>
        <option value="sectors" <?php selected($summary_by, 'sectors'); ?>>Sectors</option>
        <option value="statuses" <?php selected($summary_by, 'statuses'); ?>>Statuses</option>
        <option value="governments" <?php selected($summary_by, 'governments'); ?>>Governments</option>
        <option value="jurisdictions" <?php selected($summary_by, 'jurisdictions'); ?>>Jurisdictions</option>
        <option value="average_cases_delay_durations" <?php selected($summary_by, 'average_cases_delay_durations'); ?>>
            Average Cases Delay Durations</option>
    </select>
    <button class="filter-btn" type="Submit">Filter</button>
</form>
<div class="cct-summary">
    <?php include_once CCT_PLUGIN_DIR_PATH . 'templates/summary/months.php'; ?>
    <?php include_once CCT_PLUGIN_DIR_PATH . 'templates/summary/years.php'; ?>
    <?php include_once CCT_PLUGIN_DIR_PATH . 'templates/summary/sectors.php'; ?>
    <?php include_once CCT_PLUGIN_DIR_PATH . 'templates/summary/statuses.php'; ?>
    <?php include_once CCT_PLUGIN_DIR_PATH . 'templates/summary/governments.php'; ?>
    <?php include_once CCT_PLUGIN_DIR_PATH . 'templates/summary/jurisdictions.php'; ?>
</div>
