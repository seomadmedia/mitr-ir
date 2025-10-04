<?php
//ads widget
function mweb_register_ads_widget()
{
    register_widget('mweb_ads_widget');
}
//register widget
class mweb_ads_widget extends WP_Widget
{
	//register widget
    function __construct()
    {
        $widget_ops = array('classname' => 'ads-widget', 'description' => '' );
        parent::__construct('mweb_ads_widget', THEME_NAME .' - تبلیغات' , $widget_ops);
    }


	//render widget
    function widget($args, $instance)
    {
	    extract( $args );
	    $title      = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
	    $url        = ( ! empty( $instance['url'] ) ) ? $instance['url'] : '';
	    $img        = ( ! empty( $instance['image_url'] ) ) ? $instance['image_url'] : '';
	    $google_ads = ( ! empty( $instance['google_ads'] ) ) ? $instance['google_ads'] : '';

	    echo $before_widget;
	    if ( ! empty( $title ) ) {
		    echo $before_title . esc_attr( $title ) . $after_title;
	    }else {
			echo '<div class="ads-widget-content-wrap clearfix">';
		}
		?>

        
          <?php if(!empty($img)) : ?>
	          <div class="ad-wrap">
            <?php if (!empty($url)) : ?>
                    <a target="_blank" href="<?php echo esc_url($url); ?>"><img src="<?php echo esc_url($img); ?>" alt="<?php bloginfo('name') ?>"></a>
                <?php else : ?>
                    <img src="<?php echo esc_url($img); ?>" alt="<?php bloginfo('name') ?>">
                <?php endif; ?>
	          </div>
           <?php else : ?>
	          <div class="script-ads">
		          <?php if ( ! empty( $google_ads ) ) {
						echo wp_specialchars_decode(stripcslashes($google_ads));
		          } ?>
	          </div>
            <?php endif; ?>

        <?php  echo $after_widget;
    }


    //update forms
    function update($new_instance, $old_instance)
    {
	    $instance               = $old_instance;
	    $instance['title']      = strip_tags( $new_instance['title'] );
	    $instance['url']        = strip_tags( $new_instance['url'] );
	    $instance['image_url']  = strip_tags( $new_instance['image_url'] );
	    $instance['google_ads'] = esc_js( $new_instance['google_ads'] );
        return $instance;
    }


	//form settings
	function form($instance)
	{
		$defaults = array(
			'title'      => '',
			'url'        => '',
			'image_url'  => '',
			'google_ads' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('عنوان:', 'mweb'); ?></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>"/>
		</p>
	
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('url')); ?>"><?php esc_html_e('لینک تبلیغ:', 'mweb'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('url')); ?>" name="<?php echo esc_attr($this->get_field_name('url')); ?>" type="text" value="<?php if( !empty($instance['url']) ) echo  esc_url($instance['url']); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('image_url')); ?>"><?php esc_html_e('لینک عکس تبلیغ:', 'mweb'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('image_url')); ?>" name="<?php echo esc_attr($this->get_field_name('image_url')); ?>" type="text" value="<?php if( !empty($instance['image_url']) ) echo esc_url($instance['image_url']); ?>"/>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'google_ads' )); ?>"><?php esc_html_e('کد تبلیغاتی صباویژن یا ای نتورک و ... :','mweb'); ?></label>
			<textarea rows="10" cols="50" id="<?php echo esc_attr($this->get_field_id( 'google_ads' )); ?>" name="<?php echo esc_attr($this->get_field_name('google_ads')); ?>" class="widefat"><?php echo html_entity_decode(stripcslashes($instance['google_ads'])); ?></textarea>
		</p>
		<p><?php esc_html_e('اگر شما  از کد جاوا اسکریپت استفاده می کنید لطفا تصویر  تبلیغات و آدرس  را حذف کنید.','mweb'); ?></p>
	<?php
	}
}

add_action('widgets_init', 'mweb_register_ads_widget');
?>