<?php
/**
 * @param $options
 * @return string
 * render module blog archive
 */
if ( ! function_exists( 'mweb_loop_template_blog_archive' ) ) {
	function mweb_loop_template_blog_archive( $options = array() ) {

		$str = '<div class="inner_wrap list_blog_item">';

		$str .= '<div class="blog_top">';
			$str .= mweb_get_single_post_comment_count();
			$str .= mweb_get_single_post_icon();
			$str .= '<h2 class="blog_title">'. mweb_post_title() .'</h2>';
		$str .= '</div>';

		$str .= '<div class="blog_body">';
		$str .= '<div class="row"><div class="col-12 col-sm-4 col-md-4">';
			if ( has_post_thumbnail() ) {

				$param             		= array();
				$param['size']     		= 'blog_archive';
				$param['has_link'] 		= true;
				//$param['size_mobile_h'] = 'mweb_crop_380x380';
				//$param['size_mobile']   = 'mweb_crop_364x225';

				$str .= mweb_post_thumb( $param );

			} else {
				$str .= mweb_post_no_thumbnail();
			}
		$str .= '</div><div class="col-12 col-sm-8 col-md-8">';
		$str .= '<div class="desc">'. mweb_get_post_excerpt(40) .'</div>';
		$str .= '</div>';
		$str .= '</div>';
		$str .= '</div>';

		$str .= '<div class="blog_bottom">';
			$str .= mweb_get_single_post_author();
			$str .= mweb_get_single_post_date();
			$str .= '<a href="'. get_permalink() .'" rel="bookmark" data-original-title="ادامه ..." data-toggle="tooltip" class="read_more"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#link"></use></svg></a>';
		$str .= '</div>';

		$str .= '</div>';

		return $str;
	}
}





/**
 * @param $options
 * @return string
 * render module blog one
 */
if ( ! function_exists( 'mweb_loop_template_blog_1' ) ) {
	function mweb_loop_template_blog_1( $options = array('thumbnail' => 'blog_home') ) {

		$str = '<div class="item-area clear">';
		$str .= '<div class="container-inner">';
		if ( has_post_thumbnail() ) {

			$param             		= array();
			$param['size']     		= $options['thumbnail'];
			$param['has_link'] 		= true;
			//$param['size_mobile_h'] = 'mweb_crop_380x380';
			//$param['size_mobile']   = 'mweb_crop_364x225';
			$param['class_name']    = 'post-image';

			$str .= mweb_post_thumb( $param );

		} else {
			$str .= mweb_post_no_thumbnail();
		}
		$str .= '<div class="post-content-inner">';
		$str .= '<div class="post-date"><div class="day"><span>'. get_the_time('j') .'</span></div><div class="month">'. get_the_time('F') .'</div><div class="year">'. get_the_time('Y') .'</div></div>';
		$str .= '<div class="post-detail"><h3 class="post-title">'.mweb_post_title().'</h3></div>';
		$str .= '</div>';
		$str .= '</div>';
		$str .= '</div>';

		return $str;
	}
}





/**
 * @param $options
 * @return string
 * render module blog two
 */
if ( ! function_exists( 'mweb_loop_template_blog_2' ) ) {
	function mweb_loop_template_blog_2( $options = array() ) {

		$str = '';
		//$str = '<div class="item-area clear">';
		//$str .= '<div class="container-inner">';
			$thumbnail = isset($options['thumbnail']) ? $options['thumbnail'] : 'blog_home';

			$featured_img_url = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), $thumbnail) : ''; 
  
			$str .= '<a class="grid_image" style="background-image:url('.esc_url($featured_img_url).')" href="'. esc_attr( get_permalink() ) .'" >';
			$str .= '<h4 class="over_title">'.get_the_title().'</h4>';
			$str .= '</a>'; 

		//$str .= '</div>';
		//$str .= '</div>';

		return $str;
	}
}





/**
 * @param $options
 * @return string
 * render module blog three
 */
if ( ! function_exists( 'mweb_loop_template_blog_3' ) ) {
	function mweb_loop_template_blog_3( $options = array('thumbnail' => 'blog_large') ) {

		$str = '<div class="item-area clear">';
		$str .= '<div class="blog-post-area">';
			if ( has_post_thumbnail() ) {

				$param            	    = array();
				$param['size']     		= 'blog_large';
				$param['has_link'] 		= true;
				//$param['size_mobile_h'] = 'mweb_crop_380x380';
				//$param['size_mobile']   = 'mweb_crop_364x225';

				$str .= mweb_post_thumb( $param );

			} else {
				$str .= mweb_post_no_thumbnail();
			}
			
			$str .= '<div class="blog_category">'. mweb_post_first_cat() .'</div>';
			$str .= '<h4>'. mweb_post_title() .'</h4>';
			$str .= '<div class="post-date">'. get_the_time('j F Y') .'</div>';
			$str .= '<a href="'. esc_attr( get_permalink() ) .'" class="read_more"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-left"></use></svg></a>';

		$str .= '</div>';
		$str .= '</div>';

		return $str;
	}
}





/**
 * @param $options
 * @return string
 * render module blog four
 */
if ( ! function_exists( 'mweb_loop_template_blog_4' ) ) {
	function mweb_loop_template_blog_4( $options = array('thumbnail' => 'thumbnail') ) {

		$str = '<div class="item-area clear">';
		if ( has_post_thumbnail() ) {

			$param             		= array();
			$param['size']     		= $options['thumbnail'];
			$param['has_link'] 		= true;
			//$param['size_mobile_h'] = 'mweb_crop_380x380';
			//$param['size_mobile']   = 'mweb_crop_364x225';
			$param['class_name']    = 'post-image';

			$str .= mweb_post_thumb( $param );

		} else {
			$str .= mweb_post_no_thumbnail();
		}
			$str .= '<div class="bk-content-left">';
				$str .= '<h4>'. mweb_post_title() .'</h4>';
				//$str .= '<div class="desc">'. mweb_get_post_excerpt(25) .'</div>';
				$str .= '<a href="'. esc_attr( get_permalink() ) .'" class="read-more"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-left-1"></use></svg>ادامه مقاله</a>';
				$str .= '<div class="post-date">'. get_the_time('j') . get_the_time('F') . get_the_time('Y') .'</div>';
			$str .= '</div>';
		$str .= '</div>';

		return $str;
	}
}





/**
 * @param $options
 * @return string
 * render module blog five
 */
if ( ! function_exists( 'mweb_loop_template_blog_5' ) ) {
	function mweb_loop_template_blog_5( $options = array() ) {

		$str = '<div class="item-area clear bk_blog_line">';
			$str .= '<h4>'. mweb_post_title() .'</h4>';
			$str .= '<a href="'. esc_attr( get_permalink() ) .'" class="read-more">ادامه ...</a>';
		$str .= '</div>';

		return $str;
	}
}




/**
 * @param $options
 * @return string
 * render module blog six
 */
if ( ! function_exists( 'mweb_loop_template_blog_6' ) ) {
	function mweb_loop_template_blog_6( $options = array('thumbnail' => 'blog_large') ) {

		$str = '<div class="item-area clear">';
		$str .= '<div class="blog-post-area item_blog6">';
			if ( has_post_thumbnail() ) {

				$param            	    = array();
				$param['size']     		= 'blog_large';
				$param['has_link'] 		= true;
				//$param['size_mobile_h'] = 'mweb_crop_380x380';
				//$param['size_mobile']   = 'mweb_crop_364x225';

				$str .= mweb_post_thumb( $param );

			} else {
				$str .= mweb_post_no_thumbnail();
			}
			
			$str .= '<h4>'. mweb_post_title() .'</h4>';
			$str .= '<div class="desc">'. mweb_get_post_excerpt(18) .'</div>';
			$str .= '<div class="post-date">'. get_the_time('j F Y') .'</div>';
			$str .= '<a href="'. esc_attr( get_permalink() ) .'" class="read_more">ادامه مقاله <svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-left"></use></svg></a>';

		$str .= '</div>';
		$str .= '</div>';

		return $str;
	}
}





/**
 * @param $options
 * @return string
 * render module blog seven
 */
if ( ! function_exists( 'mweb_loop_template_blog_7' ) ) {
	function mweb_loop_template_blog_7( $options = array('thumbnail' => 'blog_large') ) {

		$str = '<div class="item-area clear">';
		$str .= '<div class="blog-post-area item_blog7">';
			$str .= '<div class="blog_image">';
			
				if ( has_post_thumbnail() ) {

					$param            	    = array();
					$param['size']     		= 'blog_large';
					$param['has_link'] 		= true;
					$param['nowrap'] 		= true;
					//$param['size_mobile_h'] = 'mweb_crop_380x380';
					//$param['size_mobile']   = 'mweb_crop_364x225';

					$str .= mweb_post_thumb( $param );

				} else {
					$str .= mweb_post_no_thumbnail();
				}
				$str .= '<a href="'. esc_attr( get_permalink() ) .'" class="go_it"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-left"></use></svg></a>';
			$str .= '</div>';
			$str .= '<h4>'. mweb_post_title() .'</h4>';
			$str .= '<div class="desc">'. mweb_get_post_excerpt(16) .'</div>';

		$str .= '</div>';
		$str .= '</div>';

		return $str;
	}
}




/**
 * @param $options
 * @return string
 * render module blog eight
 */
if ( ! function_exists( 'mweb_loop_template_blog_8' ) ) {
	function mweb_loop_template_blog_8( $options = array('thumbnail' => 'blog_large') ) {

		$str = '';
		//$str .= '<div class="item-area clear">';
		$str .= '<div class="blog-post-area item_blog8">';
		$str .= '<div class="blog_image">';
			if ( has_post_thumbnail() ) {

				$param            	    = array();
				$param['size']     		= 'blog_large';
				$param['has_link'] 		= false;
				$param['nowrap'] 		= true;
				//$param['size_mobile_h'] = 'mweb_crop_380x380';
				//$param['size_mobile']   = 'mweb_crop_364x225';

				$str .= mweb_post_thumb( $param );

			} else {
				$str .= mweb_post_no_thumbnail();
			}
			$str .= '</div>';
			$str .= '<div class="blog-content-inner">';
				$str .= '<h4>'. mweb_post_title() .'</h4>';
				$str .= '<div class="desc">'. mweb_get_post_excerpt(15) .'</div>';
				$str .= '<div class="post-date">'. get_the_time('j F Y') .'</div>';
				$str .= '<a href="'. esc_attr( get_permalink() ) .'" class="read_more">ادامه مقاله</a>';
			$str .= '</div>';
		$str .= '</div>';
		//$str .= '</div>';

		return $str;
	}
}




/**
 * @param $options
 * @return string
 * render module blog simple vertical
 */
if ( ! function_exists( 'mweb_loop_template_blog_simple_v' ) ) {
	function mweb_loop_template_blog_simple_v( $options = array('thumbnail' => 'blog_home') ) {

		$str = '<div class="inner_wrap releated_item">';
			if ( has_post_thumbnail() ) {

				$param             		= array();
				$param['size']     		= 'blog_home';
				$param['has_link'] 		= true;
				//$param['size_mobile_h'] = 'mweb_crop_380x380';
				//$param['size_mobile']   = 'mweb_crop_364x225';
				$param['class_name']    = 'post-image';

				$str .= mweb_post_thumb( $param );

			} else {
				$str .= mweb_post_no_thumbnail();
			}
			$str .= '<h3 class="releated_item_title">'.get_the_title().'</h3>';
		$str .= '</div>';
		
		return $str;
		
	}
}





/**
 * @param $options
 * @return string
 * render module blog simple horizontal
 */
if ( ! function_exists( 'mweb_loop_template_blog_simple_h' ) ) {
	function mweb_loop_template_blog_simple_h( $options = array('thumbnail' => 'simplev') ) {

		$str = '<div class="post_with_thumb">';
			if ( has_post_thumbnail() ) {

				$param             		= array();
				$param['size']     		= 'simplev';
				$param['has_link'] 		= true;
				//$param['size_mobile_h'] = 'mweb_crop_380x380';
				//$param['size_mobile']   = 'mweb_crop_364x225';
				$param['class_name']    = 'post-thumb';

				$str .= mweb_post_thumb( $param );

			} else {
				$str .= mweb_post_no_thumbnail();
			}
			$str .= '<div class="inner">'.get_the_title().'</div>';
		$str .= '</div>';
		
		return $str;
		
	}
}





/**
 * @param $options
 * @return string
 * render module slider
 */
if ( ! function_exists( 'mweb_loop_template_slider' ) ) {
	function mweb_loop_template_slider( $options = array('thumbnail' => 'full') ) {

		$mweb_slider_link = get_post_meta( get_the_ID(), 'mweb_slider_link', true );
		
		$str = '<a href="'. esc_url($mweb_slider_link) .'" title="'. mweb_post_title(false) .'" target="_blank">';
			if ( has_post_thumbnail() ) {

				$param             		= array();
				$param['size']     		= $options['thumbnail'];
				$param['has_link'] 		= false;
				//$param['size_mobile_h'] = 'mweb_crop_380x380';
				//$param['size_mobile']   = 'mweb_crop_364x225';

				$str .= mweb_post_thumb( $param );

			} else {
				$str .= mweb_post_no_thumbnail();
			}
		$str .= '</a>';
		
		return $str;
		
	}
}





/**
 * @param $options
 * @return string
 * render module slider 2
 */
if ( ! function_exists( 'mweb_loop_template_slider_2' ) ) {
	function mweb_loop_template_slider_2( $options = array('thumbnail' => 'full') ) {

		$mweb_slider_link = get_post_meta( get_the_ID(), 'mweb_slider_link', true );
		
		$str = '<a class="item-area" href="'. esc_url($mweb_slider_link) .'" title="'. get_the_title() .'" target="_blank">';
			if ( has_post_thumbnail() ) {

				$param             		= array();
				$param['size']     		= $options['thumbnail'];
				$param['has_link'] 		= false;
				//$param['size_mobile_h'] = 'mweb_crop_380x380';
				//$param['size_mobile']   = 'mweb_crop_364x225';
				
				$mobile_vs = get_post_meta( get_the_ID(), 'mweb_slider_mobile', true );
				if( $options['is_mobile'] && ( is_array($mobile_vs) && !empty($mobile_vs['url']) ) ){
					$str .= wp_get_attachment_image($mobile_vs['id'], 'full');
				} else {
					$str .= mweb_post_thumb( $param );
				}
						

			} else {
				$str .= mweb_post_no_thumbnail();
			}
			
			if( $options['title_show'] == true ){
				$str .= '<span>'. get_the_title() .'</span>';
			}
				
		$str .= '</a>';
		
		return $str;
		
	}
}





/**
 * @param $options
 * @return string
 * render module testimonials
 */
if ( ! function_exists( 'mweb_loop_template_testimonial' ) ) {
	function mweb_loop_template_testimonial( $options = array() ) {

		$mweb_testimonial_sub = get_post_meta( get_the_ID(), 'mweb_testimonial_sub', true ); 

		$str = '';
		$str .= '<div class="testimonial_item">';
		$str .= '<div class="testimonial_bottom">';
			if ( has_post_thumbnail() ) {
				$param             		= array();
				$param['size']     		= 'thumb_size_v4';
				$param['has_link'] 		= false;
				//$param['size_mobile_h'] = 'mweb_crop_380x380';
				//$param['size_mobile']   = 'mweb_crop_364x225';
				$param['class_name']    = 'avatar';

				$str .= mweb_post_thumb( $param );

			} else {
				$str .= mweb_post_no_thumbnail();
			}
			$str .= '<div class="clients_author">'. mweb_post_title(false) .'<span>'. $mweb_testimonial_sub .'</span></div>';
		$str .= '</div>';
		$str .= '<div class="testimonial"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#quote-up-square"></use></svg>'. wp_trim_words( get_the_content(), $options['length'] ) .'</div>';
		$str .= '</div>';

		return $str;
		
	}
}





/**
 * @param $options
 * @return string
 * render module product general
 */
if ( ! function_exists( 'mweb_loop_template_product_general' ) ) {
	function mweb_loop_template_product_general( $options = array() ) {
		
		global $product;
		$my_flag = empty($options['flag']) ? true : false;
		$options['thumbnail'] = isset($options['thumbnail']) ? $options['thumbnail'] : 'woocommerce_thumbnail';
		ob_start();
		?>
		<div class="item-area item_general clear <?php if ( $product ) echo $product->get_stock_status(); ?>"> 
			<div class="product-image-area">
				<a class="product-image" href="<?php the_permalink(); ?>">
				<?php
					/**
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked woocommerce_template_loop_product_thumbnail - 10
					 */
					do_action( 'woocommerce_before_shop_loop_item_title' );
					echo mweb_get_product_thumbnail( $options['thumbnail'] );
					echo mweb_loop_product_back_thumbnail( $options['thumbnail'] );
				?>
				</a>
			</div>
			<div class="product-detail-area">
			<?php do_action('loop_item_featured'); ?>
				<?php woocommerce_template_loop_price(); ?>
				<h3 class="product-name"><?php echo mweb_post_title(); ?></h3>
				<div class="actions">
					<?php if ( empty( $options['rating'] ) ) { woocommerce_template_loop_rating(); } ?>
					<ul class="add-to-links">
						<?php mweb_wishlist::mweb_single_add_wishlist(get_the_ID(), 'product', $my_flag); ?>
						<?php if(function_exists('mweb_add_compare_button')) { mweb_add_compare_button(); } ?>
						<li><?php mweb_get_custom_add_to_cart_loop(); ?></li>
					</ul>
				</div>
			</div>
		</div> 
		<?php
		$str = ob_get_contents();
		ob_end_clean();
		return $str;
		
	}
}





/**
 * @param $options
 * @return string
 * render module product general two
 */
if ( ! function_exists( 'mweb_loop_template_product_general_2' ) ) {
	function mweb_loop_template_product_general_2( $options = array() ) {
		
		global $product;
		$my_flag = empty($options['flag']) ? true : false;
		$options['thumbnail'] = isset($options['thumbnail']) ? $options['thumbnail'] : 'woocommerce_thumbnail';
		ob_start();
		?>
		<div class="item-area clear <?php if ( $product ) echo $product->get_stock_status(); ?>"> 
			<div class="product-image-area">
				<?php
					if ( has_post_thumbnail() ) {

						$param             		= array();
						$param['size']     		= $options['thumbnail'];
						$param['has_link'] 		= true;
						//$param['size_mobile_h'] = 'mweb_crop_380x380';
						//$param['size_mobile']   = 'mweb_crop_364x225';
						$param['class_name']    = 'product-image';

						echo mweb_post_thumb( $param );

					} else {
						echo mweb_post_no_thumbnail();
					}
				?>
				
				<?php $sale_html = mweb_get_sale_html(); 
					  if($sale_html)
						  echo $sale_html->html;
					//mweb_woocommerce::mweb_woocommerce_check_stock();
					//mweb_woocommerce::mweb_wc_custom_label(); 
				?>
				<div class="actions">
					<ul class="add-to-links">
						<?php mweb_wishlist::mweb_single_add_wishlist( get_the_ID(), 'product', $my_flag); ?>
						<?php if(function_exists('mweb_add_compare_button')) { mweb_add_compare_button(); } ?>
						<li><?php mweb_get_custom_add_to_cart_loop(); ?></li>
					</ul>
				</div>
			</div> 
			<div class="product-detail-area">
				<?php woocommerce_template_loop_price(); ?>
				<h3 class="product-name"><?php echo mweb_post_title(); ?></h3>
			</div> 
			
		</div>
		<?php
		$str = ob_get_contents();
		ob_end_clean();
		return $str;
		
	}
}





/**
 * @param $options
 * @return string
 * render module product general three
 */
if ( ! function_exists( 'mweb_loop_template_product_general_3' ) ) {
	function mweb_loop_template_product_general_3( $options = array() ) {
		
		global $product;
		$my_flag = empty($options['flag']) ? true : false;
		$options['thumbnail'] = isset($options['thumbnail']) ? $options['thumbnail'] : 'woocommerce_thumbnail';
		ob_start();
		?>
		<div class="item-area elm_pg_3 clear <?php if ( $product ) echo $product->get_stock_status(); ?>"> 
			<div class="product-image-area">
				<a class="product-image" href="<?php the_permalink(); ?>">
				<?php
					/**
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked woocommerce_template_loop_product_thumbnail - 10
					 */
					do_action( 'woocommerce_before_shop_loop_item_title' );
					echo mweb_get_product_thumbnail( $options['thumbnail'] );
					echo mweb_loop_product_back_thumbnail( $options['thumbnail'] );
				?>
				</a>
			</div>
			<div class="product-detail-area">
								<?php
				// بررسی اینکه آیا محصول در دسته 47 یا فرزند آن است
				if ( $product && ( has_term( 47, 'product_cat', $product->get_id() ) || has_term( '', 'product_cat', $product->get_id() ) && has_term( '47', 'product_cat', $product->get_id() ) ) ) {
					// اجرای اکشن 'loop_item_featured' فقط برای این محصولات
					do_action('loop_item_featured');
				}
				?>
				
				<?php $rate = mweb_get_average_rating();
				if( !empty($rate) )
					echo '<span class="elm_p_rate rating-archive"><svg fill="gold" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" viewBox="0 0 940.688 940.688"xml:space="preserve"><g><path d="M885.344,319.071l-258-3.8l-102.7-264.399c-19.8-48.801-88.899-48.801-108.6,0l-102.7,264.399l-258,3.8c-53.4,3.101-75.1,70.2-33.7,103.9l209.2,181.4l-71.3,247.7c-14,50.899,41.1,92.899,86.5,65.899l224.3-122.7l224.3,122.601c45.4,27,100.5-15,86.5-65.9l-71.3-247.7l209.2-181.399C960.443,389.172,938.744,322.071,885.344,319.071z"/></g></svg>'.round($rate, 1).'</span>';
				?>
				<h3 class="product-name"><?php echo mweb_post_title(); ?></h3>
				<div class="flex_row align-items-center">
                    <?php woocommerce_template_loop_price(); ?>
					<?php mweb_get_custom_add_to_cart_loop(); ?>
				</div> 
			</div> 
			
		</div>
		<?php
		$str = ob_get_contents();
		ob_end_clean();
		return $str;
		
	}
}





/**
 * @param $options
 * @return string
 * render module product four
 */
if ( ! function_exists( 'mweb_loop_template_product_general_4' ) ) {
	function mweb_loop_template_product_general_4( $options = array() ) {
		
		global $product;
		$my_flag = empty($options['flag']) ? true : false;
		$options['thumbnail'] = isset($options['thumbnail']) ? $options['thumbnail'] : 'woocommerce_thumbnail';
		ob_start();
		?>
		<div class="item-area elm_pg_4 elm_btn_wa clear <?php if ( $product ) echo $product->get_stock_status(); ?>"> 
			<div class="product-image-area">
				<a class="product-image" href="<?php the_permalink(); ?>">
				<?php
					/**
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked woocommerce_template_loop_product_thumbnail - 10
					 */
					do_action( 'woocommerce_before_shop_loop_item_title' );
					echo mweb_get_product_thumbnail( $options['thumbnail'] );
					echo mweb_loop_product_back_thumbnail( $options['thumbnail'] );
				?>
				</a>
			</div>
			<div class="product-detail-area">
				<?php do_action('loop_item_featured'); ?>
				<h3 class="product-name"><?php echo mweb_post_title(); ?></h3>
				<?php woocommerce_template_loop_price(); ?>
				<div class="actions">
					<ul class="add-to-links">
						<?php mweb_wishlist::mweb_single_add_wishlist(get_the_ID(), 'product', $my_flag); ?>
						<?php if(function_exists('mweb_add_compare_button')) { mweb_add_compare_button(); } ?>
					</ul>
				</div>
			</div>
			<div class="elm_add2c"><?php mweb_get_custom_add_to_cart_loop(true); ?></div>
		</div> 
		<?php
		$str = ob_get_contents();
		ob_end_clean();
		return $str;
		
	}
}





/**
 * @param $options
 * @return string
 * render module product five
 */
if ( ! function_exists( 'mweb_loop_template_product_general_5' ) ) {
	function mweb_loop_template_product_general_5( $options = array() ) {
		
		global $product;
		$my_flag = empty($options['flag']) ? true : false;
		$options['thumbnail'] = isset($options['thumbnail']) ? $options['thumbnail'] : 'woocommerce_thumbnail';
		ob_start();
		?>
		<div class="item-area item_general elm_pg_5 elm_btn_wa clear <?php if ( $product ) echo $product->get_stock_status(); ?>"> 
			<div class="product-image-area">
				<a class="product-image" href="<?php the_permalink(); ?>">
				<?php
					/**
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked woocommerce_template_loop_product_thumbnail - 10
					 */
					do_action( 'woocommerce_before_shop_loop_item_title' );
					echo mweb_get_product_thumbnail( $options['thumbnail'] );
					echo mweb_loop_product_back_thumbnail( $options['thumbnail'] );
				?>
				</a>
			</div>
			<?php do_action('loop_item_featured'); ?>
			<h3 class="product-name"><?php echo mweb_post_title(); ?></h3>
			<div class="elm_tg_plus">
				<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#add-square"></use></svg>
				<div class="actions">
					<?php mweb_get_custom_add_to_cart_loop(true); ?>
					<ul class="add-to-links">
						<?php mweb_wishlist::mweb_single_add_wishlist(get_the_ID(), 'product', $my_flag); ?>
						<?php if(function_exists('mweb_add_compare_button')) { mweb_add_compare_button(); } ?>
					</ul>
				</div>
			</div>
			<?php woocommerce_template_loop_price(); ?>
				
		</div> 
		<?php
		$str = ob_get_contents();
		ob_end_clean();
		return $str;
		
	}
}





/**
 * @param $options
 * @return string
 * render module product six
 */
if ( ! function_exists( 'mweb_loop_template_product_general_6' ) ) {
	function mweb_loop_template_product_general_6( $options = array() ) {
		
		global $product;
		$my_flag = empty($options['flag']) ? true : false;
		$options['thumbnail'] = isset($options['thumbnail']) ? $options['thumbnail'] : 'woocommerce_thumbnail';
		ob_start();
		?>
		<div class="item-area item_general elm_pg_6 clear <?php if ( $product ) echo $product->get_stock_status(); ?>"> 
			<div class="product-image-area">
				<a class="product-image" href="<?php the_permalink(); ?>">
				<?php
					/**
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked woocommerce_template_loop_product_thumbnail - 10
					 */
					do_action( 'woocommerce_before_shop_loop_item_title' );
					echo mweb_get_product_thumbnail( $options['thumbnail'] );
					echo mweb_loop_product_back_thumbnail( $options['thumbnail'] );

				?>
				</a>
			</div>
			<?php do_action('loop_item_featured'); ?>
			<div class="flex_row">
			<?php woocommerce_template_loop_price(); ?>
			<?php $rate = mweb_get_average_rating();
				if( !empty($rate) )
					echo '<span class="elm_p_rate"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#star"></use></svg>'.round($rate, 1).'</span>';
			?>
			</div>
			<h3 class="product-name"><?php echo mweb_post_title(); ?></h3>

			<div class="actions">
				<ul class="add-to-links">
					<?php mweb_wishlist::mweb_single_add_wishlist( get_the_ID(), 'product', $my_flag); ?>
					<?php if(function_exists('mweb_add_compare_button')) { mweb_add_compare_button(); } ?>
					<li><?php mweb_get_custom_add_to_cart_loop(); ?></li>
				</ul>
			</div>
				
		</div> 
		<?php
		$str = ob_get_contents();
		ob_end_clean();
		return $str;
		
	}
}





/**
 * @param $options
 * @return string
 * render module product seven 
 */
if ( ! function_exists( 'mweb_loop_template_product_general_7' ) ) {
	function mweb_loop_template_product_general_7( $options = array() ) {
		
		global $product;
		$my_flag = empty($options['flag']) ? true : false;
		$options['thumbnail'] = isset($options['thumbnail']) ? $options['thumbnail'] : 'woocommerce_thumbnail';
		ob_start();
		?>
		<div class="item-area item_general elm_pg_5 elm_pg_7 elm_btn_wa clear <?php if ( $product ) echo $product->get_stock_status(); ?>"> 
			<div class="product-image-area">
				<a class="product-image" href="<?php the_permalink(); ?>">
				<?php
					/**
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked woocommerce_template_loop_product_thumbnail - 10
					 */
					do_action( 'woocommerce_before_shop_loop_item_title' );
					echo mweb_get_product_thumbnail( $options['thumbnail'] );
					echo mweb_loop_product_back_thumbnail( $options['thumbnail'] );

				?>
				</a>
			</div>
			<?php do_action('loop_item_featured'); ?>
			<h3 class="product-name"><?php echo mweb_post_title(); ?></h3>
			<?php woocommerce_template_loop_price(); ?>
			<div class="actions">
				<?php mweb_get_custom_add_to_cart_loop(true); ?>
				<ul class="add-to-links">
					<?php mweb_wishlist::mweb_single_add_wishlist(get_the_ID(), 'product', $my_flag); ?>
					<?php if(function_exists('mweb_add_compare_button')) { mweb_add_compare_button(); } ?>
				</ul>
			</div>				
		</div> 
		<?php
		$str = ob_get_contents();
		ob_end_clean();
		return $str;
		
	}
}



/**
 * @param $options
 * @return string
 * render module product general eight
 */
if ( ! function_exists( 'mweb_loop_template_product_general_8' ) ) {
	function mweb_loop_template_product_general_8( $options = array() ) {
		
		global $product;
		$my_flag = empty($options['flag']) ? true : false;
		$options['thumbnail'] = isset($options['thumbnail']) ? $options['thumbnail'] : 'woocommerce_thumbnail';
		ob_start();
		?>
		<div class="item-area elm_pg_3 elm_pg_8 elm_brbe clear <?php if ( $product ) echo $product->get_stock_status(); ?>"> 
			<div class="product-image-area">
				<a class="product-image" href="<?php the_permalink(); ?>">
				<?php
					
					echo mweb_get_product_thumbnail( $options['thumbnail'] );
					echo mweb_loop_product_back_thumbnail( $options['thumbnail'] );
				
					mweb_woocommerce_check_stock();
					mweb_wc_custom_label(); 
				?>
				</a>
			</div>
			<div class="product-detail-area">
				<?php do_action('loop_item_featured'); ?>
				<h3 class="product-name"><?php echo mweb_post_title(); ?></h3>
				<div class="flex_row justify-content-between align-items-center">
					<?php $sale_html = mweb_get_sale_html(); 
					  if($sale_html){
						  echo '<span class="elm_offBadge">%'.$sale_html->value.'</span>';
					  }
					?>
					<?php woocommerce_template_loop_price(); ?>
				</div> 
			</div> 
			
		</div>
		<?php
		$str = ob_get_contents();
		ob_end_clean();
		return $str;
		
	}
}



/**
 * @param $options
 * @return string
 * render module product general nine
 */
if ( ! function_exists( 'mweb_loop_template_product_general_9' ) ) {
	function mweb_loop_template_product_general_9( $options = array() ) {
		
		global $product;
		$my_flag = empty($options['flag']) ? true : false;
		$options['thumbnail'] = isset($options['thumbnail']) ? $options['thumbnail'] : 'woocommerce_thumbnail';
		ob_start();
		?>
		<div class="item-area elm_pg_3 elm_pg_9 elm_brbe clear <?php if ( $product ) echo $product->get_stock_status(); ?>"> 
			<div class="product-image-area">
				<a class="product-image" href="<?php the_permalink(); ?>">
				<?php
					/**
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked woocommerce_template_loop_product_thumbnail - 10
					 */
					do_action( 'woocommerce_before_shop_loop_item_title' );
					echo mweb_get_product_thumbnail( $options['thumbnail'] );
					echo mweb_loop_product_back_thumbnail( $options['thumbnail'] );

				?>
				</a>
			</div>
			<div class="product-detail-area">
				<?php do_action('loop_item_featured'); ?>
				<h3 class="product-name"><?php echo mweb_post_title(); ?></h3>
			</div> 
			
		</div>
		<?php
		$str = ob_get_contents();
		ob_end_clean();
		return $str;
		
	}
}




function mweb_loop_template_first_item($data, $has_wrap = true, $btn_data = [] ) {
    if (empty($data['view']) || $data['view'] === 'none') {
        return '';
    }
	
	if( ($data['view'] === 'desktop' && $data['is_mobile'] == true) || ($data['view'] === 'mobile' && $data['is_mobile'] == false) ){
		return '';
	}

    $view_class = '';
    switch ($data['view']) {
        case 'desktop':
            $view_class = 'fitem-desktop';
            break;
        case 'mobile':
            $view_class = 'fitem-mobile';
            break;
        case 'both':
            $view_class = 'fitem-both';
            break;
        default:
            $view_class = 'fitem-inline';
    }
	
	if( !empty($btn_data['text']) ){
		$view_class .= ' fitem-hasbtn';
	}

    $image_url = !empty($data['image']) ? esc_url($data['image']) : '';
    $link = $data['link'];
    $has_link = !empty($link['url']);
	
	if( $has_wrap ){
		echo '<div class="swiper-slide"><div class="item">';
	}

    ob_start();
    ?>
    <div class="item-area elm_citem <?= $data['class'] ?> <?= esc_attr($view_class) ?>">
        <?php if ($has_link): ?>
            <a href="<?= esc_url($link['url']) ?>"
               <?php if (!empty($link['is_external'])) echo 'target="_blank"'; ?>
               <?php if (!empty($link['nofollow'])) echo 'rel="nofollow"'; ?>>
        <?php endif; ?>

        <?php if ($image_url): ?>
            <img src="<?= $image_url ?>" alt="<?= $data['title']; ?>">
        <?php endif; ?>
		
		<?php echo mweb_render_custom_button($btn_data); ?>

        <?php if ($has_link): ?>
            </a>
        <?php endif; ?>
    </div>
    <?php
	
	if( $has_wrap ){
		echo '</div></div>';
	}
	
    return ob_get_clean();
}




/**
 * @param $options
 * @return string
 * render module product realtime
 */
if ( ! function_exists( 'mweb_loop_template_product_realtime' ) ) {
	function mweb_loop_template_product_realtime( $options = array() ) {

		ob_start();
		?>
		<div class="clear realtime_product"> 
			<?php
				if ( has_post_thumbnail() ) {

					$param             		= array();
					//$param['size']     		= 'blog_home';
					$param['has_link'] 		= true;
					//$param['size_mobile_h'] = 'mweb_crop_380x380';
					//$param['size_mobile']   = 'mweb_crop_364x225';
					$param['class_name']    = 'product-image';

					echo mweb_post_thumb( $param );

				} else {
					echo mweb_post_no_thumbnail();
				}
			?>
			<div class="product-detail-area">
				<h3 class="product-name"><?php echo mweb_post_title(); ?></h3>
				<div class="realtime_info">
					<div class="realtime_price"><?php woocommerce_template_loop_price(); ?></div>
					<a class="realtime_more" href="<?php the_permalink(); ?>"><svg viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#shopping-cart"></use></svg></a>
				</div>
			</div>
		</div>
		<?php
		$str = ob_get_contents();
		ob_end_clean();
		return $str;
		
	}
}





/**
 * @param $options
 * @return string
 * render module product realtime
 */
if ( ! function_exists( 'mweb_loop_template_product_realtime_2' ) ) {
	function mweb_loop_template_product_realtime_2( $options = array() ) {

		global $product;
		ob_start();
		?>
		<div class="item realtime_loop_2 <?php if ( $product ) echo $product->get_stock_status(); ?>"> 
			<div class="item-area item_general clear"> 
				<div class="product-image-area">
					<?php
						if ( has_post_thumbnail() ) {

							$param             		= array();
							//$param['size']     		= 'blog_home';
							$param['has_link'] 		= true;
							//$param['size_mobile_h'] = 'mweb_crop_380x380';
							//$param['size_mobile']   = 'mweb_crop_364x225';
							$param['class_name']    = 'product-image';

							echo mweb_post_thumb( $param );

						} else {
							echo mweb_post_no_thumbnail();
						}
					?>
				</div>
				<div class="product-detail-area">
					<h3 class="product-name"><?php echo mweb_post_title(); ?></h3>
					<?php woocommerce_template_loop_price(); ?>
				</div>
			</div> 
		</div> 
		<?php
		$str = ob_get_contents();
		ob_end_clean();
		return $str;
		
	}
}





/**
 * @param $options
 * @return string
 * render module product simple horizontal
 */
if ( ! function_exists( 'mweb_loop_template_product_simple_h' ) ) {
	function mweb_loop_template_product_simple_h( $options = array() ) {
		
		global $product;
		ob_start();
		?>
		<div class="item-area<?php echo !empty( $options['is_deal'] ) ? ' deal_tab ' : ' '; ?>clear <?php if ( $product ) echo $product->get_stock_status(); ?>"> 
			<div class="product-image-area">
				<a data-original-title="نمایش سریع" title="نمایش سریع" data-toggle="tooltip" data-product_id="<?php echo get_the_ID(); ?>" class="quickview-btn" href="#"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#search"></use></svg></a>
			<?php
				if ( has_post_thumbnail() ) {

					$param             		= array();
					$param['size']     		= 'simplev';
					$param['has_link'] 		= true;
					//$param['size_mobile_h'] = 'mweb_crop_380x380';
					//$param['size_mobile']   = 'mweb_crop_364x225';
					$param['class_name']    = 'product-image';

					echo mweb_post_thumb( $param );

				} else {
					echo mweb_post_no_thumbnail();
				}
			?>
			</div>
			<div class="product-detail-area">
				<h2 class="product-name"><?php if(isset($options['number'])) echo '<b>'.$options['number'].'</b>'; ?> <?php echo mweb_post_title(); ?></h2>
				<div class="row">
					<?php woocommerce_template_loop_price(); ?>
					<?php if ( empty( $options['hide_star_rate'] ) ) { ?>
						
							<?php $meta_rating = mweb_get_average_rating(); ?>
							<?php if( $meta_rating > 0 ): ?>
							<div class="el_avarage_rate">
								<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#star"></use></svg>
								<?php echo round( $meta_rating , 1 ); ?>
							</div>
							<?php endif; ?>
						
					<?php } ?>
				</div>
				
			</div>
			
			<?php if ( ! empty( $options['is_deal'] ) ) { ?>
			<span class="deal_label"><?php echo get_post_meta(get_the_ID(), '_discount', true); ?>%</span>
			<?php } else { 
					mweb_woocommerce_check_stock();
				} 
			?>
		
		</div>
		<?php
		$str = ob_get_contents();
		ob_end_clean();
		return $str;
		
	}
}





/**
 * @param $options
 * @return string
 * render module product simple for marquee block
 */
if ( ! function_exists( 'mweb_loop_template_product_marquee' ) ) {
	function mweb_loop_template_product_marquee( $options = array() ) {
		$options['thumbnail'] = isset($options['thumbnail']) ? $options['thumbnail'] : 'thumbnail';
		ob_start();
		?>
		<div class="marquee_item"> 
			<a href="<?php the_permalink(); ?>" title="<?php the_title() ?>">
			<?php
				if ( has_post_thumbnail() ) {

					$param             		= array();
					$param['size']     		= $options['thumbnail'];
					$param['has_link'] 		= false;
					//$param['size_mobile_h'] = 'mweb_crop_380x380';
					//$param['size_mobile']   = 'mweb_crop_364x225';
					//$param['class_name']    = 'product-image';

					echo mweb_post_thumb( $param );

				} else {
					echo mweb_post_no_thumbnail();
				}
			?>
			</a>
		</div>
		<?php
		$str = ob_get_contents();
		ob_end_clean();
		return $str;
		
	}
}





/**
 * @param $options
 * @return string
 * render module product simple horizontal with compare btn
 */
if ( ! function_exists( 'mweb_loop_template_product_simple_compare' ) ) {
	function mweb_loop_template_product_simple_compare() {
		
		ob_start();
		?>
		<div class="item-area clear"> 
			<div class="product-image-area">
			
			<?php
				if ( has_post_thumbnail() ) {

					$param             		= array();
					$param['size']     		= 'simplev';
					$param['has_link'] 		= true;
					//$param['size_mobile_h'] = 'mweb_crop_380x380';
					//$param['size_mobile']   = 'mweb_crop_364x225';
					$param['class_name']    = 'product-image';

					echo mweb_post_thumb( $param );

				} else {
					echo mweb_post_no_thumbnail();
				}
			?>
			
			<?php if(function_exists('mweb_add_compare_button')) { mweb_add_compare_button(get_the_ID(), 'div'); } ?>

			</div>
			<div class="product-detail-area">
				<h2 class="product-name"><?php echo mweb_post_title(); ?></h2>
			</div>
		</div>
		<?php
		$str = ob_get_contents();
		ob_end_clean();
		return $str;
		
	}
}




/**
 * @param $options
 * @return string
 * render module product simple horizontal big
 */
if ( ! function_exists( 'mweb_loop_template_product_simple_big' ) ) {
	function mweb_loop_template_product_simple_big( $options = array() ) {

		global $product;
		ob_start();
		?>
		<div class="item-area clear <?php if ( $product ) echo $product->get_stock_status(); ?>"> 
			<div class="product-image-area">
				<a data-original-title="نمایش سریع" title="نمایش سریع" data-toggle="tooltip" data-product_id="<?php echo get_the_ID(); ?>" class="quickview-btn" href="#"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#search"></use></svg></a>
			<?php
				if ( has_post_thumbnail() ) {

					$param             		= array();
					$param['size']     		= 'simplev_big';
					$param['has_link'] 		= true;
					//$param['size_mobile_h'] = 'mweb_crop_380x380';
					//$param['size_mobile']   = 'mweb_crop_364x225';
					$param['class_name']    = 'product-image';

					echo mweb_post_thumb( $param );

				} 
			
				$sale_html = mweb_get_sale_html(); 
				if( $sale_html )
					echo $sale_html->html;
			?>
			</div>
			<div class="product-detail-area">
				<?php woocommerce_template_loop_price(); ?>
				<h2 class="product-name"><?php echo mweb_post_title(); ?></h2>
			</div>
		</div>
		<?php
		$str = ob_get_contents();
		ob_end_clean();
		return $str;
		
	}
}





/**
 * @param $options
 * @return string
 * render module product general mobile
 */
if ( ! function_exists( 'mweb_loop_template_product_mobile' ) ) {
	function mweb_loop_template_product_mobile( $options = array() ) {
		
		global $product;
		$show_text = !empty($options['flag']) ? false : true;
		ob_start();
		?>
		<div class="item-area item_general general_mobile <?php if ( $product ) echo $product->get_stock_status(); ?>"> 
		<div class="product-image-area">
				<a class="product-image" href="<?php the_permalink(); ?>">
				<?php
					/**
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked woocommerce_template_loop_product_thumbnail - 10
					 */
					add_action( 'woocommerce_before_shop_loop_item_title', 'mweb_template_loop_product_thumbnail', 10);
					do_action( 'woocommerce_before_shop_loop_item_title' );
				?>
				</a>
			</div>
			<div class="product-detail-area">
												<?php
				// بررسی اینکه آیا محصول در دسته 47 یا فرزند آن است
				if ( $product && ( has_term( 47, 'product_cat', $product->get_id() ) || has_term( '', 'product_cat', $product->get_id() ) && has_term( '47', 'product_cat', $product->get_id() ) ) ) {
					// اجرای اکشن 'loop_item_featured' فقط برای این محصولات
					do_action('loop_item_featured');
				}
				?>
				<?php $rate = mweb_get_average_rating();
				if( !empty($rate) )
					echo '<span class="elm_p_rate rating-archive"><svg fill="gold" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" viewBox="0 0 940.688 940.688"xml:space="preserve"><g><path d="M885.344,319.071l-258-3.8l-102.7-264.399c-19.8-48.801-88.899-48.801-108.6,0l-102.7,264.399l-258,3.8c-53.4,3.101-75.1,70.2-33.7,103.9l209.2,181.4l-71.3,247.7c-14,50.899,41.1,92.899,86.5,65.899l224.3-122.7l224.3,122.601c45.4,27,100.5-15,86.5-65.9l-71.3-247.7l209.2-181.399C960.443,389.172,938.744,322.071,885.344,319.071z"/></g></svg>'.round($rate, 1).'</span>';
			?>
				<h3 class="product-name"><?php echo mweb_post_title(); ?></h3>
				<div class="flex_row align-items-center">
                    <?php woocommerce_template_loop_price(); ?>
					<?php mweb_get_custom_add_to_cart_loop(); ?>
				</div> 
			</div> 
		</div> 
		<?php
		$str = ob_get_contents();
		ob_end_clean();
		return $str;
		
	}
}





/**
 * @param $options
 * @return string
 * render module product onsale mobile
 */
if ( ! function_exists( 'mweb_loop_template_product_mobile_onsale' ) ) {
	function mweb_loop_template_product_mobile_onsale( $options = array() ) {
		
		global $product;
		$options['thumbnail'] = isset($options['thumbnail']) ? $options['thumbnail'] : 'woocommerce_thumbnail';
		ob_start();
		?>
		<div class="item special_wrap <?php if ( $product ) echo $product->get_stock_status(); ?>">
			<div class="item-area">
				<h2 class="product-name"><?php echo mweb_post_title(); ?></h2>
				<?php
					if ( has_post_thumbnail() ) {

						$param             		= array();
						$param['size']     		= $options['thumbnail'];
						$param['has_link'] 		= true;
						//$param['size_mobile_h'] = 'mweb_crop_380x380';
						//$param['size_mobile']   = 'mweb_crop_364x225';
						$param['class_name']    = 'image_area';

						echo mweb_post_thumb( $param );

					} else {
						echo mweb_post_no_thumbnail();
					}
					$sale_html = mweb_get_sale_html(); 		
				?>
				<?php woocommerce_template_loop_price(); ?>
				<?php do_action('loop_onsale_item_featured'); ?>
				
				<div class="timer_wrap">
					<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#timer-1"></use></svg>
<?php do_action('loop_onsale_item_featured'); ?>

<?php
global $product;
$deal_end_timestamp = get_post_meta($product->get_id(), '_sale_price_dates_to', true);

if (!empty($deal_end_timestamp)) {
    // گرفتن منطقه زمانی وردپرس
    $timezone = get_option('timezone_string');
    if (!$timezone) {
        $gmt_offset = get_option('gmt_offset');
        $timezone = $gmt_offset ? sprintf('Etc/GMT%+d', -$gmt_offset) : 'UTC';
    }

    // تنظیم منطقه زمانی
    $date = new DateTime();
    $date->setTimestamp($deal_end_timestamp);
    $date->setTimezone(new DateTimeZone($timezone));
    $deal_end_time = $date->format('Y-m-d H:i:s');
} else {
    $deal_end_time = ''; // در صورت نبود تخفیف، مقدار خالی می‌ماند
}
?>

<div class="product-date vc_deal_time" data-date="<?php echo esc_attr($deal_end_time); ?>"></div>
				
				</div>					
				<?php do_action('loop_onsale_item_featured'); ?>
				<h2 class="product-name"><?php echo mweb_post_title(); ?></h2>
				<div class="flex_row align-items-center">
					<a class="get_product" href="<?php the_permalink(); ?>"><svg viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#shopping-cart"></use></svg></a>
					<span class="deal_item_off"><?= !empty($sale_html) ? '%'.$sale_html->value : 0 ; ?></span>
					<?php woocommerce_template_loop_price(); ?>
				</div>
				
			</div>
		</div>
		<?php
		$str = ob_get_contents();
		ob_end_clean();
		return $str;
		
	}
}



/**
 * @param $options
 * @return string
 * render module product onsale mobile two
 */
if ( ! function_exists( 'mweb_loop_template_product_mobile_onsale_2' ) ) {
	function mweb_loop_template_product_mobile_onsale_2( $options = array() ) {
		
		global $product;
		$options['thumbnail'] = isset($options['thumbnail']) ? $options['thumbnail'] : 'woocommerce_thumbnail';
		ob_start();
		?>
		<div class="item special_wrap <?php if ( $product ) echo $product->get_stock_status(); ?>">
			<div class="item-area">
				<?php
					if ( has_post_thumbnail() ) {

						$param             		= array();
						$param['size']     		= $options['thumbnail'];
						$param['has_link'] 		= true;
						//$param['size_mobile_h'] = 'mweb_crop_380x380';
						//$param['size_mobile']   = 'mweb_crop_364x225';
						$param['class_name']    = 'image_area';

						echo mweb_post_thumb( $param );

					} else {
						echo mweb_post_no_thumbnail();
					}
					$sale_html = mweb_get_sale_html(); 		
					
				?>
				<div class="timer_wrap">
					<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#timer-1"></use></svg>
<?php do_action('loop_onsale_item_featured'); ?>

<?php
global $product;
$deal_end_timestamp = get_post_meta($product->get_id(), '_sale_price_dates_to', true);

if (!empty($deal_end_timestamp)) {
    // گرفتن منطقه زمانی وردپرس
    $timezone = get_option('timezone_string');
    if (!$timezone) {
        $gmt_offset = get_option('gmt_offset');
        $timezone = $gmt_offset ? sprintf('Etc/GMT%+d', -$gmt_offset) : 'UTC';
    }

    // تنظیم منطقه زمانی
    $date = new DateTime();
    $date->setTimestamp($deal_end_timestamp);
    $date->setTimezone(new DateTimeZone($timezone));
    $deal_end_time = $date->format('Y-m-d H:i:s');
} else {
    $deal_end_time = ''; // در صورت نبود تخفیف، مقدار خالی می‌ماند
}
?>

<div class="product-date vc_deal_time" data-date="<?php echo esc_attr($deal_end_time); ?>"></div>
				
				</div>					
				<?php do_action('loop_onsale_item_featured'); ?>
				<h2 class="product-name"><?php echo mweb_post_title(); ?></h2>
				<div class="flex_row align-items-center">
					<a class="get_product" href="<?php the_permalink(); ?>"><svg viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#shopping-cart"></use></svg></a>
					<span class="deal_item_off"><?= !empty($sale_html) ? '%'.$sale_html->value : 0 ; ?></span>
					<?php woocommerce_template_loop_price(); ?>
				</div>
				
			</div>
		</div>
		<?php
		$str = ob_get_contents();
		ob_end_clean();
		return $str;
		
	}
}




/**
 * @param $options
 * @return string
 * render module product onsale mobile three
 */
if ( ! function_exists( 'mweb_loop_template_product_mobile_onsale_3' ) ) {
	function mweb_loop_template_product_mobile_onsale_3( $options = array() ) {
		
		global $product;
		$options['thumbnail'] = isset($options['thumbnail']) ? $options['thumbnail'] : 'woocommerce_thumbnail';
		ob_start();
		?>
		<div class="item special_wrap <?php if ( $product ) echo $product->get_stock_status(); ?>">
			<div class="item-area">
				
				<?php
					if ( has_post_thumbnail() ) {

						$param             		= array();
						$param['size']     		= $options['thumbnail'];
						$param['has_link'] 		= true;
						//$param['size_mobile_h'] = 'mweb_crop_380x380';
						//$param['size_mobile']   = 'mweb_crop_364x225';
						$param['class_name']    = 'image_area';

						echo mweb_post_thumb( $param );

					} else {
						echo mweb_post_no_thumbnail();
					}
					$sale_html = mweb_get_sale_html(); 		
					
				?>
				<span class="deal_item_off"><?= !empty($sale_html) ? '%'.$sale_html->value : 0 ; ?></span>
				<div class="timer_wrap">
					<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#timer-1"></use></svg>
					<div class="product-date vc_deal_time" data-date="<?php echo date( 'Y-m-d H:i:s', mweb_deal_countdown_timer('', true, false) ); ?>"></div>					
				</div>					
				<h2 class="product-name"><?php echo mweb_post_title(); ?></h2>
				<div class="flex_row align-items-center">
					<div class="flex_row align-items-center">
						<a class="get_product" href="<?php the_permalink(); ?>"><svg viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#bag-happy"></use></svg></a>
						<p>همین حالا<b>بخــرش</b></p>
					</div>
					<?php woocommerce_template_loop_price(); ?>
				</div>
				
			</div>
		</div>
		<?php
		$str = ob_get_contents();
		ob_end_clean();
		return $str;
		
	}
}




/**
 * @param $options
 * @return string
 * render module product onsale mobile four
 */
if ( ! function_exists( 'mweb_loop_template_product_mobile_onsale_4' ) ) {
	function mweb_loop_template_product_mobile_onsale_4( $options = array() ) {
		
		global $product;
		$options['thumbnail'] = isset($options['thumbnail']) ? $options['thumbnail'] : 'woocommerce_thumbnail';
		ob_start();
		?>
		<div class="item special_wrap <?php if ( $product ) echo $product->get_stock_status(); ?>">
			<div class="item-area">
				
				<?php
					if ( has_post_thumbnail() ) {

						$param             		= array();
						$param['size']     		= $options['thumbnail'];
						$param['has_link'] 		= true;
						//$param['size_mobile_h'] = 'mweb_crop_380x380';
						//$param['size_mobile']   = 'mweb_crop_364x225';
						$param['class_name']    = 'image_area';

						echo mweb_post_thumb( $param );

					} else {
						echo mweb_post_no_thumbnail();
					}
					$sale_html = mweb_get_sale_html(); 		
					
				?>
				
				<div class="timer_wrap">
					<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#timer-1"></use></svg>
					<div class="product-date vc_deal_time" data-date="<?php echo date( 'Y-m-d H:i:s', mweb_deal_countdown_timer('', true, false) ); ?>"></div>					
				</div>					
				<h2 class="product-name"><?php echo mweb_post_title(); ?></h2>
				<div class="flex_row align-items-center">
					<a class="get_product" href="<?php the_permalink(); ?>"><svg viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#bag-happy"></use></svg><span><?= !empty($sale_html) ? '%'.$sale_html->value : 0 ; ?></span></a>
					<?php woocommerce_template_loop_price(); ?>
				</div>
				
			</div>
		</div>
		<?php
		$str = ob_get_contents();
		ob_end_clean();
		return $str;
		
	}
}





/**
 * @param $options
 * @return string
 * render module product general
 */
if ( ! function_exists( 'mweb_loop_template_product_onsale_loop' ) ) {
	function mweb_loop_template_product_onsale_loop( $options = array() ) {
		
		global $product;
		$my_flag = empty($options['flag']) ? true : false;
		$options['thumbnail'] = isset($options['thumbnail']) ? $options['thumbnail'] : 'woocommerce_thumbnail';
		ob_start();
		?>
		<div class="item-area item_general onsale_general clear <?php if ( $product ) echo $product->get_stock_status(); ?>"> 
			<div class="product-image-area">
				<a class="product-image" href="<?php the_permalink(); ?>">
				<?php
					/**
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked woocommerce_template_loop_product_thumbnail - 10
					 */
					do_action( 'woocommerce_before_shop_loop_item_title' );
					echo mweb_get_product_thumbnail( $options['thumbnail'] );
				?>
				</a>
			</div>
			<div class="product-detail-area">
				<?php do_action('loop_onsale_item_featured'); ?>
				<?php woocommerce_template_loop_price(); ?>
				<h3 class="product-name"><?php echo mweb_post_title(); ?></h3>
				<div class="actions">
					<?php woocommerce_template_loop_rating(); ?>
					<ul class="add-to-links">
						<?php mweb_wishlist::mweb_single_add_wishlist(get_the_ID(), 'product', $my_flag); ?>
						<?php if(function_exists('mweb_add_compare_button')) { mweb_add_compare_button(); } ?>
						<li><?php mweb_get_custom_add_to_cart_loop(); ?></li>
					</ul>
				</div>
				<div class="timer_wrap">
					<div class="product-date vc_deal_time" data-date="<?php echo date( 'Y-m-d H:i:s', mweb_deal_countdown_timer('', true, false) ); ?>"></div>					
				</div>
			</div>
		</div> 
		<?php
		$str = ob_get_contents();
		ob_end_clean();
		return $str;
		
	}
}





/**
 * @param $options
 * @return string
 * render module product onsale first
 */
if ( ! function_exists( 'mweb_loop_template_product_onsale_1' ) ) {
	function mweb_loop_template_product_onsale_1( $options = array() ) {
		
		$sale_html = mweb_get_sale_html(); 		
		$options['thumbnail'] = isset($options['thumbnail']) ? $options['thumbnail'] : 'product_deal';
		ob_start();
		?>
		<?php $flag_onsale = mweb_deal_countdown_timer('', false, true); ?>
		<div class="item product-deal<?php echo ( $flag_onsale == false ) ? ' deal_finished' : ' deal_continues'; ?>" data-off="<?= !empty($sale_html) ? $sale_html->value : 0 ; ?>">
			<div class="item-area clear d-flex"> 
				<div class="col-12 col-sm-12 col-md-5 col-lg-4">
					<div class="product-image-area">
						<?php
							if ( has_post_thumbnail() ) {

								$param             		= array();
								$param['size']     		= $options['thumbnail'];
								$param['has_link'] 		= true;
								//$param['size_mobile_h'] = 'mweb_crop_380x380';
								//$param['size_mobile']   = 'mweb_crop_364x225';
								$param['class_name']    = 'product-image';

								echo mweb_post_thumb( $param );

							} else {
								echo mweb_post_no_thumbnail();
							}
						?>
						<?php if($sale_html)
								echo $sale_html->html; ?>
					</div>
				</div>
				<div class="product-detail-area col-12 col-sm-12 col-md-7 col-lg-8">
					<?php woocommerce_template_loop_price(); ?>
					<h2 class="product-name"><?php echo mweb_post_title(); ?></h2>
					<?php woocommerce_template_single_excerpt(); ?>
					<?php do_action('loop_onsale_item_featured'); ?>
					<?php
					if( $flag_onsale == false && !empty( $options['deal_soldout'] ) ){
						echo '<div class="deal_alert rs_time">مهلت فروش ویژه تمام شد</div>';
					}
					if( mweb_get_product_stock() == false && !empty( $options['deal_outofstock'] ) ){
						echo '<div class="deal_alert rs_stock">موجودی محصول تمام شد</div>';
					}
					?>					
					<?php mweb_deal_countdown_timer(); ?>					
					<?php if ( !empty( $options['deal_progress'] ) ) {  mweb_deal_progress_bar(); } ?>
				</div>
			</div>
		</div>
		<?php
		$str = ob_get_contents();
		ob_end_clean();
		return $str;
		
	}
}





/**
 * @param $options
 * @return string
 * render module product onsale two
 */
if ( ! function_exists( 'mweb_loop_template_product_onsale_2' ) ) {
	function mweb_loop_template_product_onsale_2( $options = array() ) {
		
		global $product;
		$my_flag = empty($options['flag']) ? true : false;
		$options['thumbnail'] = isset($options['thumbnail']) ? $options['thumbnail'] : 'woocommerce_thumbnail';
		ob_start();
		?>
		<div class="item">
			<div class="item-area item_general elm_pg_6 clear <?php if ( $product ) echo $product->get_stock_status(); ?>"> 
				<div class="product-image-area">
					<a class="product-image" href="<?php the_permalink(); ?>">
					<?php
						/**
						 * @hooked woocommerce_show_product_loop_sale_flash - 10
						 * @hooked woocommerce_template_loop_product_thumbnail - 10
						 */
						woocommerce_show_product_loop_sale_flash();
						echo mweb_get_product_thumbnail( $options['thumbnail'] );
					?>
					</a>
				</div>
				<?php do_action('loop_onsale_item_featured'); ?>
				<div class="product-date vc_deal_time" data-date="<?php echo date( 'Y-m-d H:i:s', mweb_deal_countdown_timer('', true, false) ); ?>"></div>					
				<div class="flex_row">
				<?php woocommerce_template_loop_price(); ?>
				<?php $rate = mweb_get_average_rating();
					if( !empty($rate) )
						echo '<span class="elm_p_rate"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#star"></use></svg>'.round($rate, 1).'</span>';
				?>
				</div>
				<h3 class="product-name"><?php echo mweb_post_title(); ?></h3>

				<div class="actions">
					<ul class="add-to-links">
						<?php mweb_wishlist::mweb_single_add_wishlist( get_the_ID(), 'product', $my_flag); ?>
						<?php if(function_exists('mweb_add_compare_button')) { mweb_add_compare_button(); } ?>
						<li><?php mweb_get_custom_add_to_cart_loop(); ?></li>
					</ul>
				</div>
		
			</div> 
		</div> 
		<?php
		$str = ob_get_contents();
		ob_end_clean();
		return $str;
		
	}
}



/**
 * @param $options
 * @return string
 * render module product onsale three
 */
if ( ! function_exists( 'mweb_loop_template_product_onsale_3' ) ) {
	function mweb_loop_template_product_onsale_3( $options = array() ) {
		
		$sale_html = mweb_get_sale_html(); 		
		$options['thumbnail'] = isset($options['thumbnail']) ? $options['thumbnail'] : 'product_deal';
		ob_start();
		?>
		<?php $flag_onsale = mweb_deal_countdown_timer('', false, true); ?>
		<div class="item deal_new<?php echo ( $flag_onsale == false ) ? ' deal_finished' : ' deal_continues'; ?>" data-off="<?= !empty($sale_html) ? $sale_html->value : 0 ; ?>">
			<div class="item-area clear d-flex"> 
				<div class="product-image-area">
					<span class="deal_title">شـگفت انگیـز</span>
					<?php
						if ( has_post_thumbnail() ) {

							$param             		= array();
							$param['size']     		= $options['thumbnail'];
							$param['has_link'] 		= true;
							//$param['size_mobile_h'] = 'mweb_crop_380x380';
							//$param['size_mobile']   = 'mweb_crop_364x225';
							$param['class_name']    = 'product-image';

							echo mweb_post_thumb( $param );

						} else {
							echo mweb_post_no_thumbnail();
						}
					?>
					<?php if($sale_html)
							echo $sale_html->html; ?>
				</div>
				<div class="product-detail-area">
					<h2 class="product-name"><?php echo mweb_post_title(); ?></h2>
					<?php woocommerce_template_single_excerpt(); ?>	
					<div class="flex_row">
						<?php woocommerce_template_loop_price(); ?>
						<a class="btn_p_link" href="<?php the_permalink(); ?>"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#bag-2"></use></svg></a>

					</div>
					<div class="product-date" data-date="<?php echo date( 'Y-m-d H:i:s', mweb_deal_countdown_timer('', true, false) ); ?>"></div>					
					<?php mweb_deal_progress_bar(); ?>
					<?php //if ( !empty( $options['deal_progress'] ) ) {  mweb_deal_progress_bar(); } ?>

				</div>
			</div>
		</div>
		<?php
		$str = ob_get_contents();
		ob_end_clean();
		return $str;
		
	}
}



/**
 * @param $options
 * @return string
 * render module product wishlist 
 */
if ( ! function_exists( 'mweb_loop_template_product_wishlist' ) ) {
	function mweb_loop_template_product_wishlist( $options = array() ) {
		
		ob_start();
		?>
		<div class="item-area item_general general_mobile"> 
			<div class="product-image-area">
				<a class="product-image" href="<?php the_permalink(); ?>">
				<?php
					if ( has_post_thumbnail() ) {

						$param             		= array();
						$param['size']     		= 'woocommerce_thumbnail';
						$param['has_link'] 		= false;
						//$param['size_mobile_h'] = 'mweb_crop_380x380';
						//$param['size_mobile']   = 'mweb_crop_364x225';
						//$param['class_name']    = 'product-image';

						echo mweb_post_thumb( $param );

					} else {
						echo mweb_post_no_thumbnail();
					}
				?>
				</a>
			</div>
			<div class="product-detail-area">
				<h3 class="product-name"><?php the_title(); ?></h3>
				<div class="wishlist_act">
					<a class="wl_goto_p" href="<?php the_permalink(); ?>" target="_blank">مشاهده</a>
					<div class="add_to_wishlist_wrap"><a href="#" data-action="wl_remove" data-product-id="<?= get_the_ID() ?>" class="add_to_wishlist single_add_to_wishlist user_logged" title="حذف از علاقه مندی ها">حذف</a></div>
				</div>
			</div>
		</div> 
		<?php
		$str = ob_get_contents();
		ob_end_clean();
		return $str;
		
	}
}





/**
 * @param $options
 * @return string
 * render module product wishlist 
 */
if ( ! function_exists( 'mweb_loop_template_product_buy_later' ) ) {
	function mweb_loop_template_product_buy_later( $options = array() ) {
		global $product;
		
		ob_start();
		?>
		<div class="item-area item_general general_mobile"> 
			<div class="product-image-area">
				<a class="product-image" href="<?php the_permalink(); ?>">
				<?= woocommerce_get_product_thumbnail(); ?>
				</a>
			</div>
			<div class="product-detail-area">
				<h3 class="product-name"><?php echo mweb_post_title(); ?></h3>
				<div class="actions">
					<?php woocommerce_template_loop_price(); ?>
					<a class="buy_later_redirect buy_later <?= 'product_type_' . $product->get_type(); ?>" href="<?= esc_url( $product->add_to_cart_url() ); ?>" target="_blank" data-product_id="<?= get_the_ID(); ?>" data-action="remove"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#shopping-cart"></use></svg>خرید</a>
				</div>
			</div>
			<span class="buy_later remove_buy_later" data-product_id="<?= get_the_ID(); ?>" data-action="remove">حذف</span>
		</div> 
		<?php
		$str = ob_get_contents();
		ob_end_clean();
		
		return $str;
		
	}
}





function mweb_render_custom_button($data) {
    if (empty($data['text'])) {
        return '';
    }

    $link = $data['link'] ?? [];
    $has_link = !empty($link['url']);

    ob_start();
    ?>
    <div class="mweb-btn-wrap">
        <?php if ($has_link): ?>
            <a class="elm_cbtn <?= $data['class'] ?>"
               href="<?= esc_url($link['url']) ?>"
               <?php if (!empty($link['is_external'])) echo 'target="_blank"'; ?>
               <?php if (!empty($link['nofollow'])) echo 'rel="nofollow"'; ?>>
               <?= esc_html($data['text']) ?>
            </a>
        <?php else: ?>
            <span class="elm_cbtn <?= $data['class'] ?>"><?= esc_html($data['text']) ?></span>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
