<?php 
/*
Feature Name:   Related Post
Developer URI:  http://www.DivTruth.com
Author:         Div Truth
Description:    Related Post shortcode, used by related post widget
Version:        1.0
*/

 /**
 * RELATED POSTS SHORTCODE
 * @example SHORTCODE [related posts="3"]
 * @example div_get_related_posts()
 * 
 * @param <string> $posts - number of posts
 * @param <string> $limit - character limit of content
 * @param <string> $image - ACF Image field
 * @param <string> $message - Error message in case no posts are returned
 * @return <array> $post
 */
function div_get_related_posts( $atts ){
  extract( shortcode_atts( array(
      'posts'       => '3',
      'limit'       => '100',
      'img_field'   => '',
      'size'        => 'thumbnail',
      'message'     => 'Unfortunately there are no related posts at this time',
  ), $atts ) );

  global $post;  
  $orig_post = $post;  
  $tags = wp_get_post_tags($post->ID);  
    
  if ($tags) {
    $tag_ids = array();  
    foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;  
    $args = array(  
      'tag__in' => $tag_ids,  
      'post__not_in' => array($post->ID),  
      'posts_per_page'=> $posts, // Number of related posts to display.  
      'ignore_sticky_posts'=> 1  
    );
    $related_query = new wp_query( $args );  
    
    $string = '<aside class="related_articles posts_listing">';
      
      while( $related_query->have_posts() ) {
        $related_query->the_post();  
      
        $string .= '<article class="entry">';

        if($img_field == ""){
          if(has_post_thumbnail()){
            $string .= '<div class="post-feature-image">'.get_the_post_thumbnail($post->ID,$size).'</div>';
          }
        } else {
          if(get_field($img_field)){
            $string .= '<div class="post-feature-image">
              <img src="'.get_field($img_field).'">
            </div>'; 
          }
        }

        $string .= '<section>
            <a class="" href="'.get_permalink().'"><h1>'.get_the_title().'</h1></a>
            <p class="excerpt">'.div_truncate(get_the_excerpt(),$limit).'</p>
          </section>
        </article>';
      }

    $string .= '</aside>';

  } else {
    return $message;
  }
  $post = $orig_post;  
  wp_reset_query();  

  return $string;

}
add_shortcode( 'related', 'div_get_related_posts' );
?>