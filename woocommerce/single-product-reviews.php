<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.7.0
 */
 
defined( 'ABSPATH' ) || exit;

global $product;

if ( ! comments_open() ) {
	return;
}

$review_count 		= $product->get_review_count();
$avg_rating_number 	= number_format( $product->get_average_rating(), 1 );
$rating_counts 		= $product->get_rating_counts();

$star_rating = apply_filters( 'hook_show_star_rating_histogram', true );

$p_subtitle = get_post_meta( get_the_ID(), '_product_subtitle', true );
$content_title = apply_filters('mweb_tab_content_title', true);


ob_start();
	mweb_wc_extra_comment::mweb_get_extra_ratings_counts($product);
	$customers_review = ob_get_clean();

if( $content_title ){
?>
<div class="tab_content_heading">
	<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#message-text"></use></svg>
	<div class="heading_left">
		<span class="tab_h_title">دیدگاه کاربران</span><span class="tab_h_desc"><?= $p_subtitle ?></span>
	</div>
</div>
<?php } ?>

<div id="reviews" class="woocommerce-Reviews">
	
	<div id="elm-pcm-modal" class="modal">
		
		<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>

			<div id="review_form_wrapper">
				<div id="review_form">
					<?php
						$commenter = wp_get_current_commenter();
						$name_email_required = (bool) get_option( 'require_name_email', 1 );
						$comment_form = array(
							'title_reply'         => have_comments() ? esc_html__( 'Add a review', 'woocommerce' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'woocommerce' ), get_the_title() ),
							'title_reply_to'      => esc_html__( 'Leave a Reply to %s', 'woocommerce' ),
							'title_reply_before'   => '<span id="reply-title" class="comment-reply-title"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#message-text"></use></svg>',
							'title_reply_after'    => '</span>',
							'comment_notes_after'  => '',
							'label_submit'  => __( 'Submit', 'woocommerce' ),
							'logged_in_as'  => '',
							'comment_field' => '',
							'class_form' => 'vertical_scroll_css',
						);
						
						$fields              = array(
							'author' => array(
								'label'        => __( 'Name', 'woocommerce' ),
								'type'         => 'text',
								'value'        => $commenter['comment_author'],
								'required'     => $name_email_required,
								'autocomplete' => 'name',
							),
							'email'  => array(
								'label'        => __( 'Email', 'woocommerce' ),
								'type'         => 'email',
								'value'        => $commenter['comment_author_email'],
								'required'     => $name_email_required,
								'autocomplete' => 'email',
							),
						);

						$comment_form['fields'] = array();
						$count = count($fields);
						$counter = 1;
						foreach ( $fields as $key => $field ) {
							$field_html = '';
							if( $counter == 1 ){
								$field_html .= '<div class="row">';
							}
							$field_html .= '<div class="col-6"><p class="comment-form-' . esc_attr( $key ) . '">';
							$field_html .= '<label for="' . esc_attr( $key ) . '">' . esc_html( $field['label'] );

							if ( $field['required'] ) {
								$field_html .= '&nbsp;<span class="required">*</span>';
							}

							$field_html .= '</label><input id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" type="' . esc_attr( $field['type'] ) . '" autocomplete="' . esc_attr( $field['autocomplete'] ) . '" value="' . esc_attr( $field['value'] ) . '" size="30" ' . ( $field['required'] ? 'required' : '' ) . ' /></p></div>';

							if( $counter == $count ){
								$field_html .= '</div>';
							}
							
							$comment_form['fields'][ $key ] = $field_html;

							$counter++;
						}
				
						if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
							$comment_form['must_log_in'] = '<p class="must-log-in"><strong>برای ثبت دیدگاه، لازم است ابتدا وارد حساب کاربری خود شوید. اگر این محصول را قبلا از این فروشگاه خریده باشید، دیدگاه شما به عنوان مالک محصول ثبت خواهد شد.</strong><button class="comment_login">افزودن دیدگاه جدید</button></p>';
							//$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a review.', 'woocommerce' ), esc_url( $account_page_url ) ) . '</p>';
						}
						if ( wc_review_ratings_enabled() ) {
							$comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Your rating', 'woocommerce' ) . '</label><select name="rating" id="rating" required>
								<option value="">' . esc_html__( 'Rate&hellip;', 'woocommerce' ) . '</option>
								<option value="5">' . esc_html__( 'Perfect', 'woocommerce' ) . '</option>
								<option value="4">' . esc_html__( 'Good', 'woocommerce' ) . '</option>
								<option value="3">' . esc_html__( 'Average', 'woocommerce' ) . '</option>
								<option value="2">' . esc_html__( 'Not that bad', 'woocommerce' ) . '</option>
								<option value="1">' . esc_html__( 'Very poor', 'woocommerce' ) . '</option>
							</select></div>';
						}
						$comment_form['comment_field'] .= '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required palcholder="' . esc_attr( 'Your review', 'woocommerce' ) . ' "></textarea></p>';
						comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
						
						$comment_rules_page_id = mweb_theme_util::get_theme_option('comment_rules_page_id');
						$rules_link = get_permalink( $comment_rules_page_id );
						if ( get_option( 'comment_registration' ) && ! is_user_logged_in() )
							echo '';
						else
							echo '<p class="cm-rules">با ثبت دیدگاه موافقت خود را با <a href="'.esc_url($rules_link).'" target="_blank">قوانین انتشار نظرات</a> در سایت اعلام می کنم.</p>';
					?>
				</div>
			</div>

		<?php else : ?>

			<p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>

		<?php endif; ?>

	</div>
	
	<div class="advanced-review row">
		
		<div class="col-12 col-sm-8 col-lg-9">
		
			<div id="comments" class="comment_override">
				<div class="wc_comment_title">
					<h5 class="woocommerce-Reviews-title"><?php _e( 'Reviews', 'woocommerce' ); ?><span><?= $review_count ?></span></h5>
					<ul class="wcc_comments_filter" data-post_id="<?= get_the_ID() ?>">
						<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#filter-square"></use></svg>
						<li data-filter="newest">جدیدترین</li>
						<li data-filter="score">مفیدترین</li>
						<li data-filter="buyer">دیدگاه خریداران</li>
					</ul>
				</div>

				<?php if ( have_comments() ) : ?>

					<ol class="commentlist wc_cmAjax">
						<?php //wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
					</ol>
					

					<?php
					/* if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
						echo '<nav class="woocommerce-pagination">';
						paginate_comments_links(
							apply_filters(
								'woocommerce_comment_pagination_args',
								array(
									'prev_text' => is_rtl() ? '&rarr;' : '&larr;',
									'next_text' => is_rtl() ? '&larr;' : '&rarr;',
									'type'      => 'list',
								)
							)
						);
						echo '</nav>';
					endif; */
					?>

				<?php else : ?>

				<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'woocommerce' ); ?></p>

				<?php endif; ?>
			</div>
		</div>
		
		
		<div class="col-12 col-sm-4 col-lg-3 elm-sticky_cmLeft order_first">
			<div class="elm-sticky_content">
				<?php if ( wc_review_ratings_enabled() && ($star_rating || !$customers_review) ) { ?>
					<div class="elm-pcm">
						<div class="rating-histogram">
							<?php for( $rating = 5; $rating > 0; $rating-- ) : ?>
							<div class="rating-bar">
								<?php 
									$rating_percentage = 0;
									if ( isset( $rating_counts[$rating] ) && $review_count > 0 ) {
										$rating_percentage = (round( $rating_counts[$rating] / $review_count, 2 ) * 100 );
									}
								?>
								<div class="progress rating-percentage-bar">
									<span class="progress-bar rating-percentage" role="progressbar" data-transitiongoal="<?php echo esc_attr( $rating_percentage ); ?>"></span>
								</div>
								<div class="rating-count"><?php echo $rating; ?></div>
							</div>
							<?php endfor; ?>
						</div>
						<div class="avg-rating">
							<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#star"></use></svg>
							<?php 
								echo '<span class="avg-rating-number">' . $avg_rating_number . '</span>';
							?>
							<p><?php echo esc_html( sprintf( _n( 'بر اساس %s دیدگاه', 'بر اساس %s دیدگاه', $review_count, 'mweb' ), $review_count ) ); ?></p>
						</div>
					</div>
				<?php } ?>			
			
				
				<?php echo $customers_review; ?>

				
				<div class="elm-pcm-send">
					<span><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#messages-1"></use></svg> نظر خود را در مورد این محصول بنویسید ...</span>
					<a href="#elm-pcm-modal" rel="modal:open">افزودن دیدگاه <svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#add"></use></svg></a>
				</div>
			
			</div>
			

		</div>
		
		
	</div>
</div>
