<?php
namespace ElementorMahdisweb\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Module Blog Slider
 * @since 1.0.0
 */
class Block_Blog_Slider extends Widget_Base {


	public function get_name() {
		return 'block-post-slider';
	}


	public function get_title() {
		return __( 'وبلاگ اسلایدر', 'mweb' );
	}


	public function get_icon() {
		return 'eicon-posts-carousel';
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
			'section_display',
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
					'mweb_loop_template_blog_1' => __( 'یک', 'mweb' ),
					'mweb_loop_template_blog_2' => __( 'دو', 'mweb' ),
					'mweb_loop_template_blog_3' => __( 'سه', 'mweb' ),
					'mweb_loop_template_blog_4' => __( 'چهار', 'mweb' ),
					'mweb_loop_template_blog_6' => __( 'پنج', 'mweb' ),
					'mweb_loop_template_blog_7' => __( 'شش', 'mweb' ),
					'mweb_loop_template_blog_8' => __( 'هفت', 'mweb' ),
				],
				'default' => 'mweb_loop_template_blog_3',
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
				'selector' => '{{WRAPPER}} .blog-posts-content .post-title a, {{WRAPPER}} .blog-posts-content-2 .grid_image h4, {{WRAPPER}} .blog-posts-content-4 h4 a, {{WRAPPER}} .blog-posts-content-3 .item-area .blog-post-area h4 a',
			]
		);
		
		$this->add_control(
			'item_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .item .item-area, {{WRAPPER}} .item_blog8 .blog-content-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .blog-posts-content-4 .post-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .blog-posts-content-2 .grid_image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .blog-posts-content .post-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} 25px;',
					'{{WRAPPER}} .blog-posts-content .item-area:hover .post-image a:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} 25px;',
					'{{WRAPPER}} .swiper-slide-shadow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'img_border_radius',
			[
				'label' => __( 'گوشه های مدور عکس', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .blog-posts-content-4 .post-image, {{WRAPPER}} .blog-post-area.item_blog6 a img, {{WRAPPER}} .blog-post-area.item_blog7 a img, {{WRAPPER}} .item_blog8 .blog_image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .blog-posts-content-4 .item-area:hover .post-image a:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 'block_name' => ['mweb_loop_template_blog_4', 'mweb_loop_template_blog_6', 'mweb_loop_template_blog_7', 'mweb_loop_template_blog_8'] ],
			]
		);
		
		$this->add_responsive_control(
			'item_height',
			[
				'label' => __( 'ارتفاع', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 260,
				],
				'selectors' => [
					'{{WRAPPER}} .blog-posts-content-2 .grid_image' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 'block_name' => ['mweb_loop_template_blog_2'] ],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'item_box_shadow',
				'selector' => '{{WRAPPER}} .item .item-area, {{WRAPPER}} .blog-posts-content-2 .grid_image, {{WRAPPER}} .item_blog8 .blog-content-inner',
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
		
		$this->end_controls_section();

		
	}


	protected function render() {
		
		$settings = $this->get_settings_for_display();
		
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
		
		if( !wp_is_mobile() )
			$data_setting = get_swiper_effect($settings['sw_effect'], $data_setting);
	
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
		if( $settings['overflow'] == 'yes' ){
			$attr_class .= ' swiper-wrap-visible';
		}

		$this->add_render_attribute( [
			'carousel-wrapper' => [
				'class' => $attr_class,
				'id' => 'sl_'.$this->get_id(),
				'dir' => 'rtl',
				'data-slider' => wp_json_encode($data_setting)
			],
		] );
		
		$loop_name = $settings['block_name'];
		
		if( $loop_name == 'mweb_loop_template_blog_1' ){
			$block_class = 'blog-posts-content';
		}elseif( $loop_name == 'mweb_loop_template_blog_2' ){
			$block_class = 'blog-posts-content-2';
		}elseif( $loop_name == 'mweb_loop_template_blog_3' || $loop_name == 'mweb_loop_template_blog_6' || $loop_name == 'mweb_loop_template_blog_7' ){
			$block_class = 'blog-posts-content-3';
		}elseif( $loop_name == 'mweb_loop_template_blog_8' ){
			$block_class = '';
		}else{
			$block_class = 'blog-posts-content-4';
		}

		$loop_arg = array();
		$loop_arg['thumbnail'] = isset($settings['item_thumbnail_size']) ? $settings['item_thumbnail_size'] : '';



		$query_options = array('category_id' => $settings['category_id'], 'category_ids' => $settings['category_ids'], 'posts_per_page' => $settings['posts_per_page'], 'orderby' => $settings['orderby'], 'author_id' => $settings['authors'], 'offset' => $settings['offset'], 'post__in' => $settings['include_products'], 'post_not_in' => $settings['exclude_products'] );
				
		$block = array('block_id' => 'mweb_'.$this->get_id(), 'block_name' => 'mweb_'.$this->get_name(), 'block_classes' => $block_class, 'block_options' => $query_options);
		$block['block_options'] = array_merge($block['block_options'], array('title' => $settings['title'], 'icon' => $settings['title_picon'], 'title_url' => $settings['title_url'] ));
		
		$query_data = \mweb_theme_query::get_custom_query( $query_options );
		
		echo  \mweb_theme_block::block_open( $block, $query_data );
		echo  \mweb_theme_block::block_header( $block );
		echo \mweb_theme_block::block_content_open();
		
		//check empty
		if ( $query_data->have_posts() ) {

			echo '<div '. $this->get_render_attribute_string( 'carousel-wrapper' ) .'>';
			echo '<div class="swiper-wrapper">';
				while ( $query_data->have_posts() ) : 
					$query_data->the_post(); 
					echo '<div class="swiper-slide"><div class="item">';
						echo $loop_name($loop_arg);
					echo '</div></div>';
				endwhile;
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


	
}
