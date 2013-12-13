<?php
/*
Plugin Name: Div Truth Contact Block Widget
Plugin URI: http://divtruth.com/
Description: Customizable widget for creating a contact block
Version: 0.1
Author: Div Truth LLC
Author URI: http://divtruth.com
*/

/**
 * Div Truth Contact Block Widget Class
 */
class div_contact_block_widget extends WP_Widget {
 
    /** constructor -- name this the same as the class above */
    function div_contact_block_widget() {
        parent::WP_Widget(false, $name = 'DT: Contact Block');
        $widget_ops = array('classname' => 'div_contact_block', 'description' => 'Create a contact block from company details' );
        $control_ops = array( 'width' => 350);
        $this->WP_Widget('div_contact_block_widget', 'Contact Block', $widget_ops, $control_ops);
    } //end constructor
            
    /** @see WP_Widget::widget -- do not rename this */
    /* This section writes the icons on the website page */
    function widget($args, $instance) {	
      $sort = array();
      extract($instance, EXTR_SKIP);
      foreach($args as $k => $v){$$k = $v;}
      foreach($instance as $k => $v){
        $$k = $v;
        $sort_field = substr($k, -5);
        if($sort_field == "order"){
          if($v){
            $sort[$v] = substr_replace($k ,"",-6); //remove "_order" and insert into array
          }
        }
      }
      ?>
      <?php /* Create Widget */ ?>
      <?php echo $before_widget; ?>
        <div id="div-contact" class="<?php echo @$icon_theme; ?>">
          <?php /* Write the widget title, if needed */ ?>      
          <?php if ( $title ) {
            echo $before_title . $title . $after_title; 
          } 
          array_unique($sort); //Remove any duplicates

          if($sort){
            $sorted = $sort;
          } else {
            echo "Need to update the order of the conact fields for this widget instance";
          }
          ksort($sorted);
          foreach ( $sorted as $f) {
            switch ($f) {
              case 'name':
                echo '<div id="company_name">'.$company_name.'</div>';
                break;
              
              case 'phone':
                echo '<div id="phone">'.$phone.'</div>';
                break;
              
              case 'email':
                echo '<div id="email">'.$email.'</div>';
                break;
              
              case 'address1':
                echo '<div id="address1">'.$address1.'</div>';
                break;
              
              case 'address2':
                echo '<div id="address2">'.$address2.'</div>';
                break;
              
              default:
                echo '<div id="company_name">'.$company_name.'</div>';
                break;
            }
          }
          ?>
          
        </div> <!-- end #div-contact -->

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
          'title'             => 'Contact Us',
          'company_name'      => get_field('name','option'),
          'phone'             => get_field('phone','option'),
          'email'             => get_field('email_link','option'),
          'address1'         => get_field('street_address','option'),
          'address2'         => get_field('city','option').', '.get_field('state','option').' '.get_field('zip','option'),
          'name_order'        => '1',
          'phone_order'       => '2',
          'email_order'       => '3',
          'address1_order'    => '4',
          'address2_order'    => '5',
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
      <p>Change details as needed, leave field empty if you do not want it used. IF you want a different layout, change the default order</p>
      <?php add_thickbox(); ?>
      <a class="thickbox button" style="margin-bottom:10px;" href="http://divtruth.com/instuction_videos/Contact_Block_Widget.swf?TB_iframe=true&width=1100&height=800">Instructions<a>
      <p>
        <label for="<?php echo $this->get_field_id('company_name'); ?>"><?php _e('<strong>Name:</strong>'); ?></label> 
        <input style="width:220px;float:right;" tabindex="6" class="widefat" id="<?php echo $this->get_field_id('company_name'); ?>" name="<?php echo $this->get_field_name('company_name'); ?>" type="text" value="<?php echo esc_attr($company_name); ?>" />
        <input style="width:50px;float:right;" tabindex="1" id="<?php echo $this->get_field_id('name_order'); ?>" name="<?php echo $this->get_field_name('name_order'); ?>" type="text" value="<?php echo esc_attr($name_order); ?>" placeholder="Order" />
      </p>
      
      <p>
        <label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e('<strong>Phone:</strong>'); ?></label> 
        <input style="width:220px;float:right;" tabindex="7" class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo esc_attr($phone); ?>" />
        <input style="width:50px;float:right;" tabindex="2" id="<?php echo $this->get_field_id('phone_order'); ?>" name="<?php echo $this->get_field_name('phone_order'); ?>" type="text" value="<?php echo esc_attr($phone_order); ?>" placeholder="Order" />
      </p>

      <p>
        <label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('<strong>Email:</strong>'); ?></label> 
        <input style="width:220px;float:right;" tabindex="8" class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo esc_attr($email); ?>" />
        <input style="width:50px;float:right;" tabindex="3" id="<?php echo $this->get_field_id('email_order'); ?>" name="<?php echo $this->get_field_name('email_order'); ?>" type="text" value="<?php echo esc_attr($email_order); ?>" placeholder="Order" />
      </p>

      <p>
        <label for="<?php echo $this->get_field_id('address1'); ?>"><?php _e('<strong>Address 1:</strong>'); ?></label> 
        <input style="width:220px;float:right;" tabindex="9" class="widefat" id="<?php echo $this->get_field_id('address1'); ?>" name="<?php echo $this->get_field_name('address1'); ?>" type="text" value="<?php echo esc_attr($address1); ?>" />
        <input style="width:50px;float:right;" tabindex="4" id="<?php echo $this->get_field_id('address1_order'); ?>" name="<?php echo $this->get_field_name('address1_order'); ?>" type="text" value="<?php echo esc_attr($address1_order); ?>" placeholder="Order" />
      </p>
      
      <p>
        <label for="<?php echo $this->get_field_id('address2'); ?>"><?php _e('<strong>Address 2:</strong>'); ?></label> 
        <input style="width:220px;float:right;" tabindex="10" class="widefat" id="<?php echo $this->get_field_id('address2'); ?>" name="<?php echo $this->get_field_name('address2'); ?>" type="text" value="<?php echo esc_attr($address2); ?>" />
        <input style="width:50px;float:right;" tabindex="5" id="<?php echo $this->get_field_id('address2_order'); ?>" name="<?php echo $this->get_field_name('address2_order'); ?>" type="text" value="<?php echo esc_attr($address2_order); ?>" placeholder="Order" />
      </p>
      
    <?php } 
} // end class div_contact_block_widget
add_action('widgets_init', create_function('', 'return register_widget("div_contact_block_widget");'));
?>