<?php

	/* Template for displaying single product */
	
	$id = get_the_ID();

	$header_img = wp_get_attachment_image_src( get_post_meta($id, 'products_header_img', true), 'full' );
	$header_imgSrc = $header_img[0];
	$featured_img = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full' );
	$featured_imgSrc = $featured_img[0];
	$category = get_post_meta($id, 'products_category', true);
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

	$class = '';
	if($category == 'invisible dry shampoo'){
		$class = ' mod';
	}

?>

<section class="product">
	
	<div id="feature">		
		<div class="container">
			<div class="hold">
				<div class="image">
					<img src="<?php echo $header_imgSrc; ?>"/>
				</div>
				<div class="productShot">
					<img src="<?php echo $featured_imgSrc; ?>"/>
					<h1 class="title"><?php echo $category; ?></h1>
					<h2 class="subTitle<?php echo $class; ?>"><?php the_title(); ?></h2>
					<h3 class="description"><?php echo $description; ?></h3>
				</div>
			</div>
		</div>
		<div id="logo">
			<h1>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo('name'); ?></a>
			</h1>
		</div>
	</div>


	<?php if ($shades[0]["name"] != null) { ?>
		<div id="shades">
			<div class="container">
				<h3 class="title"><?php echo __('available in <span>x</span> shades','styleedit'); ?></h3>
				<ul>
					<?php foreach($shades as $shade){ 

						$shade_img = wp_get_attachment_image_src( $shade["image"], 'full' );
						$shade_imgSrc = $shade_img[0];

						?>
						<li>
							<span class="colorName"><?php echo $shade["name"]; ?></span>
							<span class="commonText"><?php echo __('matches hair color:','styleedit'); ?></span>
							<img src="<?php echo $shade_imgSrc; ?>"/>
						</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	<?php } ?>
	<div class="container clearfix<?php echo $class; ?>">
		
		<?php if ($before_imgSrc) { ?>
			<div class="beforeafter">
				<figure class="prod_img_before">
					<img src="<?php echo $before_imgSrc; ?>" />
				</figure><figure class="prod_img_after">
					<img src="<?php echo $after_imgSrc; ?>" />
				</figure>
			</div>
		<?php } ?>
		<div id="details">
			<div class="whatItDoes">
				<h3><?php echo __('what it does','styleedit'); ?></h3>
				<div>
					<p><?php echo $what_it_does; ?></p>
				</div>
			</div>
			
			<div id="accordion">
					
					<div>
						<h3><?php echo __('what’s in it','styleedit'); ?></h3>
						<div>
							<p><?php echo $whats_in_it; ?></p>
						</div>
					</div>
					
					<div>
						<h3><?php echo __('what’s NOT in it','styleedit'); ?></h3>
						<div>
							<p><?php echo $whats_not_in_it; ?></p>
						</div>
					</div>

					<div>
						<h3><?php echo __('directions','styleedit'); ?></h3>
						<div>
							<p><?php echo $directions; ?></p>
						</div>
					</div>

				<div id="wrapper_ingredients">
					<h3 id="ingredients_header"><?php echo __('ingredients','styleedit'); ?></h3>				
					<div id="ingredients_content">
						<img src="<?php bloginfo('template_directory'); ?>/img/ingredients_close.png" id="ingredients_close" />
						<p><?php echo $ingredients; ?></p>
					</div>
				</div>

			</div>

			<a href="find-a-salon" class="btn_salon"><?php echo __('Find a Salon','styleedit'); ?></a>
		</div>
	</div>
	
	<?php if ($video_thumbnailSrc) { ?>
		<div id="video">
			<div class="container">
				<div class="embed" data-id="<?php echo $video_embed; ?>">
					<img src="<?php echo $video_thumbnailSrc; ?>"/>
					<div class="play"></div>
					<div class="hold"></div>
				</div>
			</div>
		</div>
	<?php } ?>

	<div id="dualFeature">
		<div class="container">
			<div class="image">
				<img src="<?php echo $dual_featureSrc; ?>"/>
			</div>
		</div>
	</div>

</section><!-- .no-results -->










