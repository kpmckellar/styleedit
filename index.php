<?php

	get_header(); 

?>

	<!-- Homepage slider START -->

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
					@media only screen and (max-width: 736px) and (orientation: landscape) {
						.slide<?php echo $id; ?> {
							background-image: url(<?php echo $desktop_imgSrc; ?>);
						}	
					}
					@media only screen and (max-width: 1024px) and (orientation: landscape) {
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

	<!-- Homepage slider END -->

<?php

	get_footer();
