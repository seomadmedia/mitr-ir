<?php 
$mweb_contact_address = mweb_theme_util::get_theme_option('mweb_contact_address'); 
$mweb_contact_tel = mweb_theme_util::get_theme_option('mweb_contact_tel'); 
$mweb_contact_mail = mweb_theme_util::get_theme_option('mweb_contact_mail'); 

$mweb_footer_android = mweb_theme_util::get_theme_option('mweb_footer_android'); 
$mweb_footer_ios = mweb_theme_util::get_theme_option('mweb_footer_ios'); 
$mweb_footer_subscribe = mweb_theme_util::get_theme_option('mweb_footer_subscribe'); 

$mweb_footer_light = mweb_theme_util::get_theme_option('mweb_footer_light'); 
?>

<footer class="footer_wrap clear<?php if($mweb_footer_light){ echo ' footer_light'; } ?>" <?php mweb_theme_schema::makeup('footer'); ?>>
	<div class="container">
		<div class="row">
			<?php
				get_template_part( 'templates/footer/foot_item', 'sort' );
			?>
			
			<div class="col-12">
				<div class="footer_center">
					<?php if(!empty($mweb_footer_ios)) { echo '<a href="'.esc_url($mweb_footer_ios).'" class="app_btn"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#apple"></use></svg><span class="normal_txt">دانلود اپلیکیشن</span> <span class="big_txt">Apple ios</span></a>'; } ?>
					<?php if(!empty($mweb_footer_android)) { echo '<a href="'.esc_url($mweb_footer_android).'" class="app_btn"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#android"></use></svg><span class="normal_txt">دانلود اپلیکیشن</span> <span class="big_txt">Android</span></a>'; } ?>
					<?php if(!empty($mweb_footer_subscribe)) {  echo do_shortcode( $mweb_footer_subscribe ); }  ?>
				</div>
				<?php do_action( 'wp_footer_tools'); ?>
			</div>
		</div>
	</div>
</footer>

