<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Messages extends CI_Controller
	{
	public

	function __construct()
		{
		parent::__construct();
		$this->auth->admin_restrict();
		$this->load->library(array('form_validation'));
		$this->load->model(array(admin_folder . 'messages_model','common_model'));
		}
	function index()
		{
		$messages_list = $this->messages_model->ajax_messages_list();
		
		$data = array('messages_list'=>$messages_list);	
		$this->load->view(admin_folder() . 'messages/view',$data);
		}
	}