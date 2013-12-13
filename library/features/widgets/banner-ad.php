<?php
/*
Plugin Name: Banner Ad Widget
Plugin URI: http://divtruth.com/
Description: Simple widget for placing ads
Version: 0.1
Author: Div Truth LLC
Author URI: http://divtruth.com
*/
class div_banner_ad_widget extends WP_Widget {
 
    /** constructor -- name this the same as the class above */
    function div_banner_ad_widget() {
        parent::WP_Widget(false, $name = 'Banner Ad');
        $widget_ops = array('classname' => 'div_banner_ad', 'description' => 'Simple widget for placing ads' );
        $control_ops = array( 'width' => 350);
        $this->WP_Widget('div_banner_ad_widget', 'Banner Ad', $widget_ops, $control_ops);
    } //end constructor
            
    /** @see WP_Widget::widget -- do not rename this */
    /* This section writes the icons on the website page */
    function widget($args, $instance) {	
      $sort = array();
      extract($instance, EXTR_SKIP);
      extract($args, EXTR_SKIP);
      ?>
      <?php /* Create Widget */ ?>
      <?php echo $before_widget; ?>

        <?php $target = (isset($new_window)) ? "_blank" : "_self"; ?>
        <?php $banner =  wp_get_attachment_image_src( $image_id, 'full' ); ?>
        <div style="max-width:<?php echo $banner[1]; ?>px; max-height:<?php echo $banner[2]; ?>px; margin:auto;">
          <a href="<?php echo $link ?>" target="<?php echo $target; ?>">
            <img src="<?php echo $banner[0]; ?>" class="fit" alt="<?php echo $link; ?>">
          </a>
        </div>

      <?php echo $after_widget; ?>
      <?php /* End of write the icons on the website page */ ?>
 
    <?php }
 
    /**
     * Updates Widget Instance
     *
     * @author Nick Worth
     * @since 0.1
     * @version 0.1
     * @param <type> $new_instance
     * @param <type> $old_instance
     * @return <type>
     */
    function update( $new_instance, $old_instance ) {
        return $new_instance;
    }
 
    /** @see WP_Widget::form -- do not rename this */
    /* This section writes the widget input form in the Appearance > Widgets section */
    function form($instance) {	
      $instance = wp_parse_args( (array) $instance, array(
          'title'             => '',
          'image_id'          => '',
          'link'              => '',
          'new_window'        => 0,
        )
      );  
      foreach($instance as $k => $v){
          $$k = $v;
      }
      ?>
        
      <?php /* The widget input form */ ?>

      <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('<strong>Title:</strong>'); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
      </p>
      
      <p>
        <?php pco_image_field( $this, $instance, array( 'title' => 'Select a Banner Image', 'update' => 'Select Image', 'field' => 'image_id' ) ); ?>
      </p>

      <p>
        <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('<strong>Link:</strong>'); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo esc_attr($link); ?>" placeholder="http://"/>
      </p>

      <p>
        <label for="<?php echo $this->get_field_id('new_window'); ?>">
        <input id="<?php echo $this->get_field_id('new_window'); ?>" name="<?php echo $this->get_field_name('new_window'); ?>" type="checkbox" <?php echo $checked = ($new_window === "on") ? "checked" : ""; ?> />
        <?php _e('<strong>New Window</strong>'); ?></label>
      </p>
      
    <?php } 
} // end class div_contact_block_widget
add_action('widgets_init', create_function('', 'return register_widget("div_banner_ad_widget");'));
?>