<?php
/**
 * instagram Widget
 * display instagram grid images
 */
add_action('widgets_init', 'mweb_register_instagrampro_widget');

function mweb_register_instagrampro_widget()
{
    register_widget('mweb_instagram_widget');
}


class mweb_instagram_widget extends WP_Widget {

	//register widget
	function __construct() {
		$widget_ops = array('classname'   => 'widget_instagram_wg', 'description' => '' );
		parent::__construct( 'instagram_wg',  THEME_NAME .' - اینستاگرام بنر', $widget_ops );
	}


	//render widget
    function widget($args, $instance)
    {
        extract($args, EXTR_SKIP);

	    $title           = ( ! empty( $instance['title'] ) ) ? $instance['title'] : 'صفحه اینستاگرام';
	    $desc 		     = ( ! empty( $instance['desc'] ) ) ? $instance['desc'] : '';
	    $instagram_id     = ( ! empty( $instance['instagram_id'] ) ) ? $instance['instagram_id'] : '';
	    $link            = ( ! empty( $instance['link'] ) ) ? $instance['link'] : '';

	   echo $before_widget;
			echo '<div>';
			echo '<a href="'.esc_url($link).'" target="_blank">';
				echo '<div class="instagram_head"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#instagram"></use></svg>'.esc_attr( $title ).'</div>';
				echo '<div class="instagram_info"><p>'.esc_attr( $desc ).'</p><span>'.esc_attr( $instagram_id ).'</span></div>';
			echo '</a>';
		echo $after_widget;
    }

	//update forms
	function update( $new_instance, $old_instance ) {

		$instance                    = $old_instance;
		$instance['title']           = strip_tags( $new_instance['title'] );
		$instance['desc'] 			 = strip_tags( $new_instance['desc'] );
		$instance['instagram_id']     = strip_tags( $new_instance['instagram_id'] );
		$instance['link']            = strip_tags( $new_instance['link'] );

		return $instance;
	}

	
    //form settings
    function form($instance)
    {
	    $defaults = array(
		    'title'           => 'صفحه اینستاگرام',
		    'desc'            => 'اخبار مقالات و تخفیفات گروهی را دنبال کنید',
		    'instagram_id'     => '@mahdisweb',
		    'link'            => 'http://',
	    );
	    $instance = wp_parse_args( (array) $instance, $defaults );

	    ?>
	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><strong><?php esc_attr_e('عنوان :', 'mweb') ?></strong></label>
		    <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>"/>
	    </p>

	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id('desc')); ?>"><strong><?php esc_attr_e('توضیح :', 'mweb') ?></strong></label>
		    <input class="widefat" id="<?php echo esc_attr($this->get_field_id('desc')); ?>" name="<?php echo esc_attr($this->get_field_name('desc')); ?>" type="text" value="<?php echo esc_attr($instance['desc']); ?>"/>
	    </p>
	    
	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id('instagram_id')); ?>"><strong><?php esc_attr_e('آیدی اینستاگرام :', 'mweb') ?></strong></label>
		    <input class="widefat" id="<?php echo esc_attr($this->get_field_id('instagram_id')); ?>" name="<?php echo esc_attr($this->get_field_name('instagram_id')); ?>" type="text" value="<?php echo esc_html($instance['instagram_id']); ?>"/>
	    </p>
		
		<p>
		    <label for="<?php echo esc_attr($this->get_field_id('link')); ?>"><strong><?php esc_attr_e('لینک :', 'mweb') ?></strong></label>
		    <input class="widefat" id="<?php echo esc_attr($this->get_field_id('link')); ?>" name="<?php echo esc_attr($this->get_field_name('link')); ?>" type="text" value="<?php echo esc_html($instance['link']); ?>"/>
	    </p>


    <?php
    }
}

