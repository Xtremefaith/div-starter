<?php 
/*
 * Feature Name: Div Truth Content Widget
 * @author: Nick Worth
 * @description: Plugin for displaying a featured stories section within the content section of the site, along with options available from the admin panel
 * @dependency: This uses the get_content shortcode within the Div Truth Starter
 */
require_once( DIV_CLASSES_DIR .'/Content.php');  #import the Content Class

class div_content_widget extends WP_Widget{

    /**
    * Holds widget settings defaults, populated in constructor.
    *
    * @var array
    */  
    protected $defaults;

    /** constructor -- name this the same as the class above */
    function div_content_widget() {
        $this->defaults = array(
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
        );

        parent::WP_Widget(false, $name = 'Content Widget');
        $widget_ops = array('classname' => 'div_content', 'description' => 'Dynamically add content where you want within sidebars defined in your theme' );
        $control_ops = array( 'width' => 615);
        $this->WP_Widget('div_content_widget', 'Content Widget', $widget_ops, $control_ops);
    } //end constructor
 
    function form($instance){
      /** Merge with defaults */
      $instance = wp_parse_args( (array) $instance, $this->defaults ); 
      extract ( $instance, EXTR_SKIP);
      $Content = new Content();

      $columns = array(
        'col1' => array( #Column 1
          array(
            'aside_class'   => array(
              'label'       => __( 'Aside Class', 'div' ),
              'type'        => 'text',
              'save'        => false,
              'value'       => $aside_class,
              'requires'    => '',
            ),
            'article_class'   => array(
              'label'       => __( 'Article Class', 'div' ),
              'type'        => 'text',
              'save'        => false,
              'value'       => $article_class,
              'requires'    => '',
            ),
            'header_class'   => array(
              'label'       => __( 'Header Class', 'div' ),
              'type'        => 'text',
              'save'        => false,
              'value'       => $header_class,
              'requires'    => '',
            ),
            'header_tag'    => array(
              'label'       => __( 'Header Tag', 'div' ),
              'type'        => 'select',
              'options'     => array(
                'h1'  => 'h1',
                'h2'  => 'h2',
                'h3'  => 'h3',
                'h4'  => 'h4',
                'h5'  => 'h5',
                'h6'  => 'h6',
              ),
              'save'        => true,
              'value'       => $header_tag,
              'requires'    => '',
            ),
            'section_class'   => array(
              'label'       => __( 'Section Class', 'div' ),
              'type'        => 'text',
              'save'        => false,
              'value'       => $section_class,
              'requires'    => '',
            ),
            'image_class'   => array(
              'label'       => __( 'Image Class', 'div' ),
              'type'        => 'text',
              'save'        => false,
              'value'       => $image_class,
              'requires'    => array(
                'post_image',
                '',
                true,
              ),
            ),
          ),
        ),
        'col2' => array( #Column 2
          array(
            'title'   => array(
              'label'       => __( 'Title', 'div' ),
              'type'        => 'text',
              'save'        => false,
              'value'       => $title,
              'requires'    => '',
            ),
            'post_type'   => array(
              'label'       => __( 'Content Type', 'div' ),
              'type'        => 'select',
              'options'     => $Content->get_post_type_options(),
              'save'        => true,
              'value'       => $post_type,
              'requires'    => '',
            ),
            'category'    => array(
              'label'       => __( 'By Category', 'div' ),
              'type'        => 'select',
              'options'     => $Content->get_categories_array(),
              'save'        => false,
              'value'       => $category,
              'requires'    => array(
                'post_type',
                'page',
                true
              ),
            ),
            'order'   => array(
              'label'       => __( 'Order', 'div' ),
              'type'        => 'select',
              'options'     => array(
                'DESC'  => 'DESC',
                'ASC'   => 'ASC',
              ),
              'save'        => false,
              'value'       => $order,
              'requires'    => '',
            ),
            'post_image'   => array(
              'label'       => __( 'Include Image', 'div' ),
              'type'        => 'select',
              'options'     => array(
                'No Image'    => '',
                'None'        => 'none',
                'Left'        => 'left',
                'Right'       => 'right',
              ),
              'save'        => true,
              'value'       => $post_image,
              'requires'    => '',
            ),
            'image_size'    => array(
              'label'       => __( 'Image Size', 'div' ),
              'type'        => 'select',
              'options'     => $Content->get_images_array(),
              'save'        => true,
              'value'       => $image_size,
              'requires'    => array(
                'post_image',
                '',
                true
              ),
            ),
          ),
        ), #END Column 1
        'col3' => array( #Column 3
          array(
            'posts_per_page'    => array(
              'label'       => __( 'How Many?', 'div' ),
              
              'type'        => 'text',
              'save'        => false,
              'value'       => $posts_per_page,
              'requires'    => '',
            ),
            'post_excluded' => array(
              'label'       => __( 'Excluded IDs', 'div' ),
              'type'        => 'text',
              'save'        => false,
              'value'       => $post_excluded,
              'requires'    => '',
            ),
            'post_included' => array(
              'label'       => __( 'Included IDs', 'div' ),
              'type'        => 'text',
              'save'        => false,
              'value'       => $post_included,
              'requires'    => '',
            ),
            'character_limit'   => array(
              'label'       => __( 'Character Limit', 'div' ),
              'type'        => 'text',
              'save'        => false,
              'value'       => $character_limit,
              'requires'    => '',
            ),
            'more_link'   => array(
              'label'       => __( 'More Link Text', 'div' ),
              'type'        => 'text',
              'save'        => false,
              'value'       => $more_link,
              'requires'    => '',
            ),
          ), 
        ), #END Column 2
      );

      foreach( $columns as $column => $boxes ){
        // if( 'col1' == $column || 'col2' == $column)
        //   echo '<div style="float: left; width: 200px;margin-left:5px;">';
            
        // else 
          echo '<div style="float: left; width: 200px; margin-left:5px;">';

          foreach( $boxes as $box){
            echo '<div style="background: #f1f1f1; border: 1px solid #DDD; padding: 10px 10px 0px 10px; margin-bottom: 5px;">';

            foreach( $box as $field => $args ){
              $save = $args['save']     ? 'widget-save ' : '';
              $style = $args['requires'] ? ' style="'. div_get_display_option( $instance, $args['requires'][0], $args['requires'][1], $args['requires'][2] ) .'"' : '';

              #Switch by field type
              switch ($args['type']) {
                case 'text':
                  echo '<p'. $style .'>
                    <label for="'.$this->get_field_id($field).'"><strong>'.$args['label'].':</strong></label> 
                    <input class="widefat '. $save .'" id="'.$this->get_field_id($field).'" name="'.$this->get_field_name($field).'" type="text" value="'.esc_attr($args['value']).'" />
                  </p>';
                  break;

                case 'select':
                  echo '<p'. $style .'>
                    <label for="'.$this->get_field_id($field).'"><strong>'.$args['label'].':</strong></label> 
                    <select class="widefat '. $save .'" id="'.$this->get_field_id($field).'" name="'.$this->get_field_name($field).'">';
                      foreach ($args['options'] as $name => $value) {
                        echo '<option value="' . $value . '"', $args['value'] == $value ? ' selected="selected"' : '', '>', $name, '</option>'; 
                      }
                    echo '</select>
                  </p>';
                  break; 

                // case 'radio':
                //   echo '<p'. $style .'>
                //     <label for="'.$this->get_field_id($field).'"><strong>'.$args['label'].':</strong></label> 
                //     <select class="widefat '. $save .'" id="'.$this->get_field_id($field).'" name="'.$this->get_field_name($field).'">';
                //       foreach ($args['options'] as $name => $value) {
                //         echo '<option value="' . $value . '"', $args['value'] == $value ? ' selected="selected"' : '', '>', $name, '</option>'; 
                //       }
                //     echo '</select>
                //   </p>';
                //   break;  

                default:
                  echo '<p>No field defined for '.$args['label'].' - '.$args['type'].'</p>';
                  break;
              }
            }
          echo '</div>'; #Div
        }
        echo '</div>'; #close Column Div
      }

    } #END Form()

    /** @see WP_Widget::update -- do not rename this */
    /* This section updates the widget data with any new data */
    function update( $new_instance, $old_instance ) {
        return $new_instance;
    }

    /** @see WP_Widget::widget -- do not rename this */
    /* This section writes the icons on the website page */
    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        extract($instance, EXTR_SKIP);
        // $Content = new Content();
        // $categories = ($post_type != "page") ? $category : "";

        echo $before_widget;

        if ( $title ) {
          echo $before_title . $title . $after_title; 
        }
        
        do_shortcode( '[get_content
          title           = '.$title.'
          aside_class     = "'.@$aside_class.'"
          article_class   = "'.@$article_class.'"
          header_class    = "'.@$header_class.'"
          header_tag      = '.@$header_tag.'
          section_class   = "'.@$section_class.'"
          image_class     = "'.@$image_class.'"
          post_type       = '.$post_type.'
          order           = '.$order.'
          post_image      = '.$post_image.'
          image_size      = '.$image_size.'
          post_excluded   = '.$post_excluded.'
          post_included   = '.$post_included.'
          posts_per_page  = '.$posts_per_page.'
          character_limit = "'.$character_limit.'"
          more_link       = "'.$more_link.'"
          category        = '.$category.'
        ]' );

        echo $after_widget;
    }
}
add_action( 'widgets_init', create_function('', 'return register_widget("div_content_widget");') ); 

/**
 * Returns "display: none;" if option and value match, or of they don't match with $standard is set to false
 *
 * @author Nick Worth
 * @param <array> $instance Values set in widget isntance
 * @param <mixed> $option instance option to test
 * @param <mixed> $value value to test against
 * @param <boolean> $standard echo standard return false for oposite
 */
function div_get_display_option( $instance, $option='', $value='', $standard=true ) {
  $display = '';
  if ( is_array( $option ) ) {
    foreach ( $option as $key ) {
      if ( in_array( $instance[$key], $value ) )
        $display = 'display: none;';
    }
  }
  elseif ( is_array( $value ) ) {
    if ( in_array( $instance[$option], $value ) )
      $display = 'display: none;';
  }
  else {
    if ( $instance[$option] == $value )
      $display = 'display: none;';
  }
  if ( $standard == false ) {
    if ( $display == 'display: none;' )
      $display = '';
    else
      $display = 'display: none;';
  }
  return $display;
}

/**
 * Saves widget on change of select fields with class 'widget-save'
 *
 * @author Nick Worth
 */
add_action( 'admin_print_footer_scripts', 'div_form_submit' );
function div_form_submit() {
?>
  <script type="text/javascript">

    (function(a) {
      a('.widget-save').live('change', function(){
          wpWidgets.save( a(this).closest('div.widget'), 0, 1, 0 );
          return false;
      });
    })(jQuery);

  </script>

<?php
}
?>