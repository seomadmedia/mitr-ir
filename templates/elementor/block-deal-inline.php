<?php
namespace ElementorMahdisweb\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Module Deal inline Slider
 * @since 1.0.0
 */
class Block_Deal_Inline extends Widget_Base {

	public function get_name() {
		return 'carousel-onsale-product';
	}

	
	public function get_title() {
		return __( 'فروش  ویژه دو', 'mweb' );
	}

	
	public function get_icon() {
		return 'eicon-carousel';
	}

	
	public function get_categories() {
		return [ 'digiland' ];
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
				'default' => __( 'پیشنهادات شگفت انگیز', 'mweb' ),
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
			'category_id',
			[
				'label' => __( 'انتخاب دسته بندی', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 0,
				'options' => get_element_category_list('product_cat'),
			]
		);
		$this->add_control(
			'posts_per_page',
			[
				'label' => __( 'تعداد مطالب', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 5,
				'min' => 1,
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
			'block_name',
			[
				'label' => __( 'نوع نمایش', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => mweb_get_product_list_templates(),
				'default' => 'type-0',
				'prefix_class' => 'product-',
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ptitle_typography',
				'label' => __( 'تایپوگرافی عنوان محصول', 'mweb' ),
				'selector' => '{{WRAPPER}} .item .item-area .product-name',
			]
		);
		
		$this->add_control(
			'price_text_size',
			[
				'label' => __( 'اندازه متن قیمت', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 13,
				],
				'selectors' => [
					'{{WRAPPER}} .item .item-area .price' => 'font-size: {{SIZE}}{{UNIT}};',
				]
			]
		);
		
		
		$this->add_responsive_control(
			'product_title_alignment',
			[
				'label' => __( 'تراز', 'mweb' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'چپ', 'mweb' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'وسط', 'mweb' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'راست', 'mweb' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .item .item-area:not(.general_mobile) .product-name' => 'text-align: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'item_thumbnail', 
				'exclude' => [ 'custom' ],
				//'include' => [],
				'default' => 'woocommerce_thumbnail',
			]
		);
		
		$this->add_control(
			'bg_color',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .deal_left_timer' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .deal_left_timer .product-date>div span.no:after' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'item_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .item-area' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .item-area' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
	
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'item_box_shadow',
				'selector' => '{{WRAPPER}} .item-area',
				'selector' => '{{WRAPPER}} .deal_left_timer',
			]
		);
		
		$this->add_control(
			'svgi_color',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dleft_svg_i' => 'fill: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'svgb_color',
			[
				'label' => __( 'رنگ هم رنگ پس زمینه آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dleft_svg_b' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'تنظیمات اسلایدر', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$slides_to_show = range( 1, 10 );
		$slides_to_show = array_combine( $slides_to_show, $slides_to_show );
		
		$this->add_responsive_control(
			'slides_to_show',
			[
				'label' => __( 'اسلاید جهت نمایش', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'پیشفرض', 'mweb' ),
				] + $slides_to_show,
				'default' => 3,
			]
		);
		
		$this->add_control(
			'slides_spaceBetween',
			[
				'label' => __( 'فاصله از هم', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 50,
				'step' => 1,
				'default' => 15,
			]
		);
		
		$this->add_control(
			'navigation',
			[
				'label' => __( 'جهت بندی', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'arrows' => __( 'فلش', 'mweb' ),
					'none' => __( 'هیچ', 'mweb' ),
				]
			]
		);
		
		$this->add_control(
			'navigation_show',
			[
				'label' => __( 'نمایش دکمه فلش ثابت', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'prefix_class' => 'swiper-slider-arrows-fixed-',
				'condition' => [ 'navigation' => ['both', 'arrows'] ],
			]
		);
		
		$this->add_control(
			'autoplay',
			[
				'label' => __( 'پخش خودکار', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __( 'بله', 'mweb' ),
					'no' => __( 'خیر', 'mweb' ),
				]
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label' => __( 'توقف در هاور', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __( 'بله', 'mweb' ),
					'no' => __( 'خیر', 'mweb' ),
				]
			]
		);
		
		$this->add_control(
			'infinite',
			[
				'label' => __( 'حلقه بی نهایت', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __( 'بله', 'mweb' ),
					'no' => __( 'خیر', 'mweb' ),
				]
			]
		);
		
		$this->add_control(
			'is_3d',
			[
				'label' => __( 'سه بعدی', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'yes' => __( 'بله', 'mweb' ),
					'no' => __( 'خیر', 'mweb' ),
				]
			]
		);
		
		$this->end_controls_section();


	}


	protected function render() {
		
		$settings = $this->get_settings_for_display();
		
		$query_options = array('category_id' => $settings['category_id'], 'posts_per_page' => $settings['posts_per_page'], 'orderby' => 'on_sale', 'post_type' => 'product' );
	
		$query_data = \mweb_theme_query::get_custom_query( $query_options );

		$show_dots = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
		$show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
		
		$data_setting = array();
		
		$slide_tablet = empty($settings['slides_to_show_tablet']) ? 2 : $settings['slides_to_show_tablet'];
		$slide_mobile = empty($settings['slides_to_show_mobile']) ? 1 : $settings['slides_to_show_mobile'];
		
		$data_setting['slidesPerView'] = $slide_mobile;
		$data_setting['spaceBetween'] = $settings['slides_spaceBetween'];
		$data_setting['watchSlidesVisibility'] = true;
		
		if( $settings['infinite'] == 'yes'){
			$data_setting['loop'] = true;
		}
		if( $settings['autoplay'] == 'yes'){
			$data_setting['autoplay'] = true;
		}
		if( $settings['pause_on_hover'] == 'yes'){
			$data_setting['touchMoveStopPropagation'] = true;
		}
		
		if($settings['is_3d'] == 'yes'){
			$data_setting['effect'] = 'coverflow';
			$data_setting['grabCursor'] = true;
			//$data_setting['slidesPerView'] = 'auto';
			$data_setting['coverflowEffect'] = array('rotate' => 30, 'stretch' => 0, 'depth' => 100, 'modifier' => 1, 'slideShadows' => true);
		}
	
		if( $show_dots ){
			$data_setting['pagination'] = array('el' => '.mweb-swiper-pagination', 'clickable' => true);
		}
		if( $show_arrows ){
			$data_setting['navigation'] = array('nextEl' => '.mweb-swiper-next', 'prevEl' => '.mweb-swiper-prev' );
		}



		$data_setting['breakpoints'] = array('575' => array('slidesPerView' => $slide_mobile), '768' => array('slidesPerView' => $slide_tablet), '1024' => array('slidesPerView' => $settings['slides_to_show']));
			
		$arrow_right = 'arrow-right-1';
		$arrow_left = 'arrow-left-1';
			
		$attr_class = 'swiper xslider';
	
		$this->add_render_attribute( [
			'carousel-wrapper' => [
				'class' => $attr_class,
				'id' => 'sl_'.$this->get_id(),
				'dir' => 'rtl',
				'data-slider' => wp_json_encode($data_setting)
			],
		] );
		
		$loop_arg = [];
		$style_type = $settings['block_name'];
		if( $style_type == 'type-0' || $style_type == 'type-1' ){
			$loop_func = 'general';
		}else{
			$loop_func = 'general_'.$style_type[-1];
		}
		
		$wp_is_mobile = wp_is_mobile();
		
		if( $wp_is_mobile ){
			$settings['loop_type'] = apply_filters('general_product_type', 'prdtype_default');
			$settings['block_name'] = 'module_mobile';
			$loop_func = 'mobile';
		} 
		
		$loop_name = 'mweb_loop_template_product_'.$loop_func;
		
		
		if ( $style_type == 'type-1'){
			$loop_arg['rating'] = true;
		}
		
		$loop_arg['thumbnail'] = isset($settings['item_thumbnail_size']) ? $settings['item_thumbnail_size'] : '';


		$product_title = '';
			
		$array_time = array();
		$array_percentage = array();
		
		//echo \mweb_theme_block::block_open();
		echo \mweb_theme_block::block_content_open('row inline-deal-sliderWrap');

		if ( $query_data->have_posts() ) {
			echo '<div class="col-12 col-md-8 inline-deal-slider">';
			echo '<div '. $this->get_render_attribute_string( 'carousel-wrapper' ) .'>';
			echo '<div class="swiper-wrapper">';
				while ( $query_data->have_posts() ) : 
					$query_data->the_post(); 
					$tmp_time = mweb_deal_countdown_timer(null, true);
					echo '<div class="swiper-slide"><div class="item '. (empty($tmp_time) ? 'deal_ended' : '') .'">';
						$sale_html = mweb_get_sale_html();
						$array_percentage[] = !empty($sale_html) ? $sale_html->value : 0 ;
						if(!empty($tmp_time)){
							$array_time[] = $tmp_time;
							if(min($array_time) == $tmp_time){
								$product_title = get_the_title();
							}
								
						}		
						echo $loop_name( $loop_arg );
					echo '</div></div>';
				endwhile;
			echo '</div>';	
				if ( $show_dots ) { 
					echo '<div class="mweb-swiper-pagination"></div>';
				} 
				if ( $show_arrows ){
					echo '<div class="mweb-swiper-next"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#'.$arrow_right.'"></use></svg></div><div class="mweb-swiper-prev"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#'.$arrow_left.'"></use></svg></div>';
				}			
			echo '</div></div>';	
			?>
			<div class="col-12 col-md-4 deal_left_wrap">
				<div class="deal_left_timer">
					<div class="deal_title"><?php echo $settings['title']; ?></div>
					<?php if(!empty($array_percentage)){
						echo '<div class="deal_percentage"><span><b>'.max($array_percentage).'%</b></span></div>';
					}
					if(!empty($array_time)){
						echo '<strong>فرصت باقی مانده تا اتمام حراج محصول : <i>'.$product_title.'</i></strong><div class="product-date" data-date="'.date( 'Y-m-d H:i:s', min($array_time) ).'"></div>';
					} 
					?>
					<svg class="dleft_svg_b" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="176px" height="51px" viewBox="0 0 176 51">
						<path fill-rule="evenodd"  fill="inherit" d="M174.1000,50.1000 C175.335,50.1000 175.667,50.990 175.1000,50.982 L175.1000,50.1000 L174.1000,50.1000 ZM38.025,50.1000 L1.000,50.1000 C20.718,50.1000 37.764,39.582 45.904,23.000 L45.927,23.000 C54.821,9.169 70.335,0.000 88.000,0.000 C105.665,0.000 121.179,9.169 130.073,23.000 L130.096,23.000 C138.236,39.582 155.282,50.1000 174.1000,50.1000 L137.975,50.1000 L38.025,50.1000 ZM0.000,50.982 C0.333,50.990 0.665,50.1000 1.000,50.1000 L0.000,50.1000 L0.000,50.982 Z"/>
					</svg>

					<svg class="dleft_svg_i fa-fade" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="75px" height="75px" viewBox="0 0 75 75">
						<path fill-rule="evenodd"  fill="inherit" d="M49.050,74.000 C49.569,59.890 60.890,48.569 75.000,48.050 L75.000,74.000 L49.050,74.000 ZM26.429,70.320 C20.571,76.178 11.074,76.178 5.216,70.320 L4.509,69.613 C-1.349,63.755 -1.349,54.257 4.509,48.399 L48.349,4.559 C54.207,-1.299 63.705,-1.299 69.562,4.559 L70.270,5.266 C76.127,11.124 76.127,20.621 70.270,26.479 L26.429,70.320 ZM0.1000,25.950 L0.1000,0.000 L26.950,0.000 C26.431,14.110 15.110,25.431 0.1000,25.950 Z"/>
					</svg>
				
				</div>
			</div>
			<?php

		} else {
			echo mweb_no_content();
		}
		//reset post data
		wp_reset_postdata();
		
		echo \mweb_theme_block::block_content_close();
		//echo \mweb_theme_block::block_close();
		
		
		
	}

	
	protected function content_template() {
		
	}
}
