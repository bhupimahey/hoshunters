<?php
$header = array('title' =>''.$ListingInfo->me_firstname.'('.$ListingInfo->me_age.')');
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
							<?php echo form_hidden('profile_id',$listing_id);?>
							<div class="row massanger">
                           
								<div class="col-md-12 col-xl-4">
                                                                
									<div class="accordion mt_30" id="accordion1" role="tablist">
		                                <div class="card mb_20">
		                                    <div class="card-header p-0" role="tab">
		                                        <h6 class="m-0"><a href="#collapseOne" data-toggle="collapse" data-parent="#accordion1"  class="panel_accordian">Profile Overview</a></h6>
		                                    </div>
		                                    <div class="collapse show" id="collapseOne" role="tabpanel" style="">
		                                        <div class="card-body">
		                                        	<div class="row">
													<div class="col-md-12">
													 <?php
													 
													 if($customer_photo_info && $customer_photo_info->photo!='')
                                            		      $customer_photo_path = '<img src="'.base_url().CNTPHT_THUMB.$customer_photo_info->photo.'" alt="#" />';
                                            		   else
                                            		     $customer_photo_path = '<img src="'.base_url().'images/no_image.gif" alt="#" />';
                                            		     
                                            		     echo $customer_photo_path;
													  ?>
                                                
											</div>
                                            
													</div>
					                                <br>
                                                    <br>
                                                    <div class="row">
                                                      <div class="col-md-12"> <a href="<?php echo customer_path();?>listings/edit_about_info/<?php echo $ListingInfo->profile_id;?>/1" class="btn btn-default1"> <span class="button-circle-span text-uppercase">Edit</span> </a> </div>
                                                    </div>
                                                  
		                                        </div>
		                                    </div>
		                                </div>
		                               
		                              
		                            </div>
								</div>
								<div class="col-md-12 col-xl-8">
									<div class="accordion mt_30">
                                    
		                                <div class="card mb_20">
		                                    
		                                    <div class="collapse show"style="">
                                            <div class="card-body">
                                            <div class="row">
                                            
              							    <div id="single-questions" class="col-lg-12">
    <div class="edit-list-box edit-third">
        <div class="row">
            <div class="col-lg-12 lower-section">
              <table class="w-100">
								
									<tbody>
										<tr>
											<td><h6 class="color-primary mb-4">What type of place are you looking for</h6></td>
											<td></td>
                                            <td></td>
                                            <td></td>
											<td align="right"><a href="#" class="btn btn-default1 request_edit_link" data-id="1">Edit</a></td>											
										
										</tr>
                                        <tr>
                                        
                                        <td>
                                       <?php
									
											    $place_looking_for_data='';
												$place_looking_for=$this->config->item('place_looking_for');
												if($ListingInfo->place_looking_for){
												   $place_looking_for_info = explode(",",$ListingInfo->place_looking_for);
												   foreach($place_looking_for_info as  $place_looking_for_val){
													  $place_looking_for_data .= $place_looking_for[$place_looking_for_val].'<br>';   
												   }
												}
												$place_looking_for_data = rtrim($place_looking_for_data,"<br>");
												echo $place_looking_for_data;
												?>
                                                <br>
                                             <strong>Teamups&nbsp;:&nbsp;</strong><?php echo ($ListingInfo->teamups==1)?"Yes":"No";?>   
                                        </td>
                                        </tr>
										
									</tbody>
								</table>
            </div>
        </div>
    </div>
</div>
                    
                                            <div id="about_person" class="col-lg-12">
    <div class="edit-list-box edit-third">
        <div class="row">
            <div class="col-lg-12 lower-section">
              <table class="w-100">
								
									<tbody>
										<tr>
											<td><h6 class="color-primary mb-4">Where would you like to live?</h6></td>
											<td align="right">
												<a href="<?php echo customer_path();?>listings/locations/<?php echo $ListingInfo->profile_id;?>/2" class="btn btn-default1" data-id="2">Edit</a>
											</td>
										
										</tr>
                                        <tr><td colspan="2"></td></tr>
										<tr>
											<td colspan="2"><p>
											<?php						
											if($ListingInfo->suburb){
											$suburb =  json_decode($ListingInfo->suburb);
											if($suburb){
											    foreach($suburb as $suburb_key => $suburb_val){
											        echo $suburb_val->location.'<br>';
											    }
											    
											}
											}
											
											?></p>
											</td>
										</tr>
									</tbody>
								</table>
            </div>
        </div>
    </div>
</div>

											<div id="personal_qualities" class="col-lg-12">
    <div class="edit-list-box edit-third">
        <div class="row">
            <div class="col-lg-12 lower-section">
              <table class="w-100">
								
									<tbody>
										<tr>
											<td><h6 class="color-primary mb-4">Rent and timing</h6></td>
										<td align="right">
												<a href="#" class="btn btn-default1 request_edit_link" data-id="3">Edit</a>
											</td>	
										
										</tr>
                                        <tr><td colspan="2"></td></tr>
										<tr>
											<td colspan="2">
                                            <table class="w-100">
								
									<tbody>
										<tr>
											<td>Weekly budget</td>											
											<td>Preferred move date</td>
                                            <td>Preferred length of stay</td>
										</tr>
                                        <tr>
											<td>$<?php
											if($ListingInfo->weekly_budget)
											 echo $ListingInfo->weekly_budget;
											 else
											 echo 'N/A';?></td>											
											<td><?php 
											if($ListingInfo->preferred_move_date)											
											echo $ListingInfo->preferred_move_date;
											else
											echo "N/A";?></td>
                                            <td><?php 
											
											if($ListingInfo->length_of_stay)											
											echo $length_of_stay[$ListingInfo->length_of_stay];
											else
											echo "N/A";?></td>
										</tr>
                                        
                                        </tbody></table>
                                            
                                            </td></tr></tbody></table>
                                            
            </div>
        </div>
    </div>
</div>

                                           <div id="food_sharing_furniture" class="col-lg-12">
    <div class="edit-list-box edit-third">
        <div class="row">
            <div class="col-lg-12 lower-section">
              
<table class="w-100">
  <tbody>
    
    <tr>
      <td><h6 class="color-primary mb-4">Property preferences</h6></td>
      <td align="right"><a href="#" class="btn btn-default1 request_edit_link" data-id="4">Edit</a></td>
    </tr>
    <tr>
      <td>Room furnishings :</td>
      <td align="left" valign="middle"><?php
											$property_reference_rooms = $this->config->item("property_reference_rooms");
											?>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <?php 
											if($listing_preferences->room_furnishings)											
											echo $property_reference_rooms[$listing_preferences->room_furnishings];
											?></td>
    </tr>
    <tr>
      <td>Internet :</td>
      <td align="left" valign="middle"><?php
											$property_reference_internet = $this->config->item("property_reference_internet");
											
											?>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <?php 
											if($listing_preferences->internet)
											    echo $property_reference_internet[$listing_preferences->internet];?></td>
    </tr>
    <tr>
      <td>Bathroom type : </td>
      <td align="left" valign="middle"><?php
											$property_reference_bathroom = $this->config->item("property_reference_bathroom");
											?>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <?php 
											if($listing_preferences->bathroom_type)
											echo $property_reference_bathroom[$listing_preferences->bathroom_type];?></td>
    </tr>
    <tr>
      <td>Parking : </td>
      <td align="left" valign="middle"><?php
											$property_reference_parking = $this->config->item("property_reference_parking");
											?>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <?php 
											if($listing_preferences->parking)
											echo $property_reference_parking[$listing_preferences->parking];?></td>
    </tr>
    <tr>
      <td>Max number of flatmates : </td>
      <td align="left" valign="middle"><?php
											$property_reference_maxflatmates = $this->config->item("property_reference_maxflatmates");
											?>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <?php 
											if($listing_preferences->no_of_flatmates)
											echo $property_reference_maxflatmates[$listing_preferences->no_of_flatmates];?></td>
    </tr>
  </tbody>
</table>

            </div>
        </div>
    </div>
</div>

										   <div id="describe_pets" class="col-lg-12">
    <div class="edit-list-box edit-third">
        <div class="row">
            <div class="col-lg-12 lower-section">
              <table class="w-100">
								
									<tbody>
										<tr>
											<td><h6 class="color-primary mb-4">About you</h6> </td>
											<td align="right">
												<a href="<?php echo customer_path();?>listings/edit_about_info/<?php echo $ListingInfo->profile_id;?>/1" class="btn btn-default1" data-id="5" >Edit</a>
											</td>
										
										</tr>
                                        <tr><td colspan="2">
                                            
                                          <table class="w-100">
								
									<tbody>
										<tr>
											<td>This place is for</td>											
											<td>Your first name</td>
                                            <td>Your age</td>
                                             <td>The gender you identify with</td>
										</tr>
                                        <tr>
											<td><?php
											$placeisfor_status = $this->config->item('placeisfor_status');
											$gender_you_identify= $this->config->item('gender_you_identify');
											if(isset($placeisfor_status[$ListingInfo->place_is_for]))
											echo $placeisfor_status[$ListingInfo->place_is_for];
											
											?></td>											
											<td><?php echo $ListingInfo->me_firstname;?></td>
                                            <td><?php echo $ListingInfo->me_age;?></td>
                                            <td><?php 
                                            if(isset($gender_you_identify[$ListingInfo->me_gender]))
                                            echo $gender_you_identify[$ListingInfo->me_gender];?></td>
										</tr>
                                        
                                        </tbody></table>  
                                            
                                            
                                            
                                        </td></tr>
									
                                        
                                        
									</tbody>
								</table>
            </div>
        </div>
    </div>
</div>

											<div id="single-questions" class="col-lg-12">
    <div class="edit-list-box edit-third">
        <div class="row">
            <div class="col-lg-12 lower-section">
              <table class="w-100">
								
									<tbody>
										<tr>
											<td><h6 class="color-primary mb-4">Employment status</h6></td>
											<td></td>
                                            <td></td>
                                            <td></td>
											<td align="right">
												<a href="#" class="btn btn-default1 request_edit_link" data-id="6">Edit</a>
											</td>											
											
										</tr>
                                        <tr>
                                        
                                        <td>
                                       <?php
									
											    $employment_status_data='';
												$employment_status=$this->config->item('employment_status');
												if($ListingInfo->employment_status){
												   $employment_status_info = explode(",",$ListingInfo->employment_status);
												   foreach($employment_status_info as  $employment_status_val){
													  $employment_status_data .= $employment_status[$employment_status_val].'<br>';   
												   }
												}
												$employment_status_data = rtrim($employment_status_data,"<br>");
												echo $employment_status_data;
												?>
                                             
                                        </td>
                                        </tr>
										
									</tbody>
								</table>
            </div>
        </div>
    </div>
</div>

											<div id="single-questions" class="col-lg-12">
    <div class="edit-list-box edit-third">
        <div class="row">
            <div class="col-lg-12 lower-section">
              <table class="w-100">
								
									<tbody>
										<tr>
											<td><h6 class="color-primary mb-4">Lifestyle</h6></td>
											<td></td>
                                            <td></td>
                                            <td></td>
											<td align="right">
												<a href="#" class="btn btn-default1 request_edit_link" data-id="7">Edit</a>
											</td>											
										
										</tr>
                                        <tr>
                                        
                                        <td>
                                       <?php
									
											    $lifestyle_status_data='';
												$lifestyle_status=$this->config->item('lifestyle_status');
												if($ListingInfo->life_style){
												   $lifestyle_status_info = explode(",",$ListingInfo->life_style);
												   foreach($lifestyle_status_info as  $lifestyle_status_val){
													  $lifestyle_status_data .= $lifestyle_status[$lifestyle_status_val].'<br>';   
												   }
												}
												$lifestyle_status_data = rtrim($lifestyle_status_data,"<br>");
												echo $lifestyle_status_data;
												?>
                                             
                                        </td>
                                        </tr>
										
									</tbody>
								</table>
            </div>
        </div>
    </div>
</div>
                                            
                                            <div id="single-questions" class="col-lg-12">
    <div class="edit-list-box edit-third">
        <div class="row">
            <div class="col-lg-12 lower-section">
              <table class="w-100">
								
									<tbody>
										<tr>
											<td><h6 class="color-primary mb-4">What makes you great to live with?</h6></td>
											<td></td>
                                            <td></td>
                                            <td></td>
											<td align="right">
												<a href="#" class="btn btn-default1 request_edit_link" data-id="8">Edit</a>
											</td>											
										
										</tr>
                                        <tr>
                                        
                                        <td><p>
                                       <?php
								echo	$ListingInfo->great_live_with_text;
												?></p>
                                             
                                        </td>
                                        </tr>
										
									</tbody>
								</table>
            </div>
        </div>
    </div>
</div>
                                            
                                            <div id="single-questions" class="col-lg-12">
                                                    <div class="edit-list-box edit-third">
        <div class="row">
            <div class="col-lg-12 lower-section">
              <table class="w-100">
								
									<tbody>
										<tr>
											<td><h6 class="color-primary mb-4">Preferred Language</h6></td>
											<td></td>
                                            <td></td>
                                            <td></td>
											<td align="right">
												<a href="#" class="btn btn-default1 request_edit_link" data-id="9">Edit</a>
											</td>											
											
										</tr>
                                        <tr>
                                        
                                        <td>
                                            
                                         <?php
									
											    $preferred_language_info='';
												$preferred_language_list=$this->config->item('preferred_language_list');
												if($ListingInfo->preferred_language)
												   $preferred_language_info =$preferred_language_list[$ListingInfo->preferred_language];
											   
												if($ListingInfo->preferred_language==0){
											        $show_preferred_language =$preferred_language_list[$ListingInfo->preferred_language];  
											     }
											    else
												$show_preferred_language = $preferred_language_info;
												 
												 echo  $show_preferred_language;
												?>
                                            
                                        </td>
                                        </tr>
										
									</tbody>
								</table>
            </div>
        </div>
    </div>
                                                  </div>
                                                  
                                            <div id="single-questions" class="col-lg-12">
                                                    <div class="edit-list-box edit-third">
        <div class="row">
            <div class="col-lg-12 lower-section">
              <table class="w-100">
								
									<tbody>
										<tr>
											<td><h6 class="color-primary mb-4">Flatmate Preference</h6></td>
											<td></td>
                                            <td></td>
                                            <td></td>
											<td align="right">
												<a href="#" class="btn btn-default1 request_edit_link" data-id="9">Edit</a>
											</td>											
											
										</tr>
                                        <tr>
                                        
                                        <td>
                                         <?php
                                         
											    $employment_status_info='';
												$flatmatespref_status=$this->config->item('flatmatespref_status');
												if($flatmatepreferrences && isset($flatmatepreferrences->preference))
											    	echo $flatmatepreferrences_rc = $flatmatespref_status[$flatmatepreferrences->preference];
											
												?>
                                             
                                        </td>
                                        </tr>
										
									</tbody>
								</table>
            </div>
        </div>
    </div>
                                                  </div>      
                                            <div id="single-questions" class="col-lg-12">
                                                    <div class="edit-list-box edit-third">
        <div class="row">
            <div class="col-lg-12 lower-section">
              <table class="w-100">
								
									<tbody>
										<tr>
											<td><h6 class="color-primary mb-4">Accepting</h6></td>
											<td></td>
                                            <td></td>
                                            <td></td>
											<td align="right">
												<a href="#" class="btn btn-default1 request_edit_link" data-id="9">Edit</a>
											</td>											
											
										</tr>
                                        <tr>
                                        
                                        <td>
                                            <div class="row">
                                         <?php
									
											    $flatmatespref_accepting_info='';
												$flatmatespref_accepting=$this->config->item('flatmatespref_accepting');
												if($flatmatepreferrences && isset($flatmatepreferrences->accepting)){
												    $accepting = $flatmatepreferrences->accepting;
												    if($accepting){
												      $accepting =  explode(",",$accepting) ;
												      foreach($accepting as $accepting_val){
												          	$show_accepting_val = $flatmatespref_accepting[$accepting_val];
												         ?>
												        <div class="col-md-3"><?php echo $show_accepting_val;?> </div>
												         <?php
												         }
												    }
												}
												?>
                                            </div> 
                                        </td>
                                        </tr>
										
									</tbody>
								</table>
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
<script>
    var customer_path='<?php echo customer_path();?>';
    
</script>

<?php 
$below_app_js=array('js/datepicker/js/bootstrap-datepicker.js','js/jquery.validate.min.js','js/edit_looking_home.js');
$this->load->view('includes/'.admin_folder.'footer',array('below_app_js'=>$below_app_js)); ?>
