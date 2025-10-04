<?php

//get data
$mweb_sidebar_position 	   = mweb_get_single_sidebar_position();
$mweb_tags             	   = mweb_theme_util::get_theme_option( 'mweb-tag' );
$mweb_share           	   = mweb_theme_util::get_theme_option( 'mweb-single-share' );
$mweb_author_post          = mweb_theme_util::get_theme_option( 'mweb-author-post' );
$mweb_enable_related_post  = mweb_theme_util::get_theme_option( 'mweb_show_relpost' );
$mweb_single_comment       = mweb_check_single_comment_box();



//create single class
$mweb_single_class   = array();
$mweb_single_class[] = 'is-single';
$mweb_single_class[] = 'inner_wrap';
$mweb_single_class[] = 'post-wrapper';
$mweb_single_class   = implode( ' ', $mweb_single_class );


mweb_open_page_wrap( 'single-wrap ', $mweb_sidebar_position );
mweb_get_breadcrumbs();

mweb_open_page_inner( 'single-inner', $mweb_sidebar_position);
mweb_open_single_wrap( $mweb_single_class );

echo '<div class="blog_top">';
	echo mweb_get_single_post_icon();
	echo '<h1 class="blog_title">'. mweb_post_title(false) .'</h1>';
echo  '</div>';

get_template_part( 'templates/single/block', 'entry' );


if ( $mweb_tags ) {
	get_template_part( 'templates/single/block', 'tags' );
}
?>
<div class="blog_bottom">
	<?php if ( $mweb_author_post ) { echo mweb_get_single_post_author(); } ?>
	<?= mweb_get_single_post_date(); ?>
	<?php if ( $mweb_share ) {	mweb_single_social_sharing('blog_social');  } ?>
</div>
<?php

mweb_close_single_wrap();

get_template_part( 'templates/single/block', 'advertising' );

get_template_part( 'templates/single/block', 'related' );

if ( ! empty( $mweb_single_comment ) && 'none' != $mweb_single_comment ) {
	get_template_part( 'templates/single/block', 'comment' );
}

mweb_close_page_inner();
mweb_single_sidebar();
mweb_close_page_wrap();
