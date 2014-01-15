<?php 
/*
Feature Name:   Custom Post Types
Description:    All CPT activations are setup and installed here
Dependencies:   ACF
*/

/******************************************************
 * DIRECTIONS: Activation Setup and Install Modules 
 * 		by uncommenting the modules that you want turned
 *		on for this particular theme
 ******************************************************/
global $theme_modules;
if(file_exists(THEME_MODULES_DIR))
    $theme_modules = div_dir_array(THEME_MODULES_DIR);
$fields = array();

if($theme_modules){
    foreach ($theme_modules as $module => $path) {
        $slug = CUSTOM::slugify($module);
    	$cpt = CUSTOM::singularize_slug($module);
    	$field = array(
    		'key' => 'field_'.$slug,
            'label' => 'Enable '.$module.' Module',
            'name' => $slug.'_module',
            'type' => 'radio',
            'instructions' => 'Do you want to enable the '.$module.' module?',
            'choices' => array (
                    'Disable' => 'Disable',
                    'Enable' => 'Enable',
            ),
            'other_choice' => 0,
            'save_other_choice' => 0,
            'default_value' => 'Disable',
            'layout' => 'horizontal',
        );
        array_push($fields, $field);

        if(file_exists(THEME_MODULES_DIR.'/'.$module.'/_'.$cpt.'.php'))
            require_once( THEME_MODULES_DIR.'/'.$module.'/_'.$cpt.'.php');
        
        if(file_exists(THEME_MODULES_DIR.'/'.$module.'/fields.php'))
            require_once( THEME_MODULES_DIR.'/'.$module.'/fields.php');

        if(file_exists(THEME_MODULES_DIR.'/'.$module.'/columns.php'))
            require_once( THEME_MODULES_DIR.'/'.$module.'/columns.php');

        if(file_exists(THEME_MODULES_DIR.'/'.$module.'/permalinks.php'))
            require_once( THEME_MODULES_DIR.'/'.$module.'/permalinks.php');

        if(file_exists(THEME_MODULES_DIR.'/'.$module.'/shortcodes.php'))
            require_once( THEME_MODULES_DIR.'/'.$module.'/shortcodes.php');
    }
}

/**************************
 * Initialize Modules
 **************************/
if(function_exists("register_field_group")){
    register_field_group(array (
        'id' => 'acf_modules-available',
        'title' => 'Modules Available',
        'fields' => $fields,
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-modules-settings',
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
