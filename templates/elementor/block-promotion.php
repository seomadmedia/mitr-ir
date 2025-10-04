<?php
namespace ElementorMahdisweb\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Module Promotion
 * @since 1.0.0
 */
class Block_Promotion extends Widget_Base {


	public function get_name() {
		return 'block-promotion';
	}

	
	public function get_title() {
		return __( 'پروموشن', 'mweb' );
	}

	
	public function get_icon() {
		return 'eicon-post';
	}

	
	public function get_categories() {
		return [ 'digiland' ];
	}


	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'پروموشن', 'mweb' ),
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
				'selector' => '{{WRAPPER}} .banner-inner h3',
			]
		);
		$this->add_control(
			'subtitle',
			[
				'label' => __( 'زیر عنوان', 'mweb' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => __( 'تایپوگرافی زیر عنوان', 'mweb' ),
				'selector' => '{{WRAPPER}} .banner-inner p',
			]
		);
		$this->add_control(
			'halign',
			[
				'label' => __( 'موقعیت افقی', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [
					'left'  => __( 'چپ', 'mweb' ),
					'center' => __( 'وسط', 'mweb' ),
					'right' => __( 'راست', 'mweb' ),
				],
			]
		);
		$this->add_control(
			'valign',
			[
				'label' => __( 'موقعیت عمودی', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'top',
				'options' => [
					'top'  => __( 'بالا', 'mweb' ),
					'middle' => __( 'وسط', 'mweb' ),
					'bottom' => __( 'پایین', 'mweb' ),
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
		
		$this->add_control(
			'mod_ld',
			[
				'label' => __( 'استایل', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'فعال', 'mweb' ),
				'label_off' => __( 'غیرفعال', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		
		$this->add_control(
			'overlay',
			[
				'label' => __( 'فعال سازی هاور', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'فعال', 'mweb' ),
				'label_off' => __( 'غیرفعال', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_control(
			'bg_color',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banner' => 'background-color: {{VALUE}}',
				]
			]
		);
		$this->add_control(
			'overlay_color',
			[
				'label' => __( 'رنگ پس زمینه هاور', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ovrly' => 'background-color: {{VALUE}}',
				]
			]
		);
		
		$this->add_control(
			'color',
			[
				'label' => __( 'رنگ عنوان', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banner-inner' => 'color: {{VALUE}}',
				]
			]
		);
		
		$this->add_control(
			'subcolor',
			[
				'label' => __( 'رنگ زیر عنوان', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banner-inner p' => 'color: {{VALUE}}',
				]
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
			'bg_photo_style',
			[
				'label' => __( 'سایز عکس', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'auto' => __( 'auto', 'mweb' ),
					'cover' => __( 'cover', 'mweb' ),
					'contain' => __( 'contain', 'mweb' ),
				],
				'default' => 'cover',
				'selectors' => [
					'{{WRAPPER}} .banner-image' => 'background-size: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'bg_photo_ah',
			[
				'label' => __( 'تراز افقی عکس', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'right' => __( 'راست', 'mweb' ),
					'center' => __( 'وسط', 'mweb' ),
					'left' => __( 'چپ', 'mweb' ),
				],
				'default' => 'right',
				'selectors' => [
					'{{WRAPPER}} .banner-image' => 'background-position-x: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'bg_photo_av',
			[
				'label' => __( 'تراز عمودی عکس', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'top' => __( 'بالا', 'mweb' ),
					'center' => __( 'وسط', 'mweb' ),
					'bottom' => __( 'پایین', 'mweb' ),
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .banner-image' => 'background-position-y: {{VALUE}}',
				],
			]
		);
		
		$this->add_responsive_control(
			'height',
			[
				'label' => __( 'ارتفاع', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 70,
						'max' => 400,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 120,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 80,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 80,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .banner' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'el_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .banner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
	
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'el_box_shadow',
				'selector' => '{{WRAPPER}} .banner',
			]
		);
		
		$this->add_control(
			'separator_link',
			[
				'type' => Controls_Manager::DIVIDER,
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
			'btn_text',
			[
				'label' => __( 'عنوان دکمه لینک', 'mweb' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'btn_color',
			[
				'label' => __( 'رنگ پس زمینه دکمه لینک', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn' => 'background-color: {{VALUE}}',
				]
			]
		);
		$this->add_control(
			'btn_color_arrow',
			[
				'label' => __( 'رنگ پس زمینه علامت فلش', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn svg' => 'background-color: {{VALUE}}',
				]
			]
		);
		$this->add_control(
			'btn_color_arrow_color',
			[
				'label' => __( 'رنگ علامت فلش', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn svg' => 'stroke: {{VALUE}}',
				]
			]
		);
		$this->add_control(
			'btnalign',
			[
				'label' => __( 'موقعیت افقی دکمه', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [
					'left'  => __( 'چپ', 'mweb' ),
					'center' => __( 'وسط', 'mweb' ),
					'right' => __( 'راست', 'mweb' ),
				],
			]
		);
		$this->add_control(
			'btn_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		
	}


	protected function render() {
		$settings = $this->get_settings_for_display();
		$subtitle = !empty($settings['subtitle']) ? '<p>'.$settings['subtitle'].'</p>' : '';
		$halign = empty($settings['halign']) ? 'right' : $settings['halign'];
		$valign = empty($settings['valign']) ? 'top' : $settings['valign'];
		$textalign = empty($settings['textalign']) ? 'right' : $settings['textalign'];
		$mod_ld = ($settings['mod_ld'] == 'yes') ? 'breal_active' : '';
		$active_overlay = '';
		if($settings['overlay'] == 'yes'){
			$active_overlay = 'active_overlay';
		}
		
		
		
		$btn = '';
		if(!empty($settings['btn_text'])){
			$btnalign = empty($settings['btnalign']) ? 'right' : $settings['btnalign'];
			$target = $settings['link']['is_external'] ? ' target="_blank"' : '';
			$nofollow = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
			$btn .= '<a href="'.$settings['link']['url'].'" class="btn btn_link_'.$btnalign.'" '.$target . $nofollow.'>'.$settings['btn_text'].'<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-left-1"></use></svg></a>';
		}
		
		$str = '<div class="banner hover-zoom '.$active_overlay.' '.$mod_ld.'">';
		if ( ! empty( $settings['link']['url'] ) ) {
			$target = $settings['link']['is_external'] ? ' target="_blank"' : '';
			$nofollow = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
			if(empty($settings['btn_text']))
				$str .= '<a href="' . esc_url( $settings['link']['url'] ) . '" title="' . esc_attr( $settings['title'] ) . '" ' . $target . $nofollow . '>';

			$str .= '<div class="banner-image" style="background-image: url(' . esc_url(  $settings['image']['url'] ) . ');"></div>';
			if($settings['overlay'] == 'yes'){
				$str .= '<div class="ovrly"></div>';
			}
			$str .= '<div class="banner-content-warper">
					  <div class="banner-content align-'.$halign.' valign-'.$valign.' text-align-'.$textalign.'">
						 <div class="banner-inner">
							<h3>'.$settings['title'].'</h3> '.$subtitle. $btn.'
						 </div>
					  </div>
					</div>';
			if(empty($settings['link_btn_text']))
				$str .= '</a>';
		} else {
			$str .= '<div class="banner-image" style="background-image: url(' . esc_url(  $settings['image']['url'] ) . ');"></div>';
			if($settings['overlay'] == 'yes'){
				$str .= '<div class="ovrly"></div>';
			}
			$str .= '<div class="banner-content-warper">
					  <div class="banner-content align-'.$halign.' valign-'.$valign.' text-align-'.$textalign.' '. $settings['mod_ld'].'">
						 <div class="banner-inner">
							<h3>'.$settings['title'].'</h3> '.$subtitle.'
						 </div>
					  </div>
					</div>';
		}
		$str .= '</div>';	
		echo $str;
		
	}


	
}
