;(function($){
	// video embed
	if($('#video .embed').length){
		$('#video .play').on('click', function(){
			var el = $(this),
				hold = el.parent().find('.hold'),
				videoId = el.parent().attr('data-id'),
				iframe = '<iframe src="https://player.vimeo.com/video/'+videoId+'?wmode=transparent&amp;autoplay=1" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
			hold.append(iframe).fadeIn(300);
		});
	}

	// shades slider
	if($('#shades ul li').length > 1){

		// populte shade count to string
		$('#shades .title span').text($('#shades ul li').length);
		
		var width = $(window).width(),
			settings = {
				items:1,
			    margin:0,
			    loop:true,
			    nav:true,
			    responsive: {
			    	0: {
			    		items: 1
			    	},
			    	490: {
			    		items: 2
			    	}
			    }
			},
			slider = $('#shades ul');

		slider.owlCarousel(settings);

		swap(width, slider);

		function swap(width, slider){				
			if(width > 768){
				slider.trigger('destroy.owl.carousel');
			} else {
				slider.trigger('refresh.owl.carousel');
			}
		}
	}

	// accordion functionality KM
	var accordionSelector = $("#accordion"),
		windowSize = $(window).width();

	accordionSelector.accordion({
		collapsible: true,
		heightStyle: "content"
	});

	if (windowSize > 586) {
		accordionSelector.accordion( "destroy" );
	}

	$(window).resize(function(){
		if(windowSize < 586){
			accordionSelector.accordion({
				collapsible: true,
				heightStyle: "content"
			});
		} else {
			accordionSelector.accordion( "destroy" );
		}
	});

	// ingredients popup KM
	$('#ingredients_open, #ingredients_close').click(function() {
		$('#ingredients_content').toggleClass('show');
	});
})(jQuery);