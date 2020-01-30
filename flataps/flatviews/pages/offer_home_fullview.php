<?php
$header = array('title' => $page_title);
$this->load->view('includes/header', $header);
?>
<body>
<?php $this->load->view('includes/pages_inner_header'); ?>

<div class="page-banner bg-gray">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="breadcrumbs color-secondery">
					<ul>
						<li class="hover_gray"><a href="<?php echo base_url();?>">Home</a></li>
						<li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
						<li class="color-default">Listing</li>
					</ul>
				</div>
				<div class="float-right color-primary">
					<h3 class="banner-title font-weight-bold"><?php echo $final_code;?></h3>
				</div>
			</div>
		</div>
	</div>
</div>

		<?php $this->message_output->run(); ?>
		<div class="profile_details" style="box-shadow:none;">
			 <div class="owl-carousel single_slide">
							        <?php 
							        $photo_counter=0;
							        if($home_photos_info){ foreach($home_photos_info as $home_phtos) {
							         if($home_phtos){ $photo_counter++;?>
							        
							            	<div class="pro-img">
								            	<a href="<?php echo base_url().HMEPHT.$home_phtos->photo;?>" data-lightbox="roadtrip" data-title=""><img src="<?php echo base_url().HMEPHT_THUMB.$home_phtos->photo;?>" alt="#"/></a>
							            	</div>
									<?php } } } ?>
								</div>
		</div>
   
<section class="full-row">
		<div class="container">
			<div class="row">
			    <div class="col-md-12 col-lg-12">
					<div class="row">					  
						<div class="col-md-8 col-lg-8">
						    <h5 class="color-primary"><?php echo $location;?></h5>
						    <div class="row">
						        <div class="col-md-4 col-lg-4"><button class="btn btn-default1 w-100">
						            <?php
								 $entry_time = $profile_info->entry_time;
                                 $diff = strtotime(date("Y-m-d")) - strtotime(date('Y-m-d',strtotime($entry_time))); 
                                 $days = abs(round($diff / 86400)); 
                                 if($days <=14){
								?>
								<center> Early bird</center>
								<?php } else echo'Free to message'; ?>
						            </button></div>
						        <div class="col-md-8 col-lg-8 pt-2"><?php 
						        if($total_home_rooms >1){
						         echo    $total_home_rooms .' rooms for rent ';
						            
						        }
						        else
						        {
						          if( $homedes_rooms && isset($roomtypes_status_config[$homedes_rooms->room_type]) ){
						          ?>
						         <?php  echo $roomtypes_status_config[$homedes_rooms->room_type];?> room  with  <?php echo $bathrooms_status_config[$homedes_rooms->bathroom];?> bathroom 
						        
						          <?php
						          }
						            
						        }
						        ?>
						        
						        
						        </div>
						    </div>
						    
						<div class="row">
						    <?php if(count($homedes_all_rooms)>1){ 
						     foreach($homedes_all_rooms as $roomslist){?>
							<div class="col-md-3 col-lg-3 col-6  pt-4">
							  <h5 class="color-primary">$<?php echo $roomslist->weekly_rent;?>/wk</h5><?php echo $bills_status_config[$roomslist->bills];?>
                          	</div>
                          	<?php } } else{ ?>
                          		<div class="col-md-3 col-lg-3 col-6 pt-4">
							  <h5 class="color-primary">$<?php echo $weekly_rent;?>/wk</h5><?php echo $bills_included;?>
                          	</div>
                          	<?php } ?>
							<div class="col-md-3 col-lg-3 col-6 pt-4">
							  <h5 class="color-primary"><i class="fa fa-bed" aria-hidden="true"></i> <?php echo $total_bedrooms;?></h5>Bedrooms
                          	</div>			    	
							<div class="col-md-3 col-lg-3 col-6 pt-4">
							  <h5 class="color-primary"><i class="fa fa-bath" aria-hidden="true"></i> <?php echo $total_bathrooms;?></h5>Bathrooms
                          	</div>
                          		<div class="col-md-3 col-lg-3 col-6 pt-4">
							  <h5 class="color-primary"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $total_flatmates;?></h5>Flatmates
                          	</div>
									    	
						</div>	
									    
									   
						    
						    
						    
							<div class="over_view pt-4">
								<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
								  <li class="nav-item">
								    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">About</a>
								  </li>
								  <li class="nav-item">
								    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Property preferences</a>
								  </li>
								   <li class="nav-item">
								    <a class="nav-link" id="pills-profile1-tab" data-toggle="pill" href="#pills-profile1" role="tab" aria-controls="pills-profile1" aria-selected="false">Room overview</a>
								  </li>
								    <li class="nav-item">
								    <a class="nav-link" id="pills-profile2-tab" data-toggle="pill" href="#pills-profile2" role="tab" aria-controls="pills-profile2" aria-selected="false">About the flatmates</a>
								  </li>
								  
								</ul>
								<div class="tab-content mt_60" id="pills-tabContent">
								  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
								  	<h4 class="color-primary mb_30">About the property</h4>
								  	<?php echo $about_me;?>
								  </div>
								  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
								  	<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
								  	<h4 class="color-primary mb_30">Details</h4>
								  	
									    <div class="agent_data mt_60 color-secondery">
									    	<div class="row">
									    	    <?php 
									    	        foreach($flatmates_preferences_list as $flatmates_preferences_list_val){
									    	    ?>
									    	   	<div class="col-4 col-md-4 col-lg-4">
									    			<h5 class="color-primary"><i class="fa fa-check" aria-hidden="true"></i> <?php echo $flatmates_preferences_list_val;?></h5>
									    		</div>
									    		<?php } ?>
									    	
									    	 
									    	</div>	
									    </div>									    
										
										
									
								  </div>
								  </div>
								  <div class="tab-pane fade" id="pills-profile1" role="tabpanel" aria-labelledby="pills-profile1-tab">
								  	
								  	<?php
								  	$about_flatmates='';
								  	if(count($homedes_all_rooms) >0){
								  	    $roomscounter=0;
								  	 foreach($homedes_all_rooms as $roomsinfo){  $roomscounter++;
								  	 
								     	 $room_weekly_rent      =  $roomsinfo->weekly_rent;
                                         $room_bond_amount      =  $room_weekly_rent*(int)$bond_status_config[$roomsinfo->bond];
								  	     $room_bills_included   =  $bills_status_config[$roomsinfo->bills];
								  	     
								  	     
								  	     $room_availability          =  $this->common_model->room_availability($roomsinfo->room_id,$listing_id);
								  	     $room_flatmates_preferences =  $this->common_model->room_flatmates_preferences($roomsinfo->room_id,$listing_id);
								  	     $room_features              =  $this->common_model->room_features($roomsinfo->room_id,$listing_id);
								  	     
								  	     
								  	    $room_features_list=array();
                                        if($room_features){
                                            $room_furnishings_features = explode(",",$room_features->furnishings_features);
                                            foreach($room_furnishings_features as $room_furnishings_features_val){
                                                if($room_furnishings_features_val)
                                                    $room_features_list[]= $room_furnishing_features[$room_furnishings_features_val];
                                                
                                              }
                                          }
								  	     
								  	     if($room_availability){
								  	       $available_date = date('d M Y',strtotime($room_availability->date_available));   
								  	      
								  	     }
								  	     else
								  	      $available_date='';
								  	      
								  	      
								  	      if($room_flatmates_preferences){
								  	       $room_flatmates_preferences_list = $flatmatespref_status_config[$room_flatmates_preferences->preference];  
								  	       $about_flatmates            = ($room_flatmates_preferences)?$room_flatmates_preferences->about_flatmates:"";
								  	     }
								  	     else{
								  	      $room_flatmates_preferences_list='';
								  	      $about_flatmates ='';
								  	     }
								  	      
								  	 ?>
								  	<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
								     	<h4 class="color-primary mb_30">
								     	    <?php if( $roomscounter==1)
								     	             $show_counter='';
								     	           else
								     	             $show_counter= $roomscounter;
								     	             ?>
								     	    
								     	    Room <?php echo  $show_counter;?> Overview</h4>
									    <div class="agent_data mt_60 color-secondery">
									    <div class="row">
									    	   
									    	   	<div class="col-6 col-md-6 col-lg-6">
									    			<h5 class="color-primary">$<?php echo $room_weekly_rent;?> weekly rent</h5>$<?php echo $room_bond_amount;?> bond
									    		</div>
									    		<div class="col-6 col-md-6 col-lg-6">
									    			<h5 class="color-primary"><i class="fa flaticon-bill" aria-hidden="true"></i> Bills <?php echo $room_bills_included;?> </h5> Internet <?php echo $internet;?>
									    		</div>
									    
									    
									    </div>									    
										<div class="row">
									    	   
									    	   	<div class="col-6 col-md-6 col-lg-6">
									    			<h5 class="color-primary"><i class="fa flaticon-room" aria-hidden="true"></i><?php echo $roomtypes_status_config[$roomsinfo->room_type];?> room</h5>
									    		</div>
									    		<div class="col-6 col-md-6 col-lg-6">
									    			<h5 class="color-primary"><i class="fa fa-bath" aria-hidden="true"></i><?php echo $bathrooms_status_config[$roomsinfo->bathroom];?> bathroom </h5> 
									    		</div>
									    
									    
									    </div>	
										<div class="row">
									    	   
									    	   	<div class="col-6 col-md-6 col-lg-6">
									    			<h5 class="color-primary"><i class="fa fa-calendar" aria-hidden="true"></i>Flexible length of stay</h5> available <?php echo $available_date;?>
									    		</div>
									    		<div class="col-6 col-md-6 col-lg-6">
									    			<h5 class="color-primary"><i class="fa fa-user" aria-hidden="true"></i><?php echo $room_flatmates_preferences_list;?> welcome </h5> 
									    		</div>
									    
									    
									    </div>	
									    <div class="row">
									    	   
									    	   	<div class="col-6 col-md-6 col-lg-6">
									    			<h5 class="color-primary"><i class="fa fa-bed" aria-hidden="true"></i><?php echo $roomfurnishings_status_config[$roomsinfo->room_furnishings];?> with furnishings</h5> 
									    		</div>
									    		<div class="col-6 col-md-6 col-lg-6">
									    			<h5 class="color-primary"><i class="fa fa-car" aria-hidden="true"></i><?php echo $parking;?> </h5> 
									    		</div>
									    
									    
									    </div>	
								      </div>
								      
								      
								      <div class="agent_data mt_60 color-secondery">
								        <h4 class="color-primary mb_30">FEATURES</h4> 
								        <div class="row">
									    	   <?php if($room_features_list){ 
									    	       foreach($room_features_list as $room_features_info){?>
									    	   	<div class="col-6 col-md-6 col-lg-6">
									    			<h5 class="color-primary"><?php echo $room_features_info;?></h5>
									    		</div>
									    	<?php } } ?>
									    
									    
									    </div>	
								      </div>   
								          <hr>
								    </div>
								  <?php } }
								  ?>
								 
								 
								  
								  
								   </div>
								  <div class="tab-pane fade" id="pills-profile2" role="tabpanel" aria-labelledby="pills-profile2-tab">
								  	<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
								  	<h4 class="color-primary mb_30">Details</h4>
								  	
									    <div class="agent_data mt_60 color-secondery">
									    	<div class="row">
									    	    <?php
									    	    
									    	    if($about_flatmates)
									    	    echo $about_flatmates;?>
									    	
									    	</div>	
									    
									    
									    </div>									    
										
										
									
								  </div>
								  </div> 
								  
								</div>
							</div>
						</div>
						<div class="col-md-4 col-lg-4">
							<div class="broker_contact mt_30 d-inline-block p_30 boxshadow_one">
								<div class="img_80 float-left pr_20 mb_20"><?php echo $thumb_photo;?></div>
								<div class="broker_name">
									<h6 class="font-weight-bold color-default"><?php echo $full_name;?></h6>
									<span class="color-secondery"><?php
									if($check_mobile_access){
								        echo $mobile_no;
								        $check_mobile_access_url='';
									}
								     else{
								         
								       $check_mobile_access_url='<a href="javascript:void(0);" id="show_mobile_upgrade" class="btn btn-default1 w-100">Show '.  $full_name.' number</a>';
								         
								     }    
								        ?></span>
								</div>
								 <?php if(is_customer_logged_in()){?>
								<form class="form4 w-100 d-inline-block" action="<?php echo customer_path();?>send_message/submit" method="post">
								    <?php } else{ ?>
								    <form  class="form4 w-100 d-inline-block">
								    <?php } ?>
								    <?php echo form_hidden('listingid',$listing_id); ?>
									<div class="row">
									  	<div class="col-md-12 col-lg-12">
									  		<div class="form-group">
											  <textarea class="form-control" id="message" name="message" cols="30" rows="6" placeholder="Type your message" required></textarea>
											</div>
									  	</div>
									  		<div class="col-md-12 col-lg-12">
									  	    <?php if(is_customer_logged_in()){
									  	      if($check_access && $days>14){
									  	    ?>
											<button type="submit" id="send" value="submit" class="btn btn-default1 w-100">Send message to <?php echo  $full_name;?></button>
											<?php }
											elseif($sms_to_all_access){?>
												<button type="submit" id="send" value="submit" class="btn btn-default1 w-100">Send message to <?php echo  $full_name;?></button>
												
										  <?php } else{ ?> 
										
												<a href="javascript:void(0);" id="send_sms_upgrade" class="btn btn-default1 w-100 ">Send message to <?php echo  $full_name;?></a><br><br>
												<?php echo $check_mobile_access_url;?>
											   
											<?php }  }  else { ?>
											<a href="<?php echo base_url();?>login" class="btn btn-default1 w-100">Login to message <?php echo  $full_name;?></a><br><br>
											<a href="<?php echo base_url();?>login" class="btn btn-default1 w-100">Login to show <?php echo  $full_name;?> number</a>
											
											<?php } ?>
									  	</div>
									</div>
								</form>
							</div>
							<br>
							<a href="#" class="color-primary mb_30 p_4" data-toggle="modal" data-target="#report_modal"><i class="fa fa-warning" aria-hidden="true"></i> Report this property</a>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<style>
	    #report_modal .modal-content{top:90px;}
	    
	</style>
	<div id="report_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" style="float:left;">Report this property</h4>  
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
        <?php if(is_customer_logged_in()){?>
								<form class="form4 w-100 d-inline-block" action="<?php echo customer_path();?>report_listing/submit" method="post">
								    <?php } else{ ?>
								    <form  class="form4 w-100 d-inline-block">
								    <?php } ?>
								    <?php echo form_hidden('listingid',$listing_id); ?>
								    <div class="row">
									  	<div class="col-md-12 col-lg-12">
									  		<div class="form-group">
											  <?php 
											  echo form_dropdown('report_property_list', $report_property_list, set_value('report_property_list'),'class="form-control" id="report_property_list" required="true"');
											  ?>
											</div>
									  	</div>
									  	
									  <div class="col-md-12 col-lg-12" id="reason_desc">
									  	</div>	
									  	
									  	<div class="col-md-12 col-lg-12">
									  	    <?php if(is_customer_logged_in()){?>
											<button type="submit" id="submit_report" value="submit" class="btn btn-default1 w-100">Submit</button>
											<?php } else { ?>
											<a href="<?php echo base_url();?>login" class="btn btn-default1 w-100">Login to report</a>
											
											<?php } ?>
									  	</div>
									</div>
								    
								    </form>
      </div>
    </div>

  </div>
</div>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/css/lightbox.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/js/lightbox-plus-jquery.min.js"></script>
<script>
    lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true
    });
</script>
<?php
$below_app_js = array('js/common.js');
$this->load->view('includes/footer', array(
	'below_app_js' => $below_app_js)); ?>
	
