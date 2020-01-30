<?php
class Messages_model extends CI_Model
	{

    public	function message_information($message_id)
		{
		$this->db->where('message_id', $message_id);
		$query = $this->db->get('messages');
		$result = $query->row();
		return $result;
		}

   	public function reply_customer_message($reply_to_id,$profile_id) {
   	      
		  $message_data  = $this->input->post('message_data');
		  $user_id       = $this->session->userdata('s_user_id'); 
		  
		  $profile_info  =  $this->common_model->getProfileInfo($profile_id);
          if( $profile_info){
         
          $profile_type = $profile_info->profile_type;
          if( $profile_type=='1'){
                $profile_photo_info    = $this->common_model->get_user_photo($profile_id);
                 if($profile_photo_info){
			            $thumb_photo=$profile_photo_info->photo; 
                    }
		           else{
			            $thumb_photo='';
		           }   
           }
          else if( $profile_type=='2'){
                $profile_photo_info    = $this->common_model->get_home_owner_photo($profile_info->account_id);
                if($profile_photo_info && $profile_photo_info->photo_path!=''){
			            $thumb_photo=$profile_photo_info->photo_path;
                    }
		           else{
			            $thumb_photo='';
		           }     
           }
              
         $insert_data = array("send_from" =>$user_id,"send_to"=>$reply_to_id,"profile_id"=>$profile_id,"message_body"=>$message_data,
								  "entry_time"=>date('Y-m-d H:i:s'), "ip_address"=>ip_address(),'profile_photo'=>$thumb_photo);
		  $this->db->insert("messages",$insert_data);
		  return TRUE;      
              
          }
		  
		  
		 
		 
   	}

   function read_messages($customer_id,$profile_id){
       
            $user_id       = $this->session->userdata('s_user_id'); 
	   	    $sql ='SELECT * FROM messages  WHERE  (messages.send_from="'. (int)$customer_id.'" OR messages.send_to="'. (int)$customer_id.'") AND (messages.send_from="'. (int)$user_id.'" OR messages.send_to="'. (int)$user_id.'")  AND message_status="0" ORDER BY message_id DESC';
 	       	$query = $this->db->query($sql);
 	       	$result = $query->result();
 	       	foreach($result as $values)
			{
			    $send_to = $values->send_to;
			    if($send_to==$user_id){
			         $message_id =$values->message_id;
			         $this->db->where('message_id',$message_id);
			         $this->db->update("messages",array("message_status"=>"1"));
			     }
			}
 
     }


 	function chat_history($from_id)
		{			
	    $user_id       = $this->session->userdata('s_user_id');   
 	    $sql = "SELECT * FROM messages WHERE ( (send_from = '" . (int)$from_id . "' OR  send_from='" . (int)$user_id . "') AND (send_to = '" . (int)$from_id . "' OR  send_to='" . (int)$user_id . "')) ORDER BY message_id";
		$query = $this->db->query($sql);
		$records = array();
		$records["data"] = array();
		$id = 0;
		$result = $query->result();
		foreach($result as $values)
			{
	
			 $records["data"][] = array(				
			    	'message_id'    =>$values->message_id,
			    	'from_id'    =>$values->send_from,
			    	'to_id'    =>$values->send_to,
			    	'message_body'  =>$values->message_body,
			    	'photo'         => $values->profile_photo,
			    	'entry_time'    =>$values->entry_time
			   );
		
	    }
		return $records;
   }		
 
 
 
 	function message_groups($customer_id)
		{		
		    
		//SELECT m.* FROM messages m WHERE m.message_id IN ( SELECT MAX(message_id) FROM messages WHERE send_from = 2 OR send_to =2 GROUP BY send_to) ORDER BY m.message_id DESC
		
		$user_id       = $this->session->userdata('s_user_id'); 
		$sql ='SELECT m.* FROM messages m WHERE m.message_id IN ( SELECT MAX(message_id) FROM messages WHERE  (messages.send_from="'. (int)$customer_id.'" OR messages.send_to="'. (int)$customer_id.'") AND (messages.send_from="'. (int)$user_id.'" OR messages.send_to="'. (int)$user_id.'") GROUP BY profile_id) ORDER BY m.message_id DESC';
 	  //  $sql ='select messages.* from messages where (messages.send_from="'. (int)$customer_id.'" OR messages.send_to="'. (int)$customer_id.'") AND (messages.send_from="'. (int)$user_id.'" OR messages.send_to="'. (int)$user_id.'") order by entry_time DESC '; 
		$query = $this->db->query($sql);
		$records = array();
		$records["data"] = array();
		$id = 0;
		$result = $query->result();
		$final_array =array();
    	$mesages_counter=0;
		foreach($result as $values)
			{
			  if($values->send_from ==$user_id ){
			   if($values->message_status==0) 
			    $mesages_counter= $mesages_counter+1; 
			   else  if($values->message_status==1) 
			    $mesages_counter=0; 
			    $send_from_info  = $this->common_model->get_user_info($values->send_to);
			    $send_from_name  = ucwords($send_from_info->full_name);   
			   
			    $profile_photo = $send_from_info->photo_path;
			    $final_array[$values->send_to] = array('name'=>$send_from_name,'photo'=>$profile_photo,'message_body'=>$values->message_body,
			                                          'entry_time'=>$values->entry_time,'message_status'=>$values->message_status,'total_messages_unread'=>0,
			                                          'profile_id'=>$values->profile_id);
			  }
			  else{
			    
			    $counter_query = $this->db->query('SELECT count(*) as total_messages FROM messages m WHERE send_to ="'. (int)$values->send_to.'" AND message_status="0" ');
			    $counter_result = $counter_query->row();
			    if($values->send_to==$user_id)
			    $total_messages_unread= $counter_result->total_messages;
			    else
			    $total_messages_unread=0; 
			      
			    if($values->message_status==0) 
			       $mesages_counter= $mesages_counter+1; 
			    else if($values->message_status==1) 
			    $mesages_counter=0; 
			    $send_from_info  = $this->common_model->get_user_info($values->send_from);
		     	$send_from_name  = ucwords($send_from_info->full_name);  
		     	$profile_photo = $send_from_info->photo_path;
		     	 
			    $final_array[$values->send_from] = array('name'=>$send_from_name,'photo'=>$profile_photo,'message_body'=>$values->message_body,
			                                              'entry_time'=>$values->entry_time,'message_status'=>$values->message_status,'total_messages_unread'=>$total_messages_unread,
			                                              'profile_id'=>$values->profile_id);
			  }
	      }
	   	return $final_array;
      }		
 	}