<div class="cct-home">
    <form method="get" class="cct-search-form">
        <div class="search-filter-group">
            <label for="sector_of_the_case">Sector of the case
                <select name="sector_of_the_case" id="sector_of_the_case">
                    <option value="">All Sector</option>
                    <?php
                    $sector_of_the_case_options = cct_get_field_options('sector_of_the_case');
                    foreach ($sector_of_the_case_options as $key => $value) {
                        if (isset($_GET['sector_of_the_case']) && $_GET['sector_of_the_case'] === $key) {
                            echo '<option value="' . $key . '" selected>' . $value . '</option>';
                        } else {
                            echo '<option value="' . $key . '">' . $value . '</option>';
                        }
                    }
                    ?>
                </select>
            </label>
            <label for="jurisdiction">
                Jurisdiction
                <select name="jurisdiction" id="jurisdiction">
                    <option value="">All Jurisdiction</option>
                    <?php
                    $jurisdiction_options = cct_get_field_options('jurisdiction');
                    foreach ($jurisdiction_options as $key => $value) {
                        if (isset($_GET['jurisdiction']) && $_GET['jurisdiction'] === $key) {
                            echo '<option value="' . $key . '" selected>' . $value . '</option>';
                        } else {
                            echo '<option value="' . $key . '">' . $value . '</option>';
                        }
                    }
                    ?>
                </select>
            </label>
            <label for="caseStatus">
                Case Status
                <select name="case_status" id="caseStatus">
                    <option value="">All Statuses</option>
                    <?php
                    $case_status_options = cct_get_field_options('case_status');
                    foreach ($case_status_options as $key => $value) {
                        if (isset($_GET['case_status']) && $_GET['case_status'] === $key) {
                            echo '<option value="' . $key . '" selected>' . $value . '</option>';
                        } else {
                            echo '<option value="' . $key . '">' . $value . '</option>';
                        }
                    }
                    ?>
                </select>
            </label>
        </div>

        <?php



        ?>

        <div class="search-input-group">
            <input type="search" placeholder="Search here...">
            <input class="search-btn" type="submit" value="Search">
        </div>
    </form>

    <div class="cct-search-result">
        <?php
        $query = get_cct_cases();
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $status_field = get_field_object('case_status');
                $status_label = '';
                if ($status_field) {
                    $status = $status_field['value'];
                    $status_label = $status_field['choices'][$status];
                }


                // echo "<pre>";
                // var_dump(get_fields());
                // echo '</pre>';
                ?>
                <article class="case-card">
                    <div class="meta-info">
                        <span class="date"><?php the_field('submitted_at'); ?></span>
                        <span class="status"><?php echo $status_label; ?></span>
                    </div>
                    <?php the_title('<h2 class="title"><a href="' . get_permalink() . '">', '</a></h2>'); ?>
                    <div class="summary"><?php the_field('summary_of_the_case'); ?></div>
                </article>
                <?php
            }
        }
        ?>
    </div>
</div>
