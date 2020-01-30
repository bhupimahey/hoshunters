<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Not_authorize extends CI_Controller
	{
	public

	function __construct()
		{
		parent::__construct();
		$this->auth->admin_restrict();
		$this->load->library('form_validation');		
		}

	function index()
		{		
		$this->load->view(admin_folder().'not_authorize');
		}

	}
