<?php
namespace ElementorMahdisweb\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Module Product Table
 * @since 1.2.0
 */
class Block_Product_table extends Widget_Base {

	protected $query = null;
	
	protected $attributes = null;
	
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);

		wp_register_script('highcharts', THEME_ASSET . '/js/highcharts.js', array('jquery'), THEME_VERSION, true);

	}

	public function get_script_depends() {
		return [ 'highcharts' ];
	}
		
	public function get_name() {
		return 'block-product-table';
	}


	public function get_title() {
		return __( 'جدول محصولات', 'mweb' );
	}


	public function get_icon() {
		return 'eicon-table';
	}


	public function get_categories() {
		return [ 'digiland', 'digiland_woo' ];
	}


	protected function register_controls() {
		
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'عنوان', 'mweb' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'عنوان بلاک', 'mweb' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'bk_title_color',
			[
				'label' => __( 'رنگ عنوان', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .block-title .title' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'title_picon',
			[
				'label' => __( 'آیکن', 'mweb' ),
				'type' => 'iconpicker',
			]
		);
		
		
		$this->add_control(
			'title_icon_color',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .block-title .title svg' => 'stroke: {{VALUE}}; fill: {{VALUE}}',
					'{{WRAPPER}} .bk_view_more svg' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'title_icon_size',
			[
				'label' => __( 'اندازه آیکن', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 24,
				],
				'selectors' => [
					'{{WRAPPER}} .block-title .title svg' => 'width: {{SIZE}}{{UNIT}};',
				]
			]
		);
		
		$this->add_control(
			'show_print',
			[
				'label' => __( 'نمایش دکمه پرینت', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [ 'title!' => '' ]
			]
		);
		
		$this->add_control(
			'show_excel',
			[
				'label' => __( 'نمایش دکمه اکسل', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [ 'title!' => '' ]
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'header_background',
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .block-title',
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_filter',
			[
				'label' => __( 'فیلتر', 'mweb' ),
			]
		);
		
		$this->add_control(
			'is_archive',
			[
				'label' => __( 'استفاده در آرشیو', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'yes' => __( 'بله', 'mweb' ),
					'no' => __( 'خیر', 'mweb' ),
				]
			]
		);

		$this->add_control(
			'category_id',
			[
				'label' => __( 'انتخاب دسته بندی', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 0,
				'options' => get_element_category_list('product_cat'),
				'condition' => [ 'is_archive' => ['no'] ],
			]
		);
		
		$this->add_control(
			'brand_id',
			[
				'label' => __( 'انتخاب برند', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 0,
				'options' => get_element_category_list(apply_filters('mweb_product_brand_taxonomy', 'product_brand')),
			]
		);
		
		$this->add_control(
			'posts_per_page',
			[
				'label' => __( 'تعداد مطالب', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 10,
				'min' => 1,
			]
		);
		$this->add_control(
			'offset',
			[
				'label' => __( 'نقطه شروع مطالب', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '',
				'description' => 'offset باعث می شود چند نتیجه اول را رد کند و از آنجا به بعد تعداد پست به شما دهد',
			]
		);

		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_type',
			[
				'label' => __( 'نمـایش', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'product_attribute',
			[
				'label' => __( 'انتخاب ویژگی ها', 'mweb' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $this->get_attributes()
			]
		);
		
		$this->add_control(
			'show_product_photo',
			[
				'label' => __( 'نمایش عکس محصول', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'show_product_sku',
			[
				'label' => __( 'نمایش شناسه محصول', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'show_product_unit',
			[
				'label' => __( 'نمایش واحد محصول', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'show_product_price',
			[
				'label' => __( 'نمایش قیمت', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'show_product_chart',
			[
				'label' => __( 'نمایش نمودار قیمت', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'show_product_buy',
			[
				'label' => __( 'نمایش خرید', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'product_buy_type',
			[
				'label' => __( 'نوع خرید', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'مستقیم', 'mweb' ),
				'label_off' => __( 'پاپ آپ', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [ 'show_product_buy' => ['yes'] ],
			]
		);
		
		$this->add_control(
			'show_pagination',
			[
				'label' => __( 'نمایش صفحه بندی', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		
	
		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'استایل', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
				
		$this->add_control(
			'bk_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .mweb-block-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'bk_box_shadow',
				'selector' => '{{WRAPPER}} .mweb-block-wrap',
			]
		);
		
		$this->add_control(
			'bk_padding',
			[
				'label' => __( 'فاصله داخلی', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .mweb-block-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'bk_bg_color',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mweb-block-wrap' => 'background-color: {{VALUE}}',
				],
			]
		);
	
		

		
		$this->end_controls_section();
		

	}
	
	
	public function get_attributes() {
		if(empty($this->attributes))
			$this->attributes = get_wc_attribute_taxonomies();
		return $this->attributes; 
	}
	
	public function get_query() {
		return $this->query;
	}
	
	
	public function get_current_page() {
		return max( 1, get_query_var( 'paged' ), get_query_var( 'page' ) );
	}

	private function get_wp_link_page( $i ) {
		if ( ! is_singular() || is_front_page() ) {
			return get_pagenum_link( $i );
		}

		// Based on wp-includes/post-template.php:957 `_wp_link_page`.
		global $wp_rewrite;
		$post = get_post();
		$query_args = [];
		$url = get_permalink();

		if ( $i > 1 ) {
			if ( '' === get_option( 'permalink_structure' ) || in_array( $post->post_status, [ 'draft', 'pending' ] ) ) {
				$url = add_query_arg( 'page', $i, $url );
			} elseif ( get_option( 'show_on_front' ) === 'page' && (int) get_option( 'page_on_front' ) === $post->ID ) {
				$url = trailingslashit( $url ) . user_trailingslashit( "$wp_rewrite->pagination_base/" . $i, 'single_paged' );
			} else {
				$url = trailingslashit( $url ) . user_trailingslashit( $i, 'single_paged' );
			}
		}

		if ( is_preview() ) {
			if ( ( 'draft' !== $post->post_status ) && isset( $_GET['preview_id'], $_GET['preview_nonce'] ) ) {
				$query_args['preview_id'] = wp_unslash( $_GET['preview_id'] );
				$query_args['preview_nonce'] = wp_unslash( $_GET['preview_nonce'] );
			}

			$url = get_preview_post_link( $post, $query_args, $url );
		}

		return $url;
	}

	public function get_posts_nav_link( $page_limit = null ) {
		if ( ! $page_limit ) {
			$page_limit = $this->get_query->max_num_pages;
		}

		$return = [];

		$paged = $this->get_current_page();

		$link_template = '<a class="page-numbers %s" href="%s">%s</a>';
		$disabled_template = '<span class="page-numbers %s">%s</span>';

		if ( $paged > 1 ) {
			$next_page = intval( $paged ) - 1;
			if ( $next_page < 1 ) {
				$next_page = 1;
			}

			$return['prev'] = sprintf( $link_template, 'prev', $this->get_wp_link_page( $next_page ), $this->get_settings( 'pagination_prev_label' ) );
		} else {
			$return['prev'] = sprintf( $disabled_template, 'prev', $this->get_settings( 'pagination_prev_label' ) );
		}

		$next_page = intval( $paged ) + 1;

		if ( $next_page <= $page_limit ) {
			$return['next'] = sprintf( $link_template, 'next', $this->get_wp_link_page( $next_page ), $this->get_settings( 'pagination_next_label' ) );
		} else {
			$return['next'] = sprintf( $disabled_template, 'next', $this->get_settings( 'pagination_next_label' ) );
		}

		return $return;
	}
	
	
	public function query_posts() {

		$args = array(
			'posts_per_page' => $this->get_settings('posts_per_page'),
			'ignore_sticky_posts' => 1,
			'post_status' => 'publish',
			'post_type' => 'product',
			'paged' => $this->get_current_page(),
			
		);
		
		if($this->get_settings('is_archive') == 'no'){
			$args['tax_query'] = array();
			if(!empty($this->get_settings('category_id'))){
				if(!empty($this->get_settings('brand_id'))){
					$args['tax_query']['relation'] = 'AND';
				}
				$args['tax_query'][] = array(
					array(
						'taxonomy' => 'product_cat',
						'terms'    => $this->get_settings('category_id')
					)
				);
			}
			if(!empty($this->get_settings('brand_id'))){
				$args['tax_query'][] = array(
					array(
						'taxonomy' => apply_filters('mweb_product_brand_taxonomy', 'product_brand'),
						'terms'    => $this->get_settings('brand_id')
					)
				);
			}
		}else{
			 global $wp_query;
			$category_ar = $wp_query->get_queried_object();
			if(!empty($category_ar) && !is_wp_error($category_ar)){
				if(isset($category_ar->term_id))
					$args['tax_query'] = array(
						array(
							'taxonomy' => 'product_cat',
							'terms'    => $category_ar->term_id
						)
					);
			}
		}
		
		$this->query = new \WP_Query( $args );

		
	}
	
	
	
	
	protected function render() {
				
		$settings = $this->get_settings_for_display();
						
		$block = array('block_id' => 'mweb_'.$this->get_id(), 'block_name' => 'mweb_'.$this->get_name(), 'block_options' => array('title' => $settings['title'], 'icon' => $settings['title_picon']));
		
		$this->query_posts();

		$query_data = $this->get_query();
		
		$page_limit = $query_data->max_num_pages; 
		
		$product_attribute = $settings['product_attribute'];
				
		echo \mweb_theme_block::block_open( $block, $query_data );
		
		if( is_tax() && $settings['is_archive'] == 'yes' ){
			echo '<header class="woocommerce-products-header block-title">';
				echo '<h1 class="woocommerce-products-header__title page-title title">';
					if ( is_product_category() ){
						global $wp_query;
						$cat = $wp_query->get_queried_object();
						$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
						$image = wp_get_attachment_url( $thumbnail_id );
						if ( $image ) {
							echo '<img class="archive_thumbnail" src="' . $image . '" alt="' . $cat->name . '" />';
						}else{
							echo '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#category-2"></use></svg>';
						}
					}else{
						echo '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#category-2"></use></svg>';
					}
					woocommerce_page_title();
				echo '</h1>';
			echo '</header>';
		}else{
			if ( !empty( $settings['title'] ) ) {
				
				$block_icon = '';
				if ( !empty( $settings['title_picon'] ) ) {
					$block_icon = $settings['title_picon'];
				}else{
					$block_icon = apply_filters('block_header_icon' , '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#category-2"></use></svg>');
				}
				$el_tools = '';
				
				if( $settings['show_print'] == 'yes' )
					$el_tools .= '<span class="bkt_tools elm_print" data-toggle="tooltip" data-original-title="چاپ"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#printer"></use></svg></span>';
				if( $settings['show_excel'] == 'yes' )
					$el_tools .= '<span class="bkt_tools elm_exp_excel" data-toggle="tooltip" data-original-title="خروجی اکسل"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#document-download"></use></svg></span>';

				echo '<div class="block-title elm_bt_title"><div class="title">'.$block_icon.' '.esc_html( $settings['title'] ). '</div>'.$el_tools.'</div>';
			
				
			}
		}
		
		
		$temp = get_wc_attribute_taxonomies();
		
		echo \mweb_theme_block::block_content_open();
		
		if ( $query_data->have_posts() ) {
			
			echo '<table class="product_list_table elm_table'. ( $settings['title'] ? ' elm_bthas_title' : '' ) .'">';
				echo '<thead><tr>';
					if($settings['show_product_photo'] == 'yes')
						echo '<th class="th_img">عکس</th>';
					if($settings['show_product_sku'] == 'yes')
						echo '<th class="th_sku">کد</th>';
					echo '<th class="th_title">نام</th>';
					if(!empty($product_attribute)){
						foreach($product_attribute as $attr){
							echo '<th class="th_attribute">'.$temp[$attr].'</th>';
						}
					}
					if($settings['show_product_unit'] == 'yes')
						echo '<th class="th_unit">واحـد</th>';
					if($settings['show_product_price'] == 'yes')
						echo '<th class="th_price">قیمت</th>';
					if($settings['show_product_chart'] == 'yes' || $settings['show_product_buy'] == 'yes')
						echo '<th class="th_action">عملیات</th>';
				
				echo '</tr></thead>';
				echo '<tbody>';

				while ( $query_data->have_posts() ) : $query_data->the_post();
					
					global $product;
					
					$product_id = get_the_ID();
					
					echo '<tr>';
					
					if($settings['show_product_photo'] == 'yes')
						echo '<td class="td_img">'. woocommerce_get_product_thumbnail('simplev') .'</td>';
					
					if($settings['show_product_sku'] == 'yes'){
						$prd_sku = $product->get_sku();
						echo '<td class="td_sku'. (empty($prd_sku) ? ' hide_mobile' : '') .'" data-title="شناسه">'.$prd_sku.'</td>';
					}
						
					
					echo '<td class="td_title" data-title="عنوان"><a href="'.get_permalink().'">'.get_the_title().'</a></td>';
					
					if(!empty($product_attribute)){
						foreach($product_attribute as $attr){
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
					
					if($settings['show_product_unit'] == 'yes'){
						$prd_unit = get_post_meta( $product_id, '_product_unit', true );
						echo '<td class="td_unit'. (empty($prd_unit) ? ' hide_mobile' : '') .'" data-title="واحد">'.$prd_unit.'</td>';
					}
					
					if($settings['show_product_price'] == 'yes'){
						$my_flag = '';
						$my_price_old = mweb_last_price_data($product_id);
						if(!empty($my_price_old)){
							$old_price = $product->is_on_sale() ? $product->get_regular_price() : $my_price_old->price;
							$current_price = $product->is_on_sale() ? $product->get_sale_price() : $product->get_regular_price();
							if( !empty($current_price) ){
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
						
					if($settings['show_product_chart'] == 'yes' || $settings['show_product_buy'] == 'yes'){
						$my_action = '';
						$show_price_chart = get_post_meta($product_id, '_show_price_chart' , true);
						if($settings['show_product_chart'] == 'yes' && $show_price_chart == 'yes' && !empty($my_price_old))
							$my_action .= '<a href="javascript:void(0);" class="btn btn_price_chart" data-product_id="'.$product_id.'" title="نمودار قیمت" data-toggle="tooltip"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#chart-2"></use></svg></a>';
						
						if($settings['show_product_buy'] == 'yes'){
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
			
		} else {
			echo mweb_no_content();
		}	
		//reset post data
		wp_reset_postdata();
		
		echo \mweb_theme_block::block_content_close();
		
		$links = [];
		if ( 2 < $page_limit && $settings['show_pagination'] == 'yes') {
			$paginate_args = [
				'type' => 'array',
				'current' => $this->get_current_page(),
				'total' => $page_limit,
				'prev_next' => false,
				'show_all' => false,
				'before_page_number' => '<span class="elementor-screen-only">' . __( 'Page', 'elementor-pro' ) . '</span>',
			];

			$big = 999999999; 

			if ( is_singular() && ! is_front_page() ) {
				global $wp_rewrite;
				if ( $wp_rewrite->using_permalinks() ) {
					$paginate_args['base'] = str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );
					$paginate_args['format'] = user_trailingslashit( '%#%', 'single_paged' );
				} else {
					$paginate_args['format'] = '?page=%#%';
				}
			}

			$links = paginate_links( $paginate_args );
			
			
			echo '<div class="pagination-wrap clear">';
				echo '<div class="pagination-num">';
					echo implode( PHP_EOL, $links );
				echo '</div>';
			echo '</div>';
			
		}
			
		
		echo \mweb_theme_block::block_footer( $block );
		echo \mweb_theme_block::block_close();
		
	}


	protected function content_template() {
		
	}
}




/**
 * Elementor Module Product data table
 * @since 1.0.0
 */
class Block_Product_Datatable extends Widget_Base {

	protected $query = null;
	
	protected $attributes = null;
	
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);

		wp_register_script('highcharts', THEME_ASSET . '/js/highcharts.js', array('jquery'), THEME_VERSION, true);
		wp_register_script('datatable', THEME_ASSET . '/js/datatables.min.js', array('jquery'), THEME_VERSION, true);
		wp_register_style( 'datatablecss', THEME_ASSET . '/css/datatables.min.css', array(), THEME_VERSION);

	}


	public function get_script_depends() {
		return [ 'highcharts', 'datatable' ];
	}
	
	
	public function get_style_depends() {
		return [ 'datatablecss' ];
	}	

	
	public function get_name() {
		return 'block-product-datatable';
	}


	public function get_title() {
		return __( 'جدول محصولات (DataTable)', 'mweb' );
	}


	public function get_icon() {
		return 'eicon-table';
	}


	public function get_categories() {
		return [ 'digiland', 'digiland_woo' ];
	}


	protected function register_controls() {
		
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'عنوان', 'mweb' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'عنوان بلاک', 'mweb' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'bk_title_color',
			[
				'label' => __( 'رنگ عنوان', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .block-title .title' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'title_picon',
			[
				'label' => __( 'آیکن', 'mweb' ),
				'type' => 'iconpicker',
			]
		);
		
		$this->add_control(
			'title_icon_color',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .block-title .title svg' => 'stroke: {{VALUE}}; fill: {{VALUE}}',
					'{{WRAPPER}} .bk_view_more svg' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'title_icon_size',
			[
				'label' => __( 'اندازه آیکن', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 24,
				],
				'selectors' => [
					'{{WRAPPER}} .block-title .title svg' => 'width: {{SIZE}}{{UNIT}};',
				]
			]
		);
		
		$this->add_control(
			'show_print',
			[
				'label' => __( 'نمایش دکمه پرینت', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [ 'title!' => '' ],
				'prefix_class' => 'datatable-show-print-',

			]
		);
		
		$this->add_control(
			'show_excel',
			[
				'label' => __( 'نمایش دکمه اکسل', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [ 'title!' => '' ],
				'prefix_class' => 'datatable-show-excel-',
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'header_background',
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .block-title',
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_filter',
			[
				'label' => __( 'فیلتر', 'mweb' ),
			]
		);
		
		$this->add_control(
			'is_archive',
			[
				'label' => __( 'استفاده در آرشیو', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'yes' => __( 'بله', 'mweb' ),
					'no' => __( 'خیر', 'mweb' ),
				]
			]
		);

		$this->add_control(
			'category_id',
			[
				'label' => __( 'انتخاب دسته بندی', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 0,
				'options' => get_element_category_list('product_cat'),
				'condition' => [ 'is_archive' => ['no'] ],
			]
		);
		
		$this->add_control(
			'brand_id',
			[
				'label' => __( 'انتخاب برند', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 0,
				'options' => get_element_category_list(apply_filters('mweb_product_brand_taxonomy', 'product_brand')),
			]
		);
		
		$this->add_control(
			'posts_per_page',
			[
				'label' => __( 'تعداد مطالب', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 10,
			]
		);
		
		$this->add_control(
			'offset',
			[
				'label' => __( 'نقطه شروع مطالب', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '',
				'description' => 'offset باعث می شود چند نتیجه اول را رد کند و از آنجا به بعد تعداد پست به شما دهد',
			]
		);

		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_type',
			[
				'label' => __( 'نمـایش', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'product_attribute',
			[
				'label' => __( 'انتخاب ویژگی ها', 'mweb' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $this->get_attributes()
			]
		);
		
		$this->add_control(
			'show_product_photo',
			[
				'label' => __( 'نمایش عکس محصول', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'show_product_sku',
			[
				'label' => __( 'نمایش شناسه محصول', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'show_sku_as_id',
			[
				'label' => __( 'نمایش ایدی محصول به عنوان شناسه(sku)', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [ 'show_product_sku' => ['yes'] ],
			]
		);
		
		$this->add_control(
			'show_product_unit',
			[
				'label' => __( 'نمایش واحد محصول', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'show_product_price',
			[
				'label' => __( 'نمایش قیمت', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'show_product_update',
			[
				'label' => __( 'نمایش تاریخ بروزرسانی', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		
		$this->add_control(
			'show_product_chart',
			[
				'label' => __( 'نمایش نمودار قیمت', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'show_product_buy',
			[
				'label' => __( 'نمایش خرید', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'product_buy_type',
			[
				'label' => __( 'نوع خرید', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'مستقیم', 'mweb' ),
				'label_off' => __( 'پاپ آپ', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [ 'show_product_buy' => ['yes'] ],
			]
		);
		
		$this->add_control(
			'show_pagination',
			[
				'label' => __( 'نمایش صفحه بندی', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		
	
		
		$this->end_controls_section();
		
		
		
		$this->start_controls_section(
			'section_dtstyle',
			[
				'label' => __( 'تنظمیات DataTbale', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'dt_navigate',
			[
				'label' => __( 'نمایش صفحه بندی جدول', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		
		$this->add_control(
			'dt_num_record',
			[
				'label' => __( 'تعداد رکورد در هر صفحه جدول', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 10,
			]
		);
		
		$this->add_control(
			'dt_info',
			[
				'label' => __( 'نمایش جزئیات نمایش رکوردها', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		
		$this->add_control(
			'dt_search',
			[
				'label' => __( 'نمایش جستجو', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'no',
				'prefix_class' => 'elementor-dt-search-',
			]
		);
		
		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'استایل', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		/* $this->add_control(
			'tb_rm_style',
			[
				'label' => __( 'حذف استایل جدول', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'no',
				'prefix_class' => 'elementor-tb-rm-style-',
			]
		); */
		
		$this->add_control(
			'bk_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .mweb-block-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'bk_box_shadow',
				'selector' => '{{WRAPPER}} .mweb-block-wrap',
			]
		);
		
		$this->add_control(
			'bk_padding',
			[
				'label' => __( 'فاصله داخلی', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .mweb-block-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'bk_bg_color',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mweb-block-wrap' => 'background-color: {{VALUE}}',
				],
			]
		);
	

		$this->end_controls_section();
		

	}
	
	
	public function get_attributes() {
		if(empty($this->attributes))
			$this->attributes = get_wc_attribute_taxonomies();
		return $this->attributes; 
	}
	
	public function get_query() {
		return $this->query;
	}
	
	
	public function get_current_page() {
		return max( 1, get_query_var( 'paged' ), get_query_var( 'page' ) );
	}

	private function get_wp_link_page( $i ) {
		if ( ! is_singular() || is_front_page() ) {
			return get_pagenum_link( $i );
		}

		// Based on wp-includes/post-template.php:957 `_wp_link_page`.
		global $wp_rewrite;
		$post = get_post();
		$query_args = [];
		$url = get_permalink();

		if ( $i > 1 ) {
			if ( '' === get_option( 'permalink_structure' ) || in_array( $post->post_status, [ 'draft', 'pending' ] ) ) {
				$url = add_query_arg( 'page', $i, $url );
			} elseif ( get_option( 'show_on_front' ) === 'page' && (int) get_option( 'page_on_front' ) === $post->ID ) {
				$url = trailingslashit( $url ) . user_trailingslashit( "$wp_rewrite->pagination_base/" . $i, 'single_paged' );
			} else {
				$url = trailingslashit( $url ) . user_trailingslashit( $i, 'single_paged' );
			}
		}

		if ( is_preview() ) {
			if ( ( 'draft' !== $post->post_status ) && isset( $_GET['preview_id'], $_GET['preview_nonce'] ) ) {
				$query_args['preview_id'] = wp_unslash( $_GET['preview_id'] );
				$query_args['preview_nonce'] = wp_unslash( $_GET['preview_nonce'] );
			}

			$url = get_preview_post_link( $post, $query_args, $url );
		}

		return $url;
	}

	public function get_posts_nav_link( $page_limit = null ) {
		if ( ! $page_limit ) {
			$page_limit = $this->get_query->max_num_pages;
		}

		$return = [];

		$paged = $this->get_current_page();

		$link_template = '<a class="page-numbers %s" href="%s">%s</a>';
		$disabled_template = '<span class="page-numbers %s">%s</span>';

		if ( $paged > 1 ) {
			$next_page = intval( $paged ) - 1;
			if ( $next_page < 1 ) {
				$next_page = 1;
			}

			$return['prev'] = sprintf( $link_template, 'prev', $this->get_wp_link_page( $next_page ), $this->get_settings( 'pagination_prev_label' ) );
		} else {
			$return['prev'] = sprintf( $disabled_template, 'prev', $this->get_settings( 'pagination_prev_label' ) );
		}

		$next_page = intval( $paged ) + 1;

		if ( $next_page <= $page_limit ) {
			$return['next'] = sprintf( $link_template, 'next', $this->get_wp_link_page( $next_page ), $this->get_settings( 'pagination_next_label' ) );
		} else {
			$return['next'] = sprintf( $disabled_template, 'next', $this->get_settings( 'pagination_next_label' ) );
		}

		return $return;
	}
	
	
	public function query_posts() {

		$args = array(
			'posts_per_page' => $this->get_settings('posts_per_page'),
			'ignore_sticky_posts' => 1,
			'post_status' => 'publish',
			'post_type' => 'product',
			'paged' => $this->get_current_page(),
			
		);
		
		if($this->get_settings('is_archive') == 'no'){
			$args['tax_query'] = array();
			if(!empty($this->get_settings('category_id'))){
				if(!empty($this->get_settings('brand_id'))){
					$args['tax_query']['relation'] = 'AND';
				}
				$args['tax_query'][] = array(
					array(
						'taxonomy' => 'product_cat',
						'terms'    => $this->get_settings('category_id')
					)
				);
			}
			if(!empty($this->get_settings('brand_id'))){
				$args['tax_query'][] = array(
					array(
						'taxonomy' => apply_filters('mweb_product_brand_taxonomy', 'product_brand'),
						'terms'    => $this->get_settings('brand_id')
					)
				);
			}
		}else{
			 global $wp_query;
			$category_ar = $wp_query->get_queried_object();
			if(!empty($category_ar) && !is_wp_error($category_ar)){
				if(isset($category_ar->term_id))
					$args['tax_query'] = array(
						array(
							'taxonomy' => 'product_cat',
							'terms'    => $category_ar->term_id
						)
					);
			}
		}
		
		$this->query = new \WP_Query( $args );

		
	}
	
	
	
	
	protected function render() {
				
		$settings = $this->get_settings_for_display();
						
		$block = array('block_id' => 'mweb_'.$this->get_id(), 'block_name' => 'mweb_'.$this->get_name(), 'block_options' => array('title' => $settings['title'], 'icon' => $settings['title_picon']));
		
		$this->query_posts();

		$query_data = $this->get_query();
		
		$page_limit = $query_data->max_num_pages; 
		
		$product_attribute = $settings['product_attribute'];
				
		echo \mweb_theme_block::block_open( $block, $query_data );
		
		$el_tools = '';
				
		if( $settings['show_print'] == 'yes' )
			$el_tools .= '<span class="bkt_tools elm_print" data-toggle="tooltip" data-original-title="چاپ"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#printer"></use></svg></span>';
		if( $settings['show_excel'] == 'yes' )
			$el_tools .= '<span class="bkt_tools elm_exp_excel" data-toggle="tooltip" data-original-title="خروجی اکسل"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#document-download"></use></svg></span>';
		
		if( is_tax() && $settings['is_archive'] == 'yes' ){
			echo '<header class="woocommerce-products-header block-title">';
				echo '<h1 class="woocommerce-products-header__title page-title title">';
					if ( is_product_category() ){
						global $wp_query;
						$cat = $wp_query->get_queried_object();
						$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
						$image = wp_get_attachment_url( $thumbnail_id );
						if ( $image ) {
							echo '<img class="archive_thumbnail" src="' . $image . '" alt="' . $cat->name . '" />';
						}else{
							echo '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#category-2"></use></svg>';
						}
					}else{
						echo '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#category-2"></use></svg>';
					}
					woocommerce_page_title();
				echo '</h1>';
				echo $el_tools;
			echo '</header>';
		}else{
			if ( !empty( $settings['title'] ) ) {
				
				$block_icon = '';
				if ( !empty( $settings['title_picon'] ) ) {
					$block_icon = $settings['title_picon'];
				}else{
					$block_icon = '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#category-2"></use></svg>';
				}

				echo '<div class="block-title elm_bt_title"><div class="title">'.$block_icon.' '.esc_html( $settings['title'] ). '</div>'.$el_tools.'</div>';
				
			}
		}
		
		
		$temp = get_wc_attribute_taxonomies();
		
		echo \mweb_theme_block::block_content_open();
		
		if ( $query_data->have_posts() ) {
			// product_list_table elm_table
			echo '<table class="elm_datatable'. ( $settings['title'] ? ' elm_bthas_title' : '' ) .'" id="dt_'.$this->get_id().'">';
				echo '<thead><tr>';
					if($settings['show_product_photo'] == 'yes')
						echo '<th class="th_img">عکس</th>';
					if($settings['show_product_sku'] == 'yes')
						echo '<th class="th_sku">کد</th>';
					echo '<th class="th_title">نام</th>';
					if(!empty($product_attribute)){
						foreach($product_attribute as $attr){
							echo '<th class="th_attribute">'.$temp[$attr].'</th>';
						}
					}
					if($settings['show_product_unit'] == 'yes')
						echo '<th class="th_unit">واحـد</th>';
					if($settings['show_product_update'] == 'yes')
						echo '<th class="th_upadte">بروزرسانی</th>';
					if($settings['show_product_price'] == 'yes')
						echo '<th class="th_price">قیمت</th>';
					if($settings['show_product_chart'] == 'yes' || $settings['show_product_buy'] == 'yes')
						echo '<th class="th_action">عملیات</th>';
				
				echo '</tr></thead>';
				echo '<tbody>';

				while ( $query_data->have_posts() ) : $query_data->the_post();
					
					global $product;
					
					$product_id = get_the_ID();
					
					echo '<tr>';
					
					if($settings['show_product_photo'] == 'yes')
						echo '<td class="td_img">'. woocommerce_get_product_thumbnail('simplev') .'</td>';
					
					if($settings['show_product_sku'] == 'yes'){
						$prd_sku = $settings['show_sku_as_id'] == 'yes' ? $product_id : $product->get_sku();
						echo '<td class="td_sku" data-title="شناسه">'.$prd_sku.'</td>';
					}
						
					
					echo '<td class="td_title" data-title="عنوان"><a href="'.get_permalink().'">'.get_the_title().'</a></td>';
					
					if(!empty($product_attribute)){
						foreach($product_attribute as $attr){
							$terms = wc_get_product_terms( $product_id, 'pa_'.$attr, array( 'fields' => 'all' ) );
							$attr_tax = '';
							if(!empty($terms)){
								foreach($terms as $tax ){
									$attr_tax .= '<span>'.$tax->name.'</span>';
								}
							}
							echo '<td class="td_attribute" data-title="'.$temp[$attr].'">'.$attr_tax.'</td>';
						}
					}
					
					if($settings['show_product_unit'] == 'yes'){
						$prd_unit = get_post_meta( $product_id, '_product_unit', true );
						echo '<td class="td_unit" data-title="واحد">'.$prd_unit.'</td>';
					}
					
					if($settings['show_product_update'] == 'yes'){
						$last_modified = get_post_meta( get_the_ID(), '_show_last_modified', true );
						$last_modified_date = get_post_meta( get_the_ID(), '_custom_last_modified', true );
						
						if( empty($last_modified_date) ){
							echo '<td class="td_update" data-title="بروزرسانی">'. get_the_modified_date( get_option( 'date_format' ) ) .'</td>';
						}else{
							echo '<td class="td_update" data-title="بروزرسانی">'. date_i18n( get_option( 'date_format' ), strtotime( $last_modified_date ) ) .'</td>';
						}
					}
					
					if($settings['show_product_price'] == 'yes'){
						$my_flag = '';
						$my_price_old = mweb_last_price_data($product_id);
						if(!empty($my_price_old)){
							$old_price = $product->is_on_sale() ? $product->get_regular_price() : $my_price_old->price;
							$current_price = $product->is_on_sale() ? $product->get_sale_price() : $product->get_regular_price();
							if( !empty($current_price) ){
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
						
					if($settings['show_product_chart'] == 'yes' || $settings['show_product_buy'] == 'yes'){
						$my_action = '';
						$show_price_chart = get_post_meta($product_id, '_show_price_chart' , true);
						if($settings['show_product_chart'] == 'yes' && $show_price_chart == 'yes' && !empty($my_price_old))
							$my_action .= '<a href="javascript:void(0);" class="btn btn_price_chart" data-product_id="'.$product_id.'" title="نمودار قیمت" data-toggle="tooltip"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#chart-2"></use></svg></a>';
						
						if($settings['show_product_buy'] == 'yes'){
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
			
		} else {
			echo mweb_no_content();
		}	
		//reset post data
		wp_reset_postdata();
		
		echo \mweb_theme_block::block_content_close();
		
		$links = [];
		if ( 2 < $page_limit && $settings['show_pagination'] == 'yes') {
			$paginate_args = [
				'type' => 'array',
				'current' => $this->get_current_page(),
				'total' => $page_limit,
				'prev_next' => false,
				'show_all' => false,
				'before_page_number' => '<span class="elementor-screen-only">' . __( 'Page', 'elementor-pro' ) . '</span>',
			];

			$big = 999999999; 

			if ( is_singular() && ! is_front_page() ) {
				global $wp_rewrite;
				if ( $wp_rewrite->using_permalinks() ) {
					$paginate_args['base'] = str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );
					$paginate_args['format'] = user_trailingslashit( '%#%', 'single_paged' );
				} else {
					$paginate_args['format'] = '?page=%#%';
				}
			}

			$links = paginate_links( $paginate_args );
			
			
			echo '<div class="pagination-wrap clear">';
				echo '<div class="pagination-num">';
					echo implode( PHP_EOL, $links );
				echo '</div>';
			echo '</div>';
			
		}
		ob_start();
		?>
		(function($) {
			"use strict";
			$(document).ready(function() {
				var dtarag = {
					destroy: true,
					lengthChange: false,
					info: <?= $settings['dt_info'] == 'yes' ? 'true': 'false' ?>,
					pageLength: <?= $settings['dt_num_record'] ?>,
					paging: <?= $settings['dt_navigate'] == 'yes' ? 'true': 'false' ?>, 
					pagingType: 'simple',
					responsive: true,
					language: {
						"loadingRecords": "بارگذاری ...",
						"processing": "",
						"search": "جستجو",
						"zeroRecords": "هیچ محصولی با این ویژگی یافت نشد",
						"info": "نمایش _START_ تا _END_ از _TOTAL_",
						"infoEmpty": "نمایش 0 تا 0 از 0",
						'paginate': {
							'previous': '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#arrow-left-1"></use></svg>',
							'next': '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#arrow-right-1"></use></svg>'
						},
					},
				}
				var table = $(<?= 'dt_'.$this->get_id(); ?>).DataTable(dtarag);
			 });
		})(jQuery);
			
		<?php
		wp_add_inline_script( 'datatable', ob_get_clean() );
		
		echo \mweb_theme_block::block_footer( $block );
		echo \mweb_theme_block::block_close();
		
	}


	protected function content_template() {
		
	}
}





/**
 * Elementor Module Products Table as Tab
 * @since 1.0.0
 */
class Block_Product_Table_Tabs extends Widget_Base {

	protected $attributes = null;
	
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);

		wp_register_script('highcharts', THEME_ASSET . '/js/highcharts.js', array('jquery'), THEME_VERSION, true);

	}

	public function get_script_depends() {
		return [ 'highcharts' ];
	}
	
	public function get_name() {
		return 'product-table-tabs';
	}

	
	public function get_title() {
		return __( 'تب بندی جدول محصولات', 'mweb' );
	}

	
	public function get_icon() {
		return 'eicon-table';
	}

	
	public function get_categories() {
		return [ 'digiland' ];
	}


	protected function register_controls() {
		
		
		$this->start_controls_section(
			'section_filter',
			[
				'label' => __( 'فیلتر', 'mweb' ),
			]
		);
		
		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
			'category_id',
			[
				'label' => __( 'انتخاب دسته', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 0,
				'options' => get_element_category_list('product_cat'),
			]
		);
		
		$repeater->add_control(
			'select_icon_warning',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => __( 'تنها یکی از دو مورد زیر قابل انتخاب است', 'mweb' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			]
		);
		
		$repeater->add_control(
			'category_photo',
			[
				'label' => __( 'تصویر دسته', 'mweb' ),
				'type' => Controls_Manager::MEDIA,
			]
		);
		

		$repeater->add_control(
			'category_icon',
			[
				'label' => __( 'آیکن', 'mweb' ),
				'type' => 'iconpicker',
			]
		);
		
		$this->add_control(
			'cat_list',
			[
				'label' => __( 'دسته بندی', 'mweb' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ category_id }}}',
			]
		);
		
		$this->add_control(
			'posts_per_page',
			[
				'label' => __( 'تعداد محصول', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 10,
				'min' => 1,
			]
		);
		
		$this->add_control(
			'show_print',
			[
				'label' => __( 'نمایش دکمه پرینت', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		
		$this->add_control(
			'show_excel',
			[
				'label' => __( 'نمایش دکمه اکسل', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		

		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_type',
			[
				'label' => __( 'ویژگی ها', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'product_attribute',
			[
				'label' => __( 'انتخاب ویژگی ها', 'mweb' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $this->get_attributes()
			]
		);
		
		$this->add_control(
			'show_product_photo',
			[
				'label' => __( 'نمایش عکس محصول', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'show_product_sku',
			[
				'label' => __( 'نمایش شناسه محصول', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'show_product_unit',
			[
				'label' => __( 'نمایش واحد محصول', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'show_product_price',
			[
				'label' => __( 'نمایش قیمت', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'show_product_chart',
			[
				'label' => __( 'نمایش نمودار قیمت', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'show_product_buy',
			[
				'label' => __( 'نمایش خرید', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'product_buy_type',
			[
				'label' => __( 'نوع خرید', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'مستقیم', 'mweb' ),
				'label_off' => __( 'پاپ آپ', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [ 'show_product_buy' => ['yes'] ],
			]
		);
		

		$this->end_controls_section();
		

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'استایل', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'header_background',
				'label' => __( 'رنگ پس زمینه دکمه ها', 'mweb' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .block-title',
			]
		);
		
		$this->add_control(
			'tab_align_element',
			[
				'label' => __( 'تراز محتوای تب', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'column',
				'options' => [
					'column' => __( 'عمودی', 'mweb' ),
					'row' => __( 'افقی', 'mweb' ),
				],
				'selectors' => [
					'{{WRAPPER}} .tab_box li a' => 'flex-direction: {{VALUE}}',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_style' );

		$this->start_controls_tab( 'normal_tabs_style',
			[
				'label' => __( 'حالت پیشفرض', 'mweb' ),
			]
		);

		$this->add_control(
			'tab_text_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tab_box li a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'tab_bg_color',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'alpha' => false,
				'selectors' => [
					'{{WRAPPER}} .tab_box li' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'tab_icon_color',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tab_box li svg' => 'fill: {{VALUE}}; stroke: {{VALUE}}',
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'active_tabs_style',
			[
				'label' => __( 'حالت فعال', 'mweb' ),
			]
		);

		$this->add_control(
			'active_tab_text_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tab_box li.active a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'active_tab_bg_color',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'alpha' => false,
				'selectors' => [
					'{{WRAPPER}} .tab_box li.active' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .tab_box li:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'active_tab_icon_color',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tab_box li.active svg' => 'fill: {{VALUE}}; stroke: {{VALUE}}',
					'{{WRAPPER}} .tab_box li:hover svg' => 'fill: {{VALUE}}; stroke: {{VALUE}}',
				]
			]
		);
		
		$this->add_control(
			'active_tab_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .tab_box li.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'separator_tabs_style',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		
		
		$this->add_control(
			'horizontal_align_element',
			[
				'label' => __( 'تراز افقی المان ها', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'space-between',
				'options' => [
					'flex-start' => __( 'راست', 'mweb' ),
					'center' => __( 'وسط', 'mweb' ),
					'space-between' => __( 'فاصله دار', 'mweb' ),
				],
				'selectors' => [
					'{{WRAPPER}} .tab_box' => 'justify-content: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tab_typography',
				'label' => __( 'تایپوگرافی', 'mweb' ),
				'selector' => '{{WRAPPER}} .tab_box li a',
			]
		);

		$this->add_control(
			'tab_img_size',
			[
				'label' => __( 'اندازه عکس / آیکن', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 15,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 25,
				],
				'selectors' => [
					'{{WRAPPER}} .tab_box li img' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tab_box li svg' => 'width: {{SIZE}}{{UNIT}};',
				]
			]
		);
		
		$this->add_control(
			'tab_icon_margin',
			[
				'label' => __( 'فاصله خارجی عکس/آیکن', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tab_box li img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .tab_box li svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'tab_padding',
			[
				'label' => __( 'فاصله داخلی تب', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tab_box li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'tab_margin',
			[
				'label' => __( 'فاصله خارجی تب', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tab_box li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'tab_border_radius',
			[
				'label' => __( 'گوشه های مدور تب', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .tab_box li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tab_box_shadow',
				'selector' => '{{WRAPPER}} .tab_box li',
			]
		);

		$this->end_controls_section();
		
		
	
		
		
	}


	public function get_attributes() {
		if(empty($this->attributes))
			$this->attributes = get_wc_attribute_taxonomies();
		return $this->attributes; 
	}
	
	public function render_tab( $categories, $show_print, $show_excel ) {

		$is_first = true;
		$str = '';
		if(!empty($categories)){
			$str .= '<ul class="tab_box scrolling-wrapper">';
			foreach ($categories as $cat) {
				$cat_name = mweb_get_product_cat_name($cat['category_id']);
				$el_class = 'category-'.$cat['category_id'];
				if( $is_first ){
					$el_class .= ' active';
					$is_first = false;
				}
				$str .= '<li class="'.$el_class.'"><a href="'.  mweb_get_product_cat_link($cat['category_id']) .'" data-ajax_filter_val="'.$cat['category_id'].'" title="'.$cat_name.'">';
				if( !empty($cat['category_photo']['url']) ){
					$str .=  '<img src="'. esc_url( $cat['category_photo']['url'] ) .'">';
				}elseif( !empty($cat['category_icon']) ){
					$str .=  $cat['category_icon'];
				}
					
				$str .= $cat_name .'</a></li>';
			}
			$str .= '</ul>';
							
			
		}else{
			$str .= '<div class="mweb-error"><h3>لطفا فیلتر دسته بندی و فیلتر دسته بندی ها را از پنل انتخاب کنید</h3></div>';
		}
		
		if( $show_print == 'yes' || $show_excel == 'yes' ){
			$str .= '<div class="block-title elm_bt_title has_tools">';
				if( $show_print == 'yes' )
					$str .= '<span class="bkt_tools elm_print" data-toggle="tooltip" data-original-title="چاپ"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#printer"></use></svg></span>';
				if( $show_excel == 'yes' )
					$str .= '<span class="bkt_tools elm_exp_excel" data-toggle="tooltip" data-original-title="خروجی اکسل"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#document-download"></use></svg></span>';
			$str .= '</div>';
		}
		return $str;
		
	}

	
	protected function render() {

		$settings = $this->get_settings_for_display();

		$data_setting = array();
		$data_setting['attributes'] = empty($settings['product_attribute']) ? null : $settings['product_attribute'];
		$data_setting['product_photo'] = $settings['show_product_photo'];
		$data_setting['product_unit'] = $settings['show_product_unit'];
		$data_setting['product_price'] = $settings['show_product_price'];
		$data_setting['product_chart'] = $settings['show_product_chart'];
		$data_setting['product_buy'] = $settings['show_product_buy'];
		$data_setting['product_buy_type'] = $settings['product_buy_type'];
		$data_setting['product_sku'] = $settings['show_product_sku'];
		$data_setting['has_icon'] = $show_print == 'yes' || $show_excel == 'yes' ? 'yes' : 'no';
						
		$category_id = !empty($settings['cat_list']) ? $settings['cat_list'][0]['category_id'] : 0;
		$query_options = array('category_id' => $category_id, 'posts_per_page' => $settings['posts_per_page'], 'ajax_dropdown' => 'category', 'post_type' => 'product' );
				
		$block = array('block_id' => 'mweb_'.$this->get_id(), 'block_name' => 'mweb_product_list_as_table', 'block_options' => array( 'bk_param' => true, 'other' => $data_setting ));
		$block['block_options'] = array_merge( $block['block_options'], $query_options );
		

		$query_data = \mweb_theme_query::get_custom_query( $query_options );
		
				
		echo \mweb_theme_block::block_open( $block, $query_data );
		echo $this->render_tab( $settings['cat_list'], $settings['show_print'], $settings['show_excel'] );
		echo \mweb_theme_block::block_content_open();	
		
		//check empty
		if ( $query_data->have_posts() ) {
			echo mweb_product_list_as_table($query_data, $data_setting);
		} else {
			echo mweb_no_content();
		}
		//reset post data
		wp_reset_postdata();
		
		echo \mweb_theme_block::block_content_close();
		echo \mweb_theme_block::block_footer( $block );
		echo \mweb_theme_block::block_close();
		
		
	}

	
	function content_template() {
		
	}
}





