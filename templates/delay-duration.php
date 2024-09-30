<?php
$status_field = get_field_object('case_status');
foreach ($status_field['choices'] as $key => $value) {
    if ($duration = get_field($key)) {
        $bg_color = cct_get_status_color($key) . '33';
        echo <<<HTML
            <span style="background-color: $bg_color;">$duration $value</span>
        HTML;
    }
}
