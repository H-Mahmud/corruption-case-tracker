<div class="cct-home">
    <form method="get" class="cct-search-form">
        <div class="search-filter-group">
            <label for="case-nature">Nature of the case
                <select name="case-nature" id="case-nature">
                    <option value="all" selected>All Nature</option>
                    <option value="government">Government</option>
                    <option value="individual">Individual</option>
                </select>
            </label>
            <label for="jurisdiction">
                Jurisdiction
                <select name="jurisdiction" id="jurisdiction">
                    <option value="all" selected>All Jurisdiction</option>
                    <option value="lacc">LACC</option>
                    <option value="lower_court">Lower Court</option>
                    <option value="upper_court">Upper Court</option>
                </select>
            </label>
            <label for="caseStatus">
                <select name="case_status" id="caseStatus">
                    <option value="all" selected>All Statuses</option>
                    <option value="alleged" selected>Alleged</option>
                    <option value="pending_investigation">Pending Investigation</option>
                    <option value="under_investigation">Under Investigation</option>
                    <option value="concluded">Concluded</option>
                </select>
            </label>
        </div>

        <div class="search-input-group">
            <input type="search" placeholder="Search here...">
            <button type="submit">Search</button>
        </div>
    </form>

    <div class="cct-search-result">
        <?php
        $query = new WP_Query(
            array(
                'post_type' => 'case'
            )
        );
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
                // var_dump($status_obj);
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
