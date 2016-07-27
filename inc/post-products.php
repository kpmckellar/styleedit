<?php
add_action( 'init', 'post_products', 0 );
function post_products() {
    $labels = array(
		'name' => __( 'Products', 'styleedit' ),
		'singular_name' => __( 'Product', 'styleedit' ),
		'add_new' => __( 'Add New Product', 'styleedit' ),
		'add_new_item' => __( 'Add New Product', 'styleedit' ),
		'edit_item' => __( 'Edit Product', 'styleedit' ),
		'new_item' => __( 'New Product Post Item', 'styleedit' ),
		'view_item' => __( 'View Product', 'styleedit' ),
		'search_items' => __( 'Search Products', 'styleedit' ),
		'not_found' => __( 'Nothing found', 'styleedit' ),
		'not_found_in_trash' => __( 'Nothing found in Trash', 'styleedit' ),
		'parent_item_colon' => ''
	); 	
    $args = array( 
        'labels' => $labels, // adds your $labels array from above
		  'public' => true,
		  'publicly_queryable' => true,
		  'show_ui' => true,
		  'query_var' => true,
		  'capability_type' => 'post',
		  'hierarchical' => false,
		  'rewrite' => array( 'slug' => 'products' ), // changes name in permalink structure
		  'menu_icon' => 'dashicons-store',
		  'menu_position' => 4, // search WordPress Codex for menu_position parameters
		  'supports' => array( 'title', 'editor', 'thumbnail' )
    );
    register_post_type( 'products', $args ); // adds your $args array from above    
    // Register meta fields for slider
    function post_products_meta($current_screen){
		if ( 'products' == $current_screen->post_type && 'post' == $current_screen->base ) {
			$prefix = 'products_';			
			$fields = array(				
				array(
				    'label' => 'Header Image',
				    'desc'  => 'The image that will be displayed in the header beside the product shot.',
				    'id'    => $prefix.'header_img',			
				    'type'  => 'image'
				),
				array(
				    'label' => 'Product Category',
				    'desc'  => 'Text appearing above the product title.',
				    'id'    => $prefix.'category',			
				    'type'  => 'text'
				),
				array(
				    'label' => 'Product Description',
				    'desc'  => 'Text appearing under the product subtitle.',
				    'id'    => $prefix.'description',			
				    'type'  => 'text'
				),
				array(
				    'label' => 'Product Shades',
				    'desc'  => 'Repeatble shade fields.',
				    'id'    => $prefix.'shades',			
				    'type'  => 'repeatable',
				    'sanitizer' => array( // array of sanitizers with matching kets to next array
						'name' => 'sanitize_text_field'
					),
					'repeatable_fields' => array( // array of fields to be repeated
						'name' => array(
							'label' => 'Name',
							'desc'  => 'Name of the shade.',
							'id' => 'name',
							'type' => 'text'
						),
						'image' => array(
							'label' => 'Image',
							'desc'  => 'Image of shade samples.',
							'id' => 'image',
							'type' => 'image'
						)				
					)
				),
				array(
				    'label' => 'Before Image',
				    'desc'  => 'A shot of the hair before product.',
				    'id'    => $prefix.'before_img',
				    'type'  => 'image'
				),
				array(
				    'label' => 'After Image',
				    'desc'  => 'A shot of the hair after product.',
				    'id'    => $prefix.'after_img',
				    'type'  => 'image'
				),
				array(
				    'label' => 'What It Does',
				    'desc'  => 'The description of what a product does.',
				    'id'    => $prefix.'what_it_does',
				    'type'  => 'textarea'
				),
				array(
				    'label' => 'What\'s In It',
				    'desc'  => 'The description of what is in a product.',
				    'id'    => $prefix.'whats_in_it',
				    'type'  => 'textarea'
				),
				array(
				    'label' => 'What\'s NOT In It',
				    'desc'  => 'The description of what is not in a product.',
				    'id'    => $prefix.'whats_not_in_it',
				    'type'  => 'textarea'
				),
				array(
				    'label' => 'Directions',
				    'desc'  => 'The directions for how to use a product.',
				    'id'    => $prefix.'directions',
				    'type'  => 'textarea'
				),
				array(
				    'label' => 'Ingredients',
				    'desc'  => 'The description of product ingredients.',
				    'id'    => $prefix.'ingredients',
				    'type'  => 'textarea'
				),
				array(
				    'label' => 'Video Thumbnail',
				    'desc'  => 'Thumbnail image for the product video.',
				    'id'    => $prefix.'video_thumbnail',
				    'type'  => 'image'
				),
				array(
				    'label' => 'Video Embed',
				    'desc'  => 'Embed code for the product video.',
				    'id'    => $prefix.'video_embed',
				    'type'  => 'text'
				),
				array(
				    'label' => 'Dual Image Feature',
				    'desc'  => 'The image pair appearing at the bottom of the products page.',
				    'id'    => $prefix.'dual_feature',
				    'type'  => 'image'
				)
			);
			$products_box = new custom_add_meta_box( 'products_box', 'Product Options', $fields, 'products', true );
		}
	}
	add_action( 'current_screen', 'post_products_meta' );
}