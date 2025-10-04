<div id="main-content-wrap" class="clearfix">
	<div class="container">
		<div class="search-no-result">
			<?php if ( is_search() ) : ?>
				<h3><?php esc_html_e( 'متاسفانه درخواست فاقد مطلب است', 'mweb' ); ?></h3>
			<?php else : ?>
				<h3><?php esc_html_e( 'مطلبی وجود ندارد . لطفا از پنل مدیریت اضافه کنید', 'mweb' ); ?></h3>
			<?php endif; ?>
		</div>
	</div>
</div>