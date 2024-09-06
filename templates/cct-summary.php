<?php defined('ABSPATH') || exit(); ?>

<label for="summaryBy">Summary by</label>
<form method="get" class="summary-filter-form">
    <select name="summary_by" id="summaryBy">
        <?php $summary_by = isset($_GET['summary_by']) ? $_GET['summary_by'] : ''; ?>
        <option value="years" <?php selected($summary_by, 'years'); ?>>Years</option>
        <option value="months" <?php selected($summary_by, 'months'); ?>>Months</option>
        <option value="sectors" <?php selected($summary_by, 'sectors'); ?>>Sectors</option>
        <option value="statuses" <?php selected($summary_by, 'statuses'); ?>>Statuses</option>
        <option value="governments" <?php selected($summary_by, 'governments'); ?>>Governments</option>
        <option value="jurisdictions" <?php selected($summary_by, 'jurisdictions'); ?>>Jurisdictions</option>
        <option value="average-duration" <?php selected($summary_by, 'average-duration'); ?>>Average Duration</option>
        <?php
        /*
        <option value="average_cases_delay_durations" <?php selected($summary_by, 'average_cases_delay_durations'); ?>>
            Average Cases Delay Durations</option>
            */
        ?>
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
    <?php include_once CCT_PLUGIN_DIR_PATH . 'templates/summary/average-duration.php'; ?>
</div>
