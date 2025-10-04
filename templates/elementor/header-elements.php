<?php
namespace ElementorMahdisweb\Widgets;


use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


/**
 * Elementor Header Logo
 * @since 1.0.0
 */
class My_Header_Logo extends Widget_Base {

	
	public function get_name() {
		return 'my-header-logo';
	}
	
	public function get_title() {
		return __( 'لوگو', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-site-logo';
	}

	public function get_categories() {
		return [ 'digiland_header' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'لوگو', 'mweb' ),
			]
		);

		$this->add_control(
			'logo',
			[
				'label' => __( 'آپلود لوگو', 'mweb' ),
				'type' => Controls_Manager::MEDIA,
				'description' => 'رها کردن = پیشفرض تنظیمات پوسته'
			]
		);
		
		$this->add_control(
			'link',
			[
				'label' => __( 'لینک', 'mweb' ),
				'type' => Controls_Manager::URL,
				'show_external' => false,
				'placeholder' => __( 'https://your-link.com', 'mweb' ),
				'description' => 'رها کردن = پیشفرض آدرس سایت'
			]
		);
		
		$this->add_control(
			'width',
			[
				'label' => __( 'عرض', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'em' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .logo img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'max_height',
			[
				'label' => __( 'حداکثر ارتفاع', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .logo img' => 'max-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'align',
			[
				'label' => __( 'چیدمان', 'mweb' ),
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
				'default' => 'center',
				'toggle' => true,
			]
		);

		$this->end_controls_section();
		


	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$logo = empty( $settings['logo'] ) ? \mweb_theme_util::get_theme_option('mweb_logo','id') : $settings['logo']['id'];
		$link = empty( $settings['link']['url'] ) ? home_url( '/' ) : $settings['link']['url'];
		
		//print_r(\mweb_theme_util::get_theme_option('mweb_logo'));
		?>
		<div class="logo elm_logo align_<?= $settings['align'] ?>" <?php \mweb_theme_schema::makeup('logo'); ?>>
			<a href="<?php echo esc_url($link); ?>" title="<?php bloginfo( 'name' ); ?>">
					<?php if ( !empty($logo) ): 
					$image_attributes = wp_get_attachment_image_src( $settings['logo']['id'], 'full' ); ?>
					<img src="<?php echo esc_url($image_attributes[0]); ?>"  width="<?php echo $image_attributes[1]; ?>" height="<?php echo $image_attributes[2]; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" <?php \mweb_theme_schema::makeup('image'); ?>>
					<?php else : ?>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" <?php \mweb_theme_schema::makeup('image'); ?>>
					<?php endif; ?>
			</a>	
			<meta itemprop="name" content="<?php bloginfo( 'name' ) ?>">
		</div>
		<?php
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * @access protected
	 */
	protected function content_template() {
		
	}
}




/**
 * Elementor Header Search
 * @since 1.0.1
 */
class My_Header_Search extends Widget_Base {

	
	public function get_name() {
		return 'my-header-search';
	}
	
	public function get_title() {
		return __( 'جستجو', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-search';
	}

	public function get_categories() {
		return [ 'digiland_header' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'جستجو', 'mweb' ),
			]
		);
		
		$this->add_control(
			'title_placeholder',
			[
				'label' => __( 'متن نگه دارنده', 'mweb' ),
				'type' => Controls_Manager::TEXT,
				'description' => 'کلید واژه مورد نظر ...'
			]
		);


		$this->add_control(
			'type_search',
			[
				'label' => __( 'نوع', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'elm_one'   => __( 'ثابت', 'mweb' ),
					'elm_two'   => __( 'بازشو', 'mweb' ),
				],
				'default' => 'elm_one',
				'description' => ''
			]
		);

		$this->add_control(
			'el_color',
			[
				'label' => __( 'رنگ پس زمینه جستجو', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} form.elm_search' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} form.search_wrap input' => 'background-color: {{VALUE}}',
				],
				'condition' => [ 'type_search' => ['elm_one'] ],
			]
		);
		$this->add_control(
			'el_color_text',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} form.search_wrap input' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'el_color_placeholder',
			[
				'label' => __( 'رنگ متن نگه دارنده', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} form.search_wrap input::-ms-input-placeholder' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} form.search_wrap input::-ms-input-placeholder' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} form.search_wrap input::-webkit-input-placeholder' => 'color: {{VALUE}} !important',
				],
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
					'{{WRAPPER}}' => 'text-align: {{VALUE}}',
				],
				'condition' => [ 'type_search' => ['elm_two'] ],
			]
		);
		
		$this->add_control(
			'btn_color',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hs_search_btn svg' => 'stroke: {{VALUE}}',
					'{{WRAPPER}} form.search_wrap .search_icon svg' => 'stroke: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'btn_cat_color',
			[
				'label' => __( 'رنگ آیکن دسته بندی', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn_search_cat.el_cat_icon svg' => 'stroke: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'btn_bg_color',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hs_search_btn' => 'background-color: {{VALUE}}',
				],
				'condition' => [ 'type_search' => ['elm_two'] ],
			]
		);
		
		$this->add_control(
			'btn_color_hover',
			[
				'label' => __( 'رنگ آیکن هاور', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hs_search_btn:hover svg' => 'stroke: {{VALUE}}',
					'{{WRAPPER}} .elm_search:hover .search_icon svg, {{WRAPPER}} .elm_search:focus .search_icon svg' => 'stroke: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'btn_bg_color_hover',
			[
				'label' => __( 'رنگ پس زمینه هاور', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hs_search_btn:hover' => 'background-color: {{VALUE}}',
				],
				'condition' => [ 'type_search' => ['elm_two'] ],
			]
		);

		$this->add_control(
			'btn_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .hs_search_btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} form.elm_search' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'btn_padding',
			[
				'label' => __( 'فاصله داخلی', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .hs_search_btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} form.elm_search' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'btn_margin',
			[
				'label' => __( 'فاصله خارجی', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .hs_search_btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 'type_search' => ['elm_two'] ],
			]
		);
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'btn_box_shadow',
				'label' => __( 'سایه', 'mweb' ),
				'selector' => '.hs_search_btn',
				'condition' => [ 'type_search' => ['elm_two'] ],
			]
		);
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'btn_box_shadow_one',
				'label' => __( 'سایه', 'mweb' ),
				'selector' => 'form.elm_search',
				'condition' => [ 'type_search' => ['elm_one'] ],
			]
		);
		
		$this->add_control(
			'input_font_size',
			[
				'label' => __( 'اندازه فونت متن', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'min' => 8,
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
					'size' => 11,
				],
				'selectors' => [
					'{{WRAPPER}} form.elm_search input' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
	
		$this->add_control(
			'btn_icon_size',
			[
				'label' => __( 'اندازه آیکن', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'em' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 24,
				],
				'selectors' => [
					'{{WRAPPER}} .hs_search_btn svg' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 'type_search' => ['elm_two'] ],
			]
		);
		
		$this->add_responsive_control(
			'btn_height',
			[
				'label' => __( 'ارتفاع', 'mweb' ),
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
					'{{WRAPPER}} .hs_search_btn' => 'height: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} form.search_wrap' => 'height: {{SIZE}}{{UNIT}}',
				
				],
			]
		);
		
		$this->add_responsive_control(
			'btn_lineheight',
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
					'{{WRAPPER}} .hs_search_btn' => 'line-height: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} form.elm_search' => 'line-height: {{SIZE}}{{UNIT}}',
				
				]
			]
		);
		
		$this->add_control(
			'font_family',
			[
				'label' => __( 'خانواده فونت', 'mweb' ),
				'type' => Controls_Manager::FONT,
				'selectors' => [
					'{{WRAPPER}} .search_wrap' => 'font-family: {{VALUE}}',
					'{{WRAPPER}} form.search_wrap input' => 'font-family: {{VALUE}}',
					'{{WRAPPER}} .post_with_thumb .inner a' => 'font-family: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'hide_filter',
			[
				'label' => __( 'مخفی کردن دسته بندی', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بلی', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
	

		$this->end_controls_section();
	
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * @access protected
	 */
	protected function render() {
		
		$settings = $this->get_settings_for_display();
		$hide = $settings['hide_filter'] == 'yes' ? true : false;
		if( $settings['type_search'] == 'elm_one' ): 		
			echo mweb_render_search_form( 'elm_search', $settings['title_placeholder'], $hide );
		 else: ?>
			<div class="hs_icon hs_search_btn"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#search"></use></svg></div>
			<div class="search_overlay">
				<div class="search_toggle"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#close-circle"></use></svg></div>
				<?php echo mweb_render_search_form( '', $settings['title_placeholder'], $hide); ?>
			</div>
		<?php endif; 
		
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * @access protected
	 */
	protected function content_template() {
		
	}
}




/**
 * Elementor Header Cart
 * @since 1.0.1
 */
class My_Header_Cart extends Widget_Base {

	
	public function get_name() {
		return 'my-header-cart';
	}
	
	public function get_title() {
		return __( 'سبد خرید', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-cart-light';
	}

	public function get_categories() {
		return [ 'digiland_header' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'سبد خرید', 'mweb' ),
			]
		);
		
		$this->add_control(
			'type',
			[
				'label' => __( 'نوع', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'square'  => __( 'مربع', 'mweb' ),
					'rectangle' => __( 'مستطیل', 'mweb' ),
					'rectangle_o' => __( 'مستطیل دوم', 'mweb' ),
					'rectangle_s' => __( 'مستطیل سوم', 'mweb' ),
					'vertical' => __( 'عمودی', 'mweb' ),
				],
				'default' => 'square',				

			]
		);
		
		$this->add_control(
			'cart_icon',
			[
				'label' => __( 'آیکن', 'mweb' ),
				'type' => 'iconpicker',
			]
		);
		
		$this->add_control(
			'btn_cart_icon_size',
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
					'{{WRAPPER}} .top_icons.shop_cart svg' => 'width: {{SIZE}}{{UNIT}}',
				]
			]
		);


		$this->add_control(
			'icon_margin',
			[
				'label' => __( 'فاصله خارجی آیکن', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .top_icons.shop_cart svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_cart_typography',
				'label' => __( 'تایپوگرافی', 'mweb' ),
				'selector' => '{{WRAPPER}} .top_icons.shop_cart .top_cart_title',
			]
		);
		
		
		$this->add_control(
			'cart_padding',
			[
				'label' => __( 'فاصله داخلی متن', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .top_icons.shop_cart .top_cart_title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 'type!' => ['square'] ],
			]
		);
				
		$this->add_control(
			'btn_cart_width',
			[
				'label' => __( 'عرض', 'mweb' ),
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
					'{{WRAPPER}} .top_icons.shop_cart' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);
		
		$this->add_control(
			'btn_cart_height',
			[
				'label' => __( 'ارتفاع', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 39,
				],
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
					'{{WRAPPER}} .top_icons.shop_cart' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);
		
		$this->add_responsive_control(
			'btn_lineheight',
			[
				'label' => __( 'ارتفاع خط', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 43,
				],
				'range' => [
					'px' => [
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .top_icons.shop_cart' => 'line-height: {{SIZE}}{{UNIT}}',
				
				],
				'condition' => [ 'type' => ['square'] ],
			]
		);
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'btn_cart_box_shadow',
				'selector' => '{{WRAPPER}} .top_icons.shop_cart',
			]
		);
		
		$this->add_control(
			'btn_cart_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .top_icons.shop_cart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			'text_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .top_icons.shop_cart>a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .top_icons.shop_cart>a svg' => 'fill: {{VALUE}}; stroke: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .top_icons.shop_cart',
				'condition' => [ 'type!' => 'vertical' ]
			]
		);
		
		$this->add_control(
			'counter_color',
			[
				'label' => __( 'رنگ متن تعداد', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shop_cart a .shop-badge' => 'color: {{VALUE}}',
				]
			]
		);
		
		$this->add_control(
			'counter_bg',
			[
				'label' => __( 'رنگ پس زمینه تعداد', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shop_cart a .shop-badge' => 'background-color: {{VALUE}}',
				]
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab( 'items_style_hover',
			[
				'label' => __( 'حالت هاور', 'mweb' ),
			]
		);

		$this->add_control(
			'text_color_hover',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .top_icons.shop_cart:hover>a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .top_icons.shop_cart:hover>a svg' => 'fill: {{VALUE}}; stroke: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_hover',
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .top_icons.shop_cart:hover',
				'condition' => [ 'type!' => 'vertical' ]
			]
		);
		
		$this->add_control(
			'counter_color_hover',
			[
				'label' => __( 'رنگ متن تعداد', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shop_cart:hover a .shop-badge' => 'color: {{VALUE}}',
				]

			]
		);
		
		$this->add_control(
			'counter_bg_hover',
			[
				'label' => __( 'رنگ پس زمینه تعداد', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shop_cart:hover a .shop-badge' => 'background-color: {{VALUE}}',
				]
			]
		);
		
		$this->add_control(
			'btn_transition',
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
					'{{WRAPPER}} .shop_cart' => 'transition: all {{SIZE}}s',
				],
			]
		);
		

		$this->end_controls_tab();
		
		$this->end_controls_tabs();
		
		
		$this->add_control(
			'cart_is_left',
			[
				'label' => __( 'تراز چپ محتویات سبد', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'prefix_class' => 'elementor-header-cart-left-',
			]
		);
		
		$this->add_control(
			'counter_border_radius',
			[
				'label' => __( 'گوشه های مدور تعداد', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .shop_cart .shop-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'counter_font_size',
			[
				'label' => __( 'اندازه فونت تعداد', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .shop_cart .shop-badge' => 'font-size: {{SIZE}}{{UNIT}}',
				],
				'condition' => [ 'type' => 'rectangle_s' ]

			]
		);
		
		
		$this->add_control(
			'counter_left_center',
			[
				'label' => __( 'تراز چپ-وسط تعداد', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'prefix_class' => 'elementor-header-cart-counter-outside-',
				'condition' => [ 'type!' => ['rectangle_s', 'vertical'] ]
			]
		);
		
		$this->add_control(
			'counter_border_color',
			[
				'label' => __( 'رنگ حاشیه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .shop_cart .shop-badge' => 'border-color: {{VALUE}}',
				],
				'condition' => [ 'counter_left_center' => 'yes' ]
			]
		);
		
		
	

		$this->end_controls_section();

		
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$btn_icon = '';
		if( !empty($settings['cart_icon']) )
			$btn_icon = $settings['cart_icon'];
		
		if( $settings['type'] == 'square' ) :
		?>
			<div class="top_icons shop_cart get_sidebar elm_cart_s" data-class="open_cart_sidebar"> <a class="head_cart_total" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="مشاهده سبد خرید"> <span class="shop-badge header-cart-count"><?php echo sprintf (_n( '%d ', '%d ', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?></span><?= $btn_icon; ?></a>
				<?php get_template_part( 'templates/header/module', 'cart' ); ?>
			</div>
		<?php
		elseif( $settings['type']== 'vertical'):
		?>
		<div class="top_icons shop_cart get_sidebar elm_cart_s elm_cart_v" data-class="open_cart_sidebar"> <a class="head_cart_total" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="مشاهده سبد خرید"> <span class="shop-badge header-cart-count"><?php echo sprintf (_n( '%d ', '%d ', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?></span><?= $btn_icon; ?><strong class="top_cart_title">سبد خرید</strong></a>
			<?php get_template_part( 'templates/header/module', 'cart' ); ?>
		</div>
		<?php
		else:
		$cart_class = '';
		if( $settings['type'] == 'rectangle_o' )
			$cart_class .= ' hide_bg';
		if( $settings['type'] == 'rectangle_s' )
			$cart_class .= ' elm_cart_rs';
		?>
			<div class="top_icons shop_cart fullwidth_shop_cart get_sidebar elm_cart_r<?= $cart_class ?>" data-class="open_cart_sidebar"> <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="مشاهده سبد خرید"> <div class="top_cart_title" >سبد خرید <span class="shop-badge"><?php echo sprintf (_n( '%d ', '%d ', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?></span></div><?= $btn_icon; ?></a>
				<?php get_template_part( 'templates/header/module', 'cart' ); ?>
			</div>		
		<?php
		endif;
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * @access protected
	 */
	protected function content_template() {
		
	}
}




/**
 * Elementor Header Button
 * @since 1.0.0
 */
class My_Header_Button extends Widget_Base {

	
	public function get_name() {
		return 'my-header-button';
	}
	
	public function get_title() {
		return __( 'آیکن / دکمه', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-button';
	}

	public function get_categories() {
		return [ 'digiland_header' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'دکمه', 'mweb' ),
			]
		);
		
		$this->add_control(
			'title',
			[
				'label' => __( 'عنوان', 'mweb' ),
				'type' => Controls_Manager::TEXT,
				'description' => 'جهت نمایش آیکن تنها این فیلد را خالی رها کنید'
			]
		);
		
		$this->add_control(
			'myicon',
			[
				'label' => __( 'آیکن', 'mweb' ),
				'type' => 'iconpicker',
			]
		);
				
		$this->add_control(
			'icon_size',
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
					'{{WRAPPER}} .elm_btn_c svg' => 'width: {{SIZE}}{{UNIT}}',
				]
			]
		);
		
		$this->add_control(
			'icon_margin',
			[
				'label' => __( 'فاصله خارجی آیکن', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elm_btn_c svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
				'label' => __( 'تایپوگرافی', 'mweb' ),
				'selector' => '{{WRAPPER}} .elm_btn_c',
			]
		);
		
		$this->add_control(
			'icon_padding',
			[
				'label' => __( 'فاصله داخلی', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elm_btn_c' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
			
		$this->add_control(
			'border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elm_btn_c' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'btn_box_shadow',
				'selector' => '{{WRAPPER}} .elm_btn_c',
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
			'btnu_align_vertical',
			[
				'label' => __( 'تراز عمودی دکمه', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'prefix_class' => 'elementor-header-btn-align-vertical-',
			]
		);
		
		
		$this->start_controls_tabs( 'items_style_tabs' );

		$this->start_controls_tab( 'items_style_normal',
			[
				'label' => __( 'حالت نرمال', 'mweb' ),
			]
		);
		
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elm_btn_c svg' => 'stroke: {{VALUE}}; fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elm_btn_c' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'background',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elm_btn_c' => 'background-color: {{VALUE}}',
				]
			]
		);
		

		$this->end_controls_tab();

		$this->start_controls_tab( 'items_style_hover',
			[
				'label' => __( 'حالت هاور', 'mweb' ),
			]
		);

		$this->add_control(
			'icon_color_hover',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elm_btn_c:hover svg' => 'stroke: {{VALUE}}; fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'text_color_hover',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elm_btn_c:hover' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'background_hover',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elm_btn_c:hover' => 'background-color: {{VALUE}}',
				]
			]
		);
		
		$this->add_control(
			'btn_transition',
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
					'{{WRAPPER}} .elm_btn_c' => 'transition: all {{SIZE}}s',
				],
			]
		);

		$this->end_controls_tab();
		
		$this->end_controls_tabs();
		
		
		$this->add_control(
			'is_login',
			[
				'label' => __( 'نمایش مخصوص اعضا', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بلی', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'is_guest',
			[
				'label' => __( 'نمایش مخصوص مهمان', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بلی', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'hover_animation',
			[
				'label' => esc_html__( 'انیمیشن هاور', 'mweb' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);
	

		$this->end_controls_section();

		
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		
			if( !is_user_logged_in() && $settings['is_login'] === 'yes' ){
				return false;
			}
			
			if( is_user_logged_in() && $settings['is_guest'] === 'yes' ){
				return false;
			}
			
			$class = 'elm_btn_c';
			if( !empty($settings['title']) )
				$class .= ' auto_width';
			
			if ( $settings['hover_animation'] ) {
				$class .= ' elementor-animation-' . $settings['hover_animation'];
			}
			$this->add_render_attribute( 'wrapper', 'class', $class );
			
			
			
			if( !empty($settings['link']['url']) ){
				$target = $settings['link']['is_external'] ? ' target="_blank"' : '';
				$nofollow = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
				echo '<a '. $this->get_render_attribute_string( 'wrapper' ) .' href="' . esc_url( $settings['link']['url'] ) . '" title="' . esc_attr( $settings['title'] ) . '" ' . $target . $nofollow . '>';
			}else{
				echo '<div '. $this->get_render_attribute_string( 'wrapper' ) .'>';
			}
			
			if( !empty($settings['myicon']) ){
				echo $settings['myicon'];
			}
			if( !empty($settings['title']) )
				echo '<span>'.$settings['title'].'</span>';
			
			if( !empty($settings['link']['url']) ){
				echo '</a>';
			}else{
				echo '</div>';
			}		
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * @access protected
	 */
	protected function content_template() {
		
	}
}




/**
 * Elementor Header User
 * @since 1.0.0
 */
class My_Header_User extends Widget_Base {

	
	public function get_name() {
		return 'my-header-user';
	}
	
	public function get_title() {
		return __( 'ورود و عضویت', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-site-identity';
	}

	public function get_categories() {
		return [ 'digiland_header' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'ورود و عضویت', 'mweb' ),
			]
		);
		
		$this->add_control(
			'type',
			[
				'label' => __( 'نوع', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'is_icon'  => __( 'آیکن', 'mweb' ),
					'is_text' => __( 'متن', 'mweb' ),
				],
				'default' => 'is_icon',
			]
		);
		
		$this->add_control(
			'text_in',
			[
				'label' => __( 'متن قبل ورود', 'mweb' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'ورود / عضویت', 'mweb' ),
				'condition' => [ 'type' => 'is_text' ]
			]
		);
		
		$this->add_control(
			'text_out',
			[
				'label' => __( 'متن بعد ورود', 'mweb' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'خوش آمدید %s', 'mweb' ),
				'description' => 'از %s به عنوان نام کاربر استفاده می شود.',
				'condition' => [ 'type' => 'is_text' ]
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
				'label' => __( 'تایپوگرافی', 'mweb' ),
				'selector' => '{{WRAPPER}} .elm_user_btn',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elm_user_btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'btn_padding',
			[
				'label' => __( 'فاصله داخلی', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elm_user_btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'btn_box_shadow',
				'selector' => '{{WRAPPER}} .elm_user_btn',
			]
		);
		
		$this->add_control(
			'show_icon',
			[
				'label' => __( 'نمایش آیکن', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بلی', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [ 'type' => ['is_text'] ],
			]
		);
		
		$this->add_control(
			'icon_size',
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
					'{{WRAPPER}} .elm_user_btn svg' => 'width: {{SIZE}}{{UNIT}}',
				],
				'condition' => [ 'show_icon' => 'yes' ]
			]
		);
		
		$this->add_control(
			'icon_margin',
			[
				'label' => __( 'فاصله خارجی آیکن', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elm_user_btn svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 'show_icon' => 'yes' ]
			]
		);
	
		$this->add_control(
			'icon_in',
			[
				'label' => __( 'آیکن قبل ورود', 'mweb' ),
				'type' => 'iconpicker',
			]
		);
		
		$this->add_control(
			'icon_out',
			[
				'label' => __( 'آیکن بعد ورود', 'mweb' ),
				'type' => 'iconpicker',
			]
		);
		
		
		$this->start_controls_tabs( 'items_style_tabs' );

		$this->start_controls_tab( 'items_style_normal',
			[
				'label' => __( 'حالت نرمال', 'mweb' ),
			]
		);
		
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elm_user_btn svg' => 'stroke: {{VALUE}}; fill: {{VALUE}}',
				],
				'condition' => [ 'show_icon' => 'yes' ]
			]
		);
		
		$this->add_control(
			'color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elm_user_btn' => 'color: {{VALUE}}',
				],
				'condition' => [ 'show_icon' => 'yes' ]
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .elm_user_btn',
				'condition' => [ 'show_icon' => 'yes' ]
			]
		);

		
		$this->add_control(
			'btn_align_vertical',
			[
				'label' => __( 'تراز عمودی دکمه', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'prefix_class' => 'elementor-header-btn-align-vertical-',
			]
		);
	

		$this->end_controls_tab();

		$this->start_controls_tab( 'items_style_hover',
			[
				'label' => __( 'حالت هاور', 'mweb' ),
			]
		);

		$this->add_control(
			'icon_color_hover',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elm_user_btn:hover svg' => 'stroke: {{VALUE}}; fill: {{VALUE}}',
				],
				'condition' => [ 'show_icon' => 'yes' ]
			]
		);
		
		$this->add_control(
			'color_hover',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elm_user_btn:hover' => 'color: {{VALUE}}',
				]
			]
		);
		
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_hover',
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .elm_user_btn:hover',
				'condition' => [ 'show_icon' => 'yes' ]
			]
		);
		
		
		$this->add_control(
			'btn_transition',
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
					'{{WRAPPER}} .elm_user_btn' => 'transition: all {{SIZE}}s',
				],
			]
		);

		$this->end_controls_tab();
		
		$this->end_controls_tabs();
		
		$this->add_control(
			'show_menu',
			[
				'label' => __( 'نمایش منو کاربری', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بلی', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'user_menu_is_left',
			[
				'label' => __( 'تراز چپ منو حساب کاربری', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'prefix_class' => 'elementor-header-user-menu-left-',
			]
		);

		$this->end_controls_section();

		
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$user_text = ['<p>ورود / عضویت</p>', '<p>خوش آمدید <b>%s</b></p>'];
		
		if( !empty($settings['text_in']) )
			$user_text[0] = '<p>'.$settings['text_in'].'</p>';
		
		if( !empty($settings['text_out']) )
			$user_text[1] = '<p>'. str_replace('%s', '<b>%s</b>', $settings['text_out']).'</p>';
		
		$mweb_acc_url = \mweb_theme_util::get_theme_option('mweb_login_register_url'); 
		if( empty($mweb_acc_url) ){
			$mweb_acc_url = get_permalink( get_option('woocommerce_myaccount_page_id'));
		}
		$icon_in = !empty($settings['icon_in']) ? $settings['icon_in'] : '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#profile-tick"></use></svg>';
		$icon_out = !empty($settings['icon_out']) ? $settings['icon_out'] : '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'. mweb_print_sprites_path().'#user"></use></svg>';
		
		$btn_class = $settings['show_menu'] == 'yes' ? '' : 'elm_acc_link';
		?>
		<?php if( is_user_logged_in() ):
			  $current_user = wp_get_current_user(); ?>
			<div class="user_login elm_user_btn <?= $btn_class.' el_'.$settings['type']; ?>" data-href="<?= esc_url($mweb_acc_url); ?>">
				<?php 
					if( $settings['type'] == 'is_text' ){ 
						if( $settings['show_icon'] === 'yes' ){
							echo $icon_out;
						}
						printf( $user_text[1], $current_user->display_name );
					}elseif( $settings['type'] == 'is_icon' ){
						echo $icon_out;
					} 
					if( has_nav_menu('user-menu') && $settings['show_menu'] == 'yes' ): ?>
						<div class="my-account">
						<?php
						   wp_nav_menu( array(
								'theme_location' => 'user-menu',
								'container' => false, 
								'menu_id' => '',
								'menu_class' => 'menu'
							));
						?>
						</div>
					<?php endif; ?>
			</div>
			<?php else: ?>
				<a class="user_login login_btn elm_user_btn<?php echo ' el_'.$settings['type']; ?>" href="<?= esc_url($mweb_acc_url); ?>">
				<?php 
					if( $settings['type'] == 'is_text' ){ 
						if($settings['show_icon'] === 'yes'){
							echo $icon_in;
						}
						echo $user_text[0]; 
					}elseif( $settings['type'] == 'is_icon' ){
						echo $icon_in;
					} 
				?>
				</a>
			<?php endif; ?>
		<?php
		
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * @access protected
	 */
	protected function content_template() {
		
	}
}




/**
 * Elementor Main Menu
 * @since 1.0.0
 */
class My_Header_Menu extends Widget_Base {

	
	public function get_name() {
		return 'my-header-menu';
	}
	
	public function get_title() {
		return __( 'منو اصلی', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-menu-bar';
	}

	public function get_categories() {
		return [ 'digiland_header' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'منو اصلی', 'mweb' ),
			]
		);
		
		$this->add_control(
			'menu',
			[
				'label' => __( 'انتخاب منو', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => get_element_menus_list(),
			]
		);
		
		$this->add_responsive_control(
			'menu_alignment',
			[
				'label' => __( 'تراز منو', 'mweb' ),
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
			]
		);
		
		$this->add_control(
			'color',
			[
				'label' => __( 'رنگ منو', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mweb-main-menu ul>li.level-0>a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .mobile-nav-button' => 'color: {{VALUE}}',
				]
			]
		);
		$this->add_control(
			'hover_color',
			[
				'label' => __( 'رنگ منو هاور', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mweb-main-menu ul>li.level-0>a .caret, .mweb-main-menu ul>li.level-0>a:hover' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .mobile-nav-button a' => 'color: {{VALUE}}',
				]
			]
		);
		$this->add_control(
			'active_color',
			[
				'label' => __( 'رنگ منو فعال', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mweb-main-menu ul>li.current-menu-item>a' => 'color: {{VALUE}} !important',
				]
			]
		);
		$this->add_control(
			'color_icon',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .mweb-main-menu svg.pack-theme' => 'stroke: {{VALUE}}',
					'.woocommerce {{WRAPPER}} .mweb-main-menu svg' => 'fill: {{VALUE}}',
				]
			]
		);
		$this->add_control(
			'hover_color_icon',
			[
				'label' => __( 'رنگ آیکن هاور', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .mweb-main-menu ul>li.level-0:hover .el_icon svg.pack-theme' => 'stroke: {{VALUE}}',
					'.woocommerce {{WRAPPER}} .mweb-main-menu ul>li.level-0:hover .el_icon svg' => 'fill: {{VALUE}}',
				]
			]
		);
		$this->add_control(
			'arrow_color_icon',
			[
				'label' => __( 'رنگ علامت فلش', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .el_arrow svg.pack-theme' => 'stroke: {{VALUE}} !important',
				]
			]
		);
		$this->add_control(
			'font_family',
			[
				'label' => __( 'خانواده فونت', 'mweb' ),
				'type' => Controls_Manager::FONT,
				'selectors' => [
					'{{WRAPPER}} .mweb-main-menu' => 'font-family: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'lvl_one_size',
			[
				'label' => __( 'اندازه فونت سطح یک', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
					'size' => 13,
				],
				'range' => [
					'px' => [
						'min' => 12,
						'max' => 30,
						'step' => 1,
					],
				],
				'selectors' => [
					'.woocommerce {{WRAPPER}} .mweb-main-menu ul>li.level-0>a' => 'font-size: {{SIZE}}{{UNIT}}',
					'.mobile-nav-button a' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_control(
			'lvl_two_size',
			[
				'label' => __( 'اندازه فونت سطح دو', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
					'size' => 12,
				],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 30,
						'step' => 1,
					],
				],
				'selectors' => [
					'.woocommerce {{WRAPPER}} .mweb-main-menu ul>li.level-0 div.sub-menu li a' => 'font-size: {{SIZE}}{{UNIT}}',
					'.woocommerce {{WRAPPER}} .mweb-main-menu ul>li.level-0>ul.sub-menu li a' => 'font-size: {{SIZE}}{{UNIT}}'
				],
			]
		);
		$this->add_control(
			'item_icon_size',
			[
				'label' => __( 'اندازه آیکن سطح یک', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
					'size' => 25,
				],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'.woocommerce {{WRAPPER}} .mweb-main-menu ul>li.level-0>a>.el_icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
				],
			]
		);
		
		$this->add_control(
			'item_padding_side',
			[
				'label' => __( 'فاصله داخلی چپ و راست سطح اول', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 50,
						'step' => 1,
					],
				],
				'selectors' => [
					'.woocommerce {{WRAPPER}} .mweb-main-menu ul>li.level-0' => 'padding: 0px {{SIZE}}{{UNIT}}',
				],
			]
		);
		
		$this->add_control(
			'icon_in_center',
			[
				'label' => __( 'آیکن سطر اول عمودی', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'prefix_class' => 'elementor-menu-icon-vertical-',
			]
		);
		
		$this->add_control(
			'item_height',
			[
				'label' => __( 'ارتفاع سطح یک', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'default' => [
					'unit' => 'px',
					'size' => 49,
				],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mweb-main-menu ul>li.level-0' => 'height: {{SIZE}}{{UNIT}}',
				],
				'condition' => [ 'icon_in_center' => 'yes' ]
			]
		);
		
		$this->add_control(
			'item_line_height',
			[
				'label' => __( 'ارتفاع خط سطح یک', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'default' => [
					'unit' => 'px',
					'size' => 49,
				],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mweb-main-menu ul>li.level-0' => 'line-height: {{SIZE}}{{UNIT}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'item_box_shadow',
				'label' => __( 'سایه منو فعال', 'mweb' ),
				'selector' => '{{WRAPPER}} .mweb-main-menu ul>li.level-0.current-menu-parent, {{WRAPPER}} .mweb-main-menu ul>li.level-0.current-menu-item',
			]
		);
		
		$this->add_responsive_control(
			'mobile_alignment',
			[
				'label' => __( 'تراز افقی دکمه منو موبایل', 'mweb' ),
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
					'{{WRAPPER}} .mobile-nav-button' => 'text-align: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'menu_vertical_align',
			[
				'label' => __( 'منو عمودی', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'prefix_class' => 'right_menu elm_mneu_r-',
				'condition' => [ 'icon_in_center!' => 'yes' ]
			]
		);
		
		$this->add_control(
			'mneu_item_show',
			[
				'label' => __( 'نوع', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'both'   => __( 'هر دو', 'mweb' ),
					'main_menu'   => __( 'منو اصلی', 'mweb' ),
					'mobile_menu'   => __( 'منو همبرگری(موبایل)', 'mweb' ),
				],
				'default' => 'both',
				'description' => 'صرفا برای جداسازی آیکن همبرگری منو ریسپانسیو'
			]
		);
		
		$this->add_control(
			'menu_hm_only_icon',
			[
				'label' => __( 'فقط نمایش آیکن', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'prefix_class' => 'elm_menu_hm-',
				'condition' => [ 'mneu_item_show' => 'mobile_menu' ]
			]
		);
		
		$this->add_control(
			'menu_hm_icon_size',
			[
				'label' => __( 'اندازه آیکن', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 30,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} #mweb-trigger svg' => 'width: {{SIZE}}{{UNIT}}',
				],
				'condition' => [ 'mneu_item_show' => 'mobile_menu' ]
			]
		);
		
		$this->add_control(
			'menu_hm_icon_color',
			[
				'label' => __( 'رنگ آیکن همبرگری', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #mweb-trigger svg' => 'stroke: {{VALUE}}',
					'{{WRAPPER}} #mweb-trigger' => 'color: {{VALUE}}',
				]
			]
		);
		
		$this->add_control(
			'sub_menu_radius',
			[
				'label' => __( 'گوشه های مدور زیر منو', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .mweb-main-menu ul div.sub-menu, {{WRAPPER}} .mweb-main-menu ul ul.sub-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]			]
		);
		
		$this->add_control(
			'sub_menu_blur',
			[
				'label' => __( 'پس زمینه شفاف زیر منو', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'prefix_class' => 'elementor-menu--blur-',
			]
		);
		
		$this->end_controls_section();
	}


	/**
	 * Render the widget output on the frontend.
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		
		if( in_array( $settings['mneu_item_show'], [ 'both', 'main_menu' ] ) ){
			echo '<div id="navigation" class="mweb-drop-down mweb-main-menu main_menu_align'.$settings['menu_alignment'].'">';
				if( $settings['menu'] ){
					wp_nav_menu(
						array(
							'menu' => $settings['menu'],
							'container'      => false,
							'walker'         => new \mweb_mega_menu_walker,
							)
					);
				} else {
					if( has_nav_menu('main-menu') ){
						wp_nav_menu(
							array(
								'theme_location' => 'main-menu',
								'container'      => '',
								'walker'         => new \mweb_mega_menu_walker,
								)
						);
					}
				}
			echo '</div>';
		}
		
		if( in_array( $settings['mneu_item_show'], [ 'both', 'mobile_menu' ] ) ){
			get_template_part( 'templates/header/module', 'nav_mobile' ); 
			if( $settings['menu_hm_only_icon'] == 'yes' )
				echo '<a id="mweb-trigger" class="icon-wrap" href="#"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#menu"></use></svg></a>';
			else
				get_template_part( 'templates/header/module', 'menu_button' ); 

		}
		
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * @access protected
	 */
	protected function content_template() {
		
	}
}




/**
 * Elementor Header Phone
 * @since 1.0.0
 */
class My_Header_Phone extends Widget_Base {

	
	public function get_name() {
		return 'mweb-call-us';
	}
	
	public function get_title() {
		return __( 'شماره تماس', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-tel-field';
	}

	public function get_categories() {
		return [ 'digiland_header' ];
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
				'default' => 'one',
				'options' => [
					'one' => __( 'یک', 'mweb' ),
					'two' => __( 'دو', 'mweb' ),
					'three' => __( 'سه', 'mweb' ),
				],
				'prefix_class' => 'elementor-phone-number--view-',
			]
		);

		$this->add_control(
			'heading_phone_number',
			[
				'label' => __( 'شماره تماس', 'mweb' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'phone_number_code',
			[
				'label' => __( 'پیش شماره', 'mweb' ),
				'type' => Controls_Manager::TEXT,
				'default' => '021',
			]
		);
		
		$this->add_control(
			'phone_number',
			[
				'label' => __( 'شماره', 'mweb' ),
				'type' => Controls_Manager::TEXT,
				'default' => '42156644',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'phone_code_typography',
				'label' => __( 'تایپوگرافی پیش شماره', 'mweb' ),
				'selector' => '{{WRAPPER}} .call_number span',
			]
		);

		$this->add_control(
			'phone_code_color',
			[
				'label' => __( 'رنگ پیش شماره', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .call_number span' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'phone_number_typography',
				'label' => __( 'تایپوگرافی شماره', 'mweb' ),
				'selector' => '{{WRAPPER}} .call_number strong',
			]
		);

		$this->add_control(
			'phone_number_color',
			[
				'label' => __( 'رنگ شماره', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .call_number strong' => 'color: {{VALUE}}',
				],
			]
		);

		
		$this->add_control(
			'heading_phone_alt',
			[
				'label' => __( 'متن یا توضیح', 'mweb' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'phone_alt',
			[
				'label' => __( 'متن', 'mweb' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'با ما در تماس باشـید', 'mweb' ),
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'phone_alt_typography',
				'label' => __( 'تایپوگرافی متن', 'mweb' ),
				'selector' => '{{WRAPPER}} .call_number_alt',
			]
		);

		$this->add_control(
			'phone_alt_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .call_number_alt' => 'color: {{VALUE}}',
				],
			]
		);
		
		
		$this->add_control(
			'heading_phone_icon',
			[
				'label' => __( 'آیکن', 'mweb' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'myphone_icon',
			[
				'label' => __( 'آیکن', 'mweb' ),
				'type' => 'iconpicker',
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .el_call_number .icon_wrap',
				'condition' => [ 'view_type' => 'three' ]				
			]
		);

		$this->add_control(
			'icon_size',
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
					'{{WRAPPER}} .el_call_number svg' => 'width: {{SIZE}}{{UNIT}}',
				]
			]
		);

		$this->add_control(
			'phone_icon_color',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .el_call_number svg' => 'fill: {{VALUE}}; stroke: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'phone_icon_margin',
			[
				'label' => __( 'فاصله خارجی آیکن', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .el_call_number svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'btn_icon_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .el_call_number .icon_wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 'view_type' => 'three' ]				
			]
		);
		
		$this->add_control(
			'icon_wrap_height',
			[
				'label' => __( 'عرض و ارتفاع آیکن', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .el_call_number .icon_wrap' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 'view_type' => 'three' ]				
			]
		);
		
		$this->end_controls_section();
		


	}

	
	protected function render() {
	
		$settings = $this->get_settings_for_display();
		
		echo '<div class="el_call_number" onclick="window.open (\'tel:'.$settings['phone_number_code'].$settings['phone_number'].'\', \'_self\');">';
			
			if($settings['view_type'] !== 'one')
				echo '<div class="call_number_row">';
			
				echo '<div class="call_number">';
					printf('<strong>%1$s</strong><span>%2$s</span>', $settings['phone_number'], $settings['phone_number_code'] );
					if(!empty($settings['myphone_icon']) && $settings['view_type'] == 'one'){
						echo $settings['myphone_icon'];
					}
				echo '</div>';
				
				if(!empty($settings['phone_alt'])){
					echo '<p class="call_number_alt">'.$settings['phone_alt'].'</p>';
				}
				
			if($settings['view_type'] !== 'one')
				echo '</div>';
			
			if(!empty($settings['myphone_icon']) && $settings['view_type'] == 'two'){
				echo $settings['myphone_icon'];
			}
			if(!empty($settings['myphone_icon']) && $settings['view_type'] == 'three'){
				echo '<div class="icon_wrap">'.$settings['myphone_icon'].'</div>';
			}
		
		echo '</div>';
		
		

	}

	
	protected function content_template() {
		
	}
}



/**
 * Elementor Header Toggle Menu
 * @since 1.0.0
 */
class My_Header_Menu_Toggle extends Widget_Base {

	
	public function get_name() {
		return 'my-header-menu-toggle';
	}
	
	public function get_title() {
		return __( 'منو افقی (دکمه)', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-table-of-contents';
	}

	public function get_categories() {
		return [ 'digiland_header' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'منو افقی', 'mweb' ),
			]
		);
		
		$this->add_control(
			'menu',
			[
				'label' => __( 'انتخاب منو', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => get_element_menus_list(),
			]
		);
		
		$this->add_control(
			'title',
			[
				'label' => __( 'عنـوان', 'mweb' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'دسته بندی ها', 'mweb' ),
			]
		);
		
		
		
		
		$this->add_control(
			'menu_toggle_icon',
			[
				'label' => __( 'آیکن', 'mweb' ),
				'type' => 'iconpicker',
			]
		);
		
		$this->add_control(
			'menu_toggle_icon_size',
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
					'size' => 25,
				],
				'selectors' => [
					'{{WRAPPER}} .menu_title svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'menu_toggle_icon_margin',
			[
				'label' => __( 'فاصله خارجی آیکن', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .menu_title svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .elm_bkg .menu_title' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'btn_icon_color',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .menu_title svg' => 'stroke: {{VALUE}}; fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elm_bkg .menu_title' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_tab();

		$this->start_controls_tab( 'button_style_hover',
			[
				'label' => __( 'حالت انتخاب', 'mweb' ),
			]
		);

		$this->add_control(
			'button_text_color_hover',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elm_bkg.active .menu_title' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'btn_icon_color_hover',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elm_bkg.active .menu_title svg' => 'stroke: {{VALUE}}; fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_bg_color_hover',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elm_bkg.active .menu_title' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'تایپوگرافی عنوان', 'mweb' ),
				'selector' => '{{WRAPPER}} .elm_bkg .menu_title',
			]
		);
		
		$this->add_control(
			'btn_padding',
			[
				'label' => __( 'فاصله داخلی', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elm_bkg .menu_title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'btn_bar_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .elm_bkg .menu_title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]			
			]
		);
		
		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		if( $settings['menu'] ):
			?>
			<div class="mega_bkg elm_bkg"> 
				<div class="menu_title"><?= !empty($settings['menu_toggle_icon']) ? $settings['menu_toggle_icon'] : '' ?><span><?= $settings['title'] ?></span></div>
				<div class="main_nav right_menu head_3_menu">
					<div id="navigation" class="mweb-main-menu mweb-drop-down">
						<?php
							wp_nav_menu(
								array(
									'menu' => $settings['menu'],
									'container'      => false,
									'menu_id'        => '',
									'walker'         => new \mweb_mega_menu_walker,
									'depth'          => 4,
									'echo'           => true
									)
							);
						?>
					</div>
				</div>
			</div>
			<?php
		endif;
		
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * @access protected
	 */
	protected function content_template() {
		
	}
}



/**
 * Elementor Header Mobile Sidebar Menu
 * @since 1.0.0
 */
class My_Header_Menu_Sidebar_Mobile extends Widget_Base {

	
	public function get_name() {
		return 'my-header-menu-mmenu';
	}
	
	public function get_title() {
		return __( 'منو سایدبار موبایل(کشویی)', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-table-of-contents';
	}

	public function get_categories() {
		return [ 'digiland_header' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'فهرست', 'mweb' ),
			]
		);
		
		$this->add_control(
			'menu',
			[
				'label' => __( 'انتخاب منو', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => get_element_menus_list(),
			]
		);
		
		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		if( $settings['menu'] ):
			?>
			<div id="mweb-mobile-nav" class="mobile-menu-wrap">
				<?php wp_nav_menu(
					array(
						'menu' => $settings['menu'],
						'container'      => false,
						'menu_class'     => 'mobile-menu',
						'depth'          => 6,
						//'echo'           => true,
						'walker'         => new \mweb_alt_menu_walker,
						)
				); ?>
			</div>
			<?php
		endif;
		
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * @access protected
	 */
	protected function content_template() {
		
	}
}





/**
 * Elementor Header Notify
 * @since 1.0.0
 */
class My_Header_Notify extends Widget_Base {

	
	public function get_name() {
		return 'my-header-notify';
	}
	
	public function get_title() {
		return __( 'پیغام و اطلاعیه ها', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-woocommerce-notices';
	}

	public function get_categories() {
		return [ 'digiland_header' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تنظمیات', 'mweb' ),
			]
		);
		
	
		$this->add_control(
			'icon_size',
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
					'{{WRAPPER}} .notify_btn svg' => 'width: {{SIZE}}{{UNIT}}',
				]
			]
		);
		
		$this->add_control(
			'icon_margin',
			[
				'label' => __( 'فاصله خارجی آیکن', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .notify_btn svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_padding',
			[
				'label' => __( 'فاصله داخلی', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .notify_btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
			
		$this->add_control(
			'border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .notify_btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'btn_box_shadow',
				'selector' => '{{WRAPPER}} .notify_btn',
			]
		);
		
		
		$this->add_control(
			'dropdown_alignment',
			[
				'label' => __( 'تراز افقی کشویی', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'center',
				'options' => [
					'right' => __( 'راست', 'mweb' ),
					'center' => __( 'وسط', 'mweb' ),
					'left' => __( 'چپ', 'mweb' ),
				],
				'prefix_class' => 'elementor-nofify-dropdwon--align-',
			]
		);
		
				
		$this->start_controls_tabs( 'items_style_tabs' );

		$this->start_controls_tab( 'items_style_normal',
			[
				'label' => __( 'حالت نرمال', 'mweb' ),
			]
		);
		
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .notify_btn svg' => 'stroke: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'background',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .notify_btn' => 'background-color: {{VALUE}}',
				]
			]
		);
		

		$this->end_controls_tab();

		$this->start_controls_tab( 'items_style_hover',
			[
				'label' => __( 'حالت هاور', 'mweb' ),
			]
		);

		$this->add_control(
			'icon_color_hover',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .notify_btn:hover svg' => 'stroke: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'background_hover',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .notify_btn:hover' => 'background-color: {{VALUE}}',
				]
			]
		);
		
		$this->add_control(
			'btn_transition',
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
					'{{WRAPPER}} .notify_btn' => 'transition: all {{SIZE}}s',
				],
			]
		);

		$this->end_controls_tab();
		
		$this->end_controls_tabs();
		
		
		$this->add_control(
			'only_myaccount',
			[
				'label' => __( 'فقط در صفحه حساب کاربری', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بلی', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);


		$this->end_controls_section();

		
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		
		if( !is_user_logged_in() ){
			return false;
		}
		
		if( $settings['only_myaccount'] == 'yes' && !is_account_page() ){
			return false;
		}

		$mweb_acc_url = get_permalink( get_option('woocommerce_myaccount_page_id'));

		$equal = mweb_get_notify_count();

		$notify_page = wc_get_endpoint_url('notify', '', $mweb_acc_url);
		//$ticket_notify = get_user_meta( get_current_user_id(), 'ticket_notify', true );
		//$equal = is_array($ticket_notify) ? $equal + intval(count($ticket_notify)) : $equal;
		$notify_dropdown = '';
		if( $equal > 0 ){
			/* $ticket_list = '';
			if( !empty($ticket_notify) ){
				foreach($ticket_notify as $key => $notify){
					$ticket_list = '<div class="tk_list">'.$notify['title'].'</div>';
				}
			} */
			$notify_dropdown = '<div class="notify_dropdown"><span>شما <b>'.$equal.'</b> پیغام خوانده نشده دارید</span><a href="'.esc_url($notify_page).'">مشاهده پیغام ها</a></div>';
			$notify_btn = '<div class="notify_btn is_active" data-count="'.$equal.'"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#notification"></use></svg>'.$notify_dropdown.'</div>';
		} else {
			$notify_btn = '<a class="notify_btn" href="'.esc_url($notify_page).'" title="پیغام ها"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#notification"></use></svg></a>';
		}

		echo $notify_btn;

	}

	/**
	 * Render the widget output in the editor.
	 *
	 * @access protected
	 */
	protected function content_template() {
		
	}
}
