<?php
$header = array('title' => 'Update Faq Information');
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
							<h4 class="color-primary mb-4">Update Faq Information Page</h4>
							
							<div class="submit_form color-secondery icon_primary p-5 bg-white">
								<?php  $attributes = array('id' => 'faq_frm','name' => 'faq_frm','novalidate'=>'','class' => '','autocomplete' => 'off');
						        echo form_open_multipart(admin_path().'faq/edit/'.$information_id.'/submit', $attributes);							 
			                    ?>
									<div class="description">
									<?php $this->message_output->run(); ?>
										<h5 class="color-primary">Basic Information</h5>
										<hr>
										<div class="row">
											<div class="col-lg-12 col-md-12">
												<div class="form-group">
													<label>Faq Title</label><span class="ml-2 fa-2x"></span>
													<?php $data = array('class' =>'form-control', 'name'=> 'faq_title','required'=>'true',  'id'=> 'faq_title','value'=>$PageInfo->faq_title);
															echo form_input($data); 
													?>
												</div>
											</div>
											<div class="col-lg-12 col-md-12">
												<div class="form-group">
													<label>Description</label><span class="ml-2 fa-2x"></span>
													<?php $data = array('class' =>'form-control ckeditor', 'name'=> 'faq_desc', 'id'=> 'faq_desc','value'=>$PageInfo->faq_desc);
														echo form_textarea($data); ?>
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
$below_app_js=array('assets/pages/form-validation/validate.js','assets/pages/form-validation/faq.js','ckeditor/ckeditor.js');
$this->load->view('includes/'.admin_folder.'footer',array('below_app_js'=>$below_app_js)); ?>