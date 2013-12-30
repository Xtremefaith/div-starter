<?php 
/*
Feature Name:   Browser Detection
Developer URI:  http://www.DivTruth.com
Description:    The browser and device agent that is used is based as a class within the body tag for easy CSS adjustments
*/
function mv_browser_body_class($classes) {
    // echo '<h1>'.$_SERVER['HTTP_USER_AGENT'].'<h1>'; #for testing purposes
    global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari,$is_chrome, $is_iphone;
    if($is_lynx) $classes[] = 'lynx';
    elseif($is_gecko) $classes[] = 'gecko';
    elseif($is_opera) $classes[] = 'opera';
    elseif($is_NS4) $classes[] = 'ns4';
    elseif($is_safari) $classes[] = 'safari';
    elseif($is_chrome) $classes[] = 'chrome';
    elseif($is_IE) {
        if(preg_match('/MSIE ([0-9]+)([a-zA-Z0-9.]+)/',$_SERVER['HTTP_USER_AGENT'], $browser_version))
            $classes[] = 'ie ie'.$browser_version[1];
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)
            $classes[] = 'ie ie11';
    } else $classes[] = 'unknown';
    if($is_iphone) $classes[] = 'iphone';
    if ( stristr( $_SERVER['HTTP_USER_AGENT'],"mac") ) {
         $classes[] = 'osx';
       } elseif ( stristr( $_SERVER['HTTP_USER_AGENT'],"linux") ) {
           $classes[] = 'linux'; //Browser detection and OS detection with body_class
       } elseif ( stristr( $_SERVER['HTTP_USER_AGENT'],"windows") ) {
         $classes[] = 'windows';
       }
    return $classes;
}
add_filter('body_class','mv_browser_body_class');

?>