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

/**
 * Case status according fields ACF ID for status date period
 * 
 * @return string[][]
 */
function cct_get_status_attr()
{
    return $fields = [
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
}


/**
 * Modifies a meta query value based on its comparison operator.
 *
 * @param string $value   The value to modify.
 * @param string $compare The comparison operator.
 *
 * @return string The modified value.
 */
function cct_meta_query_value($value, $compare)
{
    if ($compare === 'LIKE') {
        return '%' . $value . '%';
    } else {
        return $value;
    }
}


/**
 * Gets the current URL.
 *
 * @return string The current URL.
 */
function get_current_url()
{
    // Get the protocol (HTTP or HTTPS)
    $protocol = is_ssl() ? 'https://' : 'http://';

    // Get the host (domain name) and the request URI
    $host = $_SERVER['HTTP_HOST'];
    $request_uri = $_SERVER['REQUEST_URI'];

    // Combine them to form the full URL
    return $protocol . $host . $request_uri;
}
