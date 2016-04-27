(function(document, window, $){
	'use strict';

	(function plusMinus(){
		$(".plusminusbutton").click( function(){
			var $button = $(this);
			var oldValue = $button.parent().find(".input-text.qty").val();
			var newVal;
			if ( $button.hasClass('plus') ) {
				newVal = parseFloat(oldValue) + 1;
			} else {
				// Don't allow decrementing below zero
				if (oldValue > 0) {
					newVal = parseFloat(oldValue) - 1;
				} else {
					newVal = 0;
				}
			}
			$button.parent().find(".input-text.qty").val(newVal);
		});
	})();

	(function clearSearchOnClick(){
		//clear search on click
		defaultValue = $('#Searchform').val();
		$('#Searchform').click(function() {
			if( this.value == defaultValue ) {
				$(this).val("");
			}
		});
	})();

	//Fast CLick
	FastClick.attach(document.body);

})(document, window, jQuery);
