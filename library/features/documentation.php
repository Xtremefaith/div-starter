<?php 
/*
Feature Name:   Documentation
Developer URI:  http://www.divtruth.com
Author: 				Nick Worth
Description:    Setup a documenation page with client tutorial information
Version:        1.0.1.0
*/

$contributors = get_field('developer_contacts','options');

_e('<div class="wrap no_move">
  	<div class="icon32" id="icon-options-general"><br></div>
  	<h2>Documentation</h2>');
  _e('<h1>Developer Details</h1>');

  _e('<div style="overflow: hidden;">');
    if($contributors)
      do_action('div_developer_blocks',$contributors);
  _e('</div>');

  if(get_field('develop_mode','options') != "Disable"){
    do_action('div_list_developer_videos');    
  }

  _e('<hr>');
    
  $dir = getDirectoryList(THEME_LIBRARY_DIR.'/tutorial_videos/');
  if($dir){
    add_thickbox();
    _e('<h4>'.get_bloginfo( 'name' ).' - Child Theme Videos</h4>');
    _e('<div id="tutorial_videos" class="div_videos">');
      echo '<ol style="margin-bottom:20px;">';
      foreach($dir as $k => $file){
        $exploded = explode('.', $file);
        $ext = end($exploded);
        $name = substr_replace(str_replace("_"," ",$file), "", -4);
        if($ext == "swf"){
          echo '<li class="video"><a class="button thickbox" target="_blank" href="'.THEME_LIBRARY_URL.'/tutorial_videos/'.$file.'?TB_iframe=true&width=1100&height=800">'.$name.'</a></li>';
        }
      }
      echo '</ol>';
  } else {
    _e('<h4>No videos for this theme available</h4>');
  }

  do_action('div_list_general_videos');

_e('</div>');
_e('<hr>');

?>