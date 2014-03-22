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

?>