<?php
defined( 'ABSPATH' ) || exit;
?>
<a href="#" class="print_btn p_btn_<?= @$type; ?>" title="چاپ">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M96 160H64V64C64 28.7 92.7 0 128 0H357.5c17 0 33.3 6.7 45.3 18.7l26.5 26.5c12 12 18.7 28.3 18.7 45.3V160H416V90.5c0-8.5-3.4-16.6-9.4-22.6L380.1 41.4c-6-6-14.1-9.4-22.6-9.4H128c-17.7 0-32 14.3-32 32v96zm352 64H64c-17.7 0-32 14.3-32 32V384H64V352c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32v32h32V256c0-17.7-14.3-32-32-32zm0 192v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V416H32c-17.7 0-32-14.3-32-32V256c0-35.3 28.7-64 64-64H448c35.3 0 64 28.7 64 64V384c0 17.7-14.3 32-32 32H448zM96 352l0 128H416V352H96zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg>
</a>
<?php if( is_account_page() ){ ?>
<a href="<?= wc_get_endpoint_url( 'orders', '', wc_get_page_permalink( 'myaccount' )) ?>" onclick="closeWindow();" class="close_btn" title="بازگشت">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M4.7 244.7c-6.2 6.2-6.2 16.4 0 22.6l176 176c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6L54.6 272 432 272c8.8 0 16-7.2 16-16s-7.2-16-16-16L54.6 240 203.3 91.3c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0l-176 176z"/></svg>
</a>
<?php }else{ ?>
<a href="#" onclick="window.close();" class="close_btn" title="بستن صفحه">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M324.5 411.1c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6L214.6 256 347.1 123.5c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0L192 233.4 59.5 100.9c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6L169.4 256 36.9 388.5c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0L192 278.6 324.5 411.1z"/></svg>
</a>
<?php } ?>
<script src="<?php echo includes_url('/js/jquery/jquery.min.js'); ?>"></script>
<script src="<?php echo get_template_directory_uri() . '/assets/js/printThis.js'; ?>"></script>
<script type="text/javascript" >
	jQuery(document).ready(function($) {
		$('.p_btn_<?= @$type; ?>').on("click", function () {
			$('.container_<?= @$type; ?>').printThis({
				importCSS: true
			});
		});
	});
</script>

</body>
</html>
