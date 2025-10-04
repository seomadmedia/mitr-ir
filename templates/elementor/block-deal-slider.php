<?php
namespace ElementorMahdisweb\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Module Hot Deal Slider
 * @since 1.0.0
 */
class Block_Deal_Slider extends Widget_Base {

	
	public function get_name() {
		return 'general-onsale-product';
	}

	
	public function get_title() {
		return __( 'فروش ویژه', 'mweb' );
	}


	public function get_icon() {
		return 'eicon-product-meta';
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
				'options' => get_element_category_list('product_cat'),
			]
		);
		$this->add_control(
			'posts_per_page',
			[
				'label' => __( 'تعداد مطالب', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '',
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
				'default' => 'product_deal',
			]
		);
		
		$this->add_control(
			'navigation',
			[
				'label' => __( 'نوع دکمه پیمایش', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'percentage',
				'options' => [
					'percentage' => __( 'درصد', 'mweb' ),
					'image' => __( 'عکس', 'mweb' ),
					'title' => __( 'عنوان', 'mweb' ),
				],
				'prefix_class' => 'elementor-onsale-slider-nav-',
			]
		);


		$this->add_control(
			'progress_show',
			[
				'label' => __( 'نمایش تعداد فروش', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes'
			]
		);
		$this->add_control(
			'outofstock_show',
			[
				'label' => __( 'نمایش اتمام موجودی', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes'
			]
		);
		$this->add_control(
			'soldout_show',
			[
				'label' => __( 'نمایش اتمام فروش ویژه', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes'
			]
		);
	
		$this->add_control(
			'item_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .home-product-deal-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
	
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'item_box_shadow',
				'selector' => '{{WRAPPER}} .home-product-deal-wrap',
			]
		);
		
		$this->end_controls_section();
		

	}
	
	
	
	

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$query_options = array('category_id' => $settings['category_id'], 'posts_per_page' => $settings['posts_per_page'], 'orderby' => 'on_sale', 'offset' => $settings['offset'], 'post__in' => $settings['include_products'], 'post_not_in' => $settings['exclude_products'], 'post_type' => 'product' );
				
		$block = array('block_id' => 'mweb_'.$this->get_id(), 'block_name' => 'mweb_'.$this->get_name(), 'block_options' => $query_options);
		//$block['block_options'] = array_merge($block['block_options'], array('title' => $settings['title'] ));
		
		$loop_arg = array();
		$loop_arg['deal_progress'] = $settings['progress_show'] == 'yes' ? true : false;
		$loop_arg['deal_outofstock'] = $settings['outofstock_show'] == 'yes' ? true : false;
		$loop_arg['deal_soldout'] = $settings['soldout_show'] == 'yes' ? true : false;
		$loop_arg['thumbnail'] = $settings['item_thumbnail_size'];
		
		$query_data = \mweb_theme_query::get_custom_query( $query_options );
		
		echo \mweb_theme_block::block_content_open('home-product-deal-wrap');
		
		if ( $query_data->have_posts() ) {
			
		?>
		<div class="swiper main_onsale_slider" dir="rtl" data-nav="<?= $settings['navigation'] ?>" id="<?= 'sl_'.$this->get_id() ?>">
			<div class="swiper-wrapper">
			<?php while ( $query_data->have_posts() ) : ?>
				<?php $query_data->the_post(); ?>
				<div class="swiper-slide">
					<?php echo mweb_loop_template_product_onsale_1($loop_arg); ?>
				</div>
			<?php endwhile; ?>
			</div>
			<div class="mweb-swiper-next"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#arrow-right-1"></use></svg></div><div class="mweb-swiper-prev"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>'#arrow-left-1"></use></svg></div>
			<div class="onsale-pagination"></div>
		</div>			
		<?php
		
		} else {
			echo mweb_no_content();
		}
		//reset post data
		wp_reset_postdata();
		
		echo \mweb_theme_block::block_content_close();
		
	}


	protected function content_template() {
		
	}
}




/**
 * Elementor Module Vertical Deal Slider
 * @since 1.0.0
 */
class Block_Vertical_Deal_Slider extends Widget_Base {

	
	public function get_name() {
		return 'general-vonsale-product';
	}

	
	public function get_title() {
		return __( 'فروش ویژه عمودی', 'mweb' );
	}


	public function get_icon() {
		return 'eicon-accordion';
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
				'options' => get_element_category_list('product_cat'),
			]
		);
		$this->add_control(
			'posts_per_page',
			[
				'label' => __( 'تعداد مطالب', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '',
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
				'default' => 'product_deal',
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
			'progress_show',
			[
				'label' => __( 'نمایش تعداد فروش', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes'
			]
		);
	
		$this->add_control(
			'item_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .deal_new .item-area' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .deal_slider_v:before, {{WRAPPER}} .deal_slider_v:after' => 'border-radius: 0{{UNIT}} 0{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'bg_color',
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .deal_new .item-area, {{WRAPPER}} .deal_slider_v:before, {{WRAPPER}} .deal_slider_v:after'
			]
		);
		
		$this->add_control(
			'bg_color_label',
			[
				'label' => __( 'رنگ پس زمینه تخفیف', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .deal_new .item-area .product-image-area .product-label' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'color_label',
			[
				'label' => __( 'رنگ متن تخفیف', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .deal_new .item-area .product-image-area .product-label' => 'color: {{VALUE}} !important;',
				],
			]
		);
		
		$this->end_controls_section();
		

	}
	
	
	
	

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$query_options = array('category_id' => $settings['category_id'], 'posts_per_page' => $settings['posts_per_page'], 'offset' => $settings['offset'], 'orderby' => 'on_sale', 'post_type' => 'product' );
				
		$block = array('block_id' => 'mweb_'.$this->get_id(), 'block_name' => 'mweb_'.$this->get_name(), 'block_options' => $query_options);
		//$block['block_options'] = array_merge($block['block_options'], array('title' => $settings['title'] ));
		
		$loop_arg = array();
		$loop_arg['deal_progress'] = $settings['progress_show'] == 'yes' ? true : false;
		$loop_arg['thumbnail'] = $settings['item_thumbnail_size'];
		
		
		$data_setting['slidesPerView'] = 1;
		$data_setting['spaceBetween'] = 0;
		$data_setting['watchSlidesVisibility'] = false;
		$data_setting['direction'] = 'vertical';
		$data_setting['observer'] = true;
		$data_setting['observeParents'] = true;
			
		$data_setting['loop'] = true;
		
		if( $settings['autoplay'] == 'yes'){
			$data_setting['autoplay'] = true;
		}
		if( $settings['pause_on_hover'] == 'yes'){
			$data_setting['touchMoveStopPropagation'] = true;
		}
		
		$attr_class = 'swiper deal_slider_v';
	
		$this->add_render_attribute( [
			'carousel-wrapper' => [
				'class' => $attr_class,
				'id' => 'sl_'.$this->get_id(),
				//'dir' => 'rtl',
				'data-slider' => wp_json_encode($data_setting)
			],
		] );
		
		$query_data = \mweb_theme_query::get_custom_query( $query_options );
		
		echo \mweb_theme_block::block_content_open();
		
		//check empty
		if ( $query_data->have_posts() ) {

			echo '<div '. $this->get_render_attribute_string( 'carousel-wrapper' ) .'>';
				echo '<div class="swiper-wrapper">';
				while ( $query_data->have_posts() ) : 
						$query_data->the_post(); 
						echo '<div class="swiper-slide">';
							echo mweb_loop_template_product_onsale_3( $loop_arg );
						echo '</div>';
					endwhile;
				
				echo '</div>';		
			echo '</div>';				

		} else {
			echo mweb_no_content();
		}
		//reset post data
		wp_reset_postdata();
		
		echo \mweb_theme_block::block_content_close();
		
	}


	protected function content_template() {
		
	}
}

