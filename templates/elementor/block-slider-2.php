<?php
namespace ElementorMahdisweb\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Module Blog Slider
 * @since 1.0.0
 */
class Block_Slider_2 extends Widget_Base {


	public function get_name() {
		return 'block-slider-two';
	}


	public function get_title() {
		return __( 'اسلایدر تکی', 'mweb' );
	}


	public function get_icon() {
		return 'eicon-slider-album';
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

		$this->add_control(
			'category_id',
			[
				'label' => __( 'انتخاب دسته بندی', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 0,
				'options' => get_element_category_list('slider_category'),
			]
		);
		$this->add_control(
			'orderby',
			[
				'label' => __( 'مرتب سازی', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'date_post',
				'options' => get_element_post_orderby(),
			]
		);
		$this->add_control(
			'posts_per_page',
			[
				'label' => __( 'تعداد اسلاید', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 5,
				'min' => 1,
			]
		);
		$this->add_control(
			'offset',
			[
				'label' => __( 'نقطه شروع اسلاید', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '',
				'description' => 'offset باعث می شود چند نتیجه اول را رد کند و از آنجا به بعد تعداد پست به شما دهد',
			]
		);

		$this->end_controls_section();
		
		
		
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'تنظیمات نمایش', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		

		$this->add_control(
			'title_show',
			[
				'label' => __( 'نمایش عناوین اسلاید', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
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
				],
			]
		);
		
		$this->add_control(
			'artype',
			[
				'label' => __( 'نوع نمایش فلش', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'one'  => __( 'یک', 'mweb' ),
					'two' => __( 'دو', 'mweb' ),
					'three' => __( 'سه', 'mweb' ),
					//'four' => __( 'چهار', 'mweb' ),
					//'five' => __( 'پنج', 'mweb' ),
				],
				'default' => 'one',
				'prefix_class' => 'elementor-slider--view-',
				'condition' => [ 'navigation' => ['both', 'arrows'] ],
			]
		);
		
		$this->add_control(
			'dottype',
			[
				'label' => __( 'نوع نمایش دکمه', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'one'  => __( 'یک', 'mweb' ),
					'two' => __( 'دو', 'mweb' ),
					//'three' => __( 'سه', 'mweb' ),
					//'four' => __( 'چهار', 'mweb' ),
					//'five' => __( 'پنج', 'mweb' ),
				],
				'default' => 'one',
				'prefix_class' => 'elementor-slider--view-dot-',
				'condition' => [ 'navigation' => ['both', 'dots'] ],
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
					'slide' => __( 'اسلاید', 'mweb' ),
					'fade' => __( 'محوی', 'mweb' ),
					'is_3d' => __( 'سه بعدی', 'mweb' ),
					'cube' => __( 'مکعبی', 'mweb' ),
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
				],
				'condition' => [ 'effect' => ['slide'] ],
			]
		);
		
		$this->add_control(
			'item_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .item-area' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .swiper-slide-shadow-right' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .swiper-slide-shadow-left' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'item_box_shadow',
				'selector' => '{{WRAPPER}} .item-area',
			]
		);
		
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'item_thumbnail', 
				'exclude' => [ 'custom' ],
				//'include' => [],
				'default' => 'full',
			]
		);
		
		$this->add_control(
			'svg_color',
			[
				'label' => __( 'رنگ فضای خالی', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elm_sl_svg' => 'fill: {{VALUE}}',
				],
			]
		);
		
		
		$this->add_control(
			'display_as_bg',
			[
				'label' => __( 'نمایش به صورت پس زمینه', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			]
		);
		
		
		$this->add_control(
			'background_size',
			[
				'label' => _x( 'سایز تصاویر', 'Background Control', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'cover',
				'options' => [
					'cover' => _x( 'Cover', 'Background Control', 'elementor-pro' ),
					'contain' => _x( 'Contain', 'Background Control', 'elementor-pro' ),
					'auto' => _x( 'Auto', 'Background Control', 'elementor-pro' ),
				],
				'selectors' => [
					'{{WRAPPER}} .item_slider_2' => 'background-size: {{VALUE}}',
				],
				'condition' => [ 'display_as_bg' => ['yes'] ],

			]
		);

		$this->add_responsive_control(
			'slides_height',
			[
				'label' => esc_html__( 'ارتفاع اسلایدر', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'vh', 'custom' ],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1000,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 400,
				],
				'selectors' => [
					'{{WRAPPER}} .item_slider_2' => 'height: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
				'condition' => [ 'display_as_bg' => ['yes'] ]
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
		if( $show_dots ){
			$data_setting['pagination'] = array('el' => '.mweb-swiper-pagination', 'clickable' => true);
		}
		if( $show_arrows ){
			$data_setting['navigation'] = array('nextEl' => '.mweb-swiper-next', 'prevEl' => '.mweb-swiper-prev' );
		}
		
		$slide_tablet = empty($settings['slides_to_show_tablet']) ? 1 : $settings['slides_to_show_tablet'];
		$slide_mobile = empty($settings['slides_to_show_mobile']) ? 1 : $settings['slides_to_show_mobile'];

		$data_setting['breakpoints'] = array('575' => array('slidesPerView' => $slide_mobile), '768' => array('slidesPerView' => $slide_tablet), '1024' => array('slidesPerView' => $settings['slides_to_show']));
		
		if($settings['effect'] == 'is_3d'){
			$data_setting['effect'] = 'coverflow';
			$data_setting['grabCursor'] = true;
			//$data_setting['slidesPerView'] = 'auto';
			$data_setting['coverflowEffect'] = array('rotate' => 30, 'stretch' => 0, 'depth' => 100, 'modifier' => 1, 'slideShadows' => true);
		}elseif($settings['effect'] == 'cube'){
			$data_setting['effect'] = 'cube';
			$data_setting['grabCursor'] = true;
			$data_setting['cubeEffect'] = array('shadow' => true, 'slideShadows' => true, 'shadowOffset' => 8, 'shadowScale' => 0.6);
			$data_setting['slidesPerView'] = 1;
			$data_setting['breakpoints'] = array('575' => array('slidesPerView' => 1), '768' => array('slidesPerView' => 1), '1024' => array('slidesPerView' => 1));
		}elseif($settings['effect'] == 'fade'){
			$data_setting['effect'] = 'fade';
		}

						
		$attr_class = 'swiper xslider elm_bn_slider';
		
		if( $settings['overflow'] == 'yes' ){
			$attr_class .= ' swiper-wrap-visible';
		}
		
		$this->add_render_attribute( [
			'carousel-wrapper' => [
				'class' => $attr_class,
				'id' => 'sl_'.$this->get_id(),
				'dir' => 'rtl',
				'data-slider' => wp_json_encode($data_setting)
			],
		] );


		$settings = $this->get_settings_for_display();
		
		$query_options = array('category_id' => $settings['category_id'], 'posts_per_page' => $settings['posts_per_page'], 'orderby' => $settings['orderby'], 'offset' => $settings['offset'], 'post_type' => 'slider' );
				
		$block = array('block_id' => 'mweb_'.$this->get_id(), 'block_name' => 'mweb_'.$this->get_name(), 'block_classes' => 'product_slider_two', 'block_options' => $query_options);
		
		$query_data = \mweb_theme_query::get_custom_query( $query_options );
		
		
		//echo \mweb_theme_block::block_open( $block, $query_data );
		//echo \mweb_theme_block::block_header( $block );
		echo \mweb_theme_block::block_content_open();
		
		$is_mobile = wp_is_mobile();

		
		$loop_arg = array();
		$loop_arg['title_show'] = $settings['title_show'] == 'yes' ? true : false;
		$loop_arg['thumbnail'] = $settings['item_thumbnail_size'];
		$loop_arg['is_mobile'] = $is_mobile;
		
		$arrows = ['arrow-right', 'arrow-left'];
		
		
		//check empty
		if ( $query_data->have_posts() ) {

			echo '<div '. $this->get_render_attribute_string( 'carousel-wrapper' ) .'>';
			echo '<div class="swiper-wrapper">';
				if( $settings['display_as_bg'] == 'yes' ){
					while ( $query_data->have_posts() ) : 
						$query_data->the_post(); 
						$featured_img_url = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), $settings['item_thumbnail_size']) : ''; 
						if( $is_mobile ){
							$mobile_vs = get_post_meta( get_the_ID(), 'mweb_slider_mobile', true );
							$featured_img_url = is_array($mobile_vs) && !empty($mobile_vs['url']) ?  $mobile_vs['url'] : $featured_img_url;
						} 
						echo '<div class="swiper-slide"><div class="item item_slider_2" style="background-image:url('.esc_url($featured_img_url).')">';
							$mweb_slider_link = get_post_meta( get_the_ID(), 'mweb_slider_link', true );
							if( !empty($mweb_slider_link) )
								echo '<a class="link_hide" href="'. esc_url($mweb_slider_link) .'" target="_blank"></a>';
						echo '</div></div>';
					endwhile;
				} else {
					while ( $query_data->have_posts() ) : 
						$query_data->the_post(); 
						echo '<div class="swiper-slide"><div class="item item_slider_2">';
							echo mweb_loop_template_slider_2($loop_arg);
						echo '</div></div>';
					endwhile;
				}
			echo '</div>';	
				if ( $show_dots ) { 
					echo '<div class="mweb-swiper-pagination"></div>';
					if( $settings['dottype'] == 'one' )
						echo '<svg class="elm_sl_svg el_bullet_w1" xmlns="http://www.w3.org/2000/svg" width="450" height="100" viewBox="0 0 450 100"><path d="M270.237,99.821V99.491c40.471,0.125,98.4.46,180.972,1.134C355.121,99.842,395.9,8.993,327.679,8.993H124.453c-69.409,0-27.919,90.849-125.675,91.632,85.077-.682,144.365-1.016,185.606-1.137v0.333c5.854-.193,18.314-0.351,42.557-0.382C251.605,99.47,264.281,99.628,270.237,99.821Zm0,0v0.8S281,100.169,270.237,99.821Zm-85.854.8v-0.8C173.8,100.169,184.383,100.625,184.383,100.625Z"/></svg>';
					} 
				if ( $show_arrows ){
					if( $settings['artype'] == 'two' ){
						$arrows = ['arrow-right-1', 'arrow-left-1'];
						echo '<svg class="elm_sl_svg el_arw_right" xmlns="http://www.w3.org/2000/svg" width="131" height="508" viewBox="0 0 131 508">
						  <path d="M104,409c14.52,30.124,23.482,63.027,27,99V0c-3.518,35.973-12.48,68.876-27,99C77.185,154.635,4.9,199.393,6,254,4.9,308.607,77.185,353.365,104,409Z"/>
						</svg>';
						echo '<svg class="elm_sl_svg el_arw_left" xmlns="http://www.w3.org/2000/svg" width="131" height="508" viewBox="0 0 131 508">
						  <path d="M27,409C12.48,439.124,3.518,472.027,0,508V0C3.518,35.973,12.48,68.876,27,99c26.815,55.635,99.1,100.393,98,155C126.1,308.607,53.815,353.365,27,409Z"/>
						</svg>';
					}

					echo '<div class="mweb-swiper-next"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#'.$arrows[0].'"></use></svg></div><div class="mweb-swiper-prev"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#'.$arrows[1].'"></use></svg></div>';
				}			
			echo '</div>';				

		} else {
			echo mweb_no_content();
		}
		//reset post data
		wp_reset_postdata();
		
		echo \mweb_theme_block::block_content_close();
		//echo \mweb_theme_block::block_footer( $block );
		//echo \mweb_theme_block::block_close();
		
	}


	protected function content_template() {
		
	}
}
