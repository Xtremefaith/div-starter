<?php
$THEME_DEV = TRUE; #Theme is in development mode
$LOCAL_DEV = TRUE; #Theme is in local environment
define( 'WP_VERSION', get_bloginfo('version') );

/* **************  PARENT THEME Paths definition *********************** */
define( 'DIV_NAME', wp_get_theme('Div Starter') );
define( 'DIV_LIBRARY_DIR', TEMPLATEPATH.'/library' );
define( 'DIV_LIBRARY_URL', get_template_directory_uri().'/library' );
define( 'DIV_CLASSES_DIR', DIV_LIBRARY_DIR.'/classes' );
define( 'DIV_CLASSES_URL', DIV_LIBRARY_URL.'/classes' );
define( 'DIV_MODULES_DIR', DIV_LIBRARY_DIR.'/modules' );
define( 'DIV_MODULES_URL', DIV_LIBRARY_URL.'/modules' );
define( 'DIV_FEATURES_DIR', DIV_LIBRARY_DIR.'/features' );
define( 'DIV_FEATURES_URL', DIV_LIBRARY_URL.'/features' );
/* **************  PARENT THEME Paths definition *********************** */
/* *************  CHILD THEMEPaths definition *********************** */
define( 'THEME_NAME', wp_get_theme() );
define( 'THEME_LIBRARY_DIR', get_stylesheet_directory().'/library' );
define( 'THEME_LIBRARY_URL', get_stylesheet_directory_uri().'/library' );
define( 'THEME_CLASSES_DIR', THEME_LIBRARY_DIR.'/classes' );
define( 'THEME_CLASSES_URL', THEME_LIBRARY_URL.'/classes' );
define( 'THEME_MODULES_DIR', THEME_LIBRARY_DIR.'/modules' );
define( 'THEME_MODULES_URL', THEME_LIBRARY_URL.'/modules' );
define( 'THEME_FEATURES_DIR', THEME_LIBRARY_DIR.'/features' );
define( 'THEME_FEATURES_URL', THEME_LIBRARY_URL.'/features' );
/* **************  CHILD THEME Paths definition *********************** */

/************************************
 * Load active features
 ************************************/
require_once(DIV_FEATURES_DIR.'/classes.php');                                          #FEATURE: Classes
require_once(DIV_FEATURES_DIR.'/acf/acf.php');                                          #FEATURE: ACF 4+
include_once(DIV_FEATURES_DIR.'/acf/acf-options-page/acf-options-page.php');            /*Options Page*/
include_once(DIV_FEATURES_DIR.'/acf-fields.php');                                       #FEATURE: ACF Fields
require_once(DIV_FEATURES_DIR.'/bones.php');                                            #FEATURE: Bones
require_once(DIV_FEATURES_DIR.'/div.php');                                              #FEATURE: Div Truth (on top of bones)
require_once(DIV_FEATURES_DIR.'/fields/image-widget-field/pco-image-widget-field.php'); #FEATURE: Image Widget Field
require_once(DIV_FEATURES_DIR.'/admin.php');                                            #FEATURE: Custom Admin
require_once(DIV_FEATURES_DIR.'/browser.php');                                          #FEATURE: Browser detection
require_once(DIV_FEATURES_DIR.'/options.php');                                          #FEATURE: Options pages
require_once(DIV_FEATURES_DIR.'/modules.php');                                          #FEATURE: Modules pages
require_once(DIV_FEATURES_DIR.'/theme-support.php');                                    #FEATURE: Theme Features
require_once(DIV_FEATURES_DIR.'/sidebars.php');                                         #FEATURE: Sidebars
require_once(DIV_FEATURES_DIR.'/widgets.php');                                          #FEATURE: Widgets
require_once(DIV_FEATURES_DIR.'/shortcodes.php');                                       #FEATURE: Shortcodes

/*****************************
 * ACF Plugin Activation
 *****************************/
add_action('acf/register_fields', 'div_register_fields');
add_filter('acf_settings', 'div_acf_settings');
function div_register_fields(){  #4.0+ Add ons
    include_once(DIV_FEATURES_DIR.'/acf/acf-repeater/repeater.php');                                  /*Repeater*/
    include_once(DIV_FEATURES_DIR.'/acf/acf-gallery/gallery.php');                                    /*Gallery*/
    include_once(DIV_FEATURES_DIR.'/acf/acf-location-field-master/acf-location.php');                 /*Location Field*/
    include_once(DIV_FEATURES_DIR.'/acf/acf-field-date-time-picker/acf-date_time_picker.php');        /*Time Picker Field*/
    include_once(DIV_FEATURES_DIR.'/acf/Gravity-Forms-ACF-Field-master/acf-gravity_forms.php');       /*Gravity Form Field*/
    include_once(DIV_FEATURES_DIR.'/acf/acf-cf7-field-master/acf-cf7.php');                           /*Contact Form 7 Field*/
}
function div_acf_settings( $options ){
    // activate add-ons
    $options['activation_codes']['repeater'] = 'QJF7-L4IX-UCNP-RF2W';
    $options['activation_codes']['options_page'] = 'OPN8-FA4J-Y2LW-81LS';
    $options['activation_codes']['gallery'] = 'GF72-8ME6-JS15-3PZC';
    //$options['activation_codes']['flexible_content'] = 'XXXX';
    return $options;
}

?>