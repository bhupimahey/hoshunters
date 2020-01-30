<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_Forward {
	
	var $CI;

	function CI_Forward(){	
		$this->CI =& get_instance();		
		$this->CI->load->library('session');
		$this->CI->load->helper('url');
	}
	

	function set_forward($fw, $id='default'){
		$forward = $this->get_forward();
		$forward[$id] = $fw;
		$this->CI->session->set_userdata('_forward', $forward);
	}

	function run($id='default', $default='/', $clear=TRUE){
	 	$forward = $this->get_forward();
		if(isset($forward[$id])){
			$fw = $forward[$id];
			if($clear){
				unset($forward[$id]);
				$this->CI->session->set_userdata('_forward', $forward);
			}
			
			redirect($fw);
		}
		
		redirect($default);
	}
	
	function admin_run($id='default', $default='/', $clear=TRUE){
		
	 	$forward = $this->get_forward();
		
		if(isset($forward[$id])){
		$fw = $forward[$id];
			
			if($clear){
				unset($forward[$id]);
				$this->CI->session->set_userdata('_forward', $forward);
			}
			  // redirect($fw);
		}
		 
		 $default='admin/cms';		
	     redirect($default);
	}
	
	
	
	function brun($id='default', $default='/', $clear=TRUE){
		
	 	$forward = $this->get_forward();
		
		if(isset($forward[$id])){
		$fw = $forward[$id];
			
			if($clear){
				unset($forward[$id]);
				$this->CI->session->set_userdata('_forward', $forward);
			}
			   //redirect($fw);
		}
		 
		// $default='reminders';		
	     redirect($default);
	}
		
	function get_forward(){
		$forward = $this->CI->session->userdata('_forward');		
		if(!is_array($forward)) $forward = array('default' => $forward);
		return $forward;
	}
	
	

}