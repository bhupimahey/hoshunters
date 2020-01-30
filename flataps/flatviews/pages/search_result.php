<?php
   $header = array('title' => 'Search Result');   
   $this->load->view('includes/header', $header);
?>
<body>
<?php $this->load->view('includes/pages_inner_header'); ?>

<section class="full-row p-0">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 col-xl-5">
				<div class="row">
					<div id="map" class="map_2">
						
					</div>
				</div>
			</div>
			<div class="col-md-12 col-xl-7">
				<div class="property_search my-2">
					<div class="col-md-12 col-lg-12">
						<div class="main-title-two pb_60 mt-3">
							<h3 class="title color-primary">Property Search</h3>
						</div>
					</div>
				
					<div class="col-md-12 col-lg-12">
						<div class="choost_listing mt_15">
							
							<div class="row">
                            
                    <?php
                             
                     $listing_js_info='';
                             
				    $gender_you_identify = $this->config->item('gender_you_identify');
				    $roomtypes_status    = $this->config->item('roomtypes_status');
				    $roomfurnishings_status    = $this->config->item('roomfurnishings_status');
				    $property_type  = $this->config->item('property_type');
				      $total_bedrooms_config       = $this->config->item('total_bedrooms');
				     $total_bathrooms_config= $this->config->item('total_bathrooms');
					
					
				    $no_image_path=NO_IMAGE;
				    	$latitude_array=array();
					$longitude_array=array();
				    if($listings_list['recordsTotal'] >0){
				        
	         foreach($listings_list['data'] as $list){ 
				    
				    $is_shortlisted  =$this->common_model->is_shortlisted($list['listing_id']);
				    
				    if($list['photo']==''){
				      $full_path=base_url().$no_image_path;
				  	  $list['photo']='<img src="'.$full_path.'" alt="#"/>';
					}	
					
				
					
				    if($list['profile_type']=='1'){
				        
				        if( $list['suburb'])
				        $location = json_decode($list['suburb']);
				       
				        if($location){
				            foreach($location as $location_val){
				                if($location_val!=''){
				                $listing_url =base_url().'F'.random_string('numeric', 6).$list['listing_id'];
				                $photo_path = $list['photo_path'];
				                if($photo_path=='')
				                 $photo_path =base_url().NO_IMAGE;
				                
				                $listing_title ='Looking room in - '.$location_val->location;
				                $latitude =  $location_val->latitude;
				                $longitude  = $location_val->longitude;
				                
				                
				                
				                $latitude_array[$latitude]=$latitude;
				                $longitude_array[$longitude]=$longitude;
				                
				                $listing_js_info .='["'.$listing_title.'", "'.$location_val->location.'", "$'.$list['weekly_budget'].'", '.$latitude.','.$longitude.', "'.$listing_url.'", "'.$photo_path.'", "'.base_url().'images/map/house.png", "", "", ""],';
				                }
				                
				            }
				            
				            
				        }
				       
				        
				        if( $location [0])
				         $location =  $location[0]->location; 
				         else
				         $location ='';
				      
				         
				 	     ?> 
                     <div class="col-md-12 col-lg-6">
                     <div class="thumbnail_one mb_30 color-secondery">
						<div class="image_area overlay_one overfollow">
						    <?php echo $list['photo']; ?>						
							<div class="Featured">Featured</div>
							
							<div class="area_price price_position">$<?php echo $list['weekly_budget'];?></div>
							<?php if($is_shortlisted >0){?>
							<div class="starmark starmark_position" style="cursor:pointer;color:rgb(237, 194, 24)" data-id="<?php echo $list['listing_id'];?>" ><i class="fa fa-star-o" aria-hidden="true" style="font-weight: bold;"></i></div>
							<?php } else { ?>
							<div class="starmark starmark_position" style="cursor:pointer;" data-id="<?php echo $list['listing_id'];?>" ><i class="fa fa-star-o" aria-hidden="true" style="font-weight: bold;"></i></div>
							<?php } ?>
							
							
						</div>
						<div class="thum_one_content">
							<div class="thum_title color-secondery">
								<h5 class="hover_primary"><a href="<?php echo base_url();?>F<?php echo random_string('numeric', 6);?><?php echo $list['listing_id'];?>"><?php echo  ucwords($list['first_name']);?></a></h5>
								<p><i class="fa fa-map-marker" aria-hidden="true"></i>Looking in: <?php echo character_limiter($location,22);?></p>
								<p>
								 <?php 
								if(strlen($list['about_yourself'])<50)
								echo character_limiter($list['about_yourself'],20);
								else{
								echo character_limiter($list['about_yourself'],70);
								?>
								<a href="<?php echo base_url();?>F<?php echo random_string('numeric', 6);?><?php echo $list['listing_id'];?>">readmore</a>
								<?php }
								?> </p>
								
							</div>
							<div class="ft_area p_20">
								<div class="post_author"><i class="fa fa-user" aria-hidden="true"></i><?php echo $gender_you_identify[$list['gender']];?></div>
								<div class="post_date float-right"><i class="fa fa-calendar-o" aria-hidden="true"></i><?php echo $list['age']; ?></div>
							</div>
						</div>
				    </div>
                     </div>
							
								
                    <?php } if($list['profile_type']=='2'){
				      
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
				                if(isset($roomtypes_status[$homedes_rooms->room_type]))
				                   $room_type = $roomtypes_status[$homedes_rooms->room_type];
				                else
				                 $room_type = '';
				                 
				                if(isset($roomfurnishings_status[$homedes_rooms->room_furnishings]))
				                  $room_furnishings = $roomfurnishings_status[$homedes_rooms->room_furnishings];
				                else
				                  $room_furnishings ='';
				            }
				            else{
				                $room_furnishings=$room_type='';
				                
				            }
				            
				            $property_address = json_decode($property_address_info->property_address);
				            if(isset($property_address[0])){
				            $property_address = $property_address[0];
				            $location = $property_address->location;
				            
				             $latitude =  $property_address->latitude;
				             $longitude  = $property_address->longitude;
				             
				               $latitude_array[]=$latitude;
				               $longitude_array[]=$longitude; 
				            }
				            else{
				            $location   ='';
				            $latitude   = '';
				            $longitude  ='';
				            }
				            
				            
				           $total_bathrooms = $total_bathrooms_config[$property_address_info->total_bathrooms];
				           $total_bedrooms  = $total_bedrooms_config[$property_address_info->total_bedrooms];
				           $total_flatmates = $property_address_info->total_flatmates; 
				        
				         $listing_url =base_url().'F'.random_string('numeric', 6).$list['listing_id'];
				         $photo_path = $list['photo_path'];
				         
				         if($photo_path=='')
				                 $photo_path =base_url().NO_IMAGE;
				                 if(isset($property_type[$list['property_type']]))
				         $listing_title =$room_furnishings.' room in a '.$room_type.' '.$property_type[$list['property_type']];
				         else
				          $listing_title =$room_furnishings.' room in a '.$room_type;
				        
				      
				        
				         
				         $listing_js_info .='["'.$listing_title.'", "'.$location.'", "$'.$rent.'", '.$latitude.','.$longitude.', "'.$listing_url.'", "'.$photo_path.'", "'.base_url().'images/map/house.png", "For Rent", "", ""],';
			
				       ?>
                       <div class="col-md-12 col-lg-6">
                        <div class="thumbnail_one mb_30 color-secondery">
						<div class="image_area overlay_one overfollow">
						<?php 
						if($list['photo']=='')
				                 $list_photo =base_url().NO_IMAGE;
				                 else
				                 $list_photo = $list['photo'];
						        echo $list_photo;
					       	?>					
							<div class="Featured">Featured</div>
							<div class="sale sale_position bg-primary">For Rent</div>
							<div class="area_price price_position">$<?php echo $rent;?> <span><?php echo $included;?></span></div>
							<?php if($is_shortlisted >0){?>
							<div class="starmark starmark_position" style="cursor:pointer;color:rgb(237, 194, 24)" data-title="Listing-<?php echo $list['listing_id'];?>"  data-id="<?php echo $list['listing_id'];?>"><i class="fa fa-star-o" aria-hidden="true" style="font-weight: bold;"></i></div>
							<?php } else { ?>
							<div class="starmark starmark_position" style="cursor:pointer;" data-title="Listing-<?php echo $list['listing_id'];?>"  data-id="<?php echo $list['listing_id'];?>"><i class="fa fa-star-o" aria-hidden="true" style="font-weight: bold;"></i></div>
							<?php } ?>
						</div>
						<div class="thum_one_content">
							<div class="thum_title color-secondery">
								<h5 class="hover_primary"><a href="<?php echo base_url();?>F<?php echo random_string('numeric', 6);?><?php echo $list['listing_id'];?>"><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo character_limiter($location,25);?></a></h5>
								
								<?php if(isset($property_type[$list['property_type']])){ ?>
								<p><?php echo $room_furnishings;?> room in a <?php echo $room_type;?> <?php echo $property_type[$list['property_type']];?> </p>
								<?php } else { ?>
							<p><?php echo $room_furnishings;?> room in a <?php echo $room_type;?> </p>
								
								<?php } ?>
								<p><?php 
								if(strlen($list['about_yourself'])<50)
								echo character_limiter($list['about_yourself'],20);
								else{
								echo character_limiter($list['about_yourself'],70);
								?>
								<a href="<?php echo base_url();?>F<?php echo random_string('numeric', 6);?><?php echo $list['listing_id'];?>">readmore</a>
								<?php }
								?></p>
							</div>
								<div class="ft_area p_20">
								 <div class="post_author" style="padding-right:20px;"><i class="fa fa-bed" aria-hidden="true"></i> <?php echo $total_bedrooms;?></div>
								 <div class="post_author" style="padding-right:20px;"><i class="fa fa-bath" aria-hidden="true"></i> <?php echo $total_bathrooms;?></div>
								 <div class="post_author"><i class="fa fa-users" aria-hidden="true"></i> <?php echo $total_flatmates;?></div>
								</div>
						</div>
				    </div> </div>
                        <?php } ?>   
                        <?php } ?>   
                       <?php } ?>   
                    <?php } ?> 
                    <?php }
                    else{
                        echo 'No Result Found!!';
                        
                    }
                    ?>       
                      </div>
                       <?php $listings_list['links'];?>
							
						</div>
					</div>
				</div>
			</div>
			
			
		</div>
	</div>
</section>
<script><?php  $listing_js_info = rtrim($listing_js_info,",");?>var locations = [<?php echo $listing_js_info;?>];</script><script>var _latitude = <?php echo current($latitude_array);?>;var _longitude = <?php echo rtrim(end($longitude_array),",");?>;</script><?php 
$below_app_js=array('js/map/markerwithlabel_packed.js','js/map/infobox.js','js/map/markerclusterer_packed.js','js/map/custom-map.js','js/map/maplistings.js');
$this->load->view('includes/footer',array('below_app_js'=>$below_app_js)); ?>

