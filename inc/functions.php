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
