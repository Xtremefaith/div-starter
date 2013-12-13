<?php 
/*
Feature Name:   ACF Fields: Theme Options
Developer URI:  http://www.DivTruth.com
Description:    All fields displayed on the theme options page should be here
Version:        1.0
Dependencies:   ACF
*/

/*****************
 * Company Details
 *****************/
if(function_exists("register_field_group")){
        register_field_group(array (
                'id' => 'acf_company-details',
                'title' => 'Company Details',
                'fields' => array (
                        array (
                                'key' => 'field_2',
                                'label' => 'Name',
                                'name' => 'name',
                                'type' => 'text',
                                'instructions' => 'The full company/business name',
                                'default_value' => '',
                                'formatting' => 'none',
                        ),
                        array (
                                'key' => 'field_3',
                                'label' => 'Phone',
                                'name' => 'phone',
                                'type' => 'text',
                                'instructions' => 'Business phone number',
                                'default_value' => '',
                                'formatting' => 'none',
                        ),
                        array (
                                'key' => 'field_354160',
                                'label' => 'TTY Phone',
                                'name' => 'tty_phone',
                                'type' => 'text',
                                'instructions' => 'TTY phone number',
                                'default_value' => '',
                                'formatting' => 'none',
                        ),
                        array (
                                'key' => 'field_4',
                                'label' => 'Street Address',
                                'name' => 'street_address',
                                'type' => 'text',
                                'default_value' => '',
                                'formatting' => 'none',
                        ),
                        array (
                                'key' => 'field_5',
                                'label' => 'City',
                                'name' => 'city',
                                'type' => 'text',
                                'default_value' => '',
                                'formatting' => 'none',
                        ),
                        array (
                                'key' => 'field_6',
                                'label' => 'State',
                                'name' => 'state',
                                'type' => 'text',
                                'default_value' => '',
                                'formatting' => 'none',
                        ),
                        array (
                                'key' => 'field_7',
                                'label' => 'Zip',
                                'name' => 'zip',
                                'type' => 'text',
                                'default_value' => '',
                                'formatting' => 'none',
                        ),
                        array (
                                'key' => 'field_34',
                                'label' => 'Map Link',
                                'name' => 'map_link',
                                'type' => 'text',
                                'instructions' => 'Copy and past the permalink from your preferred map',
                                'default_value' => '',
                                'formatting' => 'none',
                        ),
                ),
                'location' => array (
                        array (
                                array (
                                        'param' => 'options_page',
                                        'operator' => '==',
                                        'value' => 'acf-options-company-settings',
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

/**************************
 * Social Network Settings
 **************************/
if(function_exists("register_field_group"))
{
        register_field_group(array (
                'id' => 'acf_social-media-details',
                'title' => 'Social Media Details',
                'fields' => array (
                        array (
                                'key' => 'field_51917b9c677d8',
                                'label' => 'Social Options',
                                'name' => 'social_options',
                                'type' => 'checkbox',
                                'instructions' => 'Select the social networks you would like to include for this project',
                                'multiple' => 0,
                                'allow_null' => 0,
                                'choices' => array (
                                        'email'         => 'email',
                                        'facebook'      => 'facebook',
                                        'flicker'       => 'flicker',
                                        'goodreads'     => 'goodreads',
                                        'google'        => 'google',
                                        'instagram'     => 'instagram',
                                        'linkedin'      => 'linkedin',
                                        'pinterest'     => 'pinterest',
                                        'rss'           => 'rss',
                                        'twitter'       => 'twitter',
                                        'youtube'       => 'youtube',
                                        'plus'          => 'plus',
                                ),
                                'default_value' => 'facebook
        twitter
        email',
                        ),
                        array (
                                'key' => 'field_51917b1f677d5',
                                'label' => 'Email Link',
                                'name' => 'email_link',
                                'type' => 'text',
                                'instructions' => 'Company contact email',
                                'conditional_logic' => array (
                                        'status' => 1,
                                        'rules' => array (
                                                array (
                                                        'field' => 'field_51917b9c677d8',
                                                        'operator' => '==',
                                                        'value' => 'email',
                                                ),
                                        ),
                                        'allorany' => 'all',
                                ),
                                'default_value' => 'email@mydomain.com',
                                'formatting' => 'none',
                        ),
                        array (
                                'key' => 'field_51917b1f677d6',
                                'label' => 'Facebook Link',
                                'name' => 'facebook_link',
                                'type' => 'text',
                                'instructions' => 'Company facebook page URL',
                                'conditional_logic' => array (
                                        'status' => 1,
                                        'rules' => array (
                                                array (
                                                        'field' => 'field_51917b9c677d8',
                                                        'operator' => '==',
                                                        'value' => 'facebook',
                                                ),
                                        ),
                                        'allorany' => 'all',
                                ),
                                'default_value' => 'http://facebook.com/',
                                'formatting' => 'none',
                        ),
                        array (
                                'key' => 'field_51917b62677d1',
                                'label' => 'Flicker Link',
                                'name' => 'flicker_link',
                                'type' => 'text',
                                'instructions' => 'Company flicker profile URL',
                                'conditional_logic' => array (
                                        'status' => 1,
                                        'rules' => array (
                                                array (
                                                        'field' => 'field_51917b9c677d8',
                                                        'operator' => '==',
                                                        'value' => 'flicker',
                                                ),
                                        ),
                                        'allorany' => 'all',
                                ),
                                'default_value' => 'http://flicker.com',
                                'formatting' => 'none',
                        ),
                        array (
                                'key' => 'field_51917b62677d2',
                                'label' => 'GoodReads Link',
                                'name' => 'goodreads_link',
                                'type' => 'text',
                                'instructions' => 'Company goodreads profile URL',
                                'conditional_logic' => array (
                                        'status' => 1,
                                        'rules' => array (
                                                array (
                                                        'field' => 'field_51917b9c677d8',
                                                        'operator' => '==',
                                                        'value' => 'goodreads',
                                                ),
                                        ),
                                        'allorany' => 'all',
                                ),
                                'default_value' => 'http://goodreads.com',
                                'formatting' => 'none',
                        ),
                        array (
                                'key' => 'field_51917e76677da',
                                'label' => 'Google+ Link',
                                'name' => 'google_link',
                                'type' => 'text',
                                'instructions' => 'Company google+ page URL',
                                'conditional_logic' => array (
                                        'status' => 1,
                                        'rules' => array (
                                                array (
                                                        'field' => 'field_51917b9c677d8',
                                                        'operator' => '==',
                                                        'value' => 'google',
                                                ),
                                        ),
                                        'allorany' => 'all',
                                ),
                                'default_value' => 'http://plus.google.com',
                                'formatting' => 'none',
                        ),
                        array (
                                'key' => 'field_51917e78877da',
                                'label' => 'Instagram Link',
                                'name' => 'instagram_link',
                                'type' => 'text',
                                'instructions' => 'Company instagram page URL',
                                'conditional_logic' => array (
                                        'status' => 1,
                                        'rules' => array (
                                                array (
                                                        'field' => 'field_51917b9c677d8',
                                                        'operator' => '==',
                                                        'value' => 'instagram',
                                                ),
                                        ),
                                        'allorany' => 'all',
                                ),
                                'default_value' => 'http://www.instagram.com',
                                'formatting' => 'none',
                        ),
                        array (
                                'key' => 'field_51917e79977da',
                                'label' => 'LinkedIn Link',
                                'name' => 'linkedin_link',
                                'type' => 'text',
                                'instructions' => 'Company linkedin page URL',
                                'conditional_logic' => array (
                                        'status' => 1,
                                        'rules' => array (
                                                array (
                                                        'field' => 'field_51917b9c677d8',
                                                        'operator' => '==',
                                                        'value' => 'linkedin',
                                                ),
                                        ),
                                        'allorany' => 'all',
                                ),
                                'default_value' => 'http://www.linkedin.com',
                                'formatting' => 'none',
                        ),
                        array (
                                'key' => 'field_51917e25677d9',
                                'label' => 'Pinterest Link',
                                'name' => 'pinterest_link',
                                'type' => 'text',
                                'instructions' => 'Company pinterest page URL',
                                'conditional_logic' => array (
                                        'status' => 1,
                                        'rules' => array (
                                                array (
                                                        'field' => 'field_51917b9c677d8',
                                                        'operator' => '==',
                                                        'value' => 'pinterest',
                                                ),
                                        ),
                                        'allorany' => 'all',
                                ),
                                'default_value' => 'http://pinterest.com',
                                'formatting' => 'none',
                        ),
                        array (
                                'key' => 'field_51917e25677d0',
                                'label' => 'RSS Link',
                                'name' => 'rss_link',
                                'type' => 'text',
                                'instructions' => 'Website rss URL',
                                'conditional_logic' => array (
                                        'status' => 1,
                                        'rules' => array (
                                                array (
                                                        'field' => 'field_51917b9c677d8',
                                                        'operator' => '==',
                                                        'value' => 'rss',
                                                ),
                                        ),
                                        'allorany' => 'all',
                                ),
                                'default_value' => get_bloginfo('atom_url'),
                                'formatting' => 'none',
                        ),
                        array (
                                'key' => 'field_51917b62677d7',
                                'label' => 'Twitter Link',
                                'name' => 'twitter_link',
                                'type' => 'text',
                                'instructions' => 'Company twitter profile URL',
                                'conditional_logic' => array (
                                        'status' => 1,
                                        'rules' => array (
                                                array (
                                                        'field' => 'field_51917b9c677d8',
                                                        'operator' => '==',
                                                        'value' => 'twitter',
                                                ),
                                        ),
                                        'allorany' => 'all',
                                ),
                                'default_value' => 'http://twitter.com',
                                'formatting' => 'none',
                        ),
                        array (
                                'key' => 'field_51917eaa677db',
                                'label' => 'YouTube Link',
                                'name' => 'youtube_link',
                                'type' => 'text',
                                'instructions' => 'Company youtube channel URL',
                                'conditional_logic' => array (
                                        'status' => 1,
                                        'rules' => array (
                                                array (
                                                        'field' => 'field_51917b9c677d8',
                                                        'operator' => '==',
                                                        'value' => 'youtube',
                                                ),
                                        ),
                                        'allorany' => 'all',
                                ),
                                'default_value' => 'http://youtube.com',
                                'formatting' => 'none',
                        ),
                        array (
                                'key' => 'field_51917b62677d8',
                                'label' => 'Plus Link',
                                'name' => 'plus_link',
                                'type' => 'text',
                                'instructions' => 'Company div profile URL',
                                'conditional_logic' => array (
                                        'status' => 1,
                                        'rules' => array (
                                                array (
                                                        'field' => 'field_51917b9c677d8',
                                                        'operator' => '==',
                                                        'value' => 'plus',
                                                ),
                                        ),
                                        'allorany' => 'all',
                                ),
                                'default_value' => 'http://divtruth.com',
                                'formatting' => 'none',
                        ),
                ),
                'location' => array (
                        array (
                                array (
                                        'param' => 'options_page',
                                        'operator' => '==',
                                        'value' => 'acf-options-company-settings',
                                        'order_no' => 0,
                                        'group_no' => 0,
                                ),
                        ),
                ),
                'options' => array (
                        'position' => 'side',
                        'layout' => 'no_box',
                        'hide_on_screen' => array (
                        ),
                ),
                'menu_order' => 0,
        ));
}

add_action( 'admin_bar_menu', 'activateCheckboxes');
function activateCheckboxes(){
        echo '<script>
                jQuery(document).ready(function($){
                        $("input.checkbox:checked").parent().toggleClass("active");
                        $("input.checkbox").on("click", function(e){
                                $(this).parent().toggleClass("active");
                        });
                });
        </script>';
}

/**************************
 * Footer Details
 **************************/
if(function_exists("register_field_group")){
        register_field_group(array (
                'id' => 'acf_footer-details',
                'title' => 'Footer Details',
                'fields' => array (
                        array (
                                'key' => 'field_21984131',
                                'label' => 'Footer Message',
                                'name' => 'footer_message',
                                'type' => 'textarea',
                                'instructions' => 'Enter the message in the footer',
                                'default_value' => '',
                                'formatting' => 'none',
                        ),
                ),
                'location' => array (
                        array (
                                array (
                                        'param' => 'options_page',
                                        'operator' => '==',
                                        'value' => 'acf-options-company-settings',
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
?>