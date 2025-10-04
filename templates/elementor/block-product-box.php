<?php
namespace ElementorMahdisweb\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Module Product Box (with cat & slider)
 * @since 1.0.0
 */
class Product_List_Box extends Widget_Base {

	
	public function get_name() {
		return 'product-list-box';
	}

	
	public function get_title() {
		return __( 'باکس محصولات', 'mweb' );
	}

	
	public function get_icon() {
		return 'eicon-thumbnails-right';
	}

	
	public function get_categories() {
		return [ 'digiland' ];
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
			'sub_title',
			[
				'label' => __( 'زیر عنوان', 'mweb' ),
				'type' => Controls_Manager::TEXT,
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
			'header_color',
			[
				'label' => __( 'رنگ سربرگ عنوان', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nav_tabs_warpper .icon' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .nav_tabs_warpper .icon:after' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .mweb-swiper-next:hover' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .mweb-swiper-prev:hover' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .bk_view_more svg' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .nav_tabs_warpper .icon:before' => 'border-right-color: {{VALUE}}',
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
		

		$this->end_controls_section();
		
		
		
		$this->start_controls_section(
			'section_display',
			[
				'label' => __( 'نمایش', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'box_type',
			[
				'label' => __( 'نوع نمایش باکس', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'box_one' => __( 'یک', 'mweb' ),
					'box_two' => __( 'دو', 'mweb' ),
				],
				'default' => 'box_one',

			]
		);
		
		$this->add_control(
			'block_name',
			[
				'label' => __( 'نوع نمایش محصول', 'mweb' ),
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
		
		$this->add_control(
			'show_subcats',
			[
				'label' => __( 'نمایش زیر دسته ها', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 0,
				'options' => get_element_on_off(),
				'condition' => [ 'box_type' => ['box_one'] ]
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
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .item .item-area' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .tab_cat_list .inner_wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
	
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'item_box_shadow',
				'selector' => '{{WRAPPER}} .item .item-area',
				'selector' => '{{WRAPPER}} .tab_cat_list .inner_wrap',
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
			'brand_id',
			[
				'label' => __( 'انتخاب برند', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 0,
				'options' => get_element_category_list(apply_filters('mweb_product_brand_taxonomy', 'product_brand')),
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
			'only_inStock',
			[
				'label' => __( 'فقط محصولات موجود', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
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
			'section_style',
			[
				'label' => __( 'تنظیمات اسلایدر', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 'box_type' => ['box_one'] ]
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
				'default' => 'none',
				'options' => [
					'arrows' => __( 'فلش', 'mweb' ),
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
		
		
		
		$this->end_controls_section();
	
			
	}
	
	
	public function render_block_header($options = array()){

			//check title
			if ( empty( $options['title'] ) ) {
				return false;
			}

			$str = '';
			$str .= '<div class="nav_tabs_warpper">';
			if ( !empty( $options['icon'] ) ) {
				$str .= '<div class="icon">'. $options['icon'] .'</div>';
			}
			$str .= '<div class="nav_tabs_content">';
			$str .= '<h4 class="heading">'. $options['title'] .'</h4>';
			if( !empty($options['title_url']['url']) )
				$str .= '<a href="'.esc_url( $options['title_url']['url'] ).'" class="bk_view_more"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-left-1"></use></svg>مشاهده همه</a>';
			if( !empty($options['sub_title']) )
				$str .= '<span class="subtitle">'. $options['sub_title'] .'</span>';
			$str .= '</div>';
			$str .= '</div>';

			return $str;

	}
	
	
	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$show_dots = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
		$show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
		
		$data_setting = array();
		
		$data_setting['slidesPerView'] = 2;
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
	
		if( $show_dots ){
			$data_setting['pagination'] = array('el' => '.mweb-swiper-pagination', 'clickable' => true);
		}
		if( $show_arrows ){
			$data_setting['navigation'] = array('nextEl' => '.mweb-swiper-next', 'prevEl' => '.mweb-swiper-prev' );
		}

		$slide_tablet = empty($settings['slides_to_show_tablet']) ? 2 : $settings['slides_to_show_tablet'];
		$slide_mobile = empty($settings['slides_to_show_mobile']) ? 1 : $settings['slides_to_show_mobile'];

		$data_setting['breakpoints'] = array('575' => array('slidesPerView' => $slide_mobile), '768' => array('slidesPerView' => $slide_tablet), '1024' => array('slidesPerView' => $settings['slides_to_show']));
			
		$arrow_right = 'arrow-right-1';
		$arrow_left = 'arrow-left-1';
			
		$attr_class = 'swiper xslider';

		$this->add_render_attribute( [
			'carousel-wrapper' => [
				'class' => $attr_class,
				'id' => 'sl_'.$this->get_id(),
				'dir' => 'rtl',
				'data-slider' => wp_json_encode($data_setting)
			],
		] );
		
		
		
		$content_class = $settings['show_subcats'] == true && !empty($settings['category_id']) ? 'row' : '' ;
		
		/* if( !wp_is_mobile() ){
			$content_class .= ' product-type-1';
		}  */
		
		$block_cls = $settings['loop_type'];
		$block_cls .= ' block_product_box';
		$posts_per_page = $settings['posts_per_page'];
		if( $settings['box_type'] == 'box_two' ){
			$posts_per_page = $settings['posts_per_page'] > 4 ? 4 : $settings['posts_per_page'];
			$block_cls .= ' block_product_box box_3p';
		}
		
		$in_stock = $settings['only_inStock'] == 'yes' ? true : '';
		
		$query_options = array('category_id' => $settings['category_id'], 'brand_id' => $settings['brand_id'], 'posts_per_page' => $posts_per_page, 'orderby' => $settings['orderby'], 'author_id' => $settings['authors'], 'offset' => $settings['offset'], 'post__in' => $settings['include_products'], 'post_not_in' => $settings['exclude_products'], 'post_type' => 'product', 'in_stock' => $in_stock );
				
		$block = array('block_id' => 'mweb_'.$this->get_id(), 'block_name' => 'mweb_'.$this->get_name(), 'block_classes' => $block_cls, 'block_options' => $query_options);
		$block_head = array('title' => $settings['title'], 'sub_title' => $settings['sub_title'], 'icon' => $settings['title_picon'], 'title_url' => $settings['title_url'] );
		
		$query_data = \mweb_theme_query::get_custom_query( $query_options );
		
		echo \mweb_theme_block::block_open( $block );
		echo $this->render_block_header( $block_head );
		if( $settings['box_type'] == 'box_one' ){
			
			echo \mweb_theme_block::block_content_open($content_class);
		
			if( $settings['show_subcats'] == true && !empty($settings['category_id']) ){ ?>
				<div class="col-md-3 hide_mobile hide_tablet">
					<div class="tab_cat_list">
					<div class="inner_wrap">
						<div class="cat_list_title">سایر دسته بندی ها</div>
						<div class="cat_list_wrap">	
							<ul>
							<?php
								$sub_categories = get_terms( 'product_cat', array(
									'orderby'    => 'name',
									'order'      => 'ASC',
									'parent' => $settings['category_id'],
									'hide_empty' => false
								));

								foreach( $sub_categories as $pro_cat ) :
									$term_link = get_term_link( $pro_cat , 'product_cat' );
									if ( $term_link ) {
										echo '<li><a href="'.$term_link.'">'. $pro_cat->name .'</a></li>';
									}
								endforeach; 
							?>
							</ul>
						</div>
					</div>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-9">
			<?php  }
			
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
			
			$loop_arg = [];
			if ( $style_type == 'type-1'){
				$loop_arg['rating'] = true;
			}
			
			$loop_arg['thumbnail'] = isset($settings['item_thumbnail_size']) ? $settings['item_thumbnail_size'] : '';

			//check empty
			if ( $query_data->have_posts() ) {

				echo '<div '. $this->get_render_attribute_string( 'carousel-wrapper' ) .'>';
				echo '<div class="swiper-wrapper">';
					while ( $query_data->have_posts() ) : 
						$query_data->the_post(); 
						echo '<div class="swiper-slide"><div class="item">';
							echo $loop_name();
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
			
			if($settings['show_subcats'] == true && !empty($settings['category_id']))
				echo '</div>';
			
			echo \mweb_theme_block::block_content_close();
			echo \mweb_theme_block::block_footer( $block );
			
		} else {
			
			if ($query_data->have_posts()) :
				$products = [];
				while ($query_data->have_posts()) : $query_data->the_post();
					global $product;
					$products[] = [
						'link'  => get_permalink(),
						'image' => $product->get_image($settings['item_thumbnail_size']),
						'title'  => get_the_title(),
					];
				endwhile;
				wp_reset_postdata();
				if (count($products) === 3) :
					?>
					<div class="product-grid-wrapper tooltip_light">
						<div class="product-big img_heffect">
							<a href="<?php echo esc_url($products[0]['link']); ?>" data-toggle="tooltip" data-original-title="<?php echo esc_attr($products[0]['title']); ?>" title="<?php echo esc_attr($products[0]['title']); ?>">
								<?php echo $products[0]['image']; ?>
							</a>
						</div>

						<div class="product-small-column">
							<div class="product-small img_heffect">
								<a href="<?php echo esc_url($products[1]['link']); ?>" data-toggle="tooltip" data-original-title="<?php echo esc_attr($products[1]['title']); ?>" title="<?php echo esc_attr($products[1]['title']); ?>">
									<?php echo $products[1]['image']; ?>
								</a>
							</div>
							<div class="product-small img_heffect">
								<a href="<?php echo esc_url($products[2]['link']); ?>" data-toggle="tooltip" data-original-title="<?php echo esc_attr($products[2]['title']); ?>" title="<?php echo esc_attr($products[2]['title']); ?>">
									<?php echo $products[2]['image']; ?>
								</a>
							</div>
						</div>
					</div>
					<?php
					else :
					?>
					<div class="product-grid-wrapper tooltip_light">
						<div class="product-small-column">
							<div class="product-small img_heffect">
								<a href="<?php echo esc_url($products[0]['link']); ?>" data-toggle="tooltip" data-original-title="<?php echo esc_attr($products[0]['title']); ?>" title="<?php echo esc_attr($products[0]['title']); ?>">
									<?php echo $products[0]['image']; ?>
								</a>
							</div>
							<div class="product-small img_heffect">
								<a href="<?php echo esc_url($products[1]['link']); ?>" data-toggle="tooltip" data-original-title="<?php echo esc_attr($products[1]['title']); ?>" title="<?php echo esc_attr($products[1]['title']); ?>">
									<?php echo $products[1]['image']; ?>
								</a>
							</div>
						</div>
						<div class="product-small-column">
							<div class="product-small img_heffect">
								<a href="<?php echo esc_url($products[2]['link']); ?>" data-toggle="tooltip" data-original-title="<?php echo esc_attr($products[2]['title']); ?>" title="<?php echo esc_attr($products[2]['title']); ?>">
									<?php echo $products[2]['image']; ?>
								</a>
							</div>
							<div class="product-small img_heffect">
								<a href="<?php echo esc_url($products[3]['link']); ?>" data-toggle="tooltip" data-original-title="<?php echo esc_attr($products[3]['title']); ?>" title="<?php echo esc_attr($products[3]['title']); ?>">
									<?php echo $products[3]['image']; ?>
								</a>
							</div>
						</div>
					</div>
					<?php
				endif;
			endif;
		}
		echo \mweb_theme_block::block_close();
		

		
	}
	
	
	protected function content_template() {

	}
}
