<?php
/**
 * Register Custom fields for case post type to store case data
 * 
 */
function cct_case_data_fields()
{
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(
        array(
            'key' => 'group_66a5d36905afe',
            'title' => 'CCT',
            'fields' => array(
                array(
                    'key' => 'field_66a5d36961b65',
                    'label' => 'Case Status',
                    'name' => 'case_status',
                    'aria-label' => '',
                    'type' => 'select',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'choices' => array(
                        'alleged' => 'Alleged',
                        'pending_investigation' => 'Pending Investigation',
                        'under_investigation' => 'Under Investigation',
                        'indictment_drawn' => 'Indictment Drawn',
                        'in_court' => 'In Court',
                        'concluded' => 'Concluded',
                        'concluded_conviction' => 'Concluded: Conviction',
                        'concluded_not_guilty' => 'Concluded: Not Guilty',
                        'on_appeal_to_supreme_court' => 'On Appeal to Supreme Court',
                    ),
                    'default_value' => 'alleged',
                    'return_format' => 'value',
                    'multiple' => 0,
                    'allow_null' => 0,
                    'ui' => 0,
                    'ajax' => 0,
                    'placeholder' => '',
                ),
                array(
                    'key' => 'field_66c6c28b6bb2e',
                    'label' => 'Year of conclusion',
                    'name' => 'year_of_conclusion',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_66a5d36961b65',
                                'operator' => '==',
                                'value' => 'concluded',
                            ),
                        ),
                        array(
                            array(
                                'field' => 'field_66a5d36961b65',
                                'operator' => '==',
                                'value' => 'concluded_not_guilty',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_66a5d571e13bb',
                    'label' => 'Jurisdiction',
                    'name' => 'jurisdiction',
                    'aria-label' => '',
                    'type' => 'select',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'choices' => array(
                        'lacc' => 'LACC',
                        'ombudsman' => 'Ombudsman',
                        'magisterial_court' => 'Magisterial Court',
                        'circuit_court' => 'Circuit Court',
                        'supreme_court' => 'Supreme Court',
                    ),
                    'default_value' => 'lacc',
                    'return_format' => 'value',
                    'multiple' => 0,
                    'allow_null' => 0,
                    'ui' => 0,
                    'ajax' => 0,
                    'placeholder' => '',
                ),
                array(
                    'key' => 'field_66a5dbb14661b',
                    'label' => 'Nature of the Case',
                    'name' => 'nature_of_the_case',
                    'aria-label' => '',
                    'type' => 'textarea',
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
                    'rows' => '',
                    'placeholder' => '',
                    'new_lines' => '',
                ),
                array(
                    'key' => 'field_66a77507012d0',
                    'label' => 'Sector of the Case',
                    'name' => 'sector_of_the_case',
                    'aria-label' => '',
                    'type' => 'select',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'choices' => array(
                        'health' => 'Health',
                        'agriculture' => 'Agriculture',
                        'infrastructure' => 'Infrastructure',
                        'land' => 'Land',
                        'education' => 'Education',
                        'security_and_rule_of_law' => 'Security and Rule of Law',
                        'water_and_sanitation' => 'Water and Sanitation',
                        'elections' => 'Elections',
                        'transparency_and_accountability' => 'Transparency and Accountability',
                        'public_administration' => 'Public Administration',
                        'energy_and_environment' => 'Energy and Environment',
                        'industry_and_commerce' => 'Industry and Commerce',
                        'social_development_services' => 'Social Development Services',
                        'private_sector' => 'Private Sector',
                        'civil_society' => 'Civil Society',
                        'telecommunications' => 'Telecommunications',
                        'non_profit' => 'Non-profit'
                    ),
                    'default_value' => 'health',
                    'return_format' => 'value',
                    'multiple' => 0,
                    'allow_null' => 0,
                    'ui' => 0,
                    'ajax' => 0,
                    'placeholder' => '',
                ),
                array(
                    'key' => 'field_66b8562e29fe3',
                    'label' => 'Level of Government',
                    'name' => 'level_of_government',
                    'aria-label' => '',
                    'type' => 'select',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'choices' => array(
                        'national' => 'National',
                        'county' => 'County',
                        'municipal' => 'Municipal',
                    ),
                    'default_value' => 'national',
                    'return_format' => 'value',
                    'multiple' => 0,
                    'allow_null' => 0,
                    'ui' => 0,
                    'ajax' => 0,
                    'placeholder' => '',
                ),
                array(
                    'key' => 'field_66a7761c012d1',
                    'label' => 'Summary of the Case',
                    'name' => 'summary_of_the_case',
                    'aria-label' => '',
                    'type' => 'textarea',
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
                    'rows' => '',
                    'placeholder' => '',
                    'new_lines' => '',
                ),
                array(
                    'key' => 'field_66b85d4827001',
                    'label' => 'Is the case delayed?',
                    'name' => 'is_the_case_delayed',
                    'aria-label' => '',
                    'type' => 'true_false',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'message' => '',
                    'default_value' => 0,
                    'ui' => 0,
                    'ui_on_text' => '',
                    'ui_off_text' => '',
                ),
                array(
                    'key' => 'field_66b870321a26d',
                    'label' => 'Duration at Alleged',
                    'name' => 'alleged',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_66b85d4827001',
                                'operator' => '==',
                                'value' => '1',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '50',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_66b85e1527002',
                    'label' => 'Duration at Pending Investigation',
                    'name' => 'pending_investigation',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_66b85d4827001',
                                'operator' => '==',
                                'value' => '1',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '50',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_66b870f6359aa',
                    'label' => 'Duration at Under Investigation',
                    'name' => 'under_investigation',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_66b85d4827001',
                                'operator' => '==',
                                'value' => '1',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '50',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_66b8712d359ab',
                    'label' => 'Duration at Indictment Drawn',
                    'name' => 'indictment_drawn',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_66b85d4827001',
                                'operator' => '==',
                                'value' => '1',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '50',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_66b87153359ac',
                    'label' => 'Duration at In Court',
                    'name' => 'in_court',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_66b85d4827001',
                                'operator' => '==',
                                'value' => '1',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '50',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_66b8717d359ad',
                    'label' => 'Duration at Concluded',
                    'name' => 'concluded',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_66b85d4827001',
                                'operator' => '==',
                                'value' => '1',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '50',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_66b87199359ae',
                    'label' => 'Duration at Concluded: Conviction',
                    'name' => 'concluded_conviction',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_66b85d4827001',
                                'operator' => '==',
                                'value' => '1',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '50',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_66b871b8359af',
                    'label' => 'Duration at Concluded: Not Guilty',
                    'name' => 'concluded_not_guilty',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_66b85d4827001',
                                'operator' => '==',
                                'value' => '1',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '50',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_66b871d4359b0',
                    'label' => 'Duration at On Appeal to Supreme Court',
                    'name' => 'on_appeal_to_supreme_court',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_66b85d4827001',
                                'operator' => '==',
                                'value' => '1',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '50',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_66d82c35b0042',
                    'label' => 'Concluded',
                    'name' => 'concluded',
                    'aria-label' => '',
                    'type' => 'true_false',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'message' => '',
                    'default_value' => 0,
                    'allow_in_bindings' => 0,
                    'ui' => 0,
                    'ui_on_text' => '',
                    'ui_off_text' => '',
                ),
                array(
                    'key' => 'field_66d82c852304c',
                    'label' => 'Start Date',
                    'name' => 'start_date',
                    'aria-label' => '',
                    'type' => 'date_picker',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_66d82c35b0042',
                                'operator' => '==',
                                'value' => '1',
                            ),
                        ),
                    ),
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
                    'key' => 'field_66d82d342304d',
                    'label' => 'Concluded Date',
                    'name' => 'concluded_date',
                    'aria-label' => '',
                    'type' => 'date_picker',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_66d82c35b0042',
                                'operator' => '==',
                                'value' => '1',
                            ),
                        ),
                    ),
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
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'case',
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
        )
    );
}
;
add_action('acf/include_fields', 'cct_case_data_fields');



/**
 * Save case concluded date data on a custom table table
 * 
 * @param mixed $post_id
 * @return void
 */
function cct_concluded_data_sav($post_id)
{
    if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || !current_user_can('edit_post', $post_id))
        return;

    if (!isset($_POST['acf']))
        return;

    $case_status = $_POST['acf']['field_66a5d36961b65'];

    if (isset($_POST['acf']['field_66d82c35b0042']) && $_POST['acf']['field_66d82c35b0042']) {
        $start_date_obj = DateTime::createFromFormat('Ymd', $_POST['acf']['field_66d82c852304c']);
        $start_date = $start_date_obj->format('Y-m-j');

        $end_date_obj = DateTime::createFromFormat('Ymd', $_POST['acf']['field_66d82d342304d']);
        $end_date = $end_date_obj->format('Y-m-j');
        CCT_Utils::update_case_status_date($post_id, $case_status, $start_date, $end_date);
    }


}
add_action('save_post', 'cct_concluded_data_sav');






