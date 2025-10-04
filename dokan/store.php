<?php
/**
 * The Template for displaying all single posts.
 *
 * @package dokan
 * @package dokan - 2014 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$store_user   = dokan()->vendor->get( get_query_var( 'author' ) );
$store_info   = $store_user->get_shop_info();
$map_location = $store_user->get_location();


$userinfo = get_userdata($store_user->get_id());
$user_register = strtotime ($userinfo->user_registered);

$store_tabs    = dokan_get_store_tabs( $store_user->get_id() );


get_header( 'shop' );

$loop_name = apply_filters('mweb_mobile_loop_name_archive', 'product');


if ( function_exists( 'yoast_breadcrumb' ) ) {
    yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' );
}
?>
<?php do_action( 'woocommerce_before_main_content' ); ?>
<div class="mweb-section mweb-section-hs is-sidebar-right">
	<div class="row">
		<div class="content-wrap content-with-sidebar col-12 col-sm-12 col-md-9">
			<div class="is_store vendor_desc_wrap">
					
					<?php if ( $store_user->get_banner() ) { ?>
						<img src="<?php echo $store_user->get_banner(); ?>"
							 alt="<?php echo $store_user->get_shop_name(); ?>"
							 title="<?php echo $store_user->get_shop_name(); ?>"
							 class="profile-info-img">
					<?php } else { ?>
						<div class="profile-info-img dummy-image">&nbsp;</div>
					<?php } ?>
					
				<div class="vendor_desc_head">
						<?php //echo '<h1>'.$store_user->get_shop_name().'</h1>'; ?>
					
						<?php if ( $store_tabs ) { ?>
							<div class="dokan-store-tab">
								<ul class="dokan-list-inline">
									<?php foreach( $store_tabs as $key => $tab ) { ?>
										<li><a href="<?php echo esc_url( $tab['url'] ); ?>"><?php echo $tab['title']; ?></a></li>
									<?php } ?>
									<?php do_action( 'dokan_after_store_tabs', $store_user->get_id() ); ?>
								</ul>
							</div>
						<?php } ?>
				</div>
				
				<div class="vendor_desc_text">
					
					
					<?php if ( $store_user->toc_enabled() == 'yes' ) { 
						echo $store_user->get_toc();
					} ?>

				</div>
			
			</div>
			
			<div id="dokan-content" class="store-page-wrap woocommerce" role="main">


				<?php do_action( 'dokan_store_profile_frame_after', $store_user->data, $store_info ); ?>

				<?php if ( have_posts() ) { ?>

					<div class="seller-items">

						<?php woocommerce_product_loop_start(); ?>

							<?php while ( have_posts() ) : the_post(); ?>

								<?php wc_get_template_part( 'content', $loop_name ); ?>

							<?php endwhile; // end of the loop. ?>

						<?php woocommerce_product_loop_end(); ?>

					</div>

					<?php dokan_content_nav( 'nav-below' ); ?>

				<?php } else { ?>

					<p class="dokan-info"><?php _e( 'No products were found of this vendor!', 'dokan-lite' ); ?></p>

				<?php } ?>
				
				
			</div>

		

		</div>
		<?php dokan_get_template_part( 'store-sidebar' ); ?>
		
	</div>
</div>

<?php do_action( 'woocommerce_after_main_content' ); ?>

<?php get_footer( 'shop' ); ?>
