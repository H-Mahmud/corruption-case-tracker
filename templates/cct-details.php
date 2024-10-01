<table class="cct-details">
    <tr>
        <th>Case Number</th>
        <td><?php the_field('case_number'); ?></td>
    </tr>
    <tr>
        <th>Case Title</th>
        <td><?php the_title(); ?></td>
    </tr>
    <tr>
        <th>Submitted At</th>
        <td><?php the_date(); ?></td>
    </tr>
    <tr>
        <th>Case Status</th>
        <td>
            <?php
            $option = get_field_object('case_status');
            if ($option) {
                echo $option['choices'][$option['value']] ?? '';
            }
            ?>
        </td>
    </tr>

    <?php
    $chart_show_by = get_field('case_status');
    if ($chart_show_by == 'concluded_guilty' || $chart_show_by == 'concluded_not_guilty') { ?>
        <tr>
            <th>Judge</th>
            <td><?php the_field('judge'); ?></td>
        </tr>
    <?php } ?>

    <tr>
        <th>Amount Involved</th>
        <td>
            <span class="currency-badge">
                <?php $amount = get_field('amount_involved_usd');
                echo '$' . number_format(intval($amount), 2, '.', ','); ?>
                USD
            </span>
            <span class="currency-badge">
                <?php $amount = get_field('amount_involved_lrd');
                echo '$' . number_format(intval($amount), 2, '.', ','); ?>
                LRD
            </span>
        </td>
    </tr>
    <?php
    $chart_show_by = get_field(selector: 'case_status');
    if ($chart_show_by == 'concluded_guilty' || $chart_show_by == 'concluded_via_settlement') { ?>
        <tr>
            <th>Amount Recovered</th>
            <td><?php the_field('amount_recovered'); ?></td>
        </tr>
    <?php } ?>

    <?php
    if (get_field('year_of_conclusion')) { ?>
        <tr>
            <th>Year of Conclusion</th>
            <td><?php the_field('year_of_conclusion'); ?></td>
        </tr>
    <?php } ?>
    <?php
    if (get_delay_duration_statuses()) {
        ?>
        <tr>
            <th>Delay Duration</th>
            <td class="delay-status">
                <?php
                echo get_delay_duration_statuses();
                ?>
            </td>
        </tr>
        <?php
    }
    ?>
    <tr>
        <th>Jurisdiction</th>
        <td>
            <?php
            $option = get_field_object('jurisdiction');
            if ($option) {
                echo $option['choices'][$option['value']] ?? '';
            }
            ?>
        </td>
    </tr>
    <tr>
        <th>Sector of the Case</th>
        <td class="form-of-corruption">
            <?php
            $option = get_field_object('sector_of_the_case');
            foreach ($option['value'] as $value) {
                $badge = $option['choices'][$value] ?? false;

                if ($badge) {
                    echo '<span>' . $badge . '</span>';
                }
            }
            ?>
        </td>
    </tr>
    <tr>
        <th>Level of Government</th>
        <td>
            <?php
            $option = get_field_object('level_of_government');
            if ($option) {
                echo $option['choices'][$option['value']];
            }
            ?>
        </td>
    </tr>
    <tr class="form-of-corruption">
        <th>Forms of Corruption</th>
        <td>
            <?php
            $option = get_field_object('forms_of_corruption');

            foreach ($option['value'] as $value) {
                $badge = $option['choices'][$value] ?? false;

                if ($badge) {
                    echo '<span>' . $badge . '</span>';
                }
            }
            ?>
        </td>
    </tr>
    <tr>
        <th>Summary of the Case</th>
        <td> <?php the_field('summary_of_the_case'); ?> </td>
    </tr>
    <tr>
        <th>Nature of the Case</th>
        <td> <?php the_field('nature_of_the_case'); ?> </td>
    </tr>

    <?php
    if (get_field('attachment')) { ?>
        <tr>
            <th>Attachment</th>
            <td>
                <?php $attachment = get_field('attachment'); ?>
                <a class="download-button" href="<?php echo $attachment['url']; ?>" download><span><img
                            src="<?php echo $attachment['icon']; ?>" alt="<?php echo $attachment['title']; ?>"></span>
                    Download</a>
            </td>
        </tr>
    <?php } ?>
</table>


<?php

function get_delay_duration_statuses()
{
    $fields = [
        [
            'status' => 'alleged',
            'is_delay' => 'field_66da7dac2cb54',
            'start_date' => 'field_66da7df92cb55',
            'end_date' => 'field_66da7e5e2cb56'
        ],
        [
            'status' => 'pending_investigation',
            'is_delay' => 'field_66da7ecb9a08b',
            'start_date' => 'field_66da7efa9a08c',
            'end_date' => 'field_66da7f1c9a08d'
        ],
        [
            'status' => 'under_investigation',
            'is_delay' => 'field_66dc0c10a8fe2',
            'start_date' => 'field_66dc0c25a8fe3',
            'end_date' => 'field_66dc0c97a8fe4'
        ],
        [
            'status' => 'indictment_drawn',
            'is_delay' => 'field_66dc0cc2f5502',
            'start_date' => 'field_66dc0d1df5503',
            'end_date' => 'field_66dc0d44f5504'
        ],
        [
            'status' => 'in_court',
            'is_delay' => 'field_66dc0d8b5c644',
            'start_date' => 'field_66dc0dae5c645',
            'end_date' => 'field_66dc0dc95c646'
        ],
        [
            'status' => 'concluded',
            'is_delay' => 'field_66dc0e2f83dc0',
            'start_date' => 'field_66dc0e4383dc1',
            'end_date' => 'field_66dc0e5e83dc2'
        ],
        [
            'status' => 'concluded_conviction',
            'is_delay' => 'field_66dc0e7faa64d',
            'start_date' => 'field_66dc0e8eaa64e',
            'end_date' => 'field_66dc0ea6aa64f'
        ],
        [
            'status' => 'concluded_not_guilty',
            'is_delay' => 'field_66dc0ec3bc7f2',
            'start_date' => 'field_66dc0edabc7f3',
            'end_date' => 'field_66dc0efabc7f4'
        ],
        [
            'status' => 'on_appeal_to_supreme_court',
            'is_delay' => 'field_66dc0f2017b31',
            'start_date' => 'field_66dc0f3417b32',
            'end_date' => 'field_66dc0f4b17b33'
        ]
    ];


    $status_obj = get_field_object('case_status');


    $badged = false;
    foreach ($fields as $field) {

        if (get_field($field['is_delay'])) {
            $bg_color = cct_get_status_color($field['status']) . '33';

            $start_date_key = get_field_object($field['start_date'])['_name'];
            $end_date_key = get_field_object($field['end_date'])['_name'];

            $start = get_field($start_date_key);
            $end = get_field($end_date_key);

            // Convert the dates into DateTime objects
            $startDate = DateTime::createFromFormat('d/m/Y', $start);
            $endDate = DateTime::createFromFormat('d/m/Y', $end);

            // Calculate the difference between the two dates
            $interval = $startDate->diff($endDate);
            $status = $status_obj['choices'][$field['status']] ?? '';

            if (cct_format_interval($interval)) {
                $label = $status . ' ' . cct_format_interval($interval);
                $badged .= <<<HTML
                    <span style="background-color: $bg_color;">$label</span>
                HTML;

            } else {
                $label = $start . ' Started ' . $status;
                $badged .= <<<HTML
                    <span style="background-color: $bg_color;">$label</span>
                HTML;
            }

        }
    }
    return $badged;
}

function cct_format_interval($interval)
{
    $parts = [];

    if ($interval->y > 0) {
        $parts[] = $interval->y . ' year' . ($interval->y > 1 ? 's' : '');
    }

    if ($interval->m > 0) {
        $parts[] = $interval->m . ' month' . ($interval->m > 1 ? 's' : '');
    }

    if ($interval->d > 0) {
        $parts[] = $interval->d . ' day' . ($interval->d > 1 ? 's' : '');
    }

    if (empty($parts)) {
        return false;
    }

    return implode(', ', $parts);
}
