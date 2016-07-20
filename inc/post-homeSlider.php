<?php
add_action( 'init', 'post_homeSlider', 0 );
function post_homeSlider() {
    $labels = array(
		'name' => __( 'Slider', 'styleedit' ),
		'singular_name' => __( 'Slider', 'styleedit' ),
		'add_new' => __( 'Add New Slide', 'styleedit' ),
		'add_new_item' => __( 'Add New Slide', 'styleedit' ),
		'edit_item' => __( 'Edit Slide', 'styleedit' ),
		'new_item' => __( 'New Slider Post Item', 'styleedit' ),
		'view_item' => __( 'View Slide', 'styleedit' ),
		'search_items' => __( 'Search Slides', 'styleedit' ),
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
		  'rewrite' => array( 'slug' => 'slider' ), // changes name in permalink structure
		  'menu_icon' => 'dashicons-slides',
		  'menu_position' => 4, // search WordPress Codex for menu_position parameters
		  'supports' => array( 'title', 'editor', 'thumbnail' )
    );
    register_post_type( 'slider', $args ); // adds your $args array from above
    // Register meta fields for slider
    function post_slider_meta($current_screen){
		if ( 'slider' == $current_screen->post_type && 'post' == $current_screen->base ) {
			$prefix = 'slide_';			
			$fields = array(				
				array(
				    'label' => 'Slide Tablet Image',
				    'desc'  => 'The image that will be displayed on tablet devices.',
				    'id'    => $prefix.'tablet_img',			
				    'type'  => 'image'
				),
				array(
				    'label' => 'Slide Mobile Image',
				    'desc'  => 'The image tht will be displayed on mobile devices.',
				    'id'    => $prefix.'mobile_img',
				    'type'  => 'image'
				)
			);
			$slider_box = new custom_add_meta_box( 'slider_box', 'Slide Options', $fields, 'slider', true );
		}
	}
	add_action( 'current_screen', 'post_slider_meta' );
}