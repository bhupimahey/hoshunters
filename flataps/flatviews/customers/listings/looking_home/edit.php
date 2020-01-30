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
                 window.location.href=customer_path+'listing/preview/'+profile_id
  }  , 3000 );
				    }
				}
		     });
return false;		     
		     
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
   
    $('#preferred_move_date').attr('min', maxDate);
});

$(function() {
	var room_counter=0;
    $(document).on("click","#addmore_rooms", function (e) {	
	 room_counter=room_counter+1;	 
	 if(room_counter>=1)
	 var urllink ='<a href="javascript:void(0);" style="float:right;" class="remove_room" data-id="'+room_counter+'">Remove</a>';
	 else
	 var urllink ='<a href="javascript:void(0);" style="float:right;" id="addmore_rooms">Add More</a>';
	 
	 
	 $("#group_div").after('<div id="room'+room_counter+'" class="extradivs">  '+urllink+'           <hr>             <div class="form-group">              <label for="psw">Your friend\'s first name</label>              <input type="text" name="friends_firstname[]" value="" class="form-control" id="friends_firstname">            </div><div class="form-group">              <label for="psw">Your friend\'s age</label>              <input type="text" name="friends_age[]" value="" class="form-control" id="friends_age">            </div><div class="form-group">              <label for="psw">The gender your friend identifies with</label>             <ul class="radio_submit">                    <li>            <input type="radio" name="friends_gender[]" class="hide" id="friends_gender'+room_counter+'" value="1">            <label for="friends_gender'+room_counter+'">Female</label>          </li>                              <li>            <input type="radio" name="friends_gender[]" class="hide" id="friends_gender'+room_counter+'1" value="2">            <label for="friends_gender'+room_counter+'1">Male</label>          </li>                            </ul>            </div>                       </div>');
	 
	 $("#room"+room_counter).show();
 });

   $(document).on("click",".remove_room", function (e) {
	 var roomid = $(this).attr("data-id");
	 $("#room"+roomid+"").remove();
   });
	
	
$("#save_requestfrm1_edit").on("click",function(){
		    var profile_id = $("#requestfrm1 #profile_id").val();
             var action = customer_path+'listing_ajax/update_request_info'; 
			 call_ajax_file(profile_id,action,'#requestfrm1');
			 return false;
		});
			
$("#save_requestfrm3_edit").on("click",function(){
			var profile_id = $("#requestfrm3 #profile_id").val();
             var action = customer_path+'listing_ajax/update_request_info'; 
			 call_ajax_file(profile_id,action,'#requestfrm3');
			 return false;
   });			
			
$("#save_requestfrm4_edit").on("click",function(){
			var profile_id = $("#requestfrm4 #profile_id").val();
             var action = customer_path+'listing_ajax/update_request_info'; 
			 call_ajax_file(profile_id,action,'#requestfrm4');
			 return false;
   });
   
$("#save_requestfrm5_edit").on("click",function(){
			var profile_id = $("#requestfrm5 #profile_id").val();
             var action = customer_path+'listing_ajax/update_request_info'; 
			 call_ajax_file(profile_id,action,'#requestfrm5');
			 return false;
   });   
   			
$("#save_requestfrm6_edit").on("click",function(){
			var profile_id = $("#requestfrm6 #profile_id").val();
             var action = customer_path+'listing_ajax/update_request_info'; 
			call_ajax_file(profile_id,action,'#requestfrm6');
			return false;
   });

$("#save_requestfrm7_edit").on("click",function(){
			var profile_id = $("#requestfrm7 #profile_id").val();
            var action = customer_path+'listing_ajax/update_request_info'; 
		   call_ajax_file(profile_id,action,'#requestfrm7');
		   return false;
   });
 $("#save_requestfrm8_edit").on("click",function(){
			var profile_id = $("#requestfrm8 #profile_id").val();
            var action = customer_path+'listing_ajax/update_request_info'; 
		   call_ajax_file(profile_id,action,'#requestfrm8');
		   return false;
   });   
   
  $("#save_requestfrm9_edit").on("click",function(){
			var profile_id = $("#requestfrm9 #profile_id").val();
            var action = customer_path+'listing_ajax/update_request_info'; 
		   call_ajax_file(profile_id,action,'#requestfrm9');
		   return false;
   });   
});
</script>
<?php if($request_type=='1'){ ?>
<div class="modal-dialog"> 
  
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <h4>What type of place are you looking for</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
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
			
			$final_place_looking_for=array();
			  if($listing_info->place_looking_for!=''){
			   	  $place_looking_for = explode(",",$listing_info->place_looking_for);
				  if($place_looking_for){
					foreach($place_looking_for as $place_looking_forval){
						$final_place_looking_for[$place_looking_forval]=$place_looking_forval;
					}						
				  }
			  }
			  
			  $config_place_looking_for=$this->config->item('place_looking_for');
			  if($config_place_looking_for){
				  foreach($config_place_looking_for as $place_looking_key =>  $place_looking_list){
					  if(array_key_exists($place_looking_key ,$final_place_looking_for)){  ?>
          <li>
            <input type="checkbox" name="place_looking_for[]" class="hide" id="place_looking_for<?php echo $place_looking_key;?>" value="<?php echo $place_looking_key;?>" checked="true">
            <label for="place_looking_for<?php echo $place_looking_key;?>"><?php echo $place_looking_list;?></label>
          </li>
          <?php }  else { ?>
          <li> 
            <input type="checkbox" name="place_looking_for[]" class="hide" id="place_looking_for<?php echo $place_looking_key;?>" value="<?php echo $place_looking_key;?>">
            <label for="place_looking_for<?php echo $place_looking_key;?>"><?php echo $place_looking_list;?></label>
          </li>
          <?php } ?>
          <?php } } ?>
        </ul>
      </div>
      <hr>
      <div class="form-group">
          <ul class="check_submit">
              <?php if($listing_info->teamups==1){ ?>
         <li>
            <input type="checkbox" name="teamups" class="hide" id="teamups" value="1" checked="true">
            <label for="teamups">Teamups</label>
          </li>     
          <?php }  else { ?>
          <li>
            <input type="checkbox" name="teamups" class="hide" id="teamups" value="1">
            <label for="teamups">Teamups</label>
          </li>   
          <?php } ?>
              
           </ul>
      </div>      
      
      <button type="submit" id="save_requestfrm1_edit" class="btn btn-default btn-success btn-block">Submit</button>
      </form>
    </div>
  </div>
</div>
<?php } ?>

<?php if($request_type=='3'){ ?>
<div class="modal-dialog"> 
  
  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <h4>Rent and timing	</h4>
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
      <div class="form-group">
      
            <div class="form-group">
              <label for="psw">Weekly budget($)</label>
              <?php $data = array('class' =>'form-control', 'name'=> 'weekly_budget', 'id'=> 'weekly_budget','value'=>$listing_info->weekly_budget);
					echo form_input($data); 
				?>
            </div>
             <div class="form-group">
              <label for="psw">Preferred move date</label>
              <?php $data = array('class' =>'form-control','type'=>'date', 'name'=> 'preferred_move_date', 'id'=> 'preferred_move_date','value'=>$listing_info->preferred_move_date);
					echo form_input($data); 
				?>
            </div>
            
              <div class="form-group">
              <label for="psw">Preferred length of stay</label>
              <?php				
			    $length_of_stay = $this->config->item('length_of_stay');									
				echo form_dropdown('length_of_stay', $length_of_stay,$listing_info->length_of_stay,'class="form-control" ');
				?>
            </div>
            
            
      </div>
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
      <h4>Property preferences</h4>
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
      <div class="form-group">
        <label for="psw">Room furnishings</label>
        <ul class="radio_submit">
          <?php
		       $property_reference_rooms = $this->config->item('property_reference_rooms');
			   $final_reference_rooms=array();
			  if($preferences_info && $preferences_info->room_furnishings!=''){
			   	  $room_furnishings = explode(",",$preferences_info->room_furnishings);
				  if($room_furnishings){
					foreach($room_furnishings as $room_furnishingsval){
						$final_reference_rooms[$room_furnishingsval]=$room_furnishingsval;
					}						
				  }
			  }
			  			
				 foreach($property_reference_rooms as $reference_rooms_key =>  $reference_rooms_val){
					  if(array_key_exists($reference_rooms_key ,$final_reference_rooms)){
				  ?>
       			   <li>
            <input type="radio" name="room_furnishings" class="hide" id="room_furnishings<?php echo $reference_rooms_key;?>" value="<?php echo $reference_rooms_key;?>" checked>
            <label for="room_furnishings<?php echo $reference_rooms_key;?>"><?php echo $reference_rooms_val;?></label>
          </li>
       		   <?php } else { ?>
       			   <li>
            <input type="radio" name="room_furnishings" class="hide" id="room_furnishings<?php echo $reference_rooms_key;?>" value="<?php echo $reference_rooms_key;?>">
            <label for="room_furnishings<?php echo $reference_rooms_key;?>"><?php echo $reference_rooms_val;?></label>
          </li>
        	      <?php } ?>
               <?php } ?>
        </ul>
      </div>
      
      <div class="form-group">
        <label for="psw">Internet</label>
        <ul class="radio_submit">
          <?php
		       $property_reference_internet = $this->config->item('property_reference_internet');
			   $final_reference_internet=array();
			  if($preferences_info && $preferences_info->internet!=''){
			   	  $reference_internet = explode(",",$preferences_info->internet);
				  if($reference_internet){
					foreach($reference_internet as $reference_internetval){
						$final_reference_internet[$reference_internetval]=$reference_internetval;
					}						
				  }
			  }
			  			
				 foreach($property_reference_internet as $reference_internet_key =>  $reference_internet_val){
					  if(array_key_exists($reference_internet_key ,$final_reference_internet)){
				  ?>
       			   <li>
            <input type="radio" name="internet" class="hide" id="internet<?php echo $reference_internet_key;?>" value="<?php echo $reference_internet_key;?>" checked>
            <label for="internet<?php echo $reference_internet_key;?>"><?php echo $reference_internet_val;?></label>
          </li>
       		   <?php } else { ?>
       			   <li>
            <input type="radio" name="internet" class="hide" id="internet<?php echo $reference_internet_key;?>" value="<?php echo $reference_internet_key;?>">
            <label for="internet<?php echo $reference_internet_key;?>"><?php echo $reference_internet_val;?></label>
          </li>
        	      <?php } ?>
               <?php } ?>
        </ul>
      </div>
      
      <div class="form-group">
        <label for="psw">Bathroom type</label>
        <ul class="radio_submit">
          <?php
		       $property_reference_bathroom = $this->config->item('property_reference_bathroom');
			   $final_reference_bathroom=array();
			  if($preferences_info && $preferences_info->bathroom_type!=''){
			   	  $bathroom_type = explode(",",$preferences_info->bathroom_type);
				  if($bathroom_type){
					foreach($bathroom_type as $bathroom_typeval){
						$final_reference_bathroom[$bathroom_typeval]=$bathroom_typeval;
					}						
				  }
			  }
			  			
				 foreach($property_reference_bathroom as $reference_bathroom_key =>  $reference_bathroom_val){
					  if(array_key_exists($reference_bathroom_key ,$final_reference_bathroom)){
				  ?>
       			   <li>
            <input type="radio" name="bathroom_type" class="hide" id="bathroom_type<?php echo $reference_bathroom_key;?>" value="<?php echo $reference_bathroom_key;?>" checked>
            <label for="bathroom_type<?php echo $reference_bathroom_key;?>"><?php echo $reference_bathroom_val;?></label>
          </li>
       		   <?php } else { ?>
       			    <li>
            <input type="radio" name="bathroom_type" class="hide" id="bathroom_type<?php echo $reference_bathroom_key;?>" value="<?php echo $reference_bathroom_key;?>">
            <label for="bathroom_type<?php echo $reference_bathroom_key;?>"><?php echo $reference_bathroom_val;?></label>
          </li>
        	      <?php } ?>
               <?php } ?>
        </ul>
      </div>
      
      <div class="form-group">
        <label for="psw">Parking</label>
        <ul class="radio_submit">
          <?php
		       $property_reference_parking = $this->config->item('property_reference_parking');
			   $final_reference_parking=array();
			  if($preferences_info && $preferences_info->parking!=''){
			   	  $parking = explode(",",$preferences_info->parking);
				  if($parking){
					foreach($parking as $parkingval){
						$final_reference_parking[$parkingval]=$parkingval;
					}						
				  }
			  }
			  			
				 foreach($property_reference_parking as $reference_parking_key =>  $reference_parking_val){
					  if(array_key_exists($reference_parking_key ,$final_reference_parking)){
				  ?>
       			   <li>
            <input type="radio" name="parking" class="hide" id="parking<?php echo $reference_parking_key;?>" value="<?php echo $reference_parking_key;?>" checked>
            <label for="parking<?php echo $reference_parking_key;?>"><?php echo $reference_parking_val;?></label>
          </li>
       		   <?php } else { ?>
       			   <li>
            <input type="radio" name="parking" class="hide" id="parking<?php echo $reference_parking_key;?>" value="<?php echo $reference_parking_key;?>" >
            <label for="parking<?php echo $reference_parking_key;?>"><?php echo $reference_parking_val;?></label>
          </li>
        	      <?php } ?>
               <?php } ?>
        </ul>
      </div>
      <div class="form-group">
      
        <label for="psw">Max number of flatmates</label>
        <div class="row">
          <?php
		       $property_reference_maxflatmates = $this->config->item('property_reference_maxflatmates');
			   $final_reference_maxflatmates=array();
			  if($preferences_info && $preferences_info->no_of_flatmates!=''){
			   	  $no_of_flatmates = explode(",",$preferences_info->no_of_flatmates);
				  if($no_of_flatmates){
					foreach($no_of_flatmates as $no_of_flatmatesval){
						$final_reference_maxflatmates[$no_of_flatmatesval]=$no_of_flatmatesval;
					}						
				  }
			  }
			  			
				 foreach($property_reference_maxflatmates as $reference_maxflatmates_key =>  $reference_maxflatmates_val){
					  if(array_key_exists($reference_maxflatmates_key ,$final_reference_maxflatmates)){
				  ?>
				   <div class="col-lg-6 col-md-6">
                   <ul class="radio_submit"> 
       			   <li>
            <input type="radio" name="no_of_flatmates" class="hide" id="no_of_flatmates<?php echo $reference_maxflatmates_key;?>" value="<?php echo $reference_maxflatmates_key;?>" checked>
            <label for="no_of_flatmates<?php echo $reference_maxflatmates_key;?>"><?php echo $reference_maxflatmates_val;?></label>
          </li></ul></div>
       		   <?php } else { ?>
       		   <div class="col-lg-6 col-md-6">
                   <ul class="radio_submit">
       			   <li>
            <input type="radio" name="no_of_flatmates" class="hide" id="no_of_flatmates<?php echo $reference_maxflatmates_key;?>" value="<?php echo $reference_maxflatmates_key;?>">
            <label for="no_of_flatmates<?php echo $reference_maxflatmates_key;?>"><?php echo $reference_maxflatmates_val;?></label>
          </li></ul></div>
        	      <?php } ?>
               <?php } ?>
        </ul>
      </div> </div>
      
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
      <h4>About you</h4>
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
			     echo form_open_multipart('#', $attributes);
				 echo form_hidden('profile_id',$profile_id);
				 echo form_hidden('request_type',5);							
		   ?>
      <div class="form-group">
        <label for="psw">This place is for</label>
        <ul class="radio_submit">
          <?php
		      $placeisfor_status = $this->config->item('placeisfor_status');
			  $final_place_is_for=array();
			  if($listing_info->place_is_for!=''){
			   	  $place_is_forinfo = explode(",",$listing_info->place_is_for);
				  if($place_is_forinfo){
					foreach($place_is_forinfo as $place_is_forinfoval){
						$final_place_is_for[$place_is_forinfoval]=$place_is_forinfoval;
					}						
				  }
			  }
			  if($placeisfor_status){
				  foreach($placeisfor_status as $placeisfor_status_key =>  $placeisfor_status_val){
					  if(array_key_exists($placeisfor_status_key ,$final_place_is_for)){
				  ?>
          <li>
            <input type="radio" name="place_is_for" class="hide" id="place_is_for<?php echo $placeisfor_status_key;?>" value="<?php echo $placeisfor_status_key;?>" checked>
            <label for="place_is_for<?php echo $placeisfor_status_key;?>"><?php echo $placeisfor_status_val;?></label>
          </li>
          <?php } else { ?>
          <li>
            <input type="radio" name="place_is_for" class="hide" id="place_is_for<?php echo $placeisfor_status_key;?>" value="<?php echo $placeisfor_status_key;?>">
            <label for="place_is_for<?php echo $placeisfor_status_key;?>"><?php echo $placeisfor_status_val;?></label>
          </li>
          <?php } ?>
          <?php } } ?>
        </ul>
      </div>
      
      <div id="me_div">
    	
       <div class="form-group">
              <label for="psw">Your first name</label>
              <?php $data = array('class' =>'form-control', 'name'=> 'me_firstname', 'id'=> 'me_firstname','value'=>$listing_info->me_firstname);
					echo form_input($data); 
				?>
            </div>
       <div class="form-group">
              <label for="psw">Your age</label>
              <?php $data = array('class' =>'form-control', 'name'=> 'me_age', 'id'=> 'me_age','value'=>$listing_info->me_age);
					echo form_input($data); 
				?>
            </div>
       <div class="form-group">
              <label for="psw">The gender you identify with</label>
             <ul class="radio_submit">
          <?php
		      $gender_you_identify = $this->config->item('gender_you_identify');
			  $final_gender_you_identify=array();
			  if($listing_info->me_gender!=''){
			   	  $me_gender_forinfo = explode(",",$listing_info->me_gender);
				  if($me_gender_forinfo){
					foreach($me_gender_forinfo as $me_genderfoval){
						$final_gender_you_identify[$me_genderfoval]=$me_genderfoval;
					}						
				  }
			  }
			  if($gender_you_identify){
				  foreach($gender_you_identify as $gender_you_identify_key =>  $gender_you_identify_val){
					  if(array_key_exists($placeisfor_status_key ,$final_gender_you_identify)){
				  ?>
          <li>
            <input type="radio" name="me_gender" class="hide" id="me_gender<?php echo $gender_you_identify_key;?>" value="<?php echo $gender_you_identify_key;?>" checked>
            <label for="me_gender<?php echo $gender_you_identify_key;?>"><?php echo $gender_you_identify_val;?></label>
          </li>
          <?php } else { ?>
          <li>
            <input type="radio" name="me_gender" class="hide" id="me_gender<?php echo $gender_you_identify_key;?>" value="<?php echo $gender_you_identify_key;?>">
            <label for="me_gender<?php echo $gender_you_identify_key;?>"><?php echo $gender_you_identify_val;?></label>
          </li>
          <?php } ?>
          <?php } } ?>
        </ul>
            </div>
      </div>      
      <div id="couple_div" style="display:none;">
         <div class="form-group">
              <label for="psw">Your partner's first name</label>
              <?php $data = array('class' =>'form-control', 'name'=> 'partner_firstname', 'id'=> 'partner_firstname','value'=>'');
					echo form_input($data); 
				?>
            </div>
         <div class="form-group">
              <label for="psw">Your partner's age</label>
              <?php $data = array('class' =>'form-control', 'name'=> 'partner_age', 'id'=> 'partner_age','value'=>'');
					echo form_input($data); 
				?>
            </div>
         <div class="form-group">
              <label for="psw">The gender your partner identifies with</label>
             <ul class="radio_submit">
          <?php
		      $gender_you_identify = $this->config->item('gender_you_identify');
			  $final_gender_you_identify=array();
			  if($listing_info->me_gender!=''){
			   	  $me_gender_forinfo = explode(",",$listing_info->me_gender);
				  if($me_gender_forinfo){
					foreach($me_gender_forinfo as $me_genderfoval){
						$final_gender_you_identify[$me_genderfoval]=$me_genderfoval;
					}						
				  }
			  }
			  if($gender_you_identify){
				  foreach($gender_you_identify as $gender_you_identify_key =>  $gender_you_identify_val){
					  if(@array_key_exists($placeisfor_status_key ,$final_gender_you_identify)){
				  ?>
          <li>
            <input type="radio" name="partner_gender" class="hide" id="partner_gender<?php echo $gender_you_identify_key;?>" value="<?php echo $gender_you_identify_key;?>" checked>
            <label for="partner_gender<?php echo $gender_you_identify_key;?>"><?php echo $gender_you_identify_val;?></label>
          </li>
          <?php } else { ?>
          <li>
            <input type="radio" name="partner_gender" class="hide" id="partner_gender<?php echo $gender_you_identify_key;?>" value="<?php echo $gender_you_identify_key;?>">
            <label for="partner_gender<?php echo $gender_you_identify_key;?>"><?php echo $gender_you_identify_val;?></label>
          </li>
          <?php } ?>
          <?php } } ?>
        </ul>
            </div>
      </div>      
            
      <div id="group_div"  style="display:none;">
         <div class="form-group">
              <label for="psw">Your friend's first name</label>
              <?php $data = array('class' =>'form-control', 'name'=> 'friends_firstname[]', 'id'=> 'friends_firstname','value'=>'');
					echo form_input($data); 
				?>
            </div>
         <div class="form-group">
              <label for="psw">Your friend's age</label>
              <?php $data = array('class' =>'form-control', 'name'=> 'friends_age[]', 'id'=> 'friends_age','value'=>'');
					echo form_input($data); 
				?>
            </div>
         <div class="form-group">
              <label for="psw">The gender your friend identifies with</label>
             <ul class="radio_submit">
          <?php
		      $gender_you_identify = $this->config->item('gender_you_identify');
			  $final_gender_you_identify=array();
			  if($listing_info->me_gender!=''){
			   	  $me_gender_forinfo = explode(",",$listing_info->me_gender);
				  if($me_gender_forinfo){
					foreach($me_gender_forinfo as $me_genderfoval){
						$final_gender_you_identify[$me_genderfoval]=$me_genderfoval;
					}						
				  }
			  }
			  if($gender_you_identify){
				  foreach($gender_you_identify as $gender_you_identify_key =>  $gender_you_identify_val){
					  if(@array_key_exists($placeisfor_status_key ,$final_gender_you_identify)){
				  ?>
          <li>
            <input type="radio" name="friends_gender[]" class="hide" id="friends_gender<?php echo $gender_you_identify_key;?>" value="<?php echo $gender_you_identify_key;?>" checked>
            <label for="friends_gender<?php echo $gender_you_identify_key;?>"><?php echo $gender_you_identify_val;?></label>
          </li>
          <?php } else { ?>
          <li>
            <input type="radio" name="friends_gender[]" class="hide" id="friends_gender<?php echo $gender_you_identify_key;?>" value="<?php echo $gender_you_identify_key;?>">
            <label for="friends_gender<?php echo $gender_you_identify_key;?>"><?php echo $gender_you_identify_val;?></label>
          </li>
          <?php } ?>
          <?php } } ?>
        </ul>
            </div>
      
      </div>      
            
            
      <div class="form-group" style="display:none;">
              <label for="psw">Profile Pic</label>
              <input type="file" name="" />
            </div>
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
      <h4>Employment Status</h4>
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
		   ?>
      <div class="row">
       
        
          <?php
		      $employment_status = $this->config->item('employment_status');
			  $final_employment_status=array();
			  if($listing_info && $listing_info->employment_status!=''){
			   	  $employment_status_info = explode(",",$listing_info->employment_status);
				  if($employment_status_info){
					foreach($employment_status_info as $employment_statusval){
						$final_employment_status[$employment_statusval]=$employment_statusval;
					}						
				  }
			  }
			  if($employment_status){
				  foreach($employment_status as $employment_status_key =>  $employment_status_val){
					  if(array_key_exists($employment_status_key ,$final_employment_status)){
				  ?>
				  <div class="col-lg-6 col-md-6">
                   <ul class="radio_submit"> 
          <li>
            <input type="radio" name="employment_status[]" class="hide" id="employment_status<?php echo $employment_status_key;?>" value="<?php echo $employment_status_key;?>" checked>
            <label for="employment_status<?php echo $employment_status_key;?>"><?php echo $employment_status_val;?></label>
          </li></ul></div>
          <?php } else { ?>
          <div class="col-lg-6 col-md-6">
                   <ul class="radio_submit">
          <li>
            <input type="radio" name="employment_status[]" class="hide" id="employment_status<?php echo $employment_status_key;?>" value="<?php echo $employment_status_key;?>">
            <label for="employment_status<?php echo $employment_status_key;?>"><?php echo $employment_status_val;?></label>
          </li></ul></div>
          <?php } ?>
          <?php } } ?>
        
      </div>
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
      <h4>Lifestyle</h4>
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
		   ?>
      <div class="form-group">
       
        <ul class="check_submit">
          <?php
		      $lifestyle_status = $this->config->item('lifestyle_status');
			  $final_lifestyle_status=array();
			  if($listing_info && $listing_info->life_style!=''){
			   	  $life_style_info = explode(",",$listing_info->life_style);
				  if($life_style_info){
					foreach($life_style_info as $life_style_infosval){
						$final_lifestyle_status[$life_style_infosval]=$life_style_infosval;
					}						
				  }
			  }
			  if($lifestyle_status){
				  foreach($lifestyle_status as $lifestyle_status_key =>  $lifestyle_status_val){
					  if(array_key_exists($lifestyle_status_key ,$final_lifestyle_status)){
				  ?>
          <li>
            <input type="checkbox" name="life_style[]" class="hide" id="life_style<?php echo $lifestyle_status_key;?>" value="<?php echo $lifestyle_status_key;?>" checked>
            <label for="life_style<?php echo $lifestyle_status_key;?>"><?php echo $lifestyle_status_val;?></label>
          </li>
          <?php } else { ?>
          <li>
            <input type="checkbox" name="life_style[]" class="hide" id="life_style<?php echo $lifestyle_status_key;?>" value="<?php echo $lifestyle_status_key;?>">
            <label for="life_style<?php echo $lifestyle_status_key;?>"><?php echo $lifestyle_status_val;?></label>
          </li>
          <?php } ?>
          <?php } } ?>
        </ul>
      </div>
      
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
      <h4>What makes you great to live with?</h4>
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
		   ?>
      <div class="form-group">
       <textarea  name="great_live_with_text" class="form-control" id="great_live_with_text"  style="height:200px;"><?php echo $listing_info->great_live_with_text;?></textarea>
        
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
      <h4>Preferred Language,Flatmate Preference & Accepting</h4>
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
              <label for="psw">Choose Language</label>
              <?php				
			    $preferred_language_list = $this->config->item('preferred_language_list');									
				echo form_dropdown('preferred_language', $preferred_language_list,$listing_info->preferred_language,'class="form-control" id="preferred_language" ');
				?>
              
            </div>	   
	
	  <div class="form-group">
              <label for="psw">Flatmate Preference</label>
             <?php				
			    $flatmatespref_status = $this->config->item('flatmatespref_status');		
			    if(isset($flatmatepreferrences->preference))
			     $sel_preference = $flatmatepreferrences->preference;
			     else
			     $sel_preference ='';
				echo form_dropdown('preference', $flatmatespref_status,$sel_preference,'class="form-control" id="flatmatespref_status" ');
				?>
            </div>
            
      <div class="form-group">
       <label for="psw">Accepting</label>
       <div class="row">
        
          <?php
		      $flatmatespref_accepting = $this->config->item('flatmatespref_accepting');
			  $final_accepting_status=array();
			  if($flatmatepreferrences && $flatmatepreferrences->accepting!=''){
			   	  $accepting_style_info = explode(",",$flatmatepreferrences->accepting);
				  if($accepting_style_info){
					foreach($accepting_style_info as $accepting_style_infoval){
						$final_accepting_status[$accepting_style_infoval]=$flatmatespref_accepting[$accepting_style_infoval];
					}						
				  }
			  }
			  if($flatmatespref_accepting){
				  foreach($flatmatespref_accepting as $final_accepting_status_key =>  $final_accepting_status_val){
					  if(array_key_exists($final_accepting_status_key ,$final_accepting_status)){
				  ?>
				  <div class="col-lg-4 col-md-4"> 
				  <ul class="check_submit">
          <li>
            <input type="checkbox" name="accepting[]" class="hide" id="accepting<?php echo $final_accepting_status_key;?>" value="<?php echo $final_accepting_status_key;?>" checked>
            <label for="accepting<?php echo $final_accepting_status_key;?>"><?php echo $final_accepting_status_val;?></label>
          </li>
          </ul>
          </div>
          <?php } else { ?>
          <div class="col-lg-4 col-md-4"> 
          <ul class="check_submit">
          <li>
            <input type="checkbox" name="accepting[]" class="hide" id="accepting<?php echo $final_accepting_status_key;?>" value="<?php echo $final_accepting_status_key;?>">
            <label for="accepting<?php echo $final_accepting_status_key;?>"><?php echo $final_accepting_status_val;?></label>
          </li>
          </ul>
          </div>
          <?php } ?>
          <?php } } 
          ?>
          </div>
          
        </ul>
      </div>
      
      <button type="submit" id="save_requestfrm9_edit" class="btn btn-default btn-success btn-block">Submit</button>
      </form>
    </div>
  </div>
</div>
<?php } ?>
