<?php
add_action('widgets_init', 'mweb_mostview_slider_widget');

function mweb_mostview_slider_widget()
{
	register_widget('mweb_mostview_widget');
}

class mweb_mostview_widget extends WP_Widget
{

	//register widget
	function __construct()
	{
		$widget_ops = array('classname' => 'most-view-widget', 'description' => '');

		/* Create the widget. */
		parent::__construct('mweb_mostview_widget', THEME_NAME .' - ترین ها', $widget_ops);
	}


	//render widget
	function widget($args, $instance)
	{
        extract($args);
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
	    $posts_per_page = ! empty( $instance['posts_per_page'] ) ? $instance['posts_per_page'] : 5;


			echo '<div class="inner_wrap the_most">';
			echo '<div class="tabs" data-toggle="tabslet" data-animation="true">';
		
			?>
			<ul class="ul_tab">
				<li><a href="#mostsell"><span>پر فروش ترین</span><div class="el_ico"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#bag-2"></use></svg></div></a></li>
				<li><a href="#mostlike"><span>محبوب ترین ها</span><div class="el_ico"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#heart"></use></svg></div></a></li>
				<li><a href="#mostcmd"><span>پر بحث ترین</span><div class="el_ico"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#message-notif"></use></svg></div></a></li>
			</ul>

			<div class="tab_body" id="mostsell">
			
			<?php
				$block_options = array();
				$query_data = array();
				$block_options['post_type'] = 'product';
				$block_options['orderby'] = 'best_selling';
				$block_options['posts_per_page'] = $posts_per_page; 
				$query_data = mweb_theme_query::get_custom_query($block_options);
			?>
			
			<?php echo apply_filters( 'woocommerce_before_widget_product_list', '<ul class="product_list_widget">' );
					while ( $query_data->have_posts() ) : ?>
					<?php $query_data->the_post(); ?>
					<?php wc_get_template( 'content-widget-product.php', array( 'show_rating' => false ) );	?>
				<?php endwhile; 
					  //reset post data
					  wp_reset_postdata();
					  echo apply_filters( 'woocommerce_after_widget_product_list', '</ul>' );
					?>
               
            </div>
			<div class="tab_body" id="mostlike">
			
			<?php
				$block_options = array();
				$query_data = array();
				$block_options['post_type'] = 'product';
				$block_options['orderby'] = 'top_rate';
				$block_options['posts_per_page'] = $posts_per_page; 
				$query_data = mweb_theme_query::get_custom_query($block_options);
			?>
			
			<?php  	echo apply_filters( 'woocommerce_before_widget_product_list', '<ul class="product_list_widget">' );
					while ( $query_data->have_posts() ) : ?>
				<?php $query_data->the_post(); ?>
					<?php wc_get_template( 'content-widget-product.php', array( 'show_rating' => true ) ); ?>
				<?php endwhile; 
					  //reset post data
					  wp_reset_postdata();
					  echo apply_filters( 'woocommerce_after_widget_product_list', '</ul>' );
						?>
               
            </div>
			<div class="tab_body" id="mostcmd">
			
			<?php
				$block_options = array();
				$query_data = array();
				$block_options['post_type'] = 'product';
				$block_options['orderby'] = 'comment_count';
				$block_options['posts_per_page'] = $posts_per_page; 
				$query_data = mweb_theme_query::get_custom_query($block_options);
			?>
			
			<?php  	echo apply_filters( 'woocommerce_before_widget_product_list', '<ul class="product_list_widget">' );
					while ( $query_data->have_posts() ) : ?>
				<?php $query_data->the_post(); ?>
					<?php wc_get_template( 'content-widget-product.php', array( 'show_rating' => false ) ); ?>
				<?php endwhile; 
					  //reset post data
					  wp_reset_postdata();
					  echo apply_filters( 'woocommerce_after_widget_product_list', '</ul>' );
					?>
               
            </div>
			
			


			<?php
			
			echo '</div></div>';
	}


	//update forms
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['posts_per_page'] = absint( strip_tags( $new_instance['posts_per_page'] ) );
		return $instance;
	}


	//form settings
	function form($instance)
	{
		$defaults = array( 'title' => 'بیشترین ها' , 'posts_per_page' => 5);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><strong>عنوان</strong></label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>"/>
		</p>
		<p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'posts_per_page' )); ?>">تعداد مطلب</label>
		    <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'posts_per_page' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'posts_per_page' )); ?>" value="<?php if( !empty($instance['posts_per_page']) ) echo esc_attr($instance['posts_per_page']); ?>" />
	    </p>
	
	<?php
	}
}

?>