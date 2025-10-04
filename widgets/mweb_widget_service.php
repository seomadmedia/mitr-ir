<?php
//ads widget
function mweb_tools_block_widget()
{
    register_widget('mweb_tools_widget');
}
//register widget
class mweb_tools_widget extends WP_Widget
{
	//register widget
    function __construct()
    {
        $widget_ops = array('classname' => 'tools-widget', 'description' => '');
        parent::__construct('mweb_tools_widget', THEME_NAME .' - خدمات', $widget_ops);
    }


	//render widget
    function widget($args, $instance)
    {
	    extract( $args );
	    $title      = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
	    $icon   = ( ! empty( $instance['icon'] ) ) ? $instance['icon'] : '';
	    $url        = ( ! empty( $instance['url'] ) ) ? $instance['url'] : '';
	    $color        = ( ! empty( $instance['color'] ) ) ? $instance['color'] : '';

	 ?>
		
	<div class="tools-item" >
            <a target="_blank" href="<?php echo esc_url($url); ?>" <?php if(!empty($color)){ echo 'style="background-color :'.$color.'"'; } ?>><i class="fa <?php echo esc_html( $icon ); ?>"></i><?php echo esc_attr( $title ); ?></a>
    </div>

     

        <?php 
    }


    //update forms
    function update($new_instance, $old_instance)
    {
	    $instance               = $old_instance;
	    $instance['title']      = strip_tags( $new_instance['title'] );
	    $instance['icon']      = strip_tags( $new_instance['icon'] );
	    $instance['url']        = strip_tags( $new_instance['url'] );
	    $instance['color']  = strip_tags( $new_instance['color'] );

        return $instance;
    }


	//form settings
	function form($instance)
	{
		$defaults = array(
			'title'      => 'گزینه دلخواه',
			'icon'   => '',
			'url'        => '',
			'color'  => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		 <script type='text/javascript'>
            jQuery(document).ready(function($) {
                $('#<?php echo esc_attr($this->get_field_id('color')); ?>').wpColorPicker();
            });
        </script>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><strong>عنوان</strong></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('icon')); ?>">آیکن</label>
			<input class="widefat" type="hidden" id="<?php echo esc_attr($this->get_field_id('icon')); ?>" name="<?php echo esc_attr($this->get_field_name('icon')); ?>" value="<?php echo esc_attr($instance['icon']); ?>"/>
			<div id="preview_icon_picker_<?php echo $this->get_field_id('icon'); ?>" data-target="#<?php echo esc_attr($this->get_field_id('icon')); ?>" class="button icon-picker fa <?php if( !empty($instance['icon']) ) echo $instance['icon']; ?>"></div>
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('url')); ?>">لینک</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('url')); ?>" name="<?php echo esc_attr($this->get_field_name('url')); ?>" type="text" value="<?php if( !empty($instance['url']) ) echo  esc_url($instance['url']); ?>"/>
		</p>
	
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('color')); ?>">پس زمینه</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('color')); ?>" name="<?php echo esc_attr($this->get_field_name('color')); ?>" type="text" value="<?php if( !empty($instance['color']) ) echo esc_url($instance['color']); ?>"/>
		</p>
		
	<?php
	}
}

add_action('widgets_init', 'mweb_tools_block_widget');
?>