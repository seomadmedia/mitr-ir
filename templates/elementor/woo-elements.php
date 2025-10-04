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
 * Elementor Woocommerce Breadcrumbs
 * @since 1.0.0
 */
class My_Woo_Breadcrumbs extends Widget_Base {

	
	public function get_name() {
		return 'mweb-breadcrumbs';
	}
	
	public function get_title() {
		return __( 'مسیر جاری', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-product-breadcrumbs';
	}

	public function get_categories() {
		return [ 'digiland_woo' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تنظیمات', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woocommerce-breadcrumb' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'link_color',
			[
				'label' => __( 'رنگ لینک', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woocommerce-breadcrumb > a' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'sep_type',
			[
				'label' => __( 'تبدیل جداکننده به ممیز', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'prefix_class' => 'elementor_breadcrumb_sepslash_',
			]
		);
		
		$this->add_control(
			'sep_color',
			[
				'label' => __( 'رنگ جدا کننده', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#888',
				'selectors' => [
					'.woocommerce {{WRAPPER}} .woocommerce-breadcrumb a:after' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_responsive_control(
			'sep_space',
			[
				'label' => __( 'فاصله جداکننده', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 7,
					],
				],
				'selectors' => [
					'.woocommerce {{WRAPPER}} .woocommerce-breadcrumb a:after' => 'margin: 0 {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'selector' => '{{WRAPPER}} .woocommerce-breadcrumb',
			]
		);

		$this->add_responsive_control(
			'alignment',
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
					'{{WRAPPER}} .woocommerce-breadcrumb' => 'text-align: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'elm_bg',
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .woocommerce-breadcrumb'
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'elm_border',
				'selector' => '{{WRAPPER}} .woocommerce-breadcrumb',
			]
		);

		$this->add_control(
			'elm_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .woocommerce-breadcrumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'elm_box_shadow',
				'selector' => '{{WRAPPER}} .woocommerce-breadcrumb',
			]
		);
		
		$this->end_controls_section();
		


	}

	
	protected function render() {
		woocommerce_breadcrumb();
	}

	
	protected function content_template() {
		
	}
}






/**
 * Elementor Woocommerce Title
 * @since 1.0.0
 */
class My_Woo_Title extends Widget_Base {

	
	public function get_name() {
		return 'mweb-title';
	}
	
	public function get_title() {
		return __( 'عنوان محصول', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-product-title';
	}

	public function get_categories() {
		return [ 'digiland_woo' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تنظیمات', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'رنگ عنوان', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product_title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .product_title',
			]
		);

		$this->add_control(
			'show_en_title',
			[
				'label' => __( 'نمایش عنوان انگلیسی', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بلی', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'title_en_color',
			[
				'label' => __( 'رنگ عنوان انگلیسی', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sub_head' => 'color: {{VALUE}}',
				],
				'condition' => [ 'show_en_title' => ['yes'] ],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_en_typography',
				'selector' => '{{WRAPPER}} .sub_head',
				'condition' => [ 'show_en_title' => ['yes'] ],
			]
		);
		
		$this->add_control(
			'show_fake_tag',
			[
				'label' => __( 'نمایش برچسب غیر اصل', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بلی', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'show_custom_tag',
			[
				'label' => __( 'نمایش برچسب سفارشی', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بلی', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		
		$this->end_controls_section();
		


	}

	
	protected function render() {
		$settings = $this->get_settings_for_display();
		
		echo '<h1 class="product_title entry-title">';
			the_title();
			$is_fake = get_post_meta( get_the_ID(), '_is_fake', true );
			if($is_fake == 'yes' && $settings['show_fake_tag'] === 'yes'){
				echo '<span class="is_fake_label">غیر اصل</span>';
			}
			$custom_label = get_post_meta( get_the_ID(), '_is_custom_label', true );
			if(!empty($custom_label) && $settings['show_custom_tag'] === 'yes'){
				echo '<span class="is_custom_label">'.$custom_label.'</span>';
			}
			$p_subtitle = get_post_meta( get_the_ID(), '_product_subtitle', true );
			if(!empty($p_subtitle) && $settings['show_en_title'] === 'yes'){
				echo '<span class="sub_head">'.$p_subtitle.'</span>';
			}
		echo '</h1>';
	}

	
	protected function content_template() {
		
	}
}





/**
 * Elementor Woocommerce Rating Star
 * @since 1.0.0
 */
class My_Woo_Rating extends Widget_Base {

	
	public function get_name() {
		return 'mweb-rating';
	}
	
	public function get_title() {
		return __( 'امتیاز محصول', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-product-rating';
	}

	public function get_categories() {
		return [ 'digiland_woo' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تنظیمات', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'star_color',
			[
				'label' => __( 'رنگ ستاره', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .star-rating svg' => 'stroke: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'link_color',
			[
				'label' => __( 'رنگ لینک', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .woocommerce-review-link' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'selector' => '.woocommerce {{WRAPPER}} .woocommerce-review-link',
			]
		);

		$this->add_control(
			'star_size',
			[
				'label' => __( 'اندازه ستاره', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'em',
				],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 4,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'.woocommerce {{WRAPPER}} .star-rating svg ' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'space_between',
			[
				'label' => __( 'فاصله بین', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'unit' => 'em',
				],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 4,
						'step' => 0.1,
					],
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'selectors' => [
					'.woocommerce.rtl {{WRAPPER}} .star-rating' => 'margin-left: {{SIZE}}{{UNIT}}',
				],
			]
		);
		
		$this->add_control(
			'is_vertical',
			[
				'label' => __( 'ترتیب عمودی', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'prefix_class' => 'elementor-product-star-rating-vertical-',
			]
		);

		$this->add_responsive_control(
			'alignment',
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
				'prefix_class' => 'elementor-product-rating--align-',
			]
		);
		
		
		$this->end_controls_section();
		


	}

	
	protected function render() {
		if ( ! post_type_supports( 'product', 'comments' ) ) {
			return;
		}

		global $product;
		$product = wc_get_product();

		if ( empty( $product ) ) {
			return;
		}

		wc_get_template( 'single-product/rating.php' );
	}

	
	protected function content_template() {
		
	}
}





/**
 * Elementor Woocommerce Meta
 * @since 1.0.0
 */
class My_Woo_Meta extends Widget_Base {

	
	public function get_name() {
		return 'mweb-meta';
	}
	
	public function get_title() {
		return __( 'متای محصول', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-product-meta';
	}

	public function get_categories() {
		return [ 'digiland_woo' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تنظیمات', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'view',
			[
				'label' => __( 'نوع نمایش', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'inline',
				'options' => [
					'table' => __( 'جدولی', 'mweb' ),
					'stacked' => __( 'سطری', 'mweb' ),
					'inline' => __( 'خطی', 'mweb' ),
				],
				'prefix_class' => 'elementor-woo-meta--view-',
			]
		);

		$this->add_responsive_control(
			'space_between',
			[
				'label' => __( 'فاصله', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}}:not(.elementor-woo-meta--view-inline) .product_meta .detail-container:not(:last-child)' => 'padding-bottom: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}}:not(.elementor-woo-meta--view-inline) .product_meta .detail-container:not(:first-child)' => 'margin-top: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}}.elementor-woo-meta--view-inline .product_meta .detail-container' => 'margin-right: calc({{SIZE}}{{UNIT}}/2); margin-left: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}}.elementor-woo-meta--view-inline .product_meta' => 'margin-right: calc(-{{SIZE}}{{UNIT}}/2); margin-left: calc(-{{SIZE}}{{UNIT}}/2)',
					'body:not.rtl {{WRAPPER}}.elementor-woo-meta--view-inline .detail-container:after' => 'left: calc( (-{{SIZE}}{{UNIT}}/2) - ({{divider_weight.SIZE}}px/2) )',
				],
			]
		);

		$this->add_control(
			'divider',
			[
				'label' => __( 'جداکننده', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => __( 'بلی', 'mweb' ),
				'label_on' => __( 'خیر', 'mweb' ),
				'selectors' => [
					'{{WRAPPER}} .product_meta .detail-container:not(:last-child):after' => 'content: ""',
				],
				'return_value' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'divider_style',
			[
				'label' => __( 'استایل جداکننده', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'solid' => __( 'توپر', 'mweb' ),
					'double' => __( 'دوخطی', 'mweb' ),
					'dotted' => __( 'نقطه', 'mweb' ),
					'dashed' => __( 'خط فاصله', 'mweb' ),
				],
				'default' => 'solid',
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}:not(.elementor-woo-meta--view-inline) .product_meta .detail-container:not(:last-child):after' => 'border-top-style: {{VALUE}}',
					'{{WRAPPER}}.elementor-woo-meta--view-inline .product_meta .detail-container:not(:last-child):after' => 'border-left-style: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'divider_weight',
			[
				'label' => __( 'ضخامت جداکننده', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 20,
					],
				],
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}:not(.elementor-woo-meta--view-inline) .product_meta .detail-container:not(:last-child):after' => 'border-top-width: {{SIZE}}{{UNIT}}; margin-bottom: calc(-{{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}}.elementor-woo-meta--view-inline .product_meta .detail-container:not(:last-child):after' => 'border-left-width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'divider_width',
			[
				'label' => __( 'عرض جداکننده', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'default' => [
					'unit' => '%',
				],
				'condition' => [
					'divider' => 'yes',
					'view!' => 'inline',
				],
				'selectors' => [
					'{{WRAPPER}} .product_meta .detail-container:not(:last-child):after' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'divider_height',
			[
				'label' => __( 'ارتفاع جداکننده', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'condition' => [
					'divider' => 'yes',
					'view' => 'inline',
				],
				'selectors' => [
					'{{WRAPPER}} .product_meta .detail-container:not(:last-child):after' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'divider_color',
			[
				'label' => __( 'رنگ جداکننده', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ddd',
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .product_meta .detail-container:not(:last-child):after' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'heading_text_style',
			[
				'label' => __( 'استایل متن', 'mweb' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'selector' => '{{WRAPPER}}',
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'رنگ', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'heading_link_style',
			[
				'label' => __( 'استایل لینک', 'mweb' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'link_typography',
				'selector' => '{{WRAPPER}} a',
			]
		);

		$this->add_control(
			'link_color',
			[
				'label' => __( 'رنگ', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a' => 'color: {{VALUE}}',
					'{{WRAPPER}} span.sku' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'item_to_show',
			[
				'label' => __( 'موارد نمایش', 'mweb' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => [
					'p_sku' => __( 'شناسه محصول', 'mweb' ),
					'p_cat' => __( 'دسته بندی محصول', 'mweb' ),
					'p_tag' => __( 'برچسب محصول', 'mweb' ),
					'p_brand' => __( 'برند محصول', 'mweb' ),
				],
			]
		);
		
	
		
		$this->end_controls_section();
		


	}

	
	protected function render() {
	
		global $product;
		$product = wc_get_product();

		if ( empty( $product ) ) {
			return;
		}
		
		$sku = $product->get_sku();
		
		$settings = $this->get_settings_for_display();
		$item_to_show = empty($settings['item_to_show']) ? array() : $settings['item_to_show'];
		
		if( !in_array('p_brand', $item_to_show) )
			remove_action( 'woocommerce_product_meta_start', [ \mweb_product_brand::init(), 'addProductBrand' ] );
			
		add_filter('woocommerce_product_brands_output', function(){ return '';});
		
		?>
		<div class="product_meta">

			<?php do_action( 'woocommerce_product_meta_start' ); ?>

			<?php if ( $sku && wc_product_sku_enabled() && ( $sku || $product->is_type( 'variable' ) ) && in_array('p_sku', $item_to_show) ) : ?>
				<span class="sku_wrapper detail-container"><span class="detail-label">شناسه محصول : </span> <span class="sku"><?php echo $sku; ?></span></span>
			<?php endif; ?>

			<?php if ( count( $product->get_category_ids() ) && in_array('p_cat', $item_to_show) ) : ?>
				<span class="posted_in detail-container"><span class="detail-label">دسته : </span> <span class="detail-content"><?php echo get_the_term_list( $product->get_id(), 'product_cat', '', ', ' ); ?></span></span>
			<?php endif; ?>

			<?php if ( count( $product->get_tag_ids() ) && in_array('p_tag', $item_to_show) ) : ?>
				<span class="tagged_as detail-container">برچسب : </span> <span class="detail-content"><?php echo get_the_term_list( $product->get_id(), 'product_tag', '', ', ' ); ?></span></span>
			<?php endif; ?>

			<?php do_action( 'woocommerce_product_meta_end' ); ?>

		</div>
		<?php

	}

	
	protected function content_template() {
		
	}
}






/**
 * Elementor Woocommerce Short Description
 * @since 1.0.0
 */
class My_Woo_Short_Description extends Widget_Base {

	
	public function get_name() {
		return 'mweb-short-description';
	}
	
	public function get_title() {
		return __( 'توضیحات کوتاه', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-product-description';
	}

	public function get_categories() {
		return [ 'digiland_woo' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تنظیمات', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'text_align',
			[
				'label' => __( 'تراز متن', 'mweb' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'right' => [
						'title' => __( 'راست', 'mweb' ),
						'icon' => 'eicon-text-align-right',
					],
					'center' => [
						'title' => __( 'وسط', 'mweb' ),
						'icon' => 'eicon-text-align-center',
					],
					'left' => [
						'title' => __( 'چپ', 'mweb' ),
						'icon' => 'eicon-text-align-left',
					],
					'justify' => [
						'title' => __( 'کشیده', 'mweb' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .woocommerce-product-details__short-description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'label' => __( 'تایپوگرافی', 'mweb' ),
				'selector' => '.woocommerce {{WRAPPER}} .woocommerce-product-details__short-description',
			]
		);
		
		$this->add_control(
			'has_more',
			[
				'label' => __( 'دکمه مشاهده بیشتر', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			]
		);
		
		$this->add_control(
			'desc_height',
			[
				'label' => __( 'ارتفاع', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'default' => [
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .woocommerce-product-details__short-description' => 'height: {{SIZE}}{{UNIT}}',
				],
				'condition' => [ 'has_more' => ['yes'] ],

			]
		);
		
		
		$this->end_controls_section();
		


	}

	
	protected function render() {
	
		global $product;
		$product = wc_get_product();

		if ( empty( $product ) ) {
			return;
		}
		
		$settings = $this->get_settings_for_display();
		$args = $settings['has_more'] == 'yes' ? array( 'has_more' => true ) : null;
		wc_get_template( 'single-product/short-description.php', $args );
		

	}

	
	protected function content_template() {
		
	}
}





/**
 * Elementor Woocommerce Price
 * @since 1.0.0
 */
class My_Woo_Price extends Widget_Base {

	
	public function get_name() {
		return 'mweb-price';
	}
	
	public function get_title() {
		return __( 'قیمت', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-product-price';
	}

	public function get_categories() {
		return [ 'digiland_woo' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تنظیمات', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		

		$this->add_responsive_control(
			'text_align',
			[
				'label' => __( 'تـراز', 'mweb' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'right' => [
						'title' => __( 'راست', 'mweb' ),
						'icon' => 'eicon-text-align-right',
					],
					'center' => [
						'title' => __( 'وسط', 'mweb' ),
						'icon' => 'eicon-text-align-center',
					],
					'left' => [
						'title' => __( 'چپ', 'mweb' ),
						'icon' => 'eicon-text-align-left',
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'price_color',
			[
				'label' => __( 'رنگ قیمت', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .price' => 'color: {{VALUE}}',
				],
				
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '.woocommerce {{WRAPPER}} .price',
			]
		);

		$this->add_control(
			'sale_heading',
			[
				'label' => __( 'حـراج', 'mweb' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'sale_price_color',
			[
				'label' => __( 'رنگ', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .price ins' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sale_price_typography',
				'selector' => '.woocommerce {{WRAPPER}} .price ins',
			]
		);

		$this->add_control(
			'price_block',
			[
				'label' => __( 'زیر هم', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'prefix_class' => 'elementor-product-price-block-',
			]
		);

		$this->add_responsive_control(
			'sale_price_spacing',
			[
				'label' => __( 'فاصله', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 5,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'body.rtl {{WRAPPER}}:not(.elementor-product-price-block-yes) del' => 'margin-left: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}}.elementor-product-price-block-yes del' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);
		
		$this->add_control(
			'hide_price_outofstock',
			[
				'label' => __( 'مخفی سازی قیمت در محصولات ناموجود', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			]
		);
		
		
		$this->add_control(
			'hide_price',
			[
				'label' => __( 'مخفی سازی قیمت در محصولات متغییر', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			]
		);
		
		
		$this->add_control(
			'price_desc_color',
			[
				'label' => __( 'رنگ توضیحات قیمت', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .jewel_price_details' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_price_desc',
				'label' => __( 'تایپوگرافی توضیحات قیمت', 'mweb' ),
				'selector' => '.woocommerce {{WRAPPER}} .jewel_price_details',
			]
		);
		
		
		$this->end_controls_section();
		


	}

	
	protected function render() {
	
		global $product;
		$product = wc_get_product();

		if ( empty( $product ) ) {
			return;
		}
		
		$settings = $this->get_settings_for_display();
		
		if( mweb_get_product_stock($product) == false || ( $settings['hide_price_outofstock'] == true ) ){
			return;
		}
		
		$price_html = $product->get_price_html();
		
		if( $product->is_type( 'variable' ) ){
			$variations = $product->get_available_variations();
			$count = count( $variations );
			if( $count > 1 && $settings['hide_price'] == true )
				$price_html = '';
		}

		if ( get_post_meta( get_the_ID(), '_upcoming', true ) == 'yes' ) {
			$mweb_upcoming_price = \mweb_theme_util::get_theme_option( 'mweb_upcoming_price' );
            if ( $mweb_upcoming_price ) {
                return;
            }
		}
		
		?>
		<p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>"><?php echo $price_html; ?></p>
		<?php
		
		do_action( 'mweb_jewel_variation_price_detail', $product );

	}

	
	protected function content_template() {
		
	}
}






/**
 * Elementor Woocommerce Add to Cart
 * @since 1.0.0
 */
class My_Woo_Add_To_Cart extends Widget_Base {

	
	public function get_name() {
		return 'mweb-add-to-cart';
	}
	
	public function get_title() {
		return __( 'افزودن به سبد', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-product-add-to-cart';
	}

	public function get_categories() {
		return [ 'digiland_woo' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_atc_button_style',
			[
				'label' => __( 'دکمه افزودن به سبد', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'form_text_color',
			[
				'label' => __( 'رنگ متن فرم', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cart' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'alignment',
			[
				'label' => __( 'تـراز', 'mweb' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'right' => [
						'title' => __( 'راست', 'mweb' ),
						'icon' => 'eicon-text-align-right',
					],
					'center' => [
						'title' => __( 'وسط', 'mweb' ),
						'icon' => 'eicon-text-align-center',
					],
					'left' => [
						'title' => __( 'چپ', 'mweb' ),
						'icon' => 'eicon-text-align-left',
					],
				],
				'prefix_class' => 'elementor-add-to-cart%s--align-',
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .cart .button',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .cart .button',
				'exclude' => [ 'color' ],
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .cart .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'btn_box_shadow',
				'selector' => '{{WRAPPER}} .cart .button',
			]
		);
		
		$this->add_control(
			'btn_icon_size',
			[
				'label' => __( 'اندازه آیکن', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'default' => [
					'unit' => 'px',
					'size' => 24,
				],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .single_add_to_cart_button svg' => 'width: {{SIZE}}{{UNIT}}',
				]
			]
		);
		
		$this->add_control(
			'btn_icon_space',
			[
				'label' => __( 'فاصله خارجی آیکن', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .single_add_to_cart_button .elm_a2c_i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'btn_icon_padding',
			[
				'label' => __( 'فاصله داخلی آیکن', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .single_add_to_cart_button .elm_a2c_i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'btn_icon_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .single_add_to_cart_button .elm_a2c_i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_control(
			'button_padding',
			[
				'label' => __( 'فاصله داخلی دکمه', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .cart .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		

		$this->start_controls_tabs( 'button_style_tabs' );

		$this->start_controls_tab( 'button_style_normal',
			[
				'label' => __( 'حالت نرمال', 'mweb' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cart .button' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_bg_color',
				'label' => __( 'رنگ پس زمینه عنوان', 'mweb' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .cart .button'
			]
		);

		$this->add_control(
			'button_border_color',
			[
				'label' => __( 'رنگ حاشیه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cart .button' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'btn_icon_color',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .single_add_to_cart_button .elm_a2c_i svg' => 'stroke: {{VALUE}}; fill: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'btn_icon_bgcolor',
			[
				'label' => __( 'رنگ پس زمینه آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .single_add_to_cart_button .elm_a2c_i' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'button_style_hover',
			[
				'label' => __( 'حالت هاور', 'mweb' ),
			]
		);

		$this->add_control(
			'button_text_color_hover',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cart .button:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_bg_color_hover',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cart .button:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_border_color_hover',
			[
				'label' => __( 'رنگ حاشیه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cart .button:hover' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'btn_icon_color_hover',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cart .button:hover svg' => 'stroke: {{VALUE}}; fill: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'btn_icon_bgcolor_hover',
			[
				'label' => __( 'رنگ پس زمینه آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .single_add_to_cart_button .elm_a2c_i' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_transition',
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
					'{{WRAPPER}} .cart .button, {{WRAPPER}} .cart .elm_a2c_i' => 'transition: all {{SIZE}}s',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'variation_price_typography',
				'label' => __( 'تایپوگرافی قیمت متغییر', 'mweb' ),
				'selector' => '.woocommerce {{WRAPPER}} .woocommerce-variation-price span',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_atc_quantity_style',
			[
				'label' => __( 'تعداد', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'quantity_type',
			[
				'label' => __( 'نوع', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'alignv'   => __( 'یک', 'mweb' ),
					'alignh'   => __( 'دو', 'mweb' ),
				],
				'default' => 'alignv',
				'prefix_class' => 'elementor-quantity--type-',
			]
		);

		$this->add_control(
			'spacing',
			[
				'label' => __( 'فاصله', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'body:not(.rtl) {{WRAPPER}} .quantity + .button' => 'margin-left: {{SIZE}}{{UNIT}}',
					'body.rtl {{WRAPPER}} .quantity + .button' => 'margin-right: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'quantity_typography',
				'selector' => '{{WRAPPER}} .quantity .qty',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'quantity_border',
				'selector' => '{{WRAPPER}} .quantity .qty',
				'exclude' => [ 'color' ],
			]
		);

		$this->add_control(
			'quantity_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .quantity .qty' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->start_controls_tabs( 'quantity_style_tabs' );

		$this->start_controls_tab( 'quantity_style_normal',
			[
				'label' => __( 'حالت نرمال', 'mweb' ),
			]
		);

		$this->add_control(
			'quantity_text_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .quantity .qty' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'quantity_bg_color',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .quantity .qty' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'quantity_border_color',
			[
				'label' => __( 'رنگ حاشیه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .quantity .qty' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'quantity_btn_color',
			[
				'label' => __( 'رنگ متن دکمه افزایش و کاهش', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .quantity .plus-minus .elm_qty svg' => 'stroke: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'quantity_btn_bg_color',
			[
				'label' => __( 'رنگ پس زمینه دکمه افزایش و کاهش', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .quantity .plus-minus .elm_qty' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'quantity_style_focus',
			[
				'label' => __( 'حالت انتخاب', 'mweb' ),
			]
		);

		$this->add_control(
			'quantity_text_color_focus',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .quantity .qty:focus' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'quantity_bg_color_focus',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .quantity .qty:focus' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'quantity_border_color_focus',
			[
				'label' => __( 'رنگ حاشیه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .quantity .qty:focus' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'quantity_btn_color_focus',
			[
				'label' => __( 'رنگ متن دکمه افزایش و کاهش', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .quantity .plus-minus .elm_qty:hover svg' => 'stroke: {{VALUE}}',
					'{{WRAPPER}} .quantity .plus-minus .elm_qty:focus svg' => 'stroke: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'quantity_btn_bg_color_focus',
			[
				'label' => __( 'رنگ پس زمینه دکمه افزایش و کاهش', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .quantity .plus-minus .elm_qty:hover' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .quantity .plus-minus .elm_qty:focus' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'quantity_transition',
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
					'{{WRAPPER}} .quantity .qty' => 'transition: all {{SIZE}}s',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_atc_alert_style',
			[
				'label' => __( 'اطلاع رسانی', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'btn_alert',
			[
				'label' => __( 'نمایش دکمه اطلاع رسانی', 'mweb' ),
				'description' => __( 'وقتی که ناموجود بود', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'alert_typography',
				'selector' => '{{WRAPPER}} .remindme_btn',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'alert_border',
				'selector' => '{{WRAPPER}} .remindme_btn',
				'exclude' => [ 'color' ],
			]
		);		
		
		$this->add_control(
			'alert_text_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .remindme_btn' => 'color: {{VALUE}}',
					'{{WRAPPER}} .remindme_btn svg' => 'stroke: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'alert_bg_color',
				'label' => __( 'رنگ پس زمینه عنوان', 'mweb' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .remindme_btn'
			]
		);
		
		$this->add_control(
			'alert_padding',
			[
				'label' => __( 'فاصله داخلی دکمه', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .remindme_btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'alert_margin',
			[
				'label' => __( 'فاصله خارجی دکمه', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .remindme_btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		
		$this->add_control(
			'alert_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .remindme_btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'alert_box_shadow',
				'selector' => '{{WRAPPER}} .remindme_btn',
			]
		);
		
		$this->add_responsive_control(
			'alert_alignment',
			[
				'label' => __( 'تراز', 'mweb' ),
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
					'{{WRAPPER}} .remindme_btn' => 'align-items: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_section();



	}

	
	protected function render() {
	
		global $product;

		$product = wc_get_product();

		if ( empty( $product ) ) {
			return;
		}
		
		$settings = $this->get_settings_for_display();

		
		if( mweb_get_product_stock($product) == false ){
			$show_alert = get_post_meta(get_the_ID(), '_show_notification_alert' , true);

			if( $settings['btn_alert'] == 'yes' && $show_alert == 'yes' ){
				echo '<a href="#remindme" rel="modal:open" class="remindme_btn"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#notification-bing"></use></svg>موجود شد خبرم کنید</a>';
			
				return;
			}
			return;
			
		}

		if( get_post_meta( get_the_ID(), '_upcoming', true ) == 'yes' ){
			return;
		}
		
		remove_action( 'woocommerce_after_add_to_cart_button', 'mweb_render_single_acc' );    
		remove_action( 'woocommerce_after_add_to_cart_form', 'mweb_add_preparation_time_product_summary' );    
		
		?>

		<div class="elementor-add-to-cart elementor-product-<?php echo esc_attr( wc_get_product()->get_type() ); ?>">
			<?php woocommerce_template_single_add_to_cart(); ?>
		</div>

		<?php

	}

	
	protected function content_template() {
		
	}
}





/**
 * Elementor Woocommerce Lead Time  
 * @since 1.0.0
 */
class My_Woo_Lead_Time extends Widget_Base {

	
	public function get_name() {
		return 'mweb-lead-time';
	}
	
	public function get_title() {
		return __( 'زمان آماده سازی محصول', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-product-stock';
	}

	public function get_categories() {
		return [ 'digiland_woo' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تنظیمات', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'lt_icon_hover',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .lead_time svg' => 'stroke: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'btn_icon_size',
			[
				'label' => __( 'اندازه آیکن', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'default' => [
					'unit' => 'px',
					'size' => 24,
				],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .lead_time svg' => 'width: {{SIZE}}{{UNIT}}',
				]
			]
		);

		$this->add_control(
			'lt_text_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .lead_time' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'lt_text_typography',
				'label' => __( 'تایپوگرافی', 'mweb' ),
				'selector' => '{{WRAPPER}} .lead_time',
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'lt_bg_color',
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .lead_time'
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'lt_border',
				'selector' => '{{WRAPPER}} .lead_time',
			]
		);
		
		$this->add_control(
			'lt_padding',
			[
				'label' => __( 'فاصله داخلی', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .lead_time' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'lt_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .lead_time' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		
		$this->end_controls_section();
		


	}

	
	protected function render() {
	
		global $product;
		$product = wc_get_product();

		if ( empty( $product ) ) {
			return;
		}

		mweb_add_preparation_time_product_summary();

	}

	
	protected function content_template() {
		
	}
}





/**
 * Elementor Woocommerce Add To Wishlist
 * @since 1.0.0
 */
class My_Woo_AddTo_Wishlist extends Widget_Base {

	
	public function get_name() {
		return 'mweb-addto-wishlist';
	}
	
	public function get_title() {
		return __( 'افزودن به علاقه مندی', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-favorite';
	}

	public function get_categories() {
		return [ 'digiland_woo' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تنظیمات', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'icon_type',
			[
				'label' => __( 'نوع آیکن', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'bookmark' => __( 'یک', 'mweb' ),
					'heart' => __( 'دو', 'mweb' ),
				],
				'default' => 'bookmark',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'wishlist_btn_typography',
				'selector' => '.woocommerce {{WRAPPER}} .single_add_to_wishlist',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'wishlist_btn_border',
				'selector' => '.woocommerce {{WRAPPER}} .single_add_to_wishlist',
				'exclude' => [ 'color' ],
			]
		);

		$this->add_control(
			'wishlist_btn_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .single_add_to_wishlist' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'wishlist_padding',
			[
				'label' => __( 'فاصله داخلی', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .single_add_to_wishlist' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'wishlist_btn_onlyIcon',
			[
				'label' => __( 'نمایش فقط آیکن', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'prefix_class' => 'elementor-single_wishlist_onlyicon_',
			]
		);
		
		$this->add_control(
			'wishlis_icon_size',
			[
				'label' => __( 'اندازه آیکن', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'default' => [
					'unit' => 'px',
					'size' => 24,
				],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .single_add_to_wishlist svg' => 'width: {{SIZE}}{{UNIT}}',
				]
			]
		);


		$this->start_controls_tabs( 'wishlist_btn_style_tabs' );

		$this->start_controls_tab( 'wishlist_btn_style_normal',
			[
				'label' => __( 'حالت نرمال', 'mweb' ),
			]
		);

		$this->add_control(
			'wishlist_btn_text_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .single_add_to_wishlist' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'wishlist_btn_bg_color',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .single_add_to_wishlist' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'wishlist_btn_border_color',
			[
				'label' => __( 'رنگ حاشیه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .single_add_to_wishlist' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'wishlist_btn_icon_color',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .single_add_to_wishlist svg' => 'stroke: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'wishlist_btn_style_focus',
			[
				'label' => __( 'حالت انتخاب', 'mweb' ),
			]
		);
		
		$this->add_control(
			'wishlist_btn_text_color_hover',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .add_to_wishlist_wrap:hover .single_add_to_wishlist' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'wishlist_btn_bg_color_hover',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .add_to_wishlist_wrap:hover .single_add_to_wishlist' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'wishlist_btn_border_color_hover',
			[
				'label' => __( 'رنگ حاشیه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .add_to_wishlist_wrap:hover .single_add_to_wishlist' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'wishlist_btn_icon_color_hover',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .add_to_wishlist_wrap:hover .single_add_to_wishlist svg' => 'stroke: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'quantity_transition',
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
					'.woocommerce {{WRAPPER}} .single_add_to_wishlist' => 'transition: all {{SIZE}}s',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		
		
		$this->end_controls_section();
		


	}

	
	protected function render() {
	
		global $product;
		$product = wc_get_product();

		if ( empty( $product ) ) {
			return;
		}
		
		$settings = $this->get_settings_for_display();
		$flag = $settings['wishlist_btn_onlyIcon'] == 'yes' ? false : true;

		\mweb_wishlist::mweb_single_add_wishlist(get_the_ID(), 'product', $flag, false, $settings['icon_type']);

	}

	
	protected function content_template() {
		
	}
}






/**
 * Elementor Woocommerce Compare Button
 * @since 1.0.0
 */
class My_Woo_Compare_Button extends Widget_Base {

	
	public function get_name() {
		return 'mweb-compare-btn';
	}
	
	public function get_title() {
		return __( 'دکمه مقایسه', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-products';
	}

	public function get_categories() {
		return [ 'digiland_woo' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تنظیمات', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'compare_btn_typography',
				'selector' => '.woocommerce {{WRAPPER}} .compare',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'compare_btn_border',
				'selector' => '.woocommerce {{WRAPPER}} .compare',
				'exclude' => [ 'color' ],
			]
		);

		$this->add_control(
			'compare_btn_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .compare' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'compare_btn_onlyIcon',
			[
				'label' => __( 'نمایش فقط آیکن', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'prefix_class' => 'elementor-single_compare_onlyicon_',
			]
		);
		
		$this->add_control(
			'compare_padding',
			[
				'label' => __( 'فاصله داخلی', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .single_compare' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'compare_icon_size',
			[
				'label' => __( 'اندازه آیکن', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'default' => [
					'unit' => 'px',
					'size' => 24,
				],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .single_compare svg' => 'width: {{SIZE}}{{UNIT}}',
				]
			]
		);

		$this->start_controls_tabs( 'compare_btn_style_tabs' );

		$this->start_controls_tab( 'compare_btn_style_normal',
			[
				'label' => __( 'حالت نرمال', 'mweb' ),
			]
		);

		$this->add_control(
			'compare_btn_text_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .compare' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'compare_btn_bg_color',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .compare' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'compare_btn_border_color',
			[
				'label' => __( 'رنگ حاشیه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .compare' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'compare_btn_icon_color',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .compare svg' => 'stroke: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'compare_btn_style_focus',
			[
				'label' => __( 'حالت انتخاب', 'mweb' ),
			]
		);
		
		$this->add_control(
			'compare_btn_text_color_hover',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .compare:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'compare_btn_bg_color_hover',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .compare:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'compare_btn_border_color_hover',
			[
				'label' => __( 'رنگ حاشیه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .compare:hover' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'compare_btn_icon_color_hover',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .compare:hover svg' => 'stroke: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'quantity_transition',
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
					'.woocommerce {{WRAPPER}} .compare' => 'transition: all {{SIZE}}s',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		
		
		$this->end_controls_section();
		


	}

	
	protected function render() {
	
		global $product;
		$product = wc_get_product();

		if ( empty( $product ) ) {
			return;
		}
		
		$settings = $this->get_settings_for_display();
		$flag = $settings['compare_btn_onlyIcon'] == 'yes' ? true : false;

		if(function_exists('mweb_add_compare_button')) {
			mweb_add_compare_button_single($flag);
		}else{
			echo mweb_error('قابلیت مقایسه غیرفعال می باشد');
		}

	}

	
	protected function content_template() {
		
	}
}






/**
 * Elementor Woocommerce Price Survey
 * @since 1.0.0
 */
class My_Woo_Price_Survey extends Widget_Base {

	
	public function get_name() {
		return 'mweb-price-survey';
	}
	
	public function get_title() {
		return __( 'پرسش قیمت رقابتی', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-price-list';
	}

	public function get_categories() {
		return [ 'digiland_woo' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تنظیمات', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		

		$this->add_control(
			'ps_text_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .price_survey_question' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ps_text_typography',
				'label' => __( 'تایپوگرافی', 'mweb' ),
				'selector' => '{{WRAPPER}} .price_survey_question',
			]
		);
		
		$this->add_control(
			'ps_bg_color',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .price_survey_question' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ps_border',
				'selector' => '{{WRAPPER}} .price_survey_question',
			]
		);

		$this->add_control(
			'ps_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .price_survey_question' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'ps_padding',
			[
				'label' => __( 'فاصله داخلی', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .price_survey_question' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		
		$this->end_controls_section();
		


	}

	
	protected function render() {
	
		global $product;
		$product = wc_get_product();

		if ( empty( $product ) ) {
			return;
		}

		\mweb_pricing_survey_question::init()->mweb_frontend_setup();

	}

	
	protected function content_template() {
		
	}
}




/**
 * Elementor Woocommerce Report Product
 * @since 1.0.0
 */
class My_Woo_Report_Product extends Widget_Base {

	
	public function get_name() {
		return 'mweb-report-product';
	}
	
	public function get_title() {
		return __( 'گزارش نادرستی مشخصات', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-alert';
	}

	public function get_categories() {
		return [ 'digiland_woo' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تنظیمات', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		

		$this->add_control(
			'btn_text_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn_report_product' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_text_typography',
				'label' => __( 'تایپوگرافی', 'mweb' ),
				'selector' => '{{WRAPPER}} .btn_report_product',
			]
		);
		
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn_report_product svg' => 'stroke: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'icon_size',
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
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .btn_report_product svg' => 'width: {{SIZE}}{{UNIT}};',
				]
			]
		);
		
		$this->add_responsive_control(
			'el_icon_space',
			[
				'label' => __( 'فاصله آیکن', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .btn_report_product svg' => 'margin-left: {{SIZE}}{{UNIT}}',
				],
			]
		);
		
		
		
		$this->end_controls_section();
		


	}

	
	protected function render() {
	
		global $product;
		$product = wc_get_product();

		if ( empty( $product ) ) {
			return;
		}

		\mweb_report_product::init()->mweb_frontend_setup();

	}

	
	protected function content_template() {
		
	}
}






/**
 * Elementor Woocommerce Product Guide
 * @since 1.0.0
 */
class My_Woo_Product_Guide extends Widget_Base {

	
	public function get_name() {
		return 'mweb-product_guide';
	}
	
	public function get_title() {
		return __( 'راهنمای انتخاب محصول', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-info-circle-o';
	}

	public function get_categories() {
		return [ 'digiland_woo' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تنظیمات', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elm_product_guide' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'label' => __( 'تایپوگرافی', 'mweb' ),
				'selector' => '{{WRAPPER}} .elm_product_guide',
			]
		);
		
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elm_product_guide svg' => 'stroke: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'icon_size',
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
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .elm_product_guide svg' => 'width: {{SIZE}}{{UNIT}};',
				]
			]
		);
		
		$this->add_control(
			'icon_name',
			[
				'label' => __( 'آیکن', 'mweb' ),
				'type' => 'iconpicker',
			]
		);
		
		$this->add_responsive_control(
			'el_icon_space',
			[
				'label' => __( 'فاصله آیکن', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elm_product_guide svg' => 'margin-left: {{SIZE}}{{UNIT}}',
				],
			]
		);
		

		$this->end_controls_section();


	}

	
	protected function render() {
	
		global $product;
		$product = wc_get_product();

		if ( empty( $product ) ) {
			return;
		}
		
		$settings = $this->get_settings_for_display();
		
		$icon_name = !empty($settings['icon_name']) ? $settings['icon_name'] : '';
		$product_guide = get_post_meta( get_the_ID(), '_product_guide', true );
		if(!empty($product_guide)){
			$post_product_guide = get_post( (int) $product_guide ); 
			if(!empty($post_product_guide) && !is_wp_error( $post_product_guide )){
				echo '<a class="product_guide elm_product_guide" href="#product_guide_wrap" rel="modal:open">'.$icon_name . $post_product_guide->post_title.'</a>';
				add_action('wp_footer', function() use ( $post_product_guide ) { mweb_init_product_guide( $post_product_guide ); } );
			}
		}

	}

	
	protected function content_template() {
		
	}
}





/**
 * Elementor Woocommerce Custom Field
 * @since 1.0.0
 */
class My_Woo_Custom_Field extends Widget_Base {

	
	public function get_name() {
		return 'mweb-custom-field';
	}
	
	public function get_title() {
		return __( 'زمینه دلخواه محصول / مرجوعی', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-text-field';
	}

	public function get_categories() {
		return [ 'digiland_woo' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تنظیمات', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		

		$this->add_control(
			'cf_text_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .custom_note_summary' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'cf_text_typography',
				'label' => __( 'تایپوگرافی', 'mweb' ),
				'selector' => '{{WRAPPER}} .custom_note_summary',
			]
		);
		
		$this->add_control(
			'cf_bg_color',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .custom_note_summary' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'cf_border',
				'selector' => '{{WRAPPER}} .custom_note_summary',
			]
		);

		$this->add_control(
			'cf_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .custom_note_summary' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'cf_padding',
			[
				'label' => __( 'فاصله داخلی', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .custom_note_summary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'hr_icon',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		
		$this->add_control(
			'cf_picon',
			[
				'label' => __( 'آیکن', 'mweb' ),
				'type' => 'iconpicker',
			]
		);
		
		$this->add_control(
			'cf_icon_color',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .custom_note_summary svg' => 'stroke: {{VALUE}}; fill: {{VALUE}}; ',
				],
			]
		);
		
		$this->add_control(
			'cf_icon_size',
			[
				'label' => __( 'اندازه آیکن', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .custom_note_summary svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'cf_icon_space',
			[
				'label' => __( 'فاصله آیکن', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .custom_note_summary svg' => 'margin-left: {{SIZE}}{{UNIT}}',
				],
			]
		);
		
		$this->add_control(
			'hr_field',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		
		$this->add_control(
			'cf_field_name',
			[
				'label' => __( 'نام زمینه دلخواه', 'mweb' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '_custom_product_note', 'mweb' ),
			]
		);
		
		$this->add_control(
			'cf_field_checkbox',
			[
				'label' => __( 'فیلد چک باکس', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			]
		);
		
		$this->add_control(
			'cf_field_pattern',
			[
				'label' => __( 'پترن درج زمینه دلخواه', 'mweb' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'محتوای زمینه : [value]', 'mweb' ),
				'description' => __( 'برای درج مقدار زمینه دلخواه از [value] استفاده کنید', 'mweb' ),
			]
		);
		
		$this->add_control(
			'hr_return',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		
		$this->add_control(
			'return_enable',
			[
				'label' => __( 'نمایش مرجوعی', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'description' => __( 'نیازی به تنظیم زمینه دلخواه نیست', 'mweb' ),
			]
		);
		
		$this->end_controls_section();
		


	}

	
	protected function render() {
	
		global $product;
		$product = wc_get_product();

		if ( empty( $product ) ) {
			return;
		}
		$el_content = '';
		$el_icon = '';
		$settings = $this->get_settings_for_display();
		if( $settings['return_enable'] != 'yes' ){
			$custom_filed = get_post_meta( get_the_ID(), $settings['cf_field_name'], true );
			if(!empty($custom_filed)){
				if($settings['cf_field_checkbox'] == 'yes' && $custom_filed != 'yes'){
					return false;
				}
				$el_icon = !empty($settings['cf_picon']) ? $settings['cf_picon'] : '';
				
				$el_content = !empty($settings['cf_field_pattern']) ? str_replace('[value]', $custom_filed, $settings['cf_field_pattern']) : $custom_filed;
				if( $settings['cf_field_name'] == '_custom_product_note'){
					$el_content = wpautop(htmlspecialchars_decode($el_content));
				}
				
			}
		} else {
			
			$el_icon = !empty($settings['cf_picon']) ? $settings['cf_picon'] : '';
			$mweb_return_cat_id = \mweb_theme_util::get_theme_option('mweb_return_cat_id');
			$mweb_return_cat_text = \mweb_theme_util::get_theme_option('mweb_return_cat_text');
			$last_cat = mweb_get_product_last_level_of_category($product->get_id());
			if( $last_cat && !empty($mweb_return_cat_id) && is_array($mweb_return_cat_id) ){
				$index = array_search($last_cat->term_id, $mweb_return_cat_id);
				if ($index !== false) {
					$el_content = $mweb_return_cat_text[$index];
				} 
			}
		}
		
		if( !empty($el_content) ){
			echo '<div class="custom_note_summary">'.$el_icon.$el_content.'</div>';
		}


	}

	
	protected function content_template() {
		?>
		<div class="custom_note_summary">{{{ settings.cf_icon_name }}}{{{ settings.cf_field_pattern }}}</div>
		<?php
	}
}






/**
 * Elementor Woocommerce Modified Date
 * @since 1.0.0
 */
class My_Woo_Modified_Date extends Widget_Base {

	
	public function get_name() {
		return 'mweb-modified-date';
	}
	
	public function get_title() {
		return __( 'تاریخ بروزرسانی', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-tools';
	}

	public function get_categories() {
		return [ 'digiland_woo' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تنظیمات', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'md_title',
			[
				'label' => __( 'عنوان', 'mweb' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'تاریخ بروزرسانی : ', 'mweb' ),
			]
		);

		$this->add_control(
			'md_text_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .modified_date' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'md_span_color',
			[
				'label' => __( 'رنگ تاریخ', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .modified_date span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'md_text_typography',
				'label' => __( 'تایپوگرافی', 'mweb' ),
				'selector' => '{{WRAPPER}} .modified_date',
			]
		);

		
		$this->add_control(
			'hr_icon',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
				
		$this->add_control(
			'md_icon_color',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .modified_date svg' => 'stroek: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'md_icon_size',
			[
				'label' => __( 'اندازه آیکن', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .modified_date svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'st_icon_space',
			[
				'label' => __( 'فاصله آیکن', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'max' => 500,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .modified_date svg' => 'margin-left: {{SIZE}}{{UNIT}}',
				],
			]
		);

		
		$this->end_controls_section();


	}

	
	protected function render() {
	
		global $product;
		$product = wc_get_product();

		if ( empty( $product ) ) {
			return;
		}
		
		$settings = $this->get_settings_for_display();
		
		$last_modified = get_post_meta( get_the_ID(), '_show_last_modified', true );
		$last_modified_date = get_post_meta( get_the_ID(), '_custom_last_modified', true );
		
		
		if($last_modified == 'yes' && empty($last_modified_date)){
			echo '<div class="fake_note modified_date"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#calendar-2"></use></svg> '.apply_filters('mweb_modified_date_text', $settings['md_title']).' <span>'.get_the_modified_date( get_option( 'date_format' ) ).'</span></div>';
		}elseif(!empty($last_modified_date)){
			echo '<div class="fake_note modified_date"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#calendar-2"></use></svg> '.apply_filters('mweb_modified_date_text', $settings['md_title']).' <span>'.date_i18n( get_option( 'date_format' ), strtotime( $last_modified_date ) ).'</span></div>';
		}

	}

	
	protected function content_template() {
		?>
		<div class="fake_note modified_date">{{{ settings.md_title }}}<span>مثال : 2 بهمن 1399</span></div>
		<?php
	}
}






/**
 * Elementor Woocommerce Warranty
 * @since 1.0.0
 */
class My_Woo_Warranty extends Widget_Base {

	
	public function get_name() {
		return 'mweb-warranty-product';
	}
	
	public function get_title() {
		return __( 'گارانتی محصول', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-upgrade-crown';
	}

	public function get_categories() {
		return [ 'digiland_woo' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تنظیمات', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'md_text_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .el_warranties' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'md_text_typography',
				'label' => __( 'تایپوگرافی', 'mweb' ),
				'selector' => '{{WRAPPER}} .el_warranties span',
			]
		);

		
		$this->add_control(
			'hr_icon',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
				
		$this->add_control(
			'md_icon_color',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .el_warranties svg' => 'stroek: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'md_icon_size',
			[
				'label' => __( 'اندازه آیکن', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .el_warranties svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'st_icon_space',
			[
				'label' => __( 'فاصله آیکن', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'max' => 500,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .el_warranties svg' => 'margin-left: {{SIZE}}{{UNIT}}',
				],
			]
		);

		
		$this->end_controls_section();


	}

	
	protected function render() {
	
		global $product;
		$product = wc_get_product();

		if ( empty( $product ) ) {
			return;
		}
		
		echo do_shortcode('[warranty_product]');

	}

	

}





/**
 * Elementor Woocommerce Stock
 * @since 1.0.0
 */
class My_Woo_Stock extends Widget_Base {

	
	public function get_name() {
		return 'mweb-product-stock';
	}
	
	public function get_title() {
		return __( 'موجودی', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-product-stock';
	}

	public function get_categories() {
		return [ 'digiland_woo' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تنظیمات', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'stock_title',
			[
				'label' => __( 'عنوان موجودی', 'mweb' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'موجود است', 'mweb' ),
			]
		);
		
		$this->add_control(
			'outofstock_title',
			[
				'label' => __( 'عنوان ناموجود', 'mweb' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'موجود نیست', 'mweb' ),
			]
		);
		

		$this->add_control(
			'st_text_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product_stock' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'st_text_typography',
				'label' => __( 'تایپوگرافی', 'mweb' ),
				'selector' => '{{WRAPPER}} .product_stock',
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'st_bg_color',
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .product_stock'
			]
		);

		$this->add_control(
			'st_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .product_stock' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'st_padding',
			[
				'label' => __( 'فاصله داخلی', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .product_stock' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'st_icon_checkbox',
			[
				'label' => __( 'نمایش آیکن', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			]
		);
		
		$this->add_control(
			'st_icon_size',
			[
				'label' => __( 'اندازه آیکن', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
					'em' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .product_stock svg' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 'st_icon_checkbox' => ['yes'] ],
			]
		);
		
		$this->add_control(
			'st_icon_color',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product_stock svg' => 'stroke: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'st_icon_space',
			[
				'label' => __( 'فاصله خارجی ایکن', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .product_stock svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 'st_icon_checkbox' => ['yes'] ],
			]
		);
		
		
		$this->add_control(
			'st_only_out_of_stock',
			[
				'label' => __( 'فقط نمایش هنگام ناموجود بودن', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			]
		);
		
		$this->add_responsive_control(
			'stock_alignment',
			[
				'label' => __( 'تراز', 'mweb' ),
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
					'{{WRAPPER}} .product_stock' => 'align-items: {{VALUE}}',
				],
			]
		);
		
		
		$this->add_control(
			'stock_halign_element',
			[
				'label' => __( 'تراز عمودی المان ها', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'inline-block',
				'options' => [
					'column' => __( 'عمودی', 'mweb' ),
					'row' => __( 'افقی', 'mweb' ),
				],
				'selectors' => [
					'{{WRAPPER}} .product_stock' => 'display: flex; flex-direction: {{VALUE}}',
				],
			]
		);
		
		
		$this->end_controls_section();
		


	}

	
	protected function render() {
	
		global $product;
		$product = wc_get_product();

		if ( empty( $product ) ) {
			return;
		}
		
		$settings = $this->get_settings_for_display();
		
		$icon_one = $icon_two = $icon_three = '';
		
		if( $settings['st_icon_checkbox'] == 'yes' ){
			$icon_one = '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#calendar"></use></svg>';
			$icon_two = '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#close-square"></use></svg>';
			$icon_three = '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#tick-square"></use></svg>';
		}
		
		if ( get_post_meta( get_the_ID(), '_upcoming', true ) == 'yes' ) {
			echo '<div class="product_stock">'.$icon_one.'<span>عرضه به زودی</span></div>';
		}else{
			if ( $product->is_type( 'variable' ) ) {

				$temp_stock = false;
				foreach ( $product->get_children() as $child_id ) {
					$variation = wc_get_product( $child_id );
					if($variation->is_in_stock() == true ){
						$temp_stock = true;
						break;
					}
					
				}
				if ( $temp_stock == false ){
					echo '<div class="product_stock no_avl">'.$icon_two.'<span>'.$settings['outofstock_title'].'</span></div>';
				}else {
					if($settings['st_only_out_of_stock'] != 'yes')
					echo '<div class="product_stock">'.$icon_three.'<span>'.$settings['stock_title'].'</span></div>';
				}
			}else{
				if ( $product->is_in_stock() ) {
					if( $settings['st_only_out_of_stock'] != 'yes' )
						echo '<div class="product_stock">'.$icon_three.'<span>'.$settings['stock_title'].'</span></div>';
				}else {
					echo '<div class="product_stock no_avl">'.$icon_two.'<span>'.$settings['outofstock_title'].'</span></div>';
				}
			}
		}
	

	}

	
	protected function content_template() {
		?>
		<div class="product_stock"><span>موجود در انبار</span></div>
		<?php
	}
}





/**
 * Elementor Woocommerce Product Recommend
 * @since 1.0.0
 */
class My_Woo_Recommend extends Widget_Base {

	
	public function get_name() {
		return 'mweb-product-recommend';
	}
	
	public function get_title() {
		return __( 'تعداد پیشنهاد خرید', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-product-info';
	}

	public function get_categories() {
		return [ 'digiland_woo' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تنظیمات', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'pr_text_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .el_recommended' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'pr_text_typography',
				'label' => __( 'تایپوگرافی', 'mweb' ),
				'selector' => '{{WRAPPER}} .el_recommended',
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'pr_bg_color',
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .el_recommended'
			]
		);

		$this->add_control(
			'pr_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .el_recommended' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'pr_padding',
			[
				'label' => __( 'فاصله داخلی', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .el_recommended' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'pr_icon_color',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .el_recommended svg' => 'stroke: {{VALUE}}',
				],
			]
		);
	
		$this->add_control(
			'pr_icon_size',
			[
				'label' => __( 'اندازه آیکن', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .el_recommended svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'pr_icon_space',
			[
				'label' => __( 'فاصله آیکن', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .el_recommended svg' => 'margin-left: {{SIZE}}{{UNIT}}',
				],
			]
		);
		
		$this->add_control(
			'pr_field_pattern',
			[
				'label' => __( 'پترن نوشته', 'mweb' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'پیشنهاد شده توسط بیش از [value] نفر از خریداران', 'mweb' ),
				'description' => __( 'برای درج تعداد پیشنهاد از [value] استفاده کنید', 'mweb' ),
			]
		);
		
		$this->add_control(
			'pr_show_condition',
			[
				'label' => __( 'شرط نمایش اگر بزرگتر n بود', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 1000,
				'step' => 1,
				'default' => 2,
			]
		);
		
		
		$this->end_controls_section();
		


	}

	
	protected function render() {
	
		global $product;
		$product = wc_get_product();

		if ( empty( $product ) ) {
			return;
		}
		
		$settings = $this->get_settings_for_display();
		
		$recommend_count = \mweb_wc_extra_comment::mweb_get_recommend_status_count();
		
		if($recommend_count > $settings['pr_show_condition'])
			echo '<div class="el_recommended"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#medal"></use></svg>'.str_replace('[value]', '<span>'.$recommend_count.'</span>', $settings['pr_field_pattern']).'</div>';
	

	}

	
	protected function content_template() {
		?>
		<div class="el_recommended">پیشنهاد شده توسط بیش از <span>{{{ settings.pr_show_condition }}}</span> نفر از خریداران</div>
		<?php
	}
}




/**
 * Elementor Woocommerce Services
 * @since 1.0.0
 */
class My_Woo_Services extends Widget_Base {

	
	public function get_name() {
		return 'mweb-shop-services';
	}
	
	public function get_title() {
		return __( 'خدمات', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-plug';
	}

	public function get_categories() {
		return [ 'digiland_woo' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تنظیمات', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'item_title',
			[
				'label' => __( 'عنوان', 'mweb' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'بسته بندی زیبا', 'mweb' ),
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .services_item' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'label' => __( 'تایپوگرافی', 'mweb' ),
				'selector' => '{{WRAPPER}} .services_item',
			]
		);
		
		$this->add_control(
			'bg_color',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .services_item' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'item_border',
				'selector' => '{{WRAPPER}} .services_item',
			]
		);

		$this->add_control(
			'item_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .services_item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'item_padding',
			[
				'label' => __( 'فاصله داخلی', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .services_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'hr_icon',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		
		
		$this->add_control(
			'item_picon',
			[
				'label' => __( 'آیکن', 'mweb' ),
				'type' => 'iconpicker',
			]
		);
		
		$this->add_control(
			'item_icon_size',
			[
				'label' => __( 'اندازه آیکن', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 24,
				],
				'selectors' => [
					'{{WRAPPER}} .services_item svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
				
		$this->add_control(
			'item_icon_color',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .services_item svg' => 'stroke: {{VALUE}}; fill: {{VALUE}}',
				],
			]
		);
		

		$this->add_responsive_control(
			'item_icon_space',
			[
				'label' => __( 'فاصله آیکن', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .services_item svg' => 'margin-left: {{SIZE}}{{UNIT}}',
				],
			]
		);
		
		
		$this->end_controls_section();
		


	}

	
	protected function render() {
	
		$settings = $this->get_settings_for_display();
		
		$el_icon = !empty($settings['item_picon']) ? $settings['item_picon'] : '';		
		echo '<div class="services_item">'.$el_icon.$settings['item_title'].'</div>';

	}

	
	protected function content_template() {
		?>
		<div class="services_item">{{{ settings.item_picon }}}{{{ settings.item_title }}}</div>
		<?php
	}
}




/**
 * Elementor Woocommerce Overview Product
 * @since 1.0.0
 */
class My_Woo_Overview extends Widget_Base {

	
	public function get_name() {
		return 'mweb-overview';
	}
	
	public function get_title() {
		return __( 'بررسی محصول', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-product-info';
	}

	public function get_categories() {
		return [ 'digiland_woo' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تنظیمات', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'view',
			[
				'label' => __( 'نمایش محتوا', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'overview_product',
				'options' => [
					'positive_points' => __( 'نقاط مثبت', 'mweb' ),
					'negative_points' => __( 'نقاط منفی', 'mweb' ),
					'overview_product' => __( 'بررسی اجمالی', 'mweb' ),
				],
			]
		);
		
		$this->add_control(
			'title',
			[
				'label' => __( 'عنوان', 'mweb' ),
				'type' => Controls_Manager::TEXT,
				'condition' => [ 'view' => ['positive_points', 'negative_points'] ],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => __( 'تایپوگرافی عنوان', 'mweb' ),
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .woocommerce_review_point .review_title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'رنگ عنوان', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woocommerce_review_point .review_title' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => __( 'تایپوگرافی متن', 'mweb' ),
				'name' => 'text_typography',
				'selector' => '{{WRAPPER}} .woocommerce_review_point ul li, {{WRAPPER}} .woocommerce_review_progress .progress-label',
			]
		);
		
		$this->add_control(
			'text_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woocommerce_review_point' => 'color: {{VALUE}}',
					'{{WRAPPER}} .woocommerce_review_progress .progress-label' => 'color: {{VALUE}}',
					'{{WRAPPER}} .crp_label, {{WRAPPER}} .crp_number' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'p_circular',
			[
				'label' => __( 'امتیاز به صورت دایره', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'condition' => [ 'view' => ['overview_product'] ]
			]
		);
		
		$this->add_control(
			'p_type',
			[
				'label' => __( 'نوع', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'v',
				'options' => [
					'v' => __( 'عمودی', 'mweb' ),
					'h' => __( 'افقی', 'mweb' ),
				],
				'condition' => [ 'p_circular' => ['yes'] ],
			]
		);
	
		$this->end_controls_section();
		


	}

	
	protected function render() {
			
		$settings = $this->get_settings_for_display();
		switch($settings['view']){
			case 'positive_points':
				echo do_shortcode( '[positive_points title="'.$settings['title'].'"]' );
				break;
			case 'negative_points':
				echo do_shortcode( '[negative_points title="'.$settings['title'].'"]' );
				break;
			case 'overview_product':
				echo do_shortcode( '[overview_product circular="'.$settings['p_circular'].'" dir="'.$settings['p_type'].'"]' );
				break;			
		}
	
	}

	
	protected function content_template() {
		
	}
}




/**
 * Elementor Woocommerce CountDown
 * @since 1.0.0
 */
class My_Woo_CountDown extends Widget_Base {

	
	public function get_name() {
		return 'mweb-countdown';
	}
	
	public function get_title() {
		return __( 'شمارشگر فروش ویژه', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-countdown';
	}

	public function get_categories() {
		return [ 'digiland_woo' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تنظیمات نوشته', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'main_title',
			[
				'label' => __( 'عنوان', 'mweb' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'پیشنهاد شگفت انگیز', 'mweb' ),
			]
		);
		
		$this->add_control(
			'main_title_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .deal_title .deal_title_main' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'main_title_typography',
				'label' => __( 'تایپوگرافی', 'mweb' ),
				'selector' => '{{WRAPPER}} .deal_title .deal_title_main',
			]
		);
		
		
		$this->add_control(
			'hr_title',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		
		$this->add_control(
			'sub_title',
			[
				'label' => __( 'زیر عنوان', 'mweb' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'فرصت باقی مانده', 'mweb' ),
			]
		);

		$this->add_control(
			'sub_title_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .deal_title .deal_title_sub' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sub_title_typography',
				'label' => __( 'تایپوگرافی', 'mweb' ),
				'selector' => '{{WRAPPER}} .deal_title .deal_title_sub',
			]
		);
		
		$this->add_responsive_control(
			'sub_title_space',
			[
				'label' => __( 'فاصله زیر عنوان', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .deal_title .deal_title_sub' => 'margin-right: {{SIZE}}{{UNIT}}',
				],
				'condition' => [ 'cd_row_title!' => ['yes'] ],
			]
		);
		
		$this->add_control(
			'hr_box',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		
		$this->add_control(
			'cd_halign_element',
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
					'{{WRAPPER}} .woo_single_countdown' => 'justify-content: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'cd_row_title',
			[
				'label' => __( 'عناوین به صورت سطری', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'prefix_class' => 'elementor-product-countdown-row-',
			]
		);
		
		$this->add_control(
			'cd_valign_title',
			[
				'label' => __( 'جایگاه عمودی عناوین', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'baseline',
				'options' => [
					'baseline' => __( 'بالا', 'mweb' ),
					'center' => __( 'وسط', 'mweb' ),
					'flex-end' => __( 'پایین', 'mweb' ),
				],
				'selectors' => [
					'{{WRAPPER}} .woo_single_countdown .deal_title' => 'align-self: {{VALUE}}',
				],
				'prefix_class' => 'elementor-woo-countdown--view-',
			]
		);
		
		$this->add_control(
			'cd_bg_color',
			[
				'label' => __( 'رنگ پس زمینه باکس', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .woo_single_countdown' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'cd_border_radius',
			[
				'label' => __( 'گوشه های مدور باکس', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .woo_single_countdown' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'cd_padding',
			[
				'label' => __( 'فاصله داخلی باکس', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .woo_single_countdown' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'st_icon_space',
			[
				'label' => __( 'فاصله از شمارنده', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'max' => 500,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .woo_single_countdown .deal_title' => 'margin-left: {{SIZE}}{{UNIT}}',
				],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_timer',
			[
				'label' => __( 'تنظیمات شمارنده', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		
		$this->add_control(
			'cd_item_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .home-dailydeal .product-date>div span.no' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'cd_item_bg_color',
			[
				'label' => __( 'پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .home-dailydeal .product-date>div span.no' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'cd_item_size',
			[
				'label' => __( 'اندازه شمارشگر', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 40,
				],
				'selectors' => [
					'{{WRAPPER}} .home-dailydeal .product-date>div span.no' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'cd_item_font_size',
			[
				'label' => __( 'اندازه متن شمارشگر', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .home-dailydeal .product-date>div span.no' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'cd_item_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .home-dailydeal .product-date>div span.no' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'cd_item_sub_color',
			[
				'label' => __( 'رنگ زیر متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .home-dailydeal .product-date>div span.text' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'hr_timer_active',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		
		$this->add_control(
			'cd_item_active_bg_color',
			[
				'label' => __( 'رنگ شمارنده فعال', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .home-dailydeal .product-date>div.second span.no' => 'background-color: {{VALUE}}',
				],
			]
		);
		
	
		
		
		$this->end_controls_section();
		


	}

	
protected function render() {
    global $product;
    $product = wc_get_product();

    if (empty($product)) {
        return;
    }

    $settings = $this->get_settings_for_display();
    $sale_end_date = $product->get_date_on_sale_to(); // گرفتن تاریخ پایان فروش ویژه

    if ($sale_end_date) {
        // فرمت کردن تاریخ به شکل دلخواه
        $formatted_date = $sale_end_date->date('Y/m/d H:i:s'); 

        ?>
        <div class="home-dailydeal woo_single_countdown">
            <div class="deal_title">
                <?php if (!empty($settings['main_title'])) { ?>
                    <span class="deal_title_main"><?= esc_html($settings['main_title']); ?></span>
                <?php } ?>
                <?php if (!empty($settings['sub_title'])) { ?>
                    <span class="deal_title_sub"><?= esc_html($settings['sub_title']); ?></span>
                <?php } ?>
            </div>
            <div class="product-date" data-date="<?php echo esc_attr($formatted_date); ?>"></div>
        </div>
        <?php
    }
}




	
	protected function content_template() {
		?>
		<div class="home-dailydeal woo_single_countdown">  
			  <div class="deal_title">
				<span class="deal_title_main">{{{ settings.main_title }}}</span>
				<span class="deal_title_sub">{{{ settings.sub_title }}}</span>
			  </div>
			  <div class="product-date" data-date="2024-02-12 20:29:59"><div class="day"><span class="no">21</span><span class="text">روز</span></div><div class="hours"><span class="no">03</span><span class="text">ساعت</span></div><div class="min"><span class="no">53</span><span class="text">دقیقه</span></div><div class="second"><span class="no">36</span><span class="text">ثانیه</span></div></div>
			</div>
		<?php
	}
}







/**
 * Elementor Woocommerce Images
 * @since 1.0.0
 */
class My_Woo_Images extends Widget_Base {

	
	public function get_name() {
		return 'mweb-product-images';
	}
	
	public function get_title() {
		return __( 'تصاویر محصول', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-product-images';
	}

	public function get_categories() {
		return [ 'digiland_woo' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تنظیمات', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'st_type',
			[
				'label' => __( 'نوع نمایش', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'one',
				'options' => [
					'one' => __( 'یک', 'mweb' ),
					'two' => __( 'دو', 'mweb' ),
				]
			]
		);
		
		$this->add_control(
			'has_video',
			[
				'label' => __( 'نمایش ویدیو در اسلایدر', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __( 'بله', 'mweb' ),
					'no' => __( 'خیر', 'mweb' ),
				],
				'condition' => [ 'st_type' => ['two'] ],
			]
		);
		
		$this->add_control(
			'hide_thumbnail',
			[
				'label' => __( 'مخفی کردن تصاویر کوچک', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بلی', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [ 'st_type' => ['one'] ],
			]
		);
		
		$this->add_control(
			'view',
			[
				'label' => __( 'جهت نمایش', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => [
					'horizontal' => __( 'افقی', 'mweb' ),
					'vertical' => __( 'عمودی', 'mweb' ),
				],
				'condition' => [ 'hide_thumbnail!' => ['yes'], 'st_type' => ['one'] ],
			]
		);
		
		$slides_to_show = range( 1, 10 );
		$slides_to_show = array_combine( $slides_to_show, $slides_to_show );
		
		$this->add_responsive_control(
			'slides_to_show',
			[
				'label' => __( 'اسلاید جهت نمایش', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => $slides_to_show,
				'default' => 1,
				'condition' => [ 'hide_thumbnail' => ['yes'] ],
			]
		);
		
		$this->add_control(
			'space_between',
			[
				'label' => __( 'فاصله', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'condition' => [ 'hide_thumbnail' => ['yes'] ],
			]
		);
		
		
		$this->add_control(
			'sw_effect',
			[
				'label' => __( 'افکت', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'3d' => __( 'سه بعدی', 'mweb' ),
					'cube' => __( 'مکعبی', 'mweb' ),
					'card1' => __( 'کارت 1', 'mweb' ),
					'card2' => __( 'کارت 2', 'mweb' ),
					'creative1' => __( 'خلاقانه 1', 'mweb' ),
					'creative2' => __( 'خلاقانه 2', 'mweb' ),
					'creative3' => __( 'خلاقانه 3', 'mweb' ),
					'creative4' => __( 'خلاقانه 4', 'mweb' ),
					'creative5' => __( 'خلاقانه 5', 'mweb' ),
					'creative6' => __( 'خلاقانه 6', 'mweb' ),
					'none' => __( 'هیچ', 'mweb' ),
				],
				'condition' => [ 'hide_thumbnail' => ['yes'] ],
			]
		);
		
		$this->add_control(
			'hr_images',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		
		$this->add_control(
			'images_border',
			[
				'label' => __( 'رنگ حاشیه عکس', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .images .img img' => 'border-color: {{VALUE}}',
					'.woocommerce {{WRAPPER}} .images .woocommerce-product-gallery__image img' => 'border-color: {{VALUE}}',
					'.woocommerce {{WRAPPER}} .entry-img .thumbnails .img:not(.swiper-slide-thumb-active) img' => 'border-color: {{VALUE}}',
					'.woocommerce {{WRAPPER}} .wc_gallery_image a' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'images_border_radius',
			[
				'label' => __( 'گوشه های مدور عکس بزرگ', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .entry-img .images .img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.woocommerce {{WRAPPER}} .images .woocommerce-product-gallery__image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .swiper-slide-shadow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'thumbnail_border_radius',
			[
				'label' => __( 'گوشه های مدور عکس کوچک', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .entry-img .thumbnails .img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.woocommerce {{WRAPPER}} .wc_gallery_image a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		
		$this->end_controls_section();

		
		
		$this->start_controls_section(
			'section_gallery_tools',
			[
				'label' => __( 'تنظیمات آیکن ها', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'product_btn_align_v',
			[
				'label' => __( 'ترتیب عمودی', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'prefix_class' => 'elementor-product-btn-align-vertical-',
			]
		);
		
		$this->add_control(
			'product_btn_align_h',
			[
				'label' => __( 'ترتیب افقی راست', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'prefix_class' => 'elementor-product-btn-align-hright-',
			]
		);
		
		$this->add_control(
			'product_btn_align_vtop',
			[
				'label' => __( 'تراز بالا', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'prefix_class' => 'elementor-product-btn-align-vtop-',
			]
		);
		
		$this->add_control(
			'show_elements_gallery',
			[
				'label' => __( 'آیکن های فعال', 'mweb' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => [
					'zoom'  => __( 'زوم تصاویر', 'mweb' ),
					'video'  => __( 'ویدیو', 'mweb' ),
					'share'  => __( 'اشتراک گذاری', 'mweb' ),
					'chart'  => __( 'نمودار قیمت', 'mweb' ),
					'view360'  => __( 'نمای 360', 'mweb' ),
					'alarm'  => __( 'اطلاع رسانی', 'mweb' ),
					'wishlist'  => __( 'علاقه مندی', 'mweb' ),
					'compare'  => __( 'مقایسه', 'mweb' ),

				],
				'default' => [ 'zoom', 'video', 'share' ],
			]
		);
		
		$this->add_control(
			'item_color',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .popup-image svg, .woocommerce {{WRAPPER}} .popup-share>a svg, .woocommerce {{WRAPPER}} .popup-video svg, .woocommerce {{WRAPPER}} .remindme_icon svg, .woocommerce {{WRAPPER}} .product_tools_btn .add_to_wishlist_wrap .single_add_to_wishlist svg, .woocommerce {{WRAPPER}} .product_tools_btn .compare svg' => 'stroke: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'item_color_hover',
			[
				'label' => __( 'رنگ آیکن هاور', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .popup-image:hover svg, .woocommerce {{WRAPPER}} .popup-share>a:hover svg, .woocommerce {{WRAPPER}} .popup-video:hover svg, .woocommerce {{WRAPPER}} .remindme_icon:hover svg, .woocommerce {{WRAPPER}} .product_tools_btn .add_to_wishlist_wrap .single_add_to_wishlist:hover svg, .woocommerce {{WRAPPER}} .product_tools_btn .compare:hover svg' => 'stroke: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'item_bg_color',
			[
				'label' => __( 'پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .images .popup-image' => 'background-color: {{VALUE}}',
					'.woocommerce {{WRAPPER}} .images .popup-share>a' => 'background-color: {{VALUE}}',
					'.woocommerce {{WRAPPER}} .images .popup-video' => 'background-color: {{VALUE}}',
					'.woocommerce {{WRAPPER}} .images .remindme_icon' => 'background-color: {{VALUE}}',
					'.woocommerce {{WRAPPER}} .product_tools_btn .add_to_wishlist_wrap .single_add_to_wishlist' => 'background-color: {{VALUE}}',
					'.woocommerce {{WRAPPER}} .product_tools_btn .compare' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		
		$this->add_control(
			'item_border_color',
			[
				'label' => __( 'رنگ حاشیه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .images .popup-image' => 'border-color: {{VALUE}}',
					'.woocommerce {{WRAPPER}} .images .popup-share>a' => 'border-color: {{VALUE}}',
					'.woocommerce {{WRAPPER}} .images .popup-video' => 'border-color: {{VALUE}}',
					'.woocommerce {{WRAPPER}} .images .remindme_icon' => 'border-color: {{VALUE}}',
					'.woocommerce {{WRAPPER}} .product_tools_btn .add_to_wishlist_wrap .single_add_to_wishlist' => 'border-color: {{VALUE}}',
					'.woocommerce {{WRAPPER}} .product_tools_btn .compare' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'item_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .images .popup-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.woocommerce {{WRAPPER}} .images .popup-share>a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.woocommerce {{WRAPPER}} .images .popup-video' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.woocommerce {{WRAPPER}} .images .remindme_icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.woocommerce {{WRAPPER}} .product_tools_btn .add_to_wishlist_wrap .single_add_to_wishlist' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.woocommerce {{WRAPPER}} .product_tools_btn .compare' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		
		$this->end_controls_section();

	}
	
	
	
	public function product_buttons($my_elements = array(), $st_type = 'one'){
		?>
		<div class="product_tools_btn">
			<?php if(in_array('zoom', $my_elements)){ echo '<span class="popup-image" id="btn_popup_images"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#maximize-4"></use></svg></span>'; } ?>
			
			<?php $price_chart_class = '';
				if(in_array('video', $my_elements) && $st_type !== 'two'){
					$video_embed = get_post_meta( get_the_ID(), 'mweb_single_video_embed', true ); 
					$video_direct = get_post_meta( get_the_ID(), 'mweb_single_video_directlink', true );
					
					
					if(!empty($video_embed)){ 
						$price_chart_class = ' has_right'; 
						echo '<a class="popup-video embed_video" href="https://www.aparat.com/video/video/embed/videohash/'.$video_embed.'/vt/frame" title="ویدیو"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#play"></use></svg></a>'; 
					}elseif(!empty($video_direct)){
						$price_chart_class = ' has_right'; 
						echo '<a href="#popup-video" class="popup-video direct_video" title="ویدیو"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#play"></use></svg></a>';
						echo '<div id="popup-video" class="mfp-hide"><video controls><source src="'.$video_direct.'" type="video/mp4">مرورگر شما ویدئو با این پسوند را پشتیبانی نمی کند.</video></div>';
					}
				} 
				
				if(in_array('wishlist', $my_elements)){
					$flag =false;
					\mweb_wishlist::mweb_single_add_wishlist(get_the_ID(), 'product', $flag, false, 'heart');
				}
				if(in_array('compare', $my_elements)){
					if(function_exists('mweb_add_compare_button')) {
						mweb_add_compare_button_single(true);
					}
				}
				if(in_array('share', $my_elements)){
					mweb_get_product_share();
				}
				if(in_array('chart', $my_elements)){
					mweb_get_product_price_chart($price_chart_class);
				}
				if(in_array('view360', $my_elements)){
					mweb_get_product_360_view();
				}
				if(in_array('alarm', $my_elements)){
					do_action('product_tools_hook');
				}
			?>
		</div>
		<?php
	}

	
	protected function render() {
	
		global $product;
		$product = wc_get_product();

		if ( empty( $product ) ) {
			return;
		}
		
		$settings = $this->get_settings_for_display();
		
		$st_type = $settings['st_type'];
		$my_elements = $settings['show_elements_gallery'];

		if( $st_type == 'two' ){
			$args = array(); 
			if( $settings['has_video'] == 'yes' ){
				$args['video'] = true; 
			}
			ob_start();
			$this->product_buttons($my_elements, $st_type);
			$args['product_btns'] = ob_get_clean(); 
			$args['is_elm'] = true; 
			
			wc_get_template( 'single-product/product-image-v.php', $args );
		} else {
		
		
		
		$gallery_dir = $settings['view'];
		$gallery_dir_class = ($settings['view'] == 'vertical') ? 'gallery_type_v' : 'gallery_type_h';
		
		if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
			return;
		}
		
		$data_setting = array();
		$slide_desktop = empty($settings['slides_to_show']) ? 1 : $settings['slides_to_show'];
		
		$data_setting['slidesPerView'] = $slide_desktop;
		$data_setting['spaceBetween'] = empty($settings['space_between']['size']) ? 0 : $settings['space_between']['size'];
		$data_setting['watchSlidesVisibility'] = true;
		
		if( !wp_is_mobile() )
			$data_setting = get_swiper_effect($settings['sw_effect'], $data_setting);

		if( $settings['hide_thumbnail'] == 'yes' ){
			$data_setting['navigation'] = array('nextEl' => '.mweb_gallery_next','prevEl' => '.mweb_gallery_prev' );
		}
	
		$slide_tablet = empty($settings['slides_to_show_tablet']) ? 1 : $settings['slides_to_show_tablet'];
		$slide_mobile = empty($settings['slides_to_show_mobile']) ? 1 : $settings['slides_to_show_mobile'];  

		$data_setting['breakpoints'] = array('575' => array('slidesPerView' => $slide_mobile), '768' => array('slidesPerView' => $slide_tablet), '1024' => array('slidesPerView' => $slide_desktop));

			
		$attr_class = 'swiper product-images';
		
		
		$this->add_render_attribute( [
			'carousel-wrapper' => [
				'class' => $attr_class,
				'id' => 'sl_'.$this->get_id(),
				'dir' => 'rtl',
				'data-slider' => wp_json_encode($data_setting)
			],
		] );
		
		
		
		$wrapper_classes   = 'gallery-' . ( has_post_thumbnail() ? 'with-images' : 'without-images' );
		$attachment_ids = $product->get_gallery_image_ids();
		
		?>
		<div class="entry-img single_p_gallery <?= $gallery_dir_class ?>" data-direction="<?= $gallery_dir ?>">
			<div class="inner">
				<?php do_action( 'mweb_before_single_product_images', $product ); ?>			
				<?php woocommerce_show_product_sale_flash(); ?>			
				<div class="images <?php echo $wrapper_classes; ?>">
					<div <?= $this->get_render_attribute_string( 'carousel-wrapper' ); ?>>
						<div class="swiper-wrapper">
						<?php
							
							$my_thumb = $product->get_image_id();
							if ( $attachment_ids && $product->get_image_id() ) {
								array_unshift($attachment_ids ,$my_thumb);
								
								$my_flag = true ;
								
								foreach ( $attachment_ids as $attachment_id ) {
									$full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
									$thumbnail       = wp_get_attachment_image_src( $attachment_id, 'woocommerce_single' );
									if($my_flag){
										$attributes      = array(
											'title'                   => get_post_field( 'post_title', $attachment_id ),
											'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
											'class' 				  => 'img-responsive woocommerce-main-image',
											'data-zoom-image'		  => $full_size_image[0],
											'data-src'                => $full_size_image[0],
											'data-large_image'        => $full_size_image[0],
											'data-large_image_width'  => $full_size_image[1],
											'data-large_image_height' => $full_size_image[2],
										);
										$my_flag = false;
										
									}else {
										$attributes      = array(
											'title'                   => get_post_field( 'post_title', $attachment_id ),
											'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
											'class' 				  => 'img-responsive',
											'data-zoom-image'		  => $full_size_image[0],
											'data-src'                => $full_size_image[0],
											'data-large_image'        => $full_size_image[0],
											'data-large_image_width'  => $full_size_image[1],
											'data-large_image_height' => $full_size_image[2],
										);
									}		

									$html  = '<div data-thumb="' . esc_url( $thumbnail[0] ) . '" class="swiper-slide img woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '">';
									$html .= wp_get_attachment_image( $attachment_id, 'shop_single', false, $attributes );
									$html .= '</a></div>';

									echo apply_filters( 'woocommerce_single_product_image_html', $html, $attachment_id );
								}
							} elseif(has_post_thumbnail()){
								$html  = wc_get_gallery_image_html( $my_thumb, true );
								echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $my_thumb );
							} else {

								$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
								$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
								$html .= '</div>';
								echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $my_thumb );
							}
							

						?>
						</div>
						<?php if($settings['hide_thumbnail'] == 'yes'){ ?>
							<div class="swiper-button-next mweb_gallery_next"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#arrow-left-1"></use></svg></div>
							<div class="swiper-button-prev mweb_gallery_prev"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#arrow-right-1"></use></svg></div>
						<?php } ?>
					</div>
					<?php $this->product_buttons($my_elements, $st_type); ?>
					
				</div>
				<?php
				ob_start();
					do_action( 'woocommerce_product_thumbnails' );
				$thumb_html = ob_get_clean();
				?>
				<?php if($settings['hide_thumbnail'] != 'yes' && !empty($thumb_html)){ ?>
				<div class="thumbnails">
					<div class="swiper product-thumbs" dir="rtl">
						<div class="swiper-wrapper">
							<?php echo $thumb_html; ?>
						</div>
						<div class="swiper-button-next swiper-button-v1-next"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#arrow-left-1"></use></svg></div>
						<div class="swiper-button-prev swiper-button-v1-prev"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#arrow-right-1"></use></svg></div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
		
		
		<?php
	
		}
	}

	
	/* protected function content_template() {
		
	} */
}






/**
 * Elementor Woocommerce Upcoming Product
 * @since 1.0.0
 */
class My_Woo_Upcoming_Product extends Widget_Base {

	
	public function get_name() {
		return 'mweb-upcoming';
	}
	
	public function get_title() {
		return __( 'محصول بزودی', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-kit-upload-alt';
	}

	public function get_categories() {
		return [ 'digiland_woo' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تنظیمات', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		

		$this->add_control(
			'text_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .available_on' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'label' => __( 'تایپوگرافی', 'mweb' ),
				'selector' => '{{WRAPPER}} .available_on',
			]
		);
		
		$this->add_control(
			'bg_color',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .available_on' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'upp_border',
				'selector' => '{{WRAPPER}} .available_on',
			]
		);

		$this->add_control(
			'upp_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .available_on' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'upp_padding',
			[
				'label' => __( 'فاصله داخلی', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .available_on' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		
		$this->end_controls_section();
		


	}

	
	protected function render() {
	
		global $product;
		$product = wc_get_product();

		if ( empty( $product ) ) {
			return;
		}

		\mweb_wc_upcoming_product::init()->mweb_upcoming_single_page_view();

	}

	
	protected function content_template() {
		
		echo '<span class="available_on"><strong>محل نمایش تاریخ عرضه محصول</strong></span>';
		
	}
}





/**
 * Elementor Woocommerce Product Accessories
 * @since 1.0.0
 */
class My_Woo_Accessories extends Widget_Base {

	
	public function get_name() {
		return 'mweb-accessories';
	}
	
	public function get_title() {
		return __( 'لوازم جانبی محصول و مرتبط', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-product-categories';
	}

	public function get_categories() {
		return [ 'digiland_woo' ];
	}

	protected function register_controls() {
		
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تنظیمات', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		

		$this->add_control(
			'acc_type',
			[
				'label' => __( 'نوع', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __( 'تکی', 'mweb' ),
					'no' => __( 'چند تایی', 'mweb' ),
				]
			]
		);
		
		$this->add_control(
			'acc_single_border_color',
			[
				'label' => __( 'رنگ حاشیه کد', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .single_acc' => 'border-color: {{VALUE}}',
				],
				'condition' => [ 'acc_type' => ['yes'] ],
			]
		);
		
		$this->add_control(
			'acc_vertical',
			[
				'label' => __( 'عمودی', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => __( 'خیر', 'mweb' ),
				'label_on' => __( 'بله', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [ 'acc_type!' => ['yes'] ],
			]
		);
		
		$this->add_control(
			'acc_wide',
			[
				'label' => __( 'عریض', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => __( 'خیر', 'mweb' ),
				'label_on' => __( 'بله', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [ 'acc_type!' => ['yes'] ],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'addtocart_background',
				'label' => __( 'رنگ پس زمینه افزودن به سبد', 'mweb' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '.woocommerce {{WRAPPER}} .accessories .acc_left_c .add-all-to-cart',
				'condition' => [ 'acc_type!' => ['yes'] ],
			]
		);
		
		
		$this->add_control(
			'wc_style_type',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => __( 'حالت تک => محصول مرتبط تکی', 'mweb' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			]
		);
		
		$this->add_control(
			'wc_style_warning',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => __( 'این المان فاقد تنظیمات است', 'mweb' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			]
		);
		
		
		$this->end_controls_section();
		


	}

	
	protected function render() {
	
		global $product;
		$product = wc_get_product();

		if ( empty( $product ) ) {
			return;
		}

		$settings = $this->get_settings_for_display();
		

		if( $settings['acc_type'] != 'yes' ){
			$is_vertical = $settings['acc_vertical'] == 'yes' ? true : false; 
			$is_wide = $settings['acc_wide'] == 'yes' ? true : false; 
			\mweb_product_accessories::show_accessories( $product, $is_vertical, $is_wide );
		} else {
			mweb_render_single_acc();
		}

	}

	
	protected function content_template() {
		
	}
}




/**
 * Elementor Woocommerce Prodcut Content
 * @since 1.0.0
 */
class My_Woo_Product_Content extends Widget_Base {

	
	public function get_name() {
		return 'mweb-product-content';
	}
	
	public function get_title() {
		return __( 'محتوای محصول', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-post-excerpt';
	}

	public function get_categories() {
		return [ 'digiland_woo' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تنظیمات', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		
		$this->add_control(
			'content_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .entry-content' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => __( 'تایپوگرافی', 'mweb' ),
				'selector' => '{{WRAPPER}} .entry-content p',
			]
		);
		
		
		$this->add_control(
			'content_show_more',
			[
				'label' => __( 'نمایش دکمه جمع شونده', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بلی', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		
		$this->end_controls_section();


	}

	
	protected function render() {
	
		global $product;
		$product = wc_get_product();

		if ( empty( $product ) ) {
			return;
		}
		
		
		$the_content = apply_filters( 'the_content', get_the_content() );
		if ( !empty($the_content) ) {
			echo '<div class="entry-content">';
				if( $settings['content_show_more'] == 'yes' ){
					echo '<div class="entry_content_inner">';
						echo $the_content;
					echo '</div><div class="entry_content_more"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-circle-down"></use></svg>نمایش <span>ادامه مطلب</span></div>';
				}else{
					echo $the_content;
				}
			echo '</div>';
		}
	}

	
	protected function content_template() {

	}
}




/**
 * Elementor Woocommerce Product Tabs
 * @since 1.0.0
 */
class My_Woo_Tabs extends Widget_Base {

	
	public function get_name() {
		return 'mweb-data-tabs';
	}
	
	public function get_title() {
		return __( 'تب های محصول', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-product-tabs';
	}

	public function get_categories() {
		return [ 'digiland_woo' ];
	}

	protected function register_controls() {
		
		
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تنظیمات کلی', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'is_scroll',
			[
				'label' => __( 'نمایش تب ها به صورت اسکرول', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بلی', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [ 'single_tab!' => ['yes'] ],
			]
		);
		
		$this->add_control(
			'is_scroll_mobile',
			[
				'label' => __( 'حذف تب در موبایل', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بلی', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [ 'single_tab!' => ['yes'] ],
			]
		);
		
		$this->add_control(
			'remove_tabs',
			[
				'label' => __( 'حذف تب ها', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بلی', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [ 'is_scroll' => ['yes'] ],
			]
		);
		
		
		$this->add_control(
			'single_tab',
			[
				'label' => __( 'نمایش تکی تب', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بلی', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		
		$this->add_control(
			'single_tab_callback',
			[
				'label' => __( 'انتخاب تب', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'description' => __( 'توضیحات', 'mweb' ),
					'additional_information' => __( 'مشخصات کلی', 'mweb' ),
					'reviews' => __( 'نظرات کاربران', 'mweb' ),
					'questions' => __( 'سوالات کاربران', 'mweb' ),
					'review_p_tab' => __( 'نقد و بررسی', 'mweb' ),
				],
				'condition' => [ 'single_tab' => ['yes'] ],
			]
		);
		
		
		$this->add_control(
			'mobile_tab_fixed',
			[
				'label' => __( 'نمایش چسبان تب در موبایل', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بلی', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'no',
				//'condition' => [ 'is_scroll' => ['yes'] ],
			]
		);
		
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_product_tabs_style',
			[
				'label' => __( 'تب ها', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'wc_style_warning',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => __( 'استایل تب ها را میتوانید از طریق پنل مدیریت پوسته نیز تغییر دهید - تنها نوع استایل 3 از طریق زیر قابل استایل دهی است', 'mweb' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'tabs_background',
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '.style_tabs_three {{WRAPPER}} .wc-tabs'
			]
		);
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tabs_box_shadow',
				'selector' => '.style_tabs_three {{WRAPPER}} .wc-tabs',
			]
		);
		
		$this->add_control(
			'tabs_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'.style_tabs_three {{WRAPPER}} .wc-tabs' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'tabs_margin',
			[
				'label' => __( 'فاصله خارجی', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'.woocommerce {{WRAPPER}} .wc-tabs' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
					'.woocommerce {{WRAPPER}} .woocommerce-tabs ul.wc-tabs li a' => 'color: {{VALUE}}',
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
					'.woocommerce {{WRAPPER}} .woocommerce-tabs ul.wc-tabs li a' => 'background-color: {{VALUE}}',
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
					'.woocommerce {{WRAPPER}} .woocommerce-tabs ul.wc-tabs li.active a' => 'color: {{VALUE}}',
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
					'.woocommerce {{WRAPPER}} .woocommerce-tabs ul.wc-tabs li.active a' => 'background-color: {{VALUE}}',
					'.style_tabs_default {{WRAPPER}} .wc-tabs>li.active a::before' => 'border-top-color: {{VALUE}}',
					//'.woocommerce.style_tabs_three {{WRAPPER}} ul.tabs li.active:after' => 'background-color: {{VALUE}}',
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

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tab_typography',
				'label' => __( 'تایپوگرافی', 'mweb' ),
				'selector' => '.woocommerce {{WRAPPER}} .woocommerce-tabs ul.wc-tabs li a',
			]
		);

		$this->add_control(
			'tab_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .woocommerce-tabs ul.wc-tabs li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_product_panel_style',
			[
				'label' => __( 'محتوای تب', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .woocommerce-Tabs-panel--description.entry-content>p' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => __( 'تایپوگرافی', 'mweb' ),
				'selector' => '.woocommerce {{WRAPPER}} .woocommerce-tabs .woocommerce-Tabs-panel--description.entry-content',
			]
		);

		$this->add_control(
			'heading_panel_heading_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'عناوین', 'mweb' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'heading_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .woocommerce-Tabs-panel--description.entry-content h2' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_heading_typography',
				'label' => __( 'تایپوگرافی', 'mweb' ),
				'selector' => '.woocommerce {{WRAPPER}} .woocommerce-tabs .woocommerce-Tabs-panel--description.entry-content h2',
			]
		);

		$this->add_control(
			'separator_panel_style',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		
		$this->add_control(
			'panel_bg_color',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'alpha' => false,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .woocommerce-tabs .woocommerce-Tabs-panel' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'panel_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .woocommerce-tabs .woocommerce-Tabs-panel' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					//'.woocommerce {{WRAPPER}} .woocommerce-tabs ul.wc-tabs' => 'margin-left: {{TOP}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'panel_box_shadow',
				'selector' => '.woocommerce {{WRAPPER}} .woocommerce-tabs .woocommerce-Tabs-panel',
			]
		);
		
		$this->add_control(
			'margin_tcontant',
			[
				'label' => __( 'فاصله بالایی تب ها', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'default' => [
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .scroll_wc_tab .woocommerce-Tabs-panel' => 'margin-top: {{SIZE}}{{UNIT}} !important',
				],
				'condition' => [ 'is_scroll' => ['yes'] ],

			]
		);


		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_content_desc',
			[
				'label' => __( 'توضیحات تکمیلی', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		
		$this->add_control(
			'thh_text_size',
			[
				'label' => __( 'اندازه متن عنوان گروه', 'mweb' ),
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
					'size' => 12,
				],
				'selectors' => [
					'.woocommerce {{WRAPPER}} table.shop_attributes tr.attribute_group_row_defined th' => 'font-size: {{SIZE}}{{UNIT}};',
				]
			]
		);
		
		$this->add_control(
			'th_text_size',
			[
				'label' => __( 'اندازه متن عنوان', 'mweb' ),
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
					'size' => 11,
				],
				'selectors' => [
					'.woocommerce {{WRAPPER}} table.shop_attributes th' => 'font-size: {{SIZE}}{{UNIT}};',
				]
			]
		);
		
		$this->add_control(
			'td_text_size',
			[
				'label' => __( 'اندازه متن مقدار', 'mweb' ),
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
					'size' => 11,
				],
				'selectors' => [
					'.woocommerce {{WRAPPER}} table.shop_attributes td' => 'font-size: {{SIZE}}{{UNIT}};',
				]
			]
		);
		
		
		$this->end_controls_section();
		
	}

	protected function render() {
		global $product;

		$product = wc_get_product();

		if ( empty( $product ) ) {
			return;
		}
		
		$settings = $this->get_settings_for_display();

		setup_postdata( $product->get_id() );
		
		$args = array();
		
		if( $settings['is_scroll'] == 'yes' || ($settings['is_scroll_mobile'] == 'yes' && wp_is_mobile()) ){
			$args['scroll'] = true; 
			
			if( $settings['remove_tabs'] == 'yes' ) 
				$args['remove_tabs'] = true;
			
			
		
		}
		if( $settings['mobile_tab_fixed'] == 'yes' ){
			$args['tab_fixed'] = true;
		}
		
		if( $settings['single_tab'] == 'yes' ){
			$key = $settings['single_tab_callback'];
			$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );
			if ( !empty($product_tabs) && !empty($key) ){
				if ( isset($product_tabs[$key]) ) {
					add_action( 'mweb_tab_content_title', '__return_false' );
					?>
					<div class="woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> entry-content" id="tab-<?php echo esc_attr( $key ); ?>">
						<?php
							call_user_func( $product_tabs[$key]['callback'], $key, $product_tabs[$key] );
						?>
					</div>
					<?php
				}
				
			}

		} else {
			wc_get_template( 'single-product/tabs/tabs.php', $args );
		}

		// On render widget from Editor - trigger the init manually.
		if ( wp_doing_ajax() && $settings['is_scroll'] != 'yes' ) {
			?>
			<script>
				jQuery( '.wc-tabs-wrapper, .woocommerce-tabs, #rating' ).trigger( 'init' );
			</script>
			<?php
		}
	}

	public function render_plain_content() {}

}





/**
 * Elementor Woocommerce Product Related
 * @since 1.1.0
 */
class My_Woo_Related extends Widget_Base {

	
	public function get_name() {
		return 'mweb-product-related';
	}
	
	public function get_title() {
		return __( 'محصولات مرتبط', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-product-related';
	}

	public function get_categories() {
		return [ 'digiland_woo' ];
	}

	protected function register_controls() {
		
		
		$this->start_controls_section(
			'section_block_title',
			[
				'label' => __( 'تنظیمات عنوان', 'mweb' ),
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
			'section_content',
			[
				'label' => __( 'تنظیمات', 'mweb' ),
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
			'posts_per_page',
			[
				'label' => __( 'تعداد', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 5,
				'min' => 1,
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' => __( 'بر اساس', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date' => __( 'تاریخ', 'mweb' ),
					'title' => __( 'عنوان', 'mweb' ),
					'price' => __( 'قیمت', 'mweb' ),
					'popularity' => __( 'محبوبیت', 'mweb' ),
					'rating' => __( 'امتیاز', 'mweb' ),
					'rand' => __( 'تصادفی', 'mweb' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label' => __( 'ترتیب', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc' => __( 'صعودی', 'mweb' ),
					'desc' => __( 'نزولی', 'mweb' ),
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ptitle_typography',
				'label' => __( 'تایپوگرافی عنوان محصول', 'mweb' ),
				'selector' => '{{WRAPPER}} .item .item-area:not(.general_mobile) .product-name',
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

		
		$this->end_controls_section(); 
		
		$this->start_controls_section(
			'section_type',
			[
				'label' => __( 'نمـایش', 'mweb' ),
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
				],
				'prefix_class' => 'swiper-slider-nav-',
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
			'centered_slider',
			[
				'label' => __( 'اسلایدر وسط', 'mweb' ),
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
			'sw_effect',
			[
				'label' => __( 'افکت', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'3d' => __( 'سه بعدی', 'mweb' ),
					'cube' => __( 'مکعبی', 'mweb' ),
					'card1' => __( 'کارت 1', 'mweb' ),
					'card2' => __( 'کارت 2', 'mweb' ),
					'creative1' => __( 'خلاقانه 1', 'mweb' ),
					'creative2' => __( 'خلاقانه 2', 'mweb' ),
					'creative3' => __( 'خلاقانه 3', 'mweb' ),
					'creative4' => __( 'خلاقانه 4', 'mweb' ),
					'creative5' => __( 'خلاقانه 5', 'mweb' ),
					'creative6' => __( 'خلاقانه 6', 'mweb' ),
					'none' => __( 'هیچ', 'mweb' ),
				],
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
		
		

		$this->end_controls_section();
		

	}


	protected function render() {
	
		global $product;

		$product = wc_get_product();

		if ( ! $product ) {
			return;
		}

		$settings = $this->get_settings_for_display();

		$args = [
			'posts_per_page' => 4,
			'columns' => 4,
			'orderby' => $settings['orderby'],
			'order' => $settings['order'],
		];

		if ( ! empty( $settings['posts_per_page'] ) ) {
			$args['posts_per_page'] = $settings['posts_per_page'];
		}

		$args['related_products'] = array_filter( array_map( 'wc_get_product', wc_get_related_products( $product->get_id(), $args['posts_per_page'], $product->get_upsell_ids() ) ), 'wc_products_array_filter_visible' );

		$args['related_products'] = wc_products_array_orderby( $args['related_products'], $args['orderby'], $args['order'] );
		
		$show_dots = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
		$show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
		
		$data_setting = array();
		
		$slide_tablet = empty($settings['slides_to_show_tablet']) ? 2 : $settings['slides_to_show_tablet'];
		$slide_mobile = empty($settings['slides_to_show_mobile']) ? 1 : $settings['slides_to_show_mobile'];  
		
		$data_setting['slidesPerView'] = $slide_mobile;
		$data_setting['spaceBetween'] = $settings['slides_spaceBetween'];
		$data_setting['watchSlidesVisibility'] = true;
		
		if( $settings['centered_slider'] == 'yes'){
			$data_setting['centeredSlides'] = true;
		}
		
		if( !wp_is_mobile() )
			$data_setting = get_swiper_effect($settings['sw_effect'], $data_setting);
		
		
		if( $settings['infinite'] == 'yes' ){
			$data_setting['loop'] = true;
		}
		if( $settings['autoplay'] == 'yes' ){
			$data_setting['autoplay'] = true;
		}
		if( $settings['pause_on_hover'] == 'yes' ) {
			$data_setting['touchMoveStopPropagation'] = true;
		}
		
		if( $show_dots ){
			$data_setting['pagination'] = array('el' => '.mweb-swiper-pagination','clickable' => true);
		}
		if( $show_arrows ){
			$data_setting['navigation'] = array('nextEl' => '.mweb-swiper-next','prevEl' => '.mweb-swiper-prev' );
		}
		


		$data_setting['breakpoints'] = array('575' => array('slidesPerView' => $slide_mobile), '768' => array('slidesPerView' => $slide_tablet), '1024' => array('slidesPerView' => $settings['slides_to_show']));

		$args['slider_data'] = $data_setting;
		
		$args['slider_overflow'] = $settings['overflow'] == 'yes' ? true : false;
		
		
		$loop_arg = array();
		
		$loop_arg['flag'] = 'yes';
			
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
		
		$loop_name = 'mweb_loop_template_product_'.$loop_func;
		
		
		if ( $style_type == 'type-1'){
			$loop_arg['rating'] = true;
		}
		$loop_arg['thumbnail'] = $settings['item_thumbnail_size'];

		$args['loop_name'] = $loop_name;
		$args['loop_type'] = $settings['loop_type'];
		$args['loop_arg'] = $loop_arg;
		

		wc_get_template( 'single-product/related.php', $args );
		

	}

	
	protected function content_template() {
		
	}
}




/**
 * Elementor Woocommerce Product Upsell
 * @since 1.0.0
 */
class My_Woo_Upsell extends Widget_Base {

	
	public function get_name() {
		return 'mweb-product-upsell';
	}
	
	public function get_title() {
		return __( 'تشویق برای خرید بیشتر', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-product-upsell';
	}

	public function get_categories() {
		return [ 'digiland_woo' ];
	}

	protected function register_controls() {
		
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تنظیمات', 'mweb' ),
			]
		);
	
		$this->add_control(
			'orderby',
			[
				'label' => __( 'بر اساس', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date' => __( 'تاریخ', 'mweb' ),
					'title' => __( 'عنوان', 'mweb' ),
					'price' => __( 'قیمت', 'mweb' ),
					'popularity' => __( 'محبوبیت', 'mweb' ),
					'rating' => __( 'امتیاز', 'mweb' ),
					'rand' => __( 'تصادفی', 'mweb' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label' => __( 'ترتیب', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc' => __( 'صعودی', 'mweb' ),
					'desc' => __( 'نزولی', 'mweb' ),
				],
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
		
		
		$this->end_controls_section(); 
		
		$this->start_controls_section(
			'section_type',
			[
				'label' => __( 'نمـایش', 'mweb' ),
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
				],
				'prefix_class' => 'swiper-slider-nav-',
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
			'centered_slider',
			[
				'label' => __( 'اسلایدر وسط', 'mweb' ),
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

		$this->end_controls_section();

	}

	
	protected function render() {
	
		$settings = $this->get_settings_for_display();
		
		global $product;

		if ( ! $product ) {
			return;
		}
	
		$limit = '-1';
		$columns = 0;
		$orderby = 'rand';
		$order = 'desc';

		if ( ! empty( $settings['orderby'] ) ) {
			$orderby = $settings['orderby'];
		}

		if ( ! empty( $settings['order'] ) ) {
			$order = $settings['order'];
		}


		// Handle the legacy filter which controlled posts per page etc.
		$args = apply_filters(
			'woocommerce_upsell_display_args',
			array(
				'posts_per_page' => $limit,
				'orderby'        => $orderby,
				'order'          => $order,
				'columns'        => $columns,
			)
		);
		wc_set_loop_prop( 'name', 'up-sells' );
		wc_set_loop_prop( 'columns', apply_filters( 'woocommerce_upsells_columns', isset( $args['columns'] ) ? $args['columns'] : $columns ) );

		$orderby = apply_filters( 'woocommerce_upsells_orderby', isset( $args['orderby'] ) ? $args['orderby'] : $orderby );
		$order   = apply_filters( 'woocommerce_upsells_order', isset( $args['order'] ) ? $args['order'] : $order );
		$limit   = apply_filters( 'woocommerce_upsells_total', isset( $args['posts_per_page'] ) ? $args['posts_per_page'] : $limit );

		// Get visible upsells then sort them at random, then limit result set.
		$upsells = wc_products_array_orderby( array_filter( array_map( 'wc_get_product', $product->get_upsell_ids() ), 'wc_products_array_filter_visible' ), $orderby, $order );
		$upsells = $limit > 0 ? array_slice( $upsells, 0, $limit ) : $upsells;
		
		$args = array(
				'upsells'        => $upsells,

				// Not used now, but used in previous version of up-sells.php.
				'posts_per_page' => $limit,
				'orderby'        => $orderby,
				'columns'        => $columns,
			);
			
		$show_dots = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
		$show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
		
		$data_setting = array();
		
		
		$slide_tablet = empty($settings['slides_to_show_tablet']) ? 2 : $settings['slides_to_show_tablet'];
		$slide_mobile = empty($settings['slides_to_show_mobile']) ? 1 : $settings['slides_to_show_mobile'];  
		
		$data_setting['slidesPerView'] = $slide_mobile;
		$data_setting['spaceBetween'] = $settings['slides_spaceBetween'];
		$data_setting['watchSlidesVisibility'] = true;
		
		if( $settings['centered_slider'] == 'yes'){
			$data_setting['centeredSlides'] = true;
		}
		
		if( $settings['is_3d'] == 'yes' ){
			$data_setting['effect'] = 'coverflow';
			$data_setting['grabCursor'] = true;
			//$data_setting['slidesPerView'] = 'auto';
			$data_setting['coverflowEffect'] = array('rotate' => 30, 'stretch' => 0, 'depth' => 100, 'modifier' => 1, 'slideShadows' => true);
		}
		
		
		if( $settings['infinite'] == 'yes' ){
			$data_setting['loop'] = true;
		}
		if( $settings['autoplay'] == 'yes' ){
			$data_setting['autoplay'] = true;
		}
		if( $settings['pause_on_hover'] == 'yes' ) {
			$data_setting['touchMoveStopPropagation'] = true;
		}
		
		if( $show_dots ){
			$data_setting['pagination'] = array('el' => '.mweb-swiper-pagination','clickable' => true);
		}
		if( $show_arrows ){
			$data_setting['navigation'] = array('nextEl' => '.mweb-swiper-next','prevEl' => '.mweb-swiper-prev' );
		}

		

		$data_setting['breakpoints'] = array('575' => array('slidesPerView' => $slide_mobile), '768' => array('slidesPerView' => $slide_tablet), '1024' => array('slidesPerView' => $settings['slides_to_show']));

		$args['slider_data'] = $data_setting;
		
		$args['slider_overflow'] = $settings['overflow'] == 'yes' ? true : false;
		
		
		$loop_arg = array();
		
		$loop_arg['flag'] = 'yes';
			
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
		
		$loop_name = 'mweb_loop_template_product_'.$loop_func;
		
		
		if ( $style_type == 'type-1'){
			$loop_arg['rating'] = true;
		}
		$loop_arg['thumbnail'] = $settings['item_thumbnail_size'];

		$args['loop_name'] = $loop_name;
		$args['loop_type'] = $settings['loop_type'];
		$args['loop_arg'] = $loop_arg;
		


		wc_get_template( 'single-product/up-sells.php', $args );
		

	}

	
	protected function content_template() {
		
	}
}





/**
 * Elementor Module Dynamic price chart
 * @since 1.0.0
 */
class My_Woo_Price_Chart extends Widget_Base {
	
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);

		wp_register_script('highcharts', THEME_ASSET . '/js/highcharts.js', array('jquery'), THEME_VERSION, true);

	}

	public function get_script_depends() {
		return [ 'highcharts' ];
	}
	
	
	public function get_name() {
		return 'block-price-chart';
	}


	public function get_title() {
		return __( 'نمودار قیمت', 'mweb' );
	}


	public function get_icon() {
		return 'eicon-user-preferences';
	}


	public function get_categories() {
		return [ 'digiland_woo' ];
	}


	protected function register_controls() {
		
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'نمـایش', 'mweb' ),
			]
		);
		
		$this->add_control(
			'product_id',
			[
				'label' => __( 'شناسه محصول', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'description' => 'اگر داخل صفحه محصول استفاده میکنید این گزینه را رها کنید'
			]
		);
	
		$this->add_control(
			'bk_height',
			[
				'label' => __( 'ارتفاع', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'default' => [
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .dynamic_price_chart' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'bk_border',
				'selector' => '{{WRAPPER}} .dynamic_price_chart',
				//'exclude' => [ 'color' ],
			]
		);
		
		$this->add_control(
			'bk_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .dynamic_price_chart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'bk_box_shadow',
				'selector' => '{{WRAPPER}} .dynamic_price_chart',
			]
		);
		
		$this->add_control(
			'bk_margin',
			[
				'label' => __( 'فاصله خارجی', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .dynamic_price_chart' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'bk_padding',
			[
				'label' => __( 'فاصله داخلی', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .dynamic_price_chart' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();
		
	}
	
	protected function render() {
	
		$settings = $this->get_settings_for_display();
		
		$product_id = '';
		
		if( is_product() ){
			$product_id = get_the_ID();
		}else{
			if( !empty($settings['product_id']) ){
				$product = wc_get_product($settings['product_id']);
				if ( $product ) {
					$product_id = $product->get_id();
				}
			}
		}

		
		echo '<div class="dynamic_price_chart" id="inner_price_chart_'.$product_id.'" data-product_id="'.$product_id.'"></div>';
		

	}
	
	protected function content_template() {
		
	}
}





/**
 * Elementor Module Additional Information Without Group
 * @since 1.0.0
 */
class My_Woo_Additional_Information extends Widget_Base {
	
	public function get_name() {
		return 'block-additional-information';
	}


	public function get_title() {
		return __( 'مشخصات بدون گروه بندی', 'mweb' );
	}


	public function get_icon() {
		return 'eicon-product-info';
	}


	public function get_categories() {
		return [ 'digiland_woo' ];
	}


	protected function register_controls() {
		
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'نمـایش', 'mweb' ),
			]
		);
		
		$this->add_control(
			'show_type',
			[
				'label' => __( 'نوغ نمایش', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'attr_1',
				'options' => [
					'attr_1' => __( 'یک', 'mweb' ),
					'attr_2' => __( 'دو', 'mweb' ),
				],
				//'condition' => [ 'show_more_btn' => ['yes'] ]
			]
		);
		
		$this->add_control(
			'numberOfshow',
			[
				'label' => __( 'تعداد نمایش', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'condition' => [ 'show_type' => ['attr_2'] ]
			]
		);
		
		$this->add_responsive_control(
			'itemInrow',
			[
				'label' => __( 'تعداد در ردیف', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'custom' ],
				'range' => [
					'custom' => [
						'min' => 1,
						'max' => 5,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'custom',
					'size' => 3,
				],
				'selectors' => [
					'.woocommerce {{WRAPPER}} .el_attribute-list' => 'grid-template-columns: repeat({{SIZE}}, minmax(0, 1fr));',
				],
				'condition' => [ 'show_type' => ['attr_2'] ]
			]
		);
		
		$this->add_control(
			'show_unit',
			[
				'label' => __( 'نمایش واحد محصول', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بلی', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'label_typography',
				'label' => __( 'تایپوگرافی عنوان', 'mweb' ),
				'selector' => '.woocommerce {{WRAPPER}} .el_attribute-list .label',
			]
		);
		
		$this->add_control(
			'label_color',
			[
				'label' => __( 'رنگ برچسب', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .el_attribute-list .label' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'value_typography',
				'label' => __( 'تایپوگرافی مقدار', 'mweb' ),
				'selector' => '.woocommerce {{WRAPPER}} .el_attribute-list .value',
			]
		);
		
		$this->add_control(
			'value_color',
			[
				'label' => __( 'رنگ مقدار', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .el_attribute-list .value' => 'color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => __( 'تایپوگرافی', 'mweb' ),
				'selector' => '.woocommerce {{WRAPPER}} .el_attribute-list',
			]
		);
		
		$this->add_control(
			'bg_color',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .box_attr_1 .el_attribute-list li .label, .woocommerce {{WRAPPER}} .box_attr_1 .el_attribute-list li .value, .woocommerce {{WRAPPER}} .box_attr_2 .el_attribute-list li' => 'background-color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'item_padding',
			[
				'label' => __( 'فاصله داخلی آیتم ها', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'.woocommerce {{WRAPPER}} .el_attribute-list li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'item_border_radius',
			[
				'label' => __( 'گوشه های مدور آیتم ها', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .el_attribute-list li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 'show_type' => ['attr_2'] ]
			]
		);
		
		$this->end_controls_section();
		
	}
	
	protected function render() {
	
		global $product;

		$product = wc_get_product();

		if ( ! $product ) {
			return;
		}
		
		/* $product_attributes = array_filter( $product->get_attributes(), 'wc_attributes_array_filter_visible' );
		
		if ( ! $product_attributes ) {
			return;
		} */
		
		//print_r($product_attributes);
		
		$product_attributes = array();
		
		$settings = $this->get_settings_for_display();
		
		if ( $settings['show_unit'] ) {
			$unit = get_post_meta( get_the_ID(), '_product_unit', true );
			if(!empty($unit))
			$product_attributes['unit'] = array(
				'label' => 'واحد کالا',
				'value' => $unit,
			);
		}

		// Add product attributes to list.
		$attributes = array_filter( $product->get_attributes(), 'wc_attributes_array_filter_visible' );
		
		if ( ! $attributes ) {
			return;
		}

		foreach ( $attributes as $attribute ) {
			$values = array();

			if ( $attribute->is_taxonomy() ) {
				$attribute_taxonomy = $attribute->get_taxonomy_object();
				$attribute_values   = wc_get_product_terms( $product->get_id(), $attribute->get_name(), array( 'fields' => 'all' ) );

				foreach ( $attribute_values as $attribute_value ) {
					$value_name = esc_html( $attribute_value->name );

					if ( $attribute_taxonomy->attribute_public ) {
						$values[] = '<a href="' . esc_url( get_term_link( $attribute_value->term_id, $attribute->get_name() ) ) . '" rel="tag">' . $value_name . '</a>';
					} else {
						$values[] = $value_name;
					}
				}
			} else {
				$values = $attribute->get_options();

				foreach ( $values as &$value ) {
					$value = make_clickable( esc_html( $value ) );
				}
			}

			$product_attributes[ 'attribute_' . sanitize_title_with_dashes( $attribute->get_name() ) ] = array(
				'label' => wc_attribute_label( $attribute->get_name() ),
				'value' => apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values ),
			);

		}
		
		// Display weight and dimensions before attribute list.
		$display_dimensions = apply_filters( 'wc_product_enable_dimensions_display', $product->has_weight() || $product->has_dimensions() );

		if ( $display_dimensions && $product->has_weight() ) {
			$product_attributes['weight'] = array(
				'label' => __( 'Weight', 'woocommerce' ),
				'value' => wc_format_weight( $product->get_weight() ),
			);
		}

		if ( $display_dimensions && $product->has_dimensions() ) {
			$product_attributes['dimensions'] = array(
				'label' => __( 'Dimensions', 'woocommerce' ),
				'value' => wc_format_dimensions( $product->get_dimensions( false ) ),
			);
		}
		
		$counter = 1;
	
		
	?>
		<div class="el_product-attributes<?= ' box_'.$settings['show_type']; ?>">
			<ul class="el_attribute-list">
				<?php foreach ( $product_attributes as $product_attribute_key => $product_attribute ) :
					if( $counter > $settings['numberOfshow'] ){
						break;
					}
				?>
					<li><span class="label"><?php echo wp_kses_post( $product_attribute['label'] ); ?></span><span class="value"><?php echo $product_attribute['value']; ?></span></li>
				<?php 
				$counter++;
				endforeach; ?>
			</ul>
		</div>
	<?php
		
	}
	
	protected function content_template() {
		
	}
}





/**
 * Elementor Module Archive Product
 * @since 1.0.0
 */
class My_Woo_Archive_Product extends Widget_Base {
	
	public function get_name() {
		return 'block-archive-product';
	}


	public function get_title() {
		return __( 'آرشیو محصولات', 'mweb' );
	}


	public function get_icon() {
		return 'eicon-products';
	}


	public function get_categories() {
		return [ 'digiland_woo' ];
	}


	protected function register_controls() {
	
		
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'نمایش', 'mweb' ),
				//'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'show_title',
			[
				'label' => __( 'نمایش عنوان دسته', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بلی', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'cat_title_color',
			[
				'label' => __( 'رنگ متن عنوان', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .block-title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .block-title:before' => 'border-bottom: 2px dotted {{VALUE}}'
				],
				'condition' => [ 'show_title' => 'yes' ]
			]
		);
		
		$this->add_control(
			'show_thumbnail',
			[
				'label' => __( 'نمایش تصویر شاخص دسته', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بلی', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [ 'show_title' => 'yes' ]
			]
		);
		
		$this->add_control(
			'block_name',
			[
				'label' => __( 'نوع نمایش', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => mweb_get_product_list_templates(),
				'default' => 'type-0',
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
		
		$this->add_control(
			'remove_item_margin',
			[
				'label' => __( 'حذف فاصله بین محصولات', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'prefix_class' => 'wc-archive-loop-remove-margin--',
			]
		);
		
		$this->add_control(
			'ul_loop_product_bg',
			[
				'label' => __( 'رنگ پس زمینه فریم محصولات', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ul.products.row' => 'background-color: {{VALUE}}',
				],
				'condition' => [ 'remove_item_margin' => 'yes' ]
			]
		);	
		
		$this->add_control(
			'ul_loop_product_border_radius',
			[
				'label' => __( 'گوشه های مدور فریم محصولات', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} ul.products.row' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 'remove_item_margin' => 'yes' ]
			]
		);
		
		$this->add_control(
			'ul_loop_product_padding',
			[
				'label' => __( 'فاصله داخلی فریم محصولات', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} ul.products.row' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$slides_to_show = array(1, 2, 3, 4, 5);
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
		
		$this->add_control(
			'chr_box',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		
		$this->add_control(
			'show_control_bar',
			[
				'label' => __( 'نمایش نوار ابزار فروشگاه', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'description' => 'شامل تعداد محصول ، فیلتر مرتب سازی و ...',
				'label_on' => __( 'بلی', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'show_wc_result_count',
			[
				'label' => __( 'نمایش تعداد نتایج', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بلی', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [ 'show_control_bar' => 'yes' ]
			]
		);
		
		$this->add_control(
			'show_wc_ordering',
			[
				'label' => __( 'نمایش نوع مرتب سازی', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بلی', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [ 'show_control_bar' => 'yes' ]
			]
		);
		
		$this->add_control(
			'show_wc_ordering_as_list',
			[
				'label' => __( 'نوع مرتب سازی به صورت لیست', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'لیست', 'mweb' ),
				'label_off' => __( 'انتخابی', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [ 'show_wc_ordering' => 'yes' ]
			]
		);
		
		$this->add_control(
			'ct_bar_radius',
			[
				'label' => __( 'گوشه های مدور نوار ابزار', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .shop-control-bar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 'show_control_bar' => 'yes' ]
			]
		);
		
		$this->add_control(
			'ct_bar_color',
			[
				'label' => __( 'رنگ متن نوار ابزار', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shop-control-bar' => 'color: {{VALUE}}',
					'{{WRAPPER}} .shop-control-bar .woocommerce-result-count' => 'color: {{VALUE}}'
				],
				'condition' => [ 'show_control_bar' => 'yes' ]
			]
		);
		
		$this->add_control(
			'ct_bar_bgcolor',
			[
				'label' => __( 'رنگ پس زمینه نوار ابزار', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shop-control-bar' => 'background-color: {{VALUE}}',
				],
				'condition' => [ 'show_control_bar' => 'yes' ]
			]
		);
		
		$this->add_responsive_control(
			'ct_alignment',
			[
				'label' => __( 'تراز نوار ابزار', 'mweb' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'چپ', 'mweb' ),
						'icon' => 'eicon-text-align-left',
					],
					'right' => [
						'title' => __( 'راست', 'mweb' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'prefix_class' => 'elementor-shop-control-bar-align--',

			]
		);
		
		
		
		
		$this->end_controls_section();
		
		
	}
	
	
	public function products_loop() {
		if ( is_product_taxonomy() || is_post_type_archive( 'product' ) || is_page( wc_get_page_id( 'shop' ) ) ) {
			if ( woocommerce_product_loop() ) {
				
				if( $this->get_settings('show_control_bar') == 'yes' ){
					echo '<div class="shop-control-bar clear'. ($this->get_settings('show_wc_ordering_as_list') == 'yes' ? ' order_as_list' : '') .'">';
						/**
						 * Hook: woocommerce_before_shop_loop.
						 *
						 * @hooked wc_print_notices - 10
						 * @hooked woocommerce_result_count - 20
						 * @hooked woocommerce_catalog_ordering - 30
						 */
						remove_action( 'woocommerce_before_shop_loop', 'wc_print_notices', 10 );
						
						if( $this->get_settings('show_wc_result_count') != 'yes' )
							remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
							
						if( $this->get_settings('show_wc_ordering') != 'yes' )
							remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
							
						
						do_action( 'woocommerce_before_shop_loop' );
					echo '</div>';
					if ( WC()->session ) {
						wc_print_notices();
					}
				}else{
					remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
					remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
					do_action( 'woocommerce_before_shop_loop' );
				}
								
				
				$style_type = $this->get_settings('block_name');
				if( $style_type == 'type-0' || $style_type == 'type-1' ){
					$loop_func = 'general';
				}elseif( $style_type == 'type-8' ){
					$loop_func = 'simple_h';
				}else{
					$loop_func = 'general_'.$style_type[-1];
				}
				
				if( $style_type != 'type-8' && wp_is_mobile() )
					$loop_func = 'mobile';
				
				$loop_name = 'mweb_loop_template_product_'.$loop_func;
				
						
				
				
				$item_mobile = empty($this->get_settings('item_in_row_mobile')) ? 12 / 1 : 12 / $this->get_settings('item_in_row_mobile');
				$item_tablet = empty($this->get_settings('item_in_row_tablet')) ? 12 / 2 : 12 / $this->get_settings('item_in_row_tablet');
				$item_desktop = $this->get_settings('item_in_row') == 5 ? '5c' : 12 / $this->get_settings('item_in_row');
				
				if( $style_type == 'type-8' )
					$item_desktop .= ' item_simple';
				
				
				//woocommerce_product_loop_start();
				$product_type = $this->get_settings('loop_type');
				$loop_name2 = apply_filters('mweb_mobile_loop_name_archive', 'product');
				$product_type = $loop_name2 == 'product_mobile' ? 'prdtype_override_size' : $product_type;
				echo '<ul class="products row '.$product_type.'">';

				if ( wc_get_loop_prop( 'total' ) ) {
					while ( have_posts() ) {
						the_post();

						do_action( 'woocommerce_shop_loop' );
						
						global $product;

						// Ensure visibility.
						if ( empty( $product ) || ! $product->is_visible() ) {
							return;
						}
						
						$my_class = 'item col-'. $item_mobile .' col-sm-'. $item_tablet.' col-lg-'. $item_desktop;
						echo '<div class=" '. esc_attr( implode( ' ', wc_get_product_class( $my_class, $product ) ) ) .'">';
						echo $loop_name(array('thumbnail' => $this->get_settings('item_thumbnail_size')));
						echo '</div>';

					}
				}

				woocommerce_product_loop_end();

				wp_reset_postdata();
				
				woocommerce_pagination();
				
			} else {
				do_action( 'woocommerce_no_products_found' );
			}
		}
	}
	
	protected function render() {
	
		$settings = $this->get_settings_for_display();
		
		if( $settings['show_title'] == 'yes' ){
			echo '<header class="woocommerce-products-header block-title">';
				echo '<h1 class="woocommerce-products-header__title page-title title">';
					if( $settings['show_thumbnail'] == 'yes' ){
						if ( is_product_category() ){
							global $wp_query;
							$cat = $wp_query->get_queried_object();
							$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
							$image = wp_get_attachment_url( $thumbnail_id );
							if ( $image ) {
								echo '<img class="archive_thumbnail" src="' . $image . '" alt="' . $cat->name . '" />';
							}
						}
					}else{
						echo '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#document"></use></svg>';
					}
				
					woocommerce_page_title();
				echo '</h1>';
			echo '</header>';
		}
		
		$this->products_loop();
		
	}
	
	protected function content_template() {
		
	}
}






/**
 * Elementor Module Archive Product as Table
 * @since 1.0.0
 */
class My_Woo_Archive_Product_as_Table extends Widget_Base {
	
	protected $attributes = null;
	
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);

		wp_register_script('highcharts', THEME_ASSET . '/js/highcharts.js', array('jquery'), THEME_VERSION, true);

	}

	public function get_script_depends() {
		return [ 'highcharts' ];
	}
	
	public function get_name() {
		return 'block-archive-product-table';
	}


	public function get_title() {
		return __( 'آرشیو محصولات جدولی', 'mweb' );
	}


	public function get_icon() {
		return 'eicon-table';
	}


	public function get_categories() {
		return [ 'digiland_woo' ];
	}


	protected function register_controls() {
	
		
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'نمایش', 'mweb' ),
				//'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'show_title',
			[
				'label' => __( 'نمایش عنوان دسته', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بلی', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'cat_title_color',
			[
				'label' => __( 'رنگ متن نوار ابزار', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .block-title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .block-title:before' => 'border-bottom: 2px dotted {{VALUE}}'
				],
				'condition' => [ 'show_title' => 'yes' ]
			]
		);
		
		$this->add_control(
			'show_thumbnail',
			[
				'label' => __( 'نمایش تصویر شاخص دسته', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بلی', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [ 'show_title' => 'yes' ]
			]
		);
		
		$this->add_control(
			'product_attribute',
			[
				'label' => __( 'انتخاب ویژگی ها', 'mweb' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $this->get_attributes()
			]
		);
		
		$this->add_control(
			'show_product_photo',
			[
				'label' => __( 'نمایش عکس محصول', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'show_product_sku',
			[
				'label' => __( 'نمایش شناسه محصول', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'show_product_unit',
			[
				'label' => __( 'نمایش واحد محصول', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'show_product_price',
			[
				'label' => __( 'نمایش قیمت', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'show_product_chart',
			[
				'label' => __( 'نمایش نمودار قیمت', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'show_product_buy',
			[
				'label' => __( 'نمایش خرید', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بله', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'product_buy_type',
			[
				'label' => __( 'نوع خرید', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'مستقیم', 'mweb' ),
				'label_off' => __( 'پاپ آپ', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [ 'show_product_buy' => ['yes'] ],
			]
		);

		
		$this->add_control(
			'chr_box',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		
		$this->add_control(
			'show_control_bar',
			[
				'label' => __( 'نمایش نوار ابزار فروشگاه', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'description' => 'شامل تعداد محصول ، فیلتر مرتب سازی و ...',
				'label_on' => __( 'بلی', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'show_wc_result_count',
			[
				'label' => __( 'نمایش تعداد نتایج', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بلی', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [ 'show_control_bar' => 'yes' ]
			]
		);
		
		$this->add_control(
			'show_wc_ordering',
			[
				'label' => __( 'نمایش نوع مرتب سازی', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بلی', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [ 'show_control_bar' => 'yes' ]
			]
		);
		
		$this->add_control(
			'show_wc_ordering_as_list',
			[
				'label' => __( 'نوع مرتب سازی به صورت لیست', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'لیست', 'mweb' ),
				'label_off' => __( 'انتخابی', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [ 'show_wc_ordering' => 'yes' ]
			]
		);
		
		$this->add_control(
			'ct_bar_radius',
			[
				'label' => __( 'گوشه های مدور نوار ابزار', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .shop-control-bar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 'show_control_bar' => 'yes' ]
			]
		);
		
		$this->add_control(
			'ct_bar_color',
			[
				'label' => __( 'رنگ متن نوار ابزار', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shop-control-bar' => 'color: {{VALUE}}',
					'{{WRAPPER}} .shop-control-bar .woocommerce-result-count' => 'color: {{VALUE}}'
				],
				'condition' => [ 'show_control_bar' => 'yes' ]
			]
		);
		
		$this->add_control(
			'ct_bar_bgcolor',
			[
				'label' => __( 'رنگ پس زمینه نوار ابزار', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shop-control-bar' => 'background-color: {{VALUE}}',
				],
				'condition' => [ 'show_control_bar' => 'yes' ]
			]
		);

		$this->end_controls_section();
		
		
	}
	
	public function get_attributes() {
		if(empty($this->attributes))
			$this->attributes = get_wc_attribute_taxonomies();
		return $this->attributes; 
	}
	
	
	public function products_loop() {
		if ( is_product_taxonomy() || is_post_type_archive( 'product' ) || is_page( wc_get_page_id( 'shop' ) ) ) {
			if ( woocommerce_product_loop() ) {
				
				if( $this->get_settings('show_control_bar') == 'yes' ){
					echo '<div class="shop-control-bar clear'. ($this->get_settings('show_wc_ordering_as_list') == 'yes' ? ' order_as_list' : '') .'">';
						/**
						 * Hook: woocommerce_before_shop_loop.
						 *
						 * @hooked wc_print_notices - 10
						 * @hooked woocommerce_result_count - 20
						 * @hooked woocommerce_catalog_ordering - 30
						 */
						remove_action( 'woocommerce_before_shop_loop', 'wc_print_notices', 10 );
						
						if( $this->get_settings('show_wc_result_count') != 'yes' )
							remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
							
						if( $this->get_settings('show_wc_ordering') != 'yes' )
							remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
							
						
						do_action( 'woocommerce_before_shop_loop' );
					echo '</div>';
					if ( WC()->session ) {
						wc_print_notices();
					}
				}else{
					remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
					remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
					do_action( 'woocommerce_before_shop_loop' );
				}
				
				
				$product_attribute = $this->get_settings('product_attribute');
				
				$temp = get_wc_attribute_taxonomies();
				
				
				woocommerce_product_loop_start();

				if ( wc_get_loop_prop( 'total' ) ) {
					
					echo '<table class="product_list_table elm_table">';
						echo '<thead><tr>';
							if($this->get_settings('show_product_photo') == 'yes')
								echo '<th class="th_img">عکس</th>';
							if($this->get_settings('show_product_sku') == 'yes')
								echo '<th class="th_sku">کد</th>';
							echo '<th class="th_title">نام</th>';
							if(!empty($product_attribute)){
								foreach($product_attribute as $attr){
									echo '<th class="th_attribute">'. $temp[$attr] .'</th>';
								}
							}
							if($this->get_settings('show_product_unit') == 'yes')
								echo '<th class="th_unit">واحـد</th>';
							if($this->get_settings('show_product_price') == 'yes')
								echo '<th class="th_price">قیمت</th>';
							if($this->get_settings('show_product_chart') == 'yes' || $settings['show_product_buy'] == 'yes')
								echo '<th class="th_action">عملیات</th>';
						
						echo '</tr></thead>';
						echo '<tbody>';
				
				
					while ( have_posts() ) {
						the_post();

						do_action( 'woocommerce_shop_loop' );
						
						global $product;

						// Ensure visibility.
						if ( empty( $product ) || ! $product->is_visible() ) {
							return;
						}
						
						$product_id = get_the_ID();
					
						echo '<tr>';
						
						if($this->get_settings('show_product_photo') == 'yes')
							echo '<td class="td_img">'. woocommerce_get_product_thumbnail('simplev') .'</td>';
						
						if($this->get_settings('show_product_sku') == 'yes'){
							$prd_sku = $product->get_sku();
							echo '<td class="td_sku'. (empty($prd_sku) ? ' hide_mobile' : '') .'" data-title="شناسه">'.$prd_sku.'</td>';
						}
							
						
						echo '<td class="td_title"><a href="'.get_permalink().'" data-title="عنوان">'.get_the_title().'</a></td>';
						
						if(!empty($product_attribute)){
							foreach($product_attribute as $attr){
								$terms = wc_get_product_terms( $product_id, 'pa_'.$attr, array( 'fields' => 'all' ) );
								$attr_tax = '';
								if(!empty($terms)){
									foreach($terms as $tax ){
										$attr_tax .= '<span>'.$tax->name.'</span>';
									}
								}
								echo '<td class="td_attribute'. (empty($attr_tax) ? ' hide_mobile' : '') .'" data-title="'.$this->attributes[$attr].'">'.$attr_tax.'</td>';
							}
						}
						
						if($this->get_settings('show_product_unit') == 'yes'){
							$prd_unit = get_post_meta( $product_id, '_product_unit', true );
							echo '<td class="td_unit'. (empty($prd_unit) ? ' hide_mobile' : '') .'"  data-title="واحد">'.$prd_unit.'</td>';
						}
						
						if( $this->get_settings('show_product_price') == 'yes' ){
							$my_flag = '';
							$my_price_old = mweb_last_price_data($product_id);
							if(!empty($my_price_old)){
								$old_price = $product->is_on_sale() ? $product->get_regular_price() : $my_price_old->price;
								$current_price = $product->is_on_sale() ? $product->get_sale_price() : $product->get_regular_price();
								if(!empty($current_price)){
									$my_attr = empty($my_price_old->date) || $product->is_on_sale() ? ' data-original-title="فروش ویژه" title="فروش ویژه" data-toggle="tooltip"' : ' data-original-title="نسبت به تاریخ '.$my_price_old->date.'" title="نسبت به تاریخ '.$my_price_old->date.'" data-toggle="tooltip"';
									//$my_flag = '<i class="fal fa-equals"'.$my_attr.'></i>';
									$my_flag = '';
									if($current_price > $old_price){
										$my_flag = '<div class="elm_td_svg" '.$my_attr.'><svg class="pack-theme trend_up" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#trend-up"></use></svg></div>';
									}elseif($current_price < $old_price){
										$my_flag = '<div class="elm_td_svg" '.$my_attr.'><svg class="pack-theme trend_down" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#trend-down"></use></svg></div>';
									}
								}
							}
							
							echo '<td class="td_price" data-title="قیمت">'.$my_flag.'<span class="price tb_price">'. $product->get_price_html() .'</span></td>';
						}
							
						if($this->get_settings('show_product_chart') == 'yes' || $this->get_settings('show_product_buy') == 'yes'){
							$my_action = '';
							$show_price_chart = get_post_meta($product_id, '_show_price_chart' , true);
							if($this->get_settings('show_product_chart') == 'yes' && $show_price_chart == 'yes' && !empty($my_price_old))
							$my_action .= '<span class="btn btn_price_chart" data-product_id="'.$product_id.'" title="نمودار قیمت" data-toggle="tooltip"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#chart-2"></use></svg></span>';
							
							if($this->get_settings('show_product_buy') == 'yes'){
								if($this->get_settings('product_buy_type') == 'yes' || wp_is_mobile()){
									$my_action .= '<a href="'.esc_url(get_permalink()).'" class="btn tb_btn_buy" data-product_id="'.$product_id.'" title="خرید"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#shopping-cart"></use></svg></a>';						
								}else{
									$my_action .= '<a href="#" class="btn quickview-btn" data-toggle="tooltip" data-product_id="'.$product_id.'" title="خرید"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#shopping-cart"></use></svg></a>';
								}
							}
							echo '<td class="td_action" data-title="عملیات">'.$my_action.'</td>';
						}
						

						echo '</tr>';

					}
					
					echo '</tbody>
						</table>';
				
				}

				woocommerce_product_loop_end();

				wp_reset_postdata();
				
				woocommerce_pagination();
				
			} else {
				do_action( 'woocommerce_no_products_found' );
			}
		}
	}
	
	protected function render() {
	
		$settings = $this->get_settings_for_display();
		
		if( $settings['show_title'] == 'yes' ){
			echo '<header class="woocommerce-products-header block-title">';
				echo '<h1 class="woocommerce-products-header__title page-title title">';
					if( $settings['show_thumbnail'] == 'yes' ){
						if ( is_product_category() ){
							global $wp_query;
							$cat = $wp_query->get_queried_object();
							$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
							$image = wp_get_attachment_url( $thumbnail_id );
							if ( $image ) {
								echo '<img class="archive_thumbnail" src="' . $image . '" alt="' . $cat->name . '" />';
							}
						}
					}else{
						echo '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#document"></use></svg>';
					}
				
					woocommerce_page_title();
				echo '</h1>';
			echo '</header>';
		}
		
		$this->products_loop();
		
	}
	
	protected function content_template() {
		
	}
}






/**
 * Elementor Module Archive Product Description
 * @since 1.0.0
 */
class My_Woo_Archive_Description extends Widget_Base {
	
	public function get_name() {
		return 'block-archive-desc';
	}


	public function get_title() {
		return __( 'توضیحات آرشیو', 'mweb' );
	}


	public function get_icon() {
		return 'eicon-single-post';
	}


	public function get_categories() {
		return [ 'digiland_woo' ];
	}


	protected function register_controls() {
	
		
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'نمایش', 'mweb' ),
				//'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'box_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .term-description-wrap"' => 'color: {{VALUE}}'
				]
			]
		);
		
		/* $this->add_control(
			'box_bgcolor',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .term-description-wrap' => 'background-color: {{VALUE}}',
				]
			]
		); */
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'boxdc_typography',
				'selector' => '{{WRAPPER}} .term-description',
			]
		);
		
		$this->add_control(
			'boxdc_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .term-description-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'boxdc_shadow',
				'selector' => '{{WRAPPER}} .term-description-wrap',
			]
		);

		$this->end_controls_section();
		
		
	}
	
	protected function render() {
	
		$settings = $this->get_settings_for_display();
		
		ob_start();
		/**
		 * Hook: woocommerce_archive_description.
		 *
		 * @hooked woocommerce_taxonomy_archive_description - 10
		 * @hooked woocommerce_product_archive_description - 10
		 */
		do_action( 'woocommerce_archive_description' );
		$my_desc = ob_get_clean();

		if( !empty( $my_desc ) ){ 
			echo '<div class="term-description-wrap">';
				echo $my_desc;
				echo '<div class="loadmore">اطلاعات بیشتر ...</div>';
			echo '</div>';
		} 
				
	}
	
	protected function content_template() {
		
	}
}




/**
 * Elementor Woocommerce Product Brand
 * @since 1.0.0
 */
class My_Woo_Product_Brand extends Widget_Base {

	
	public function get_name() {
		return 'mweb-product-brand';
	}
	
	public function get_title() {
		return __( 'برند محصول', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-meta-data';
	}

	public function get_categories() {
		return [ 'digiland_woo' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تنظیمات', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		
		$this->add_control(
			'view_type',
			[
				'label' => __( 'نوع نمایش', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'thumb',
				'options' => [
					'thumb' => __( 'عکس', 'mweb' ),
					'title' => __( 'عنوان', 'mweb' ),
					'both' => __( 'هر دو', 'mweb' ),
				]
			]
		);
		
		$this->add_control(
			'view_vertically',
			[
				'label' => __( 'تراز عمودی', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'prefix_class' => 'elementor-product-brand-v--',
				'condition' => [ 'view_type' => 'both' ]
			]
		);
		
		$this->add_control(
			'brand_text_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .el_product_brand span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'brand_text_typography',
				'label' => __( 'تایپوگرافی', 'mweb' ),
				'selector' => '{{WRAPPER}} .el_product_brand span',
			]
		);
		
		$this->add_control(
			'brand_icon_size',
			[
				'label' => __( 'اندازه عکس برند', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .el_product_brand img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'brand_icon_space',
			[
				'label' => __( 'فاصله خارجی عکس', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .el_product_brand img' => 'margin-left: {{SIZE}}{{UNIT}}',
				],
			]
		);
		
		$this->add_control(
			'brand_icon_radius',
			[
				'label' => __( 'گوشه های مدور عکس', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .el_product_brand img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'brand_icon_shadow',
				'label' => __( 'سایه عکس', 'mweb' ),
				'selector' => '{{WRAPPER}} .el_product_brand img',
			]
		);
		
		
		$this->end_controls_section();
		


	}

	
	protected function render() {
	
		global $product;
		$product = wc_get_product();

		if ( empty( $product ) ) {
			return;
		}
		
		$settings = $this->get_settings_for_display();
		$tax_name = apply_filters('mweb_product_brand_taxonomy', 'product_brand');
		$brands = get_the_terms(get_the_ID(), $tax_name);
		$brand = isset($brands[0]) ? $brands[0] : null;
			if(!is_object($brand))
				return false;
		
		echo '<div class="el_product_brand">';
			echo '<a href="'. get_term_link($brand->slug, $tax_name) .'" title="برند : '. $brand->name .'" data-toggle="tooltip">';
			if($settings['view_type'] == 'thumb' || $settings['view_type'] == 'both'){
				if ($imageURL = wp_get_attachment_image_url(get_term_meta($brand->term_id, 'thumbnail_id', true), 'thumbnail')) : 
					echo '<img src="'.$imageURL.'">';
				 endif;
			}
			
			if($settings['view_type'] == 'title' || $settings['view_type'] == 'both'){
				echo '<span>'. $brand->name .'</span>';
			}
			echo '</a>';
		echo '</div>';
	
	}

	
	protected function content_template() {
		
		
	}
}





/**
 * Elementor Module Get Seller Product
 * @since 1.0.0
 */
class Block_Seller_Name extends Widget_Base {

	
	public function get_name() {
		return 'bk-dk-seller';
	}

	
	public function get_title() {
		return __( 'نام فروشگاه یا فروشنده', 'mweb' );
	}

	
	public function get_icon() {
		return 'eicon-my-account';
	}

	
	public function get_categories() {
		return [ 'digiland_woo' ];
	}


	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تنظیمات', 'mweb' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'عنوان', 'mweb' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'فروشـنده',
			]
		);
		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'استایل', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'تایپوگرافی عنوان', 'mweb' ),
				'selector' => '{{WRAPPER}} .product_seller_name',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'رنگ عنوان', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product_seller_name span' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'icon_size',
			[
				'label' => __( 'اندازه آیکن', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 22,
				],
				'selectors' => [
					'{{WRAPPER}} .product_seller_name svg' => 'width: {{SIZE}}{{UNIT}};',
				]
			]
		);
		
		
		$this->end_controls_section();
	
			
	}
	

	
	protected function render() {
		$settings = $this->get_settings_for_display();
		
		if( is_dokan_activated() ){
			echo '<div class="product_seller_name"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#shop"></use></svg><span>'.$settings['title'].' : </span>'.sprintf( '<a href="%s">%s</a>', esc_url( dokan_get_store_url( get_the_author_meta('ID') ) ), esc_attr( get_the_author() ) ).'</div>';
		} else {
			echo '<div class="product_seller_name"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#shop"></use></svg><span>'.$settings['title'].' : </span>'. get_the_author() .'</div>';
		}
			
	}
	
	
	protected function content_template() {

	}
}






/**
 * Elementor Module Block Title
 * @since 1.0.0
 */
class Block_title extends Widget_Base {

	
	public function get_name() {
		return 'bk-title';
	}

	
	public function get_title() {
		return __( 'عنوان بلاک', 'mweb' );
	}

	
	public function get_icon() {
		return 'eicon-editor-h1';
	}

	
	public function get_categories() {
		return [ 'digiland', 'digiland_woo' ];
	}


	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تنظیمات', 'mweb' ),
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
			'url_text',
			[
				'label' => __( 'متن لینک', 'mweb' ),
				'type' => Controls_Manager::TEXT,
			]
		);
	
		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'استایل', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
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
	
			
	}
	

	
	protected function render() {
		$settings = $this->get_settings_for_display();
		
		//check title
		if ( empty( $settings['title'] ) ) {
			return false;
		}

		
		$block_icon = '';
		if ( !empty( $settings['title_picon'] ) ) {
			$block_icon = $settings['title_picon'];
		}

		$str = '';
		$str .= '<div class="block-title'.(empty($settings['title_url']['url']) ? '':' has_url').'"><div class="title">'.$block_icon;
		$str .= $settings['title'];
		$str .= '</div>';
		if( !empty($settings['title_url']['url']) ){
			$target = $settings['title_url']['is_external'] == 'on' ? ' target="_blank"' : '';
			$rel_a = $settings['title_url']['nofollow'] == 'on' ? ' rel="nofollow"' : '';
			$str .= '<a href="' . esc_url( $settings['title_url']['url'] ) . '" class="bk_view_more"'.$target.$rel_a.' title="' . esc_attr( $settings['url_text'] ) . '"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-left-1"></use></svg>'.$settings['url_text'].'</a>';
		}
		$str .= '</div>';

		echo $str;
			
	}
	
	
	protected function content_template() {

	}
}







/**
 * Elementor Module Block Title
 * @since 1.0.0
 */
class Block_Coupon extends Widget_Base {

	
	public function get_name() {
		return 'block-coupon';
	}

	
	public function get_title() {
		return __( 'کوپن تخفیف', 'mweb' );
	}

	
	public function get_icon() {
		return 'eicon-select';
	}

	
	public function get_categories() {
		return [ 'digiland', 'digiland_woo' ];
	}


	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تنظیمات', 'mweb' ),
			]
		);
		
		$this->add_control(
			'coupon_id',
			[
				'label' => __( 'شناسه کوپن', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
			]
		);
		
		$this->add_control(
			'el_photo',
			[
				'label' => __( 'تصویر شاخص', 'mweb' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				]
			]
		);
		
		$this->add_control(
			'قم_padding',
			[
				'label' => __( 'فاصله داخلی', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .product__coupon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'elm_border',
				'selector' => '{{WRAPPER}} .product__coupon, {{WRAPPER}} .product__coupon .divider:after, {{WRAPPER}} .product__coupon .divider:before',
			]
		);

		$this->add_control(
			'elm_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .product__coupon, {{WRAPPER}} .product__coupon .thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'elm_box_shadow',
				'selector' => '{{WRAPPER}} .product__coupon',
			]
		);
		
		$this->add_control(
			'title_bgcolor',
			[
				'label' => __( 'رنگ پس زمینه جداکننده', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product__coupon .divider:after, {{WRAPPER}} .product__coupon .divider:before' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'coupon_dashed_color',
			[
				'label' => __( 'رنگ خط چین', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product__coupon .divider' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'types' => [ 'classic', 'gradient' ],
				//'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .product__coupon',
			]
		);
		
		
		$this->add_control(
			'heading_panel_1',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'عنوان', 'mweb' ),
				'separator' => 'before',
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'coupon_title_typography',
				'label' => __( 'تایپوگرافی عنوان', 'mweb' ),
				'selector' => '{{WRAPPER}} .product__coupon .title',
			]
		);

		$this->add_control(
			'coupon_title_color',
			[
				'label' => __( 'رنگ عنوان', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product__coupon .title' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'coupon_desc_typography',
				'label' => __( 'تایپوگرافی زیر عنوان', 'mweb' ),
				'selector' => '{{WRAPPER}} .product__coupon .offer',
			]
		);

		$this->add_control(
			'coupon_desc_color',
			[
				'label' => __( 'رنگ زیر عنوان', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product__coupon .offer' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'heading_panel_2',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'وضعیت', 'mweb' ),
				'separator' => 'before',
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'coupon_position_typography',
				'label' => __( 'تایپوگرافی وضعیت', 'mweb' ),
				'selector' => '{{WRAPPER}} .product__coupon .state',
			]
		);

		$this->add_control(
			'coupon_position_color',
			[
				'label' => __( 'رنگ وضعیت', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product__coupon .state' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'heading_panel_3',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'کدت خفیف', 'mweb' ),
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'coupon_code_color',
			[
				'label' => __( 'رنگ متن کد', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product__coupon .coupon_code' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'coupon_codebg_color',
			[
				'label' => __( 'رنگ پس زمینه کد', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product__coupon .coupon_code' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'coupon_codeborder_color',
			[
				'label' => __( 'رنگ حاشیه کد', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product__coupon .coupon_code' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'heading_panel_4',
			[
				'type' => Controls_Manager::HEADING,
				'label' => __( 'شمارنده', 'mweb' ),
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'coupon_counter_color',
			[
				'label' => __( 'رنگ متن شمارنده', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product__coupon .product-date' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'coupon_counterborder_color',
			[
				'label' => __( 'رنگ حاشیه شمارنده', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product__coupon .product-date>div' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		

		
		
		$this->end_controls_section();
	
			
	}
	

	
	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$coupon = new \WC_Coupon($settings['coupon_id']);
		
		if ( 0 === $coupon->get_id() ) 
			return false;

		?>
		<div class="product__coupon">
			<div class="divider"></div>
			<div class="right">
				<?php if( !empty($settings['el_photo']['url']) ){ ?>
				<div class="thumb"><img src="<?= esc_url( $settings['el_photo']['url'] ) ?>"></div>
				<?php } ?>
				<div class="content">
					<?php if( !empty($coupon->get_description()) ) 
						echo '<h5 class="title">'.$coupon->get_description().'</h5>';
						echo '<div class="offer '.$coupon->get_discount_type().'"><span>'.$coupon->get_amount().'</span><strong>'. ($coupon->get_discount_type() == 'percent' ? '%' : 'تومان' ) .'</strong> تخفیف</div>';
						echo $coupon->get_date_expires() ? '<div class="product-date" data-date="'. date( 'Y-m-d H:i:s', $coupon->get_date_expires()->getTimestamp() ) .'"></div>' : '';
					?>
														

				</div>
			</div>
			<div class="left">
				<div class="state">وضعیت<?= $coupon->is_valid() ? '<span>فعـال</span>' : '<span class="inactive">منقضـی شده</span>' ?></div>
				<input class="coupon_code" value="<?= $coupon->get_code() ?>" readonly />
			</div>
		</div>
		
		<?php
		
			
	}
	
	
	protected function content_template() {

	}
}
