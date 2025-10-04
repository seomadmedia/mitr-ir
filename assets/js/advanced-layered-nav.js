jQuery(function($){

    $(document).on('click', '.filter-toggle', function(){
        $(this).toggleClass('open');
        $(this).next('.filter-content').slideToggle(200);
    });


    $(document).on('input', '.term-search-input', function(){
        var q = $(this).val().toLowerCase();
        $(this).siblings('.wc-layered-nav-term-list').find('.wc-layered-nav-term').each(function(){
            var t = $(this).text().toLowerCase();
            $(this).toggle(t.indexOf(q) !== -1);
        });
    });


$(document).on('click', '#mweb-clear-filters', function(e){
    e.preventDefault();

    // ریست چک‌باکس‌ها
    $('.advanced-layered-nav-widget input[type="checkbox"]').prop('checked', false);
    $('input[name="in_stock"]').prop('checked', false);

    // ریست فیلدهای عددی (قیمت)
    $('.advanced-layered-nav-widget input[type="number"]').val('');

    // ریست کلاس‌های انتخاب شده
    $('.advanced-layered-nav-widget .selected').removeClass('selected');

    // ریست slider و flag قیمت
    const $slider = $("#price-range-slider");
    const minPrice = parseInt($slider.data('min')) || 0;
    const maxPrice = parseInt($slider.data('max')) || 100000000;
    $("#imin_price").val(minPrice);
    $("#imax_price").val(maxPrice);
    $slider.slider("values", [minPrice, maxPrice]);

    priceFiltered = false; // ریست flag قیمت

    // فراخوانی applyFilters با پارامتر خالی تا همه محصولات برگردند
    updateProducts({}); // ← مهم، params خالی می‌فرستیم
    $('#mweb-clear-filters').hide(); // دکمه پاکسازی مخفی شود
});

	
	
	function formatPrice(price) {
        return new Intl.NumberFormat('fa-IR', {
            style: 'currency',
            currency: 'IRR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(price).replace('ریال', 'تومان');
    }
	
	
$(document).ready(function() {

    const $slider = $("#price-range-slider");
    const minPrice = parseInt($slider.data('min')) || 0;
    const maxPrice = parseInt($slider.data('max')) || 100000000;

    $("#imin_price").val(minPrice);
    $("#imax_price").val(maxPrice);

    let priceFiltered = false; // flag برای تشخیص تغییر قیمت

    // تنظیم slider
    $slider.slider({
        range: true,
        min: minPrice,
        max: maxPrice,
        step: Math.round((maxPrice - minPrice) / 100),
        values: [minPrice, maxPrice],
        slide: function(event, ui) {
            $("#imin_price").val(ui.values[0]);
            $("#imax_price").val(ui.values[1]);
        },
        stop: function(event, ui) {
            priceFiltered = true; // کاربر قیمت را تغییر داد
            applyFilters();
        }
    });

    // تغییر برند، ویژگی‌ها یا موجودی
    $('.filter-block input[type="checkbox"], .filter-block .term-button, .filter-block .color-swatch, .filter-block .image-swatch').on('change click', function(){
        applyFilters();
    });

    function applyFilters(){
        let params = {};

        // موجودی
        if ($('input[name="in_stock"]').is(':checked')) {
            params['in_stock'] = '1';
        }

        // قیمت فقط اگر کاربر آن را تغییر داده باشد
        if(priceFiltered){
            let min_price = $('#imin_price').val();
            let max_price = $('#imax_price').val();
            if(min_price) params['min_price'] = min_price;
            if(max_price) params['max_price'] = max_price;
        }

        // برند
        let brands = [];
        $('.filter-block[data-type="brand"] input[type="checkbox"]:checked').each(function(){
            brands.push($(this).val());
        });
        if(brands.length) params['get_brand'] = brands.join(',');

        // سایر ویژگی‌ها
        $('.filter-block[data-attribute]').each(function(){
            let attribute = $(this).data('attribute');
            let values = [];

            $(this).find('input[type="checkbox"]:checked').each(function(){
                values.push($(this).val());
            });
            $(this).find('.color-swatch.selected, .image-swatch.selected, .term-button.selected').each(function(){
                values.push($(this).data('value'));
            });

            if(values.length){
                if(!attribute.startsWith('pa_')) attribute = 'pa_' + attribute;
                params['get_' + attribute] = values.join(',');
            }
        });

        if(Object.keys(params).length > 0) {
            $('#mweb-clear-filters').show();
        }

        updateProducts(params);
    }

});




    /* function updateProducts(params){
        var baseUrl = window.location.pathname;
        var query = $.param(params);
        var newUrl = baseUrl + (query ? '?' + query : '');

        history.pushState(params, '', newUrl);

        var $productsWrapper = $('.products').parent(); 
        $productsWrapper.addClass('mweb-loader_up');

        $.get(newUrl, function(response){
            var $html = $('<div>').html(response);

            var newContent = $html.find('ul.products, .woocommerce-info').first();

            if (newContent.length) {
                $productsWrapper.html(newContent);
            } else {
                $productsWrapper.html('<p class="woocommerce-info">هیچ محصولی یافت نشد.</p>');
            }

            $productsWrapper.removeClass('mweb-loader_up');
        });
    } */
	
	function updateProducts(params){
		var baseUrl = window.location.pathname;
		var query = $.param(params);
		var newUrl = baseUrl + (query ? '?' + query : '');

		history.pushState(params, '', newUrl);

		var $productsWrapper = $('.products').parent();
		$productsWrapper.addClass('mweb-loader_up');

		$.get(newUrl, function(response){
			var $html = $('<div>').html(response);

			var $newProducts   = $html.find('ul.products, .woocommerce-info').first();
			var $newToolbar    = $html.find('.shop-control-bar').first();
			var $newPagination = $html.find('.woocommerce-pagination').first();

			if ($newToolbar.length) {
				var $oldToolbar = $('.shop-control-bar').first();
				if ($oldToolbar.length) $oldToolbar.replaceWith($newToolbar);
				else $productsWrapper.before($newToolbar); 
			}

			var $oldProducts = $productsWrapper.find('ul.products, .woocommerce-info').first();
			
			if( $('ul.products').length || $('.woocommerce-info').length > 1 )
				$('.woocommerce-info').remove();

			if ($newProducts.length) {
				if ($oldProducts.length) {
					/*console.log('log 1');*/
					$oldProducts.replaceWith($newProducts);
					//$productsWrapper.find('.woocommerce-info').remove();
				} else {
					//$('.woocommerce-info').remove();
					/*console.log('log 2');*/
					var $pag = $('.woocommerce-pagination').first();
					if ($pag.length) {
						$pag.before($newProducts);
					} else {
						var $tb = $('.shop-control-bar').first();
						if ($tb.length) $tb.after($newProducts);
						else $productsWrapper.append($newProducts); 
					}
				}
			} else {
				if ($oldProducts.length){
					 $oldProducts.replaceWith('<p class="woocommerce-info">هیچ محصولی یافت نشد.</p>');
					 /*console.log('log 3');*/
				}
				else {
					$productsWrapper.append('<p class="woocommerce-info">هیچ محصولی یافت نشد.</p>');
				/*	console.log('log 4');*/
				} 
			}

			var $oldPag = $('.woocommerce-pagination').first();
			if ($newPagination.length) {
				if ($oldPag.length) {
					$oldPag.replaceWith($newPagination);
				} else {
					var $currentProducts = $productsWrapper.find('ul.products, .woocommerce-info').first();
					if ($currentProducts.length) $currentProducts.after($newPagination);
					else $productsWrapper.append($newPagination);
				}
				
				if( typeof infiniteScroll !== 'undefined' ){		
					var currentPage = parseInt($('.woocommerce-pagination .page-numbers.current').text(), 10);
					if (!isNaN(currentPage) && currentPage < 5 && infiniteScroll.enable) {
						$('.woocommerce-pagination').hide();
					}
				}
				
			} else {
				if ($oldPag.length) $oldPag.remove();
			}
			
			

			$productsWrapper.removeClass('mweb-loader_up');
		});
	}




    $(window).on('popstate', function(e){
        var state = e.originalEvent.state || {};
        updateProducts(state);
    });
	
	
	
});
