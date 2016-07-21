<?php

	/* Template Name: Static */

	get_header();

?>

	<!-- Page content START -->
	
	<link href="<?php bloginfo('template_directory'); ?>/css/style-static.css" rel="stylesheet" type="text/css">

	<?php
		
		while ( have_posts() ) : the_post();
			$id = get_the_ID();
			// desktop image
			$desktop_img = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full' );
			$desktop_imgSrc = $desktop_img[0];
			// tablet image
			$tablet_img = wp_get_attachment_image_src( get_post_meta($id, 'page_tablet_img', true), 'full' );
			$tablet_imgSrc = $tablet_img[0];
			// mobile image
			$mobile_img = wp_get_attachment_image_src( get_post_meta($id, 'page_mobile_img', true), 'full' );
			$mobile_imgSrc = $mobile_img[0];

	?>

		<section id="static">
			
			<div class="billboard">
				
				<style type="text/css" media="screen">
					.billboard {
						background-image: url(<?php echo $mobile_imgSrc; ?>);
					}
					@media only screen and (min-width: 481px) {
						.billboard {
							background-image: url(<?php echo $desktop_imgSrc; ?>);
						}	
					}
					@media only screen and (min-width: 1025px) {
						.billboard {
							background-image: url(<?php echo $desktop_imgSrc; ?>);
						}	
					}
				</style>

				<div id="logo">
					<h1>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Style Edit</a>
					</h1>
				</div>

			</div>

			<div class="copy">
				
				<h2 class="heading"><?php echo __('our story', 'styleedit'); ?>:</h2>
	
				<?php the_content(); ?>				

			</div>

		</section>

	<?php 

		endwhile;

	?>	

	<!-- Page content END -->

<?php 

	get_footer();

?>