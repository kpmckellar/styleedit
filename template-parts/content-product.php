<?php

	/* Template for displaying single product */
	
	$id = get_the_ID();

	$header_img = wp_get_attachment_image_src( get_post_meta($id, 'products_header_img', true), 'full' );
	$header_imgSrc = $header_img[0];
	$featured_img = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full' );
	$featured_imgSrc = $featured_img[0];
	$subtitle = get_post_meta($id, 'products_subtitle', true);
	$description = get_post_meta($id, 'products_description', true);

	$shades = get_post_meta($id, 'products_shades', true);

	$before_img = wp_get_attachment_image_src( get_post_meta($id, 'products_before_img', true), 'full' );
	$before_imgSrc = $before_img[0];
	$after_img = wp_get_attachment_image_src( get_post_meta($id, 'products_after_img', true), 'full' );
	$after_imgSrc = $after_img[0];

	$what_it_does = get_post_meta($id, 'products_what_it_does', true);
	$whats_in_it = get_post_meta($id, 'products_whats_in_it', true);
	$whats_not_in_it = get_post_meta($id, 'products_whats_not_in_it', true);
	$directions = get_post_meta($id, 'products_directions', true);
	$ingredients = get_post_meta($id, 'products_ingredients', true);

	$video_thumbnail = wp_get_attachment_image_src( get_post_meta($id, 'products_video_thumbnail', true), 'full' );
	$video_thumbnailSrc = $video_thumbnail[0];
	$video_embed = get_post_meta($id, 'products_video_embed', true);

	$dual_feature = wp_get_attachment_image_src( get_post_meta($id, 'products_dual_feature', true), 'full' );
	$dual_featureSrc = $dual_feature[0];

?>

<link href="<?php bloginfo('template_directory'); ?>/css/style-product.css" rel="stylesheet" type="text/css">
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>

<section class="product">
	
	<div id="feature">		
		<div class="container">
			<div class="hold">
				<div class="image">
					<img src="<?php echo $header_imgSrc; ?>"/>
				</div>
				<div class="productShot">
					<img src="<?php echo $featured_imgSrc; ?>"/>
					<h1 class="title"><?php the_title(); ?></h1>
					<h2 class="subTitle"><?php echo $subtitle; ?></h2>
					<h3 class="description"><?php echo $description; ?></h3>
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
				<?php foreach($shades as $shade){ 

					$shade_img = wp_get_attachment_image_src( $shade["image"], 'full' );
					$shade_imgSrc = $shade_img[0];

					?>
					<li>
						<span class="colorName"><?php echo $shade["name"]; ?></span>
						<span class="commonText">matches hair color:</span>
						<img src="<?php echo $shade_imgSrc; ?>"/>
					</li>
				<?php } ?>
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

			<a href="find-a-salon" class="btn_salon">Find a Salon</a>
		</div>
	</div>

	<div id="video">
		<div class="container">
			<div class="embed" data-id="<?php echo $video_embed; ?>">
				<img src="<?php echo $video_thumbnailSrc; ?>"/>
				<div class="play"></div>
				<div class="hold"></div>
			</div>
		</div>
	</div>

	<div id="dualFeature">
		<div class="container">
			<div class="image">
				<img src="<?php echo $dual_featureSrc; ?>"/>
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
				var hold = el.parent().find('.hold');
				var videoId = el.parent().attr('data-id');
				var iframe = '<iframe src="https://player.vimeo.com/video/'+videoId+'?wmode=transparent&amp;autoplay=1" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
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










