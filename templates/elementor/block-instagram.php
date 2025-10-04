<?php
namespace ElementorMahdisweb\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Widget Class
 *
 * Elementor widget for the class below
 *
 * @since 1.0.0
 */
class Block_Instagram extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'block-instagram';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'اینستاگرام', 'mweb' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-share';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'digiland' ];
	}


	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'تنظیمات', 'mweb' ),
			]
		);
		
		$this->add_control(
			'instagram_text',
			[
				'label' => __( 'عنوان', 'mweb' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'username',
			[
				'label' => __( 'نام کاربری', 'mweb' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'username_show',
			[
				'label' => __( 'نمایش نام کاربری', 'mweb' ),
				'type' => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'photos',
			[
				'label' => __( 'تعداد عکس', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 4,
				'mix' => 10,
			]
		);
		


		$this->end_controls_section();
		
		
		
		
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$photos = $settings['photos'];
		$username = $settings['username'];
		$instagram_text = $settings['instagram_text'];
		$username_show = $settings['username_show'];
		
		$content = '<div class="mweb-intagram-wrap">';
		$content .= '<div class="mweb-instagram items-' . $photos . '"><div class="username-text text-center hide_mobile"><i class="fab fa-instagram"></i><span>' . $username_show . '</span> ' . $instagram_text . ' </div>';
		
		$instagram = new \mweb_instagram(
			array(
				'username' => trim($username),
				'target' => '_blank',
				'number' => $photos,
			)
		);
		
		$content .= $instagram->outPut();
		$content .= '</div></div>';
		
		echo $content;
		
		
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function content_template() {
		
	}
}
