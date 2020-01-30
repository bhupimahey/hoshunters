<?php
class Auth
	{
	var $CI = null;
	var $redirect = 'dashboard';
	var $login_page = 'login';
	var $user = null;
	function __construct()
		{
		$this->CI = & get_instance();
		$this->CI->load->model(array(
			'common_model'
		));
		}

	function admin_login($username, $password)
		{
		$admin_data = $this->CI->common_model->admin_login_user($username, $password);
		if ($admin_data)
			{
			$this->admin_data = $admin_data;
			
				$this->CI->session->unset_userdata(array(
					's_admin_name',
					's_admin_email',
					's_admin_id'
					
				));
				$this->CI->session->set_userdata(array(
					's_admin_name' => $this->admin_data->full_name,
					's_admin_email' => $this->admin_data->account_username,
					's_admin_id' => $this->admin_data->account_id
				));
				
					$this->CI->session->set_userdata('user_type', 'ad');
				

				return TRUE;
				
			}

		return FALSE;
		}

	function user_login($username, $password,$user_data)
		{		
		if ($user_data)
			{
			$this->user_data = $user_data;
			$account_active = $this->CI->common_model->is_user_active($this->user_data);
			if ($account_active == '1')
				{
				$this->CI->session->unset_userdata(array(
					's_user_name',
					's_user_email',
					's_user_id',
					's_is_social_login',
					's_user_roles'
				));
				
				$s_user_name = $this->user_data->full_name;					
				$this->CI->session->set_userdata(array(
						's_user_name'  => $s_user_name,
						's_user_mob'   => $this->user_data->mobile_no,
						's_user_email' => $this->user_data->email_id,
						's_user_id'    => $this->user_data->account_id,
						's_is_social_login'=>0
						
					));
			  
				return TRUE;
				}
			  else
				{
				return FALSE;
				}
			}

		return FALSE;
		}
	function social_login($user)
		{
		if ($user && $this->CI->common_model->is_user_active($user))
			{
			$this->user = $user;
			$this->CI->session->unset_userdata('s_user_name');
			$this->CI->session->unset_userdata('s_user_mob');
			$this->CI->session->unset_userdata('s_user_email');
			$this->CI->session->unset_userdata('s_user_email');
			$this->CI->session->unset_userdata('s_user_id');
			$this->CI->session->unset_userdata('s_is_social_login');
			
			$this->CI->session->set_userdata('s_user_name', ($this->user->full_name));
			$this->CI->session->set_userdata('s_user_mob', $this->user->mobile_no);
			$this->CI->session->set_userdata('s_user_email', $this->user->email_id);
			$this->CI->session->set_userdata('s_user_id', $this->user->account_id);
			$this->CI->session->set_userdata('s_is_social_login',1);
			return TRUE;
			}

		return FALSE;
		}

	function customer_logout()
		{
		$this->CI->session->unset_userdata('s_user_name');
		$this->CI->session->unset_userdata('s_user_email');
		$this->CI->session->unset_userdata('s_user_id');
		$this->CI->session->unset_userdata('s_is_social_login');
		$this->CI->session->unset_userdata('s_user_roles');
		$this->CI->session->set_flashdata('_error', '');
		$this->CI->session->set_flashdata('_success', '');
		return TRUE;
		}

	function redirect()
		{
		$this->CI->forward->run('default', $this->redirect);
		}

	function admin_restrict()
		{
		if ($this->CI->session->userdata('s_admin_id') == '')
			{
			redirect(admin_folder() . 'login');
			}
		}

	function customer_restrict($type = NULL)
		{
		if ($this->CI->session->userdata('s_user_id') != '')
			{
			if (($type == 'us') && $this->CI->session->userdata('s_user_id') == '')
				{
				redirect(user_path() . 'login');
				}
			}
		  else redirect('login');
		}



	function user_logged_in()
		{
		if ($this->CI->session->userdata('s_user_id'))
			{
			$user = $this->CI->common_model->get_user_by_id($this->CI->session->userdata('s_user_id'));
			if ($user )
				{
				$this->user = $user;
				return TRUE;
				}
			}

		return FALSE;
		}

	function admin_logged_in()
		{
		$user = $this->CI->common_model->get_admin_by_id($this->CI->session->userdata('s_admin_id'));
		if ($user)
			{
			$this->user = $user;
			return TRUE;
			}

		return FALSE;
		}

	function remember_id($user)
		{
		return sprintf('%x', $user->user_id) . md5($user->email . $user->password);
		}

	function admin_logout($type = '')
		{
		$unset_data = array(
			's_admin_name',
			's_admin_id',
			'user_type',
			's_admin_email'
		);
		$this->CI->session->unset_userdata($unset_data);
		return TRUE;
		}
	}