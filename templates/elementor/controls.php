<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

 
class Elementor_IconPicker_Control extends \Elementor\Base_Data_Control {


	public function get_type() {
		return 'iconpicker';
	}
	
	
	public function enqueue() {
		
		$css = get_template_directory_uri() . '/includes/admin/css/icon-picker.css';
		wp_enqueue_style( 'icon-picker', $css, array(), '1.0' );
		
		//$font = THEME_THEMEROOT . '/assets/css/admin/font-awesome.min.css';
	   //wp_enqueue_style( 'font-awesome', $font,'','1.0');

		$js = get_template_directory_uri() . '/includes/admin/js/icon-picker.js';
		wp_enqueue_script( 'icon-picker', $js, array( 'jquery' ), '1.0' );
		wp_add_inline_script( 'icon-picker', 'const IconPack = ' . json_encode( array(
			'theme' => mweb_print_sprites_path(),
			'fontawesome' => get_template_directory_uri().'/assets/images/fontawesome.svg',
		) ), 'before' );
	
	}


	protected function get_default_settings() {
		return [
			'svg_icon' => ''
		];
	}


	public function get_default_value() {
		return '';
	}


	public function content_template() {
		$control_uid = $this->get_control_uid();
		?>
		<div class="elementor-control-field">

			<# if ( data.label ) {#>
			<label for="<?php echo $control_uid; ?>" class="elementor-control-title">{{{ data.label }}}</label>
			<# } #>

			<div class="elementor-control-input-wrapper">
				<div class="elementor-control-input-wrapper myrow">
					<textarea id="<?php echo esc_attr( $control_uid ); ?>" class="elementor-control-tag-area elm_iconpicker_source" rows="{{ data.rows }}" data-setting="{{ data.name }}" placeholder="{{ data.placeholder }}"></textarea>
					<div id="preview_icon_picker_<?php echo esc_attr( $control_uid ); ?>" data-target="#<?php echo esc_attr( $control_uid ); ?>" class="button icon-picker">انتخاب</div>
				</div>
			</div>

		</div>

		<# if ( data.description ) { #>
		<div class="elementor-control-field-description">{{{ data.description }}}</div>
		<# } #>
		<?php
	}

}





class Elementor_SelectApi_Control extends \Elementor\Base_Data_Control {

	public function get_type() {
		return 'selectapi';
	}

	public function enqueue() {

		
		if ( ! wp_script_is( 'select2', 'enqueued' ) && ! wp_script_is( 'select2', 'registered' ) ) {
			//wp_enqueue_style( 'select2', get_stylesheet_directory_uri() . '/includes/admin/css/select2.min.css', [], '4.0.13' );
			//wp_enqueue_script( 'select2', get_stylesheet_directory_uri() . '/includes/admin/js/select2.min.js', [ 'jquery' ], '4.0.13', true );
		} else {
			//wp_enqueue_style( 'select2' );
			//wp_enqueue_script( 'select2' );
		}
		
        wp_enqueue_script(
            'mweb-selectapi-control',
            get_stylesheet_directory_uri() . '/includes/admin/js/selectapi-control.js',
            [ 'jquery' ],
            '1.0',
            true
        );

        wp_localize_script( 'mweb-selectapi-control', 'mweb_selectapi', [
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce( 'mweb_selectapi_nonce' ),
        ] );
		
		
	}

	protected function get_default_settings() {
		return [
			'label'       => 'انتخاب محصول',
			'multiple'    => true,
			'placeholder' => __('یک مورد انتخاب کنید...', 'mweb'),
			'label_block' => true,
			'source'      => '', // مثلا: product_list, post_list, page_list, product_cat
		];
	}

	public function content_template() {
		?>
		<div class="elementor-control-field">
			<label class="elementor-control-title">
				{{ data.label }}
			</label>
			<div class="elementor-control-input-wrapper">
				<select class="mweb-selectapi elementor-select2"
					data-setting="{{ data.name }}"
					data-source="{{ data.source }}"
					data-placeholder="{{ data.placeholder }}"
					<# if ( data.multiple ) { #> multiple="multiple" <# } #>>
				</select>
			</div>
			<# if ( data.description ) { #>
				<div class="elementor-control-field-description">
					{{ data.description }}
				</div>
			<# } #>
		</div>
		<?php
	}

}



