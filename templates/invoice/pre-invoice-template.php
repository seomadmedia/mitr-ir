<?php
defined( 'ABSPATH' ) || exit;


if ( WC()->cart->get_cart_contents_count() == 0 ) {
    wp_die('<p>سبد خرید شما خالی است.</p>');
} 

$invoice_phone = mweb_theme_util::get_theme_option('invoice_phone');
$invoice_seller = mweb_theme_util::get_theme_option('invoice_seller');

$store_address     = WC()->countries->get_base_address();
$store_address_2   = WC()->countries->get_base_address_2();
$store_state       = WC()->countries->states[WC()->countries->get_base_country()][WC()->countries->get_base_state()];
$store_city        = WC()->countries->get_base_city();
$store_postcode    = WC()->countries->get_base_postcode();
	
mweb_get_template( 'invoice/order-template_header.php', array( 'title' => get_the_title() ) );

$date_current = date( 'Y n d' );
$date_current = explode( ' ', $date_current );
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
			<div class="order_detail_item"><strong>پیـش فاکــتور</strong></div>
			<div class="order_detail_item"><strong>تاریـخ : </strong><span><?= implode('/', gregorian_to_jalali($date_current[0], $date_current[1], $date_current[2])) ?></span></div>
		</div>
	</div>
</header>


<table class="order_info">
	<thead>
		<tr>
			<th><?= $invoice_seller ?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<span class="inc_state"><b>استان</b><?= $store_state ?></span>
				<span class="inc_city"><b>شهر</b><?= $store_city ?></span>
				<span class="inc_postcode"><b>کدپستی</b><?= $store_postcode ?></span>
				<span class="inc_phone"><b>شماره تماس</b><?= $invoice_phone ?></span>
				<span class="inc_address"><b>آدرس</b><?= $store_address ?></span>
			</td>
		</tr>
	</tbody>
</table>


<?php

echo '<table class="order_details" border="1" cellspacing="0" cellpadding="5">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>ردیف</th>';
    echo '<th>شناسه</th>';
    echo '<th>محصول</th>';
    echo '<th>تعداد</th>';
    echo '<th>مبلغ واحد	</th>';
    echo '<th>تخفیف</th>';
    echo '<th>مبلغ کل</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    $items = WC()->cart->get_cart();
    $index = 1;
	
    foreach ($items as $item) {
        $product = $item['data'];
        $product_id = $product->get_id();
        $product_name = $product->get_name();
        $quantity = $item['quantity'];
        $price = wc_price($product->get_price());
        $discount = $item['line_subtotal'] - $item['line_total'] != 0 ? wc_price($item['line_subtotal'] - $item['line_total']) : '-';
        $total = wc_price($item['line_total']);

        echo '<tr>';
        echo '<td>' . $index . '</td>';
        echo '<td>' . $product_id . '</td>';
        echo '<td>' . $product_name . '</td>';
        echo '<td>' . $quantity . '</td>';
        echo '<td>' . $price . '</td>';
        echo '<td>' . $discount . '</td>';
        echo '<td>' . $total . '</td>';
        echo '</tr>';

        $index++;
    }

    echo '</tbody>';
    echo '<tfoot>';

    // تخفیف کل
    echo '<tr>';
    echo '<td colspan="6" style="text-align:right">تخفیف :</td>';
    echo '<td>' . wc_price(WC()->cart->get_discount_total()) . '</td>';
    echo '</tr>';

    // مالیات
    echo '<tr>';
    echo '<td colspan="6" style="text-align:right">مالیات :</td>';
    echo '<td>' . wc_price(WC()->cart->get_taxes_total()) . '</td>';
    echo '</tr>';

    // جمع کل
    echo '<tr>';
    echo '<td colspan="6" style="text-align:right"><strong>جمع کل :</strong></td>';
    echo '<td><strong>' . wc_price(WC()->cart->get_total('edit')) . '</strong></td>';
    echo '</tr>';

    echo '</tfoot>';
    echo '</table>';




?>


<footer>

</footer>



</div>

<?php

mweb_get_template( 'invoice/order-template_footer.php', array( 'type' => 'order' ));

