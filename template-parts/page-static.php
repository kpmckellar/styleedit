<?php

	/* Template Name: Static */

	get_header();

?>

	<!-- Page content START -->

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

			$page_enable_locator = get_post_meta($id, 'page_enable_locator', true);

	?>

		<section id="static" class="<?php echo $post->post_name;?>">
			
			<div class="billboard">
				
				<style type="text/css" media="screen">
					.billboard {
						background-image: url(<?php echo $mobile_imgSrc; ?>);
					}
					@media only screen and (min-width: 481px) {
						.billboard {
							background-image: url(<?php echo $tablet_imgSrc; ?>);
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
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo('name'); ?></a>
					</h1>
				</div>

			</div>

			<div class="copy">
				
				<h2 class="heading"><?php the_title(); ?>:</h2>
	
				<?php the_content(); ?>				

			</div>

			<?php if( is_page('find-a-salon') && shortcode_exists( 'wpsl' )){ ?>
				
				<div id="locator">
					
					<?php if($page_enable_locator === on || $page_enable_locator === true){ 
						echo do_shortcode('[wpsl]'); 
					} ?>

				</div>

			<?php } ?>

		</section>

	<?php 

		endwhile;

	?>	

	<!-- Page content END -->

<?php 

	get_footer();

?>