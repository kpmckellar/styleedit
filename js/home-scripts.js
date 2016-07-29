;(function($){
	if($('#homeSlider ul li').length > 1){
		$('#homeSlider ul').owlCarousel({
			items:1,			    
		    margin:0,
		    loop:true,
		    nav:false,				    
		    autoplayTimeout:4000,
		    responsive:{
		    	0:{
		    		autoplay:false		    		
		    	},
		    	768:{
		    		autoplay:true
		    	}
		    },
		    onInitialized: function(event){
    			if($(window).width() < 490){
    				$('#homeSlider ul').trigger('destroy.owl.carousel');
    			}		    			
    		}
		});
	}
})(jQuery);