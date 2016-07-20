jQuery(function($) {

///////////////////////////////////////////////////////////////////
///// META BOXES JS
///////////////////////////////////////////////////////////////////


	// function my_check_categories(){
 //       $('.post-php #normal-sortables .postbox, .post-new-php #normal-sortables .postbox').hide();
 //       $('#videosmetadata, #featuredvideos').show();
 //       $('#contacts').show();
 //       $('#categorychecklist input[type="checkbox"]').each(function(i,e){
 //           var id = $(this).attr('id').match(/-([0-9]*)$/i);
 //           id = (id && id[1]) ? parseInt(id[1]) : null ;
 //           if ($.inArray(id, [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]) > -1 && $(this).is(':checked')){
 //           		var cat = $(this).parent('label').text();
 //           		var editcat = cat.replace(/ /g,'').toLowerCase();
 //               $('#'+editcat).show();
 //           }
 //       });
 //   }		
 //   $('#categorychecklist input[type="checkbox"]').live('click', my_check_categories);
 //   my_check_categories();
 
 	jQuery('.repeatable-add').live('click', function() {
	    var field = jQuery(this).closest('td').find('.custom_repeatable li:last').clone(true);
	    var fieldLocation = jQuery(this).closest('td').find('.custom_repeatable li:last');
	    field.find('input.regular-text, textarea, select').val('');
	    
	    field.find('input, textarea, select').val('').attr('name', function(index, name) {
		    return name.replace(/(\d+)/, function(fullMatch, n) {
		    	return Number(n) + 1;
		    });
		});
		
	    field.insertAfter(fieldLocation, jQuery(this).closest('td'));
	    var fieldsCount = jQuery('.repeatable-remove').length;
		if( fieldsCount > 1 ) {
		    jQuery('.repeatable-remove').css('display','inline');
		}
	    return false;
	});
	 
	jQuery('.repeatable-remove').live('click', function() {
	    jQuery(this).parent().remove();
	    var fieldsCount = jQuery('.repeatable-remove').length;
		if( fieldsCount == 1 ) {
		    jQuery('.repeatable-remove').css('display','none');
		}
	    return false;
	});
	     
	jQuery('.custom_repeatable').sortable({
	    opacity: 0.6,
	    revert: true,
	    cursor: 'move',
	    handle: '.sort'
	});
	
	// the upload image button, saves the id and outputs a preview of the image
	var imageFrame;
	$('.rg-mid_upload_image_button').live('click', function(event) {
		event.preventDefault();
		
		var options, attachment;
		
		$self = $(event.target);
		$div = $self.closest('div.rg-mid_image');
		
		// if the frame already exists, open it
		if ( imageFrame ) {
			imageFrame.open();
			return;
		}
		
		// set our settings
		imageFrame = wp.media({
			title: 'Choose Image',
			multiple: true,
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
				
				$div.find('.rg-mid_preview_image').attr('src', src);
				$div.find('.rg-mid_upload_image').val(id);
			} );
		});
		
		// open the frame
		imageFrame.open();
	});
	
	// the remove image link, removes the image id from the hidden field and replaces the image preview
	$('.rg-mid_clear_image_button').live('click', function() {
		var defaultImage = $(this).parent().siblings('.rg-mid_default_image').text();
		$(this).parent().siblings('.rg-mid_upload_image').val('');
		$(this).parent().siblings('.rg-mid_preview_image').attr('src', defaultImage);
		return false;
	});
	
	// function to create an array of input values
	function ids(inputs) {
		var a = [];
		for (var i = 0; i < inputs.length; i++) {
			a.push(inputs[i].val);
		}
		//$("span").text(a.join(" "));
    }
	// repeatable fields
	$('.toggle').on("click", function() { 
		console.log($(this).parent().siblings().toggleClass('closed'));
	});
	
	$('.meta_box_repeatable_add').live('click', function(e) {
		e.preventDefault();
		// clone
		var row = $(this).closest('.meta_box_repeatable').find('tbody tr:last-child');
		var clone = row.clone();
		var defaultImage = clone.find('.meta_box_default_image').text();
		clone.find('select.chosen').removeAttr('style', '').removeAttr('id', '').removeClass('chzn-done').data('chosen', null).next().remove();
		clone.find('input.regular-text, textarea, select').val('');
		clone.find('.meta_box_preview_image').attr('src', defaultImage).removeClass('loaded');
		clone.find('input[type=checkbox], input[type=radio]').attr('checked', false);
		row.after(clone);
		// increment name and id
		clone.find('input, textarea, select').attr('name', function(index, name) {
				return name.replace(/(\d+)/, function(fullMatch, n) {
					return Number(n) + 1;
				});
			});
		var arr = [];
		$('input.repeatable_id:text').each(function(){ arr.push($(this).val()); }); 
		clone.find('input.repeatable_id')
			.val(Number(Math.max.apply( Math, arr )) + 1);
		if (!!$.prototype.chosen) {
			clone.find('select.chosen')
				.chosen({allow_single_deselect: true});
		}
	});
	
	$('.meta_box_repeatable_remove').live('click', function(e){
		e.preventDefault();
		$(this).closest('tr').remove();
	});
		
	$('.meta_box_repeatable tbody').sortable({
		opacity: 0.6,
		revert: true,
		cursor: 'move',
		handle: '.hndle'
	});
	
	// post_drop_sort	
	$('.sort_list').sortable({
		connectWith: '.sort_list',
		opacity: 0.6,
		revert: true,
		cursor: 'move',
		cancel: '.post_drop_sort_area_name',
		items: 'li:not(.post_drop_sort_area_name)',
        update: function(event, ui) {
			var result = $(this).sortable('toArray');
			var thisID = $(this).attr('id');
			$('.store-' + thisID).val(result) 
		}
    });

	$('.sort_list').disableSelection();

	// turn select boxes into something magical
	if (!!$.prototype.chosen)
		$('.chosen').chosen({ allow_single_deselect: true });


});