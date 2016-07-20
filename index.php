<?php

	get_header(); 

?>

	<!-- Homepage slider START -->

	<!-- Homepage styles -->
	<link href="<?php bloginfo('template_directory'); ?>/css/style-home.css" rel="stylesheet" type="text/css">

	<section id="homeSlider">
		
		<div class="slide">
		
			<div class="text">
				
			</div>

		</div>

		<div id="logo">
			<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Style Edit</a></h1>
		</div>

	</section>

	<!-- Owl Carousel -->
	<link href="<?php bloginfo('template_directory'); ?>/js/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css">
	<link href="<?php bloginfo('template_directory'); ?>/js/owl-carousel/owl.theme.css" rel="stylesheet" type="text/css">
	<script src="<?php bloginfo('template_directory'); ?>/js/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>

	<!-- Homepage slider END -->

<?php

	get_footer();
