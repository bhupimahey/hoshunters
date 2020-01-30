<?php
$header = array('title' => 'Profiles');
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
							<h4 class="color-primary mb-4">Profiles List</h4>
							
							<div class="items_list bg_transparent color-secondery icon_default">
								<table class="w-100">
									<thead>
										<tr class="bg-white">
											<th>Listing</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Added Date</th>											
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
                                    <?php									
									if($listings_list){
										foreach($listings_list['data'] as $listing){
									?>
										<tr>
											<td>
												<a href="<?php echo customer_path();?>listing/preview/<?php echo $listing['profile_id'];?>"><?php echo $listing['photo'];?></a>
												<div class="property_info d-table">
													<h5 class="color-primary"><a href="<?php echo customer_path();?>listing/preview/<?php echo $listing['profile_id'];?>"><?php echo $listing['profile_type'];?></a></h5>
													<span class="location"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $listing['locations'];?></span>
													<div class="price mt-3">
                                                    <?php if($listing['profile_status']==='1'){?>
															Profile : <span class="color-default">Active</span>
													<?php } elseif($listing['profile_status']==='0'){ ?>
        			                                        Profile : <span class="color-red">Inactive</span>
													<?php } ?>
                                                	</div>
                                                	<div class="price mt-3">
                                                    <?php if($listing['listing_confirmed']==='1'){?>
															Listing : <span class="color-default">Confirmed</span>
													<?php } elseif($listing['listing_confirmed']==='0'){ ?>
        			                                        Listing : <span class="color-red">Not Confirmed</span>
													<?php } ?>
                                                	</div>
												</div>
											</td>
                                            <td><?php echo $listing['full_name'];?></td>
											<td><?php echo $listing['mobile_no'];?></td>
											<td>
                                            <?php echo $listing['entry_date'];?>												
											</td>
                                            <td>
                                            <?php echo $listing['user_actions'];?>												
											</td>
										</tr>
									<?php } } ?>	
											
									</tbody>
								</table>
							</div>
							<nav aria-label="Page navigation" class="alinment d-table pt-5">
							<?php echo $listings_list['links'];?>
						
							</nav>
							
						</div>
						
					</div>
				
				
					
				</div>
			
			
						
					</div>
				</div>
			</div>
		</div>
	</div>
 
   
<?php 
$above_app_js = array();
$below_app_js=array('');
$this->load->view('includes/footer',array('below_app_js'=>$below_app_js,'above_app_js' => $above_app_js)); ?>