<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( is_user_logged_in() ) {
	return;
}

$reg_login_phone = mweb_theme_util::get_theme_option('reg_login_only_phone');
$register_opt = mweb_theme_util::get_theme_option('reg_only_phone');
$reg_login_joint = mweb_theme_util::get_theme_option('reg_login_joint');


?>

<div class="tabs woo_myaccount_login" data-toggle="tabslet" data-animation="true">
	<section class="account_login_logo">
	<?php $logo = esc_url( mweb_theme_util::get_theme_option('mweb_logo_account','url')); ?>
	<div class="logo">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"  title="<?php bloginfo( 'name' ); ?>">
			<?php if ( $logo != ''): ?>
				<img src="<?php echo $logo; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
			<?php else : ?>
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
			<?php endif; ?>
		</a>	
	</div>
	</section>
	<?php if( $reg_login_joint ) : ?>
		<div>
			<div class="myaccount_title"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#user"></use></svg> ورود به سایت</div>
			<?php echo ( $message ) ? wpautop( wptexturize( $message ) ) : ''; // @codingStandardsIgnoreLine ?>
			<?php echo do_shortcode('[mweb_login]'); ?>
		</div>
	<?php else: ?>

		<ul>
			<li><a href="#login"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#user"></use></svg> ورود</a></li>
		</ul>
		<div id='login'>
			<?php echo ( $message ) ? wpautop( wptexturize( $message ) ) : ''; // @codingStandardsIgnoreLine ?>
			<?php do_action( 'woocommerce_before_customer_login_form' ); ?>
			<?php if( $reg_login_phone == false ){ ?>

			<form class="woocommerce-form woocommerce-form-login login" method="post" novalidate <?php echo ( $hidden ) ? 'style="display:none;"' : ''; ?>>

				<?php do_action( 'woocommerce_login_form_start' ); ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
				</p>
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
				</p>

				<?php do_action( 'woocommerce_login_form' ); ?>

				<p class="form-row">
					<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
						<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
					</label>
					<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
					<button type="submit" class="woocommerce-button button woocommerce-form-login__submit<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
				</p>
				<p class="woocommerce-LostPassword lost_password">
					<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
				</p>

				<?php do_action( 'woocommerce_login_form_end' ); ?>

			</form>
			<?php 
			} else {
				echo do_shortcode('[mweb_login]');
			} ?>
			
		</div>
		
		<?php do_action( 'woocommerce_after_customer_login_form' ); ?>

	<?php endif; ?>




</div>
			

