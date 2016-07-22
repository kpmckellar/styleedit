<?php

	/* Template for displaying single product */

?>

<link href="<?php bloginfo('template_directory'); ?>/css/style-product.css" rel="stylesheet" type="text/css">

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
			<h3 class="title">available in x shades</h3>
			<ul>
				<li>
					<span class="colorName">dark blonde</span>
					<span class="commonText">matches hair color:</span>
					<img src="<?php bloginfo('template_directory'); ?>/img/shade.png"/>
				</li>
				<li>
					<span class="colorName">dark blonde</span>
					<span class="commonText">matches hair color:</span>
					<img src="<?php bloginfo('template_directory'); ?>/img/shade.png"/>
				</li>
				<li>
					<span class="colorName">dark blonde</span>
					<span class="commonText">matches hair color:</span>
					<img src="<?php bloginfo('template_directory'); ?>/img/shade.png"/>
				</li>
			<lu>
		</div>
	</div>

	<div id="details">
		<div class="container">
			
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
			<img src="<?php bloginfo('template_directory'); ?>/img/dual-feature.jpg"/>
		</div>
	</div>

</section><!-- .no-results -->
