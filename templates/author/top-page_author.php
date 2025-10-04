<?php
//check and return
$mweb_author_name          = get_the_author_meta( 'display_name' );
$mweb_author_avatar            = get_avatar_url( get_the_author_meta( 'user_email' ), 55 );
$mweb_author_desc   = get_the_author_meta('description');
$mweb_author_social_facebook = get_the_author_meta('facebook');
$mweb_author_social_twitter = get_the_author_meta('twitter');
$mweb_author_social_instagram = get_the_author_meta('instagram');
$mweb_author_social_telegram = get_the_author_meta('google') ;


?>

<div class="author_wrap container">
<div class="post-wrapper">
<img src="<?php echo esc_url( $mweb_author_avatar ); ?>" />

<div class="author_name"><?php echo esc_attr( $mweb_author_name ) ?></div>
<div class="social_icons">
	<ul>
		<?php if(!empty($mweb_author_social_facebook)) : ?>
            <li><a target="_blank" href="<?php echo esc_url($mweb_author_social_facebook); ?>" class="fa fa-facebook"></a></li>
        <?php endif; ?>
		<?php if(!empty($mweb_author_social_twitter)) : ?>
            <li><a target="_blank" href="<?php echo esc_url($mweb_author_social_twitter); ?>" class="fa fa-twitter"></a></li>
        <?php endif; ?>
		<?php if(!empty($mweb_author_social_instagram)) : ?>
            <li><a target="_blank" href="<?php echo esc_url($mweb_author_social_instagram); ?>" class="fa fa-instagram"></a></li>
        <?php endif; ?>
		<?php if(!empty($mweb_author_social_telegram)) : ?>
            <li><a target="_blank" href="<?php echo esc_url($mweb_author_social_telegram); ?>" class="fa fa-telegram"></a></li>
        <?php endif; ?>

	</ul>
</div><!-- ./ social_icons -->
<div class="author_inner">
<?php echo esc_attr( $mweb_author_desc ) ?>
</div>
</div>
</div><!-- ./ author_wrap -->