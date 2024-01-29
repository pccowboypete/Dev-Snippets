(function($) {
    // here $ would be point to jQuery object
    $(document).ready(function() {
        $(document).keydown(function(event) {
			if (!event.ctrlKey){ return true; }
				if(
					String.fromCharCode(event.which) == "S"
			   	){
					$("#publish").click();
					event.preventDefault();
				}
				
		});
    });
})(jQuery);
