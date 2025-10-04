<?php

//register widget area

function mweb_widgets_init() {

register_sidebar(
	array(
		'id'            => 'home_sidebar',
		'name'          => esc_attr__( 'سایدبار', 'mweb' ),
		'description'   => esc_attr__( '', 'mweb' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></aside>',
		'before_title'  => '<div class="widget_title">',
		'after_title'   => '</div><div class="widget-content">'
	)
);

register_sidebar(
	array(
		'id'            => 'vendor_sidebar',
		'name'          => esc_attr__( 'سایدبار فروشنده', 'mweb' ),
		'description'   => esc_attr__( '', 'mweb' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></aside>',
		'before_title'  => '<div class="widget_title">',
		'after_title'   => '</div><div class="widget-content">'
	)
);

// register_sidebar(
	// array(
		// 'id'            => 'filter_sidebar',
		// 'name'          => esc_attr__( 'فیلتر فروشگاه افقی', 'mweb' ),
		// 'description'   => esc_attr__( '', 'mweb' ),
		// 'before_widget' => '<div id="%1$s" class="widget swiper-slide wd_filter %2$s">',
		// 'after_widget'  => '</div></div>',
		// 'before_title'  => '<div class="wd_title">',
		// 'after_title'   => '<i class="fal fa-plus-circle"></i></div><div class="widget-content">'
	// )
// );

register_sidebar(
	array(
		'id'            => 'filter_sidebar_toggle',
		'name'          => esc_attr__( 'فیلتر فروشگاه نوار کناری', 'mweb' ),
		'description'   => esc_attr__( '', 'mweb' ),
		'before_widget' => '<div id="%1$s" class="widget wt_filter %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="wt_title">',
		'after_title'   => '</div><div class="widget-content">'
	)
);

register_sidebar(
array(
		'id'            => 'single_downads',
		'name'          => esc_attr__( 'تبلیغات ادامه مطلب', 'mweb' ),
		'description'   => esc_attr__( 'تبلیغات زیر مطالب - ابزارک رو بدون عنوان استفاده کنید', 'mweb' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => ''
	)
);
register_sidebar(
	array(
		'id'            => 'myaccount_sidebar_right',
		'name'          => esc_attr__( 'سایدبار حساب کاربری یک', 'mweb' ),
		'description'   => esc_attr__( '', 'mweb' ),
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="widget_title">',
		'after_title'   => '</div><div class="widget-content">'
	)
);
register_sidebar(
	array(
		'id'            => 'myaccount_sidebar_left',
		'name'          => esc_attr__( 'سایدبار حساب کاربری دو', 'mweb' ),
		'description'   => esc_attr__( '', 'mweb' ),
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="widget_title">',
		'after_title'   => '</div><div class="widget-content">'
	)
);




//registering sidebar sections
if ( get_option( 'mweb_custom_multi_sidebars', false ) ) {
	$mweb_theme_current_sidebars = get_option( 'mweb_custom_multi_sidebars', '' );
	if ( ! empty( $mweb_theme_current_sidebars ) && is_array( $mweb_theme_current_sidebars ) ) {
		foreach ( $mweb_theme_current_sidebars as $mweb_current_sidebar ) {
			register_sidebar(
				array(
					'name'          => $mweb_current_sidebar['name'],
					'id'            => $mweb_current_sidebar['id'],
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div></aside>',
					'before_title'  => '<div class="widget_title">',
					'after_title'   => '</div><div class="widget-content">'
				)
			); //#foreach
		};
	};
};


}
add_action( 'widgets_init', 'mweb_widgets_init' );