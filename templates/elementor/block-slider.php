<?php
namespace ElementorMahdisweb\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Module Slider
 * @since 1.0.0
 */
class Block_Slider extends Widget_Base {


	public function get_name() {
		return 'block-slider';
	}


	public function get_title() {
		return __( 'اسلایدر', 'mweb' );
	}


	public function get_icon() {
		return 'eicon-slider-push';
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
				'options' => get_element_category_list('slider_category'),
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
			'posts_per_page',
			[
				'label' => __( 'تعداد اسلاید', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 5,
				'min' => 1,
			]
		);
		
		$this->add_control(
			'offset',
			[
				'label' => __( 'نقطه شروع اسلاید', 'mweb' ),
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
				'default' => 'full',
			]
		);
		
		$this->add_control(
			'border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .product_banner_slider' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .product_banner_slider',
			]
		);
		
		$this->add_control(
			'show_arrow',
			[
				'label' => __( 'نمایش جهت نمای پیکان', 'mweb' ),
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


	protected function render() {
		
		$settings = $this->get_settings_for_display();
		
		$query_options = array('category_id' => $settings['category_id'], 'posts_per_page' => $settings['posts_per_page'], 'orderby' => $settings['orderby'], 'offset' => $settings['offset'], 'post_type' => 'slider' );
				
		$block = array('block_id' => 'mweb_'.$this->get_id(), 'block_name' => 'mweb_'.$this->get_name(), 'block_options' => $query_options);
		
		$query_data = \mweb_theme_query::get_custom_query( $query_options );

		
		//echo  \mweb_theme_block::block_open( $block, $query_data );
		//echo  \mweb_theme_block::block_header( $block );
		echo \mweb_theme_block::block_content_open('product_banner_slider');
		
			if ( $query_data->have_posts() ) {
			?>
			<div class="swiper slick_slider_wrap" dir="rtl" id="<?= 'sl_'.$this->get_id(); ?>">
				<div class="swiper-wrapper">
				<?php while ( $query_data->have_posts() ) : ?>
					<?php $query_data->the_post(); ?>
					<div class="swiper-slide">
						<?php echo mweb_loop_template_slider(array('thumbnail' => $settings['item_thumbnail_size'])); ?>
					</div>
				<?php endwhile; ?>
				</div>
				<div class="swiper-pagination"></div>
				<?php
					if ( $settings['show_arrow'] == 'yes' ){
						echo '<div class="mweb-swiper-next"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-right-1"></use></svg></div><div class="mweb-swiper-prev"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-left-1"></use></svg></div>';
					}
				?>
			</div>			
			<?php
			} else {
				echo mweb_no_content();
			}
			
			//reset post data
			wp_reset_postdata();
		
		echo \mweb_theme_block::block_content_close();
		//echo \mweb_theme_block::block_footer( $block );
		//echo \mweb_theme_block::block_close();
		
	}

	protected function content_template() {
		
	}
	
}
