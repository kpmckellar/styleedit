jQuery(function($) {

// the upload image button, saves the id and outputs a preview of the image
	var imageFrame;
	$('.rg-miles_upload_image_button').live('click', function(event) {
		event.preventDefault();
		
		var options, attachment;
		
		$self = $(event.target);
		$div = $self.closest('div.rg-miles_image');
		
		// if the frame already exists, open it
		if ( imageFrame ) {
			imageFrame.open();
			return;
		}
		
		// set our settings
		imageFrame = wp.media({
			title: 'Choose Image',
			multiple: false,
			library: {
		 		type: 'image'
			},
			button: {
		  		text: 'Use This Image'
			}
		});
		
		// set up our select handler
		imageFrame.on( 'select', function() {
			selection = imageFrame.state().get('selection');
			
			if ( ! selection )
			return;
			
			// loop through the selected files
			selection.each( function( attachment ) {
				console.log(attachment);
				var src = attachment.attributes.sizes.full.url;
				var id = attachment.id;
				
				$div.find('.rg-miles_preview_image').attr('src', src);
				$div.find('.rg-miles_upload_image').val(id);
			} );
		});
		
		// open the frame
		imageFrame.open();
	});
	
	// the remove image link, removes the image id from the hidden field and replaces the image preview
	$('.rg-miles_clear_image_button').live('click', function() {
		var defaultImage = $(this).parent().siblings('.rg-miles_default_image').text();
		$(this).parent().siblings('.rg-miles_upload_image').val('');
		$(this).parent().siblings('.rg-miles_preview_image').attr('src', defaultImage);
		return false;
	});

});