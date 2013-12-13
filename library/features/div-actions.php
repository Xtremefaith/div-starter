<?php
/*
Author: Div Truth LLC
Description: Available action functions used through Div Truth development
*/


/**
 * CREATE A DIV HEADER LOGO
 * @since 1.0
 */
add_action( 'div_header_logo', 'div_header_logo'); 
function div_header_logo($title){
  echo '<div style="width:100%;background:#333333;margin: 20px 0px;height: 70px;">
    <img style="float:left;margin:5px;" src="'.DIV_LIBRARY_URL.'/images/header-logo.png" width="200"/>
    <h1 style="float:left;margin-top: 27px;color:#fff;">'.$title.'</h1>
  </div>';
}

/**
 * A LIST OF GENERAL VIDEOS
 * @since 1.0
 */
add_action( 'div_list_general_videos', 'div_list_general_videos');
function div_list_general_videos(){
  add_thickbox();
  $matches = array();
  $videos = preg_match_all("/(a href\=\")([^\?\"]*)(\")/i", get_text('http://divtruth.com/tutorial_videos/'), $matches);
  
  if($videos){
    _e('<h4>General Videos</h4>');
    _e('<div id="general_videos" class="div_videos"><ol>');
      foreach($matches[2] as $file) {
        $exploded = explode('.', $file);
        $ext = end($exploded);
        $path = substr_replace(str_replace("_"," ",$file), "", -4);
        $name = substr($path, 17);
        if($ext == "swf"){
          echo '<li class="video"><a class="button thickbox" target="_blank" href="http://divtruth.com'.$file.'?TB_iframe=true&width=1100&height=800">'.$name.'</a></li>';
        }
      } 
      _e('</ol></div>');
  } else {
    _e('<h4>No general videos available at this time</h4>');
  }
}

/**
 * A LIST OF Developer Videos
 * @since 1.0
 */
add_action( 'div_list_developer_videos', 'div_list_developer_videos');
function div_list_developer_videos(){
  add_thickbox();
  $matches = array();
  $videos = preg_match_all("/(a href\=\")([^\?\"]*)(\")/i", get_text('http://divtruth.com/developer_videos'), $matches);
  
  if($videos){
    do_action('div_header_logo','Developer Videos');
    _e('<ul style="list-style-type:none;">');
      foreach($matches[2] as $file) {
        $exploded = explode('.', $file);
        $ext = end($exploded);
        $path = substr_replace(str_replace("_"," ",$file), "", -4);
        $name = substr($path, 18);
        if($ext == "swf"){
          echo '<li class="video"><a class="button thickbox" target="_blank" href="http://divtruth.com'.$file.'?TB_iframe=true&width=1100&height=800">'.$name.'</a></li>';
        }
      } 
    _e('</ul>');
  } else {
    do_action('div_header_logo','No developer videos available at this time');
  }
}

/**
 * DEVELOPER CONTACT BLOCKS
 * @since 1.0
 * @param array $contributor simple array for all developer contact details
 *  (name,title,email,phone,twitter,website,headshot_url)
 */
add_action( 'div_developer_blocks', 'div_developer_blocks');
function div_developer_blocks($contributors){
  foreach($contributors as $c){
    _e('<div class="dev_block" style="width:500px;margin: 5px;float:left;">');
      _e('<div style="background:#eee;border-radius:5px;padding:0px 10px 10px;min-height: 150px;">
        <h2 style="border-bottom:1px solid #333;margin-bottom:10px;">'.$c['name'].', <span class="title">'.$c['title'].'</span></h2>
        <img class="headshot alignleft " width="75" src="'.$c['headshot_url'].'">
        <div>
          <p><strong>Email</strong>: '.$c['email'].'</p>
          <p><strong>Phone</strong>: '.$c['phone'].'</p>
          <p><strong>Twitter</strong>: <a href="http://twitter.com/'.strtolower($c['twitter']).'">@'.$c['twitter'].'</a></p>
          <p><strong>Website</strong>: <a href="'.$c['website'].'">'.$c['website'].'</a></p>
          <p style="font-style:italic;clear:both;font-size:12px;color:#999;">'.$c['notes'].'</p>
        </div>
      </div>');
    _e('</div>');
  }
}

/**
 * SITE COPYRIGHT
 * 
 * @since 1.1
 */
add_action('div_copyright','div_copyright');
function div_copyright(){
  $copyright = '&copy; '.date('Y').' '.get_bloginfo('name').' All Rights Reserved. <br>';
  echo $copyright .= 'Site designed and developed by <a href="http://www.divtruth.com" target="_blank">Div Truth LLC</a>.</p>';
  return $copyright;
}

?>