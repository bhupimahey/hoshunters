<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Pages extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array(
			'pages_model'
		));	
    }
 
    public function index($page_url=NULL)
     {
         if($page_url!=NULL){
	        $data = array("page_info"=> $this->pages_model->page_info($page_url));
	        $this->load->view('pages/page',$data);	
         }
         else{
             redirtect(base_url());
             
         }
         
	 }

  
   
} 