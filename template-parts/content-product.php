<?php

	/* Template for displaying single product */
	$id = get_the_ID();

	$before_img = wp_get_attachment_image_src( get_post_meta($id, 'products_before_img', true), 'full' );
	$before_imgSrc = $before_img[0];
	$after_img = wp_get_attachment_image_src( get_post_meta($id, 'products_after_img', true), 'full' );
	$after_imgSrc = $after_img[0];

	$what_it_does = get_post_meta($id, 'products_what_it_does', true);
	$whats_in_it = get_post_meta($id, 'products_whats_in_it', true);
	$whats_not_in_it = get_post_meta($id, 'products_whats_not_in_it', true);
	$directions = get_post_meta($id, 'products_directions', true);
	$directions = get_post_meta($id, 'products_directions', true);
	$ingredients = get_post_meta($id, 'products_ingredients', true);

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
	
	<div class="container clearfix">
		<div class="beforeafter">
			<figure class="prod_img_before">
				<img src="<?php echo $before_imgSrc; ?>" />
			</figure><figure class="prod_img_after">
				<img src="<?php echo $after_imgSrc; ?>" />
			</figure>
		</div>
		<div id="details">
			<div class="whatItDoes">
				<h3>what it does</h3>
				<div>
					<p><?php echo $what_it_does; ?></p>
				</div>
			</div>
			
			<div id="accordion">
				
					<h3>what’s in it</h3>
					<div>
						<p><?php echo $whats_in_it; ?></p>
					</div>
					
					<h3>what’s NOT in it</h3>
					<div>
						<p><?php echo $whats_not_in_it; ?></p>
					</div>

					<h3>directions</h3>
					<div>
						<p><?php echo $directions; ?></p>
					</div>

				<div id="wrapper_ingredients"><h3 id="ingredients_header">ingredients</h3><img src="<?php bloginfo('template_directory'); ?>/img/ingredients_open.png" id="ingredients_open" /></div>
				<div id="ingredients_content">
					<img src="<?php bloginfo('template_directory'); ?>/img/ingredients_close.png" id="ingredients_close" />
					<p><?php echo $ingredients; ?></p>
				</div>

			</div>

			<a href="../../find-a-salon" class="btn_salon">Find a Salon</a>
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
			slider.owlCarousel(settings);

			swap(width, slider);

			function swap(width, slider){				
				if(width >= 768){
					slider.trigger('destroy.owl.carousel');
				} else {
					slider.trigger('refresh.owl.carousel');
				}
			}
		}
	})(jQuery);
</script>

		<!-- accordion functionality KM -->
		<script>
		var accordionSelector = $("#accordion")
		var windowSize = $(window).width();
		
		accordionSelector.accordion({
			collapsible: true,
			heightStyle: "content"
		});

		if (windowSize > 586) {
	    	accordionSelector.accordion( "destroy" );
	    }

		$(window).resize(function() {
			    if(windowSize < 586){
			    	accordionSelector.accordion({
					collapsible: true,
					heightStyle: "content"
				});
			    } else {
			    	accordionSelector.accordion( "destroy" );
			    }
			})
		</script>
	
		<!-- ingredients popup KM -->
		<script>
			$('#ingredients_open, #ingredients_close').click(function() {
				$('#ingredients_content').toggleClass('show')
			})
		</script>










