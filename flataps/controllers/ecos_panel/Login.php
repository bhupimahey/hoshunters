<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Login extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->library('form_validation');
    }
    public function index()
    {        
	   // echo $password    = salted_hash('admin11');        
        if ($this->auth->admin_logged_in())
            redirect(admin_folder() . 'dashboard');
			
			
        $this->load->view(admin_folder() . 'login');
    }
    function submit()
    {
        
        $rules = array(
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required'
            )
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run()) {            
            
            $user = $this->common_model->admin_login_user($this->input->post('username'), $this->input->post('password'));
            if ($user) {
   				  $this->session->set_userdata("s_user_roles","");
			      $this->session->set_userdata("s_user_designation","superadmin");
				  
				$success = $this->auth->admin_login($this->input->post('username'), $this->input->post('password'));
                if ($success) {
					 $this->message_output->set_success('You are now logged in Admin section.', TRUE);
                    redirect(admin_folder() . 'dashboard');
                } else {
                    $this->message_output->set_error('Your account is inactive.');
                    
                }
            } else {
                $this->message_output->set_error('Username  and password combination does not exist.');
            }
        } else
            $this->message_output->set_error($this->form_validation->output_errors());
         $this->load->view(admin_folder() . 'login');
    }
  
    function success()
    {
        $this->load->view('blank');
    }
} 