<?php
class Common_model extends CI_Model
	{

function DeleteOldSession(){
    $today_date = date('Y-m-d');
    $query = "DELETE FROM  `flats_sessions` WHERE from_unixtime( `timestamp`, '%Y-%m-%d')<'".$today_date."'";
    $result = $this->db->query( $query);
}

  function is_shortlisted($property_id){
        $session_id =explode(".",ip_address());
        $session_id = $session_id[0].$session_id[1].$session_id[2].$session_id[3];
        $sql = "SELECT * FROM shortlists WHERE listing_id = '" . (int)$property_id . "' and session_id = '" . (int)$session_id . "' ORDER BY entry_time DESC";
		$counter_query = $this->db->query($sql);
		$iTotalRecords = $counter_query->num_rows();
		return $iTotalRecords;
  }


 function hasAccess($role_id){
     if($this->session->userdata('s_user_id')){
     $s_user_roles = $this->session->userdata('s_user_roles');
     $s_user_roles = explode(",",$s_user_roles);
     if(in_array($role_id,$s_user_roles))
        return true;
     else
         return false;
     }
     else
     return false;
     
 }
 
 function is_page_exists($page_url){
     $isexists = $this->db->where('name_url',$page_url)->count_all_results('information_pages');
     if($isexists)
      return TRUE;
     else
     return FALSE;
 }
 
 
 function confirm_mobile_code($user_id) {
        $mobile_no = $this->session->userdata('s_sms_mobile');
	   $this->db->where('otp',$this->input->post('sms_code'));
	   $query = $this->db->get('otp_log');
	   if($query->num_rows() >0 ){
	     $this->db->where('account_id',$user_id);  
	     $this->db->update('users',array('mobile_no'=>$mobile_no,'mobile_verified'=>'1'));
	     $this->session->unset_userdata('s_sms_mobile');
	    
	     return "success";   
	   }
	   else{
	     return "error"; 
	   }
		
	}	
	
	
 
  function send_verify_change_code(){ // user profile
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
 
 
 
 
 function send_device_notification($user_email,$user_name,$device,$ip,$time){
   
					// Send an HTML email
					////////////////////////////////////////				
					$base_url = base_url();
					$time = date('l.  M.  d  H:i A Y',strtotime($time));
					$msg = "<p>Device : ".$device."</p><p>Time: ".$time."</p><p>IP: ".$ip."";
					
					$this->load->library('email');
				
					ob_start();
					$this->load->view('templates/new_device_notify', array('message' => $msg,'user_name'=>$user_name));
					$html_msg = ob_get_clean();
					
					$this->email->set_mailtype('html');					
				
					$this->email->to($user_email);
					$this->email->from('info@hosthunters.com.au');
					$this->email->subject('New Login Alert');
					$this->email->message($html_msg);
					$this->email->send();
 }
 
 
 function login_privacy($user_id){
     
     $user_info = $this->get_user_info($user_id);
     
     $last_ip     = $user_info->last_login_ip;
     $last_device =  $user_info->login_device;
     
     $ip_address = ip_address();
     $useragent  = $_SERVER['HTTP_USER_AGENT'];
     $deviceinfo = preg_match('#\((.*?)\)#', $useragent, $match);
     $device_info = $match[1];
     
     if( (strtolower($device_info)!=strtolower($last_device))   && $last_device!=''){
        $user_name = $user_info->full_name; 
        $device    = $user_info->login_device; 
        $ip        = $user_info->last_login_ip;
        $time      = date('Y-m-d H:i:s');
        $this->send_device_notification($user_info->username,$user_name,$device,$ip,$time);
     }
     $this->db->where('account_id',$user_id);
     $this->db->update("users",array('last_login_ip'=>$ip_address,'login_device'=>$device_info)); 
 }
 
 function pages_menu(){
   $this->db->where('status',1);
   $query  = $this->db->get('information_pages');
   $result = $query->result();
   return $result;
 }
 
 function get_subscription($user_id){
     
     $this->db->where('user_id',$user_id);
     $this->db->where('status','1');
     $query  = $this->db->get('user_subscriptions');
     $result = $query->row();
     $roles  = $result->roles; 
     return $roles;
 }
 
 function delete_user_photo($user_id){
      $this->db->query("UPDATE users SET photo_path = ''  WHERE account_id='".$user_id."'"); 
 }
 
  function deactivate_profile($user_id){
      $this->db->query("UPDATE users SET account_status = '0'  WHERE account_id='".$user_id."'"); 
 }
 
 
 
 function update_mailalerts_info($user_id){
     $listing_alert      = $this->input->post('listing_alert');
     $newdevice_alert    = $this->input->post('newdevice_alert');
     $community_alert    = $this->input->post('community_alert');
     $specialoffer_alert = $this->input->post('specialoffer_alert');
     
     
     $alerts_exists = $this->db->where('user_id',$user_id)->count_all_results('users_email_alerts');
     if($alerts_exists==0){
         
         $insert_data = array("user_id"=>$user_id,"listing_alerts"=>$listing_alert ,"new_device_alerts"=>$newdevice_alert,
                              "community_notices"=>$community_alert,"special_offers"=>$specialoffer_alert);
         $this->db->insert("users_email_alerts",$insert_data);                      
     }
     else{
         $update_data = array("listing_alerts"=>$listing_alert ,"new_device_alerts"=>$newdevice_alert,
                              "community_notices"=>$community_alert,"special_offers"=>$specialoffer_alert);
         $this->db->where('user_id',$user_id);                      
         $this->db->update("users_email_alerts",$update_data);   
     }
     
     return TRUE;
 }
 
 function update_user_profile($user_id){
        $name = $this->input->post('your_name');
        $email_id = $this->input->post('email_id');
        $phone_number = $this->input->post('phone_number');
		$this->db->where('account_id', $user_id);
	    $this->db->update("users",array("full_name"=>$name,"email_id"=>$email_id,"mobile_no"=>$phone_number));
	    
	      if ($_FILES['profile_photo']['name'] != ''){
						$config['upload_path']    = $this->contact_main_photo;
						$config['allowed_types']  = '*';
						$config['max_size']       = '4024';
						$config['encrypt_name']   = TRUE;
						$this->upload->initialize($config);
						if ($this->upload->do_upload('profile_photo'))
							{
							$data_file = $this->upload->data();
							if (isset($data_file))
								{
								  $this->createPhotoThumbnail($data_file['file_name']);
								  $this->createPhotoMini($data_file['file_name']);
							      
								  $attachment_file  =  $data_file['file_name'];
		                    	  $this->db->query("UPDATE users SET photo_path = '" . $attachment_file."'  WHERE account_id='".$user_id."'"); 
			  				
								}
							 }
						}
						
	    return TRUE;	
 }
 
  	function createPhotoThumbnail($filename)	{
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

	function createPhotoMini($filename)	{
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
 
 
 function is_early_bird($listing_id){
     $this->db->select('entry_time');
     $this->db->where('profile_id',$listing_id);
     $query = $this->db->get('users_profile');
     $result = $query->row();
     if($result){
     $entry_time = $result->entry_time;
     $diff = strtotime(date("Y-m-d")) - strtotime(date('Y-m-d',strtotime($entry_time))); 
    // 1 day = 24 hours 
    // 24 * 60 * 60 = 86400 seconds 
     $days = abs(round($diff / 86400)); 
     if($days <=14)
       return true;
      else
      return false;
     }
 }
 
  function get_mailalerts_info($user_id){
     $this->db->where('user_id',$user_id);
     $query = $this->db->get('users_email_alerts');
     $result = $query->row();
     return $result;
  }
 
 function countUserProfiles($user_id) {
        $this->db->select('COUNT(*) AS total');
        $this->db->where('account_id',$user_id);
		$query = $this->db->get('users_profile');
		$result = $query->row_array();
		return $result['total'];
	}
 
   function check_empty_file($filedata){
	   $error=0;
     if($filedata){
		 foreach($filedata as $file_key => $file_val){			 
				if($file_val=="")
					 $error=1;
				else
                     $error=0;					
		 }		 
	  }
	  return $error;
		 
    }	
	 
   function total_listing(){
	 $total_listing = $this->db->count_all_results('users_profile');
	 return $total_listing;
   }
   function total_users(){
	 $total_users = $this->db->count_all_results('users');
	 return $total_users;
   }
   
  function total_pages(){
	 $total_pages = $this->db->count_all_results('information_pages');
	 return $total_pages;
   }

  function total_messages(){
	 $total_messages = $this->db->count_all_results('messages');
	 return $total_messages;
   }

 function admin_latest_messages(){
     $this->db->limit(10);
     $this->db->order_by('message_id','DESC');
     $query = $this->db->get('messages');
     $result = $query->result();
	 $records["data"] = array();
	 $id = 0;
	 $result = $query->result();
	 foreach($result as $values)
			{
			$send_from_info  = $this->get_user_info($values->send_from);
			$send_from_name  = ucwords($send_from_info->full_name); 
			
			$send_to_info  = $this->get_user_info($values->send_to);
			$send_to_name  = ucwords($send_to_info->full_name); 
			   
			 $records["data"][] = array(				
			    	'message_id'    => $values->message_id,
			    	'from_id'       => $values->send_from,
			    	'send_from_name'=> $send_from_name,
			    	'send_to_name'  => $send_to_name,
			    	'to_id'         => $values->send_to,
			    	'message_body'  => $values->message_body,
			    	'photo'         => $values->profile_photo,
			    	'entry_time'    => $values->entry_time
			   );
	    }
		return $records;
 }

function admin_latest_listings(){
     $this->db->limit(10);
     $this->db->order_by('entry_time','DESC');
     $query = $this->db->get('users_profile');
     $result = $query->result();
	 $records["data"] = array();
	 $id = 0;
	 $result = $query->result();
	 foreach($result as $values)
			{
			$owner_info  = $this->get_user_info($values->account_id);
			$owner_name  =  ucwords($owner_info->full_name);
			$property_address_info = $this->property_address_info($values->profile_id);
			$homedes_rooms         = $this->homedes_rooms($values->profile_id);
			
			
			 $records["data"][] = array(				
			    	'profile_id'    => $values->profile_id,
			    	'owner_name'    => $owner_name,
			    	'suburb'        => $values->suburb,
			    	'profile_type'  => $values->profile_type,
			    	'property_address_info'=>$property_address_info,
			    	'homedes_rooms'    => $homedes_rooms,
			    	'property_type'   => $values->property_type,
			    	'entry_time'    => $values->entry_time
			   );
	    }
		return $records;
 }
 
  function get_state_information($state_id){
		$this->db->where('state_id', $state_id);
		$query = $this->db->get('states');
		$result = $query->row();
		return $result;
	 }


	 function addSubscriptionEmail(){
	   $subscribe_email = $this->input->post('emailid');
	   $check_subscription = $this->db->where('email_id',$subscribe_email)->count_all_results('email_subscriptions');
	   if($check_subscription==0){
	     $insert_data = array('email_id'=>$subscribe_email,'entry_time'=>date('Y-m-d H:i:s'),'ip_address'=>ip_address());   
	     $this->db->insert('email_subscriptions',$insert_data);
	     
	     
	          // Send an HTML email
					////////////////////////////////////////				
					
					$msg = "<p>Newsletter Subscribed By : ".$subscribe_email."<p>";
					
					$this->load->library('email');
				
					$this->email->set_mailtype('html');					
					$this->email->to('info@hosthunters.com.au');
					$this->email->from($subscribe_email);
					$this->email->subject('New user subscribed for monthly newsletter');
					$this->email->message($msg);
					$this->email->send();
	     
	     
	    }
	    echo json_encode(array('message'=>'subscribed','success'=>'1'));
	 }
	 

		
	 function get_city_information($city_id){
		$this->db->where('city_id', $city_id);
		$query = $this->db->get('cities');
		$result = $query->row();
		return $result;
	 }
	
	
	function country_states($country_id){
		$this->db->order_by('name');
		$this->db->where('country_id',$country_id);
		$query = $this->db->get('zone');
		$result = $query->result_array();
		$states_ids = array();
		$states_ids['']= 'Select State';
		if($result){
		  foreach($result as $val){
			  $states_ids[$val['zone_id']]= $val['name'];
		  }
		}
		return $states_ids;
	}

	function property_flatmates_preferences($profile_id)
		{
		$this->db->where('profile_id',$profile_id);
		$query  = $this->db->get('homedes_flatmates_preferences');
		$result = $query->row();
		return $result;
		}
		
	function property_address_info($profile_id)
		{
		$this->db->where('profile_id',$profile_id);
		$query  = $this->db->get('homedes_about_property');
		$result = $query->row();
		return $result;
		}

	function homedes_rentbondbills($profile_id)
		{
		$this->db->where('profile_id',$profile_id);
		$query  = $this->db->get('homedes_rentbondbills');
		$result = $query->row();
		return $result;
		}

 	function room_flatmates_preferences($room_id,$profile_id)
		{
		$this->db->where('room_id',$room_id);
		$this->db->where('profile_id',$profile_id);
		$query  = $this->db->get('homedes_flatmates_preferences');
		$result = $query->row();
		return $result;
		} 
  
  
   function total_home_rooms($profile_id){
       
     $total_rooms=  $this->db->where('profile_id',$profile_id)->count_all_results('homedes_rooms');
     return $total_rooms;
   }


	function room_features($room_id,$profile_id)
		{
		$this->db->where('profile_id',$profile_id);
		$this->db->where('room_id',$room_id);
		$query  = $this->db->get('homedes_room_features');
		$result = $query->row();
		return $result;
		}


	function homedes_all_rooms($profile_id)
		{
		$this->db->where('t1.profile_id',$profile_id);
		$this->db->join('homedes_rentbondbills t2','t1.room_id=t2.room_id');
		$query  = $this->db->get('homedes_rooms t1');
		$result = $query->result();
		return $result;
		}
		
	function room_availability($room_id,$profile_id)
		{
		$this->db->where('room_id',$room_id);
		$this->db->where('profile_id',$profile_id);
		$query  = $this->db->get('homedes_room_availability');
		$result = $query->row();
		return $result;
		}

		
	function homedes_rooms($profile_id)
		{
		$this->db->where('profile_id',$profile_id);
		$query  = $this->db->get('homedes_rooms');
		$result = $query->row();
		return $result;
		}
		
		
	function get_couple_info($profile_id)
		{
		$this->db->where('profile_id',$profile_id);
		$query  = $this->db->get('users_introduce_yourself_couple');
		$result = $query->row();
		return $result;
		}

	function get_group_info($profile_id)
		{
		$this->db->where('profile_id',$profile_id);
		$query  = $this->db->get('users_introduce_yourself_group');
		$result = $query->result();
		return $result;
		}
		
				

	function get_user_info($user_id)
		{
		$this->db->where('account_id',$user_id);
		$query  = $this->db->get('users');
		$result = $query->row();
		return $result;
		}
		
	function user_email_id($account_id){
		$this->db->where('account_id', $account_id);
		$this->db->order_by("first_name");
		$query = $this->db->get('users');
		$result = $query->row();
		$email = $result->email_id;
		return $email;
	}
	
	function user_fullname_id($account_id){
		$this->db->where('account_id', $account_id);
		$this->db->order_by("first_name");
		$query = $this->db->get('users');
		$result = $query->row();
		$fullname = $result->first_name.'&nbsp;'.$result->middle_name.'&nbsp;'.$result->last_name;
		return $fullname;
	}

    function islogin_first_time($user_id){
	 $this->db->where('account_id', $user_id);
	 $query  = $this->db->get('users');
	 $result = $query->row();
	 if($result->autopass!='')
	  return TRUE;
	  else
	  return FALSE;
    }

	function get_home_owner_photo($account_id)
		{
		$this->db->order_by('entry_time','DESC');
		$this->db->limit('1');    
		$this->db->where('account_id', $account_id);
		$query = $this->db->get('users');
		$result = $query->row();
		return $result;
		}
		
	function get_user_photo($profile_id)
		{
		$this->db->order_by('entry_time','DESC');
		$this->db->limit('1');    
		$this->db->where('profile_id', $profile_id);
		$query = $this->db->get('users_photos');
		$result = $query->row();
		return $result;
		}

	function user_information($user_id)
		{
		$this->db->where('account_id', $user_id);
		$query = $this->db->get('users');
		$result = $query->row();
		return $result;
		}

	function getProfileInfo($profile_id)
		{
		$this->db->where('profile_id', $profile_id);
		$query = $this->db->get('users_profile');
		$result = $query->row();
		return $result;
		}

	function get_user_by_id($user_id)
		{
		$this->db->where('account_id', $user_id);
		$query = $this->db->get('users');
		$result = $query->row();
		return $result;
		}

	function country_lists()
		{
		$this->db->order_by("name");		
		$query = $this->db->get('country');		
		$result = $query->result();
		$country_array = array();		
		if ($result)
			{
			foreach($result as $country_val)
				{
				$country_array[$country_val->id] = ucwords($country_val->nicename).'(+'.$country_val->phonecode.')';
				}
			}

		return $country_array;
		}

	function get_admin($username)
		{
		$this->db->where('account_username', $username);
		$query = $this->db->get('site_head');
		return $query->row();
		}

	function package_info($package_id)
		{
		$this->db->where('package_id', $package_id);
		$query = $this->db->get('packages');
		return $query->row();
		}

  function subscribe_customer_package($user_id,$package_id,$token_id,$payer_id){
     
      $this->db->where('package_id',$package_id);
      $query = $this->db->get('packages');
      if($query->num_rows()>0){
         $result        = $query->row();
         
         $package_validity = $this->config->item('planvaliditylist');
         $validity_days = $package_validity[$result->package_validity];   
         $roles         = $result->roles;  
         $end_date      = date('Y-m-d', strtotime("+".$validity_days.""));
         $insert_data   = array('user_id'=>$user_id,'package_id'=> $package_id,'roles'=>$roles,'start_date'=>date('Y-m-d'),'end_date'=>$end_date,'entry_time'=>date('Y-m-d H:i:s'),'ip_address'=>ip_address());
         $this->db->insert('user_subscriptions',$insert_data);
         $subscribed_package = $this->db->insert_id();
         
         
         // make log of customer payment
         $payment_log = array("user_id"=>$user_id,"package_id"=>$package_id,"token_id"=>$token_id,"payer_id"=>$payer_id,"entry_time"=>date("Y-m-d H:i:s"));
         $this->db->insert("users_payments", $payment_log);
         
         
         $user_roles =  $this->get_subscription($user_id);
		 $this->session->unset_userdata('s_user_roles');
		 $this->session->set_userdata('s_user_roles',$user_roles);
         return  $subscribed_package;
      }
  }


   function customer_current_package_nfo($user_id){
     $this->db->limit(1);
     $this->db->where('status','1');
     $this->db->where('user_id',$user_id);
     $query = $this->db->get('user_subscriptions');
     $result = $query->row();
     return $result;
   }

   function upgrade_customer_package($user_id,$token_id,$payer_id){
       $this->db->where("user_id",$user_id);
       $this->db->update("user_subscriptions",array('status'=>'0'));
       $package_id = $this->session->userdata('order_package_id');
       $this->subscribe_customer_package($user_id,$package_id,$token_id,$payer_id);
       
       $this->session->unset_userdata('order_package_id');
   }

		
	function get_admin_information()
		{
		$this->db->where('account_id', '1');
		$query = $this->db->get('site_head');
		return $query->row();
		}


	function getPackagelists()
		{
		$this->db->order_by('package_id');
		$this->db->where('status','1');
		$query = $this->db->get('packages');
		$result = $query->result();
		return $result;
		}
		
		
  function subscribe_free_package($user_id){
      $free_package_id ='1';
      $this->db->where('package_price','0');
      $query = $this->db->get('packages');
      if($query->num_rows()>0){
         $result        = $query->row();
         $validity_days = $result->package_validity;   
         $roles         = $result->roles;  
         $end_date      = date('Y-m-d', strtotime("+".$validity_days." days"));
         $insert_data   = array('user_id'=>$user_id,'package_id'=> $free_package_id,'roles'=>$roles,'start_date'=>date('Y-m-d'),'end_date'=>$end_date,'entry_time'=>date('Y-m-d H:i:s'),'ip_address'=>ip_address());
         $this->db->insert('user_subscriptions',$insert_data);
         return $this->db->insert_id();
      }
  }


   function update_password($user_id,$password){
	 $this->db->where('account_id', $user_id);
	 $this->db->update("users",array("password"=>salted_hash($password)));
	 return TRUE;	
    }

	function change_customer_password($user_id){
		$new_password = $this->input->post('new_password');
		$this->db->where('account_id', $user_id);
	    $this->db->update("users",array("password"=>salted_hash($new_password)));
	    return TRUE;	
	}
	
	
	function change_password($user_id){
		$new_password = $this->input->post('new_password');
		$this->db->where('account_id', $user_id);
	    $this->db->update("site_head",array("account_key"=>salted_hash($new_password)));
	    return TRUE;	
	}


	function get_user_pass_email($email)
		{
		$this->db->where('username', $email);
		$query = $this->db->get('users');
		return $query->row();
		}

	function admin_login_user($username, $password)
		{
		$user = $this->get_admin($username);	
		if ($user)
			{
			if ($user->account_key == salted_hash($password, $user->account_key))
				{
				return $user;
				}
			}

		return NULL;
		}

	function get_customer($username)
		{
		$this->db->where('email_id', $username);
		$query = $this->db->get('users');
		return $query->row();
		}

	function login_user($username, $password)
		{
		$user = $this->get_customer($username);
		if ($user)
			{
			if ($user->password == salted_hash($password, $user->password))
				{
				return $user;
				}
			}
		  return NULL;
		}


  function send_customer_message($user_id){
     $listingid     = $this->input->post('listingid');
     $profile_info  =  $this->getProfileInfo($listingid);
     if( $profile_info){
         
          $profile_type = $profile_info->profile_type;
          if( $profile_type=='1'){
                $profile_photo_info    = $this->get_user_photo($listingid);
                 if($profile_photo_info){
			            $thumb_photo=$profile_photo_info->photo; 
                    }
		           else{
			            $thumb_photo='';
		           }   
           }
          else if( $profile_type=='2'){
                $profile_photo_info    = $this->get_home_owner_photo($profile_info->account_id);
                if($profile_photo_info && $profile_photo_info->photo_path!=''){
			            $thumb_photo=$profile_photo_info->photo_path;
                    }
		           else{
			            $thumb_photo='';
		           }     
           }
         
         $account_id   =  $profile_info->account_id;
         $message_body = $this->input->post('message');
         $insert_data = array('send_from'=>$user_id,"send_to"=>$account_id,'profile_id'=>$listingid,'profile_photo'=>$thumb_photo,'message_body'=>$message_body,'entry_time'=>date('Y-m-d H:i:s'),
                              'ip_address'=>ip_address()); 
         $this->db->insert("messages",$insert_data);
        }
      
     }


  function report_property($user_id){
     $listingid     = $this->input->post('listingid');
     if( $listingid){
         $report_status = $this->input->post('report_property_list');
         $reported_reason_desc = $this->input->post('feedback_details');
         $insert_data = array('listing_id'=>$listingid,"reported_by"=>$user_id,'reported_reason'=>$report_status,
                              'reported_reason_desc'=>$reported_reason_desc,'entry_time'=>date('Y-m-d H:i:s'),
                              'ip_address'=>ip_address()); 
         $this->db->insert("report_properties",$insert_data);
         
         
         $report_property_list_status = $this->config->item('report_property_list');
         $final_report_status = $report_property_list_status[$report_status];
         $user_name = $this->session->userdata('s_user_name');
         $user_mobile = $this->session->userdata('s_user_mob');
          $user_email = $this->session->userdata('s_user_email');
          
          $listing_id ='F'.random_string('numeric', 6).$listingid;
        ////////////////////////////////////////
					// Send an HTML email
					////////////////////////////////////////			
					$base_url = base_url();
					$msg = "<p><h1>Listing Reported Details:</h1><p><br><br>
					
                            <p>Name: '.$user_name.'<p><br><br><br>
                            <p>Mobile: '.$user_mobile.'<p><br><br><br>
                            <p>Email: '.$user_email.'<p><br><br><br>
                            <p>Reported Reason: '.$final_report_status.'<p><br><br><br>
                            <p>Description: '.$reported_reason_desc.'<p><br><br><br>
                            <p><h4><a href=\"{$base_url}{$listing_id}\">View Property</h4>";
					$this->load->library('email');
					ob_start();
					//$this->load->view('templates/register', array('message' => $msg));
					//$html_msg = ob_get_clean();
					
					$this->email->set_mailtype('html');					
				
					$this->email->to('info@hosthunters.com.au');
					$this->email->from('info@hosthunters.com.au');
					$this->email->subject('Listing reported by '.$user_name);
					$this->email->message($msg);
					$this->email->send(); 
         
         
         
        }
      
     }
     
     
     function add_social_user($email, $name, $username, $user_id){
         
      $insert_user = array("username"=>$username,"full_name"=>$name,"email_id"=>$email,"account_status"=>"1","entry_time"=>date("Y-m-d H:i:s"),
                          "ip_address"=>ip_address());     
       $this->db->insert("users",$insert_user);
       
                     ////////////////////////////////////////
					// Send an HTML email
					////////////////////////////////////////			
					$base_url = base_url();
					$msg = "<p><h1>Welcome to Hosthunters</h1><p><br><br>
                            <p>Let's get your search started!<p><br><br><br>
                            <p>Create your listing</p><br>Whether you're looking for a new flatmate or a new home, a listing will ensure your search is a successful one. It's free to create a listing and only takes a few minutes.<br><br>
					        <p><h4><a href=\"{$base_url}list_my_place\">List my place</h4> &nbsp;&nbsp; <h4><a href=\"{$base_url}find_place\">Find a place</a></h4>";
					
					$this->load->library('email');
				
					ob_start();
					$this->load->view('templates/register', array('message' => $msg));
					$html_msg = ob_get_clean();
					
					$this->email->set_mailtype('html');					
				
					$this->email->to($email);
					$this->email->from('info@hosthunters.com.au');
					$this->email->subject('Welcome to Hosthunters');
					$this->email->message($html_msg);
					$this->email->send();  
       
     }


	function getFaqList()
		{			
 
		if(isset($_GET['start'])){	
		$search_text = $_GET['search'];
		$length      = $_GET['length'];
		}
		else{
		$search_text='';			
		$length=20;
		}
		$start=($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		
	    $sql = "SELECT * FROM faq  ORDER BY entry_time DESC";
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
			    $records["data"][] = array(				
			    	'faq_title'   =>$values->faq_title,
			    	'faq_desc'    =>$values->faq_desc
			   );
		
	    }

		$config = array();
        $config["base_url"] = base_url() . "faq";
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


	function is_user_active($user)
		{
		$account_status = $user->account_status;
		if ($account_status == '1') return TRUE;
		  else return NULL;
		return NULL;
		}

	function get_admin_by_id($user_id)
		{
		$sql = "SELECT * FROM site_head  WHERE 	account_id=?  LIMIT 1";
		$query = $this->db->query($sql, array(
			$user_id
		));
		return $query->row();
		}		

	}