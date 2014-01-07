<?php
 /*
  * @class: Content
  * @description: Content populating functions
  * @author Nick Worth
  * @version: 1.0
  */

class Content{

  public function __construct(){

  }


  /**
   * GET POST TYPE OPTIONS
   * 
   * @author Nick Worth
   * @since 1.0
   * @return <array> $post_types
   */
  public static function get_post_type_options(){  
    $post_types = get_post_types( '', 'names' );

    $type_exclude = array('attachment', 'revision', 'nav_menu_item', 'acf');
    foreach ($type_exclude as $value) {
        $options = array_search($value, $post_types );
        unset($post_types [$options]);
    }
    return $post_types;
  }

  /**
   * GET CATEGORIES ARRAY
   * 
   * @author Nick Worth
   * @since 1.0
   * @return <array> $post_types
   */
  public function get_categories_array(){  
    $categories = get_categories();
    $cat_array['All Category'] = "";
    foreach ($categories as $category) {
        $cat_array[$category->name] = $category->term_id;
    }
    return $cat_array;
  }

  /**
   * GET TAXONOMY SELECT/DROPDOWN
   * 
   * @author Nick Worth
   * @since 1.0
   * @param <string> $taxonomy
   * @param <string> $orderby
   * @param <string> $order
   * @param <string> $limit
   * @param <string> $name
   * @param <boolean> $show_option_all
   * @param <boolean> $show_option_none
   * @return <string>
   */
  public function get_taxonomy_dropdown($taxonomy, $args, $default = "", $onChange = null, $show_option_all = null, $show_option_none = null){  
      $terms = get_terms( $taxonomy, $args );
      if ( $terms ) {
        printf( '<select id="%s" name="%s" class="postform" onChange="'.$onChange.'">', esc_attr( $taxonomy ), esc_attr( $taxonomy ) );
        if ( $show_option_all ) {
          printf( '<option value="0">%s</option>', esc_html( $show_option_all ) );
        }
        if ( $show_option_none ) {
          printf( '<option value="-1">%s</option>', esc_html( $show_option_none ) );
        }
        foreach ( $terms as $term ) {
          if($default == esc_html( $term->slug )){
            printf( '<option selected="selected" value="%s">%s</option>', esc_attr( $term->slug ), esc_html( $term->name ) );
          } else {
            printf( '<option value="%s">%s</option>', esc_attr( $term->slug ), esc_html( $term->name ) );
          }
        }
        print( '</select>' );
      }
  }

  /**
   * GET IMAGES ARRAY
   * 
   * @author Nick Worth
   * @since 1.0
   * @return <array> $post_types
   */
  public function get_images_array(){  
    $images = get_intermediate_image_sizes();

    foreach ($images as $k => $v) {
        $image_array[ucfirst($v)] = $v;
    }
    return $image_array;
  }
  
  /**
   * GET CONTENT IMAGE
   * 
   * @author Nick Worth
   * @since 1.0
   * @param <number> $postid
   * @param <string> $size
   * @return <array> $post_types
   */
  public static function get_attachment_image($postid=0, $size='thumbnail') {    
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches[1][0];

    return $first_img;
  }

  /**
   * SET EXCERPT LENGTH
   * 
   * @author Nick Worth
   * @since 1.0
   * @return <string>
   */
  public function the_excerpt_max_charlength($charlength,$more_link="[...]") {
    add_filter( 'excerpt_more', function(){ return ""; } );
    $excerpt = get_the_excerpt();
    $charlength++;
    $string = "";

     if ( mb_strlen( $excerpt ) > $charlength ) {
       $subex = mb_substr( $excerpt, 0, $charlength - 5 );
       $exwords = explode( ' ', $subex );
       $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
       if ( $excut < 0 ) {
           $string .= mb_substr( $subex, 0, $excut );
       } else {
           $string .= $subex;
       }
       $string .= '<a href="' . get_permalink() . '" class="read-more">'.$more_link.'</a>';
     } else {
         $string .= $excerpt;
     }

    return $string;
  }

  /**
   * SOCIAL SHARE ICONS
   * 
   * @author Nick Worth
   * @since 1.0
   * @param <array> icons
   * @param <string> image_src
   * @return <string>
   */
  public function share_icons($id,$icons,$image_src) {
    $title    = urlencode(get_the_title($id));
    $url      = urlencode(get_permalink($id));
    $summary  = urlencode(strip_tags($this->the_excerpt_max_charlength(50,'')));
    $image    = urlencode($image_src);
    foreach ($icons as $key => $icon) {
      switch ($icon) {
        case 'facebook':
          $fbshare = "divFBShare('".$title."','".$url."','".$summary."','".$image."')";
          echo '<a class="social_icon '.$icon.'" title="'.$icon.'" href="javascript:void(0);" onclick="'.$fbshare.'"></a>';
          break;
        
        case 'twitter':
          echo '<a class="social_icon '.$icon.'" title="'.$icon.'" href="http://twitter.com/share?text='.$title.'&url='.$url.'" onclick="newDivWindow($(this),400,300);return false;"></a>';
          break;

        case 'email':
          echo '<a class="social_icon '.$icon.'" title="'.$icon.'" href="mailto:?subject=Check this out!&amp;body=Check out this site '.$url.'." title="Share by Email" onclick="newDivWindow($(this),600,500);return false;"></a>';          
        // echo '<a class="social_icon '.$icon.'" href="mailto:?subject=I wanted you to see this site&amp;body=Check out this site http://www.website.com." title="Share by Email">Test Email</a>';
          break;

        default:
          # code...
          break;
      }
    }
  }

}
?>
