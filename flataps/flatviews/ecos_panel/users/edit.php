<?php
$header = array('title' => 'Update User');
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
							<h4 class="color-primary mb-4">Update User</h4>
							
							<div class="submit_form color-secondery icon_primary p-5 bg-white">
								<?php  $attributes = array('id' => 'user_frm','name' => 'user_frm','novalidate'=>'','class' => '','autocomplete' => 'off');
						        echo form_open_multipart(admin_path().'users/edit/'.$user_id.'/submit', $attributes);							 
			                    ?>
									<div class="description">
									<?php $this->message_output->run(); ?>
										<h5 class="color-primary">Basic Information</h5>
										<hr>
										<div class="row">
											<div class="col-lg-12 col-md-12">
												<div class="form-group">
													<label>Full Name</label><span class="ml-2 fa-2x"></span>
													<?php $data = array('class' =>'form-control', 'name'=> 'full_name','required'=>'true',  'id'=> 'full_name','value'=>$UserInfo->full_name);
															echo form_input($data); 
													?>
												</div>
											</div>
										<div class="col-lg-12 col-md-12">
												<div class="form-group">
													<label>Email</label><span class="ml-2 fa-2x"></span>
													<?php $data = array('class' =>'form-control', 'name'=> 'email_id','required'=>'true',  'id'=> 'email_id','value'=>$UserInfo->email_id);
															echo form_input($data); 
													?>
												</div>
											</div>
										<div class="col-lg-12 col-md-12">
												<div class="form-group">
													<label>Mobile</label><span class="ml-2 fa-2x"></span>
													<?php $data = array('class' =>'form-control', 'name'=> 'mobile_no','required'=>'true',  'id'=> 'mobile_no','value'=>$UserInfo->mobile_no);
															echo form_input($data); 
													?>
												</div>
											</div>	
										<div class="col-lg-12 col-md-12">
												<div class="form-group">
													<label>Status</label><span class="ml-2 fa-2x"></span>
													<?php
												echo form_dropdown('status', $StatusList,$UserInfo->account_status,'class="form-control" ');
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
$below_app_js=array('assets/pages/form-validation/validate.js','assets/pages/form-validation/information.js');
$this->load->view('includes/'.admin_folder.'footer',array('below_app_js'=>$below_app_js)); ?>