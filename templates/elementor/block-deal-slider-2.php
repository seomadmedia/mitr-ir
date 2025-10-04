<?php
namespace ElementorMahdisweb\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Module Product Slider
 * @since 1.0.0
 */
class Block_Mobile_Deal_Slider extends Widget_Base {

	
	public function get_name() {
		return 'mobile-deal-slider-product';
	}


	public function get_title() {
		return __( 'فروش ویژه سه', 'mweb' );
	}


	public function get_icon() {
		return 'eicon-slider-push';
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
				'default' => __( 'پیشنهادات شگفت انگیز', 'mweb' ),
			]
		);
		
		$this->add_responsive_control(
			'title_fontsize',
			[
				'label' => __( 'اندازه عنوان', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 13,
				],
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .block-special-title' => 'font-size: {{SIZE}}{{UNIT}}',
				],
				'condition' => [ 'block_name!' => ['type-3'] ],

			]
		);
		
		$this->add_responsive_control(
			'title_lineheight',
			[
				'label' => __( 'ارتفاع خط', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 39,
				],
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .block-special-title' => 'line-height: {{SIZE}}{{UNIT}}',
				],
				'condition' => [ 'block_name!' => ['type-3'] ],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'تایپوگرافی عنوان', 'mweb' ),
				'selector' => '{{WRAPPER}} .block-special-title',
				'condition' => [ 'block_name' => ['type-3'] ],
			]
		);
		
		$this->add_control(
			'title_color',
			[
				'label' => __( 'رنگ عنوان', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .block-special-title' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'title_color_sec',
			[
				'label' => __( 'رنگ عنوان دوم', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .block-special-title span' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'title_bgcolor',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .block-special-title' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'title_padding',
			[
				'label' => __( 'فاصله داخلی', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .block-special-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => __( 'فاصله خارجی', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .block-special-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		
		$this->add_control(
			'title_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .block-special-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
			'title_icon_color',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .block-special-title .deal_icon svg' => 'stroke: {{VALUE}}; fill: {{VALUE}}',
				],
			]
		);
		
		$this->add_responsive_control(
			'title_icon_fontsize',
			[
				'label' => __( 'اندازه آیکن', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 20,
				],
				'range' => [
					'px' => [
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .block-special-title .deal_icon svg' => 'width: {{SIZE}}{{UNIT}}',
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
			'posts_per_page',
			[
				'label' => __( 'تعداد مطالب', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 5,
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
			'section_type',
			[
				'label' => __( 'نمـایش', 'mweb' ),
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
		
		$this->add_control(
			'block_name',
			[
				'label' => __( 'نوع نمایش', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'type-1' => __( 'یک', 'mweb' ),
					'type-2' => __( 'دو', 'mweb' ),
					'type-3' => __( 'سه', 'mweb' ),
					'type-4' => __( 'چهار', 'mweb' ),
					'type-5' => __( 'پنج', 'mweb' ),

				],
				'default' => 'type-1',
			]
		);
		
		
		$this->add_control(
			'off_bgcolor',
			[
				'label' => __( 'رنگ پس زمینه درصد تخفیف', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .special_wrap .timer_wrap .deal_item_off' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .deal_type-3 .special_wrap .deal_item_off' => 'background-color: {{VALUE}}; box-shadow: unset',
				],
				'condition' => [ 'block_name' => ['type-1', 'type-3'] ],
			]
		);
		
		$this->add_control(
			'off_border_radius',
			[
				'label' => __( 'گوشه های مدور درصد تخفیف', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .special_wrap .timer_wrap .deal_item_off' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 'block_name' => ['type-1'] ],
			]
		);
		
		$this->add_control(
			'svg_color',
			[
				'label' => __( 'فضای خالی و خط چین', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .deal_title_wrap svg' => 'fill: {{VALUE}}',
					'.woocommerce {{WRAPPER}} .deal_title_wrap' => 'border-left-color: {{VALUE}}',
				],
				'condition' => [ 'block_name' => ['type-3'] ],

			]
		);


		$this->add_control(
			'item_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .item .item-area' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .swiper-slide-shadow-right' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .swiper-slide-shadow-left' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .item .item-area .product-name, {{WRAPPER}} .special_wrap h2 a',
			]
		);
		
		$this->add_control(
			'title_line_extend',
			[
				'label' => __( 'عنوان دو خطی', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'prefix_class' => 'special-title-extend-',
				'condition' => [ 'block_name' => ['type-1'] ],
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
					'{{WRAPPER}} .item .item-area .price, {{WRAPPER}} .special_wrap .price .woocommerce-Price-amount, {{WRAPPER}} .special_wrap .price del .woocommerce-Price-amount' => 'font-size: {{SIZE}}{{UNIT}};',
				]
			]
		);
		
		$this->add_responsive_control(
			'product_price_alignment',
			[
				'label' => __( 'تراز قیمت', 'mweb' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'flex-end' => [
						'title' => __( 'چپ', 'mweb' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'وسط', 'mweb' ),
						'icon' => 'eicon-text-align-center',
					],
					'flex-start' => [
						'title' => __( 'راست', 'mweb' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .item .item-area.elm_pg_6 .flex_row' => 'justify-content: {{VALUE}}',
				],
			]
		);
		
		$this->add_responsive_control(
			'product_title_alignment',
			[
				'label' => __( 'تراز عنوان', 'mweb' ),
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
			'counter_bgcolor',
			[
				'label' => __( 'رنگ پس زمینه شمارنده', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item .item-area.elm_pg_6 .vc_deal_time.product-date>div' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .deal_type-3 .special_wrap .timer_wrap' => 'background-color: {{VALUE}}; box-shadow: unset',
				],
				'condition' => [ 'block_name' => ['type-1', 'type-3'] ],
			]
		);
		
		

		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_style',
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
				'default' => 5,
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
				]
			]
		);
		
		$this->add_control(
			'navigation_show',
			[
				'label' => __( 'نمایش دکمه فلش ثابت', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'prefix_class' => 'swiper-slider-arrows-fixed-',
				'condition' => [ 'navigation' => ['both', 'arrows'] ],
			]
		);
		
		$this->add_control(
			'autoplay',
			[
				'label' => __( 'پخش خودکار', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'yes',
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
				'default' => 'yes',
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
				'default' => 'yes',
				'options' => [
					'yes' => __( 'بله', 'mweb' ),
					'no' => __( 'خیر', 'mweb' ),
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
		
		$this->start_controls_section(
			'section_fitem',
			[
				'label' => __( 'آیتم اول', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'fitem_view',
			[
				'label' => __( 'فعال سازی', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => __( 'غیرفعال', 'mweb' ),
					'desktop' => __( 'دسکتاپ', 'mweb' ),
					'mobile' => __( 'موبایل', 'mweb' ),
					'both' => __( 'هر دو', 'mweb' ),
				],
			]
		);
		
		$this->add_control(
			'fitem_image',
			[
				'label' => __( 'عکس', 'mweb' ),
				'type' => Controls_Manager::MEDIA,
			]
		);
		
		$this->add_control(
			'fitem_link',
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
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'fitem_background',
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .elm_fitem',
			]
		);
		
		$this->add_control(
			'btnf_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'دکمه', 'mweb' ),
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'btnf_text',
			[
				'label'       => __( 'متن دکمه', 'mweb' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '', 'mweb' ),
				'placeholder' => __( 'متن دلخواه', 'mweb' ),
			]
		);

		$this->add_control(
			'btnf_link',
			[
				'label'         => __( 'لینک دکمه', 'mweb' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'mweb' ),
				'show_external' => true,
				'default'       => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				],
				'condition' => [ 'fitem_link' => '' ],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'btnf_typography',
				'label'    => __( 'تایپوگرافی', 'mweb' ),
				'selector' => '{{WRAPPER}} .elm_fbtn',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'btnf_background',
				'label'    => __( 'پس زمینه دکمه', 'mweb' ),
				'types'    => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .elm_fbtn',
			]
		);

		$this->add_control(
			'btnf_text_color',
			[
				'label'     => __( 'رنگ متن', 'mweb' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elm_fbtn' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'btnf_padding',
			[
				'label'      => __( 'پدینگ', 'mweb' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elm_fbtn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'btnf_margin',
			[
				'label'      => __( 'فاصله', 'mweb' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elm_fbtn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'btnf_border_radius',
			[
				'label'      => __( 'انحنای گوشه ها', 'mweb' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elm_fbtn' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_eitem',
			[
				'label' => __( 'آیتم آخر', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'eitem_view',
			[
				'label' => __( 'فعال سازی', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => __( 'غیرفعال', 'mweb' ),
					'desktop' => __( 'دسکتاپ', 'mweb' ),
					'mobile' => __( 'موبایل', 'mweb' ),
					'both' => __( 'هر دو', 'mweb' ),
				],
			]
		);
		
		$this->add_control(
			'eitem_image',
			[
				'label' => __( 'عکس', 'mweb' ),
				'type' => Controls_Manager::MEDIA,
			]
		);
		
		$this->add_control(
			'eitem_link',
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
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'eitem_background',
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .elm_eitem',
			]
		);
		
		$this->add_control(
			'btne_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'دکمه', 'mweb' ),
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'btne_text',
			[
				'label'       => __( 'متن دکمه', 'mweb' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '', 'mweb' ),
				'placeholder' => __( 'متن دلخواه', 'mweb' ),
			]
		);

		$this->add_control(
			'btne_link',
			[
				'label'         => __( 'لینک دکمه', 'mweb' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'mweb' ),
				'show_external' => true,
				'default'       => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				],
				'condition' => [ 'eitem_link' => '' ],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'btne_typography',
				'label'    => __( 'تایپوگرافی', 'mweb' ),
				'selector' => '{{WRAPPER}} .elm_ebtn',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'btne_background',
				'label'    => __( 'پس زمینه دکمه', 'mweb' ),
				'types'    => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .elm_ebtn',
			]
		);

		$this->add_control(
			'btne_text_color',
			[
				'label'     => __( 'رنگ متن', 'mweb' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elm_ebtn' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'btne_padding',
			[
				'label'      => __( 'پدینگ', 'mweb' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elm_ebtn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'btne_margin',
			[
				'label'      => __( 'فاصله', 'mweb' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elm_ebtn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'btne_border_radius',
			[
				'label'      => __( 'انحنای گوشه ها', 'mweb' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elm_ebtn' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();
		
	}


	public function render_block_header( $title, $icon, $type ){
		if(!empty($title)) {
			list($title_1, $title_2) = preg_split('/ /', $title, 2);  
			$html = '<div class="block-special-title"><div class="deal_icon">'.$icon.'</div><span>'.$title_1.'</span>'.$title_2.'</div>';
			return $type == 'type-3' ? '<div class="deal_title_wrap">'.$html.'<svg class="space_top" width="125" height="98" viewBox="0 0 125 98" fill="#FFF" xmlns="http://www.w3.org/2000/svg">
<path d="M125 54C95.3 54 93.3234 97.5 63.5 97.5C33.6766 97.5 29.5 54 0 54C0 24.1766 33.6766 0 63.5 0C93.3234 0 125 24.1766 125 54Z" fill="inherit"/>
</svg><svg class="space_bottom" width="125" height="98" viewBox="0 0 125 98" fill="#FFF" xmlns="http://www.w3.org/2000/svg">
<path d="M125 54C95.3 54 93.3234 97.5 63.5 97.5C33.6766 97.5 29.5 54 0 54C0 24.1766 33.6766 0 63.5 0C93.3234 0 125 24.1766 125 54Z" fill="inherit"/>
</svg></div>' : $html;
		}
	}

	protected function render() {
		
		$settings = $this->get_settings_for_display();
		
		$wp_is_mobile = wp_is_mobile();
		
		$show_dots = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
		$show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
		
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
		
		if($settings['is_3d'] == 'yes'){
			$data_setting['effect'] = 'coverflow';
			$data_setting['grabCursor'] = true;
			//$data_setting['slidesPerView'] = 'auto';
			$data_setting['coverflowEffect'] = array('rotate' => 30, 'stretch' => 0, 'depth' => 100, 'modifier' => 1, 'slideShadows' => true);
		}
	
		if( $show_dots ){
			$data_setting['pagination'] = array('el' => '.mweb-swiper-pagination', 'clickable' => true);
		}
		if( $show_arrows ){
			$data_setting['navigation'] = array('nextEl' => '.mweb-swiper-next', 'prevEl' => '.mweb-swiper-prev' );
		}
		

		$data_setting['breakpoints'] = array('575' => array('slidesPerView' => $slide_mobile), '768' => array('slidesPerView' => $slide_tablet), '1024' => array('slidesPerView' => $settings['slides_to_show']));
			
		$arrow_right = 'arrow-right-1';
		$arrow_left = 'arrow-left-1';	
			
		$attr_class = 'swiper xslider';
		if($settings['overflow'] == 'yes'){
			$attr_class .= ' swiper-wrap-visible';
		}
		
		$block_classes = 'deal_'.$settings['block_name'];
		
		if( $settings['block_name'] == 'type-2' ){
			$loop_name = 'mweb_loop_template_product_onsale_2';
		} elseif ( $settings['block_name'] == 'type-3' ) {
			$loop_name = 'mweb_loop_template_product_mobile_onsale_2';
			if( empty($settings['title']) ){
				$block_classes .= ' deal_wide';
			}
		} elseif ( $settings['block_name'] == 'type-4' ) {
			$loop_name = 'mweb_loop_template_product_mobile_onsale_3';
			if( empty($settings['title']) ){
				$block_classes .= ' deal_wide';
			}
		} elseif ( $settings['block_name'] == 'type-5' ) {
			$loop_name = 'mweb_loop_template_product_mobile_onsale_4';
			$block_classes = 'deal_type-4 deal_'.$settings['block_name'];
			if( empty($settings['title']) ){
				$block_classes .= ' deal_wide';
			}
		} else {
			$loop_name = 'mweb_loop_template_product_mobile_onsale';
		}

		$this->add_render_attribute( [
			'carousel-wrapper' => [
				'class' => $attr_class,
				'id' => 'sl_'.$this->get_id(),
				'dir' => 'rtl',
				'data-slider' => wp_json_encode($data_setting)
			],
		] );
		
		$query_options = array('category_id' => $settings['category_id'], 'posts_per_page' => $settings['posts_per_page'], 'orderby' => 'on_sale', 'offset' => $settings['offset'], 'post__in' => $settings['include_products'], 'post_not_in' => $settings['exclude_products'], 'post_type' => 'product', 'in_stock' => true );
				
		$block = array('block_id' => 'mweb_'.$this->get_id(), 'block_name' => 'mweb_'.$this->get_name(), 'block_options' => $query_options, 'block_classes' => $block_classes);
		//$block['block_options'] = array_merge($block['block_options'], array('title' => $settings['title'] ));
		
		$query_data = \mweb_theme_query::get_custom_query( $query_options );
		
		echo \mweb_theme_block::block_open( $block, $query_data );
		echo $this->render_block_header( $settings['title'], $settings['title_picon'], $settings['block_name'] );
		echo \mweb_theme_block::block_content_open();
		
		//check empty
		if ( $query_data->have_posts() ) {

			echo '<div '. $this->get_render_attribute_string( 'carousel-wrapper' ) .'>';
			echo '<div class="swiper-wrapper">';
			
				$fitem_data = [
					'view' => $settings['fitem_view'] ?? 'none',
					'image' => $settings['fitem_image']['url'] ?? '',
					'link' => $settings['fitem_link'] ?? [],
					'title' => $settings['title'] ?? [],
					'is_mobile' => $wp_is_mobile,
					'class' => 'elm_fitem'
				];
				
				$btn_data = [
					'text' => $settings['btnf_text'] ?? '',
					'link' => $settings['btnf_link'] ?? [],
					'class' => 'elm_fbtn',
				];

				echo mweb_loop_template_first_item($fitem_data, true, $btn_data);
			
			
				while ( $query_data->have_posts() ) : 
					$query_data->the_post(); 
					echo '<div class="swiper-slide">';
						echo $loop_name(array('thumbnail' => $settings['item_thumbnail_size']));
					echo '</div>';
				endwhile;
				
				
				$fitem_data = [
					'view' => $settings['eitem_view'] ?? 'none',
					'image' => $settings['eitem_image']['url'] ?? '',
					'link' => $settings['eitem_link'] ?? [],
					'title' => $settings['title'] ?? [],
					'is_mobile' => $wp_is_mobile,
					'class' => 'elm_eitem'
				];
				
				$btn_data = [
					'text' => $settings['btne_text'] ?? '',
					'link' => $settings['btne_link'] ?? [],
					'class' => 'elm_ebtn',
				];

				echo mweb_loop_template_first_item($fitem_data, true, $btn_data);
				
				
			echo '</div>';	
				if ( $show_dots ) { 
					echo '<div class="mweb-swiper-pagination"></div>';
				} 
				if ( $show_arrows ){
					echo '<div class="mweb-swiper-next"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#'.$arrow_right.'"></use></svg></div><div class="mweb-swiper-prev"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#'.$arrow_left.'"></use></svg></div>';
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
