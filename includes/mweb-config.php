<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */



	//load imported demo
	require_once THEME_INC . '/mweb-import.php';

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "shop_options";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

	// remove redux menu under the settings
	if ( ! function_exists( 'mweb_remove_redux_menu' ) ) {
		function mweb_remove_redux_menu() {
			remove_submenu_page( 'options-general.php', 'redux-framework' );
		}

		add_action( 'admin_menu', 'mweb_remove_redux_menu', 12 );
	}


    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
		// This is where your data is stored in the database and also becomes your global variable name.
		'opt_name'                  => $opt_name,

		// Name that appears at the top of your panel.
		'display_name'              => $theme->get( 'Name' ),

		// Version that appears at the top of your panel.
		'display_version'           => $theme->get( 'Version' ),

		// Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only).
		'menu_type'                 => 'menu',

		// Show the sections below the admin menu item or not.
		'allow_sub_menu'            => true,

		// The text to appear in the admin menu.
		'menu_title'                => esc_html__( 'دیجی لند', 'mweb' ),

		// The text to appear on the page title.
		'page_title'                => esc_html__( 'پنل مدیریت پوسته', 'mweb' ),

		// Disable to create your own Google fonts loader.
		'disable_google_fonts_link' => true,

		// Show the panel pages on the admin bar.
		'admin_bar'                 => true,

		// Icon for the admin bar menu.
		'admin_bar_icon'            => 'dashicons-portfolio',

		// Priority for the admin bar menu.
		'admin_bar_priority'        => 50,

		// Sets a different name for your global variable other than the opt_name.
		'global_variable'           => $opt_name,

		// Show the time the page took to load, etc. (forced on while on localhost or when WP_DEBUG is enabled).
		'dev_mode'                  => false,

		// Enable basic customizer support.
		'customizer'                => true,

		// Allow the panel to open expanded.
		'open_expanded'             => false,

		// Disable the save warning when a user changes a field.
		'disable_save_warn'         => false,

		// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
		'page_priority'             => 54,

		// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters.
		'page_parent'               => 'themes.php',

		// Permissions needed to access the options panel.
		'page_permissions'          => 'manage_options',

		// Specify a custom URL to an icon.
		'menu_icon'                 => '',

		// Force your panel to always open to a specific tab (by id).
		'last_tab'                  => '',

		// Icon displayed in the admin panel next to your menu_title.
		'page_icon'                 => 'icon-themes',

		// Page slug used to denote the panel, will be based off page title, then menu title, then opt_name if not provided.
		'page_slug'                 => '',

		// On load save the defaults to DB before user clicks save.
		'save_defaults'             => true,

		// Display the default value next to each field when not set to the default value.
		'default_show'              => false,

		// What to print by the field's title if the value shown is default.
		'default_mark'              => '*',

		// Shows the Import/Export panel when not used as a field.
		'show_import_export'        => true,

		// The time transients will expire when the 'database' arg is set.
		'transient_time'            => 60 * MINUTE_IN_SECONDS,

		// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output.
		'output'                    => true,

		// Allows dynamic CSS to be generated for customizer and google fonts,
		// but stops the dynamic CSS from going to the page head.
		'output_tag'                => true,

		// Disable the footer credit of Redux. Please leave if you can help it.
		'footer_credit'             => '',

		// If you prefer not to use the CDN for ACE Editor.
		// You may download the Redux Vendor Support plugin to run locally or embed it in your code.
		'use_cdn'                   => true,

		// Set the theme of the option panel.  Use 'wp' to use a more modern style, default is classic.
		'admin_theme'               => 'wp',

		// Enable or disable flyout menus when hovering over a menu with submenus.
		'flyout_submenus'           => true,

		// Mode to display fonts (auto|block|swap|fallback|optional)
		// See: https://developer.mozilla.org/en-US/docs/Web/CSS/@font-face/font-display.
		'font_display'              => 'swap',

		// HINTS.
		'hints'                     => array(
			'icon'          => 'el el-question-sign',
			'icon_position' => 'right',
			'icon_color'    => 'lightgray',
			'icon_size'     => 'normal',
			'tip_style'     => array(
				'color'   => 'red',
				'shadow'  => true,
				'rounded' => false,
				'style'   => '',
			),
			'tip_position'  => array(
				'my' => 'top left',
				'at' => 'bottom right',
			),
			'tip_effect'    => array(
				'show' => array(
					'effect'   => 'slide',
					'duration' => '500',
					'event'    => 'mouseover',
				),
				'hide' => array(
					'effect'   => 'slide',
					'duration' => '500',
					'event'    => 'click mouseleave',
				),
			),
		),

		// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
		// Possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
		'database'                  => '',
		'network_admin'             => true,
		'search'                    => false,
	);

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.

    $args['admin_bar_links'][] = array(
        //'id'    => 'redux-support',
        'href'  => 'http://www.mahdisweb.net/contactus/',
        'title' => esc_html__( 'پشتیبانی', 'mweb' ),
    );


    // Add content after the form.
    //$args['footer_text'] = '<p>Need help? Visit our dedicated <a href="http://veented.com/support" target="_blank">Support Forums</a>.</p>';

    Redux::setArgs( $opt_name, $args );


    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for

     */



    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'عمومی', 'mweb' ),
        'id'     => 'mweb-general',
        'desc'   => esc_html__( 'تنظیمات کلی', 'mweb' ),
        'icon'   => 'fa fa-cog',
        'fields' => array(

			/* array(
				'id'       => 'open_graph',
				'type'     => 'switch',
				'title'    => esc_html__( 'فعال سازی open graph', 'mweb' ),
				'subtitle' => esc_html__( ' . اگر از پلاگین سئو دارای open graph  استفاده میکنید این گزینه را غیر فعال کنید', 'mweb' ),
				'default'  => false
			), */
			array(
                'id'       => 'mweb-body-pat',
                'type'     => 'background',
				'background-color' => false,
                'title'    => esc_html__( 'تصویر پس زمینه سایت', 'mweb' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( "آپلود کنید", 'mweb' ),
                'default'  => ''
            ),
			array(
				'id'       => 'wishlist_activity',
				'type'     => 'switch',
				'title'    => esc_html__( 'فعال سازی علاقه مندی', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => 1
			),
			array(
				'id'       => 'compare_activity',
				'type'     => 'switch',
				'title'    => esc_html__( 'فعال سازی مقایسه', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => 1
			),
			array(
				'id'		=> 'compare_category',
				'title'		=> __( 'دسته ی قابل مقایسه', 'mweb' ),
				'subtitle'	=> __( '', 'mweb' ),
				'type'		=> 'select',
				'options'  => array(
					'first' => esc_html__( 'اولین دسته مادر محصول', 'mweb' ),
					'last' => esc_html__( 'آخرین دسته انتخابی محصول', 'mweb' ),
				),
				'default' => 'last'
			),
			array(
				'id'		=> 'compare_page_id',
				'title'		=> __( 'برگه مقایسه', 'mweb' ),
				'subtitle'	=> __( '', 'mweb' ),
				'type'		=> 'select',
				'data'		=> 'pages',
			),
			array(
                'id'       => 'mweb_site_width',
                'type'     => 'slider',
                'title'    => esc_html__( 'عرض سایت در دسکتاپ', 'mweb' ),
                'subtitle' => esc_html__( 'یک مقدار عددی وارد کنید', 'mweb' ),
                'default'  => '1150',
				"min"      => 1150,
				"step"     => 1,
				"max"      => 2000,
            ),
			array(
				'id'       => 'mweb_login_register_ajax',
				'type'     => 'switch',
				'title'    => esc_html__( 'فعال سازی ثبت نام و ورود ایجکس', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => true
			),
			array(
				'id'       => 'mweb_pop_digits',
				'type'     => 'switch',
				'title'    => esc_html__( 'فعال سازی پاپ آپ ورود و عضویت دیجیتس با دکمه پیشفرض پوسته', 'mweb' ),
				'subtitle' => esc_html__( 'باید افزونه دیجتس فعال داشته باشید', 'mweb' ),
				'default'  => false
			),
			array(
                'id'       => 'mweb_login_register_url',
                'type'     => 'text',
                'title'    => esc_html__( 'آدرس صفحه ورود و عضویت', 'mweb' ),
				'subtitle'	=> __( '', 'mweb' ),
            ),
			array(
				'id'       => 'mweb_free_shipping',
				'type'     => 'switch',
				'title'    => esc_html__( 'فعال سازی پیام ارسال رایگان', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => false
			),
			array(
                'id'       => 'mweb_is_free_shipping',
                'type'     => 'text',
                'title'    => esc_html__( 'متن ارسال رایگان', 'mweb' ),
				'default'  => 'تبریک، ارسال به صورت رایگان',
				'subtitle'	=> __( '', 'mweb' ),
            ),
			array(
                'id'       => 'mweb_isnt_free_shipping',
                'type'     => 'text',
                'title'    => esc_html__( 'متن ارسال رایگان', 'mweb' ),
				'default'  => '',
				'subtitle'	=> __( '[price] مبلغ - به طور مثال [price]  تا ارسال رایگان', 'mweb' ),
            ),
			array(
                'id'       => 'mweb_cart_sidebar',
                'type'     => 'switch',
                'title'    => esc_html__( 'فعال سازی سبد خرید کناری', 'mweb' ),
				'default'  => true,
            ),
			array(
                'id'       => 'mweb_cart_sidebar_quantity',
                'type'     => 'switch',
                'title'    => esc_html__( 'فعال سازی امکان کم و زیاد کردن محصول در سبدخرید کناری', 'mweb' ),
				'default'  => true,
            ),
			array(
                'id'       => 'mweb_active_loop_quantity',
                'type'     => 'switch',
                'title'    => esc_html__( 'فعال سازی امکان کم و زیاد کردن محصول در حلقه ها', 'mweb' ),
				'default'  => false,
            ),
			array(
                'id'       => 'mweb_active_mb_menu',
                'type'     => 'switch',
                'title'    => esc_html__( 'فعال سازی منو شناور پایین موبایل', 'mweb' ),
				'default'  => false,
            ),
			array(
				'id'       => 'lazy_status',
				'type'     => 'switch',
				'title'    => esc_html__( 'فعال سازی lazy load', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => true
			),
			array(
                'id'       => 'mweb_thankyou_text',
                'type'     => 'textarea',
                'title'    => esc_html__( 'متن تشکر از خرید', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
            ),
			array(
				'id'       => 'mweb_buy_later',
				'type'     => 'switch',
				'title'    => esc_html__( 'فعال سازی افزودن به خرید بعدی', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => false
			),
			array(
				'id'       => 'mweb_report_product',
				'type'     => 'switch',
				'title'    => esc_html__( 'فعال سازی گزارش نادرستی مشخصات', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => false
			),
			array(
				'id'       => 'mweb_font_family',
				'type'     => 'select',
				'title'    => __('انتخاب فونت سایت', 'mweb'),
				'subtitle' => __('', 'mweb'),
				'options'  => array(
					'iransans'   => esc_html__( 'ایران سنس', 'mweb' ),
					'iranyekan'  => esc_html__( 'ایران یکان', 'mweb' ),
					'yekanbakh'  => esc_html__( 'یکان بخ', 'mweb' ),
					'dana'       => esc_html__( 'دانا', 'mweb' ),
				),
				'default' => 'iransans'
			),
			array(
				'id'       => 'mweb_just_numfa',
				'type'     => 'switch',
				'title'    => esc_html__( 'تنها فراخوانی فونت اعداد فارسی', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => true
			),
			array(
                'id'       => 'mweb_preloader',
                'type'     => 'switch',
                'title'    => esc_html__( 'افکت پیش بارگذاری', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'default'  => false,
            ),

			array(
                'id'       => 'mweb_excel_edit',
                'type'     => 'switch',
                'title'    => esc_html__( 'ویرایش محصولات با اکسل', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'default'  => false,
            ),

        )
    ) );



	Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'در دست ساخت', 'mweb' ),
        'id'     => 'mweb-wrench',
        'desc'   => esc_html__( 'تنظیمات در دست ساخت', 'mweb' ),
        'icon'   => 'fa fa-wrench',
        'fields' => array(

			array(
				'id'       => 'under_construction',
				'type'     => 'switch',
				'title'    => esc_html__( 'فعال سازی در دست ساخت', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => 0
			),
			array(
                'id'       => 'under_construction_title',
                'type'     => 'text',
                'title'    => esc_html__( 'عنوان', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'default'  => 'در دست ساخت',
            ),
			array(
                'id'       => 'under_construction_content',
                'type'     => 'editor',
                'title'    => esc_html__( 'توضیحات', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'default'  => '',
            ),
			array(
                'id'       => 'under_construction_background',
                'type'     => 'background',
				'background-color' => false,
                'title'    => esc_html__( 'تصویر پس زمینه در دست ساخت', 'mweb' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( "آپلود کنید", 'mweb' ),
                'default'  => ''
            ),
			array(
				'id'		=> 'under_construction_time',
				'title'		=> __( 'تایم در دست ساخت', 'mweb' ),
				'subtitle'	=> __( 'راهنمای درج تاریخ و زمان را مانند مثال روبرو وارد کنید', 'mweb' ),
				'type'		=> 'text',
                'default' => esc_html__( "2018-07-24 19:30:00", 'mweb' ),
			),


        )
    ) );


	Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'ایمیل', 'mweb' ),
        'id'     => 'mweb-email',
        'desc'   => esc_html__( 'تنظیمات / ایمیل', 'mweb' ),
        'icon'   => 'fa fa-bell',
        'fields' => array(

			array(
                'id'       => 'in_stock_subject',
                'type'     => 'text',
                'title'    => esc_html__( 'عنوان خبرنامه ایمیل موجود شدن', 'mweb' ),
                'subtitle' => esc_html__( '[product_title] برای عنوان محصول', 'mweb' ),
                'default'  => 'محصول [product_title] موجود شد',
            ),
			array(
                'id'       => 'on_sale_subject',
                'type'     => 'text',
                'title'    => esc_html__( 'عنوان خبرنامه ایمیل حراج شدن', 'mweb' ),
                'subtitle' => esc_html__( '[product_title] برای عنوان محصول', 'mweb' ),
                'default'  => 'محصول [product_title] حراج شد',
            ),
			array(
                'id'       => 'in_stock_notifi_text',
                'type'     => 'editor',
                'title'    => esc_html__( 'محتوای پیشفرض ایمیل موجود شدن', 'mweb' ),
                'subtitle' => esc_html__( '[product_title] برای عنوان محصول', 'mweb' ),
                'default'  => 'سلام محصول [product_title] هم اکنون موجود و قابل خرید می باشد.',
            ),
			array(
                'id'       => 'on_sale_notifi_text',
                'type'     => 'editor',
                'title'    => esc_html__( 'محتوای پیشفرض ایمیل حراج شدن', 'mweb' ),
                'subtitle' => esc_html__( '[product_title] برای عنوان محصول', 'mweb' ),
                'default'  => 'سلام قیمت محصول [product_title] کاهش یافت.',
            ),


        )
    ) );


	Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'ورود و عضویت', 'mweb' ),
        'id'     => 'mweb-verf',
        'desc'   => esc_html__( 'تنظیمات پیامک', 'mweb' ),
        'icon'   => 'fa fa-bell',
        'fields' => array(


			array(
				'id'       => 'login_only_phone',
				'type'     => 'switch',
				'title'    => esc_html__( 'ورود با رمز یکبار مصرف', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => 0
			),

			array(
				'id'       => 'reg_only_phone',
				'type'     => 'switch',
				'title'    => esc_html__( 'ثبت نام تنها با شماره موبایل', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => 0
			),
			
			array(
				'id'       => 'reg_login_only_phone',
				'type'     => 'switch',
				'title'    => esc_html__( 'حذف آپشن ورود با رمز', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => 1
			),
			
			array(
				'id'       => 'reg_login_joint',
				'type'     => 'switch',
				'title'    => esc_html__( 'ورود و عضویت مشترک', 'mweb' ),
				'subtitle' => esc_html__( 'تنها از طریق ارسال پیامک', 'mweb' ),
				'default'  => 1
			),

			array(
				'id'       => 'lostpass_sms_form',
				'type'     => 'switch',
				'title'    => esc_html__( 'فعال سازی بازیابی رمز عبور از طریق پیامک', 'mweb' ),
				'subtitle' => esc_html__( 'این گزینه بعد از نسخه 4 قالب و برای کاربرانی که احراز هویت موبایلی انجام داده اند قابل استفاده  می باشد', 'mweb' ),
				'default'  => 0
			),

			array(
				'id'       => 'verify_status',
				'type'     => 'switch',
				'title'    => esc_html__( 'فعال سازی تایید موبایل', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => 0
			),

			array(
				'id'       => 'forced_verify_status',
				'type'     => 'switch',
				'title'    => esc_html__( 'اجباری کردن تایید موبایل', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => 0
			),

			array(
                'id'       => 'verify_text',
                'type'     => 'textarea',
                'title'    => esc_html__( 'متن تایید شماره موبایل', 'mweb' ),
                'subtitle' => esc_html__( "کد : [code]", 'mweb' ),
                'default'  => 'کاربر گرامی کد تایید عبارت است از : [code]'
            ),

			array(
                'id'       => 'number_of_token',
                'type'     => 'text',
				'validate' => 'numeric',
                'title'    => esc_html__( 'تعداد اعداد توکن', 'mweb' ),
                'subtitle' => esc_html__( "", 'mweb' ),
                'default'  => 5
            ),

			array(
                'id'       => 'number_of_retries',
                'type'     => 'text',
				'validate' => 'numeric',
                'title'    => esc_html__( 'حداکثر تعداد درخواست در روز', 'mweb' ),
                'subtitle' => esc_html__( "", 'mweb' ),
                'default'  => 10
            ),
			
			array(
                'id'       => 'time_of_retries',
                'type'     => 'text',
				'validate' => 'numeric',
                'title'    => esc_html__( 'فاصله زمانی درخواست کد', 'mweb' ),
                'subtitle' => esc_html__( "حداقل 10 ثانیه", 'mweb' ),
                'default'  => 60
            ),

			array(
				'id'       => 'sms_gateway',
				'type'     => 'select',
				'required' => '',
				'title'    => esc_html__( 'سرویس دهنده پیامک', 'mweb' ),
				'subtitle' => 'اگر سرویس دهنده پیامکی دلخواه موجود نیست . از افزونه پیامک ووکامرس فارسی استفاده نمائید',
				//'desc'     => 'اگر از افزونه پیامک ووکامرس استفاده می کنید میتوانید تنظیمات درگاه را خالی رها کنید',
				'options'  => array(
					'none'        => esc_html__( 'هیچ کدام', 'mweb' ),
					'kavenegar'   => esc_html__( 'kavenegar.com (lookup)', 'mweb' ),
					'melipayamak' => esc_html__( 'melipayamak.com', 'mweb' ),
					'farapayamak' => esc_html__( 'farapayamak.ir', 'mweb' ),
					'parsgreen'   => esc_html__( 'parsgreen.com', 'mweb' ),
					'raygansms'   => esc_html__( 'raygansms.com', 'mweb' ),
					'smsir'       => esc_html__( 'sms.ir', 'mweb' ),
					'payamresan'  => esc_html__( 'payam-resan.com', 'mweb' ),
					'ippanel'     => esc_html__( 'ippanel.com REST', 'mweb' ),
					//'_0098'       => esc_html__( '0098sms.com', 'mweb' ),
					'sabanovin'   => esc_html__( 'sabanovin.com', 'mweb' ),
					'niazpardaz'   => esc_html__( 'niazpardaz-sms.com', 'mweb' ),
				),
				'default'  => 'none'
			),
			array(
                'id'       => 'sms_gateway_username',
                'type'     => 'text',
                'title'    => esc_html__( 'نام کاربری یا api', 'mweb' ),
                'subtitle' => esc_html__( "", 'mweb' ),
                'default'  => ''
            ),
			array(
                'id'       => 'sms_gateway_password',
                'type'     => 'text',
                'title'    => esc_html__( 'گذرواژه', 'mweb' ),
                'subtitle' => esc_html__( "", 'mweb' ),
                'default'  => ''
            ),
			array(
                'id'       => 'sms_gateway_number',
                'type'     => 'text',
                'title'    => esc_html__( 'شماره خط ارسالی', 'mweb' ),
                'subtitle' => esc_html__( "", 'mweb' ),
                'default'  => ''
            ),
			array(
                'id'       => 'sms_gateway_template',
                'type'     => 'text',
                'title'    => esc_html__( 'الگوی ارسال پیامک', 'mweb' ),
                'subtitle' => esc_html__( "اگر سرویس پیامکی از این قابلیت پشتیبانی می کند", 'mweb' ),
                'default'  => ''
            ),
			array(
                'id'       => 'pattern_param_name',
                'type'     => 'text',
                'title'    => esc_html__( 'نام پارامتر پترن', 'mweb' ),
                'subtitle' => esc_html__( "برای سرویس هایی نظیر ippanleو sms.irو ...", 'mweb' ),
                'default'  => ''
            ),



        )
    ) );

	Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'نقشه', 'mweb' ),
        'id'     => 'mweb-map-picker',
        'desc'   => esc_html__( 'انتخاب آدرس از روی نقشه / https://corp.map.ir/registration/', 'mweb' ),
        'icon'   => 'fa fa-map',
        'fields' => array(
			array(
				'id'       => 'map_enable',
				'type'     => 'switch',
				'title'    => esc_html__( 'فعال سازی', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => 0
			),
			array(
				'id'       => 'apikey',
				'type'     => 'textarea',
				'title'    => esc_html__( 'کلید api', 'mweb' ),
			),
			array(
				'id'       => 'defaultlat',
				'type'     => 'text',
				'title'    => esc_html__( 'عرض جغرافیایی پیشفرض', 'mweb' ),
				'default'  => '35.74470165',
			),
			array(
				'id'       => 'defaultlong',
				'type'     => 'text',
				'title'    => esc_html__( 'طول جغرافیایی پیشفرض', 'mweb' ),
				'default'  => '51.37527375',
			),


        )
    ) );




    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'سربرگ', 'mweb' ),
        'id'     => 'mweb-header',
        'desc'   => esc_html__( 'تنظیمات بالای صفحه', 'mweb' ),
        'icon'   => 'fa fa-bars',
        'fields' => array(
            array(
                'id'       => 'mweb_logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'لوگو', 'mweb' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( "آپلود کنید", 'mweb' ),
                //'default'  => array( 'url' => get_template_directory_uri() . '/images/logo.png' ),
            ),
			array(
                'id'       => 'mweb_logo_mobile',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'لوگو موبایل', 'mweb' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( "آپلود کنید", 'mweb' ),
                //'default'  => array( 'url' => get_template_directory_uri() . '/images/logo.png' ),
            ),
            array(
                'id'       => 'mweb_favicon',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'آیکن', 'mweb' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( "favicon", 'mweb' ),
            ),
			array(
				'id'       => 'mweb_header_layout',
				'type'     => 'select',
				'title'    => __('انتخاب سربرگ', 'mweb'),
				'subtitle' => __('', 'mweb'),
				'options'  => array(
					'1'        => esc_html__( 'سربرگ 1', 'mweb' ),
					'2'        => esc_html__( 'سربرگ 2', 'mweb' ),
					'3'        => esc_html__( 'سربرگ 3', 'mweb' ),
					//'4'        => esc_html__( 'سربرگ 4', 'mweb' ),
					'5'        => esc_html__( 'سربرگ 5', 'mweb' ),
					//'6'        => esc_html__( 'سربرگ 6', 'mweb' ),
				),
				'default' => '1'
			),

			array(
                'id'       => 'mweb-head-pat',
                'type'     => 'background',
				'background-color' => false,
                'title'    => esc_html__( 'تصویر پس زمینه سربرگ', 'mweb' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( "آپلود کنید", 'mweb' ),
                'default'  => ''
            ),

			array(
				'id'       => 'mweb_head3_menu',
				'type'     => 'select',
				'required' => array( 'mweb_header_layout', '=', '3' ),
				'title'    => esc_html__( 'انتخاب مگامنو عمودی :', 'mweb' ),
				'data'  => 'menu',
			),

			array(
				'id'       => 'mweb_head_tel_or_ins',
				'type'     => 'select',
				'required' => '',
				'title'    => esc_html__( 'نمایش آیکن تلگرام یا اینستاگرام :', 'mweb' ),
				'subtitle' => '',
				'options'  => array(
					'none'        => esc_html__( 'هیچ کدام', 'mweb' ),
					'head_telegram'        => esc_html__( 'تلگرام', 'mweb' ),
					'head_instagram'       => esc_html__( 'اینستاگرام', 'mweb' )
				),
				'default'  => 'head_telegram'
			),

			array(
                'id'       => 'mweb_head_tel_or_ins_link',
                'type'     => 'text',
                'title'    => esc_html__( 'لینک آیکن بالا', 'mweb' ),
		        'default'  => 'http://',
            ),

			array(
                'id'       => 'mhead_social',
                'type'     => 'switch',
                'title'    => esc_html__( 'نمایش آیکن بالا در سربرگ موبایل', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'default'  => true,
            ),

			array(
                'id'       => 'mweb_head_support',
                'type'     => 'switch',
                'title'    => esc_html__( 'دکمه تماس', 'mweb' ),
                'subtitle' => esc_html__( 'نمایش ؟', 'mweb' ),
                'default'  => true,
            ),
			array(
                'id'       => 'sticky_header',
                'type'     => 'switch',
                'title'    => esc_html__( 'منو شناور', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'default'  => true,
            ),
			array(
				'id'       => 'mweb_head_support_text',
				'type'     => 'editor',
				'title'    => 'اطلاعات تماس',
				'subtitle' => '',
				'args'   => array(
				'media_buttons'   => false,
				'textarea_rows'    => 5
				)
			),
			array(
                'id'       => 'mweb_head_logout_url',
                'type'     => 'text',
                'title'    => esc_html__( 'آدرس دکمه خروج', 'mweb' ),
		        'default'  => 'http://',
            ),
			array(
				'id'       => 'mobile_head_activity',
				'type'     => 'switch',
				'title'    => esc_html__( 'فعال سازی سربرگ موبایل', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => true
			),
			array(
				'id'       => 'mobile_head_layout',
				'type'     => 'image_select',
				'title'    => __('انتخاب سربرگ موبایل', 'mweb'),
				'subtitle' => __('', 'mweb'),
				'options'  => array(
					'1' => array(
						'alt'   => 'نوع یک',
						'img'   => ReduxFramework::$_url.'assets/img/mhead-1.png'
					),
					'2' => array(
						'alt'   => 'نوع دو',
						'img'   => ReduxFramework::$_url.'assets/img/mhead-2.png'
					),
					'3' => array(
						'alt'   => 'نوع سه',
						'img'   => ReduxFramework::$_url.'assets/img/mhead-3.png'
					),
				),
				'default' => '2'
			),
			array(
				'id'       => 'mhead_cart',
				'type'     => 'switch',
				'title'    => esc_html__( 'نمایش سبد خرید در سربرگ موبایل', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => true
			),
			array(
                'id'       => 'search_filter',
                'type'     => 'select',
                'title'    => esc_html__( 'نوع جستجوی ایجکس', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
				'options'  => array(
					'product'   => esc_html__( 'محصول', 'mweb' ),
					'post'  => esc_html__( 'وبلاگ', 'mweb' ),
					'both'  => esc_html__( 'هر دو', 'mweb' ),
				),
				'default' => 'both'
            ),
			array(
                'id'       => 'search_list_type',
                'type'     => 'select',
                'title'    => esc_html__( 'نوع نمایش نتیجه جستجو', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'options'  => array(
					'hr' => 'افقی',
					'vr' => 'عمودی',
				),
				'default'  => 'hr'
            ),
			array(
				'id'       => 'search_category',
				'type'     => 'switch',
				'title'    => esc_html__( 'نمایش دسته بندی در فرم جستجو', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => false
			),
			array(
				'id'       => 'search_category_is_text',
				'type'     => 'switch',
				'title'    => esc_html__( 'نمایش دسته بندی در فرم جستجو به صورت متن', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => false
			),
			array(
				'id'       => 'search_history',
				'type'     => 'switch',
				'title'    => esc_html__( 'نمایش تاریخچه جستجو', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => false
			),
			array(
				'id'       => 'search_category_level',
				'type'     => 'switch',
				'title'    => esc_html__( 'تنها نمایش دسته های والد در فرم جستجو', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => false
			),
			array(
                'id'       => 'search_in',
                'type'     => 'select',
                'multi'    => true,
                'title'    => esc_html__( 'نمایش سایر جستجو ها', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'options'  => array(
                    'category' => 'دسته بندی',
                    'tag' => 'برچسب',
                    'brand' => 'برند',
                )
            ),

        )
    ) );


	Redux::setSection( $opt_name, array(
		'title'      => esc_html__( 'تبلیغات و بنر', 'mweb' ),
		'id'         => 'mweb_head_offer',
		'subsection' => true,
		'fields'     => array(

			array(
                'id'       => 'mweb_offer_txt',
                'type'     => 'text',
                'title'    => esc_html__( 'متن', 'mweb' ),
		        'default'  => '',
            ),
			
			array(
                'id'       => 'mweb_offer_size',
                'type'     => 'text',
				'validate' => 'numeric',
                'title'    => esc_html__( 'اندازه فونت', 'mweb' ),
                'subtitle' => esc_html__( "", 'mweb' ),
                'default'  => 12
            ),
			
			array(
				'id'       => 'mweb_offer_color',
				'type'     => 'color',
				'title'    => esc_html__( 'رنگ متن', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => '',
	 			'validate' => 'color',
			),
			
			array(
				'id'       => 'mweb_offer_align',
				'type'     => 'select',
				'title'    => esc_html__( 'تراز متن', 'mweb' ),
				'options'  => array(
					'left'        => esc_html__( 'جپ', 'mweb' ),
					'center'       => esc_html__( 'وسط', 'mweb' ),
					'right' => esc_html__( 'راست', 'mweb' ),
				),
				'default'  => 'center'
			),

			array(
				'id'       => 'mweb_offer_img',
				'type'     => 'media',
				'url'      => true,
				'title'    => esc_html__( 'عکس نسخه دسکتاپ', 'mweb' ),
				'compiler' => 'true',
			),

			array(
				'id'       => 'mweb_offer_img_mob',
				'type'     => 'media',
				'url'      => true,
				'title'    => esc_html__( 'عکس نسخه موبایل', 'mweb' ),
				'compiler' => 'true',
			),

			array(
				'id'       => 'mweb_offer_pat',
				'type'     => 'background',
				'background-color' => true,
				'title'    => esc_html__( 'پس زمینه', 'mweb' ),
				'compiler' => 'true',
				'subtitle' => esc_html__( "آپلود کنید", 'mweb' ),
				'default'  => ''
			),

			array(
				'id'       => 'mweb_offer_link',
				'type'     => 'text',
				'title'    => esc_html__( 'لینک', 'mweb' ),
				'default'  => 'http://',
			),
			array(
                'id'       => 'mweb_offer_gr_bg',
                'type'     => 'switch',
                'title'    => esc_html__( 'پس زمینه گرادینت خودکار', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'default'  => true,
            ),
			array(
                'id'    => 'mweb_banner_info',
                'type'  => 'info',
                'title' => __('توجه', 'mweb'),
                'style' => 'warning',
                'desc'  => __('تنها یک گزینه از میان متن و عکس قابل نمایش است', 'mweb')
            ),

		) )
	);


	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'خدمات', 'mweb' ),
        'id'         => 'mweb_tools',
        'icon'   => 'fa fa-plus',
        'fields'     => array(
		    array(
                'id'       => 'mweb_tools_icon',
                'type'       => 'repeater',
                'title'    => esc_html__( 'آیکن خدمات', 'mweb' ),
                'subtitle' => esc_html__( '.', 'mweb' ),
                'fields'     => array(
		            array(
						'id'          => 'support_info_title',
						 'type'     => 'text',
						'placeholder' => __( 'نام', 'mweb' ),
					),
					array(
						'id'          => 'support_info_link',
						'type'        => 'text',
						'placeholder' => __( 'لینک', 'mweb' ),
					),
					array(
						'id'          => 'support_info_img',
						'type'        => 'text',
						'title'    => esc_html__( 'انتخاب آیکن به صورت تصویر', 'mweb' ),
						'placeholder' => __( 'آدرس آیکن دلخواه', 'mweb' ),
					),
		            array(
						'id'       => 'support_info_icon',
						'type'     => 'select',
						'title'    => esc_html__( 'یا > انتخاب آیکن', 'mweb' ),
						'subtitle' => esc_html__( '', 'mweb' ),
						'options'  => array(
							  'delivery' => 'تحویل اکسپرس',
							  'return-policy' => 'ضمانت بازگشت',
							  'payment-terms' => 'پرداخت در محل',
							  'price-guarantee' => 'تضمین بهترین قیمت',
							  'origin-guarantee' => 'ضمانت اصل بودن',
							  'sendto-all' => 'ارسال به تمام نقاط',
							  'beauti-pack' => 'بسته بندی زیبا',
						)
                  ),

				)
            ),
			array(
                'id'       => 'support_info_style',
                'type'     => 'switch',
                'title'    => esc_html__( 'تغییر استایل', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'default'  => true,
            ),
        )
	));

    // Singles


	Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'صفحات داخلی', 'mweb' ),
        'id'     => 'mweb-single',
        'desc'   => esc_html__( 'تنظیمات صفحات داخلی', 'mweb' ),
        'icon'   => 'fa fa-sitemap',
        'fields' => array(


			array(
				'id'       => 'single_sidebar_position',
				'type'     => 'image_select',
				'title'    => 'موقعیت سایدبار',
				'subtitle' => 'انتخاب موقعیت سایدبار',
				'options'  => mweb_theme_config::sidebar_position(),
				'default'  => 'default'
			),
			array(
				'id'       => 'default_single_post_sidebar',
				'type'     => 'select',
				'title'    => esc_html__( 'سایدبار پیشفرض', 'mweb' ),
				'subtitle' => esc_html__( 'انتخاب کنید', 'mweb' ),
				'options'  => mweb_theme_config::sidebar_name(),
				'default'  => 'sidebar_default'
			),
			array(
                'id'       => 'enable-postviews',
                'type'     => 'switch',
                'title'    => esc_html__( 'ثبت بازدید ها', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'default'  => false,
            ),

        )
    ) );


	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'مطالب عمومی', 'mweb' ),
        'id'         => 'mweb-single_general',
        'subsection' => true,
        'fields'     => array(


			array(
                'id'       => 'mweb-tag',
                'type'     => 'switch',
                'title'    => esc_html__( 'برچسب', 'mweb' ),
                'subtitle' => esc_html__( 'نمایش و عدم نمایش برچسب ها.', 'mweb' ),
                'default'  => true,
            ),

			array(
                'id'       => 'mweb-single-share',
                'type'     => 'switch',
                'title'    => esc_html__( 'اشتراک گذاری', 'mweb' ),
                'subtitle' => esc_html__( 'نمایش و عدم نمایش دکمه های اشتراک گذاری.', 'mweb' ),
                'default'  => true,
            ),

			array(
                'id'       => 'mweb-author-post',
                'type'     => 'switch',
                'title'    => esc_html__( 'نویسنده مطلب', 'mweb' ),
                'subtitle' => esc_html__( 'نمایش و عدم نمایش', 'mweb' ),
                'default'  => true,
            ),

			array(
                'id'       => 'mweb_single_comment',
                'type'     => 'switch',
                'title'    => esc_html__( 'نظرات', 'mweb' ),
                'subtitle' => esc_html__( 'نمایش و عدم نمایش قسمت نظرات.', 'mweb' ),
                'default'  => true,
            ),

        ),

		)

	);




	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'مطالب مرتبط وبلاگ', 'mweb' ),
        'id'         => 'mweb_related_post_section',
        'subsection' => true,
        'fields'     => array(

			array(
                'id'       => 'mweb_show_relpost',
                'type'     => 'switch',
                'title'    => esc_html__( 'مطالب مرتبط', 'mweb' ),
                'subtitle' => esc_html__( 'نمایش یا عدم نمایش', 'mweb' ),
                'default'  => true,
            ),

			array(
				'id'       => 'single_related_where',
				'type'     => 'select',
				'required' => array( 'mweb_show_relpost', '=', '1' ),
				'title'    => esc_html__( 'براساس :', 'mweb' ),
				'subtitle' => esc_html__( 'نمایش مطالب مرتبط', 'mweb' ),
				'options'  => array(
					'all'        => esc_html__( 'دسته بندی و برچسب', 'mweb' ),
					'tags'       => esc_html__( 'برچسب ها', 'mweb' ),
					'categories' => esc_html__( 'دسته بندی ها', 'mweb' ),
				),
				'default'  => 'all'
			),

			array(
                'id'       => 'mweb_num_relpost',
                'type'     => 'slider',
                'title'    => esc_html__( 'تعداد مطالب', 'mweb' ),
                'subtitle' => esc_html__( 'یک مقدار عددی وارد کنید', 'mweb' ),
                'default'  => '5',
				"min"      => 1,
				"step"     => 1,
				"max"      => 10,
            ),
			array(
				'id'       => 'mweb_layout_relpost',
				'type'     => 'select',
				'title'    => __('نحوه نمایش', 'mweb'),
				'subtitle' => __('', 'mweb'),
				'options'  => array(
					'mweb_loop_template_blog_1' => esc_html__( 'یک', 'mweb' ),
					'mweb_loop_template_blog_2' => esc_html__( 'دو', 'mweb' ),
					'mweb_loop_template_blog_3' => esc_html__( 'سه', 'mweb' ),
					'mweb_loop_template_blog_4' => esc_html__( 'چهار', 'mweb' ),
					'mweb_loop_template_blog_5' => esc_html__( 'پنج', 'mweb' ),
				),
				'default' => 'mweb_loop_template_blog_1'
			),

        ),

		)

	);



	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'محصول', 'mweb' ),
        'id'         => 'mweb-single_product',
        'subsection' => true,
        'fields'     => array(

			array(
                'id'       => 'mweb_tools_icon_single',
                'type'       => 'repeater',
                'title'    => esc_html__( 'آیکن خدمات', 'mweb' ),
                'subtitle' => esc_html__( '.', 'mweb' ),
                'fields'     => array(
		            array(
						'id'          => 'single_support_info_title',
						'type'     => 'text',
						'placeholder' => __( 'نام', 'mweb' ),
					),
					array(
						'id'          => 'single_support_info_link',
						'type'        => 'text',
						'placeholder' => __( 'لینک', 'mweb' ),
					),
					array(
						'id'          => 'single_support_info_img',
						'type'        => 'text',
						'title'    => esc_html__( 'انتخاب آیکون به صورت تصویر', 'mweb' ),
						'placeholder' => __( 'آدرس آیکن دلخواه', 'mweb' ),
					),
		            array(
						'id'       => 'single_support_info_icon',
						'type'     => 'select',
						'title'    => esc_html__( 'انتخاب آیکون', 'mweb' ),
						'subtitle' => esc_html__( '', 'mweb' ),
						'options'  => array(
							  'delivery' => 'تحویل اکسپرس',
							  'return-policy' => 'ضمانت بازگشت',
							  'payment-terms' => 'پرداخت در محل',
							  'price-guarantee' => 'تضمین بهترین قیمت',
							  'origin-guarantee' => 'ضمانت اصل بودن',
							  'sendto-all' => 'ارسال به تمام نقاط',
							  'beauti-pack' => 'بسته بندی زیبا',
						)
                  ),

				)
            ),
			array(
                'id'       => 'mweb_add2cart_text',
                'type'     => 'text',
                'title'    => esc_html__( 'متن افزودن به سبد خرید', 'mweb' ),
                'default'  => 'افزودن به سبد خرید',
            ),
			array(
                'id'       => 'mweb_custom_note_product',
                'type'     => 'textarea',
                'title'    => esc_html__( 'افزودن متن یا نکته به محصولات', 'mweb' ),
				'default'  => '',
            ),
			array(
                'id'       => 'mweb_review_tab',
                'type'     => 'select',
                'title'    => esc_html__( 'نمایش تب بررسی', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'options'  => array(
					'show' => 'نمایش',
					'hide' => 'عدم نمایش',
				),
				'default'  => 'show'
            ),
			array(
                'id'       => 'mweb_zoomtype',
                'type'     => 'select',
                'title'    => esc_html__( 'نوع زوم تصاویر محصول', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'options'  => array(
					'none'       => esc_html__( 'غیر فعال', 'mweb' ),
					'inner'      => esc_html__( 'داخلی', 'mweb' ),
					'lens'       => esc_html__( 'لنز', 'mweb' ),
				),
				'default'  => 'inner'
            ),
			array(
                'id'       => 'mweb_product_recently_viewed',
                'type'     => 'switch',
                'title'    => esc_html__( 'نمایش محصولات اخیرا مشاهده  شده', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'default'  => false,
            ),
			array(
                'id'       => 'mweb_product_title_style',
                'type'     => 'switch',
                'title'    => esc_html__( 'تغییر استایل عنوان محصول', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'default'  => false,
            ),
			array(
                'id'       => 'mweb_upcoming_price',
                'type'     => 'switch',
                'title'    => esc_html__( 'حذف قیمت در محصولات به زودی', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'default'  => false,
            ),
			array(
                'id'       => 'pricing_survey_activity',
                'type'     => 'switch',
                'title'    => esc_html__( 'پرسش قیمت مناسبتر', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'default'  => true,
            ),
			array(
                'id'       => 'mweb_upcoming_text',
                'type'     => 'text',
                'title'    => esc_html__( 'متن عرضه به زودی', 'mweb' ),
                'subtitle' => esc_html__( 'تاریخ = %date%', 'mweb' ),
                'default'  => '%date% تا به عرضه این محصول باقی مانده است',
            ),
			array(
                'id'       => 'mweb_upcoming_type',
                'type'     => 'select',
                'title'    => esc_html__( 'نوع نمایش تاریخ عرضه', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'options'  => array(
					'date'  => esc_html__( 'درج تاریخ عرضه', 'mweb' ),
					'duration' => esc_html__( 'درج مدت زمان تا عرضه', 'mweb' ),
				),
				'default'  => 'date'
            ),
			/*array(
                'id'       => 'mweb_review_one',
                'type'     => 'switch',
                'title'    => esc_html__( 'کاربر به ازای هر محصول یک دیدگاه ثبت کند؟', 'mweb' ),
                'subtitle' => esc_html__( 'بله / خیر', 'mweb' ),
                'default'  => true,
            ),*/
			array(
				'id'       => 'mweb_wcc_media_status',
				'type'     => 'switch',
				'title'    => esc_html__( 'امکان افزودن تصاویر توسط خریدار در دیدگاه ها', 'mweb' ),
                'default'  => false,
			),
			array(
                'id'       => 'mweb_like_dislike_restriction',
                'type'     => 'select',
                'title'    => esc_html__( 'محدودیت امتیاز دهی نظرات', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'options'  => array(
					'cookie'  => esc_html__( 'کوکی', 'mweb' ),
					'ip'  => esc_html__( 'آی پی', 'mweb' ),
					'user'  => esc_html__( 'کاربر', 'mweb' ),
					'no'  => esc_html__( 'بدون محدودیت', 'mweb' ),
				),
				'default'  => 'ip'
            ),
			/* array(
                'id'       => 'mweb_comment_rules',
                'type'     => 'editor',
                'title'    => esc_html__( 'قوانین دیدگاه', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'default'  => '',
            ), */
			array(
				'id'		=> 'comment_rules_page_id',
				'title'		=> __( 'برگه قوانین دیدگاه', 'mweb' ),
				'subtitle'	=> __( '', 'mweb' ),
				'type'		=> 'select',
				'data'		=> 'pages',
			),
			array(
                'id'       => 'mweb_sticky_adcart',
                'type'     => 'switch',
                'title'    => esc_html__( 'افزودن به سبد خرید شناور', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'default'  => true,
            ),
			array(
                'id'       => 'mweb_sticky_addcart_mobile',
                'type'     => 'switch',
                'title'    => esc_html__( 'افزودن به سبد خرید شناور موبایل', 'mweb' ),
				'default'  => true,
            ),
			array(
				'id'       => 'mweb_product_single_style',
				'type'     => 'select',
				'required' => '',
				'title'    => esc_html__( 'استایل محصول :', 'mweb' ),
				'subtitle' => '',
				'options'  => array(
					'none' => esc_html__( 'پیشفرض', 'mweb' ),
					'p_style_one' => esc_html__( 'یک', 'mweb' ),
					'p_style_two' => esc_html__( 'دو', 'mweb' ),
				),
				'default'  => 'none'
			),
			array(
				'id'       => 'mweb_product_picmode',
				'type'     => 'select',
				'required' => '',
				'title'    => esc_html__( 'استایل تصویر محصول', 'mweb' ),
				'subtitle' => '',
				'options'  => array(
					'horizontal' => esc_html__( 'افقی', 'mweb' ),
					'vertical' => esc_html__( 'عمودی', 'mweb' ),
				),
				'default'  => 'horizontal'
			),
			array(
				'id'       => 'mweb_product_tab_style',
				'type'     => 'select',
				'required' => '',
				'title'    => esc_html__( 'استایل تب های محصول :', 'mweb' ),
				'subtitle' => '',
				'options'  => array(
					'none'        => esc_html__( 'پیشفرض', 'mweb' ),
					'tabs_one'    => esc_html__( 'یک', 'mweb' ),
					'tabs_two'    => esc_html__( 'دو', 'mweb' ),
					'tabs_three'  => esc_html__( 'سه', 'mweb' )
				),
				'default'  => 'none'
			),
			array(
                'id'       => 'mweb_question_tab',
                'type'     => 'select',
                'title'    => esc_html__( 'نمایش تب پرسش', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'options'  => array(
					'show' => 'نمایش',
					'hide' => 'عدم نمایش',
				),
				'default'  => 'show'
            ),
			array(
                'id'       => 'mweb_accessories_title',
                'type'     => 'text',
                'title'    => esc_html__( 'متن خرید لوازم جانبی', 'mweb' ),
				'default'  => 'خرید لوازم جانبی',
				'subtitle'	=> __( '', 'mweb' ),
            ),
			array(
                'id'       => 'mweb_toggle_content',
                'type'     => 'switch',
                'title'    => esc_html__( 'نمایش محتوای محصول به صورت بازشو', 'mweb' ),
                'subtitle' => esc_html__( 'بله / خیر', 'mweb' ),
                'default'  => false,
            ),
			array(
				'id'       => 'mweb_hide_tags',
				'type'     => 'switch',
				'title'    => esc_html__( 'برچسب محصول', 'mweb' ),
                'subtitle' => esc_html__( 'نمایش و عدم نمایش برچسب ها.', 'mweb' ),
                'default'  => true,
			),
			array(
				'id'       => 'mweb_ajax_single',
				'type'     => 'switch',
				'title'    => esc_html__( 'افزودن به سبد خرید ایجکس', 'mweb' ),
                'default'  => false,
			),
			array(
                'id'       => 'mweb_unavailable_text',
                'type'     => 'text',
                'title'    => esc_html__( 'متن عدم موجودی محصولات متغییر', 'mweb' ),
				'default'  => '',
				'subtitle'	=> __( 'با عرض پوزش، این محصول در دسترس نیست. لطفا ترکیب متفاوتی را انتخاب کنید', 'mweb' ),
            ),
			array(
                'id'       => 'mweb_no_matching_variations_text',
                'type'     => 'text',
                'title'    => esc_html__( 'متن عدم مطابقت ویژگی محصولات متغییر', 'mweb' ),
				'default'  => '',
				'subtitle'	=> __( 'با عرض پوزش، هیچ محصولی با انتخاب شما مطابقت نداشت. لطفا ترکیب متفاوتی را انتخاب کنید.', 'mweb' ),
            ),
			array(
				'id'       => 'mweb_cr_p',
				'type'     => 'switch',
				'title'    => esc_html__( 'نقد بررسی دایره ای', 'mweb' ),
                'default'  => false,
			),
			array(
				'id'       => 'mweb_vstock',
				'type'     => 'switch',
				'title'    => esc_html__( 'نمایش موجودی متغییر ها', 'mweb' ),
                'default'  => false,
			),
			array(
                'id'       => 'mweb_attr_type',
                'type'     => 'select',
                'title'    => esc_html__( 'نمایش ویژگی ها', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'options'  => array(
					'table' => 'جدول',
					'list' => 'لیست',
				),
				'default'  => 'table'
            ),
			array(
				'id'       => 'allow_replayq',
				'type'     => 'switch',
				'title'    => esc_html__( 'اجازه ثبت پاسخ توسط کاربر در پرسش ها', 'mweb' ),
                'default'  => true,
			),

        ))

	);




	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'مطالب مرتبط محصولات', 'mweb' ),
        'id'         => 'mweb_related_product_section',
        'subsection' => true,
        'fields'     => array(

			array(
                'id'       => 'mweb_num_relproduct',
                'type'     => 'slider',
                'title'    => esc_html__( 'تعداد محصول', 'mweb' ),
                'subtitle' => esc_html__( 'یک مقدار عددی وارد کنید', 'mweb' ),
                'default'  => '5',
				"min"      => 1,
				"step"     => 1,
				"max"      => 10,
            ),

			/* array(
				'id'       => 'mweb_rel_outstock',
				'type'     => 'switch',
				'title'    => esc_html__( 'حذف محصولات ناموجود از محصولات مرتبط', 'mweb' ),
                'default'  => false,
			) */

        ),

	)
	);



    // blog

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'وبلاگ', 'mweb' ),
        'id'     => 'mweb_blog_home',
        'desc'   => esc_html__( 'تنظیمات وبلاگ', 'mweb' ),
        'icon'   => 'fa fa-home',
        'fields' => array(

			array(
				'id'       => 'home_sidebar',
				'type'     => 'select',
				'title'    => 'سایدبار',
				'subtitle' => 'انتخاب سایدبار',
				'options'  => mweb_theme_config::sidebar_name(),
				'default'  => 'sidebar_default'
			),
			array(
				'id'       => 'home_sidebar_position',
				'type'     => 'image_select',
				'title'    => 'موقعیت سایدبار',
				'subtitle' => 'انتخاب موقعیت سایدبار',
				'options'  => mweb_theme_config::sidebar_position(),
				'default'  => 'default'
			)


    	)
    ) );




	// page

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'برگه', 'mweb' ),
        'id'     => 'mweb_page_option',
        'desc'   => esc_html__( 'تنظیمات برگه', 'mweb' ),
        'icon'   => 'fa fa-file',
        'fields' => array(

			array(
				'id'       => 'page_sidebar',
				'type'     => 'select',
				'title'    => 'سایدبار',
				'subtitle' => 'انتخاب سایدبار',
				'options'  => mweb_theme_config::sidebar_name(),
				'default'  => 'sidebar_default'
			),
			array(
				'id'       => 'page_sidebar_position',
				'type'     => 'image_select',
				'title'    => 'موقعیت سایدبار',
				'subtitle' => 'انتخاب موقعیت سایدبار',
				'options'  => mweb_theme_config::sidebar_position(),
				'default'  => 'default'
			)


    	)
    ) );




	// archive post

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'آرشیو', 'mweb' ),
        'id'     => 'mweb_archive_home',
        'desc'   => esc_html__( 'تنظیمات آرشیو', 'mweb' ),
        'icon'   => 'fa fa-newspaper',
        'fields' => array(


			array(
				'id'       => 'archive_sidebar',
				'type'     => 'select',
				'title'    => 'سایدبار',
				'subtitle' => 'انتخاب سایدبار',
				'options'  => mweb_theme_config::sidebar_name(),
				'default'  => 'sidebar_default'
			),
			array(
				'id'       => 'archive_sidebar_position',
				'type'     => 'image_select',
				'title'    => 'موقعیت سایدبار',
				'subtitle' => 'انتخاب موقعیت سایدبار',
				'options'  => mweb_theme_config::sidebar_position(),
				'default'  => 'default'
			),

    	)
    ) );





	// archive product

	Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'آرشیو محصولات', 'mweb' ),
        'id'     => 'mweb_product_archive_home',
        'desc'   => esc_html__( 'تنظیمات آرشیو', 'mweb' ),
        'icon'   => 'fa fa-shopping-cart',
        'fields'     => array(

			array(
                'id'       => 'mweb_num_product',
                'type'     => 'slider',
                'title'    => esc_html__( 'تعداد محصول', 'mweb' ),
                'subtitle' => esc_html__( 'یک مقدار عددی وارد کنید', 'mweb' ),
                'default'  => '12',
				"min"      => 1,
				"step"     => 1,
				"max"      => 30,
            ),
			
			array(
				'id'       => 'mweb_infinite_scroll',
				'type'     => 'switch',
				'title'    => esc_html__( 'بارگذاری اسکرولی محصولات', 'mweb' ),
                'default'  => true,
			),

			array(
				'id'       => 'mweb_product_sidebar',
				'type'     => 'select',
				'title'    => 'سایدبار',
				'subtitle' => 'انتخاب سایدبار',
				'options'  => mweb_theme_config::sidebar_name(),
				'default'  => 'sidebar_default'
			),

			array(
				'id'       => 'product_archive_sidebar_position',
				'type'     => 'image_select',
				'title'    => 'موقعیت سایدبار',
				'subtitle' => 'انتخاب موقعیت سایدبار',
				'options'  => mweb_theme_config::sidebar_position(),
				'default'  => 'default'
			),
			array(
				'id'       => 'product_archive_default_type',
				'type'     => 'select',
				'title'    => __('انتخاب نوع نمایش محصول', 'mweb'),
				'subtitle' => __('', 'mweb'),
				'options'  => array(
					'1'        => esc_html__( 'یک', 'mweb' ),
					'2'        => esc_html__( 'دو', 'mweb' ),
					'3'        => esc_html__( 'سه', 'mweb' ),
				),
				'default' => '1'
			),
			array(
                'id'       => 'active_sub_categories',
                'type'     => 'switch',
                'title'    => esc_html__( 'نمایش زیر دسته ها', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'default'  => false,
            ),
			array(
                'id'       => 'position_sub_categories',
                'type'     => 'select',
                'title'    => esc_html__( 'مکان نمایش زیر دسته', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'options'  => array(
					'is_top' => esc_html__( 'بالای عنوان دسته', 'mweb' ),
					'is_down' => esc_html__( 'پایین عنوان دسته', 'mweb' ),
				),
				'default'  => 'is_top'
            ),
			array(
                'id'       => 'product_back_thumbnail',
                'type'     => 'switch',
                'title'    => esc_html__( 'فعال سازی عکس دوم محصولات', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'default'  => false,
            ),
			array(
                'id'       => 'archive_sidebar_toggle',
                'type'     => 'switch',
                'title'    => esc_html__( 'فعال سازی نوار کناری فیلتر', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'default'  => false,
            ),
			array(
                'id'       => 'archive_sidebar_toggle_fixed',
                'type'     => 'switch',
                'title'    => esc_html__( 'فعال سازی نوار کناری فیلتر شناور', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'default'  => false,
            ),
			array(
                'id'       => 'archive_desc_bottom',
                'type'     => 'switch',
                'title'    => esc_html__( 'نمایش توضیحات دسته بندی در پایین محصولات', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'default'  => false,
            ),
			array(
                'id'       => 'disable_sidebar_mobile',
                'type'     => 'switch',
                'title'    => esc_html__( 'غیر فعال سازی سایدبار در موبایل', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'default'  => false,
            ),
			

        ),

		)
	);




	// dokan

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'دکان', 'mweb' ),
        'id'     => 'mweb_store',
        'desc'   => esc_html__( 'در صورت استفاده از افزونه چند فروشندگی', 'mweb' ),
        'icon'   => 'fa fa-home',
        'fields' => array(

			array(
				'id'       => 'dokan_sidebar',
				'type'     => 'select',
				'title'    => 'سایدبار',
				'subtitle' => 'انتخاب سایدبار',
				'options'  => mweb_theme_config::sidebar_name(),
				'default'  => 'sidebar_default'
			),
			array(
				'id'       => 'dokan_sidebar_position',
				'type'     => 'image_select',
				'title'    => 'موقعیت سایدبار',
				'subtitle' => 'انتخاب موقعیت سایدبار',
				'options'  => mweb_theme_config::sidebar_position(),
				'default'  => 'default'
			)


    	)
    ) );



	// popup

	Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'پاپ آپ', 'mweb' ),
        'id'     => 'mweb_popup',
        'desc'   => esc_html__( 'تنظیمات آرشیو', 'mweb' ),
        'icon'   => 'fa fa-clone',
        'fields'     => array(
			array(
				'id'       => 'mweb_popup_pic',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'عکس پاپ آپ', 'mweb' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( "آپلود کنید", 'mweb' ),
			),
			array(
                'id'       => 'mweb_popup_link',
                'type'     => 'text',
                'title'    => esc_html__( 'لینک', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'default'  => 'http://',
            ),
			array(
                'id'       => 'mweb_popup_day',
                'type'     => 'slider',
                'title'    => esc_html__( 'تعداد روز کوکی ', 'mweb' ),
                'subtitle' => esc_html__( 'مدت زمان از بستن پنجره پاپ آپ تا بارگذاری مجدد ان', 'mweb' ),
                'default'  => '12',
				"min"      => 1,
				"step"     => 1,
				"max"      => 30,
            ),

        ),

		)
	);


	// delivery
	Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'تحویل مرسوله', 'mweb' ),
        'id'     => 'mweb-delivery-time',
        'desc'   => esc_html__( '', 'mweb' ),
        'icon'   => 'fa fa-truck',
        'fields' => array(
			array(
				'id'       => 'estimate_delivery_time',
				'type'     => 'switch',
				'title'    => esc_html__( 'فعال سازی تخمین زمان ارسال', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => true
			),
			array(
                'id'       => 'min_delivery_time',
                'type'     => 'text',
                'title'    => esc_html__( 'حداقل زمان تحویل', 'mweb' ),
				'default'  => '',
				'subtitle'	=> __( 'روز به عدد - این عدد با مدت تهیه محصولات جمع و شروع بازه انتخابی خواهد بود', 'mweb' ),
            ),
			array(
                'id'       => 'max_delivery_time',
                'type'     => 'text',
                'title'    => esc_html__( 'تخمین حداکثر زمان تحویل ', 'mweb' ),
				'default'  => '',
				'subtitle'	=> __( 'روز به عدد - این عدد با مدت تهیه محصول جمع و پایان بازه انتخابی خواهد بود', 'mweb' ),
            ),
			array(
				'id'       => 'delivery_time_select',
				'type'     => 'switch',
				'title'    => esc_html__( 'فعال سازی انتخاب زمان تحویل', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => true
			),
			array(
				'id'       => 'delivery_only_bike',
				'type'     => 'switch',
				'title'    => esc_html__( 'نمایش هنگامی که روش ارسال پیک اختصاصی باشد', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => false
			),
			array(
				'id'       => 'delivery_cities_select',
				'type'     => 'text',
				'title'    => esc_html__( 'شهر های دارای پیک', 'mweb' ),
				'subtitle' => esc_html__( 'شهر ها رو با علامت - جدا کنید. جهت غیر فعال سازی این فیلد را خالی رها کنید', 'mweb' ),
			),
			array(
				'id'       => 'delivery_cities_daily',
				'type'     => 'text',
				'title'    => esc_html__( 'شهر های تحویل روز', 'mweb' ),
				'subtitle' => esc_html__( 'شهر ها رو با علامت - جدا کنید. جهت غیر فعال سازی این فیلد را خالی رها کنید', 'mweb' ),
			),
			array(
                'id'       => 'delivery_time_select_title',
                'type'     => 'text',
                'title'    => esc_html__( 'عنوان', 'mweb' ),
				'default'  => ' زمان ارسال این مرسوله را انتخاب نمائید',
				'subtitle'	=> __( '', 'mweb' )
            ),
			array(
                'id'       => 'delivery_time_select_desc',
                'type'     => 'text',
                'title'    => esc_html__( 'توضیح', 'mweb' ),
				'default'  => 'زمان تقریبی تحویل طبق بازه انتخابی در هنگام ثبت سفارشات',
				'subtitle'	=> __( '', 'mweb' )
            ),
			array(
                'id'       => 'delivery_offset_time',
                'type'     => 'text',
				'validate' => 'numeric',
                'title'    => esc_html__( 'بازه غیر فعال سازی', 'mweb' ),
                'subtitle' => esc_html__( "تا چند ساعت قبل از بازه غیر فعال باشد", 'mweb' ),
                'default'  => 2
            ),
			array(
                'id'       => 'delivery_time_select_times',
                'type'     => 'repeater',
                'title'    => esc_html__( 'ساعات تحویل', 'mweb' ),
				'subtitle' => __( 'طبق مثال وارد نمائید  : 9-12', 'mweb' ),
                'fields'   => array(
		            array(
						'id'       => 'delivery_time_start',
						'type'     => 'select',
						'title'    => esc_html__( 'از ساعت', 'mweb' ),
						'subtitle' => esc_html__( '', 'mweb' ),
						'options'  => array_slice(range(0,24), 1, NULL, TRUE),
						'default'  => 8,
					),
					array(
						'id'       => 'delivery_time_end',
						'type'     => 'select',
						'title'    => esc_html__( 'تا ساعت', 'mweb' ),
						'subtitle' => esc_html__( '', 'mweb' ),
						'options'  => array_slice(range(0,24), 1, NULL, TRUE),
						'default'  => 24,
					),
					array(
						'id'       => 'delivery_time_peyk',
						'type'     => 'text',
						'validate' => 'numeric',
						'title'    => esc_html__( 'تعداد پیک', 'mweb' ),
						'subtitle' => esc_html__( "", 'mweb' ),
						'default'  => 5
					),
				)
            ),
			array(
				'id'       => 'delivery_peyk_check',
				'type'     => 'switch',
				'title'    => esc_html__( 'فعال سازی پیک', 'mweb' ),
				'subtitle' => esc_html__( 'بررسی تعداد سفارش در بازه زمانی', 'mweb' ),
				'default'  => true
			),
			array(
				'id'       => 'delivery_peyk_msg',
				'type'     => 'text',
				'title'    => esc_html__( 'متن عدم پیک', 'mweb' ),
				'default' => esc_html__( 'در بازه انتخاب ظرفیت ارسال پر می باشد', 'mweb' ),
			),
			array(
				'id'       => 'delivery_time_friday',
				'type'     => 'switch',
				'title'    => esc_html__( 'غیر فعال سازی جمعه ها', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => true
			),
			array(
                'id'       => 'delivery_time_holidays',
                'type'     => 'multi_text',
                'title'    => esc_html__( 'انتخاب روزهای تعطیل سال', 'mweb' ),
				'default'  => '',
				'subtitle'	=> __( '', 'mweb' )
            ),
			array(
                'id'    => 'delivery_time_info',
                'type'  => 'info',
                'title' => __('توجه :', 'mweb'),
                'style' => 'normal',
                'desc'  => __('در صورتی که روز های جمعه غیرفعال باشد یک به روز به بازه انتخابی افزوده میشود. و این مورد در انتخاب روزهای تعطیل نیز صدق میکند', 'mweb')
            ),

		)

    ) );




	// jewelry options

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'گالری جواهر', 'mweb' ),
        'id'     => 'mweb_jewelry_set',
        'desc'   => esc_html__( 'تنظیمات طلا و جواهر', 'mweb' ),
        'icon'   => 'fa fa-newspaper',
        'fields' => array(

			array(
				'id'       => 'jewelry_enable',
				'type'     => 'switch',
				'title'    => esc_html__( 'فعال سازی تنظیمات جواهر', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => false
			),

			array(
                'id'       => 'jewelry_gold_price_18',
                'type'     => 'text',
				'validate' => 'numeric',
                'title'    => esc_html__( 'قیمت روز طلای 18 عیار', 'mweb' ),
                'subtitle' => esc_html__( "به تومان - شورتکد قیمت زنده [gold_price type=\"18\"] ", 'mweb' ),
            ),

			array(
                'id'       => 'jewelry_gold_price_24',
                'type'     => 'text',
				'validate' => 'numeric',
                'title'    => esc_html__( 'قیمت روز طلای 24 عیار', 'mweb' ),
                'subtitle' => esc_html__( "به تومان - شورتکد قیمت زنده [gold_price type=\"24\"]", 'mweb' ),
            ),
			
			array(
                'id'       => 'jewelry_silver_price_925',
                'type'     => 'text',
				'validate' => 'numeric',
                'title'    => esc_html__( 'قیمت روز نقره 925 عیار', 'mweb' ),
                'subtitle' => esc_html__( "به تومان - شورتکد قیمت زنده [silver_price type=\"925\"]", 'mweb' ),
            ),

			array(
				'id'       => 'jewelry_gold_price_auto',
				'type'     => 'select',
				'title'    => __('قیمت طلا ی اتوماتیک', 'mweb'),
				'subtitle' => __('فراخوانی از سایت های مرجع', 'mweb'),
				'options'  => array(
					'disable'   => esc_html__( 'غیر فعال', 'mweb' ),
					'tgju'  => esc_html__( 'tgju.org', 'mweb' ),
					'tala'  => esc_html__( 'tala.ir', 'mweb' ),
				),
				'default' => 'disable',
				'desc'     => esc_html__( 'ماهدیس وب هیچ گونه مسئولیتی در استفاده از سروریس های فوق ندارد', 'mweb' ),

			),

			array(
                'id'       => 'jewelry_price_check_hours',
                'type'     => 'slider',
                'title'    => esc_html__( 'بررسی از هر چند ساعت', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'default'  => '3',
				"min"      => 1,
				"step"     => 1,
				"max"      => 24,
            ),

			array(
                'id'       => 'jewelry_auto_price_diff',
                'type'     => 'text',
				'validate' => 'numeric',
				'default'  => 0,
                'title'    => esc_html__( 'کم و زیاد کردن قیمت اتوماتیک', 'mweb' ),
                'subtitle' => esc_html__( "می توانید به قیمت اتوماتیک مبلغی را اضافه یا کم کنید(به تومان) - کم کردن را با منفی بنویسید", 'mweb' ),
            ),

			array(
                'id'       => 'jewelry_profit',
                'type'     => 'text',
				'validate' => 'numeric',
				'default'  => 7,
                'title'    => esc_html__( 'میزان سود', 'mweb' ),
                'subtitle' => esc_html__( "به درصد", 'mweb' ),
            ),

			array(
                'id'       => 'jewelry_custom_fields',
                'type'     => 'repeater',
                'title'    => esc_html__( 'فیلدهای سفارشی', 'mweb' ),
				'subtitle' => __( 'مثل : قیمت سنگ، قیمت بند و ...', 'mweb' ),
                'fields'   => array(

					array(
						'id'       => 'jewelry_c_name',
						'type'     => 'text',
						'title'    => esc_html__( 'عنوان', 'mweb' ),
						'subtitle' => esc_html__( "", 'mweb' ),
						'validate' => 'not_empty'
					),
					array(
						'id'       => 'jewelry_c_slug',
						'type'     => 'text',
						'title'    => esc_html__( 'نامک (به انگلیسی)', 'mweb' ),
						'subtitle' => esc_html__( "فاصله مجاز نیست (از _ استفاده کنید)", 'mweb' ),
						'validate' => 'not_empty'
					),
				)
            ),
			array(
				'id'       => 'jewelry_dtprice_btn',
				'type'     => 'switch',
				'title'    => esc_html__( 'نمایش دکمه (مشاهده محاسبه قیمت)', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => 0
			),

			array(
                'id'    => 'jewelry_calculator',
                'type'  => 'info',
                'title' => __('شورتکد ماشین حساب محاسبه قیمت طلا', 'mweb'),
                'style' => 'warning',
                'desc'  => __('[jewel_calculator]', 'mweb')
            ),


    	)
    ) );
	
	
	
	// jewelry options

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'همکاری', 'mweb' ),
        'id'     => 'mweb_cooperation_set',
        'desc'   => esc_html__( 'درخواست قیمت همکاری', 'mweb' ),
        'icon'   => 'fa fa-user',
        'fields' => array(

			array(
				'id'       => 'cooperation_enable',
				'type'     => 'switch',
				'title'    => esc_html__( 'فعال سازی همکاری', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => false
			),
			
			array(
                'id'       => 'cooperation_note_btn',
                'type'     => 'text',
                'title'    => esc_html__( 'درخواست قیمت همکاری', 'mweb' ),
                //'subtitle' => esc_html__( '', 'mweb' ),
            ),

			array(
                'id'       => 'cooperation_myaccount_note',
                'type'     => 'editor',
                'title'    => esc_html__( 'متن جهت نمایش در صفحه اصلی حساب کاربری', 'mweb' ),
                'subtitle' => esc_html__( 'برای عدم نمایش فیلد را خالی رها کنید', 'mweb' ),
            ),

			array(
                'id'       => 'cooperation_main_note',
                'type'     => 'editor',
                'title'    => esc_html__( 'متن جهت نمایش در صفحه ارسال درخواست همکاری', 'mweb' ),
                'subtitle' => esc_html__( 'برای عدم نمایش فیلد را خالی رها کنید', 'mweb' ),
            ),
			
			array(
                'id'    => 'cooperation_shortcode',
                'type'  => 'info',
                'title' => __('شورتکد درخواست همکاری', 'mweb'),
                'style' => 'warning',
                'desc'  => __('[cooperation_request]', 'mweb')
            ),


    	)
    ) );




	// ticket options

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'تیکت', 'mweb' ),
        'id'     => 'mweb_ticket_set',
        'desc'   => esc_html__( 'تنظیمات تیکتینگ', 'mweb' ),
        'icon'   => 'fa fa-file',
        'fields' => array(

			array(
				'id'       => 'ticket_enable',
				'type'     => 'switch',
				'title'    => esc_html__( 'فعال سازی تیکت', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => false
			),

			array(
				'id'       => 'ticket_product',
				'type'     => 'switch',
				'title'    => esc_html__( 'ضروری بودن فیلد محصول', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => false
			),

			array(
				'id'       => 'ticket_product_purchased',
				'type'     => 'switch',
				'title'    => esc_html__( 'حتما باید خریدار محصول باشد', 'mweb' ),
				'subtitle' => esc_html__( 'تا بتواند تیکت ارسال کند', 'mweb' ),
				'default'  => false
			),

			array(
                'id'       => 'ticket_close',
                'type'     => 'slider',
                'title'    => esc_html__( 'بستن تیکت اتوماتیک (به روز)', 'mweb' ),
                'default'  => 3,
				"min"      => 1,
				"step"     => 1,
				"max"      => 30,
            ),

			array(
                'id'       => 'departments',
                'type'     => 'repeater',
                'title'    => esc_html__( 'دپارتمان ها', 'mweb' ),
				'subtitle' => __( '', 'mweb' ),
                'fields'   => array(
					array(
						'id'       => 'department_name',
						'type'     => 'text',
						'title'    => esc_html__( 'عنوان', 'mweb' ),
						'subtitle' => esc_html__( "", 'mweb' ),
						'validate' => 'not_empty'
					),
					array(
						'id'       => 'department_dependent',
						'type'     => 'switch',
						'title'    => esc_html__( 'وابسته به محصول', 'mweb' ),
						'subtitle' => esc_html__( '', 'mweb' ),
						'default'  => false
					),
					array(
						'id'       => 'department_availability',
						'type'     => 'switch',
						'title'    => esc_html__( 'فعال سازی', 'mweb' ),
						'subtitle' => esc_html__( '', 'mweb' ),
						'default'  => true
					),
					array(
						'id'		=> 'department_responder',
						'title'		=> __( 'انتخاب مسئول (کاربر)', 'mweb' ),
						'type'		=> 'select',
						'data'		=> 'users',
						'args' => array(
							'role__in' => array('administrator', 'editor', 'author')
						),
						//'multi' => true,
						'ajax' => true 
					),
				)
            ),
			array(
                'id'       => 'ticket_desc',
                'type'     => 'editor',
                'title'    => esc_html__( 'توضیحات ارسال تیکت', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'default'  => '',
            ),
			array(
                'id'       => 'ticket_faq',
                'type'     => 'repeater',
                'title'    => esc_html__( '', 'mweb' ),
				'subtitle' => __( '', 'mweb' ),
                'fields'     => array(
		            array(
						'id'          => 'ticket_faq_question',
						 'type'     => 'text',
						'placeholder' => __( 'سوال', 'mweb' ),
					),
					array(
						'id'          => 'ticket_faq_answer',
						'type'        => 'textarea',
						'placeholder' => __( 'پاسخ', 'mweb' ),
					)
				)
            ),

    	)
    ) );




	// invoice
	Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'فاکتور', 'mweb' ),
        'id'     => 'mweb-invoice',
        'desc'   => esc_html__( '', 'mweb' ),
        'icon'   => 'fa fa-receipt',
        'fields' => array(
			array(
				'id'       => 'invoice_enable',
				'type'     => 'switch',
				'title'    => esc_html__( 'فعال سازی فاکتور', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => true
			),
			array(
				'id'       => 'preinvoice_enable',
				'type'     => 'switch',
				'title'    => esc_html__( 'فعال سازی پیش فاکتور', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => true
			),
			array(
				'id'       => 'invoice_logo',
				'type'     => 'switch',
				'title'    => esc_html__( 'نمایش لوگو', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => true
			),
			array(
                'id'       => 'invoice_logo_src',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'لوگو فاکتور', 'mweb' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( "آپلود کنید", 'mweb' ),
            ),
			array(
                'id'       => 'invoice_seller',
                'type'     => 'text',
                'title'    => esc_html__( 'نام فروشگاه / فروشنده', 'mweb' ),
				'default'  => '',
				'subtitle'	=> __( '', 'mweb' ),
            ),
			array(
                'id'       => 'invoice_phone',
                'type'     => 'text',
                'title'    => esc_html__( 'شماره تماس فروشگاه', 'mweb' ),
				'default'  => '0210000000',
				'subtitle'	=> __( '', 'mweb' ),
            ),
			array(
                'id'       => 'invoice_meta',
                'type'     => 'select',
                'multi'    => true,
                'title'    => esc_html__( 'محتوای جدول', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'options'  => get_invoice_meta_list()
            ),
			array(
				'id'       => 'invoice_send',
				'type'     => 'switch',
				'title'    => esc_html__( 'ارسال فاکتور', 'mweb' ),
				'subtitle' => esc_html__( 'افزودن گزینه درخواست ارسال فاکتور خرید به صفحه پرداخت', 'mweb' ),
				'default'  => true
			),
			array(
				'id'       => 'invoice_label_style',
				'type'     => 'select',
				'title'    => esc_html__( 'استایل برچسب پستی', 'mweb' ),
				//'subtitle' => esc_html__( '', 'mweb' ),
				//'desc'     => esc_html__( '', 'mweb' ),
				'options'  => array(
					'one' => esc_html__( 'یک', 'mweb' ),
					'two' => esc_html__( 'دو', 'mweb' ),
					//'three' => esc_html__( 'سه', 'mweb' ),
				),
				'default'  => 'one'
			),
			array(
                'id'       => 'invoice_signature_src',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'مهر یا امضا', 'mweb' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( "آپلود کنید", 'mweb' ),
            ),
			
			array(
                'id'       => 'invoice_order_meta',
                'type'     => 'multi_text',
                'title'    => esc_html__( 'متای سفارش', 'mweb' ),
                'subtitle' => esc_html__( 'برچسب|slug', 'mweb' ),
                'desc' => esc_html__( 'باید به صورت نمونه روبرو وارد کنید . ابتدا عنوان متا بعد علامت | و بعد نامک انگلیسی متا', 'mweb' ),
				'default'  => array()
            ),
			array(
                'id'       => 'invoice_product_meta',
                'type'     => 'multi_text',
                'title'    => esc_html__( 'متای محصول', 'mweb' ),
                'subtitle' => esc_html__( 'برچسب|slug', 'mweb' ),
                'desc' => esc_html__( 'باید به صورت نمونه روبرو وارد کنید . ابتدا عنوان متا بعد علامت | و بعد نامک انگلیسی متا', 'mweb' ),
				'default'  => array()
            ),
			array(
                'id'       => 'invoice_label_size',
                'type'     => 'dimensions',
                'title'    => esc_html__( 'اندازه برچسب پستی', 'mweb' ),
				'units'    => array('px'),
				'default'  => array(
					'Width'   => '15', 
					'Height'  => '10'
				),
            ),
			

		)

    ) );


	
	// sms
	Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'پیامک', 'mweb' ),
        'id'     => 'mweb-sms',
        'desc'   => esc_html__( '', 'mweb' ),
        'icon'   => 'fa fa-sms',
        'fields' => array(
		
			array(
				'id'       => 'sms_enable',
				'type'     => 'switch',
				'title'    => esc_html__( 'فعال سازی پیامک', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => false
			),

			array(
				'id'       => 'main_sms_gateway',
				'type'     => 'select',
				'required' => '',
				'title'    => esc_html__( 'سرویس دهنده پیامک', 'mweb' ),
				'subtitle' => '',
				//'desc'     => 'اگر از افزونه پیامک ووکامرس استفاده می کنید میتوانید تنظیمات درگاه را خالی رها کنید',
				'options'  => array(
					'none'        => esc_html__( 'هیچ کدام', 'mweb' ),
					'kavenegar'   => esc_html__( 'kavenegar.com (lookup)', 'mweb' ),
					'melipayamak' => esc_html__( 'melipayamak.com', 'mweb' ),
					'farapayamak' => esc_html__( 'farapayamak.ir', 'mweb' ),
					//'parsgreen'   => esc_html__( 'parsgreen.com', 'mweb' ),
					//'raygansms'   => esc_html__( 'raygansms.com', 'mweb' ),
					'smsir'       => esc_html__( 'sms.ir', 'mweb' ),
					//'payamresan'  => esc_html__( 'payam-resan.com', 'mweb' ),
					'ippanel'     => esc_html__( 'ippanel.com REST', 'mweb' ),
					//'_0098'       => esc_html__( '0098sms.com', 'mweb' ),
					//'sabanovin'   => esc_html__( 'sabanovin.com', 'mweb' ),
				),
				'default'  => 'none'
			),
			array(
				'id'       => 'main_sms_username',
				'type'     => 'text',
				'title'    => esc_html__( 'نام کاربری یا api', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'default'  => ''
			),
			array(
				'id'       => 'main_sms_password',
				'type'     => 'text',
				'title'    => esc_html__( 'گذرواژه', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'default'  => ''
			),
			array(
				'id'       => 'main_sms_number',
				'type'     => 'text',
				'title'    => esc_html__( 'شماره خط ارسالی', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'default'  => ''
			),
			array(
				'id'   => 'sms_order_sc',
				'title' => esc_html__('شورتکد های جزییات سفارش', 'mweb'),
				'type' => 'info',
				'desc' => __('<code>mobile</code> = شماره موبایل کاربر، <code>phone</code> = شماره تلفن مشتری، <code>email</code> = ایمیل مشتری، <code>status</code> = وضعیت سفارش، 
<code>all_items</code> = محصولات سفارش، <code>count_items</code> = تعداد محصولات سفارش، 
<code>price</code> = مبلغ سفارش، <code>order_id</code> = شماره سفارش، <code>transaction_id</code> = شماره تراکنش، 
<code>date</code> = تاریخ سفارش، <code>payment_method</code> = روش پرداخت، <code>shipping_method</code> = روش ارسال', 'mweb')
			),
			array(
				'id'   => 'sms_billing_sc',
				'title' => esc_html__('شورتکد های جزییات صورت حساب', 'mweb'),
				'type' => 'info',
				'style' => 'warning',
				'desc' => __('<code>b_first_name</code> = نام مشتری ، <code>b_last_name</code> = نام خانوادگی مشتری ، <code>b_company</code> = نام شرکت ، <code>b_country</code> = کشور ،
<code>b_state</code> = ایالت/استان ، <code>b_city</code> = شهر ، <code>b_address_1</code> = آدرس 1 ، <code>b_address_2</code> = آدرس 2 ، <code>b_postcode</code> = کد پستی', 'mweb')
			),
			array(
				'id'   => 'sms_shipping_sc',
				'title' => __('شورتکد های جزییات حمل و نقل', 'mweb'),
				'type' => 'info',
				'style' => 'critical',
				'desc' => __('<code>sh_first_name</code> = نام مشتری ، <code>sh_last_name</code> = نام خانوادگی مشتری ، <code>sh_company</code> = نام شرکت ، <code>sh_country</code> = کشور ،
<code>sh_state</code> = ایالت/استان ، <code>sh_city</code> = شهر ، <code>sh_address_1</code> = آدرس 1 ، <code>sh_address_2</code> = آدرس 2 ، <code>sh_postcode</code> = کد پستی ،', 'mweb')
			),
			
		
		)

    ) );
	
	
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'سفارشات', 'mweb' ),
        'id'         => 'main_sms_gateway_order',
        'subsection' => true,
        'fields'     => array(
		
		
			array(
				'id'       => 'admin_sms_sec_start',
				'type'     => 'section',
				'title'    => esc_html__( 'پیامک های مدیر', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'indent' => true 
			),
			array(
				'id'          => 'admin_phone_number',
				'type'        => 'text',
				'title'    => esc_html__( 'شماره موبایل مدیر سایت', 'mweb' ),
				'placeholder' => __( '', 'mweb' ),
				'desc' => __('اگر بیشتر از یک شماره بود با علامت , جدا کنید', 'mweb')
			),
			
			array(
				'id'       => 'admin_sms_status',
				'type'     => 'select',
				'multi'    => true,
				'title'    => esc_html__( 'وضعیت های فعال پیامک مدیر / فروشنده', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'options'  => array(
					//'created' => 'ایجاد سفارش',
					'pending' => 'در انتظار پرداخت',
					'processing' => 'در حال انجام',
					'on_hold' => 'در انتظار بررسی',
					'completed' => 'تکمیل شده',
					'cancelled' => 'لغو شده',
					'cancel_request' => 'درخواست لغو',
					'refunded' => 'مسترد شده',
					'failed' => 'ناموفق',
					'returned' => 'مرجوع شده',
					'return_requested' => 'درخواست مرجوعی',
				)
			),
			
			/* array(
				'id'   =>'divider_a1',
				'type' => 'divide'
			),
			
			array(
				'id'       => 'adsms_created_p',
				'type'     => 'text',
				'title'    => esc_html__( 'نام پترن / الگو', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'default'  => ''
			),
			array(
				'id'          => 'adsms_created',
				'type'     => 'select',
				'multi'    => true,
				'sortable'    => true,
				'title'    => esc_html__( 'پیامک مدیر / ایجاد سفارش', 'mweb' ),
				'options'  => mweb_get_order_sms_shortcode_array(),
			), */
			array(
				'id'   =>'divider_a2',
				'type' => 'divide'
			),
			
			array(
				'id'       => 'adsms_pending_p',
				'type'     => 'text',
				'title'    => esc_html__( 'نام پترن / الگو', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'default'  => ''
			),
			array(
				'id'          => 'adsms_pending',
				'type'     => 'select',
				'multi'    => true,
				'sortable'    => true,
				'title'    => esc_html__( 'پیامک مدیر / در انتظار پرداخت', 'mweb' ),
				'options'  => mweb_get_order_sms_shortcode_array(),
			),
			array(
				'id'   =>'divider_a3',
				'type' => 'divide'
			),
			
			array(
				'id'       => 'adsms_processing_p',
				'type'     => 'text',
				'title'    => esc_html__( 'نام پترن / الگو', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'default'  => ''
			),
			array(
				'id'          => 'adsms_processing',
				'type'     => 'select',
				'multi'    => true,
				'sortable'    => true,
				'title'    => esc_html__( 'پیامک مدیر / در حال انجام', 'mweb' ),
				'options'  => mweb_get_order_sms_shortcode_array(),
			),
			array(
				'id'   =>'divider_a4',
				'type' => 'divide'
			),
			
			array(
				'id'       => 'adsms_on_hold_p',
				'type'     => 'text',
				'title'    => esc_html__( 'نام پترن / الگو', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'default'  => ''
			),
			array(
				'id'          => 'adsms_on_hold',
				'type'     => 'select',
				'multi'    => true,
				'sortable'    => true,
				'title'    => esc_html__( 'پیامک مدیر / در انتظار بررسی', 'mweb' ),
				'options'  => mweb_get_order_sms_shortcode_array(),
			),
			array(
				'id'   =>'divider_a5',
				'type' => 'divide'
			),
			
			array(
				'id'       => 'adsms_completed_p',
				'type'     => 'text',
				'title'    => esc_html__( 'نام پترن / الگو', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'default'  => ''
			),
			array(
				'id'          => 'adsms_completed',
				'type'     => 'select',
				'multi'    => true,
				'sortable'    => true,
				'title'    => esc_html__( 'پیامک مدیر / تکمیل شده', 'mweb' ),
				'options'  => mweb_get_order_sms_shortcode_array(),
			),
			array(
				'id'   =>'divider_a6',
				'type' => 'divide'
			),
			
			array(
				'id'       => 'adsms_cancelled_p',
				'type'     => 'text',
				'title'    => esc_html__( 'نام پترن / الگو', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'default'  => ''
			),
			array(
				'id'          => 'adsms_cancelled',
				'type'     => 'select',
				'multi'    => true,
				'sortable'    => true,
				'title'    => esc_html__( 'پیامک مدیر / لغو شده', 'mweb' ),
				'options'  => mweb_get_order_sms_shortcode_array(),
			),
			array(
				'id'   =>'divider_a7',
				'type' => 'divide'
			),
			
			array(
				'id'       => 'adsms_cancel_request_p',
				'type'     => 'text',
				'title'    => esc_html__( 'نام پترن / الگو', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'default'  => ''
			),
			array(
				'id'          => 'adsms_cancel_request',
				'type'     => 'select',
				'multi'    => true,
				'sortable'    => true,
				'title'    => esc_html__( 'پیامک مدیر / درخواست لغو', 'mweb' ),
				'options'  => mweb_get_order_sms_shortcode_array(),
			),
			array(
				'id'   =>'divider_a8',
				'type' => 'divide'
			),
			
			array(
				'id'       => 'adsms_refunded_p',
				'type'     => 'text',
				'title'    => esc_html__( 'نام پترن / الگو', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'default'  => ''
			),
			array(
				'id'          => 'adsms_refunded',
				'type'     => 'select',
				'multi'    => true,
				'sortable'    => true,
				'title'    => esc_html__( 'پیامک مدیر / مسترد شده', 'mweb' ),
				'options'  => mweb_get_order_sms_shortcode_array(),
			),
			array(
				'id'   =>'divider_a9',
				'type' => 'divide'
			),
			
			array(
				'id'       => 'adsms_failed_p',
				'type'     => 'text',
				'title'    => esc_html__( 'نام پترن / الگو', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'default'  => ''
			),
			array(
				'id'          => 'adsms_failed',
				'type'     => 'select',
				'multi'    => true,
				'sortable'    => true,
				'title'    => esc_html__( 'پیامک مدیر / ناموفق', 'mweb' ),
				'options'  => mweb_get_order_sms_shortcode_array(),
			),
			
			array(
				'id'   =>'divider_a10',
				'type' => 'divide'
			),
			
			array(
				'id'       => 'adsms_return_requested_p',
				'type'     => 'text',
				'title'    => esc_html__( 'نام پترن / الگو', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'default'  => ''
			),
			array(
				'id'          => 'adsms_return_requested',
				'type'     => 'select',
				'multi'    => true,
				'sortable'    => true,
				'title'    => esc_html__( 'پیامک مدیر / درخواست مرجوعی', 'mweb' ),
				'options'  => mweb_get_order_sms_shortcode_array(),
			),
			
			array(
				'id'       => 'admin_sms_sec_end',
				'type'     => 'section',
				'indent' => false 
			),
			
			
			
			array(
				'id'       => 'user_sms_sec_start',
				'type'     => 'section',
				'title'    => esc_html__( 'پیامک های مشتری', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'indent' => true 
			),
			
			
			array(
				'id'       => 'user_sms_status',
				'type'     => 'select',
				'multi'    => true,
				'title'    => esc_html__( 'وضعیت های فعال پیامک مشتری', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'options'  => array(
					//'created' => 'ایجاد سفارش',
					'pending' => 'در انتظار پرداخت',
					'processing' => 'در حال انجام',
					'on_hold' => 'در انتظار بررسی',
					'completed' => 'تکمیل شده',
					'cancelled' => 'لغو شده',
					'cancel_request' => 'درخواست لغو',
					'refunded' => 'مسترد شده',
					'failed' => 'ناموفق',
					'returned' => 'مرجوع شده',
					'return_requested' => 'درخواست مرجوعی',
				)
			),
			/* array(
				'id'   =>'divider_s0',
				'type' => 'divide'
			),
			array(
				'id'       => 'crsms_created_p',
				'type'     => 'text',
				'title'    => esc_html__( 'نام پترن / الگو', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'default'  => ''
			),
			array(
				'id'          => 'crsms_created',
				'type'     => 'select',
				'multi'    => true,
				'sortable'    => true,
				'title'    => esc_html__( 'پیامک مشتری / ایجاد سفارش', 'mweb' ),
				'options'  => mweb_get_order_sms_shortcode_array(),
			), */
			array(
				'id'   =>'divider_s1',
				'type' => 'divide'
			),
			array(
				'id'       => 'crsms_pending_p',
				'type'     => 'text',
				'title'    => esc_html__( 'نام پترن / الگو', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'default'  => ''
			),
			array(
				'id'          => 'crsms_pending',
				'type'     => 'select',
				'multi'    => true,
				'sortable'    => true,
				'title'    => esc_html__( 'پیامک مشتری / در انتظار پرداخت', 'mweb' ),
				'options'  => mweb_get_order_sms_shortcode_array(),
			),
			array(
				'id'   =>'divider_s2',
				'type' => 'divide'
			),
			array(
				'id'       => 'crsms_processing_p',
				'type'     => 'text',
				'title'    => esc_html__( 'نام پترن / الگو', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'default'  => ''
			),
			array(
				'id'          => 'crsms_processing',
				'type'     => 'select',
				'multi'    => true,
				'sortable'    => true,
				'title'    => esc_html__( 'پیامک مشتری / در حال انجام', 'mweb' ),
				'options'  => mweb_get_order_sms_shortcode_array(),
			),
			array(
				'id'   =>'divider_s3',
				'type' => 'divide'
			),
			array(
				'id'       => 'crsms_on_hold_p',
				'type'     => 'text',
				'title'    => esc_html__( 'نام پترن / الگو', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'default'  => ''
			),
			array(
				'id'          => 'crsms_on_hold',
				'type'     => 'select',
				'multi'    => true,
				'sortable'    => true,
				'title'    => esc_html__( 'پیامک مشتری / در انتظار بررسی', 'mweb' ),
				'options'  => mweb_get_order_sms_shortcode_array(),
			),
			array(
				'id'   =>'divider_s4',
				'type' => 'divide'
			),
			array(
				'id'       => 'crsms_completed_p',
				'type'     => 'text',
				'title'    => esc_html__( 'نام پترن / الگو', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'default'  => ''
			),
			array(
				'id'          => 'crsms_completed',
				'type'     => 'select',
				'multi'    => true,
				'sortable'    => true,
				'title'    => esc_html__( 'پیامک مشتری / تکمیل شده', 'mweb' ),
				'options'  => mweb_get_order_sms_shortcode_array(),
			),
			array(
				'id'   =>'divider_s5',
				'type' => 'divide'
			),
			array(
				'id'       => 'crsms_cancelled_p',
				'type'     => 'text',
				'title'    => esc_html__( 'نام پترن / الگو', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'default'  => ''
			),
			array(
				'id'          => 'crsms_cancelled',
				'type'     => 'select',
				'multi'    => true,
				'sortable'    => true,
				'title'    => esc_html__( 'پیامک مشتری / لغو شده', 'mweb' ),
				'options'  => mweb_get_order_sms_shortcode_array(),
			),
			array(
				'id'   =>'divider_s6',
				'type' => 'divide'
			),
			array(
				'id'       => 'crsms_cancel_request_p',
				'type'     => 'text',
				'title'    => esc_html__( 'نام پترن / الگو', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'default'  => ''
			),
			array(
				'id'          => 'crsms_cancel_request',
				'type'     => 'select',
				'multi'    => true,
				'sortable'    => true,
				'title'    => esc_html__( 'پیامک مشتری / درخواست لغو', 'mweb' ),
				'options'  => mweb_get_order_sms_shortcode_array(),
			),
			array(
				'id'   =>'divider_s7',
				'type' => 'divide'
			),
			array(
				'id'       => 'crsms_refunded_p',
				'type'     => 'text',
				'title'    => esc_html__( 'نام پترن / الگو', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'default'  => ''
			),
			array(
				'id'          => 'crsms_refunded',
				'type'     => 'select',
				'multi'    => true,
				'sortable'    => true,
				'title'    => esc_html__( 'پیامک مشتری / مسترد شده', 'mweb' ),
				'options'  => mweb_get_order_sms_shortcode_array(),
			),
			array(
				'id'   =>'divider_s8',
				'type' => 'divide'
			),
			array(
				'id'       => 'crsms_failed_p',
				'type'     => 'text',
				'title'    => esc_html__( 'نام پترن / الگو', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'default'  => ''
			),
			array(
				'id'          => 'crsms_failed',
				'type'     => 'select',
				'multi'    => true,
				'sortable'    => true,
				'title'    => esc_html__( 'پیامک مشتری / ناموفق', 'mweb' ),
				'options'  => mweb_get_order_sms_shortcode_array(),
			),
			
			array(
				'id'   =>'divider_s9',
				'type' => 'divide'
			),
			array(
				'id'       => 'crsms_return_requested_p',
				'type'     => 'text',
				'title'    => esc_html__( 'نام پترن / الگو', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'default'  => ''
			),
			array(
				'id'          => 'crsms_return_requested',
				'type'     => 'select',
				'multi'    => true,
				'sortable'    => true,
				'title'    => esc_html__( 'پیامک مشتری / درخواست مرجوع', 'mweb' ),
				'options'  => mweb_get_order_sms_shortcode_array(),
			),
			
			array(
				'id'   =>'divider_s10',
				'type' => 'divide'
			),
			array(
				'id'       => 'crsms_returned_p',
				'type'     => 'text',
				'title'    => esc_html__( 'نام پترن / الگو', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'default'  => ''
			),
			array(
				'id'          => 'crsms_returned',
				'type'     => 'select',
				'multi'    => true,
				'sortable'    => true,
				'title'    => esc_html__( 'پیامک مشتری / مرجوع شده', 'mweb' ),
				'options'  => mweb_get_order_sms_shortcode_array(),
			),
			
			array(
				'id'       => 'user_sms_sec_end',
				'type'     => 'section',
				'indent' => false 
			),
					

        ),

	));
	
	
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'رهگیری سفارشات', 'mweb' ),
        'id'         => 'main_sms_order_tracking',
        'subsection' => true,
        'fields'     => array(
		
		
			array(
				'id'       => 'tracking_sms_sec_start',
				'type'     => 'section',
				'title'    => esc_html__( 'پیامک های مشتری', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'indent' => true 
			),
			
			array(
				'id'       => 'sms_tracking_pattern',
				'type'     => 'text',
				'title'    => esc_html__( 'نام پترن / الگو', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'default'  => ''
			),
			array(
				'id'          => 'sms_tracking_params',
				'type'     => 'select',
				'multi'    => true,
				'sortable'    => true,
				'title'    => esc_html__( 'پیامک رهگیری سفارشات', 'mweb' ),
				'options'  => array(
					'order_id' => 'شماره سفارش',
					'b_first_name' => 'صورتحساب / نام',
					'b_last_name' => 'صورتحساب / نام خانوادگی',
					'sh_first_name' => 'حمل و نقل / نام',
					'sh_last_name' => 'حمل و نقل / نام خانوادگی',
					'tracking_code' => 'کد رهگیری',
					'transfer_co' => 'شرکت حمل و نقل',
				)
			),
			
			array(
				'id'       => 'tracking_sms_sec_end',
				'type'     => 'section',
				'indent' => false 
			),
			
			
			array(
				'id'   => 'sms_order_tracking_sc',
				'title' => __('شورتکد های رهگیری سفارشات', 'mweb'),
				'type' => 'info',
				'style' => 'warning',
				'desc' => __('<code>tracking_code</code> = کد رهگیری ، <code>transfer_co</code> =  شرکت حمل و نقل ، <code>transaction_id</code> = شماره تراکنش ، <code>b_first_name</code> = صورتحساب / نام مشتری ، <code>b_last_name</code> = صورتحساب / نام خانوادگی مشتری ، <code>sh_first_name</code> = حمل و نقل / نام مشتری ، <code>sh_last_name</code> = حمل و نقل / نام خانوادگی مشتری', 'mweb')
			),
			
		),

	));
	
	
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'تیکت', 'mweb' ),
        'id'         => 'main_sms_ticket',
        'subsection' => true,
        'fields'     => array(
		
		
			array(
				'id'       => 'tasms_sec_start',
				'type'     => 'section',
				'title'    => esc_html__( 'پیامک های مدیر / پشتیبان', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'indent' => true 
			),
			
			array(
				'id'          => 'tadmin_phone_number',
				'type'        => 'text',
				'title'    => esc_html__( 'شماره موبایل مدیر سایت', 'mweb' ),
				'placeholder' => __( '', 'mweb' ),
			),
			
			array(
				'id'       => 'tadmin_sms_status',
				'type'     => 'select',
				'multi'    => true,
				'title'    => esc_html__( 'وضعیت های فعال پیامک مدیر / پشتیبان', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'options'  => array(
					1 => 'ایجاد',
					2 => 'پاسخ',
					3 => 'تغییر وضعیت',
				)
			),
			
			
			array(
				'id'   =>'divider_ta1',
				'type' => 'divide'
			),
			array(
				'id'       => 'tasms_create_p',
				'type'     => 'text',
				'title'    => esc_html__( 'نام پترن / الگو', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'default'  => ''
			),
			array(
				'id'          => 'tasms_create',
				'type'     => 'select',
				'multi'    => true,
				'sortable'    => true,
				'title'    => esc_html__( 'پیامک پشتیبان / ایجاد', 'mweb' ),
				'options'  => array(
					'id' => 'شناسه',
					'title' => 'عنوان',
					'status' => 'وضعیت',
					'date' => 'تاریخ ایجاد',
					'update' => 'تاریخ بروزرسانی',
					'priority' => 'اولویت',
					'department' => 'دیپارتمان',
									
				)
			),
			
			array(
				'id'   =>'divider_ta2',
				'type' => 'divide'
			),
			array(
				'id'       => 'tasms_reply_p',
				'type'     => 'text',
				'title'    => esc_html__( 'نام پترن / الگو', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'default'  => ''
			),
			array(
				'id'          => 'tasms_reply',
				'type'     => 'select',
				'multi'    => true,
				'sortable'    => true,
				'title'    => esc_html__( 'پیامک پشتیبان / پاسخ', 'mweb' ),
				'options'  => array(
					'id' => 'شناسه',
					'title' => 'عنوان',
					'status' => 'وضعیت',
					'priority' => 'اولویت',
					'department' => 'دیپارتمان',
					'date' => 'تاریخ ایجاد',
					'update' => 'تاریخ بروزرسانی',
									
				)
			),
			
			array(
				'id'   =>'divider_ta3',
				'type' => 'divide'
			),
			array(
				'id'       => 'tasms_status_p',
				'type'     => 'text',
				'title'    => esc_html__( 'نام پترن / الگو', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'default'  => ''
			),
			array(
				'id'          => 'tasms_status',
				'type'     => 'select',
				'multi'    => true,
				'sortable'    => true,
				'title'    => esc_html__( 'پیامک پشتیبان / تغییر وضعیت', 'mweb' ),
				'options'  => array(
					'id' => 'شناسه',
					'title' => 'عنوان',
					'status' => 'وضعیت',
					'date' => 'تاریخ ایجاد',
					'update' => 'تاریخ بروزرسانی',
					'priority' => 'اولویت',
					'department' => 'دیپارتمان',
									
				)
			),
			
			
			array(
				'id'       => 'tadmin_sms_sec_end',
				'type'     => 'section',
				'indent' => false 
			),
			
			
			array(
				'id'       => 'tuser_sms_sec_start',
				'type'     => 'section',
				'title'    => esc_html__( 'پیامک های کاربر', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'indent' => true 
			),
			
			array(
				'id'       => 'tuser_sms_status',
				'type'     => 'select',
				'multi'    => true,
				'title'    => esc_html__( 'وضعیت های فعال پیامک کاربر', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'options'  => array(
					1 => 'ایجاد',
					2 => 'پاسخ',
					3 => 'تغییر وضعیت',
				)
			),
			
			
			array(
				'id'   =>'divider_tu1',
				'type' => 'divide'
			),
			array(
				'id'       => 'tusms_create_p',
				'type'     => 'text',
				'title'    => esc_html__( 'نام پترن / الگو', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'default'  => ''
			),
			array(
				'id'          => 'tusms_create',
				'type'     => 'select',
				'multi'    => true,
				'sortable'    => true,
				'title'    => esc_html__( 'پیامک کاربر / ایجاد', 'mweb' ),
				'options'  => array(
					'id' => 'شناسه',
					'title' => 'عنوان',
					'status' => 'وضعیت',
					'date' => 'تاریخ ایجاد',
					'update' => 'تاریخ بروزرسانی',
					'priority' => 'اولویت',
					'department' => 'دیپارتمان',
									
				)
			),
			
			array(
				'id'   =>'divider_tu2',
				'type' => 'divide'
			),
			array(
				'id'       => 'tusms_reply_p',
				'type'     => 'text',
				'title'    => esc_html__( 'نام پترن / الگو', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'default'  => ''
			),
			array(
				'id'          => 'tusms_reply',
				'type'     => 'select',
				'multi'    => true,
				'sortable'    => true,
				'title'    => esc_html__( 'پیامک کاربر / پاسخ', 'mweb' ),
				'options'  => array(
					'id' => 'شناسه',
					'title' => 'عنوان',
					'status' => 'وضعیت',
					'date' => 'تاریخ ایجاد',
					'update' => 'تاریخ بروزرسانی',
					'priority' => 'اولویت',
					'department' => 'دیپارتمان',
									
				)
			),
			
			array(
				'id'   =>'divider_tu3',
				'type' => 'divide'
			),
			array(
				'id'       => 'tusms_status_p',
				'type'     => 'text',
				'title'    => esc_html__( 'نام پترن / الگو', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'default'  => ''
			),
			array(
				'id'          => 'tusms_status',
				'type'     => 'select',
				'multi'    => true,
				'sortable'    => true,
				'title'    => esc_html__( 'پیامک کاربر / تغییر وضعیت', 'mweb' ),
				'options'  => array(
					'id' => 'شناسه',
					'title' => 'عنوان',
					'status' => 'وضعیت',
					'date' => 'تاریخ ایجاد',
					'update' => 'تاریخ بروزرسانی',
					'priority' => 'اولویت',
					'department' => 'دیپارتمان',
									
				)
			),
			
			array(
				'id'       => 'tuser_sms_sec_end',
				'type'     => 'section',
				'indent' => false 
			),
			

			array(
				'id'   => 'sms_ticket_sc',
				'title' => __('شورتکد های تیکت', 'mweb'),
				'type' => 'info',
				'style' => 'warning',
				'desc' => __('<code>id</code> = شناسه، <code>title</code> = عنوان، <code>status</code> = وضعیت، <code>date</code> = تاریخ ایجاد، <code>update</code> = تاریخ بروزرسانی، <code>priority</code> = اولویت، <code>department</code> = دیپارتمان ', 'mweb')
			),

        ),

	));
	
	
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'مشترکین خبرنامه', 'mweb' ),
        'id'         => 'main_sms_subsciber_product',
        'subsection' => true,
        'fields'     => array(
		
		
			array(
				'id'       => 'sp_sms_sec_start',
				'type'     => 'section',
				'title'    => esc_html__( 'پیامک های مشترکین', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'indent' => true 
			),
			
			array(
				'id'       => 'sms_in_pattern',
				'type'     => 'text',
				'title'    => esc_html__( 'نام پترن / الگو', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'default'  => ''
			),
			array(
				'id'          => 'sms_in_params',
				'type'     => 'select',
				'multi'    => true,
				'sortable'    => true,
				'title'    => esc_html__( 'پیامک موجود شدن', 'mweb' ),
				'options'  => array(
					'product_name' => 'نام محصول',
					'product_url' => 'آدرس محصول',
					'price' => 'قیمت محصول',
					'onsale_price' => 'قیمت فروش ویژه',
					'discount_percent' => 'درصد تخفیف',
				)
			),
			
			array(
				'id'   =>'divider_sp',
				'type' => 'divide'
			),
			
			array(
				'id'       => 'sms_onsale_pattern',
				'type'     => 'text',
				'title'    => esc_html__( 'نام پترن / الگو', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'default'  => ''
			),
			array(
				'id'          => 'sms_onsale_params',
				'type'     => 'select',
				'multi'    => true,
				'sortable'    => true,
				'title'    => esc_html__( 'پیامک فروش ویژه', 'mweb' ),
				'options'  => array(
					'product_name' => 'نام محصول',
					'product_url' => 'آدرس محصول',
					'price' => 'قیمت محصول',
					'onsale_price' => 'قیمت فروش ویژه',
					'discount_percent' => 'درصد تخفیف',
				)
			),
			
			array(
				'id'       => 'sp_sms_sec_end',
				'type'     => 'section',
				'indent' => false 
			),
						
			array(
				'id'   => 'sms_subscriber_sc',
				'title' => __('شورتکد های مشترکین خبرنامه', 'mweb'),
				'type' => 'info',
				'style' => 'warning',
				'desc' => __('<code>product_name</code> = نام محصول، <code>product_url</code> = آدرس محصول ، <code>price</code> = قیمت ، <code>onsale_price</code> = قیمت فروش ویژه ، <code>discount_percent</code> = درصد تخفیف', 'mweb')
			),
			
		),

	));
	
	
	
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'نظر سنجی سفارش', 'mweb' ),
        'id'         => 'main_sms_rate_order',
        'subsection' => true,
        'fields'     => array(
		
		
			array(
				'id'       => 'or_sms_sec_start',
				'type'     => 'section',
				'title'    => esc_html__( 'پیامک های مشتری', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'indent' => true 
			),
			
			array(
                'id'       => 'orsms_day',
                'type'     => 'text',
				'validate' => 'numeric',
                'title'    => esc_html__( 'زمان ارسال (به روز)', 'mweb' ),
                'desc' => esc_html__( "چند روز بعد از تکمیل سفارش پیامک ارسال شود", 'mweb' ),
                'default'  => 7
            ),
			
			array(
				'id'       => 'orsms_in_pattern',
				'type'     => 'text',
				'title'    => esc_html__( 'نام پترن / الگو', 'mweb' ),
				'subtitle' => esc_html__( "", 'mweb' ),
				'default'  => ''
			),
			array(
				'id'          => 'orsms_in_params',
				'type'     => 'select',
				'multi'    => true,
				'sortable'    => true,
				'title'    => esc_html__( 'پیامک نظر سنجی', 'mweb' ),
				'options'  => array(
					'b_first_name' => 'نام مشتری',
					'b_last_name' => 'نام خانوادگی مشتری',
					'order_id' => 'شناسه سفارش',
					'survey_link' => 'لینک نظر سنجی',
				)
			),
			
			array(
				'id'       => 'or_sms_sec_end',
				'type'     => 'section',
				'indent' => false 
			),
						
			array(
				'id'   => 'or_subscriber_sc',
				'title' => __('نظر سنجی', 'mweb'),
				'type' => 'info',
				'style' => 'warning',
				'desc' => __('<code>order_id</code> = شناسه سفارش، <code>survey_link</code> = لینک نظر سنجی، <code>b_first_name</code> = نام مشتری ، <code>b_last_name</code> = نام خانوادگی مشتری', 'mweb')
			),
			
		),

	));
	

	// Sidebars
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'سایدبار', 'mweb' ),
        'id'     => 'mweb-sidebars',
        'icon'   => 'fa fa-indent',
        'fields' => array(
			array(
				'id'       => 'sidebar_style',
				'type'     => 'select',
				'title'    => esc_html__( 'استایل سربرگ سایدبار', 'mweb' ),
				//'subtitle' => esc_html__( '', 'mweb' ),
				//'desc'     => esc_html__( '', 'mweb' ),
				'options'  => array(
					'1' => esc_html__( 'یک', 'mweb' ),
					'2' => esc_html__( 'دو', 'mweb' ),
					'3' => esc_html__( 'سه', 'mweb' ),
					'4' => esc_html__( 'چهار', 'mweb' ),
					//'three' => esc_html__( 'سه', 'mweb' ),
				),
				'default'  => '1'
			),
            array(
                'id'       => 'mweb_multi_sidebar',
                'type'     => 'multi_text',
                'title'    => esc_html__( 'ایجاد سایدبار', 'mweb' ),
                'subtitle' => esc_html__( 'از حروف انگلیسی استفاده کنید', 'mweb' ),
				'default'  => array()
            ),
			array(
                'id'       => 'sticky_sidebar',
                'type'     => 'switch',
                'title'    => esc_html__( 'سایدبار شناور', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'default'  => false,
            )


    	)
    ) );




	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'حساب کاربری', 'mweb' ),
        'id'         => 'mweb_myaccount',
        'icon'   => 'fa fa-user',
        'fields'     => array(
			array(
                'id'       => 'disable_password_current',
                'type'     => 'switch',
                'title'    => esc_html__( 'حذف گذرواژه پیشین', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'default'  => true,
            ),
			array(
                'id'       => 'allow_avatar',
                'type'     => 'switch',
                'title'    => esc_html__( 'امکان تغییر آواتار کاربر', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'default'  => true,
            ),
		    array(
                'id'       => 'mweb_myacc_menu',
                'type'       => 'repeater',
                'title'    => esc_html__( 'منو سفارشی', 'mweb' ),
                'subtitle' => esc_html__( '.', 'mweb' ),
                'fields'     => array(
		            array(
						'id'          => 'myacc_title',
						 'type'     => 'text',
						'placeholder' => __( 'عنوان', 'mweb' ),
					),
					array(
						'id'          => 'myacc_link',
						'type'        => 'text',
						'placeholder' => __( 'لینک', 'mweb' ),
					),
				)
            ),
			array(
				'id'		=> 'become_seller_page_id',
				'title'		=> __( 'برگه فروشنده شوید', 'mweb' ),
				'subtitle'	=> __( 'مخصوص حساب کاربری', 'mweb' ),
				'type'		=> 'select',
				'data'		=> 'pages',
			),
			array(
                'id'       => 'mweb_become_seller_text',
                'type'     => 'editor',
                'title'    => esc_html__( 'متن جهت فروشنده شدن', 'mweb' ),
				'subtitle'	=> __( 'مخصوص حساب کاربری', 'mweb' ),
            ),
			array(
                'id'       => 'mweb_myaccount_note',
                'type'     => 'editor',
                'title'    => esc_html__( 'نکته و ... در داشبود پنل کاربری', 'mweb' ),
                'subtitle' => esc_html__( 'برای عدم نمایش فیلد را خالی رها کنید', 'mweb' ),
            ),
			/* array(
                'id'       => 'mweb_myacc_style',
                'type'     => 'switch',
                'title'    => esc_html__( 'تغییر استایل', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'default'  => true,
            ), */
			array(
                'id'       => 'mweb_transfer_company',
                'type'       => 'repeater',
                'title'    => esc_html__( 'لیست شرکت های خدمات بار', 'mweb' ),
                'subtitle'     => esc_html__( 'جهت نمایش در پیگیری سفارش و کد رهگیری - دقت کنید نباید بعدا نامک ها را حذف و یا تغییر دهید', 'mweb' ),
                'fields'     => array(
		            array(
						'id'          => 'transfer_co_name',
						'type'        => 'text',
						'placeholder' => __( 'نام شرکت', 'mweb' ),
						'validate' => array( 'not_empty' )
					),
					array(
						'id'          => 'transfer_co_slug',
						'type'        => 'text',
						'placeholder' => __( 'نامک (انگلیسی) . مثلا tipax', 'mweb' ),
						'validate' => array( 'not_empty' )
					),
					array(
						'id'          => 'transfer_co_url',
						'type'        => 'text',
						'placeholder' => __( 'آدرس سایت', 'mweb' ),
						'validate' => array( 'url', 'not_empty' )
					),
				)
            ),
			array(
                'id'       => 'mweb_order_status',
                'type'       => 'repeater',
                'title'    => esc_html__( 'ترتیب وضعیت سفارشات', 'mweb' ),
                'subtitle'     => esc_html__( 'اگر مایل به نمایش وضعیت سفارشبه صورت مرحله هستید مقادیر زیر را پر کنید', 'mweb' ),
                'fields'     => array(
		            array(
						'id'       => 'order_status_name',
						'type'     => 'select',
						'title'    => esc_html__( 'وضعیت', 'mweb' ),
						'options'  => get_order_status_list_as_array(),
					),
					array(
						'id'          => 'order_status_priority',
						'type'        => 'select',
						'title'       => esc_html__( 'اولویت(مرحله)', 'mweb' ),
						'options'  => array( 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9 ),
					)
				)
            ),
			array(
				'id'       => 'login_style',
				'type'     => 'select',
				'title'    => esc_html__( 'استایل ورود و عضویت', 'mweb' ),
				//'subtitle' => esc_html__( '', 'mweb' ),
				//'desc'     => esc_html__( '', 'mweb' ),
				'options'  => array(
					'one' => esc_html__( 'یک', 'mweb' ),
					'two' => esc_html__( 'دو', 'mweb' ),
					//'three' => esc_html__( 'سه', 'mweb' ),
				),
				'default'  => 'one'
			),
			array(
                'id'       => 'mweb_logo_account',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'لوگو ورود و عضویت', 'mweb' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( "آپلود کنید", 'mweb' ),
                //'default'  => array( 'url' => get_template_directory_uri() . '/images/logo.png' ),
            ),
			
			

        )
	));
	
	
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'مرجوعی', 'mweb' ),
        'id'         => 'mweb_return_product',
        'subsection' => true,
        'fields'     => array(
			
			array(
                'id'       => 'mweb_return_active',
                'type'     => 'switch',
                'title'    => esc_html__( 'فعال سازی مرجوعی', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'default'  => false,
            ),
			
			array(
				'id'       => 'mweb_return_rules',
				'type'     => 'editor',
				'title'    => 'قوانین مرجوعی',
				'subtitle' => '',
				'args'   => array(
				'media_buttons'   => false,
				'textarea_rows'    => 5
				)
			),
			array(
				'id'       => 'mweb_return_statuses',
				'type'     => 'select',
				'title'    => esc_html__( 'وضعیت های قابل قبول', 'mweb' ),
				'multi'    => true,
				'options'  => get_order_status_list_as_array(),
			),
			array(
                'id'       => 'mweb_return_day',
                'type'     => 'text',
				'validate' => 'numeric',
                'title'    => esc_html__( 'مرجوعی تا چند روز', 'mweb' ),
                'desc' => esc_html__( "تا چند روز بعد از تکمیل سفارش فعال باشد", 'mweb' ),
                'default'  => 10
            ),
			array(
                'id'       => 'mweb_return_reasons',
                'title'    => esc_html__( 'دلایل مرجوعی', 'mweb' ),
				'type'     => 'select',
				'multi'    => true,
				'options'  => mweb_get_return_reasons()
            ),
			array(
                'id'       => 'mweb_return_cats',
                'type'       => 'repeater',
                'title'    => esc_html__( 'دسته های شامل مرجوعی', 'mweb' ),
                'subtitle' => esc_html__( '.', 'mweb' ),
                'fields'     => array(
		            array(
						'id'          => 'mweb_return_cat_id',
						'type'     => 'select',
						'data'     => 'terms',
						'args' => array(
							'taxonomies' => array( 'product_cat' ),
						),
						'title'    => __( 'دسته بندی', 'mweb' ),
						//'multi' => true,
						'ajax' => true
					),
					array(
						'id'          => 'mweb_return_cat_text',
						'type'        => 'textarea',
						'title'    => __( 'پیغام', 'mweb' ),
						'placeholder' => __( 'درخواست مرجوع کردن کالا در گروه دیجیتال با دلیل "انصراف از خرید" تنها در صورتی قابل تایید است که کالا در شرایط اولیه باشد (در صورت پلمپ بودن، کالا نباید باز شده باشد).', 'mweb' ),
					)
				)
            )

        ),
	));




	// faq

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'پرسش و پاسخ', 'arad' ),
        'id'     => 'mweb_faq',
        'desc'   => esc_html__( 'مدیریت قسمت پرسش و پاسخ', 'arad' ),
        'icon'   => 'fa fa-question-circle',
        'fields' => array(

			array(
                'id'       => 'mweb_question_and_answer',
                'type'       => 'repeater',
                'title'    => esc_html__( 'پرسش و پاسخ', 'mweb' ),
                'subtitle' => esc_html__( '.', 'mweb' ),
                'fields'     => array(
		            array(
						'id'          => 'mweb_faq_question',
						 'type'     => 'text',
						'placeholder' => __( 'سوال', 'mweb' ),
					),
					array(
						'id'          => 'mweb_faq_answer',
						'type'        => 'textarea',
						'placeholder' => __( 'پاسخ', 'mweb' ),
					)
				)
            )

    	)
    ) );




	// typography

	Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'تایپوگرافی', 'mweb' ),
        'id'     => 'mweb-typography',
        'icon'   => 'fa fa-indent',
        'fields' => array(
			array(
				'id'          => 'menu-typography',
				'type'        => 'typography',
				'title'       => __('منو اصلی', 'mweb'),
				'google'      => false,
				'font-family' => false,
				'text-align'  => false,
				'font-style'  => false,
				'font-weight' => true,
				//'output'      => array('h2.site-description'),
				'units'       =>'px',
				//'subtitle'    => __('', 'mweb'),
				'default'     => array(
					'color'       => '#333',
					'font-weight'  => '500',
					'font-size'   => '12px',
					'line-height' => '49px'
				),
			),
			array(
				'id'          => 'content-typography',
				'type'        => 'typography',
				'title'       => __('محتوای محصولات و وبلاگ', 'mweb'),
				'google'      => false,
				'font-family' => false,
				'text-align'  => false,
				'font-style'  => false,
				'font-weight' => true,
				//'output'      => array('h2.site-description'),
				'units'       =>'px',
				//'subtitle'    => __('', 'mweb'),
				'default'     => array(
					'font-size'   => '12px',
				),
			),
			array(
				'id'          => 'ch2-typography',
				'type'        => 'typography',
				'title'       => __('تگ H2', 'mweb'),
				'google'      => false,
				'font-family' => false,
				'text-align'  => false,
				'font-style'  => false,
				'font-weight' => true,
				//'output'      => array('h2.site-description'),
				'units'       =>'px',
				//'subtitle'    => __('', 'mweb'),
				'default'     => array(
					'font-weight'   => '500',
				),
			),
			array(
				'id'          => 'ch3-typography',
				'type'        => 'typography',
				'title'       => __('تگ H3', 'mweb'),
				'google'      => false,
				'font-family' => false,
				'text-align'  => false,
				'font-style'  => false,
				'font-weight' => true,
				//'output'      => array('h2.site-description'),
				'units'       =>'px',
				//'subtitle'    => __('', 'mweb'),
				'default'     => array(
					'font-weight'   => '500',
				),
			),
			array(
				'id'          => 'ch4-typography',
				'type'        => 'typography',
				'title'       => __('تگ H4', 'mweb'),
				'google'      => false,
				'font-family' => false,
				'text-align'  => false,
				'font-style'  => false,
				'font-weight' => true,
				//'output'      => array('h2.site-description'),
				'units'       =>'px',
				//'subtitle'    => __('', 'mweb'),
				'default'     => array(
					'font-weight'   => '500',
				),
			),
			array(
				'id'          => 'ch5-typography',
				'type'        => 'typography',
				'title'       => __('تگ H5', 'mweb'),
				'google'      => false,
				'font-family' => false,
				'text-align'  => false,
				'font-style'  => false,
				'font-weight' => true,
				//'output'      => array('h2.site-description'),
				'units'       =>'px',
				//'subtitle'    => __('', 'mweb'),
				'default'     => array(
					'font-weight'   => '500',
				),
			)



    	)
    ) );



	// thumbnails

	Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'تصاویر', 'mweb' ),
        'id'     => 'mweb-thumbnails',
        'icon'   => 'fa fa-image',
        'fields' => array(
			array(
				'id'       => 'thumb_feat',
				'type'     => 'select',
				'title'    => esc_html__( 'تصاویر شاخص - موقعیت برش', 'mweb' ),
				'subtitle' => esc_html__( 'موقعیت را برای برش تصاویر شاخص انتخاب کنید. ', 'mweb' ),
				'desc'     => esc_html__( 'برای تغییر تصاویر شاخص قدیمی از پلاگین Regenerate thumbnail استفاده نمائید', 'mweb' ),
				'options'  => array(
					'center' => esc_html__( 'از وسط', 'mweb' ),
					'top'    => esc_html__( 'از بالا', 'mweb' ),
				),
				'default'  => 'center'
			),
			array(
				'id'       => 'thumb_size_v1',
				'type'     => 'switch',
				'title'    => esc_html__( '850x283', 'mweb' ),
				'subtitle' => esc_html__( 'تصاویر تب اسلایدر', 'mweb' ),
				'default'  => 1
			),
			array(
				'id'       => 'thumb_size_v2',
				'type'     => 'switch',
				'title'    => esc_html__( '300x300', 'mweb' ),
				'subtitle' => esc_html__( 'تصاویر اسلایدر فروش ویژه', 'mweb' ),
				'default'  => 1
			),
			array(
				'id'       => 'thumb_size_v3',
				'type'     => 'switch',
				'title'    => esc_html__( '256x170', 'mweb' ),
				'subtitle' => esc_html__( 'تصاویر بلاک وبلاک یک ، دو ، چهار', 'mweb' ),
				'default'  => 1
			),
			array(
				'id'       => 'thumb_size_v4',
				'type'     => 'switch',
				'title'    => esc_html__( '75x75', 'mweb' ),
				'subtitle' => esc_html__( 'تصاویر محصولات افقی کوچک', 'mweb' ),
				'default'  => 1
			),
			array(
				'id'       => 'thumb_size_v5',
				'type'     => 'switch',
				'title'    => esc_html__( '209x209', 'mweb' ),
				'subtitle' => esc_html__( 'تصویر بزرگ محصول اول بلاک / همراه با محصولات افقی کوچک', 'mweb' ),
				'default'  => 1
			),
			array(
				'id'       => 'thumb_size_v6',
				'type'     => 'switch',
				'title'    => esc_html__( '162x78', 'mweb' ),
				'subtitle' => esc_html__( 'تصاویر پست تایپ برند', 'mweb' ),
				'default'  => 1
			),
			/* array(
				'id'       => 'thumb_size_v7',
				'type'     => 'switch',
				'title'    => esc_html__( '110x110', 'mweb' ),
				'subtitle' => esc_html__( 'تصاویر نظرات کاربران', 'mweb' ),
				'default'  => 1
			), */
			/* array(
				'id'       => 'thumb_size_v8',
				'type'     => 'switch',
				'title'    => esc_html__( '50x50', 'mweb' ),
				'subtitle' => esc_html__( 'تصاویر محصولات / مطالب همراه با عکس ابزارک ها', 'mweb' ),
				'default'  => 1
			), */
			array(
				'id'       => 'thumb_size_v9',
				'type'     => 'switch',
				'title'    => esc_html__( '230x160', 'mweb' ),
				'subtitle' => esc_html__( 'تصاویر محصولات ارشیو وبلاگ', 'mweb' ),
				'default'  => 1
			),
			array(
				'id'       => 'thumb_size_v10',
				'type'     => 'switch',
				'title'    => esc_html__( '405x236', 'mweb' ),
				'subtitle' => esc_html__( 'تصاویر بلاک سه وبلاگ', 'mweb' ),
				'default'  => 1
			),
			array(
				'id'       => 'thumb_size_v11',
				'type'     => 'switch',
				'title'    => esc_html__( '550x550', 'mweb' ),
				'subtitle' => esc_html__( 'تصاویر محصول 360 درجه', 'mweb' ),
				'default'  => 1
			),


    	)
    ) );



	 // color

	 Redux::setSection( $opt_name, array(
			'title'  => esc_html__( 'رنگبندی', 'mweb' ),
			'id'     => 'mweb_colors',
			'desc'   => esc_html__( 'تنظیمات رنگبندی', 'mweb' ),
			'icon'   => 'fa fa-paint-brush',
			'fields' => array(

			array(
				'id'       => 'color_main',
				'type'     => 'color',
				'title'    => esc_html__( 'رنگ اصلی', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => '',
	 			'validate' => 'color',
			),
			array(
				'id'       => 'color_sec',
				'type'     => 'color',
				'title'    => esc_html__( 'رنگ فرعی', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => '',
	 			'validate' => 'color',
			),
			array(
				'id'       => 'color1',
				'type'     => 'color',
				'title'    => esc_html__( 'رنگ 1', 'mweb' ),
				'subtitle' => esc_html__( 'پس زمینه سایت', 'mweb' ),
				'default'  => '',
	 			'validate' => 'color',
			),
			array(
				'id'       => 'color2',
				'type'     => 'color',
				'title'    => esc_html__( 'رنگ 2', 'mweb' ),
				'subtitle' => esc_html__( 'سربرگ', 'mweb' ),
				'default'  => '',
	 			'validate' => 'color',
			),

			array(
				'id'       => 'color3',
				'type'     => 'color',
				'title'    => esc_html__( 'رنگ 3', 'mweb' ),
				'subtitle' => esc_html__( 'رنگ پس زمینه پابرگ', 'mweb' ),
				'default'  => '',
	 			'validate' => 'color',
			),
			array(
				'id'       => 'color4',
				'type'     => 'color',
				'title'    => esc_html__( 'رنگ 4', 'mweb' ),
				'subtitle' => esc_html__( 'رنگ متن پابرگ', 'mweb' ),
				'default'  => '',
	 			'validate' => 'color',
			),
			array(
				'id'       => 'color5',
				'type'     => 'color',
				'title'    => esc_html__( 'رنگ 5', 'mweb' ),
				'subtitle' => esc_html__( 'رنگ دکمه افزودن به سبد خرید', 'mweb' ),
				'default'  => '',
	 			'validate' => 'color',
			),

			array(
				'id'       => 'color6',
				'type'     => 'color',
				'title'    => esc_html__( 'رنگ 6', 'mweb' ),
				'subtitle' => esc_html__( 'رنگ برچسب موجود نیست', 'mweb' ),
				'default'  => '',
	 			'validate' => 'color',
			),
			array(
				'id'       => 'color7',
				'type'     => 'color',
				'title'    => esc_html__( 'رنگ 7', 'mweb' ),
				'subtitle' => esc_html__( 'رنگ سبد خرید', 'mweb' ),
				'default'  => '',
	 			'validate' => 'color',
			),
			array(
				'id'       => 'color8',
				'type'     => 'color',
				'title'    => esc_html__( 'رنگ 8', 'mweb' ),
				'subtitle' => esc_html__( 'رنگ پس زمینه درصد تخفیف', 'mweb' ),
				'default'  => '',
	 			'validate' => 'color',
			),
			array(
				'id'       => 'bg_head_mobile',
				'type'     => 'color',
				'title'    => esc_html__( 'رنگ پس زمینه سربرگ موبایل ', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
	 			'validate' => 'color',
			),
			array(
				'id'       => 'color_head_mobile',
				'type'     => 'color',
				'title'    => esc_html__( 'رنگ متن سربرگ موبایل', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
	 			'validate' => 'color',
			),
			array(
				'id'       => 'bg_toolbar',
				'type'     => 'color',
				'title'    => esc_html__( 'رنگ پس زمینه نوارابزار پایین موبایل ', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
	 			'validate' => 'color',
			),
			array(
				'id'       => 'color_txt_toolbar',
				'type'     => 'color',
				'title'    => esc_html__( 'رنگ متن نوارابزار پایین موبایل ', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
	 			'validate' => 'color',
			),

        )
    ) );




    // Social Icons

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'شبکه اجتماعی', 'mweb' ),
        'id'     => 'socialicons',
        'icon'   => 'fa fa-share',
        'fields' => array(
            array(
                'id'       => 'mweb_social_icons',
                'type'     => 'sortable',
                'title'    => esc_html__( 'شبکه های اجتماعی سایت', 'mweb' ),
                'subtitle' => esc_html__( 'به راحتی میتوانید با کشیدن و رها کردن گزینه ها را جابجا کنید', 'mweb' ),
                'label'    => true,
                'options'  => array(
                    'facebook' => 'http://your_facebook_page_url',
                    'twitter' => '#',
                    'instagram' => '',
                    'telegram' => '#',
                    'youtube' => '',
                    'aparat' => '#',
                    'behance' => '',
                    'dribble' => '',
                    'linkedin' => '',
                    'pinterest' => '',
                )
            ),
			array(
				'id'       => 'sharing_social_medias',
				'type'     => 'select',
				'multi'    => true,
				'title'    => esc_html__( 'اشتراک مطالب', 'mweb' ),
				'subtitle' => esc_html__( 'به راحتی میتوانید با کشیدن و رها کردن گزینه ها را جابجا کنید', 'mweb' ),
				'options'  => array(
					'facebook' => 'فیسبوک',
					'twitter' => 'تویتر',
					'telegram' => 'تلگرام',
					'whatsapp' => 'واتس آپ',
					'linkedin' => 'لینکدین',
					'pinterest' => 'پینترست',
				)
			),

			array(
				'id'       => 'sharing_social_product',
				'type'     => 'select',
				'multi'    => true,
				'title'    => esc_html__( 'اشتراک محصول', 'mweb' ),
				'subtitle' => esc_html__( 'به راحتی میتوانید با کشیدن و رها کردن گزینه ها را جابجا کنید', 'mweb' ),
				'options'  => array(
					'facebook' => 'فیسبوک',
					'twitter' => 'تویتر',
					'telegram' => 'تلگرام',
					'whatsapp' => 'واتس آپ',
					'sms' => 'اس ام اس',
					//'google-plus' => 'گوگل پلاس',
					'linkedin' => 'لینکدین',
					'pinterest' => 'پینترست',
				)
			),

    	)
    ) );





	// box

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'باکس', 'mweb' ),
        'id'     => 'mweb_boxs',
        'desc'   => esc_html__( 'تنظیمات عناوین باکس ها', 'mweb' ),
        'icon'   => 'fa fa-box',
        'fields' => array(

			/* array(
				'id'       => 'box_layout',
				'type'     => 'image_select',
				'title'    => __('انتخاب نوع باکس', 'mweb'),
				'subtitle' => __('نوع نمایش عنوان باکس ها را انتخاب نمایید.', 'mweb'),
				'options'  => array(

				'1'      => array(
					'alt'   => 'decor0',
					'img'   => ReduxFramework::$_url.'assets/img/box0.png'
				),
				'2'      => array(
					'alt'   => 'decor1',
					'img'   => ReduxFramework::$_url.'assets/img/box1.png'
				),
				),
				'default' => '2'
			), */
			array(
				'id'       => 'badge_style',
				'type'     => 'select',
				'title'    => esc_html__( 'استایل برچسب تخفیف', 'mweb' ),
				'options'  => array(
					'triangle'        => esc_html__( 'مثلث ', 'mweb' ),
					'hexagon'       => esc_html__( 'شش ضلعی', 'mweb' ),
					'circle'       => esc_html__( 'دایره', 'mweb' ),
					'square'       => esc_html__( 'مربع', 'mweb' ),
				),
				'default'  => 'triangle'
			),
			array(
				'id'       => 'label_text_style',
				'type'     => 'select',
				'title'    => esc_html__( 'استایل برچسب محصول', 'mweb' ),
				'options'  => array(
					'one'       => esc_html__( 'یک', 'mweb' ),
					'two'       => esc_html__( 'دو', 'mweb' ),
					'three'     => esc_html__( 'سه', 'mweb' ),
				),
				'default'  => 'three'
			),
			array(
                'id'       => 'mweb_check_stock',
                'type'     => 'switch',
                'title'    => esc_html__( 'نمایش برچسب موجود نیست', 'mweb' ),
                'subtitle' => esc_html__( 'در ارشیو محصولات', 'mweb' ),
                'default'  => false,
            ),
			array(
                'id'       => 'mweb_white_body',
                'type'     => 'switch',
                'title'    => esc_html__( 'تغییر شادو باکس ها', 'mweb' ),
                'subtitle' => esc_html__( 'اگر از پس زمینه سفید استفاده میکنید این گزینه را فعال کنید', 'mweb' ),
                'default'  => false,
            ),
			array(
                'id'       => 'global_radius',
                'type'     => 'text',
				'validate' => 'numeric',
                'title'    => esc_html__( 'گوشه های مدور کلی', 'mweb' ),
                'subtitle' => esc_html__( "", 'mweb' ),
                'default'  => 7
            ),
			array(
				'id'       => 'sepbox_style',
				'type'     => 'select',
				'title'    => esc_html__( 'استایل جداکننده عناوین بلاک', 'mweb' ),
				'options'  => array(
					'one'        => esc_html__( 'یک', 'mweb' ),
					'two'       => esc_html__( 'دو', 'mweb' ),
					'three'       => esc_html__( 'سه', 'mweb' ),
				),
				'default'  => 'one'
			),

    	)
    ) );


    // Footer

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'پابرگ', 'mweb' ),
        'id'     => 'mweb_footer',
        'desc'   => esc_html__( 'تنظیمات پابرگ', 'mweb' ),
        'icon'   => 'fa fa-minus',
        'fields' => array(

			array(
				'id'       => 'mweb_footer_layout',
				'type'     => 'select',
				'title'    => __('انتخاب پابرگ', 'mweb'),
				'subtitle' => __('', 'mweb'),
				'options'  => array(
					'1'        => esc_html__( 'پابرگ 1', 'mweb' ),
					'2'        => esc_html__( 'پابرگ 2', 'mweb' ),
					'3'        => esc_html__( 'پابرگ 3', 'mweb' ),
				),
				'default' => '1'
			),

            array(
                'id'       => 'mweb_copyright',
                'type'     => 'textarea',
                'title'    => esc_html__( 'متن کپی رایت', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'default'  => 'کلیه حقوق مادی و معنوی برای این سایت محفوظ می باشد',
            ),

			array(
                'id'       => 'mweb-footer-social',
                'type'     => 'switch',
                'title'    => esc_html__( 'شبکه های اجتماعی', 'mweb' ),
                'subtitle' => esc_html__( 'نمایش و عدم نمایش شبکه های اجتماعی.', 'mweb' ),
                'default'  => true,
            ),

			array(
                'id'       => 'mweb_gototop',
                'type'     => 'switch',
                'title'    => esc_html__( 'رفتن به بالا', 'mweb' ),
                'subtitle' => esc_html__( 'نمایش و عدم نمایش دکمه رفتن به بالا.', 'mweb' ),
                'default'  => true,
            ),
			array(
                'id'       => 'mweb_footer_light',
                'type'     => 'switch',
                'title'    => esc_html__( 'پابرگ لایت', 'mweb' ),
                'subtitle' => esc_html__( 'اگر در رنگبندی فوتر از پس زمینه روشن استفاده میکنید این گزینه را فعال نمائید', 'mweb' ),
                'default'  => false,
            ),

			array(
                'id'       => 'mweb_toolbox',
                'type'     => 'switch',
                'title'    => esc_html__( 'منو دسترسی سریع', 'mweb' ),
                'subtitle' => esc_html__( 'نمایش و عدم نمایش', 'mweb' ),
                'default'  => '',
            ),


			array(
				'id'      => 'mweb_footer_sort',
				'type'    => 'sorter',
				'title'   => 'ترتیب قرار گیری',
				'desc'    => '',
				'options' => array(
					'enabled'  => array(
						'footer_menu_1' => 'منو یک',
						'footer_menu_2'     => 'منو دو',
						'footer_menu_3'     => 'منو دو',
						'namad_electro' => 'نماد الکترونیک',
						'namad_samandehi'   => 'نماد ساماندهی',
						'namad_slider'   => 'اسلایدر نمادها',
						'about_us'   => 'درباره ما',
						'contact_us_one'   => 'ارتباط با ما یک',
						'contact_us_two'   => 'ارتباط با ما دو',
						'contact_us_three'   => 'ارتباط با ما سه'
					),
					'disabled' => array(
					)
				),
			),


			array(
				'id'       => 'mweb_namad_electro_title',
				'type'     => 'text',
				'title'    => esc_html__( 'عنوان کد نماد الکترونیکی', 'mweb' ),
			),
			array(
				'id'       => 'mweb_namad_electro',
				'type'     => 'textarea',
				'title'    => esc_html__( 'کد نماد الکترونیکی', 'mweb' ),
			),

			array(
				'id'       => 'mweb_namad_samandehi_title',
				'type'     => 'text',
				'title'    => esc_html__( 'عنوان کد نماد ساماندهی', 'mweb' ),
			),
			array(
				'id'       => 'mweb_namad_samandehi',
				'type'     => 'textarea',
				'title'    => esc_html__( 'کد نماد ساماندهی', 'mweb' ),
			),

			array(
				'id'       => 'mweb_namad_unknown',
				'type'     => 'textarea',
				'title'    => esc_html__( 'کد نماد سوم', 'mweb' ),
			),

			array(
				'id'       => 'mweb_aboutus_title',
				'type'     => 'text',
				'title'    => esc_html__( 'سایت درباره عنوان', 'mweb' ),
			),
			array(
				'id'       => 'mweb_aboutus_content',
				'type'     => 'editor',
				'title'    => esc_html__( 'متن درباره سایت', 'mweb' ),
			),

			array(
				'id'       => 'mweb_footer_android',
				'type'     => 'text',
				'title'    => esc_html__( 'لینک دریافت آپ اندروید', 'mweb' ),
			),
			array(
				'id'       => 'mweb_footer_ios',
				'type'     => 'text',
				'title'    => esc_html__( 'لینک دریافت آپ آی او اس', 'mweb' ),
			),
			array(
				'id'       => 'mweb_footer_subscribe',
				'type'     => 'text',
				'title'    => esc_html__( 'شورتکد اشتراک در خبرنامه', 'mweb' ),
			),

			array(
                'id'       => 'mweb-footer-pat',
                'type'     => 'background',
				'background-color' => false,
                'title'    => esc_html__( 'تصویر پس زمینه پابرگ', 'mweb' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( "آپلود کنید", 'mweb' ),
                'default'  => ''
            ),

			array(
				'id'       => 'mweb_bottom_toolbar_style',
				'type'     => 'select',
				'title'    => __('نوع نمایش پابرگ چسبان موبایل', 'mweb'),
				'subtitle' => __('', 'mweb'),
				'options'  => array(
					'1' => esc_html__( 'یک', 'mweb' ),
					'2' => esc_html__( 'دو', 'mweb' ),
					'3' => esc_html__( 'سه', 'mweb' ),
					'4' => esc_html__( 'چهار', 'mweb' ),
				),
				'default' => '2'
			),

			array(
                'id'       => 'mweb_bottom_toolbar',
                'type'       => 'repeater',
                'title'    => esc_html__( 'گزینه های منو شناور موبایل', 'mweb' ),
                'subtitle' => esc_html__( 'تعداد آیتم میبایست عددی فرد باشد - برچسب ها تنها برای نوع 3 و 4 می باشد', 'mweb' ),
                'fields'     => array(
					array(
						'id'       => 'b_toolbar_type',
						'type'     => 'select',
						'title'    => esc_html__( 'نوع آیتم', 'mweb' ),
						'subtitle' => esc_html__( 'اگر نوع سفارشی بود فیلدهای پایین رو پر کنید - (آیکن و لینک)', 'mweb' ),
						'options'  => array(
							  'goup' => 'رفتن به بالا',
							  'cart' => 'سبد خرید',
							  'cat' => 'دسته بندی ها',
							  'user' => 'ورود و عضویت',
							  'custom' => 'سفارشی',
						),
						'default'  => 'custom',
					),
					array(
						'id'          => 'b_toolbar_icon',
						'type'     => 'text',
						'subtitle' => esc_html__( 'آدرس فایل svg یا سورس آن', 'mweb' ),
						'placeholder' => __( 'آیکن', 'mweb' ),
						'default'  => '',
					),
					array(
						'id'          => 'b_toolbar_label',
						'type'        => 'text',
						'placeholder' => __( 'برچسب', 'mweb' ),
					),
					array(
						'id'          => 'b_toolbar_link',
						'type'        => 'text',
						'placeholder' => __( 'لینک', 'mweb' ),
					),

				)
			),



    	)
    ) );


	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'دکمه پیام رسان', 'mweb' ),
        'id'         => 'mweb_contact_btn',
        'subsection' => true,
        'fields'     => array(
			array(
				'id'       => 'elm_c_btn_position',
				'type'     => 'switch',
				'title'    => esc_html__( 'موقعیت', 'mweb' ),
				'on'       => 'راست',
				'off'      => 'چپ',
				'default'  => true
			),
			array(
				'id'       => 'elm_c_bg',
				'type'     => 'color',
				'title'    => esc_html__('زنگ پس زمینه دکمه همگانی', 'mweb'),
				'default'  => '#FC0111',
				'validate' => 'color',
			),
			array(
				'id'          => 'elm_c_icon',
				'type'        => 'text',
				'title'       => __( 'آیکن دکمه', 'mweb' ),
                'subtitle'    => esc_html__( 'آدرس تصویر آیکن را وارد کنید', 'mweb' ),
				'default'     => ''
			),
			array(
                'id'       => 'elm_c_btns',
                'type'     => 'repeater',
                'title'    => esc_html__( 'دکمه ها', 'mweb' ),
                'subtitle' => esc_html__( 'اگر بیشتر از یک گزینه باشد به صورت کشویی باز خواهد شد', 'mweb' ),
                'fields'   => array(
		            array(
						'id'       => 'elm_c_btn_type',
						'type'     => 'select',
						'title'    => esc_html__( 'انتخاب', 'mweb' ),
						'subtitle' => esc_html__( '', 'mweb' ),
						'options'  => array(
							  'telegram' => 'تلگرام',
							  'whatsapp' => 'واتس اپ',
							  'sms' => 'پیامک',
							  'call' => 'تماس',
							  'instagram' => 'اینستاگرام',
							  'eitaa' => 'ایتا',
							  'bale' => 'بله',
							  'soroush' => 'سروش',
							  'rubika' => 'روبیکا',
							  'goftino' => 'گفتینو',
						)
					),
					array(
						'id'          => 'elm_c_btn_title',
						'type'        => 'text',
						'placeholder' => __( 'عنوان', 'mweb' ),
					),
					array(
						'id'          => 'elm_c_btn_link',
						'type'        => 'text',
						'placeholder' => __( 'لینک', 'mweb' ),
					),

				)
            ),


       ),
	));

	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'ارتباط با ما', 'mweb' ),
        'id'         => 'mweb_contact_us',
        'subsection' => true,
        'fields'     => array(
			array(
				'id'       => 'mweb_contact_address',
				'type'     => 'text',
				'title'    => esc_html__( 'آدرس', 'mweb' ),
				'subtitle' => esc_html__( '', 'mweb' ),
				'default'  => '',
				),
			array(
                'id'       => 'mweb_contact_tel',
                'type'     => 'text',
                'title'    => esc_html__( 'تلفن', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'default'  => '',
            ),
			array(
                'id'       => 'mweb_contact_mail',
                'type'     => 'text',
                'title'    => esc_html__( 'ایمیل', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'default'  => '',
            ),

        ),
	));



	Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'برگه ارتباط با ما', 'mweb' ),
	'id'         => 'mweb_contact_page',
	'fields'     => array(

		array(
			'id'       => 'mweb_contact_map',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'عکس ادرس روی نقشه', 'mweb' ),
			'compiler' => 'true',
			'subtitle' => esc_html__( "آپلود کنید - 465x360", 'mweb' ),
			//'default'  => array( 'url' => get_template_directory_uri() . '/images/logo.png' ),
		),
		array(
			'id'          => 'mweb_pcontact_address',
			'type'        => 'text',
			'title'    => esc_html__( 'آدرس', 'mweb' ),
		),
		array(
			'id'          => 'mweb_pcontact_email',
			'type'        => 'text',
			'title'    => esc_html__( 'ایمیل', 'mweb' ),
		),
		array(
			'id'          => 'mweb_pcontact_tell',
			'type'        => 'text',
			'title'    => esc_html__( 'تلفن', 'mweb' ),
		),
		array(
			'id'          => 'mweb_cform',
			'type'        => 'text',
			'title'    => esc_html__( 'شورتکد فرم ارتباط با ما', 'mweb' ),
		),

	)
	));


    // Advanced

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'پیشرفته', 'mweb' ),
        'id'     => 'mweb_advanced',
        'icon'   => 'fa fa-code',
        'fields' => array(
            array(
                'id'       => 'custom_css',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'کد CSS سفارشی', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'mode'     => 'css',
                'theme'    => 'monokai',
                'default'  => "#header{\n   margin: 0 auto;\n}"
            ),
			array(
                'id'       => 'mweb_custom_file_cssjs',
                'type'     => 'switch',
                'title'    => esc_html__( 'بارگذاری فایل های پیشرفته js و css', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'default'  => false,
            ),
			array(
                'id'       => 'custom_code_header',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'کد های سفارشی سربرگ', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'mode'     => 'html',
                'theme'    => 'monokai',
                'default'  => ""
            ),
			array(
                'id'       => 'custom_code_footer',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'کد های سفارشی پابرگ', 'mweb' ),
                'subtitle' => esc_html__( '', 'mweb' ),
                'mode'     => 'html',
                'theme'    => 'monokai',
                'default'  => ""
            ),
    	)
    ) );






    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $return['error'] = $field;
                $field['msg']    = 'your custom error message';
            }

            if ( $warning == true ) {
                $return['warning'] = $field;
                $field['msg']      = 'your custom warning message';
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {

            $sections[] = array(
                'title'  => esc_html__( 'Section via hook', 'mweb' ),
                'desc'   => esc_html__( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'mweb' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }





