<?php
$header = array('title' => 'Room for rent in '.$locaton.' ');
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
              <?php if($ListingInfo->listing_confirmed!='1'){ ?>
              <div class="row">
                  <div class="col-md-12 col-xl-12 text-center">
                      Your Listing Preview<br>(You can edit this listing later)<br><a href="<?php echo base_url();?>verify_mobile" class="btn btn-default1 d-none d-lg-block">Continue</a>
                      </div>
                  </div>
               <?php } ?>
              
            <h4 class="color-primary mb-4"><?php echo $locaton; ?></h4>
            <?php $this->message_output->run(); ?>
            <?php echo form_hidden('profile_id',$listing_id);?>
            <div class="row massanger">
                
               <div class="col-md-12 col-xl-12">
                <div class="accordion mt_30">
                  <div class="card mb_20">
                    <div class="collapse show"style="">
                      <div class="card-body">
                        <div class="row">
                          <div id="single-questions" class="col-lg-12">
                            <div class="edit-list-box edit-third">
                              <div class="row">
                                     <?php if($photos){
                                         foreach($photos as $home_phtos) {
							         if($home_phtos){?>
							         <div class="col-lg-4"> <img src="<?php echo base_url().HMEPHT.$home_phtos->photo;?>" alt="#"/></div>
									<?php } } 
									} else{
										$no_image_path=NO_IMAGE; 
										?>
									<div class="col-lg-4"> <img src="<?php echo base_url().$no_image_path;?>" alt="#"/></div>	
										<?php
										
									}
									
									?> 
                                
                                 </div>
                                 <br>
                                 <?php if($ListingInfo->listing_confirmed=='1'){ ?>
                                  <div class="row">
                                      <div class="col-md-12"> <a href="<?php echo customer_path();?>listings/home_photos/<?php echo $ListingInfo->profile_id;?>" class="btn btn-default1"> <span class="button-circle-span text-uppercase">Edit</span> </a> </div>
                                  </div>
                              <?php } ?>
                                 </div>
                                 </div>
                                 </div>
                                 </div>
                                 </div>
                                 </div>
                                 </div>
                                 </div>
               
              <div class="col-md-12 col-xl-12">
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
                                        <td><strong>What type of accommodation are you offering?</strong></td>                                        
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <?php if($ListingInfo->listing_confirmed=='1'){ ?>
                                        <td align="right"><a href="#" class="btn btn-default1 request_edit_link" data-id="1">Edit</a></td>
                                        <?php } ?>
                                      </tr>
                                      <tr>
                                        <td><?php
									
											    $accommodation_offering_data='';
												$accommodation_offering=$this->config->item('accommodation_offering');
												if($ListingInfo->accommodation_offering){
												   $accommodation_offering_info = explode(",",$ListingInfo->accommodation_offering);
												   foreach($accommodation_offering_info as  $accommodation_offering_val){
													  $accommodation_offering_data .= $accommodation_offering[$accommodation_offering_val].'<br>';   
												   }
												}
												$accommodation_offering_data = rtrim($accommodation_offering_data,"<br>");
												echo $accommodation_offering_data;
												?>
                                          <br></td>
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
                                        <td><strong>About the property</strong></td>
                                        <?php if($ListingInfo->listing_confirmed=='1'){ ?>
                                        <td align="right"><a href="#" class="btn btn-default1 request_edit_link" data-id="2">Edit</a></td>
                                        <?php } ?>
                                      </tr>
                                      <tr>
                                        <td colspan="2"></td>
                                      </tr>
                                      <tr>
                                        <td><strong>Property Address : </strong></td>
                                        <td>
                                           <?php
                                            
                                            	if($about_property->property_address){
											$suburb =  json_decode($about_property->property_address);
											if($suburb){
											    foreach($suburb as $suburb_key => $suburb_val){
											        echo $suburb_val->location.'<br>';
											    }
											    
											}
											}
											
											?></td>
                                      </tr>
                                      <tr>
                                        <td><strong>Total bedrooms : </strong></td>
                                        <td><?php
											$total_bedrooms=$this->config->item('total_bedrooms');
											if($total_bedrooms && $about_property->total_bedrooms!='')
											 echo $total_bedrooms[$about_property->total_bedrooms];?></td>
                                      </tr>
                                      <tr>
                                        <td><strong>Total bathrooms : </strong></td>
                                        <td><?php 
											$total_bathrooms=$this->config->item('total_bathrooms');
											if($total_bathrooms && $about_property->total_bathrooms!='')
											echo $total_bathrooms[$about_property->total_bathrooms];?></td>
                                      </tr>
                                      <tr>
                                        <td><strong>Parking : </strong></td>
                                        <td><?php
											$parking_status=$this->config->item('parking_status');
											if($parking_status && $about_property->parking!='')
											 echo $parking_status[$about_property->parking];?></td>
                                      </tr>
                                      <tr>
                                        <td><strong>Internet : </strong></td>
                                        <td><?php 
											$internet_status=$this->config->item('internet_status');
											if($internet_status)
											echo $internet_status[$about_property->internet];?></td>
                                      </tr>
                                      <tr>
                                        <td><strong>Total number of flatmates : </strong></td>
                                        <td><?php 
											$total_flatmates=$this->config->item('total_flatmates');
											if($total_flatmates && $about_property->total_flatmates!='')
											echo $total_flatmates[$about_property->total_flatmates];?></td>
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
                                        <td><strong>About the room(s)</strong></td>
                                        <?php if($ListingInfo->listing_confirmed=='1'){ ?>
                                        <td align="right"><a href="#" class="btn btn-default1 request_edit_link" data-id="3">Edit</a></td>
                                        <?php } ?>
                                      </tr>
                                      <tr>
                                        <td colspan="2"></td>
                                      </tr>
                                      <tr>
                                        <td colspan="2"><table class="w-100">
                                            <tbody>
                                              <tr>
                                                <td><strong>Room Name</strong></td>
                                                <td><strong>Room Type</strong></td>
                                                <td><strong>Room furnishings</strong></td>
                                                <td><strong>Bathroom</strong></td>
                                              </tr>
                                              <?php 
										$roomtypes_status= $this->config->item('roomtypes_status');
										$roomfurnishings_status= $this->config->item('roomfurnishings_status');
										$bathrooms_status= $this->config->item('bathrooms_status');
										
										if($about_rooms){
											foreach($about_rooms as $key => $room_info){
												?>
                                              <tr>
                                                <td><?php echo $room_info->room_name;?></td>
                                                <td><?php echo $roomtypes_status[$room_info->room_type];?></td>
                                                <td><?php echo $roomfurnishings_status[$room_info->room_furnishings];?></td>
                                                <td><?php echo $bathrooms_status[$room_info->bathroom];?></td>
                                              </tr>
                                              <?php } } ?>
                                            </tbody>
                                          </table></td>
                                      </tr>
                                    </tbody>
                                  </table>
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
                                        <td><strong>Room Features</strong></td>
                                      <?php if($ListingInfo->listing_confirmed=='1'){ ?>
                                      <td align="right"><a href="#" class="btn btn-default1 request_edit_link" data-id="4">Edit</a></td>
                                      <?php } ?>
                                      </tr>
                                      <tr>
                                        <td colspan="2"></td>
                                      </tr>
                                      <tr>
                                        <td colspan="2">
                                            <table class="w-100" width="100%;">
  <tbody>
      
      	<?php 
      	$room_furnishing_features=$this->config->item('room_furnishing_features');
      	$bedsize_status = $this->config->item("bedsize_status");
      	$room_fcounter=0;
      	if($room_features){
											foreach($room_features as $room_features_val){
											    $room_fcounter++;
												?>
						<tr>
      <td><strong>Room <?php echo $room_fcounter;?> detail</strong></td>
      <td align="left" valign="middle"></td>
      </tr>
          						
    <tr>
      <td><strong> Bed Size</strong></td>
      <td align="left" valign="middle"><?php
											
											?>
        
        <?php 
											if($room_features_val->bed_size)
											    echo $bedsize_status[$room_features_val->bed_size];?></td>
    </tr>
    
    <tr>
                                        <td colspan="2">
                                            <table class="w-100" width="100%">
  <tbody>
    <tr>
      <td><strong>Features</strong></td>
      <td align="left" valign="middle">
        <?php
                                            $furnishings_features_data='';
												
												if($room_features_val->furnishings_features){
												   $furnishing_features_info = explode(",",$room_features_val->furnishings_features);
												   foreach($furnishing_features_info as  $furnishing_features_val){
													  $furnishings_features_data .= $room_furnishing_features[$furnishing_features_val].',';   
												   }
												}
												$furnishings_features_data = rtrim($furnishings_features_data,",");
												echo $furnishings_features_data;
												
												?></td>
    </tr>
  </tbody>
</table>
</td>
                                      </tr>
                                      
                                      
                                      <tr>
      <td colspan="2"><hr></td>
      </tr>
  </tbody>
</table>
<?php } }?>
</td>
                                      </tr>
                                      
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-12">
                            <div class="edit-list-box edit-third">
                              <div class="row">
                                <div class="col-lg-12 lower-section">
                                  <table class="w-100">
                                    <tbody>
                                      <tr>
                                        <td><strong>Rent, bond and bills</strong></td>
                                         <?php if($ListingInfo->listing_confirmed=='1'){ ?>
                                         <td align="right"><a href="#" class="btn btn-default1 request_edit_link" data-id="5">Edit</a></td>
                                         <?php } ?>
                                      </tr>
                                      <tr>
                                        <td colspan="2"></td>
                                      </tr>
                                      <tr>
                                        <td colspan="2">
                                            <?php
                                                 $room_rcounter=0;
                                            	$bond_status= $this->config->item('bond_status');
									        	$bills_status= $this->config->item('bills_status');
                                         	if($room_rentbills){
											foreach($room_rentbills as $room_rentbills_val){
											    $room_rcounter++;
												?>
                                            <table class="w-100">
                                            <tbody>
                                                
                                              <tr>
                                                <td colspan="3"><strong>Room <?php echo $room_rcounter;?> detail</strong></td>
                                              </tr>  
                                                
                                              <tr>
                                                <td><strong>Weekly rent</strong></td>
                                                <td><strong>Bond</strong></td>
                                                <td><strong>Bills</strong></td>
                                              </tr>
                                              
                                              <tr>
                                                <td>$<?php echo $room_rentbills_val->weekly_rent;?></td>
                                                <td><?php echo $bond_status[$room_rentbills_val->bond];?></td>
                                                <td><?php echo $bills_status[$room_rentbills_val->bills];?></td>
                                              </tr>
                                               <tr>
                                                <td colspan="3"><hr></td>
                                              </tr>
                                            </tbody>
                                          </table>
                                          
                                          <?php } } ?>
                                          
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
                                        <td><strong>Room availability</strong></td>
                                       <?php if($ListingInfo->listing_confirmed=='1'){ ?>
                                       <td align="right"><a href="#" class="btn btn-default1 request_edit_link" data-id="6">Edit</a></td>
                                       <?php } ?>
                                      </tr>
                                      <tr>
                                        <td colspan="2"></td>
                                      </tr>
                                      <tr>
                                        <td colspan="2">
                                           <?php
                                            $room_acounter=0;
                                            $length_of_stay= $this->config->item('length_of_stay');
                                           	if($room_availability){
											foreach($room_availability as $room_availability_val){
											    $room_acounter++;
												?>
                                            <table class="w-100">
                                            <tbody>
                                                <tr>
                                                <td colspan="3"><strong>Room <?php echo $room_acounter;?> detail</strong></td>
                                              </tr> 
                                              <tr>
                                                <td><strong>Date available</strong></td>
                                                <td><strong>Minimum length of stay</strong></td>
                                                <td><strong>Maximum length of stay</strong></td>
                                              </tr>
                                              <tr>
                                                <td><?php echo $room_availability_val->date_available;?></td>
                                                <td><?php echo $length_of_stay[$room_availability_val->min_stay_length];?></td>
                                                <td><?php echo $length_of_stay[$room_availability_val->max_stay_length];?></td>
                                              </tr>
                                              <tr>
                                                <td colspan="3"><hr></td>
                                              </tr>
                                            </tbody>
                                          </table>
                                          <?php } } ?>
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
                                        <td><strong>YOUR IDEAL FLATEMATE(S)</strong></td>
                                        <?php if($ListingInfo->listing_confirmed=='1'){ ?>
                                        <td align="right"><a href="#" class="btn btn-default1 request_edit_link" data-id="7">Edit</a></td>
                                        <?php } ?>
                                      </tr>
                                      <tr>
                                        <td colspan="2"></td>
                                      </tr>
                                      <tr>
                                        <td colspan="2">
                                           <?php
                                            $room_ffcounter=0;
                                            $about_flatmates='';
                                            	$flatmatespref_status = $this->config->item("flatmatespref_status");
                                            	$flatmatespref_accepting=$this->config->item('flatmatespref_accepting');
                                           	if($room_availability){
											foreach($flatmates_preferences as $flatmates_preferences_val){
											    $room_ffcounter++;
												?> 
                                            <table class="w-100">
                                            <tbody>
                                              <tr>
                                                <td><strong>Flatmate Preference</strong></td>
                                              </tr>
                                              <tr>
                                                <td><strong>Room <?php echo $room_ffcounter;?> detail</strong></td>
                                              </tr> 
                                              <tr>
                                                <td><?php
										
											?>
                                                  &nbsp;&nbsp;&nbsp;&nbsp;
                                                  <?php 
											if($flatmates_preferences_val->preference)
											    echo $flatmatespref_status[$flatmates_preferences_val->preference];?></td>
                                              </tr>
                                               <tr>
                                                <td><strong>Accepting</strong></td>
                                                <td></td>
                                              </tr>
                                              <tr>
                                                <td><?php
                                                $accepting_flatmatespref_data='';
												
												if($flatmates_preferences_val->accepting){
												   $flatmatespref_accepting_info = explode(",",$flatmates_preferences_val->accepting);
												   foreach($flatmatespref_accepting_info as  $flatmatespref_accepting_val){
													  $accepting_flatmatespref_data .= '&nbsp;&nbsp;&nbsp;&nbsp;'.$flatmatespref_accepting[$flatmatespref_accepting_val].'<br>';   
												   }
												}
												$accepting_flatmatespref_data = rtrim($accepting_flatmatespref_data,"<br>");
												echo $accepting_flatmatespref_data;
												
												?></td>
                                              </tr>
                                              
                                            </tbody>
                                          </table>
                                             <hr>
                                          <?php 
                                          $about_flatmates = $flatmates_preferences_val->about_flatmates;
                                          
                                          } } ?>
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
                                        <td><strong>Tell us about you and your flatmates</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <?php if($ListingInfo->listing_confirmed=='1'){ ?>
                                        <td align="right"><a href="#" class="btn btn-default1 request_edit_link" data-id="8">Edit</a></td>
                                        <?php }?>
                                       
                                      </tr>
                                      <tr>
                                        <td><?php
									echo nl2br($about_flatmates);
												?>
                                          <br></td>
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
                                        <td><strong>What's great about living at this property?</strong></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <?php if($ListingInfo->listing_confirmed=='1'){ ?>
                                        <td align="right"><a href="#" class="btn btn-default1 request_edit_link" data-id="9">Edit</a></td>
                                       <?php } ?>
                                      </tr>
                                      <tr>
                                        <td><?php
									echo nl2br($ListingInfo->great_live_with_text);
												?>
                                          <br></td>
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
											<td><strong>Preferred Language</strong></td>
											<td></td>
                                            <td></td>
                                            <td></td>
                                            <?php if($ListingInfo->listing_confirmed=='1'){ ?>
											<td align="right">
												<a href="#" class="btn btn-default1 request_edit_link" data-id="10">Edit</a>
											</td>	
											<?php } ?>
											
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
$below_app_js=array('js/datepicker/js/bootstrap-datepicker.js','js/jquery.validate.min.js','js/edit_offer_home.js');
$this->load->view('includes/'.admin_folder.'footer',array('below_app_js'=>$below_app_js)); ?>
