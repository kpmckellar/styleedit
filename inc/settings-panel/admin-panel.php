<?php

/* -----------------------------------------
	Plugin Global Settings
----------------------------------------- */

global $custom_fields;

$tax = ($_GET['taxonomy'])? $_GET['taxonomy'] : 'category';
define('CUSTOM_TAXONOMY', $tax, true);


class custom_Admin_Options {

public function __construct() {
    add_action( 'admin_menu', array( $this, '_customsettingsMenu' ) );
    add_action( 'admin_init', array( $this, '_customregisterSettings' ) );
    //add_action( 'admin_init', array( $this, '_customprocesmformActions' ) );
    
    if (isset($_GET['page']) && ( $_GET['page'] == 'custom-settings') ){
		add_action( 'admin_enqueue_scripts', array( $this, '_customAdminScripts' ) );
		add_action( 'admin_head', array( $this, '_customaddCustomScripts' ) );
	}

}
	
public function _customdisplaySettings( $field, $meta = null, $repeatable = null ) {
	if ( ! ( $field || is_array( $field ) ) )
  		 	return;
  		 	
  	$value = isset( $field['value'] ) ? $field['value'] : null;
	$title = isset( $field['title'] ) ? $field['title'] : null;
	$type = isset( $field['type'] ) ? $field['type'] : null;
   	$options = isset( $field['options'] ) ? $field['options'] : null;
   	$width = isset( $field['width'] ) ? $field['width'] : null;
   	$label = isset( $field['label'] ) ? '<label for="'.$field['id'].'">'.$field['label'].'</label>' : null;
	$desc = isset( $field['desc'] ) ? '<span class="description">' . $field['desc'] . '</span>' : null;
	$rows = isset( $field['rows'] ) ? $field['rows'] : null;
	$cols = isset( $field['cols'] ) ? $field['cols'] : null;
	$post_type = isset( $field['post_type'] ) ? $field['post_type'] : null;
	$post_cat = isset( $field['post_cat'] ) ? $field['post_cat'] : null;
	$place = isset( $field['place'] ) ? $field['place'] : null;
	$placeholder = isset( $field['placeholder'] ) ? $field['placeholder'] : null;
	$size = isset( $field['size'] ) ? $field['size'] : null;
  	$repeatable_fields = isset( $field['repeatable_fields'] ) ? $field['repeatable_fields'] : null;
  	$group_fields = isset( $field['group_fields'] ) ? $field['group_fields'] : null;
  	$groups = isset( $field['users'] ) ? $field['users'] : null;
  	$default_color = isset( $field['default_color'] ) ? $field['default_color'] : null;
  	
  	$id = $name = isset( $field['id'] ) ? 'custom_options['.$field['id'].']' : null;

  	if ( $repeatable ) {		
		$name = $repeatable[0].'['.$repeatable[1].']['.$repeatable[2].']';
		$id = $repeatable[0] . '_' . $repeatable[1] . '_' . $field['id'];
  	}

   switch($type) {
      // text
      case 'text':
      	echo '<input type="'.$type.'" name="'.$name.'" id="'.$id.'" value="'.$meta.'" '.($placeholder ? 'placeholder="'.$placeholder.'"' : '').' class="regular-text" '.($width ? 'style="width:'.$width.';"' : '').' size="30" />';
      	if($desc){ echo '<br/>'.$desc; }
      break;
      // editor
	  case 'editor':
	      echo wp_editor( $meta, $id, $settings ) . '<br />' . $desc;
	  break;
      // text
      case 'password':
         echo '<input type="password" name="'.$name.'" id="'.$id.'" value="'.$meta.'" size="30" class="regular-text" />'.$desc;
      break;
      // textarea
      case 'textarea':
         echo '<textarea name="'.$name.'" id="'.$id.'" cols="60" rows="4" placeholder="'.$placeholder.'">'.$meta.'</textarea>
         	<br />'.$desc;
      break;
      // checkbox
      case 'checkbox':
      	 echo '<div class="checkbox" style="padding:10px 0;">';
         echo '<input type="checkbox" value="'.($meta != '' ? 'true' : 'false').'" name="'.$name.'" id="'.$id.'" ',$meta != '' ? ' checked="checked"' : '',' />
         	<label for="custom_options['.$field['id'].']"><span class="description">'.$field['desc'].'</span></label>';
         echo '</div>';
      break;
      // value checkbox
		case 'value_checkbox':
			echo '<div class="checkbox" style="padding:10px 0;">';
			echo '<input type="checkbox" name="'.$name.'" id="'.$id.'" ',$meta != '' ? ' checked="checked"' : '',' value="'.$value.'"/>
			<label for="custom_options['.$field['id'].']"><span class="description">'.$field['desc'].'</span></label>';
			echo '</div>';
		break;
      // select, chosen
	  case 'select':
	  case 'chosen':
	      echo '<select name="'.$name.'" id="'.$id.'"' , $type == 'chosen' ? ' class="chosen"' : '' , isset( $multiple ) && $multiple == true ? ' multiple="multiple"' : '' , '>
	      		<option value="">Select One</option>'; // Select One
	      foreach ( $options as $option )
	      	  echo '<option' . selected( $meta, $option['value'], false ) . ' value="'.$option['value'].'">' . $option['label'] . '</option>';
	      echo '</select>';
	      if($desc){ echo '<br />' . $desc; }
	  break;
      // radio
      case 'radio':
         foreach ( $field['options'] as $option ) {
         	echo '<input type="radio" name="'.$name.'" id="custom_options['.$option['value'].']" value="'.$option['value'].'" ',$meta == $option['value'] ? ' checked="checked"' : '',' />
         			<label for="'.$option['value'].'">'.$option['label'].'</label><br />';
         }
         echo $desc;
      break;
      // checkbox_group
      case 'checkbox_group':
		 	foreach ($field['options'] as $option){
		 	    echo '<input type="checkbox" value="'.$option['value'].'" name="custom_options['.$field['id'].'][]" id="custom_options['.$option['value'].']"',$meta && in_array($option['value'], $meta) ? ' checked="checked"' : '',' />
		 	    		<label for="'.$option['value'].'">'.$option['label'].'</label><br />';
		 	}
         echo $desc;
      break;
      // tax_select
      case 'tax_select':
         echo '<select name="custom_options['.$field['id'].']" id="'.$id.'">
         		<option value="">-- '.__('Select', CUSTOM_LOCALE).' --</option>'; // Select One
         $terms = get_terms($field['id'], 'get=all');
         $selected = wp_get_object_terms('', 'custom_options['.$field['id'].']');
         foreach ($terms as $term) {
         	if ($selected && $term->slug == $meta )
         		echo '<option value="'.$term->slug.'" selected="selected">'.$term->name.'</option>';
         	else
         		echo '<option value="'.$term->slug.'">'.$term->name.'</option>';
         }
         $taxonomy = get_taxonomy($field['id']);
         echo '</select><br /><span class="description"><a href="'.get_bloginfo('home').'/wp-admin/edit-tags.php?taxonomy='.$field['id'].'">'.__('Manage', 'rg').' '.$taxonomy->label.'</a></span>';
      break; 
      // post_select, post_chosen
	  case 'post_select':
		case 'post_list':
		case 'post_chosen':
			echo '<select data-placeholder="Select One" name="' . esc_attr( $name ) . '[]" id="' . esc_attr( $id ) . '"' , $type == 'post_chosen' ? ' class="chosen"' : '' , isset( $multiple ) && $multiple == true ? ' multiple="multiple"' : '' , '>
					<option value=""></option>'; // Select One
			if( isset($post_cat) ):
				$category = get_posts( array( 'category_name' => $post_cat, 'posts_per_page' => -1, 'orderby' => 'name', 'order' => 'ASC' ) );
				foreach ( $category as $item ):
					echo '<option value="'.$item->ID.'"'.selected( is_array( $meta ) && in_array( $item->ID, $meta ), true, false ).'>'.$item->post_title.'</option>';
				endforeach;
				$post_type_object = get_post_type_object( $post_cat );
				mf($post_type_object);
				$postsurl = admin_url( 'edit.php' );
			endif;
			
			if( isset($post_type) ):
				$posts = get_posts( array( 'post_type' => $post_type, 'posts_per_page' => -1, 'orderby' => 'name', 'order' => 'ASC' ) );
				foreach ( $posts as $item ):
					echo '<option value="'.$item->ID.'"'.selected( is_array( $meta ) && in_array( $item->ID, $meta ), true, false ).'>'.$item->post_title.'</option>';
				endforeach;
				$post_type_object = get_post_type_object( $post_type );
				$postsurl = admin_url( 'edit.php?post_type='.$post_type );
			endif;
			
			echo '</select> &nbsp;<span class="description">'.$desc.' &nbsp;<a href="'.$postsurl.'">Manage '.$post_type_object->label.' Posts</a></span>';
		break; 
      // date
      case 'date':
         echo '<input type="text" class="date-'.$field['id'].'" name="'.$name.'" id="'.$id.'" value="'.$meta.'" size="30" />
         		<span class="description">'.$field['desc'].'</span>';
      break;
      //date format
      case 'format_date':
			echo '<input type="text" class="datepicker" name="'.$name.'" id="'.$id.'" value="' . $meta . '" style="width:'.esc_attr( $width ).';" size="30" />
			<p>Format options:<br>
			  <select id="format">
			    <option value="mm/dd/yy">Default - mm/dd/yy</option>
			    <option value="yy-mm-dd">ISO 8601 - yy-mm-dd</option>
			    <option value="d M, y">Short - d M, y</option>
			    <option value="d MM, y">Medium - d MM, y</option>
			    <option value="DD, d MM, yy">Full - DD, d MM, yy</option>
			    <option value="&apos;day&apos; d &apos;of&apos; MM &apos;in the year&apos; yy">With text - "day" d "of" MM "in the year" yy</option>
			  </select>
			</p>
					<br />' . $field['desc'];
		break;
		//timepicker
		case 'timepicker':
			echo '<input type="text" name="'.$name.'" id="'.$id.'-'.$repeatable[0].'" value="'.esc_attr( $meta ).'" class="rg-timepicker" style="width:'.esc_attr( $width ).';" size="30" />';
		break;
      // image
	  case 'image':
	      $image = CUSTOM_URL . '/images/usa-icon.png';	
	      echo '<div class="rg-custom_image" style="overflow:hidden;padding:0 0 0 10px">
	      		<span class="rg-custom_default_image" style="display:none">' . $image . '</span>';
	      if ( $meta ) { $image = wp_get_attachment_image_src( intval( $meta ), 'medium' ); }				
	      echo	'<input name="'.$name.'" type="hidden" class="rg-custom_upload_image" value="' . intval( $meta ) . '" style="width:'.$width.';" />
	      	     <img src="'.($meta ? $image[0] : $image).'" class="rg-custom_preview_image" style="display:block;max-width:300px;margin-bottom:10px;" />
	      		 <a href="#" class="rg-custom_upload_image_button button" rel="' . get_the_ID() . '" style="vertical-align:middle;">Choose Image</a>&nbsp;&nbsp;
	      		 <small style="vertical-align:middle;"><a href="#" class="rg-custom_clear_image_button">Remove Image</a></small>
	      	   </div>' . $desc;
	  break;
      // repeatable
      case 'repeatable':
		    echo '<a class="repeatable-add button-primary" href="#">Add Field</a>
		            <ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
		    $i = 0;
		    if ( $meta == '' || $meta == array() ) {
			    $keys = wp_list_pluck( $repeatable_fields, 'id' );
			    $meta = array ( array_fill_keys( $keys, null ) );
			}
			$meta = array_values( $meta );
		    foreach( $meta as $value ):
		    	$p = 0;
		    	echo '<li class="r-row">';
		    		//echo '<span class="sort hndle">|||</span>';
					foreach($repeatable_fields as $repeatable_field):
						//echo '<label class="label">'.$repeatable_field['id'].'</label>';
					    echo $this->_customdisplaySettings( $repeatable_field, $meta[$i][$p++], array( $id, $i ) );
					endforeach;
			    	echo '<div class="repeatable-remove button" href="#">-</div>';
			    echo '</li>';
			    $i++;
		    endforeach;
		    echo '</ul>';
		    echo $desc;
		break;
		
      // colorpicker
	  case 'color':
	       echo '<input type="text" name="'.esc_attr( $name ).'" id="colorpicker-'.$field['id'].'" value="'.$meta.'" '.($default_color ? 'data-default-color="'.$default_color.'"' : '').' />
	       	<br />' . $desc;
	       echo '<script type="text/javascript">
	       	jQuery(function($){
	       		var colorOptions = {
	       		    defaultColor: true,
	       		    palettes: false
	       		};
	       		jQuery("#colorpicker-'.$field['id'].'").wpColorPicker(colorOptions);
	       	});
	       	</script>';
	   break;
	  
	  // slider
	  case 'slider':
      	 $value = $meta != '' ? $meta : '0';
         echo '<div id="'.$field['id'].'-slider"></div>
         		<input type="text" name="'.$name.'" id="'.$field['id'].'" min="'.$field['min'].'" max="'.$field['max'].'" '.($field['step'] ? 'step='.$field['step'] : '').' value="'.$value.'" size="5" '.($width ? 'style="width:'.$width.';"' : '').' />
         		<br /><span class="description">'.$field['desc'].'</span>';
	   	echo '<script type="text/javascript">
	     	jQuery(function(jQuery) {
	   			jQuery("#'.$field['id'].'-slider").slider({
	   				value: ' . $value . ',
	   				min: ' . $field['min'] . ',
	   				max: ' . $field['max'] . ',';
	   				if($field['step']){ echo 'step: ' . $field['step'] . ','; }
	   				echo 'slide: function( event, ui ) {
	   					jQuery( "#'.$field['id'].'" ).val( ui.value );
	   				}
	   			});
	   		});
	   		</script>';
      break;
	  // group of fields
	  case 'input_group':
	      echo '<ul id="'.$id.'-group" class="admin_group">';
	      $i = 0;
		  if ( $meta == '' || $meta === array() ) {
		      $keys = wp_list_pluck( $group_fields, 'id' );
		      $meta = array ( array_fill_keys( $keys, null ) );
		  }
		  $meta = array_values( $meta );
		  foreach( $meta as $value ):
		  	  $p = 0;
		  	  foreach($group_fields as $group_field ):
		  	    echo '<li class="r-row">';
		  	      echo '<label>'.$group_field['label'].'</label>';
		  	      echo $this->_customdisplaySettings( $group_field, $meta[$i][$p++], array( $id, $i ) );
		  	    echo '</li>';
		  	  endforeach;
		  	  $i++;
		  endforeach;
	      echo '</ul>';
		  echo $desc;
	  break;
	  // spinnerslider
      case 'spinnerslider':
      $value = $meta != '' ? $meta : '0';
         echo '<div id="'.$field['id'].'-slider"></div>
         		<input type="text" name="'.$name.'" id="'.$field['id'].'" min="'.$field['min'].'" max="'.$field['max'].'" '.($field['step'] ? 'step='.$field['step'] : '').' value="'.$value.'" size="5" />
         		<br /><span class="description">'.$field['desc'].'</span>';
	   	echo '<script type="text/javascript">
	     	jQuery(function(jQuery) {
	     		function updateSpin() {
  				  var opts = {};
  				   					  
  				  jQuery(".admin_group input[min]").each(function() {
  				    opts[this.id] = parseFloat(this.value);
  				    jQuery( "#"+this.id ).val( opts[this.id] );
  				  });
  				  jQuery("#spinpreview").spin(opts);
  				  console.log(opts);
  				}
  				updateSpin();
	   			jQuery("#'.$field['id'].'-slider").slider({
	   				value: ' . $value . ',
	   				min: ' . $field['min'] . ',
	   				max: ' . $field['max'] . ',';
	   				if($field['step']){ echo 'step: ' . $field['step'] . ','; }
	   				echo 'slide: function( event, ui ) {
	   					jQuery( "#'.$field['id'].'" ).val( ui.value );
	   				},
	   				change: function(event, ui) {
					    console.log(ui.value);
					    updateSpin();
					}
	   			});
	   		});
	   		</script>';
      break;
	  
	  case 'preview':
	  	  $meta = get_option( 'custom_options' );
	  	  //'.$meta['store_loading_spinner'][0][8].'
	  	  echo '<div id="spinpreview"></div>';
	  	  echo '<script type="text/javascript">
	  	  		jQuery.fn.spin = function(opts) {
  				  this.each(function() {
  				    var $this = jQuery(this),
  				        data = $this.data();
  					
  				    if (data.spinner) {
  				      data.spinner.stop();
  				      delete data.spinner;
  				    }

  				    if (opts !== false) {
  				      data.spinner = new Spinner(jQuery.extend({color: ["'.$meta['store_loading_spinner'][0][8].'", "'.$meta['store_loading_spinner'][0][9].'"], className: "spin", shadow: true, hwaccel: true }, opts)).spin(this);
  				    }
  				  });
  				  return this;
  				};
	   		</script>';
	  break;
      
   }//end switch

}

function _customhex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}

function _customfindFieldType( $needle, $haystack ) {
	foreach ( $haystack as $h )
		if ( isset( $h['type'] ) && $h['type'] == 'repeatable' )
			return $this->_customfindFieldType( $needle, $h['repeatable_fields'] );
		elseif ( isset( $h['type'] ) && $h['type'] == 'input_group' )
			return $this->_customfindFieldType( $needle, $h['group_fields'] );
		elseif ( ( isset( $h['type'] ) && $h['type'] == $needle ) || ( isset( $h['repeatable_type'] ) && $h['repeatable_type'] == $needle ) )
			return true;
	return false;
}

function _customfindRepeatableType( $needle = 'repeatable', $haystack ) {
	foreach ( $haystack as $h )
		if ( isset( $h['type'] ) && $h['type'] == $needle )
			return true;
	return false;
}

function _customvalidateThis($input) {
    $valid = array();
    // checks each input that has been added
    foreach($input as $key => $value){
    	// does a basic check to make sure that the database value is there
    	if(get_option($key === FALSE)){
    		// adds the field if its not there
    		add_option($key, $value);
    	} else {
    		// updates the field if its already there
    		update_option($key, $value);
    	}

    	// you have to return the value or WordPress will cry
    	$valid[$key] = $value;
    }
    // return it and prevent WordPress depression
    return $valid;
}

/* ----------------------------------------
* create the settings page layout
----------------------------------------- */

function _customdisplayPage() {
   global $custom_fields;
   $meta = get_option( 'custom_options' );

   echo '<div class="wrap" id="rg-mf">';
      	echo '<div class="icon"></div>';
      	echo '<h2>' . __( 'Style Edit Options', CUSTOM_LOCALE ) . '</h2>';
      	
      	if ( ! isset( $_REQUEST['settings-updated'] ) )
   			$_REQUEST['settings-updated'] = false;
   			
   		if( $_GET['page'] == 'custom-settings' && isset($_GET['all-transients-deleted']) ):
		    echo '<div class="updated fade below-h2"><p>All Transients Deleted</p></div>';
		elseif( $_GET['page'] == 'custom-settings' && isset($_GET['transient-deleted']) ):
			echo '<div class="updated fade below-h2"><p>'.$_REQUEST['transient'].' Transient Deleted</p></div>';
		endif;
   
      echo '<div class="has-right-sidebar">';
      	echo '<style>';
      		echo '#poststuff { width: 25% !important; overflow: hidden !important; float: right !important; min-width: 25% !important; }';
      	echo '</style>';
      	echo '<div id="poststuff">';
      		// echo $this->_customsidebarMenu();
      	echo '</div>';
      
      	echo '<div style="float: left; width: 75%;" >';
      		echo '<form method="post" action="options.php" class="custom_options_form">';
      			settings_fields('custom_options');
      			wp_nonce_field( basename(__FILE__), 'custom_Admin_Page_Class_nonce' );
      			
      			echo '<div id="section_container">';
      			echo '<table class="form-table rg-mf">';
						foreach ( $custom_fields as $field ) {
						   if ( $field['type'] == 'section' ) {
						   	echo '<tr class="' . $field['id'] . '">
						   			<td colspan="2">
						   				<h2 class="section-title">' . $field['label'] . '</h2>
						   			</td>
						   		</tr>';
						   } else {
						   	echo '<tr class="' . $field['id'] . '">
						   			<th style="width:15%"><label for="' . $field['id'] . '">' . $field['label'] . '</label></th>
						   			<td>';
						   			
						   			$meta = get_option( 'custom_options' );						   			

						   			echo $this->_customdisplaySettings( $field, $meta[$field['id']] );
						   			
						   	echo     '<td>
						   		</tr>';
						   }
						} // end foreach
						echo '</table>'; // end table
					echo '</div>';      			
      			echo '<p class="submit"><input name="Submit" type="submit" class="button-primary" value="'. __( 'Save Options', CUSTOM_LOCALE ). '" /></p>';
      		echo '</form>';
      	echo '</div>';
      	echo $this->_categoryOrderDisplayPage();
      echo '</div>';
   echo '</div>';
   
}

public function _customsettingsMenu() {
   add_menu_page( 'Style Edit Options', 'Style Edit Options', 'edit_posts', 'custom-settings', array( $this, '_customsettingsOptions' ), 'dashicons-admin-generic' );
}


function _customsettingsOptions(){
	if (!current_user_can('manage_options')) {
	  wp_die( __('You do not have sufficient permissions to access this page.') );
	} else {
		$this->_customdisplayPage();
	}
}


/* ----------------------------------------
* register the plugin settings
----------------------------------------- */

public function _customregisterSettings() {
	register_setting( 'custom_options', 'custom_options', array( $this, '_customvalidateThis' ) );
}



public function _categoryOrderGetSubCats($parentID){
  global $wpdb;
  
  $subCatStr = "";
  $results=$wpdb->get_results("SELECT t.term_id, t.name FROM $wpdb->term_taxonomy tt, $wpdb->terms t, $wpdb->term_taxonomy tt2 WHERE tt.parent = $parentID AND tt.taxonomy = '".CUSTOM_TAXONOMY."' AND t.term_id = tt.term_id AND tt2.parent = tt.term_id GROUP BY t.term_id, t.name HAVING COUNT(*) > 0 ORDER BY t.term_order ASC");
  foreach($results as $row):
  	$subCatStr = $subCatStr."<option value='$row->term_id'>$row->name</option>";
  endforeach;

  return $subCatStr;
}

public function _categoryOrderUpdateOrder(){
  if (isset($_POST['handleCategoryOrder']) && $_POST['handleCategoryOrder'] != ""): 
  	global $wpdb;
  	
  	$handleCategoryOrder = $_POST['handleCategoryOrder'];
  	$IDs = explode(',', $handleCategoryOrder);
  	$result = count($IDs);

  	for($i = 0; $i < $result; $i++){
  		$str = str_replace("id_", "", $IDs[$i]);
  		$wpdb->query("UPDATE $wpdb->terms SET term_order = '$i' WHERE term_id ='$str'");
  	}
  	return '<div id="message" class="updated fade"><p>Categories updated successfully</p></div>';
  else:
  	return '<div id="message" class="updated fade"><p>An error occurred, order has not been saved.</p></div>';
  endif;
}

public function _categoryOrderCatQuery($parentID){
  global $wpdb;
  return $wpdb->get_results("SELECT * FROM $wpdb->terms t inner join $wpdb->term_taxonomy tt on t.term_id = tt.term_id WHERE taxonomy = '".CUSTOM_TAXONOMY."' and parent = $parentID ORDER BY term_order ASC");
}


public function _categoryOrderGetParentLink($parentID){
  if($parentID != 0):
  	return '<input type="submit" class="button" id="returnParent_btn" name="returnParent_btn" value="Return to parent category" />';
  else:
  	return '';
  endif;
}

public function _categoryOrderApplyOrderFilter($orderby, $args){
  if($args['orderby'] == 'order'):
  	return 't.term_order';
  else:
  	return $orderby;
  endif;
}

/* ----------------------------------------
* create the settings page layout
----------------------------------------- */

public function _categoryOrderDisplayPage() {
  global $wpdb;
  
  $parentID = 0;
  $wpdb->show_errors();
  $query1 = $wpdb->query("SHOW COLUMNS FROM $wpdb->terms LIKE 'term_order'");
  
  if ($query1 == 0) {
  	$wpdb->query("ALTER TABLE $wpdb->terms ADD `term_order` INT( 4 ) NULL DEFAULT '0'");
  }
  
  if (isset($_POST['subCategory_btn'])) { 
  	$parentID = $_POST['cats'];
  }
  elseif (isset($_POST['parentID'])) { 
  	$parentID = $_POST['parentID'];
  }

  if (isset($_POST['returnParent_btn'])) { 
  	$parentsParent = $wpdb->get_row("SELECT parent FROM $wpdb->term_taxonomy WHERE term_id = " . $_POST['parentID'], ARRAY_N);
  	$parentID = $parentsParent[0];
  }

  $success = '';
  if (isset($_POST['orderCategory_btn'])) { 
  	$success = $this->_categoryOrderUpdateOrder();
  }

  $subCatStr = $this->_categoryOrderGetSubCats($parentID);
}

/* ----------------------------------------
* register scripts & styles
----------------------------------------- */
public function _customAdminScripts() {
	global $custom_fields;
	if( is_admin() && isset($_GET['page']) && ( $_GET['page'] == 'custom-settings' ) ) {
	
		$deps = array( 'jquery' );
		wp_enqueue_media();
		
		if ( $this->_customfindFieldType( 'spinnerslider', $custom_fields ) || $this->_customfindFieldType( 'slider', $custom_fields ) )
			wp_enqueue_script('jquery-ui-slider');
			wp_enqueue_script('spinner', CUSTOM_URL . '/js/spin.js', $deps, true);
			
		if ( $this->_customfindFieldType( 'repeatable', $custom_fields ) || $this->_customfindFieldType( 'input_group', $custom_fields ) )
			wp_enqueue_script('jquery-ui-sortable');
		
		wp_enqueue_script('thickbox', null, $deps );
		wp_enqueue_script('wp-color-picker');
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('chosen', CUSTOM_URL . '/js/chosen.js', $deps, true );
		wp_enqueue_script('admin-js', CUSTOM_URL . '/js/custom-admin.js', $deps, true);
		
		wp_enqueue_style('thickbox');
		wp_enqueue_style('wp-color-picker');
		wp_enqueue_style('chosen-css', CUSTOM_URL. '/css/chosen.css' );
		wp_enqueue_style('admin-css', CUSTOM_URL . '/css/admin-panel.css');
		wp_enqueue_style('jquery-ui', '//ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css');		
	}
}  	

public function _customaddCustomScripts() {
   global $custom_fields;
   
   $meta = get_option( 'custom_options' );
   
   $output = '<script type="text/javascript">
   			jQuery(function($){';
   			
   foreach ( $custom_fields as $field ) {
	   switch( $field['type'] ) {
	   	case 'format_date' :
		    echo '$( "#' . $field['id'] . '" ).datepicker();
    	    	  $( "#format" ).change(function() {
    	    	    $( "#' . $field['id'] . '" ).datepicker( "option", "dateFormat", $( this ).val() );
    	    	  });';
		break;
		case 'date' :
		    echo '$("#' . $field['id'] . '").datepicker({
		     		dateFormat: mm/dd/yy
		     	});';
		break;
	   	// timepicker
		case 'timepicker' :
		    echo '$("input#'.$field['id'].'").timepicker({
		    			timeFormat: "hh:mm tt"
		    	  })';
		break;
	   }
	}		
   $output .= '});
   	</script>';

   echo $output;
}

}

new custom_Admin_Options;

?>