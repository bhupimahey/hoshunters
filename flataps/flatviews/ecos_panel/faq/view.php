<?php
$header = array('title' => 'Faq Information List');
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
							<h4 class="color-primary mb-4">Faq Information Pages List
							<div style="float:right;"><a href="<?php echo admin_path();?>faq/add" class="btn btn-default1 appartment color-default ml-3"><i class="fa fa-plus"></i> Add</a></div>
							</h4>
							<?php $this->message_output->run(); ?>
							
							<ul class="message_list color-secondery mt-4">
								
							<?php
							if($information_list){
								 foreach($information_list['data'] as $list){
								
								?>							
								<li>
									<div class="row">
										<div class="col-md-9 col-lg-10">
											
											<div class="d-table">
												<h5 class="inner_title"><a class="color-primary" href="#"><?php echo $list['info_title'];?></a>
												</h5>
												<?php echo $list['info_actions'];?>
											</div>
										</div>
										<div class="col-md-3 col-lg-2">
											<div class="date_time mt-4 text-right">
												<span><?php echo $list['entry_date'];?></span>
												<span><?php echo $list['entry_time'];?></span>
											</div>
										</div>
									</div>
								</li>
								<?php
									 
									 
								 }
							}
								?>
								
								
									
							</ul>
							
							<nav aria-label="Page navigation" class="alinment d-table pt-5">
							<?php echo $information_list['links'];?>
						
							</nav>
							
						</div>
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
$below_app_js=array('assets/pages/form-validation/validate.js','assets/pages/form-validation/information.js','ckeditor/ckeditor.js');
$this->load->view('includes/'.admin_folder.'footer',array('below_app_js'=>$below_app_js)); ?>