<?php
namespace ElementorMahdisweb\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Module Blog Vitrin 
 * @since 1.0.0
 */
class Block_Blog_Gride extends Widget_Base {

	
	public function get_name() {
		return 'block-post-gride';
	}

	
	public function get_title() {
		return __( 'وبلاگ ویترین', 'mweb' );
	}

	
	public function get_icon() {
		return 'eicon-gallery-group';
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
			'posts_per_page',
			[
				'label' => __( 'تعداد مطالب', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 6,
				'min' => 6,
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
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ptitle_typography',
				'label' => __( 'تایپوگرافی عنوان مطالب', 'mweb' ),
				'selector' => '{{WRAPPER}} .blog-posts-content-2 .grid_image h4',
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

		$this->add_control(
			'item_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .grid_image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
	
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'item_box_shadow',
				'selector' => '{{WRAPPER}} .grid_image',
			]
		);
		
		$this->end_controls_section();
		
		

		
	}

	
	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$query_options = array('category_id' => $settings['category_id'], 'category_ids' => $settings['category_ids'], 'posts_per_page' => $settings['posts_per_page'], 'orderby' => $settings['orderby'], 'author_id' => $settings['authors'], 'offset' => $settings['offset'], 'post__in' => $settings['include_products'], 'post_not_in' => $settings['exclude_products']);
				
		$block = array('block_id' => 'mweb_'.$this->get_id(), 'block_name' => 'mweb_'.$this->get_name(), 'block_classes' => 'row-is-d-noflex-yes', 'block_options' => $query_options);
		$block['block_options'] = array_merge($block['block_options'], array('title' => $settings['title'], 'icon' => $settings['title_picon'], 'title_url' => $settings['title_url'] ));

		
		$query_data = \mweb_theme_query::get_custom_query( $query_options );
		
		$loop_arg = array();
		$loop_arg['thumbnail'] = isset($settings['item_thumbnail_size']) ? $settings['item_thumbnail_size'] : '';

				
		echo \mweb_theme_block::block_open( $block, $query_data );
		echo \mweb_theme_block::block_header( $block );
		echo \mweb_theme_block::block_content_open('blog-posts-content-2 row');
		
		//check empty
		if ( $query_data->have_posts() && $query_data->post_count >= 6 ) {
			
			$count_blog = 1;
			while ( $query_data->have_posts() ) : 
				$query_data->the_post();
				
					if($count_blog == 1){ 
						echo '<div class="col-6 col-sm-6 col-lg-4 grid_center">';
							echo mweb_loop_template_blog_2($loop_arg);
						echo '</div>';
                    } 
					if($count_blog == 2){ 
						echo '<div class="col-6 col-sm-6 col-lg-3 grid_right">';
							echo mweb_loop_template_blog_2($loop_arg);
                    }
					if($count_blog == 3){ 
							echo mweb_loop_template_blog_2($loop_arg);
						echo '</div>';
                    }
					if($count_blog == 4){ 
						echo '<div class="col-6 col-sm-6 col-lg-2 grid_center">';
							echo mweb_loop_template_blog_2($loop_arg);
						echo '</div>';
                    } 
					if($count_blog == 5){ 
						echo '<div class="col-12 col-sm-12 col-lg-3 grid_left">';
							echo mweb_loop_template_blog_2($loop_arg);
                    }
					if($count_blog == 6){ 
							echo mweb_loop_template_blog_2($loop_arg);
						echo '</div>';
                    }
					if($count_blog > 6){ 
						echo '<div class="col-6 col-sm-6 col-lg-3 grid_left">';
							echo mweb_loop_template_blog_2($loop_arg);
						echo '</div>';
                    }
			
					$count_blog ++;
					
			 endwhile;
			 
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
