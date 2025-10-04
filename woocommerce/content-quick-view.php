<div class="quick_view_inner">
	<span class="close_quickview">&times;</span>
	<?php mweb_variations_Woocommerce::mwebshop_variable_product(); ?>

	<div id="product-<?php the_ID(); ?>" <?php wc_product_class(); ?>>
		<div class="primary_block row clearfix mweb-quick-view">
			<div class="entry-img single_p_gallery gallery_type_h col-12 col-sm-12 col-md-4 col-lg-4" data-direction="horizontal">
				<div class="inner">
				<?php
					/**
					 * woocommerce_before_single_product_summary hook
					 *
					 * @hooked woocommerce_show_product_sale_flash - 10
					 * @hooked woocommerce_show_product_images - 20
					 */
					remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
					add_action( 'woocommerce_before_single_product_summary', 'mweb_woo_images_quickview', 20 );
					do_action( 'woocommerce_before_single_product_summary' );
				?>
				</div>
			</div>
			<div class="summary entry-summary col-12 col-sm-12 col-md-8 col-lg-8">
			<div class="quickview_summary">
			<div class="single_product_head">

				<?php
					/**
					 * Hook: woocommerce_single_product_summary.
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_rating - 10
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 * @hooked woocommerce_template_single_sharing - 50
					 * @hooked WC_Structured_Data::generate_product_data() - 60
					 */
					remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
					remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
					remove_action('woocommerce_single_product_summary', 'mweb_add_compare_button_single', 30 );
					
					remove_action('woocommerce_single_product_summary', 'mweb_add_line_product_summary', 11 );
					remove_action('woocommerce_single_product_summary', 'mweb_product_info_box', 50 );
					remove_action('woocommerce_single_product_summary', 'mweb_close_col_summary', 50 );

					remove_action( 'woocommerce_single_product_summary', array(mweb_pricing_survey_question::init(), 'mweb_frontend_setup' ), 40);

					add_action('woocommerce_single_product_summary', 'mweb_close_col_summary', 11);

					
					add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 29);
					add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 10);
					do_action( 'woocommerce_single_product_summary' );
				?>

			</div>
			</div>
		</div>
	</div>
	
</div>