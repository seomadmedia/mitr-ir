<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<!--meta tag-->
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="http://gmpg.org/xfn/11"/>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>

	<?php wp_head(); ?>

</head>
<body <?php body_class(); mweb_theme_schema::makeup( 'body' ); ?>>
<div class="page-wrap clear page-404">
	<div class="container">
		<div class="content-404-inner content-inner">
			<div class="icon-wrap"><i>4</i><i>0</i><i>4</i></div>
			<div class="circle"></div>
			 <div class="one">
                    <div class="content">
                        <span class="piece"></span>
                        <span class="piece"></span>
                        <span class="piece"></span>
                    </div>
                </div>

                <div class="two">
                    <div class="content">
                        <span class="piece"></span>
                        <span class="piece"></span>
                        <span class="piece"></span>
                    </div>
                </div>

                <div class="three">
                    <div class="content">
                        <span class="piece"></span>
                        <span class="piece"></span>
                        <span class="piece"></span>
                    </div>
                </div>
			<div class="content-404">
				<h1>صفحه مورد نظر یافت نشد که به چند دلیل این اتفاق افتاده است:</h1>
				<div class="title-404 post-title">
					<ul>
					  <li>آدرس صفحه تغییر کرده است.</li>
					  <li>مطلب به طور کلی حذف شده است.</li>
					  <li>مشکلی در دیتابیس بوجود آمده است.</li>
					</ul>
				</div>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="gotoback-404" title="<?php bloginfo( 'name' ); ?>">بازگشت به صفحه اصلی</a>
			</div>
		</div>
	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>