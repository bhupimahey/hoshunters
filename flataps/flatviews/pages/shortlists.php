<?php
$header = array('title' => 'Shortlists');
$this->load->view('includes/header', $header);
?>
<body>
<?php $this->load->view('includes/pages_inner_header'); ?>

<div class="page-banner bg-gray">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="breadcrumbs color-secondery">
					<ul>
						<li class="hover_gray"><a href="<?php echo base_url();?>">Home</a></li>
						<li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
						<li class="color-default">Shortlists</li>
					</ul>
				</div>
				<div class="float-right color-primary">
					<h3 class="banner-title font-weight-bold">Shortlists</h3>
				</div>
			</div>
		</div>
	</div>
</div>

<section class="full-row">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-12">
			
				<div class="row">
				    <?php
				    $gender_you_identify = $this->config->item('gender_you_identify');
				    $roomtypes_status    = $this->config->item('roomtypes_status');
				    $roomfurnishings_status    = $this->config->item('roomfurnishings_status');
				    
				    if($short_list['recordsTotal'] >0){ foreach($short_list['data'] as $list){ 
				    
				    if($list['profile_type']=='1'){
				        
				        if( $list['suburb'])
				        $location = json_decode($list['suburb']);
				        
				        if( $location [0])
				         $location =  $location[0]->location; 
				         else
				         $location ='';
				     ?>
				     <div class="col-md-6 col-lg-4">
						<div class="thumbnail_one mb_30 color-secondery">
							<div class="image_area overlay_one overfollow">
							 <?php echo $list['photo']; ?>
												
								<div class="Featured">New</div>
								
								<div class="area_price price_position">$<?php echo $list['weekly_budget'];?> </div>
								<div class="starmark starmark_position" style="cursor:pointer;color:rgb(237, 194, 24)" data-id="<?php echo $list['listing_id'];?>"><i class="fa fa-star-o" aria-hidden="true" style="font-weight: bold;"></i></div>
							</div>
							<div class="thum_one_content">
								<div class="thum_title">
									<h5 class="hover_primary"><a href="<?php echo base_url();?>F<?php echo random_string('numeric', 6);?><?php echo $list['listing_id'];?>"><?php echo  ucwords($list['first_name']);?></a></h5>
									<p><i class="fa fa-map-marker" aria-hidden="true"></i>Looking in: <?php echo character_limiter($location,22);?></p>
									<p><?php 
								if(strlen($list['about_yourself'])<50)
								echo character_limiter($list['about_yourself'],20);
								else{
								echo character_limiter($list['about_yourself'],70);
								?>
								<a class="readSET" href="<?php echo base_url();?>F<?php echo random_string('numeric', 6);?><?php echo $list['listing_id'];?>">readmore</a>
								<?php }
								?></p>
								</div>
								<div class="ft_area p_20">
									<div class="post_author"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $gender_you_identify[$list['gender']];?></div>
									<div class="post_date float-right"><?php echo $list['age']; ?></div>
									<br>
								<?php
								 $entry_time = $list['entry_time'];
                                 $diff = strtotime(date("Y-m-d")) - strtotime(date('Y-m-d',strtotime($entry_time))); 
                                 $days = abs(round($diff / 86400)); 
                                 if($days <=14){
								?>
								<center>Early bird</center>
								<?php } else echo'<center><i class="fa fa-envelope" aria-hidden="true"></i>Free to message</center>'; ?>
								</div>
							</div>
					    </div>
					</div>
				     <?php
				    }
				    
				    else if($list['profile_type']=='2'){
				      
				        if($list['property_address_info']){
				            $property_address_info = $list['property_address_info'];
				            
				            if( $property_address_info){
				                
				                $rentbondbills = $list['rentbondbills'];
				                $rent          = $rentbondbills->weekly_rent;
				                $bill          = $rentbondbills->bills;
				                if($bill==3)
				                 $included ='Inc';
				                 else
				                 $included ='';
				                 
				            $homedes_rooms =   $list['homedes_rooms'];   
				            if($homedes_rooms){
				                $room_type = $roomtypes_status[$homedes_rooms->room_type];
				                $room_furnishings = $roomfurnishings_status[$homedes_rooms->room_furnishings];
				            }
				            else{
				                $room_type = $room_furnishings='';
				            }
				            
				            $property_address = json_decode($property_address_info->property_address);
				            $property_address = $property_address[0];
				            $location = $property_address->location;
				           
				           
				           $total_bathrooms = $property_address_info->total_bathrooms;
				           $total_bedrooms  = $property_address_info->total_bedrooms;
				           $total_flatmates = $property_address_info->total_flatmates; 
				        
				       ?>
				       <div class="col-md-6 col-lg-4">
						<div class="thumbnail_one mb_30 color-secondery">
							<div class="image_area overlay_one overfollow">
							  <?php echo $list['photo']; ?>
												
								<div class="Featured">New</div>
								
								<div class="area_price price_position">$<?php echo $rent.'&nbsp;'. $included;?> </div>
								<div class="starmark starmark_position" style="cursor:pointer;color:rgb(237, 194, 24)" data-id="<?php echo $list['listing_id'];?>"><i class="fa fa-star-o" aria-hidden="true" style="font-weight: bold;"></i></div>
							</div>
							<div class="thum_one_content">
								<div class="thum_title">
									<h5 class="hover_primary"><a href="<?php echo base_url();?>F<?php echo random_string('numeric', 6);?><?php echo $list['listing_id'];?>"><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo character_limiter($location,25);?></a></h5>
									<?php if($room_furnishings!=''  && $room_type!=''){ ?>
									<p><?php echo $room_furnishings;?> room in a <?php echo $room_type;?> house </p>
									<?php } ?>
									<p><?php 
								if(strlen($list['about_yourself'])<50)
								echo character_limiter($list['about_yourself'],20);
								else{
								echo character_limiter($list['about_yourself'],70);
								?>
								<a class="readSET" href="<?php echo base_url();?>F<?php echo random_string('numeric', 6);?><?php echo $list['listing_id'];?>">readmore</a>
								<?php }
								?></p>
								</div>
								<div class="ft_area p_20">
									<div class="post_author" style="padding-right:20px;"><i class="fa fa-bed" aria-hidden="true"></i> <?php echo $total_bedrooms;?></div>
										<div class="post_author" style="padding-right:20px;"><i class="fa fa-bath" aria-hidden="true"></i> <?php echo $total_bathrooms;?></div>
											<div class="post_author"><i class="fa fa-users" aria-hidden="true"></i> <?php echo $total_flatmates;?></div>
											<br>
								<?php
								 $entry_time = $list['entry_time'];
                                 $diff = strtotime(date("Y-m-d")) - strtotime(date('Y-m-d',strtotime($entry_time))); 
                                 $days = abs(round($diff / 86400)); 
                                 if($days <=14){
								?>
								<center>Early bird</center>
								<?php } else echo'<center><i class="fa fa-envelope" aria-hidden="true"></i>Free to message</center>'; ?>
								</div>
							</div>
					    </div>
					</div>
				       <?php
				    }
				    }
				     }
				    ?>
					
				  <?php } } else{ ?>
				  	<div class="row"><div class="col-md-12 col-lg-12"><h3>Your shortlist is empty</h3><p>Click on the stars to add or remove listings from your shortlist. Make sure you login or create a free account before you leave the site and we will save your shortlist for next time.</p></div></div>
				  
				  <?php } ?>
				</div>
				
			</div>
		</div>
	</div>
</section>
<?php
$below_app_js=array('js/common.js');
$this->load->view('includes/footer', array(
	'below_app_js' => $below_app_js)); ?>
