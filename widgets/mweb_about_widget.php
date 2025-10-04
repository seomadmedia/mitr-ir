<?php
//About widget
add_action('widgets_init', 'mweb_register_about_widget');
function mweb_register_about_widget()
{
    register_widget('mweb_about_widget');
}

class mweb_about_widget extends WP_Widget
{
    function __construct()
    {
        $widget_ops = array('classname' => 'about-widget', 'description' => '' );
        parent::__construct('mweb_about_widget', THEME_NAME .' - درباره ما' , $widget_ops);
    }

    function widget($args, $instance)
    {
	    extract( $args );
	    $title   = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
	    $text    = ( ! empty( $instance['text'] ) ) ? $instance['text'] : '';
	    $name    = ( ! empty( $instance['name'] ) ) ? $instance['name'] : '';
	    $image   = ( ! empty( $instance['logo_image'] ) ) ? $instance['logo_image'] : '';
	    $address = ( ! empty( $instance['address'] ) ) ? $instance['address'] : '';
	    $phone   = ( ! empty( $instance['phone'] ) ) ? $instance['phone'] : '';
	    $email   = ( ! empty( $instance['email'] ) ) ? $instance['email'] : '';


	    echo $before_widget;

	    if ( ! empty( $title ) ) {
		    echo $before_title . esc_attr( $title ) . $after_title;
	    } ?>


        <?php if (!empty($image)) : ?>
            <div class="about-widget-image">
	            <img src="<?php echo esc_url($image); ?>" alt="<?php bloginfo() ?>"/>
	            <?php if (!empty($name)) : ?>
		            <div class="about-name"><h3><?php echo esc_attr($name); ?></h3></div>
	            <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="about-content-wrap">

            <?php if (!empty($text)) : ?>
                <div class="about-content"><?php echo do_shortcode($text); ?></div>
            <?php endif; ?>

	        <?php if ( ! empty( $address ) ) : ?>
		        <div class="address"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#map"></use></svg><span><?php echo esc_html( $address ); ?></span></div>
	        <?php endif; ?>

	        <?php if ( ! empty( $phone ) ) :
					$num_strong = substr($phone, 0, 3) == '091' ? 4 : 3;
					echo '<div class="phone"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#call"></use></svg>'. ( strlen($phone) > 8 ? substr($phone, $num_strong).'<strong>'.substr($phone, 0, $num_strong).'</strong>' : $phone ) .'</div>';
				endif; ?>

	        <?php if ( ! empty( $email ) ) : ?>
		        <div class="email"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#sms"></use></svg><a href="mailto:<?php esc_html($email)?>"><?php echo esc_html( $email ); ?></a></div>
	        <?php endif; ?>
        </div>


        <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
	    $instance               = $old_instance;
	    $instance['title']      = strip_tags( $new_instance['title'] );
	    $instance['name']       = strip_tags( $new_instance['name'] );
	    $instance['text']       = $new_instance['text'];
	    $instance['logo_image'] = strip_tags( $new_instance['logo_image'] );
	    $instance['address']    = strip_tags( $new_instance['address'] );
	    $instance['phone']      = strip_tags( $new_instance['phone'] );
	    $instance['email']      = strip_tags( $new_instance['email'] );

	    return $instance;
    }

    function form($instance)
    {
	    $defaults = array(
		    'title'      => esc_html__( 'درباره ما', 'mweb' ),
		    'text'       => '',
		    'name'       => '',
		    'logo_image' => '',
		    'address'    => '',
		    'phone'      => '',
		    'email'      => ''
	    );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('عنوان:','mweb');?></label>
		    <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php if( !empty($instance['title']) ) echo esc_attr($instance['title']); ?>" />
	    </p>

	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'logo_image' )); ?>"><?php esc_html_e('لینک عکس درباره ما:','mweb'); ?></label>
		    <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'logo_image' )); ?>" name="<?php echo esc_attr($this->get_field_name('logo_image')); ?>" value="<?php if( !empty($instance['logo_image']) ) echo esc_url($instance['logo_image']); ?>" />
	    </p>
	    <p>
		    <label for="<?php echo esc_attr($this->get_field_id( 'name' )); ?>"><?php esc_html_e('نام:','mweb'); ?></label>
		    <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'name' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'name' )); ?>" value="<?php if( !empty($instance['name']) ) echo esc_attr($instance['name']); ?>" />
	    </p>
	    <p>
		    <label for="<?php echo esc_html($this->get_field_id( 'text' )); ?>"><?php esc_html_e('متن قسمت درباره ما:','mweb'); ?></label>
		    <textarea rows="10" cols="50" id="<?php echo esc_html($this->get_field_id( 'text' )); ?>" name="<?php echo esc_html($this->get_field_name('text')); ?>" class="widefat"><?php echo esc_html($instance['text']); ?></textarea>
	    </p>

	    <p>
		    <label for="<?php echo esc_html($this->get_field_id( 'address' )); ?>"><?php esc_html_e('آدرس شما:','mweb'); ?></label>
		    <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'address' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'address' )); ?>" value="<?php if( !empty($instance['address']) ) echo esc_attr($instance['address']); ?>" />
	    </p>

	    <p>
		    <label for="<?php echo esc_html($this->get_field_id( 'phone' )); ?>"><?php esc_html_e('تلفن شما:','mweb'); ?></label>
		    <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'phone' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'phone' )); ?>" value="<?php if( !empty($instance['phone']) ) echo esc_attr($instance['phone']); ?>" />
	    </p>

	    <p>
		    <label for="<?php echo esc_html($this->get_field_id( 'email' )); ?>"><?php esc_html_e('ایمیل شما:','mweb'); ?></label>
		    <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'email' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'email' )); ?>" value="<?php if( !empty($instance['email']) ) echo esc_attr($instance['email']); ?>" />
	    </p>


    <?php
    }
}
?>
