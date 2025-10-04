<?php 
$mweb_contact_address = mweb_theme_util::get_theme_option('mweb_contact_address'); 
$mweb_contact_tel = mweb_theme_util::get_theme_option('mweb_contact_tel'); 
$mweb_contact_mail = mweb_theme_util::get_theme_option('mweb_contact_mail'); 

$mweb_footer_android = mweb_theme_util::get_theme_option('mweb_footer_android'); 
$mweb_footer_ios = mweb_theme_util::get_theme_option('mweb_footer_ios'); 
$mweb_footer_subscribe = mweb_theme_util::get_theme_option('mweb_footer_subscribe'); 

$mweb_footer_light = mweb_theme_util::get_theme_option('mweb_footer_light'); 

?>

<footer class="footer_wrap clear footer_2<?php if($mweb_footer_light){ echo ' footer_light'; } ?>" <?php mweb_theme_schema::makeup('footer'); ?>>
	<div class="footer_top_wrap">
		<div class="gototop"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#arrow-up-2"></use></svg></div>
	</div>
	<div class="container">
		<div class="row">
			<?php get_template_part( 'templates/footer/foot_item', 'sort' ); ?>
			<div class="col-12">
				<?php add_filter('gototop_hook' , function(){ return false;});
				do_action( 'wp_footer_tools'); ?>
			</div>
		</div>
	</div>
</footer>
  
