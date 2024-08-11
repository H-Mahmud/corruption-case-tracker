<?php
/**
 * Custom Case Post type register
 * 
 * @return void
 */
function cct_case_post_type_register()
{
    register_post_type('case', array(
        'labels' => array(
            'name' => 'Cases',
            'singular_name' => 'Case',
            'menu_name' => 'Cases',
            'all_items' => 'All Cases',
            'edit_item' => 'Edit Case',
            'view_item' => 'View Case',
            'view_items' => 'View Cases',
            'add_new_item' => 'Add New Case',
            'add_new' => 'Add New Case',
            'new_item' => 'New Case',
            'parent_item_colon' => 'Parent Case:',
            'search_items' => 'Search Cases',
            'not_found' => 'No cases found',
            'not_found_in_trash' => 'No cases found in Trash',
            'archives' => 'Case Archives',
            'attributes' => 'Case Attributes',
            'insert_into_item' => 'Insert into case',
            'uploaded_to_this_item' => 'Uploaded to this case',
            'filter_items_list' => 'Filter cases list',
            'filter_by_date' => 'Filter cases by date',
            'items_list_navigation' => 'Cases list navigation',
            'items_list' => 'Cases list',
            'item_published' => 'Case published.',
            'item_published_privately' => 'Case published privately.',
            'item_reverted_to_draft' => 'Case reverted to draft.',
            'item_scheduled' => 'Case scheduled.',
            'item_updated' => 'Case updated.',
            'item_link' => 'Case Link',
            'item_link_description' => 'A link to a case.',
        ),
        'description' => 'Corruption Case Track',
        'public' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-category',
        'supports' => array(
            0 => 'title',
            1 => 'author',
            2 => 'custom-fields',
        ),
        'delete_with_user' => false,
    )
    );
}
add_action('init', 'cct_case_post_type_register');
