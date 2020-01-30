<?php
$header = array('title' => 'About Profile');
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
[type="radio"] {
display:inline-block;
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
            <h4 class="color-primary mb-4">About Profile</h4>
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
                                <?php  $attributes = array('id' => 'requestfrm5','name' => 'requestfrm5','role' => 'form','autocomplete' => 'off');
			     echo form_open_multipart(customer_path().'listings/update_about/'.$profile_id.'/submit', $attributes);
				 echo form_hidden('profile_id',$profile_id);
				 echo form_hidden('request_type',5);							
		   ?>
                              <div class="row">
                               <div class="col-lg-12 col-md-12">
												<div class="form-group">
												    <label>This place is for</label>
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
								</div>
								
							 <div class="col-lg-12 col-md-12">
											<div class="form-group">
              <label>Your first name</label>
              <?php $data = array('class' =>'form-control', 'name'=> 'me_firstname', 'id'=> 'me_firstname','value'=>$listing_info->me_firstname);
					echo form_input($data); 
				?>
            </div>
								</div>
								
				<div class="col-lg-12 col-md-12">
										<div class="form-group">
              <label>Your age</label>
              <?php $data = array('class' =>'form-control', 'name'=> 'me_age', 'id'=> 'me_age','value'=>$listing_info->me_age);
					echo form_input($data); 
				?>
            </div>
								</div>
								
			<div class="col-lg-12 col-md-12">
										<div class="form-group">
              <label>The gender you identify with</label>
             <ul class="radio_submit">
          <?php
		      $gender_you_identify = $this->config->item('gender_you_identify');
		
			  if($gender_you_identify){
				  foreach($gender_you_identify as $gender_you_identify_key =>  $gender_you_identify_val){
					  if($gender_you_identify_key==$listing_info->me_gender){
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
								                              </div>
								        <?php
								        if($listing_info->place_is_for==2)
								          $couple_display='';    
								            
								        else
								        $couple_display='style="display:none;"';
								        ?>
								                              
                              <div class="row" id="couple_div" <?php echo  $couple_display;?>>
                                  <?php
                                  if($customer_couple_info){
                                      $partner_name = $customer_couple_info->partner_first_name;
                                      $partner_age = $customer_couple_info->partner_age;
                                      $partner_gender = $customer_couple_info->partner_gender;
                                      
                                      
                                      
                                  }
                                  else{
                                   $partner_name = '';
                                      $partner_age = '';
                                      $partner_gender ='';
                                      
                                  }
                                  ?>
                                  
                                  
                                  
                               <div class="col-lg-12 col-md-12">
											<div class="form-group">
              <label for="psw">Your partner's first name</label>
              <?php $data = array('class' =>'form-control', 'name'=> 'partner_firstname', 'id'=> 'partner_firstname','value'=>$partner_name);
					echo form_input($data); 
				?>
            </div>
								</div>
								
							 <div class="col-lg-12 col-md-12">
										<div class="form-group">
              <label for="psw">Your partner's age</label>
              <?php $data = array('class' =>'form-control', 'name'=> 'partner_age', 'id'=> 'partner_age','value'=>$partner_age);
					echo form_input($data); 
				?>
            </div>
								</div>
								
		                		<div class="col-lg-12 col-md-12">
								<div class="form-group">
              <label for="psw">The gender your partner identifies with</label>
             <ul class="radio_submit">
          <?php
		      $gender_you_identify = $this->config->item('gender_you_identify');
			  
			  if($gender_you_identify){
				  foreach($gender_you_identify as $gender_you_identify_key =>  $gender_you_identify_val){
					  if($partner_gender==$gender_you_identify_key ){
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
								
		
								                              </div>
                             
                             <?php
                                if($listing_info->place_is_for==3)
								          $group_display='';    
								            
								        else
								        $group_display='style="display:none;"';
								        ?>
                             
                              <div class="row" id="group_div" <?php echo  $group_display;?>>
                                  
                                  
                               <?php if($customer_group_info){ ?>   
                               <?php $grpcounter=500;
                               foreach($customer_group_info as $grpkey => $grpval){  $grpcounter++;?>
                               <div class="row extradivs"  id="room<?php echo  $grpcounter;?>">
                                  <a href="javascript:void(0);" style="float:right;" class="remove_room" data-id="<?php echo  $grpcounter;?>">Remove</a>
                                   <div class="col-lg-12 col-md-12">
                                       <div class="form-group"> 
                                            <label>Your friend's first name</label> 
                                             <input type="text" name="friends_firstname[]" value="<?php echo  $grpval->friends_name;?>" class="form-control"> 
                                         </div>
                                         </div>
                                   <div class="col-lg-12 col-md-12"><div class="form-group"> 
                                   <label>Your friend's age</label> 
                                   <input type="text" name="friends_age[]" value="<?php echo  $grpval->age;?>" class="form-control"> 
                                   </div></div>
                                   <div class="col-lg-12 col-md-12"><div class="form-group">
                                     <label>The gender your friend identifies with</label>
                                     <ul class="radio_submit">
                                        <?php if($grpval->gender_identify==1){ ?>
                                        <li> <input type="radio" name="friends_gender<?php echo $grpkey;?>[]" class="hide" id="friends_gender<?php echo $grpkey;?>" value="1" checked> 
                                        <label for="friends_gender<?php echo $grpkey;?>">Female</label>
                                        </li>     
                                        <li>  
                                        <input type="radio" name="friends_gender<?php echo $grpkey;?>[]" class="hide" id="friends_gender<?php echo $grpkey;?>" value="2"> 
                                        <label for="friends_gender<?php echo $grpkey;?>">Male</label> 
                                        </li>                 
                                        <?php } elseif($grpval->gender_identify==2){ ?>
                                         <li> <input type="radio" name="friends_gender<?php echo $grpkey;?>[]" class="hide" id="friends_gender<?php echo $grpkey;?>" value="1"> 
                                        <label for="friends_gender<?php echo $grpkey;?>">Female</label>
                                        </li>     
                                        <li>  
                                        <input type="radio" name="friends_gender<?php echo $grpkey;?>[]" class="hide" id="friends_gender<?php echo $grpkey;?>" value="2" checked> 
                                        <label for="friends_gender<?php echo $grpkey;?>">Male</label> 
                                        </li>    
                                        <?php } else { ?>
                                         <li> <input type="radio" name="friends_gender<?php echo $grpkey;?>[]" class="hide" id="friends_gender<?php echo $grpkey;?>" value="1"> 
                                        <label for="friends_gender<?php echo $grpkey;?>">Female</label>
                                        </li>     
                                        <li>  
                                        <input type="radio" name="friends_gender<?php echo $grpkey;?>[]" class="hide" id="friends_gender<?php echo $grpkey;?>" value="2"> 
                                        <label for="friends_gender<?php echo $grpkey;?>">Male</label> 
                                        </li>    
                                        
                                        <?php } ?>
                                        
                                        </ul>       
                                        </div></div>  
                                        </div>   
                                  <?php } ?>
                                  <?php } ?>
                                 
                              </div>
                               
		
								                             
                                <div class="row"> 							
                                		<div class="col-lg-12 col-md-12"><div class="form-group">
                                              <label>Profile Pic</label>
                                              <input type="file" name="profile_pic" class="form-control" />
                                            </div>
											</div></div>
					                             
                                <div class="row"> 							
	                        	<div class="col-lg-12 col-md-12"><div class="form-group">						
											
				                    	<button type="submit"  class="btn btn-default btn-success btn-block">Submit</button>						
									</div></div>		
                              </form>
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


<?php 
$below_app_js=array();
$this->load->view('includes/footer',array('below_app_js'=>$below_app_js)); ?>
<script type="text/javascript">//<![CDATA[

    $(function(){
     	var room_counter=200;
     	var newroom_counter=100;
    $(document).on("click","#addmore_rooms", function (e) {	
	 room_counter=room_counter+1;	 
	 
	 newroom_counter =parseInt(newroom_counter)+parseInt(room_counter);
	 fcounter=parseInt(newroom_counter)+1;
	 
	 alert(newroom_counter);
	 if(room_counter>=1)
	 var urllink ='<a href="javascript:void(0);" style="float:right;" class="remove_room" data-id="'+room_counter+'">Remove</a>';
	 else
	 var urllink ='<a href="javascript:void(0);" style="float:right;" id="addmore_rooms">Add More</a>';
	 
	 
	 $(".extradivs").after('<div class="row extradivs" id="room'+room_counter+'">'+urllink+' <div class="col-lg-12 col-md-12"><div class="form-group">              <label>Your friend\'s first name</label>              <input type="text" name="friends_firstname[]" value="" class="form-control">            </div></div><div class="col-lg-12 col-md-12"><div class="form-group">              <label>Your friend\'s age</label>              <input type="text" name="friends_age[]" value="" class="form-control" >            </div></div><div class="col-lg-12 col-md-12"><div class="form-group">              <label>The gender your friend identifies with</label>             <ul class="radio_submit">                    <li>            <input type="radio" name="friends_gender'+room_counter+'[]" class="hide" id="friends_gender'+newroom_counter+'" value="1">            <label for="friends_gender'+newroom_counter+'">Female</label>          </li>                              <li>            <input type="radio" name="friends_gender'+room_counter+'[]" class="hide" id="friends_gender'+fcounter+'" value="2">            <label for="friends_gender'+fcounter+'">Male</label>          </li>                            </ul>            </div></div>                              </div>');
	 
	 $("#room"+room_counter).show();
	 
 });

$(document).on("click",".remove_room", function (e) {
	 var roomid = $(this).attr("data-id");
	 $("#room"+roomid+"").remove();
 });
	   
        
      	$('input[name="place_is_for"]:radio').change(function () {	
	var room_counter=50;	
	var newroom_counter=100;
		var place_is_for_id = ($(this).val());
		if(place_is_for_id==1){			
		  $("#couple_div").hide();
		  $("#group_div").hide();
		}
		else if(place_is_for_id==2){	
		  $("#couple_div").show();	
		  $("#group_div").hide();
		  
		  $(".extradivs").remove();
		  
		  
		  
		}		
		else if(place_is_for_id==3){	
		    var urllink ='<a href="javascript:void(0);" style="float:right;" id="addmore_rooms">Add More</a>';
		   $("#couple_div").hide();
		  // $("#group_div").show();
		   
		    room_counter=room_counter+1;
		    
		    newroom_counter =parseInt(room_counter)+parseInt(1);
	$("#group_div").after('<div class="row extradivs" id="room'+room_counter+'">'+urllink+' <div class="col-lg-12 col-md-12"><div class="form-group">              <label>Your friend\'s first name</label>              <input type="text" name="friends_firstname[]" value="yuuuy" class="form-control">            </div></div><div class="col-lg-12 col-md-12"><div class="form-group">              <label>Your friend\'s age</label>              <input type="text" name="friends_age[]" value="" class="form-control" >            </div></div><div class="col-lg-12 col-md-12"><div class="form-group">              <label>The gender your friend identifies with</label>             <ul class="radio_submit">                    <li>            <input type="radio" name="friends_gender[]" class="hide" id="friends_gender'+room_counter+'" value="1">            <label for="friends_gender'+room_counter+'">Female</label>          </li>                              <li>            <input type="radio" name="friends_gender[]" class="hide" id="friends_gender'+newroom_counter+'" value="2">            <label for="friends_gender'+newroom_counter+'">Male</label>          </li>                            </ul>            </div></div>                              </div>'); 
	 $("#room"+room_counter).show();
		   
		}		
	});  
        


    });

  //]]></script>

