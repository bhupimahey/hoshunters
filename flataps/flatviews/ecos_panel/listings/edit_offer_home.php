<style>
.modal-content .form-control {
	height: 35px;
}
[type="radio"] {
display:inline-block;
}
.pac-container{z-index:9999;}

.flaticon-settings-animate {
    -animation: spin .7s infinite linear;
    -webkit-animation: spin2 .7s infinite linear;
}

@-webkit-keyframes spin2 {
    from { -webkit-transform: rotate(0deg);}
    to { -webkit-transform: rotate(360deg);}
}

@keyframes spin {
    from { transform: scale(1) rotate(0deg);}
    to { transform: scale(1) rotate(360deg);}
}
    
/* This parent can be any width and height */
#loading {
  text-align: center;
    background:#ccc;
    opacity: 0.85;
    margin-bottom:10px;
    height: 100%;
    width: 100%;
    top: 0;
    left: 0;
    position:absolute;
    display:none;
    z-index: 999999;
}
 
/* The ghost, nudged to maintain perfect centering */
#loading:before {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
  margin-right: -0.25em; /* Adjusts for spacing */
}

/* The element to be centered, can
   also be of any width and height */ 
#loading > div {
  display: inline-block;
  vertical-align: middle;
  color: white;
}
</style>
<script>

function call_ajax_file(profile_id,action,formid){
        var  ldg = $('#loading');
  ldg.find('> div > span').text('Please wait....').end().show();
		     $.ajax({
				url:action,
				method:"POST",
				dataType: "json",	
				data:$(formid).serializeArray(),
				success:function(beforedata){	
				    
				    if(beforedata){
				        
				        setTimeout( function(){ 
				             ldg.hide();
                 window.location.href=admin_path+'listings/view/'+profile_id
  }  , 3000 );
				        
				        
				    }
				}
		     });	
}
$(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;
   
    $('#date_available').attr('min', maxDate);
});

$(function() {
	var room_counter=0;
$(document).on("click","#addmore_rooms", function (e) {
	 room_counter=room_counter+1;
	 $("#others_rooms").after('<div id="room'+room_counter+'">            <hr>             <div class="form-group">             <a href="javascript:void(0);" style="float:right;" class="remove_room" data-id="'+room_counter+'">Remove Room</a>              <label for="psw">Room Name</label>              <input type="text" name="room_name[]" value="" class="form-control" id="room_name">            </div>             <div class="form-group">              <label for="psw">Room Type</label>              <select name="room_type[]" class="form-control"><option value="1">Private</option><option value="2">Shared</option></select>            </div>                          <div class="form-group">              <label for="psw">Room furnishings</label>              <select name="room_furnishings[]" class="form-control"><option value="1">Flexible</option><option value="2">Furnished</option><option value="3">Unfurnished</option></select>            </div>                        <div class="form-group">              <label for="psw">Bathroom</label>              <select name="bathroom[]" class="form-control"><option value="1">Shared</option><option value="2">Own</option><option value="3">Ensuite</option></select>            </div>                        </div>');
	 
	 $("#room"+room_counter).show();
 });

$(document).on("click",".remove_room", function (e) {
	 var roomid = $(this).attr("data-id");
	 $("#room"+roomid+"").remove();
 });



$("#property_address").bind("paste", function(e){
    $("#street").val('');
    $("#country").val('');
    $("#latitude").val('');
    $("#longitude").val('');
    $("#state").val('');
    $("#city").val('');
    $("#postal_code").val('');
});
    
$(document).on("keyup","#property_address", function (e) {
   $("#street").val('');
    $("#country").val('');
    $("#latitude").val('');
    $("#longitude").val('');
    $("#state").val('');
    $("#city").val('');
    $("#postal_code").val('');
});


$("#searchsuburb").bind("paste", function(e){
    $("#search_p_street").val('');
    $("#search_p_country").val('');
    $("#search_p_latitude").val('');
    $("#search_p_longitude").val('');
    $("#search_p_state").val('');
    $("#search_p_city").val('');
    $("#search_p_postal_code").val('');
    $("#search_p_suburb").val(''); 
});
    
$(document).on("keyup","#searchsuburb", function (e) {
    $("#search_p_street").val('');
    $("#search_p_country").val('');
    $("#search_p_latitude").val('');
    $("#search_p_longitude").val('');
    $("#search_p_state").val('');
    $("#search_p_city").val('');
    $("#search_p_postal_code").val('');
    $("#search_p_suburb").val('');
});


	
$("#save_requestfrm1_edit").on("click",function(){
		    var profile_id = $("#requestfrm1 #profile_id").val();
             var action = admin_path+'listing_ajax/update_home_request_info'; 
			 call_ajax_file(profile_id,action,'#requestfrm1');
		    
        return false;    
		});
$("#save_requestfrm2_edit").on("click",function(){
    
            if($("#street").val()==''){
              $("#property_address").css("border-color","red");  
              $("#property_address").after('<span id="name-error" class="help-block help-block-error" style="color:red">Street number is missing.</span>');
                
            }
            else{
                $("#property_address").removeAttr("style");
                $("#name-error").remove();
                
			var profile_id = $("#requestfrm2 #profile_id").val();
             var action = admin_path+'listing_ajax/update_home_request_info'; 
			 call_ajax_file(profile_id,action,'#requestfrm2');
            }
		   
      return false;       
   });			
$("#save_requestfrm3_edit").on("click",function(){
			var profile_id = $("#requestfrm3 #profile_id").val();
             var action = admin_path+'listing_ajax/update_home_request_info'; 
			 call_ajax_file(profile_id,action,'#requestfrm3');
		    
        return false;  
   });			
			
$("#save_requestfrm4_edit").on("click",function(){
			var profile_id = $("#requestfrm4 #profile_id").val();
             var action = admin_path+'listing_ajax/update_home_request_info'; 
			 call_ajax_file(profile_id,action,'#requestfrm4');			    
        return false;  
   });		
   
   $("#save_requestfrm5_edit").on("click",function(){
			var profile_id = $("#requestfrm5 #profile_id").val();
             var action = admin_path+'listing_ajax/update_home_request_info'; 
			 call_ajax_file(profile_id,action,'#requestfrm5');			    
        return false;  
   });	
$("#save_requestfrm6_edit").on("click",function(){
			var profile_id = $("#requestfrm6 #profile_id").val();
             var action = admin_path+'listing_ajax/update_home_request_info'; 
			call_ajax_file(profile_id,action,'#requestfrm6');		   
        return false;  
   });

$("#save_requestfrm7_edit").on("click",function(){
			var profile_id = $("#requestfrm7 #profile_id").val();
            var action = admin_path+'listing_ajax/update_home_request_info'; 
		   call_ajax_file(profile_id,action,'#requestfrm7');
        return false;  
   }) 
 $("#save_requestfrm8_edit").on("click",function(){
			var profile_id = $("#requestfrm8 #profile_id").val();
            var action = admin_path+'listing_ajax/update_home_request_info'; 
		   call_ajax_file(profile_id,action,'#requestfrm8');
        return false;  
   }) 
 $("#save_requestfrm9_edit").on("click",function(){
			var profile_id = $("#requestfrm9 #profile_id").val();
            var action = admin_path+'listing_ajax/update_home_request_info'; 
		   call_ajax_file(profile_id,action,'#requestfrm9');
        return false;  
   })    
 
 $("#save_requestfrm10_edit").on("click",function(){
			var profile_id = $("#requestfrm10 #profile_id").val();
            var action = admin_path+'listing_ajax/update_home_request_info'; 
		   call_ajax_file(profile_id,action,'#requestfrm10');
        return false;  
   })         									
});
</script>


    
    
<?php if($request_type=='1'){ ?>
<div class="modal-dialog"> 

  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <h4>What type of accommodation are you offering?</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
  <div class="modal-body"  style="height:350px; overflow:scroll;">
        <div id="loading">
        <div>
        <img src="<?php echo base_url();?>images/loader.gif" style="width:auto;">
        <span>Message</span>
        </div>
      </div>
      <?php  $attributes = array('id' => 'requestfrm1','name' => 'requestfrm1','role' => 'form','autocomplete' => 'off');
			     echo form_open('#', $attributes);
				 echo form_hidden('profile_id',$profile_id);
				 echo form_hidden('request_type',1);							
		   ?>
      <div class="form-group">
       <ul class="check_submit">
          <?php
			$final_accommodation_offering=array();
			  if($listing_info->accommodation_offering!=''){
			   	  $accommodation_offering_info = explode(",",$listing_info->accommodation_offering);
				  if($accommodation_offering_info){
					foreach($accommodation_offering_info as $accommodation_offeringval){
						$final_accommodation_offering[$accommodation_offeringval]=$accommodation_offeringval;
					}						
				  }
			  }
			  
			  $config_accommodation_offering=$this->config->item('accommodation_offering');
			  if($config_accommodation_offering){
				  foreach($config_accommodation_offering as $accommodation_offering_key =>  $accommodation_offering_list){
					  if(array_key_exists($accommodation_offering_key ,$final_accommodation_offering)){  ?>
          <li>
            <input type="checkbox" name="accommodation_offering[]" class="hide" id="accommodation_offering<?php echo $accommodation_offering_key;?>" value="<?php echo $accommodation_offering_key;?>" checked="true">
            <label for="accommodation_offering<?php echo $accommodation_offering_key;?>"><?php echo $accommodation_offering_list;?></label>
          </li>
          <?php }  else { ?>
          <li> 
            <input type="checkbox" name="accommodation_offering[]" class="hide" id="accommodation_offering<?php echo $accommodation_offering_key;?>" value="<?php echo $accommodation_offering_key;?>">
            <label for="accommodation_offering<?php echo $accommodation_offering_key;?>"><?php echo $accommodation_offering_list;?></label>
          </li>
          <?php } ?>
          <?php } } ?>
        </ul>
      </div>
      <button type="submit" id="save_requestfrm1_edit" class="btn btn-default btn-success btn-block">Submit</button>
      </form>
    </div>
  </div>
</div>
<?php } ?>
<?php if($request_type=='2'){ ?>
<div class="modal-dialog"> 
  
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <h4>About the property</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body"  style="height:500px; overflow:scroll;">
         <div id="loading">
        <div>
        <img src="<?php echo base_url();?>images/loader.gif" style="width:auto;">
        <span>Message</span>
        </div>
      </div>
      <?php  $attributes = array('id' => 'requestfrm2','name' => 'requestfrm2','role' => 'form','autocomplete' => 'off');
			     echo form_open('#', $attributes);
				 echo form_hidden('profile_id',$profile_id);
				  echo form_hidden('request_type',2);								
		   
		           $street_array_list='';
				  $country_array_list='';
				  $state_array_list='';
				  $city_array_list='';
				  $postal_code_array_list='';
				  $latitude_array_list='';
				  $longitude_array_list='';
				 
				 	if($about_property->property_address){
											$suburb =  json_decode($about_property->property_address);
											if(isset($suburb[0]))
											 $property_address = $suburb[0]->location;
											else
											$property_address ='';
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
				 	?>
		   <input type="hidden" name="street" id="street" value='<?php echo $street_array_list;?>'>
		                        <input type="hidden" name="country" id="country" value='<?php echo $country_array_list;?>'>
		                        <input type="hidden" name="latitude" id="latitude" value='<?php echo $latitude_array_list;?>'>
		                        <input type="hidden" name="longitude" id="longitude" value='<?php echo $longitude_array_list;?>'>
		                        <input type="hidden" name="state" id="state" value='<?php echo $state_array_list;?>'>
		                        <input type="hidden" name="city" id="city" value='<?php echo $city_array_list;?>'>
		                         <input type="hidden" name="postal_code" id="postal_code" value='<?php echo $postal_code_array_list;?>'>
      <div class="form-group">
      <label>Property Address</label>
      <?php $data = array('class' =>'form-control row_address', 'name'=> 'property_address', 'id'=> 'property_address','value'=>$property_address);
					echo form_input($data); 
				?>
        
      </div>
      <div class="form-group">
      <label>Total bedrooms<p><small>Including the one you're offering</small></p></label>
        <?php				
			    $total_bedrooms = $this->config->item('total_bedrooms');									
				echo form_dropdown('total_bedrooms', $total_bedrooms,$about_property->total_bedrooms,'class="form-control" ');
				?>
        
      </div>
       <div class="form-group">
      <label>Total bathrooms</label>
        <?php				
			    $total_bathrooms = $this->config->item('total_bathrooms');									
				echo form_dropdown('total_bathrooms', $total_bathrooms,$about_property->total_bathrooms,'class="form-control" ');
				?>
        
      </div>
       <div class="form-group">
      <label>Parking</label>
        <?php				
			    $parking_status = $this->config->item('parking_status');									
				echo form_dropdown('parking', $parking_status,$about_property->parking,'class="form-control" ');
				?>
        
      </div>
       <div class="form-group">
      <label>Internet</label>
        <?php				
			    $internet_status = $this->config->item('internet_status');									
				echo form_dropdown('internet', $internet_status,$about_property->internet,'class="form-control" ');
				?>
        
      </div>
       <div class="form-group">
      <label>Total number of flatmates<p><small>Once all rooms are rented</small></p></label>
        <?php				
			    $total_flatmates = $this->config->item('total_flatmates');									
				echo form_dropdown('total_flatmates', $total_flatmates,$about_property->total_flatmates,'class="form-control" ');
				?>
        
      </div>
      <button type="submit" id="save_requestfrm2_edit" class="btn btn-default btn-success btn-block">Submit</button>
      </form>
    </div>
  </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAtLfFXXmIptDnSQURNRGjVSfAwZl-v6Vo"></script>
<script type="text/javascript">//<![CDATA[

  
  $(document).on("click", "#property_address", function() {
    var $newAddressInput = $("input[name='property_address']");
    $newAddressInput.focus();

    applySearchAddress($newAddressInput);
    return false;
  });


$(document).on("click", ".remove", function() {
    $(this).closest(".row_address").remove();
    // https://developers.google.com/maps/documentation/javascript/places-autocomplete#style_autocomplete
    // remove predictions
    $("#predictions_" + $(this).closest("div").attr("id")).remove();
   return false;
  });

function applySearchAddress($input) {

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

  var autocomplete = new google.maps.places.Autocomplete($input.get(0), options);

  autocomplete.addListener('place_changed', function() {

    var place = autocomplete.getPlace();
    
    console.log(place);
   
    
    

    if (place.length == 0) {
      return;
    }

    var address = '';
   if (place.address_components) {
		             var lat = autocomplete.getPlace().geometry.location.lat();
					var lng = autocomplete.getPlace().geometry.location.lng();
			        
			        
			        //console.log(lat+"==="+lng);
			        if($('#latitude').val()!='')
					$('#latitude').val($('#latitude').val());
					else
					$('#latitude').val(lat+',');
					
					if($('#longitude').val()!='')
					$('#longitude').val($('#longitude').val());
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
							         show_street_number = $("#street").val()+addressObj.long_name+','
									 }
                                 
							      
							   else  if (addressObj.types[j] === 'country') {
									 var country_value=addressObj.long_name;
									 show_country_name = $("#country").val()+addressObj.long_name+','
										
					              }
	                             else if(addressObj.types[j] === 'administrative_area_level_1') {
	                              var regions_value=addressObj.long_name;	 
			                	   show_state_name = $("#state").val()+addressObj.long_name+','
				
                                 }	  
	                             else if (addressObj.types[j] === 'locality') {
	                              var city_value=addressObj.long_name;
			                	    show_city_name = $("#city").val()+addressObj.long_name+','
       	         
			                   }
    			    	         else if (addressObj.types[j] === 'postal_code') {
 			                	  show_postalcode_name = $("#postal_code").val()+addressObj.long_name+','
 				  
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
		      	      		      
		      if(show_street_number!=''){
		          $("#country").val(show_country_name);
		          $("#street").val(show_street_number);
		          $("#postal_code").val(show_postalcode_name);
		          $("#state").val(show_state_name);
		          $("#city").val(show_city_name);
		          $(".row_address").removeAttr("style");
		          return true;
		      }
		      else{
		          //$("#home_address").css("border-color","red");
		          $(".row_address").addClass("error");
	              $(".row_address input").after('<label id="home_address-error" class="error" for="home_address">Street number is missing.</label>');
	              return false;
		      }
		  
		  		   

			    
		
 
		  
		     
		    }
		    
		    
		    
    $input.val(address);
    
             
  });

  // set attr id to the predictions list
  setTimeout(function() {
    var rowId = $input.closest("div").attr("id");
    $(".pac-container:last").attr("id", "predictions_" + rowId);
  }, 100);

};

  //]]></script>


<?php } ?>
<?php if($request_type=='3'){ ?>
<div class="modal-dialog"> 
  
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <h4>About the room(s)</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
         <div id="loading">
        <div>
        <img src="<?php echo base_url();?>images/loader.gif" style="width:auto;">
        <span>Message</span>
        </div>
      </div>
      <?php  $attributes = array('id' => 'requestfrm3','name' => 'requestfrm3','role' => 'form','autocomplete' => 'off');
			     echo form_open('#', $attributes);
				 echo form_hidden('profile_id',$profile_id);
				 echo form_hidden('request_type',3);							
		   ?>
      
       <a href="javascript:void(0);" style="float:right;" id="addmore_rooms">Add More</a>	
      <?php $total_room=100;
			if($about_rooms){
			foreach($about_rooms as $key => $room_info){
				
						?>
           <div id="room<?php echo $total_room;?>">
                 <div class="form-group">
            <?php if($total_room >100){ ?>
             <a href="javascript:void(0);" style="float:right;"  class="remove_room" data-id="<?php echo $total_room;?>">Remove Room</a><?php } ?>
              <label for="psw">Room Name</label>
              <?php $data = array('class' =>'form-control', 'name'=> 'room_name[]', 'id'=> 'room_name','value'=>$room_info->room_name);
					echo form_input($data); 
				?>
            </div>
                 <div class="form-group">
              <label for="psw">Room Type</label>
              <?php				
			    $roomtypes_status = $this->config->item('roomtypes_status');									
				echo form_dropdown('room_type[]', $roomtypes_status,$room_info->room_type,'class="form-control" ');
				?>
            </div>
            
                  <div class="form-group">
              <label for="psw">Room furnishings</label>
              <?php				
			    $roomfurnishings_status = $this->config->item('roomfurnishings_status');									
				echo form_dropdown('room_furnishings[]', $roomfurnishings_status,$room_info->room_furnishings,'class="form-control" ');
				?>
            </div>
            
                  <div class="form-group">
              <label for="psw">Bathroom</label>
              <?php				
			    $bathrooms_status = $this->config->item('bathrooms_status');									
				echo form_dropdown('bathroom[]', $bathrooms_status,$room_info->bathroom,'class="form-control" ');
				?>
            </div>
            </div>
           
            <?php  $total_room++;}} ?>
            
            <div id="others_rooms"></div>
            
     
      <button type="submit" id="save_requestfrm3_edit" class="btn btn-default btn-success btn-block">Submit</button>
      </form>
    </div>
  </div>
</div>
<?php } ?>
<?php if($request_type=='4'){ ?>
<div class="modal-dialog"> 
  
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <h4>Room's Features</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body" style="height:350px; overflow:scroll;">
         <div id="loading">
        <div>
        <img src="<?php echo base_url();?>images/loader.gif" style="width:auto;">
        <span>Message</span>
        </div>
      </div>
      <?php  $attributes = array('id' => 'requestfrm4','name' => 'requestfrm4','role' => 'form','autocomplete' => 'off');
			     echo form_open('#', $attributes);
				 echo form_hidden('profile_id',$profile_id);
				 echo form_hidden('request_type',4);		
		   ?>
		   
	 <?php
	 $i=0;
	 $room_furnishing_features = $this->config->item('room_furnishing_features');
	 foreach($room_features as $room_features_val){
	 
	 $i++;?>	   
		<h4>Room <?php echo $i;?> Detail</h4>   
      <div class="form-group">
        <label for="psw">Bed Size</label>
         <?php				
			    $bedsize_status = $this->config->item('bedsize_status');									
				echo form_dropdown('bed_size['.$i.']', $bedsize_status,$room_features_val->bed_size,'class="form-control" ');
				?>
      </div>
      <div class="form-group">
        <label for="psw">Room furnishings and features</label>
        <ul class="check_submit">
          <?php
		       
			   $final_room_furnishing_features=array();
			  if($room_features_val && $room_features_val->furnishings_features!=''){
			   	  $furnishings_featuresinfo = explode(",",$room_features_val->furnishings_features);
				  if($furnishings_featuresinfo){
					foreach($furnishings_featuresinfo as $furnishings_featuresinfoval){
						$final_room_furnishing_features[$furnishings_featuresinfoval]=$furnishings_featuresinfoval;
					}						
				  }
			  }
			  			
				 foreach($room_furnishing_features as $room_furnishing_features_key =>  $room_furnishing_features_val){
					  if(array_key_exists($room_furnishing_features_key ,$final_room_furnishing_features)){
				  ?>
       			   <li>
            <input type="checkbox" name="furnishings_features[<?php echo $i;?>][]" class="hide" id="furnishings_features<?php echo $room_furnishing_features_key.$i;?>" value="<?php echo $room_furnishing_features_key;?>" checked>
            <label for="furnishings_features<?php echo $room_furnishing_features_key.$i;?>"><?php echo $room_furnishing_features_val;?></label>
          </li>
       		   <?php } else { ?>
       			    <li>
            <input type="checkbox" name="furnishings_features[<?php echo $i;?>][]" class="hide" id="furnishings_features<?php echo $room_furnishing_features_key.$i;?>" value="<?php echo $room_furnishing_features_key;?>">
            <label for="furnishings_features<?php echo $room_furnishing_features_key.$i;?>"><?php echo $room_furnishing_features_val;?></label>
          </li>
        	      <?php } ?>
               <?php } ?>
        </ul>
      </div>
      
      <?php } ?>
      
      <button type="submit" id="save_requestfrm4_edit" class="btn btn-default btn-success btn-block">Submit</button>
      </form>
    </div>
  </div>
</div>
<?php } ?>
<?php if($request_type=='5'){ ?>
<div class="modal-dialog"> 
  
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <h4>Rent, bond and bills</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
         <div id="loading">
        <div>
        <img src="<?php echo base_url();?>images/loader.gif" style="width:auto;">
        <span>Message</span>
        </div>
      </div>
      <?php  $attributes = array('id' => 'requestfrm5','name' => 'requestfrm5','role' => 'form','autocomplete' => 'off');
			     echo form_open('#', $attributes);
				 echo form_hidden('profile_id',$profile_id);
				 echo form_hidden('request_type',5);
				 $j=0;
				 $bills_status = $this->config->item('bills_status');
				 $bond_status = $this->config->item('bond_status');	
	foreach($room_rentbills as $room_rentbills_val){
		 $j++;
		   ?>
	 <h4>Room <?php echo $j;?> detail</h4>	   
      <div class="form-group">
              <label for="psw">Weekly rent($)</label>
              <?php $data = array('class' =>'form-control', 'name'=> 'weekly_rent['.$j.']', 'id'=> 'weekly_rent','value'=>$room_rentbills_val->weekly_rent);
					echo form_input($data); 
				?>
            </div>
      <div class="form-group">
              <label for="psw">Bond</label>
             <?php				
			    								
				echo form_dropdown('bond['.$j.']', $bond_status,$room_rentbills_val->bond,'class="form-control" ');
				?> 
            </div>
       <div class="form-group">
              <label for="psw">Bills</label>
             <?php				
			    								
				echo form_dropdown('bills['.$j.']', $bills_status,$room_rentbills_val->bills,'class="form-control" ');
				?> 
            </div>
        <?php } ?>    
            
      <button type="submit" id="save_requestfrm5_edit" class="btn btn-default btn-success btn-block">Submit</button>
      </form>
    </div>
  </div>
</div>
<?php } ?>
<?php if($request_type=='6'){ ?>
<div class="modal-dialog"> 
  
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <h4>Room availability</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
         <div id="loading">
        <div>
        <img src="<?php echo base_url();?>images/loader.gif" style="width:auto;">
        <span>Message</span>
        </div>
      </div>
      <?php  $attributes = array('id' => 'requestfrm6','name' => 'requestfrm6','role' => 'form','autocomplete' => 'off');
			     echo form_open('#', $attributes);
				 echo form_hidden('profile_id',$profile_id);
				 echo form_hidden('request_type',6);							
		
	$k=0;
	$length_of_stay = $this->config->item('length_of_stay');	
	foreach($room_availability as $room_availability_val){
		 $k++;	
		
		   ?>
       <h4>Room <?php echo $k;?> detail</h4>
      <div class="form-group">
              <label for="psw">Date available</label>
              <?php $data = array('class' =>'form-control','type'=>'date', 'name'=> 'date_available['.$k.']', 'id'=> 'date_available','value'=>$room_availability_val->date_available);
					echo form_input($data); 
				?>
            </div>
      <div class="form-group">
              <label for="psw">Minimum length of stay</label>
             <?php				
			    								
				echo form_dropdown('min_stay_length['.$k.']', $length_of_stay,$room_availability_val->min_stay_length,'class="form-control" ');
				?> 
            </div>
       <div class="form-group">
              <label for="psw">Maximum length of stay</label>
             <?php				
			   									
				echo form_dropdown('max_stay_length['.$k.']', $length_of_stay,$room_availability_val->max_stay_length,'class="form-control" ');
				?> 
            </div>
            <?php } ?>
      <button type="submit" id="save_requestfrm6_edit" class="btn btn-default btn-success btn-block">Submit</button>
      </form>
    </div>
  </div>
</div>
<?php } ?>
<?php if($request_type=='7'){ ?>
<div class="modal-dialog"> 
  
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <h4>Flatmate Preference</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
         <div id="loading">
        <div>
        <img src="<?php echo base_url();?>images/loader.gif" style="width:auto;">
        <span>Message</span>
        </div>
      </div>
      <?php  $attributes = array('id' => 'requestfrm7','name' => 'requestfrm7','role' => 'form','autocomplete' => 'off');
			     echo form_open('#', $attributes);
				 echo form_hidden('profile_id',$profile_id);
				 echo form_hidden('request_type',7);
				 
		 $m=0;
		 $flatmatespref_status    = $this->config->item('flatmatespref_status');	
		 $flatmatespref_accepting = $this->config->item('flatmatespref_accepting');
		 if($flatmates_preferences){
	     foreach($flatmates_preferences as $flatmates_preferences_val){
		 $m++;				 
		   ?>
   <div class="form-group">
        <?php echo form_dropdown('preference['.$m.']', $flatmatespref_status,$flatmates_preferences_val->preference,'class="form-control" ');
				?>
      </div>
      <div class="form-group">
        <label for="psw">Accepting</label>
        <div class="row">
          <?php
			   $final_flatmatespref_acceptings=array();
			  if($flatmates_preferences && isset($flatmates_preferences_val->accepting)){
			   	  $acceptinginfo = explode(",",$flatmates_preferences_val->accepting);
				  if($acceptinginfo){
					foreach($acceptinginfo as $acceptinginfoval){
						$final_flatmatespref_acceptings[$acceptinginfoval]=$acceptinginfoval;
					}						
				  }
			  }
			  			
				 foreach($flatmatespref_accepting as $flatmatespref_accepting_key =>  $flatmatespref_accepting_val){
					  if(array_key_exists($flatmatespref_accepting_key ,$final_flatmatespref_acceptings)){
				  ?>
				   <div class="col-lg-4 col-md-4">
				  <ul class="check_submit">
       			   <li>
            <input type="checkbox" name="accepting[<?php echo $m;?>][]" class="hide" id="accepting<?php echo $flatmatespref_accepting_key.$m;?>" value="<?php echo $flatmatespref_accepting_key;?>" checked>
            <label for="accepting<?php echo $flatmatespref_accepting_key.$m;?>"><?php echo $flatmatespref_accepting_val;?></label>
          </li>
          </ul>
          </div>
       		   <?php } else { ?>
       		    <div class="col-lg-4 col-md-4">
       		   <ul class="check_submit">
       			    <li>
            <input type="checkbox" name="accepting[<?php echo $m;?>][]" class="hide" id="accepting<?php echo $flatmatespref_accepting_key.$m;?>" value="<?php echo $flatmatespref_accepting_key;?>">
            <label for="accepting<?php echo $flatmatespref_accepting_key.$m;?>"><?php echo $flatmatespref_accepting_val;?></label>
          </li>
          </ul></div>
        	      <?php } ?>
               <?php } ?>
        </div>
      </div>
      <?php } 
         }
        
      ?>
      
      
      <button type="submit" id="save_requestfrm7_edit" class="btn btn-default btn-success btn-block">Submit</button>
      </form>
    </div>
  </div>
</div>
<?php } ?>
<?php if($request_type=='8'){ ?>
<div class="modal-dialog"> 
  
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <h4>Tell us about you and your flatmates</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
         <div id="loading">
        <div>
        <img src="<?php echo base_url();?>images/loader.gif" style="width:auto;">
        <span>Message</span>
        </div>
      </div>
      <?php  $attributes = array('id' => 'requestfrm8','name' => 'requestfrm8','role' => 'form','autocomplete' => 'off');
			     echo form_open('#', $attributes);
				 echo form_hidden('profile_id',$profile_id);
				 echo form_hidden('request_type',8);							
				 if(isset($flatmates_preferences[0])){
				 $flatmates_preferences=$flatmates_preferences[0];
				 $about_flatmates = $flatmates_preferences->about_flatmates;
				 }
				 else
				 $about_flatmates ='';
				 
				 
		   ?>
      <div class="form-group">
       <textarea  name="about_flatmates" class="form-control" id="about_flatmates"  style="height:200px;"><?php echo $about_flatmates;?></textarea>
        
      </div>
      <button type="submit" id="save_requestfrm8_edit" class="btn btn-default btn-success btn-block">Submit</button>
      </form>
    </div>
  </div>
</div>
<?php } ?>

<?php if($request_type=='9'){ ?>
<div class="modal-dialog"> 
  
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <h4>What's great about living at this property?</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
         <div id="loading">
        <div>
        <img src="<?php echo base_url();?>images/loader.gif" style="width:auto;">
        <span>Message</span>
        </div>
      </div>
      <?php  $attributes = array('id' => 'requestfrm9','name' => 'requestfrm9','role' => 'form','autocomplete' => 'off');
			     echo form_open('#', $attributes);
				 echo form_hidden('profile_id',$profile_id);
				 echo form_hidden('request_type',9);							
		   ?>
      <div class="form-group">
       <textarea  name="great_live_with_text" class="form-control" id="great_live_with_text"  style="height:200px;"><?php echo $listing_info->great_live_with_text;?></textarea>
        
      </div>
      <button type="submit" id="save_requestfrm9_edit" class="btn btn-default btn-success btn-block">Submit</button>
      </form>
    </div>
  </div>
</div>
<?php } ?>

<?php if($request_type=='10'){ ?>
<div class="modal-dialog"> 
  
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <h4>Preferred Language</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
         <div id="loading">
        <div>
        <img src="<?php echo base_url();?>images/loader.gif" style="width:auto;">
        <span>Message</span>
        </div>
      </div>
      <?php  $attributes = array('id' => 'requestfrm10','name' => 'requestfrm10','role' => 'form','autocomplete' => 'off');
			     echo form_open('#', $attributes);
				 echo form_hidden('profile_id',$profile_id);
				 echo form_hidden('request_type',10);							
		   ?>
       <div class="form-group">
              <label for="psw">Choose Language</label>
              <?php				
			    $preferred_language_list = $this->config->item('preferred_language_list');									
				echo form_dropdown('preferred_language', $preferred_language_list,$listing_info->preferred_language,'class="form-control" id="preferred_language" ');
				?>
              
            </div>
      <button type="submit" id="save_requestfrm10_edit" class="btn btn-default btn-success btn-block">Submit</button>
      </form>
    </div>
  </div>
</div>
<?php } ?>