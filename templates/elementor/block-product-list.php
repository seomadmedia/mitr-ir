<?php
namespace ElementorMahdisweb\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Module Product List
 * @since 1.0.0
 */
class Block_Product_List extends Widget_Base {

	
	public function get_name() {
		return 'general-product-list';
	}


	public function get_title() {
		return __( 'لیست محصولات', 'mweb' );
	}


	public function get_icon() {
		return 'eicon-posts-grid';
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
			'posts_per_page',
			[
				'label' => __( 'تعداد مطالب', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 4,
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
			'section_style',
			[
				'label' => __( 'نمایش', 'mweb' ),
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
		
		$this->add_control(
			'loop_type',
			[
				'label' => __( 'نوع یک', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'prdtype_1' => __( 'یک یک', 'mweb' ),
					'prdtype_2' => __( 'یک دو', 'mweb' ),
					'prdtype_3' => __( 'یک سه', 'mweb' )
				],
				'default' => 'prdtype_1',
				'condition' => [ 'block_name' => ['type-0'] ],

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
			'item_border_radius',
			[
				'label' => __( 'گوشه های مدور محصولات', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .item .item-area' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'item_box_shadow',
				'selector' => '{{WRAPPER}} .item .item-area',
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ptitle_typography',
				'label' => __( 'تایپوگرافی عنوان محصول', 'mweb' ),
				'selector' => '{{WRAPPER}} .item_simple .item-area .product-name',
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
		
		$this->add_control(
			'ajax_dropdown',
			[
				'label' => __( 'فیلتر کشویی ایجکس', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 0,
				'options' => get_element_ajax_filter_type()
			]
		);
		$this->add_control(
			'ajax_dropdown_id',
			[
				'label' => __( 'فیلتر ایجکس کشویی آیدی', 'mweb' ),
				'type' => Controls_Manager::TEXT,
				'description' => 'بر اساس آیدی دسته بندی ، نویسنده و ...',
			]
		);
		$this->add_control(
			'ajax_dropdown_text',
			[
				'label' => __( 'عنوان اولین آیتم', 'mweb' ),
				'type' => Controls_Manager::TEXT,
				'description' => 'عنوان اولین گزینه لیست کشویی ایجکس',
			]
		);
		$this->add_control(
			'pagination',
			[
				'label' => __( 'صفحه بندی ایجکس', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'description' => '',
				'default' => 0,
				'options' => get_element_ajax_pagination_type()
			]
		);
		
		$slides_to_show = array(1, 2, 3, 4, 6);
		$slides_to_show = array_combine( $slides_to_show, $slides_to_show );
		
		$this->add_responsive_control(
			'item_in_row',
			[
				'label' => __( 'تعداد آیتم در ردیف', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'پیشفرض', 'mweb' ),
				] + $slides_to_show,
				'default' => 4,
			]
		);
		
		
		$this->end_controls_section();
	}

	
	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$item_tablet = empty($settings['item_in_row_tablet']) ? 2 : $settings['item_in_row_tablet'];
		$item_mobile = empty($settings['item_in_row_mobile']) ? 1 : $settings['item_in_row_mobile'];
		
		$column_in_row = $item_mobile.'_'.$item_tablet.'_'.$settings['item_in_row'];
		
		$style_type = $settings['block_name'];
		if( $style_type == 'type-0' || $style_type == 'type-1' ){
			$loop_func = 'general';
		}else{
			$loop_func = 'general_'.$style_type[-1];
		}
		
		if( wp_is_mobile() ){
			$settings['loop_type'] = apply_filters('general_product_type' , 'prdtype_default');
			$settings['block_name'] = 'module_mobile';
			$loop_func = 'mobile';
		} 
		
		$query_options = array('category_id' => $settings['category_id'], 'posts_per_page' => $settings['posts_per_page'], 'orderby' => $settings['orderby'], 'author_id' => $settings['authors'], 'offset' => $settings['offset'], 'post_type' => 'product' );
		
		$block = array('block_id' => 'mweb_'.$this->get_id(), 'block_name' => 'mweb_product_listing', 'block_classes' => $settings['loop_type'], 'block_options' => $query_options);
		$block['block_options'] = array_merge($block['block_options'], array('title' => $settings['title'], 'icon' => $settings['title_picon'], 'title_url' => $settings['title_url'], 'column_in_row' => $column_in_row, 'block_style' => $loop_func.'__'.$settings['item_thumbnail_size'], 'ajax_dropdown' => $settings['ajax_dropdown'], 'ajax_dropdown_id' => $settings['ajax_dropdown_id'], 'ajax_dropdown_text' => $settings['ajax_dropdown_text'], 'pagination' => $settings['pagination'] ));

		$query_data = \mweb_theme_query::get_custom_query( $query_options );
		
		
		
		

		echo \mweb_theme_block::block_open( $block, $query_data );
		echo \mweb_theme_block::block_header( $block );
		echo \mweb_theme_block::block_content_open('row scrolling-wrapper');
		
		//check empty
		if ( $query_data->have_posts() ) {
			echo mweb_product_listing($query_data, $block['block_options']);
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
