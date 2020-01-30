<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message_output {
	
	var $CI;
	var $success = array();
	var $error = array();
	var $error_group = array();
	var $success_group = array();

 function __construct(){	
		$this->CI =& get_instance();		
		$this->CI->load->library('session');

		if($this->CI->session->flashdata('_error')) $this->set_error($this->CI->session->flashdata('_error'));
		if($this->CI->session->flashdata('_success')) $this->set_success($this->CI->session->flashdata('_success'));
		
		if($this->CI->session->flashdata('_error_group')){
			list($group, $error) = explode('|', $this->CI->session->flashdata('_error_group'));
			$this->check_group($group);
			$this->set_error(explode(';', $error), $group);
		}
		if($this->CI->session->flashdata('_success_group')){
			list($group, $success) = explode('|', $this->CI->session->flashdata('_success_group'));
			$this->check_group($group);
			$this->set_success(explode(';', $success), $group);
		}
	}	

	function set_error($msg, $flash = FALSE, $group = FALSE){
		
		if($flash !== FALSE){
			if($group !== FALSE){
				$this->CI->session->set_flashdata('_error_group', $group.'|'.$msg);
			} else {
				$this->CI->session->set_flashdata('_error', $msg);
			}			
			return;
		}
		$error =& $this->error;
		if($group !== FALSE) $error =&$this->error_group[$group];
		if( is_array($msg) ){
		
			$error =array_merge($error, $msg);
		} else { 
			$error[] = $msg;
		}
			
	return $error;
	}
	
	function set_success($msg, $flash = FALSE, $group = FALSE){
		if($flash !== FALSE){
			if($group !== FALSE){
				$this->CI->session->set_flashdata('_success_group', $group.'|'.$msg);
			} else {
				$this->CI->session->set_flashdata('_success', $msg);
			}
			return;
		}
		$success =& $this->success;
		if($group !== FALSE) $success =& $this->success_group[$group];
		if( is_array($msg) ){
			$success = array_merge($success, $msg);
		} else {
			$success[] = $msg;
		}
		
		return $success;
	}

	function run($group = FALSE){
		if($group !== FALSE){
			$this->check_group($group);
			$success = $this->success_group[$group];
			$error = $this->error_group[$group];
		} else {
			$success = $this->success;
			$error = $this->error;
			
		}
		if(count($success) > 0){
			?>
			<div class="panel_massage color-primary mt_30 mb_60">
           	<?php foreach($success as $msg){ ?>
					<div class="success bg-white">
								  <span class="closebtn">×</span>  
								 	 <?php echo $msg; ?>
								</div>
				<?php } ?>
			</div>	
			<?php			
		}
		if(count($error) > 0){
			?>
           
			<div class="panel_massage color-primary mt_30 mb_60">
           	<?php foreach($error as $msg){ ?>
			<div class="alert success bg-white">
								  <span class="closebtn">×</span>  
								  <?php echo $msg; ?>
								</div>
								
					
				<?php } ?>
			</div>	
			<?php	
		}
	}
	
	function check_group($group){
		if(!isset($this->success_group[$group])) $this->success_group[$group] = array();
		if(!isset($this->error_group[$group])) $this->error_group[$group] = array();
	}

}