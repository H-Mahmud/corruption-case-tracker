<div class="wrap">
    <h2>Export Posts to CSV</h2>

    <div class="import-container">

        <?php if (isset($_GET['export-begin']) && $_GET['export-begin'] == true) {

            CCT_Data_Export::getInstance();
        } else { ?>
            <form method="get" action="">
                <input type="hidden" name="post_type" value="case">
                <input type="hidden" name="page" value="tools">
                <input type="hidden" name="tab" value="export">
                <input type="hidden" name="export-begin" value="true">
                <button type="submit" class="button button-primary">Export Posts</button>
            </form>
            <?php
        }
        ?>
    </div>
</div>
