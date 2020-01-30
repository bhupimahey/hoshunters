<?php
$header = array('title' => 'Find a place');
$this->external->set_css(array(base_url().'css/steps.css',base_url().'fonts/material-design-iconic-font/css/material-design-iconic-font.css',base_url().'jsupload/js/jquery.ui.plupload.css'));
$this->load->view('includes/header', $header);

?>
<body>
<style>
[type="radio"] {
display:inline-block;
}
</style>
<?php $this->load->view('includes/pages_inner_header'); ?>
<div class="page-banner bg-gray">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-12">
        <div class="breadcrumbs color-secondery">
          <ul>
            <li class="hover_gray"><a href="<?php echo base_url();?>">Home</a></li>
            <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
            <li class="color-default">Find a place</li>
          </ul>
        </div>
        <div class="float-right color-primary">
          <h3 class="banner-title font-weight-bold">Find a place</h3>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="wrapper container cust-wrap"> 
   <?php  $attributes = array('id' => 'wizard','name' => 'listmyplacefrm','role' => 'form','autocomplete' => 'off');
	     echo form_open_multipart(customer_path().'listings/find_a_place/submit', $attributes);					
    ?>
    <!-- SECTION 1 -->
    <h2></h2>
    <section>
      <div class="inner">
        <div class="image-holder" style="background-image:url(<?php echo base_url();?>images/form-wizard-1.jpg)"></div>
        <div class="form-content" >
          <div class="form-header">
            <h3>What type of place are you looking for</h3>
          </div>
          <div class="row">
                  <?php
		      $place_looking_for = $this->config->item('place_looking_for');
			  
			  if($place_looking_for){
				  foreach($place_looking_for as $place_looking_key =>  $place_looking_val){					 
				  ?>
                  <div class="col-md-6">
                   <ul class="check_submit"> 
                  <li>
                    <input type="checkbox" name="place_looking_for[]" class="hide" id="place_looking_for<?php echo $place_looking_key;?>" value="<?php echo $place_looking_key;?>">
                    <label for="place_looking_for<?php echo $place_looking_key;?>"><?php echo $place_looking_val;?></label>
                  </li>
                  </ul>
                  </div>
                  <?php } } ?>
                  </div>
          
          
        
          <div class="row">
              
                  <div class="col-lg-12 col-md-12">
                   <ul class="check_submit"> 
                  <li>
                    <input type="checkbox" name="teamups" class="hide" id="teamups" value="1" checked>
                    <label for="teamups">Teamups</label><br>
                    <small>Teamups are when you get together with others who are looking for accommodation and start a new share house together.</small>
                  </li>
                  </ul>
                  </div>
                
                  </div>
        </div>
      </div>
    </section>
    
    <!-- SECTION 2 -->
    <h2></h2>
    <section>
      <div class="inner">
        <div class="image-holder" style="background-image:url(<?php echo base_url();?>images/form-wizard-2.jpg)"> </div>
        <div class="form-content">
          <div class="form-header">
            <h3>Where would you like to live?</h3>
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
                  
                <label>Suburb</label>
                <small>We recommend choosing at least 4 suburbs</small>
                
                
                <div class="row">
                 <div class="col-lg-12 col-md-12">
                   <a href="javascript:void(0);" class="btn btn-default1" id="new">Add address</a>
                </div></div>
                <input type="hidden" name="street[]" id="street" value=''>
		        <input type="hidden" name="country[]" id="country" value=''>
		        <input type="hidden" name="latitude[]" id="latitude" value=''>
		        <input type="hidden" name="longitude[]" id="longitude" value=''>
		        <input type="hidden" name="state[]" id="state" value=''>
		        <input type="hidden" name="city[]" id="city" value=''>
		        <input type="hidden" name="postal_code[]" id="postal_code" value=''>        
                        
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </section>
    
    <!-- SECTION 3 -->
    <h2></h2>
    <section>
      <div class="inner">
        <div class="image-holder" style="background-image:url(<?php echo base_url();?>images/form-wizard-3.jpg)"></div>
        <div class="form-content">
          <div class="form-header">
            <h3>Rent and timing</h3>
          </div>
          <div class="row" id="mainrow">
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
                <label>Weekly budget</label>
                <?php $data = array('class' =>'form-control', 'name'=> 'weekly_budget', 'id'=> 'weekly_budget',"required"=>"true","value"=>set_value("weekly_budget"),'maxlength'=>'5');
                    	echo form_input($data); ?>
              </div>
            </div>
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
                <label>Preferred move date</label>
                <?php $data = array('class' =>'form-control dateavailable','name'=> 'preferred_move_date', 'id'=> 'preferred_move_date',"required"=>"true","value"=>set_value("preferred_move_date"));
                    	echo form_input($data); ?>
              </div>
            </div>
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
                <label>Preferred length of stay</label>
               <?php				
			    $length_of_stay = $this->config->item('length_of_stay');									
				echo form_dropdown('length_of_stay', $length_of_stay,set_value("length_of_stay"),'class="form-control" ');
				?>
              </div>
            </div>
          </div>
         
        </div>
      </div>
    </section>
    
    <!-- SECTION 4 -->
    <h2></h2>
    <section>
      <div class="inner">
        <div class="image-holder" style="background-image:url(<?php echo base_url();?>images/property_perference.jpg)"> </div>
        <div class="form-content">
          <div class="form-header">
            <h3>Property preferences</h3>
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
                <label>Room furnishings</label>
                <?php				
			    $roomfurnishings_status = $this->config->item('roomfurnishings_status');									
				echo form_dropdown('room_furnishings', $roomfurnishings_status,set_value('room_furnishings'),'class="form-control" id="room_furnishings" ');
				?>
              </div>
            </div>
            <div class="col-lg-12 col-md-12">
             <div class="form-group">
                <label>Internet</label>
                <?php				
			    $internet_status = $this->config->item('property_reference_internet');									
				echo form_dropdown('internet', $internet_status,set_value('internet'),'class="form-control" ');
				?>
              </div>
            </div>
              <div class="col-lg-12 col-md-12">
             <div class="form-group">
                <label>Bathroom type</label>
                <?php				
			    $bathrooms_status = $this->config->item('property_reference_bathroom');									
				echo form_dropdown('bathroom_type', $bathrooms_status,set_value('bathroom_type'),'class="form-control" id="bathroom_type" ');
				?>
              </div>
            </div>
            <div class="col-lg-12 col-md-12">
             <div class="form-group">
                <label>Parking</label>
                <?php				
			    $parking_status = $this->config->item('property_reference_parking');									
				echo form_dropdown('parking', $parking_status,set_value('parking'),'class="form-control" ');
				?>
              </div>
            </div>
            
             <div class="col-lg-12 col-md-12">
             <div class="form-group">
                <label>Max number of flatmates</label>
                <?php				
			    $total_flatmates = $this->config->item('property_reference_maxflatmates');									
				echo form_dropdown('no_of_flatmates', $total_flatmates,set_value('no_of_flatmates'),'class="form-control" ');
				?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <!-- SECTION 5 -->
    <h2></h2>
    <section>
      <div class="inner">
        <div class="image-holder" style="background-image:url(<?php echo base_url();?>images/form-wizard-5.jpg)"> </div>
        <div class="form-content">
          <div class="form-header">
            <h3>About you</h3>
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
                <label>This place is for</label>
                
                 <div class="row">
               <?php
		        $placeisfor_status = $this->config->item('placeisfor_status');
			    if($placeisfor_status){
				  foreach($placeisfor_status as $placeisfor_status_key =>  $placeisfor_status_val){
				      if($placeisfor_status_key==1){
				      
				  ?>
				  <div class="col-lg4 col-md-4">
          <ul class="radio_submit">
          <li>
            <input type="radio" name="place_is_for" class="hide" id="place_is_for<?php echo $placeisfor_status_key;?>" value="<?php echo $placeisfor_status_key;?>" checked>
            <label for="place_is_for<?php echo $placeisfor_status_key;?>"><?php echo $placeisfor_status_val;?></label>
          </li>
           </ul>
         </div>
         <?php } else { ?>
         <div class="col-lg4 col-md-4">
          <ul class="radio_submit">
          <li>
            <input type="radio" name="place_is_for" class="hide" id="place_is_for<?php echo $placeisfor_status_key;?>" value="<?php echo $placeisfor_status_key;?>">
            <label for="place_is_for<?php echo $placeisfor_status_key;?>"><?php echo $placeisfor_status_val;?></label>
          </li>
           </ul>
         </div>
         
          <?php }  } } ?>
             </div>
                
              </div>
            </div>
          </div>
          
           <div class="row" id="about_me_div">
            <div class="col-lg-12 col-md-12">
				<div class="form-group">
              <label>Your first name</label>
              <?php $data = array('class' =>'form-control', 'name'=> 'me_firstname', 'id'=> 'me_firstname','value'=>'');
					echo form_input($data); 
				?>
            </div>
				</div>
			<div class="col-lg-12 col-md-12">
					<div class="form-group">
              <label>Your age</label>
              <?php $data = array('class' =>'form-control', 'name'=> 'me_age', 'id'=> 'me_age','value'=>'','maxlength'=>'2');
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
				?>
          <li>
            <input type="radio" name="me_gender" class="hide" id="me_gender<?php echo $gender_you_identify_key;?>" value="<?php echo $gender_you_identify_key;?>">
            <label for="me_gender<?php echo $gender_you_identify_key;?>"><?php echo $gender_you_identify_val;?></label>
          </li>
       
          <?php } } ?>
        </ul>
            </div>
				</div>
          </div>
           <div class="row" id="couple_div" style="display:none;">
            <div class="col-lg-12 col-md-12">
			<div class="form-group">
              <label for="psw">Your partner's first name</label>
              <?php $data = array('class' =>'form-control', 'name'=> 'partner_firstname', 'id'=> 'partner_firstname','value'=>'');
					echo form_input($data); 
				?>
            </div>
			</div>   
           <div class="col-lg-12 col-md-12">
			<div class="form-group">
              <label for="psw">Your partner's age</label>
              <?php $data = array('class' =>'form-control', 'name'=> 'partner_age', 'id'=> 'partner_age','value'=>'','maxlength'=>'2');
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
				  ?>
          <li>
            <input type="radio" name="partner_gender" class="hide" id="partner_gender<?php echo $gender_you_identify_key;?>" value="<?php echo $gender_you_identify_key;?>">
            <label for="partner_gender<?php echo $gender_you_identify_key;?>"><?php echo $gender_you_identify_val;?></label>
          </li>
          
          <?php } } ?>
        </ul>
            </div>
								</div>    
               
                </div>
                
           <div class="row" id="group_div" style="display:none;">
            <div class="col-lg-12 col-md-12">
			 <div class="form-group">
              <label for="psw">Your friend's first name</label>
              <?php $data = array('class' =>'form-control', 'name'=> 'friends_firstname[]', 'id'=> 'friends_firstname','value'=>'');
					echo form_input($data); 
				?>
            </div>
			</div>   
           <div class="col-lg-12 col-md-12">
	    	<div class="form-group">
              <label for="psw">Your friend's age</label>
              <?php $data = array('class' =>'form-control', 'name'=> 'friends_age[]', 'id'=> 'friends_age','value'=>'');
					echo form_input($data); 
				?>
            </div>
			</div>    
           <div class="col-lg-12 col-md-12">
		   <div class="form-group">
              <label for="psw">The gender your friend identifies with</label>
             <ul class="radio_submit">
          <?php
		      $gender_you_identify = $this->config->item('gender_you_identify');
			     
				  foreach($gender_you_identify as $gender_you_identify_key =>  $gender_you_identify_val){					 
				  ?>
          
          <li>
            <input type="radio" name="friends_gender[<?php echo $gender_you_identify_key;?>]" class="hide" id="friends_gender<?php echo $gender_you_identify_key;?>" value="<?php echo $gender_you_identify_key;?>">
            <label for="friends_gender<?php echo $gender_you_identify_key;?>"><?php echo $gender_you_identify_val;?></label>
          </li>
        
          <?php } ?>
        </ul>
            </div>
								</div>    
               
                </div>        
          
          <div class="row" style="display:none;">
              <div class="col-lg-12 col-md-12">
          <div class="form-group">
              <label for="psw">Profile Pic</label>
              <input type="file" name="" />
            </div>
            </div>
            </div> 
          
        </div>
      </div>
    </section>
    <!-- SECTION 6 -->
    <h2></h2>
    <section>
      <div class="inner">
        <div class="image-holder" style="background-image:url(<?php echo base_url();?>images/form-wizard-2.jpg)"> </div>
        <div class="form-content">
          <div class="form-header">
            <h3>Employment status</h3>
          </div>
          <div class="row">
                  <?php
		      $employment_status = $this->config->item('employment_status');
			  
			  if($employment_status){
				  foreach($employment_status as $employment_status_key =>  $employment_status_val){					 
				  ?>
                  <div class="col-lg-4 col-md-4">
                   <ul class="radio_submit"> 
                  <li>
                    <input type="radio" name="employment_status[]" class="hide" id="employment_status<?php echo $employment_status_key;?>" value="<?php echo $employment_status_key;?>">
                    <label for="employment_status<?php echo $employment_status_key;?>"><?php echo $employment_status_val;?></label>
                  </li>
                  </ul>
                  </div>
                  <?php } } ?>
                  </div>
                  
                  
          <div class="form-header">
            <h3>Lifestyle</h3>
          </div>
          <div class="row">
                  <?php
		      $lifestyle_status = $this->config->item('lifestyle_status');
			  
			  if($lifestyle_status){
				  foreach($lifestyle_status as $lifestyle_status_key =>  $lifestyle_status_val){					 
				  ?>
                  <div class="col-lg-4 col-md-4">
                   <ul class="check_submit"> 
                  <li>
                    <input type="checkbox" name="lifestyle_status[]" class="hide" id="lifestyle_status<?php echo $lifestyle_status_key;?>" value="<?php echo $lifestyle_status_key;?>">
                    <label for="lifestyle_status<?php echo $lifestyle_status_key;?>"><?php echo $lifestyle_status_val;?></label>
                  </li>
                  </ul>
                  </div>
                  <?php } } ?>
                  </div>        
        </div>
      </div>
    </section>
    
    <!-- SECTION 7 -->
    <h2></h2>
    <section>
      <div class="inner">
        <div class="image-holder" style="background-image:url(<?php echo base_url();?>images/form-wizard-4.jpg)"> </div>
        <div class="form-content">
          <div class="form-header">
            <h3>What makes you great to live with?</h3>
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
                <?php $data = array('class' =>'form-control', 'name'=> 'great_live_with_text', 'id'=> 'great_live_with_text',"required"=>"true","value"=>set_value("great_live_with_text"));
                 echo form_textarea($data); ?>
                 
                 
                 <small>Tell your potential flatmates a little about yourself. What do you do for work, what do you like to do for fun and where you are from. Also remember to let them know what you're looking for.</small>                        
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </section>
    
      <!-- SECTION 8 -->
    <h2></h2>
    <section>
    <p>Your Ideal Flatemate(s)</p>
      <div class="inner">
        <div class="image-holder" style="background-image:url(<?php echo base_url();?>images/form-wizard-5.jpg)"> <img src="" alt="" style="width:100%;"> </div>
        <div class="form-content">
            
          <div class="form-header">
            <h3>Preferred Language</h3>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-12">
              <div class="form-group">
               <?php				
			    $preferred_language_list = $this->config->item('preferred_language_list');									
				echo form_dropdown('preferred_language', $preferred_language_list,set_value('preferred_language'),'class="form-control" id="preferred_language" ');
				?>
              </div>
            </div>
            
          </div>   
            
            
          <div class="form-header">
            <h3>Flatmate Preference</h3>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-12">
              <div class="form-group">
               <?php				
			    $flatmatespref_status = $this->config->item('flatmatespref_status');									
				echo form_dropdown('preference', $flatmatespref_status,set_value('flatmatespref_status'),'class="form-control" id="flatmatespref_status" ');
				?>
              </div>
            </div>
            <div class="col-lg-12 col-md-12" style="display:none;" id="femalediv">
              <div class="form-group">
                <label for="psw">Is this property female only?</label>
                <ul class="radio_submit">
                    <li>
                      <input type="radio" name="property_female_only" class="hide" id="property_female_only1" value="1">
                      <label for="property_female_only1"> Yes</label>
                    </li>
                    <li>
                      <input type="radio" name="property_female_only" class="hide" id="property_female_only2" value="2">
                      <label for="property_female_only2"> No</label>
                    </li>
                    </ul>
              </div>
            </div>
            
          </div>
          
          
          <div class="form-header">
            <h3>Accepting</h3>
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
               <div class="row">
                  <?php
		      $flatmatespref_accepting = $this->config->item('flatmatespref_accepting');
			  
			  if($flatmatespref_accepting){
				  foreach($flatmatespref_accepting as $flatmatespref_accepting_key =>  $flatmatespref_accepting_val){					 
				  ?>
                  <div class="col-lg-4 col-md-4"> 
                  <ul class="check_submit">                
                   <li> <input type="checkbox" name="accepting[]" class="hide" id="flatmatespref_accepting<?php echo $flatmatespref_accepting_key;?>" value="<?php echo $flatmatespref_accepting_key;?>">
                    <label for="flatmatespref_accepting<?php echo $flatmatespref_accepting_key;?>"><?php echo $flatmatespref_accepting_val;?></label></li></ul>
                
                  </div>
                  <?php } } ?>
                  </div>
               
              </div>
            </div>
            
            
          </div>
        </div>
      </div>
    </section>
     
      <!-- SECTION 9 -->
   
  </form>
</div>
 <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
<?php
$below_app_js = array('js/jquery.steps.js','js/steps_find_location.js','js/find_place_property.js','jsupload/js/plupload.full.min.js','jsupload/js/jquery.ui.plupload.min.js',);
$this->load->view('includes/footer', array(
	'below_app_js' => $below_app_js)); ?>
