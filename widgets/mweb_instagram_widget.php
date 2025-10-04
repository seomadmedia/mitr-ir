<?php
/**
 * instagram Widget
 * display instagram grid images
 */
add_action('widgets_init', 'mweb_register_instagram_widget');

function mweb_register_instagram_widget()
{
    register_widget('mweb_sb_instagram');
}


class mweb_sb_instagram extends WP_Widget {

	//register widget
	function __construct() {
		$widget_ops = array('classname'   => 'sb-instagram-widget', 'description' => '' );
		parent::__construct( 'mweb_sb_instagram_widget',  THEME_NAME .' - اینستاگرام', $widget_ops );
	}


	//render widget
    function widget($args, $instance)
    {
        extract($args, EXTR_SKIP);

	    $title           = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
	    $instagram_token = ( ! empty( $instance['instagram_token'] ) ) ? $instance['instagram_token'] : '';
	    $num_images      = ( ! empty( $instance['num_image'] ) ) ? $instance['num_image'] : '';
	    $num_column      = ( ! empty( $instance['num_column'] ) ) ? $instance['num_column'] : 'col-3';
	    $bottom_text     = ( ! empty( $instance['bottom_text'] ) ) ? $instance['bottom_text'] : '';
	    $click_popup     = ( ! empty( $instance['click_popup'] ) ) ? $instance['click_popup'] : '';
	    $tag             = ( ! empty( $instance['tag'] ) ) ? strip_tags( $instance['tag'] ) : '';

	    echo $before_widget;

	    if ( ! empty( $title ) ) {
		    echo $before_title . esc_attr( $title ) . $after_title;
	    }

	    $data_images = get_transient( 'mweb_sb_instagram_cache' );

	    if ( empty( $data_images ) ) {
		    $data_images = mweb_theme_instagram_data::get_data( $instagram_token, 'mweb_sb_instagram_cache', $num_images, $tag );
	    };

	    if ( ! empty( $data_images->data ) ) : ?>
		    <div class="instagram-content-wrap row clearfix">

			    <?php foreach ($data_images->data as $mweb_post_data) : ?>
				    <div class="instagram-el <?php echo esc_attr($num_column) ?>">
					    <?php if(!empty($click_popup))  : ?>
						    <a href="<?php echo esc_url($mweb_post_data->images->standard_resolution->url) ?>" class="instagram-popup-el cursor-zoom" data-source="<?php if(!empty($mweb_post_data->user->username)){ echo esc_attr($mweb_post_data->user->username); } ?>"><img src="<?php echo esc_url($mweb_post_data->images->low_resolution->url) ?>" alt=""></a>
					    <?php else : ?>
						    <a href="<?php echo esc_html( $mweb_post_data->link ); ?>" target="_blank"><img src="<?php echo esc_url($mweb_post_data->images->low_resolution->url) ?>" alt=""></a>
					    <?php endif; ?>
				    </div>
			    <?php endforeach; ?>
		    </div><!--# instagram content wrap -->

		    <?php if(!empty($bottom_text)) : ?>
			    <div class="instagram-bottom-text clearfix entry"><span><?php echo html_entity_decode(stripcslashes($bottom_text)); ?></span></div>
		    <?php endif; ?>

		    <?php if ( ! empty( $click_popup ) ) {
			    //enable popup images
			    wp_localize_script( 'my-script', 'mweb_instagram_popup', '1' );
		    } ?>
	    <?php else :
		    if(is_string($data_images)){
			    echo( strval( $data_images ) );
		    };
	    endif;

	    echo $after_widget;
    }

	//update forms
	function update( $new_instance, $old_instance ) {

		delete_transient( 'mweb_sb_instagram_cache' );
		$instance                    = $old_instance;
		$instance['title']           = strip_tags( $new_instance['title'] );
		$instance['instagram_token'] = strip_tags( $new_instance['instagram_token'] );
		$instance['num_image']       = absint( strip_tags( $new_instance['num_image'] ) );
		$instance['bottom_text']     = addslashes( $new_instance['bottom_text'] );
		$instance['num_column']      = strip_tags( $new_instance['num_column'] );
		$instance['click_popup']     = strip_tags( $new_instance['click_popup'] );
		$instance['tag']             = strip_tags( $new_instance['tag'] );

		return $instance;
	}

	
    //form settings
    function form($instance)
    {
	    $defaults = array(
		    'title'           => 'اینستاگرام',
		    'instagram_token' => '',
		    'num_image'       => 12,
		    'num_column'      => 'col-3',
		    'bottom_text'     => '',
		    'click_popup'     => '',
		    'tag'             => ''

	    );
	    $instance = wp_parse_args( (array) $instance, $defaults );

	    ?>
	    <p><?php echo html_entity_decode( esc_html__( '<p>برای اطلاع از نحوه تنظیم این ابزارک به لینک <a target="_blank" href="http://www.mahdisweb.net/blog/token-instagram/">"کلیک کنید"</a> مراجعه کنید</p>', 'mweb' ) ); ?>
	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('عنوان :', 'mweb') ?></label>
		    <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>"/>
	    </p>

	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id('instagram_token')); ?>"><?php esc_attr_e('اینستاگرام Access Token:', 'mweb') ?></label>
		    <input class="widefat" id="<?php echo esc_attr($this->get_field_id('instagram_token')); ?>" name="<?php echo esc_attr($this->get_field_name('instagram_token')); ?>" type="text" value="<?php echo esc_attr($instance['instagram_token']); ?>"/>
	    </p>

	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id('num_image')); ?>"><?php esc_attr_e('تعداد عکس:', 'mweb') ?></label>
		    <input class="widefat" id="<?php echo esc_attr($this->get_field_id('num_image')); ?>" name="<?php echo esc_attr($this->get_field_name('num_image')); ?>" type="text" value="<?php echo esc_attr($instance['num_image']); ?>"/>
	    </p>
	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id('tag')); ?>"><?php esc_attr_e('نمایش بر اساس تگ:', 'mweb') ?><span><?php echo esc_html__( ' (اگر میخواید عکس های خودتون نمایش داده شه این فیلد رو خالی رها کنید)', 'mweb' ); ?></span></label>
		    <input class="widefat" id="<?php echo esc_attr($this->get_field_id('tag')); ?>" name="<?php echo esc_attr($this->get_field_name('tag')); ?>" type="text" value="<?php echo esc_attr($instance['tag']); ?>"/>
	    </p>
	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'num_column' )); ?>"><?php esc_attr_e('تعداد ستون:', 'mweb'); ?></label>
		    <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'num_column' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'num_column' )); ?>" >
			    <option value="col-6" <?php if( !empty($instance['num_column']) && $instance['num_column'] == 'col-6' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_attr_e('2 ستون', 'mweb'); ?></option>
			    <option value="col-4" <?php if( !empty($instance['num_column']) && $instance['num_column'] == 'col-4' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_attr_e('3 ستون', 'mweb'); ?></option>
			    <option value="col-3" <?php if( !empty($instance['num_column']) && $instance['num_column'] == 'col-3' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_attr_e('4 ستون', 'mweb'); ?></option>
		    </select>
	    </p>
	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id('bottom_text')); ?>"><?php esc_attr_e('متن پایین:', 'mweb') ?></label>
		    <input class="widefat" id="<?php echo esc_attr($this->get_field_id('bottom_text')); ?>" name="<?php echo esc_attr($this->get_field_name('bottom_text')); ?>" type="text" value="<?php echo esc_html($instance['bottom_text']); ?>"/>
	    </p>

	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'click_popup' )); ?>"><?php esc_attr_e('فعال سازی پاپ آپ:','mweb') ?></label>
		    <input class="widefat" type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'click_popup' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'click_popup' )); ?>" value="checked" <?php if( !empty( $instance['click_popup'] ) ) echo 'checked="checked"'; ?>  />
	    </p>

    <?php
    }
}

