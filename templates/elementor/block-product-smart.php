<?php
namespace ElementorMahdisweb\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Widget Class
 *
 * Elementor widget for the class below
 *
 * @since 1.0.0
 */
class Block_Product_Smart extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'smart-slider-product';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'اسلایدر محصولات هوشمند', 'mweb' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-form-vertical';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'digiland' ];
	}


	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
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
			'number_of_block',
			[
				'label' => __( 'تعداد بلاک ها', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 2,
				'min' => 1,
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
				'label' => __( 'تعداد مطالب', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 5,
				'min' => 1,
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
				'options' => [
					'mweb_theme_fw_block_1' => __( 'یک', 'mweb' ),
					'mweb_theme_fw_block_9' => __( 'دو', 'mweb' ),
					'mweb_theme_fw_block_10' => __( 'سه', 'mweb' )
				],
				'default' => 'mweb_theme_fw_block_1',
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
			'ctrl',
			[
				'label' => __( 'نمایش دکمه چپ و راست', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 0,
				'options' => get_element_on_off()
			]
		);
		
		$this->add_control(
			'pager',
			[
				'label' => __( 'دکمه ی صفحه بندی اسلایدر', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 0,
				'options' => get_element_on_off()
			]
		);
		
		$this->add_control(
			'auto_play',
			[
				'label' => __( 'پخش خودکار', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 0,
				'options' => get_element_on_off()
			]
		);
		
		$this->add_control(
			'rcol_desktop',
			[
				'label' => __( 'تعداد در ردیف دسکتاپ', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'mix' => 6,
				'default' => 5,
			]
		);
		$this->add_control(
			'rcol_tablet',
			[
				'label' => __( 'تعداد در ردیف تبلت', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'mix' => 4,
				'default' => 3,
			]
		);
		$this->add_control(
			'rcol_mobile',
			[
				'label' => __( 'تعداد در ردیف موبایل', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'mix' => 2,
				'default' => 1,
			]
		);
	

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', wp_unslash( $_COOKIE['woocommerce_recently_viewed'] ) ) : array(); // @codingStandardsIgnoreLine
		$viewed_products = array_reverse( array_filter( array_map( 'absint', $viewed_products ) ) );
		
		if ( empty( $viewed_products ) ) {
			return;
		}
		$categories_args = array();
		foreach($viewed_products as $vd_product){
			$_product = wc_get_product( $vd_product );
				if( !is_object($_product) ){
					continue;
				}
			$categories_args = array_merge($categories_args, $_product->get_category_ids());
		}
	
		$number_of_block = empty($settings['number_of_block']) ? 2 : $settings['number_of_block'];
		$categories_args = array_unique($categories_args);
		if(!empty($categories_args)){
			foreach($categories_args as $key => $cat){
				
				if($key >= $number_of_block){
					break;
				}
				$query_options = array('category_id' => absint($cat) ,'posts_per_page' => $settings['posts_per_page'],'post_type' => 'product' );
				$block_id = 'mweb_'.$this->get_id();
				$block_name = get_term_by('id', absint($cat) , 'product_cat' );
				$device_col = $settings['rcol_desktop'].':'.$settings['rcol_tablet'].':'.$settings['rcol_mobile'];
				$block_options = array('block_id' => $block_id ,'block_type' => 'full_width','block_name' => $settings['block_name'],'block_options' => array('title' => $settings['title'].' '.$block_name->name,'pager' => $settings['pager'],'ctrl' => $settings['ctrl'],'num_of_slider' => $device_col,'auto_play' => $settings['auto_play'] ));

				$block_options['block_options'] = array_merge($block_options['block_options'],$query_options);

				
				$query_data = \mweb_theme_query::get_custom_query( $query_options );

				$str = '';
				$str .= \mweb_theme_block::block_open( $block_options, $query_data );
				$str .= \mweb_theme_block::block_header( $block_options );
				$str .= call_user_func_array(array($settings['block_name'], "content"), array($block_options, $query_data));
				$str .= \mweb_theme_block::block_footer( $block_options );
				$str .= \mweb_theme_block::block_close();

				echo $str; 
				
			}
		}
			

		
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function content_template() {
		
	}
}
