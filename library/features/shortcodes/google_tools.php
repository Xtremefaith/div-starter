<?php 
/*
Feature Name:   Google Tools
Developer URI:  http://www.DivTruth.com
Author:         Div Truth
Description:    A collection of shortcodes for google tools (maps, charts, pdf viewer, etc.)
*/

/**
* GOOGLE MAP
* @example [googlemap width="600" height="300" src="http://maps.google.com/maps?q=Heraklion,+Greece&hl=en&ll=35.327451,25.140495&spn=0.233326,0.445976& sll=37.0625,-95.677068&sspn=57.161276,114.169922& oq=Heraklion&hnear=Heraklion,+Greece&t=h&z=12"]
* 
* @param <string> $width
* @param <string> $height
* @link http://wp.smashingmagazine.com/2012/05/01/wordpress-shortcodes-complete-guide/
**/
function googlemap_function($atts, $content = null) {
   extract(shortcode_atts(array(
      "width" => '640',
      "height" => '480',
      "src" => 'http://maps.google.com/maps'
   ), $atts));
   return '<iframe width="'.$width.'" height="'.$height.'" src="'.$src.'&output=embed" ></iframe>';
}
add_shortcode("googlemap", "googlemap_function");

/**
* GOOGLE CHARTS
* @example [chart type="pie" title="Example Pie Chart" data="41.12,32.35,21.52,5.01" labels="First+Label|Second+Label|Third+Label|Fourth+Label" background_color="FFFFFF" colors="D73030,329E4A,415FB4,DFD32F" size="450x180"]
* 
* @author Nick Worth
* @since 1.1
* @param <string> $width
* @param <string> $height
* @link http://wp.smashingmagazine.com/2012/05/01/wordpress-shortcodes-complete-guide/
**/
function chart_function( $atts ) {
   extract(shortcode_atts(array(
       'data' => '',
       'chart_type' => 'pie',
       'title' => 'Chart',
       'labels' => '',
       'size' => '640x480',
       'background_color' => 'FFFFFF',
       'colors' => '',
   ), $atts));

   switch ($chart_type) {
      case 'line' :
         $chart_type = 'lc';
         break;
      case 'pie' :
         $chart_type = 'p3';
         break;
      default :
         break;
   }

   $attributes = '';
   $attributes .= '&chd=t:'.$data.'';
   $attributes .= '&chtt='.$title.'';
   $attributes .= '&chl='.$labels.'';
   $attributes .= '&chs='.$size.'';
   $attributes .= '&chf='.$background_color.'';
   $attributes .= '&chco='.$colors.'';

   return '<img title="'.$title.'" src="http://chart.apis.google.com/chart?cht='.$chart_type.''.$attributes.'" alt="'.$title.'" />';
}
add_shortcode('chart', 'chart_function');

/**
* GOOGLE PDF VIEWER
* @example [pdf width="520px" height="700px"]http://static.fsf.org/common/what-is-fs-new.pdf[/pdf]
* 
* @author Nick Worth
* @since 1.1
* @param <string> $width
* @param <string> $height
* @link http://wp.smashingmagazine.com/2012/05/01/wordpress-shortcodes-complete-guide/
**/
function pdf_function($attr, $url) {
   extract(shortcode_atts(array(
       'width' => '640',
       'height' => '480'
   ), $attr));
   return '<iframe src="http://docs.google.com/viewer?url=' . $url . '&embedded=true" style="width:' .$width. '; height:' .$height. ';">Your browser does not support iframes</iframe>';
}
add_shortcode('pdf', 'pdf_function');
?>