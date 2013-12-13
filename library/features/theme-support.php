<?php 
/*
Feature Name:   Theme Support Options
Developer URI:  http://www.DivTruth.com
Author: 		Div Truth LLC
Description:    Theme Support options specific to this child theme

These are the standard options for Div Truth Themes, please DO NOT EDIT for the purpose of a single project, instead edit the child theme version of this file
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
		'main-nav' => __( 'The Main Menu', 'div_starter' ),   // main nav in header
		'mobile-nav' => __( 'Mobile Responsive Alt Menu', 'div_starter' ), // alternative main menu for mobile
		'utility-nav' => __( 'Utility Menu', 'div_starter' ), // secondary nav, often smaller in top right
	)
);

function div_starter_main_nav() {
    wp_nav_menu(array(
    	'container' => false,                           // remove nav container
    	'container_class' => 'menu clearfix',           // class of container (should you choose to use it)
    	'menu' => __( 'The Main Menu', 'div_starter' ),  // nav name
    	'menu_class' => 'nav top-nav clearfix',         // adding custom nav class
    	'theme_location' => 'main-nav',                 // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 0,                                   // limit the depth of the nav
    	'fallback_cb' => 'div_starter_main_nav_fallback'      // fallback function
	));
} /* end div_starter main nav */

function div_starter_mobile_nav() {
    wp_nav_menu(array(
    	'container' => false,                           // remove nav container
    	'container_class' => 'menu clearfix',           // class of container (should you choose to use it)
    	'menu' => __( 'Mobile Responsive Alt Menu', 'div_starter' ),  // nav name
    	'menu_class' => 'nav top-nav clearfix',         // adding custom nav class
    	'theme_location' => 'mobile-nav',                 // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 0,                                   // limit the depth of the nav
    	'fallback_cb' => 'div_starter_main_nav_fallback'      // fallback function
	));
} /* end div_starter mobile nav */

function div_starter_utility_nav() {
    wp_nav_menu(array(
    	'container' => false,                           // remove nav container
    	'container_class' => 'menu clearfix',           // class of container (should you choose to use it)
    	'menu' => __( 'Utility Menu', 'div_starter' ),  // nav name
    	'menu_class' => 'utility-nav clearfix',         // adding custom nav class
    	'theme_location' => 'utility-nav',                 // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 0,                                   // limit the depth of the nav
    	'fallback_cb' => ''      						// fallback function
	));
} /* end div_starter utility nav */

function div_starter_footer_links() {
    // display the wp3 menu if available
    wp_nav_menu(array(
        'container' => '',                              // remove nav container
        'container_class' => 'footer-links clearfix',   // class of container (should you choose to use it)
        'menu' => __( 'Footer Links', 'div_starter' ),   // nav name
        'menu_class' => 'nav footer-nav clearfix',      // adding custom nav class
        'theme_location' => 'footer-links',             // where it's located in the theme
        'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 0,                                   // limit the depth of the nav
        'fallback_cb' => 'bones_footer_links_fallback'  // fallback function
    ));
} /* end div footer link */

?>