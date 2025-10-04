<?php
namespace ElementorMahdisweb\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Module Story
 * @since 1.0.0
 */
class Block_Story extends Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);

		wp_register_script( 'storyjs', THEME_ASSET . '/js/story.min.js', array('jquery'), THEME_VERSION, true);
		wp_register_style( 'storycss', THEME_ASSET . '/css/story.min.css', array(), THEME_VERSION);

	}

	public function get_script_depends() {
		return [ 'storyjs' ];
	}
	
	public function get_style_depends() {
		return [ 'storycss' ];
	}
		
	public function get_name() {
		return 'block-story';
	}

	public function get_title() {
		return __( 'اسـتوری', 'mweb' );
	}

	public function get_icon() {
		return 'eicon-circle-o';
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
			'posts_per_page',
			[
				'label' => __( 'تعداد استوری ها', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 10,
				'min' => 1,
			]
		);
		
		$this->add_control(
			'offset',
			[
				'label' => __( 'نقطه شروع استوری', 'mweb' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '',
				'description' => 'offset باعث می شود چند نتیجه اول را رد کند و از آنجا به بعد تعداد پست به شما دهد',
			]
		);
		
		$this->add_control(
			'post_not_in',
			[
				'label' => __( 'آیدی استوری ها - عدم نمایش', 'mweb' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'description' => 'با خط فاصله جدا کنید . به طور مثال  110-12-60',
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
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'label' => __( 'تایپوگرافی', 'mweb' ),
				'selector' => '{{WRAPPER}} .stories.carousel .story>.item-link>.info .name',
			]
		);
		
		$this->end_controls_section();


	}
	
	
	
	protected function render() {
				
		$settings = $this->get_settings_for_display();
		
		$exclude_ids = array();
		if( !empty($settings['post_not_in']) )
			$exclude_ids = explode('-', $settings['post_not_in']);
		
		$query_arg = array( 'post_type' => 'mweb_story', 'posts_per_page' => $settings['posts_per_page'], 'offset' => $settings['offset'], 'post__not_in' => $exclude_ids );
		$query_data = new \WP_Query( $query_arg );
		
		$my_array = array();
		$my_array['backNative'] = true;
		$my_array['previousTap'] = true;
		$my_array['skin'] = 'Snapgram';
		$my_array['autoFullScreen'] = false;
		$my_array['avatars'] = true;
		$my_array['paginationArrows'] = false;
		$my_array['list'] = false;
		$my_array['cubeEffect'] = false;
		$my_array['localStorage'] = true;
		//$my_array['rtl'] = true;
		$my_array['stories'] = array();
		
		if ( $query_data->have_posts() ) {
			echo '<div id="stories" class="storiesWrapper" style="grid-template-columns: repeat('.$settings['posts_per_page'].', 1fr)"></div>';
			
			while ( $query_data->have_posts() ) : $query_data->the_post();
				
				global $post;
				
				$story_type = get_post_meta(get_the_ID(), 'story_type', true);
				$story_media = get_post_meta(get_the_ID(), 'story_media', true);
				$story_preview = get_post_meta(get_the_ID(), 'story_preview', true);
				$story_link = get_post_meta(get_the_ID(), 'story_link', true);
				$story_link_title = get_post_meta(get_the_ID(), 'story_link_title', true);
				$story_length = get_post_meta(get_the_ID(), 'story_length', true);
				
				//print_r($story_type);
				
				$story_post = array();
				$story_post['id'] = 'story_'.get_the_ID();
				$story_post['photo'] = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); 
				$story_post['name'] = get_the_title(); 
				$story_post['time'] = strtotime(get_post_time( 'Y-m-d H:i:s', false, $post, false )); 
				$story_post['items'] = array(); 
			
				
				foreach( $story_type as $key => $value ){
					
					$item = array();
					$item['id'] = 'story_'.get_the_ID().$key;
					$item['type'] = $story_type[$key];
					$item['length'] = empty($story_length) ? 3 : $story_length;
					$item['src'] = $story_media[$key]['url'];
					$item['preview'] = $story_type[$key] == 'photo' && empty($story_preview[$key]['url']) ? $story_media[$key]['url'] : $story_preview[$key]['url'];
					$item['link'] = $story_link[$key];
					$item['linkText'] = empty($story_link_title[$key]) ? : $story_link_title[$key];
					$item['time'] = strtotime(get_post_time( 'Y-m-d H:i:s', false, $post, false )); 
					
					$story_post['items'][] = $item;

				}
				
				$my_array['stories'][] = $story_post;


			endwhile;
			
			
			$my_array['language'] = array();
			$my_array['language']['unmute'] = 'صدا لمس کنید';
			$my_array['language']['keyboardTip'] = 'برای دیدن بعدی، فاصله را فشار دهید';
			$my_array['language']['visitLink'] = 'مشاهده';
			$my_array['language']['time'] = array('ago' => 'قبل', 'hour' => 'ساعت قبل', 'hours' => 'ساعت قبل', 'minute' => 'دقیقه قبل', 'minutes' => 'دقیقه قبل', 'fromnow' => 'الان', 'seconds' => 'ثانیه قبل', 'yesterday' => 'دیروز', 'tomorrow' => 'امروز', 'days' => 'روز قبل' );

			
			ob_start();
			//echo '<script type="text/javascript">';
				echo 'const element_stories = document.querySelector("#stories");';
				echo 'const stories = Zuck(element_stories,'.json_encode($my_array).');';
			//echo '</script>';
			//print_r($my_array);
			
			wp_add_inline_script( 'storyjs', ob_get_clean() );

			
		} else {
			
			echo mweb_no_content();
			
		}	
		//reset post data
		wp_reset_postdata();
		
		
		
	}


	protected function content_template() {
		
	}
	
}




