<?php 
/*
Feature Name:   Menu
Developer URI:  http://www.DivTruth.com
Description:    All custom WP menu/page options
Version:        1.2
*/

/*****************************
 * Setup Custom Pages & Menus
 *****************************/
if(function_exists("register_options_page")){
    register_options_page('Theme Settings');
    register_options_page('Company Settings');
    register_options_page('Modules Settings');
    register_options_page('Documentation');    
    register_options_page('Developer Tools');    
}

/* ACTIONS */
add_action('admin_menu', 'div_option_page_menus');  # Div Truth Options Menu
add_action('admin_menu', 'hide_acf_admin_menu',999);  # Div Truth Options Menu

/* FUNCTIONS */
function hide_acf_admin_menu() {
    # If "Theme Develop Mode" is disabled
    if(get_field('develop_mode','options') == "Disable"){
      remove_menu_page('edit.php?post_type=acf'); # Remove ACF Menu
      remove_submenu_page('admin.php?page=acf-options-theme-settings','admin.php?page=acf-options-developer-tools'); # Remove Developer Tools
    }
    # If "Documentation Page" is disabled
    if(get_field('div_documentation_page','options') == "Disable"){
      remove_submenu_page('admin.php?page=acf-options-theme-settings','documentation');
    }
}

function div_option_page_menus() {
  $menu_label = (get_field('div_menu_label','option')) ? get_field('div_menu_label','option') : 'Div Starter Options';
  if(!file_exists(THEME_LIBRARY_URL.'/images/admin-logo.png')){
    $menu_icon = THEME_LIBRARY_URL.'/images/admin-logo.png';
  } else {
    $menu_icon = DIV_LIBRARY_URL.'/images/admin-logo.png';
  }
  
  add_menu_page("<span class='DT_title'>".$menu_label."</span>", "<span class='DT_title'>".$menu_label."</span>", 'manage_options','admin.php?page=acf-options-theme-settings',"",$menu_icon,4);
  add_submenu_page('admin.php?page=acf-options-theme-settings', __('Developer Tools','theme-main'), __('Developer Tools','theme-main'), 'manage_options', 'admin.php?page=acf-options-developer-tools');
  add_submenu_page('admin.php?page=acf-options-theme-settings', __('Documentation','theme-main'), __('Documentation','theme-main'), 'manage_options', 'documentation', 'div_active_pages');
  add_submenu_page('admin.php?page=acf-options-theme-settings', __('Company Settings','theme-main'), __('Company Settings','theme-main'), 'manage_options', 'admin.php?page=acf-options-company-settings');
  if(file_exists(THEME_FEATURES_DIR.'/modules.php')){
    add_submenu_page('admin.php?page=acf-options-company-settings', __('Modules','theme-main'), __('Modules','theme-main'), 'manage_options', 'admin.php?page=acf-options-modules-settings');
  }
}
function div_active_pages(){
  include(DIV_FEATURES_DIR.'/documentation.php');           #FEATURE: Documentation
}

?>