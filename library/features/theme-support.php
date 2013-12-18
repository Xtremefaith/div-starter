<?php 
/*
Feature Name:   Theme Support Options
Developer URI:  http://www.DivTruth.com
Author: 		Div Truth LLC
Description:    Theme Support options provided by framework

These are the standard options for Div Starter Themes, please DO NOT EDIT
for the purpose of a single project, instead edit the child theme version of this file
*/

/************************************
 * WP MENUS
 * @description: Enable menu WP menu support
 * @author: Nick Worth
 * @since: 1.0
 ************************************/
add_theme_support( 'menus' );

/************************************
 * FEATURED IMAGES
 * @description: Enable menu WP thumbnail support for featured images in post
 * @author: Nick Worth
 * @since: 1.0
 ************************************/
add_theme_support( 'post-thumbnails' ); 


/************************************
 * REGISTER DEFAULT NAV MENUS
 * @description: Enable the default menus
 * @author: Nick Worth
 * @since: 1.0
 ************************************/
register_nav_menus(
	array(
		'main-nav' => __( 'Main Navigation', 'div_starter' ),   // main nav in header
		'mobile-nav' => __( 'Mobile Navigation', 'div_starter' ), // alternative main menu for mobile
		'utility-nav' => __( 'Utility Nav', 'div_starter' ), // secondary nav, often smaller in top right
	)
);

function div_starter_main_nav() {
    wp_nav_menu(array(
    	'container' => false,                           // remove nav container
    	'container_class' => 'menu clearfix',           // class of container (should you choose to use it)
    	'menu' => __( 'Main Navigation', 'div_starter' ),  // nav name
    	'menu_class' => 'nav top-nav clearfix',         // adding custom nav class
    	'theme_location' => 'main-nav',                 // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 0,                                   // limit the depth of the nav
	));
} /* end div_starter main nav */

function div_starter_mobile_nav() {
    wp_nav_menu(array(
    	'container' => false,                           // remove nav container
    	'container_class' => 'menu clearfix',           // class of container (should you choose to use it)
    	'menu' => __( 'Mobile Navigation', 'div_starter' ),  // nav name
    	'menu_class' => 'nav top-nav clearfix',         // adding custom nav class
    	'theme_location' => 'mobile-nav',                 // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 0,                                   // limit the depth of the nav
	));
} /* end div_starter mobile nav */

function div_starter_utility_nav() {
    wp_nav_menu(array(
    	'container' => false,                           // remove nav container
    	'container_class' => 'menu clearfix',           // class of container (should you choose to use it)
    	'menu' => __( 'Utility Nav', 'div_starter' ),  // nav name
    	'menu_class' => 'utility-nav clearfix',         // adding custom nav class
    	'theme_location' => 'utility-nav',                 // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 0,                                   // limit the depth of the nav
	));
} /* end div_starter utility nav */

?>