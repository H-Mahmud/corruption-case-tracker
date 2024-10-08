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
        <option value="forms_of_corruption" <?php selected($summary_by, 'forms_of_corruption'); ?>>Forms of Corruption
        </option>
        <option value="amount_involved" <?php selected($summary_by, 'amount_involved'); ?>>Amount Involved
        </option>
        <option value="amount_recovered" <?php selected($summary_by, 'amount_recovered'); ?>>Amount Recovered
        </option>
        <option value="average-duration" <?php selected($summary_by, 'average-duration'); ?>>Average
            Duration</option>
        <option value="average-delay-duration" <?php selected($summary_by, 'average-delay-duration'); ?>>Average Delay
            Duration</option>
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
    <?php include_once CCT_PLUGIN_DIR_PATH . 'templates/summary/forms-of-corruption.php'; ?>
    <?php include_once CCT_PLUGIN_DIR_PATH . 'templates/summary/amount-involved.php'; ?>
    <?php include_once CCT_PLUGIN_DIR_PATH . 'templates/summary/amount-recovered.php'; ?>
    <?php include_once CCT_PLUGIN_DIR_PATH . 'templates/summary/average-duration.php'; ?>
    <?php include_once CCT_PLUGIN_DIR_PATH . 'templates/summary/average-delay-duration.php'; ?>
</div>
