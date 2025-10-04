<?php
namespace ElementorMahdisweb\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Module Service Slider
 * @since 1.0.0
 */
class Block_Service_Slider extends Widget_Base {


	public function get_name() {
		return 'block-service-slider';
	}


	public function get_title() {
		return __( 'اسلایدر خدمات', 'mweb' );
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
				'label' => __( 'تنظیمات موارد', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .support_info a span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'selector' => '{{WRAPPER}} .support_info a span',
			]
		);
		
		
		$this->add_control(
			'sicon_color',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .support_info svg' => 'stroke: {{VALUE}}; fill: {{VALUE}}',
				]
			]
		);
		
		$this->add_control(
			'img_size',
			[
				'label' => __( 'اندازه آیکن / تصویر', 'mweb' ),
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
					'size' => 40,
				],
				'selectors' => [
					'{{WRAPPER}} .support_info img, {{WRAPPER}} .support_info svg' => 'width: {{SIZE}}{{UNIT}};',
				]
			]
		);
		
		
		$this->add_control(
			'item_bg_color',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .support_info' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'item_padding',
			[
				'label' => __( 'فاصله داخلی', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .support_info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'item_margin',
			[
				'label' => __( 'فاصله خارجی', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .support_info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'item_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .support_info' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'item_box_shadow',
				'selector' => '{{WRAPPER}} .support_info',
			]
		);
		
		
		$this->add_control(
			'heading_hover_style',
			[
				'label' => __( 'استایل هاور / اگر آیکن بود', 'mweb' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);
				
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_color_hover',
				'label' => __( 'رنگ پس زمینه هاور', 'mweb' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .support_info:hover'
			]
		);
		
		
		$this->add_control(
			'color_hover',
			[
				'label' => __( 'رنگ متن هاور', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .support_info:hover a span' => 'color: {{VALUE}}',
				]
			]
		);
		
		$this->add_control(
			'icon_color_hover',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .support_info:hover svg' => 'stroke: {{VALUE}}; fill: {{VALUE}}',
				]
			]
		);
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_hover',
				'selector' => '{{WRAPPER}} .support_info:hover',
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
				'default' => 6,
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
				'default' => 'both',
				'options' => [
					'both' => __( 'فلش و دکمه', 'mweb' ),
					'arrows' => __( 'فلش', 'mweb' ),
					'dots' => __( 'دکمه', 'mweb' ),
					'none' => __( 'هیچ', 'mweb' ),
				],
				//'prefix_class' => 'swiper-slider-nav-',
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
				'default' => 'no',
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
				'default' => 'no',
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
				'default' => 'no',
				'options' => [
					'yes' => __( 'بله', 'mweb' ),
					'no' => __( 'خیر', 'mweb' ),
				]
			]
		);
		
		$this->add_control(
			'overflow',
			[
				'label' => __( 'حذف چهارچوب', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
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
		
		$show_dots = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
		$show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
		
		$data_setting = array();
		
		
		$slide_tablet = empty($settings['slides_to_show_tablet']) ? 4 : $settings['slides_to_show_tablet'];
		$slide_mobile = empty($settings['slides_to_show_mobile']) ? 2 : $settings['slides_to_show_mobile'];
		
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
		if($settings['overflow'] == 'yes'){
			$attr_class .= ' swiper-wrap-visible';
		}
		
		$support_info_title = \mweb_theme_util::get_theme_option('support_info_title');
		$support_info_link = \mweb_theme_util::get_theme_option('support_info_link');
		$support_info_icon = \mweb_theme_util::get_theme_option('support_info_icon');
		$support_info_style = \mweb_theme_util::get_theme_option('support_info_style');
		$support_info_img = \mweb_theme_util::get_theme_option('support_info_img');
		
		
		
		$font_icon = array(
			'delivery' => '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#truk-tick"></use></svg>',
			'return-policy' => '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#money-change"></use></svg>',
			'payment-terms' => '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#money-3"></use></svg>',
			'price-guarantee' => '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#discount-shape"></use></svg>',
			'origin-guarantee' => '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#verify"></use></svg>',
			'sendto-all' => '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#map"></use></svg>',
			'beauti-pack' => '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#gift"></use></svg>',
		);
		
		$this->add_render_attribute( [
			'carousel-wrapper' => [
				'class' => $attr_class,
				'id' => 'sl_'.$this->get_id(),
				'dir' => 'rtl',
				'data-slider' => wp_json_encode($data_setting)
			],
		] );
		
		
		if ( is_array($support_info_icon) ){
			echo '<div '. $this->get_render_attribute_string( 'carousel-wrapper' ) .'>';
				echo '<div class="swiper-wrapper">';
						if($support_info_style){
							$el_cls = 1;
							foreach ($support_info_icon as $key => $tl) { 
								echo '<div class="swiper-slide">';
									echo '<div class="support_info el_font el_s'.$el_cls++.'">';
									echo '<a href="'.$support_info_link[$key].'" title="'.$support_info_title[$key].'">'.$font_icon[$support_info_icon[$key]].'<span>'.$support_info_title[$key].'</span></a>';
									echo '</div>';
								echo '</div>';	
							}
						}else{
							foreach ($support_info_icon as $key => $tl) { 
								$my_icon = $font_icon[$support_info_icon[$key]];
								if(!empty($support_info_img[$key])){
									$img_size = !empty($settings['img_size']['size']) ? 'width="'.$settings['img_size']['size'].$settings['img_size']['unit'].'" height="'.$settings['img_size']['size'].$settings['img_size']['unit'].'"' : '';
									$my_icon = '<img src="'.esc_url($support_info_img[$key]).'" alt="'.$support_info_title[$key].'" '.$img_size.' />';
								}
								echo '<div class="swiper-slide">';
									echo '<div class="support_info">';
									echo '<a href="'.$support_info_link[$key].'" title="'.$support_info_title[$key].'">'.$my_icon.'<span>'.$support_info_title[$key].'</span></a>';
									echo '</div>';
								echo '</div>';	
							}
						}
				echo '</div>';	
				if ( $show_dots ) { 
					echo '<div class="mweb-swiper-pagination"></div>';
				} 
				if ( $show_arrows ){
					echo '<div class="mweb-swiper-next"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#'.$arrow_right.'"></use></svg></div><div class="mweb-swiper-prev"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#'.$arrow_left.'"></use></svg></div>';
				}			
			echo '</div>';
		} else {
			echo '<div class="support_info_empty">لیست خدمات خالی است از پنل تنظیمات اضافه کنید</div>';
		}
		
	}


	protected function content_template() {
		
	}
}
