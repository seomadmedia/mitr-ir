<?php 
$mweb_acc_url = get_permalink( get_option('woocommerce_myaccount_page_id'));
if( is_user_logged_in() ):

$mweb_head_logout_url = mweb_theme_util::get_theme_option('mweb_head_logout_url');

$equal = mweb_get_notify_count();

$setting_page = wc_get_endpoint_url('edit-account', '', $mweb_acc_url);
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
	$notify_btn = '<div class="up_top_notify notify_btn is_active" data-count="'.$equal.'"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#notification"></use></svg>'.$notify_dropdown.'</div>';
} else {
	$notify_btn = '<a class="up_top_notify" href="'.esc_url($notify_page).'" title="پیغام ها"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#notification"></use></svg></a>';
}
?>
<header class="user_header">
	<div class="container">
		<div class="my_account_menu"><i class="fal fa-bars"></i>فهرست</a></div>
		<div class="account_head_icon text_align_left">
			<?php echo '<a href="'.wp_logout_url(esc_url($mweb_head_logout_url)).'" class="up_top_logout" title="خروج از حساب"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#login-1"></use></svg></a>'; ?>
			<?= $notify_btn ?>
			<a class="up_top_setting" href="<?php echo esc_url($setting_page); ?>" title="تنظیمات"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#user-edit"></use></svg></a>				
			<a class="up_top_home" href="<?php echo get_home_url(); ?>"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#home"></use></svg></a>	
		</div>
	</div>
</header>
<?php endif; ?>