<?php
namespace ElementorMahdisweb\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Module Onsale TimeLine
 * @since 1.0.0
 */
class Block_Deal_Timeline extends Widget_Base {

	
	public function get_name() {
		return 'block-deal-timeline';
	}

	
	public function get_title() {
		return __( 'جعبه تخفیف', 'mweb' );
	}

	
	public function get_icon() {
		return 'eicon-products';
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

		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_filter',
			[
				'label' => __( 'فیلتر', 'mweb' ),
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label' => __( 'تعداد محصول', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 6,
				'min' => 1,
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
					'{{WRAPPER}} .item_simple .item-area .price' => 'font-size: {{SIZE}}{{UNIT}};',
				]
			]
		);
		
		$this->add_control(
			'item_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
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
		

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_color',
				'label' => __( 'رنگ پس زمینه عنوان', 'mweb' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .discount_title, {{WRAPPER}} .discount_num'
			]
		);
		
		$this->add_control(
			'line_color',
			[
				'label' => __( 'رنگ خط چین', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elm_off_line' => 'stroke: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'circle_txt_color',
			[
				'label' => __( 'رنگ اعداد', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elm_off_text' => 'fill: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'circle_bg_color',
			[
				'label' => __( 'رنگ پس زمینه اعداد', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elm_off_point' => 'fill: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'circle_border_color',
			[
				'label' => __( 'رنگ حاشیه اعداد', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elm_off_point' => 'stroke: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'circle_bgac_color',
			[
				'label' => __( 'رنگ پس زمینه فعال', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elm_off_point.active' => 'fill: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'circle_marker_color',
			[
				'label' => __( 'رنگ مارکر', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elm_off_picker svg' => 'stroke: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_section();
		

	}
	
	
	public function render_tab( $title ) {

			$str = '';

			$str .= '<div class="block-title '. ( !empty($title) ? 'd-flex' : '' ) .'">';
			if( $title ){
				$str .= '<span class="discount_title">';
					$str .= esc_attr( $title );
				$str .= '<div class="discount_num_wrap">';
				$str .= '<select class="discount_num">
							<option value="3">3</option>
							<option value="6" selected>6</option>
							<option value="9">9</option>
							<option value="12">12</option>
						</select>';
				$str .= '</div>';
				$str .= '</span>';
			}
			$str .= '<div class="elm_off_svg"><svg xmlns="http://www.w3.org/2000/svg" width="1200" height="100" viewBox="0 0 1200 100">
			  <path class="elm_off_line" d="M1196,67c-45.92-10.845-90.86-13.964-135-9-48.54,5.458-76.176,22.546-125,24-64.145,1.91-93.067-21.452-157-27-61.008-5.294-87.8,19.883-149,22-75.317,2.605-115.68-23.469-191-26-62.059-2.086-155.592,20.518-167,22C184.715,84.342,94.57,78.349,1,56"></path>
			  <circle class="elm_off_point active" cx="1129.5" cy="54.5" r="12.5"></circle>
			  <text class="elm_off_text" id="1-10" x="1134" y="57.5">10</text>
			  <circle class="elm_off_point" cx="1022.5" cy="64.5" r="12.5"></circle>
			  <text class="elm_off_text" id="11-20" x="1028" y="67.5">20</text>
			  <circle class="elm_off_point" cx="945.5" cy="80.5" r="12.5"></circle>
			  <text class="elm_off_text" id="21-30" x="952" y="83.5">30</text>
			  <circle class="elm_off_point" cx="781.5" cy="54.5" r="12.5"></circle>
			  <text class="elm_off_text" id="31-40" x="787" y="57.5">40</text>
			  <circle class="elm_off_point" cx="585.5" cy="74.5" r="12.5"></circle>
			  <text class="elm_off_text" id="41-50" x="591" y="77.5">50</text>
			  <circle class="elm_off_point" cx="476.5" cy="52.5" r="12.5"></circle>
			  <text class="elm_off_text" id="51-60" x="483" y="55.5">60</text>
			  <circle class="elm_off_point" cx="418.5" cy="49.5" r="12.5"></circle>
			  <text class="elm_off_text" id="61-70" x="424" y="52.5">70</text>
			  <circle class="elm_off_point" cx="342.5" cy="58.5" r="12.5"></circle>
			  <text class="elm_off_text" id="71-80" x="348" y="61.5">80</text>
			  <circle class="elm_off_point" cx="155.5" cy="77.5" r="12.5"></circle>
			  <text class="elm_off_text" id="81-90" x="161" y="80.5">90</text>
			  <circle class="elm_off_point" cx="51.5" cy="65.5" r="12.5"></circle>
			  <text class="elm_off_text" id="91-100" x="58.5" y="68.5">100</text>
			</svg>
			</div>
			<div class="elm_off_picker"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#location"></use></svg></div>';
			
			$str .= '</div>';

			return $str;
			
		}

	
	protected function render() {

		$settings = $this->get_settings_for_display();

		$item_tablet = empty($settings['item_in_row_tablet']) ? 2 : $settings['item_in_row_tablet'];
		$item_mobile = empty($settings['item_in_row_mobile']) ? 1 : $settings['item_in_row_mobile'];
		
		$column_in_row = $item_mobile.'_'.$item_tablet.'_'.$settings['item_in_row'];
						
		$block = array('block_id' => 'mweb_'.$this->get_id(), 'block_name' => 'mweb_onsale_product_timeline', 'block_options' => array( 'title' => $settings['title'], 'posts_per_page' => $settings['posts_per_page'], 'post_type' => 'product', 'column_in_row' => $column_in_row, 'bk_param' => true ));

		
		$query_options = array();
		$query_options['array_range'] = '1-10';
		$query_options['posts_per_page'] = $settings['posts_per_page'];

		$query_data = \mweb_theme_query::mweb_query_discount( $query_options );
		
				
		echo \mweb_theme_block::block_open( $block, $query_data );
		echo $this->render_tab( $settings['title'] );
		echo \mweb_theme_block::block_content_open();
		
		//check empty
		if ( $query_data->have_posts() ) {
			echo mweb_onsale_product_timeline($query_data, $block['block_options']);
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
