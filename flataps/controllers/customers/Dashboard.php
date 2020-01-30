<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller
	{
	    
	var $contact_main_photo;
	var $contact_thumb_photo;
	var $contact_mini_photo;    
	public function __construct()
		{
		parent::__construct();
		$this->auth->customer_restrict();
		$this->load->library(array('form_validation','Googleplus','upload','image_lib'));
		$this->load->model('common_model');
		
		 $this->contact_main_photo  = realpath(CNTPHT);
		 $this->contact_thumb_photo = realpath(CNTPHT_THUMB);
		 $this->contact_mini_photo = realpath(CNTPHT_MINI);
		 
		}

	function index()	
		{
		   // echo'<pre>';
		  //  print_r($this->session->userdata);
		    
		 $this->load->view(customer_folder() . 'dashboard');			
		}


	function delete_photo()	
		{
		 if($this->session->userdata('s_user_id'))  { 
		  $this->common_model->delete_user_photo($this->session->userdata('s_user_id'));   
		  $this->message_output->set_success('Profile photo has been deleted.', TRUE);
          redirect(customer_path() . 'profile_information');			
		 }
		 else{
		   redirect(customer_path() . 'profile_information');  
		 }
		}

	function deactivate_profile()	
		{
		 if($this->session->userdata('s_user_id'))  { 
		  $this->common_model->deactivate_profile($this->session->userdata('s_user_id'));   
		  $this->message_output->set_success('Profile has been deactivated.', TRUE);
          redirect(customer_path() . 'profile_information');			
		 }
		 else{
		   redirect(customer_path() . 'profile_information');  
		 }
		}
		
		
	function update_profile($submit=NULL)	
		{
		 
		 if ($submit != NULL) {
			
            $rules = array(array('field' => 'your_name', 'label' => 'Name', 'rules' => 'trim|required'), 
			         array('field' => 'email_id', 'label' => 'Email', 'rules' => 'trim|required|valid_email'),
			         array('field' => 'phone_number', 'label' => 'Phone Number', 'rules' => 'trim|required'));
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run()) {
                $update_profile = $this->common_model->update_user_profile($this->session->userdata('s_user_id'));
                $this->message_output->set_success('Profile information has been updated.', TRUE);
                redirect(customer_path() . 'profile_information');
            } else $this->message_output->set_error($this->form_validation->output_errors());
        }
		    
		 $profile_info  = $this->common_model->get_user_info($this->session->userdata('s_user_id'));   
		 $data          = array('profile_info'=>$profile_info);
		 $this->load->view(customer_folder() . 'profile_information',$data);			
		}


	function update_email_settings($submit=NULL)	
		{
		 
		 if ($submit != NULL) {
                $update_profile = $this->common_model->update_mailalerts_info($this->session->userdata('s_user_id'));
                $this->message_output->set_success('Email alerts setting has been updated.', TRUE);
                redirect(customer_path() . 'email_setting');
          }
		 $alerts_info  = $this->common_model->get_mailalerts_info($this->session->userdata('s_user_id'));   
		 $data          = array('alerts_info'=>$alerts_info);
		 $this->load->view(customer_folder() . 'email_settings',$data);			
		}


   function make_payment(){
       if($_POST){
          $package_id = $this->input->post('packageid'); 
          $this->session->unset_userdata('order_package_id');
          $this->session->set_userdata('order_package_id',$package_id);
          echo '1';
       }
       else
          echo '0';
       
   }
   
		
  	function upgrade_account()	
		{
		 $package_lists = $this->common_model->getPackagelists();   
		 $current_package = $this->common_model->customer_current_package_nfo($this->session->userdata('s_user_id'));
		 $planvaliditylist = $this->config->item('planvaliditylist');
		 $data = array('package_lists'=>$package_lists,'planvaliditylist'=>$planvaliditylist,'current_package'=>$current_package);
		 $this->load->view(customer_folder() . 'upgrade_account',$data);			
		}
		
	function logout()
		{
		    if($this->facebook->logged_in())
		$this->facebook->destroy_session();
		$this->googleplus->revokeToken();    
		if($this->auth->customer_logout())
		   redirect(base_url());
		}

  function verify_profile_number(){
      	$this->load->view(customer_folder() . 'profile/verify_mobile');
      
  }



  function change_profile_number(){
      $this->load->view(customer_folder() . 'profile/change_mobile');
  }

   function send_message($submit = NULL){
       if ($submit != NULL) {
           
          $messagesubmit = $this->common_model->send_customer_message($this->session->userdata('s_user_id'));
          $this->message_output->set_success('Message has been send successfully.', TRUE); 
          redirect($_SERVER['HTTP_REFERER']);
       }
       
   }

   function report_property($submit = NULL){
       if ($submit != NULL) {
          $messagesubmit = $this->common_model->report_property($this->session->userdata('s_user_id'));
          $this->message_output->set_success('Thanks for your feedback \n Our team will review your feedback and contact you if further details are required.', TRUE); 
          redirect($_SERVER['HTTP_REFERER']);
       }
       
   }

    function change_password($submit = NULL) {
        
        if($this->session->userdata('s_is_social_login')==0){
        
        if ($submit != NULL) {
			
            $rules = array(array('field' => 'new_password', 'label' => 'New Password', 'rules' => 'trim|required'), 
			         array('field' => 'confirm_password', 'label' => 'Confirm Password', 'rules' => 'trim|required|matches[new_password]'));
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run()) {
                $change_password = $this->common_model->change_customer_password($this->session->userdata('s_user_id'));
                $this->message_output->set_success('Password has been changed.', TRUE);
                redirect(customer_path() . 'change_password');
            } else $this->message_output->set_error($this->form_validation->output_errors());
        }
        $this->load->view(customer_folder() . "change_password");
        
        }
        else
        redirect($_SERVER['HTTP_REFERER']);
        
    }		

	
	}