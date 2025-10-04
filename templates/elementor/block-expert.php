<?php
namespace ElementorMahdisweb\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Module Blog Slider
 * @since 1.0.0
 */
class Block_Expert extends Widget_Base {


	public function get_name() {
		return 'block-expert';
	}


	public function get_title() {
		return __( 'کارشناس فروش و پشتیبانی', 'mweb' );
	}


	public function get_icon() {
		return 'eicon-info-box';
	}


	public function get_categories() {
		return [ 'digiland' ];
	}


	protected function register_controls() {
		
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'محتوا', 'mweb' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
			'el_title',
			[
				'label' => __( 'نام و نام خانوادگی', 'mweb' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		
		$repeater->add_control(
			'el_position',
			[
				'label' => __( 'سمت', 'mweb' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		
		$repeater->add_control(
			'el_photo',
			[
				'label' => __( 'عکس کارشناس', 'mweb' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				]
			]
		);

		$repeater->add_group_control(
			'background',
			[
				'name' => 'el_background',
				'label' => __( 'رنگ حاشیه', 'mweb' ),
				'types' => [ 'gradient' ],
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .el_expert_photo'
			]
		);
		
		$repeater->add_control(
			'el_phone',
			[
				'label' => __( 'شماره تماس', 'mweb' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		
		$repeater->add_control(
			'el_telegram',
			[
				'label' => __( 'آیدی تلگرام', 'mweb' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'مثال : mahdisweb', 'mweb' ),
			]
		);
		
		$repeater->add_control(
			'el_whatsapp',
			[
				'label' => __( 'واتس آپ', 'mweb' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'مثال : +989370191111', 'mweb' ),
			]
		);

		$this->add_control(
			'list',
			[
				'label' => __( 'ایتم ها', 'mweb' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ el_title }}}',
			]
		);
		
		$this->add_control(
			'item_style',
			[
				'label' => __( 'ظاهر عکس', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'is_cr',
				'options' => [
					'is_sq'  => __( 'مربع', 'mweb' ),
					'is_cr' => __( 'دایره', 'mweb' ),
				],
				'prefix_class' => 'expert-photo-',
			]
		);
		
		$this->add_control(
			'item_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .el_expert' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .swiper-slide-shadow-left' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .swiper-slide-shadow-right' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'item_box_shadow',
				'selector' => '{{WRAPPER}} .el_expert',
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
				'default' => 1,
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
			'centeredSlides',
			[
				'label' => __( 'اسلاید وسط چین', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'yes' => __( 'بله', 'mweb' ),
					'no' => __( 'خیر', 'mweb' ),
				]
			]
		);
		
		$this->add_control(
			'effect',
			[
				'label' => __( 'استایل', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'cube',
				'options' => [
					'none' => __( 'هیچ', 'mweb' ),
					'is_3d' => __( 'سه بعدی', 'mweb' ),
					'cube' => __( 'مکعبی', 'mweb' ),
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
		
		$data_setting['slidesPerView'] = 1;
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
		if( $settings['centeredSlides'] == 'yes'){
			$data_setting['centeredSlides'] = true;
		}
		
		if($settings['effect'] == 'is_3d'){
			$data_setting['effect'] = 'coverflow';
			$data_setting['grabCursor'] = true;
			//$data_setting['slidesPerView'] = 'auto';
			$data_setting['coverflowEffect'] = array('rotate' => 30, 'stretch' => 0, 'depth' => 100, 'modifier' => 1, 'slideShadows' => true);
		}else{
			$data_setting['effect'] = 'cube';
			$data_setting['grabCursor'] = true;
			$data_setting['cubeEffect'] = array('shadow' => true, 'slideShadows' => true, 'shadowOffset' => 8, 'shadowScale' => 0.6);
		}
	
		if( $show_dots ){
			$data_setting['pagination'] = array('el' => '.mweb-swiper-pagination', 'clickable' => true);
		}
		if( $show_arrows ){
			$data_setting['navigation'] = array('nextEl' => '.mweb-swiper-next', 'prevEl' => '.mweb-swiper-prev' );
		}

		$slide_tablet = empty($settings['slides_to_show_tablet']) ? 1 : $settings['slides_to_show_tablet'];
		$slide_mobile = empty($settings['slides_to_show_mobile']) ? 1 : $settings['slides_to_show_mobile'];

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


		//echo \mweb_theme_block::block_open( $block, $query_data );
		//echo \mweb_theme_block::block_header( $block );
		echo \mweb_theme_block::block_content_open();
		
		//check empty
		if ( $settings['list'] ) {

			echo '<div '. $this->get_render_attribute_string( 'carousel-wrapper' ) .'>';
			echo '<div class="swiper-wrapper">';
				foreach (  $settings['list'] as $item ) {
					echo '<div class="swiper-slide">';
						echo '<div class="el_expert elementor-repeater-item-' . $item['_id'] . '">';
							if(!empty($item['list_link']['url'])){
								echo '<a href="' . esc_url( $item['list_link']['url'] ) . '" title="' . esc_attr( $item['list_title'] ) . '" ' . $target . $nofollow . '>';
							}
							echo '<div class="el_expert_photo"><img src="'. esc_url( $item['el_photo']['url'] ) .'"></div>';
							
							if(!empty($item['el_title']))
								echo '<h4>'. $item['el_title'] .'</h4>';
							
							if(!empty($item['el_position']))
								echo '<span class="el_expert_pos">'. $item['el_position'] .'</span>';
							
							if(!empty($item['el_phone'])){
								$num_strong = substr($item['el_phone'], 0, 3) == '091' ? 4 : 3;
									echo '<div class="el_expert_phone">'. ( strlen($item['el_phone']) > 8 ? '<strong>'.substr($item['el_phone'], 0, $num_strong).'</strong>'.substr($item['el_phone'], $num_strong) : $item['el_phone'] ) .'</div>';
							}
								
							
							if(!empty($item['el_telegram']) || !empty($item['el_whatsapp'])){
								echo '<div class="el_expert_contact">';
								
									if(!empty($item['el_telegram']))
										echo '<a class="el_ex_telegram" href="https://t.me/'. $item['el_telegram']. '" target="_blank"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#telegram"></use></svg></a>';
									
									if(!empty($item['el_whatsapp']))
										echo '<a class="el_ex_whatsapp" href="https://wa.me/'. $item['el_whatsapp']. '" target="_blank"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#whatsapp"></use></svg></a>';
									
								echo '</div>';
							}
						echo '</div>';
					echo '</div>';
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
			echo mweb_no_content();
		}
		
		echo \mweb_theme_block::block_content_close();
		//echo \mweb_theme_block::block_footer( $block );
		//echo \mweb_theme_block::block_close();
		
	}


	protected function content_template() {
		
	}
}
