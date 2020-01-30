<?php
$header = array('title' => 'Add Membership Plan');
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
							<h4 class="color-primary mb-4">Add Membership Plan</h4>
							
							<div class="submit_form color-secondery icon_primary p-5 bg-white">
								<?php  $attributes = array('id' => 'plans_frm','name' => 'plans_frm','novalidate'=>'','class' => '','autocomplete' => 'off');
						                echo form_open_multipart(admin_path().'membership_plans/add/submit', $attributes);							 
			                      ?>
									<div class="description">
									<?php $this->message_output->run(); ?>
										<h5 class="color-primary">Basic Information</h5>
										<hr>
										<div class="row">
											<div class="col-lg-12 col-md-12">
												<div class="form-group">
													<label>Plan Title</label><span class="ml-2 fa-2x"></span>
													<?php $data = array('class' =>'form-control', 'name'=> 'plan_name','required'=>'true',  'id'=> 'plan_name');
															echo form_input($data); 
													?>
												</div>
											</div>
											<div class="col-lg-12 col-md-12">
												<div class="form-group">
													<label>Description</label><span class="ml-2 fa-2x"></span>
													<?php $data = array('class' =>'form-control ckeditor', 'name'=> 'plan_features', 'id'=> 'plan_features');
														echo form_textarea($data); ?>
												</div>
											</div>
											
											<div class="col-lg-12 col-md-12">
												<div class="form-group">
													<label>Plan Cost</label><span class="ml-2 fa-2x"></span>
													<?php $data = array('class' =>'form-control', 'name'=> 'plan_cost', 'id'=> 'plan_cost');
														echo form_input($data); 
													?>
												</div>
											</div>
											
											<div class="col-lg-12 col-md-12">
												<div class="form-group">
													<label>Plan Validity</label><span class="ml-2 fa-2x"></span>
													<?php
												echo form_dropdown('plan_validity', $planvaliditylist,set_value("plan_validity"),'class="form-control" ');
													?>
												</div>
											</div>
											<div class="col-lg-12 col-md-12">
												<div class="form-group">
													<label>Roles</label><span class="ml-2 fa-2x"></span>
													<div class="row">
													    
													<?php
													foreach($packages_roles as $role_key => $role_val){
													?>
													<div class="col-lg-6 col-md-6">
													 <ul class="check_submit">   
													<li><input type="checkbox" name="package_roles[]" class="hide" id="package_roles<?php echo $role_key;?>" value="<?php echo $role_key;?>">
            <label for="package_roles<?php echo $role_key;?>"><?php echo $role_val;?></label></li>	</ul>
                                                    </div>
													<?php } ?>
												
													</div>
												</div>
											</div>	
									<div class="col-lg-12 col-md-12">
												<div class="form-group">
													<label>Highlights Package</label><span class="ml-2 fa-2x"></span>
													<div class="row">
													 
													<div class="col-lg-6 col-md-6">
													 <ul class="check_submit">   
													<li><input type="checkbox" name="highligh_package" class="hide" id="highligh_package" value="1">
                                                    <label for="highligh_package">Mark Highlights</label></li>	</ul>
                                                    </div>
												
													</div>
												</div>
											</div>		
											<div class="col-lg-12 col-md-12">
												<div class="form-group">
													<label>Special Notes On Package</label><span class="ml-2 fa-2x"></span>
													<?php $data = array('class' =>'form-control ckeditor', 'name'=> 'special_notes', 'id'=> 'special_notes');
														echo form_textarea($data); ?>
												</div>
											</div>	
										<div class="col-lg-12 col-md-12">
												<div class="form-group">
													<label>Status</label><span class="ml-2 fa-2x"></span>
													<?php
												echo form_dropdown('status', $StatusList,set_value("status"),'class="form-control" ');
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
$below_app_js=array('js/jquery.validate.min.js','js/add_membership_plans.js','ckeditor/ckeditor.js');
$this->load->view('includes/'.admin_folder.'footer',array('below_app_js'=>$below_app_js)); ?>