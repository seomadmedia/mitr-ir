<?php
namespace ElementorMahdisweb\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Module Featured Off
 * @since 1.0.0
 */
class Block_Featured_Off extends Widget_Base {


	public function get_name() {
		return 'block-featured-off';
	}

	
	public function get_title() {
		return __( 'باکس عکس همراه با متن', 'mweb' );
	}

	
	public function get_icon() {
		return 'eicon-post-content';
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
		
		$this->add_control(
			'el_title',
			[
				'label' => __( 'عنوان', 'mweb' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'hr_title',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		
		$this->add_control(
			'el_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .el_featured_rqs_inner' => 'color: {{VALUE}}',
				]
			]
		);
		
		$this->add_control(
			'el_background',
			[
				'label' => __( 'تصویر پس زمینه', 'mweb' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				]
			]
		);
		
		$this->add_group_control(
			'background',
			[
				'name' => 'el_background_overlay',
				'label' => __( 'رنگ پوشش', 'mweb' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .el_featured_rqs_inner'
			]
		);
		
		$this->add_control(
			'el_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .el_featured_rqs' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'el_height',
			[
				'label' => __( 'ارتفاع', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .el_featured_rqs' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);
		
		$this->add_control(
			'hr_counter',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		
		$this->add_control(
			'el_int',
			[
				'label' => __( 'درج عدد', 'mweb' ),
				'type' => Controls_Manager::TEXT,
				'description' => 'اختیاری'
			]
		);
		
		$this->add_control(
			'el_counter_color',
			[
				'label' => __( 'رنگ عدد', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .el_featured_rqs_inner .count' => 'color: {{VALUE}}',
				]
			]
		);
		
		$this->add_control(
			'el_counter_bgcolor',
			[
				'label' => __( 'رنگ پس زمینه عدد', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .el_featured_rqs_inner .count' => 'background-color: {{VALUE}}',
				]
			]
		);
		
		$this->add_control(
			'el_counter_br_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .el_featured_rqs_inner .count' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'hr_link',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		
		$this->add_control(
			'el_link',
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
			'el_link_title',
			[
				'label' => __( 'عنوان لینک', 'mweb' ),
				'type' => Controls_Manager::TEXT,
				'description' => __( 'جهت عدم نمایش فیلد را خالی رها کنید', 'mweb' ),
			]
		);

		
		$this->end_controls_section();
		

	}

	
	protected function render() {
		$settings = $this->get_settings_for_display();
		$el_int = !empty($settings['el_int']) ? '<span class="count">'.$settings['el_int'].'</span>' : '';
		$el_background = !empty($settings['el_background']['url']) ? ' style="background-image:url('.$settings['el_background']['url'].')"' : '';
		$el_class = $el_anchor = '';
		if(!empty($settings['el_link_title'])){
			$el_class = ' el_has_text';
			$el_anchor = '<span class="el_anchor_text"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-left-1"></use></svg>'.$settings['el_link_title'].'</span>';
		}
		
		echo '<div class="el_featured_rqs'.$el_class.'"'.$el_background.'>';	
			if(!empty($settings['el_link']['url'])){
				$target = $settings['el_link']['is_external'] ? ' target="_blank"' : '';
				$nofollow = $settings['el_link']['nofollow'] ? ' rel="nofollow"' : '';
				echo '<a href="' . esc_url( $settings['el_link']['url'] ) . '" title="' . esc_attr( $settings['el_title'] ) . '" ' . $target . $nofollow . '>';
			}
			echo '<div class="el_featured_rqs_inner">'.$el_int;
				echo '<h4>'.$settings['el_title'].'</h4>';
			echo $el_anchor.'</div>';	
			
			if(!empty($settings['el_link']['url'])){
				echo '</a>';
			}
		echo '</div>';
		
			
				
	}

	protected function content_template() {
		
	}
}
