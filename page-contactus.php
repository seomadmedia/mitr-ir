<?php
/*
Template Name: تماس با ما
*/


//get header
get_header(); 


//create single class
$mweb_single_class   = array();
$mweb_single_class[] = 'is-page';
$mweb_single_class[] = 'inner_wrap';
$mweb_single_class[] = 'contact-wrapper';
$mweb_single_class   = implode(' ', $mweb_single_class );

mweb_open_page_wrap( 'get_in_touch', 'none' );

//render
if ( have_posts() ) {
	the_post();

	?>
		
<?php
$map = esc_url( mweb_theme_util::get_theme_option('mweb_contact_map','url'));
$mweb_contact_address = mweb_theme_util::get_theme_option('mweb_pcontact_address');
$mweb_contact_email = mweb_theme_util::get_theme_option('mweb_pcontact_email');
$mweb_contact_tell = mweb_theme_util::get_theme_option('mweb_pcontact_tell');
?>
<div class="col-12">
	<div class="contact_wrap">
		<div class="contact_right">
			<h1><?php the_title(); ?></h1>
			<div class="contact_w"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#sms"></use></svg><h4>پست الکترونیک</h4><span><?php echo $mweb_contact_email; ?></span></div>
			<div class="contact_w"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#call"></use></svg><h4>شماره تماس</h4><span><?php echo $mweb_contact_tell; ?></span></div>
			<div class="contact_w"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#map"></use></svg><h4>آدرس </h4><span><?php echo $mweb_contact_address; ?></span></div>
			
			<div class="location">
				<?php if ( $map != ''): ?>
				<img src="<?php echo $map; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" <?php mweb_theme_schema::makeup('image'); ?>>
				<?php else : ?>
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/map.png" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" 				            <?php mweb_theme_schema::makeup('image'); ?>>
				<?php endif; ?>
			</div>
		</div>	
		<div class="contact_left">
			<?php $shortcode_from = mweb_theme_util::get_theme_option('mweb_cform');
			echo do_shortcode( ''.$shortcode_from.'' ); ?>
		</div>	
	</div>
</div>
<?php
		
}

if(!empty(get_the_content())){
?>
<div class="col-12">
	<div class="entry entry-content">
		<?php the_content(); ?>
	</div>
</div>

<?php
}
?>

<?php
mweb_close_page_wrap();

//get footer
get_footer();