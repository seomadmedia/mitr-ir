<?php
/**-------------------------------------------------------------------------------------------------------------------------
* Add new comment filter type
*/
add_filter( 'admin_comment_types_dropdown', 'mweb_admin_comment_types_dropdown', 10, 1, 999 );
function mweb_admin_comment_types_dropdown( $comment_types ) {
    $comment_types['pquestion'] = __( 'پرسش و پاسخ', 'mweb' );
    return $comment_types;
}




/**-------------------------------------------------------------------------------------------------------------------------
* Exclude webhook comments from queries and RSS.
*/
add_filter( 'comment_feed_where', 'mweb_exclude_webhook_comments_from_feed_where' );
function mweb_exclude_webhook_comments_from_feed_where( $where ) {
	return $where . ( $where ? ' AND ' : '' ) . " comment_type != 'webhook_delivery' ";
}



/**-------------------------------------------------------------------------------------------------------------------------
* Remove product data tabs
*/
add_filter( 'woocommerce_product_tabs', 'mweb_woo_rename_tabs', 98 );
function mweb_woo_rename_tabs( $tabs ) {

	$tabs['reviews']['title'] = __( 'نظرات کاربران' );
	return $tabs;

}


/**-------------------------------------------------------------------------------------------------------------------------
* Modify comment type in queries
*/
add_action( 'pre_get_comments', function(\WP_Comment_Query $query) {
   // only allow 'my_custom_comment_type' when is required explicitly 
   if( !is_admin() ){
	   if ( $query->query_vars['type'] != 'pquestion' ) {
		  $query->query_vars['type__not_in'] = array_merge(
			  (array) $query->query_vars['type__not_in'],
			  array('pquestion')
		  );
	   }else{
		   $query->query_vars['type__in'] = array_merge(
			  (array) $query->query_vars['type__in'],
			  array('pquestion')
		  );
	   }
   }
}); 


add_filter( 'pre_comment_approved', function( $approved, $data ) {
	if( !is_admin() ){
		return isset($data['comment_type']) && $data['comment_type'] === 'pquestion' ? 0 : $approved ;
	}
}, 20, 2); 


/*<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path().'#message-question'; ?>"></use></svg>*/

/**-------------------------------------------------------------------------------------------------------------------------
* Add question list callback
*/
function mweb_question_list_callback($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

    $is_reply = ! empty( $comment->comment_parent );
    ?>
    <<?php echo $tag; ?> id="question-<?php comment_ID() ?>" <?php comment_class( $is_reply ? 'question-item reply-item' : 'question-item' ); ?>>
        <div class="question-body">
            <div class="question-head">
                <?php if ( ! $is_reply ) { ?>
                    <span class="question-author">
                        <?php echo mweb_convert_to_stars( get_comment_author(), true ); ?>
                    </span>
                    <span class="question-date"><?php echo get_comment_date('j M Y'); ?></span>
                <?php } else { ?>
                    <span class="question-author">پاسخ کارشناس:</span>
                <?php } ?>
            </div>

            <?php if ( $comment->comment_approved == '0' ) { ?>
                <em class="question-awaiting"><?php _e( 'منتظر پاسخ کارشناسان باشید.' ); ?></em><br/>
            <?php } ?>

            <div class="question-text">
                <?php comment_text(); ?>
            </div>

            <div class="question-footer">
                <?php
                // دکمه پاسخ
                comment_reply_link( array_merge( $args, array(
                    'add_below' => 'question-' . get_comment_ID(),
                    'depth'     => $depth,
                    'max_depth' => $args['max_depth'],
                    'reply_text'=> '↩ پاسخ',
                ) ) );
                ?>
            </div>
        </div>
    <?php
}





/**-------------------------------------------------------------------------------------------------------------------------
* Add new tab for question
*/
add_filter( 'woocommerce_product_tabs', 'mweb_add_product_questions_tab' );
function mweb_add_product_questions_tab( $tabs ) {
	$mweb_review_tab = mweb_theme_util::get_theme_option('mweb_question_tab');
	if( $mweb_review_tab == 'show' )
    $tabs['questions'] = array(
        'title'     => __( 'سوالات کاربران', 'mweb' ),
        'priority'  => 30,
        'callback'  => 'mweb_product_questions_tab_content'
    );
	return $tabs;
}

function mweb_product_questions_tab_content() {
	$p_subtitle = get_post_meta( get_the_ID(), '_product_subtitle', true );
	$content_title = apply_filters('mweb_tab_content_title', true);
	if( $content_title ){
	?>
	<div class="tab_content_heading">
		<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#messages-1"></use></svg>
		<div class="heading_left">
			<span class="tab_h_title">پرسش و پاسخ</span><span class="tab_h_desc"><?= $p_subtitle ?></span>
		</div>
	</div>
	<?php
	}
	echo do_shortcode('[pquestion_list]');
}

/*function mweb_product_questions_tab_content()  {
	$comments = get_comments(array(
		'post_id' => get_the_ID(),
		'status' => 'approve',
		'type' => 'pquestion'
	));
	
	$p_subtitle = get_post_meta( get_the_ID(), '_product_subtitle', true );
	$content_title = apply_filters('mweb_tab_content_title', true);
	if( $content_title ){
	?>
	<div class="tab_content_heading">
		<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#messages-1"></use></svg>
		<div class="heading_left">
			<span class="tab_h_title">پرسش و پاسخ</span><span class="tab_h_desc"><?= $p_subtitle ?></span>
		</div>
	</div>
	<?php
	}
	if( empty($comments) )
		echo mweb_error('هیچ پرسشی یافت نشد');
	
		if( ( isset( $_REQUEST['unapproved'] ) ) && ( $_REQUEST['unapproved'] != '') ) { 
			$comment_id = wc_clean( $_REQUEST['unapproved'] );
			if( is_numeric($comment_id) ){
				$comment_row = get_comment( $comment_id ); 
				if( $comment_row ){
					if( $comment_row->user_id == get_current_user_id() && $comment_row->comment_approved == 0 )
						printf( '<div class="question_waiting"><p>%s</p><span>در انتظار پاسخ</span></div>', $comment_row->comment_content );
				}
			
			
			
			}
		}
		
	echo '<ul class="questionlist">';	
		wp_list_comments( array( 'per_page' => -1, 'type' => 'pquestion', 'style' => 'ul', 'callback' => 'mweb_question_list_callback'), $comments );
	echo '</ul>';

	// if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		// echo '<nav class="woocommerce-pagination">';
		// paginate_comments_links(	
			// array(
				// 'prev_text' => '&larr;',
				// 'next_text' => '&rarr;',
				// 'type'      => 'list',
			// )
		// );
		// echo '</nav>';
	// endif;
			
	
	
	$commenter = wp_get_current_commenter();
	$form_args = array(
		'id_form'		=> 'questions-form',
		'class_form'	=> 'questions-form',
		'title_reply_before' => '<div class="block-title cm_title title--decor1"><span class="title">',
		'title_reply_after' => '</span></div>',
		'class_submit'      => 'submit',
		'comment_notes_after' => '',
		'format' => 'xhtml',
		'label_submit'		=> __('ارسال پرسش','mahdisweb'),
		'title_reply'		=> __('ارسال پرسش','mahdisweb'),
		'must_log_in'		=> __('برای ثبت پرسش، لازم است ابتدا وارد حساب کاربری خود شوید','mahdisweb'),
		'title_reply_to'	=>  __('لغو ارسال پاسخ %s','mahdisweb'),
		'comment_field' => '<div class="form-group"><textarea id="comment" name="comment" class="form-control" cols="45" placeholder="پرسش خود را بنوسید" rows="7" required></textarea><input type="hidden" name="comment_type" value="pquestion" id="comment_type" /></div>',

				
	);
	
	if ( is_user_logged_in() ) {
		comment_form($form_args); 
	}else{
		echo '<p class="closed_question">برای ثبت پرسش، لازم است ابتدا وارد حساب کاربری خود شوید</p>';
	}
	
}*/





/**-------------------------------------------------------------------------------------------------------------------------
* Modify commentdata before handle it
*/
add_filter( 'preprocess_comment', 'mweb_preprocess_comment_handler', 12, 1, 9999 );
function mweb_preprocess_comment_handler( $commentdata ){     
    if( ( isset( $_POST['comment_type'] ) ) && ( $_POST['comment_type'] != '') ) { 
		$commentdata['comment_type'] = wp_filter_nohtml_kses( $_POST['comment_type'] );
    }
	if( is_admin() ){
		if( !empty($commentdata['comment_parent']) ){
			$comment = get_comment( $commentdata['comment_parent'] );
			if ( !empty($comment->comment_type) ) {
				$commentdata['comment_type'] = $comment->comment_type;
			}
		}
	}
    return $commentdata;    
} 






//add_filter( 'comment_post_redirect', 'redirect_after_comment', 10, 2 );
function redirect_after_comment($location, $comment ){
	if( $comment->comment_type == 'pquestion' ){
		$location = str_replace( "#comment-{$comment->comment_ID}", "#question-{$comment->comment_ID}", $location );
	}
	
	return $location;
}


add_shortcode('pquestion_list', 'mweb_pquestion_list_shortcode');
function mweb_pquestion_list_shortcode() {
    ob_start();
	
	$allow_replayq = mweb_theme_util::get_theme_option('allow_replayq');
	$comment_rules_page_id = mweb_theme_util::get_theme_option('comment_rules_page_id');
	$rules_link = get_permalink( $comment_rules_page_id );

    ?>
	<div class="row">
		<div class="col-12 col-sm-8 col-lg-9">
			<div id="pquestion-list-wrapper">
				<ul class="questionlist">
					<?php
					$comments = get_comments([
						'post_id' => get_the_ID(),
						'status'  => 'approve',
						'type'    => 'pquestion',
						'parent'  => 0
					]);

					if ($comments) {
						foreach ($comments as $comment) {
							?>
							<li class="pquestion-item" id="question-<?php echo $comment->comment_ID; ?>">
								<div class="pquestion-body">
									<div class="pquestion-head">
										<div class="pquestion-text"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path().'#message-question'; ?>"></use></svg><?php echo esc_html($comment->comment_content); ?></div>
										<span class="pquestion-date"><?php echo get_comment_date('j M Y', $comment); ?></span>
									</div>
								</div>

								<?php
								$btn_text = 'ثبت پاسخ';
								$replies = get_comments([
									'post_id' => get_the_ID(),
									'status'  => 'approve',
									'type'    => 'pquestion',
									'parent'  => $comment->comment_ID
								]);
								if ($replies) {
									echo '<ul class="pquestion-replies">';
									foreach ($replies as $reply) {
										$is_buyer = wc_customer_bought_product(
											$reply->comment_author_email,
											$reply->user_id,
											get_the_ID()
										);
										?>
										<li class="pquestion-reply">
											<div class="reply-head">
												<span class="reply-label">پاسخ</span>
											</div>
											<div class="reply-text">
												<?php echo esc_html($reply->comment_content); ?>
												<span class="reply-author">
													<?php 
														echo esc_html( mweb_convert_to_stars($reply->comment_author, true) );
														if ( $is_buyer ) {
															echo ' <b class="buyer-label">خریدار</b>';
														}
													?>
												</span>
											</div>
										</li>
										<?php
									}
									echo '</ul>';
									$btn_text = 'ثبت پاسخ جدید';
								}  

								if( $allow_replayq ){
								?>
								<button class="pquestion-reply-btn" data-id="<?= $comment->comment_ID; ?>"><?= $btn_text; ?><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path().'#arrow-left-1'; ?>"></use></svg></button>
								<?php } ?>
							</li>
							<?php
						}
					} else {
						echo '<li><p class="woocommerce-nopqs">هنوز پرسشی ثبت نشده است.</p></li>';
					}
					?>
				</ul>

				
			</div>
		</div>
		<div class="col-12 col-sm-4 col-lg-3 elm-sticky_cmLeft">
			<div class="elm-pcm-send">
				<span><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#message-add-1"></use></svg> شما هم درباره این کالا پرسش ثبت کنید</span>
				<a id="ask-question-btn">ثبت پرسش جدید <svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#add"></use></svg></a>
			</div>
		</div>

		<div id="ask-question-modal" class="modal modal_box">
			<h5><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path().'#message-add-1'; ?>"></use></svg>ثبت پرسش جدید</h5>
			<div class="modal_inner">
				<?php
					if ( is_user_logged_in() ) {
						?>
					<form id="ask-question-form">
						<textarea id="question-text" maxlength="100" name="question" placeholder="پرسش خود را وارد کنید..." required></textarea>
						<div class="char-counter">
							<span id="question-count">0</span>/100 کاراکتر
						</div>
						<?php wp_nonce_field('submit_pquestion_action', 'submit_pquestion_nonce'); ?>
						<input type="hidden" name="action" value="submit_pquestion">
						<input type="hidden" name="post_id" value="<?php echo get_the_ID(); ?>">
						<button type="submit">ارسال پرسش</button>
						<p class="cm-rules">ثبت پرسش به معنی موافقت با <a href="<?= esc_url($rules_link) ?>" target="_blank">قوانین انتشار</a> در سایت است.</p>
					</form>
				<?php
					} else {
						echo '<p class="closed_question">برای ثبت پرسش، لازم است ابتدا وارد حساب کاربری خود شوید</p>';
					} 
				?>
			</div>
		</div>

		<div id="answer-question-modal" class="modal modal_box">
			<h5><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path().'#message-text'; ?>"></use></svg>به این پرسش پاسخ دهید</h5>
			<div class="modal_inner">
				<?php
					if ( is_user_logged_in() ) {
						?>
						<form id="answer-question-form">
							<textarea id="answer-text" name="answer" placeholder="پاسخ خود را وارد کنید..." required></textarea>
							<div class="char-counter">
								<span id="answer-count">0</span>/500 کاراکتر
							</div>
							<?php wp_nonce_field('submit_panswer_action', 'submit_panswer_nonce'); ?>
							<input type="hidden" name="action" value="submit_panswer">
							<input type="hidden" name="post_id" value="<?php echo get_the_ID(); ?>">
							<input type="hidden" name="parent_id" id="answer-parent-id">
							<button type="submit">ارسال پاسخ</button>
							<p class="cm-rules">ثبت پاسخ به معنی موافقت با <a href="<?= esc_url($rules_link) ?>" target="_blank">قوانین انتشار</a> در سایت است.</p>
						</form>
						<?php
					} else {
						echo '<p class="closed_question">برای ثبت پرسش، لازم است ابتدا وارد حساب کاربری خود شوید</p>';
					} 
				?>
			</div>
		</div>
	</div>
    <?php
    return ob_get_clean();
}


// ثبت پرسش
add_action('wp_ajax_submit_pquestion', 'submit_pquestion_callback');
add_action('wp_ajax_nopriv_submit_pquestion', 'submit_pquestion_callback');
function submit_pquestion_callback() {
    if (!is_user_logged_in()) {
        wp_send_json_error(['message' => 'لطفا وارد شوید.']);
    }
    if (!isset($_POST['submit_pquestion_nonce']) || !wp_verify_nonce($_POST['submit_pquestion_nonce'], 'submit_pquestion_action')) {
        wp_send_json_error(['message' => 'درخواست نامعتبر است.']);
    }

    $user = wp_get_current_user();
    $commentdata = [
        'comment_post_ID'      => intval($_POST['post_id']),
        'comment_author'       => $user->display_name,
        'comment_author_email' => $user->user_email,
        'comment_content'      => sanitize_textarea_field($_POST['question']),
        'comment_type'         => 'pquestion',
        'comment_approved'     => 0,
    ];
    wp_insert_comment($commentdata);

    wp_send_json_success(['message' => 'پرسش شما ثبت شد و پس از تایید نمایش داده خواهد شد.']);
}

// ثبت پاسخ
add_action('wp_ajax_submit_panswer', 'submit_panswer_callback');
add_action('wp_ajax_nopriv_submit_panswer', 'submit_panswer_callback');
function submit_panswer_callback() {
    if (!is_user_logged_in()) {
        wp_send_json_error(['message' => 'لطفا وارد شوید.']);
    }
    if (!isset($_POST['submit_panswer_nonce']) || !wp_verify_nonce($_POST['submit_panswer_nonce'], 'submit_panswer_action')) {
        wp_send_json_error(['message' => 'درخواست نامعتبر است.']);
    }

    $user = wp_get_current_user();
    $commentdata = [
        'comment_post_ID'      => intval($_POST['post_id']),
        'comment_author'       => $user->display_name,
        'comment_author_email' => $user->user_email,
        'comment_content'      => sanitize_textarea_field($_POST['answer']),
        'comment_type'         => 'pquestion',
        'comment_parent'       => intval($_POST['parent_id']),
        'comment_approved'     => 0,
    ];
    wp_insert_comment($commentdata);

    wp_send_json_success(['message' => 'پاسخ شما ثبت شد و پس از تایید نمایش داده خواهد شد.']);
}













