<?php
$header = array('title' => ''.$full_name.' - Looking in '.$location.'');
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

<section class="full-row">
		<div class="container">
			<div class="row">
			    
				<div class="col-md-12 col-lg-12">
				     <?php $this->message_output->run(); ?>
					<div class="profile_details mb_30 d-inline-block rounded">
						<div class="row">
							<div class="col-lg-5 col-md-5">
								<div class="pro-img overfollow">
									<?php echo $photo;?>
								</div>
							</div>
							<div class="col-lg-7 col-md-7">
								<div class="profile_data py-4 color-secondery hover_primary">
									<div class="name_deg d-inline-block mb_30">
										<h5 class="font-weight-bold d-block color-primary"><?php echo $full_name;?></h5>
										<button class="btn btn-default1 w-100">
						            <?php
								 $entry_time = $profile_info->entry_time;
                                 $diff = strtotime(date("Y-m-d")) - strtotime(date('Y-m-d',strtotime($entry_time))); 
                                 $days = abs(round($diff / 86400)); 
                                 if($days <=14){
								?>
								<center> Early bird</center>
								<?php } else echo'Free to message'; ?>
						            </button>
									</div>
									
									<div class="bio_data">
										<table class="table">
										  <tbody>
											<tr>
											  <th>Rent budget :</th>
											  <td>$<?php echo $weekly_budget ;?>/wk</td>
											</tr>
											<tr>
											  <th>Stay length :</th>
											  <td><?php echo $length_of_stay;?></td>
											</tr>
											<tr>
											  <th>Move date :</th>
											  <td><?php echo date('d M, Y',strtotime($move_date));?></td>
											</tr>
											 <tr>
											  <th>Age :</th>
											  <td><?php echo $age;?></td>
											</tr>
											 <tr>
											  <th>Gender :</th>
											  <td><?php echo $gender;?></td>
											</tr>
											
										  </tbody>
										</table>
									</div>
									<div class="agent_socalmedia d-inline-block">
										<ul>
											<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
										</ul>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12 col-lg-12">
					<div class="row">
						<div class="col-md-8 col-lg-8">
							<div class="over_view pt-4">
								<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
								  <li class="nav-item">
								    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">About</a>
								  </li>
								  <li class="nav-item">
								    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Property preferences</a>
								  </li>
								   <li class="nav-item">
								    <a class="nav-link" id="pills-profile1-tab" data-toggle="pill" href="#pills-profile1" role="tab" aria-controls="pills-profile1" aria-selected="false">Preferred accommodation types</a>
								  </li>
								    <li class="nav-item">
								    <a class="nav-link" id="pills-profile2-tab" data-toggle="pill" href="#pills-profile2" role="tab" aria-controls="pills-profile2" aria-selected="false">Preferred locations</a>
								  </li>
								  
								</ul>
								<div class="tab-content mt_60" id="pills-tabContent">
								  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
								  	<h4 class="color-primary mb_30">About me</h4>
								  	<?php echo $about_me;?>
								  	
									    <div class="agent_data mt_60 color-secondery">
									    	<div class="row">
									    	    <?php if($life_style_list){ foreach($life_style_list as $stylist){?>
									    		<div class="col-6 col-md-3 col-lg-3">
									    			<h5 class="color-primary"><?php echo $stylist;?></h5>
									    		</div>
									    		<?php } } ?>
									    		
									    	</div>
									    </div>									    
										
										
									
								  </div>
								  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
								  	<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
								  	<h4 class="color-primary mb_30">Details</h4>
								  	
									    <div class="agent_data mt_60 color-secondery">
									    	<div class="row">
									    	    <?php if($listing_preferences->room_furnishings){  ?>
									    	   	<div class="col-6 col-md-6 col-lg-6">
									    			<h5 class="color-primary"><i class="fa fa-bed" aria-hidden="true"></i> Furnished room &nbsp;&nbsp;
							<?php echo $property_reference_rooms[$listing_preferences->room_furnishings];?></h5>
									    		</div>
									    		<?php } ?>
									    		 <?php if($listing_preferences->bathroom_type){  ?>
									    	   	<div class="col-6 col-md-6 col-lg-6">
									    			<h5 class="color-primary"><i class="fa fa-bath" aria-hidden="true"></i> Bathroom &nbsp;&nbsp;<?php echo $property_reference_bathroom[$listing_preferences->bathroom_type];?></h5>
									    		</div>
									    		<?php } ?>
									    	
									    	</div>	
									    	<div class="row">	
									    	  <?php if($listing_preferences->no_of_flatmates){  ?>
									    	   	<div class="col-6 col-md-6 col-lg-6">
									    			<h5 class="color-primary"><i class="fa fa-user" aria-hidden="true"></i> Max no. of flatmates&nbsp;&nbsp;<?php echo $property_reference_maxflatmates[$listing_preferences->no_of_flatmates];?></h5>
									    		</div>
									    		<?php } ?>	
									    		
									    		
									    	   <?php if($listing_preferences->internet){  ?>
									    	   	<div class="col-6 col-md-6 col-lg-6">
									    			<h5 class="color-primary"><i class="fa fa-wifi" aria-hidden="true"></i> Internet &nbsp;&nbsp;<?php echo $property_reference_internet[$listing_preferences->internet];?></h5>
									    		</div>
									    		<?php } ?>
									   </div>
									    		<div class="row">
									    		<?php if($listing_preferences->parking){  ?>
									    	   	<div class="col-6 col-md-6 col-lg-6">
									    			<h5 class="color-primary"><i class="fa fa-car" aria-hidden="true"></i> Parking &nbsp;&nbsp;<?php echo $property_reference_parking[$listing_preferences->parking];?></h5>
									    		</div>
									    		<?php } ?>
									    		
									    	</div>
									    </div>									    
										
										
									
								  </div>
								  </div>
								  
								  <?php// die();?>
								   <div class="tab-pane fade" id="pills-profile1" role="tabpanel" aria-labelledby="pills-profile1-tab">
								  	<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
								  	<h4 class="color-primary mb_30">Details</h4>
								  	
									    <div class="agent_data mt_60 color-secondery">
									    	<div class="row">
									    	    <?php if($place_looking_for){  
									    	        $place_looking_for = explode(",",$place_looking_for);
									    	        if($place_looking_for){
									    	        foreach($place_looking_for as $place_looking_for_val){
									    	    ?>
									    	   	<div class="col-4 col-md-4 col-lg-4">
									    			<h5 class="color-primary"><i class="fa fa-check" aria-hidden="true"></i> <?php echo $place_looking_for_config[$place_looking_for_val];?></h5>
									    		</div>
									    		<?php } } } ?>
									    	
									    	  <?php if($teamups){ ?>
									    		<div class="col-4 col-md-4 col-lg-4">
									    			<h5 class="color-primary"><i class="fa fa-users" style="color:orange" aria-hidden="true"></i> Teamup</h5>
									    		</div>
									    		<?php } ?>
									    	</div>	
									    
									    
									    </div>									    
										
										
									
								  </div>
								  </div>
								  
								  <div class="tab-pane fade" id="pills-profile2" role="tabpanel" aria-labelledby="pills-profile2-tab">
								  	<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
								  	<h4 class="color-primary mb_30">Details</h4>
								  	
									    <div class="agent_data mt_60 color-secondery">
									    	<div class="row">
									    	    <?php if($locations){  
									    	        $place_locations = json_decode($locations);
									    	        if($place_locations){
									    	          foreach($place_locations as $place_locations_key =>  $place_locations_val){
									    	            if($place_locations_val->location!=''){
									    	    ?>
									    	   	<div class="col-4 col-md-4 col-lg-4">
									    			<h5 class="color-primary"><i class="fa fa-check" aria-hidden="true"></i> <?php echo $place_locations_val->location;?></h5>
									    		</div>
									    		<?php } } } } ?>
									    	
									    	
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
									  	    if($check_access  && $days>14){
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
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php
$below_app_js = array();
$this->load->view('includes/footer', array(
	'below_app_js' => $below_app_js)); ?>
