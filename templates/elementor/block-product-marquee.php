<?php
namespace ElementorMahdisweb\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Module Product Marquee
 * @since 1.0.0
 */
class Block_Product_Marquee extends Widget_Base {

	
	public function get_name() {
		return 'marquee-product';
	}


	public function get_title() {
		return __( 'محصولات چرخشی افقی', 'mweb' );
	}


	public function get_icon() {
		return 'eicon-gallery-justified';
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
			'title_url',
			[
				'label' => __( 'لینک', 'mweb' ),
				'type' => Controls_Manager::URL,
				'show_external' => false,
				'placeholder' => __( 'https://your-link.com', 'mweb' ),
			]
		);
		
		$this->add_control(
			'hr_title',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		
		$this->add_control(
			'title_color',
			[
				'label' => __( 'رنگ عنوان', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .block-title .title' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'title_bgcolor',
			[
				'label' => __( 'رنگ پس زمینه عنوان', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .block-title .title' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .block-title .title',
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
			'category_ids',
			[
				'label' => __( 'انتخاب دسته بندی ها', 'mweb' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'default' => 0,
				'options' => get_element_category_multiple_list('product_cat'),
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
			'orderby',
			[
				'label' => __( 'مرتب سازی', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'date_post',
				'options' => get_element_post_orderby(),
			]
		);
		
		$this->add_control(
			'authors',
			[
				'label' => __( 'فیلتر نویسنده', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 0,
				'options' => get_element_author_list(),
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
		
		$this->add_control(
			'include_products',
			[
				'label'       => __( 'محصولات شامل', 'mweb' ),
				'type'        => 'selectapi',
				'multiple'    => true,
				'source'      => 'product_list', 
				'placeholder' => __('جستجو...', 'mweb'),
				'description' => __( 'نام محصول را جستجو کنید...', 'mweb' ),
			]
		);
		
		$this->add_control(
			'exclude_products',
			[
				'label'       => __( 'محصولات مستثنی', 'mweb' ),
				'type'        => 'selectapi',
				'multiple'    => true,
				'source'      => 'product_list', 
				'placeholder' => __('جستجو...', 'mweb'),
				'description' => __( 'نام محصول را جستجو کنید...', 'mweb' ),
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
		
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'item_thumbnail', 
				'exclude' => [ 'custom' ],
				//'include' => [],
				'default' => 'simplev',
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
		
		/* $this->add_control(
			'no_row',
			[
				'label' => __( 'تعداد ردیف', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'placeholder' => '0',
				'min' => 1,
				'max' => 3,
				'step' => 1,
				'default' => 2,
			]
		); */
		
		$this->add_control(
			'no_item_in_row',
			[
				'label' => __( 'تعداد محصول در ردیف', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'placeholder' => '0',
				'min' => 3,
				'max' => 50,
				'step' => 1,
				'default' => 15,
			]
		);

		$this->add_control(
			'item_dimensions',
			[
				'label' => __( 'اندازه تصویر', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'size' => 80,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 200,
					],
				],

				'selectors' => [
					'{{WRAPPER}} .marquee_item' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$slides_to_show = range( 1, 20 );
		$slides_to_show = array_combine( $slides_to_show, $slides_to_show );
		
		$this->add_responsive_control(
			'item_to_show',
			[
				'label' => __( 'اسلاید جهت نمایش', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'پیشفرض', 'mweb' ),
				] + $slides_to_show,
				'default' => 12,
			]
		);
		
		$this->add_control(
			'item_spaceBetween',
			[
				'label' => __( 'فاصله از هم', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 50,
				'step' => 1,
				'default' => 15,
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'item_border',
				'label' => __( 'حاشیه آیتم ها', 'mweb' ),
				'selector' => '{{WRAPPER}} .marquee_item',
				'exclude' => [ 'color' ],
			]
		);
		
		$this->add_control(
			'item_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .marquee_item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->start_controls_tabs( 'items_style_tabs' );

		$this->start_controls_tab( 'items_style_normal',
			[
				'label' => __( 'حالت نرمال', 'mweb' ),
			]
		);

		$this->add_control(
			'items_border_color',
			[
				'label' => __( 'رنگ حاشیه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .marquee_item' => 'border-color: {{VALUE}}',
				],
			]
		);		

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'item_box_shadow',
				'selector' => '{{WRAPPER}} .marquee_item',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'items_style_hover',
			[
				'label' => __( 'حالت هاور', 'mweb' ),
			]
		);

		$this->add_control(
			'item_border_color_hover',
			[
				'label' => __( 'رنگ حاشیه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .marquee_item:hover' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'item_box_shadow_hover',
				'selector' => '{{WRAPPER}} .marquee_item:hover',
			]
		);

		
		$this->add_control(
			'items_transition',
			[
				'label' => __( 'مدت زمان تغییر', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.2,
				],
				'range' => [
					'px' => [
						'max' => 2,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .marquee_item' => 'transition: all {{SIZE}}s',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		
		
		
		$this->end_controls_section();
		
	}


	protected function render() {
		
		$settings = $this->get_settings_for_display();
		
		$num_posts = $settings['posts_per_page'];
		$posts_per_row = $settings['no_item_in_row']; 

		$num_rows = ceil($num_posts / $posts_per_row);

				
		$query_options = array('category_id' => $settings['category_id'], 'category_ids' => $settings['category_ids'], 'brand_id' => $settings['brand_id'], 'posts_per_page' => $settings['posts_per_page'], 'orderby' => $settings['orderby'], 'author_id' => $settings['authors'], 'offset' => $settings['offset'], 'post__in' => $settings['include_products'], 'post_not_in' => $settings['exclude_products'], 'post_type' => 'product' );
				
		$block = array('block_id' => 'mweb_'.$this->get_id(), 'block_name' => 'mweb_'.$this->get_name(), 'block_options' => $query_options);
		$block['block_options'] = array_merge($block['block_options'], array('title' => $settings['title'], 'icon' => $settings['title_picon'], 'title_url' => $settings['title_url'] ));
		
		$query_data = \mweb_theme_query::get_custom_query( $query_options );
		
		echo \mweb_theme_block::block_open( $block, $query_data );
		echo \mweb_theme_block::block_header( $block );
		echo \mweb_theme_block::block_content_open();
		
		
		$slide_tablet = empty($settings['item_to_show_tablet']) ? 6 : $settings['item_to_show_tablet'];
		$slide_mobile = empty($settings['item_to_show_mobile']) ? 3 : $settings['item_to_show_mobile'];
		
		$data_attr1 = '{
                    "slidesPerView": '.$slide_mobile.',
                    "centeredSlides": false,
                    "autoplay": {"delay": 500},
                    "speed": 7000,
                    "loop": true,
					"allowTouchMove": false,
                    "spaceBetween": '.$settings['item_spaceBetween'].',
                    "breakpoints":{"540":{"slidesPerView":'.$slide_mobile.'}, "768":{"slidesPerView":'.$slide_tablet.'}, "1024":{"slidesPerView":'.$settings['item_to_show'].'}},
                    "navigation": {"nextEl": ".swiper-button-next", "prevEl": ".swiper-button-prev"}
                    }';
					
		$data_attr2 = '{
                    "slidesPerView": '.$slide_mobile.',
                    "centeredSlides": false,
                    "autoplay": {"delay": 500},
                    "speed": 7000,
                    "loop": true,
					"allowTouchMove": false,
                    "spaceBetween": '.$settings['item_spaceBetween'].',
                    "breakpoints":{"540":{"slidesPerView":'.$slide_mobile.'}, "768":{"slidesPerView":'.$slide_tablet.'}, "1024":{"slidesPerView":'.$settings['item_to_show'].'}},
                    "navigation": {"nextEl": ".swiper-button-next", "prevEl": ".swiper-button-prev"}
                    }';
		
		//check empty
		if ( $query_data->have_posts() ) {

			echo '<div class="marquee_wrap">';

				for ($row = 1; $row <= $num_rows; $row++) {
					echo '<div class="swiper mr-swiper" data-swiper=\' '. ( $row % 2 == 0 ? $data_attr2 : $data_attr1 ) .' \' '. ( $row % 2 == 0 ? 'dir="rtl"' : 'dir="ltr"' ) .'>
                <div class="swiper-wrapper">';
					for ($col = 1; $col <= $posts_per_row; $col++) {
						$post_num = ($row - 1) * $posts_per_row + $col;
						if ($post_num <= $num_posts) {
							$query_data->the_post();
							echo '<div class="swiper-slide">';
							echo mweb_loop_template_product_marquee(array('thumbnail' => $settings['item_thumbnail_size']));
							echo '</div>';
						}
					}
					echo "</div></div>";
				}
			
			echo '</div>';				

		} else {
			echo mweb_no_content();
		}
		//reset post data
		wp_reset_postdata();
		
		echo \mweb_theme_block::block_content_close();
		echo \mweb_theme_block::block_footer( $block );
		echo \mweb_theme_block::block_close();
		
	}


	protected function content_template() {
		
	}
}
