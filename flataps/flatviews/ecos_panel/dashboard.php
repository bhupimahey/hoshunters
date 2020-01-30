<?php
$header = array('title' => 'Dashboard');
$this->load->view('includes/' . admin_folder . 'header', $header);
?>
<body>
	<?php  $this->load->view('includes/' . admin_folder . 'inner_header');?>
	<div class="full-row deshbord">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-1 col-xl-2 bg-primary">
					<?php $this->load->view('includes/' . admin_folder . 'sidebar');?>
				</div>
				<div class="col-md-11 col-xl-10 bg-gray">
					<div class="row">
						<div class="full-row deshbord_panel w-100 mb-5">
							<h4 class="color-primary mb-4">Dashboard</h4>
							
							<div class="available">
								<div class="row">
									<div class="col-md-6 col-xl-3">
										<div class="profile_property asset mb-4">
											<span><i class="flaticon-house-2" aria-hidden="true"></i></span>
											<h4 class="m-0 d-inline-block"><?php echo $total_listing;?></h4>
											<p>Total Listing</p>
										</div>
									</div>
									<div class="col-md-6 col-xl-3">
										<div class="profile_rent asset mb-4">
											<span><i class="flaticon-seller-1" aria-hidden="true"></i></span>
											<h4 class="m-0 d-inline-block"><?php echo $total_users;?></h4>
											<p>Total Users</p>
										</div>
									</div>
									<div class="col-md-6 col-xl-3">
										<div class="profile_sale  asset mb-4">
											<span><i class="flaticon-chat-comment-oval-speech-bubble-with-text-lines" aria-hidden="true"></i></span>
											<h4 class="m-0 d-inline-block"><?php echo $total_pages;?></h4>
											<p>Total Pages</p>
										</div>
									</div>
									<div class="col-md-6 col-xl-3">
										<div class="profile_earning  asset mb-4">
											<span><i class="flaticon-contact-1" aria-hidden="true"></i></span>
											<h4 class="m-0 d-inline-block"><?php echo $total_messages;?></h4>
											<p>Total Mesages</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row massanger">
								<div class="col-md-12 col-xl-6">
									<div class="accordion mt_30" id="accordion1" role="tablist">
		                             
		                                <div class="card mb_20">
		                                    <div class="card-header p-0" role="tab">
		                                        <h6 class="m-0"><a class="panel_accordian" href="#collapseThree" data-toggle="collapse" data-parent="#accordion1" aria-expanded="true">Recent Messages</a></h6>
		                                    </div>
		                                    <div class="collapse show" id="collapseThree" role="tabpanel" style="">
		                                        <div class="card-body">
		                                        	<ul class="recent_comments">
		                                        		
		                                        		<?php
		                                        		if($latest_messages){
		                                        		    foreach($latest_messages['data'] as $message_info){
		                                        		
		                                        		?>
		                                        		<li class="user_reviews borber_b py_30">
															<div class="user_img img_80">
															    <?php
															    if($message_info['photo']==''){ 
                                                                  echo '<img src="'.base_url().'images/user-profile.png">';
                                                                    }
                                                                  else{
                                                                  echo  '<img src="'.base_url().CNTPHT_THUMB.$message_info['photo'].'">';
                                                                  }
                                                                ?>
															    
															</div>
															<div class="feedback d-table">
																<div class="d-inline-block">
																	<h5 class="font-weight-bold color-primary"><?php echo $message_info['send_from_name'];?></h5>
																
																</div>
																<div class="float-right">
																	<p class="float-left pr_20 color-default">to <?php echo $message_info['send_to_name'];?></p>
																</div>
																<p class="color-secondery mt_15"><?php echo $message_info['message_body'];?></p>
																
															</div>
														</li>
														<?php } } else {?>
														 <p>No Record Found!!</p>
														<?php } ?>
		                                        	</ul>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
								</div>
								<div class="col-md-12 col-xl-6">
									<div class="accordion mt_30" id="accordion2" role="tablist">
		                                
										<div class="card mb_20">
		                                    <div class="card-header p-0" role="tab">
		                                        <h6 class="m-0"><a href="#collapseFive" data-toggle="collapse" data-parent="#accordion1" aria-expanded="true" class="panel_accordian">Recent Listings</a></h6>
		                                    </div>
		                                    <div class="collapse show" id="collapseFive" role="tabpanel" style="">
		                                        <div class="card-body">
												    <div class="row">
												       <?php
												       $roomtypes_status    = $this->config->item('roomtypes_status');
				                                       $roomfurnishings_status    = $this->config->item('roomfurnishings_status');
				                                       $property_type  = $this->config->item('property_type');
				    
		                                        		if($latest_listing){
		                                        		    foreach($latest_listing['data'] as $listing_info){
		                                        		    
		                                        		     if($listing_info['profile_type']=='1'){    
		                                        		         
		                                        		           if( $listing_info['suburb'])
                                            				        $location = json_decode($listing_info['suburb']);
                                            				        
                                            				        if( $location [0])
                                            				         $location =  $location[0]->location; 
                                            				         else
                                            				         $location ='';
		                                        		        
		                                        		?> 
												        
												    	<div class="col-md-12 col-lg-12 mb_20">
												    		<div class="recent_properties">
																<img src="images/dashboard/1.png" alt="">
																<div class="properties_info light_gray icon_default">
																	<a class="btn btn-default1" href="<?php echo admin_path();?>listings/view/<?php echo $listing_info['profile_id'];?>">View</a>
																	<h5 class="font-weight-bold color-primary"><?php echo $listing_info['owner_name'];?> Looking in</h5>
																	<p><i class="fa fa-map-marker" aria-hidden="true"></i>  <?php echo character_limiter($location,22);?></p>
																	<span class="dates"><?php echo date("d M, Y",strtotime($listing_info['entry_time']));?></span>
														  		</div>
															</div>
												    	</div>
												    	
												    	<?php } else { 
												    	$property_address = $listing_info['property_address_info'];
												    	 $property_address = json_decode($property_address->property_address);
                            				            if(isset($property_address[0])){
                            				                 $property_address = $property_address[0];
                            				                 $location = $property_address->location;
                            				            }
                            				            else
                            				                $location ='';
												    	
												    	$homedes_rooms =   $listing_info['homedes_rooms'];   
                            				            if($homedes_rooms){
                            				                $room_type = $roomtypes_status[$homedes_rooms->room_type];
                            				                if(isset($roomfurnishings_status[$homedes_rooms->room_furnishings]))
                            				                   $room_furnishings = $roomfurnishings_status[$homedes_rooms->room_furnishings];
                            				                else
                            				                  $room_furnishings ='';
                            				            }
                            				            else{
                            				            $room_furnishings='';
                            				            $room_type='';
                            				            }
                            				            
												    	?>
												    		<div class="col-md-12 col-lg-12 mb_20">
												    		<div class="recent_properties">
																<img src="images/dashboard/1.png" alt="">
																<div class="properties_info light_gray icon_default">
																	<a class="btn btn-default1" href="<?php echo admin_path();?>listings/view/<?php echo $listing_info['profile_id'];?>">View</a>
																	<h5 class="font-weight-bold color-primary">
																	    <?php if(isset($property_type[$listing_info['property_type']])){ ?>
																	    <?php echo $room_furnishings;?> room in a <?php echo $room_type;?> <?php echo $property_type[$listing_info['property_type']];?>
																	    <?php } else { ?>
																	   <?php echo $room_furnishings;?> <?php echo $room_type;?> room    
																	     
																	    
																	    <?php } ?>
																	    
																	    
																	    </h5>
																	<p><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo character_limiter($location,22);?></p>
																	<span class="dates"><?php echo date("d M, Y",strtotime($listing_info['entry_time']));?></span>
														  		</div>
															</div>
												    	</div>
												    	
												    	<?php } ?>
												    	
												    	<?php } } ?>
												    </div>
		                                        </div>
		                                    </div>
		                                </div>
										
		                            </div>
								</div>
							</div>
						</div>
					<?php  $this->load->view('includes/' . admin_folder . 'inner_copyright');?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php  $this->load->view('includes/' . admin_folder . 'inner_footer');?>
<?php 
$below_app_js=array();
$this->load->view('includes/'.admin_folder.'footer',array('below_app_js'=>$below_app_js)); ?>