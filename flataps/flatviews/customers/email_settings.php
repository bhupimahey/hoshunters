<?php
$header = array('title' => 'Email alert Settings');
$this->load->view('includes/header', $header);
?>
<body>
<?php  $this->load->view('includes/pages_inner_header');?>
	<div class="full-row deshbord">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-1 col-xl-2 bg-primary">
					<?php $this->load->view('includes/sidebar');?>
				</div>
				<div class="col-md-11 col-xl-10 bg-gray">
					<div class="row">
						<div class="full-row deshbord_panel w-100 mb-5">
							<h4 class="color-primary mb-4">Email alert Settings</h4>
							
							<div class="submit_form color-secondery icon_primary p-5 bg-white">
								<?php  $attributes = array('id' => 'profileinfo_frm','name' => 'profileinfo_frm','novalidate'=>'','class' => '','autocomplete' => 'off');
						                echo form_open(customer_path().'email_setting/submit', $attributes);
			                      ?>
									<div class="description">
									<?php $this->message_output->run(); ?>
										<h5 class="color-primary">Account Info</h5>
										<hr>
								<div class="row mt-4">
										<div class="col-lg-12 col-md-12">
									        
									        <div class="row">
									              <div class="col-lg-6 col-md-6">
									                	<label><strong>Listing alerts</strong><br>
                                                        We'll only send listing alerts when you have an active listing</label>
									                </div>
									             <div class="col-lg-6 col-md-6">
									                <?php $listing_alert_list=array(); 
									                 $listing_alert_list['real_time']='Real Time';
									                 $listing_alert_list['daily']='Daily';
									                 $listing_alert_list['none']='None';
									                 
									                 if($alerts_info && $alerts_info->listing_alerts!='')
									                   $sel_listing_alert=$alerts_info->listing_alerts;
									                 else
									                 $sel_listing_alert='';
									               
                                                	echo form_dropdown("listing_alert", $listing_alert_list,$sel_listing_alert,' class="form-control" id="listing_alert"');
                                                	?>
									                </div>    
									        </div>    
									        <br>
									            
									         <div class="row">
									              <div class="col-lg-6 col-md-6">
									                	<label><strong>New Device alerts</strong><br>
                                                        You will be notified when a new device or browser has accessed your account</label>
									                </div>
									             <div class="col-lg-6 col-md-6">
									               <?php $newdevice_alert_list=array(); 
									                 $newdevice_alert_list['on']='On';
									                 $newdevice_alert_list['no']='No Thanks';
									                 
									                 if($alerts_info && $alerts_info->new_device_alerts!='')
									                   $sel_new_device_alerts=$alerts_info->new_device_alerts;
									                 else
									                 $sel_new_device_alerts='';
									                 
                                                	echo form_dropdown("newdevice_alert", $newdevice_alert_list,$sel_new_device_alerts,' class="form-control" id="newdevice_alert"');
                                                	?>
									                </div>    
									        </div>       
										 <br>
										    <div class="row">
									              <div class="col-lg-6 col-md-6">
									                	<label><strong>Message alerts</strong><br>
                                                        You will only receive new message alerts when you have an active listing</label>
									                </div>
									             <div class="col-lg-6 col-md-6">
									                   Always On
									                </div>    
									        </div>  
									         <br>
									        <div class="row">
									              <div class="col-lg-6 col-md-6">
									                	<label><strong>Community notices</strong><br>
                                                        Hosthunters news, events and competitions</label>
									                </div>
									             <div class="col-lg-6 col-md-6">
									                <?php $community_alert_list=array(); 
									                 $community_alert_list['on']='On';
									                 $community_alert_list['no']='No Thanks';
									                 
									                 if($alerts_info && $alerts_info->community_notices!='')
									                   $sel_community_notices=$alerts_info->community_notices;
									                 else
									                 $sel_community_notices='';
									                 
                                                	echo form_dropdown("community_alert", $community_alert_list,$sel_community_notices,' class="form-control" id="community_alert"');
                                                	?>
									                </div>    
									        </div>  
									         <br>
									        <div class="row">
									              <div class="col-lg-6 col-md-6">
									                	<label><strong>Special offers</strong><br>
                                                        Exclusive offers from our partners</label>
									                </div>
									             <div class="col-lg-6 col-md-6">
									                 <?php $specialoffer_alert_list=array(); 
									                 $specialoffer_alert_list['on']='On';
									                 $specialoffer_alert_list['no']='No Thanks';
									                 
									                  if($alerts_info && $alerts_info->special_offers!='')
									                   $sel_special_offers=$alerts_info->special_offers;
									                 else
									                 $sel_special_offers='';
									                 
                                                	echo form_dropdown("specialoffer_alert", $specialoffer_alert_list,$sel_special_offers,' class="form-control" id="specialoffer_alert"');
                                                	?>
									                </div>    
									        </div> 
											
										</div>
									
									
									</div>
									        		
										</div>
									</div>
								
										<hr>
										<div class="row">
										
										
											<div class="col-md-12">
										<div class="form-group text-center">
										<button type="submit" class="btn btn-default1">Save Changes</button>
											
										</div>
											
											</div>
										</div>
									
									
									
									</div>
								</form>
                               
							</div>
                            
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
<?php 
$below_app_js=array('js/jquery.validate.min.js','js/change_password.js');
$this->load->view('includes/footer',array('below_app_js'=>$below_app_js)); ?>