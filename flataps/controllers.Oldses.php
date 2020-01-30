<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Register extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct(); 	
		$this->load->library(array('form_validation'));
		$this->load->model('register_model');
		$this->load->library('Googleplus');
    }

   public function index($submit=NULL)
     {
         
	   if($submit!=NULL){  
        
        $rules = array(
		  array(
                'field' => 'fullname',
                'label' => 'Full Name',
                'rules' => 'trim|required'
            ),
			array(
                'field' => 'username',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email'
            ),
             array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required'
            )
        );
		
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run()) {            
         	$success = $this->register_model->registerCustomer();
            if($success=="email_exists") {
			   	   $this->message_output->set_error('Email already exists');
				}		
			else{
			    $this->message_output->set_success('Registration has been done successfully.',TRUE);
			    
				 redirect(customer_path().'dashboard');
			    }   
            }	
			 else
         		   $this->message_output->set_error($this->form_validation->output_errors());
	    }
	    
	    
	    $this->load->model('pages_model');
	    $terms_condition_info = $this->pages_model->page_info('terms_and_conditions');
	    $data['facebook_login_url'] = $this->facebook->login_url();
		$data['google_login_url'] = $this->googleplus->loginURL();
		$data['terms_condition_info'] = $terms_condition_info;
	    $this->load->view('pages/register',$data);	
	 }
	 
	 
} 