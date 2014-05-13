<?php
/*
Author: Div Truth LLC
Description: Available functions used through Div Truth development
*/

/**
 * TRUNCATE STRING
 * Used to cutoff a string to a set length if it exceeds the specified length
 * 
 * @author Nick Worth
 * @since 1.0
 * @param string $str Any string that might need to be shortened
 * @param string $length Any whole integer
 * @param string $ending to be added at the end
 * @return string
 */
function div_truncate($string,$max=20,$ending="..."){
    if(strlen($string)>=$max){
        $tok=strtok($string,' ');
        $string='';
        while($tok!==false && strlen($string)<$max)
        {
            if (strlen($string)+strlen($tok)<=$max)
                $string.=$tok.' ';
            else
                break;
            $tok=strtok(' ');
        }
        return trim($string).$ending;
    }
    return trim($string);
}

/**
 * GET CONTENTS OF DIRECTORY
 * 
 * @author: Nick Worth
 * @since: 1.0
 * @param <STRING> $filename
 */
function get_text($filename) {
  @$fp_load = fopen("$filename", "rb");

  if ( $fp_load ) {
    $content="";
    while ( !feof($fp_load) ) {
        $content .= fgets($fp_load, 8192);
    }
    fclose($fp_load);
    return $content;
  }
}

/**
 * GET LIST FROM DIRECTORY
 *
 * @author: Nick Worth
 * @since: 1.0
 * @param <STRING> $directory
 */
function getDirectoryList ($directory){
  if(file_exists($directory)){
    // create an array to hold directory list
    $results = array();
    // create a handler for the directory
    $handler = opendir($directory);
    // open directory and walk through the filenames
    while ($file = readdir($handler)) {
      // if file isn't this directory or its parent, add it to the results
      if ($file != "." && $file != "..") {
        $results[] = $file;
      }
    }
    // tidy up: close the handler
    closedir($handler);
    // done!
    return $results;
  } else {
    return false;
  }
}

/**
 * DIV PAGINATION
 *
 * @author Nick Worth
 * @since 1.0
 * @param <STRING> $pages
 * @param <NUMBER> $range
 */
function div_pagination($pages = '', $range = 2, $icons = array() ){ 
    if(empty($icons)){
        $icons = array(
            'first' => '&laquo;',
            'prev'  => '&lsaquo;',
            'next'  => '&rsaquo;',
            'last'  => '&raquo;',
        );
    }

    $showitems = ($range * 2)+1;  

    global $paged;
    if(empty($paged)) $paged = 1;

    if($pages == ''){
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if(!$pages){
            $pages = 1;
        }
    }   

    if(1 != $pages){
        echo "<div class='pagination'>";
        if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>".$icons['first']."</a>";
        if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>".$icons['prev']."</a>";

        for ($i=1; $i <= $pages; $i++){
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
                echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
            }
        }

        if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>".$icons['next']."</a>";  
        if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>".$icons['last']."</a>";
        echo "</div>\n";
    }
}

/**
 * LIST FOLDERS FILES
 *
 * @author: Nick Worth
 * @since 1.0
 * @param <STRING> $dir
 * @link http://stackoverflow.com/a/15876851/1058371
 */
function list_folder_files($dir){
    $ffs = scandir($dir);
    echo '<ol>';
    foreach($ffs as $ff){
        if($ff != '.' && $ff != '..'){
            echo '<li class="title">';
            if(is_dir($dir.'/'.$ff)){
                echo $ff;
                list_folder_files($dir.'/'.$ff);
            }else{
                echo '<a href="'.$dir.'/'.$ff.'">'.$ff.'</a>';
            }
            echo '</li>';
        }
    }
    echo '</ol>';
}

/**
 * LIST FOLDERS FILES
 *
 * @author: Nick Worth
 * @since 1.0
 * @param <STRING> $dir
 * @link http://stackoverflow.com/a/15876851/1058371
 */
function div_dir_array($dir){
    $ffs = scandir($dir);
    $dirs = array();
    foreach($ffs as $ff){
        if($ff != '.' && $ff != '..'){
            $dirs[$ff] = $dir.'/'.$ff;
        }
    }
    return $dirs;
}

/**
 * CLEAN CONTENT AUTO P TAGS
 * Convert WP auto <p>s to <div>s
 *
 * @author: Nick Worth
 * @since 1.0
 * @param <STRING> $content
 */
function clean_string($content){
   $content = str_replace("<p>", "<div>", $content);
   return str_replace("</p>", "</div>", $content);
}

/**
 * STRIP CONTENT AUTO P TAGS
 * Prevent <p> tags
 *
 * @author: Nick Worth
 * @since 1.0
 * @param <STRING> $content
 */
function remove_paragraghs($content){
   $content = str_replace("<p>", "", $content);
   return str_replace("</p>", "", $content);
}

/**
 * FORMAT CURRENCY
 * Presets for formatting money, since money_format() doesn't work on windows servers
 *
 * @author: Nick Worth
 * @since 1.0
 * @param <STRING> $value
 * @param <STRING> $format ['dollar',etc]
 * @return <STRING>
 */
function format_currency($value,$format="dollar") {
    switch ($format) {
      case 'dollar':
        return '$' . number_format($value, 2);
        break;
      #TODO: Add other cases
    }
}

/**
 * GET FEATURED POST THUMBNAIL URL
 * Simple function for getting the post thumbnail url only
 *
 * @author: Nick Worth
 * @since 1.0
 * @param <NUMBER> $post_id
 * @param <STRING> $size ['thumbnail','medium','large','full']
 * @return <ARRAY>
 */
function get_post_thumbnail_src( $post_id, $size="full" ) {
    if(has_post_thumbnail($post_id)) :
      $thumbnail_id = get_post_thumbnail_id($post_id);
      return $thumbnail_url = wp_get_attachment_image_src( $thumbnail_id, $size );
    else : 
      return false;
    endif;
}

/**
 * GET MEDIA ITEM ARRAY
 * Based on ACF's image field array
 *
 * @author: Nick Worth
 * @since 1.0
 * @param <NUMBER> $post_id
 * @return <ARRAY>
 */
function div_get_media_item( $post_id ) {
    $attachment = get_post( $post_id );
    
    // create array to hold value data
    $src = wp_get_attachment_image_src( $attachment->ID, 'full' );

    $value = array(
        'id' => $attachment->ID,
        'alt' => get_post_meta($attachment->ID, '_wp_attachment_image_alt', true),
        'title' => $attachment->post_title,
        'caption' => $attachment->post_excerpt,
        'description' => $attachment->post_content,
        'mime_type' => $attachment->post_mime_type,
        'url' => $src[0],
        'width' => $src[1],
        'height' => $src[2],
        'sizes' => array(),
    );

    # find all image sizes
    $image_sizes = get_intermediate_image_sizes();

    if( $image_sizes ){
        foreach( $image_sizes as $image_size ){
          // find src
          $src = wp_get_attachment_image_src( $attachment->ID, $image_size );
          
          // add src
          $value[ 'sizes' ][ $image_size ] = $src[0];
          $value[ 'sizes' ][ $image_size . '-width' ] = $src[1];
          $value[ 'sizes' ][ $image_size . '-height' ] = $src[2];
        }
    }
    return $value;
}

?>