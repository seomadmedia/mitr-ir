<?php
add_action('widgets_init', 'mweb_register_block_realtime_widget');

function mweb_register_block_realtime_widget()
{
    register_widget('mweb_block_realtime_widget');
}

class mweb_block_realtime_widget extends WP_Widget
{

	//register widget
    function __construct()
    {
        $widget_ops = array('classname' => 'block-realtime-widget', 'description' => '');
        parent::__construct('mweb_block_realtime_widget', THEME_NAME .' - پیشنهاد لحظه ای', $widget_ops);
    }


	//render widget
    function widget($args, $instance)
    {
        extract($args);
	    $mweb_options                   = array();
		$mweb_options['post_type']      = 'product';

	    $title                          = ! empty( $instance['title'] ) ? esc_attr( $instance['title'] ) : 'پیشنهاد لحظه ای';
	    $mweb_options['posts_per_page'] = ! empty( $instance['posts_per_page'] ) ? $instance['posts_per_page'] : 4;
	    $mweb_options['orderby']        = ! empty( $instance['orderby'] ) ? $instance['orderby'] : 'date_post';
	    $mweb_options['category_id']    = ! empty( $instance['category'] ) ? $instance['category'] : '';
		$type                           = ! empty( $instance['type'] ) ? $instance['type'] : 'one';

		//query data
        $query_data = mweb_theme_query::get_custom_query($mweb_options);

        echo $before_widget;

	    if ( ! empty( $title ) ) {
		    echo $type == 'one' ? $before_title . esc_attr( $title ) . $after_title : '<div class="realtime_title">' . esc_attr( $title ) . '</div><div class="widget-content">';
	    }
		
		

	    if ( $query_data->have_posts() ) {

			if( $type == 'one' ){
				echo '<div class="realtime_slider_wrap">';
					echo '<div class="swiper realtime_slider nav_swiper-slider" dir="rtl">';
						echo '<div class="swiper-wrapper">';
							while ( $query_data->have_posts() ) {
								$query_data->the_post();
								echo '<div class="swiper-slide">';
								echo mweb_loop_template_product_realtime();
								echo '</div>';
							};
						echo '</div>';
						echo '<div class="mweb-swiper-next"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-right-1"></use></svg></div><div class="mweb-swiper-prev"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-left-1"></use></svg></div>';
						echo '<div class="slider-progress-wrap"><div class="slider-progress"></div></div>';
					echo '</div>';
				echo '</div>';
			} else{
				$data_setting = array();

				$data_setting['slidesPerView'] = 1;
				$data_setting['spaceBetween'] = 0;
				$data_setting['watchSlidesVisibility'] = true;
				$data_setting['loop'] = true;
				$data_setting['autoplay'] = false;
				$data_setting['touchMoveStopPropagation'] = true;
				$data_setting['navigation'] = array('nextEl' => '.mweb-rts-next', 'prevEl' => '.mweb-rts-prev' );
				$data_setting['pagination'] = array('el' => '.mweb-swiper-pagination', 'clickable' => true);

				
				echo '<div class="swiper sw_slider_realtime" dir="rtl" id="'.wp_unique_id('sl_').'" data-slider="'. esc_attr(wp_json_encode($data_setting)) .'"><div class="swiper-wrapper">';				
					while ( $query_data->have_posts() ) {
						$query_data->the_post();
						echo '<div class="swiper-slide">';
						echo mweb_loop_template_product_realtime_2();
						echo '</div>';
					};
				echo '</div><div class="realtime_nav"><div class="mweb-rts-next"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-right-1"></use></svg></div><div class="mweb-swiper-pagination"></div><div class="mweb-rts-prev"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-left-1"></use></svg></div></div></div>';
				
			}

		}

	    //reset post data
	    wp_reset_postdata();
        echo $after_widget;
    }


	//update forms
	function update( $new_instance, $old_instance ) {
		$instance                   = $old_instance;
		$instance['title']          = strip_tags( $new_instance['title'] );
		$instance['category']		= strip_tags( $new_instance['category'] );
		$instance['posts_per_page'] = absint( strip_tags( $new_instance['posts_per_page'] ) );
		$instance['orderby']        = strip_tags( $new_instance['orderby'] );
		$instance['type']           = strip_tags( $new_instance['type'] );

		return $instance;
	}


	//form settinga
    function form($instance)
    {
	    $defaults = array(
		    'title'          => 'پیشنهاد لحظه ای',
		    'orderby'        => '',
		    'posts_per_page' => 4,
		    'category'       => '',
			'type'           => 'one',
		    
	    );
	    $instance = wp_parse_args( (array) $instance, $defaults ); ?>

	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">عنوان</label>
		    <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php if(!empty($instance['title'])) echo esc_attr($instance['title']); ?>" />
	    </p>

	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id('category')); ?>">دسته بندی</label>
		    <?php

			wp_dropdown_categories( array(

				'orderby'    => 'title',
				'show_option_none'  => 'همه دسته ها',
				'option_none_value' => 0,
				'hide_empty' => true,
				'name'       => $this->get_field_name( 'category' ),
				'id'         => $this->get_field_id( 'category' ),
				'class'      => 'widefat',
				'taxonomy'	 => 'product_cat',
				'selected'   => $instance['category']

			) );

			?>
	    </p>

	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'posts_per_page' )); ?>">تعداد مطلب</label>
		    <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'posts_per_page' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'posts_per_page' )); ?>" value="<?php if( !empty($instance['posts_per_page']) ) echo esc_attr($instance['posts_per_page']); ?>" />
	    </p>

	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'orderby' )); ?>">نمایش بر اساس</label>
		    <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'orderby' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'orderby' )); ?>" >
			    <option value="date_post" <?php if( !empty($instance['date_post']) && $instance['date_post'] == 'date_post' ) echo "selected=\"selected\""; else echo ""; ?>>تاریخ</option>
			    <option value="rand" <?php if( !empty($instance['orderby']) && $instance['orderby'] == 'rand' ) echo "selected=\"selected\""; else echo ""; ?>>تصادفی</option>
			    <option value="best_selling" <?php if( !empty($instance['best_selling']) && $instance['best_selling'] == 'best_selling' ) echo "selected=\"selected\""; else echo ""; ?>>فروش</option>
			    <option value="top_rate" <?php if( !empty($instance['top_rate']) && $instance['top_rate'] == 'top_rate' ) echo "selected=\"selected\""; else echo ""; ?>>امتیاز</option>
		    </select>
	    </p>
		
		<p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'type' )); ?>"><?php esc_attr_e('نوع نمایش', 'mweb'); ?></label>
		    <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'type' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'type' )); ?>" >
			    <option value="one" <?php if( !empty($instance['type']) && $instance['type'] == 'one' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_attr_e('یک', 'mweb'); ?></option>
			    <option value="two" <?php if( !empty($instance['type']) && $instance['type'] == 'two' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_attr_e('دو', 'mweb'); ?></option>
		    </select>
	    </p>
		
	
		
    <?php
    }
}

?>