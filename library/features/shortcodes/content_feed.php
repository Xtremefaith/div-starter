<?php 
/*
Feature Name:   Content Feed
Developer URI:  http://www.DivTruth.com
Author:         Div Truth
Description:    Easily place site content anywhere you want
*/

/*********************************************************************************************
 * CONTENT FEED 
     [get_content 
        $title           => '',             # h4 Header
        $class           => '',             # aside class
        $post_type       => 'post',         # post, page, or cpt
        $order           => 'DESC',         # ASC or DESC
        $post_image      => '',             # left, right, or none
        $image_size      => 'thumbnail',    # thumbnail, medium, large, or custom
        $post_excluded   => '',             # post_ids
        $post_included   => '',             # post_ids
        $posts_per_page  => '3',            # number of post to display
        $character_limit => '',             # <optional> set a character limit
        $more_link       => '',             # if character limit then set a more permalink text
        $category        => '',             # category_ids
     ] 
 *********************************************************************************************/
function get_content( $atts ){
    require_once( DIV_CLASSES_DIR .'/Content.php');  #import the Content Class

    extract( shortcode_atts( array(
        'title'           => '',
        'aside_class'     => '',
        'article_class'   => '',
        'header_class'    => '',
        'header_tag'      => '',
        'section_class'   => '',
        'image_class'     => '',
        'post_type'       => 'post',
        'order'           => 'DESC',
        'post_image'      => '',
        'image_size'      => 'thumbnail',
        'post_excluded'   => '',
        'post_included'   => '',
        'posts_per_page'  => '3',
        'character_limit' => '',
        'more_link'       => '',
        'category'        => '',
    ), $atts ) );
    
    $Content = new Content();
    $categories = ($post_type != "page") ? $category : "";   
    
    $content_args = array(
        'post_type'         => $post_type,
        'order'             => $order,
        'hide_empty'        => true, 
        'fields'            => 'all', 
        'posts_per_page'    => $posts_per_page,
        'category__in'      => $categories,
        'post__not_in'      => array($post_excluded),
        'post__in '         => array($post_included),
    );

    $content_query = new WP_Query( $content_args );
    echo '<aside '; if($aside_class) echo 'class="'.$aside_class.'"'; echo '>';

        if ( $content_query->have_posts() ) : while ( $content_query->have_posts() ) : $content_query->the_post();
        
            echo '<article data-post="'.get_the_ID().'"';  if($article_class) echo 'class="'.$article_class.'"'; echo '>';
                if ($post_image != "" && has_post_thumbnail()){
                    $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'thumbnail');
                    echo '<div '; if($image_class) echo 'class="'.$image_class.'"'; echo ' style="float:'.$post_image.';"><img src="'.$thumbnail[0].'"></div>';
                }
                echo '<section '; if($section_class) echo 'class="'.$section_class.'"'; echo '>';
                    echo '<a href="'.get_permalink().'"><'.$header_tag.' '; if($header_class) echo 'class="'.$header_class.'"'; echo '>'.get_the_title().'</'.$header_tag.'></a>';
                    echo '<p>'.$Content->the_excerpt_max_charlength( $character_limit, $more_link ).'</section>
                </section>
            </article>';
        
        endwhile;
        #navigation
        else:
        #no post found
        endif;

    echo '</aside>';
        
}
add_shortcode( 'get_content', 'get_content' ); ?>