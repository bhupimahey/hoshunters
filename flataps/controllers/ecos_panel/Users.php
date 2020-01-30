<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Users extends CI_Controller
	{
	public

	function __construct()
		{
		parent::__construct();
		$this->auth->admin_restrict();
		$this->load->library(array('form_validation'));
		$this->load->model(array(admin_folder . 'users_model',admin_folder . 'listings_model','common_model'));
		}
	function index()
		{
		$users_list = $this->users_model->ajax_users_list();
		
		$data = array('users_list'=>$users_list);	
		$this->load->view(admin_folder() . 'users/view',$data);
		}

	function profiles($user_id)
		{
		$listings_list = $this->listings_model->ajax_listings_list($user_id);	
		$user_info     = $this->common_model->get_user_info($user_id);
		if($user_info)
		 $customer_name  = $user_info->full_name;
		else
		$customer_name  ='';
		
		$data = array('listings_list'=>$listings_list,'page_heading'=>'Listings List('.$customer_name.')');
		$this->load->view(admin_folder() . 'listings/view',$data);	
		}

	function add($submit = NULL)
		{
		 if ($submit != NULL)
			{
			$rules = array(
				
					array(
						'field' => 'full_name',
						'label' => 'Full Name',
						'rules' => 'trim|required|max_length[80]'
					),
					array(
						'field' => 'email_id',
						'label' => 'Email',
						'rules' => 'trim|required|max_length[100]|valid_email'
					),
					array(
						'field' => 'mobile_no',
						'label' => 'Mobile No.',
						'rules' => 'trim|required|max_length[18]'
					),
					array(
						'field' => 'password',
						'label' => 'Password',
						'rules' => 'trim|required|max_length[60]'
					)
			);
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run())
				{
				$this->users_model->addUserInformation($user_id);
				$this->message_output->set_success('User information  has been added.', TRUE);
				redirect(admin_path() . 'users');
				}
			  else $this->message_output->set_error($this->form_validation->output_errors());
			}
		 $this->load->view(admin_folder() . 'users/add');		
		}

	function edit($user_id, $submit = NULL)
		{
		 if ($submit != NULL)
			{
			$rules = array(
				
					array(
						'field' => 'full_name',
						'label' => 'Full Name',
						'rules' => 'trim|required|max_length[80]'
					),
					array(
						'field' => 'email_id',
						'label' => 'Email',
						'rules' => 'trim|required|max_length[100]|valid_email'
					),
					array(
						'field' => 'mobile_no',
						'label' => 'Mobile No.',
						'rules' => 'trim'
					)
			);
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run())
				{
				$this->users_model->ediUserInformation($user_id);
				$this->message_output->set_success('User information  has been updated.', TRUE);
				redirect(admin_path() . 'users');
				}
			  else $this->message_output->set_error($this->form_validation->output_errors());
			}
		     $data = array('StatusList'=>$this->config->item('StatusList'),		                       	 
					       'UserInfo'=>$this->users_model->getUserInformation($user_id),
					      'user_id'=>$user_id);	
		 $this->load->view(admin_folder() . 'users/edit',$data);		
		}
	
	
    function delete($user_id)
		{
			if ($user_id)
			{
			$this->users_model->delete_user($user_id);	
			$this->message_output->set_success('User Information has been deleted.', TRUE);			
			redirect(admin_path() . 'users');
			}
		  else
			{
			redirect(admin_path() . 'users');
			}
		}	

    function delete_photo($photo_id)
		{
			if ($photo_id)
			{
			$this->users_model->delete_user_photo($photo_id);	
			$this->message_output->set_success('Photo Information has been deleted.', TRUE);			
			redirect($_SERVER['HTTP_REFERER']);
			}
		  else
			{
			redirect($_SERVER['HTTP_REFERER']);
			}
		}	

	
	}