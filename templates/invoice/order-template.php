<?php
defined( 'ABSPATH' ) || exit;

$order = wc_get_order( $order_id );

if( !$order ) {
	wp_die( __( 'سفارش نامعتبر !', 'mweb' ) );
}

if( get_current_user_id() != $order->get_user_id() && !is_admin() ){
	wp_die( __( 'خطای دسترسی !', 'mweb' ) );
}

	// Get the order ID
	$order_id = $order->get_id();

	// Get the order items
	$items = $order->get_items();
	//print_r($order);

	$invoice_phone = mweb_theme_util::get_theme_option('invoice_phone');
	$invoice_seller = mweb_theme_util::get_theme_option('invoice_seller');

	$store_address     = WC()->countries->get_base_address();
	$store_address_2   = WC()->countries->get_base_address_2();
	$store_state       = WC()->countries->states[WC()->countries->get_base_country()][WC()->countries->get_base_state()];
	$store_city        = WC()->countries->get_base_city();
	$store_postcode    = WC()->countries->get_base_postcode();
	
	
	$cr_name = $order->get_formatted_shipping_full_name();
	//$cr_state = $order->get_shipping_state();
	$cr_state = WC()->countries->states[$order->get_shipping_country()][$order->get_shipping_state()];
	$cr_city = $order->get_shipping_city();
	$cr_postcode = $order->get_shipping_postcode();
	$cr_phone = $order->get_billing_phone();
	//$cr_phone = get_user_meta( $order->get_user_id(), 'user_meta_mobile', true );
	$cr_address = $order->get_shipping_address_1() . ' ' . $order->get_shipping_address_2();


	if( !isset($canvas) ){
		 mweb_get_template( 'invoice/order-template_header.php', array( 'title' => 'چاپ فاکتور', 'type' => 'order' ) );
	}
   
	$date_created = date( 'Y n d', strtotime($order->get_date_created()) );
	$date_created = explode( ' ', $date_created );
	
	$invoice_meta = mweb_theme_util::get_theme_option('invoice_meta');
	
	$meta_labels = get_invoice_meta_list();
	
	
	$invoice_order_meta = mweb_theme_util::get_theme_option('invoice_order_meta');
	if( !empty($invoice_order_meta) && is_array($invoice_order_meta) ){
		$pairs = array_map(function($item) {
			list($label, $slug) = explode('|', $item);
			return ['slug' => $slug, 'label' => $label];
		}, $invoice_order_meta);

		$custom_order_meta = array_column($pairs, 'label', 'slug');
		$meta_labels = array_merge($meta_labels, $custom_order_meta);
		
		$slugs = array_column($pairs, 'slug');
		$invoice_meta = array_merge($invoice_meta, $slugs);
		
	}
	

	$custom_product_meta = [];
	$invoice_product_meta = mweb_theme_util::get_theme_option('invoice_product_meta');
	if( !empty($invoice_product_meta) && is_array($invoice_product_meta) ){
		$pairs = array_map(function($item) {
			list($label, $slug) = explode('|', $item);
			return ['slug' => $slug, 'label' => $label];
		}, $invoice_product_meta);

		$custom_product_meta = array_column($pairs, 'label', 'slug');
	}
	
	
	$count_meta = empty($invoice_meta) ? 0 : count($invoice_meta);



	$_states  = [
			'ABZ' => 'البرز',
			'ADL' => 'اردبیل',
			'EAZ' => 'آذربایجان شرقی',
			'WAZ' => 'آذربایجان غربی',
			'BHR' => 'بوشهر',
			'CHB' => 'چهارمحال و بختیاری',
			'FRS' => 'فارس',
			'GIL' => 'گیلان',
			'GLS' => 'گلستان',
			'HDN' => 'همدان',
			'HRZ' => 'هرمزگان',
			'ILM' => 'ایلام',
			'ESF' => 'اصفهان',
			'KRN' => 'کرمان',
			'KRH' => 'کرمانشاه',
			'NKH' => 'خراسان شمالی',
			'RKH' => 'خراسان رضوی',
			'SKH' => 'خراسان جنوبی',
			'KHZ' => 'خوزستان',
			'KBD' => 'کهگیلویه و بویراحمد',
			'KRD' => 'کردستان',
			'LRS' => 'لرستان',
			'MKZ' => 'مرکزی',
			'MZN' => 'مازندران',
			'GZN' => 'قزوین',
			'QHM' => 'قم',
			'SMN' => 'سمنان',
			'SBN' => 'سیستان و بلوچستان',
			'THR' => 'تهران',
			'YZD' => 'یزد',
			'ZJN' => 'زنجان',
		];

	if( empty($store_state) )
		$store_state = isset($_states[WC()->countries->get_base_state()]) ? $_states[WC()->countries->get_base_state()] : WC()->countries->get_base_state();

	if( empty($cr_state) )
		$cr_state = isset($_states[$order->get_shipping_state()]) ? $_states[$order->get_shipping_state()] : $order->get_shipping_state();
	
	
	
	$available_meta = array();
	$available_meta_p = array();
	$items = $order->get_items();
	foreach( $items as $item ) {
		$product = $item->get_product();
		
		if( !empty($custom_product_meta) ){
			foreach( $custom_product_meta as $key => $metap ){
				if( get_post_meta( $product->get_id(), $key, true ) ){
					$available_meta_p[] = $key;
				}
			}
		}
		
		if( !empty($invoice_meta) ){
			foreach( $invoice_meta as $meta ){
				switch( $meta ){
					case 'weight' : 
						$product_weight = is_object( $product ) ? $product->get_weight() : '';
						if( !empty($product_weight) ){
							if( !in_array($meta, $available_meta) ){
								$available_meta[] = $meta;
							}
						}
					break;
					default:
						$meta_c = $item->get_meta( $meta, true );
						if( !empty($meta_c) ){
							if( !in_array($meta, $available_meta) ){
								$available_meta[] = $meta;
							}
						}
				}
			}
		}
	}
		
	$count_meta = count($available_meta) + count($available_meta_p);
	
?>
<div class="container container_order">

<header>
	<div class="hd_order_detail">
		<div class="hd_right">
			<?php if( mweb_theme_util::get_theme_option('invoice_logo') == true ){ 
			$logo = mweb_theme_util::get_theme_option('invoice_logo_src', 'url');
			?>
				<?php if ( $logo != ''): ?>
					<img class="invoice_logo" src="<?php echo esc_url( $logo ); ?>">
				<?php else : ?>
						<img class="invoice_logo" src="<?= THEME_ASSET.'/images/logo.png' ?>" />
				<?php endif; ?>
			<?php } ?>
		</div>
		<div class="hd_left">
			<div class="order_detail_item has_barcode"><strong>شناسه فاکتور : </strong><span><i><?= $order_id ?></i><?= do_shortcode('[barcode data="'.$order_id.'" size="25"]') ?></span></div>
			<div class="order_detail_item"><strong>تاریخ سفارش : </strong><span><?= implode('/', gregorian_to_jalali($date_created[0], $date_created[1], $date_created[2])) ?></span></div>
		</div>
	</div>
</header>


<table class="order_info">
	<thead>
		<tr>
			<th>فروشنده</th>
			<th>خریدار</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<span class="inc_name"><b>فروشنده</b><?= $invoice_seller ?></span>
				<span class="inc_state"><b>استان</b><?= $store_state ?></span>
				<span class="inc_city"><b>شهر</b><?= $store_city ?></span>
				<span class="inc_postcode"><b>کدپستی</b><?= $store_postcode ?></span>
				<span class="inc_phone"><b>شماره تماس</b><?= $invoice_phone ?></span>
				<span class="inc_address"><b>آدرس</b><?= $store_address ?></span>
			</td>
			<td>
				<span class="inc_name"><b>خریدار</b><?= $cr_name ?></span>
				<span class="inc_state"><b>استان</b><?= $cr_state ?></span>
				<span class="inc_city"><b>شهر</b><?= $cr_city ?></span>
				<span class="inc_postcode"><b>کدپستی</b><?= $cr_postcode ?></span>
				<span class="inc_phone"><b>شماره تماس</b><?= $cr_phone ?></span>
				<span class="inc_address"><b>آدرس</b><?= $cr_address ?></span>
			</td>
		</tr>
	</tbody>
</table>

<table class="order_details">
	<thead>
		<tr>
			<th class="num">ردیف</th>
			<th class="sku">شناسه</th>
			<th class="product">محصول</th>
			<th class="quantity">تعداد</th>
			<?php 
				if( !empty($invoice_meta) ){
					foreach( $invoice_meta as $meta ){
						if( !in_array($meta, $available_meta) ){
							continue;
						}
						$meta_label = isset($meta_labels[$meta]) ? $meta_labels[$meta] : '';
						printf( '<th class="%s">%s</th>', $meta, $meta_label );
					}
				}
				
				if( !empty($available_meta_p) ){
					foreach( $available_meta_p as $metap ){
						printf( '<th class="%s">%s</th>', $metap, $custom_product_meta[$metap] );
					}
				}
			?>
			<th class="item_price">مبلغ واحد</th>
			<th class="total_price">مبلغ کل</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$items = $order->get_items();
		$counter_item = 1;
		foreach( $items as $item ) {
			

			$product_qty   = $item->get_quantity();
			$product_price = $item->get_total() / $product_qty;
			$product_total = $item->get_total();
			
			$product       = $item->get_product();
			$product_sku   = is_object( $product ) ? $product->get_sku() : '';
			
			
			$product_name  = $item->get_name();
			
			$is_visible = $product && $product->is_visible();

			$product_name = wp_kses_post( apply_filters( 'woocommerce_order_item_name', $item->get_name(), $item, $is_visible ) );


		?>
		<tr>
			<td><?= $counter_item++; ?></td>
			<td><?= $product_sku; ?></td>
			<td><?= $product_name; ?><?php wc_display_item_meta( $item ); ?></td>
			<td><?= $product_qty; ?></td>
			<?php 
				if( !empty($invoice_meta) ){
					foreach( $invoice_meta as $meta ){
						if( !in_array($meta, $available_meta) ){
							continue;
						}
						switch( $meta ){
							case 'weight' : 
								$product_weight = is_object( $product ) ? $product->get_weight() : '';
								echo '<td>';
								if( !empty($product_weight) )
									printf('%s × %s %s', $product_weight, $product_qty, get_option('woocommerce_weight_unit'));
								echo '</td>';
							break;
							case '_item_jewel_carat':
								$meta_c = $item->get_meta( $meta, true );
								echo '<td>';
								if( !empty($meta_c) )
									echo $meta_c;
								echo '</td>';
							break;
							default:
								$meta_c = $item->get_meta( $meta, true );
								echo '<td>';
								if( !empty($meta_c) )
									printf('%s %s', number_format($meta_c), get_woocommerce_currency_symbol());
								echo '</td>';
							
						}
					}
				}
				
				if( !empty($available_meta_p) ){
					foreach( $available_meta_p as $metap ){
						printf( '<td>%s</td>', get_post_meta( $product->get_id(), $metap, true ) );
					}
				}
			?>
			<td><?= wc_price( $product_price ); ?></td>
			<td><?= wc_price( $product_total ); ?></td>
		</tr>
		<?php } ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="<?= $count_meta + 5 ?>"><b>مبلغ کل :</b></td>
			<td><?= wc_price( $order->get_subtotal() ); ?></td>
		</tr>
		<?php if(!empty($order->get_total_discount())) { ?>
		<tr>
			<td colspan="<?= $count_meta + 5 ?>"><b>تخفیف :</b></td>
			<td><?= wc_price( $order->get_total_discount() ); ?></td>
		</tr>
		<?php } ?>
		<?php if($order->get_total_tax()) { ?>
			<tr>
				<td colspan="<?= $count_meta + 5 ?>"><b>مالیات :</b> <small></small></td>
				<td><?= wc_price( $order->get_total_tax() ); ?></td>
			</tr>
		<?php } ?>
		<tr>
			<td colspan="<?= $count_meta + 5 ?>"><b>حمل و نقل :</b> <small><?= $order->get_shipping_to_display(); ?></small></td>
			<td><?= wc_price( $order->get_shipping_total() ); ?></td>
		</tr>
		<tr>
			<td colspan="<?= $count_meta + 5 ?>"><b>مبلغ نهایی :</b> <small><?= $order->get_payment_method_title() ?></small></td>
			<td><?= wc_price( $order->get_total() ); ?></td>
		</tr>
	</tfoot>
</table>


<footer>
<?php if( !empty($order->get_customer_note()) ) { ?>
	<div class="order_note">
		<div class="order_note_title"><h5>یاداشت خریدار</h5></div>
		<div class="order_note_text"><?= $order->get_customer_note(); ?></div>
	</div>
<?php } ?>
</footer>

<?php $signature = mweb_theme_util::get_theme_option('invoice_signature_src', 'url');?>
<?php if ( $signature != ''): ?>
	<div class="signature"><img class="signature_logo" src="<?php echo esc_url( $signature ); ?>">مهر و امضای فروشنده</div>
<?php endif; ?>


</div>

<?php

if( !isset($canvas) ){
	mweb_get_template( 'invoice/order-template_footer.php', array( 'type' => 'order' ));
}
