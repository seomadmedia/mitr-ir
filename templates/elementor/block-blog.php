<?php
namespace ElementorMahdisweb\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Module Main Blog
 * @since 1.0.0
 */
class Block_Blog extends Widget_Base {

	
	public function get_name() {
		return 'block-post';
	}

	
	public function get_title() {
		return __( 'وبلاگ', 'mweb' );
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
				'options' => get_element_category_list(),
			]
		);
		
		$this->add_control(
			'category_ids',
			[
				'label' => __( 'انتخاب دسته بندی ها', 'mweb' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'default' => 0,
				'options' => get_element_category_multiple_list(),
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
		
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'item_thumbnail', 
				'exclude' => [ 'custom' ],
				//'include' => [],
				'default' => 'blog_home',
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ptitle_typography',
				'label' => __( 'تایپوگرافی عنوان مطالب', 'mweb' ),
				'selector' => '{{WRAPPER}} .blog-posts-content .post-title a, {{WRAPPER}} .blog-posts-content-2 .grid_image h4, {{WRAPPER}} .blog-posts-content-4 h4 a',
			]
		);
		
		$this->add_control(
			'block_name_o',
			[
				'label' => __( 'نوع نمایش', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'blog_1' => __( 'یک', 'mweb' ),
					'blog_4' => __( 'دو', 'mweb' ),
					'blog_5' => __( 'سه', 'mweb' ),
				],
				'default' => 'blog_1',
			]
		);
		
		$this->add_control(
			'item_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .item .item-area' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .blog-posts-content-4 .post-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .blog-posts-content .post-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} 25px;',
					'{{WRAPPER}} .blog-posts-content .item-area:hover .post-image a:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} 25px;',
				],
			]
		);
		
		$this->add_control(
			'img_border_radius',
			[
				'label' => __( 'گوشه های مدور عکس', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .blog-posts-content-4 .post-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .blog-posts-content-4 .item-area:hover .post-image a:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 'block_name_o' => ['blog_4'] ],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'item_box_shadow',
				'selector' => '{{WRAPPER}} .item .item-area',
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
		
		$loop_thumbnail = isset($settings['item_thumbnail_size']) ? $settings['item_thumbnail_size'] : '';
		
		$query_options = array('category_id' => $settings['category_id'], 'category_ids' => $settings['category_ids'], 'posts_per_page' => $settings['posts_per_page'], 'orderby' => $settings['orderby'], 'author_id' => $settings['authors'], 'offset' => $settings['offset']);
				
		$block = array('block_id' => 'mweb_'.$this->get_id(), 'block_name' => 'mweb_blog_listing', 'block_options' => $query_options);
		$block['block_options'] = array_merge($block['block_options'], array('title' => $settings['title'], 'icon' => $settings['title_picon'], 'title_url' => $settings['title_url'], 'block_style' => $settings['block_name_o'].'__'.$loop_thumbnail, 'column_in_row' => $column_in_row, 'ajax_dropdown' => $settings['ajax_dropdown'], 'ajax_dropdown_id' => $settings['ajax_dropdown_id'], 'ajax_dropdown_text' => $settings['ajax_dropdown_text'], 'pagination' => $settings['pagination'] ));

		$content_class = $settings['block_name_o'] == 'blog_1' ? 'blog-posts-content' : 'blog-posts-content-4';
		
		$query_data = \mweb_theme_query::get_custom_query( $query_options );
				
		echo \mweb_theme_block::block_open( $block, $query_data );
		echo \mweb_theme_block::block_header( $block );
		echo \mweb_theme_block::block_content_open($content_class.' row');
		
		//check empty
		if ( $query_data->have_posts() ) {
			echo mweb_blog_listing($query_data, $block['block_options']);
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
