<?php
defined('ABSPATH') || exit();


/**
 * CPT Sanction Custom Post Type Register
 * 
 * @return void;
 */
function cct_sanction_custom_post_type()
{

    register_post_type('sanction', array(
        'labels' => array(
            'name' => 'Sanctions',
            'singular_name' => 'Sanction',
            'menu_name' => 'Sanctions',
            'all_items' => 'All Sanctions',
            'edit_item' => 'Edit Sanction',
            'view_item' => 'View Sanction',
            'view_items' => 'View Sanctions',
            'add_new_item' => 'Add New Sanction',
            'add_new' => 'Add New Sanction',
            'new_item' => 'New Sanction',
            'parent_item_colon' => 'Parent Sanction:',
            'search_items' => 'Search Sanctions',
            'not_found' => 'No sanctions found',
            'not_found_in_trash' => 'No sanctions found in Trash',
            'archives' => 'Sanction Archives',
            'attributes' => 'Sanction Attributes',
            'insert_into_item' => 'Insert into sanction',
            'uploaded_to_this_item' => 'Uploaded to this sanction',
            'filter_items_list' => 'Filter sanctions list',
            'filter_by_date' => 'Filter sanctions by date',
            'items_list_navigation' => 'Sanctions list navigation',
            'items_list' => 'Sanctions list',
            'item_published' => 'Sanction published.',
            'item_published_privately' => 'Sanction published privately.',
            'item_reverted_to_draft' => 'Sanction reverted to draft.',
            'item_scheduled' => 'Sanction scheduled.',
            'item_updated' => 'Sanction updated.',
            'item_link' => 'Sanction Link',
            'item_link_description' => 'A link to a sanction.',
        ),
        'public' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-clipboard',
        'supports' => array(
            0 => 'title',
            1 => 'custom-fields',
        ),
        'delete_with_user' => false,
    ));
}
;
add_action('init', 'cct_sanction_custom_post_type');


/**
 *  Custom Fields for Sanction
 * 
 * @return void
 */
function cct_sanction_data_fields()
{

    acf_add_local_field_group(array(
        'key' => 'group_66fa33abef69b',
        'title' => 'sanction',
        'fields' => array(
            array(
                'key' => 'field_66fa33ac4cf64',
                'label' => 'Name',
                'name' => 'name',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'maxlength' => '',
                'allow_in_bindings' => 0,
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
            ),
            array(
                'key' => 'field_66fa33be4cf65',
                'label' => 'Sanctioned By',
                'name' => 'sanctioned_by',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'maxlength' => '',
                'allow_in_bindings' => 0,
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
            ),
            array(
                'key' => 'field_66fa33d64cf66',
                'label' => 'Date of Sanction',
                'name' => 'date_of_sanction',
                'aria-label' => '',
                'type' => 'date_picker',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'display_format' => 'd/m/Y',
                'return_format' => 'd/m/Y',
                'first_day' => 1,
                'allow_in_bindings' => 0,
            ),
            array(
                'key' => 'field_66fa34014cf67',
                'label' => 'reason for Sanction',
                'name' => 'reason_for_sanction',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'maxlength' => '',
                'allow_in_bindings' => 0,
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
            ),
            array(
                'key' => 'field_66fa340c4cf68',
                'label' => 'Scope of Sanction',
                'name' => 'scope_of_sanction',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'maxlength' => '',
                'allow_in_bindings' => 0,
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'sanction',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ));
}
;
add_action('acf/include_fields', 'cct_sanction_data_fields');
