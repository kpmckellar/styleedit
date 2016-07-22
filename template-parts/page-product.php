<?php

	/* Template Name: Product */

	get_header();

?>

	<!-- Page content START -->
	
	<link href="<?php bloginfo('template_directory'); ?>/css/style-product.css" rel="stylesheet" type="text/css">

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

		<section id="products">
			
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
				
				<h2 class="heading"><?php the_title(); ?>:</h2>
	
				<?php

					$product_arguments = array( 'post_type' => 'products', 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => -1 );
					$queue_product = new WP_Query( $product_arguments );
					
					if ( $queue_product->have_posts() ) :
						while ( $queue_product->have_posts() ) : $queue_product->the_post(); 
							$id = get_the_ID();				

				?>

					<div class="product">
						
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

					</div>

				<?php 
		
						endwhile;
					endif; 
					
					wp_reset_postdata();

				?>

			</div>

		</section>

	<?php 

		endwhile;

	?>	

	<!-- Page content END -->

<?php 

	get_footer();

?>