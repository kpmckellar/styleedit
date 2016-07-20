<?php
/*/////////////////////////////////////////////////////
	* Creates Admin Panel in dashboard settings page
	* Includes admin-panel.php
/////////////////////////////////////////////////////*/
add_action( 'init', '_customAdminOptions' );

function _customAdminOptions(){
    global $post_settings, $post_types_options, $plugins_options, $post_video_options, $custom_fields;
    
	if ( ! ( current_user_can( 'administrator' ) || current_user_can( 'developer' )) )
	    	return;
				
    require_once( CUSTOM_DIR . '/admin-panel.php' );
    	
    $prefix = 'custom_';

    $custom_fields = array(
		array(
		 	'id'	=> $prefix.'options_social',
		 	'type'	=> 'section',
		 	'label' => __( 'Social Options', CUSTOM_LOCALE )
		),
		array(
			'desc'  => ' The Facebook url.',
		 	'id'	=> $prefix.'facebook_url',
		 	'type'	=> 'text',
		 	'label' => __( 'Facebook URL', CUSTOM_LOCALE )
		),
		array(
			'desc'  => ' The Twitter url.',
		 	'id'	=> $prefix.'twitter_url',
		 	'type'	=> 'text',
		 	'label' => __( 'Twitter URL', CUSTOM_LOCALE )
		),
		array(
			'desc'  => ' The Instagram url.',
		 	'id'	=> $prefix.'instagram_a',
		 	'type'	=> 'text',
		 	'label' => __( 'Instagram URL', CUSTOM_LOCALE )
		),
		array(
			'desc'  => ' The YouTube url.',
		 	'id'	=> $prefix.'youtube_url',
		 	'type'	=> 'text',
		 	'label' => __( 'YouTube URL', CUSTOM_LOCALE )
		)
	);
}
?>