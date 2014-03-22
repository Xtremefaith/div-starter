<?php 
/*
Feature Name:   ACF Fields: Develop Tools
Developer URI:  http://www.DivTruth.com
Description:    All fields displayed on the developer tools page should be here
Version:        1.0
Dependencies:   ACF
*/

/************************
 * BRANDING OPTIONS
 ************************/
if(function_exists("register_field_group"))
{
        register_field_group(array (
                'id' => 'acf_child-theme-options',
                'title' => 'Branding Options',
                'fields' => array (
                        array (
                                'key' => 'field_5256e0a94d052',
                                'label' => 'Menu Label',
                                'name' => 'div_menu_label',
                                'type' => 'text',
                                'instructions' => 'Replace the "Div Truth Options" label',
                                'default_value' => 'Div Starter Options',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'formatting' => 'html',
                                'maxlength' => '',
                        ),
                        array (
                                'key' => 'field_5256e0f34d053',
                                'label' => 'Documentation Page',
                                'name' => 'div_documentation_page',
                                'type' => 'radio',
                                'instructions' => 'Enable documentation page?',
                                'required' => 1,
                                'choices' => array (
                                        'Enable' => 'Enable',
                                        'Disable' => 'Disable',
                                ),
                                'other_choice' => 0,
                                'save_other_choice' => 0,
                                'default_value' => '',
                                'layout' => 'horizontal',
                        ),
                ),
                'location' => array (
                        array (
                                array (
                                        'param' => 'options_page',
                                        'operator' => '==',
                                        'value' => 'acf-options-developer-tools',
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

        /**************************
         * Sitemap Options
         **************************/
        $post_types = CONTENT::get_post_type_options();
        register_field_group(array (
            'id' => 'acf_sitemap-details',
            'title' => 'Sitemap Details',
            'fields' => array (
                array (
                    'key' => 'field_52a21d118a25d',
                    'label' => 'Include Sitemap',
                    'name' => 'include_sitemap',
                    'type' => 'true_false',
                    'instructions' => 'Would you like to generate a sitemap page',
                    'required' => 0,
                    'message' => '',
                    'default_value' => 0,
                ),
                array (
                    'key' => 'field_52a21c3f8a25c',
                    'label' => 'Excluded Post Types',
                    'name' => 'sitemap_excluded_post_types',
                    'type' => 'checkbox',
                    'instructions' => 'Which post types should be excluded from the sitemap',
                    'conditional_logic' => array (
                        'status' => 1,
                        'rules' => array (
                            array (
                                'field' => 'field_52a21d118a25d',
                                'operator' => '==',
                                'value' => '1',
                            ),
                        ),
                        'allorany' => 'all',
                    ),
                    'choices' => $post_types,
                    'default_value' => '',
                    'layout' => 'vertical',
                ),
            ),
            'location' => array (
                array (
                    array (
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'acf-options-developer-tools',
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
            'menu_order' => 2,
        ));


         /**************************
         * Media Options
         **************************/
        register_field_group(array (
                'id' => 'acf_media-options',
                'title' => 'Media Options',
                'fields' => array (
                        array (
                                'key' => 'field_51a4dfa4ahadd7',
                                'label' => 'JPG Compression Quality',
                                'name' => 'jpg_quality',
                                'type' => 'text',
                                'instructions' => 'Set percentage for JPG compression on upload images <em>(WordPress default it 75%)</em> <br/><strong>Enter just a number (i.e. 75)</strong>',                                
                                'default_value' => '100',
                                'formatting' => 'none',
                        ),
                        array (
                                'key' => 'field_51f1q9c21fd56',
                                'label' => 'Set Thumbnail Defaults',
                                'name' => 'div_set_thumbnail_defaults',
                                'type' => 'radio',
                                'instructions' => 'Manually set image size defaults on media upload',
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
                                'key' => 'field_51d12nyhsadd7',
                                'label' => 'Default Image Sizes',
                                'name' => 'div_image_sizes',
                                'type' => 'checkbox',
                                'instructions' => 'Select the which default WP image sizes are crunched',
                                'choices' => array (
                                        'thumbnail' => 'Thumbnail',
                                        'medium' => 'Medium',
                                        'large' => 'Large',
                                ),
                                'conditional_logic' => array (
                                        'status' => 1,
                                        'rules' => array (
                                                array (
                                                        'field' => 'field_51f1q9c21fd56',
                                                        'operator' => '==',
                                                        'value' => 'Enable',
                                                ),
                                        ),
                                        'allorany' => 'any',
                                ),
                                'default_value' => '100',
                                'formatting' => 'none',
                        ),
                ),
                'location' => array (
                        array (
                                array (
                                        'param' => 'options_page',
                                        'operator' => '==',
                                        'value' => 'acf-options-developer-tools',
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
                'menu_order' => 10,
        ));

    /************************
     * DEVELOPER DETAILS
     ************************/
        register_field_group(array (
                'id' => 'acf_developer-details',
                'title' => 'Developer Details',
                'fields' => array (
                        array (
                                'key' => 'field_5256e21394b27',
                                'label' => 'Developer Contacts',
                                'name' => 'developer_contacts',
                                'type' => 'repeater',
                                'instructions' => 'Insert a new block for each developer / contributor',
                                'sub_fields' => array (
                                        array (
                                                'key' => 'field_5256e27194b28',
                                                'label' => 'Name',
                                                'name' => 'name',
                                                'type' => 'text',
                                                'column_width' => '',
                                                'default_value' => '',
                                                'placeholder' => '',
                                                'prepend' => '',
                                                'append' => '',
                                                'formatting' => 'html',
                                                'maxlength' => '',
                                        ),
                                        array (
                                                'key' => 'field_5256e29994b29',
                                                'label' => 'Title',
                                                'name' => 'title',
                                                'type' => 'text',
                                                'column_width' => '',
                                                'default_value' => '',
                                                'placeholder' => '',
                                                'prepend' => '',
                                                'append' => '',
                                                'formatting' => 'html',
                                                'maxlength' => '',
                                        ),
                                        array (
                                                'key' => 'field_5256e2a094b2a',
                                                'label' => 'Email',
                                                'name' => 'email',
                                                'type' => 'text',
                                                'column_width' => '',
                                                'default_value' => '',
                                                'placeholder' => '',
                                                'prepend' => '',
                                                'append' => '',
                                                'formatting' => 'html',
                                                'maxlength' => '',
                                        ),
                                        array (
                                                'key' => 'field_5256e2a994b2b',
                                                'label' => 'Phone',
                                                'name' => 'phone',
                                                'type' => 'text',
                                                'instructions' => '(optional)',
                                                'column_width' => '',
                                                'default_value' => '',
                                                'placeholder' => '',
                                                'prepend' => '',
                                                'append' => '',
                                                'formatting' => 'html',
                                                'maxlength' => '',
                                        ),
                                        array (
                                                'key' => 'field_5256e2c094b2c',
                                                'label' => 'Twitter',
                                                'name' => 'twitter',
                                                'type' => 'text',
                                                'instructions' => '(optional)',
                                                'column_width' => '',
                                                'default_value' => '',
                                                'placeholder' => '',
                                                'prepend' => '',
                                                'append' => '',
                                                'formatting' => 'html',
                                                'maxlength' => '',
                                        ),
                                        array (
                                                'key' => 'field_5256e2d594b2d',
                                                'label' => 'Website',
                                                'name' => 'website',
                                                'type' => 'text',
                                                'column_width' => '',
                                                'default_value' => '',
                                                'placeholder' => '',
                                                'prepend' => '',
                                                'append' => '',
                                                'formatting' => 'html',
                                                'maxlength' => '',
                                        ),
                                        array (
                                                'key' => 'field_5256e2fc94b2e',
                                                'label' => 'Notes',
                                                'name' => 'notes',
                                                'type' => 'textarea',
                                                'column_width' => '',
                                                'default_value' => '',
                                                'placeholder' => '',
                                                'maxlength' => 150,
                                                'formatting' => 'none',
                                        ),
                                        array (
                                                'key' => 'field_5256eaa570a3d',
                                                'label' => 'Headshot URL',
                                                'name' => 'headshot_url',
                                                'type' => 'text',
                                                'column_width' => '',
                                                'default_value' => '',
                                                'placeholder' => '',
                                                'prepend' => '',
                                                'append' => '',
                                                'formatting' => 'html',
                                                'maxlength' => '',
                                        ),
                                ),
                                'row_min' => 0,
                                'row_limit' => '',
                                'layout' => 'table',
                                'button_label' => 'Add Contributor',
                        ),
                ),
                'location' => array (
                        array (
                                array (
                                        'param' => 'options_page',
                                        'operator' => '==',
                                        'value' => 'acf-options-developer-tools',
                                        'order_no' => 0,
                                        'group_no' => 0,
                                ),
                        ),
                ),
                'options' => array (
                        'position' => 'normal',
                        'layout' => 'default',
                        'hide_on_screen' => array (
                        ),
                ),
                'menu_order' => 0,
        ));
}

/********************************
 * Twitter API 1.1 Authentication
 ********************************/
if(function_exists("register_field_group")){
        register_field_group(array (
                'id' => 'acf_twitter-authentication',
                'title' => 'Twitter Authentication',
                'fields' => array (
                        array (
                                'key' => 'field_5227ae62169ed',
                                'label' => 'Oauth Access Token',
                                'name' => 'oauth_access_token',
                                'type' => 'text',
                                'instructions' => 'Enter Access Token. <a href="https://dev.twitter.com/docs/auth/tokens-devtwittercom">Need Help?</a>',
                                'default_value' => '',
                                'placeholder' => '3712828794-aagRVUk9jMa8XhRnA9ebvUiraXym1dGXqodHzF3',
                                'prepend' => '',
                                'append' => '',
                                'formatting' => 'none',
                                'maxlength' => 50,
                        ),
                        array (
                                'key' => 'field_5227aff1169ee',
                                'label' => 'Oauth Access Token Secret',
                                'name' => 'oauth_access_token_secret',
                                'type' => 'text',
                                'instructions' => 'Enter Access Token Secret. <a href="https://dev.twitter.com/docs/auth/tokens-devtwittercom">Need Help?</a>',
                                'default_value' => '',
                                'placeholder' => 'LnbIzxJdLIrbVz6IM7ubmI1iJLMUy3sRTumQYWbIe',
                                'prepend' => '',
                                'append' => '',
                                'formatting' => 'none',
                                'maxlength' => 41,
                        ),
                        array (
                                'key' => 'field_5227b087169ef',
                                'label' => 'Consumer Key',
                                'name' => 'consumer_key',
                                'type' => 'text',
                                'instructions' => 'Enter Consumer Key. <a href="http://www.youtube.com/watch?v=5PUC9yGS4RI">Need Help?</a>',
                                'default_value' => '',
                                'placeholder' => 'MItaitONxu3R3pu50U0B',
                                'prepend' => '',
                                'append' => '',
                                'formatting' => 'none',
                                'maxlength' => '',
                        ),
                        array (
                                'key' => 'field_5227b0e2169f0',
                                'label' => 'Consumer Secret',
                                'name' => 'consumer_secret',
                                'type' => 'text',
                                'instructions' => 'Enter Consumer Secret. <a href="http://www.youtube.com/watch?v=5PUC9yGS4RI">Need Help?</a>',
                                'default_value' => '',
                                'placeholder' => 'pt8Uu39wyrpBZMZOHVGeIaaPGkzIxjNv1WGT2Te24B',
                                'prepend' => '',
                                'append' => '',
                                'formatting' => 'none',
                                'maxlength' => '',
                        ),
                ),
                'location' => array (
                        array (
                                array (
                                        'param' => 'options_page',
                                        'operator' => '==',
                                        'value' => 'acf-options-developer-tools',
                                        'order_no' => 0,
                                        'group_no' => 0,
                                ),
                        ),
                ),
                'options' => array (
                        'position' => 'normal',
                        'layout' => 'default',
                        'hide_on_screen' => array (
                        ),
                ),
                'menu_order' => 2,
        ));
}

/********************************
 * Facebook Authentication
 ********************************/
if(function_exists("register_field_group")){
        register_field_group(array (
                'id' => 'acf_facebook-authentication',
                'title' => 'Facebook API Authentication',
                'fields' => array (
                        array (
                                'key' => 'field_9e1s8d5ws9rg4',
                                'label' => 'App ID / API key',
                                'name' => 'fb_api_key',
                                'type' => 'text',
                                'instructions' => 'Enter Facebook App ID/API Key. <a href="http://premium.wpmudev.org/forums/topic/how-to-make-a-facebook-app-for-your-site">Need help creating Facebook Application?</a>',
                                'default_value' => '',
                                'placeholder' => '437522166123972',
                                'prepend' => '',
                                'append' => '',
                                'formatting' => 'none',
                                'maxlength' => 50,
                        ),
                        array (
                                'key' => 'field_sg12f9asg51frg',
                                'label' => 'Facebook Secret Key',
                                'name' => 'fb_secret_key',
                                'type' => 'text',
                                'instructions' => 'Enter Facebook Secret Key.',
                                'default_value' => '',
                                'placeholder' => '7a48126fe44337dc2a24478370bd5b52',
                                'prepend' => '',
                                'append' => '',
                                'formatting' => 'none',
                                'maxlength' => 50,
                        ),
                ),
                'location' => array (
                        array (
                                array (
                                        'param' => 'options_page',
                                        'operator' => '==',
                                        'value' => 'acf-options-developer-tools',
                                        'order_no' => 0,
                                        'group_no' => 0,
                                ),
                        ),
                ),
                'options' => array (
                        'position' => 'normal',
                        'layout' => 'default',
                        'hide_on_screen' => array (
                        ),
                ),
                'menu_order' => 2,
        ));
}

/********************************
 * Dropbox Authentication
 ********************************/
if(function_exists("register_field_group")){
        register_field_group(array (
                'id' => 'acf_dropbox-credentials',
                'title' => 'Dropbox Credentials',
                'fields' => array (
                        array (
                                'key' => 'field_s981gw3854f',
                                'label' => 'Dropbox Email',
                                'name' => 'dropbox_email',
                                'type' => 'text',
                                'instructions' => 'Enter the admin dropbox email',
                                'default_value' => '',
                                'placeholder' => 'admin@domain.com',
                                'prepend' => '',
                                'append' => '',
                                'formatting' => 'none',
                        ),
                        array (
                                'key' => 'field_g8a168w31b8j',
                                'label' => 'Dropbox Password',
                                'name' => 'dropbox_password',
                                'type' => 'password',
                                'instructions' => 'Enter dropbox account password',
                                'default_value' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'formatting' => 'none',
                        ),
                ),
                'location' => array (
                        array (
                                array (
                                        'param' => 'options_page',
                                        'operator' => '==',
                                        'value' => 'acf-options-developer-tools',
                                        'order_no' => 0,
                                        'group_no' => 0,
                                ),
                        ),
                ),
                'options' => array (
                        'position' => 'normal',
                        'layout' => 'default',
                        'hide_on_screen' => array (
                        ),
                ),
                'menu_order' => 2,
        ));
}

/**************************
 * Google Analytics ID
 **************************/
if(function_exists("register_field_group")){
        register_field_group(array (
                'id' => 'acf_google-analytics',
                'title' => 'Google Analytics',
                'fields' => array (
                            array (
                            'key' => 'field_5g8s1sw98h1w01',
                            'label' => 'Include Google Analytics',
                            'name' => 'include_ga_code',
                            'type' => 'true_false',
                            'instructions' => 'Would you like to generate google analytic code',
                            'required' => 0,
                            'message' => '',
                            'default_value' => 0,
                        ),
                        array (
                                'key' => 'field_5194a22146f01',
                                'label' => 'Google Analytics ID',
                                'name' => 'google_analytics_id',
                                'type' => 'text',
                                'instructions' => 'Enter Analytics ID <strong>\'UA-########-#\'</strong>
        <a href="https://support.google.com/analytics/answer/1032385?hl=en" target="_blank">Where do I get this?</a>',
                                'conditional_logic' => array (
                                    'status' => 1,
                                    'rules' => array (
                                        array (
                                            'field' => 'field_5g8s1sw98h1w01',
                                            'operator' => '==',
                                            'value' => '1',
                                        ),
                                    ),
                                    'allorany' => 'all',
                                ),
                                'default_value' => 'UA-########-#',
                                'formatting' => 'none',
                        ),
                        array (
                                'key' => 'field_5g8s1285vbs8s11',
                                'label' => 'Google Analytics Domain Name',
                                'name' => 'google_analytics_domain',
                                'type' => 'text',
                                'instructions' => 'Enter Analytics Domain Name <strong>(optional)</strong>',
                                'conditional_logic' => array (
                                    'status' => 1,
                                    'rules' => array (
                                        array (
                                            'field' => 'field_5g8s1sw98h1w01',
                                            'operator' => '==',
                                            'value' => '1',
                                        ),
                                    ),
                                    'allorany' => 'all',
                                ),
                                'default_value' => '',
                                'formatting' => 'none',
                        ),
                        array (
                                'key' => 'field_5hg851ws9gwa2w',
                                'label' => 'Header/Footer',
                                'name' => 'google_analytics_load',
                                'type' => 'radio',
                                'instructions' => 'Load script in header or footer?',
                                'conditional_logic' => array (
                                    'status' => 1,
                                    'rules' => array (
                                        array (
                                            'field' => 'field_5g8s1sw98h1w01',
                                            'operator' => '==',
                                            'value' => '1',
                                        ),
                                    ),
                                    'allorany' => 'all',
                                ),
                                'required' => 1,
                                'choices' => array (
                                        'Footer' => 'Footer',
                                        'Header' => 'Header',
                                ),
                                'other_choice' => 0,
                                'save_other_choice' => 0,
                                'default_value' => 'Footer',
                                'layout' => 'horizontal',
                        ),
                ),
                'location' => array (
                        array (
                                array (
                                        'param' => 'options_page',
                                        'operator' => '==',
                                        'value' => 'acf-options-developer-tools',
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
                'menu_order' => 1,
        ));
}

/**************************
 * Included JS scripts
 **************************/
if(function_exists("register_field_group")){
        register_field_group(array (
                'id' => 'acf_include-bxslider',
                'title' => 'Include BXSlider',
                'fields' => array (
                            array (
                            'key' => 'field_g1a89g1w3g84s',
                            'label' => 'Include Include BXSlider',
                            'name' => 'include_bxslider',
                            'type' => 'true_false',
                            'instructions' => 'Do you want to include <a href="http://bxslider.com/" target="_blank">BXSlider</a>',
                            'required' => 0,
                            'message' => '',
                            'default_value' => 0,
                        ),
                        array (
                                'key' => 'field_w91sdf5219q1b',
                                'label' => 'Header/Footer',
                                'name' => 'load_bxslider',
                                'type' => 'radio',
                                'instructions' => 'Load script in header or footer?',
                                'conditional_logic' => array (
                                    'status' => 1,
                                    'rules' => array (
                                        array (
                                            'field' => 'field_g1a89g1w3g84s',
                                            'operator' => '==',
                                            'value' => '1',
                                        ),
                                    ),
                                    'allorany' => 'all',
                                ),
                                'required' => 1,
                                'choices' => array (
                                        'Footer' => 'Footer',
                                        'Header' => 'Header',
                                ),
                                'other_choice' => 0,
                                'save_other_choice' => 0,
                                'default_value' => 'Footer',
                                'layout' => 'horizontal',
                        ),
                ),
                'location' => array (
                        array (
                                array (
                                        'param' => 'options_page',
                                        'operator' => '==',
                                        'value' => 'acf-options-developer-tools',
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
                'menu_order' => 1,
        ));
}
?>
