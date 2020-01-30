<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Not_authorize extends CI_Controller {

	 public function __construct()
    {
        parent::__construct();
        $this->load->model(array('common_model'));
        $this->load->library(array('form_validation'));
    }
	public function index()
	{
		$this->load->view('pages/not_authorize');
	}
	

		
}

