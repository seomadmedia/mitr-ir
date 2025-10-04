<?php
namespace ElementorMahdisweb\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Css_Filter;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Module Category
 * @since 1.0.0
 */
class Block_Category extends Widget_Base {

	
	public function get_name() {
		return 'block-category';
	}

	
	public function get_title() {
		return __( 'باکس دسته بندی', 'mweb' );
	}

	
	public function get_icon() {
		return 'eicon-library-save';
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
				'label' => __( 'تنظیمات', 'mweb' ),
			]
		);

		$this->add_control(
			'is_archive',
			[
				'label' => __( 'استفاده در آرشیو', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'yes' => __( 'بله', 'mweb' ),
					'no' => __( 'خیر', 'mweb' ),
				]
			]
		);
		
		$this->add_control(
			'block_type',
			[
				'label' => __( 'نوع نمایش', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'is_inbox' => __( 'یک', 'mweb' ),
					'is_sepbox' => __( 'دو', 'mweb' ),
					'is_grid' => __( 'سه', 'mweb' ),
				],
				'default' => 'is_inbox',
			]
		);

		$this->add_control(
			'has_parent',
			[
				'label' => __( 'دسته والد', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => get_element_category_list('product_cat'),
			]
		);
		
		$this->add_control(
			'has_include',
			[
				'label' => __( 'انتخاب دسته ها ', 'mweb' ),
				'type' => Controls_Manager::SELECT2,
				'description' => '',
				'multiple' => true,
				'default' => 0,
				'options' => get_element_category_multiple_list('product_cat'),
			]
		);
		
		$this->add_control(
			'top_level',
			[
				'label' => __( 'فقط نمایش زیر شاخه اول', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'yes' => __( 'بله', 'mweb' ),
					'no' => __( 'خیر', 'mweb' ),
				]
			]
		);
		
		$this->add_control(
			'hide_empty',
			[
				'label' => __( 'نمایش دسته خالی', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'yes' => __( 'بله', 'mweb' ),
					'no' => __( 'خیر', 'mweb' ),
				]
			]
		);
		
		$this->add_control(
			'show_count',
			[
				'label' => __( 'نمایش تعداد', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'yes' => __( 'بله', 'mweb' ),
					'no' => __( 'خیر', 'mweb' ),
				]
			]
		);
		
		$this->add_control(
			'only_has_img',
			[
				'label' => __( 'فقط نمایش عکس دار', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'yes' => __( 'بله', 'mweb' ),
					'no' => __( 'خیر', 'mweb' ),
				],
				'condition' => [ 'block_type' => ['is_sepbox', 'is_grid'] ]
			]
		);
		

		$this->add_control(
			'disable_auto_width',
			[
				'label' => __( 'غیرفعال سازی عرض اتوماتیک', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'yes' => __( 'بله', 'mweb' ),
					'no' => __( 'خیر', 'mweb' ),
				],
				'condition' => [ 'block_type' => 'is_sepbox' ]
			]
		);
		
		$this->add_responsive_control(
			'item_in_row',
			[
				'label' => __( 'تعداد در ردیف', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 7,
				],
				'size_units' => [ 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .bk_category_inner' => 'grid-template-columns: repeat({{SIZE}}, 1fr)',
				],
				'condition' => [ 'block_type' => 'is_grid' ]

			]
		);
		
		
		$slides_to_show = range( 1, 12 );
		$slides_to_show = array_combine( $slides_to_show, $slides_to_show );

		$this->add_control(
			'item_to_show',
			[
				'label' => __( 'تعداد نمایش', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 5,
				'max' => 12,
				'step' => 1,
				'default' => 9,
				'condition' => [ 'block_type' => ['is_sepbox', 'is_grid'] ]
			]
		);
		
		$this->add_control(
			'items_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .item-area' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .bk_cat_item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'items_box_shadow',
				'selector' => '{{WRAPPER}} .item-area',
				'selector' => '{{WRAPPER}} .bk_cat_item',
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
				],
				'condition' => [ 'block_type' => 'is_inbox' ]

			]
		);
		
		$this->add_control(
			'height_box',
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
					'{{WRAPPER}} .block_product_cat .sub-cat' => 'height: {{SIZE}}{{UNIT}}',
				],
				'condition' => [ 'block_type' => 'is_inbox' ]

			]
		);
		
		
		$this->add_control(
			'show_more_btn',
			[
				'label' => __( 'نمایش دکمه بیشتر', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'yes' => __( 'بله', 'mweb' ),
					'no' => __( 'خیر', 'mweb' ),
				],
				'condition' => [ 'block_type' => ['is_sepbox', 'is_grid'] ]

			]
		);

		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_style_cat',
			[
				'label' => __( 'نمایش', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 'block_type' => ['is_sepbox', 'is_grid'] ]

			]
		);
		
		$this->add_control(
			'notice_cat',
			[
				'label' => esc_html__( 'این بخش برای نوع دو و سه است', 'mweb' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_tpo',
				'label' => __( 'تایپوگرافی نام دسته', 'mweb' ),
				'selector' => '{{WRAPPER}} .bk_category_list .bk_cat_item strong',
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'counter_tpo',
				'label' => __( 'تایپوگرافی تعداد مطلب', 'mweb' ),
				'selector' => '{{WRAPPER}} .bk_category_list .bk_cat_item .cat_count',
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'items_border',
				'selector' => '{{WRAPPER}} .bk_category_list .bk_cat_item',
				'exclude' => [ 'color' ],
			]
		);
		
		$this->add_control(
			'item_padding',
			[
				'label' => __( 'فاصله داخلی', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bk_category_list .bk_cat_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 'block_type' => ['is_sepbox', 'is_grid'] ]
			]
		);

	
		$this->start_controls_tabs( 'items_style_tabs' );

		$this->start_controls_tab( 'items_style_normal',
			[
				'label' => __( 'حالت نرمال', 'mweb' ),
			]
		);

		$this->add_control(
			'items_title_color',
			[
				'label' => __( 'رنگ عنوان', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bk_category_list .bk_cat_item strong' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'items_counter_color',
			[
				'label' => __( 'رنگ شمارنده', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bk_category_list .bk_cat_item span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'items_bg_color',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bk_category_list .bk_cat_item' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'items_border_color',
			[
				'label' => __( 'رنگ حاشیه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bk_category_list .bk_cat_item' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'item_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .bk_category_list .bk_cat_item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'item_box_shadow',
				'selector' => '{{WRAPPER}} .bk_category_list .bk_cat_item',
			]
		);
		
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'icon_filter',
				'selector' => '{{WRAPPER}} .bk_category_list .bk_cat_item img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'items_style_hover',
			[
				'label' => __( 'حالت هاور', 'mweb' ),
			]
		);

		$this->add_control(
			'items_title_color_hover',
			[
				'label' => __( 'رنگ عنوان', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bk_category_list .bk_cat_item:hover strong' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'items_counter_color_hover',
			[
				'label' => __( 'رنگ شمارنده', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bk_category_list .bk_cat_item:hover span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'items_bg_color_hover',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bk_category_list .bk_cat_item:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'items_border_color_hover',
			[
				'label' => __( 'رنگ حاشیه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bk_category_list .bk_cat_item:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'item_border_radius_hover',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .bk_category_list .bk_cat_item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'icon_filter_hover',
				'selector' => '{{WRAPPER}} .bk_category_list .bk_cat_item:hover img',
			]
		);

		$this->end_controls_tab();
		
		$this->end_controls_tabs();
		
		
		$this->add_control(
			'img_border_radius',
			[
				'label' => __( 'گوشه های مدور تصویر', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .bk_category_list .bk_cat_item img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'item_img_height',
			[
				'label' => __( 'اندازه تصویر', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 40,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 300,
					],
				],

				'selectors' => [
					'{{WRAPPER}} .bk_category_list .bk_cat_item img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'img_border',
				'label' => __( 'حاشیه عکس', 'mweb' ),
				'selector' => '{{WRAPPER}} .bk_category_list .bk_cat_item img',
			]
		);
	
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'img_box_shadow',
				'label' => __( 'سایه عکس', 'mweb' ),
				'selector' => '{{WRAPPER}} .bk_category_list .bk_cat_item img',
			]
		);
		
		$this->end_controls_section();


	}
	
	
	protected function render() {
		$settings = $this->get_settings_for_display();

		if( empty($settings['has_include']) && !isset($settings['has_parent']) ){
			
			echo mweb_error('دسته ای انتخاب نشده است !');
			
		} else{
			
			$cat_args = array(
				'taxonomy' => 'product_cat',
				'orderby' => 'name',
				'order'   => 'ASC'
			);
			
			if($settings['hide_empty'] == 'yes'){
				$cat_args['hide_empty'] = false;
			}
			
			if($settings['is_archive'] == 'no'){
				if(!empty($settings['has_include'])){
					$cat_args['include'] = implode(',', $settings['has_include']);
				}
				
				if(!empty($settings['has_parent'])){
					if($settings['top_level'] == 'yes'){
						$cat_args['parent'] = (int) $settings['has_parent'];
					}else{
						$cat_args['child_of'] = (int) $settings['has_parent'];
					}
				}else{
					if($settings['top_level'] == 'yes'){
						$cat_args['parent'] = 0;
					}
				}
			}else{
				$category_ar = get_queried_object();

				if(!empty($category_ar) && isset($category_ar->term_id) ){
					if($settings['top_level'] == 'yes'){
						$cat_args['parent'] = (int) $category_ar->term_id;
					}else{
						$cat_args['child_of'] = (int) $category_ar->term_id;
					}
				}else{
					if($settings['top_level'] == 'yes'){
						$cat_args['parent'] = 0;
					}
				}
			}

			$categories = get_categories( $cat_args );
			
			if( !empty($categories) ){
				
				if($settings['block_type'] == 'is_inbox'){
					$bg_image = '';
					$img_id = get_term_meta( $settings['has_parent'], 'representative_image', true);
					if( !empty( $img_id ) ){
						$bg_image = ' style = "background-image: url('.wp_get_attachment_image_url( $img_id, 'medium' ).');"'; 
					}		
							
				echo  '<div class="block_product_cat">';
				?>
				<div class="item-area clear"> 
					<div class="cat_box_wrap"<?= $bg_image; ?>>
						<div class="categoryname clear"> <?php echo $settings['title']; ?>
							<?php  $icon_id = get_term_meta( $settings['has_parent'], 'thumbnail_id', true);
								if( !empty( $icon_id ) && $settings['show_icon'] == 'yes' ){
									echo '<span class="img_cat">';
									echo wp_get_attachment_image( $icon_id, 'thumbnail' );
									echo '</span>';
								}				
							?>
						</div>
						<div class="sub-cat">	
							<ul>
								<?php
									foreach( $categories as $category ) :
										$term_link = get_term_link( $category , 'product_cat' );
										if ( $term_link ) {
											echo '<li><a href="'.$term_link.'">'.$category->name.'</a>';
											if($settings['show_count'] == 'yes') echo '<span class="cat_count">'.$category->count.'</span>';
											echo '</li>';
										}
									endforeach; ?>
							</ul>
						</div>
					</div>
				</div>
				<?php		
				echo  '</div>';
				
				}else{
			
					
					$outer_class = 'bk_category_list';
					$inner_class = 'bk_category_inner';
					
					if( $settings['disable_auto_width'] == 'yes' ){
						$inner_class .= ' horizontal_scroll_css';
						$outer_class .= ' is_dynamic';
					}
					
					if( $settings['block_type'] == 'is_grid' ){
						$inner_class .= ' cat_box_grid';
					}
					
					
				
					$item_count = count($categories);
					$item_counter = 0;
					$item_visible = $item_count > $settings['item_to_show'] ? $settings['item_to_show'] - 1 : $settings['item_to_show'];
					
					$only_has_img = $settings['only_has_img'] == "yes" ? true : false;
					
					/* if(wp_is_mobile()){
						
					} */
			
			
					?>
					<div class="<?= $outer_class; ?>">
					
						<?php if( !empty($settings['title']) && $settings['block_type'] != 'is_grid' && $item_count > 0 )
							echo '<span class="sub_cat_title" data-title="'.esc_attr($settings['title']).'"></span>';
						?>
						<div class="<?= $inner_class; ?>">
					
					<?php
						foreach( $categories as $category ) :
							$term_link = get_term_link( $category , 'product_cat' );
							$classes = $item_counter >= $item_visible ? 'bk_cat_item is_hidden' : 'bk_cat_item';
							$item_img = '';
							$image_id = get_term_meta ( $category->term_id, 'thumbnail_id', true );
							if(empty($image_id)){
								if(!empty($only_has_img))
									continue;
								
							}else{
								$item_img = wp_get_attachment_image( $image_id, 'thumbnail' );;
								$classes .= ' has_img';	
							}
							
							if ( $term_link ) {
								echo '<a class="'.$classes.'" href="'.$term_link.'">'.$item_img.'<strong>'.$category->name.'</strong>';
								if($settings['show_count'] == 'yes') echo '<span class="cat_count">'.$category->count.'</span>';
								//echo $key;
								echo '</a>';
							}
							$item_counter++;
						endforeach;
						
						if( $item_count > $settings['item_to_show'] && $settings['show_more_btn'] == 'yes' ){
							echo '<div class="bk_cat_item bk_cat_more"><span>'. ($item_count - $settings['item_to_show']) .'+</span><strong>دسته بندی دیگر</strong></div>';
						}
					?>
					
						</div>
					</div>
					
					<?php
				}
				
			}
		
		}

	}

	
	protected function content_template() {
		
	}
}







/**
 * Elementor Module Post Category Slider
 * @since 1.0.0
 */
class Block_Post_Category_Slider extends Widget_Base {

	
	public function get_name() {
		return 'block-post-category-slider';
	}

	
	public function get_title() {
		return __( 'اسلایدر دسته بندی ها مطالب', 'mweb' );
	}

	
	public function get_icon() {
		return 'eicon-library-save';
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
				'label' => __( 'تنظیمات', 'mweb' ),
			]
		);

		$this->add_control(
			'is_archive',
			[
				'label' => __( 'استفاده در آرشیو', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'yes' => __( 'بله', 'mweb' ),
					'no' => __( 'خیر', 'mweb' ),
				]
			]
		);
		
		$this->add_control(
			'has_parent',
			[
				'label' => __( 'دسته والد', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => get_element_category_list(),
			]
		);
		
		$this->add_control(
			'has_include',
			[
				'label' => __( 'انتخاب دسته ها ', 'mweb' ),
				'type' => Controls_Manager::SELECT2,
				'description' => '',
				'multiple' => true,
				'default' => 0,
				'options' => get_element_category_multiple_list(),
			]
		);
		
		$this->add_control(
			'top_level',
			[
				'label' => __( 'فقط نمایش زیر شاخه اول', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'yes' => __( 'بله', 'mweb' ),
					'no' => __( 'خیر', 'mweb' ),
				]
			]
		);
		
		$this->add_control(
			'hide_empty',
			[
				'label' => __( 'نمایش دسته خالی', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'yes' => __( 'بله', 'mweb' ),
					'no' => __( 'خیر', 'mweb' ),
				]
			]
		);
		
		
		$this->add_control(
			'cat_to_show',
			[
				'label' => __( 'تعداد نمایش دسته', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'placeholder' => '0',
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'default' => 8,
			]
		);
		
		$this->add_control(
			'show_count',
			[
				'label' => __( 'نمایش تعداد مطلب', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __( 'بله', 'mweb' ),
					'no' => __( 'خیر', 'mweb' ),
				]
			]
		);
		
		$this->add_control(
			'counter_title',
			[
				'label' => __( 'واحد شمارنده', 'mweb' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'نوشته',
				'condition' => [ 'show_count' => ['yes'] ],
			]
		);
		
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_tpo',
				'label' => __( 'تایپوگرافی نام دسته', 'mweb' ),
				'selector' => '{{WRAPPER}} .bk_cat_slider_item strong',
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'counter_tpo',
				'label' => __( 'تایپوگرافی تعداد مطلب', 'mweb' ),
				'selector' => '{{WRAPPER}} .bk_cat_slider_item span',
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'items_border',
				'selector' => '{{WRAPPER}} .bk_cat_slider_item',
				'exclude' => [ 'color' ],
			]
		);
		
		$this->add_control(
			'items_padding',
			[
				'label' => __( 'فاصله داخلی', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bk_cat_slider_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			'items_title_color',
			[
				'label' => __( 'رنگ عنوان', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bk_cat_slider_item strong' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'items_counter_color',
			[
				'label' => __( 'رنگ شمارنده', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bk_cat_slider_item span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'items_bg_color',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bk_cat_slider_item' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'items_border_color',
			[
				'label' => __( 'رنگ حاشیه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bk_cat_slider_item' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'item_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .bk_cat_slider_item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'item_box_shadow',
				'selector' => '{{WRAPPER}} .bk_cat_slider_item',
			]
		);
		
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'bicon_filter',
				'selector' => '{{WRAPPER}} .bk_cat_slider_item img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'items_style_hover',
			[
				'label' => __( 'حالت هاور', 'mweb' ),
			]
		);

		$this->add_control(
			'items_title_color_hover',
			[
				'label' => __( 'رنگ عنوان', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bk_cat_slider_item:hover strong' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'items_counter_color_hover',
			[
				'label' => __( 'رنگ شمارنده', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bk_cat_slider_item:hover .cat_count' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'items_bg_color_hover',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bk_cat_slider_item:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'items_border_color_hover',
			[
				'label' => __( 'رنگ حاشیه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bk_cat_slider_item:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'item_border_radius_hover',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .bk_cat_slider_item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'bicon_filter_hover',
				'selector' => '{{WRAPPER}} .bk_cat_slider_item:hover img',
			]
		);
		
		$this->add_control(
			'items_transition',
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
					'{{WRAPPER}} .bk_cat_slider_item' => 'transition: all {{SIZE}}s',
				],
			]
		);

		$this->end_controls_tab();
		
		

		$this->end_controls_tabs();
		
		
		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'نمایش', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$slides_to_show = range( 1, 20 );
		$slides_to_show = array_combine( $slides_to_show, $slides_to_show );
		
		$this->add_responsive_control(
			'slides_to_show',
			[
				'label' => __( 'اسلاید جهت نمایش', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'پیشفرض', 'mweb' ),
				] + $slides_to_show,
				'default' => 8,
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
	
	
	protected function render() {
		$settings = $this->get_settings_for_display();

		if( empty($settings['has_include']) && !isset($settings['has_parent']) ){
			
			echo mweb_error('دسته ای انتخاب نشده است !');
			
		} else {
		
		
			$cat_args = array(
				'taxonomy' => 'category',
				'orderby' => 'name',
				'order'   => 'ASC'
			);
			
			if( $settings['hide_empty'] == 'yes'){
				$cat_args['hide_empty'] = false;
			}
			
			if( $settings['is_archive'] == 'no' ){
				if( !empty($settings['has_include']) ){
					$cat_args['include'] = implode(',', $settings['has_include']);
				}
				
				if( !empty($settings['has_parent']) ){
					if( $settings['top_level'] == 'yes' ){
						$cat_args['parent'] = (int) $settings['has_parent'];
					}else{
						$cat_args['child_of'] = (int) $settings['has_parent'];
					}
				}else{
					if( $settings['top_level'] == 'yes' ){
						$cat_args['parent'] = 0;
					}
				}
			}else{
				$category_ar = get_queried_object();

				if( !empty($category_ar) ){
					if( $settings['top_level'] == 'yes' ){
						$cat_args['parent'] = (int) $category_ar->term_id;
					}else{
						$cat_args['child_of'] = (int) $category_ar->term_id;
					}
				}else{
					if( $settings['top_level'] == 'yes' ){
						$cat_args['parent'] = 0;
					}
				}
			}
			

		   
			$categories = get_categories( $cat_args );
			
			if( !empty($categories) ){
				
		
				$block_options = array('block_id' => 'bk_'.$this->get_id() ,'block_name' => 'mweb_categories', 'block_options' => array( 'title' => $settings['title'],'icon' => $settings['title_picon'] ));
		
				
				$show_dots = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
				$show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
				
				$data_setting = array();
				
				$data_setting['slidesPerView'] = 1;
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

				$slide_tablet = empty($settings['slides_to_show_tablet']) ? 2 : $settings['slides_to_show_tablet'];
				$slide_mobile = empty($settings['slides_to_show_mobile']) ? 1 : $settings['slides_to_show_mobile'];

				$data_setting['breakpoints'] = array('575' => array('slidesPerView' => $slide_mobile), '768' => array('slidesPerView' => $slide_tablet), '1024' => array('slidesPerView' => $settings['slides_to_show']));
					

						
				$item_count = count($categories);
				$item_counter = 0;
					
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
							
				

				echo \mweb_theme_block::block_open( $block_options );
				echo \mweb_theme_block::block_header( $block_options );
				echo \mweb_theme_block::block_content_open();
				
					echo '<div '. $this->get_render_attribute_string( 'carousel-wrapper' ) .'>';
					echo '<div class="swiper-wrapper">';
					
					foreach( $categories as $category ) :
					
						$term_link = get_term_link( $category , 'category' );
						$classes = 'bk_cat_slider_item';
						
						if ( $term_link ) {
							echo '<div class="swiper-slide"><a class="'.$classes.'" href="'.$term_link.'"><strong>'.$category->name.'</strong>';
							if( $settings['show_count'] == 'yes' ) echo '<span class="cat_count">+'.$category->count.' '.$settings['counter_title'].'</span>';
							echo '</a></div>';
						}
						$item_counter++;
						if( $item_counter > $settings['cat_to_show'] )
							break;
						
					endforeach;

					echo '</div>';	
						if ( $show_dots ) { 
							echo '<div class="mweb-swiper-pagination"></div>';
						} 
						if ( $show_arrows ){
							echo '<div class="mweb-swiper-next"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#'.$arrow_right.'"></use></svg></div><div class="mweb-swiper-prev"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#'.$arrow_left.'"></use></svg></div>';
						}			
					echo '</div>';		
					
				echo \mweb_theme_block::block_content_close();
				echo \mweb_theme_block::block_footer( $block_options );
				echo \mweb_theme_block::block_close();
				
	
			}
		
		}

	}

	
	protected function content_template() {
		
	}
}







/**
 * Elementor Module Category Slider
 * @since 1.0.0
 */
class Block_Category_Slider extends Widget_Base {

	
	public function get_name() {
		return 'block-category-slider';
	}

	
	public function get_title() {
		return __( 'اسلایدر دسته بندی ها', 'mweb' );
	}

	
	public function get_icon() {
		return 'eicon-library-save';
	}

	
	public function get_categories() {
		return [ 'digiland', 'digiland_woo' ];
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
				'label' => __( 'تنظیمات', 'mweb' ),
			]
		);

		$this->add_control(
			'is_archive',
			[
				'label' => __( 'استفاده در آرشیو', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'yes' => __( 'بله', 'mweb' ),
					'no' => __( 'خیر', 'mweb' ),
				]
			]
		);
		
		$this->add_control(
			'block_type',
			[
				'label' => __( 'نوع نمایش', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style_one' => __( 'یک', 'mweb' ),
					'style_two' => __( 'دو', 'mweb' ),
				],
			]
		);

		$this->add_control(
			'has_parent',
			[
				'label' => __( 'دسته والد', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => get_element_category_list('product_cat'),
			]
		);
		
		$this->add_control(
			'has_include',
			[
				'label' => __( 'انتخاب دسته ها ', 'mweb' ),
				'type' => Controls_Manager::SELECT2,
				'description' => '',
				'multiple' => true,
				'default' => 0,
				'options' => get_element_category_multiple_list('product_cat'),
			]
		);
		
		$this->add_control(
			'top_level',
			[
				'label' => __( 'فقط نمایش زیر شاخه اول', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'yes' => __( 'بله', 'mweb' ),
					'no' => __( 'خیر', 'mweb' ),
				]
			]
		);
		
		$this->add_control(
			'hide_empty',
			[
				'label' => __( 'نمایش دسته خالی', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'yes' => __( 'بله', 'mweb' ),
					'no' => __( 'خیر', 'mweb' ),
				]
			]
		);
		
		
		$this->add_control(
			'cat_to_show',
			[
				'label' => __( 'تعداد نمایش دسته', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'placeholder' => '0',
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'default' => 8,
			]
		);
		
		$this->add_control(
			'show_count',
			[
				'label' => __( 'نمایش تعداد محصولات', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __( 'بله', 'mweb' ),
					'no' => __( 'خیر', 'mweb' ),
				]
			]
		);
		
		$this->add_control(
			'counter_title',
			[
				'label' => __( 'واحد شمارنده', 'mweb' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'محصول',
				'condition' => [ 'show_count' => ['yes'] ],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_tpo',
				'label' => __( 'تایپوگرافی نام دسته', 'mweb' ),
				'selector' => '{{WRAPPER}} .bk_cat_slider_item strong',
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'counter_tpo',
				'label' => __( 'تایپوگرافی تعداد محصولات', 'mweb' ),
				'selector' => '{{WRAPPER}} .bk_cat_slider_item span',
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'items_border',
				'selector' => '{{WRAPPER}} .bk_cat_slider_item',
				'exclude' => [ 'color' ],
			]
		);
		
		$this->add_control(
			'items_padding',
			[
				'label' => __( 'فاصله داخلی', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bk_cat_slider_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'items_min_height',
			[
				'label' => __( 'حداقل ارتفاع', 'mweb' ),
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
					'{{WRAPPER}} .bk_cat_slider_item' => 'min-height: {{SIZE}}{{UNIT}}',
				],
			]
		);
		
		$this->add_control(
			'hr_img',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		
		$this->add_control(
			'show_cat_icon',
			[
				'label' => __( 'نمایش تصویر دسته', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'yes' => __( 'بله', 'mweb' ),
					'no' => __( 'خیر', 'mweb' ),
				]
			]
		);
		
		$this->add_control(
			'only_has_img',
			[
				'label' => __( 'فقط نمایش عکس دار', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'yes' => __( 'بله', 'mweb' ),
					'no' => __( 'خیر', 'mweb' ),
				],
			]
		);

		$this->add_control(
			'img_border_radius',
			[
				'label' => __( 'گوشه های مدور تصویر', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .bk_cat_slider_item img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 'show_cat_icon' => ['yes'] ],

			]
		);
		
		$this->add_control(
			'item_img_height',
			[
				'label' => __( 'اندازه تصویر', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 40,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
				],

				'selectors' => [
					'{{WRAPPER}} .bk_cat_slider_item img' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 'show_cat_icon' => ['yes'] ],
			]
		);
		
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'img_border',
				'label' => __( 'حاشیه عکس', 'mweb' ),
				'selector' => '{{WRAPPER}} .bk_cat_slider_item img',
				'condition' => [ 'show_cat_icon' => ['yes'] ],
			]
		);
	
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'img_box_shadow',
				'label' => __( 'سایه عکس', 'mweb' ),
				'selector' => '{{WRAPPER}} .bk_cat_slider_item img',
				'condition' => [ 'show_cat_icon' => ['yes'] ],
			]
		);
		
		$this->add_control(
			'show_more_btn',
			[
				'label' => __( 'نمایش دکمه نمایش محصولات', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'yes' => __( 'بله', 'mweb' ),
					'no' => __( 'خیر', 'mweb' ),
				]
			]
		);
		
		$this->add_control(
			'show_more_btn_type',
			[
				'label' => __( 'نوغ نمایش دکمه', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'btn_1',
				'options' => [
					'btn_1' => __( 'یک', 'mweb' ),
					'btn_2' => __( 'دو', 'mweb' ),
					'btn_3' => __( 'سه', 'mweb' ),
				],
				'condition' => [ 'show_more_btn' => ['yes'] ]

			]
		);
		
		$this->start_controls_tabs( 'items_style_tabs' );

		$this->start_controls_tab( 'items_style_normal',
			[
				'label' => __( 'حالت نرمال', 'mweb' ),
			]
		);

		$this->add_control(
			'items_title_color',
			[
				'label' => __( 'رنگ عنوان', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bk_cat_slider_item strong' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'items_counter_color',
			[
				'label' => __( 'رنگ شمارنده', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bk_cat_slider_item .cat_count' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'items_bg_color',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bk_cat_slider_item' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'items_border_color',
			[
				'label' => __( 'رنگ حاشیه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bk_cat_slider_item' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'items_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .bk_cat_slider_item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'icon_filter',
				'selector' => '{{WRAPPER}} .bk_cat_slider_item img',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'item_box_shadow',
				'label' => __( 'سایه', 'mweb' ),
				'selector' => '{{WRAPPER}} .bk_cat_slider_item',
			]
		);
		
		$this->add_control(
			'items_more_btn',
			[
				'label' => __( 'رنگ دکمه بیشتر', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cat_go3, {{WRAPPER}} .cat_go2' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'items_style_hover',
			[
				'label' => __( 'حالت هاور', 'mweb' ),
			]
		);

		$this->add_control(
			'items_title_color_hover',
			[
				'label' => __( 'رنگ عنوان', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bk_cat_slider_item:hover strong' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'items_counter_color_hover',
			[
				'label' => __( 'رنگ شمارنده', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bk_cat_slider_item:hover .cat_count' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'items_bg_color_hover',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bk_cat_slider_item:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'items_border_color_hover',
			[
				'label' => __( 'رنگ حاشیه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bk_cat_slider_item:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'item_border_radius_hover',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .bk_cat_slider_item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'item_box_shadow_hover',
				'label' => __( 'سایه', 'mweb' ),
				'selector' => '{{WRAPPER}} .bk_cat_slider_item:hover',
			]
		);
		
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'icon_filter_hover',
				'selector' => '{{WRAPPER}} .bk_cat_slider_item:hover img',
			]
		);
		
		$this->add_control(
			'items_more_btn_hover',
			[
				'label' => __( 'رنگ دکمه بیشتر', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bk_cat_slider_item:hover .cat_go3, {{WRAPPER}} .bk_cat_slider_item:hover .cat_go2' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'items_transition',
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
					'{{WRAPPER}} .bk_cat_slider_item' => 'transition: all {{SIZE}}s',
				],
			]
		);

		$this->end_controls_tab();
		
		$this->end_controls_tabs();
		
				
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'نمایش', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$slides_to_show = range( 1, 20 );
		$slides_to_show = array_combine( $slides_to_show, $slides_to_show );
		
		$this->add_responsive_control(
			'slides_to_show',
			[
				'label' => __( 'اسلاید جهت نمایش', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'پیشفرض', 'mweb' ),
				] + $slides_to_show,
				'default' => 8,
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
	
	
	protected function render() {
		$settings = $this->get_settings_for_display();

		if( empty($settings['has_include']) && !isset($settings['has_parent']) ){
			
			echo mweb_error('دسته ای انتخاب نشده است !');
			
		} else {
		
			$cat_args = array(
				'taxonomy' => 'product_cat',
				'orderby' => 'name',
				'order'   => 'ASC'
			);
			
			if( $settings['hide_empty'] == 'yes'){
				$cat_args['hide_empty'] = false;
			}
			
			if( $settings['is_archive'] == 'no' ){
				if( !empty($settings['has_include']) ){
					$cat_args['include'] = implode(',', $settings['has_include']);
				}
				
				if( !empty($settings['has_parent']) ){
					if( $settings['top_level'] == 'yes' ){
						$cat_args['parent'] = (int) $settings['has_parent'];
					}else{
						$cat_args['child_of'] = (int) $settings['has_parent'];
					}
				}else{
					if( $settings['top_level'] == 'yes' ){
						$cat_args['parent'] = 0;
					}
				}
			}else{
				$category_ar = get_queried_object();

				if( !empty($category_ar) ){
					if( $settings['top_level'] == 'yes' ){
						$cat_args['parent'] = (int) $category_ar->term_id;
					}else{
						$cat_args['child_of'] = (int) $category_ar->term_id;
					}
				}else{
					if( $settings['top_level'] == 'yes' ){
						$cat_args['parent'] = 0;
					}
				}
			}
			
		   
			$categories = get_categories( $cat_args );
			
			if( !empty($categories) ){
				
		
				$block_options = array('block_id' => 'bk_'.$this->get_id() ,'block_name' => 'mweb_categories', 'block_options' => array( 'title' => $settings['title'],'icon' => $settings['title_picon'] ));
		
				
				$show_dots = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
				$show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
				
				$data_setting = array();
				
				$data_setting['slidesPerView'] = 1;
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

				$slide_tablet = empty($settings['slides_to_show_tablet']) ? 2 : $settings['slides_to_show_tablet'];
				$slide_mobile = empty($settings['slides_to_show_mobile']) ? 1 : $settings['slides_to_show_mobile'];

				$data_setting['breakpoints'] = array('575' => array('slidesPerView' => $slide_mobile), '768' => array('slidesPerView' => $slide_tablet), '1024' => array('slidesPerView' => $settings['slides_to_show']));
					

		
				$only_has_img = $settings['only_has_img'] == "yes" ? true : false;
				
				$item_count = count($categories);
				$item_counter = 0;
					
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
							
				

				echo \mweb_theme_block::block_open( $block_options );
				echo \mweb_theme_block::block_header( $block_options );
				echo \mweb_theme_block::block_content_open();
				
					echo '<div '. $this->get_render_attribute_string( 'carousel-wrapper' ) .'>';
					echo '<div class="swiper-wrapper">';
					
					foreach( $categories as $category ) :
					
						$term_link = get_term_link( $category , 'product_cat' );
						$classes = 'bk_cat_slider_item';
						$item_img = '';
						if( $settings['show_cat_icon'] == "yes" && $settings['block_type'] == 'style_one' || empty( $settings['block_type'] ) ){
							$image_id = get_term_meta ( $category->term_id, 'thumbnail_id', true );
							if( empty($image_id) ){
								if( !empty($only_has_img) )
									continue;
								
							}else{
								$item_img = wp_get_attachment_image( $image_id, 'thumbnail' );
								$classes .= ' has_img';	
							}
						}
						
						$bg_image = '';
						$img_id = get_term_meta( $category->term_id, 'representative_image', true);
						if( !empty( $img_id ) && $settings['block_type'] == 'style_two' ){
							$bg_image = '<span style="background-image: url('.wp_get_attachment_image_url( $img_id, 'medium' ).');"></span>'; 
						}	
						
						if ( $term_link ) {
							echo '<div class="swiper-slide"><a class="'.$classes.' cat_'.$settings['block_type'].'" href="'.$term_link.'">'.$bg_image.$item_img.'<strong>'.$category->name.'</strong>';
							if( $settings['show_count'] == 'yes' ) echo '<span class="cat_count">+'.$category->count.' '.$settings['counter_title'].'</span>';
							if( $settings['show_more_btn'] == 'yes' ){
								switch( $settings['show_more_btn_type'] ){
									case 'btn_2':
										echo '<span class="cat_go3"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-left"></use></svg></span>';
									break;
									case 'btn_3':
										echo '<span class="cat_go2"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-down-1"></use></svg></span>';
									break;
									default:
										echo '<span class="cat_go"><b>مشاهده</b><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#add-square"></use></svg></span>';
								}
							} 
							echo '</a></div>';
						}
						$item_counter++;
						if( $item_counter > $settings['cat_to_show'] )
							break;
						
					endforeach;

					echo '</div>';	
						if ( $show_dots ) { 
							echo '<div class="mweb-swiper-pagination"></div>';
						} 
						if ( $show_arrows ){
							echo '<div class="mweb-swiper-next"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#'.$arrow_right.'"></use></svg></div><div class="mweb-swiper-prev"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#'.$arrow_left.'"></use></svg></div>';
						}			
					echo '</div>';		
					
				echo \mweb_theme_block::block_content_close();
				echo \mweb_theme_block::block_footer( $block_options );
				echo \mweb_theme_block::block_close();
				
	
			}
		
		}

	}

	
	protected function content_template() {
		
	}
}

