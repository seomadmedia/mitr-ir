<?php
/**
 * Class mweb_theme_block
 * This file manager block for mweb composer
 */
if ( ! class_exists( 'mweb_theme_block' ) ) {
	class mweb_theme_block {

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $block
		 *
		 * @return bool|string|WP_Query
		 * query block data
		 */
		static function get_data( $block ) {

			//check and return
			if ( empty( $block['block_options'] ) ) {
				return false;
			}

			//set no found rows
			if ( ! isset( $block['block_options']['no_found_rows'] ) && empty( $block['block_options']['pagination'] ) ) {
				$block['block_options']['no_found_rows'] = true;
			} else {
				$block['block_options']['no_found_rows'] = false;
			}

			//query
			return mweb_theme_query::get_custom_query( $block['block_options'] );
		}



		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $block
		 * @param $data_query
		 *
		 * @return string
		 * render open block
		 */
		static function block_open( $block, $data_query = null ) {

			//check ID
			if ( empty( $block['block_id'] ) ) {
				return false;
			}

			//create class
			$main_classes    = array();
			//$inner_classes   = array();
			$main_classes[]  = 'mweb-block-wrap';
			//$inner_classes[] = 'mweb-block-inner';
			$ajax_param      = '';

			//create wrapper classes
			if ( ! empty( $block['block_classes'] ) ) {
				$main_classes[] = $block['block_classes'];
			}

			if ( ! empty( $block['block_options']['pagination'] ) ) {
				$main_classes[] = 'is-ajax-pagination';
			}

			/* if ( ! empty( $block['block_options']['block_style'] ) ) {
				$main_classes[] = 'is-dark-block';
			}

			if ( ! empty( $block['block_options']['position'] ) ) {
				$main_classes[] = 'big-col-right';
			}

			if ( ! empty( $block['block_options']['text_style'] ) && 'light' == $block['block_options']['text_style'] ) {
				$main_classes[] = 'is-light-text';
			}

			if ( ! empty( $block['block_options']['background'] ) && '#ffffff' != strtolower( esc_attr( $block['block_options']['background'] ) ) ) {
				$main_classes[] = 'is-background';
			}

			if ( ! empty( $block['block_options']['background_image'] ) ) {
				$main_classes[] = 'is-background is-background-image';
			} */

			/* if ( 'full_width' == $block['block_type'] ) {
				if ( isset( $block['block_options']['wrap_mode'] ) && empty( $block['block_options']['wrap_mode'] ) ) {
					$main_classes[] = 'is-fullwidth';
				} else {
					$main_classes[]  = 'is-wrapper';
					//$inner_classes[] = 'container';
				}
			} */

			$main_classes  = implode( ' ', $main_classes );
			//$inner_classes = implode( ' ', $inner_classes );

			if ( ! empty( $data_query ) && is_object( $data_query ) ) {
				$ajax_param = self::block_ajax_param( $block, $data_query );
			}


			$str = '';

			$str .= '<div id="' . esc_attr( $block['block_id'] ) . '" class="' . esc_attr( $main_classes ) . '" ' . esc_attr( $ajax_param ) . '>';
			//$str .= '<div class="' . esc_attr( $inner_classes ) . '">';

			return $str;
		}



		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $block
		 *
		 * @return string
		 * render block header
		 */
		static function block_header( $block ) {

			//check title
			if ( empty( $block['block_options']['title'] ) ) {
				return false;
			}
			
			
			$block_icon = '';
			if ( !empty( $block['block_options']['icon'] ) ) {
				$block_icon = $block['block_options']['icon'];
			}
			/* else{
				$block_icon = apply_filters('block_header_icon' , 'fa-box');
			} */


			$str = '';
			//$str .= '<div class="block-header-wrap">';
			$str .= '<div class="block-title'.( empty($block['block_options']['title_url']['url']) ? '':' has_url' ).'"><div class="title">'.$block_icon;
			$str .= esc_html( $block['block_options']['title'] );
			$str .= '</div>';
			if( !empty($block['block_options']['title_url']['url']) ){
				$target = $block['block_options']['title_url']['is_external'] == 'on' ? ' target="_blank"' : '';
				$rel_a = $block['block_options']['title_url']['nofollow'] == 'on' ? ' rel="nofollow"' : '';
				$str .= '<a href="' . esc_url( $block['block_options']['title_url']['url'] ) . '" class="bk_view_more"'.$target.$rel_a.' title="' . esc_attr( $block['block_options']['title'] ) . '"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-left-1"></use></svg>مشاهده همه</a>';
			}
			
			$str .= self::block_ajax_filter( $block );
			//$str .= '</div>';
			$str .= '</div>';

			return $str;
		}



		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $block
		 *
		 * @return string
		 * render block footer
		 */
		static function block_footer( $block ) {

			//check and return
			if ( empty( $block['block_options']['pagination'] ) && empty( $block['block_options']['viewmore'] ) ) {
				return false;
			}

			$str = '';
			$str .= '<div class="block-footer clearfix">';

			//render ajax pagination
			if ( ! empty( $block['block_options']['pagination'] ) && 'next_prev' == $block['block_options']['pagination'] ) {
				$str .= self::block_ajax_next_prev();
			} elseif ( ! empty( $block['block_options']['pagination'] ) && 'loadmore' == $block['block_options']['pagination'] ) {
				$str .= self::block_ajax_loadmore();
			} elseif ( ! empty( $block['block_options']['pagination'] ) && 'infinite_scroll' == $block['block_options']['pagination'] ) {
				$str .= self::block_ajax_infinite_scroll();
			}

			$str .= '</div>';

			return $str;
		}



		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $block
		 * @param $data_query
		 *
		 * @return string
		 * render block ajax param
		 */
		static function block_ajax_param( $block, $data_query ) {
			
			$bk_param = false;
			if(empty($block['block_options']['bk_param']))
				$bk_param = true;
				
			//check
			if ( empty( $block['block_options'] ) || empty( $block['block_name'] ) || empty( $block['block_id'] ) || ( empty( $block['block_options']['pagination'] ) && empty( $block['block_options']['ajax_dropdown'] ) && $bk_param )  ) {
				return false;
			}

			$str                      = '';
			$param                    = array();
			$block_options            = $block['block_options'];
			$param['data-block_id']   = $block['block_id'];
			$param['data-block_name'] = $block['block_name'];

			//post type
			if ( ! empty( $block_options['post_type'] ) ) {
				$param['data-post_type'] = $block_options['post_type'];
			}else{
				$param['data-post_type'] = 'post';
			}
			
			//post per page
			if ( ! empty( $block_options['posts_per_page'] ) ) {
				$param['data-posts_per_page'] = $block_options['posts_per_page'];
			}

			//ajax filter type
			if ( ! empty( $block_options['ajax_dropdown'] ) ) {
				$param['data-ajax_dropdown'] = $block_options['ajax_dropdown'];
			}

			//max page
			if ( ! empty( $data_query->max_num_pages ) ) {
				$param['data-block_page_max'] = $data_query->max_num_pages;
			} else {
				$param['data-block_page_max'] = 1;
			}

			//current page
			$param['data-block_page_current'] = 1;

			//excerpt
			if ( ! empty( $block_options['excerpt'] ) ) {
				$param['data-excerpt'] = $block_options['excerpt'];
			}

			//classic summary type
			if ( ! empty( $block_options['summary_type'] ) ) {
				$param['data-summary_type'] = $block_options['summary_type'];
			}

			//classic excerpt
			if ( ! empty( $block_options['excerpt_classic'] ) ) {
				$param['data-excerpt_classic'] = $block_options['excerpt_classic'];
			}

			//category
			if ( ! empty( $block_options['category_id'] ) ) {
				$param['data-category_id'] = $block_options['category_id'];
			}
			
			//row
			if ( ! empty( $block_options['column_in_row'] ) ) {
				$param['data-column_in_row'] = $block_options['column_in_row'];
			}

			//categories
			if ( ! empty( $block_options['category_ids'] ) && is_array( $block_options['category_ids'] ) ) {
				$param['data-category_ids'] = implode( ',', $block_options['category_ids'] );
			}

			//orderby
			if ( ! empty( $block_options['orderby'] ) ) {
				$param['data-orderby'] = $block_options['orderby'];
			}

			//author
			if ( ! empty( $block_options['authors'] ) ) {
				$param['data-authors'] = $block_options['authors'];
			}

			if ( ! empty( $block_options['post_format'] ) ) {
				$param['data-post_format'] = $block_options['post_format'];
			}

			//tag
			if ( ! empty( $block_options['tags'] ) ) {
				$param['data-tags'] = $block_options['tags'];
			}

			if ( ! empty( $block_options['offset'] ) ) {
				$param['data-offset'] = $block_options['offset'];
			}

			if ( ! empty( $block_options['block_style'] ) ) {
				$param['data-block_style'] = $block_options['block_style'];
			}

			if ( ! empty( $block_options['thumb_position'] ) ) {
				$param['data-thumb_position'] = $block_options['thumb_position'];
			}

			if ( ! empty( $block_options['share'] ) ) {
				$param['data-share'] = $block_options['share'];
			}

			if ( ! empty( $block_options['cat_info'] ) ) {
				$param['data-cat_info'] = $block_options['cat_info'];
			}

			if ( ! empty( $block_options['meta_info'] ) ) {
				$param['data-meta_info'] = $block_options['meta_info'];
			}
			
			if ( ! empty( $block_options['slider'] ) ) {
				$param['data-slider'] = wp_json_encode($block_options['slider']);
			}
			
			if ( ! empty( $block_options['other'] ) ) {
				$param['data-other'] = wp_json_encode($block_options['other']);
			}

			//foreach
			foreach ( $param as $k => $v ) {
				if ( ! empty( $k ) ) {
					$str .= esc_attr( $k ) . '= ' . esc_attr( $v ) . ' ';
				}
			}

			return $str;
		}



		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $block
		 *
		 * @return string
		 * render block ajax filter
		 */
		static function block_ajax_filter( $block ) {

			if ( empty( $block['block_options']['ajax_dropdown'] ) ) {
				return false;
			}

			if ( empty( $block['block_id'] ) ) {
				$block['block_id'] = '';
			}

			if ( ! isset( $block['block_options']['ajax_dropdown_id'] ) ) {
				$block['block_options']['ajax_dropdown_id'] = '';
			}

			if ( ! isset( $block['block_options']['ajax_dropdown_text'] ) ) {
				$block['block_options']['ajax_dropdown_text'] = '';
			};
			
			
			if ( ! isset( $block['block_options']['post_type'] ) ) {
				$block['block_options']['post_type'] = 'post';
			};

			$filter_type = $block['block_options']['ajax_dropdown'];
			$filter_ids  = $block['block_options']['ajax_dropdown_id'];
			$filter_text = $block['block_options']['ajax_dropdown_text'];
			$filter_post = $block['block_options']['post_type'];

			
			$ajax_filter_data    = mweb_theme_ajax_filter_dropdown_config( $filter_type, $filter_ids, $filter_text , $filter_post );
			$ajax_filter_id      = 'ajax_filter_' . $block['block_id'];
			$ajax_filter_id_list = 'ajax_filter_list_' . $block['block_id'];

			//render
			$str = '';
			$str .= '<div id="' . esc_attr( $ajax_filter_id ) . '" class="block-ajax-filter-wrap">';
			$str .= '<div class="block-ajax-filter-inner">';

			//ajax filter list
			$str .= '<ul id="' . esc_attr( $ajax_filter_id_list ) . '" class="ajax-filter-list">';
			foreach ( $ajax_filter_data as $item ) {
				$str .= '<li class="ajax-filter-el">';
				$str .= '<a href="#" class="ajax-link ajax-filter-link" data-ajax_filter_val="' . esc_attr( $item['id'] ) . '">';
				$str .= esc_html( $item['name'] );
				$str .= '</a>';
				$str .= '</li>';
			}
			$str .= '</ul>';
			$str .= '<div class="ajax-filter-dropdown">';

			//ajax filter more
			$str .= '<div class="ajax-filter-more" aria-haspopup="true">';
			$str .= '<span>بیشتر</span>';
			$str .= '<i><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-down-1"></use></svg></i>';
			$str .= '</div>';

			//ajax filter dropdown
			$str .= '<ul class="ajax-filter-dropdown-list">';

			$str .= '</ul>';

			$str .= '</div>';

			$str .= '</div>';
			$str .= '</div>';

			return $str;
		}



		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * render ajax next prev pagination
		 */
		static function block_ajax_next_prev() {
			$str = '';
			$str .= '<div class="ajax-pagination ajax-nextprev clearfix">';
			$str .= '<a href="#" class="ajax-pagination-link ajax-link ajax-next" data-ajax_pagination_link ="next"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-right-1"></use></svg> بعد</a>';
			$str .= '<a href="#" class="ajax-pagination-link ajax-link ajax-prev is-disable" data-ajax_pagination_link ="prev"> قبل<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-left-1"></use></svg></a>';
			$str .= '</div>';

			return $str;
		}



		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * render ajax load more
		 */
		static function block_ajax_loadmore() {
			$str = '';
			$str .= '<div class="ajax-pagination ajax-loadmore clearfix">';
			$str .= '<a href="#" class="ajax-loadmore-link ajax-link"><span>بارگذاری بیشتر</span></a>';
			$str .= '<div class="ajax-animation"><span class="ajax-animation-icon"></span></div>';
			$str .= '</div>';

			return $str;
		}



		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * render ajax load more
		 */
		static function block_ajax_infinite_scroll() {
			$str = '';
			$str .= '<div class="ajax-pagination ajax-infinite-scroll clearfix">';
			$str .= '<div class="ajax-animation"><span class="ajax-animation-icon"></span></div>';
			$str .= '</div>';

			return $str;
		}



		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param string $classes
		 *
		 * @return string
		 * open block content wrap
		 */
		static function block_content_open( $classes = '' ) {

			$class_name   = array();
			$class_name[] = 'block-content-inner clear';
			if ( ! empty( $classes ) ) {
				$class_name[] = $classes;
			}

			$class_name = implode( ' ', $class_name );

			$str = '';
			$str .= '<div class="block-content-wrap">';
			$str .= '<div class="' . esc_attr( $class_name ) . '">';

			return $str;
		}



		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * close block content
		 */
		static function block_content_close() {
			return '</div></div>';
		}



		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * close block
		 */
		static function block_close() {
			return '</div>';
		}

		
	}
}


/**-------------------------------------------------------------------------------------------------------------------------
 * @param array
 *
 * @return string
 *  get post for block
 */
function mweb_blog_listing( $query_data, $options = array() ) {

	$str = '';
	$total = $query_data->post_count;

	if ( empty($total) ) {
		return mweb_not_enough_post( 1 );
	}
	$block_style = explode('__', $options['block_style']);
	$loop_name = 'mweb_loop_template_'.$block_style[0];
	$column_in_row = explode('_', $options['column_in_row']);

	while ( $query_data->have_posts() ) : 
		$query_data->the_post(); 

		$str .= '<div class="item col-'. 12 / $column_in_row[0] .' col-sm-'. 12 / $column_in_row[1].' col-lg-'. 12 / $column_in_row[2] .'">';
		$str .=  $loop_name(array('thumbnail' => $block_style[1]));
		$str .= '</div>';
		
	endwhile;	  
	
	return $str;

}





/**-------------------------------------------------------------------------------------------------------------------------
 * @param array
 *
 * @return string
 *  get post for block
 */
function mweb_onsale_product_timeline( $query_data, $options = array() ) {

	$str = '';
	$total = $query_data->post_count;

	if ( empty($total) ) {
		return mweb_no_content();
	}
	
	$column_in_row = explode('_', $options['column_in_row']);
	$str .= '<div class="row">';
		while ( $query_data->have_posts() ) : 
			$query_data->the_post(); 

			$str .= '<div class="item item_simple col-'. 12 / $column_in_row[0] .' col-sm-'. 12 / $column_in_row[1].' col-lg-'. 12 / $column_in_row[2] .'">';
			$str .=  mweb_loop_template_product_simple_h(array('is_deal' => true, 'hide_star_rate' => true));
			$str .= '</div>';
			
		endwhile;	  
	$str .= '</div>';
	return $str;

}



/**-------------------------------------------------------------------------------------------------------------------------
 * @param array
 *
 * @return string
 *  get post for block
 */
function mweb_product_list_tab( $query_data, $options = array() ) {

	$str = '';
	$total = $query_data->post_count;

	if ( empty($total) ) {
		return mweb_no_content();
	}
	
	$block_style = explode('__', $options['block_style']);
	$loop_name = 'mweb_loop_template_product_'.$block_style[0];
	
	$column_in_row = explode('_', $options['column_in_row']);

	while ( $query_data->have_posts() ) : 
		$query_data->the_post(); 

		$str .= '<div class="item col-'. 12 / $column_in_row[0] .' col-sm-'. 12 / $column_in_row[1].' col-lg-'. 12 / $column_in_row[2] .'">';
		$str .=  $loop_name(array('thumbnail' => $block_style[1]));
		$str .= '</div>';
		
	endwhile;	  
	return $str;

}




/**-------------------------------------------------------------------------------------------------------------------------
 * @param array
 *
 * @return string
 *  get post for block
 */
function mweb_product_list_tab_v( $query_data, $options = array() ) {

	$str = '';
	$total = $query_data->post_count;

	if ( empty($total) ) {
		return mweb_no_content();
	}
	
	
	$arrow_right = 'arrow-right-1';
	$arrow_left = 'arrow-left-1';	
	$attr_class = 'swiper swiper_vtabs';
	
	$slider_data = wp_doing_ajax() ? stripslashes($options['slider']) : wp_json_encode($options['slider']) ;
	//$slider_data = wp_json_encode($options['slider']) ;
	
	$block_style = explode('__', $options['block_style']);
	//$loop_name = 'mweb_loop_template_'.$block_style[0];
	
	$is_mobile = wp_is_mobile();
	$loop_type = $is_mobile == true ? 'mweb_loop_template_product_mobile' : 'mweb_loop_template_product_general';
	$unique_id = wp_unique_id();
	
	$str .= '<div class="'.$attr_class.'" dir="rtl" data-slider="'.esc_attr($slider_data).'" id="sl_'.$unique_id.'"><div class="swiper-wrapper">';

	while ( $query_data->have_posts() ) : 
		$query_data->the_post(); 

		$str .= '<div class="swiper-slide"><div class="item">';
		$str .=  $loop_type(array('thumbnail' => $block_style[1]));
		$str .= '</div></div>';
		
	endwhile;	  
	
	$str .= '</div>';
	$str .= '<div class="mweb-swiper-next"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#'.$arrow_right.'"></use></svg></div><div class="mweb-swiper-prev"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#'.$arrow_left.'"></use></svg></div>';
	$str .=	'</div>';
		
		
	return $str;

}



/**-------------------------------------------------------------------------------------------------------------------------
 * @param array
 *
 * @return string
 *  get post for block
 */
function mweb_product_listing( $query_data, $options = array() ) {
	
	$str = '';
	$total = $query_data->post_count;

	if ( empty($total) ) {
		return mweb_not_enough_post( 1 );
	}
	
	$block_style = explode('__', $options['block_style']);
	$loop_name = 'mweb_loop_template_product_'.$block_style[0];
	
	$column_in_row = explode('_', $options['column_in_row']);

	while ( $query_data->have_posts() ) : 
		$query_data->the_post(); 

		$str .= '<div class="item col-'. 12 / $column_in_row[0] .' col-sm-'. 12 / $column_in_row[1].' col-lg-'. 12 / $column_in_row[2] .'">';
		$str .=  $loop_name(array('thumbnail' => $block_style[1]));
		$str .= '</div>';
		
	endwhile;	  
	
	return $str;
	
}




/**-------------------------------------------------------------------------------------------------------------------------
 * @param array
 *
 * @return string
 *  get post for block
 */
function mweb_product_list_as_table( $query_data, $settings = array() ) {
	
	$str = '';
	$total = $query_data->post_count;

	if ( empty($total) ) {
		return mweb_not_enough_post( 1 );
	}
	$temp = get_wc_attribute_taxonomies();
	$settings = wp_doing_ajax() && isset($settings['other']) ? json_decode(stripslashes( $settings['other'] ), true) : $settings;
	
	$product_attribute = @$settings['attributes'];
	
	ob_start();
		
	echo '<table class="product_list_table elm_table'. ( $settings['has_icon'] ? ' elm_bthas_title' : '' ) .'">';
		echo '<thead><tr>';
			if($settings['product_photo'] == 'yes')
				echo '<th class="th_img">عکس</th>';
			if($settings['product_sku'] == 'yes')
				echo '<th class="th_sku">کد</th>';
			echo '<th class="th_title">نام</th>';
			if(!empty($product_attribute)){
				foreach((array) $product_attribute as $attr){
					echo '<th class="th_attribute">'.$temp[$attr].'</th>';
				}
			}
			if($settings['product_unit'] == 'yes')
				echo '<th class="th_unit">واحـد</th>';
			if($settings['product_price'] == 'yes')
				echo '<th class="th_price">قیمت</th>';
			if($settings['product_chart'] == 'yes' || $settings['product_buy'] == 'yes')
				echo '<th class="th_action">عملیات</th>';
		
		echo '</tr></thead>';
		echo '<tbody>';

		while ( $query_data->have_posts() ) : $query_data->the_post();
			
			global $product;
			
			$product_id = get_the_ID();
			
			echo '<tr>';
			
			if($settings['product_photo'] == 'yes')
				echo '<td class="td_img">'. woocommerce_get_product_thumbnail('simplev') .'</td>';
			
			if($settings['product_sku'] == 'yes'){
				$prd_sku = $product->get_sku();
				echo '<td class="td_sku'. (empty($prd_sku) ? ' hide_mobile' : '') .'" data-title="شناسه">'.$prd_sku.'</td>';
			}
				
			
			echo '<td class="td_title" data-title="عنوان"><a href="'.get_permalink().'">'.get_the_title().'</a></td>';
			
			if(!empty($product_attribute)){
				foreach((array) $product_attribute as $attr){
					$terms = wc_get_product_terms( $product_id, 'pa_'.$attr, array( 'fields' => 'all' ) );
					$attr_tax = '';
					if(!empty($terms)){
						foreach($terms as $tax ){
							$attr_tax .= '<span>'.$tax->name.'</span>';
						}
					}
					echo '<td class="td_attribute'. (empty($attr_tax) ? ' hide_mobile' : '') .'" data-title="'.$temp[$attr].'">'.$attr_tax.'</td>';
				}
			}
			
			if($settings['product_unit'] == 'yes'){
				$prd_unit = get_post_meta( $product_id, '_product_unit', true );
				echo '<td class="td_unit'. (empty($prd_unit) ? ' hide_mobile' : '') .'" data-title="واحد">'.$prd_unit.'</td>';
			}
			
			if($settings['product_price'] == 'yes'){
				$my_flag = '';
				$my_price_old = mweb_last_price_data($product_id);
				if(!empty($my_price_old)){
					$old_price = $product->is_on_sale() ? $product->get_regular_price() : $my_price_old->price;
					$current_price = $product->is_on_sale() ? $product->get_sale_price() : $product->get_regular_price();
					if(!empty($current_price)){
						$my_attr = empty($my_price_old->date) || $product->is_on_sale() ? ' data-original-title="فروش ویژه" title="فروش ویژه" data-toggle="tooltip"' : ' data-original-title="نسبت به تاریخ '.$my_price_old->date.'" title="نسبت به تاریخ '.$my_price_old->date.'" data-toggle="tooltip"';
						//$my_flag = '<i class="fal fa-equals"'.$my_attr.'></i>';
						$my_flag = '';
						if($current_price > $old_price){
							$my_flag = '<div class="elm_td_svg" '.$my_attr.'><svg class="pack-theme trend_up" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#trend-up"></use></svg></div>';
						}elseif($current_price < $old_price){
							$my_flag = '<div class="elm_td_svg" '.$my_attr.'><svg class="pack-theme trend_down" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#trend-down"></use></svg></div>';
						}
					}
				}
				
				echo '<td class="td_price" data-title="قیمت">'.$my_flag.'<span class="price tb_price">'. $product->get_price_html() .'</span></td>';
			}
				
			if($settings['product_chart'] == 'yes' || $settings['product_buy'] == 'yes'){
				$my_action = '';
				$show_price_chart = get_post_meta($product_id, '_show_price_chart' , true);
				if($settings['product_chart'] == 'yes' && $show_price_chart == 'yes' && !empty($my_price_old))
					$my_action .= '<a href="javascript:void(0);" class="btn btn_price_chart" data-product_id="'.$product_id.'" title="نمودار قیمت" data-toggle="tooltip"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#chart-2"></use></svg></a>';
				
				if($settings['product_buy'] == 'yes'){
					if($settings['product_buy_type'] == 'yes' || wp_is_mobile()){
						$my_action .= '<a href="'.esc_url(get_permalink()).'" class="btn tb_btn_buy" data-product_id="'.$product_id.'" title="خرید"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#add"></use></svg></a>';						
					}else{
						$my_action .= '<a href="javascript:void(0);" class="btn quickview-btn" data-toggle="tooltip" data-product_id="'.$product_id.'" title="خرید"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#add"></use></svg></a>';
					}
				}
				echo '<td class="td_action" data-title="عملیات">'.$my_action.'</td>';
			}

			echo '</tr>';
		endwhile;

	echo '</tbody>
		</table>';

	$str .= ob_get_clean();
	return $str;
	
}

