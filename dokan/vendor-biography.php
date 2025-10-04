<?php
/**
 * The Template for displaying vendor biography.
 *
 * @package dokan
 */


get_header( 'shop' );


$store_user = dokan()->vendor->get( get_query_var( 'author' ) );
$store_info = $store_user->get_shop_info();

$store_tabs = dokan_get_store_tabs( $store_user->get_id() );



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
					
					<?php do_action( 'dokan_vendor_biography_tab_before', $store_user, $store_info ); ?>

					<h2 class="headline"><?php echo apply_filters( 'dokan_vendor_biography_title', __( 'Vendor Biography', 'dokan' ) ); ?></h2>

					<?php
						if ( ! empty( $store_info['vendor_biography'] ) ) {
							printf( '%s', apply_filters( 'the_content', $store_info['vendor_biography'] ) );
						}
					?>

					<?php do_action( 'dokan_vendor_biography_tab_after', $store_user, $store_info ); ?>

				</div><!--#entry -->
			
			</div>


		</div>
		<?php dokan_get_template_part( 'store-sidebar' ); ?>
		
	</div>
</div>

<?php do_action( 'woocommerce_after_main_content' ); ?>

<?php get_footer( 'shop' ); ?>
