(function($) {
	
	$(document).ready(function ($) {
		
		$.urlParam = function(name){
			var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec( window.location.href );
			if (results == null) {
			   return null;
			}
			return decodeURI( results[1] ) || 0;
		}
		
		let select_type = $('#filter-by-review-type');
		
		select_type.append($('<option>', {
			value: 'pquestion',
			text: 'پرسش و پاسخ'
		}));
		
		$('tr.pquestion').find('td.column-type').text('پرسش و پاسخ');

		if( $.urlParam('review_type') == 'pquestion' ){
			select_type.children( 'option[value="pquestion"]' ).attr( 'selected', 'selected' );
		} 

	});


})(jQuery);
