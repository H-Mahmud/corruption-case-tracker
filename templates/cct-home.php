<div class="cct-home">
    <form method="get" class="cct-search-form">
        <div class="search-filter-group">
            <label for="sector_of_the_case">Sector of the case
                <select name="sector_of_the_case" id="sector_of_the_case">
                    <option value="">All Sector</option>
                    <?php
                    $sector_of_the_case_options = CCT_Utils::get_field_options('sector_of_the_case');
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
                    $jurisdiction_options = CCT_Utils::get_field_options('jurisdiction');
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
                    $case_status_options = CCT_Utils::get_field_options('case_status');
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

            <label for="levelOfGovernment">
                Government Level
                <select name="level_of_government" id="levelOfGovernment">
                    <option value="">All Levels</option>
                    <?php
                    $level_of_government_options = CCT_Utils::get_field_options('level_of_government');
                    foreach ($level_of_government_options as $key => $value) {
                        if (isset($_GET['level_of_government']) && $_GET['level_of_government'] === $key) {
                            echo '<option value="' . $key . '" selected>' . $value . '</option>';
                        } else {
                            echo '<option value="' . $key . '">' . $value . '</option>';
                        }
                    }
                    ?>
                </select>
            </label>

        </div>

        <div class="search-input-group">
            <input class="search-input" type="search" name="cct-search" placeholder="Search here..."
                value="<?php echo isset($_GET['cct-search']) ? $_GET['cct-search'] : '' ?>">
            <input class="search-btn" type="submit" value="Search">
        </div>
    </form>
    <?php
    $case_query = new CCT_Case_Query();
    $query = $case_query->get_query();

    if ($query->have_posts()) { ?>

        <div class="cct-search-result">
            <?php
            while ($query->have_posts()) {
                $query->the_post();
                $status_field = get_field_object('case_status');
                $status_label = '';
                if ($status_field) {
                    $status = $status_field['value'];
                    $status_label = $status_field['choices'][$status] ?? '';
                }

                ?>
                <article class="case-card">
                    <div class="meta-info">
                        <span class="date"><?php the_date(); ?></span>
                        <span class="status" <?php $status_color = CCT_Utils::get_status_color($status_field['value']); ?>
                            style="background-color: <?php echo $status_color; ?>33;"><?php echo $status_label; ?></span>
                    </div>
                    <?php the_title('<h2 class="title"><a href="' . get_permalink() . '">', '</a></h2>'); ?>
                    <div class="summary"><?php the_field('nature_of_the_case'); ?></div>
                </article>
                <?php
            }
            ?>
        </div>
        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        // Pagination Links
        echo '<div class="cct-pagination">';

        // Previous Page Link
        if ($paged > 1) {
            echo '<a class="page" href="' . get_pagenum_link($paged - 1) . '">Previous</a>';
        }

        // Page Numbers
        for ($i = 1; $i <= $query->max_num_pages; $i++) {
            if ($i == $paged) {
                echo '<span class="page">' . $i . '</span>';
            } else {
                echo '<a class="page" href="' . get_pagenum_link($i) . '">' . $i . '</a>';
            }
        }

        // Next Page Link
        if ($paged < $query->max_num_pages) {
            echo '<a class="page" href="' . get_pagenum_link($paged + 1) . '">Next</a>';
        }

        echo '</div>';

        // Reset post data
        wp_reset_postdata();


    } else {
        echo '<h2>Not found</h2>';
    }
    ?>

</div>
