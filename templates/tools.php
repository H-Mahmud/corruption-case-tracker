<?php
$default_tab = null;
$tab = isset($_GET['tab']) ? $_GET['tab'] : $default_tab;
?>
<div class="wrap">
    <h2><?php echo get_admin_page_title() ?></h2>

    <h2 class="nav-tab-wrapper">
        <a href="?post_type=case&page=tools"
            class="nav-tab <?php if ($tab === null): ?>nav-tab-active<?php endif; ?>">Import</a>
        <a href="?post_type=case&page=tools&tab=export"
            class="nav-tab <?php if ($tab === 'export'): ?>nav-tab-active<?php endif; ?>">Export</a>
    </h2>

    <div class="tab-content">
        <?php switch ($tab):
            case 'export':
                include_once(CCT_PLUGIN_DIR_PATH . 'templates/tools/export.php');
                break;
            default:
                include_once(CCT_PLUGIN_DIR_PATH . 'templates/tools/import.php');
                break;
        endswitch; ?>
    </div>
</div>
