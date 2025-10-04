<?php
/**
 * this file register config options for theme
 */
if ( ! class_exists( 'mweb_theme_config' ) ) {

	class mweb_theme_config {

	
		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param string $display_default
		 * @return array
		 * sidebar name options config
		 */
		static function sidebar_name( $display_default = '' ) {
			
			
			$sidebar_options = array();
			$custom_sidebars = get_option( 'mweb_custom_multi_sidebars', '' );

			//add default sidebar
			if ( true === $display_default ) {
				$sidebar_options['mweb_default_from_theme_options'] = esc_attr__( 'پیشفرض تنظیمات پوسته', 'mweb' );
			};

			//handle sidebar option
			if ( ! empty( $custom_sidebars ) && is_array( $custom_sidebars ) ) {
				foreach ( $custom_sidebars as $sidebar ) {
					$sidebar_options[ $sidebar['id'] ] = $sidebar['name'];
				};
			};

			return $sidebar_options;
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param string $default
		 * @return array
		 * sidebar position options config
		 */
		static function sidebar_position( $default = true ) {
			
			if ( ! is_admin() ) {
				return false;
			}
			
			$sidebar = array(
				'none'  => array(
					'alt'   => 'none sidebar',
					'img'   => get_template_directory_uri() . '/includes/admin/images/none-sidebar.png',
				),
				'left'  => array(
					'alt'   => 'left sidebar',
					'img'   => get_template_directory_uri() . '/includes/admin/images/left-sidebar.png',
				),
				'right' => array(
					'alt'   => 'right sidebar',
					'img'   => get_template_directory_uri() . '/includes/admin/images/right-sidebar.png',
				)
			);

			//load default setting
			if ( true === $default ) {
				$sidebar['default'] = array(
					'alt'   => 'Default',
					'img'   => get_template_directory_uri() . '/includes/admin/images/default-sidebar.png',
				);
			};

			return $sidebar;
		}
		
		
		
		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return array
		 * layout options config
		 */
		static function blog_layouts() {
			if ( ! is_admin() ) {
				return false;
			}
			
			$layouts = array(
				'classic-list'  => array(
					'alt'   => 'classic list',
					'img'   => get_template_directory_uri() . '/includes/admin/images/list-layout.png',
				),
				'grid-list'  => array(
					'alt'   => 'grid list',
					'img'   => get_template_directory_uri() . '/includes/admin/images/grid-layout.png',
				),
				'small-list' => array(
					'alt'   => 'small list',
					'img'   => get_template_directory_uri() . '/includes/admin/images/small-grid-layout.png',
				)
			);

			return $layouts;
		}

		
		
		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return array
		 * sidebar position options config for single metabox
		 */
		static function metabox_sidebar_position() {
			if ( ! is_admin() ) {
				return false;
			}
			
			return array(
				'default' => get_template_directory_uri() . '/includes/admin/images/default-sidebar.png',
				'none'    => get_template_directory_uri() . '/includes/admin/images/none-sidebar.png',
				'left'    => get_template_directory_uri() . '/includes/admin/images/left-sidebar.png',
				'right'   => get_template_directory_uri() . '/includes/admin/images/right-sidebar.png',
			);
		}

		



		

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * select category
		 */
		static function category_dropdown_select() {

			if ( ! is_admin() ) {
				return false;
			}

			$mweb_categories = get_categories( array(
				'hide_empty' => 0,
			) );

			$mweb_category_array_walker = new mweb_category_array_walker;
			$mweb_category_array_walker->walk( $mweb_categories, 4 );
			$mweb_categories_buffer = $mweb_category_array_walker->cat_array;

			//render
			$str = '';
			$str .= '<select class="mweb-field mweb-field-select">';
			$str .= '<option value="0" selected="selected">' . esc_html__( '-- همه دسته ها --', 'mweb' ) . '</option>';
			foreach ( $mweb_categories_buffer as $mweb_category_name => $category_id ) {
				$str .= '<option value="' . esc_attr( $category_id ) . '">';
				$str .= esc_html( $mweb_category_name );
				$str .= '</option>';
			}

			$str .= '</select><!--#category select-->';

			return $str;
		}

		
	
		
		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return array
		 * woocommerce category select config
		 */
		static function wc_category_dropdown_select() {

			
			if ( ! is_admin() ) {
				return false;
			}

			$mweb_categories = get_categories( 
				array(
					'hide_empty'   => 0,
					'orderby'      => 'name',
					'order'        => 'ASC',
					'hierarchical' => 1,
					'taxonomy'	 => 'product_cat'

				)
			);

			$mweb_category_array_walker = new mweb_category_array_walker;
			$mweb_category_array_walker->walk( $mweb_categories, 4 );
			$mweb_categories_buffer = $mweb_category_array_walker->cat_array;

			//render
			$str = '';
			$str .= '<select class="mweb-field mweb-field-select">';
			$str .= '<option value="0" selected="selected">' . esc_html__( '-- کلیه دسته ها --', 'mweb' ) . '</option>';
			foreach ( $mweb_categories_buffer as $mweb_category_name => $category_id ) {
				$str .= '<option value="' . esc_attr( $category_id ) . '">';
				$str .= esc_html( $mweb_category_name );
				$str .= '</option>';
			}

			$str .= '</select><!--#category select-->';
			

			return $str;
		}
		
		
		
		
		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return array
		 * slider category select config
		 */
		static function slider_category_dropdown_select() {
			if ( ! is_admin() ) {
				return false;
			}
			
			$mweb_categories = get_categories( 
				array(
					'hide_empty'   => 0,
					'orderby'      => 'name',
					'order'        => 'ASC',
					'hierarchical' => 1,
					'taxonomy'	 => 'slider_category'

				)
			);

			$mweb_category_array_walker = new mweb_category_array_walker;
			$mweb_category_array_walker->walk( $mweb_categories, 4 );
			$mweb_categories_buffer = $mweb_category_array_walker->cat_array;

			//render
			$str = '';
			$str .= '<select class="mweb-field mweb-field-select">';
			$str .= '<option value="0" selected="selected">' . esc_html__( '-- کلیه دسته ها --', 'mweb' ) . '</option>';
			foreach ( $mweb_categories_buffer as $mweb_category_name => $category_id ) {
				$str .= '<option value="' . esc_attr( $category_id ) . '">';
				$str .= esc_html( $mweb_category_name );
				$str .= '</option>';
			}

			$str .= '</select><!--#category select-->';

			return $str;
		}
		
		
		


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * Order config
		 */
		static function orderby_dropdown_select() {

			if ( ! is_admin() ) {
				return false;
			}

			$orderby_data = array(
				'date_post'               => esc_html__( 'آخرین', 'mweb' ),
				'comment_count'           => esc_html__( 'تعداد نظرات', 'mweb' ),
				'popular'                 => esc_html__( 'پربازدیدترین', 'mweb' ),
				//'popular_week'            => esc_html__( 'محبوب ترین هفته', 'mweb' ),
				'top_review'              => esc_html__( 'محبوب ترین', 'mweb' ),
				'last_review'             => esc_html__( 'آخرین بازدید', 'mweb' ),
				'post_type'               => esc_html__( 'نوع پست', 'mweb' ),
				'rand'                    => esc_html__( 'تصادفی', 'mweb' ),
				'author'                  => esc_html__( 'نویسنده', 'mweb' ),
				'alphabetical_order_decs' => esc_html__( 'نزولی', 'mweb' ),
				'alphabetical_order_asc'  => esc_html__( 'صعودی', 'mweb' ),
				'best_selling'            => esc_attr__( 'بیشترین فروش', 'mweb' ),
				'featured_product'        => esc_attr__( 'محصول ویژه', 'mweb' ),
				'top_rate'                => esc_attr__( 'بیشترین امتیاز', 'mweb' ),
				'recent'                  => esc_attr__( 'موجودی', 'mweb' ),
				'on_sale'                 => esc_attr__( 'فروش ویژه', 'mweb' ),
			);

			$str = '';
			$str .= '<select class="mweb-field mweb-field-select">';
			foreach ( $orderby_data as $val => $title ) {
				$str .= '<option value="' . esc_attr( $val ) . '">' . esc_html( $title ) . '</option>';
			}
			$str .= '</select>';

			return $str;
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * select author
		 */
		static function author_dropdown_select() {

			if ( ! is_admin() ) {
				return false;
			}

			return wp_dropdown_users(
				array(
					'show_option_all' => esc_html__( 'کلیه نویسنده ها', 'mweb' ),
					'orderby'         => 'ID',
					'class'           => 'mweb-field',
					'echo'            => 0,
					'hierarchical'    => true
				)
			);
		}
		
		
		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * select category
		 */
		static function categories_dropdown_select() {

			if ( ! is_admin() ) {
				return false;
			}


			$mweb_categories = get_categories( array(
				'hide_empty' => 0,
			) );

			$mweb_category_array_walker = new mweb_category_array_walker;
			$mweb_category_array_walker->walk( $mweb_categories, 4 );
			$mweb_categories_buffer = $mweb_category_array_walker->cat_array;

			//render
			$str = '';
			$str .= '<select class="mweb-field mweb-field-select" multiple="multiple">';
			$str .= '<option value="0" selected="selected">' . esc_html__( '-- غیر فعال --', 'mweb' ) . '</option>';
			foreach ( $mweb_categories_buffer as $mweb_category_name => $category_id ) {
				$str .= '<option value="' . esc_attr( $category_id ) . '">';
				$str .= esc_html( $mweb_category_name );
				$str .= '</option>';
			}

			$str .= '</select><!--#categories select-->';

			return $str;
		}
		
		
		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * select category woocommerce
		 */
		static function wc_categories_dropdown_select() {

			if ( ! is_admin() ) {
				return false;
			}


			$mweb_categories = get_categories( array(
				'hide_empty' => 0,
				'taxonomy'	 => 'product_cat'

			) );

			$mweb_category_array_walker = new mweb_category_array_walker;
			$mweb_category_array_walker->walk( $mweb_categories, 4 );
			$mweb_categories_buffer = $mweb_category_array_walker->cat_array;

			//render
			$str = '';
			$str .= '<select class="mweb-field mweb-field-select" multiple="multiple">';
			$str .= '<option value="0" selected="selected">' . esc_html__( '-- غیر فعال --', 'mweb' ) . '</option>';
			foreach ( $mweb_categories_buffer as $mweb_category_name => $category_id ) {
				$str .= '<option value="' . esc_attr( $category_id ) . '">';
				$str .= esc_html( $mweb_category_name );
				$str .= '</option>';
			}

			$str .= '</select><!--#categories select-->';

			return $str;
		}
		
		
		
		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * format dropdown select
		 */
		static function post_format_dropdown_select() {

			if ( ! is_admin() ) {
				return false;
			}

			//render
			$str = '';
			$str .= '<select class="mweb-field mweb-field-select">';
			$str .= '<option value="0" selected="selected">' . esc_html__( '-- همه --', 'mweb' ) . '</option>';
			$str .= '<option value="default">' . esc_html__( 'پیش فرض', 'mweb' ) . '</option>';
			$str .= '<option value="gallery">' . esc_html__( 'گالری', 'mweb' ) . '</option>';
			$str .= '<option value="video">' . esc_html__( 'ویدیو', 'mweb' ) . '</option>';
			$str .= '<option value="audio">' . esc_html__( 'صوت', 'mweb' ) . '</option>';
			$str .= '</select>';

			return $str;
		}
		
		
		
		/**-------------------------------------------------------------------------------------------------------------------------
		 *
		 * @return string
		 * column dropdown select
		 */
		static function column_dropdown_select() {

			if ( ! is_admin() ) {
				return false;
			}

			//render
			$str = '';
			$str .= '<select class="mweb-field mweb-field-select">';
			
			$str .= '<option value="col-md-9">3/12</option><option value="col-md-12">4/12</option><option value="col-md-18">6/12</option><option value="col-md-24">8/12</option><option value="col-md-27">9/12</option><option selected value="col-md-36">12/12</option>';

			$str .= '</select>';

			return $str;
		}
		
		
		
		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param text
		 *
		 * @return string
		 * enable or disable dropdown select
		 */
		static function enable_dropdown_select( $disable = false ) {

			if ( ! is_admin() ) {
				return false;
			}

			//render
			$str = '';
			$str .= '<select class="mweb-field mweb-field-select">';
			if ( true == $disable ) {
				$str .= '<option value="0">' . esc_html__( '-- غیر فعال --', 'mweb' ) . '</option>';
				$str .= '<option value="1"  selected="selected">' . esc_html__( 'فعال', 'mweb' ) . '</option>';
			} else {
				$str .= '<option value="0" selected="selected">' . esc_html__( '-- غیر فعال --', 'mweb' ) . '</option>';
				$str .= '<option value="1">' . esc_html__( 'فعال', 'mweb' ) . '</option>';
			}

			$str .= '</select>';

			return $str;
		}
		
		
		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * viewmore dropdown select
		 */
		static function viewmore_dropdown_select() {

			if ( ! is_admin() ) {
				return false;
			}

			//render
			$str = '';
			$str .= '<select class="mweb-field mweb-field-select">';
			$str .= '<option value="0"  selected="selected">' . esc_html__( '-- غیر فعال --', 'mweb' ) . '</option>';
			$str .= '<option value="1">' . esc_html__( 'فعال', 'mweb' ) . '</option>';
			$str .= '</select>';

			return $str;
		}
		
		
		
		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * summary select config
		 */
		static function summary_dropdown_select() {
			
			$str = '';
			$str .= '<select class="mweb-field mweb-field-select">';
			$str .= '<option value="excerpt">' . esc_html__( 'استفاده از چکیده مطلب', 'mweb' ) . '</option>';
			$str .= '<option value="moretag">' . esc_html__( 'استفاده از تگ یشتر', 'mweb' ) . '</option>';
			$str .= '</select>';

			return $str;
		}
		
		
		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * position dropdown select
		 */
		static function position_dropdown_select() {
			$str = '';
			$str .= '<select class="mweb-field mweb-field-select">';
			$str .= '<option value="0">' . esc_html__( '-- سمت چپ --', 'mweb' ) . '</option>';
			$str .= '<option value="1">' . esc_html__( 'سمت راست', 'mweb' ) . '</option>';
			$str .= '</select>';

			return $str;
		}
		
		
		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * wrapper mode config
		 */
		static function wrapmode_dropdown_select() {

			if ( ! is_admin() ) {
				return false;
			}

			//render
			$str = '';
			$str .= '<select class="mweb-field mweb-field-select">';
			$str .= '<option value="1" selected="selected">' . esc_html__( '-- حاشیه دار --', 'mweb' ) . '</option>';
			$str .= '<option value="0">' . esc_html__( 'فول عرض', 'mweb' ) . '</option>';
			$str .= '</select>';

			return $str;
		}
		
		
		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * text style select
		 */
		static function text_style_dropdown_select() {

			if ( ! is_admin() ) {
				return false;
			}

			//render
			$str = '';
			$str .= '<select class="mweb-field mweb-field-select">';
			$str .= '<option value="dark" selected="selected">' . esc_html__( ' -- تیره -- ', 'mweb' ) . '</option>';
			$str .= '<option value="light">' . esc_html__( 'روشن', 'mweb' ) . '</option>';
			$str .= '</select>';

			return $str;
		}
		
		
		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * number of columns
		 */
		static function number_of_columns_select() {

			if ( ! is_admin() ) {
				return false;
			}

			//render
			$str = '';
			$str .= '<select class="mweb-field mweb-field-select">';
			$str .= '<option value="1">' . esc_html__( '1 ستون', 'mweb' ) . '</option>';
			$str .= '<option value="2">' . esc_html__( '2 ستون', 'mweb' ) . '</option>';
			$str .= '<option value="3" selected="selected">' . esc_html__( ' -- 3 ستون -- ', 'mweb' ) . '</option>';
			$str .= '<option value="4">' . esc_html__( '4 ستون', 'mweb' ) . '</option>';
			$str .= '</select>';

			return $str;
		}
		
		
		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * number of columns
		 */
		static function col_img_style_select() {

			if ( ! is_admin() ) {
				return false;
			}

			//render
			$str = '';
			$str .= '<select class="mweb-field mweb-field-select">';
			$str .= '<option value="1" selected="selected">' . esc_html__( '-- استایل 1 ---', 'mweb' ) . '</option>';
			$str .= '<option value="2">' . esc_html__( 'استایل 2 (بازنویسی)', 'mweb' ) . '</option>';
			$str .= '<option value="3">' . esc_html__( 'استایل 3 (بازنویسی)', 'mweb' ) . '</option>';
			$str .= '</select>';

			return $str;
		}
		
		
		
		/**-------------------------------------------------------------------------------------------------------------------------
		 * block style select
		 */
		static function block_style_dropdown_select() {
			if ( ! is_admin() ) {
				return false;
			}

			$str = '';
			$str .= '<select class="mweb-field mweb-field-select">';
			$str .= '<option value="light" selected="selected">' . esc_html__( '-- تیره --', 'mweb' ) . '</option>';
			$str .= '<option value="dark">' . esc_html__( 'روشن', 'mweb' ) . '</option>';
			$str .= '</select>';

			return $str;
		}
		
		
		
		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * ajax filter type
		 */
		static function ajax_filter_dropdown_select() {

			if ( ! is_admin() ) {
				return false;
			}

			$ajax_filter_dropdown_select_data = array(
				'0'        => esc_html__( '-- غیر فعال --', 'mweb' ),
				'category' => esc_html__( 'دسته بندی', 'mweb' ),
				'tag'      => esc_html__( 'مطالب : برچسب', 'mweb' ),
				'author'   => esc_html__( 'مطالب : نویسنده ', 'mweb' ),
				'popular'  => esc_html__( 'محصولات : پرفروشترین ها و ...', 'mweb' ),

			);

			$str = '';
			$str .= '<select class="mweb-field mweb-field-select">';
			foreach ( $ajax_filter_dropdown_select_data as $val => $title ) {
				$str .= '<option value="' . esc_attr( $val ) . '">' . esc_html( $title ) . '</option>';
			}
			$str .= '</select>';

			return $str;
		}
		
		
		
		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * pagination select config
		 */
		static function pagination_dropdown_select() {

			if ( ! is_admin() ) {
				return false;
			}

			//render
			$str = '';
			$str .= '<select class="mweb-field mweb-field-select">';
			$str .= '<option value="0" selected="selected">' . esc_html__( ' -- غیرفعال -- ', 'mweb' ) . '</option>';
			$str .= '<option value="next_prev">' . esc_html__( 'دکمه قبل و بعد', 'mweb' ) . '</option>';
			$str .= '<option value="loadmore">' . esc_html__( 'بارگذاری بیشتر', 'mweb' ) . '</option>';
			//$str .= '<option value="infinite_scroll">' . esc_html__( 'اسکرول', 'mweb' ) . '</option>';
			$str .= '</select>';

			return $str;
		}
		
		
		
		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * grid style select
		 */
		static function grid_style_dropdown_select() {

			if ( ! is_admin() ) {
				return false;
			}

			//render
			$str = '';
			$str .= '<select class="mweb-field mweb-field-select">';
			$str .= '<option value="1" selected="selected">' . esc_html__( ' -- استایل 1 -- ', 'mweb' ) . '</option>';
			$str .= '<option value="2">' . esc_html__( 'استایل 2 (بالای عنوان)', 'mweb' ) . '</option>';
			$str .= '<option value="3">' . esc_html__( 'استایل 3 (وسط عنوان)', 'mweb' ) . '</option>';
			$str .= '<option value="4">' . esc_html__( 'استایل 4 (قوس)', 'mweb' ) . '</option>';
			$str .= '<option value="5">' . esc_html__( 'استایل 5 (قوس + وسط عنوان)', 'mweb' ) . '</option>';
			$str .= '</select>';

			return $str;
		}
		
		
		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * viewmore dropdown select
		 */
		static function textarea_custom_html( $data ) {

			//render
			$str = '';
			if ( ! function_exists( 'wp_editor' ) ) {
				$str .= '<textarea class="mweb-field" rows="9" name="' . $data['block_name'] . '">' . $data['block_content'] . '</textarea>'; //text area
			} else {
				ob_start();
				wp_editor( htmlspecialchars_decode( $data['block_content'] ), 'tinymce_' . $data['block_id'], array(
					'editor_class'  => 'mweb-textarea mweb-html mweb-tinymce',
					'textarea_name' => $data['block_name'],
					'media_buttons' => true,
					'wpautop'       => false
				) );
				$str .= ob_get_clean();
			}

			return $str;
		}
		
		
		//get all sidebar after load
		static function get_all_sidebar() {

			return $GLOBALS['wp_registered_sidebars'];
		}



	}

}




/**-------------------------------------------------------------------------------------------------------------------------
 * ajax custom html (WYSWYG)
 */
if ( ! function_exists( 'mweb_theme_ajax_composer_html' ) ) {
	add_action( 'wp_ajax_mweb_theme_ajax_composer_html', 'mweb_theme_ajax_composer_html' );

	function mweb_theme_ajax_composer_html() {

		$data                  = array();
		$data['block_id']      = '';
		$data['block_name']    = '';
		$data['block_content'] = '';

		//get and validate request data
		if ( ! empty( $_POST['data']['block_id'] ) ) {
			$data['block_id'] = esc_attr( $_POST['data']['block_id'] );
		}

		if ( ! empty( $_POST['data']['block_name'] ) ) {
			$data['block_name'] = esc_attr( $_POST['data']['block_name'] );
		}

		if ( ! empty( $_POST['data']['block_content'] ) ) {
			$data['block_content'] = stripcslashes( $_POST['data']['block_content'] );
		}

		$data_response = mweb_theme_config::textarea_custom_html( $data );
		die( json_encode( $data_response ) );
	}
}


if ( ! class_exists( 'mweb_category_array_walker' ) ) {
	class mweb_category_array_walker extends Walker {

		var $tree_type = 'category';
		var $cat_array = array();
		var $db_fields = array(
			'id'     => 'term_id',
			'parent' => 'parent'
		);

		public function start_lvl( &$output, $depth = 0, $args = array() ) {
		}

		public function end_lvl( &$output, $depth = 0, $args = array() ) {
		}

		public function start_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 ) {
			$this->cat_array[ str_repeat( ' - ', $depth ) . $object->name . ' - [ آیدی: ' . $object->term_id . ' / تعداد محتوا: ' . $object->category_count . ' ]' ] = $object->term_id;
		}

		public function end_el( &$output, $object, $depth = 0, $args = array() ) {
		}

	}
}



/**-------------------------------------------------------------------------------------------------------------------------
 * @return array
 * Custom category list
 */
function get_element_category_list($taxonomy = 'category') {
	
	if ( ! is_admin() ) {
		return false;
	}

	$mweb_categories = get_categories( 
		array(
			'hide_empty'   => 0,
			'orderby'      => 'name',
			'order'        => 'ASC',
			'hierarchical' => 1,
			'taxonomy'	 => $taxonomy

		)
	);

	$mweb_category_array_walker = new mweb_category_array_walker;
	$mweb_category_array_walker->walk( $mweb_categories, 6 );
	$mweb_categories_buffer = $mweb_category_array_walker->cat_array;
	
	$category_list = array();
	$category_list[0] = '-- همه --';
	
	
	foreach ( $mweb_categories_buffer as $mweb_category_name => $category_id ) {
		$category_list[esc_attr( $category_id )] = esc_html( $mweb_category_name );
	}
	
	return $category_list;
	
}


/**-------------------------------------------------------------------------------------------------------------------------
 * @return string
 * select category
 */
function get_element_category_multiple_list($taxonomy = 'category') {

	if ( ! is_admin() ) {
		return false;
	}


	$mweb_categories = get_categories( array(
		'hide_empty' => 0,
		'taxonomy'	 => $taxonomy
	) );

	$mweb_category_array_walker = new mweb_category_array_walker;
	$mweb_category_array_walker->walk( $mweb_categories, 6 );
	$mweb_categories_buffer = $mweb_category_array_walker->cat_array;

	//render
	$category_list = array();
	$category_list[0] = '-- غیرفعال --';
	
	
	foreach ( $mweb_categories_buffer as $mweb_category_name => $category_id ) {
		$category_list[esc_attr( $category_id )] = esc_html( $mweb_category_name );
	}
	
	return $category_list;
}



/**-------------------------------------------------------------------------------------------------------------------------
 * @return string
 * select mneus
 */
function get_element_menus_list() {

	if ( ! is_admin() ) {
		return false;
	}
	$list_menu = array();
	$menus = wp_get_nav_menus(); 
	if(!empty($menus)){
		foreach($menus as $menu){
			$list_menu[$menu->term_id] = $menu->name;
		}		
	}
	
	return $list_menu;
}



/**-------------------------------------------------------------------------------------------------------------------------
 * @return array
 * Order config
 */
function get_element_post_orderby() {

	if ( ! is_admin() ) {
		return false;
	}

	$orderby_data = array(
		'date_post'               => esc_html__( 'آخرین', 'mweb' ),
		'comment_count'           => esc_html__( 'تعداد نظرات', 'mweb' ),
		'popular'                 => esc_html__( 'پربازدیدترین', 'mweb' ),
		//'popular_week'            => esc_html__( 'محبوب ترین هفته', 'mweb' ),
		'top_review'              => esc_html__( 'محبوب ترین', 'mweb' ),
		'last_review'             => esc_html__( 'آخرین بازدید', 'mweb' ),
		'post_type'               => esc_html__( 'نوع پست', 'mweb' ),
		'rand'                    => esc_html__( 'تصادفی', 'mweb' ),
		'author'                  => esc_html__( 'نویسنده', 'mweb' ),
		'alphabetical_order_decs' => esc_html__( 'نزولی', 'mweb' ),
		'alphabetical_order_asc'  => esc_html__( 'صعودی', 'mweb' ),
		'best_selling'            => esc_attr__( 'بیشترین فروش', 'mweb' ),
		'featured_product'        => esc_attr__( 'محصول ویژه', 'mweb' ),
		'top_rate'                => esc_attr__( 'بیشترین امتیاز', 'mweb' ),
		'recent'                  => esc_attr__( 'موجودی', 'mweb' ),
		'on_sale'                 => esc_attr__( 'فروش ویژه', 'mweb' )
	);

	return $orderby_data;
	
}


/**-------------------------------------------------------------------------------------------------------------------------
 * @return string
 * select author
 */
function get_element_author_list() {

	if ( ! is_admin() ) {
		return false;
	}

	$user_list = array();
	$user_list[0]= 'همه نویسنده ها';
	$all_users = get_users(array(
        'role__in'     => array('administrator', 'editor', 'author'),
    ));
	foreach ( $all_users as $user ) {
		$user_list[$user->ID] = $user->user_email;
	}
	return $user_list;
	
}


/**-------------------------------------------------------------------------------------------------------------------------
 * @return string
 * viewmore dropdown select
 */
function get_element_on_off() {

	if ( ! is_admin() ) {
		return false;
	}
	
	$switch_data = array(
		0 => esc_html( '-- غیر فعال --', 'mweb' ),
		1 => esc_html( 'فعال', 'mweb' )
	);
	
	return $switch_data;

}


/**-------------------------------------------------------------------------------------------------------------------------
 * @return string
 * ajax filter type
 */
function get_element_ajax_filter_type() {

	if ( ! is_admin() ) {
		return false;
	}

	$ajax_filter_data = array(
		'0'        => esc_html__( '-- غیر فعال --', 'mweb' ),
		'category' => esc_html__( 'دسته بندی', 'mweb' ),
		'tag'      => esc_html__( 'مطالب : برچسب', 'mweb' ),
		'author'   => esc_html__( 'مطالب : نویسنده ', 'mweb' ),
		'popular'  => esc_html__( 'محصولات : پرفروشترین ها و ...', 'mweb' )

	);

	return $ajax_filter_data;
}


/**-------------------------------------------------------------------------------------------------------------------------
 * @return string
 * pagination select config
 */
function get_element_ajax_pagination_type() {

	if ( ! is_admin() ) {
		return false;
	}

	//render
	$ajax_filter_pagination = array(
		'0'          => esc_html__( '-- غیر فعال --', 'mweb' ),
		'next_prev'  => esc_html__( 'دکمه قبل و بعد', 'mweb' ),
		'loadmore'   => esc_html__( 'بارگذاری بیشتر', 'mweb' )
	);
	return $ajax_filter_pagination;
}


/**-------------------------------------------------------------------------------------------------------------------------
 * @return string
 * get wc attribute taxonomies
 */
function get_wc_attribute_taxonomies() {

	//render
	$attribute_otp = array();
	$attributes = wc_get_attribute_taxonomies();
	
	foreach($attributes as $attr){
		$attribute_otp[$attr->attribute_name] = $attr->attribute_label;
	}
	
	return $attribute_otp;
}


/**-------------------------------------------------------------------------------------------------------------------------
 * @return string
 * get category list for search
 */
function get_category_list_as_array($taxonomy = 'category', $only_parent = false) {
	
	$param = array(
			'hide_empty'   => 0,
			'orderby'      => 'name',
			'order'        => 'ASC',
			'hierarchical' => 1,
			'taxonomy'	 => $taxonomy
		);
		
	if($only_parent){
		$param['parent'] = 0;
	}	
	$mweb_categories = get_categories( $param );
	
	return $mweb_categories;
	
}


/**-------------------------------------------------------------------------------------------------------------------------
 * @return string
 * get order status list
 */
function get_order_status_list_as_array() {

	if( ! is_woocommerce_activated() && ! is_admin() ){
		return array('');
	}	

	return get_order_statuses_from_transient();
	
}


function get_order_statuses_from_transient() {
    $order_statuses = get_transient('order_statuses_list');

    if (false === $order_statuses) {
        $order_statuses = apply_filters('wc_order_statuses', array());
        $formatted_statuses = wc_get_order_statuses();
        set_transient('order_statuses_list', $formatted_statuses, 24 * HOUR_IN_SECONDS);
    }

    return $order_statuses;
}


/**-------------------------------------------------------------------------------------------------------------------------
 * @return array
 * get product guide list
 */
function get_product_guide_list_as_array() {
	$product_guide = array();
	$product_guide[0] = '-- هیـچ --';
	$product_guide_post = get_posts( array('posts_per_page' => -1, 'post_type' => 'product_guide') );
	if(!empty($product_guide_post))
		foreach ($product_guide_post as $value) {
			$product_guide[$value->ID] = $value->post_title;
		}
	return $product_guide;
}


/**-------------------------------------------------------------------------------------------------------------------------
 * @return string
 * get invoice meta list
 */
function get_invoice_meta_list() {
	$args = array( 'weight' => 'وزن' );
	$list = apply_filters( 'mweb_invoice_meta_list', $args );
	return $list;
}


/**-------------------------------------------------------------------------------------------------------------------------
 * @return string
 * array map divide column
 */
function get_divide_div($n) {
	if(!empty($n))
		return ( 36 / $n );
}



/**-------------------------------------------------------------------------------------------------------------------------
 * @return array
 * get slider effect
 */
function get_swiper_effect( $sw_effect, $data_setting = [] ) {
	
	
	switch( $sw_effect ){
		case '3d':
			$data_setting['effect'] = 'coverflow';
			$data_setting['grabCursor'] = true;
			//$data_setting['slidesPerView'] = 'auto';
			$data_setting['coverflowEffect'] = array('rotate' => 30, 'stretch' => 0, 'depth' => 100, 'modifier' => 1, 'slideShadows' => true);
		break;
		case 'cube':
			$data_setting['effect'] = 'cube';
			$data_setting['grabCursor'] = true;
			$data_setting['cubeEffect'] = [
				'shadow' => true,
				'slideShadows' => true,
				'shadowOffset' => 20,
				'shadowScale' => 0.94,
			];
		break;
		case 'card1':
			$data_setting['effect'] = 'cards';
			$data_setting['grabCursor'] = true;
			$data_setting['cardsEffect'] = [
				'shadow' => false,
				'slideShadows' => false,
			];
		break;
		case 'card2':
			$data_setting['effect'] = 'cards';
			$data_setting['grabCursor'] = true;
			$data_setting['cardsEffect'] = [
				'rotate' => false,
				'shadow' => false,
				'slideShadows' => false,
				'perSlideOffset' => 10,
			];
		break;
		case 'creative1':
			$data_setting['grabCursor'] = true;
			$data_setting['effect'] = 'creative';
			$data_setting['creativeEffect'] = [
				'shadowPerProgress' => false,
				'prev' => [
					'shadow' => true,
					'translate' => [0, 0, -400],
				],
				'next' => [
					'translate' => ['100%', 0, 0],
				],
			];
		break;
		case 'creative2':
			$data_setting['grabCursor'] = true;
			$data_setting['effect'] = 'creative';
			$data_setting['creativeEffect'] = [
				'shadowPerProgress' => false,
				'prev' => [
					'shadow' => true,
					'translate' => ['-120%', 0, -500],
				],
				'next' => [
					'shadow' => true,
					'translate' => ['120%', 0, -500],
				],
			];
		break;
		case 'creative3':
			$data_setting['grabCursor'] = true;
			$data_setting['effect'] = 'creative';
			$data_setting['creativeEffect'] = [
				'prev' => [
					'shadow'   => true,
					'translate'=> ['-30%', 0, -200],
					'rotate'   => [0, 0, -5],
				],
				'next' => [
					'shadow'   => true,
					'origin'   => 'right center',
					'translate'=> ['100%', 0, -300],
					'rotate'   => [0, -90, 0],
				],
			];
		break;
		case 'creative4':
			$data_setting['grabCursor'] = true;
			$data_setting['effect'] = 'creative';
			$data_setting['creativeEffect'] = [
				'shadowPerProgress' => false,
				'prev' => [
					'shadow' => true,
					'translate' => [0, 0, -800],
					'rotate' => [180, 0, 0],
				],
				'next' => [
					'shadow' => true,
					'translate' => [0, 0, -800],
					'rotate' => [-180, 0, 0],
				],
			];
		break;
		case 'creative5':
			$data_setting['grabCursor'] = true;
			$data_setting['effect'] = 'creative';
			$data_setting['creativeEffect'] = [
				'shadowPerProgress' => false,
				'prev' => [
					'shadow' => true,
					'translate' => ['-125%', 0, -800],
					'rotate' => [0, 0, -90],
				],
				'next' => [
					'shadow' => true,
					'translate' => ['125%', 0, -800],
					'rotate' => [0, 0, 90],
				],
			];
		break;
		case 'creative6':
			$data_setting['grabCursor'] = true;
			$data_setting['effect'] = 'creative';
			$data_setting['creativeEffect'] = [
				'shadowPerProgress' => false,
				'prev' => [
					'shadow' => true,
					'origin' => 'left center',
					'translate' => ['-5%', 0, -200],
					'rotate' => [0, 100, 0],
				],
				'next' => [
					'origin' => 'right center',
					'translate' => ['5%', 0, -200],
					'rotate' => [0, -100, 0],
				],
			];
		break;
	}
	
	return $data_setting;
		
}


/**-------------------------------------------------------------------------------------------------------------------------
 * @return string
 * minify css
 */
function mweb_minimize_CSS( $css ){
	$css = preg_replace('/\/\*((?!\*\/).)*\*\//', '', $css); // negative look ahead
	$css = preg_replace('/\s{2,}/', ' ', $css);
	$css = preg_replace('/\s*([:;{}])\s*/', '$1', $css);
	$css = preg_replace('/;}/', '}', $css);
	return $css;
}


/**-------------------------------------------------------------------------------------------------------------------------
 * @return array
 * get order sms shortcode
 */
function mweb_get_order_sms_shortcode_array(){
	 $array = array(
		'mobile' => 'شماره موبایل مشتری',
		'phone' => 'شماره تلفن مشتری',
		'email' => 'ایمیل مشتری',
		'status' => 'وضعیت سفارش',
		'all_items' => 'محصولات سفارش',
		'count_items' => 'تعداد محصولات سفارش',
		'price' => 'مبلغ سفارش',
		'order_id' => 'شماره سفارش',
		'transaction_id' => 'شماره تراکنش',
		'date' => 'تاریخ سفارش',
		'payment_method' => 'روش پرداخت',
		'shipping_method' => 'روش ارسال',
		'b_first_name' => 'صورتحساب / نام',
		'b_last_name' => 'صورتحساب / نام خانوادگی',
		'b_company' => 'صورتحساب / نام شرکت',
		'b_country' => 'صورتحساب / کشور',
		'b_state' => 'صورتحساب / ایالت/استان',
		'b_city' => 'صورتحساب / شهر',
		'b_address_1' => 'صورتحساب / آدرس 1',
		'b_address_2' => 'صورتحساب / آدرس 2',
		'b_postcode' => 'صورتحساب / کد پستی',
		'sh_first_name' => 'حمل و نقل / نام',
		'sh_last_name' => 'حمل و نقل / نام خانوادگی',
		'sh_company' => 'حمل و نقل / نام شرکت',
		'sh_country' => 'حمل و نقل / کشور',
		'sh_state' => 'حمل و نقل / ایالت/استان',
		'sh_city' => 'حمل و نقل / شهر',
		'sh_address_1' => 'حمل و نقل / آدرس 1',
		'sh_address_2' => 'حمل و نقل / آدرس 2',
		'sh_postcode' => 'حمل و نقل / کد پستی',
	);

	return $array;
}


function mweb_get_product_list_templates(){
	$list = [
		'type-0' => __( 'یک', 'mweb' ),
		'type-1' => __( 'دو', 'mweb' ),
		'type-2' => __( 'سه', 'mweb' ),
		'type-3' => __( 'چهار', 'mweb' ),
		'type-4' => __( 'پنج', 'mweb' ),
		'type-5' => __( 'شش', 'mweb' ),
		'type-6' => __( 'هفت', 'mweb' ),
		'type-7' => __( 'هشت', 'mweb' ),
		'type-8' => __( 'نه', 'mweb' ),
		'type-9' => __( 'ده', 'mweb' ),
	];
	return $list;
}