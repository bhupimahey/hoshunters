<?php
$header = array('title' => 'User Messages List');
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
							<h4 class="color-primary mb-4">User Messages List</h4>
							
                            <?php $this->message_output->run(); ?>
							<div class="items_list bg_transparent color-secondery icon_default">
								<table class="w-100">
									<thead>
										<tr class="bg-white">
                                           <th>Send From</th>
											<th>Send To</th>
											<th>Message</th>
											<th>Status</th>
                                            <th>Dated</th>
										</tr>
									</thead>
									<tbody>
									<?php									
							         if($messages_list){
								        foreach($messages_list['data'] as $list){     ?>	
										<tr>
                                            <td><?php echo $list['send_from'];?></td>
											<td><?php echo $list['send_to'];?></td>
											<td><?php echo $list['message_body'];?></td>
											<td><?php echo $list['message_status'];?></td>											
                                            <td><?php echo $list['entry_date'];?></td>
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