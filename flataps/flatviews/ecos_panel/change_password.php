<?php
$header = array('title' => 'Change Password');
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
							<h4 class="color-primary mb-4">Change Password</h4>
							
							<div class="submit_form color-secondery icon_primary p-5 bg-white">
								<?php  $attributes = array('id' => 'changepassword_frm','name' => 'changepassword_frm','novalidate'=>'','class' => '','autocomplete' => 'off');
						                echo form_open_multipart(admin_path().'change_password/submit', $attributes);							 
			                      ?>
									<div class="description">
									<?php $this->message_output->run(); ?>
										<h5 class="color-primary">Basic Information</h5>
										<hr>
										<div class="row">
											<div class="col-lg-12 col-md-12">
												<div class="form-group">
													<label>New Password</label><span class="ml-2 fa-2x"></span>
													<?php $data = array('class' =>'form-control', 'name'=> 'new_password','required'=>'true',  'id'=> 'new_password');
															echo form_password($data); 
													?>
												</div>
											</div>
                                            
                                            <div class="col-lg-12 col-md-12">
												<div class="form-group">
													<label>Confirm New Password</label><span class="ml-2 fa-2x"></span>
													<?php $data = array('class' =>'form-control', 'name'=> 'confirm_password','required'=>'true',  'id'=> 'confirm_password');
															echo form_password($data); 
													?>
												</div>
											</div>
                                            
                                         
												
											</div>
											
										</div>
									</div>
								
										<hr>
										<div class="row">
										
										
										
											<div class="col-md-12">
										<div class="form-group text-center">
										<button type="submit" class="btn btn-default1">Submit</button>
											
													</div>
											
											</div>
										</div>
									
									
									
									</div>
								</form>
                                <?php  $this->load->view('includes/' . admin_folder . 'inner_copyright');?>
							</div>
                            
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
<?php  $this->load->view('includes/' . admin_folder . 'inner_footer');?>
<?php 
$below_app_js=array('js/jquery.validate.min.js','js/change_password.js');
$this->load->view('includes/'.admin_folder.'footer',array('below_app_js'=>$below_app_js)); ?>