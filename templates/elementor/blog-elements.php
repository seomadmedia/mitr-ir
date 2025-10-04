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
 * Elementor Blog Breadcrumbs
 * @since 1.0.0
 */
class My_Blog_Breadcrumbs extends Widget_Base {

	
	public function get_name() {
		return 'mweb-blog-breadcrumbs';
	}
	
	public function get_title() {
		return __( 'مسیر جاری', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-product-breadcrumbs';
	}

	public function get_categories() {
		return [ 'digiland_blog' ];
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
					'{{WRAPPER}} .breadcrumb-arrow' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'link_color',
			[
				'label' => __( 'رنگ لینک', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .breadcrumb-arrow li a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'selector' => '{{WRAPPER}} .breadcrumb-arrow',
			]
		);
		
		$this->add_control(
			'type_delimiter',
			[
				'label' => __( 'نوع جداکننده', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'arrow-left-1'   => __( 'یک', 'mweb' ),
					'more'   => __( 'دو', 'mweb' ),
					'arrow-left'   => __( 'سه', 'mweb' ),
					'arrow-circle-left'   => __( 'چهار', 'mweb' ),
				],
				'default' => 'more',
			]
		);
		
		
		$this->add_control(
			'sep_size',
			[
				'label' => __( 'اندازه جدا کننده', 'mweb' ),
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
					'size' => 17,
				],
				'selectors' => [
					'{{WRAPPER}} .breadcrumb-arrow li svg' => 'width: {{SIZE}}{{UNIT}};',
				]
			]
		);
		
		$this->add_control(
			'sep_color',
			[
				'label' => __( 'رنگ جدا کننده', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#b1b7c9',
				'selectors' => [
					'.woocommerce {{WRAPPER}} .breadcrumb-arrow li svg' => 'stroke: {{VALUE}}',
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
					'{{WRAPPER}} .breadcrumb-arrow' => 'text-align: {{VALUE}}',
				],
			]
		);
		
		
		$this->end_controls_section();
		


	}

	
	protected function render() {
		$settings = $this->get_settings_for_display();
		$delimiter = '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#'.$settings['type_delimiter'].'"></use></svg>'; 
		
		mweb_get_breadcrumbs( 0, null, false, $delimiter );
	}

	
	protected function content_template() {
		
	}
}





/**
 * Elementor Blog Title
 * @since 1.0.0
 */
class My_Blog_Title extends Widget_Base {

	
	public function get_name() {
		return 'mweb-blog-title';
	}
	
	public function get_title() {
		return __( 'عنوان مقاله', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-product-title';
	}

	public function get_categories() {
		return [ 'digiland_blog' ];
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
					'{{WRAPPER}} .entry-title h1' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .entry-title h1',
			]
		);
		
		$this->add_control(
			'display_icon',
			[
				'label' => __( 'نمایش آیکن', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			]
		);
		
		$this->add_control(
			'icon_size',
			[
				'label' => __( 'اندازه آیکن', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .entry-title i' => 'width: {{SIZE}}{{UNIT}}',
				],
				'condition' => [ 'display_icon' => ['yes'] ],
			]
		);
		
		$this->add_control(
			'icon_margin',
			[
				'label' => esc_html__( 'فاصله خارجی آیکن', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .entry-title svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 'display_icon' => ['yes'] ],
			]
		);
		
		$this->add_control(
			'title_icon_color',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .entry-title svg' => 'stroke: {{VALUE}}',
				],
				'condition' => [ 'display_icon' => ['yes'] ],
			]
		);
		
		$this->add_control(
			'only_display_icon',
			[
				'label' => __( 'فقط نمایش آیکن', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'condition' => [ 'display_icon' => ['yes'] ],
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
					'{{WRAPPER}} .entry-title' => 'text-align: {{VALUE}}',
				],
			]
		);
		
		

		$this->end_controls_section();
		


	}

	
	protected function render() {
		$settings = $this->get_settings_for_display();
		
		if( $settings['only_display_icon'] !== 'yes' ) {
			echo '<div class="entry-title">';
				echo '<h1>';
		}
		
				if( $settings['display_icon'] == 'yes' )
					echo mweb_post_format_icon();
				if( $settings['only_display_icon'] !== 'yes' )
					the_title();
				
		if( $settings['only_display_icon'] !== 'yes' ) {

				echo '</h1>';
			echo '</div>';
	
		}
		
	}

	
	protected function content_template() {
		
	}
}





/**
 * Elementor Blog Meta
 * @since 1.0.0
 */
class My_Blog_Meta extends Widget_Base {

	
	public function get_name() {
		return 'mweb-blog-meta';
	}
	
	public function get_title() {
		return __( 'متای وبلاگ', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-product-meta';
	}

	public function get_categories() {
		return [ 'digiland_blog' ];
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
		
		$this->add_control(
			'show_icon',
			[
				'label' => __( 'نمایش آیکن', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'prefix_class' => 'elementor-woo-meta-shwo-icon-',
			]
		);
		
		$this->add_control(
			'item_icon_size',
			[
				'label' => __( 'اندازه آیکن', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
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
					'.woocommerce {{WRAPPER}} .product_meta>span svg' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 'show_icon' => ['yes'] ],
			]
		);
		
		$this->add_control(
			'item_icon_color',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.woocommerce {{WRAPPER}} .product_meta>span svg' => 'stroke: {{VALUE}}',
				],
				'condition' => [ 'show_icon' => ['yes'] ],
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
					'{{WRAPPER}} span.minute' => 'color: {{VALUE}}',
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
					'p_reading' => __( 'زمان مطالعه', 'mweb' ),
					'p_cat' => __( 'دسته بندی محصول', 'mweb' ),
					'p_tag' => __( 'برچسب محصول', 'mweb' ),
					'p_publish' => __( 'تاریخ انتشار', 'mweb' ),
					'p_modified' => __( 'تاریخ ویرایش', 'mweb' ),
					'p_views' => __( 'تعداد بازدید', 'mweb' ),
					'p_author' => __( 'نویسنده', 'mweb' ),
				],
			]
		);
		
	
		
		$this->end_controls_section();
		


	}
	
	
	public function get_item_icon( $show_icon , $element ) {
		
		$array_icon = array(
			'p_reading' => 'book-1',
			'p_cat' => 'folder-open',
			'p_tag' => 'tag',
			'p_publish' => 'calendar-2',
			'p_modified' => 'calendar',
			'p_views' => 'eye',
			'p_author' => 'user-edit',
		);
		if($show_icon == 'yes')
			return '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#'.$array_icon[$element].'"></use></svg>';
		
		return false;
		
	}

	
	protected function render() {
	
		global $post;

		if ( !is_single() && 'post' != get_post_type() ) {
			return;
		}
		
		
		$settings = $this->get_settings_for_display();
		$item_to_show = empty($settings['item_to_show']) ? array() : $settings['item_to_show'];
		
		if ( empty($item_to_show) )
			return;
		
		?>
		<div class="product_meta">

			<?php
			
				if( in_array('p_reading', $item_to_show) ){
					$the_content = apply_filters('the_content', get_the_content());
					printf('<span class="reading_time_wrapper detail-container">'.$this->get_item_icon($settings['show_icon'], 'p_reading').'<span class="detail-label">زمان مطالعه : </span> <span class="detail-content minute">%s</span>  دقیقه</span>', mweb_estimate_reading_time_in_minutes($the_content) );
				}
				
				if( in_array('p_publish', $item_to_show) ) 
					echo '<span class="publish_date detail-container">'.$this->get_item_icon($settings['show_icon'], 'p_publish').'' . sprintf( __( '<span class="detail-label">تاریخ انتشار : </span><span>%s</span>', 'woocommerce' ), get_the_date( 'j  F  Y', get_the_ID() ) ) . '</span>';
				
				if( in_array('p_modified', $item_to_show) ){
					$last_modified_date = get_post_meta( get_the_ID(), '_custom_last_modified', true );
					if( empty($last_modified_date) ){
						echo '<span class="publish_date modified detail-container">'.$this->get_item_icon($settings['show_icon'], 'p_modified').'<span class="detail-label">'.apply_filters('mweb_modified_date_text', 'آخرین بروزرسانی').' :</span> <span>'.get_the_modified_date( get_option( 'date_format' ) ).'</span></span>';
					}else{
						echo '<span class="publish_date modified detail-container">'.$this->get_item_icon($settings['show_icon'], 'p_modified').'<span class="detail-label">'.apply_filters('mweb_modified_date_text', 'آخرین بروزرسانی').' :</span> <span>'.date_i18n( get_option( 'date_format' ), strtotime( $last_modified_date ) ).'</span></span>';
					}
				}
				
				if( in_array('p_views', $item_to_show) ){
					$n_view = empty(mweb_theme_post_view_real()) ? 0 : mweb_theme_post_view_real();
					echo '<span class="total_view detail-container">'.$this->get_item_icon($settings['show_icon'], 'p_views').'' . sprintf( __( '<span class="detail-label">تعداد بازدید : </span><span>%s</span>', 'woocommerce' ), $n_view ) . '</span>';
				}
				
				if( in_array('p_author', $item_to_show) ){
					printf('<span class="author detail-container">'.$this->get_item_icon($settings['show_icon'], 'p_author').'<span class="detail-label">نویسنده : </span> <span class="detail-content minute">%s</span></span>', get_the_author_posts_link() );
				}
				
			?>
			
			<?php if ( !empty( get_the_category() ) && in_array('p_cat', $item_to_show) ) : ?>
				<span class="posted_in detail-container"><?= $this->get_item_icon($settings['show_icon'], 'p_cat') ?><span class="detail-label">دسته بندی : </span> <span class="detail-content"><?php the_category( ', ' ); ?></span></span>
			<?php endif; ?>

			<?php if ( !empty( get_the_tags() ) && in_array('p_tag', $item_to_show) ) : ?>
				<span class="tagged_as detail-container"><?= $this->get_item_icon($settings['show_icon'], 'p_tag') ?><span class="detail-label">برچسب ها : </span> <span class="detail-content"><?php the_tags('', ', ', ''); ?></span></span>
			<?php endif; ?>


		</div>
		<?php

	}

	
	protected function content_template() {
		
	}
}





/**
 * Elementor Blog Tools
 * @since 1.0.0
 */
class My_Blog_Tools extends Widget_Base {

	
	public function get_name() {
		return 'mweb-blog-tools';
	}
	
	public function get_title() {
		return __( 'ابزار وبلاگ', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-tools';
	}

	public function get_categories() {
		return [ 'digiland_blog' ];
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
			'title',
			[
				'label' => __( 'عنوان ابزار', 'mweb' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'show_tooltips',
			[
				'label' => __( 'فقط نمایش آیکن', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بلی', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'item_to_show',
			[
				'label' => __( 'نمایش ابزار', 'mweb' ),
				'type' => Controls_Manager::SELECT2,
				//'multiple' => true,
				'options' => [
					'p_print' => __( 'چاپ', 'mweb' ),
					'p_like' => __( 'لایک', 'mweb' ),
					'p_share' => __( 'اشتراک گذاری', 'mweb' ),
					'p_shortlink' => __( 'لینک کوتاه', 'mweb' ),
					'p_reading' => __( 'زمان مطالعه', 'mweb' ),
					'p_wishlist' => __( 'علاقه مندی', 'mweb' ),
					'p_fontsize' => __( 'اندازه فونت', 'mweb' ),
				],
			]
		);
		
		$this->add_control(
			'share_type',
			[
				'label' => __( 'نمایش', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'static',
				'options' => [
					'static' => __( 'ثابت', 'mweb' ),
					'modal' => __( 'دکمه / مودال', 'mweb' ),
				],
				'condition' => [ 'item_to_show' => ['p_share'] ]
			]
		);
		
		$this->add_control(
			'hr_style',
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
					'{{WRAPPER}} .elm_blog_tools' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .elm_blog_tools',
			]
		);
		
		$this->add_control(
			'link_color',
			[
				'label' => __( 'رنگ لینک کوتاه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elm_blog_tools input' => 'color: {{VALUE}}',
				],
				'condition' => [ 'item_to_show' => ['p_shortlink'] ]
			]
		);
		
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elm_blog_tools svg' => 'stroke: {{VALUE}}',
					'{{WRAPPER}} .btn_share ul li a svg' => 'stroke: {{VALUE}}; fill: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'icon_color_hover',
			[
				'label' => __( 'رنگ آیکن هاور / فعال', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elm_blog_tools:hover svg:not(.fbtn)' => 'stroke: {{VALUE}}',
					'{{WRAPPER}} .btn_share ul li:hover a svg' => 'stroke: {{VALUE}}; fill: {{VALUE}}',
					'{{WRAPPER}} .elm_blog_tools.added svg' => 'stroke: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'icon_size',
			[
				'label' => __( 'اندازه آیکن', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .elm_blog_tools svg' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .btn_share ul li svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'icon_space',
			[
				'label' => __( 'فاصله آیکن', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elm_blog_tools svg' => 'margin-left: {{SIZE}}{{UNIT}}',
				],
			]
		);
		
		$this->add_control(
			'left_icon',
			[
				'label' => __( 'نمایش آیکن سمت چپ', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'prefix_class' => 'elementor-tools-alignLeft-',
			]
		);
		
		$this->add_control(
			'num_color',
			[
				'label' => __( 'رنگ اعداد', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elm_blog_tools .count' => 'color: {{VALUE}}',
				],
				'condition' => [ 'item_to_show' => ['p_like', 'p_reading'] ]

			]
		);
		
		$this->add_control(
			'num_size',
			[
				'label' => __( 'اندازه اعداد', 'mweb' ),
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
				'selectors' => [
					'{{WRAPPER}} .elm_blog_tools .count' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 'item_to_show' => ['p_like', 'p_reading'] ]
			]
		);
	
		
		$this->end_controls_section();
		


	}
	

	
	protected function render() {
	
		global $post;

		if ( !is_single() && 'post' != get_post_type() ) {
			return;
		}
		
		
		$settings = $this->get_settings_for_display();
		$item_to_show = $settings['item_to_show'];
		
		if ( empty($item_to_show) )
			return;
		
			$title = $settings['show_tooltips'] == 'yes' ? null : $settings['title'];
			$attr =  $settings['show_tooltips'] == 'yes' ? ' title="'.$settings['title'].'"' : null;
	
			
			if( 'p_print' == $item_to_show ){
				echo '<div class="btn_print elm_blog_tools"'.$attr.'><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#printer"></use></svg>'.$title.'</div>';
			}
			
			if( 'p_like' == $item_to_show ){
				$likes = get_post_meta(get_the_ID(), '_likes', true);
				echo '<div class="btn_like elm_blog_tools" data-id="'.get_the_ID().'"'.$attr.'><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#heart"></use></svg><p>'.$title.'<span class="count">'. ( empty($likes) ? 0 : $likes ) .'</span></p></div>';
			}
			
			if( 'p_share' == $item_to_show ){
				if( $settings['share_type'] == 'modal' ){
					echo '<a href="#popup-share-wrap" rel="modal:open" class="btn_share elm_blog_tools" href="#"'.$attr.'><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#share"></use></svg>'.$title.'</a>';
					echo '<div id="popup-share-wrap" class="modal">';
						echo '<p>با استفاده از روش‌های زیر می‌توانید این صفحه را با دوستان خود به اشتراک بگذارید.</p>';
					echo '<div class="product_share coloring">';
				}else{
					echo '<div class="btn_share elm_blog_tools no_modal">';
					echo $settings['left_icon'] !== 'yes' ? '<p><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#share"></use></svg>'.$title.'</p>' : $title;
				}
					$links = mweb_get_product_share_list();
					if ( is_array($links) ){
						echo '<ul>';
						echo implode( '', $links);
						echo '</ul>';
					}
			
				if( $settings['share_type'] == 'modal' ){
					echo '</div>';
					echo '<div class="product_shortlink"><input class="text_copy" onClick="this.select();" value="'.wp_get_shortlink().'" /><i class="btn_copy"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#copy"></use></svg></i></div>';
				}
				echo'</div>';
			}
			
			if( 'p_shortlink' == $item_to_show ){
				echo '<div class="btn_shortlink product_shortlink elm_blog_tools">';
					echo '<span class="btn_copy"'.$attr.'><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#copy"></use></svg>'.$title.'</span><input class="text_copy" onClick="this.select();" value="'.wp_get_shortlink().'" readonly="readonly"/>';
				echo'</div>';
			}
			
			if( 'p_reading' == $item_to_show ){
				$the_content = apply_filters('the_content', get_the_content());
				echo '<div class="btn_reading elm_blog_tools"'.$attr.'><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#glass-1"></use></svg><p>'.$title.'<span class="count">'. mweb_estimate_reading_time_in_minutes($the_content, 200) .'</span> دقیقه</p></div>';
			}
			
			if( 'p_wishlist' == $item_to_show ){
				$flag = $settings['show_tooltips'] == 'yes' ? true : false;
				\mweb_wishlist::mweb_blog_add_wishlist(get_the_ID(), $settings['title'], 'post', $flag);
			}
			
			if( 'p_fontsize' == $item_to_show ){
				echo '<div class="btn_fontsize elm_blog_tools"'.$attr.'><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#text-block"></use></svg><p>'.$title.'<span class="fontsize_change"><i class="increase fbtn"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#add-square"></use></svg></i><b>12</b><i class="decrease fbtn"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#minus-square"></use></svg></i></span></p></div>';
			}


	}

	
	protected function content_template() {
		
	}
}






/**
 * Elementor Module Related Post
 * @since 1.0.0
 */
class My_Blog_Related extends Widget_Base {

	
	public function get_name() {
		return 'block-related-posts';
	}

	
	public function get_title() {
		return __( 'مطالب مرتبط', 'mweb' );
	}

	 
	public function get_icon() {
		return 'eicon-posts-carousel';
	}

	
	public function get_categories() {
		return [ 'digiland_blog' ];
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
				'label' => __( 'فیلتر', 'mweb' ),
			]
		);
		
		$this->add_control(
			'posts_per_page',
			[
				'label' => __( 'تعداد مطالب', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 4,
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
					'mweb_loop_template_blog_1' => __( 'یک', 'mweb' ),
					'mweb_loop_template_blog_2' => __( 'دو', 'mweb' ),
					'mweb_loop_template_blog_3' => __( 'سه', 'mweb' ),
					'mweb_loop_template_blog_4' => __( 'چهار', 'mweb' ),
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
					'{{WRAPPER}} .blog-posts-content-4 .post-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .blog-posts-content-2 .grid_image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .blog-posts-content .post-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} 25px;',
					'{{WRAPPER}} .blog-posts-content .item-area:hover .post-image a:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} 25px;',
				],
			]
		);
		
		$this->add_control(
			'img_border_radius',
			[
				'label' => __( 'گوشه های مدور عکس', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .blog-posts-content-4 .post-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .blog-posts-content-4 .item-area:hover .post-image a:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 'block_name' => ['mweb_loop_template_blog_4'] ],
			]
		);
		
		$this->add_control(
			'item_height',
			[
				'label' => __( 'ارتفاع', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
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
				'selector' => '{{WRAPPER}} .item .item-area, {{WRAPPER}} .blog-posts-content-2 .grid_image',
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'slider_style',
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

		$loop_name = !empty($settings['loop_tmp']) ? $settings['loop_tmp'] : 'mweb_loop_template_blog_1';

		if($loop_name == 'mweb_loop_template_blog_1'){
			$block_class = 'blog-posts-content';
		}elseif($loop_name == 'mweb_loop_template_blog_2'){
			$block_class = 'blog-posts-content-2';
		}elseif($loop_name == 'mweb_loop_template_blog_3'){
			$block_class = 'blog-posts-content-3';
		}else{
			$block_class = 'blog-posts-content-4';
		}
		

		$related_data = \mweb_theme_post_related::get_data( $settings['posts_per_page'] );

				
		$block = array('block_id' => 'mweb_'.$this->get_id(), 'block_name' => 'mweb_'.$this->get_name(), 'block_classes' => $block_class );
		$block['block_options'] = array('title' => $settings['title'], 'icon' => $settings['title_picon']);

		
		
		echo \mweb_theme_block::block_open( $block );
		echo \mweb_theme_block::block_header( $block );
		echo \mweb_theme_block::block_content_open();
		
		//check empty
		if ( ! empty( $related_data ) ) {
			
			echo '<div '. $this->get_render_attribute_string( 'carousel-wrapper' ) .'>';
			echo '<div class="swiper-wrapper">';
			foreach ( $related_data as $post ) : 
				setup_postdata( $GLOBALS['post'] =& $post );
				echo '<div class="swiper-slide"><div class="item">';
					echo $loop_name(array('thumbnail' => $settings['item_thumbnail_size']));
				echo '</div></div>';
			endforeach;
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





/**
 * Elementor Module Comments
 * @since 1.0.0
 */
class My_Blog_Comments extends Widget_Base {

	
	public function get_name() {
		return 'block-comment-post';
	}

	
	public function get_title() {
		return __( 'دیدگاه ها', 'mweb' );
	}

	 
	public function get_icon() {
		return 'eicon-comments';
	}

	
	public function get_categories() {
		return [ 'digiland_blog' ];
	}


	protected function register_controls() {
		
		
		$this->start_controls_section(
			'section_header',
			[
				'label' => __( 'سربرگ', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
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
			'form_style',
			[
				'label' => __( 'فرم ارسال', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'form_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .comment-reply-form, {{WRAPPER}} .comment-reply-form a' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'form_bg_color',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .comment-reply-form' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'form_padding',
			[
				'label' => __( 'فاصله داخلی', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .comment-reply-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'form_border',
				'selector' => '{{WRAPPER}} .comment-reply-form',
			]
		);
		
		$this->add_control(
			'form_border_radius',
			[
				'label' => __( 'گوشه های مدور چهارچوب', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .comment-reply-form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'form_box_shadow',
				'label' => __( 'سایه چهارچوب', 'mweb' ),
				'selector' => '{{WRAPPER}} .comment-reply-form',
			]
		);
		
		$this->add_control(
			'hr_form',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		
		$this->add_control(
			'form_i_color',
			[
				'label' => __( 'رنگ متن فیلدها', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .comment-respond .form-control, {{WRAPPER}} .comment-respond .form-control::-webkit-input-placeholder' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'form_i_bg_color',
			[
				'label' => __( 'رنگ پس زمینه فیلدها', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .comment-respond .form-control' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'form_i_border',
				'selector' => '{{WRAPPER}} .comment-respond .form-control',
			]
		);
		
		$this->add_control(
			'form_i_border_radius',
			[
				'label' => __( 'گوشه های مدور فیلدها', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .comment-respond .form-control' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		
		$this->add_control(
			'hr_form_2',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		
		
		$this->add_control(
			'form_b_color',
			[
				'label' => __( 'رنگ متن دکمه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .comment-respond .submit' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'form_b_bg_color',
			[
				'label' => __( 'رنگ پس زمینه دکمه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .comment-respond .submit' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'form_b_border_radius',
			[
				'label' => __( 'گوشه های مدور دکمه', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .comment-respond .submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'form_b_padding',
			[
				'label' => __( 'فاصله داخلی دکمه', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .comment-respond .submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'list_style',
			[
				'label' => __( 'لیست دیدگاه ها', 'mweb' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'list_padding',
			[
				'label' => __( 'فاصله داخلی', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .comments-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'list_bgcolor',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .comments-area, {{WRAPPER}} .comments-area .block-title .title, {{WRAPPER}} .comments_number' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .comments_number:after' => 'border-top-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'list_border',
				'selector' => '{{WRAPPER}} .comments-area',
			]
		);
		
		$this->add_control(
			'list_border_radius',
			[
				'label' => __( 'گوشه های مدور چهارچوب', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .comments-area' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'list_box_shadow',
				'label' => __( 'سایه چهارچوب', 'mweb' ),
				'selector' => '{{WRAPPER}} .comments-area',
			]
		);
		
		$this->add_control(
			'hr_form_3',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
				
		$this->add_control(
			'list_li_color',
			[
				'label' => __( 'رنگ متن دیدگاه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .comments-area>ul li.comment>article, {{WRAPPER}} .comments-area>ul li.comment>article .comment-top .comment-meta .action-link a' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'list_li_head_color',
			[
				'label' => __( 'رنگ سربرگ دیدگاه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .comment-top, {{WRAPPER}} .comments_number' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'list_li_bgcolor',
			[
				'label' => __( 'رنگ پس زمینه دیدگاه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .comments-area>ul li.comment>article .comment-content, {{WRAPPER}} .comments-area>ul li.comment>article .comment-top .comment-meta .action-link a' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .comments-area>ul li.comment>article .comment-content:before' => 'border-bottom-color: {{VALUE}}',
				],
			]
		);
		
		
		$this->end_controls_section();

		
	}

	
	protected function render() {
		
		$settings = $this->get_settings_for_display();
		
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
		
	
	}

	
	protected function content_template() {
		
	}
}
