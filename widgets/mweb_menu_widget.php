<?php

//menu widget
add_action( 'widgets_init', 'mweb_register_menu_widget' );

function mweb_register_menu_widget() {
	register_widget( 'mweb_menu_widget' );
}


class mweb_menu_widget extends WP_Widget {

	//register widget
	function __construct() {
		$widget_ops = array( 'classname'   => 'oghat-shariee-widget', 'description' => '' );
		parent::__construct( 'mweb_menu_widget', THEME_NAME .' - منو ' , $widget_ops );

	}


	//render widget
	function widget( $args, $instance ) {
		extract( $args );
		// Get menu
		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

		if ( !$nav_menu )
			return;
		
		$title   = ( ! empty( $instance['title'] ) ) ? esc_attr( $instance['title'] ) : '';
		
		?>
		<div class="main_nav right_menu hide_mobile hide_tablet">

			<div id="navigation" class="mweb-main-menu mweb-drop-down" <?php mweb_theme_schema::makeup( 'menu' ) ?>>
				<?php
					wp_nav_menu(
						array(
							'menu' => $nav_menu,
							'container'      => '',
							'walker'         => new mweb_mega_menu_walker,
							)
					);
				?>
			</div>

		</div><!--#main_nav right-->
		
		
		
		
		<?php

		
    }

	
	function update( $new_instance, $old_instance ) {
		$instance                 = $old_instance;
		$instance['title']        = strip_tags( $new_instance['title'] );
		if ( ! empty( $new_instance['nav_menu'] ) ) {
			$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		}

		return $instance;
	}

	
    function form($instance) {
	    $title = isset( $instance['title'] ) ? $instance['title'] : '';
		$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';
		
		// Get menus
		$menus = wp_get_nav_menus();
	    ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">عنوان</label>
            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php if (!empty($instance['title'])) echo esc_attr($instance['title']); ?>"/>
        </p>

		<p>
				<label for="<?php echo $this->get_field_id( 'nav_menu' ); ?>"><?php _e( 'Select Menu:' ); ?></label>
				<select id="<?php echo $this->get_field_id( 'nav_menu' ); ?>" name="<?php echo $this->get_field_name( 'nav_menu' ); ?>">
					<option value="0"><?php _e( '&mdash; Select &mdash;' ); ?></option>
					<?php foreach ( $menus as $menu ) : ?>
						<option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu, $menu->term_id ); ?>>
							<?php echo esc_html( $menu->name ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>
        
	    <p><?php echo html_entity_decode(esc_html__( 'فیلد منو حتما باید پر باشد' )); ?></p>
    <?php
    }
}

?>