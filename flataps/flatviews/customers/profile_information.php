<?php
$header = array('title' => 'Update Profile Information');
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
							<h4 class="color-primary mb-4">Update Profile Information</h4>
							
							<div class="submit_form color-secondery icon_primary p-5 bg-white">
								<?php  $attributes = array('id' => 'profileinfo_frm','name' => 'profileinfo_frm','novalidate'=>'','class' => '','autocomplete' => 'off');
						                echo form_open_multipart(customer_path().'profile_information/submit', $attributes);
						                
						                
			                      ?>
									<div class="description">
									<?php $this->message_output->run(); ?>
										<h5 class="color-primary">Account Info</h5>
										<hr>
								<div class="row mt-4">
										<div class="col-lg-6 col-md-12">
									
											<div class="form-group">
												<label>Your Name</label>
												<?php $data = array('class' =>'form-control','name'=> 'your_name',  'id'=> 'your_name',"required"=>"true","value"=>$profile_info->full_name);
                                               	echo form_input($data); ?>
											
											</div>
											<div class="form-group">
												<label>Your Email</label>
												<?php $data = array('class' =>'form-control', 'type'=>'email','name'=> 'email_id', 'id'=> 'email_id',"required"=>"true","value"=>$profile_info->email_id);
                                               	echo form_input($data); ?>
											</div>
											<div class="form-group">
												<label>Phone Number</label>
												<?php $data = array('class' =>'form-control','name'=> 'phone_number',  'id'=> 'phone_number',"required"=>"true","maxlength"=>"10","readonly"=>"true", "value"=>$profile_info->mobile_no);
                                               	echo form_input($data); ?>
											</div>
										
											
										</div>
										<div class="col-lg-1"></div>
										<div class="col-lg-5 col-md-12">
											<div class="user_photo">
											    <?php
											    if($profile_info->photo_path!=''){
											        $file_path=base_url().CNTPHT_THUMB.$profile_info->photo_path;
											    }
											    else{
											         $file_path=base_url().NO_IMAGE;
											    }
											    ?>
												<img src="<?php echo $file_path;?>" alt="<?php echo $profile_info->full_name;?>">
												<div class="d-table">
													<label class="btn btn-default1 mb-0 mr-2" for="btn-uploat">Upload File</label>
													<input id="btn-uploat" class="hide" type="file" name="profile_photo">
													<?php if($profile_info->photo_path!=''){ ?> 
													<a href="<?php echo customer_path();?>delete_photo" class="btn btn-default1">Delete Photo</a>
													<?php } ?>
													<?php if($profile_info->mobile_no!=''){?>
														<a href="<?php echo customer_path();?>profile/change/mobile" class="btn btn-default1">Change Number</a>
													<?php } else {?>	
													   <a href="<?php echo customer_path();?>profile/verify/mobile" class="btn btn-default1">Verify Mobile</a>
													<?php } ?>
													
													 
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