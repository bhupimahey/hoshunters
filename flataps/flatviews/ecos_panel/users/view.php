<?php
$header = array('title' => 'Users List');
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
							<h4 class="color-primary mb-4">Users List<div style="float:right;"><a href="<?php echo admin_path();?>users/add" class="btn btn-default1 appartment color-default ml-3"><i class="fa fa-plus"></i> Add</a></div></h4>
							
                            <?php $this->message_output->run(); ?>
							<div class="items_list bg_transparent color-secondery icon_default">
								<table class="w-100">
									<thead>
										<tr class="bg-white">
                                           
											<th>Full Name</th>
											<th>Email</th>
											<th>Mobile</th>
											<th>Status</th>
                                            <th>Register On</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php									
							         if($users_list){
								        foreach($users_list['data'] as $list){
								
								      ?>	
										<tr>
                                            
											<td><?php echo $list['full_name'];?></td>
											<td><?php echo $list['email_id'];?></td>
											<td><?php echo $list['mobile_no'];?></td>											
											<td>
											<?php if($list['account_status']==='1'){?>
												<a href="#" class="appartment color-default ml-3">Active</a>
												<?php } elseif($list['account_status']==='0'){ ?>
												<a href="#" class="appartment color-red ml-3">Inactive</a>
										   <?php } ?>
											
											
											
											</td>
                                            <td><?php echo $list['entry_date'];?></td>
											<td><?php echo $list['info_actions'];?></td>
										</tr>
										<?php	 
									  }
							}
								?>
										
									</tbody>
								</table>
								
							</div>
							
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