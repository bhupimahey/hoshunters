<?php
$header = array('title' => 'Search Location');
$this->load->view('includes/header', $header);
?>
<style>
.edit-list-box {
	background-color: #fff;
	border: 1px solid #ddd;
	border-radius: 2px;
	margin-bottom: 20px;
	padding: 20px;
}
.edit-list-title {
	color: #263238;
	font-size: 18px;
	margin: 0;
}
.edit-list-title-text {
	color: #263238;
	font-size: 13px;
	margin: 0;
}
.row_address {
    display: flex;
    margin-bottom: 10px;
}

.row_address_new {
    display: flex;
    margin-bottom: 10px;
}

button {
    background: #4285f4;
    border-radius: 0;
    color: #fff;
    cursor: pointer;
}
input, button {
    font-family: Arial;
    font-size: 12px;
    border: 1px solid #4285f4;
    padding: 8px;
    outline: none;
}
</style>
<body>
<?php $this->load->view('includes/pages_inner_header'); ?>

<div class="full-row deshbord">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-1 col-xl-2 bg-primary">
       <?php $this->load->view('includes/sidebar');?>
      </div>
      <div class="col-md-11 col-xl-10 bg-gray">
        <div class="row">
          <div class="full-row deshbord_panel w-100 mb-5">
            <h4 class="color-primary mb-4">Looking for a home</h4>
            <?php $this->message_output->run(); ?>
            <div class="row massanger">
              <div class="col-md-12 col-xl-12">
                <div class="accordion mt_30">
                  <div class="card mb_20">
                    <div class="collapse show"style="">
                      <div class="card-body">
                        <div class="row">
                          <div id="about_person" class="col-lg-12">
                            <div class="edit-list-box edit-third">
                              <div class="row">
                                <div class="col-lg-12 lower-section">
            <?php  $attributes = array('id' => 'requestfrm2','name' => 'requestfrm2','role' => 'form','autocomplete' => 'off');
			     echo form_open(customer_path().'listings/update_locations/'.$profile_id.'/submit', $attributes);
				 echo form_hidden('profile_id',$profile_id);
				 echo form_hidden('request_type',2);			
				  $street_array_list='';
				  $country_array_list='';
				  $state_array_list='';
				  $city_array_list='';
				  $postal_code_array_list='';
				  $latitude_array_list='';
				  $longitude_array_list='';
				 
				 	if($listing_info->suburb){
											$suburb =  json_decode($listing_info->suburb);
											if($suburb){
											    foreach($suburb as $suburb_key => $suburb_val){
											       $street_array_list .= $suburb_val->street.',';
											       $country_array_list .= $suburb_val->country.',';
											       $state_array_list .= $suburb_val->state.',';
											       $city_array_list .= $suburb_val->city.',';
											       $postal_code_array_list .= $suburb_val->postal_code.',';
											       $latitude_array_list .= $suburb_val->latitude.',';
											       $longitude_array_list .= $suburb_val->longitude.',';
											    }
											}
				 	}
											
				 
		   ?>					<input type="hidden" name="street[]" id="street" value='<?php echo $street_array_list;?>'>
		                        <input type="hidden" name="country[]" id="country" value='<?php echo $country_array_list;?>'>
		                        <input type="hidden" name="latitude[]" id="latitude" value='<?php echo $latitude_array_list;?>'>
		                        <input type="hidden" name="longitude[]" id="longitude" value='<?php echo $longitude_array_list;?>'>
		                        <input type="hidden" name="state[]" id="state" value='<?php echo $state_array_list;?>'>
		                        <input type="hidden" name="city[]" id="city" value='<?php echo $city_array_list;?>'>
		                         <input type="hidden" name="postal_code[]" id="postal_code" value='<?php echo $postal_code_array_list;?>'>
		                        <input type="hidden" name="suburb[]" id="suburb">
		                        
                                  <table class="w-100">
                                    <tbody>
                                      <tr>
                                        <td colspan="2"><label>Suburb</label><p>We recommend choosing at least 4 suburbs</p>
                                           
                                            <a href="javascript:void(0);" class=btn"" id="new">Add address</a>
                                            
                                            <?php
                                            
                                            	if($listing_info->suburb){
											$suburb =  json_decode($listing_info->suburb);
											$suburbcounter=0;
											if($suburb){
											    foreach($suburb as $suburb_key => $suburb_val){
											        $suburbcounter++;
											        //echo $suburb_val->location.'<br>';
											        if($suburb_val->location!='')
											        echo '<div id="'.$suburbcounter.'" class="row_address_new" ><input type="text" name="home_address[]" class="form-control seladdress" data-id="'.$suburbcounter.'" value="'.$suburb_val->location.'" placeholder="Address..."><button class="remove_new">X</button></div>';
											    }
											    
											}
											}
											
											?>
                                            
                                        
  					  					   </td>
                                      </tr>
                                      
                                       <tr>
                                        <td colspan="2"><button type="submit" id="save_requestfrm2_edit" class="btn btn-default btn-success btn-block">Submit</button></td>
                                      </tr>
                                       
                                    </tbody>
                                  </table>
                                  
                                  <?php form_close();?>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
       
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAtLfFXXmIptDnSQURNRGjVSfAwZl-v6Vo"></script>


<script>

</script>
<?php 
$below_app_js=array('js/datepicker/js/bootstrap-datepicker.js','js/jquery.validate.min.js','js/lookinghome.js');
$this->load->view('includes/footer',array('below_app_js'=>$below_app_js)); ?>
<script type="text/javascript">

    $(function(){
        $(document).on("click",".seladdress", function (e) {
       var $newAddressInput1 = $(this).val(); 
       var datacounter = $(this).attr('data-id');
         applySearchAddressNew($(this),datacounter); 
     });
     


  $("#new").on("click", function() {
   
    var inc = $(".row_address").length + 1,
      $newAddressRow = '<div id="'+inc+'" class="row_address" ><input type="text" name="home_address[]" class="form-control seladdress" placeholder="Address..." autocomplete="off"><button class="remove">X</button></div>';

    $($newAddressRow).insertBefore($(this));

    var $newAddressInput = $("input[name='home_address[]']");
    $newAddressInput.focus();

    applySearchAddressNew($newAddressInput,inc);
   
  });



  $(document).on("click", ".remove_new", function() {
    $(this).closest(".row_address_new").remove();
    // https://developers.google.com/maps/documentation/javascript/places-autocomplete#style_autocomplete
    // remove predictions
    $("#predictions_" + $(this).closest("div").attr("id")).remove();
   return false;
  });
$(document).on("click", ".remove", function() {
    $(this).closest(".row_address").remove();
    // https://developers.google.com/maps/documentation/javascript/places-autocomplete#style_autocomplete
    // remove predictions
    $("#predictions_" + $(this).closest("div").attr("id")).remove();
   return false;
  });

function applySearchAddressNew($input,inc) {

  if (google.maps.places.PlacesServiceStatus.OK != "OK") {
    console.warn(google.maps.places.PlacesServiceStatus)
    return false;
  }

  // https://developers.google.com/maps/documentation/javascript/geocoding#ComponentFiltering
  // country: matches a country name or a two letter ISO 3166-1 country code. Note: The API follows the ISO standard for defining countries, and the filtering works best when using the corresponding ISO code of the country.
  var options = {
    // componentRestrictions: {
    //   country: "en"
    // }
  };

  var autocomplete = new google.maps.places.Autocomplete($input[parseInt(inc)-parseInt(1)], options);

  autocomplete.addListener('place_changed', function() {

    var place = autocomplete.getPlace();
    
    //console.log(place);
    if (place.length == 0) {
      return;
    }

    var address = '';
   if (place.address_components) {
		             var lat = autocomplete.getPlace().geometry.location.lat();
					var lng = autocomplete.getPlace().geometry.location.lng();
			        
			        
			        //console.log(lat+"==="+lng);
			        if($('#latitude').val()!='')
					$('#latitude').val(lat+','+ $('#latitude').val());
					else
					$('#latitude').val(lat+',');
					
					if($('#longitude').val()!='')
					$('#longitude').val(lng+','+$('#longitude').val());
					else
					$('#longitude').val(lng+',');
					
					
		    
		    
		    	 if (place.address_components) {
				    	  var component_form = {
						    'street_number': 'short_name',
						    'route': 'long_name',
						    'locality': 'long_name',
						    'administrative_area_level_1': 'short_name',
						    'country': 'long_name',
						    'postal_code': 'short_name'
						  };
						  //alert(place.address_components);
						  $street_number='';
						  $country='';
						  $city_id='';
						  $state_id='';
						  var show_street_number=''
						  var show_country_name=''
						  var show_postalcode_name='';
						  var show_state_name='';
						  var show_city_name='';
						  for(var i = 0; i < place.address_components.length; i += 1) {
							  var addressObj = place.address_components[i];
							 // alert(addressObj.short_name);
							  for(var j = 0; j < addressObj.types.length; j += 1) {
							      
							     if (addressObj.types[j] === 'street_number') {
							         show_street_number += $("#street").val()+addressObj.long_name+','
									 }
                                 
							      
							   else  if (addressObj.types[j] === 'country') {
									 var country_value=addressObj.long_name;
									 show_country_name += $("#country").val()+addressObj.long_name+','
										
					              }
	                             else if(addressObj.types[j] === 'administrative_area_level_1') {
	                              var regions_value=addressObj.long_name;	 
			                	   show_state_name += $("#state").val()+addressObj.long_name+','
				
                                 }	  
	                             else if (addressObj.types[j] === 'locality') {
	                              var city_value=addressObj.long_name;
			                	    show_city_name += $("#city").val()+addressObj.long_name+','
       	         
			                   }
    			    	         else if (addressObj.types[j] === 'postal_code') {
 			                	  show_postalcode_name += $("#postal_code").val()+addressObj.long_name+','
 				  
    		                    	}
                                }
						}			
						
					
						
				/*-----------New code Abhi */
				addressObj.street_number ? $('#street').val(addressObj.street_number + ' ' + addressObj.route) : $('#street').val(addressObj.route);
				$('#suburb').val(addressObj.locality);
				
				/*-----------New code Abhi */
	   
	   
     				}
					else {
      // set an error - the user didn't provide a complete address
    }

	  
			  
		      address = [
		        (place.address_components[0] && place.address_components[0].short_name || ''),
		        (place.address_components[1] && place.address_components[1].short_name || ''),
		        (place.address_components[2] && place.address_components[2].short_name || ''),
		      ].join(' ');
		      	      		      
		           $("#country").val(show_country_name);
		          $("#street").val(show_street_number);
		          $("#postal_code").val(show_postalcode_name);
		          $("#state").val(show_state_name);
		          $("#city").val(show_city_name);
		          
		          return true;
		     
 
		  
		     
		    }
		    
		    
		    
    $input.val(address);
    
             
  });

  // set attr id to the predictions list
  
  setTimeout(function(){  var rowId = $input.closest("div").attr("id"); $(".pac-container:last").attr("id", "predictions_" + rowId); }, 100);

}

    });

 </script>

