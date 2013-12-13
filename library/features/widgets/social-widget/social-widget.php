<?php
/*
Plugin Name: Div Truth Social Profiles Widget
Plugin URI: http://divtruth.com/
Description: Provides easy to use social media icons
Version: 0.1
Author: Div Truth
Author URI: http://nickworth.com
*/

/**
 * Div Social Profiles Widget Class
 */
class div_social_profiles_widget extends WP_Widget {
  /**
  * Holds widget settings defaults, populated in constructor.
  *
  * @var array
  */  
  protected $defaults;

  /** constructor -- name this the same as the class above */
  function div_social_profiles_widget() {
    $this->defaults = array(
      'title'                 => 'Connect With Us!',
      'icon_theme'            => 'white',
      'email_num'             => '',
      'email_num_target'      => '',
      'facebook_num'          => '',            
      'facebook_num_target'   => 'on',  
      'flicker_num'           => '',
      'flicker_num_target'    => 'on',
      'goodreads_num'         => '',
      'goodreads_num_target'  => 'on',
      'google_num'            => '',
      'google_num_target'     => 'on',
      'instagram_num'         => '',
      'instagram_num_target'  => 'on',
      'linkedin_num'          => '',
      'linkedin_num_target'   => 'on',
      'pinterest_num'         => '',
      'pinterest_num_target'  => 'on',
      'rss_num'               => '',
      'rss_num_target'        => 'on',
      'twitter_num'           => '',
      'twitter_num_target'    => 'on',
      'youtube_num'           => '',
      'youtube_num_target'    => 'on',
      'div_num'              => '',
      'div_num_target'       => 'on'
    );
    parent::WP_Widget(false, $name = 'Div Social Profiles');
    $widget_ops = array('classname' => 'div_social_profiles', 'description' => 'Simple custom widget that creates social icons using links from company info page' );
    $control_ops = array( 'width' => 250);
    $this->WP_Widget('div_social_profiles_widget', 'Social Profile Widget', $widget_ops, $control_ops);
  } //end constructor
            
  /** @see WP_Widget::widget -- do not rename this */
  /* This section writes the icons on the website page */
  function widget($args, $instance) { 
    wp_enqueue_style('div_social_widget_styles', DIV_FEATURES_URL.'/widgets/social-widget/social-widget.css', '', '0.3', 'screen');
    $sort = array();
    $sorted_profiles = array();
    extract($instance, EXTR_SKIP);
    foreach($args as $k => $v){$$k = $v;}
    foreach($instance as $k => $v){
      if($v == "checked"){
        $id = substr_replace($k ,"",-7); //remove "_num" and insert into array
        $target[$id] = array($v);
      }
      if(!($k == "title" || $k == "icon_theme" || $v == "checked")){
        if($v){
          $id = substr_replace($k ,"",-4); //remove "_num" and insert into array
          $sort[$v] = array($id, $k);
        }
      }
    }
    ?>
    <?php /* Create Widget */ ?>
    <?php echo $before_widget; ?>
      <?php $social_icons = get_field('social_options','option'); ?>

      <div id="div-social" class="<?php echo $icon_theme; ?>">
        <?php /* Write the widget title, if needed */ ?>      
        <?php if ( $title ) {
          echo $before_title . $title . $after_title; 
        } ?>

        <ul>
          <?php 
          if($social_icons){
            if($sort){
              $sorted_profiles = $sort;                
            } else {
              $sorted_profiles = $social_icons;
            }
            ksort($sorted_profiles);
            // print_r($sorted_profiles);
            foreach ( $sorted_profiles as $item) {
              $blank = (array_key_exists($item[1], $target)) ? "_blank" : "_self";
              echo '<li class="'. strtolower($item[0]) .'"><a target="'.$blank.'" href="'.get_field( strtolower($item[0])."_link", "option").'">'. esc_attr($item[0]) .'</a></li>';     
            }
          } else {
            echo "Need to activate some social profile accounts <a href='". admin_url( '/admin.php?page=acf-options-company-settings') ."'>HERE</a>";
          } ?>
        </ul>

      </div> <!-- end #div-social -->

    <?php echo $after_widget; ?>
    <?php /* End of write the icons on the website page */ ?>

  <?php }
 
  /** @see WP_Widget::update -- do not rename this */
  /* This section updates the widget data with any new data */
  function update( $new_instance, $old_instance ) {
    return $new_instance;
  }
 
  /** @see WP_Widget::form -- do not rename this */
  /* This section writes the widget input form in the Appearance > Widgets section */
  function form($instance) {
    /** Merge with defaults */
    $instance = wp_parse_args( (array) $instance, $this->defaults ); 

    extract ( $instance, EXTR_SKIP);

    $fields = array(
      array(
        'label'       => __( 'Title', 'div' ),
        'id'          => 'title',
        'type'        => 'text',
        'value'       => $title,
      ),
      array(
        'label'       => __( 'Icon Theme', 'div' ),
        'id'          => 'icon_theme',
        'type'        => 'select',
        'options'     => array(
          'Light'     =>  'white',
          'Dark'      =>  'dark'
        ),
        'value'       => $icon_theme,
      ),
      array(
        'type'        => 'options_header',
      ),
      array(
        'type'        => 'social_options',
        'options'     => array(
          array(
            'label'       => __( 'Email', 'div' ),
            'id'          => 'email_num',
            'type'        => 'social_option',
            'value'       => $email_num,
            'checked'     => $email_num_target,
          ),
          array(
            'label'       => __( 'Facebook', 'div' ),
            'id'          => 'facebook_num',
            'type'        => 'social_option',
            'value'       => $facebook_num,
            'checked'     => $facebook_num_target,
          ),
          array(
            'label'       => __( 'Flicker', 'div' ),
            'id'          => 'flicker_num',
            'type'        => 'social_option',
            'value'       => $flicker_num,
            'checked'     => $flicker_num_target,
          ),
          array(
            'label'       => __( 'Goodreads', 'div' ),
            'id'          => 'goodreads_num',
            'type'        => 'social_option',
            'value'       => $goodreads_num,
            'checked'     => $goodreads_num_target,
          ),
          array(
            'label'       => __( 'Google Plus', 'div' ),
            'id'          => 'google_num',
            'type'        => 'social_option',
            'value'       => $google_num,
            'checked'     => $google_num_target,
          ),
          array(
            'label'       => __( 'Instagram', 'div' ),
            'id'          => 'instagram_num',
            'type'        => 'social_option',
            'value'       => $instagram_num,
            'checked'     => $instagram_num_target,
          ),
          array(
            'label'       => __( 'Linked In', 'div' ),
            'id'          => 'linkedin_num',
            'type'        => 'social_option',
            'value'       => $linkedin_num,
            'checked'     => $linkedin_num_target,
          ),
          array(
            'label'       => __( 'Pinterest', 'div' ),
            'id'          => 'pinterest_num',
            'type'        => 'social_option',
            'value'       => $pinterest_num,
            'checked'     => $pinterest_num_target,
          ),
          array(
            'label'       => __( 'RSS', 'div' ),
            'id'          => 'rss_num',
            'type'        => 'social_option',
            'value'       => $rss_num,
            'checked'     => $rss_num_target,
          ),
          array(
            'label'       => __( 'Twitter', 'div' ),
            'id'          => 'twitter_num',
            'type'        => 'social_option',
            'value'       => $twitter_num,
            'checked'     => $twitter_num_target,
          ),
          array(
            'label'       => __( 'YouTube', 'div' ),
            'id'          => 'youtube_num',
            'type'        => 'social_option',
            'value'       => $youtube_num,
            'checked'     => $youtube_num_target,
          ),
          array(
            'label'       => __( 'Div Truth', 'div' ),
            'id'          => 'div_num',
            'type'        => 'social_option',
            'value'       => $div_num,
            'checked'     => $div_num_target,
          ),
        ),          
      ),
    );

    // Sort Social Options
    $i = 0;
    foreach ($fields as $field => $value) {
      if($value['type'] == "social_options"){
        $options = $value['options'];        
        usort($options, function($a, $b){
          if ($a['value'] == $b['value']){
              return 0;
          } else if ($a['value'] > $b['value']){
              return 1;
          } else {
              return -1;
          }
        });
        foreach ($options as $key => $option){ 
            if ($option['value'] === ""){ 
                unset($options[$key]);
                $options[] = $option;
            }
        }
        $fields[$i]['options'] = $options;
      }
      $i++;
    }
    
    

    foreach( $fields as $field ){
      switch ($field['type']) {
        case 'text':
          echo '<p>
            <label for="'.$this->get_field_id($field['id']).'"><strong>'.$field['label'].':</strong></label> 
            <input class="widefat" id="'.$this->get_field_id($field['id']).'" name="'.$this->get_field_name($field['id']).'" type="text" value="'.esc_attr($field['value']).'" />
          </p>';
          break;

        case 'select':
          echo '<p>
            <label for="'.$this->get_field_id($field['id']).'"><strong>'.$field['label'].':</strong></label> 
            <select class="widefat" id="'.$this->get_field_id($field['id']).'" name="'.$this->get_field_name($field['id']).'">';
              foreach ($field['options'] as $name => $value) {
                echo '<option value="' . $value . '"', $field['value'] == $value ? ' selected="selected"' : '', '>', $name, '</option>'; 
              }
            echo '</select>
          </p>';
          break;
        
        case 'social_options':
          foreach ($field['options'] as $field) {      
            $target = $field['id']."_target";
            $tabindex = ($field['value'] != "") ? $field['value'] : '0';
            echo '<p>
              <label for="'.$this->get_field_id($field['id']).'"><strong>'.$field['label'].'</strong></label>
              <input style="float:left;margin-right:20px;" id="'.$this->get_field_id($target).'" name="'.$this->get_field_name($target).'" type="checkbox" '.$field['checked'].' value="checked">
              <input style="width:30px;float:left;margin:-3px 30px;text-align:center;" tabindex="'.$tabindex.'" id="'.$this->get_field_id($field['id']).'" name="'.$this->get_field_name($field['id']).'" type="text" value="'.esc_attr($field['value']).'" />
            </p>';
          }
          break;

        case 'options_header':
          echo '<div style="width:100%;float:left;margin-bottom:5px;text-transform:uppercase;font-size:11px;">
            <span style="width:40px;float:left;">New Window</span>
            <span style="width:80px;float:left;text-align:center;margin: 15px 5px 0px 0px;">Order</span>
            <span style="width:50px;float:left;margin-top: 15px;">Icon</span>
          </div>';
          break;

        default:
          echo '<p>No field defined for '.$field['label'].'</p>';
          break;
      }
    } ?>
  <?php } 
} // end class div_social_profiles_widget
add_action('widgets_init', create_function('', 'return register_widget("div_social_profiles_widget");'));
?>