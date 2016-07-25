<?php

	/* Template for displaying single product */

?>

<link href="<?php bloginfo('template_directory'); ?>/css/style-product.css" rel="stylesheet" type="text/css">

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
		<div class="container">
			<h2>sdffsfdsfdsfdsfdsfds hey what's up thIS IS A CHanGE</h2>
			<p>jsdklfjdsklfjdsklfdsl</p>
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
		$('#shades .title span').text($('#shades ul li').length);
		if($('#shades ul li').length > 1){
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
