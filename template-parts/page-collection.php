<?php

	/* Template Name: Collection */

	get_header();

?>

	<!-- Page content START -->

	<?php
		
		while ( have_posts() ) : the_post();
			$id = get_the_ID();			

	?>

		<section id="collection">
								
			<div id="logo">
				<h1>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo('name'); ?></a>
				</h1>
			</div>

			<div class="group">

				<ul>
					<li class="product spacer">
						<img src="<?php bloginfo('template_directory'); ?>/img/spacer.jpg"/>
						<div class="overlay"></div>
					</li>
					<?php

						$product_arguments = array( 'post_type' => 'products', 'orderby' => 'date', 'order' => 'ASC', 'posts_per_page' => -1 );
						$queue_product = new WP_Query( $product_arguments );
						
						if ( $queue_product->have_posts() ) :
							while ( $queue_product->have_posts() ) : $queue_product->the_post(); 
								$id = get_the_ID();
								$featured_img = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full' );
								$featured_imgSrc = $featured_img[0];
								$category = get_post_meta($id, 'products_category', true);

					?>

						<li class="product">
							
							<img src="<?php echo $featured_imgSrc; ?>"/>

							<div class="rollover">
								<div class="center">
									<div class="cell">
										<h1 class="title">
											<a href="<?php the_permalink(); ?>"><?php echo $category; ?></a>
										</h1>
										<h2 class="subTitle">
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</h2>
									</div>
								</div>
								<div class="enter">
									<a href="<?php the_permalink(); ?>"><?php echo __('more info','styleedit'); ?></a>
								</div>
							</div>

							<a href="<?php the_permalink(); ?>" class="topLink"></a>					

						</li>

					<?php 
			
							endwhile;
						endif; 
						
						wp_reset_postdata();

					?>

				</ul>

			</div>

		</section>

	<?php 

		endwhile;

	?>	

	<!-- Page content END -->

<?php 

	get_footer();

?>