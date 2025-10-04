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
	$cr_address = $order->get_shipping_address_1() . ' ' . $order->get_shipping_address_2();


	if( !isset($canvas) ){
		mweb_get_template( 'invoice/order-template_header.php', array( 'title' => 'چاپ برچسب پستی', 'type' => 'label' ) );
	}
	
	$date_created = date( 'Y n d', strtotime($order->get_date_created()) );
	$date_created = explode( ' ', $date_created );
	
	$invoice_meta = mweb_theme_util::get_theme_option('invoice_meta');
	$meta_labels = [ 'weight' => 'وزن' ];
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
		
	$invoice_style = mweb_theme_util::get_theme_option('invoice_label_style');

	
?>
<div class="container container_label">

<?php if($invoice_style == 'one'): ?>
<div class="order_label_wrap">
	<h5>فرستنده</h5>
	<div class="order_label_details">
		<div class="order_detail_item seller_label_head has_barcode"><strong><?= $invoice_seller ?></strong><span><div class="row va_middle label_order_date"><strong>تاریخ سفارش</strong><span><?= implode('/', gregorian_to_jalali($date_created[0],$date_created[1],$date_created[2])) ?></span></div><i><?= $order_id ?></i><?= do_shortcode('[barcode data="'.$order_id.'" size="25"]') ?></span></div>
		<div class="row va_middle">
			<span class="inc_state"><b>استان</b><?= $store_state ?></span>
			<span class="inc_city"><b>شهر</b><?= $store_city ?></span>
			<span class="inc_postcode"><b>کدپستی</b><?= $store_postcode ?></span>
			<span class="inc_phone"><b>شماره تماس</b><?= $invoice_phone ?></span>
		</div>
		<div class="inc_address"><b>آدرس</b><?= $store_address ?></div>
	</div>
</div>

<div class="order_label_wrap">
	<h5>گیرنده</h5>
	<div class="order_label_details">
		<div class="seller_label_head"><strong><?= $cr_name ?></strong></div>
		<div class="row va_middle">
			<span class="inc_state"><b>استان</b><?= $cr_state ?></span>
			<span class="inc_city"><b>شهر</b><?= $cr_city ?></span>
			<span class="inc_postcode"><b>کدپستی</b><?= $cr_postcode ?></span>
			<span class="inc_phone"><b>شماره تماس</b><?= $cr_phone ?></span>
		</div>
		<div class="inc_address"><b>آدرس</b><?= $cr_address ?></div>
	</div>
</div>
<?php else: ?>
<div class="order_label_two">
	<div class="order_label_sec">
	</div>
	<div class="order_label_sec">
		<div class="order_label_details">
			<div class="order_detail_item seller_label_head has_barcode"><span><div class="row va_middle label_order_date"><strong>تاریخ سفارش</strong><span><?= implode('/', gregorian_to_jalali($date_created[0],$date_created[1],$date_created[2])) ?></span></div><i><?= $order_id ?></i><?= do_shortcode('[barcode data="'.$order_id.'" size="25"]') ?></span></div>
			<h5>فرستنده </h5>
			<strong><?= $invoice_seller ?></strong>
			<div class="row va_middle">
				<span class="inc_state"><b>استان</b><?= $store_state ?></span>
				<span class="inc_city"><b>شهر</b><?= $store_city ?></span>
			</div>
			<div class="row va_middle">
				<span class="inc_postcode"><b>کدپستی</b><?= $store_postcode ?></span>
				<span class="inc_phone"><b>شماره تماس</b><?= $invoice_phone ?></span>
			</div>
			<div class="inc_address"><b>آدرس</b><?= $store_address ?></div>
		</div>
	</div>
	<div class="order_label_sec">
		<h5>گیرنده</h5>
		<div class="order_label_details">
			<div class="seller_label_head"><strong><?= $cr_name ?></strong></div>
			<div class="row va_middle">
				<span class="inc_state"><b>استان</b><?= $cr_state ?></span>
				<span class="inc_city"><b>شهر</b><?= $cr_city ?></span>
			</div>
			<div class="row va_middle">
				<span class="inc_postcode"><b>کدپستی</b><?= $cr_postcode ?></span>
				<span class="inc_phone"><b>شماره تماس</b><?= $cr_phone ?></span>
			</div>
			<div class="inc_address"><b>آدرس</b><?= $cr_address ?></div>
		</div>
	</div>
	<div class="order_label_sec">
	</div>
	
</div>
<?php endif; ?>


</div>


<?php
if( !isset($canvas) ){
    mweb_get_template( 'invoice/order-template_footer.php', array( 'type' => 'label' ));
}