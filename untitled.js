
	$(window).on('resize', function(event){
		var windowSize = $(window).width();
	    if(windowSize < 586){
	    	$( "#accordion" ).accordion({
				collapsible: true,
				heightStyle: "content"
			});
	    }
	});