<?php
/**
 * Author: Div Truth
 * Description: Filters used by Div Truth Starter Theme
 */

add_action('init','div_after_init_filters');
function div_after_init_filters(){
  /**
   * SHORTCODES IN WIDGET FILTER
   * @author: Nick Worth
   * @since: 1.0
   */
  if(get_field('widget_shortcodes','option') == "Enable"){
    add_filter( 'widget_text', 'do_shortcode');
  }

  /**
   * RELEVANT SEARCH FILTER
   * @author: Nick Worth
   * @since: 1.2
   */
  if(get_field('search_relevance','option') == "Enable"){
    $ssrch_obj = new ssrch_class;
  }

  /**
   * TWITTER HANDLER FILTER
   * Automatically link Twitter usernames in WordPress
   *
   * @author: Nick Worth
   * @since: 1.0
   */
  function twtreplace($content) {
    $twtreplace = preg_replace('/([^a-zA-Z0-9-_&])@([0-9a-zA-Z_]+)/','$1<a href="http://twitter.com/$2" target="_blank" rel="nofollow">@$2</a>',$content);
    return $twtreplace;
  }
  if(get_field('twitter_handlers','option') == "Enable"){
    add_filter('the_content', 'twtreplace');
    add_filter('comment_text', 'twtreplace');
  }

  /**
   * JPG COMPRESSION FILTER
   * Set WP compression quality
   *
   * @author: Nick Worth
   * @since: 1.0
   */
  function div_compress_images($quality) {
    return $quality;
  }
  if(get_field('jpg_quality','option') == "Enable"){
    add_filter('jpeg_quality', 'div_compress_images');
  }

  /**
   * IMAGE CRUNCH SIZES
   * Select which default WP image sizes are used
   *
   * @author: Nick Worth
   * @since: 1.1
   */
  function div_filter_image_sizes( $images) {
    // $images = get_intermediate_image_sizes();
    if(get_field('div_image_sizes','options')){
      if(!in_array( 'thumbnail', get_field('div_image_sizes','options')))
        unset( $images['thumbnail']);
      if(!in_array( 'medium', get_field('div_image_sizes','options')))  
        unset( $images['medium']);
      if(!in_array( 'large', get_field('div_image_sizes','options')))
        unset( $images['large']);
    }

    // foreach ($images as $k => $v) {
    //     $image_array[ucfirst($v)] = $v;
    // }

    return $images;
  }
  if(get_field('div_set_thumbnail_defaults','option') == "Enable"){
    add_filter('intermediate_image_sizes_advanced', 'div_filter_image_sizes');
  }

  /**
   * GOOGLE ANALYTICS TRACKING CODE
   * @ http://code.google.com/apis/analytics/docs/tracking/asyncUsageGuide.html
   * 
   * @since 1.0
   */
  if(get_field('include_ga_code','option')){
    if(get_field('google_analytics_load','option') == "Header"){
      add_action('wp_head','google_analytics_tracking_code');
    } else {
      add_action('wp_footer','google_analytics_tracking_code');
    }
  }
  function google_analytics_tracking_code(){
    echo "<script>".get_field('google_analytics_tracking_code','option')."</script>";
  }

  /**
   * INCLUDE SCRIPTS FOR ENQUE
   * BxSlider v4.1.2 - Fully loaded, responsive content slider
   * @link http://bxslider.com
   *
   * HTML5 Shiv v3.7.0 - HTML5 support for IE8 & below
   * @link http://html5shim.googlecode.com/svn/trunk/html5.js
   * 
   * @since 1.0
   */
  if(get_field('include_bxslider','option')){ add_filter('wp_enqueue_scripts','include_bxslider'); }
  function include_bxslider(){
    if( !is_admin()) { // Don't do this for admin area
      $in_footer = (get_field('load_bxslider','option') == "Header") ? false : true;
      $url = 'https://raw.githubusercontent.com/stevenwanderski/bxslider-4/master/jquery.bxslider.min.js'; // the URL to check against
      $test_url = @fopen($url,'r'); // test parameters
      if($test_url !== false) { // test if the URL exists
        wp_enqueue_script('bxslider-js', 'https://raw.githubusercontent.com/stevenwanderski/bxslider-4/master/jquery.bxslider.min.js', array('jquery'), false, $in_footer); // register the external file
      } else {
        wp_enqueue_script( 'bxslider-js', DIV_LIBRARY_URL.'/js/libs/jquery.bxslider.min.js', array('jquery'), false, $in_footer);              
      }
    }
  }

  if(get_field('include_html5_shiv','option')){ add_filter('wp_head','include_html5_shiv'); }
  function include_html5_shiv(){
    if( !is_admin()) { // Don't do this for admin area
      $url = 'http://html5shim.googlecode.com/svn/trunk/html5.js'; // the URL to check against
      $test_url = @fopen($url,'r'); // test parameters
      if($test_url !== false) { // test if the URL exists ?>
        <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <?php 
      } else { ?>
        <!--[if lt IE 9]><script src="<?php echo DIV_LIBRARY_URL.'/js/libs/html5shiv.js'; ?>"></script> <![endif]-->
        <?php 
      }
    }
  }

  /**
   * Load jQuery from Google CDN, fallback to local
   *
   * @link http://wp.tutsplus.com/tutorials/load-jquery-from-google-cdn-with-local-fallback-for-wordpress/
   */
  if(get_field('jquery_google_cdn','option')){ add_filter('wp_enqueue_scripts','load_google_jquery'); }
  function load_google_jquery(){
    if( !is_admin()){ // Don't do this for admin area, since Google's jQuery isn't in noConflict mode and will interfere with WP's admin area.
      $url = 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'; // the URL to check against
      $test_url = @fopen($url,'r'); // test parameters
      if($test_url !== false) { // test if the URL exists
        function load_external_jQuery() { // load external file
          wp_deregister_script( 'jquery' ); // deregisters the default WordPress jQuery
          wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'); // register the external file
          wp_enqueue_script('jquery'); // enqueue the external file
        }
        add_action('wp_enqueue_scripts', 'load_external_jQuery'); // initiate the function
      }
    }
  }

} /* END INIT FILTERS */
  



/**
 * CUSTOM EXCERPT LENGTH
 * Change the default WordPress excerpt length
 *
 * @author Nick Worth
 * @since 1.0
 * @param $length (string): 
 * @return <number> (default 28)
 */
function div_excerpt( $length ) {
    if($length)
      return $length;
    else 
      return 28;
}
add_filter( 'excerpt_length', 'div_excerpt', 999 );

/**
 * ALLOW PHP IN WIDGET
 * @author: Betty Urquida
 * @since: 1.0
 */
function execute_php($html){
     if(strpos($html,"<"."?php")!==false){
          ob_start();
          eval("?".">".$html);
          $html=ob_get_contents();
          ob_end_clean();
     }
     return $html;
}
add_filter('widget_text','execute_php',100);

/**
 * DIV PREV/NEXT FILTER
 * Custom prev/next options
 *
 * @author: Nick Worth
 * @since: 1.0
 */
// add_filter('wp_link_pages_args', 'wp_link_pages_args_prevnext_add');
function wp_link_pages_args_prevnext_add($args){
    global $page, $numpages, $more, $pagenow;

    if (!$args['next_or_number'] == 'next_and_number') 
        return $args; # exit early

    $args['next_or_number'] = 'number'; # keep numbering for the main part
    if (!$more)
        return $args; # exit early

    if($page-1) # there is a previous page
        $args['before'] .= _wp_link_page($page-1)
            . $args['link_before']. $args['previouspagelink'] . $args['link_after'] . '</a>'
        ;

    if ($page<$numpages) # there is a next page
        $args['after'] = _wp_link_page($page+1)
            . $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . '</a>'
            . $args['after']
        ;

    return $args;
}

/**
 * GET LIST FROM DIRECTORY
 * Adds "parent" class to menus
 *
 * @author: Nick Worth
 * @since: 1.0.1.0
 */
function theme_add_menu_parent_classes( $classes, $item, $args ) {
    $children = get_posts( array(
        'meta_query' => array (
            array(
                'key' => '_menu_item_menu_item_parent',
                'value' => $item->ID )
        ),
        'post_type' => $item->post_type ) );
    if (count($children) > 0) {
        array_push($classes,'parent'); // add the class .parent to the current menu item
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'theme_add_menu_parent_classes', 10, 3 );

/**
 * MAINTAIN G-D FILTER
 * Wraps all usage of G-d with <nobr>
 *
 * @author: Nick Worth
 * @since: 1.0
 */
function G_Dfilter($content) {
  $G_Dfilter = preg_replace('/\bG-d\b/i','<nobr>G-d</nobr>',$content);
  return $G_Dfilter;
}
add_filter('the_content', 'G_Dfilter');
add_filter('comment_text', 'G_Dfilter');

/**
 * Filter callback to add image sizes to Media Uploader
 *
 * WP 3.3 beta adds a new filter 'image_size_names_choose' to
 * the list of image sizes which are displayed in the Media Uploader
 * after an image has been uploaded.
 *
 * See image_size_input_fields() in wp-admin/includes/media.php
 * 
 * Tested with WP 3.3 beta 1
 *
 * @uses get_intermediate_image_sizes()
 *
 * @param $sizes, array of default image sizes (associative array)
 * @return $new_sizes, array of all image sizes (associative array)
 * @author Ade Walker http://www.studiograsshopper.ch
 */
function div_display_image_size_names_muploader( $sizes ) {
  
  $new_sizes = array();
  
  $added_sizes = get_intermediate_image_sizes();
  
  // $added_sizes is an indexed array, therefore need to convert it
  // to associative array, using $value for $key and $value
  foreach( $added_sizes as $key => $value) {
    $new_sizes[$value] = $value;
  }
  
  // This preserves the labels in $sizes, and merges the two arrays
  $new_sizes = array_merge( $new_sizes, $sizes );
  
  return $new_sizes;
}
add_filter('image_size_names_choose', 'div_display_image_size_names_muploader', 11, 1);

/**
 * REMOVE SEARCH FILTERS
 * search filters can break wordpress functionality, this will prevent that
 * @link: http://wordpress.org/support/topic/36-upgrade-searchformphp-not-working#post-4559505
 * 
 * @author: Nick Worth
 * @since: 1.1
 */
function search_form_no_filters() {
  $search_form_template = locate_template( 'searchform.php' );
  if ( '' !== $search_form_template ) {
    remove_all_filters('get_search_form');
  }
}
add_action('pre_get_search_form', 'search_form_no_filters');
?>
