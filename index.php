<?php

	get_header(); 

?>

	<!-- Homepage slider START -->

	<!-- Homepage styles -->
	<link href="<?php bloginfo('template_directory'); ?>/css/style-home.css" rel="stylesheet" type="text/css">

	<section id="homeSlider">
		
		<ul>

		<?php

			$slider_arguments = array( 'post_type' => 'slider', 'orderby' => 'date', 'order' => 'ASC', 'posts_per_page' => -1 );
			$queue_slider = new WP_Query( $slider_arguments );
			
			if ( $queue_slider->have_posts() ) :
				while ( $queue_slider->have_posts() ) : $queue_slider->the_post(); 
					$id = get_the_ID();
					// desktop image
					$desktop_img = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full' );
					$desktop_imgSrc = $desktop_img[0];
					// tablet image
					$tablet_img = wp_get_attachment_image_src( get_post_meta($id, 'slide_tablet_img', true), 'full' );
					$tablet_imgSrc = $tablet_img[0];
					// mobile image
					$mobile_img = wp_get_attachment_image_src( get_post_meta($id, 'slide_mobile_img', true), 'full' );
					$mobile_imgSrc = $mobile_img[0];

		?>			
			<li class="slide slide<?php echo $id; ?>">

				<style type="text/css" media="screen">
					.slide<?php echo $id; ?> {
						background-image: url(<?php echo $mobile_imgSrc; ?>);
					}
					@media only screen and (min-width: 481px) {
						.slide<?php echo $id; ?> {
							background-image: url(<?php echo $tablet_imgSrc; ?>);
						}	
					}
					@media only screen and (min-width: 1025px) {
						.slide<?php echo $id; ?> {
							background-image: url(<?php echo $desktop_imgSrc; ?>);
						}	
					}
				</style>	
			
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
			<h1>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Style Edit</a>
			</h1>
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
				    autoplayTimeout:4000,
				    responsive:{
				    	0:{
				    		autoplay:false
				    	},
				    	568:{
				    		autoplay:true
				    	}
				    }
				});
			}
		})(jQuery);		
	</script>

	<!-- Homepage slider END -->

<?php

	get_footer();
