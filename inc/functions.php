<?php

/**
 * Get ACF Dropdown field choices by field key | meta key
 * 
 * @param string $field_key meta key
 * @return array dropdown choices;
 */
function cct_get_choices($field_key)
{
    $field = acf_get_field($field_key);
    if ($field) {
        return $field['choices'];
    }
    return [];
}


/**
 * Get color for cas status badge
 * 
 * @param string $status
 * @return string color
 */
function cct_get_status_color($status)
{
    $statuses_color = [
        'alleged' => '#FF5733',             // Bright Red
        // 'pending_investigation' => '#ffc552', // Bright Orange
        'under_investigation' => '#3357FF',   // Bright Blue
        'indictment_drawn' => '#33C3FF', // Magenta
        'trial_court' => '#C70039', // Rich Red
        'concluded_via_settlement' => '#52ff63',             // Bright Green
        'concluded_via_dismissal' => '#5263ff',             // Bright Green
        'concluded_guilty' => '#900C3F', // Deep Maroon
        'concluded_not_guilty' => '#3498DB', // Bright Blue
        'on_appeal_to_supreme_court' => '#8E44AD', // Strong Purple
    ];

    return isset($statuses_color[$status]) ? $statuses_color[$status] : '#FFF';
}
