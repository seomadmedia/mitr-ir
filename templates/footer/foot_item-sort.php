<?php 
$mweb_footer_sort = mweb_theme_util::get_theme_option('mweb_footer_sort','enabled'); 

function one_sec(){
	if(has_nav_menu('foot-menu-1')): ?>
		<div class="col-6 col-sm-4 col-md-3 col-lg-2">
			<div class="footer_list">
				<div class="title_list"><?php mweb_get_nav_name('foot-menu-1');  ?></div>
				<?php
				   wp_nav_menu( array(
						'theme_location' => 'foot-menu-1',
						'container' => false, 
						'menu_id' => '',
						'menu_class' => ''
					));
				?>
			</div> 
		</div>
<?php endif; 
}

function two_sec(){
	if(has_nav_menu('foot-menu-2')): ?>
		<div class="col-6 col-sm-4 col-md-3 col-lg-2">
			<div class="footer_list">
				<div class="title_list"><?php mweb_get_nav_name('foot-menu-2');  ?></div>
				<?php
				   wp_nav_menu( array(
						'theme_location' => 'foot-menu-2',
						'container' => false, 
						'menu_id' => '',
						'menu_class' => ''
					));
				?>
				</div> 
		</div>
<?php endif;
}

function three_sec(){
	$mweb_namad_electro_title = mweb_theme_util::get_theme_option('mweb_namad_electro_title'); 
	$mweb_namad_electro = mweb_theme_util::get_theme_option('mweb_namad_electro'); 
	echo '<div class="col-6 col-sm-4 col-md-3 col-lg-2"><div class="footer_list">';
	if(!empty($mweb_namad_electro_title))
		echo '<div class="title_list">'.$mweb_namad_electro_title.'</div>';
	echo $mweb_namad_electro;
	echo '</div></div>';
}

function four_sec(){
	$mweb_namad_samandehi_title = mweb_theme_util::get_theme_option('mweb_namad_samandehi_title'); 
	$mweb_namad_samandehi = mweb_theme_util::get_theme_option('mweb_namad_samandehi'); 
	echo '<div class="col-6 col-sm-4 col-md-3 col-lg-2"><div class="footer_list">';
	if(!empty($mweb_namad_samandehi_title))
		echo '<div class="title_list">'.$mweb_namad_samandehi_title.'</div>';
	echo $mweb_namad_samandehi;
	echo '</div></div>';
}


function five_sec(){
	$mweb_namad_samandehi_title = mweb_theme_util::get_theme_option('mweb_namad_samandehi_title'); 
	$mweb_namad_samandehi = mweb_theme_util::get_theme_option('mweb_namad_samandehi'); 
	$mweb_namad_electro = mweb_theme_util::get_theme_option('mweb_namad_electro'); 
	$mweb_namad_unknown = mweb_theme_util::get_theme_option('mweb_namad_unknown'); 
	
	$data_setting = array();

	$data_setting['slidesPerView'] = 1;
	$data_setting['spaceBetween'] = 0;
	$data_setting['watchSlidesVisibility'] = true;
	$data_setting['loop'] = true;
	$data_setting['autoplay'] = true;
	$data_setting['touchMoveStopPropagation'] = true;
	$data_setting['pagination'] = array('el' => '.mweb-swiper-pagination', 'clickable' => true);

	
	echo '<div class="col-6 col-sm-4 col-md-3 col-lg-2"><div class="footer_list mweb-swiper">';
		echo '<div class="title_list">'.$mweb_namad_samandehi_title.'</div>';
		echo '<div class="swiper sw_slider_namad" dir="rtl" id="'.wp_unique_id('sl_').'" data-slider="'. esc_attr(wp_json_encode($data_setting)) .'">';
			echo '<div class="swiper-wrapper">';
				if(!empty($mweb_namad_samandehi))
					echo '<div class="swiper-slide">'.$mweb_namad_samandehi.'</div>';
				if(!empty($mweb_namad_electro))
					echo '<div class="swiper-slide">'.$mweb_namad_electro.'</div>';
				if(!empty($mweb_namad_unknown))
					echo '<div class="swiper-slide">'.$mweb_namad_unknown.'</div>';
			echo '</div>';
			echo '<div class="mweb-swiper-pagination"></div>';
		echo '</div>';
	echo '</div></div>';
}

function six_sec(){
	$mweb_aboutus_content = mweb_theme_util::get_theme_option('mweb_aboutus_content');
	$mweb_aboutus_title = mweb_theme_util::get_theme_option('mweb_aboutus_title');
	echo '<div class="col-12 col-sm-12 col-md-6 col-lg-4"><h4 class="footer_aboutus_head">'.$mweb_aboutus_title.'</h4><div class="footer_aboutus">'.$mweb_aboutus_content.'</div></div>';
}

function seven_sec(){
	$mweb_contact_address = mweb_theme_util::get_theme_option('mweb_contact_address'); 
	$mweb_contact_tel = mweb_theme_util::get_theme_option('mweb_contact_tel'); 
	$mweb_contact_mail = mweb_theme_util::get_theme_option('mweb_contact_mail'); 
	?>
	<div class="col-12 col-sm-12 col-md-6 col-lg-4">
		<div class="contact_us_wrap"><h5>ارتباط با ما</h5>
			<?php if(!empty($mweb_contact_address)){ echo '<div class="contact_item"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#map"></use></svg><span>'.$mweb_contact_address.'</span></div>'; } ?>
			<?php if(!empty($mweb_contact_tel)){ echo '<div class="contact_item"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#call-incoming"></use></svg>'.$mweb_contact_tel.'</div>'; } ?>
			<?php if(!empty($mweb_contact_mail)){ echo '<div class="contact_item"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#sms"></use></svg>'.$mweb_contact_mail.'</div>'; } ?>

			<?php mweb_social_icons(); ?>

			<div class="basket_icon hide_mobile"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#bag-2"></use></svg></div>
		</div>
	</div>
	<?php	
}


function eight_sec(){
	if(has_nav_menu('foot-menu-3')): ?>
		<div class="col-6 col-sm-12 col-md-3 col-lg-2">
			<div class="footer_list">
				<div class="title_list"><?php mweb_get_nav_name('foot-menu-3');  ?></div>
				<?php
				   wp_nav_menu( array(
						'theme_location' => 'foot-menu-3',
						'container' => false, 
						'menu_id' => '',
						'menu_class' => ''
					));
				?>
			</div> 
		</div>
<?php endif;
	
}


function nine_sec(){
	$mweb_contact_address = mweb_theme_util::get_theme_option('mweb_contact_address'); 
	$mweb_contact_tel = mweb_theme_util::get_theme_option('mweb_contact_tel'); 
	$mweb_contact_mail = mweb_theme_util::get_theme_option('mweb_contact_mail'); 
	?>
	<div class="col-12 col-sm-12 col-md-6 col-lg-4">
		<div class="contact_us_wrap type_2"> <h5>ارتباط با ما</h5>
			<?php if(!empty($mweb_contact_address)){ echo '<div class="contact_item"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#map"></use></svg><span>'.$mweb_contact_address.'</span></div>'; } ?>
			<?php if(!empty($mweb_contact_tel)){
				echo '<div class="contact_item phone"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#call-calling"></use></svg><strong>'.substr($mweb_contact_tel, 0, 4).'</strong>'.substr($mweb_contact_tel, 4).'</div>';
				} ?>
			<?php if(!empty($mweb_contact_mail)){ echo '<div class="contact_item email">'.$mweb_contact_mail.'</div>'; } ?>

			<?php mweb_social_icons(); ?>
		</div>
	</div>
	<?php	
}

function ten_sec(){
	$mweb_contact_address = mweb_theme_util::get_theme_option('mweb_contact_address'); 
	$mweb_contact_tel = mweb_theme_util::get_theme_option('mweb_contact_tel'); 
	$mweb_contact_mail = mweb_theme_util::get_theme_option('mweb_contact_mail'); 
	
	$socials = mweb_theme_util::get_theme_option('mweb_social_icons');

	?>
	<div class="col-12 col-sm-12 col-md-6 col-lg-4">
		<div class="contact_us_wrap type_3"> <h5>ارتباط با ما</h5>
			<?php if(!empty($mweb_contact_address)){ echo '<div class="contact_item"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#map"></use></svg><span>'.$mweb_contact_address.'</span></div>'; } ?>
			<?php if(!empty($mweb_contact_tel)){
				echo '<div class="contact_item phone"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#call"></use></svg><strong>'.substr($mweb_contact_tel, 0, 4).'</strong>'.substr($mweb_contact_tel, 4).'</div>';
			} ?>
			<?php if(!empty($mweb_contact_mail)){ echo '<div class="contact_item email">'.$mweb_contact_mail.'</div>'; } ?>
			<div class="clear"></div>
			<?php 
			if(!empty($socials['telegram'])){
				echo '<a class="footer_social_l telegram" href="'.$socials['telegram'].'"><svg class="pack-theme is_white" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#telegram"></use></svg> Telegram</a>';
			}
			if(!empty($socials['instagram'])){
				echo '<a class="footer_social_l instagram" href="'.$socials['instagram'].'"><svg class="pack-theme is_white" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#instagram"></use></svg> Instagram</a>';
			}
			?>
		</div>
	</div>
	<?php	
}


if ($mweb_footer_sort): 
	foreach ($mweb_footer_sort as $key => $value) {
 
		switch($key) {
	 
			case 'footer_menu_1': 
				one_sec();
			break;
	 
			case 'footer_menu_2': 
				two_sec();
			break;
			
			case 'footer_menu_3': 
				eight_sec();
			break;
	 
			case 'namad_electro': 
				three_sec();
			break;
	 
			case 'namad_samandehi': 
				four_sec();    
			break; 

			case 'namad_slider': 
				five_sec();    
			break;
			
			case 'about_us': 
				six_sec();    
			break;  
			
			case 'contact_us_one': 
				seven_sec();    
			break;  
			
			case 'contact_us_two': 
				ten_sec();    
			break;  
			
			case 'contact_us_three': 
				nine_sec();    
			break;  

		}
 
	}
 
endif;

?>
