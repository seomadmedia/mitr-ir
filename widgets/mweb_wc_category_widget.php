<?php
/**
 * instagram Widget
 * display instagram grid images
 */
add_action('widgets_init', 'mweb_register_wccat_widget');

function mweb_register_wccat_widget()
{
    register_widget('mweb_wc_cat_widget');
}


class mweb_wc_cat_widget extends WP_Widget {

	//register widget
	function __construct() {
		$widget_ops = array('classname'   => 'wc_product_categories', 'description' => 'نمایش فرزندان دسته جاری آرشیو' );
		parent::__construct( 'wc_product_categories',  THEME_NAME .' - زیر دسته جاری', $widget_ops );
	}


	//render widget
    function widget($args, $instance)
    {
        extract($args, EXTR_SKIP);
		if(is_product_category() || is_product_tag()){
			
			$cate = get_queried_object();
			$term_id = $cate->term_id;

			$taxonomy_name = $cate->taxonomy;
			$term_children = get_term_children( $term_id, $taxonomy_name );
			if ( ! is_wp_error( $term_children ) && ! empty( $term_children ) ) {
				$title           = ( ! empty( $instance['title'] ) ) ? $instance['title'] : $cate->name;
				echo $before_widget;
				if ( ! empty( $title ) ) {
					echo $before_title . esc_attr( $title ) . $after_title;
				}
				echo '<ul class="product-categories">';
				foreach ( $term_children as $child ) {
					$term = get_term_by( 'id', $child, $taxonomy_name );
					echo '<li><a href="' . get_term_link( $child, $taxonomy_name ) . '">' . $term->name . '</a></li>';
				}
				echo '</ul>';
				echo $after_widget;
			}
		}
    }

	//update forms
	function update( $new_instance, $old_instance ) {

		$instance                    = $old_instance;
		$instance['title']           = strip_tags( $new_instance['title'] );

		return $instance;
	}

	
    //form settings
    function form($instance)
    {
	    $defaults = array(
		    'title'           => 'اتوماتیک',
	    );
	    $instance = wp_parse_args( (array) $instance, $defaults );

	    ?>
	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><strong><?php esc_attr_e('عنوان :', 'mweb') ?></strong></label>
		    <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>"/>
	    </p>


    <?php
    }
}

