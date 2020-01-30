<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Login extends CI_Controller
{    
    public function __construct()
    {
        parent::__construct();
		$this->load->library('form_validation');    
		$this->load->helper('captcha');
		$this->load->library(array('Googleplus'));
    }
    public function index()
     {
         
      if(isset($_SERVER['HTTP_REFERER'])){
        
           $listingnumber = substr($_SERVER['HTTP_REFERER'], -7);
           $listing_start = substr($_SERVER['HTTP_REFERER'], -8,-7);
           
           if($listing_start=='F' && is_numeric($listingnumber) && $listingnumber!=''){
          
                $this->session->set_userdata('s_reffer_path',$_SERVER['HTTP_REFERER']);
           }
          else{
          
             $this->session->unset_userdata('s_reffer_path');
          }
         
          
      }   
         
	   if ($this->auth->user_logged_in()){
            redirect(customer_path() . 'dashboard');
	   }
		
		$data['facebook_login_url'] = $this->facebook->login_url();
		$data['google_login_url'] = $this->googleplus->loginURL();
        $this->load->view('pages/login',$data);   
	 }

    public function submit()
     {
          
			 
         
        $rules = array(
            array(
                'field' => 'username',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required'
            )            ,
            array(
                'field' => 'login_captcha_code',
                'label' => 'Captcha',
                'rules' => 'trim|required'
            )
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run()) {            
            $captcha_info = $this->session->userdata('captcha_info');
		    $str          = $this->input->post('login_captcha_code');
			
			if ($captcha_info['code'] != $str)
				{
				$this->message_output->set_error('The captcha was not input correctly. Please try again.');			
			    }
			else{
       	    $user = $this->common_model->login_user($this->input->post('username'), $this->input->post('password'));
       	   
			if ($user) {
				  $success = $this->auth->user_login($this->input->post('username'), $this->input->post('password'),$user);
                  if ($success) {
                      
				 		 $this->message_output->set_success('You are now logged in customer section.', TRUE);
				 		 
				 		 // Save login details
				 		 $this->common_model->login_privacy($this->session->userdata('s_user_id'));
				 		 
				 		 // get subscription
				 		$user_roles =  $this->common_model->get_subscription($this->session->userdata('s_user_id'));
				 		$this->session->unset_userdata('s_user_roles');
				 		$this->session->set_userdata('s_user_roles',$user_roles);
				        
				        if($this->session->userdata('s_reffer_path')){
				           redirect($this->session->userdata('s_reffer_path'));
				        }
				        else
						  redirect(customer_path().'dashboard');
                  } else {
                    	$this->message_output->set_error('Your account is inactive.');                    
                } }
            else {
                $this->message_output->set_error('Username  and password combination does not exist.');
              }
        }
            
            
        } else
            $this->message_output->set_error($this->form_validation->output_errors());
		
		$data['facebook_login_url'] = $this->facebook->login_url();
		$data['google_login_url'] = $this->googleplus->loginURL();
		
         $this->load->view('pages/login',$data );
    	 } 

	public	function facebook_signin()
		{
			$user = $this->facebook->user();
			if ($user['code'] === 200)
			{
			    $data['user_profile'] = $user['data'];
			   	$user_id = FALSE;
				$user_email = explode("@", $data['user_profile']['email']);
				$first_name = $data['user_profile']['first_name'];
				$last_name = $data['user_profile']['last_name'];
				$facebook_id = $data['user_profile']['id'];
				$name = $data['user_profile']['name'];
				// check if user already rigister then  login first and move to dashboard page
				$username =$data['user_profile']['email'];
				$email = $data['user_profile']['email'];
				$check_user = $this->common_model->get_customer($email);
				
				if($check_user->account_status==0){
			     	$this->message_output->set_error('User account inactive!.', TRUE);
		     	    redirect(base_url().'login');   
        	 	}
        	 	else{
        	 	 
				if (count($check_user) > 0)
					{
					$success = $this->auth->social_login($check_user);
					if ($success)
						{
						// if succesfully register then login and  move to dashboartd
						 $this->common_model->login_privacy($this->session->userdata('s_user_id'));
				 		  // get subscription
				 		$user_roles =  $this->common_model->get_subscription($this->session->userdata('s_user_id'));
				 		$this->session->unset_userdata('s_user_roles');
				 		$this->session->set_userdata('s_user_roles',$user_roles);
						 $this->message_output->set_success('You are now logged in.', TRUE);
				    	 if($this->session->userdata('s_reffer_path'))
				           redirect($this->session->userdata('s_reffer_path'));
				        else
						  redirect(customer_path().'dashboard');
						}
					}
				  else
					{
					$insert_facebook_info = $this->common_model->add_social_user($email, $name, $username, $user_id);
					$success = $this->auth->social_login($check_user);
					if ($success)
						{
						// if succesfully register then login and  move to dashboartd
						 $this->message_output->set_success('You are now logged in.', TRUE);
						 $this->common_model->login_privacy($this->session->userdata('s_user_id'));
						 // assign free package
	            	     $this->common_model->subscribe_free_package($this->session->userdata('s_user_id'));
		            	  // get subscription
				 		$user_roles =  $this->common_model->get_subscription($this->session->userdata('s_user_id'));
				 		$this->session->unset_userdata('s_user_roles');
				 		$this->session->set_userdata('s_user_roles',$user_roles);
				 		 
						if($this->session->userdata('s_reffer_path'))
				           redirect($this->session->userdata('s_reffer_path'));
				        else
						  redirect(customer_path().'dashboard');
						}
					  else
						{
						$this->message_output->set_error('Username and Password combination does not exist.');
						redirect(base_url().'login');
						}
					}
        	 	}
        	 	
			}
         else{
  	            $this->message_output->set_error('Authentication failed!.', TRUE);
			    redirect(base_url().'login');  
             }
		}

	public function google_signin()
		{
	  	 $user_id = NULL;	    
    	 if (isset($_GET['code'])) {
            $this->googleplus->getAuthenticate();
            $userProfile = $this->googleplus->getUserInfo();
            
           
			$google_user_email = $userProfile['email'];
			$google_name = $userProfile['name'];
			$username_info = explode("@", $google_user_email);
			$username = $userProfile['email'];
			$google_check_user = $this->common_model->get_customer($username);
			
			if($google_check_user->account_status==0){
			 	$this->message_output->set_error('User account inactive!.', TRUE);
		     	redirect(base_url().'login');   
			    
			}
			else{
			
			if (count($google_check_user) > 0)
				{
				$success = $this->auth->social_login($google_check_user);
				if ($success)
					{
					  $this->common_model->login_privacy($this->session->userdata('s_user_id'));   
					  // get subscription
				 		$user_roles =  $this->common_model->get_subscription($this->session->userdata('s_user_id'));
				 		$this->session->unset_userdata('s_user_roles');
				 		$this->session->set_userdata('s_user_roles',$user_roles);
				    	$this->message_output->set_success('You are now logged in.', TRUE);
					   if($this->session->userdata('s_reffer_path'))
				           redirect($this->session->userdata('s_reffer_path'));
				        else
						  redirect(customer_path().'dashboard');
					}
				}
			  else
				{
				$insert_google_info = $this->common_model->add_social_user($google_user_email, $google_name, $username, $user_id);
				$success = $this->auth->social_login($google_check_user);
				if ($success)
					{
					// if succesfully register then login and  move to dashboartd
					 $this->common_model->login_privacy($this->session->userdata('s_user_id'));
					 
					   // assign free package
		               $this->common_model->subscribe_free_package($this->session->userdata('s_user_id'));
		               // get subscription
				 		$user_roles =  $this->common_model->get_subscription($this->session->userdata('s_user_id'));
				 		$this->session->unset_userdata('s_user_roles');
				 		$this->session->set_userdata('s_user_roles',$user_roles);
				 		 
				    	$this->message_output->set_success('You are now logged in.', TRUE);
					   if($this->session->userdata('s_reffer_path'))
				           redirect($this->session->userdata('s_reffer_path'));
				        else
						  redirect(customer_path().'dashboard');
					}
				}
				
    	 }
		 
        }
      else{
          	$this->message_output->set_error('User has canceled authentication!.', TRUE);
			redirect(base_url().'login');
         }  
	 

			
		}
} 