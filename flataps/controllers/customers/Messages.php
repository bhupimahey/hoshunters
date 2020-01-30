<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Messages extends CI_Controller
	{
	public

	function __construct()
		{
		parent::__construct();
		$this->auth->customer_restrict();
		$this->load->library(array('form_validation'));
		$this->load->model('messages_model');
		}

	function index($from_id=NULL,$profile_id=NULL)	
		{
    	$user_id       = $this->session->userdata('s_user_id');  
    	$customer_name ='';
    	if($from_id!=NULL && $profile_id!=NULL){
    	   $user_info = $this->common_model->get_user_info($from_id);
    	   if($user_info){
    	    $this->messages_model->read_messages($from_id,$profile_id);   
	        $user_latest_messages = $this->messages_model->message_groups($user_id);
	        $customer_name =  $user_info->full_name;
    	   }
    	   else{
    	   redirect($_SERVER['HTTP_REFERER']);
    	   }
		
    	}
		else
    	$user_latest_messages = $this->messages_model->message_groups($user_id);
		$data          = array('user_latest_messages'=>$user_latest_messages,'from_id'=>$from_id,'profile_id'=>$profile_id,'customer_name'=>$customer_name);	  
	
	
		 $this->load->view(customer_folder() . 'messages/view',$data);			
		}

   function reply_message($reply_to_id,$profile_id,$submit = NULL){
       if ($reply_to_id!='' && $profile_id!=''  && $submit != NULL) {
          $messagesubmit = $this->messages_model->reply_customer_message($reply_to_id,$profile_id); echo'<pre>';
          $this->message_output->set_success('Message has been send successfully.', TRUE); 
          redirect($_SERVER['HTTP_REFERER']);
       }
       
     }

	}