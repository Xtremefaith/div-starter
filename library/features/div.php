<?php
/*
Author: Div Truth
Description: Available functions used through Div Truth development
*/

include( dirname(__FILE__) .'/div-images.php');     #IMAGE FUNCTIONS
include( dirname(__FILE__) .'/div-actions.php');    #ACTION FUNCTIONS
include( dirname(__FILE__) .'/div-filters.php');    #FILTER FUNCTIONS
include( dirname(__FILE__) .'/div-functions.php');  #DIV FUNCTIONS

/**
 * INITIALIZE PLUS1
 * Start the div engine
 * 
 * @author Nick Worth
 * @since 1.0
 */
add_action('after_setup_theme','initialize_div', 16);
function initialize_div() {
    // enqueue base scripts and styles
    add_action('wp_enqueue_scripts', 'div_scripts_and_styles', 999);
}

/**
 * SCRIPTS AND STYLES ENQUE
 * Modified from bones starter
 * 
 * @author Nick Worth
 * @since 1.0
 */
function div_scripts_and_styles() {
  if (!is_admin()) {
    // modernizr (without media query polyfill)
    wp_register_script( 'div-modernizr', get_stylesheet_directory_uri() . '/library/js/libs/modernizr.custom.min.js', array('jquery'), '2.5.3', true );

    // register main stylesheet
    wp_register_style( 'div-starter-stylesheet', get_template_directory_uri() . '/library/css/style.css', array(), '', 'all', true );
    wp_register_style( 'div-theme-stylesheet', get_stylesheet_directory_uri() . '/library/css/style.css', array(), '', 'all', true );

    // ie-only style sheet
    wp_register_style( 'div-ie-only', get_stylesheet_directory_uri() . '/library/css/ie.css', array('div-starter-stylesheet'), '' );

    // comment reply script for threaded comments
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
      wp_enqueue_script( 'comment-reply' );
    }

    //adding scripts file in the footer
    if ( file_exists(get_stylesheet_directory() . '/library/js/scripts.min.js') )
      wp_register_script( 'div-js', get_stylesheet_directory_uri() . '/library/js/scripts.min.js', array( 'jquery' ), '', true );
    else
      wp_register_script( 'div-js', get_stylesheet_directory_uri() . '/library/js/scripts.js', array( 'jquery' ), '', true );

    // enqueue styles and scripts
    wp_enqueue_script( 'div-modernizr' );

    function theme_styles(){
      wp_enqueue_style( 'div-starter-stylesheet' );

      if ( preg_match("/(?i)msie [1-8]\.0/",$_SERVER['HTTP_USER_AGENT'])){
        // if IE<=8
        wp_enqueue_style( 'div-ie-only' );
      } else {
        wp_enqueue_style( 'div-theme-stylesheet' );
      }
    }
    add_action( 'wp_footer', 'theme_styles');

    if( !is_admin()){
      $url = 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'; // the URL to check against
      $test_url = @fopen($url,'r'); // test parameters
      if($test_url !== false) { // test if the URL exists
        wp_deregister_script( 'jquery' ); // deregisters the default WordPress jQuery
        wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', false, '1.10.2', false); // register the external file
        wp_enqueue_script('jquery'); // enqueue the external file
      } 
    }
    wp_enqueue_script( 'div-js' );
  }
}
