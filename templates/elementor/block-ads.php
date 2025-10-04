<?php
namespace ElementorMahdisweb\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Module Advertising
 * @since 1.0.0
 */
class Block_Advertising extends Widget_Base {


	public function get_name() {
		return 'block-advertising';
	}

	
	public function get_title() {
		return __( 'تبلیغ بنری', 'mweb' );
	}

	
	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	
	public function get_categories() {
		return [ 'digiland' ];
	}


	protected function register_controls() {
		
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تبلیغ', 'mweb' ),
			]
		);
		
		$this->add_control(
			'title',
			[
				'label' => __( 'عنوان', 'mweb' ),
				'type' => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __( 'عکس', 'mweb' ),
				'type' => Controls_Manager::MEDIA,
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

		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_display',
			[
				'label' => __( 'نمایش', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'item_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .ad-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
	
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'item_box_shadow',
				'selector' => '{{WRAPPER}} .ad-wrap',
			]
		);
		
		$this->end_controls_section();

		
	}

	
	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$str = '<div class="ad-wrap">';
		if ( ! empty( $settings['link']['url'] ) ) {
			$target = $settings['link']['is_external'] ? ' target="_blank"' : '';
			$nofollow = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
			$str .= '<a href="' . esc_url( $settings['link']['url'] ) . '" title="' . esc_attr( $settings['title'] ) . '" ' . $target . $nofollow . '>';
			$str .= '<img src="' . esc_url(  $settings['image']['url'] ) . '" alt="">';
			$str .= '</a>';
		} else {
			$str .= '<img src="' . esc_url( $settings['image']['url'] ) . '" alt="">';
		}
		$str .= '</div>';	
		echo $str;
		
	}

	
	protected function content_template() {
		
	}
}
