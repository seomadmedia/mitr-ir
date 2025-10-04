<?php
add_action('widgets_init', 'mweb_register_block_post_widget');

function mweb_register_block_post_widget()
{
    register_widget('mweb_block_post_widget');
}

class mweb_block_post_widget extends WP_Widget
{

	//register widget
    function __construct()
    {
        $widget_ops = array('classname' => 'block-post-widget', 'description' => '');
        parent::__construct('mweb_block_post_widget', THEME_NAME .' - لیست مطالب', $widget_ops);
    }


	//render widget
    function widget($args, $instance)
    {
        extract($args);
	    $mweb_options                   = array();
	    $title                          = ! empty( $instance['title'] ) ? esc_attr( $instance['title'] ) : 'آخرین مطالب';
	    $mweb_options['posts_per_page'] = ! empty( $instance['posts_per_page'] ) ? $instance['posts_per_page'] : 4;
	    $mweb_options['orderby']        = ! empty( $instance['orderby'] ) ? $instance['orderby'] : 'date_post';
	    $mweb_options['category_id']    = ! empty( $instance['cate'] ) ? $instance['cate'] : 0;
	    $mweb_options['category_ids']   = ! empty( $instance['cates'] ) ? $instance['cates'] : '';
	    $mweb_options['tags']           = ! empty( $instance['tags'] ) ? $instance['tags'] : '';
	    $mweb_options['offset']         = ! empty( $instance['offset'] ) ? $instance['offset'] : 0;
	    $type                           = ! empty( $instance['type'] ) ? $instance['type'] : 'simple';

		//query data
        $query_data = mweb_theme_query::get_custom_query($mweb_options);
			
		$loop_name = $type == 'simple' ? 'mweb_loop_template_blog_simple_h' : 'mweb_loop_template_blog_2';
		
		

		//if(!empty($title) && $type == 'simple')
		echo $before_widget;

	    if ( ! empty( $title ) ) {
		    echo $before_title . esc_attr( $title ) . $after_title;
	    }
		
		if($type == 'overlay')
			echo '<div class="blog-posts-content-2">';
			
	    if ( $query_data->have_posts() ) {

			while ( $query_data->have_posts() ) {
				$query_data->the_post();
				echo $loop_name();
			};
				
		}


        

	    //reset post data
	    wp_reset_postdata();
		
		if($type == 'overlay')
			echo '</div>';
		
        echo $after_widget;
	
    }


	//update forms
	function update( $new_instance, $old_instance ) {
		$instance                   = $old_instance;
		$instance['title']          = strip_tags( $new_instance['title'] );
		$instance['type']           = strip_tags( $new_instance['type'] );
		$instance['cate']           = strip_tags( $new_instance['cate'] );
		$instance['cates']          = strip_tags( $new_instance['cates'] );
		$instance['tags']           = strip_tags( $new_instance['tags'] );
		$instance['posts_per_page'] = absint( strip_tags( $new_instance['posts_per_page'] ) );
		$instance['offset']         = absint( strip_tags( $new_instance['offest'] ) );
		$instance['orderby']        = strip_tags( $new_instance['orderby'] );

		return $instance;
	}


	//form settinga
    function form($instance)
    {
	    $defaults = array(
		    'title'          => 'آخرین مطالب',
		    'type'           => 'simple',
		    'orderby'        => 'date_post',
		    'posts_per_page' => 4,
		    'cate'           => '',
		    'cates'          => '',
		    'tags'           => '',
		    'offset'         => 0
	    );
	    $instance = wp_parse_args( (array) $instance, $defaults ); ?>

	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">عنوان</label>
		    <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php if(!empty($instance['title'])) echo esc_attr($instance['title']); ?>" />
	    </p>
		
		<p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'type' )); ?>"><?php esc_attr_e('نوع نمایش', 'mweb'); ?></label>
		    <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'type' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'type' )); ?>" >
			    <option value="simple" <?php if( !empty($instance['type']) && $instance['type'] == 'simple' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_attr_e('یک', 'mweb'); ?></option>
			    <option value="overlay" <?php if( !empty($instance['type']) && $instance['type'] == 'overlay' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_attr_e('دو', 'mweb'); ?></option>
		    </select>
	    </p>

	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id('cate')); ?>">دسته بندی</label>
		    <select class="widefat" id="<?php echo esc_attr($this->get_field_id('cate')); ?>" name="<?php echo esc_attr($this->get_field_name('cate')); ?>">
			    <option value='all' <?php if ($instance['cate'] == 'all') echo 'selected="selected"'; ?>>همه</option>
			    <?php $categories = get_categories('type=post'); foreach ($categories as $category) { ?><option  value='<?php echo esc_attr($category->term_id); ?>' <?php if ($instance['cate'] == $category->term_id) echo 'selected="selected"'; ?>><?php echo esc_attr($category->cat_name); ?></option><?php } ?>
		    </select>
	    </p>

	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'cates' )); ?>">دسته بندی ها - با , آیدی دسته ها را جدا کنید </label>
		    <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'cates' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'cates' )); ?>" value="<?php if( !empty($instance['cates']) ) echo esc_attr($instance['cates']); ?>" />
	    </p>

	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'tags' )); ?>">برچسب</label>
		    <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'tags' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'tags' )); ?>" value="<?php if( !empty($instance['tags']) ) echo esc_attr($instance['tags']); ?>" />
	    </p>

	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'posts_per_page' )); ?>">تعداد مطلب</label>
		    <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'posts_per_page' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'posts_per_page' )); ?>" value="<?php if( !empty($instance['posts_per_page']) ) echo esc_attr($instance['posts_per_page']); ?>" />
	    </p>

	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'offset' )); ?>">نقطه شروع مطالب</label>
		    <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'offset' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'offest' )); ?>" value="<?php if( !empty($instance['offset']) ) echo esc_attr($instance['offset']); ?>" />
	    </p>

	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'orderby' )); ?>">نمایش بر اساس</label>
		    <select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'orderby' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'orderby' )); ?>" >
			    <option value="date_post" <?php if( !empty($instance['orderby']) && $instance['orderby'] == 'date' ) echo "selected=\"selected\""; else echo ""; ?>>تاریخ</option>
			    <option value="comment_count" <?php if( !empty($instance['orderby']) && $instance['orderby'] == 'comment_count' ) echo "selected=\"selected\""; else echo ""; ?>>بیشترین نظرات</option>
			    <option value="popular" <?php if( !empty($instance['orderby']) && $instance['orderby'] == 'popular' ) echo "selected=\"selected\""; else echo ""; ?>>پربازدیدترین</option>
			    <option value="post_type" <?php if( !empty($instance['orderby']) && $instance['orderby'] == 'post_type' ) echo "selected=\"selected\""; else echo ""; ?>>نوع مطلب</option>
			    <option value="rand" <?php if( !empty($instance['orderby']) && $instance['orderby'] == 'rand' ) echo "selected=\"selected\""; else echo ""; ?>>تصادفی</option>
			    <option value="author" <?php if( !empty($instance['author']) && $instance['orderby'] == 'author' ) echo "selected=\"selected\""; else echo ""; ?>>نویسنده</option>
		    </select>
	    </p>
    <?php
    }
}

?>