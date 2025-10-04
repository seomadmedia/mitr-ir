<?php

if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('لطفا این صفحه را به طور مستقیم بار نکنید. با تشکر!');

if ( post_password_required() ) {
	_e('این مطلب خصوصی است.در صورتی که رمز آن را دارید در قسمت زیر وارد کنید.', 'mweb');
	return;
}
	
?>


<?php if ( have_comments() ) : ?>
<div class="comments-wrapper">
<div class="block-title"><div class="title"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#message"></use></svg>دیدگاه کاربران </div><span class="comments_number"><?php comments_number( esc_html__('بدون دیدگاه', 'mweb')); ?></span></div>            
<div id="comments" class="comments-area">

    <ul class="comments-list clear">
		<?php wp_list_comments(array(
			'style'			=> 'ul',
			'callback'		=> 'mweb_layout_comments',
		)); ?>
    </ul>
	
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<div class="nav-previous"><?php previous_comments_link( esc_html__( 'دیدگاه های قدیمی &larr;', 'mweb' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( '&rarr; دیدگاه های جدید', 'mweb' ) ); ?></div>
		</nav>
	<?php endif; ?>
		
</div>
</div>

<?php endif; ?>



<?php
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
?>
	<p class="no-comments"><?php esc_html_e( 'دیدگاه ها بسته شده.', 'mweb' ); ?></p>
<?php endif; ?>
	
<?php 

$mweb_acc_url = mweb_theme_util::get_theme_option('mweb_login_register_url'); 
if(empty($mweb_acc_url)){
	$mweb_acc_url = get_permalink( get_option('woocommerce_myaccount_page_id'));
}


$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );


$form_args = array(
	'id_form'		=> 'comment-reply-form',
	'class_form'	=> 'comment-reply-form',
	'title_reply_before' => '<div class="block-title cm_title"><div class="title"><svg class="pack-theme small" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#message-text-1"></use></svg>',
	'title_reply_after' => '</div></div>',
	'class_submit'      => 'submit',
	'must_log_in'       => '<p class="must-log-in">برای نوشتن دیدگاه باید <a href="'.esc_url($mweb_acc_url).'">وارد بشوید</a>.</p>',
	'comment_notes_after' => '',
	'label_submit'		=> __('ارسال','mweb'),
	'title_reply'		=> __('ارسال دیدگاه','mweb'),
	'title_reply_to'	=>  __('لغو ارسال پاسخ به %s','mweb'),
	'comment_field' => '<div class="col-12"><div class="form-group">
							<textarea id="comment" name="comment" class="form-control" cols="45" placeholder="متن دیدگاه" rows="7"></textarea>	
						</div></div>',
						
	'fields' => apply_filters( 'comment_form_default_fields', array(
					'name' =>'<div class="row"><div class="col-12 col-sm-6">
								<input class="form-control" placeholder="نام" type="text" name="author" id="author" value="'. esc_attr( $commenter['comment_author'] ) .'">
							</div>',
					'email' =>'<div class="col-12 col-sm-6">
								<input class="form-control" placeholder="ایمیل" type="text" name="email" id="email" value="'. esc_attr( $commenter['comment_author_email'] ) .'" >
							</div></div>',
					
				)
			)
);
comment_form($form_args); 					


?>
