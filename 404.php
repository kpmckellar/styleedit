<?php 
	
	get_header(); 

?>	

	<link href="<?php bloginfo('template_directory'); ?>/css/style-404.css" rel="stylesheet" type="text/css">

	<section class="error-404 not-found">

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
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo('name'); ?></a>
				</h1>
			</div>

		</div>

		<div class="copy">
			
			<h2 class="heading"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'styleedit' ); ?></h2>

			<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'styleedit' ); ?></p>

		</div>			
						
	</section><!-- .error-404 -->

<?php

	get_footer();