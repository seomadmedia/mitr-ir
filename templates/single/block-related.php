<?php
//get data
$mweb_single_related_data = mweb_theme_post_related::get_data();
$related_layout = mweb_theme_util::get_theme_option( 'mweb_layout_relpost' );


if(empty($related_layout))
	$related_layout = 'mweb_loop_template_blog_5';

$mweb_column = 'col-12';
$mweb_class = array();
$mweb_class[] = 'related-content row';

switch($related_layout){

	case 'mweb_loop_template_blog_1':
		$mweb_class[] = 'blog-posts-content';
		$mweb_column = ' col-sm-6 col-md-4';
		break;
		
	case 'mweb_loop_template_blog_2':
		$mweb_class[] = 'blog-posts-content-2';
		$mweb_column = ' col-sm-6 col-md-4';
		break;

	case 'mweb_loop_template_blog_3':
		$mweb_class[] = 'blog-posts-content-3';
		$mweb_column = ' col-sm-6 col-md-4';
		break;
		
	case 'mweb_loop_template_blog_4':
		$mweb_class[] = 'blog-posts-content-4';
		$mweb_column = ' col-sm-12 col-md-6';
		break;
		
	default:
		$mweb_class[] = 'blog-posts-content-4';
		$mweb_column = ' col-sm-12 col-md-6';
		
}


$mweb_class = implode(' ',$mweb_class);

if ( ! empty( $mweb_single_related_data ) ) :
	?>
	<div class="related-wrap">
		<div class="block-title"><div class="title"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#link-square"></use></svg>مطالب مرتبط</div></div>            
		<div class="<?php echo esc_attr( $mweb_class ); ?>">
				<?php foreach ( $mweb_single_related_data as $post ) : ?>
					<?php setup_postdata( $post ); ?>
					<div class="item <?= $mweb_column; ?>">
					<?php echo $related_layout(); ?>
					</div>

				<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>