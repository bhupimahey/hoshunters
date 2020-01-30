<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Listing_ajax extends CI_Controller
{    
    public function __construct()
    {
        parent::__construct();	
		$this->auth->admin_restrict();
		$this->load->model(array(admin_folder . 'listings_model','common_model'));	
    }


	public function update_request_info() {		    	
		echo $result = $this->listings_model->ajax_update_find_a_home_info();			
	}
	public function update_home_request_info() {		    	
		echo $result = $this->listings_model->ajax_update_update_offer_home_info();			
	}
} 