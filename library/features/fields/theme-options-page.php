<?php 
/*
Feature Name:   ACF Fields: Theme Options
Developer URI:  http://www.DivTruth.com
Description:    All fields displayed on the theme options page should be here
Version:        1.0
Dependencies:   ACF
*/

 /*****************
 * FILTER OPTIONS
 *****************/
if(function_exists("register_field_group"))
{
        register_field_group(array (
                'id' => 'acf_filter-options',
                'title' => 'Filter Options',
                'fields' => array (
                        array (
                                'key' => 'field_51asd8747n1fd56',
                                'label' => 'Search by Relevance',
                                'name' => 'search_relevance',
                                'type' => 'radio',
                                'instructions' => 'Enable search results to search by relevance',
                                'choices' => array (
                                        'Disable' => 'Disable',
                                        'Enable' => 'Enable',
                                ),
                                'other_choice' => 0,
                                'save_other_choice' => 0,
                                'default_value' => 'Disable',
                                'layout' => 'horizontal',
                        ),
                        array (
                                'key' => 'field_51f43fa42fd56',
                                'label' => 'Widget Shortcodes',
                                'name' => 'widget_shortcodes',
                                'type' => 'radio',
                                'instructions' => 'Enable Shortcodes in widgets',
                                'choices' => array (
                                        'Disable' => 'Disable',
                                        'Enable' => 'Enable',
                                ),
                                'other_choice' => 0,
                                'save_other_choice' => 0,
                                'default_value' => 'Disable',
                                'layout' => 'horizontal',
                        ),
                        array (
                                'key' => 'field_51f43fa4ahhadd5',
                                'label' => 'Twitter Handlers',
                                'name' => 'twitter_handlers',
                                'type' => 'radio',
                                'instructions' => 'Link Twitter Handlers in content',
                                'choices' => array (
                                        'Disable' => 'Disable',
                                        'Enable' => 'Enable',
                                ),
                                'other_choice' => 0,
                                'save_other_choice' => 0,
                                'default_value' => 'Disable',
                                'layout' => 'horizontal',
                        ),
                ),
                'location' => array (
                        array (
                                array (
                                        'param' => 'options_page',
                                        'operator' => '==',
                                        'value' => 'acf-options-theme-settings',
                                        'order_no' => 5,
                                        'group_no' => 0,
                                ),
                        ),
                ),
                'options' => array (
                        'position' => 'side',
                        'layout' => 'default',
                        'hide_on_screen' => array (
                        ),
                ),
                'menu_order' => 5,
        ));
}

/**************************
 * Social Network Settings
 **************************/
if(function_exists("register_field_group")){
        register_field_group(array (
                'id' => 'acf_status-options',
                'title' => 'Status Options',
                'fields' => array (
                        array (
                                'key' => 'field_51aa84a34ahadd7',
                                'label' => 'Theme Develop Mode',
                                'name' => 'develop_mode',
                                'type' => 'radio',
                                'instructions' => 'Is theme currently in development (error message will appear while in development)',
                                'choices' => array (
                                        'Disable' => 'Disable',
                                        'Enable' => 'Enable',
                                ),
                                'other_choice' => 0,
                                'save_other_choice' => 0,
                                'default_value' => 'Enable',
                                'layout' => 'horizontal',
                        ),
                ),
                'location' => array (
                        array (
                                array (
                                        'param' => 'options_page',
                                        'operator' => '==',
                                        'value' => 'acf-options-theme-settings',
                                        'order_no' => 0,
                                        'group_no' => 0,
                                ),
                        ),
                ),
                'options' => array (
                        'position' => 'side',
                        'layout' => 'default',
                        'hide_on_screen' => array (
                        ),
                ),
                'menu_order' => 0,
        ));
}

?>