<?php 
/*
Feature Name:   Custom Shortcodes
Developer URI:  http://www.DivTruth.com
Author: 		Div Truth
Description:    Theme Support options specific to this child theme
All options are commented out by default but available as needed below. Feel free to add any addition options here or uncomment any that you would like to turn on 
*/

include( dirname(__FILE__) .'/shortcodes/twitter_feed.php');  #Twitter Feed
include( dirname(__FILE__) .'/shortcodes/content_feed.php');  #Content Feed
include( dirname(__FILE__) .'/shortcodes/google_tools.php');  #Google Tools
include( dirname(__FILE__) .'/shortcodes/download_media/download_button.php');  #Google Tools
include( dirname(__FILE__) .'/shortcodes/related_posts.php');  #Google Tools

/**
* LINK BUTTON
* [linkbutton]
* 
* @link http://wp.smashingmagazine.com/2012/05/01/wordpress-shortcodes-complete-guide/
**/
function linkbutton_function( $atts, $content = null ) {
   return '<button type="button">'.do_shortcode($content).'</button>';
}
add_shortcode('linkbutton', 'linkbutton_function');


?>