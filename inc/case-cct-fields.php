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
                        'under_investigation' => 'Under Investigation',
                        'indictment_drawn' => 'Indictment Drawn',
                        'trial_court' => 'Trial Court',
                        'concluded_via_settlement' => 'Concluded via Settlement',
                        'concluded_via_dismissal' => 'Concluded via Dismissal',
                        'concluded_guilty' => 'Concluded; Guilty',
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
                    'key' => 'field_66ebc842673a3',
                    'label' => 'Judge',
                    'name' => 'judge',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_66a5d36961b65',
                                'operator' => '==',
                                'value' => 'concluded_guilty',
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
                    'allow_in_bindings' => 0,
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_66ebca91dd4c9',
                    'label' => 'Amount Recovered',
                    'name' => 'amount_recovered',
                    'aria-label' => '',
                    'type' => 'number',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_66a5d36961b65',
                                'operator' => '==',
                                'value' => 'concluded_guilty',
                            ),
                        ),
                        array(
                            array(
                                'field' => 'field_66a5d36961b65',
                                'operator' => '==',
                                'value' => 'concluded_via_settlement',
                            ),
                        ),
                    ),
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'min' => '',
                    'max' => '',
                    'allow_in_bindings' => 1,
                    'placeholder' => '',
                    'step' => '',
                    'prepend' => '',
                    'append' => '',
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
                    'key' => 'field_66ebcd6266fa8',
                    'label' => 'Case Number',
                    'name' => 'case_number',
                    'aria-label' => '',
                    'type' => 'number',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'min' => '',
                    'max' => '',
                    'allow_in_bindings' => 0,
                    'placeholder' => '',
                    'step' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_66ebcd8466fa9',
                    'label' => 'Amount Involved',
                    'name' => 'amount_involved',
                    'aria-label' => '',
                    'type' => 'number',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'min' => '',
                    'max' => '',
                    'allow_in_bindings' => 0,
                    'placeholder' => '',
                    'step' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_66ebd1c866fab',
                    'label' => 'Attachment',
                    'name' => 'attachment',
                    'aria-label' => '',
                    'type' => 'file',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'return_format' => 'array',
                    'library' => 'all',
                    'min_size' => '',
                    'max_size' => '',
                    'mime_types' => 'zip,docs,Docx,pdf,txt',
                    'allow_in_bindings' => 0,
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
                        'liberia_anti_corruption_commission' => 'Liberia Anti-Corruption Commission',
                        'ombudsman' => 'Ombudsman',
                        'magisterial_court' => 'Magisterial Court',
                        'circuit_court' => 'Circuit Court',
                        'supreme_court' => 'Supreme Court',
                        'liberia_revenue_authority' => 'Liberia Revenue Authority',
                        'ministry_of_justice' => 'Ministry of Justice'
                    ),
                    'default_value' => 'liberia_anti_corruption_commission',
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
                        'legislature' => 'Legislature',
                        'executive' => 'Executive',
                        'judiciary' => 'Judiciary',
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
                    'key' => 'field_66ebbb274cac1',
                    'label' => 'Forms of Corruption',
                    'name' => 'forms_of_corruption',
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
                        'procurement_irregularities_fraud' => 'Procurement Irregularities / Fraud',
                        'bribery' => 'Bribery',
                        'extortion' => 'Extortion',
                        'sextortion' => 'Sextortion',
                        'favoritism' => 'Favoritism',
                        'conflict_of_interest' => 'Conflict of Interest',
                        'misapplication' => 'Misapplication',
                        'misappropriation' => 'Misappropriation',
                        'fraud' => 'Fraud',
                        'abuse_of_office' => 'Abuse of Office',
                        'money_laundering' => 'Money Laundering',
                        'tax_evasion' => 'Tax Evasion',
                    ),
                    'default_value' => array(
                    ),
                    'return_format' => 'value',
                    'multiple' => 1,
                    'allow_null' => 0,
                    'allow_in_bindings' => 0,
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
                        'district' => 'District',
                        'town' => 'Town'
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
                /*
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
                ),*/
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


function cct_case_delay_date_fields()
{

    acf_add_local_field_group(array(
        'key' => 'group_66da7dac64b89',
        'title' => 'Case Delay Data Fields',
        'fields' => array(
            array(
                'key' => 'field_66da7dac2cb54',
                'label' => 'Is Alleged Delay',
                'name' => 'is_alleged_delay',
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
                'key' => 'field_66da7df92cb55',
                'label' => 'Alignned Start',
                'name' => 'alignned_start',
                'aria-label' => '',
                'type' => 'date_picker',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_66da7dac2cb54',
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
                'display_format' => 'd/m/Y',
                'return_format' => 'd/m/Y',
                'first_day' => 1,
                'allow_in_bindings' => 0,
            ),
            array(
                'key' => 'field_66da7e5e2cb56',
                'label' => 'Alignned End',
                'name' => 'alignned_end',
                'aria-label' => '',
                'type' => 'date_picker',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_66da7dac2cb54',
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
                'display_format' => 'd/m/Y',
                'return_format' => 'd/m/Y',
                'first_day' => 1,
                'allow_in_bindings' => 0,
            ),
            array(
                'key' => 'field_66da7ecb9a08b',
                'label' => 'Is Pending Investigation Delay',
                'name' => 'is_pending_investigation_delay',
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
                'key' => 'field_66da7efa9a08c',
                'label' => 'Pending Investigation Start',
                'name' => 'pending_investigation_start',
                'aria-label' => '',
                'type' => 'date_picker',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_66da7ecb9a08b',
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
                'display_format' => 'd/m/Y',
                'return_format' => 'd/m/Y',
                'first_day' => 1,
                'allow_in_bindings' => 0,
            ),
            array(
                'key' => 'field_66da7f1c9a08d',
                'label' => 'Pending Investigation End',
                'name' => 'pending_investigation_end',
                'aria-label' => '',
                'type' => 'date_picker',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_66da7ecb9a08b',
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
                'display_format' => 'd/m/Y',
                'return_format' => 'd/m/Y',
                'first_day' => 1,
                'allow_in_bindings' => 0,
            ),
            array(
                'key' => 'field_66dc0c10a8fe2',
                'label' => 'Is Under Investigation Delay',
                'name' => 'is_under_investigation_delay',
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
                'key' => 'field_66dc0c25a8fe3',
                'label' => 'Under Investigation Start',
                'name' => 'under_investigation_start',
                'aria-label' => '',
                'type' => 'date_picker',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_66dc0c10a8fe2',
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
                'display_format' => 'd/m/Y',
                'return_format' => 'd/m/Y',
                'first_day' => 1,
                'allow_in_bindings' => 0,
            ),
            array(
                'key' => 'field_66dc0c97a8fe4',
                'label' => 'Under Investigation End',
                'name' => 'under_investigation_end',
                'aria-label' => '',
                'type' => 'date_picker',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_66dc0c10a8fe2',
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
                'display_format' => 'd/m/Y',
                'return_format' => 'd/m/Y',
                'first_day' => 1,
                'allow_in_bindings' => 0,
            ),
            array(
                'key' => 'field_66dc0cc2f5502',
                'label' => 'Is Indictment Drawn Delay',
                'name' => 'is_indictment_drawn_delay',
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
                'key' => 'field_66dc0d1df5503',
                'label' => 'Indictment Drawn Start',
                'name' => 'indictment_drawn_start',
                'aria-label' => '',
                'type' => 'date_picker',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_66dc0cc2f5502',
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
                'display_format' => 'd/m/Y',
                'return_format' => 'd/m/Y',
                'first_day' => 1,
                'allow_in_bindings' => 0,
            ),
            array(
                'key' => 'field_66dc0d44f5504',
                'label' => 'Indictment Drawn End',
                'name' => 'indictment_drawn_end',
                'aria-label' => '',
                'type' => 'date_picker',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_66dc0cc2f5502',
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
                'display_format' => 'd/m/Y',
                'return_format' => 'd/m/Y',
                'first_day' => 1,
                'allow_in_bindings' => 0,
            ),
            array(
                'key' => 'field_66dc0d8b5c644',
                'label' => 'Is In Court Delay',
                'name' => 'is_in_court_delay',
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
                'key' => 'field_66dc0dae5c645',
                'label' => 'In Court Start',
                'name' => 'in_court_start',
                'aria-label' => '',
                'type' => 'date_picker',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_66dc0d8b5c644',
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
                'display_format' => 'd/m/Y',
                'return_format' => 'd/m/Y',
                'first_day' => 1,
                'allow_in_bindings' => 0,
            ),
            array(
                'key' => 'field_66dc0dc95c646',
                'label' => 'In Court End',
                'name' => 'in_court_end',
                'aria-label' => '',
                'type' => 'date_picker',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_66dc0d8b5c644',
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
                'display_format' => 'd/m/Y',
                'return_format' => 'd/m/Y',
                'first_day' => 1,
                'allow_in_bindings' => 0,
            ),
            array(
                'key' => 'field_66dc0e2f83dc0',
                'label' => 'Is Concluded Delay',
                'name' => 'is_concluded_delay',
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
                'key' => 'field_66dc0e4383dc1',
                'label' => 'Concluded Start',
                'name' => 'concluded_start',
                'aria-label' => '',
                'type' => 'date_picker',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_66dc0e2f83dc0',
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
                'display_format' => 'd/m/Y',
                'return_format' => 'd/m/Y',
                'first_day' => 1,
                'allow_in_bindings' => 0,
            ),
            array(
                'key' => 'field_66dc0e5e83dc2',
                'label' => 'Concluded End',
                'name' => 'concluded_end',
                'aria-label' => '',
                'type' => 'date_picker',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_66dc0e2f83dc0',
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
                'display_format' => 'd/m/Y',
                'return_format' => 'd/m/Y',
                'first_day' => 1,
                'allow_in_bindings' => 0,
            ),
            array(
                'key' => 'field_66dc0e7faa64d',
                'label' => 'Is Concluded: Conviction Delay',
                'name' => 'is_concluded:_conviction_delay',
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
                'key' => 'field_66dc0e8eaa64e',
                'label' => 'Concluded: Conviction Start',
                'name' => 'concluded:_conviction_start',
                'aria-label' => '',
                'type' => 'date_picker',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_66dc0e7faa64d',
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
                'display_format' => 'd/m/Y',
                'return_format' => 'd/m/Y',
                'first_day' => 1,
                'allow_in_bindings' => 0,
            ),
            array(
                'key' => 'field_66dc0ea6aa64f',
                'label' => 'Concluded: Conviction End',
                'name' => 'concluded:_conviction_end',
                'aria-label' => '',
                'type' => 'date_picker',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_66dc0e7faa64d',
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
                'display_format' => 'd/m/Y',
                'return_format' => 'd/m/Y',
                'first_day' => 1,
                'allow_in_bindings' => 0,
            ),
            array(
                'key' => 'field_66dc0ec3bc7f2',
                'label' => 'Is Concluded: Not Guilty Delay',
                'name' => 'is_concluded:_not_guilty_delay',
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
                'key' => 'field_66dc0edabc7f3',
                'label' => 'Concluded: Not Guilty Start',
                'name' => 'concluded:_not_guilty_start',
                'aria-label' => '',
                'type' => 'date_picker',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_66dc0ec3bc7f2',
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
                'display_format' => 'd/m/Y',
                'return_format' => 'd/m/Y',
                'first_day' => 1,
                'allow_in_bindings' => 0,
            ),
            array(
                'key' => 'field_66dc0efabc7f4',
                'label' => 'Concluded: Not Guilty End',
                'name' => 'concluded:_not_guilty_end',
                'aria-label' => '',
                'type' => 'date_picker',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_66dc0ec3bc7f2',
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
                'display_format' => 'd/m/Y',
                'return_format' => 'd/m/Y',
                'first_day' => 1,
                'allow_in_bindings' => 0,
            ),
            array(
                'key' => 'field_66dc0f2017b31',
                'label' => 'Is On Appeal to Supreme Court Delay',
                'name' => 'is_on_appeal_to_supreme_court_delay',
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
                'key' => 'field_66dc0f3417b32',
                'label' => 'On Appeal to Supreme Court Start',
                'name' => 'on_appeal_to_supreme_court_start',
                'aria-label' => '',
                'type' => 'date_picker',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_66dc0f2017b31',
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
                'display_format' => 'd/m/Y',
                'return_format' => 'd/m/Y',
                'first_day' => 1,
                'allow_in_bindings' => 0,
            ),
            array(
                'key' => 'field_66dc0f4b17b33',
                'label' => 'On Appeal to Supreme Court End',
                'name' => 'on_appeal_to_supreme_court_end',
                'aria-label' => '',
                'type' => 'date_picker',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_66dc0f2017b31',
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
    ));


}
add_action('acf/include_fields', 'cct_case_delay_date_fields');





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
    } else {
        CCT_Utils::delete_delay_case_status_date($post_id, $case_status);
    }

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


    foreach ($fields as $field) {
        CCT_Utils::delay_status_date_insert($post_id, 'delay_' . $field['status'], $field['is_delay'], $field['start_date'], $field['end_date']);
    }

}
add_action('save_post', 'cct_concluded_data_sav');

add_action('before_delete_post', 'cct_delete_data_record_on_post_delete');
function cct_delete_data_record_on_post_delete($post_id)
{
    global $wpdb;

    if (empty($post_id) || get_post_status($post_id) === false) {
        return;
    }

    $table_name = $wpdb->prefix . 'case_date_data';

    $wpdb->delete(
        $table_name,
        array('post_id' => $post_id),
        array('%d')
    );
}
