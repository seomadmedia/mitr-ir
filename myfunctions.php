<?php
/**
                  _         _ _                  _     
                 | |       | (_)                | |    
  _ __ ___   __ _| |__   __| |_ _____      _____| |__  
 | '_ ` _ \ / _` | '_ \ / _` | / __\ \ /\ / / _ \ '_ \ 
 | | | | | | (_| | | | | (_| | \__ \\ V  V /  __/ |_) |
 |_| |_| |_|\__,_|_| |_|\__,_|_|___/ \_/\_/ \___|_.__/ 


*/


// insert the your code here

// disable gutenberg WP +5
add_filter('use_block_editor_for_post', '__return_false', 10);
add_filter('use_widgets_block_editor', '__return_false');
// disable responsive images srcset in WP 4.4
function meks_disable_srcset( $sources ) {
    return true;
}
//add_filter( 'wp_calculate_image_srcset', 'meks_disable_srcset' );




// Remove Price Range

	 
//remove_action( 'woocommerce_edit_account_form', 'mweb_add_billing_phone_to_edit_account_form' );
//remove_action( 'woocommerce_save_account_details_errors','mweb_billing_phone_field_validation', 20, 1 );


/**-------------------------------------------------------------------------------------------------------------------------
 * limit search by title only
 */
add_filter( 'posts_search', 'mweb_search_by_title_only', 500, 2 );
function mweb_search_by_title_only( $search, $wp_query ){
    global $wpdb;
    if(empty($search)) {
        return $search; // skip processing - no search term in query
    }
    $q = $wp_query->query_vars;
    $n = !empty($q['exact']) ? '' : '%';
    $search =
    $searchand = '';
    foreach ((array)$q['search_terms'] as $term) {
        $term = esc_sql($wpdb->esc_like($term));
        $search .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
        $searchand = ' AND ';
    }
    if (!empty($search)) {
        $search = " AND ({$search}) ";
        if (!is_user_logged_in())
            $search .= " AND ($wpdb->posts.post_password = '') ";
    }
    return $search;
}

add_action('after_short_description', 'add_content_after_short_description');

remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
add_action('woocommerce_shop_loop_item_title', 'mweb_insert_link_loop_product_title', 10);
function mweb_insert_link_loop_product_title(){
	echo '<h2 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '"><a href="' . get_permalink() . '" rel="bookmark" title="' . esc_attr( strip_tags( get_the_title() ) ) . '">' . get_the_title() . '</a></h2>';
}



// Remove Price Range
add_filter( 'woocommerce_variable_sale_price_html', 'mweb_remove_price_of_outofstock_product', 10, 2 );
add_filter( 'woocommerce_variable_price_html', 'mweb_remove_price_of_outofstock_product', 10, 2 );
add_filter( 'woocommerce_get_price_html', 'mweb_remove_price_of_outofstock_product', 10, 2 );

function mweb_remove_price_of_outofstock_product( $price, $product ) {
	if( !mweb_get_product_stock($product) && !is_product() )
		$price = '<p class="null_price"></p>';
	
	return $price;
}


function ace_ajax_add_to_cart_handler() {
	//WC_Form_Handler::add_to_cart_action();
	WC_AJAX::get_refreshed_fragments();
}
add_action( 'wc_ajax_mweb_add_to_cart', 'ace_ajax_add_to_cart_handler' );
add_action( 'wc_ajax_nopriv_mweb_add_to_cart', 'ace_ajax_add_to_cart_handler' );




function ace_ajax_add_to_cart_add_fragments( $fragments ) {
	$all_notices  = WC()->session->get( 'wc_notices', array() );
	$notice_types = apply_filters( 'woocommerce_notice_types', array( 'error', 'success', 'notice' ) );

	ob_start();
	foreach ( $notice_types as $notice_type ) {
		if ( wc_notice_count( $notice_type ) > 0 ) {
			wc_get_template( "notices/{$notice_type}.php", array(
				'notices' => array_filter( $all_notices[ $notice_type ] ),
			) );
		}
	}
	$fragments['notices_html'] = ob_get_clean();

	wc_clear_notices();

	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'ace_ajax_add_to_cart_add_fragments' );



add_filter( 'woocommerce_variable_sale_price_html', 'mweb_get_min_variation_price_format', 10, 2 );
add_filter( 'woocommerce_variable_price_html', 'mweb_get_min_variation_price_format', 10, 2 );

function mweb_get_min_variation_price_format( $price, $product ) {
	
	$prices = $product->get_variation_prices();
	$first_key = array_key_first( $prices['price'] );
	$sale_price = current( $prices['price'] );
	$regular_price = $prices['regular_price'][$first_key];
		
	$variation_ids = array_keys($prices['price']);
	if( count($prices) > 1 )
		foreach( $variation_ids as $variation_id ){
			$variation = wc_get_product( $variation_id );
			if( $variation->is_in_stock() ){
				$sale_price = $prices['price'][$variation_id];
				$regular_price = $prices['regular_price'][$variation_id];
				break;
			}
			
		}
	
	if ( $sale_price != $regular_price ) {
        $price = wc_format_sale_price( $regular_price, $sale_price );
    } else {
        $price = wc_price( $sale_price );
    }
 
    return $price;
	
}



/* function prefix_defer_js( $html ) {
    if ( ! is_admin() ) {
        $html = str_replace( '></script>', ' defer></script>', $html );
    }
    return $html;
}
add_filter( 'script_loader_tag', 'prefix_defer_js' ); */


add_filter( 'woocommerce_cross_sells_total', function( $limit ) {
    return 5; 
} );

add_action('woocommerce_after_add_to_cart_button', function() {
    if (function_exists('snapppay_product_page_widget_price')) {
        echo '<div class="snapppay-widget-wrap" style="margin-top:15px; display:block;">';
        snapppay_product_page_widget_price();
        echo '</div>';
    }
}, 31);

// Madmedia Sec
// برای نادیده گرفتن خطاهای Elemen// add attr
function custom_product_attributes_once_in_short_description($short_description) {
    global $product;

    if (!$product) return $short_description;

    if (!is_product()) return $short_description;

    if (did_action('woocommerce_single_product_summary') > 1) return $short_description;

    $attributes = $product->get_attributes();

    $counter = 0;
    $output = '<ul>';

    foreach ($attributes as $attribute) {
        if ($counter >= 7) break;

        $name = wc_attribute_label($attribute->get_name());
        
        if ($attribute->is_taxonomy()) {
            $terms = wc_get_product_terms($product->get_id(), $attribute->get_name(), ['fields' => 'names']);
            $value = implode(', ', $terms); 
        } else {
            $value = implode(', ', $attribute->get_options()); 
        }

        // اضافه کردن span برای name و value
        $output .= '<li><span class="attribute-name">' . esc_html($name) . '</span>: <span class="attribute-value">' . esc_html($value) . '</span></li>';
        $counter++;
    }

    $output .= '</ul>';

    return $short_description . $output;
}
add_filter('woocommerce_short_description', 'custom_product_attributes_once_in_short_description');



// discount price %
function custom_global_woocommerce_discount_display($price, $product) {
    if ($product->is_on_sale() && $product->get_regular_price()) {
        $regular_price = $product->get_regular_price();
        $sale_price = $product->get_sale_price();
        $discount_percentage = round((($regular_price - $sale_price) / $regular_price) * 100);

        $discount_span = '<span class="discount-archive-price">' . $discount_percentage . '%</span>';

        $price = '<del>' . wc_price($regular_price) . ' ' . $discount_span . '</del> <ins>' . wc_price($sale_price) . '</ins>';
    }
    return $price;
}
add_filter('woocommerce_get_price_html', 'custom_global_woocommerce_discount_display', 10, 2);


//sidebar
function custom_shop_widget() {
    register_sidebar( array(
        'name'          => esc_html__( 'سایدبار فروشگاهها', 'text_domain' ),
        'id'            => 'custom_shop_widget',
        'description'   => esc_html__( 'برای سایدبار فروشگاه استفاده شود', 'text_domain' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
		'before_title'  => '<div class="widget_title widget-title with-dropdown">',
        'after_title'   => '</div>',
    ) );
}
add_action( 'widgets_init', 'custom_shop_widget' );


//add short name product meta tag
function add_short_title_meta_tag() {
    if (is_product()) { 
        global $post;
        $title = mb_substr($post->post_title, 0, 35); 
        echo '<meta name="short-title" content="' . esc_attr($title) . '">' . "\n";
    }
}
add_action('wp_head', 'add_short_title_meta_tag');

//close sucsess
add_filter('wp_logout_url', 'custom_logout_url', 10, 1);
function custom_logout_url($logout_url) {
    $redirect_to = home_url();
    return add_query_arg('redirect_to', urlencode($redirect_to), $logout_url);
}

//remove mail in checkout
function custom_override_checkout_fields($fields) {
    if (isset($fields['billing']['billing_email'])) {
        $fields['billing']['billing_email']['required'] = false;
    }

    return $fields;
}
add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields');

// add name to order
// legacy – for CPT-based orders
add_filter( 'manage_edit-shop_order_columns', 'misha_order_items_column' );
// for HPOS-based orders
add_filter( 'manage_woocommerce_page_wc-orders_columns', 'misha_order_items_column' );

function misha_order_items_column( $columns ) {

	// let's add our column before "Total"
	$columns = array_slice( $columns, 0, 3, true ) // 4 columns before
	+ array( 'order_products' => 'نام محصول' ) // our column is going to be 5th
	+ array_slice( $columns, 3, NULL, true );

	return $columns;

}

// legacy – for CPT-based orders
add_action( 'manage_shop_order_posts_custom_column', 'misha_populate_order_items_column', 25, 2 );
// for HPOS-based orders
add_action( 'manage_woocommerce_page_wc-orders_custom_column', 'misha_populate_order_items_column', 25, 2 );
function misha_populate_order_items_column( $column_name, $order_or_order_id ) {

	// legacy CPT-based order compatibility
	$order = $order_or_order_id instanceof WC_Order ? $order_or_order_id : wc_get_order( $order_or_order_id );

	if( 'order_products' === $column_name ) {

		$items = $order->get_items();
		if( ! is_wp_error( $items ) ) {
			foreach( $items as $item ) {
 				echo $item[ 'quantity' ] .' × <a href="' . get_edit_post_link( $item[ 'product_id' ] ) . '">'. $item[ 'name' ] .'</a><br />';
				// you can also use $order_item->variation_id parameter
				// by the way, $item[ 'name' ] will display variation name too
			}
		}

	}

}

//noindex 
function add_noindex_nofollow_meta() {
    if (!is_admin() && !is_user_logged_in() && strpos($_SERVER['REQUEST_URI'], '?') !== false && !isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
        echo '<meta name="robots" content="noindex, nofollow">';
    }
}
add_action('wp_head', 'add_noindex_nofollow_meta', 1);



//yes or no attribuite
add_filter('woocommerce_display_product_attributes', 'mweb_custom_display_product_attributes', 10, 2);

function mweb_custom_display_product_attributes($product_attributes, $product) {
    foreach ($product_attributes as &$attribute) {
        // ابتدا "ندارد" بررسی شود تا از جایگزینی اشتباه جلوگیری شود
        if (strpos($attribute['value'], 'ندارد') !== false) {
            $attribute['value'] = str_replace(
                'ندارد',
                '<span style="color: red; font-size: 1.2em;">&#10008;</span>',
                $attribute['value']
            );
        }
        if (strpos($attribute['value'], 'دارد') !== false) {
            $attribute['value'] = str_replace(
                'دارد',
                '<span style="color: green; font-size: 1.2em;">&#10004;</span>',
                $attribute['value']
            );
        }
        if (strpos($attribute['value'], 'بله') !== false) {
            $attribute['value'] = str_replace(
                'بله',
                '<span style="color: green; font-size: 1.2em;">&#10004;</span>',
                $attribute['value']
            );
        }
        if (strpos($attribute['value'], 'خیر') !== false) {
            $attribute['value'] = str_replace(
                'خیر',
                '<span style="color: red; font-size: 1.2em;">&#10008;</span>',
                $attribute['value']
            );
        }
    }

    return $product_attributes;
}



// دیدن مدیر فروشگاه در محصولات
add_filter('manage_edit-product_columns', 'add_product_author_column');
function add_product_author_column($columns) {
    $columns['author'] = 'نویسنده';
    return $columns;
}

add_action('manage_product_posts_custom_column', 'show_product_author_column', 10, 2);
function show_product_author_column($column, $post_id) {
    if ($column === 'author') {
        $author_id = get_post_field('post_author', $post_id);
        $author = get_userdata($author_id);
        echo esc_html($author->display_name);
    }
}
// فیلتر نویسنده در صفحه محصولات
add_action('restrict_manage_posts', 'filter_products_by_shop_manager');
function filter_products_by_shop_manager() {
    global $typenow;

    if ($typenow == 'product') {
        $selected = isset($_GET['author']) ? (int) $_GET['author'] : 0;

        // فقط کاربران با نقش 'shop_manager'
        $shop_managers = get_users([
            'role'    => 'shop_manager',
            'orderby' => 'display_name',
        ]);

        echo '<select name="author" class="postform">';
        echo '<option value="">همه مدیران فروشگاه</option>';
        foreach ($shop_managers as $user) {
            printf(
                '<option value="%d"%s>%s</option>',
                $user->ID,
                $selected === $user->ID ? ' selected="selected"' : '',
                esc_html($user->display_name)
            );
        }
        echo '</select>';
    }
}



add_filter('rank_math/snippet/rich_snippet_product_entity', function($entity) {
    if (!empty($entity['offers']) && is_array($entity['offers'])) {
        if (isset($entity['offers']['priceCurrency']) && $entity['offers']['priceCurrency'] === 'IRT') {
            $entity['offers']['priceCurrency'] = 'IRR';
        }
    }
    return $entity;
}, 100);

add_filter( 'woocommerce_checkout_fields', 'custom_billing_phone_label_high_priority', 9999 );
function custom_billing_phone_label_high_priority( $fields ) {
    if ( isset( $fields['billing']['billing_phone'] ) ) {
        $fields['billing']['billing_phone']['label'] = 'تلفن همراه (حتماً شماره‌ای که پاسخگو باشید)';
    }
    return $fields;
}


//add rating product non rate
add_filter( 'rank_math/snippet/rich_snippet_product_entity', function( $entity ) {
	if ( is_singular( 'product' ) ) {

		// بررسی وجود امتیاز واقعی (aggregateRating)
		$has_rating = isset( $entity['aggregateRating'] ) && !empty( $entity['aggregateRating']['ratingValue'] );

		// اگر امتیاز وجود نداشت، امتیاز پیش‌فرض اضافه کن
		if ( ! $has_rating ) {
			$entity['aggregateRating'] = [
				"@type" => "AggregateRating",
				"ratingValue" => "4.5",  // امتیاز پیش‌فرض
				"reviewCount" => "1"     // تعداد نقد پیش‌فرض (می‌تونی صفر یا یک بذاری)
			];

			// همچنین می‌تونی یک review نمونه هم اضافه کنی
			$entity['review'] = [
				"@type" => "Review",
				"reviewRating" => [
					"@type" => "Rating",
					"ratingValue" => "4.5",
					"bestRating" => "5"
				],
				"author" => [
					"@type" => "Person",
					"name" => "امتیاز پیش‌فرض"
				],
				"reviewBody" => "این محصول امتیاز پیش‌فرض دارد."
			];
		}
	}

	return $entity;
}, 99 );

// Edit curency code 
add_filter( 'rank_math/json_ld', function( $data ) {

    if ( is_product_category() || is_product_tag() || is_shop() ) {
        foreach ( $data as &$graph_item ) {
            if ( isset( $graph_item['@type'] ) && $graph_item['@type'] === 'ItemList' && ! empty( $graph_item['itemListElement'] ) ) {
                foreach ( $graph_item['itemListElement'] as &$list_item ) {
                    if ( isset( $list_item['@type'] ) && $list_item['@type'] === 'ListItem' && isset( $list_item['item']['@type'] ) && $list_item['item']['@type'] === 'Product' ) {
                        if ( isset( $list_item['item']['offers']['priceCurrency'] ) ) {
                            $list_item['item']['offers']['priceCurrency'] = 'IRR';
                        }
                    }
                }
            }
        }
    }

    return $data;

}, 20 );


//disable cache out of stock
add_action( 'template_redirect', 'disable_litespeed_cache_for_out_of_stock_products' );
function disable_litespeed_cache_for_out_of_stock_products() {
    if ( is_singular( 'product' ) ) {
        global $post;
        $product = wc_get_product( $post->ID );

        if ( $product && ! $product->is_in_stock() ) {

            if ( defined('LSCWP_V') ) {
                do_action( 'litespeed_control_set_nocache' );
            }

            header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            header("Pragma: no-cache");

            header("Expires: 0");
        }
    }
}


//remove hook rankmath
add_action('plugins_loaded', function() {
    if ( class_exists('\RankMath\Admin\Notifications\Notification_Center') ) {
        $notification_center = \RankMath\Admin\Notifications\Notification_Center::get();

        // با اولویت بسیار بالا غیرفعال کردن متد update_storage روی shutdown
        remove_action('shutdown', [$notification_center, 'update_storage'], 10);

        // جایگزین کردن هوک با یک فانکشن خالی تا هر فراخوانی بعدی نادیده گرفته شود
        add_action('shutdown', function() {
            // عمداً خالی
        }, 10);
    }

    add_filter('rank_math/notifications/register', '__return_empty_array', 99);
    add_filter('rank_math/notifications/get', '__return_empty_array', 99);
    add_filter('rank_math/notifications/should_display', '__return_false', 99);
}, 5);  // اجرای این زودتر از حد معمول


// change tab product
add_filter( 'woocommerce_product_tabs', 'reordered_tabs', 98 );
function reordered_tabs( $tabs ) {
    global $post;

    // اگر توضیحات خالی بود، تب توضیحات را حذف کن
    if ( ! $post->post_content || trim( $post->post_content ) === '' ) {
        unset( $tabs['description'] );
    } else {
        $tabs['description']['priority'] = 15; 
    }

    // اولویت تب‌ها
    $tabs['additional_information']['priority'] = 10; 
    $tabs['reviews']['priority'] = 20;

    return $tabs;
}

// تغییر طول عمر نانس به 24 ساعت
add_filter( 'nonce_life', function( $lifespan ) {
    return DAY_IN_SECONDS; // 24 ساعت
});
// custom orderby
add_action('pre_get_posts', 'hwp_woocommerce_sort_products_by_stock_price', 9999);
function hwp_woocommerce_sort_products_by_stock_price($query) {
	if (!is_admin() && $query->is_main_query() && (is_shop() || is_product_category() || is_product_tag()) && !isset($_GET['orderby'])) {
		add_filter('posts_clauses', 'hwp_sort_products_stock_price_clause', 9999, 2);
	}
}
function hwp_sort_products_stock_price_clause($clauses, $query) {
	global $wpdb;

	$clauses['orderby'] = "
		CASE
			-- اولویت با محصولاتی که موجود هستند
			WHEN (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = '_stock_status' LIMIT 1) = 'instock' THEN 0
			ELSE 1
		END ASC,

		CASE
			-- محصولاتی که قیمت دارند اولویت دارند
			WHEN (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = '_price' LIMIT 1) IS NULL THEN 1
			WHEN (SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = '_price' LIMIT 1) = '' THEN 1
			ELSE 0
		END ASC,

		-- سپس بر اساس قیمت صعودی
		CAST((SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = {$wpdb->posts}.ID AND meta_key = '_price' LIMIT 1) AS UNSIGNED) ASC
	";

	return $clauses;
}

/*
delete_site_transient('update_plugins');
*/
