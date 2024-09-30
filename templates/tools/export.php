<div class="wrap">
    <h2>Export Cases to CSV</h2>

    <div class="import-container">

        <?php if (isset($_GET['export-begin']) && $_GET['export-begin'] == true) {

            CCT_Case_Export::getInstance();
        } else { ?>
            <form method="get" action="">
                <table class="form-table">
                    <tr>
                        <th><label for="sector_of_the_case">Sector of the case </label></th>
                        <td>
                            <select name="sector_of_the_case" id="sector_of_the_case">
                                <option value="">All Sector</option>
                                <?php
                                $sector_of_the_case_options = cct_get_choices('sector_of_the_case');
                                foreach ($sector_of_the_case_options as $key => $value) {
                                    if (isset($_GET['sector_of_the_case']) && $_GET['sector_of_the_case'] === $key) {
                                        echo '<option value="' . $key . '" selected>' . $value . '</option>';
                                    } else {
                                        echo '<option value="' . $key . '">' . $value . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th><label for="jurisdiction">Jurisdiction</label>
                        </th>
                        <td>
                            <select name="jurisdiction" id="jurisdiction">
                                <option value="">All Jurisdiction</option>
                                <?php
                                $jurisdiction_options = cct_get_choices('jurisdiction');
                                foreach ($jurisdiction_options as $key => $value) {
                                    if (isset($_GET['jurisdiction']) && $_GET['jurisdiction'] === $key) {
                                        echo '<option value="' . $key . '" selected>' . $value . '</option>';
                                    } else {
                                        echo '<option value="' . $key . '">' . $value . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th> <label for="caseStatus"> Case Status </label></th>
                        <td>
                            <select name="case_status" id="caseStatus">
                                <option value="">All Statuses</option>
                                <?php
                                $case_status_options = cct_get_choices('case_status');
                                foreach ($case_status_options as $key => $value) {
                                    if (isset($_GET['case_status']) && $_GET['case_status'] === $key) {
                                        echo '<option value="' . $key . '" selected>' . $value . '</option>';
                                    } else {
                                        echo '<option value="' . $key . '">' . $value . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th><label for="levelOfGovernment"> Government Level </label></th>
                        <td>
                            <select name="level_of_government" id="levelOfGovernment">
                                <option value="">All Levels</option>
                                <?php
                                $level_of_government_options = cct_get_choices('level_of_government');
                                foreach ($level_of_government_options as $key => $value) {
                                    if (isset($_GET['level_of_government']) && $_GET['level_of_government'] === $key) {
                                        echo '<option value="' . $key . '" selected>' . $value . '</option>';
                                    } else {
                                        echo '<option value="' . $key . '">' . $value . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th> <label for="formsOfCorruption"> Forms of Corruption </label></th>
                        <td>
                            <select name="forms_of_corruption" id="formsOfCorruption">
                                <option value="">All Forms</option>
                                <?php
                                $level_of_government_options = cct_get_choices('forms_of_corruption');
                                foreach ($level_of_government_options as $key => $value) {
                                    if (isset($_GET['forms_of_corruption']) && $_GET['forms_of_corruption'] === $key) {
                                        echo '<option value="' . $key . '" selected>' . $value . '</option>';
                                    } else {
                                        echo '<option value="' . $key . '">' . $value . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                </table>
                <input type="hidden" name="post_type" value="case">
                <input type="hidden" name="page" value="tools">
                <input type="hidden" name="tab" value="export">
                <input type="hidden" name="export-begin" value="true">
                <button type="submit" class="button button-primary">Export Cases</button>
            </form>
            <?php
        }
        ?>
    </div>
</div>
