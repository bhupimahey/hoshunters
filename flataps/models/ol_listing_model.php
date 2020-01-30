<?php
class Listings_model extends CI_Model
{
    
   function getListingResult($limit){
        
   		if(isset($_GET['start'])){	
		$search_text = $_GET['search'];
		$length      = $_GET['length'];
		}
		else{
		$search_text='';		
		if($limit)
		 $length=$limit;
		else
		$length=9;
		}
		$start=($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		
		
	   if($this->session->userdata('s_user_id'))
		$iTotalRecords = $this->db->where('profile_status','1')->where('listing_confirmed','1')->where('account_id !=',$this->session->userdata('s_user_id'))->count_all_results('users_profile');
		else
		$iTotalRecords = $this->db->where('profile_status','1')->where('listing_confirmed','1')->count_all_results('users_profile');
	    
	
		$this->db->limit($length,$start);
	    if($this->session->userdata('s_user_id'))
		  $this->db->where('account_id !=',$this->session->userdata('s_user_id'));
		
		$this->db->where('listing_confirmed','1');  
        $this->db->where('profile_status','1');
		$query = $this->db->get('users_profile');
		
		$records = array();
		$records["data"] = array();
		$id = 0;
		$result = $query->result();
		foreach($result as $values)
			{
			
			$profile_info          = $this->common_model->getProfileInfo($values->profile_id);	
			$profile_photo_info    = $this->common_model->get_user_photo($values->profile_id);
			$property_address_info = $this->common_model->property_address_info($values->profile_id);
			$homedes_rentbondbills = $this->common_model->homedes_rentbondbills($values->profile_id);
		    $homedes_rooms         = $this->common_model->homedes_rooms($values->profile_id);
		    $profile_type          = $profile_info->profile_type;
			    
			if( $profile_type==1){
			    
			      if($profile_photo_info)
			            $photo ='<img src="'.base_url().CNTPHT_THUMB.$profile_photo_info->photo.'" alt="#"/>'; 
		            
		           else
			            $photo=''; 
			        
			    }
			 else  if( $profile_type==2){
			       if($profile_photo_info)
			            $photo ='<img src="'.base_url().HMEPHT_THUMB.$profile_photo_info->photo.'" alt="#"/>'; 
		            
		           else
			            $photo='';   
			        
			    } 
			    
			    $records["data"][] = array(				
			    	'suburb'        =>$profile_info->suburb,
			    	'entry_time'    =>$profile_info->entry_time,
			    	'first_name'    =>$profile_info->me_firstname,
			    	'photo'         => $photo,
			    	'listing_id'    =>$values->profile_id,
			    	'property_type'    =>$values->property_type,
                  	'age'           =>$profile_info->me_age,
			    	'gender'        =>$profile_info->me_gender,
			    	'about_yourself'=>$profile_info->great_live_with_text,
			    	'weekly_budget' =>$profile_info->weekly_budget,
			    	'property_address_info'=>$property_address_info,
			    	'homedes_rooms' =>$homedes_rooms,
			    	'rentbondbills' =>$homedes_rentbondbills,
			    	'profile_type'  =>$profile_type,
			    	'profile_status'=>$profile_info->profile_status
			   );
		
	    }

		$config = array();
        $config["base_url"] = base_url().'listings';
        $config["total_rows"] = $iTotalRecords;
        $config["per_page"] = $length;
        $config["uri_segment"] = 2;
        $config['full_tag_open'] = '<nav aria-label="Page navigation" class="alinment d-table"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
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
    
   function searchListingResult_Old($limit){
        
        $s_search_parametrs = $this->session->userdata('s_search_parametrs');
   		if(isset($_GET['start'])){	
		$search_text = $_GET['search'];
		$length      = $_GET['length'];
		}
		else{
		$search_text='';		
		if($limit)
		 $length=$limit;
		else
		$length=9;
		}
		$start=($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		
		// Rooms = 1, Flatmates = 2, Teamups = 3
		$status_type = $s_search_parametrs['status_type'];
    	$country     = strtolower($s_search_parametrs['country']);
		$state       = strtolower($s_search_parametrs['state']);
		$city        = strtolower($s_search_parametrs['city']);
		$street      = strtolower($s_search_parametrs['street']);
		$postal_code = strtolower($s_search_parametrs['postal_code']);
		
	  	 $this->db->limit($length,$start);
	    // Order By 
	   if($status_type==1){ //Rooms
	  
	     $min_rent  = $s_search_parametrs['min_rent'];
		 $max_rent  = $s_search_parametrs['max_rent'];
		 $search_by = $s_search_parametrs['search_by'];
		 
	     ///////////////////              Advanced Search Parameters ////////////////////////////////
	    
	     $available_from    = $s_search_parametrs['available_from'];
	     $any_gender        = $s_search_parametrs['any_gender'];
	     $rooms_types       = $s_search_parametrs['rooms_types'];
	     $bathrooms_typess  = $s_search_parametrs['bathrooms_types'];
	     $room_furnishing   = $s_search_parametrs['room_furnishing'];
	     $staylength        = $s_search_parametrs['staylength'];
	     $anyparking        = $s_search_parametrs['anyparking'];
	     $avail_bedroom     = $s_search_parametrs['avail_bedroom'];
	  
	      $search_by = $s_search_parametrs['search_by'];
	      if( $search_by==3) //Cheapest (rent low to high
	           $this->db->order_by('rm.weekly_rent','ASC');
	      else if( $search_by==4) //Dearest (rent high to low)
	           $this->db->order_by('rm.weekly_rent','DESC');
	    
	     //Rooms
		  $searchset_count='';
		  $searchset='';
		  
		 // count total records	 
		 if($this->session->userdata('s_user_id')){
		    $this->db->where('uspr.account_id !=',$this->session->userdata('s_user_id'));
		   
        if($state){
        $state_path    ='"state":"'.$state.'"';
        $state_pattern = $state_path; 
        $searchset_count .="LOWER(abp.property_address) LIKE '%".$state_pattern."%' OR " ;
        }
        
        if($city){
        $city_path    ='"city":"'.$city.'"';
        $city_pattern =$city_path; 
        $searchset_count .="LOWER(abp.property_address) LIKE '%".$city_pattern."%' OR ";
        }
        
        if($street){
         $street_path    ='"street":"'.$street.'"';
         $street_pattern =$street_path; 
         $searchset_count .="LOWER(abp.property_address) LIKE '%".$street_pattern."%' OR ";
        }
        
        if($postal_code){
        $postal_path    ='"postal_code":"'.$postal_code.'"';
        $postal_pattern =$postal_path; 
        $searchset_count .="LOWER(abp.property_address) LIKE '%".$postal_pattern."%' OR ";
        }
		
	    $min_rent  = $s_search_parametrs['min_rent'];
	    $max_rent  = $s_search_parametrs['max_rent'];
	    $search_by = $s_search_parametrs['search_by'];
	    if($min_rent)
	         $this->db->where('rm.weekly_rent >=',$min_rent);  
		 if($max_rent)
		     $this->db->where('rm.weekly_rent <=',$max_rent);
		     
		 if($searchset_count){
		      $searchset_count = rtrim($searchset_count,' OR '); 
		     $this->db->where("(".$searchset_count.") ");
		     }
		     
		$this->db->join('homedes_rentbondbills rm','rm.profile_id=uspr.profile_id','LEFT'); 
		$this->db->join('property_for_search abp','abp.profile_id=uspr.profile_id','LEFT'); 
		     
	    $this->db->where('uspr.profile_type','2');
		$this->db->where('uspr.listing_confirmed','1');
		$this->db->where('uspr.profile_status','1');    
		$this->db->select('uspr.*');  
		$this->db->distinct();
	    $query = $this->db->get('users_profile uspr');
		$iTotalRecords = $query->num_rows();
		
		 }
		 else{
	
        
        if($state){
        $state_path    ='"state":"'.$state.'"';
        $state_pattern = $state_path; 
        $searchset_count .="LOWER(abp.property_address) LIKE '%".$state_pattern."%' OR " ;
        }
        
        if($city){
        $city_path    ='"city":"'.$city.'"';
        $city_pattern =$city_path; 
        $searchset_count .="LOWER(abp.property_address) LIKE '%".$city_pattern."%' OR ";
        }
        
        if($street){
         $street_path    ='"street":"'.$street.'"';
         $street_pattern =$street_path; 
         $searchset_count .="LOWER(abp.property_address) LIKE '%".$street_pattern."%' OR ";
        }
        
        if($postal_code){
        $postal_path    ='"postal_code":"'.$postal_code.'"';
        $postal_pattern =$postal_path; 
        $searchset_count .="LOWER(abp.property_address) LIKE '%".$postal_pattern."%' OR ";
        }
		
	    $min_rent  = $s_search_parametrs['min_rent'];
	    $max_rent  = $s_search_parametrs['max_rent'];
	    $search_by = $s_search_parametrs['search_by'];
	    if($min_rent)
	         $this->db->where('rm.weekly_rent >=',$min_rent);  
		 if($max_rent)
		     $this->db->where('rm.weekly_rent <=',$max_rent);
		     
		 if($searchset_count){
		      $searchset_count = rtrim($searchset_count,' OR '); 
		     $this->db->where("(".$searchset_count.") ");
		     }
		     
		$this->db->join('homedes_rentbondbills rm','rm.profile_id=uspr.profile_id','LEFT'); 
		$this->db->join('homedes_about_property abp','abp.profile_id=uspr.profile_id','LEFT'); 
		     
		$this->db->where('uspr.profile_type','2');
		$this->db->where('uspr.listing_confirmed','1');
		$this->db->where('uspr.profile_status','1');    
		$this->db->select('uspr.*');  
		$this->db->distinct();
	    $query = $this->db->get('users_profile uspr');
		$iTotalRecords = $query->num_rows();
		
		}
		
		
	        // main query	

        
           // if($state)
                $state_path    ='"state":"'.$state.'"';
                $state_pattern = $state_path; 
                $searchset .="LOWER(abp.property_address) LIKE '%".$state_pattern."%' OR " ;
                
                
           // if($city)
                $city_path    ='"city":"'.$city.'"';
                $city_pattern =$city_path; 
                $searchset .="LOWER(abp.property_address) LIKE '%".$city_pattern."%' OR ";
                
            
                 $street_path    ='"street":"'.$street.'"';
                 $street_pattern =$street_path; 
                 $searchset .="LOWER(abp.property_address) LIKE '%".$street_pattern."%' OR ";
                
                
            
                $postal_path    ='"postal_code":"'.$postal_code.'"';
                $postal_pattern =$postal_path; 
                $searchset .="LOWER(abp.property_address) LIKE '%".$postal_pattern."%' OR ";
                
///////////////////////////////////////////////////////////////  advanced search //////////////////////        	
        	if($available_from || $staylength){
        	    if($available_from){
        	      $available_from = date("Y-m-d",strtotime($available_from));
        	      $this->db->where('ravil.date_available',$available_from); 
        	    }
        	   if($staylength){
        	      if($staylength==0){    
        	       $this->db->where('ravil.min_stay_length >=','1'); 
        	       $this->db->where('ravil.max_stay_length <=','9'); 
        	      }
        	      else{
        	      $this->db->where('ravil.min_stay_length >=',$staylength); 
        	      $this->db->where('ravil.max_stay_length <=',$staylength); 
        	      }
        	      
        	    } 
        	    $this->db->join('homedes_room_availability ravil','ravil.profile_id=uspr.profile_id','LEFT'); 
        	 }
		    if($any_gender){
		        if($any_gender==0){
        	       $this->db->where_in('hpref.preference',array('1','2','3')); 
		        }
		        else{
		           $this->db->where('hpref.preference',$any_gender);   
		        }
        	    $this->db->join('homedes_flatmates_preferences hpref','hpref.profile_id=uspr.profile_id','LEFT');   
		    }
		  if($rooms_types || $bathrooms_typess || $room_furnishing){
		        if($rooms_types==0)
        	    $this->db->where_in('homedes_rooms.room_type',array('1','2')); 
        	    else
        	    $this->db->where('homedes_rooms.room_type',$rooms_types); 
        	    
        	  if($bathrooms_typess==0)
        	    $this->db->where_in('homedes_rooms.bathroom',array('1','2','3')); 
        	    else
        	    $this->db->where('homedes_rooms.bathroom',$bathrooms_typess);   
        	    
        	  if($room_furnishing){
        	     if($room_furnishing==0)
		          $this->db->where_in('homedes_rooms.room_furnishings',array('1','2')); 
		        else
		           $this->db->where('homedes_rooms.room_furnishings',$room_furnishing); 
		       
        	  }
        	   $this->db->join('homedes_rooms','homedes_rooms.profile_id=uspr.profile_id','LEFT'); 
		    }  
		 
		  if($anyparking){
		      if($anyparking==0)
		       $this->db->where_in('abp.parking',array('1','2','3')); 
		      else
		      $this->db->where('abp.parking',$anyparking); 
		  }    
		  if($avail_bedroom){
		      if($avail_bedroom==0)
		       $this->db->where_in('abp.total_bedrooms',array('1','2','3','4','5')); 
		      else
		      $this->db->where('abp.total_bedrooms',$avail_bedroom);   
		  }    
		      
		      	    
		     if($min_rent)
		     $this->db->where('rm.weekly_rent >=',$min_rent);  
		     if($max_rent)
		     $this->db->where('rm.weekly_rent <=',$max_rent);
		     
		     if($searchset){
		        $searchset = rtrim($searchset,' OR '); 
		     $this->db->where("(".$searchset.") ");
		     
		     }
		     
		     $this->db->join('homedes_rentbondbills rm','rm.profile_id=uspr.profile_id','LEFT'); 
		     $this->db->join('homedes_about_property abp','abp.profile_id=uspr.profile_id','LEFT'); 
		     
		      $this->db->where('uspr.profile_type','2');
		      
		      if($this->session->userdata('s_user_id'))
		          $this->db->where('uspr.account_id !=',$this->session->userdata('s_user_id'));
		      $this->db->where('uspr.listing_confirmed','1');
		      
		      	$this->db->select('uspr.*');  
		$this->db->distinct();
	    $query = $this->db->get('users_profile uspr');
	    
	   echo $this->db->last_query();
die();
		     
		}
		
		
	 else if($status_type==2){ // Flatmates 
		
		///////////////////              Advanced Search Parameters ////////////////////////////////
	    
	     $omin_age = $s_search_parametrs['omin_age'];
	     $omax_age = $s_search_parametrs['omax_age'];
	     
	     $omin_rent = $s_search_parametrs['omin_rent'];
	     $omax_rent = $s_search_parametrs['omax_rent'];
	     
	     $oavailable_from = $s_search_parametrs['oavailable_from'];
	     $opeoplelookingfor = $s_search_parametrs['opeoplelookingfor'];
	     
	     $omin_stay = $s_search_parametrs['omin_stay'];
	     $omax_stay = $s_search_parametrs['omax_stay'];
	     
	     $peoplethatare = $s_search_parametrs['peoplethatare'];
	     $oprofessionals = $s_search_parametrs['oprofessionals'];
	     
	     
	     
		
		$flatmatespref_status = $s_search_parametrs['flatmatespref_status'];
		$search_by            = $s_search_parametrs['search_by'];
		      
		  $searchset_count='';
		  $searchset='';
		  
		 // count total records	 
		 if($this->session->userdata('s_user_id')){
			
		    $this->db->where('uspr.account_id !=',$this->session->userdata('s_user_id'));
		  
        
        if($state){
        $state_path    ='"state":"'.$state.'"';
        $state_pattern = $state_path; 
        $searchset_count .="LOWER(uspr.suburb) LIKE '%".$state_pattern."%' OR " ;
        }
        
        if($city){
        $city_path    ='"city":"'.$city.'"';
        $city_pattern =$city_path; 
        $searchset_count .="LOWER(uspr.suburb) LIKE '%".$city_pattern."%' OR ";
        }
        
        if($street){
         $street_path    ='"street":"'.$street.'"';
         $street_pattern =$street_path; 
         $searchset_count .="LOWER(uspr.suburb) LIKE '%".$street_pattern."%' OR ";
        }
        
        if($postal_code){
        $postal_path    ='"postal_code":"'.$postal_code.'"';
        $postal_pattern =$postal_path; 
        $searchset_count .="LOWER(uspr.suburb) LIKE '%".$postal_pattern."%' OR ";
        }
		
		 if($searchset_count){
		      $searchset_count = rtrim($searchset_count,' OR '); 
		     $this->db->where("(".$searchset_count.") ");
		     }
	
	
	   $this->db->where('flprf.preference',$flatmatespref_status);       
		$this->db->join('users_flatmates_preferences flprf','flprf.profile_id=uspr.profile_id','LEFT'); 		     
		$this->db->where('uspr.profile_type','1');  
		$this->db->where('uspr.profile_status','1');  
		$this->db->select('uspr.*');  
		$this->db->distinct();
	    $query = $this->db->get('users_profile uspr');
		$iTotalRecords = $query->num_rows();
		
		 }
		 else{
	
        
        if($state){
        $state_path    ='"state":"'.$state.'"';
        $state_pattern = $state_path; 
        $searchset_count .="LOWER(uspr.suburb) LIKE '%".$state_pattern."%' OR " ;
        }
        
        if($city){
        $city_path    ='"city":"'.$city.'"';
        $city_pattern =$city_path; 
        $searchset_count .="LOWER(uspr.suburb) LIKE '%".$city_pattern."%' OR ";
        }
        
        if($street){
         $street_path    ='"street":"'.$street.'"';
         $street_pattern =$street_path; 
         $searchset_count .="LOWER(uspr.suburb) LIKE '%".$street_pattern."%' OR ";
        }
        
        if($postal_code){
        $postal_path    ='"postal_code":"'.$postal_code.'"';
        $postal_pattern =$postal_path; 
        $searchset_count .="LOWER(uspr.suburb) LIKE '%".$postal_pattern."%' OR ";
        }
		
	    
		 if($searchset_count){
		      $searchset_count = rtrim($searchset_count,' OR '); 
		     $this->db->where("(".$searchset_count.") ");
		     }
		$this->db->where('flprf.preference',$flatmatespref_status);       
		$this->db->join('users_flatmates_preferences flprf','flprf.profile_id=uspr.profile_id','LEFT'); 		     
		$this->db->where('uspr.profile_type','1');  
		$this->db->where('uspr.profile_status','1');  
		$this->db->select('uspr.*');  
		$this->db->distinct();
	    $query = $this->db->get('users_profile uspr');
	    
	   
		$iTotalRecords = $query->num_rows();
		
		}
		
		
	  // main query	
		

    if($state){
        $state_path    ='"state":"'.$state.'"';
        $state_pattern = $state_path; 
        $searchset .="LOWER(uspr.suburb) LIKE '%".$state_pattern."%' OR " ;
        }
        
    if($city){
        $city_path    ='"city":"'.$city.'"';
        $city_pattern =$city_path; 
        $searchset .="LOWER(uspr.suburb) LIKE '%".$city_pattern."%' OR ";
        }
        
    if($street){
         $street_path    ='"street":"'.$street.'"';
         $street_pattern =$street_path; 
         $searchset .="LOWER(uspr.suburb) LIKE '%".$street_pattern."%' OR ";
        }
        
    if($postal_code){
        $postal_path    ='"postal_code":"'.$postal_code.'"';
        $postal_pattern =$postal_path; 
        $searchset .="LOWER(uspr.suburb) LIKE '%".$postal_pattern."%' OR ";
        }
		
		     
	 if($searchset){
		    $searchset = rtrim($searchset,' OR '); 
		    $this->db->where("(".$searchset.") ");
		     }
   
   	  if($omin_age && $omax_age){
   	     $this->db->where('uspr.me_age >=',$omin_age); 
   	     $this->db->where('uspr.me_age <=',$omax_age);
   	  }   
     elseif($omin_age){
   	     $this->db->where('uspr.me_age',$omin_age); 
   	  } 
     elseif($omax_age){
   	     $this->db->where('uspr.me_age',$omax_age); 
   	  } 
   	  
   	 if( $oavailable_from ){
   	     $oavailable_from = date("Y-m-d",strtotime($oavailable_from));
   	     $this->db->where('uspr.preferred_move_date',$oavailable_from); 
     }
      if( $opeoplelookingfor ){
   	     if($opeoplelookingfor==0)
   	     $this->db->where_in('uspr.place_looking_for',array('1','2','3','4','5','6','7','8')); 
   	     else
   	     $this->db->where('uspr.place_looking_for',$opeoplelookingfor); 
   	     
     }
    
     if($peoplethatare){
         if($peoplethatare==0)
   	       $this->db->where_in('uspr.life_style',array('2','4','3','1')); 
   	     elseif($peoplethatare==4) 
   	        $this->db->where('uspr.life_style !=','4');
   	    elseif($peoplethatare==3) 
   	        $this->db->where('uspr.life_style !=','3');    
   	    elseif($peoplethatare==5) 
   	        $this->db->where('uspr.life_style !=','1');
   	    else
   	     $this->db->where('uspr.life_style',$peoplethatare);
   	  }   
     
   	 if($oprofessionals)
   	     $this->db->where('uspr.employment_status',$oprofessionals); 
   	  
   	  
     if($this->session->userdata('s_user_id'))
          $this->db->where('uspr.account_id !=',$this->session->userdata('s_user_id'));


		      $this->db->where('flprf.preference',$flatmatespref_status);  
		      $this->db->join('users_flatmates_preferences flprf','flprf.profile_id=uspr.profile_id','LEFT'); 
		      $this->db->where('uspr.profile_type','1');
		   } 
		   
		   
		   
      else if($status_type==3){ // Teamups 
   
   	///////////////////              Advanced Search Parameters ////////////////////////////////
	    
	     $omin_age = $s_search_parametrs['omin_age'];
	     $omax_age = $s_search_parametrs['omax_age'];
	     
	     $omin_rent = $s_search_parametrs['omin_rent'];
	     $omax_rent = $s_search_parametrs['omax_rent'];
	     
	     $oavailable_from = $s_search_parametrs['oavailable_from'];
	     $opeoplelookingfor = $s_search_parametrs['opeoplelookingfor'];
	     
	     $omin_stay = $s_search_parametrs['omin_stay'];
	     $omax_stay = $s_search_parametrs['omax_stay'];
	     
	     $peoplethatare = $s_search_parametrs['peoplethatare'];
	     $oprofessionals = $s_search_parametrs['oprofessionals'];
	     
	     $flatmatespref_status = $s_search_parametrs['flatmatespref_status'];
	     $search_by            = $s_search_parametrs['search_by'];
		      
		  $searchset_count='';
		  $searchset='';
		  
		 // count total records	 
		 if($this->session->userdata('s_user_id')){
			
		    $this->db->where('uspr.account_id !=',$this->session->userdata('s_user_id'));
		  
        
        if($state){
        $state_path    ='"state":"'.$state.'"';
        $state_pattern = $state_path; 
        $searchset_count .="LOWER(uspr.suburb) LIKE '%".$state_pattern."%' OR " ;
        }
        
        if($city){
        $city_path    ='"city":"'.$city.'"';
        $city_pattern =$city_path; 
        $searchset_count .="LOWER(uspr.suburb) LIKE '%".$city_pattern."%' OR ";
        }
        
        if($street){
         $street_path    ='"street":"'.$street.'"';
         $street_pattern =$street_path; 
         $searchset_count .="LOWER(uspr.suburb) LIKE '%".$street_pattern."%' OR ";
        }
        
        if($postal_code){
        $postal_path    ='"postal_code":"'.$postal_code.'"';
        $postal_pattern =$postal_path; 
        $searchset_count .="LOWER(uspr.suburb) LIKE '%".$postal_pattern."%' OR ";
        }
		
		 if($searchset_count){
		      $searchset_count = rtrim($searchset_count,' OR '); 
		     $this->db->where("(".$searchset_count.") ");
		     }
		     
	
	   $this->db->where('flprf.preference',$flatmatespref_status);       
		$this->db->join('users_flatmates_preferences flprf','flprf.profile_id=uspr.profile_id','LEFT'); 		     
		$this->db->where('uspr.profile_type','1');  
		$this->db->where('uspr.profile_status','1'); 
		$this->db->where('uspr.teamups','1');		 
		$this->db->select('uspr.*');  
		$this->db->distinct();
	    $query = $this->db->get('users_profile uspr');
		$iTotalRecords = $query->num_rows();
		
		 }
		 else{
	
        
        if($state){
        $state_path    ='"state":"'.$state.'"';
        $state_pattern = $state_path; 
        $searchset_count .="LOWER(uspr.suburb) LIKE '%".$state_pattern."%' OR " ;
        }
        
        if($city){
        $city_path    ='"city":"'.$city.'"';
        $city_pattern =$city_path; 
        $searchset_count .="LOWER(uspr.suburb) LIKE '%".$city_pattern."%' OR ";
        }
        
        if($street){
         $street_path    ='"street":"'.$street.'"';
         $street_pattern =$street_path; 
         $searchset_count .="LOWER(uspr.suburb) LIKE '%".$street_pattern."%' OR ";
        }
        
        if($postal_code){
        $postal_path    ='"postal_code":"'.$postal_code.'"';
        $postal_pattern =$postal_path; 
        $searchset_count .="LOWER(uspr.suburb) LIKE '%".$postal_pattern."%' OR ";
        }
		
	    
		 if($searchset_count){
		      $searchset_count = rtrim($searchset_count,' OR '); 
		     $this->db->where("(".$searchset_count.") ");
		     }
		$this->db->where('flprf.preference',$flatmatespref_status);       
		$this->db->join('users_flatmates_preferences flprf','flprf.profile_id=uspr.profile_id','LEFT'); 		     
		$this->db->where('uspr.profile_type','1');  
		$this->db->where('uspr.profile_status','1');  
		$this->db->where('uspr.teamups','1');
		$this->db->select('uspr.*');  
		$this->db->distinct();
	    $query = $this->db->get('users_profile uspr');
		$iTotalRecords = $query->num_rows();
		
		}
		
		
	  // main query	

    if($state){
        $state_path    ='"state":"'.$state.'"';
        $state_pattern = $state_path; 
        $searchset .="LOWER(uspr.suburb) LIKE '%".$state_pattern."%' OR " ;
        }
        
    if($city){
        $city_path    ='"city":"'.$city.'"';
        $city_pattern =$city_path; 
        $searchset .="LOWER(uspr.suburb) LIKE '%".$city_pattern."%' OR ";
        }
        
    if($street){
         $street_path    ='"street":"'.$street.'"';
         $street_pattern =$street_path; 
         $searchset .="LOWER(uspr.suburb) LIKE '%".$street_pattern."%' OR ";
        }
        
    if($postal_code){
        $postal_path    ='"postal_code":"'.$postal_code.'"';
        $postal_pattern =$postal_path; 
        $searchset .="LOWER(uspr.suburb) LIKE '%".$postal_pattern."%' OR ";
        }
	
	
	
	   	  if($omin_age && $omax_age){
   	     $this->db->where('uspr.me_age >=',$omin_age); 
   	     $this->db->where('uspr.me_age <=',$omax_age);
   	  }   
     elseif($omin_age){
   	     $this->db->where('uspr.me_age',$omin_age); 
   	  } 
     elseif($omax_age){
   	     $this->db->where('uspr.me_age',$omax_age); 
   	  } 
   	  
   	 if( $oavailable_from ){
   	     $oavailable_from = date("Y-m-d",strtotime($oavailable_from));
   	     $this->db->where('uspr.preferred_move_date',$oavailable_from); 
     }
      if( $opeoplelookingfor ){
   	     if($opeoplelookingfor==0)
   	     $this->db->where_in('uspr.place_looking_for',array('1','2','3','4','5','6','7','8')); 
   	     else
   	     $this->db->where('uspr.place_looking_for',$opeoplelookingfor); 
   	     
     }
    
     if($peoplethatare){
         if($peoplethatare==0)
   	       $this->db->where_in('uspr.life_style',array('2','4','3','1')); 
   	     elseif($peoplethatare==4) 
   	        $this->db->where('uspr.life_style !=','4');
   	    elseif($peoplethatare==3) 
   	        $this->db->where('uspr.life_style !=','3');    
   	    elseif($peoplethatare==5) 
   	        $this->db->where('uspr.life_style !=','1');
   	    else
   	     $this->db->where('uspr.life_style',$peoplethatare);
   	  }   
     
   	 if($oprofessionals)
   	     $this->db->where('uspr.employment_status',$oprofessionals); 
   	     
		     
		     if($searchset){
		        $searchset = rtrim($searchset,' OR '); 
		        $this->db->where("(".$searchset.") ");
		     
		     }
		     
		     
		     
		     
		     if($this->session->userdata('s_user_id'))
		          $this->db->where('uspr.account_id !=',$this->session->userdata('s_user_id'));
		      $this->db->where('flprf.preference',$flatmatespref_status);  
		      $this->db->join('users_flatmates_preferences flprf','flprf.profile_id=uspr.profile_id','LEFT'); 
		      $this->db->where('uspr.profile_type','1');
		      $this->db->where('uspr.teamups','1');
		   } 
	   
		
	
	    
		$records = array();
		$records["data"] = array();
		$id = 0;
		$result = $query->result();
		foreach($result as $values)
			{
			
			$profile_info          = $this->common_model->getProfileInfo($values->profile_id);	
			$profile_photo_info    = $this->common_model->get_user_photo($values->profile_id);
			$property_address_info = $this->common_model->property_address_info($values->profile_id);
			$homedes_rentbondbills = $this->common_model->homedes_rentbondbills($values->profile_id);
		    $homedes_rooms         = $this->common_model->homedes_rooms($values->profile_id);
		    $profile_type          = $profile_info->profile_type;
			    
			if( $profile_type==1){
			    
			      if($profile_photo_info){
			            $photo ='<img src="'.base_url().CNTPHT_THUMB.$profile_photo_info->photo.'" alt="#"/>'; 
			            $photo_path = base_url().CNTPHT_MINI.$profile_photo_info->photo;
			      }
		           else
			            $photo=$photo_path = ''; 
			        
			    }
			 else  if( $profile_type==2){
			       if($profile_photo_info){
			            $photo ='<img src="'.base_url().HMEPHT_THUMB.$profile_photo_info->photo.'" alt="#"/>'; 
			            $photo_path = base_url().HMEPHT_THUMB.$profile_photo_info->photo;
			       }
		            
		           else
			            $photo=$photo_path = '';   
			        
			    } 
			    
			    $records["data"][] = array(				
			    	'suburb'        =>$profile_info->suburb,
			    	'first_name'    =>$profile_info->me_firstname,
			    	'photo'         => $photo,
			    	'photo_path'    =>$photo_path,
			    	'listing_id'    =>$values->profile_id,
                  	'age'           =>$profile_info->me_age,
			    	'gender'        =>$profile_info->me_gender,
			    	'about_yourself'=>$profile_info->great_live_with_text,
			    	'weekly_budget' =>$profile_info->weekly_budget,
			    	'property_address_info'=>$property_address_info,
			    	'homedes_rooms' =>$homedes_rooms,
			    	'rentbondbills' =>$homedes_rentbondbills,
			    	'profile_type'  =>$profile_type,
			    	'profile_status'=>$profile_info->profile_status
			   );
		
	    }

		$config = array();
        $config["base_url"] = base_url().'listings';
        $config["total_rows"] = $iTotalRecords;
        $config["per_page"] = $length;
        $config["uri_segment"] = 2;
        $config['full_tag_open'] = '<nav aria-label="Page navigation" class="alinment d-table"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
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
    
   function rooms_query($s_search_parametrs,$length,$start){
       	 
	     $min_rent  = $s_search_parametrs['min_rent'];
		 $max_rent  = $s_search_parametrs['max_rent'];
		 $search_by = $s_search_parametrs['search_by'];
		 $preferred_language = $s_search_parametrs['spreferred_language']; 
	 
	     $available_from    = $s_search_parametrs['available_from'];
	     $any_gender        = $s_search_parametrs['any_gender'];
	     $rooms_types       = $s_search_parametrs['rooms_types'];
	     $bathrooms_typess  = $s_search_parametrs['bathrooms_types'];
	     $room_furnishing   = $s_search_parametrs['room_furnishing'];
	     $staylength        = $s_search_parametrs['staylength'];
	     $anyparking        = $s_search_parametrs['anyparking'];
	     $avail_bedroom     = $s_search_parametrs['avail_bedroom'];
	     
	    $country     = strtolower($s_search_parametrs['country']);
		$state       = strtolower($s_search_parametrs['state']);
		$city        = strtolower($s_search_parametrs['city']);
		$street      = strtolower($s_search_parametrs['street']);
		$postal_code = strtolower($s_search_parametrs['postal_code']);
		
		$searchsuburb  = strtolower($s_search_parametrs['searchsuburb']);
		
	    $searchset_count='';
		$searchset='';
     if($state){
        $state_path    ='"state":"'.$state.'"';
        $state_pattern = $state_path; 
        $searchset_count .=" LOWER(pfs.state) LIKE '%".$state."%' OR " ;
        }
       if($city){
        $city_path    ='"city":"'.$city.'"';
        $city_pattern =$city_path; 
        $searchset_count .="LOWER(pfs.city) LIKE '%".$city."%' OR ";
        }
       if($street){
         $street_path    ='"street":"'.$street.'"';
         $street_pattern =$street_path; 
         $searchset_count .="LOWER(pfs.street) LIKE '%".$street."%' OR ";
        }
       if($postal_code){
        $postal_path    ='"postal_code":"'.$postal_code.'"';
        $postal_pattern =$postal_path; 
        $searchset_count .="LOWER(pfs.postcode) LIKE '%".$postal_code."%' OR ";
        }
     	if($searchsuburb){
        $searchset_count .="LOWER(pfs.location) LIKE '%".$searchsuburb."%' OR ";    
        }	    
       
	    $search_by = $s_search_parametrs['search_by'];
	      if( $search_by==3) //Cheapest (rent low to high
	           $this->db->order_by('rm.weekly_rent','ASC');
	      else if( $search_by==4) //Dearest (rent high to low)
	           $this->db->order_by('rm.weekly_rent','DESC');
	    
	   
		 if($this->session->userdata('s_user_id')){
		    $this->db->where('uspr.account_id !=',$this->session->userdata('s_user_id'));
	
	      $min_rent  = $s_search_parametrs['min_rent'];
	         $max_rent  = $s_search_parametrs['max_rent'];
	         $search_by = $s_search_parametrs['search_by'];
	    if($min_rent)
	         $this->db->where('rm.weekly_rent >=',$min_rent);  
		 if($max_rent)
		     $this->db->where('rm.weekly_rent <=',$max_rent);
		     
		    if($searchset_count){
		      $searchset_count = rtrim($searchset_count,' OR '); 
		      $this->db->where("(".$searchset_count.") ");
		     }
 
		$this->db->join('homedes_rentbondbills rm','rm.profile_id=uspr.profile_id','LEFT'); 
		$this->db->join('homedes_about_property abp','abp.profile_id=uspr.profile_id','LEFT'); 
		$this->db->join('property_for_search pfs','pfs.profile_id=uspr.profile_id','LEFT'); 
		     
		if($preferred_language==0)
		    $this->db->where_in('uspr.preferred_language',array('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15'));
		else
		 $this->db->where('uspr.preferred_language',$preferred_language);
		
		
	    $this->db->where('uspr.profile_type','2');
		$this->db->where('uspr.listing_confirmed','1');
		$this->db->where('uspr.profile_status','1');    
		$this->db->select('uspr.*');  
		$this->db->distinct();
	    $query = $this->db->get('users_profile uspr');
		$iTotalRecords = $query->num_rows();
		
		 }
		 else{
	    
	    if($min_rent)
	         $this->db->where('rm.weekly_rent >=',$min_rent);  
		 if($max_rent)
		     $this->db->where('rm.weekly_rent <=',$max_rent);
		     
		 if($searchset_count){
		      $searchset_count = rtrim($searchset_count,' OR '); 
		     $this->db->where("(".$searchset_count.") ");
		     }
  
		$this->db->join('homedes_rentbondbills rm','rm.profile_id=uspr.profile_id','LEFT'); 
		$this->db->join('homedes_about_property abp','abp.profile_id=uspr.profile_id','LEFT'); 
	    $this->db->join('property_for_search pfs','pfs.profile_id=uspr.profile_id','LEFT');
		
		if($preferred_language==0)
		    $this->db->where_in('uspr.preferred_language',array('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15'));
		else
		 $this->db->where('uspr.preferred_language',$preferred_language);
		  
		$this->db->where('uspr.profile_type','2');
		$this->db->where('uspr.listing_confirmed','1');
		$this->db->where('uspr.profile_status','1');    
		$this->db->select('uspr.*');  
		$this->db->distinct();
	    $query = $this->db->get('users_profile uspr');
		$iTotalRecords = $query->num_rows();
	
		}
	
       $this->db->limit($length,$start);
        if($available_from || $staylength){
        	    if($available_from){
        	      $available_from = date("Y-m-d",strtotime($available_from));
        	      $this->db->where('ravil.date_available',$available_from); 
        	    }
        	   if($staylength){
        	      if($staylength==0){    
        	       $this->db->where('ravil.min_stay_length >=','1'); 
        	       $this->db->where('ravil.max_stay_length <=','9'); 
        	      }
        	      else{
        	      $this->db->where('ravil.min_stay_length >=',$staylength); 
        	      $this->db->where('ravil.max_stay_length <=',$staylength); 
        	      }
        	      
        	    } 
        	    $this->db->join('homedes_room_availability ravil','ravil.profile_id=uspr.profile_id','LEFT'); 
        	 }
		if($any_gender){
		        if($any_gender==0){
        	       $this->db->where_in('hpref.preference',array('1','2','3')); 
		        }
		        else{
		           $this->db->where('hpref.preference',$any_gender);   
		        }
        	    $this->db->join('homedes_flatmates_preferences hpref','hpref.profile_id=uspr.profile_id','LEFT');   
		    }
	 
		if($rooms_types || $bathrooms_typess || $room_furnishing){
		        if($rooms_types==0)
        	    $this->db->where_in('homedes_rooms.room_type',array('1','2')); 
        	    else
        	    $this->db->where('homedes_rooms.room_type',$rooms_types); 
        	    
        	  if($bathrooms_typess==0)
        	    $this->db->where_in('homedes_rooms.bathroom',array('1','2','3')); 
        	    else
        	    $this->db->where('homedes_rooms.bathroom',$bathrooms_typess);   
        	    
        	  if($room_furnishing){
        	     if($room_furnishing==0)
		          $this->db->where_in('homedes_rooms.room_furnishings',array('1','2')); 
		        else
		           $this->db->where('homedes_rooms.room_furnishings',$room_furnishing); 
		       
        	  }
        	   $this->db->join('homedes_rooms','homedes_rooms.profile_id=uspr.profile_id','LEFT'); 
		    }  
		if($anyparking){
		      if($anyparking==0)
		       $this->db->where_in('abp.parking',array('1','2','3')); 
		      else
		      $this->db->where('abp.parking',$anyparking); 
		  }    
		if($avail_bedroom){
		      if($avail_bedroom==0)
		       $this->db->where_in('abp.total_bedrooms',array('1','2','3','4','5')); 
		      else
		      $this->db->where('abp.total_bedrooms',$avail_bedroom);   
		  }    
	    if($min_rent)
		     $this->db->where('rm.weekly_rent >=',$min_rent);  
		  if($max_rent)
		     $this->db->where('rm.weekly_rent <=',$max_rent);
		     
		  		     
		 if($searchset_count){
		      $searchset_count = rtrim($searchset_count,' OR '); 
		     $this->db->where("(".$searchset_count.") ");
		     }
		     
		  
	    $this->db->join('homedes_rentbondbills rm','rm.profile_id=uspr.profile_id','LEFT'); 
	    $this->db->join('homedes_about_property abp','abp.profile_id=uspr.profile_id','LEFT'); 
	    $this->db->join('property_for_search pfs','pfs.profile_id=uspr.profile_id','LEFT'); 
		     
	   $this->db->where('uspr.profile_type','2');
	  if($preferred_language==0)
		    $this->db->where_in('uspr.preferred_language',array('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15'));
		else
		 $this->db->where('uspr.preferred_language',$preferred_language);
		  
      if($this->session->userdata('s_user_id'))
		$this->db->where('uspr.account_id !=',$this->session->userdata('s_user_id'));
		$this->db->where('uspr.listing_confirmed','1');
		$this->db->select('uspr.*');  
		$this->db->distinct();
	    $query = $this->db->get('users_profile uspr');
	   
	    $result = $query->result();
	    $final_result= array('iTotalRecords'=>$iTotalRecords,'result'=>$result);
        return $final_result;
    }
  
   function flatmates_query($s_search_parametrs,$length,$start){
     	 $omin_age = $s_search_parametrs['omin_age'];
	     $omax_age = $s_search_parametrs['omax_age'];
	     $omin_rent = $s_search_parametrs['omin_rent'];
	     $omax_rent = $s_search_parametrs['omax_rent'];
	     $oavailable_from = $s_search_parametrs['oavailable_from'];
	     $opeoplelookingfor = $s_search_parametrs['opeoplelookingfor'];
	     $preferred_language = $s_search_parametrs['spreferred_language'];
	     
	     $omin_stay = $s_search_parametrs['omin_stay'];
	     $omax_stay = $s_search_parametrs['omax_stay'];
	     
	     $peoplethatare = $s_search_parametrs['peoplethatare'];
	     $oprofessionals = $s_search_parametrs['oprofessionals'];
	     
	    $country     = strtolower($s_search_parametrs['country']);
		$state       = strtolower($s_search_parametrs['state']);
		$city        = strtolower($s_search_parametrs['city']);
		$street      = strtolower($s_search_parametrs['street']);
		$postal_code = strtolower($s_search_parametrs['postal_code']);
		$searchsuburb  = strtolower($s_search_parametrs['searchsuburb']);
	  
		$flatmatespref_status = $s_search_parametrs['flatmatespref_status'];
		$search_by            = $s_search_parametrs['search_by'];
		      
		  $searchset_count='';
		  $searchset='';
     if($state){
        $state_path    ='"state":"'.$state.'"';
        $state_pattern = $state_path; 
        $searchset_count .=" LOWER(pfs.state) LIKE '%".$state."%' OR " ;
        }
       if($city){
        $city_path    ='"city":"'.$city.'"';
        $city_pattern =$city_path; 
        $searchset_count .="LOWER(pfs.city) LIKE '%".$city."%' OR ";
        }
       if($street){
         $street_path    ='"street":"'.$street.'"';
         $street_pattern =$street_path; 
         $searchset_count .="LOWER(pfs.street) LIKE '%".$street."%' OR ";
        }
       if($postal_code){
        $postal_path    ='"postal_code":"'.$postal_code.'"';
        $postal_pattern =$postal_path; 
        $searchset_count .="LOWER(pfs.postcode) LIKE '%".$postal_code."%' OR ";
        }
     	if($searchsuburb){
        $searchset_count .="LOWER(pfs.location) LIKE '%".$searchsuburb."%' OR ";    
        }	  
		 
		 // count total records	 
		 if($this->session->userdata('s_user_id')){
			
		    $this->db->where('uspr.account_id !=',$this->session->userdata('s_user_id'));
		  
        
       
		 if($searchset_count){
		      $searchset_count = rtrim($searchset_count,' OR '); 
		     $this->db->where("(".$searchset_count.") ");
		     }
	
	
	    $this->db->where('flprf.preference',$flatmatespref_status);       
		$this->db->join('users_flatmates_preferences flprf','flprf.profile_id=uspr.profile_id','LEFT'); 
		$this->db->join('property_for_search pfs','pfs.profile_id=uspr.profile_id','LEFT'); 
		$this->db->where('uspr.profile_type','1');  
		
		if($preferred_language==0)
		    $this->db->where_in('uspr.preferred_language',array('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15'));
		else
		 $this->db->where('uspr.preferred_language',$preferred_language);
		
		$this->db->where('uspr.profile_status','1');  
		$this->db->select('uspr.*');  
		$this->db->distinct();
	    $query = $this->db->get('users_profile uspr');
		$iTotalRecords = $query->num_rows();
		
		 }
		 else{
	
       
	    
		 if($searchset_count){
		      $searchset_count = rtrim($searchset_count,' OR '); 
		     $this->db->where("(".$searchset_count.") ");
		     }
		$this->db->where('flprf.preference',$flatmatespref_status);       
		$this->db->join('users_flatmates_preferences flprf','flprf.profile_id=uspr.profile_id','LEFT'); 
		$this->db->join('property_for_search pfs','pfs.profile_id=uspr.profile_id','LEFT');
		$this->db->where('uspr.profile_type','1');  
		if($preferred_language==0)
		    $this->db->where_in('uspr.preferred_language',array('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15'));
		else
		 $this->db->where('uspr.preferred_language',$preferred_language);
		$this->db->where('uspr.profile_status','1');  
		$this->db->select('uspr.*');  
		$this->db->distinct();
	    $query = $this->db->get('users_profile uspr');
	    
	   
		$iTotalRecords = $query->num_rows();
		
		}
		
	  // main query	
		
     $this->db->limit($length,$start);
   
	 if($searchset_count){
		    $searchset_count = rtrim($searchset_count,' OR '); 
		    $this->db->where("(".$searchset_count.") ");
		     }
   
   	  if($omin_age && $omax_age){
   	     $this->db->where('uspr.me_age >=',$omin_age); 
   	     $this->db->where('uspr.me_age <=',$omax_age);
   	  }   
     elseif($omin_age){
   	     $this->db->where('uspr.me_age',$omin_age); 
   	  } 
     elseif($omax_age){
   	     $this->db->where('uspr.me_age',$omax_age); 
   	  } 
   	  
   	 if( $oavailable_from ){
   	     $oavailable_from = date("Y-m-d",strtotime($oavailable_from));
   	     $this->db->where('uspr.preferred_move_date',$oavailable_from); 
     }
      if( $opeoplelookingfor ){
   	     if($opeoplelookingfor==0)
   	     $this->db->where_in('uspr.place_looking_for',array('1','2','3','4','5','6','7','8')); 
   	     else
   	     $this->db->where('uspr.place_looking_for',$opeoplelookingfor); 
   	     
     }
    
     if($peoplethatare){
         if($peoplethatare==0)
   	       $this->db->where_in('uspr.life_style',array('2','4','3','1')); 
   	     elseif($peoplethatare==4) 
   	        $this->db->where('uspr.life_style !=','4');
   	    elseif($peoplethatare==3) 
   	        $this->db->where('uspr.life_style !=','3');    
   	    elseif($peoplethatare==5) 
   	        $this->db->where('uspr.life_style !=','1');
   	    else
   	     $this->db->where('uspr.life_style',$peoplethatare);
   	  }   
     
   	 if($oprofessionals)
   	     $this->db->where('uspr.employment_status',$oprofessionals); 
   	  
   	  
     if($this->session->userdata('s_user_id'))
          $this->db->where('uspr.account_id !=',$this->session->userdata('s_user_id'));


	  $this->db->where('flprf.preference',$flatmatespref_status);  
	  $this->db->join('users_flatmates_preferences flprf','flprf.profile_id=uspr.profile_id','LEFT'); 
	  $this->db->join('property_for_search pfs','pfs.profile_id=uspr.profile_id','LEFT'); 
	  $this->db->where('uspr.profile_type','1');
	  if($preferred_language==0)
		    $this->db->where_in('uspr.preferred_language',array('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15'));
		else
		 $this->db->where('uspr.preferred_language',$preferred_language);
	  $query = $this->db->get('users_profile uspr'); 
	  $result = $query->result();
      $final_result= array('iTotalRecords'=>$iTotalRecords,'result'=>$result);
        return $final_result;
      
  } 
  
   function teamups_query($s_search_parametrs,$length,$start){
     	 $omin_age = $s_search_parametrs['omin_age'];
	     $omax_age = $s_search_parametrs['omax_age'];
	     $omin_rent = $s_search_parametrs['omin_rent'];
	     $omax_rent = $s_search_parametrs['omax_rent'];
	     $oavailable_from = $s_search_parametrs['oavailable_from'];
	     $opeoplelookingfor = $s_search_parametrs['opeoplelookingfor'];
	     $preferred_language = $s_search_parametrs['spreferred_language'];
	     
	     $omin_stay = $s_search_parametrs['omin_stay'];
	     $omax_stay = $s_search_parametrs['omax_stay'];
	     
	     $searchsuburb  = strtolower($s_search_parametrs['searchsuburb']);
	     
	     $peoplethatare = $s_search_parametrs['peoplethatare'];
	     $oprofessionals = $s_search_parametrs['oprofessionals'];
	     
	    $country     = strtolower($s_search_parametrs['country']);
		$state       = strtolower($s_search_parametrs['state']);
		$city        = strtolower($s_search_parametrs['city']);
		$street      = strtolower($s_search_parametrs['street']);
		$postal_code = strtolower($s_search_parametrs['postal_code']);
		
	  
		$flatmatespref_status = $s_search_parametrs['flatmatespref_status'];
		$search_by            = $s_search_parametrs['search_by'];
		      
		  $searchset_count='';
		  $searchset='';
		  
		 
             if($state){
        $state_path    ='"state":"'.$state.'"';
        $state_pattern = $state_path; 
        $searchset_count .=" LOWER(pfs.state) LIKE '%".$state."%' OR " ;
        }
       if($city){
        $city_path    ='"city":"'.$city.'"';
        $city_pattern =$city_path; 
        $searchset_count .="LOWER(pfs.city) LIKE '%".$city."%' OR ";
        }
       if($street){
         $street_path    ='"street":"'.$street.'"';
         $street_pattern =$street_path; 
         $searchset_count .="LOWER(pfs.street) LIKE '%".$street."%' OR ";
        }
       if($postal_code){
        $postal_path    ='"postal_code":"'.$postal_code.'"';
        $postal_pattern =$postal_path; 
        $searchset_count .="LOWER(pfs.postcode) LIKE '%".$postal_code."%' OR ";
        }
     	if($searchsuburb){
        $searchset_count .="LOWER(pfs.location) LIKE '%".$searchsuburb."%' OR ";    
        }
	
	
		 // count total records	 
		 if($this->session->userdata('s_user_id')){
			
		    $this->db->where('uspr.account_id !=',$this->session->userdata('s_user_id'));
		  
       
		
		 if($searchset_count){
		      $searchset_count = rtrim($searchset_count,' OR '); 
		     $this->db->where("(".$searchset_count.") ");
		     }
	
	
	    $this->db->where('flprf.preference',$flatmatespref_status);       
		$this->db->join('users_flatmates_preferences flprf','flprf.profile_id=uspr.profile_id','LEFT'); 
		$this->db->join('property_for_search pfs','pfs.profile_id=uspr.profile_id','LEFT'); 
		$this->db->where('uspr.profile_type','1');  
		$this->db->where('uspr.profile_status','1'); 
		if($preferred_language==0)
		    $this->db->where_in('uspr.preferred_language',array('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15'));
		else
		 $this->db->where('uspr.preferred_language',$preferred_language);
		$this->db->where('uspr.teamups','1');
		$this->db->select('uspr.*');  
		$this->db->distinct();
	    $query = $this->db->get('users_profile uspr');
		$iTotalRecords = $query->num_rows();
		
		 }
		 else{
	
        
      
	    
		 if($searchset_count){
		      $searchset_count = rtrim($searchset_count,' OR '); 
		     $this->db->where("(".$searchset_count.") ");
		     }
		$this->db->where('flprf.preference',$flatmatespref_status);       
		$this->db->join('users_flatmates_preferences flprf','flprf.profile_id=uspr.profile_id','LEFT'); 
		$this->db->join('property_for_search pfs','pfs.profile_id=uspr.profile_id','LEFT');
		$this->db->where('uspr.profile_type','1');  
		$this->db->where('uspr.profile_status','1'); 
		if($preferred_language==0)
		    $this->db->where_in('uspr.preferred_language',array('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15'));
		else
		 $this->db->where('uspr.preferred_language',$preferred_language);
		$this->db->where('uspr.teamups','1');
		$this->db->select('uspr.*');  
		$this->db->distinct();
	    $query = $this->db->get('users_profile uspr');
	    
	   
		$iTotalRecords = $query->num_rows();
		
		}
		
		
	  // main query	
		
          $this->db->limit($length,$start);
   
		     
	 if($searchset_count){
		    $searchset_count = rtrim($searchset_count,' OR '); 
		    $this->db->where("(".$searchset_count.") ");
		     }
   
   	  if($omin_age && $omax_age){
   	     $this->db->where('uspr.me_age >=',$omin_age); 
   	     $this->db->where('uspr.me_age <=',$omax_age);
   	  }   
     elseif($omin_age){
   	     $this->db->where('uspr.me_age',$omin_age); 
   	  } 
     elseif($omax_age){
   	     $this->db->where('uspr.me_age',$omax_age); 
   	  } 
   	  
   	 if( $oavailable_from ){
   	     $oavailable_from = date("Y-m-d",strtotime($oavailable_from));
   	     $this->db->where('uspr.preferred_move_date',$oavailable_from); 
     }
      if( $opeoplelookingfor ){
   	     if($opeoplelookingfor==0)
   	     $this->db->where_in('uspr.place_looking_for',array('1','2','3','4','5','6','7','8')); 
   	     else
   	     $this->db->where('uspr.place_looking_for',$opeoplelookingfor); 
   	     
     }
    
     if($peoplethatare){
         if($peoplethatare==0)
   	       $this->db->where_in('uspr.life_style',array('2','4','3','1')); 
   	     elseif($peoplethatare==4) 
   	        $this->db->where('uspr.life_style !=','4');
   	    elseif($peoplethatare==3) 
   	        $this->db->where('uspr.life_style !=','3');    
   	    elseif($peoplethatare==5) 
   	        $this->db->where('uspr.life_style !=','1');
   	    else
   	     $this->db->where('uspr.life_style',$peoplethatare);
   	  }   
     
   	 if($oprofessionals)
   	     $this->db->where('uspr.employment_status',$oprofessionals); 
   	  
   	  
     if($this->session->userdata('s_user_id'))
          $this->db->where('uspr.account_id !=',$this->session->userdata('s_user_id'));


		      $this->db->where('flprf.preference',$flatmatespref_status);  
		      $this->db->join('users_flatmates_preferences flprf','flprf.profile_id=uspr.profile_id','LEFT');
		      $this->db->join('property_for_search pfs','pfs.profile_id=uspr.profile_id','LEFT'); 
		      $this->db->where('uspr.profile_type','1');
		      if($preferred_language==0)
		    $this->db->where_in('uspr.preferred_language',array('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15'));
		else
		 $this->db->where('uspr.preferred_language',$preferred_language);
		      $this->db->where('uspr.teamups','1');
		  $query = $this->db->get('users_profile uspr'); 
		  $result = $query->result();
        $final_result= array('iTotalRecords'=>$iTotalRecords,'result'=>$result);
        return $final_result;
      
  } 
    
   function searchListingResult($limit){
        
        $s_search_parametrs = $this->session->userdata('s_search_parametrs');
   		if(isset($_GET['start'])){	
		$search_text = $_GET['search'];
		$length      = $_GET['length'];
		}
		else{
		$search_text='';		
		if($limit)
		 $length=$limit;
		else
		$length=9;
		}
		$start=($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		
		// Rooms = 1, Flatmates = 2, Teamups = 3
		$status_type = $s_search_parametrs['status_type'];
  
    if($status_type==1){ //Rooms
         $records = $this->rooms_query($s_search_parametrs,$length,$start);
         $iTotalRecords =$records['iTotalRecords'];
         $result =$records['result'];
		}
		
	elseif($status_type==2){ //Flatmates
          $records = $this->flatmates_query($s_search_parametrs,$length,$start);
          $iTotalRecords =$records['iTotalRecords'];
          $result =$records['result'];
		}
	
    elseif($status_type==2){ //Teamups
          $records = $this->teamups_query($s_search_parametrs,$length,$start);
          $iTotalRecords =$records['iTotalRecords'];
          $result =$records['result'];
		}
   else
     $result =array();
     
		$records = array();
		$records["data"] = array();
		$id = 0;
		
		if($result){
		foreach($result as $values)
			{
			
			$profile_info          = $this->common_model->getProfileInfo($values->profile_id);	
			$profile_photo_info    = $this->common_model->get_user_photo($values->profile_id);
			$property_address_info = $this->common_model->property_address_info($values->profile_id);
			$homedes_rentbondbills = $this->common_model->homedes_rentbondbills($values->profile_id);
		    $homedes_rooms         = $this->common_model->homedes_rooms($values->profile_id);
		    $profile_type          = $profile_info->profile_type;
			    
			if( $profile_type==1){
			    
			      if($profile_photo_info){
			            $photo ='<img src="'.base_url().CNTPHT_THUMB.$profile_photo_info->photo.'" alt="#"/>'; 
			            $photo_path = base_url().CNTPHT_MINI.$profile_photo_info->photo;
			      }
		           else
			            $photo=$photo_path = ''; 
			        
			    }
			 else  if( $profile_type==2){
			       if($profile_photo_info){
			            $photo ='<img src="'.base_url().HMEPHT_THUMB.$profile_photo_info->photo.'" alt="#"/>'; 
			            $photo_path = base_url().HMEPHT_THUMB.$profile_photo_info->photo;
			       }
		            
		           else
			            $photo=$photo_path = '';   
			        
			    } 
			    
			    $records["data"][] = array(				
			    	'suburb'        =>$profile_info->suburb,
			    	'first_name'    =>$profile_info->me_firstname,
			    	'photo'         => $photo,
			    	'photo_path'    =>$photo_path,
			    	'listing_id'    =>$values->profile_id,
                  	'age'           =>$profile_info->me_age,
                  	'property_type'    =>$values->property_type,
			    	'gender'        =>$profile_info->me_gender,
			    	'about_yourself'=>$profile_info->great_live_with_text,
			    	'weekly_budget' =>$profile_info->weekly_budget,
			    	'property_address_info'=>$property_address_info,
			    	'homedes_rooms' =>$homedes_rooms,
			    	'rentbondbills' =>$homedes_rentbondbills,
			    	'profile_type'  =>$profile_type,
			    	'profile_status'=>$profile_info->profile_status
			   );
		
	    }

		$config = array();
        $config["base_url"] = base_url().'listings';
        $config["total_rows"] = $iTotalRecords;
        $config["per_page"] = $length;
        $config["uri_segment"] = 2;
        $config['full_tag_open'] = '<nav aria-label="Page navigation" class="alinment d-table"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
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
		else
		return false;
        
    }     
    
  function ajax_listings_list($user_id){			
		if(isset($_GET['start'])){	
		$search_text = $_GET['search'];
		$length      = $_GET['length'];
		}
		else{
		$search_text='';			
		$length=10;
		}
		$start=($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		$sql = "SELECT * FROM users_profile  WHERE account_id='".(int)$user_id."' ";	
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
			//$del_path = customer_path() . 'listings/delete/' . $values->profile_id;
			$user_actions = '<div class="message_action color-default-a mt-2">													
													<a href="' . customer_path() . 'listing/preview/' . $values->profile_id . '" class="" title="Edit Listing"><i class="icofont icofont-ui-edit"></i>View </a>
												
											</div>';
		

			
			if($values->profile_type=='1'){
			    $location_info='';
			   
			   		if($customer_photo_info){
		    if($customer_photo_info->photo!='')
		      $customer_photo_path = '<img src="'.base_url().CNTPHT_THUMB.$customer_photo_info->photo.'" alt="#" />';
		   else
		     $customer_photo_path = '';
		    
		}										
		 else
		     $customer_photo_path = ''; 
			    
			 $profile_type='Looking for a home';
			 
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
			    $location_info='';
			    	if($customer_photo_info){
		    if($customer_photo_info->photo!='')
		      $customer_photo_path = '<img src="'.base_url().HMEPHT_THUMB.$customer_photo_info->photo.'" alt="#" />';
		   else
		     $customer_photo_path = '';
		    
		}										
		 else
		     $customer_photo_path = ''; 
			    
			 $property_address_info = $this->common_model->property_address_info($values->profile_id);   
			 if($property_address_info){
			     $location = $property_address_info->property_address;
			      $location = json_decode( $location);
			      if($location && isset($location[0]))
			      $location_info =  $location[0]->location;
			      else
			      $location_info='';
			     
			 }   
			 $profile_type='Offering a home';	
			}
			
			
			$records["data"][] = array(		
			    'profile_id'=>$values->profile_id,
				'full_name'=>ucwords($full_name),
                'photo' =>$customer_photo_path,
				'mobile_no' =>$mobile_no,
				'profile_type'     =>$profile_type,
				'property_type'    =>$values->property_type,
				'profile_status'     =>$values->profile_status,
				'user_actions'=>$user_actions,
				'locations' => $location_info,
				'listing_confirmed'=>$values->listing_confirmed,
				'entry_date'=>date('d M, Y',strtotime($values->entry_time))
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
  
  function deleteListingPhoto($photo_id,$profile_id){

	   $this->db->where("photo_id",$photo_id);
	   $this->db->where("profile_id",$profile_id);	
	   $this->db->delete("users_photos");
	   return TRUE;	   
   }
  
  function update_home_request_info(){
       // list my place
	   if($_POST){
	       
			  // What type of accommodation are you offering?
			  $accommodation_offering = $this->input->post('accommodation_offering');
			  
			  $user_id = $this->session->userdata('s_user_id');
			  
			  if($accommodation_offering=='1')
			  $property_type = $this->input->post('property_type');
			  else if($accommodation_offering=='2')
			  $property_type = $this->input->post('type_of_property');
			  else
			  $property_type =''; 
		      $insert_data =array("account_id"=>$user_id,"profile_type"=>"2",
			  					  "accommodation_offering"=>$accommodation_offering,"entry_time"=>date('Y-m-d H:i:s'),
								  "ip_address"=>ip_address(),'property_type'=>$property_type	);
	          $this->db->insert("users_profile",$insert_data);			  
			  $profile_id = $this->db->insert_id();		  
		
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
                  $country_lists = $country;
                  
              }else
              $country_lists='';
              
              
              $latitude      = $this->input->post("latitude");
              if(isset($latitude)){
                  $latitude_lists =$latitude;
                  
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
                  $city_lists = $city;
                  
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
	               
	               $this->room_features_request($room_counter,$room_id,$profile_id);
	               $this->rentbondbills_request($room_counter,$room_id,$profile_id);
	               $this->roomavailability_request($room_counter,$room_id,$profile_id);
	               $this->flatmatepreference_request($room_counter,$room_id,$profile_id);
	               
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

		
		
		
			   ########################   What's great about living at this property?   ##############################
			  $great_live_with_text = $this->input->post('great_live_with_text');
			  		    
		      $update_data =array("great_live_with_text"=>$great_live_with_text);
	          $this->db->where("profile_id",$profile_id);				   
	          $this->db->update("users_profile",$update_data);
			  
			  
			   ########################   Photos   ##############################
			  $this->upload_home_photos($profile_id);
		  
		    	   
	   }
	   $this->message_output->set_success('Information has been added.', TRUE);
	   return $profile_id;
   }	
   
   
  function update_request_info(){
      // find a place
	   if($_POST){
	      
		      $user_id = $this->session->userdata('s_user_id');
			  // What type of place are you looking for
			  $place_looking_for = $this->input->post('place_looking_for');
			  if($place_looking_for){
				$place_looking_for = implode(",",$place_looking_for);  
			  }
			  else
			  $place_looking_for='';
			  
			  if($this->input->post('teamups'))
			  $teamups  = 1;
			  else
			  $teamups  = 0;
			  $insert_data =array("account_id"=>$user_id,"profile_type"=>"1","teamups"=>$teamups,
			  					  "place_looking_for"=>$place_looking_for,"entry_time"=>date('Y-m-d H:i:s'),
								  "ip_address"=>ip_address()	);
	          $this->db->insert("users_profile",$insert_data);			  
			  $profile_id = $this->db->insert_id();	
			  
		  
		 
			  // Where would you like to live?
		     $home_address  = $this->input->post("home_address");
             
             
              $country       = $this->input->post("country");
              
             
               $street_number = $this->input->post("street");
              if(isset($street_number[0])){
                  $street_number = explode(",",$street_number[0]);
                  
              }else
              $street_number='';
              
             
              
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
             
              if(isset($country[0])){
                 $country_info = explode(",",rtrim($country[0],","));
                  foreach($country_info as $country_key => $country_val){
                    
                    
                     if($latitude_lists)
                            $latitude_val =$latitude_lists[$country_key];
                      else
                           $latitude_val='';
                           
                   
                     if($longitude_lists)
                            $longitude_val =$longitude_lists[$country_key];
                      else
                           $longitude_val='';

                           
                    if($state_lists)
                            $state_val =$state_lists[$country_key];
                      else
                           $state_val='';
                    
                      if($street_number!='' && isset($street_number[$country_key]))
                            $street_number_val =$street_number[$country_key];
                      else
                           $street_number_val='na';       

                           
                    if($city_lists)
                            $city_val =$city_lists[$country_key];
                      else
                           $city_val='';

                    if($postal_code_lists)
                            $postal_code_val =$postal_code_lists[$country_key];
                      else
                           $postal_code_val='';

                          
                      $home_address_val =     $home_address[$country_key]; 
                      
                       $final_suburb[]=array('location'=>$home_address_val,'street'=>$street_number_val,
                                             'country'=>$country_val,'state'=>$state_val,'city'=>$city_val,'postal_code'=>$postal_code_val,
                                             'latitude'=>$latitude_val,'longitude'=>$longitude_val);
                      
                  }
                  
              }
              
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
              
              
			   $update_data =array("suburb"=>$final_suburb);
	          $this->db->where("profile_id",$profile_id);				   
	          $this->db->update("users_profile",$update_data); 
              
             
		   
			  // Rent and timing 
		      $weekly_budget       = $this->input->post('weekly_budget');
			  $preferred_move_date = $this->input->post('preferred_move_date');
			  $length_of_stay      = $this->input->post('length_of_stay');
			 
		      $update_data =array("weekly_budget"=>$weekly_budget,'preferred_move_date'=>$preferred_move_date,
			                      "length_of_stay"=>$length_of_stay);
	          $this->db->where("profile_id",$profile_id);				   
	          $this->db->update("users_profile",$update_data);
		    
		
			  // Property preferences
		      $room_furnishings   = $this->input->post('room_furnishings');
			  $internet 		  = $this->input->post('internet');
			  $bathroom_type      = $this->input->post('bathroom_type');
			  $parking 		      = $this->input->post('parking');
			  $no_of_flatmates    = $this->input->post('no_of_flatmates');
			 
			  $users_preferences_exist = $this->db->where('profile_id',$profile_id)->count_all_results('users_preferences');
			  if($users_preferences_exist ==0){
			     $insert_data =array("room_furnishings"=>$room_furnishings,"internet"=>$internet,"bathroom_type"=>$bathroom_type,
			  					  "parking"=>$parking,"no_of_flatmates"=>$no_of_flatmates,"profile_id"=>$profile_id,"entry_time"=>date('Y-m-d H:i:s'),
			  					  "ip_address"=>ip_address());
	            $this->db->insert("users_preferences",$insert_data);  
			      
			  }
			  else{
			   $update_data =array("room_furnishings"=>$room_furnishings,"internet"=>$internet,"bathroom_type"=>$bathroom_type,
			  					  "parking"=>$parking,"no_of_flatmates"=>$no_of_flatmates);
	           $this->db->where("profile_id",$profile_id);				   
	           $this->db->update("users_preferences",$update_data);    
			      
			  }
			  
			  
		 // users flatmates preferences & accepting & preferred language
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
		
		
			  // Employment Status
		      $employment_status =implode(",",$this->input->post('employment_status'));
			  $employment_status = rtrim($employment_status,",");
			  
			  $life_style =implode(",",$this->input->post('lifestyle_status'));
			  $life_style = rtrim($life_style,",");
			  
		      $update_data =array("employment_status"=>$employment_status,"life_style"=>$life_style);
	          $this->db->where("profile_id",$profile_id);				   
	          $this->db->update("users_profile",$update_data);
			
		    // Your employment situation
		      $great_live_with_text =$this->input->post('great_live_with_text');			 
		      $update_data =array("great_live_with_text"=>$great_live_with_text);
	          $this->db->where("profile_id",$profile_id);				   
	          $this->db->update("users_profile",$update_data);
	          
	          
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
								     $this->createContactThumbnail($data_file['file_name']);
								    $this->createContactMini($data_file['file_name']);
							 $this->db->where("profile_id",$profile_id);
					          $this->db->delete('users_photos');
					   
								$attachment_file  =  $data_file['file_name'];
								
								 $document_path    = CNTPHT.$attachment_file;
		      		
		                    	  $this->db->query("INSERT INTO users_photos SET profile_id='".(int)$profile_id."',photo = '" . $attachment_file."',entry_time = '" . date('Y-m-d H:i:s') . "',ip_address ='".ip_address()."'"); 
			  
		                    	 
							
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
								    $this->createContactMini($data_file['file_name']);
		                        	
		                    	  $this->db->query("INSERT INTO users_photos SET profile_id='".(int)$profile_id."',photo = '" . $attachment_file."',entry_time = '" . date('Y-m-d H:i:s') . "',ip_address ='".ip_address()."'"); 
			  
		                    	
							
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
								    $this->createContactMini($data_file['file_name']);  
		                        	
		                    	  $this->db->query("INSERT INTO users_photos SET profile_id='".(int)$profile_id."',photo = '" . $attachment_file."',entry_time = '" . date('Y-m-d H:i:s') . "',ip_address ='".ip_address()."'"); 
			  
		                    	 
							
								}
							 }
						}
						
			      $update_data  = array("me_firstname"=>$me_firstname,"me_age"=>$me_age,"me_gender"=>$me_gender);
		          $this->db->where("profile_id",$profile_id);				   
		          $this->db->update("users_profile",$update_data);
				  				 
				  $friends_firstname = $this->input->post('friends_firstname');
				  $friends_age       = $this->input->post('friends_age');
				  $friends_gender    = $this->input->post('friends_gender');
				  
				  				  
				  if($friends_firstname && is_array($friends_firstname)){
					  $this->db->where("profile_id",$profile_id);
					  $this->db->delete('users_introduce_yourself_group');
					  
					  $grpcounter=0;
				      foreach($friends_firstname as $namekey => $nameval){
				          
				          
				      if($nameval!=''){
				          
					   $friends_age_val         =  $friends_age[$namekey];
				       $friends_gender_val      = $friends_gender[$namekey];
			           $insert_data  = array("profile_id"=>$profile_id,"friends_name"=>$nameval,"age"=>$friends_age_val,"gender_identify"=>$friends_gender_val);		        
		               $this->db->insert("users_introduce_yourself_group",$insert_data);  
				      }
		           $grpcounter++;
				  }
				  
				  }
      	  }
  
		   
     	    ########################   Photos   ##############################
	    	if ($_FILES['profile_pic']['name'] != ''){
						$config['upload_path']    = $this->contact_main_photo;
						$config['allowed_types']  = '*';
						$config['max_size']       = '4024';
						$config['encrypt_name']   = TRUE;
						$this->upload->initialize($config);
						if ($this->upload->do_upload('profile_pic'))
							{
							$data_file = $this->upload->data();
							if (isset($data_file)){
							 $this->db->where("profile_id",$profile_id);
					         $this->db->delete('users_photos');
							 $attachment_file  =  $data_file['file_name'];
							 $document_path    = CNTPHT.$attachment_file;
		                   	 $this->createContactThumbnail($data_file['file_name']);
								    $this->createContactMini($data_file['file_name']);	
		                     $this->db->query("INSERT INTO users_photos SET profile_id='".(int)$profile_id."',photo = '" . $attachment_file."',entry_time = '" . date('Y-m-d H:i:s') . "',ip_address ='".ip_address()."'"); 
			               
								}
							 }
						}
	   }
	   return $profile_id;	   
   }	 
  
 	function createContactThumbnail($filename)	{
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

	function createContactMini($filename)	{
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
  
  	function createHomePhotoThumbnail($filename)	{
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
  
  
   function upload_home_photos($profile_id){
       
        if($this->session->userdata('s_temp_images')){
            
            
        }
    
       die();
       
      $this->createHomePhotoThumbnail($attachment_file);
     $this->db->query("INSERT INTO users_photos SET profile_id='".(int)$profile_id."',photo = '" . $attachment_file."',entry_time = '" . date('Y-m-d H:i:s') . "',ip_address ='".ip_address()."'"); 
 
   }
  
  function upload_home_photos_old($profile_id){
	  	$uploadData=array();
		$data = array();
		
		if($_FILES['files']['name']){
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
			$config['encrypt_name'] = TRUE;
			
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
		      
		      $this->createHomePhotoThumbnail($attachment_file);
		      	
			  $this->db->query("INSERT INTO users_photos SET profile_id='".(int)$profile_id."',photo = '" . $attachment_file."',entry_time = '" . date('Y-m-d H:i:s') . "',ip_address ='".ip_address()."'"); 
			}
		 }
		}		
		
		}
	  
	} 
	
  function getListingInformation($profile_id) {	 
		$query = $this->db->query("SELECT  * FROM  users_profile  WHERE profile_id = '" . (int)$profile_id . "'");
		return $query->row();
	}	
  function getPhotos($profile_id) {
	 
		$query = $this->db->query("SELECT  * FROM  users_photos WHERE profile_id = '" . (int)$profile_id . "'");
		return $query->result();
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

  function getFlatmatesPreferences($profile_id) {
	 
		$query = $this->db->query("SELECT  * FROM  homedes_flatmates_preferences WHERE profile_id = '" . (int)$profile_id . "'");
		return $query->result();
	} 

 function getUsersFlatmatesPreferences($profile_id) {
	 
		$query = $this->db->query("SELECT  * FROM  users_flatmates_preferences WHERE profile_id = '" . (int)$profile_id . "'");
		return $query->row();
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
								    $this->createContactMini($data_file['file_name']); 
								 	 
		      
		                         
		                    	  $this->db->query("INSERT INTO users_photos SET profile_id='".(int)$profile_id."',photo = '" . $attachment_file."',entry_time = '" . date('Y-m-d H:i:s') . "',ip_address ='".ip_address()."'"); 
			  
		                    	 
							
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
								    $this->createContactMini($data_file['file_name']); 
		      
		                          $this->db->query("INSERT INTO users_photos SET profile_id='".(int)$profile_id."',photo = '" . $attachment_file."',entry_time = '" . date('Y-m-d H:i:s') . "',ip_address ='".ip_address()."'"); 
			  
							
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
								    $this->createContactMini($data_file['file_name']); 
		      
		                          $this->db->query("INSERT INTO users_photos SET profile_id='".(int)$profile_id."',photo = '" . $attachment_file."',entry_time = '" . date('Y-m-d H:i:s') . "',ip_address ='".ip_address()."'"); 
			  
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
              $update_data =array("suburb"=>$final_suburb);
	          $this->db->where("profile_id",$profile_id);				   
	          $this->db->update("users_profile",$update_data); 
        
    }
	
  function confirm_listing() {
       $profile_id = $this->session->userdata('u_l_list_id');
	   $mobile_no = $this->session->userdata('s_sms_mobile');
	   
	   $this->db->where('otp',$this->input->post('sms_code'));
	   $query = $this->db->get('otp_log');
	   if($query->num_rows() >0 ){
	     $this->db->where('profile_id',$profile_id);  
	     $this->db->update('users_profile',array('listing_confirmed'=>1,'mobile_no'=>$mobile_no));
	     $this->session->unset_userdata('s_sms_mobile');
	     $this->session->unset_userdata('u_l_list_id');
	     return "success";   
	   }
	   else{
	     return "error"; 
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
			   $user_id = $this->session->userdata('s_user_id');
			  if($accommodation_offering){
			      foreach($accommodation_offering as $accommodation_offering_val){
			          
			         $accommodation_offering_list .= $accommodation_offering_val.',';
			      }
			      
			  }
			  $accommodation_offering_list = rtrim($accommodation_offering_list,",");
			
		      $update_data =array(
			  					  "accommodation_offering"=>$accommodation_offering_list	);
			  $this->db->where('profile_id',$profile_id);	
			  $this->db->where('account_id',$user_id);
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

   function send_mobile_code(){
     $mobile_no        = $this->input->post('mobile_no');
     if($mobile_no){
     $otp_info         = generateNumericOTP(6); 
     
     
     $insert_data      = array('mobile_no'=>'+61'.$mobile_no,'otp'=>$otp_info,'entry_time'=>date('Y-m-d H:i:s'));
     $this->db->insert('otp_log',$insert_data); 
     
     send_sms_international('+61'.$mobile_no,'Your listing confirmation code is:'.$otp_info.'');
     
     
     $this->session->unset_userdata('s_sms_mobile');
     $this->session->set_userdata('s_sms_mobile',$mobile_no);
     
     $attributes = array('id' => 'verifycode_frm','name' => 'verifycode_frm','novalidate'=>'','class' => '','autocomplete' => 'off');
     $data = array('class' =>'form-control', 'name'=> 'sms_code','required'=>'true',  'id'=> 'sms_code');
     $return_div =''.form_open('#', $attributes).'
 <div class="full-row deshbord_panel w-100 mb-5">
  <h4 class="color-primary mb-6">Verify SMS Code</h4>
  <div class="submit_form color-secondery icon_primary p-5 bg-white">
    <div class="description">
      '.$this->message_output->run().'
      
      <div class="row">
        <div class="col-lg-6 col-md-6">
          <div class="form-group">
            <label>Code</label>
            <span class="ml-2 fa-2x"></span>'.form_input($data).'
          </div>
        </div>        
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group text-center">
        <button type="button" id="smscode_btn" class="btn btn-default1">Submit</button>
      </div>
    </div>
  </div>
</div>'.form_close().'';
     
     return $return_div;
     }
 }

	function get_listing_steps(){
	    if($_POST){
	        $total_room = $_POST['tcounter'];
	        
	        if(isset($_POST['placeid'])){
	         $plcid=   $_POST['placeid'];
	            
	        }
	        else{
	          $plcid='';   
	            
	        }
	        if($total_room=='' || $total_room==0)
           	    $total_room=1;    
	         $step_type  = $_POST['step_type'];
	         if($step_type=='about_property'){
	            if($plcid==2){ 
	                $roomfurnishings_status = $this->config->item('roomfurnishings_status');
	               $action_status_div ='<div class="form-group">
                <label>Room furnishings</label>'.form_dropdown('roomfurnishings_status', $roomfurnishings_status,set_value('roomfurnishings_status'),'class="form-control" ').'
              </div>';  
	            }
	            else{
	                $total_flatmates = $this->config->item('total_flatmates');	
                    $action_status_div ='<div class="form-group">
                <label>Total number of flatmates<br>
                  <span class="help">Once all rooms are rented</span></label>'.form_dropdown('total_flatmates', $total_flatmates,set_value('total_flatmates'),'class="form-control" ').'
              </div>';  
	            }
	            
              
	          return array("html"=>$action_status_div);       
	        }
	        
	        if($step_type=='room_features'){
	             if($plcid==2){
	                $bond_status = $this->config->item('bond_status');	
                   $bills_status = $this->config->item('bills_status');
                
                
                
                $rentbondbills_div ='';
	            for($i=1;$i<=$total_room;$i++){
	               $data = array('class' =>'form-control validnumber', 'name'=> 'weekly_rent['.$i.']', 'id'=> 'weekly_rent'.$i.'',"required"=>"true","value"=>'');
 $rentbondbills_div .='<div class="form-header">
            <h3>Room '.$i.' Rent, bond and bills</h3>
          </div>
          <div class="row" id="rentbond_bills_div">
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
                <label>Weekly rent</label>'.form_input($data).'</div>
            </div>
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
                <label>Bond</label>'.form_dropdown('bond['.$i.']', $bond_status,'','class="form-control" ').'
              </div>
            </div>
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
                <label>Bills</label>'.form_dropdown('bills['.$i.']', $bills_status,'','class="form-control" ').'
              </div>
            </div>
          </div><hr>';  
	            }   
	             return array("html"=>$rentbondbills_div);   
	             }
	             else{ 
        	          $bedsize_status = $this->config->item('bedsize_status');
                      $room_furnishing_features = $this->config->item('room_furnishing_features');
                      $roomtypes_status_config = $this->config->item('roomtypes_status');
                      $room_features_div='';  
                      
                      $rooms_types = $this->input->post('room_types_values');
        	            
        	          for($i=1;$i<=$total_room;$i++){
        	              $roomcounter_val=$i-1;
        	              $rooms_types_name =$rooms_types[$roomcounter_val]['value'];
        	              
        	           $room_furnishing_features_div='';
                                 if($room_furnishing_features){
        				  foreach($room_furnishing_features as $room_furnishing_key =>  $room_furnishing_val){					 
        				 $room_furnishing_features_div .='
                          <div class="col-lg-4 col-md-4">
                           <ul class="check_submit"> 
                          <li>
                            <input type="checkbox" name="furnishings_features['.$i.'][]" class="hide" id="room_furnishing_features'.$room_furnishing_key.$i.'" value="'.$room_furnishing_key.'">
                            <label for="room_furnishing_features'.$room_furnishing_key.$i.'">'.$room_furnishing_val.'</label>
                          </li>
                          </ul>
                          </div>';
                           } } 
        
                $room_features_div .='<div class="form-header">
                    <h3>'.$roomtypes_status_config[$rooms_types_name].' Room '.$i.' Features</h3>
                  </div>
                  <div class="row" id="room_features_div">
                    <div class="col-lg-12 col-md-12">
                      <div class="form-group">
                        <label>Bed Size</label>'.form_dropdown('bed_size['.$i.']', $bedsize_status,'','class="form-control" ').'
                      </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                      <div class="form-group">
                        <label>Room furnishings and features</label>
                       <div class="row">
                          '.$room_furnishing_features_div.'
                          </div>
                       
                      </div>
                    </div>
                  </div>';   
        	          }
        	           return array("html"=>$room_features_div);  
        	        }
	              
	        }
	        if($step_type=='rentbondbills'){
	            $bond_status = $this->config->item('bond_status');	
                $bills_status = $this->config->item('bills_status');
                $roomtypes_status_config = $this->config->item('roomtypes_status');
                $rentbondbills_div ='';
                $rooms_types = $this->input->post('room_types_values');
        	            
	            for($i=1;$i<=$total_room;$i++){
	                 $roomcounter_val=$i-1;
        	              $rooms_types_name =$rooms_types[$roomcounter_val]['value'];
	               $data = array('class' =>'form-control validnumber', 'name'=> 'weekly_rent['.$i.']', 'id'=> 'weekly_rent'.$i.'',"required"=>"true","value"=>'');
 $rentbondbills_div .='<div class="form-header">
            <h3>'.$roomtypes_status_config[$rooms_types_name].' Room '.$i.' Rent, bond and bills</h3>
          </div>
          <div class="row" id="rentbond_bills_div">
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
                <label>Weekly rent</label>'.form_input($data).'</div>
            </div>
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
                <label>Bond</label>'.form_dropdown('bond['.$i.']', $bond_status,'','class="form-control" ').'
              </div>
            </div>
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
                <label>Bills</label>'.form_dropdown('bills['.$i.']', $bills_status,'','class="form-control" ').'
              </div>
            </div>
          </div><hr>';  
	            }
	       return array("html"=>$rentbondbills_div);      
	        }
	        if($step_type=='roomavailability'){
	            $length_of_stay = $this->config->item('length_of_stay');	
                $room_availability_div ='';
                 $roomtypes_status_config = $this->config->item('roomtypes_status');
                $rooms_types = $this->input->post('room_types_values');

	             for($i=1;$i<=$total_room;$i++){
	                  $roomcounter_val=$i-1;
        	         $rooms_types_name =$rooms_types[$roomcounter_val]['value'];
        	              
	                 $data = array('class' =>'form-control dateavailable','type'=>'date','name'=> 'date_available['.$i.']', 'id'=> 'date_available'.$i.'',"required"=>"true","value"=>'');
	   $room_availability_div .='<div class="form-header">
            <h3>'.$roomtypes_status_config[$rooms_types_name].' Room '.$i.' availability</h3>
          </div>
          <div class="row" id="room_availability_div">
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
                <label>Date available</label>'.form_input($data).'
              </div>
            </div>
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
                <label for="psw">Minimum length of stay</label>'.form_dropdown('min_stay_length['.$i.']', $length_of_stay,'','class="form-control" ').'
              </div>
            </div>
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
                <label for="psw">Maximum length of stay</label>'.form_dropdown('max_stay_length['.$i.']', $length_of_stay,'','class="form-control" ').'
              </div>
            </div>
          </div><hr>';
	             }
	             return array("html"=>$room_availability_div); 
	            
	        }
	        if($step_type=='flatmatepreference'){
	            $flatmatepreference_div='';
                $flatmatespref_status = $this->config->item('flatmatespref_status');
                $flatmatespref_accepting = $this->config->item('flatmatespref_accepting');  
                 $roomtypes_status_config = $this->config->item('roomtypes_status');
                $rooms_types = $this->input->post('room_types_values');
                
	            for($i=1;$i<=$total_room;$i++){
	             $flatmatespref_accepting_div='';
			   $roomcounter_val=$i-1;
        	         $rooms_types_name =$rooms_types[$roomcounter_val]['value'];
			  if($flatmatespref_accepting){
				  foreach($flatmatespref_accepting as $flatmatespref_accepting_key =>  $flatmatespref_accepting_val){					 
				 $flatmatespref_accepting_div .=' 
                  <div class="col-lg-4 col-md-4"> 
                  <ul class="check_submit">                
                   <li> <input type="checkbox" name="accepting['.$i.'][]" class="hide" id="flatmatespref_accepting'.$flatmatespref_accepting_key.$i.'" value="'.$flatmatespref_accepting_key.'">
                    <label for="flatmatespref_accepting'.$flatmatespref_accepting_key.$i.'">'.$flatmatespref_accepting_val.'</label></li></ul>
                
                  </div>';
                   } } 

$data = array('class' =>'form-control','type'=>'date','name'=> 'date_available['.$i.']', 'id'=> 'date_available'.$i.'',"required"=>"true");

$flatmatepreference_div .='          <div class="form-header">
            <h3>'.$roomtypes_status_config[$rooms_types_name].' Room '.$i.' Flatmate Preference</h3>
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="form-group">'.form_dropdown('preference['.$i.']', $flatmatespref_status,'','class="flatpreference form-control" id="flatmatespref_status" data-id="'.$i.'" ' ).'
              </div>
            </div>
            <div class="col-lg-12 col-md-12" id="preference_div'.$i.'" style="display:none;">
              <div class="form-group">
                <label for="psw">Is this property female only?</label>
                <ul class="radio_submit">
                    <li>
                      <input type="radio" name="property_female_only'.$i.'" class="hide" id="property_female_only1'.$i.'" value="1">
                      <label for="property_female_only1'.$i.'"> Yes</label>
                    </li>
                    <li>
                      <input type="radio" name="property_female_only'.$i.'" class="hide" id="property_female_only2'.$i.'" value="2">
                      <label for="property_female_only2'.$i.'"> No</label>
                    </li>
                    </ul>
              </div>
            </div>
            
          </div>
          
          
             <div class="form-header">
            <h3>'.$roomtypes_status_config[$rooms_types_name].' Room '.$i.' Accepting</h3>
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
               <div class="row">
              '.$flatmatespref_accepting_div.'
                  </div>
               
              </div>
            </div>
            
            
          </div><hr>';   
	                
	            }
	            
	            return array("html"=>$flatmatepreference_div); 
	        }
	        
	        
	    }
	    
	    
	}
	
			
}
	
	?>