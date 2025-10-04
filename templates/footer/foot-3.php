<?php 
$mweb_contact_address = mweb_theme_util::get_theme_option('mweb_contact_address'); 
$mweb_contact_tel = mweb_theme_util::get_theme_option('mweb_contact_tel'); 
$mweb_contact_mail = mweb_theme_util::get_theme_option('mweb_contact_mail'); 

$mweb_footer_android = mweb_theme_util::get_theme_option('mweb_footer_android'); 
$mweb_footer_ios = mweb_theme_util::get_theme_option('mweb_footer_ios'); 
$mweb_footer_subscribe = mweb_theme_util::get_theme_option('mweb_footer_subscribe'); 

$mweb_footer_android = mweb_theme_util::get_theme_option('mweb_footer_android'); 
$mweb_footer_ios = mweb_theme_util::get_theme_option('mweb_footer_ios'); 

$mweb_footer_light = mweb_theme_util::get_theme_option('mweb_footer_light'); 

?>

<footer class="footer_wrap clear footer_3<?php if($mweb_footer_light){ echo ' footer_light'; } ?>" <?php mweb_theme_schema::makeup('footer'); ?>>
    <div class="container">
		<div class="row">
			<div class="col-3 col-sm-2 col-md-2">
				<div class="footer_back2top">
					<svg xmlns="http://www.w3.org/2000/svg" width="73" height="27" viewBox="0 0 73 27">
					  <path d="M73.246,0C71.089,0.883,68.254,2.292,67,4c-6.578,8.961-16.48,23-30,23S13.578,13.1,7,4.229C5.608,2.352,2.27.839,0.073,0H73.246Z"/>
					</svg>
					<div class="gototop"><svg class="pack-theme is_white" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#arrow-up-2"></use></svg></div>
				</div>
			</div>
			<div class="col-9 col-sm-10 col-md-10">
				<div class="footer_top_w">
					<?php if(!empty($mweb_footer_ios)) { echo '<a href="'.esc_url($mweb_footer_ios).'" class="app_btn"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#apple"></use></svg><span class="big_txt">Apple ios</span></a>'; } ?>
					<?php if(!empty($mweb_footer_android)) { echo '<a href="'.esc_url($mweb_footer_android).'" class="app_btn"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#android"></use></svg><span class="big_txt">Android</span></a>'; } ?>
				</div>
			</div>
			<div class="clear footer_separate"></div>
		
			<?php get_template_part( 'templates/footer/foot_item', 'sort' ); ?>

			<div class="col-12">
				<?php 
				add_filter('gototop_hook' , function(){ return false;});
				do_action( 'wp_footer_tools'); ?>
			</div>
		</div>
    </div>
</footer>
  
