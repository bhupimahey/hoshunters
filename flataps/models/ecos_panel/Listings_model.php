<?php
class Listings_model extends CI_Model
	{
	function ajax_listings_list($user_id=NULL)
		{			
		 $roomtypes_status    = $this->config->item('roomtypes_status');
		 $roomfurnishings_status    = $this->config->item('roomfurnishings_status');
		  $property_type  = $this->config->item('property_type');
				                                       
		if(isset($_GET['start'])){	
		$search_text = $_GET['search'];
		$length      = $_GET['length'];
		}
		else{
		$search_text='';			
		$length=10;
		}
		$start=($this->uri->segment(3)) ? $this->uri->segment(3) : 0;;
		
		if($user_id!=NULL){
		$sql = "SELECT * FROM users_profile  WHERE account_id='".(int)$user_id."' ";	
		
		}
		else{
		$sql = "SELECT * FROM users_profile ";
		}
	
		$sql .= " ORDER BY entry_time DESC";		
		
		$counter_query = $this->db->query($sql);
		$iTotalRecords = $counter_query->num_rows();
		
		if (isset($start) || isset($length)) {
			$sql .= " LIMIT " . (int)$start . "," . (int)$length;
		}

		$query = $this->db->query($sql);
		$records = array();
		$records["data"] = array();
		$id = 0;
		$result = $query->result();
		foreach($result as $values)
			{
			$customer_info = $this->common_model->get_user_info($values->account_id);	
			$customer_photo_info = $this->common_model->get_user_photo($values->profile_id);
			$homedes_rooms         = $this->common_model->homedes_rooms($values->profile_id);
			
			if($customer_info){
			   $full_name  = ucwords($customer_info->full_name);
			   $mobile_no  = $customer_info->mobile_no;
			}
			else{
				$full_name  = '';
			    $mobile_no  = '';
			 }
			$id = ($id + 1);
			$user_actions = '';
			$del_path = admin_path() . 'listings/delete/' . $values->profile_id;
			
			if($values->listing_confirmed==0){
			$user_actions = '<div class="message_action color-default-a mt-2">		
			                                        <a href="' . admin_path() . 'listings/confirm_listing/' . $values->profile_id . '" class="" title="Edit Listing"><i class="icofont icofont-ui-edit"></i>Confirm Listing | </a>
													<a href="' . admin_path() . 'listings/view/' . $values->profile_id . '" class="" title="Edit Listing"><i class="icofont icofont-ui-edit"></i>View | </a>
													<a href="' . admin_path() . 'listings/delete/' . $values->profile_id . '" class="delete_record" title="Delete Listing"><i class="icofont icofont-delete-alt"></i>Delete</a>
												</div>';
			}
			else{
			$user_actions = '<div class="message_action color-default-a mt-2">		
			                                       	<a href="' . admin_path() . 'listings/view/' . $values->profile_id . '" class="" title="Edit Listing"><i class="icofont icofont-ui-edit"></i>View | </a>
													<a href="' . admin_path() . 'listings/delete/' . $values->profile_id . '" class="delete_record" title="Delete Listing"><i class="icofont icofont-delete-alt"></i>Delete</a>
												</div>';    
			    
			}
		
			
			if($values->profile_type=='1'){
			    
			    if($customer_photo_info){
		    if($customer_photo_info->photo!='')
		      $customer_photo_path = '<img src="'.base_url().CNTPHT_THUMB.$customer_photo_info->photo.'" alt="#" />';
		   else
		     $customer_photo_path = '';
		    
		}										
		 else
		     $customer_photo_path = '';
			 $profile_type= $full_name.' Looking in';
			 
			  $location = $values->suburb;
			      $location = json_decode( $location);
			       $location_info='';
			      if($location){
			          foreach($location as $location_values){
			                $location_info .=  $location_values->location.'<br>';
			          }
			      
			      }
			}
			else if($values->profile_type=='2'){
			    
			    if($customer_photo_info){
		    if($customer_photo_info->photo!='')
		      $customer_photo_path = '<img src="'.base_url().HMEPHT_THUMB.$customer_photo_info->photo.'" alt="#" />';
		   else
		     $customer_photo_path = '';
		    
		}										
		 else
		     $customer_photo_path = '';
		  
           if($homedes_rooms){
             $room_type = $roomtypes_status[$homedes_rooms->room_type];
              if(isset($roomfurnishings_status[$homedes_rooms->room_furnishings]))
                    $room_furnishings = $roomfurnishings_status[$homedes_rooms->room_furnishings];
               else
                    $room_furnishings ='';
                }
            else{
                $room_furnishings='';
                $room_type='';
                }
		     
		     
			 $property_address_info = $this->common_model->property_address_info($values->profile_id);   
			 if($property_address_info){
			     $location = $property_address_info->property_address;
			      $location = json_decode( $location);
			      if($location && isset($location[0]))
			      $location_info =  $location[0]->location;
			      else
			      $location_info='';
			     
			 }   
			 if(isset($property_type[$values->property_type]))
			 $profile_type= $room_furnishings.' room in a '.$room_type.' '.$property_type[$values->property_type];	
			 else
			 $profile_type= $room_furnishings.' '.$room_type.'room in ';	
			 
			}
			
			
			$records["data"][] = array(				
				'full_name'=>ucwords($full_name),
                'photo' =>$customer_photo_path,
				'mobile_no' =>$mobile_no,
				'profile_type'     =>$profile_type,
				'profile_status'     =>$values->profile_status,
				'user_actions'=>$user_actions,
				'listing_confirmed'=>$values->listing_confirmed,
				'locations' => $location_info,
				'entry_date'=>date('d M, Y',strtotime($values->entry_time))
			   );
			}

		$config = array();
        $config["base_url"] = admin_path() . "listings";
        $config["total_rows"] = $iTotalRecords;
        $config["per_page"] = $length;
        $config["uri_segment"] = 3;

        $config['full_tag_open'] = '<ul class="pagination">';
		 
		
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link active" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tagl_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tagl_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item disabled">';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tagl_close'] = '</a></li>';
		$config['prev_link'] = 'Previous';
    	 
		$config['next_link'] = 'Next';
		$config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
        $config['attributes'] = array('class' => 'page-link');
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$records["recordsTotal"] = $iTotalRecords;
		$records["links"] = $this->pagination->create_links();
		return $records;
   }


	function ajax_profilephoto_list($profile_id)
		{			
		if(isset($_GET['start'])){	
		$search_text = $_GET['search'];
		$length      = $_GET['length'];
		}
		else{
		$search_text='';			
		$length=10;
		}
		$start=($this->uri->segment(3)) ? $this->uri->segment(3) : 0;;
		$sql = "SELECT * FROM users_photos WHERE profile_id='".(int)$profile_id."' ORDER BY entry_time DESC";
		$counter_query = $this->db->query($sql);
		$iTotalRecords = $counter_query->num_rows();
		
		if (isset($start) || isset($length)) {
			$sql .= " LIMIT " . (int)$start . "," . (int)$length;
		}

		$query = $this->db->query($sql);
		$records = array();
		$records["data"] = array();
		$id = 0;
		$result = $query->result();
		foreach($result as $values)
			{
			$id = ($id + 1);
			$user_actions = '';
			$del_path = admin_path() . 'profile_photo/delete/' . $values->photo_id;
			$user_actions = '<div class="message_action color-default-a mt-2">													
													<a href="' . admin_path() . 'profile_photo/edit/' . $values->photo_id . '" class="" title="Edit Photo">Edit | </a>
													<a href="' . admin_path() . 'profile_photo/delete/' . $values->photo_id . '" class="delete_record" title="Delete Photo">Delete</a>
												</div>';
												
			if($values->photo_path!=''){
			  $photo ='Photo';	
			}
			else{
			  $photo='Photo';	
			}
			
			$records["data"][] = array(				
				'photo' =>$photo,
				'user_actions'=>$user_actions				
			   );
			}

		$config = array();
        $config["base_url"] = admin_path() . "information";
        $config["total_rows"] = $iTotalRecords;
        $config["per_page"] = $length;
        $config["uri_segment"] = 3;

        $config['full_tag_open'] = '<ul class="pagination">';
		 
		
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link active" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tagl_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tagl_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item disabled">';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tagl_close'] = '</a></li>';
		$config['prev_link'] = 'Previous';
    	 
		$config['next_link'] = 'Next';
		$config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
        $config['attributes'] = array('class' => 'page-link');
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$records["recordsTotal"] = $iTotalRecords;
		$records["links"] = $this->pagination->create_links();
		return $records;
   }


	 function deleteListingInformation($profile_id) {
		 $userinfo = $this->getListingInformation($profile_id);
		 
		 $this->db->where('account_id',$profile_id);  
		 $this->db->delete('users');
		 
		 		 
		 if($userinfo->profile_type=='1'){
		 $this->db->where('profile_id',$profile_id);  
		 $this->db->delete('users_profile');
		 
		 $this->db->where('profile_id',$profile_id);  
		 $this->db->delete('users_preferences');
		
		 $this->db->where('profile_id',$profile_id);  
		 $this->db->delete('users_photos');
		 
		 }
		 elseif($userinfo->profile_type=='2'){
		  $this->db->where('profile_id',$profile_id);  
		  $this->db->delete('homedes_room_features');
		 
		  $this->db->where('profile_id',$profile_id);  
		  $this->db->delete('homedes_room_availability');
		
		  $this->db->where('profile_id',$profile_id);  
		  $this->db->delete('homedes_rooms');
		  
		  $this->db->where('profile_id',$profile_id);  
		  $this->db->delete('homedes_rentbondbills');	
		  
		  $this->db->where('profile_id',$profile_id);  
		  $this->db->delete('homedes_flatmates_preferences'); 
		  
		  $this->db->where('profile_id',$profile_id);  
		  $this->db->delete('homedes_about_property'); 
		 }
		
	}

	 function getListingInformation($profile_id) {
	 
		$query = $this->db->query("SELECT  * FROM  users_profile  WHERE profile_id = '" . (int)$profile_id . "'");
		return $query->row();
	}

	 function getPreferencesInformation($profile_id) {
	 
		$query = $this->db->query("SELECT  * FROM users_preferences WHERE profile_id = '" . (int)$profile_id . "'");
		return $query->row();
	}

	 function getAboutProperty($profile_id) {
	 
	  $query = $this->db->query("SELECT  * FROM  homedes_about_property WHERE profile_id = '" . (int)$profile_id . "'");
	  return $query->row();
	}
	
   function getRooms($profile_id) {
	 
		$query = $this->db->query("SELECT  * FROM  homedes_rooms WHERE profile_id = '" . (int)$profile_id . "'");
		return $query->result();
	}

 function getUsersFlatmatesPreferences($profile_id) {
	 
		$query = $this->db->query("SELECT  * FROM  users_flatmates_preferences WHERE profile_id = '" . (int)$profile_id . "'");
		return $query->row();
	} 
	
   function getRoomFeatures($profile_id) {
	 
		$query = $this->db->query("SELECT  * FROM  homedes_room_features WHERE profile_id = '" . (int)$profile_id . "'");
			return $query->result();
	}
   function getRoomRentBills($profile_id) {
	 
		$query = $this->db->query("SELECT  * FROM  homedes_rentbondbills WHERE profile_id = '" . (int)$profile_id . "'");
		return $query->result();
	}
   function getRoomAvailability($profile_id) {
	 
		$query = $this->db->query("SELECT  * FROM  homedes_room_availability WHERE profile_id = '" . (int)$profile_id . "'");
		return $query->result();
	} 


   function getPhotos($profile_id) {
	 
		$query = $this->db->query("SELECT  * FROM  users_photos WHERE profile_id = '" . (int)$profile_id . "'");
		return $query->result();
	} 	
   function getFlatmatesPreferences($profile_id) {
	 
		$query = $this->db->query("SELECT  * FROM  homedes_flatmates_preferences WHERE profile_id = '" . (int)$profile_id . "'");
		return $query->result();
	} 	

  function confirmListing($profile_id){
      
      $this->db->where("profile_id",$profile_id);
      $query = $this->db->update("users_profile",array("listing_confirmed"=>1));
      return true;
  }
	  
   function update_request_info_old(){
	   if($_POST){
		   $profile_id = $this->input->post('profile_id');
		   $request_type = $this->input->post('request_type');
		   if($request_type==1){
			  // What type of place are you looking for
			  $place_looking_for = $this->input->post('place_looking_for');
			  if($place_looking_for){
				$place_looking_for = implode(",",$place_looking_for);  
			  }
			  else
			  $place_looking_for='';
			  
		      $update_data =array("place_looking_for"=>$place_looking_for);
	          $this->db->where("profile_id",$profile_id);				   
	          $this->db->update("users_profile",$update_data);
		   }
		  if($request_type==2){
			  // Where would you like to live?
		      $home_address =$this->input->post('home_address');
			  if($home_address)
			   $suburb = implode(",",$home_address);
			  else
			   $suburb='';
			    
		      $update_data =array("suburb"=>$suburb);
	          $this->db->where("profile_id",$profile_id);				   
	          $this->db->update("users_profile",$update_data);
		   } 
		 if($request_type==3){
			  // Rent and timing 
		      $weekly_budget       = $this->input->post('weekly_budget');
			  $preferred_move_date = $this->input->post('preferred_move_date');
			  $length_of_stay      = $this->input->post('length_of_stay');
			  
		      $update_data =array("weekly_budget"=>$weekly_budget,'preferred_move_date'=>$preferred_move_date,
			                      "length_of_stay"=>$length_of_stay);
	          $this->db->where("profile_id",$profile_id);				   
	          $this->db->update("users_profile",$update_data);
		   }  
		if($request_type==4){
			  // Property preferences
		      $room_furnishings   = $this->input->post('room_furnishings');
			  $internet 		  = $this->input->post('internet');
			  $bathroom_type      = $this->input->post('bathroom_type');
			  $parking 		      = $this->input->post('parking');
			  $no_of_flatmates    = $this->input->post('no_of_flatmates');
			  			  		  
		      $update_data =array("room_furnishings"=>$room_furnishings,"internet"=>$internet,"bathroom_type"=>$bathroom_type,
			  					  "parking"=>$parking,"no_of_flatmates"=>$no_of_flatmates);
	          $this->db->where("profile_id",$profile_id);				   
	          $this->db->update("users_preferences",$update_data);
		   } 
		if($request_type==5){
		    
					  
			  
			  
		   } 
		if($request_type==6){
			  // Employment Status
		      $employment_status =implode(",",$this->input->post('employment_status'));
			  $employment_status = rtrim($employment_status,",");
		      $update_data =array("employment_status"=>$employment_status);
	          $this->db->where("profile_id",$profile_id);				   
	          $this->db->update("users_profile",$update_data);
		   }
        if($request_type==7){
			  // Your pets
		      $life_style =implode(",",$this->input->post('life_style'));
			  $life_style = rtrim($life_style,",");
		      $update_data =array("life_style"=>$life_style);
	          $this->db->where("profile_id",$profile_id);				   
	          $this->db->update("users_profile",$update_data);
		   }	
		if($request_type==8){
			  // Your employment situation
		      $great_live_with_text =$this->input->post('great_live_with_text');			 
		      $update_data =array("great_live_with_text"=>$great_live_with_text);
	          $this->db->where("profile_id",$profile_id);				   
	          $this->db->update("users_profile",$update_data);
		   }
     	   
	   }
	   $this->message_output->set_success('Information has been updated.', TRUE);
	   return json_encode(array("success"=>true));	   
   }	
	
  function update_home_request_info_old(){
	   if($_POST){
		  
		   
		   $profile_id = $this->input->post('profile_id');
		   $request_type = $this->input->post('request_type');
		   if($request_type==1){
			 // What type of accommodation are you offering?
			  $accommodation_offering = $this->input->post('accommodation_offering');
			  if($accommodation_offering){
				$accommodation_offering = implode(",",$accommodation_offering);  
			  }
			  else
			  $accommodation_offering='';
			  
		      $update_data =array("accommodation_offering"=>$accommodation_offering);
	          $this->db->where("profile_id",$profile_id);				   
	          $this->db->update("users_profile",$update_data);
			  
		   }
		  if($request_type==2){
			  // About the property
			  
			
			 
			   $property_address = $this->input->post('property_address');
			   $total_bedrooms   = $this->input->post('total_bedrooms');
			   $total_bathrooms  = $this->input->post('total_bathrooms');
			   $parking          = $this->input->post('parking');
			   $internet         = $this->input->post('internet');
			   $total_flatmates  = $this->input->post('total_flatmates');	 
			  
              $country       = $this->input->post("country");
              if(isset($country[0])){
                  $country_lists = explode(",",$country[0]);
                  
              }else
              $country_lists='';
              
              
              $latitude      = $this->input->post("latitude");
              if(isset($latitude[0])){
                  $latitude_lists = explode(",",$latitude[0]);
                  
              }else
              $latitude_lists='';
              
               $longitude     = $this->input->post("longitude");
              if(isset($longitude[0])){
                  $longitude_lists = explode(",",$longitude[0]);
                  
              }else
              $longitude_lists='';

               $state      = $this->input->post("state");
              if(isset($state[0])){
                  $state_lists = explode(",",$state[0]);
                  
              }else
              $state_lists='';
            
                $city      = $this->input->post("city");
              if(isset($city[0])){
                  $city_lists = explode(",",$city[0]);
                  
              }else
              $city_lists='';

                 $postal_code      = $this->input->post("postal_code");
              if(isset($postal_code[0])){
                  $postal_code_lists = explode(",",$postal_code[0]);
                  
              }else
              $postal_code_lists='';
              
              
              $final_suburb=array();
              $street_number = $this->input->post("street");
              if(isset($street_number[0])){
                  $street_info = explode(",",rtrim($street_number[0],","));
                  foreach($street_info as $street_key => $streetval){
                      if($country_lists)
                            $country_val =$country_lists[$street_key];
                      else
                           $country_val='';
                    
                     if($latitude_lists)
                            $latitude_val =$latitude_lists[$street_key];
                      else
                           $latitude_val='';
                           
                   
                     if($longitude_lists)
                            $longitude_val =$longitude_lists[$street_key];
                      else
                           $longitude_val='';

                           
                    if($state_lists)
                            $state_val =$state_lists[$street_key];
                      else
                           $state_val='';

                           
                    if($city_lists)
                            $city_val =$city_lists[$street_key];
                      else
                           $city_val='';

                    if($postal_code_lists)
                            $postal_code_val =$postal_code_lists[$street_key];
                      else
                           $postal_code_val='';

                      
                       $final_suburb[]=array('location'=>$property_address,'street'=>$streetval,
                                             'country'=>$country_val,'state'=>$state_val,'city'=>$city_val,'postal_code'=>$postal_code_val,
                                             'latitude'=>$latitude_val,'longitude'=>$longitude_val);
                      
                  }
                  
              }
              
              $final_suburb= json_encode($final_suburb);
			  $update_data =array("property_address"=>$final_suburb,'total_bedrooms'=>$total_bedrooms,
			                      'total_bathrooms'=>$total_bathrooms,'parking'=>$parking,'internet'=>$internet,
								  'total_flatmates'=>$total_flatmates
			   );
	          $this->db->where("profile_id",$profile_id);				   
	          $this->db->update("homedes_about_property",$update_data);
	          
	          
	          
			 // echo $this->db->last_query();
			  
			 // die();
		   } 
		 if($request_type==3){
			  // About the room(s) 
		      $room_name        = $this->input->post('room_name');
			  $room_type        = $this->input->post('room_type');
			  $room_furnishings = $this->input->post('room_furnishings');
			  $bathroom         = $this->input->post('bathroom');
			  if($room_name){
				  $this->db->where('profile_id',$profile_id);
				  $this->db->delete('homedes_rooms'); 
				 foreach($room_name as $roomkey => $roomval){
					 if($roomval !=''){
					  $room_type_val = $room_type[$roomkey];
					  $room_furnishings_val = $room_furnishings[$roomkey];
					  $bathroom_val         = $bathroom[$roomkey];
					  
		           $update_data =array("profile_id"=>$profile_id,'room_name'=>$roomval,
			                          "room_type"=>$room_type_val,"room_furnishings"=>$room_furnishings_val,
									  "bathroom"=>$bathroom_val,"entry_time"=>date("Y-m-d H:i:s"),
									  "ip_address"=>ip_address());
	               $this->db->insert("homedes_rooms",$update_data);
					 }
			     }
			  }
		   }  
		if($request_type==4){
			  // Room Features
		      $bed_size   = $this->input->post('bed_size');
			  $furnishings_features = $this->input->post('furnishings_features');
			  if($furnishings_features){
				$furnishings_features= implode(",",$furnishings_features);
				$furnishings_features = rtrim($furnishings_features,",");  
			  }else
			  $furnishings_features='';
			  			  		  
		      $update_data =array("bed_size"=>$bed_size,
			  				      "furnishings_features"=>$furnishings_features,);
	          $this->db->where("profile_id",$profile_id);				   
	          $this->db->update("homedes_room_features",$update_data);
		   } 
		if($request_type==5){
			  // ent, bond and bills
		      $weekly_rent = $this->input->post('weekly_rent');
			  $bond        = $this->input->post('bond');
			  $bills       = $this->input->post('bills');
			 
		      $update_data =array("weekly_rent"=>$weekly_rent,'bond'=>$bond,'bills'=>$bills);
	          $this->db->where("profile_id",$profile_id);				   
	          $this->db->update("homedes_rentbondbills",$update_data);
		   } 
		if($request_type==6){
			  // Room availability
			  $date_available  = date("Y-m-d",strtotime($this->input->post('date_available')));
			  $min_stay_length = $this->input->post('min_stay_length');
			  $max_stay_length = $this->input->post('max_stay_length');
		      
		      $update_data =array("date_available"=>$date_available,"min_stay_length"=>$min_stay_length,
			                       "max_stay_length"=>$max_stay_length);
	          $this->db->where("profile_id",$profile_id);				   
	          $this->db->update("homedes_room_availability",$update_data);
		   }
   		if($request_type==7){
			  // Flatmate Preference
			  $preference = $this->input->post('preference');
			  $accepting = $this->input->post('accepting');
		      if($accepting && is_array($accepting))
			   $accepting = implode(",",$accepting);
			  else
			   $accepting='';
			    
		      $update_data =array("preference"=>$preference,"accepting"=>$accepting);
	          $this->db->where("profile_id",$profile_id);				   
	          $this->db->update("homedes_flatmates_preferences",$update_data);
		   }   
    		if($request_type==8){
			  // Tell us about you and your flatmates
			  $about_flatmates = $this->input->post('about_flatmates');
			  		    
		      $update_data =array("about_flatmates"=>$about_flatmates);
	          $this->db->where("profile_id",$profile_id);				   
	          $this->db->update("homedes_flatmates_preferences",$update_data);
		   }   
		   
		 if($request_type==9){
			  // What's great about living at this property?
			  $great_live_with_text = $this->input->post('great_live_with_text');
			  		    
		      $update_data =array("great_live_with_text"=>$great_live_with_text);
	          $this->db->where("profile_id",$profile_id);				   
	          $this->db->update("users_profile",$update_data);
		   } 
		    	   
	   }
	   $this->message_output->set_success('Information has been updated.', TRUE);
	   return json_encode(array("success"=>true));	   
   }	
 
 
   function room_features_request($room_counter,$room_id,$profile_id){
   	 #######################################		 Room Features    #######################################
		      $bed_size   = $this->input->post('bed_size');
			  $furnishings_features = $this->input->post('furnishings_features');
			  
			 
			  
			  $bed_size_val =$bed_size[$room_counter];
			  $furnishings_features_val =$furnishings_features[$room_counter];
			  
			  
			  if(is_array($furnishings_features_val)){
				$furnishings_features_val= implode(",",$furnishings_features_val);
				$furnishings_features_val = rtrim($furnishings_features_val,",");  
			  }elseif(!is_array($furnishings_features_val)){
			  	$furnishings_features_val = trim($furnishings_features_val);
			  }
			  else
			  $furnishings_features_val='';
			  
			  
			  $room_features_exist = $this->db->where('profile_id',$profile_id)->where('room_id',$room_id)->count_all_results('homedes_room_features');
			  if($room_features_exist==0){
				  $insert_data =array("bed_size"=>$bed_size_val,'profile_id'=>$profile_id,'room_id'=>$room_id,
			  				          "furnishings_features"=>$furnishings_features_val,"entry_time"=>date("Y-m-d H:i:s"),
									  "ip_address"=>ip_address());
	             $this->db->insert("homedes_room_features",$insert_data);
			  }
			  else{
				$update_data =array("bed_size"=>$bed_size_val,"furnishings_features"=>$furnishings_features_val,);
	            $this->db->where("profile_id",$profile_id);	
	            $this->db->where("room_id",$room_id);
	            $this->db->update("homedes_room_features",$update_data);  
			  }
			  			 
      
  }    
  
  function rentbondbills_request($room_counter,$room_id,$profile_id){
  
  			  ####################################### rent, bond and bills    #######################################
		      $weekly_rent = $this->input->post('weekly_rent');
			  $bond        = $this->input->post('bond');
			  $bills       = $this->input->post('bills');
			 
			  $weekly_rent = $weekly_rent[$room_counter];
			  $bond        = $bond[$room_counter];
			  $bills       = $bills[$room_counter];
			 
			  $rentbondbills_exist = $this->db->where('profile_id',$profile_id)->where('room_id',$room_id)->count_all_results('homedes_rentbondbills');
			  if($rentbondbills_exist==0){
				$insert_data =array("weekly_rent"=>$weekly_rent,'bond'=>$bond,'profile_id'=>$profile_id,'room_id'=>$room_id,
									'bills'=>$bills,"entry_time"=>date("Y-m-d H:i:s"),
									  "ip_address"=>ip_address());	   			   
	            $this->db->insert("homedes_rentbondbills",$insert_data);  
			  }
			  else{
		        $update_data =array("weekly_rent"=>$weekly_rent,'bond'=>$bond,'bills'=>$bills);
	            $this->db->where("profile_id",$profile_id);	
	            $this->db->where("room_id",$room_id);	
	            $this->db->update("homedes_rentbondbills",$update_data);
			  }
  
  }
  
  function roomavailability_request($room_counter,$room_id,$profile_id){
    #######################################     Room availability    #######################################
              $date_available = $this->input->post('date_available');
              $min_stay_length = $this->input->post('min_stay_length');
			  $max_stay_length = $this->input->post('max_stay_length');
			  
			  $min_stay_length = $min_stay_length[$room_counter];
			  $max_stay_length = $max_stay_length[$room_counter];
		      $date_available  = date("Y-m-d",strtotime($date_available[$room_counter]));
		      
		      
			  $room_avail_exist = $this->db->where('profile_id',$profile_id)->where('room_id',$room_id)->count_all_results('homedes_room_availability');
			  if($room_avail_exist==0){
				$insert_data = array("date_available"=>$date_available,"min_stay_length"=>$min_stay_length,
									 "profile_id"=>$profile_id,"max_stay_length"=>$max_stay_length,'room_id'=>$room_id,
									 "entry_time"=>date("Y-m-d H:i:s"),"ip_address"=>ip_address());
	            $this->db->insert("homedes_room_availability",$insert_data);  
			  }
			  else{
		        $update_data = array("date_available"=>$date_available,"min_stay_length"=>$min_stay_length,
			                         "max_stay_length"=>$max_stay_length);
	            $this->db->where("profile_id",$profile_id);	
	            $this->db->where("room_id",$room_id);
	            $this->db->update("homedes_room_availability",$update_data);
			  }
			  
  
  }
  
  function flatmatepreference_request($room_counter,$room_id,$profile_id){
    #######################################   Flatmate Preference &&  Tell us about you and your flatmates  #######################################
              $preference = $this->input->post('preference');
			  $accepting = $this->input->post('accepting');
			  $about_flatmates = $this->input->post('about_flatmates');
			  
        	 if($preference){
			   $preference = $preference[$room_counter];
			  
			  
			  $flatmates_pre_exist = $this->db->where('profile_id',$profile_id)->where('room_id',$room_id)->count_all_results('homedes_flatmates_preferences');
			  if($flatmates_pre_exist==0){
				$insert_data =array("preference"=>$preference,"profile_id"=>$profile_id,'room_id'=>$room_id,
									"entry_time"=>date("Y-m-d H:i:s"),"ip_address"=>ip_address()
									);	           			   
	            $this->db->insert("homedes_flatmates_preferences",$insert_data);  
			  }
			  else{
				$update_data =array("preference"=>$preference);
	            $this->db->where("profile_id",$profile_id);	
	            $this->db->where("room_id",$room_id);	
	            $this->db->update("homedes_flatmates_preferences",$update_data);  
			  }    
			      
			  }
	         if($accepting){
			  
			   $accepting = $accepting[$room_counter];
			  
		      if($accepting && is_array($accepting))
			   $accepting = implode(",",$accepting);
			   
			 else if($accepting && !is_array($accepting))
			   $accepting = trim($accepting);  
			  else
			   $accepting='';
			  
			 
			  $flatmates_pre_exist = $this->db->where('profile_id',$profile_id)->where('room_id',$room_id)->count_all_results('homedes_flatmates_preferences');
			  if($flatmates_pre_exist==0){
				$insert_data =array("accepting"=>$accepting,"profile_id"=>$profile_id,'room_id'=>$room_id,
									"entry_time"=>date("Y-m-d H:i:s"),"ip_address"=>ip_address()
									);	           			   
	            $this->db->insert("homedes_flatmates_preferences",$insert_data);  
			  }
			  else{
				$update_data =array("accepting"=>$accepting);
	            $this->db->where("profile_id",$profile_id);	
	            $this->db->where("room_id",$room_id);	
	            $this->db->update("homedes_flatmates_preferences",$update_data);  
			  }   
			      
			  }
	         if($about_flatmates){
			  
			  $flatmates_pre_exist = $this->db->where('profile_id',$profile_id)->where('room_id',$room_id)->count_all_results('homedes_flatmates_preferences');
			  if($flatmates_pre_exist==0){
				$insert_data =array("profile_id"=>$profile_id,'room_id'=>$room_id,
									"entry_time"=>date("Y-m-d H:i:s"),"ip_address"=>ip_address(),
									"about_flatmates"=>$about_flatmates
									);	           			   
	            $this->db->insert("homedes_flatmates_preferences",$insert_data);  
			  }
			  else{
				$update_data =array("about_flatmates"=>$about_flatmates);
	            $this->db->where("profile_id",$profile_id);	
	            $this->db->where("room_id",$room_id);	
	            $this->db->update("homedes_flatmates_preferences",$update_data);  
			  }   
			      
			  }		  

  }
  
   
   function ajax_update_find_a_home_info(){
	   if($_POST){
		   $profile_id = $this->input->post('profile_id');
		   $request_type = $this->input->post('request_type');
		   if($request_type==1){
			  // What type of place are you looking for
			  $place_looking_for = $this->input->post('place_looking_for');
			  if($place_looking_for){
				$place_looking_for = implode(",",$place_looking_for);  
			  }
			  else
			  $place_looking_for='';
			  
			  $teamups = $this->input->post('teamups');
			  if($teamups)
			    $show_teamups=1;
			  else
			  $show_teamups=0;
			  
		      $update_data =array("place_looking_for"=>$place_looking_for,"team_ups"=>$show_teamups);
	          $this->db->where("profile_id",$profile_id);				   
	          $this->db->update("users_profile",$update_data);
		   }
		  
		  if($request_type==3){
			  // Rent and timing 
		      $weekly_budget       = $this->input->post('weekly_budget');
			  $preferred_move_date = $this->input->post('preferred_move_date');
			  $length_of_stay      = $this->input->post('length_of_stay');
			  
		      $update_data =array("weekly_budget"=>$weekly_budget,'preferred_move_date'=>$preferred_move_date,
			                      "length_of_stay"=>$length_of_stay);
	          $this->db->where("profile_id",$profile_id);				   
	          $this->db->update("users_profile",$update_data);
		   }  
		if($request_type==4){
			  // Property preferences
		      $room_furnishings   = $this->input->post('room_furnishings');
			  $internet 		  = $this->input->post('internet');
			  $bathroom_type      = $this->input->post('bathroom_type');
			  $parking 		      = $this->input->post('parking');
			  $no_of_flatmates    = $this->input->post('no_of_flatmates');
			  			  		  
		      $update_data =array("room_furnishings"=>$room_furnishings,"internet"=>$internet,"bathroom_type"=>$bathroom_type,
			  					  "parking"=>$parking,"no_of_flatmates"=>$no_of_flatmates);
	          $this->db->where("profile_id",$profile_id);				   
	          $this->db->update("users_preferences",$update_data);
		   } 
		if($request_type==6){
			  // Employment Status
		      $employment_status =implode(",",$this->input->post('employment_status'));
			  $employment_status = rtrim($employment_status,",");
		      $update_data =array("employment_status"=>$employment_status);
	          $this->db->where("profile_id",$profile_id);				   
	          $this->db->update("users_profile",$update_data);
		   }
        if($request_type==7){
			  // Your pets
		      $life_style =implode(",",$this->input->post('life_style'));
			  $life_style = rtrim($life_style,",");
		      $update_data =array("life_style"=>$life_style);
	          $this->db->where("profile_id",$profile_id);				   
	          $this->db->update("users_profile",$update_data);
		   }	
		if($request_type==8){
			  // Your employment situation
		      $great_live_with_text =$this->input->post('great_live_with_text');			 
		      $update_data =array("great_live_with_text"=>$great_live_with_text);
	          $this->db->where("profile_id",$profile_id);				   
	          $this->db->update("users_profile",$update_data);
		   }
		   
    	if($request_type==9){
			  // Flatmate Preference  & Language Preferred & Accepting
		     
		      $preference          = $this->input->post('preference');
			  $accepting           = $this->input->post('accepting');
			  $preferred_language  = $this->input->post('preferred_language');
			  
			  
			  if($preferred_language){
			    $update_data =array("preferred_language"=>$preferred_language);
	            $this->db->where("profile_id",$profile_id);				   
	            $this->db->update("users_profile",$update_data);
			  }
	          
		      if($accepting && is_array($accepting))
			   $accepting = implode(",",$accepting);
			   
			 else if($accepting && !is_array($accepting))
			   $accepting = trim($accepting);  
			  else
			   $accepting='';
			  
			 
			  $flatmates_pre_exist = $this->db->where('profile_id',$profile_id)->count_all_results('users_flatmates_preferences');
			  if($flatmates_pre_exist==0){
				$insert_data =array("preference"=>$preference,"accepting"=>$accepting,"profile_id"=>$profile_id,
									"entry_time"=>date("Y-m-d H:i:s"),"ip_address"=>ip_address()
									);	           			   
	            $this->db->insert("users_flatmates_preferences",$insert_data);  
			  }
			  else{
				$update_data =array("preference"=>$preference,"accepting"=>$accepting);
	            $this->db->where("profile_id",$profile_id);	
	            $this->db->update("users_flatmates_preferences",$update_data);  
			  }
		   }
		   
	   }
	   $this->message_output->set_success('Information has been updated.', TRUE);
	   return json_encode(array("success"=>true));	   
   }		

   function ajax_update_update_offer_home_info(){
	   if($_POST){
	           $request_type = $this->input->post('request_type');
	           $profile_id = $this->input->post('profile_id');
	           // What type of accommodation are you offering?
			   $accommodation_offering = $this->input->post('accommodation_offering');
			  
			  
	           $homedes_all_rooms =  $this->common_model->homedes_all_rooms($profile_id);
	             
			  // What type of accommodation are you offering?
			  if($request_type==1){
			  $accommodation_offering = $this->input->post('accommodation_offering');
			   $accommodation_offering_list='';
			  if($accommodation_offering){
			      foreach($accommodation_offering as $accommodation_offering_val){
			          
			         $accommodation_offering_list .= $accommodation_offering_val.',';
			      }
			      
			  }
			  $accommodation_offering_list = rtrim($accommodation_offering_list,",");
			
		      $update_data =array(
			  					  "accommodation_offering"=>$accommodation_offering_list	);
			  $this->db->where('profile_id',$profile_id);	
	          $this->db->update("users_profile",$update_data);			  
			  
			  
			  }  
			  
		      if($request_type==2){
		        #######################################		About the property  #########################################
			 
			   $property_address = $this->input->post('property_address');
			   $total_bedrooms   = $this->input->post('total_bedrooms');
			   $total_bathrooms  = $this->input->post('total_bathrooms');
			   $parking          = $this->input->post('parking');
			   $internet         = $this->input->post('internet');
			   if($accommodation_offering==2){
			   $total_flatmates  = '';
			   $roomfurnishings_status =  $this->input->post('roomfurnishings_status');
			   }
			   else{
			   $total_flatmates  = $this->input->post('total_flatmates');    
			   $roomfurnishings_status =   '';
			       
			   }
			   
              $country       = $this->input->post("country");
              if(isset($country)){
                  $country_lists =$country;
                  
              }else
              $country_lists='';
              
              
              $latitude      = $this->input->post("latitude");
              if(isset($latitude)){
                  $latitude_lists = $latitude;
                  
              }else
              $latitude_lists='';
              
               $longitude     = $this->input->post("longitude");
              if(isset($longitude)){
                  $longitude_lists = $longitude;
                  
              }else
              $longitude_lists='';

               $state      = $this->input->post("state");
              if(isset($state)){
                  $state_lists = $state;
                  
              }else
              $state_lists='';
            
                $city      = $this->input->post("city");
              if(isset($city)){
                  $city_lists =$city;
                  
              }else
              $city_lists='';

                 $postal_code      = $this->input->post("postal_code");
              if(isset($postal_code)){
                  $postal_code_lists = $postal_code;
                  
              }else
              $postal_code_lists='';
              
              
              $final_suburb=array();
              $street_number = $this->input->post("street");
              
              $final_suburb[]=array('location'=>$property_address,'street'=>$street_number,
                                             'country'=>$country_lists,'state'=>$state_lists,'city'=>$city_lists,
											 'postal_code'=>$postal_code_lists,
                                             'latitude'=>$latitude_lists,'longitude'=>$longitude_lists);
                                             
              
            if($final_suburb){
                   $this->db->where("profile_id",$profile_id);
                   $this->db->delete('property_for_search');
                  
                   foreach($final_suburb as $final_suburb_info){
                       
                       $property_for_search_insert = array("profile_id"=>$profile_id,"location"=>$final_suburb_info['location'],
                                                           "country"=>$final_suburb_info['country'],"state"=>$final_suburb_info['state'],
                                                           "city"=>$final_suburb_info['city'],"street"=>$final_suburb_info['street'],
                                                           "postcode"=>$final_suburb_info['postal_code']);
                                                           
                                                           
                                                           
                       $this->db->insert('property_for_search',$property_for_search_insert);
                   }
                  
              }
             
              
			  $final_suburb= json_encode($final_suburb);
			  $about_property_exist = $this->db->where('profile_id',$profile_id)->count_all_results('homedes_about_property');
			  if($about_property_exist==0){
				$insert_data =array("property_address"=>$final_suburb,'total_bedrooms'=>$total_bedrooms,
			                      'total_bathrooms'=>$total_bathrooms,'parking'=>$parking,'internet'=>$internet,
								  'total_flatmates'=>$total_flatmates,'profile_id'=>$profile_id,
								  'entry_time'=>date('Y-m-d H:i:s'),'ip_address'=>ip_address()
			   );			   
	          $this->db->insert("homedes_about_property",$insert_data);   
			  }
			  else{
			  $update_data =array("property_address"=>$final_suburb,'total_bedrooms'=>$total_bedrooms,
			                      'total_bathrooms'=>$total_bathrooms,'parking'=>$parking,'internet'=>$internet,
								  'total_flatmates'=>$total_flatmates,'room_furnishings'=>$roomfurnishings_status
			   );
	          $this->db->where("profile_id",$profile_id);				   
	          $this->db->update("homedes_about_property",$update_data);	  
			  }    
		          
		      }
		      
		     if($request_type==3){ 
		      
	        	  if($accommodation_offering!=2){
			  #######################################		 About the room(s)    #######################################
		      $room_name        = $this->input->post('room_name');
			  $room_type        = $this->input->post('room_type');
			  $room_furnishings = $this->input->post('room_furnishings');
			  $bathroom         = $this->input->post('bathroom');
			  if($room_name){
				  $this->db->where('profile_id',$profile_id);
				  $this->db->delete('homedes_rooms'); 
				  $room_counter=0;
				 foreach($room_name as $roomkey => $roomval){
				     
					 if($roomval !=''){
					     $room_counter ++;
					  $room_type_val = $room_type[$roomkey];
					  $room_furnishings_val = $room_furnishings[$roomkey];
					  $bathroom_val         = $bathroom[$roomkey];
					  
		           $update_data =array("profile_id"=>$profile_id,'room_name'=>$roomval,
			                          "room_type"=>$room_type_val,"room_furnishings"=>$room_furnishings_val,
									  "bathroom"=>$bathroom_val,"entry_time"=>date("Y-m-d H:i:s"),
									  "ip_address"=>ip_address());
	               $this->db->insert("homedes_rooms",$update_data);
	               $room_id = $this->db->insert_id();
	               
					 }
			     }
			  }		          
		          
		      }
		         else{
		      $room_id=0;
		      $room_counter=1;
              $this->rentbondbills_request($room_counter,$room_id,$profile_id);
	       //$this->roomavailability_request($room_counter,$room_id,$profile_id);
	      //$this->flatmatepreference_request($room_counter,$room_id,$profile_id);  
		      
		  }
		     }
		     
		     //Room Features
		     if($request_type==4){ 
		         $room_counter1=0;
		         foreach($homedes_all_rooms as $room_info){
		             $room_counter1=$room_counter1+1;
		             $this->room_features_request($room_counter1,$room_info->room_id,$profile_id);
		           }
		     }
		    //Rent, bond and bills
		     if($request_type==5){ 
		         $room_counter2=0;
		         foreach($homedes_all_rooms as $room2_info){
		             $room_counter2=$room_counter2+1;
		             $this->rentbondbills_request($room_counter2,$room2_info->room_id,$profile_id);
		           }  
		     } 
		 //Room availability
		     if($request_type==6){ 
		         $room_counter3=0;
		         foreach($homedes_all_rooms as $room3_info){
		             $room_counter3=$room_counter3+1;
		              $this->roomavailability_request($room_counter3,$room3_info->room_id,$profile_id);
		           }  
		     }    
		 //YOUR IDEAL FLATEMATE(S)
		     if($request_type==7 || $request_type==8){ 
		       $room_counter4=0;
		         foreach($homedes_all_rooms as $room4_info){
		             $room_counter4=$room_counter4+1;
		              $this->flatmatepreference_request($room_counter4,$room4_info->room_id,$profile_id);
		           }   
		     }        
			   ########################   What's great about living at this property?   ##############################
		     if($request_type==9){ 
			  $great_live_with_text = $this->input->post('great_live_with_text');
			  		    
		      $update_data =array("great_live_with_text"=>$great_live_with_text);
	          $this->db->where("profile_id",$profile_id);				   
	          $this->db->update("users_profile",$update_data);
			        
		     }
		      ########################   Prewferred Language   ##############################
		     if($request_type==10){ 
			   $preferred_language  = $this->input->post('preferred_language');
			   if($preferred_language){
			    $update_data =array("preferred_language"=>$preferred_language);
	            $this->db->where("profile_id",$profile_id);				   
	            $this->db->update("users_profile",$update_data);
			  }
			        
		     } 
		    	   
	   }
	   $this->message_output->set_success('Information has been updated.', TRUE);
	   return json_encode(array("success"=>true));	   
   }	
   
  
   function deleteListingPhoto($photo_id,$profile_id){

	   $this->db->where("photo_id",$photo_id);
	   $this->db->where("profile_id",$profile_id);	
	   $this->db->delete("users_photos");
	   return TRUE;	   
   }
  
	function createHomePhotoThumbnail($filename)
		{
		$config['image_library'] = "gd2";
		$config['new_image'] = $this->home_thumb_photo . '/' . $filename;
		$config['source_image'] = $this->home_main_photo . '/' . $filename;
		$config['maintain_ratio'] = FALSE;
		$config['width'] = "370";
		$config['height'] = "260";
		$config['encrypt_name'] = TRUE;
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		return TRUE;
		}

	function createContactThumbnail($filename)
		{
		$config['image_library'] = "gd2";
		$config['new_image'] = $this->contact_thumb_photo . '/' . $filename;
		$config['source_image'] = $this->contact_main_photo . '/' . $filename;
		$config['maintain_ratio'] = FALSE;
		$config['width'] = "370";
		$config['height'] = "260";
		$config['encrypt_name'] = TRUE;
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		return TRUE;
		}

	function createContactMiniThumbnail($filename)
		{
		$config['image_library'] = "gd2";
		$config['new_image'] = $this->contact_mini_photo . '/' . $filename;
		$config['source_image'] = $this->contact_main_photo . '/' . $filename;
		$config['maintain_ratio'] = FALSE;
		$config['width'] = "60";
		$config['height'] = "60";
		$config['encrypt_name'] = TRUE;
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		return TRUE;
		}
		
	function updateAboutInfo($profile_id){
	       
			  // About you
		      $place_is_for = $this->input->post('place_is_for');
		      $update_data  = array("place_is_for"=>$place_is_for);
	          $this->db->where("profile_id",$profile_id);				   
	          $this->db->update("users_profile",$update_data);
			  
			  if($place_is_for=='1'){
				  $me_firstname = $this->input->post('me_firstname');
				  $me_age       = $this->input->post('me_age');
				  $me_gender    = $this->input->post('me_gender');
				  //profile_pic
				  
				   if ($_FILES['profile_pic']['name'] != ''){
				      
					  
						$config['upload_path']    = $this->contact_main_photo;
						$config['allowed_types']  = '*';
						$config['max_size']       = '4024';
						$config['encrypt_name']   = TRUE;
						$this->upload->initialize($config);
						if ($this->upload->do_upload('profile_pic'))
							{
							$data_file = $this->upload->data();
							if (isset($data_file))
								{
								    
							 $this->db->where("profile_id",$profile_id);
					          $this->db->delete('users_photos');
					   
								$attachment_file  =  $data_file['file_name'];
								
								 $document_path    = CNTPHT.$attachment_file;
								 
								 	 $this->createContactThumbnail($data_file['file_name']);
		      
		                         // $b64Doc = chunk_split(base64_encode(file_get_contents($document_path)));		
		                    	  $this->db->query("INSERT INTO users_photos SET profile_id='".(int)$profile_id."',photo = '" . $attachment_file."',entry_time = '" . date('Y-m-d H:i:s') . "',ip_address ='".ip_address()."'"); 
			  
		                    	  //unlink($document_path);
							
								}
							 }
						}
				  
			      $update_data  = array("me_firstname"=>$me_firstname,"me_age"=>$me_age,"me_gender"=>$me_gender);
		          $this->db->where("profile_id",$profile_id);				   
		          $this->db->update("users_profile",$update_data);	  
			  }
		      if($place_is_for=='2'){
				  $me_firstname = $this->input->post('me_firstname');
				  $me_age       = $this->input->post('me_age');
				  $me_gender    = $this->input->post('me_gender');
				  //profile_pic
				  
				  if ($_FILES['profile_pic']['name'] != ''){
				     
					   
						$config['upload_path']    = $this->contact_main_photo;
						$config['allowed_types']  = '*';
						$config['max_size']       = '4024';
						$config['encrypt_name']   = TRUE;
						$this->upload->initialize($config);
						if ($this->upload->do_upload('profile_pic'))
							{
							$data_file = $this->upload->data();
							if (isset($data_file))
								{
							 $this->db->where("profile_id",$profile_id);
					          $this->db->delete('users_photos');
								$attachment_file  =  $data_file['file_name'];
								
								 $document_path    = CNTPHT.$attachment_file;
								 
								 	 $this->createContactThumbnail($data_file['file_name']);
		      
		                          //$b64Doc = chunk_split(base64_encode(file_get_contents($document_path)));		
		                    	  $this->db->query("INSERT INTO users_photos SET profile_id='".(int)$profile_id."',photo = '" . $attachment_file."',entry_time = '" . date('Y-m-d H:i:s') . "',ip_address ='".ip_address()."'"); 
			  
		                    	  //unlink($document_path);
							
								}
							 }
						}
				  
			      $update_data  = array("me_firstname"=>$me_firstname,"me_age"=>$me_age,"me_gender"=>$me_gender);
		          $this->db->where("profile_id",$profile_id);				   
		          $this->db->update("users_profile",$update_data);
				  
				  
				  
				  $partner_firstname = $this->input->post('partner_firstname');
				  $partner_age       = $this->input->post('partner_age');
				  $partner_gender    = $this->input->post('partner_gender');
				  //profile_pic
				  
				  $couple_exists = $this->db->where("profile_id",$profile_id)->count_all_results('users_introduce_yourself_couple'); 
				  if($couple_exists==0){
				   $insert_data_couple  = array("profile_id"=>$profile_id,"partner_first_name"=>$partner_firstname,"partner_age"=>$partner_age,"partner_gender"=>$partner_gender);
		           $this->db->insert("users_introduce_yourself_couple",$insert_data_couple); 
				  }
				  else{
				  $update_data_couple  = array("partner_first_name"=>$partner_firstname,"partner_age"=>$partner_age,"partner_gender"=>$partner_gender);
		          $this->db->where("profile_id",$profile_id);				   
		          $this->db->update("users_introduce_yourself_couple",$update_data_couple);    
				      
				  }
			  }			  
			  if($place_is_for=='3'){
			   
			      
				  $me_firstname = $this->input->post('me_firstname');
				  $me_age       = $this->input->post('me_age');
				  $me_gender    = $this->input->post('me_gender');
				  
				  //profile_pic
				  
				  if ($_FILES['profile_pic']['name'] != ''){
						$config['upload_path']    = $this->contact_main_photo;
						$config['allowed_types']  = '*';
						$config['max_size']       = '4024';
						$config['encrypt_name']   = TRUE;
						$this->upload->initialize($config);
						if ($this->upload->do_upload('profile_pic'))
							{
							$data_file = $this->upload->data();
							if (isset($data_file))
								{
							 $this->db->where("profile_id",$profile_id);
					          $this->db->delete('users_photos');	    
							
								$attachment_file  =  $data_file['file_name'];
								
								 $document_path    = CNTPHT.$attachment_file;
								 $this->createContactThumbnail($data_file['file_name']);
		      
		                         // $b64Doc = chunk_split(base64_encode(file_get_contents($document_path)));		
		                    	  $this->db->query("INSERT INTO users_photos SET profile_id='".(int)$profile_id."',photo = '" . $attachment_file."',entry_time = '" . date('Y-m-d H:i:s') . "',ip_address ='".ip_address()."'"); 
			  
		                    	 // unlink($document_path);
							
								}
							 }
						}
						
			      $update_data  = array("me_firstname"=>$me_firstname,"me_age"=>$me_age,"me_gender"=>$me_gender);
		          $this->db->where("profile_id",$profile_id);				   
		          $this->db->update("users_profile",$update_data);
				  				  
				  $friends_firstname = $this->input->post('friends_firstname');
				  $friends_age       = $this->input->post('friends_age');
				 
				  				  
				  if($friends_firstname && is_array($friends_firstname)){
					  $this->db->where("profile_id",$profile_id);
					  $this->db->delete('users_introduce_yourself_group');
					  
					  $grpcounter=0;
				  foreach($friends_firstname as $namekey => $nameval){
					  $friends_age_val =  $friends_age[$namekey];
					  if($this->input->post('friends_gender')){
					  if($grpcounter >0){
				             $friends_gender      = $this->input->post('friends_gender'.$grpcounter.'');
				             $friends_gender_val =  $friends_gender[0];
				       }
                     else{				
                           $friends_gender = $this->input->post('friends_gender');
                           $friends_gender_val =  $friends_gender[0];
                       }    
					      
					  }
					  else{
					      
					         $friends_gender      = $this->input->post('friends_gender'.$grpcounter.'');
				             $friends_gender_val =  $friends_gender[0]; 
					  }
					  
					  
				 
			      $insert_data  = array("profile_id"=>$profile_id,"friends_name"=>$nameval,"age"=>$friends_age_val,"gender_identify"=>$friends_gender_val);		        
		          $this->db->insert("users_introduce_yourself_group",$insert_data);  
		         
		           $grpcounter++;
				  }
				  
				  }
				  
				
				  
				  
			  }
	    
	}	
		

    function updateLocations($profile_id){
             
              $home_address  = $this->input->post("home_address");
              $country       = $this->input->post("country");
              if(isset($country[0])){
                  $country_lists = explode(",",$country[0]);
                  
              }else
              $country_lists='';
              
              
              $latitude      = $this->input->post("latitude");
              if(isset($latitude[0])){
                  $latitude_lists = explode(",",$latitude[0]);
                  
              }else
              $latitude_lists='';
              
               $longitude     = $this->input->post("longitude");
              if(isset($longitude[0])){
                  $longitude_lists = explode(",",$longitude[0]);
                  
              }else
              $longitude_lists='';

               $state      = $this->input->post("state");
              if(isset($state[0])){
                  $state_lists = explode(",",$state[0]);
                  
              }else
              $state_lists='';
            
                $city      = $this->input->post("city");
              if(isset($city[0])){
                  $city_lists = explode(",",$city[0]);
                  
              }else
              $city_lists='';

                 $postal_code      = $this->input->post("postal_code");
              if(isset($postal_code[0])){
                  $postal_code_lists = explode(",",$postal_code[0]);
                  
              }else
              $postal_code_lists='';
              
              
              $final_suburb=array();
              $street_number = $this->input->post("street");
              if(isset($street_number[0])){
                  $street_info = explode(",",rtrim($street_number[0],","));
                  foreach($street_info as $street_key => $streetval){
                      if($country_lists)
                            $country_val =$country_lists[$street_key];
                      else
                           $country_val='';
                    
                     if($latitude_lists)
                            $latitude_val =$latitude_lists[$street_key];
                      else
                           $latitude_val='';
                           
                   
                     if($longitude_lists)
                            $longitude_val =$longitude_lists[$street_key];
                      else
                           $longitude_val='';

                           
                    if($state_lists)
                            $state_val =$state_lists[$street_key];
                      else
                           $state_val='';

                           
                    if($city_lists)
                            $city_val =$city_lists[$street_key];
                      else
                           $city_val='';

                    if($postal_code_lists)
                            $postal_code_val =$postal_code_lists[$street_key];
                      else
                           $postal_code_val='';

                          
                      $home_address_val =     $home_address[$street_key]; 
                      
                       $final_suburb[]=array('location'=>$home_address_val,'street'=>$streetval,
                                             'country'=>$country_val,'state'=>$state_val,'city'=>$city_val,'postal_code'=>$postal_code_val,
                                             'latitude'=>$latitude_val,'longitude'=>$longitude_val);
                      
                  }
                  
              }
              
              $final_suburb= json_encode($final_suburb);
              $update_data =array("suburb"=>$final_suburb);
	          $this->db->where("profile_id",$profile_id);				   
	          $this->db->update("users_profile",$update_data); 
        
    }

 

   function upload_home_photos($profile_id){
     
        if($this->session->userdata('s_temp_images')){
            $cache_images = $this->session->userdata('s_temp_images');
            foreach($cache_images as $key => $value){
               rename(CACHEIMGPATH.$value, HMEPHT.$value);
               $this->createHomePhotoThumbnail($value);
               $this->db->query("INSERT INTO users_photos SET profile_id='".(int)$profile_id."',photo = '" . $value."',entry_time = '" . date('Y-m-d H:i:s') . "',ip_address ='".ip_address()."'"); 
          }
       }
   }



	function upload_home_photos_old($profile_id){
	  	$uploadData=array();
		$data = array();
		$filesCount = count($_FILES['files']['name']);
		if($filesCount >0){
		$files = $_FILES['files'];
		for($i = 0; $i < $filesCount; $i++){
			$_FILES['files']['name']      = $files['name'][$i];
			$_FILES['files']['type']      = $files['type'][$i];
			$_FILES['files']['tmp_name']  = $files['tmp_name'][$i];
			$_FILES['files']['error']     = $files['error'][$i];
			$_FILES['files']['size']      = $files['size'][$i];
		  
			$config['upload_path'] = $this->home_main_photo;
			$config['allowed_types'] = '*';
			$config['encrypt_name']   = TRUE;
			
			// Load and initialize upload library
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			// Upload file to server
			if($this->upload->do_upload('files')){
				// Uploaded file data
				$fileData = $this->upload->data();				
				$uploadData[$i]['file_name'] = $fileData['file_name'];
			}
		}						
		if(!empty($uploadData)){			
		   foreach($uploadData  as $filedata){	
		      $attachment_file  = $filedata['file_name'];
		      $document_path    = HMEPHT.$attachment_file;
		      
		      $this->createHomePhotoThumbnail($filedata['file_name']);
		      //$b64Doc = chunk_split(base64_encode(file_get_contents($document_path)));		
			  $this->db->query("INSERT INTO users_photos SET profile_id='".(int)$profile_id."',photo = '" . $attachment_file."',entry_time = '" . date('Y-m-d H:i:s') . "',ip_address ='".ip_address()."'"); 
			  
			  //unlink($document_path);
			  			
			}
		 }
		}
		$this->message_output->set_success('Information has been updated.', TRUE);
	   return json_encode(array("success"=>true)); 
	  
	}


	}