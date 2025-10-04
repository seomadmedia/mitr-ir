<?php $logo = esc_url( mweb_theme_util::get_theme_option('mweb_logo','url')); ?>
<div class="logo" <?php mweb_theme_schema::makeup('logo'); ?>>
<a href="<?php echo esc_url( home_url( '/' ) ); ?>"  title="<?php bloginfo( 'name' ); ?>">
		<?php if ( $logo != ''): ?>
        <img src="<?php echo $logo; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" <?php mweb_theme_schema::makeup('image'); ?>>
        <?php else : ?>
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" <?php mweb_theme_schema::makeup('image'); ?>>
        <?php endif; ?>
</a>	
<meta itemprop="name" content="<?php bloginfo( 'name' ) ?>">
</div>
