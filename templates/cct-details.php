<table>
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
                echo $option['choices'][$option['value']];
            }
            ?>
        </td>
    </tr>
    <tr>
        <th>Jurisdiction</th>
        <td>
            <?php
            $option = get_field_object('jurisdiction');
            if ($option) {
                echo $option['choices'][$option['value']];
            }
            ?>
        </td>
    </tr>
    <tr>
        <th>Sector of the Case</th>
        <td>
            <?php
            $option = get_field_object('sector_of_the_case');
            if ($option) {
                echo $option['choices'][$option['value']];
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
    <tr>
        <th>Summary of the Case</th>
        <td> <?php the_field('summary_of_the_case'); ?> </td>
    </tr>
    <tr>
        <th>Nature of the Case</th>
        <td> <?php the_field('nature_of_the_case'); ?> </td>
    </tr>
</table>
