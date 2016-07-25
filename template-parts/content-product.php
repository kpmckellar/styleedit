<?php

	/* Template for displaying single product */

?>

<link href="<?php bloginfo('template_directory'); ?>/css/style-product.css" rel="stylesheet" type="text/css">
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>

<section class="product">
	
	<div id="feature">		
		<div class="container">
			<div class="hold">
				<div class="image">
					<img src="<?php bloginfo('template_directory'); ?>/img/featured-image.jpg"/>
				</div>
				<div class="productShot">
					<img src="<?php bloginfo('template_directory'); ?>/img/product-shot.jpg"/>
					<h1 class="title">product name</h1>
					<h2 class="subTitle">some sub title here</h2>
					<h3 class="description">Say something more about product</h3>
				</div>
			</div>
		</div>
		<div id="logo">
			<h1>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Style Edit</a>
			</h1>
		</div>
	</div>

	<div id="shades">
		<div class="container">
			<h3 class="title">available in <span>x</span> shades</h3>
			<ul>
				<li>
					<span class="colorName">dark blonde</span>
					<span class="commonText">matches hair color:</span>
					<img src="<?php bloginfo('template_directory'); ?>/img/dark-blonde.png"/>
				</li>
				<li>
					<span class="colorName">dark blonde</span>
					<span class="commonText">matches hair color:</span>
					<img src="<?php bloginfo('template_directory'); ?>/img/dark-blonde.png"/>
				</li>
				<li>
					<span class="colorName">dark blonde</span>
					<span class="commonText">matches hair color:</span>
					<img src="<?php bloginfo('template_directory'); ?>/img/dark-blonde.png"/>
				</li>
			</ul>
		</div>
	</div>

	<div id="details">
		<script>
			$( function() {
				$( "#accordion" ).accordion({
				collapsible: true,
				heightStyle: "content"
				});
			});
		</script>
		<div class="whatItDoes">
			<h3>what it does</h3>
			<div>
				<p>this temporary, touch-up spray instantly lightens and brightens to blend dark roots and perfectly disguises gray roots, leaving hair looking refreshed, revived, and ready for anything. works in seconds and shampoos out.</p>
			</div>
		</div>
		
	<div id="accordion">

		<h3>what’s in it</h3>
		<div>
			<p>multi-chromatic pigments for self-adjusting color that matches your signature hue and blends visible dark and gray roots. emollients impart vibrant shine with a natural-feeling texture.</p>
		</div>
		
		<h3>what’s NOT in it</h3>
		<div>
			<p>peroxide, ammonia, or any harsh or permanent dyes. not tested on animals.</p>
		</div>

		<h3>directions</h3>
		<div>
			<p>shake well. test spray before use. for best results, apply to clean, dry hair. hold can 4-5 inches from hair. move can continuously back and forth until roots are evenly camouflaged. let dry 2-3 minutes. apply more if necessary. if product comes into contact with hands or skin during application, remove quickly with damp cloth and/or soap and water. not recommended for facial hair, eyebrows or body hair.</p>
		</div>

		<h3>ingredients</h3>
		<div>
			<p>butane, hydrofluorocarbon 152a, ethyl trisiloxane, trimethylsiloxysilicate, polypropylsilsesquioxane, fragrance, synthetic fluorphlogopite, tin oxide, triethoxycaprylylsilane, mica, titanium dioxide (ci 77891), iron oxides (ci 77491, ci 77492, ci 77499).  may contain: ferric ferrocyanide (ci 77510).</p>
		</div>

	</div>

	<div id="video">
		<div class="container">
			<div class="embed">
				<img src="<?php bloginfo('template_directory'); ?>/img/video-thumb.jpg"/>
				<div class="play"></div>
				<div class="hold"></div>
			</div>
		</div>		
	</div>

	<div id="dualFeature">
		<div class="container">
			<div class="image">
				<img src="<?php bloginfo('template_directory'); ?>/img/dual-feature.jpg"/>
			</div>
		</div>
	</div>

</section><!-- .no-results -->

<!-- Owl Carousel -->
<link href="<?php bloginfo('template_directory'); ?>/js/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css">
<link href="<?php bloginfo('template_directory'); ?>/js/owl-carousel/owl.theme.css" rel="stylesheet" type="text/css">
<script src="<?php bloginfo('template_directory'); ?>/js/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
<script type="text/javascript">
	(function($){
		if($('#video .embed').length){
			$('#video .play').on('click', function(){
				var el = $(this);
				var hold = $(this).parent().find('.hold');
				var videoId = '1eHG-7l0vXg';
				var iframe = '<iframe width="560" height="315" src="https://www.youtube.com/embed/'+videoId+'?wmode=transparent&amp;autoplay=1" frameborder="0" allowfullscreen></iframe>';
				hold.append(iframe).fadeIn(300);
			});
		}
		if($('#shades ul li').length > 1){
			$('#shades .title span').text($('#shades ul li').length);
			var width = $(window).width();
			var settings = {
				items:1,
			    margin:0,
			    loop:true,
			    nav:true
			}			
			var slider = $('#shades ul');

			swap(width, slider);

			function swap(width, slider){				
				if(width >= 768){
					// slider.trigger('destroy.owl.carousel');
					// slider.owlCarousel(settings);
				} else {
					// slider.trigger('refresh.owl.carousel');
					slider.owlCarousel(settings);
				}
			}
		}
	})(jQuery);		
</script>
