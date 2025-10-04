<?php
namespace ElementorMahdisweb\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;



if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Module Service Slider
 * @since 1.0.1
 */
class Block_Service extends Widget_Base {

	
	public function get_name() {
		return 'block-service';
	}


	public function get_title() {
		return __( 'ایکن همراه با متن', 'mweb' );
	}

	
	public function get_icon() {
		return 'eicon-call-to-action';
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
				'label' => __( 'عنوان', 'mweb' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'تایپوگرافی عنوان', 'mweb' ),
				'selector' => '{{WRAPPER}} .service_content h4',
			]
		);
		
		$this->add_control(
			'subtitle',
			[
				'label' => __( 'توضیحات', 'mweb' ),
				'type' => Controls_Manager::TEXTAREA,
			]
		);
		
		$this->add_control(
			'bstyle',
			[
				'label' => __( 'استایل', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'one',
				'options' => [
					'one'  => __( 'یک', 'mweb' ),
					'two' => __( 'دو', 'mweb' ),
					'three' => __( 'سه', 'mweb' ),
				],
			]
		);
		$this->add_control(
			'textalign',
			[
				'label' => __( 'تراز متن', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [
					'left'  => __( 'چپ', 'mweb' ),
					'center' => __( 'وسط', 'mweb' ),
					'right' => __( 'راست', 'mweb' ),
				],
			]
		);
	
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_color',
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .mweb_service'
			]
		);
		
		
		$this->add_control(
			'color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .service_inner' => 'color: {{VALUE}}',
				]
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
			'icon_size',
			[
				'label' => __( 'اندازه آیکن', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'em' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 24,
				],
				'selectors' => [
					'{{WRAPPER}} .service_icon svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'iconcolor',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .service_icon svg' => 'stroke: {{VALUE}}; fill: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'لینک', 'mweb' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'mweb' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);
		
		$this->add_control(
			'item_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .mweb_service' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'item_box_shadow',
				'selector' => '{{WRAPPER}} .mweb_service',
			]
		);
		
		$this->add_control(
			'item_padding',
			[
				'label' => __( 'فاصله داخلی', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .mweb_service .service_inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'heading_hover_style',
			[
				'label' => __( 'استایل هاور', 'mweb' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
				
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_color_hover',
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .mweb_service:hover'
			]
		);
		
		
		$this->add_control(
			'color_hover',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .service_inner:hover' => 'color: {{VALUE}}',
				]
			]
		);
		
		$this->add_control(
			'icon_color_hover',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .service_inner:hover .service_icon svg' => 'stroke: {{VALUE}}; fill: {{VALUE}}',
				]
			]
		);
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_hover',
				'selector' => '{{WRAPPER}} .service_inner:hover',
			]
		);
		
		$this->end_controls_section();

		
	}

	
	protected function render() {
		$settings = $this->get_settings_for_display();
		$subtitle = !empty($settings['subtitle']) ? '<p>'.$settings['subtitle'].'</p>' : '';
		$textalign = empty($settings['textalign']) ? 'right' : $settings['textalign'];		
			
		$str = '<div class="mweb_service bs_'.$settings['bstyle'].'">';

			if(!empty($settings['link']['url'])){
				$target = $settings['link']['is_external'] ? ' target="_blank"' : '';
				$nofollow = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
				$str .= '<a href="' . esc_url( $settings['link']['url'] ) . '" title="' . esc_attr( $settings['title'] ) . '" ' . $target . $nofollow . '>';
			}
			$str .= '<div class="service_inner talign_'.$textalign.'">';
			if($settings['title_picon'])
				$str .= '<div class="service_icon">'.$settings['title_picon'].'</div>';
			$str .= '<div class="service_content"><h4>'.$settings['title'].'</h4> '.$subtitle.'</div>';
			$str .= '</div>';		
			if(!empty($settings['link']['url']))
				$str .= '</a>';
		
		$str .= '</div>';	
		
		echo $str;
		
	}

	
	protected function content_template() {
		
	}
}
