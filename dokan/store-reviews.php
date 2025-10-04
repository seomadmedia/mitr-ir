<?php
/**
 * The Template for displaying all reviews.
 *
 * @package dokan
 * @package dokan - 2014 1.0
 */

$store_user   = dokan()->vendor->get( get_query_var( 'author' ) );
$store_info   = $store_user->get_shop_info();
$map_location = $store_user->get_location();

$store_user_c = get_userdata( get_query_var( 'author' ) );


$userinfo = get_userdata($store_user->get_id());
$user_register = strtotime ($userinfo->user_registered);

$store_tabs    = dokan_get_store_tabs( $store_user->get_id() );


get_header( 'shop' );

if ( function_exists( 'yoast_breadcrumb' ) ) {
    yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' );
}
?>
<?php do_action( 'woocommerce_before_main_content' ); ?>
<div class="mweb-section mweb-section-hs is-sidebar-right">
	<div class="row">
		
		<?php dokan_get_template_part( 'store-sidebar' ); ?>

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

				</div><!--#entry -->
			
			</div>
			
			<div id="dokan-content" class="store-page-wrap woocommerce" role="main">


					<?php
					$dokan_template_reviews = dokan_pro()->review;
					$id                     = $store_user_c->ID;
					$post_type              = 'product';
					$limit                  = 20;
					$status                 = '1';
					$comments               = $dokan_template_reviews->comment_query( $id, $post_type, $limit, $status );
					?>

					<div id="reviews">
						<div id="comments">

						  <?php do_action( 'dokan_review_tab_before_comments' ); ?>

							<h2 class="headline"><?php _e( 'Vendor Review', 'dokan' ); ?></h2>

							<ol class="commentlist">
								<?php echo $dokan_template_reviews->render_store_tab_comment_list( $comments , $store_user_c->ID); ?>
							</ol>

						</div>
					</div>

					<?php
					echo $dokan_template_reviews->review_pagination( $id, $post_type, $limit, $status );
					?>
				
				
			</div>

		

		</div>
		
	</div>
</div>

<?php do_action( 'woocommerce_after_main_content' ); ?>

<?php get_footer( 'shop' ); ?>
