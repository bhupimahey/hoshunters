<?php
class Shortlist_model extends CI_Model
	{
		
	public function addShortlist() {
		
		$listing_id = $this->input->post('listid');
	   	$session_id =explode(".",ip_address());
        $session_id = $session_id[0].$session_id[1].$session_id[2].$session_id[3];
	
		$exists = $this->db->where("session_id",(int)$session_id)->where("listing_id",(int)$listing_id)->count_all_results('shortlists');
		if($exists==0){
		$insert_data = array('session_id'=>(int)$session_id,'listing_id'=>(int)$listing_id,'entry_time'=>date('Y-m-d H:i:s'),'ip_address'=>ip_address());
		$this->db->insert('shortlists',$insert_data);
		}
		else{
		 $this->deleteShortlist($listing_id,$session_id);
		}
	}

	public function deleteShortlist($listing_id,$session_id) {
	  	$this->db->where("listing_id",(int)$listing_id);
		$this->db->where("session_id",(int)$session_id);
		$this->db->delete("shortlists");
	}


	function getShortlist()
		{			
    	$session_id =explode(".",ip_address());
        $session_id = $session_id[0].$session_id[1].$session_id[2].$session_id[3];
	
		if(isset($_GET['start'])){	
		$search_text = $_GET['search'];
		$length      = $_GET['length'];
		}
		else{
		$search_text='';			
		$length=20;
		}
		$start=($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		
	    $sql = "SELECT * FROM shortlists WHERE session_id = '" . (int)$session_id . "' ORDER BY entry_time DESC";
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
			
			$profile_info          = $this->common_model->getProfileInfo($values->listing_id);	
			if($profile_info ){
			    
		
			$profile_photo_info    = $this->common_model->get_user_photo($values->listing_id);
			$property_address_info = $this->common_model->property_address_info($values->listing_id);
			$homedes_rentbondbills = $this->common_model->homedes_rentbondbills($values->listing_id);
		    $homedes_rooms         = $this->common_model->homedes_rooms($values->listing_id);
		    $no_image_path=NO_IMAGE;			
			$full_path_no_image=base_url().$no_image_path;
		    
		    $profile_type = $profile_info->profile_type;
			    
			    if( $profile_type==1){
			    
			       if($profile_photo_info)
			            $photo ='<img src="'.base_url().CNTPHT_THUMB.$profile_photo_info->photo.'" alt="#"/>'; 
		            
		           else
			            //$photo=''; 
					$photo='<img src="'.$full_path_no_image.'" alt="#"/>';
			        
			    }
			 else  if( $profile_type==2){
			       if($profile_photo_info)
			            $photo ='<img src="'.base_url().HMEPHT_THUMB.$profile_photo_info->photo.'" alt="#"/>'; 
		            
		           else
			           // $photo='';
							$photo='<img src="'.$full_path_no_image.'" alt="#"/>';					
			        
			    } 
			    
			    $records["data"][] = array(				
			    	'suburb'        =>$profile_info->suburb,
			    	'first_name'    =>$profile_info->me_firstname,
			    	'photo'         => $photo,
			    	'listing_id'    =>$values->listing_id,
                  	'age'           =>$profile_info->me_age,
			    	'gender'        =>$profile_info->me_gender,
			    	'about_yourself'=>$profile_info->great_live_with_text,
			    	'weekly_budget' =>$profile_info->weekly_budget,
			    	'property_address_info'=>$property_address_info,
			    	'homedes_rooms' =>$homedes_rooms,
			    	'rentbondbills' =>$homedes_rentbondbills,
			    	'profile_type'  =>$profile_type,
			    	'profile_status'=>$profile_info->profile_status,
			    	'entry_time'    =>$profile_info->entry_time
			   );
			}
	    }

		$config = array();
        $config["base_url"] = base_url() . "shortlists";
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
	}