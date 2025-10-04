<?php 
$login_opt = mweb_theme_util::get_theme_option('login_only_phone');
$register_opt = mweb_theme_util::get_theme_option('reg_only_phone');
$reg_login_phone = mweb_theme_util::get_theme_option('reg_login_only_phone');
$reg_login_joint = mweb_theme_util::get_theme_option('reg_login_joint');
?>
<div class="login_wrap">
	<?php if( !$reg_login_joint ): ?>
		<form id="mweb_login" action="#0" method="post">
			<?php if( ($reg_login_phone == false && $login_opt == true) || $login_opt == false ){ ?>
			<p class="form-row-wide row-username<?= $login_opt == false ? : ' hide' ?>">
				<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#user"></use></svg>
				<span class="username"><input id="signin_email" name="signin_email" type="text" placeholder="نام کاربری یا شماره موبایل" <?= $login_opt == false ? 'required' : '' ?>></span>
			</p>
			<p class="form-row-wide row-password<?= $login_opt == false ? : ' hide' ?>">
				<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#password-check"></use></svg>
				<span class="password"><input id="signin_password" name="signin_password" type="password" placeholder="گذرواژه" <?= $login_opt == false ? 'required' : '' ?>></span>
			</p>
			<?php } ?>
			<?php if( $login_opt == true ){ ?>
				<p class="form-row-wide row-mobile">
					<span class="woocommerce-input-wrapper mobile"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#mobile"></use></svg><input type="text" name="phone_number" placeholder="شماره موبایل - - - - - - - - - 09" value="" maxlength="11" required=""></span>
				</p>
			<?php } ?>
			<div class="flex_row flex_space-between margin_10">
			<label class="label_remember_me"><input type="checkbox" id="remember-me" name="remember-me"><span class="remember_me">مرا به خاطر بسپار</span></label>
			<?php if( $login_opt == true && $reg_login_phone == false ){ ?>
				<span class="switch_login is_active" data-off="ورود با گذرواژه" data-on="ورود با کد یکبار مصرف"><?= $login_opt == true ? 'ورود با گذرواژه' : 'ورود با کد یکبار مصرف' ?></span>
			<?php } ?>
			</div>
			<p id="message"></p>
			<input type="hidden" name="action" value="ajax_login" />
			<input type="hidden" name="type" value="<?= $login_opt == false ? 'default' : 'otp' ?>" />
			<?php if( $login_opt == false ){ ?>
				<div class="flex_row">
				<input type="submit" value="ورود به حساب کاربری">
				<a class="lost" href="<?php echo wp_lostpassword_url(); ?>">فراموشی گذرواژه؟</a>
				</div>
			<?php } else { ?>
					<input type="submit" value="ورود" class="wp_login_btn">
			<?php } ?>
			<?php do_action('google_invre_render_widget_action'); ?>
		</form>
		<span class="seprator"><i>یا</i></span>

		<div class="create_account"><span class="button"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#profile-add"></use></svg> ساخت حساب کاربری</span></div>
	</div>
	<div class="register_wrap">
	<i class="close_modal"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#close-square"></use></svg></i>

		<form id="mweb_register" action="#0" method="post">
				
			<p class="form-row-wide row-mobile">
				<span class="woocommerce-input-wrapper mobile"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#mobile"></use></svg><input type="text" name="phone_number" placeholder="شماره موبایل - - - - - - - - - 09" value="" maxlength="11" required=""></span>
			</p>
			
			<?php if( $register_opt == false ): ?>
				<span class="form-row-wide mail">
					<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#sms"></use></svg>
					<input type="email" name="signup_email" id="signup_email" value="" placeholder="پست الکترونیک" required="">
				</span>

				<span class="form-row-wide password">
					<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#password-check"></use></svg>
					<input type="password" name="signup_pass" id="signup_pass" value="" placeholder="گذرواژه" required="">
					<p class="help-block">حداقل 8 کاراکتر</p>
				</span>
			<?php endif; ?>
							
			<p id="message"></p>
			<input type="hidden" name="type" value="<?= $register_opt == true ? 'otp' : 'default' ?>" />
			<input type="hidden" name="action" value="ajax_register" />
			<div class="flex_row">
				<input type="submit" class="wp_register_btn" value="عضویت">
				<?php /* if( is_dokan_activated() ){
							echo '<a class="lost" href="'.get_permalink( get_option('woocommerce_myaccount_page_id') ).'">فروشنده شوید</a>';
					  } */
				?>
			</div>
			<?php do_action('google_invre_render_widget_action'); ?>
		</form>
	
	<?php else : ?>
		
		<form id="mweb_subscribe" action="#0" method="post">
			<p class="form-row-wide row-mobile">
				<span class="woocommerce-input-wrapper mobile"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#mobile"></use></svg><input type="text" name="phone_number" placeholder="شماره موبایل - - - - - - - - - 09" value="" maxlength="11" required=""></span>
			</p>
			<input type="hidden" name="action" value="ajax_login_register" />
			<?php if( isset($_GET['back']) ){
				echo '<input type="hidden" name="back" value="'.wc_clean($_GET['back']).'" />';
			} ?>
			<input type="submit" value="ورود یا عضویت" class="wp_subscribe_btn">
			<?php do_action('google_invre_render_widget_action'); ?>
		</form>
	
	<?php endif; ?>

</div>
