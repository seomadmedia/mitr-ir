<?php
namespace ElementorMahdisweb\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly



/**
 * Elementor Footer Menu
 * @since 1.0.1
 */
class My_Footer_Menu extends Widget_Base {

	
	public function get_name() {
		return 'my-footer-menu';
	}
	
	public function get_title() {
		return __( 'منو', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-menu-toggle';
	}

	public function get_categories() {
		return [ 'digiland_footer' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'منو', 'mweb' ),
			]
		);
		
		$this->add_control(
			'title',
			[
				'label' => __( 'عنوان', 'mweb' ),
				'type' => Controls_Manager::TEXT,
				'description' => ''
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'تایپوگرافی عنوان', 'mweb' ),
				'selector' => '{{WRAPPER}} .title_list',
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
			'color_title',
			[
				'label' => __( 'رنگ عنوان', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .footer_list .title_list' => 'color: {{VALUE}}',
					'{{WRAPPER}} .footer_list .title_list:after' => 'background-color: {{VALUE}}',
				]
			]
		);
		
		$this->add_control(
			'title_shape',
			[
				'label' => __( 'علامت کنار عنوان', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'prefix_class' => 'elementor-footer-menu-before_',
			]
		);
		
		$this->add_control(
			'title_shape_color',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .footer_list .title_list:before' => 'background-color: {{VALUE}}',
				],
				'condition' => [ 'title_shape' => ['yes'] ],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'label' => __( 'تایپوگرافی متن', 'mweb' ),
				'selector' => '{{WRAPPER}} .footer_list ul li a',
			]
		);
		
		$this->add_control(
			'color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .footer_list ul li a' => 'color: {{VALUE}}',
				]
			]
		);
		
		$this->add_control(
			'hover_color',
			[
				'label' => __( 'رنگ متن هاور', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .footer_list ul li a:hover' => 'color: {{VALUE}}',
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
		?>
		<div class="footer_list">
			<?php if(!empty($settings['title'])): ?><div class="title_list"><?php echo $settings['title']; ?></div><?php endif; ?>
			<?php
				wp_nav_menu( array(
					'menu' => $settings['menu'],
					'container' => false, 
					'menu_id' => '',
					'menu_class' => ''
				));
			?>
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
 * Elementor Footer Namad
 * @since 1.0.0
 */
class My_Footer_Namad extends Widget_Base {

	
	public function get_name() {
		return 'my-footer-namad';
	}
	
	public function get_title() {
		return __( 'نماد / اسلایدر', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-slides';
	}

	public function get_categories() {
		return [ 'digiland_footer' ];
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
				'description' => ''
			]
		);
		
		$this->add_control(
			'color_title',
			[
				'label' => __( 'رنگ عنوان', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title_list' => 'color: {{VALUE}}',
				]
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'تایپوگرافی عنوان', 'mweb' ),
				'selector' => '{{WRAPPER}} .title_list',
			]
		);
		
		$this->add_control(
			'title_shape',
			[
				'label' => __( 'علامت کنار عنوان', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'prefix_class' => 'elementor-footer-menu-before_',
			]
		);
		
		$this->add_control(
			'title_shape_color',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .footer_list .title_list:before' => 'background-color: {{VALUE}}',
				],
				'condition' => [ 'title_shape' => ['yes'] ],
			]
		);
		
		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
			'list_code',
			[
				'label' => __( 'کد نماد', 'mweb' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => '',
				'description' => ''
			]
		);
		
		$this->add_control(
			'list',
			[
				'label' => __( 'ایتم ها', 'mweb' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ list_code }}}',
			]
		);
		
		$this->add_control(
			'navigation',
			[
				'label' => __( 'جهت بندی', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
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
			'max_width',
			[
				'label' => __( 'حداکثر عرض', 'mweb' ),
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
					'{{WRAPPER}} img' => 'max-width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} img' => 'max-height: {{SIZE}}{{UNIT}};',
				],
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
		
		$data_setting = array();

		$data_setting['slidesPerView'] = 1;
		$data_setting['spaceBetween'] = 0;
		$data_setting['watchSlidesVisibility'] = true;
		$data_setting['loop'] = true;
		$data_setting['autoplay'] = true;
		$data_setting['touchMoveStopPropagation'] = true;
		
		$show_dots = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
		$show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
	
		if( $show_dots ){
			$data_setting['pagination'] = array('el' => '.mweb-swiper-pagination', 'clickable' => true);
		}
		if( $show_arrows ){
			$data_setting['navigation'] = array('nextEl' => '.mweb-swiper-next', 'prevEl' => '.mweb-swiper-prev' );
		}
		
		if ( $settings['list'] ) {
		echo '<div class="footer_list namad_slider">';
			if(!empty($settings['title']))
				echo '<div class="title_list">'.$settings['title'].'</div>';
			echo '<div class="swiper xslider no_auto" dir="rtl" id="sl_'.$this->get_id().'" data-slider="'. esc_attr(wp_json_encode($data_setting)) .'">';
				echo '<div class="swiper-wrapper">';
					foreach (  $settings['list'] as $item ) {
						echo '<div class="swiper-slide">'.$item['list_code'].'</div>';
					}
				echo '</div>';
				if ( $show_dots ) { 
					echo '<div class="mweb-swiper-pagination"></div>';
				} 
				if ( $show_arrows ){
					echo '<div class="mweb-swiper-next"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-right-1"></use></svg></div><div class="mweb-swiper-prev"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-left-1"></use></svg></div>';
				}		
			echo '</div>';
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
 * Elementor Footer Contact
 * @since 1.0.0
 */
class My_Footer_Contact extends Widget_Base {

	
	public function get_name() {
		return 'my-footer-contact';
	}
	
	public function get_title() {
		return __( 'ارتباط با ما', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-tel-field';
	}

	public function get_categories() {
		return [ 'digiland_footer' ];
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
				'description' => ''
			]
		);
		
		$this->add_control(
			'phone',
			[
				'label' => __( 'تلفن یک', 'mweb' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'phone_2',
			[
				'label' => __( 'تلفن دو', 'mweb' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'mail',
			[
				'label' => __( 'ایمیل', 'mweb' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
			'address',
			[
				'label' => __( 'آدرس', 'mweb' ),
				'type' => Controls_Manager::TEXTAREA,
			]
		);
		
		$this->add_control(
			'type_box',
			[
				'label' => __( 'نوع', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'elmf_one'   => __( 'یک', 'mweb' ),
					'elmf_two'   => __( 'دو', 'mweb' ),
					'elmf_three' => __( 'سه', 'mweb' ),
				],
				'default' => 'elmf_one',
				'description' => 'تنظیمات سوشیال را از طریق پنل انجام دهید'
			]
		);
		
		$this->add_control(
			'color_title',
			[
				'label' => __( 'رنگ عنوان', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact_us_wrap h5' => 'color: {{VALUE}}',
				]
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'تایپوگرافی عنوان', 'mweb' ),
				'selector' => '{{WRAPPER}} .contact_us_wrap h5',
			]
		);
		
		$this->add_control(
			'content_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact_item' => 'color: {{VALUE}}',
				]
			]
		);
		
		$this->add_control(
			'content_color_sec',
			[
				'label' => __( 'رنگ دوم', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact_item.email' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .contact_item.phone strong' => 'color: {{VALUE}}',
				]
			]
		);
		
		$this->add_control(
			'color_icon',
			[
				'label' => __( 'رنگ آیکن تماس', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact_item svg' => 'fill: {{VALUE}}; stroke: {{VALUE}}',
				]
			]
		);
		
		$this->add_control(
			'show_socials',
			[
				'label' => __( 'نمایش شبکه های اجتماعی', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'بلی', 'mweb' ),
				'label_off' => __( 'خیر', 'mweb' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->add_control(
			'color_icon_sc',
			[
				'label' => __( 'رنگ هاور شبکه های اجتماعی', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.mweb-body {{WRAPPER}} .contact_social_wrap a svg' => 'fill: {{VALUE}}; stroke: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'bgcolor_icon_sc',
			[
				'label' => __( 'پس زمینه شبکه های اجتماعی', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.mweb-body {{WRAPPER}} .contact_social_wrap a' => 'background-color: {{VALUE}}',
				],
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
		switch($settings['type_box']){
			case 'elmf_one':
				echo '<div class="contact_us_wrap">';
				if( !empty($settings['title']) )
					echo '<h5>'.$settings['title'].'</h5>';
					if(!empty($settings['address'])){ echo '<div class="contact_item"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#map"></use></svg><span>'.$settings['address'].'</span></div>'; }
					if(!empty($settings['phone'])){
						echo '<div class="contact_item phone" onclick="window.open (\'tel:'.$settings['phone'].'\', \'_self\');"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#call-incoming"></use></svg><strong>'.substr($settings['phone'], 0, 4).'</strong>'.substr($settings['phone'], 4).'</div>';
					}
					if(!empty($settings['phone_2'])){
						echo '<div class="contact_item phone" onclick="window.open (\'tel:'.$settings['phone'].'\', \'_self\');"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#call-incoming"></use></svg><strong>'.substr($settings['phone_2'], 0, 4).'</strong>'.substr($settings['phone_2'], 4).'</div>';
					} 
					if(!empty($settings['mail'])){ echo '<div class="contact_item"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#sms"></use></svg>'.$settings['mail'].'</div>'; } 
					
					if($settings['show_socials'] == 'yes')
						mweb_social_icons();
					
					echo '<div class="basket_icon hide_mobile"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#bag-2"></use></svg></div>';
				echo '</div>';
			break;
			
			case 'elmf_two':
				echo '<div class="contact_us_wrap type_2">';
				if( !empty($settings['title']) )
					echo '<h5>'.$settings['title'].'</h5>';
					if(!empty($settings['address'])){ echo '<div class="contact_item"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#map"></use></svg><span>'.$settings['address'].'</span></div>'; }
					if(!empty($settings['phone'])){
						echo '<div class="contact_item phone" onclick="window.open (\'tel:'.$settings['phone'].'\', \'_self\');"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#call-calling"></use></svg><strong>'.substr($settings['phone'], 0, 4).'</strong>'.substr($settings['phone'], 4).'</div>';
					}
					if(!empty($settings['phone_2'])){
						echo '<div class="contact_item phone" onclick="window.open (\'tel:'.$settings['phone'].'\', \'_self\');"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#call-calling"></use></svg><strong>'.substr($settings['phone_2'], 0, 4).'</strong>'.substr($settings['phone_2'], 4).'</div>';
					} 
					if(!empty($settings['mail'])){ echo '<div class="contact_item email">'.$settings['mail'].'</div>'; } 

					if($settings['show_socials'] == 'yes')
						mweb_social_icons();
					
				echo '</div>';
			break;
			
			case 'elmf_three':
				$socials = \mweb_theme_util::get_theme_option('mweb_social_icons');
				echo '<div class="contact_us_wrap type_3">';
				if( !empty($settings['title']) )
					echo '<h5>'.$settings['title'].'</h5>';
					if(!empty($settings['address'])){ echo '<div class="contact_item"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#map"></use></svg><span>'.$settings['address'].'</span></div>'; }
					if(!empty($settings['phone'])){
						echo '<div class="contact_item phone" onclick="window.open (\'tel:'.$settings['phone'].'\', \'_self\');"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#call-incoming"></use></svg><strong>'.substr($settings['phone'], 0, 4).'</strong>'.substr($settings['phone'], 4).'</div>';
					} 
					if(!empty($settings['phone_2'])){
						echo '<div class="contact_item phone" onclick="window.open (\'tel:'.$settings['phone'].'\', \'_self\');"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#call-incoming"></use></svg><strong>'.substr($settings['phone_2'], 0, 4).'</strong>'.substr($settings['phone_2'], 4).'</div>';
					} 
					if(!empty($settings['mail'])){ echo '<div class="contact_item email">'.$settings['mail'].'</div>'; } 

					echo '<div class="clear"></div>';
					
					
					if(!empty($socials['telegram']) && $settings['show_socials'] == 'yes'){
						echo '<a class="footer_social_l telegram" href="'.$socials['telegram'].'"><svg class="pack-theme is_white" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#telegram"></use></svg> Telegram</a>';
					}
					if(!empty($socials['instagram']) && $settings['show_socials'] == 'yes'){
						echo '<a class="footer_social_l instagram" href="'.$socials['instagram'].'"><svg class="pack-theme is_white" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#instagram"></use></svg> Instagram</a>';
					}
				echo '</div>';
			break;
			
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
 * Elementor Footer About
 * @since 1.0.0
 */
class My_Footer_About extends Widget_Base {

	
	public function get_name() {
		return 'my-footer-about';
	}
	
	public function get_title() {
		return __( 'درباره سایت', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-testimonial';
	}

	public function get_categories() {
		return [ 'digiland_footer' ];
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
				'description' => ''
			]
		);
		
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'تایپوگرافی عنوان', 'mweb' ),
				'selector' => '{{WRAPPER}} .footer_aboutus_head',
			]
		);
		
		$this->add_control(
			'title_color',
			[
				'label' => __( 'رنگ عنوان', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .footer_aboutus_head' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'desc',
			[
				'label' => __( 'متن', 'mweb' ),
				'type' => Controls_Manager::TEXTAREA,
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'label' => __( 'تایپوگرافی متن', 'mweb' ),
				'selector' => '{{WRAPPER}} .footer_aboutus',
			]
		);
		
		$this->add_control(
			'desc_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .footer_aboutus' => 'color: {{VALUE}}',
				],
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
					'{{WRAPPER}} .footer_aboutus' => 'text-align: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'show_icon',
			[
				'label' => __( 'علامت کنار عنوان', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			]
		);
		
		$this->add_control(
			'mypicon',
			[
				'label' => __( 'آیکن', 'mweb' ),
				'type' => 'iconpicker',
				'condition' => [ 'show_icon' => ['yes'] ],
			]
		);
		
		$this->add_control(
			'color',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .footer_aboutus_head svg' => 'stroke: {{VALUE}}; fill: {{VALUE}}',
				]
			]
		);
		$this->add_control(
			'font_size_icon',
			[
				'label' => __( 'اندازه آیکن', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 12,
				],
				'selectors' => [
					'{{WRAPPER}} .footer_aboutus_head svg' => 'width: {{SIZE}}{{UNIT}};',
				],
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
		
		echo '<h4 class="footer_aboutus_head">';
		if( $settings['show_icon'] == 'yes' )
			echo !empty($settings['mypicon']) ? $settings['mypicon'] : '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#message-question"></use></svg>';
		echo $settings['title'].'</h4><div class="footer_aboutus">'. wpautop($settings['desc']) .'</div>';
		
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
 * Elementor Footer Social
 * @since 1.0.0
 */
class My_Footer_Social extends Widget_Base {

	
	public function get_name() {
		return 'my-footer-social';
	}
	
	public function get_title() {
		return __( 'شبکه های اجتماعی', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-social-icons';
	}

	public function get_categories() {
		return [ 'digiland_footer' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تنظیمات', 'mweb' ),
			]
		);
		
		$this->add_control(
			'social_type',
			[
				'label' => __( 'نوع', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'one'   => __( 'یک', 'mweb' ),
					'two'   => __( 'دو', 'mweb' ),
					'three'   => __( 'سه', 'mweb' ),
				],
				'default' => 'one',
				'description' => 'تنظیمات سوشیال را از طریق پنل انجام دهید',
				'prefix_class' => 'social_type-',
			]
		);
		
		$this->add_control(
			'social_color_icon',
			[
				'label' => __( 'رنگ شبکه های اجتماعی', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.mweb-body {{WRAPPER}} .contact_social_wrap a' => 'color: {{VALUE}}',
					'.mweb-body {{WRAPPER}} .contact_social_wrap a svg' => 'fill: {{VALUE}}; stroke: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'social_bgcolor_icon',
			[
				'label' => __( 'پس زمینه شبکه های اجتماعی', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.mweb-body {{WRAPPER}} .contact_social_wrap a' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'social_color_hover',
			[
				'label' => __( 'رنگ هاور شبکه اجتماعی', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.mweb-body {{WRAPPER}} .contact_social_wrap a:hover' => 'color: {{VALUE}}',
					'.mweb-body {{WRAPPER}} .contact_social_wrap a:hover svg' => 'fill: {{VALUE}}; stroke: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'social_color_hover_bg',
			[
				'label' => __( 'رنگ هاور پس زمینه شبکه اجتماعی', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.mweb-body {{WRAPPER}} .contact_social_wrap a:hover' => 'background-color: {{VALUE}}',
					'.mweb-body {{WRAPPER}} .contact_social_wrap a:before' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'social_border_radius',
			[
				'label' => __( 'گوشه های مدور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .contact_social_wrap a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'social_border_radius_hover',
			[
				'label' => __( 'گوشه های مدور هاور', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .contact_social_wrap a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'social_color_label',
			[
				'label' => __( 'رنگ برچسب', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.mweb-body {{WRAPPER}} .contact_social_wrap a span' => 'color: {{VALUE}}',
				],
				'condition' => [ 'social_type' => ['two'] ],
			]
		);
		
		$this->add_responsive_control(
			'alignment',
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
					'.mweb-body {{WRAPPER}} .contact_social_wrap' => 'justify-content: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'span_typography',
				'label' => __( 'تایپوگرافی عنوان شبکه اجتماعی', 'mweb' ),
				'selector' => '{{WRAPPER}} .contact_social_wrap.has_label span',
				'condition' => [ 'social_type' => ['two'] ],
			]
		);
		
		$this->add_control(
			'item_width',
			[
				'label' => __( 'عرض', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .contact_social_wrap a' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 'social_type!' => ['two'] ],
			]
		);
		
		$this->add_control(
			'item_height',
			[
				'label' => __( 'ارتفاع', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .contact_social_wrap a' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 'social_type!' => ['two'] ],
			]
		);
		
		$this->add_responsive_control(
			'item_lineheight',
			[
				'label' => __( 'ارتفاع خط', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .contact_social_wrap a' => 'line-height: {{SIZE}}{{UNIT}}',
				],
				'condition' => [ 'social_type!' => ['two'] ],
			]
		);
		
		$this->add_control(
			'btn_cart_icon_size',
			[
				'label' => __( 'اندازه آیکن', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .contact_social_wrap a svg' => 'width: {{SIZE}}{{UNIT}}',
				]
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
		
		$item_class = '';
		if ( $settings['hover_animation'] ) {
			$item_class = ' elementor-animation-' . $settings['hover_animation'];
		}
		
		if( $settings['social_type'] != 'two' ){
			mweb_social_icons('', false, $item_class);
		}else{
			mweb_social_icons('', true);
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
 * Elementor Footer GoToTop 
 * @since 1.0.0
 */
class My_Footer_GoToTop extends Widget_Base {

	
	public function get_name() {
		return 'my-footer-gototop';
	}
	
	public function get_title() {
		return __( 'دکمه رفتن به بالا', 'mweb' );
	}

	public function get_icon() {
		return ' eicon-arrow-up';
	}

	public function get_categories() {
		return [ 'digiland_footer' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تنظیمات', 'mweb' ),
			]
		);
		
		$this->add_control(
			'nav_type',
			[
				'label' => __( 'نوع', 'mweb' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'n_style_1'  => __( 'یک', 'mweb' ),
					'n_style_2' => __( 'دو', 'mweb' ),
				],
				'default' => 'n_style_1',
			]
		);
		
		$this->add_control(
			'background',
			[
				'label' => __( 'رنگ پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gototop' => 'background-color: {{VALUE}}',
				]
			]
		);
	
		$this->add_control(
			'color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gototop' => 'color: {{VALUE}}',
					'{{WRAPPER}} .gototop svg' => 'stroke: {{VALUE}}; fill: {{VALUE}}',
				]
			]
		);
		
		$this->add_control(
			'font_size',
			[
				'label' => __( 'اندازه فونت', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 22,
				],
				'selectors' => [
					'{{WRAPPER}} .gototop' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		
		$this->add_control(
			'my_gtpicon',
			[
				'label' => __( 'آیکن', 'mweb' ),
				'type' => 'iconpicker',
			]
		);
		
		$this->add_control(
			'font_size_icon',
			[
				'label' => __( 'اندازه فونت آیکن', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 22,
				],
				'selectors' => [
					'{{WRAPPER}} .gototop svg' => 'width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .gototop' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'btn_width',
			[
				'label' => __( 'عرض', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
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
					'{{WRAPPER}} .gototop' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);
		
		$this->add_control(
			'btn_height',
			[
				'label' => __( 'ارتفاع', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
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
					'{{WRAPPER}} .gototop' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);
		
		$this->add_control(
			'btn_line_height',
			[
				'label' => __( 'ارتفاع خط', 'mweb' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
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
					'{{WRAPPER}} .gototop' => 'line-height: {{SIZE}}{{UNIT}}',
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
					'{{WRAPPER}} .gototop' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'btn_box_shadow',
				'label' => __( 'سایه', 'mweb' ),
				'selector' => '{{WRAPPER}} .gototop',
			]
		);
		
		$this->add_responsive_control(
			'alignment',
			[
				'label' => __( 'تراز آیکن', 'mweb' ),
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
					'.mweb-body {{WRAPPER}} .gototop' => 'text-align: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'btn_color_hover',
			[
				'label' => __( 'رنگ هاور', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gototop:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .gototop:hover svg' => 'stroke: {{VALUE}}; fill: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'btn_color_hover_bg',
			[
				'label' => __( 'رنگ هاور پس زمینه', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gototop:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_section();


		
	}

	
	protected function render() {
		$settings = $this->get_settings_for_display();
		$icon = empty($settings['my_gtpicon']) ? '<svg class="pack-theme is_white" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-up-1"></use></svg>' : $settings['my_gtpicon'];
		if($settings['nav_type'] == 'n_style_1') {
			echo '<div class="gototop elm_gtp1">'.$icon.'<span>رفتن به بالا</span></div>';
		}else{
			echo '<div class="gototop elm_gtp2">'.$icon.'</div>';
		}
		
	}

	
	protected function content_template() {
		
	}
}



/**
 * Elementor Footer Element
 * @since 1.0.0
 */
class My_Footer_Element extends Widget_Base {

	
	public function get_name() {
		return 'my-footer-elemennt';
	}
	
	public function get_title() {
		return __( 'المنت آیکن و متن', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-button';
	}

	public function get_categories() {
		return [ 'digiland_footer' ];
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
				'description' => 'جهت نمایش آیکن تنها این فیلد را خالی رها کنید'
			]
		);
		
		$this->add_control(
			'desc',
			[
				'label' => __( 'توضیح', 'mweb' ),
				'type' => Controls_Manager::TEXT,
				'description' => 'کوتاه باشد'
			]
		);
		
		$this->add_control(
			'elmicon',
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
					'{{WRAPPER}} .elm_icon_wrap svg' => 'width: {{SIZE}}{{UNIT}}',
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
					'{{WRAPPER}} .elm_icon_wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'icon_padding',
			[
				'label' => __( 'فاصله داخلی آیکن', 'mweb' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elm_icon_wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .elm_icon_wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => __( 'رنگ پس زمینه آیکن', 'mweb' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .elm_icon_wrap',
			]
		);
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'elm_box_shadow',
				'selector' => '{{WRAPPER}} .elm_icon_wrap',
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
			'elm_align_vertical',
			[
				'label' => __( 'چیدمان افقی چپ', 'mweb' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'prefix_class' => 'elementor-footer-elm-align-left-',
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'elm_typography',
				'label' => __( 'تایپوگرافی عنوان', 'mweb' ),
				'selector' => '{{WRAPPER}} .elm_text_icon h5',
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'elm_typography_desc',
				'label' => __( 'تایپوگرافی توضیحات', 'mweb' ),
				'selector' => '{{WRAPPER}} .elm_text_icon span',
			]
		);
		
		$this->add_control(
			'desc_text_color',
			[
				'label' => __( 'رنگ متن توضیحات', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elm_text_icon span' => 'color: {{VALUE}}',
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
			'icon_color',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elm_icon_wrap svg' => 'stroke: {{VALUE}}; fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elm_text_icon h5' => 'color: {{VALUE}}',
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
			'icon_color_hover',
			[
				'label' => __( 'رنگ آیکن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elm_icon_wrap:hover svg' => 'stroke: {{VALUE}}; fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'text_color_hover',
			[
				'label' => __( 'رنگ متن', 'mweb' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elm_text_icon:hover h5' => 'color: {{VALUE}}',
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
				'default' => 'no',
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
			$class = 'elm_text_icon';
			if( !empty($settings['title']) )
				$class .= ' auto_width';
			
			if ( $settings['hover_animation'] ) {
				$class .= ' elementor-animation-' . $settings['hover_animation'];
			}
			$this->add_render_attribute( 'wrapper', 'class', $class );
			
			if( !is_user_logged_in() && $settings['is_login'] === 'yes' ){
				return false;
			}
			
			if( !empty($settings['link']['url']) ){
				$target = $settings['link']['is_external'] ? ' target="_blank"' : '';
				$nofollow = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
				echo '<a '. $this->get_render_attribute_string( 'wrapper' ) .' href="' . esc_url( $settings['link']['url'] ) . '" title="' . esc_attr( $settings['title'] ) . '" ' . $target . $nofollow . '>';
			}else{
				echo '<div '. $this->get_render_attribute_string( 'wrapper' ) .'>';
			}
			
			if( !empty($settings['elmicon']) ){
				echo '<div class="elm_icon_wrap">'.$settings['elmicon'].'</div>';
			}
			echo '<div class="elm_row">';
				if( !empty($settings['title']) )
					echo '<h5>'.$settings['title'].'</h5>';
				
				if( !empty($settings['desc']) )
					echo '<span>'.$settings['desc'].'</span>';
				
			echo '</div>';
			
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