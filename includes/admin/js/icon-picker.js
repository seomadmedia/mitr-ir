/* Icon Picker */

(function($) {

	$.fn.iconPicker = function( options ) {
		var options = ['fal','fa'];
		var svgList = [];
		var svgSymbols = [];
		$list = $('');

		function font_set($btni) {
			
			svgList = [];

			/* var spriteUrl = $('#icon_pack').val();
			if(!spriteUrl)
				spriteUrl = IconPack['theme']; */
			
			var spriteUrl = $('#icon_pack').val();
			var spritename = $("#icon_pack :selected").text();
			if(!spriteUrl){
				spriteUrl = IconPack['theme'];
				spritename = 'theme';
			}
			
			//console.log(spriteUrl);

			$.get(spriteUrl, function(data) {
				$(data).find('symbol').each(function() {
					var symbolId = $(this).attr('id');
					var symbolViewBox = $(this).attr('viewBox');
					//var svgIcon = symbolId;
					//svgList.push(svgIcon);
					//svgSymbols.push({[symbolId] : $(this).html()});
					//svgSymbols[symbolId] = $(this).html();
					svgList[symbolId] = spritename == 'theme' ? '<svg class="pack-'+spritename+'" viewBox="0 0 24 24"><use xlink:href="' + spriteUrl + '#' + symbolId + '"/></svg>' : '<svg class="pack-'+spritename+'" viewBox="'+symbolViewBox+'">'+$(this).html()+'</svg>';
				});

			}, 'xml');
	
		};

		function build_list($popup,$btni,clear) {
			/* var spriteUrl = $('#icon_pack').val();
			var spritename = $("#icon_pack :selected").text();
			if(!spriteUrl){
				spriteUrl = IconPack['theme'];
				spritename = 'theme';
			} */
			
			$list = $popup.find('.icon-picker-list');
			if (clear == 1) { $list.empty();	}
			for (var i in svgList) {
				$list.append('<li data-icon="'+i+'"><a href="#" title="'+i+'">'+svgList[i]+'</a></li>');
			};
			$list.on('click', 'a', function(e) {
				e.preventDefault();
				var svg = $(this).html();
				$target.val(svg).trigger('change');
				$target.trigger('input');
				$target.change();

				$target.attr('data-item-option', true);
				$btni.html(svg);
				removePopup();
			});
		};
	
	
		function removePopup(){
			$(document).find(".icon-picker-container").remove();
		}


		//var $btni = $('#'+this.attr('id'));
		var $btni = this;

		font_set($btni);
		//$btni.each( function() {
			$($btni).on('click', function(e) {
				e.preventDefault();
				createPopup($btni);
			});
		//});


		function createPopup($btni) {
						
			$target = $($btni.data('target'));
			$popup = $('<div class="icon-picker-container"> \
					<div class="icon-picker-control" /> \
				</div>')
				.css({
					'top': $btni.offset().top + 40,
					'left': $btni.offset().left + 250
				});
				inner_list = $('<ul/>', {
					'class': 'icon-picker-list'
				}).appendTo($popup);
			build_list($popup,$btni,1);
			var $control = $popup.find('.icon-picker-control');
			var ipacks = '';
			for (var key in IconPack) {
				//if(key == 'theme'){
					//ipacks = ipacks + '<option value="'+IconPack[key]+'" selected="selected">'+key+'</option>';
				//}else{
					ipacks = ipacks + '<option value="'+IconPack[key]+'">'+key+'</option>';
				//}
			};
			$control.html('<p>انتخاب فونت : <select id="icon_pack">'+ipacks+'</select></p>'+
				'<a data-direction="back" href="#"><span class="dashicons dashicons-arrow-left-alt2"></span></a> '+
				'<input type="text" class="" placeholder="جستجو..." />'+
			'<a data-direction="forward" href="#"><span class="dashicons dashicons-arrow-right-alt2"></span></a>'+
			'');

			$control.on('change', 'select', function(e) {
				e.preventDefault();
				
				font_set($btni);
				$list = $popup.find('.icon-picker-list');
				$list.html('<p>صبر کنید ...</p>')
				setTimeout(function() {
					build_list($popup,$btni,1);
				}, 4000);
					
			});

			$control.on('click', 'a', function(e) {
				e.preventDefault();
				if ($(this).data('direction') === 'back') {
					//move last 25 elements to front
					$('li:gt(' + (svgList.length - 26) + ')', $list).each(function() {
						$(this).prependTo($list);
					});
				} else {
					//move first 25 elements to the end
					$('li:lt(25)', $list).each(function() {
						$(this).appendTo($list);
					});
				}
			});

			$popup.appendTo('body').show();

			$('input', $control).on('keyup', function(e) {
				var search = $(this).val();
				if (search === '') {
					//show all again
					$('li:lt(25)', $list).show();
				} else {
					$('li', $list).each(function() {
						if ($(this).data('icon').toString().toLowerCase().indexOf(search.toLowerCase()) !== -1) {
							$(this).show();
						} else {
							$(this).hide();
						}
					});
				}
			});

		   $(document).mouseup(function (e){
				if (!$popup.is(e.target) && $popup.has(e.target).length === 0) {
					removePopup();
				}
			}); 
			
		}
	}


	$(function() {
		if( $('body').hasClass('nav-menus-php') || $('body').hasClass('post-type-attribute_group') || $('body').hasClass('appearance_page_custom-display-features') )
			
		$('.icon-picker').each(function(){
			$($('#'+$(this).attr('id'))).iconPicker();
		});
		
	
	});
	
	window.addEventListener( 'elementor/init', () => {

		var IconPickerItemView = elementor.modules.controls.BaseData.extend({

			onReady() {
				var self = this;
				console.log('init icon picker');
				if (this.ui.textarea.val()) {
					this.ui.textarea.next('.icon-picker').html(this.ui.textarea.val());
				}
				this.ui.textarea.next('.icon-picker').iconPicker();
				
			},
			saveValue() {
				this.setValue(this.ui.textarea.val());
			},
			onBeforeDestroy() {
				this.saveValue();
			}
		
		});

		elementor.addControlView( 'iconpicker', IconPickerItemView );
	} );
	
	
}(jQuery));





