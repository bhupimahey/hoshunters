<?php
$header = array('title' => 'Membership Plans List');
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
							<h4 class="color-primary mb-4">Membership Plans List<div style="float:right;"><a href="<?php echo admin_path();?>membership_plans/add" class="btn btn-default1 appartment color-default ml-3"><i class="fa fa-plus"></i> Add</a></div></h4>
							
                            <?php $this->message_output->run(); ?>
							<div class="items_list bg_transparent color-secondery icon_default">
								<table class="w-100">
									<thead>
										<tr class="bg-white">
											<th>Plan Name</th>
											<th>Plan Cost</th>
											<th>Plan Duration</th>
											<th>Details</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
							if($plans_list){
								 foreach($plans_list['data'] as $list){
								
								?>	
										<tr>
											<td><?php echo $list['package_name'];?></td>
											<td><?php echo $list['package_price'];?></td>
											<td><?php echo $list['package_validity'];?></td>
											<td><?php echo $list['package_features'];?></td>
											<td>
											<?php if($list['info_status']==='1'){?>
												<a href="#" class="appartment color-default ml-3">Active</a>
												<?php } elseif($list['info_status']==='0'){ ?>
												<a href="#" class="appartment color-red ml-3">Inactive</a>
												<?php } ?>
											
											
											
											</td>
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
$below_app_js=array();
$this->load->view('includes/'.admin_folder.'footer',array('below_app_js'=>$below_app_js)); ?>