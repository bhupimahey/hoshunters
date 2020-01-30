<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Oldses extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array(
			'common_model'
		));	
    }
 
 function deleteoldsession()
  {
    $this->common_model->DeleteOldSession();
  }  
} 