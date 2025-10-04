<?php 

$mweb_acc_url = mweb_theme_util::get_theme_option('mweb_login_register_url'); 
if(empty($mweb_acc_url)){
	$mweb_acc_url = get_permalink( get_option('woocommerce_myaccount_page_id'));
}

$mobile_head_layout = mweb_theme_util::get_theme_option('mobile_head_layout'); 
$mhead_cart = mweb_theme_util::get_theme_option('mhead_cart'); 
$mhead_social = mweb_theme_util::get_theme_option('mhead_social'); 

$is_account = is_account_page();
$notify_btn = '';

if( $is_account ){
		
	$equal = mweb_get_notify_count();

	$notify_page = wc_get_endpoint_url('notify', '', $mweb_acc_url);
	$ticket_notify = get_user_meta( get_current_user_id(), 'ticket_notify', true );
	$equal = is_array($ticket_notify) ? $equal + intval(count($ticket_notify)) : $equal;
	$notify_dropdown = '';
	if( $equal > 0 ){
		$ticket_list = '';
		if( !empty($ticket_notify) ){
			foreach($ticket_notify as $key => $notify){
				$ticket_list = '<div class="tk_list">'.$notify['title'].'</div>';
			}
		}
		$notify_dropdown = '<div class="notify_dropdown">'.$ticket_list.'<span>شما <b>'.$equal.'</b> پیغام خوانده نشده دارید</span><a href="'.esc_url($notify_page).'">مشاهده پیغام ها</a></div>';
		$notify_btn = '<div class="hs_icon notify_btn is_active" data-count="'.$equal.'"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#notification"></use></svg>'.$notify_dropdown.'</div>';
	} else {
		$notify_btn = '<a class="hs_icon notify_btn" href="'.esc_url($notify_page).'" title="پیغام ها"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#notification"></use></svg></a>';
	}
	
}
?>
<?php get_template_part( 'templates/header/module', 'nav_mobile' ); ?>
<header <?php mweb_theme_schema::makeup('header'); ?> class="head_mobile visible position_top mhead_<?= $mobile_head_layout ?>"> 
	<div class="container">
		<?php if(($mobile_head_layout == 1 || $mobile_head_layout == 3) && !$is_account){ ?>
			<div class="is-show mobile-nav-button hs_icon">
				<a id="mweb-trigger" class="icon-wrap" href="#"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#menu"></use></svg></a>
			</div>
			<?php if( $mobile_head_layout == 3 ): ?>
				<?php if( is_user_logged_in() ): ?>
					<?php if( !$is_account ): ?>
						<div class="hs_icon user_login"><span><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#profile-tick"></use></svg></span>
							<?php
								if(has_nav_menu('user-menu')): ?>
								<div class="my-account">
								<?php
								   wp_nav_menu( array(
										'theme_location' => 'user-menu',
										'container' => false, 
										'menu_id' => '',
										'menu_class' => 'menu'
									));
								?>
								</div>
							<?php endif; ?>
						</div>
					<?php else: 
						echo $notify_btn;
					endif; ?> 
				
				<?php else: ?>
					 <a class="hs_icon user_login login_btn" href="<?php echo esc_url($mweb_acc_url); ?>"><span><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#user"></use></svg></span></a>
				<?php endif; ?> 
			<?php endif; ?> 
		<?php } ?>
		<?php $logo = mweb_theme_util::get_theme_option('mweb_logo_mobile','url'); ?>
		<div class="logo" <?php mweb_theme_schema::makeup('logo'); ?>>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"  title="<?php bloginfo( 'name' ); ?>">
				<?php if ( $logo != ''): ?>
				<img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" <?php mweb_theme_schema::makeup('image'); ?>>
				<?php else : ?>
				<h1><?php echo get_bloginfo( 'name' ); ?></h1>
				<?php endif; ?>
			</a>	
		</div>
		
		<div class="head_icon_warp">	
			<?php if($mobile_head_layout == 2 && !$is_account){ ?>
			<div class="is-show mobile-nav-button hs_icon">
				<a id="mweb-trigger" class="icon-wrap" href="#"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#element-equal"></use></svg></a>
			</div>
			<?php } ?>
			<?php
			if($mhead_social){
				$mweb_head_tel_or_ins = mweb_theme_util::get_theme_option('mweb_head_tel_or_ins'); 
				$mweb_head_tel_or_ins_link = mweb_theme_util::get_theme_option('mweb_head_tel_or_ins_link');		
				if(!empty($mweb_head_tel_or_ins) && $mweb_head_tel_or_ins != 'none' ){
					$my_icon = ($mweb_head_tel_or_ins == 'head_telegram') ? '<svg class="pack-theme" viewBox="0 0 512 512"><use xlink:href="'.mweb_print_sprites_path().'#telegram"></use></svg>' : '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#instagram"></use></svg>';
					echo '<a href="'.$mweb_head_tel_or_ins_link.'" class="hs_icon '.$mweb_head_tel_or_ins.'" title="ما در شبکه اجتماعی">'.$my_icon.'</a>';
				} 
			} 
			?>			
			<?php if ( class_exists('WooCommerce') && $mhead_cart ) : ?>
				<div class="shop_cart hs_icon get_sidebar" data-class="open_cart_sidebar"> <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="مشاهده سبد خرید"><span class="shop-badge"><?php echo sprintf (_n( '%d ', '%d ', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?></span><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#bag-2"></use></svg></a></div>
			<?php endif; ?>	

			<?php if( $mobile_head_layout != 3 ): ?>			
				<?php if(is_user_logged_in()): ?>
					<?php if( !$is_account ): ?>
						<div class="hs_icon user_login"><span><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#profile-tick"></use></svg></span>
							<?php
								if(has_nav_menu('user-menu')): ?>
								<div class="my-account">
								<?php
								   wp_nav_menu( array(
										'theme_location' => 'user-menu',
										'container' => false, 
										'menu_id' => '',
										'menu_class' => 'menu'
									));
								?>
								</div>
							<?php endif; ?>
						</div>
					<?php else: 
						echo $notify_btn;
					endif; ?> 
				<?php else: ?>
					 <a class="hs_icon user_login login_btn" href="<?php echo esc_url($mweb_acc_url); ?>"><span><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#user"></use></svg></span></a>
				<?php endif; ?> 
			<?php endif; ?> 
		</div>
		<?php if( !$is_account ){ ?>
			<div class="search_wrap_mobile">
				<?php echo mweb_render_search_form(); ?>
			</div>
		<?php } ?>
	</div>
</header>