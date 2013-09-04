<?php

//flush the permalinks
add_action('admin_init', 'flush_rewrite_rules');
//start to build widget
class cookiescontrol_widget extends WP_Widget
{
  function cookiescontrol_widget()
  {
    $widget_ops = array('classname' => 'cookiescontrol-widget', 'description' => __("Add opt-in code such as AdSense which will not be shown unless the user opts in", "cookiescontrol") );
    $this->WP_Widget('cookiescontrol-widget', 'CookiesControl Widget', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'cookiescontrol-widget-title' => '','cookiescontrol-widget-code' => '' ) );
    $cookiescontrol_widget_title = $instance['cookiescontrol_widget_title'];
	 $cookiescontrol_widget_code = $instance['cookiescontrol_widget_code'];
?>
 <p><label for="<?php echo $this->get_field_id('cookiescontrol_widget_title'); ?>"><?php echo __("Title", "cookiescontrol"); ?> <input class="widefat" id="<?php echo $this->get_field_id('cookiescontrol_widget_title'); ?>" name="<?php echo $this->get_field_name('cookiescontrol_widget_title'); ?>" value="<?php echo attribute_escape($cookiescontrol_widget_title); ?>" /></label></p>
 <p><label for="<?php echo $this->get_field_id('cookiescontrol_widget_code'); ?>"><?php echo __("Content", "cookiescontrol"); ?> <textarea class="widefat" id="<?php echo $this->get_field_id('cookiescontrol_widget_code'); ?>" name="<?php echo $this->get_field_name('cookiescontrol_widget_code'); ?>" style="height:130px;"><?php echo attribute_escape($cookiescontrol_widget_code); ?></textarea></label></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['cookiescontrol_widget_title'] = $new_instance['cookiescontrol_widget_title'];
	$instance['cookiescontrol_widget_code'] = $new_instance['cookiescontrol_widget_code'];
    return $instance;
  }

 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
   echo $before_widget;
    $cookiescontrol_widget_title = empty($instance['cookiescontrol_widget_title']) ? ' ' : apply_filters('widget_title', $instance['cookiescontrol_widget_title']);
	$cookiescontrol_widget_code = empty($instance['cookiescontrol_widget_code']) ? ' ' : apply_filters('widget_code', $instance['cookiescontrol_widget_code']);
	
 	 // start widget code
	 
	 //create unique name by using the url
	$choc_chip_cookie_name = str_replace('www.', '', $_SERVER['HTTP_HOST']);
	$choc_chip_cookie_name = str_replace(".", "", $choc_chip_cookie_name);
	
	
	if(isset($_COOKIE["$choc_chip_cookie_name"])) { 	
    	if (!empty($cookiescontrol_widget_title))
     		 echo $before_title . $cookiescontrol_widget_title . $after_title;
	  	if (!empty($cookiescontrol_widget_code))
      		echo  $cookiescontrol_widget_code ;
	}
   
   	//end widget code
 echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("cookiescontrol_widget");') );
?>