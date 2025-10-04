(function ($) {
    'use strict';

	jQuery(document).ready(function($) {
		$('#generate_excel').click(function() {
			var category_id = $('#product_cat').val();
			var paged = 1;
			var row = 2;
			$('#progress-bar').show();
			$('#progress-bar-fill').css('width', '0%').text('0%');
			$('#download-link').empty();
			generateExcel(category_id, paged, row, 1); 
		});

		function generateExcel(category_id, paged, row, total_pages) {
			$.ajax({
				url: ajax_object.ajax_url,
				type: 'POST',
				data: {
					action: 'generate_excel',
					category_id: category_id,
					paged: paged,
					row: row
				},
				success: function(response) {
					if (response.status === 'in_progress') {
						var progress = (paged * 100) / response.total_pages;
						$('#progress-bar-fill').css('width', progress + '%').text(Math.round(progress) + '%');
						generateExcel(category_id, response.paged, response.row, response.total_pages);
					} else if (response.status === 'completed') {
						if( response.message ){
							$('#download-link').html('<div class="notice notice-error is-dismissible"><p>' + response.message + '</p></div>');
						} else{
							$('#progress-bar-fill').css('width', '100%').text('100%');
							$('#download-link').html('<a href="' + response.file_url + '">دانلود فایل اکسل</a>');
						}
						
					}
				},
				error: function(error) {
					console.log(error);
				}
			});
		}
		

		$('#upload_excel').click(function() {
			var formData = new FormData($('#update-products-form')[0]); 
			formData.append('action', 'update_products_from_excel'); 
			formData.append('start_row', 2); 

			$('#update-progress-bar').show();
			$('#update-progress-bar-fill').css('width', '0%').text('0%');
			$('#update-status').empty();

			processExcelFile(formData); 
		});

		function processExcelFile(formData) {
			$.ajax({
				url: ajax_object.ajax_url,
				type: 'POST',
				data: formData,
				contentType: false,
				processData: false,
				success: function(response) {
					if (response.success) {
						var data = response.data;
						if (data.status === 'in_progress') {
							$('#update-progress-bar-fill').css('width', data.progress + '%').text(Math.round(data.progress) + '%');
							
							if (data.errors.length > 0) {
								data.errors.forEach(function(error) {
									$('#update-status').append('<div class="notice notice-error"><p>Row ' + error.row + ': ' + error.product_name + ' - ' + error.error + '</p></div>');
								});
							}
						
							formData.set('start_row', data.next_row);
							

							processExcelFile(formData);
						} else if (data.status === 'completed') {
							$('#update-progress-bar-fill').css('width', '100%').text('100%');
							$('#update-status').append('<div class="notice notice-success is-dismissible"><p>محصولات با موفقیت به روز شدند!</p></div>');
							
							if (data.errors.length > 0) {
								$('#update-status').append('<div class="notice notice-error"><p>برخی از محصولات با خطا مواجه شدند:</p></div>');
								data.errors.forEach(function(error) {
									$('#update-status').append('<div class="notice notice-error"><p>ردیف ' + error.row + ': ' + error.product_name + ' - ' + error.error + '</p></div>');
								});
							}
						
						}
					} else {
						$('#update-status').html('<div class="notice notice-error is-dismissible"><p>' + response.data + '</p></div>');
					}
				},
				error: function(error) {
					console.log(error);
					$('#update-status').html('<div class="notice notice-error is-dismissible"><p>هنگام به روزرسانی محصولات خطایی روی داد.</p></div>');
				}
			});
		}
	
	});
	
})(jQuery);
