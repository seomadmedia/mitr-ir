<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<p><?php
	/* translators: 1: user display name 2: logout url */
	printf(
		__( 'Hello %1$s (not %1$s? <a href="%2$s">Log out</a>)', 'woocommerce' ),
		'<strong>' . esc_html( $current_user->display_name ) . '</strong>',
		esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) )
	);
	

	
?></p>
<div class="MyAccount-dashboard-date">امروز : <span><?php  if ( function_exists( 'jdate' ) ) { echo jdate('l jS F Y'); } else { echo date('l jS F Y'); } ?></span></div>
<div class="MyAccount-dashboard-table">
<table>
	<tbody>
		<tr>
			<td><span class="title">نام :</span> <span class="value"><?php echo get_user_meta( $current_user->ID, 'billing_first_name', true ); ?></span></td>
			<td><span class="title">نام خانوادگی :</span> <span class="value"><?php echo get_user_meta( $current_user->ID, 'billing_last_name', true ); ?></span></td>
			<td><span class="title">ایمیل :</span> <span class="value"><?php echo get_user_meta( $current_user->ID, 'billing_email', true ); ?></span></td>
			<td><span class="title">شركت :</span> <span class="value"><?php echo get_user_meta( $current_user->ID, 'billing_company', true ); ?></span></td>
		</tr>
		<tr>
			<td><span class="title">عضویت :</span> <span class="value ltr"><?php echo esc_html( jdate('d F Y', strtotime($current_user->user_registered)) ); ?></span></td>
			<td><span class="title">شماره تماس :</span> <span class="value ltr"><?php echo get_user_meta( $current_user->ID, 'billing_phone', true ); ?></span></td>
			<td><span class="title">شهر :</span> <span class="value"><?php echo get_user_meta( $current_user->ID, 'billing_city', true ); ?></span></td>
			<td><span class="title">کدپستی :</span> <span class="value"><?php echo get_user_meta( $current_user->ID, 'billing_postcode', true ); ?></span></td>
		</tr>
		<tr>
			<td colspan="4"><span class="title">آدرس :</span> <span class="value"><?php echo get_user_meta( $current_user->ID, 'billing_address_1', true ); ?></span></td>
		</tr>
	</tbody>
</table>
</div>


<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
