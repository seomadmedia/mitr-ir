<?php
/*
Plugin Name: Iron Calculator Widget
Description: ابزارک ماشین حساب وزن آهن آلات (تیرآهن، میلگرد، پروفیل، لوله، ورق، نبشی و ناودانی)
Version: 1.0
Author: YourName
*/

if ( ! defined( 'ABSPATH' ) ) exit;

class Iron_Calc_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'iron_calc_widget',
            THEME_NAME .' - ماشین حساب آهن آلات',
            array( 'description' => 'ابزارک محاسبه وزن آهن آلات' )
        );
    }

    public function form( $instance ) {
        $title         = ! empty( $instance['title'] ) ? $instance['title'] : '';
        $selected_calc = ! empty( $instance['selected_calc'] ) ? $instance['selected_calc'] : '';
        $selected_cat  = ! empty( $instance['selected_cat'] ) ? $instance['selected_cat'] : '';

        $calcs = array(
            'tirahan'   => 'جدول وزن تیرآهن',
            'milgard'   => 'جدول وزن میلگرد',
            'profile'   => 'جدول وزن پروفیل',
            'looleh'    => 'جدول وزن لوله',
            'varagh'    => 'جدول وزن ورق',
            'nabshi'    => 'جدول وزن نبشی و ناودانی',
        );
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">عنوان ابزارک:</label>
            <input class="widefat"
                   id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>"
                   type="text"
                   value="<?php echo esc_attr($title); ?>">
        </p>

        <p>
            <label>انتخاب ماشین حساب:</label>
            <select class="widefat" name="<?php echo $this->get_field_name('selected_calc'); ?>">
                <?php foreach ( $calcs as $key => $label ) : ?>
                    <option value="<?php echo esc_attr($key); ?>" <?php selected($selected_calc, $key); ?>>
                        <?php echo $label; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>

        <p>
            <label>انتخاب دسته (category ID):</label>
            <input class="widefat" type="text"
                   name="<?php echo $this->get_field_name('selected_cat'); ?>"
                   value="<?php echo esc_attr($selected_cat); ?>">
            <small>ID دسته را وارد کنید. مثلا: <code>215</code></small>
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title']        = ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['selected_calc'] = ! empty( $new_instance['selected_calc'] ) ? sanitize_text_field( $new_instance['selected_calc'] ) : '';
        $instance['selected_cat']  = ! empty( $new_instance['selected_cat'] ) ? sanitize_text_field( $new_instance['selected_cat'] ) : '';
        return $instance;
    }

    public function widget( $args, $instance ) {
        if ( ! empty($instance['selected_cat']) ) {
            if ( !is_product_category( $instance['selected_cat'] ) ) {
                return; 
            }
        }

        echo $args['before_widget'];

        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }

        if ( ! empty( $instance['selected_calc'] ) ) {
            $this->render_calculator( $instance['selected_calc'] );
        }

        echo $args['after_widget'];
    }

    private function render_calculator( $type ) {
        
		if ( $type == 'milgard' ) : 
			echo do_shortcode('[rebar_calculator]');

		elseif ( $type == 'tirahan' ) : 
			echo do_shortcode('[beam_calculator]');
			
		elseif ( $type == 'profile' ) : 
			echo do_shortcode('[profile_calculator]');
		
		elseif ( $type == 'looleh' ) : 
			echo do_shortcode('[pipe_calculator]');
		
		elseif ( $type == 'varagh' ) : 
			echo do_shortcode('[sheet_calculator]');
		
		elseif ( $type == 'nabshi' ) : 
			echo do_shortcode('[angle_calculator]');
		endif; 
           
    }
}

function register_iron_calc_widget() {
    register_widget( 'Iron_Calc_Widget' );
}
add_action( 'widgets_init', 'register_iron_calc_widget' );






class mweb_VAT_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'mweb_VAT_Widget',
            THEME_NAME .' - احتساب ارزش افزوده',
            array( 'description' => 'چک باکس برای افزودن ۱۰٪ به قیمت های ووکامرس' )
        );

        // Ajax برای ذخیره انتخاب
        add_action( 'wp_ajax_mweb_toggle_vat', [ $this, 'mweb_toggle_vat' ] );
        add_action( 'wp_ajax_nopriv_mweb_toggle_vat', [ $this, 'mweb_toggle_vat' ] );
    }

    public function widget( $args, $instance ) {
        echo '<div class="widget widget_mweb_vat_widget">';

        $use_session = !empty( $instance['use_session'] );

        $enabled = false;
        if ( $use_session && WC()->session ) {
            $enabled = WC()->session->get( 'mweb_vat_enabled', false );
        }

        ?>
        <label class="vat_widget acc_input checkbox">
			<input type="checkbox" id="mweb-vat-toggle" <?php checked( $enabled, true ); ?> />
			<span class="custom_checkbox"></span>
            احتساب ارزش افزوده
        </label>

        <script>
        (function($){
            var $toggle = $('#mweb-vat-toggle');
            var useSession = <?php echo $use_session ? 'true' : 'false'; ?>;

            function applyVAT(enable) {
				var prices = document.querySelectorAll('.woocommerce-Price-amount');
				prices.forEach(function(el) {
					var bdi = el.querySelector('bdi') || el;
					var textNode = null;

					for (var i = 0; i < bdi.childNodes.length; i++) {
						if (bdi.childNodes[i].nodeType === 3 && bdi.childNodes[i].textContent.trim() !== '') {
							textNode = bdi.childNodes[i];
							break;
						}
					}

					if (!textNode) return;

					var num = textNode.textContent.replace(/[^\d\.]/g, '');
					if (!num) return;

					num = parseFloat(num);
					if (isNaN(num)) return;

					if (enable) {
						if (!el.dataset.original) {
							el.dataset.original = num;
						}
						var newPrice = (parseFloat(el.dataset.original) * 1.10).toFixed(0);
						textNode.textContent = newPrice.replace(/\B(?=(\d{3})+(?!\d))/g, ",") + '\u00A0';
					} else {
						if (el.dataset.original) {
							var orig = parseFloat(el.dataset.original).toFixed(0);
							textNode.textContent = orig.replace(/\B(?=(\d{3})+(?!\d))/g, ",") + '\u00A0';
						}
					}
				});
			}




            if($toggle.is(':checked')){
                applyVAT(true);
            }

            $toggle.on('change', function(){
                var enable = $(this).is(':checked');
                applyVAT(enable);

                if(useSession){
                    $.post('<?php echo admin_url( 'admin-ajax.php' ); ?>', {
                        action: 'mweb_toggle_vat',
                        enable: enable ? 1 : 0
                    });
                }
            });
        })(jQuery);
        </script>
        <?php
        echo '</div>';
    }

    public function form( $instance ) {
        $use_session = !empty( $instance['use_session'] );
        ?>
        <p>
            <input class="checkbox" type="checkbox"
                <?php checked( $use_session ); ?>
                id="<?php echo $this->get_field_id( 'use_session' ); ?>"
                name="<?php echo $this->get_field_name( 'use_session' ); ?>" />
            <label for="<?php echo $this->get_field_id( 'use_session' ); ?>">ذخیره انتخاب کاربر در سشن فعال باشد؟</label>
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = [];
        $instance['use_session'] = !empty( $new_instance['use_session'] ) ? 1 : 0;
        return $instance;
    }

    public function mweb_toggle_vat() {
        if ( WC()->session ) {
            $enable = ! empty( $_POST['enable'] ) ? true : false;
            WC()->session->set( 'mweb_vat_enabled', $enable );
        }
        wp_send_json_success();
    }
}

function mweb_register_vat_widget() {
    register_widget( 'mweb_VAT_Widget' );
}
add_action( 'widgets_init', 'mweb_register_vat_widget' );
