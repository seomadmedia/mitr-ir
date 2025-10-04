<?php
namespace ElementorMahdisweb\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Module Products Tab
 * @since 1.0.0
 */
class Block_Product_Tabs extends Widget_Base {

	
	public function get_name() {
		return 'product-tabs';
	}

	
	public function get_title() {
		return __( 'تب بندی محصولات', 'mweb' );
	}

	
	public function get_icon() {
		return 'eicon-product-tabs';
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
		
		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
			'category_id',
			[
				'label' => __( 'انتخاب دسته', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 0,
				'options' => get_element_category_list('product_cat'),
			]
		);
		
		$this->add_control(
			'cat_list',
			[
				'label' => __( 'دسته بندی', 'mweb' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ category_id }}}',
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
		
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'item_thumbnail', 
				'exclude' => [ 'custom' ],
				//'include' => [],
				'default' => 'woocommerce_thumbnail',
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ptitle_typography',
				'label' => __( 'تایپوگرافی عنوان محصول', 'mweb' ),
				'selector' => '{{WRAPPER}} .item .item-area .product-name',
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
			'posts_per_page',
			[
				'label' => __( 'تعداد مطالب', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 6,
				'min' => 1,
			]
		);
				$this->add_control(
			'only_inStock',
			[
				'label' => __( 'فقط محصولات موجود', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
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
				'default' => 3,
			]
		);
		
		$this->add_control(
			'item_border_radius',
			[
				'label' => __( 'گوشه های مدور محصول', 'mweb' ),
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
	
		
		$this->start_controls_tabs( 'tabs_style' );

		$this->start_controls_tab( 'normal_tabs_style',
			[
				'label' => __( 'حالت پیشفرض', 'mweb' ),
			]
		);

		$this->add_control(
			'tab_text_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tab_box li a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'tab_bg_color',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'alpha' => false,
				'selectors' => [
					'{{WRAPPER}} .tab_box li' => 'background-color: {{VALUE}}',
				],
			]
		);

	

		$this->end_controls_tab();

		$this->start_controls_tab( 'active_tabs_style',
			[
				'label' => __( 'حالت فعال', 'mweb' ),
			]
		);

		$this->add_control(
			'active_tab_text_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tab_box li.active a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'active_tab_bg_color',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'alpha' => false,
				'selectors' => [
					'{{WRAPPER}} .tab_box li.active' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .tab_box li:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'active_tab_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .tab_box li.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'separator_tabs_style',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		
		$this->add_control(
			'show_icon',
			[
				'label' => __( 'نمایش آیکن دسته', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'yes' => __( 'بله', 'mweb' ),
					'no' => __( 'خیر', 'mweb' ),
				]
			]
		);
		
		$this->add_control(
			'tabs_wrap_margin',
			[
				'label' => __( 'فاصله تب ها', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .block-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'tabs_item_margin',
			[
				'label' => __( 'فاصله تب تکی', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} ul.tab_box li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'tabs_item_padding',
			[
				'label' => __( 'فاصله داخلی تکی', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} ul.tab_box li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'horizontal_align_element',
			[
				'label' => __( 'تراز افقی المان ها', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'space-between',
				'options' => [
					'flex-start' => __( 'راست', 'mweb' ),
					'center' => __( 'وسط', 'mweb' ),
					'space-between' => __( 'فاصله دار', 'mweb' ),
				],
				'selectors' => [
					'{{WRAPPER}} .tab_box' => 'justify-content: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tab_typography',
				'label' => __( 'تایپوگرافی', 'mweb' ),
				'selector' => '{{WRAPPER}} .tab_box li a',
			]
		);

		$this->add_control(
			'tab_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .tab_box li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tab_box_shadow',
				'selector' => '{{WRAPPER}} .tab_box li',
			]
		);

		$this->end_controls_section();
		
		
	}

	
	public function render_tab( $categories, $show_icon = 'no' ) {

		$is_first = true;
		$str = '';
		$str .= '<div class="block-title">';
			if(!empty($categories)){
				$str .= '<ul class="tab_box scrolling-wrapper">';
				foreach ($categories as $cat) {
					$cat_name = mweb_get_product_cat_name($cat['category_id']);
					$el_class = 'category-'.$cat['category_id'];
					if($is_first){
						$el_class .= ' active';
						$is_first = false;
					}
					$str .= '<li class="'.$el_class.'"><a href="'.  mweb_get_product_cat_link($cat['category_id']) .'" data-ajax_filter_val="'.$cat['category_id'].'" title="'.$cat_name.'">';
					if($show_icon == 'yes')
						$str .=  mweb_get_product_cat_img($cat['category_id'], false);
					$str .= $cat_name .'</a></li>';
				}
				$str .= '</ul>';
			}else{
				$str .= '<div class="mweb-error"><h3>لطفا فیلتر دسته بندی و فیلتر دسته بندی ها را از پنل انتخاب کنید</h3></div>';
			}
		$str .= '</div>';
		return $str;
		
	}

	
	protected function render() {

		$settings = $this->get_settings_for_display();
		
		
		$style_type = $settings['block_name'];
		if( $style_type == 'type-0' || $style_type == 'type-1' ){
			$loop_func = 'general';
		}else{
			$loop_func = 'general_'.$style_type[-1];
		}
		
		if( wp_is_mobile() ){
			$settings['block_name'] = 'module_mobile';
			$loop_func = 'mobile';
		} 

		$item_tablet = empty($settings['item_in_row_tablet']) ? 2 : $settings['item_in_row_tablet'];
		$item_mobile = empty($settings['item_in_row_mobile']) ? 1 : $settings['item_in_row_mobile'];
		
		$column_in_row = $item_mobile.'_'.$item_tablet.'_'.$settings['item_in_row'];
		$in_stock = $settings['only_inStock'] == 'yes' ? true : '';				
		$category_id = !empty($settings['cat_list']) ? $settings['cat_list'][0]['category_id'] : 0;
		$query_options = array('category_id' => $category_id, 'posts_per_page' => $settings['posts_per_page'], 'ajax_dropdown' => 'category', 'post_type' => 'product', 'in_stock' => $in_stock );
				
		$block = array('block_id' => 'mweb_'.$this->get_id(), 'block_name' => 'mweb_product_list_tab', 'block_options' => array( 'block_style' => $loop_func.'__'.$settings['item_thumbnail_size'], 'column_in_row' => $column_in_row, 'bk_param' => true, 'post_type' => 'product', 'orderby' => $in_stock  ));
		
		$block['block_options'] = array_merge($block['block_options'], $query_options);
		
		$query_data = \mweb_theme_query::get_custom_query( $query_options );
		
		$content_class = wp_is_mobile() ? 'horizontal_scroll_css' : 'row';
				
		echo \mweb_theme_block::block_open( $block, $query_data );
		echo $this->render_tab( $settings['cat_list'], $settings['show_icon'] );
		echo \mweb_theme_block::block_content_open($content_class);	
		
		//check empty
		if ( $query_data->have_posts() ) {
			echo mweb_product_list_tab($query_data, $block['block_options']);
		} else {
			echo mweb_no_content();
		}
		//reset post data
		wp_reset_postdata();
		
		echo \mweb_theme_block::block_content_close();
		echo \mweb_theme_block::block_footer( $block );
		echo \mweb_theme_block::block_close();
		
		
	}

	
	function content_template() {
		
	}
}








/**
 * Elementor Module Products Tab Vertical
 * @since 1.0.0
 */
class Block_Product_Vertical_Tabs extends Widget_Base {

	
	public function get_name() {
		return 'product-vertical-tabs';
	}

	
	public function get_title() {
		return __( 'تب بندی عمودی محصولات', 'mweb' );
	}

	
	public function get_icon() {
		return 'eicon-tabs';
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
			'select_cat_warning',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => __( 'حداکثر 4 دسته انتخاب نمائید', 'mweb' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			]
		);
		
		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
			'category_id',
			[
				'label' => __( 'انتخاب دسته', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 0,
				'options' => get_element_category_list('product_cat'),
			]
		);

		
		$this->add_control(
			'cat_list',
			[
				'label' => __( 'دسته بندی', 'mweb' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ category_id }}}',
			]
		);
		
		
		$this->add_control(
			'posts_per_page',
			[
				'label' => __( 'تعداد مطالب', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 6,
				'min' => 1,
			]
		);
		
		$this->add_control(
			'only_instock',
			[
				'label' => __( 'مرتب سازی بر اساس موجودی', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
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
				'default' => 'woocommerce_thumbnail',
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ptitle_typography',
				'label' => __( 'تایپوگرافی عنوان محصول', 'mweb' ),
				'selector' => '{{WRAPPER}} .item .item-area .product-name',
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
			'tab_wrap_bg',
			[
				'label' => __( 'رنگ پس زمینه نگهدارنده تب ها', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'alpha' => false,
				'selectors' => [
					'{{WRAPPER}} .block-tabs-wrap' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'tab_wrap_border_radius',
			[
				'label' => __( 'گوشه های مدور مورد بالا', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .block-tabs-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'item_border_radius',
			[
				'label' => __( 'گوشه های مدور محصول', 'mweb' ),
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
	
		
		$this->start_controls_tabs( 'tabs_style' );

		$this->start_controls_tab( 'normal_tabs_style',
			[
				'label' => __( 'حالت پیشفرض', 'mweb' ),
			]
		);

		$this->add_control(
			'tab_text_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tab_box li a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'tab_bg_color',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'alpha' => false,
				'selectors' => [
					'{{WRAPPER}} .tab_box li' => 'background-color: {{VALUE}}',
				],
			]
		);

	

		$this->end_controls_tab();

		$this->start_controls_tab( 'active_tabs_style',
			[
				'label' => __( 'حالت فعال', 'mweb' ),
			]
		);

		$this->add_control(
			'active_tab_text_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tab_box li.active a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .tab_box li:hover a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'active_tab_bg_color',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'alpha' => false,
				'selectors' => [
					'{{WRAPPER}} .tab_box li.active' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .tab_box li:hover' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .elm_product_tabs_v .block-tabs-wrap ul.tab_box li.active:before' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'active_tab_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .tab_box li.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					'{{WRAPPER}} .elm_product_tabs_v .block-tabs-wrap ul.tab_box li.active:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'separator_tabs_style',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		
		$this->add_control(
			'show_icon',
			[
				'label' => __( 'نمایش آیکن دسته', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'yes' => __( 'بله', 'mweb' ),
					'no' => __( 'خیر', 'mweb' ),
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tab_typography',
				'label' => __( 'تایپوگرافی', 'mweb' ),
				'selector' => '{{WRAPPER}} .tab_box li a',
			]
		);

		$this->add_control(
			'tab_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .tab_box li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tab_box_shadow',
				'selector' => '{{WRAPPER}} .tab_box li',
			]
		);

		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_slider',
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
				'default' => 4,
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
			'navigation_show',
			[
				'label' => __( 'نمایش دکمه فلش ثابت', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'prefix_class' => 'swiper-slider-arrows-fixed-',
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

	
	public function render_tab( $categories, $show_icon = 'no' ) {

		$is_first = true;
		$str = '';
		$str .= '<div class="block-tabs-wrap">';
			if(!empty($categories)){
				$str .= '<ul class="tab_box scrolling-wrapper">';
				foreach ($categories as $cat) {
					$cat_name = mweb_get_product_cat_name($cat['category_id']);
					$el_class = 'v_tab category-'.$cat['category_id'];
					if($is_first){
						$el_class .= ' active';
						$is_first = false;
					}
					$str .= '<li class="'.$el_class.'"><a href="'.  mweb_get_product_cat_link($cat['category_id']) .'" data-ajax_filter_val="'.$cat['category_id'].'" title="'.$cat_name.'">';
					if($show_icon == 'yes')
						$str .=  mweb_get_product_cat_img($cat['category_id'], false);
					$str .= $cat_name .'</a></li>';
				}
				$str .= '</ul>';
			}else{
				$str .= '<div class="mweb-error"><h3>لطفا فیلتر دسته بندی و فیلتر دسته بندی ها را از پنل انتخاب کنید</h3></div>';
			}
		$str .= '</div>';
		return $str;
		
	}

	
	protected function render() {

		$settings = $this->get_settings_for_display();
		
	
		
		$data_setting = array();
		
		$slide_tablet = empty($settings['slides_to_show_tablet']) ? 2 : $settings['slides_to_show_tablet'];
		$slide_mobile = empty($settings['slides_to_show_mobile']) ? 1 : $settings['slides_to_show_mobile'];
		
		
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
		
		if( $settings['is_3d'] == 'yes' ){
			$data_setting['effect'] = 'coverflow';
			$data_setting['grabCursor'] = true;
			//$data_setting['slidesPerView'] = 'auto';
			$data_setting['coverflowEffect'] = array('rotate' => 30, 'stretch' => 0, 'depth' => 100, 'modifier' => 1, 'slideShadows' => true);
		}

		$data_setting['navigation'] = array('nextEl' => '.mweb-swiper-next', 'prevEl' => '.mweb-swiper-prev' );


		$data_setting['breakpoints'] = array('575' => array('slidesPerView' => $slide_mobile), '768' => array('slidesPerView' => $slide_tablet), '1024' => array('slidesPerView' => $settings['slides_to_show']));

		$content_open_class = 'elm_open_c';

						
		$category_id = !empty($settings['cat_list']) ? $settings['cat_list'][0]['category_id'] : 0;
		$query_options = array('category_id' => $category_id, 'posts_per_page' => $settings['posts_per_page'], 'ajax_dropdown' => 'category', 'post_type' => 'product' );
				
		if( $settings['only_instock'] == 'yes' ){
			$query_options['orderby'] = 'only_stock';
		}		
				
				
		$block = array('block_id' => 'mweb_'.$this->get_id(), 'block_classes' => 'elm_product_tabs_v', 'block_name' => 'mweb_product_list_tab_v', 'block_options' => array( 'block_style' => 'simple__'.$settings['item_thumbnail_size'], 'bk_param' => true, 'slider' => $data_setting ));
		$block['block_options'] = array_merge($block['block_options'], $query_options);
		

		$query_data = \mweb_theme_query::get_custom_query( $query_options );
		
				
		echo \mweb_theme_block::block_open( $block, $query_data );
		echo $this->render_tab( $settings['cat_list'], $settings['show_icon'] );
		echo \mweb_theme_block::block_content_open($content_open_class);	
		
		//check empty
		if ( $query_data->have_posts() ) {
			echo mweb_product_list_tab_v($query_data, $block['block_options']);
		} else {
			echo mweb_no_content();
		}
		//reset post data
		wp_reset_postdata();
		
		echo \mweb_theme_block::block_content_close();
		echo \mweb_theme_block::block_footer( $block );
		echo \mweb_theme_block::block_close();
		
		
	}

	
	function content_template() {
		
	}
}