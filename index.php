<?php

	get_header(); 

?>

	<!-- Homepage slider START -->

	<!-- Homepage styles -->
	<link href="<?php bloginfo('template_directory'); ?>/css/style-home.css" rel="stylesheet" type="text/css">

	<section id="homeSlider">
		
		<ul>

		<?php

			$slider_arguments = array( 'post_type' => 'slider', 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => -1 );
			$queue_slider = new WP_Query( $slider_arguments );
			
			if ( $queue_slider->have_posts() ) :
				while ( $queue_slider->have_posts() ) : $queue_slider->the_post(); 
					$id = get_the_ID();
					$fullSize_img = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full' );
					$fullSize_imgSrc = $fullSize_img[0]

		?>

			<li class="slide" style="background-image: url(<?php echo $fullSize_imgSrc; ?>);">
			
				<div class="text">
					<?php the_content(); ?>	
				</div>

			</li>

		<?php 
		
				endwhile;
			endif; 
			
			wp_reset_postdata();

		?>	 
			
		</ul>

		<div id="logo">
			<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Style Edit</a></h1>
		</div>

	</section>

	<!-- Owl Carousel -->
	<link href="<?php bloginfo('template_directory'); ?>/js/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css">
	<link href="<?php bloginfo('template_directory'); ?>/js/owl-carousel/owl.theme.css" rel="stylesheet" type="text/css">
	<script src="<?php bloginfo('template_directory'); ?>/js/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		(function($){
			if($('#homeSlider ul li').length > 1){
				$('#homeSlider ul').owlCarousel({
					items:1,			    
				    margin:0,
				    loop:true,
				    nav:false,
				    autoplay:true,
				    autoplayTimeout:2000
				});
			}
		})(jQuery);		
	</script>

	<!-- Homepage slider END -->

<?php

	get_footer();
