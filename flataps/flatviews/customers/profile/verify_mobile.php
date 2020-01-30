<?php
$header = array('title' => 'Verify mobile');
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
					<div class="row"  id="verifymobile">
					 <?php  $attributes = array('id' => 'verifymobile_frm','name' => 'verifymobile_frm','novalidate'=>'','class' => '','autocomplete' => 'off');
					        echo form_open('#', $attributes);							 
			         ?>
					<div class="full-row deshbord_panel w-100 mb-5">
							<h4 class="color-primary mb-4">Verify Your Mobile</h4>
							
							<div class="submit_form color-secondery icon_primary p-5 bg-white">
							
									<div class="description">
									<?php $this->message_output->run(); ?>
										<h5 class="color-primary">Verify your Australian mobile number</h5>
										<hr>
										<p>For the security of our community, all members are required to verify an Australian mobile number when listing a property.</p>
										<div class="row">
											<div class="col-lg-6 col-md-6">
												<div class="form-group">
													<label>Mobile number(+61)</label><span class="ml-2 fa-2x"></span>
													<?php $data = array('class' =>'form-control', 'name'=> 'mobile_no','required'=>'true',  'id'=> 'mobile_no','maxlength'=>'10');
															echo form_input($data); 
													?>
												</div>
											</div>
                                            <div class="col-lg-6 col-md-6">
												<div class="form-group">
												<label> <br> <br></label><span class="ml-2 fa-2x"></span>
													    <br>
													    <input type="checkbox" name="members_can_call" id="members_can_call" value="1" checked="true">Allow verified members to contact me on my mobile
												
												</div>
											</div>
                                        		
											</div>
										
										</div>
									 </div>
										<hr>
										<div class="row">
											<div class="col-md-12">
										<div class="form-group text-center">
										<button type="submit" class="btn btn-default1" id="sendsmscodeSubmit">Send SMS Code</button>
													</div>
											
											</div>
										</div>
									</div>
				                	<?php echo form_close();?>
                               
				            	</div>
                     
                   <div class="row"  id="verifysmscode">&nbsp;</div>       
				</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
<?php 
$below_app_js=array('js/jquery.validate.min.js','js/verify_change_profile_mobile.js');
$this->load->view('includes/footer',array('below_app_js'=>$below_app_js)); ?>