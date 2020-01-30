<?php
class Register_model extends CI_Model
	{
   	public function registerCustomer() {
		 $username        = $this->input->post('username');
		 $password     = salted_hash($this->input->post('password'));
		 $full_name    = $this->input->post('fullname');		 
		 $check_username  = $this->db->where('username', $username)->count_all_results('users');	
		 if ($check_username > 0)
			{
			return "email_exists";
			}
		  else
			{				
			$insert_data = array("username" =>$username,"password"=>$password,"full_name"=>$full_name,"email_id"=>$username,
								  "account_status"=>"1","entry_time"=>date('Y-m-d H:i:s'),"modify_time"=>date('Y-m-d H:i:s'),
								  "ip_address"=>ip_address());
			$this->db->insert("users",$insert_data);	
			
			
				////////////////////////////////////////
					// Send an HTML email
					////////////////////////////////////////			
					$base_url = base_url();
					$msg = "<p><h1>Welcome to Hosthunters</h1><p><br><br>
                            <p>Let's get your search started!<p><br><br><br>
                            <p>Login id :  ".$username."</p>
                            <p>Password:   ".$this->input->post('password')."</p>
                            <p>Create your listing</p><br>Whether you're looking for a new flatmate or a new home, a listing will ensure your search is a successful one. It's free to create a listing and only takes a few minutes.<br><br>
					        <p><h4><a href=\"{$base_url}list_my_place\">List my place</h4> &nbsp;&nbsp; <h4><a href=\"{$base_url}find_place\">Find a place</a></h4>";
					
					$this->load->library('email');
				
					ob_start();
					$this->load->view('templates/register', array('message' => $msg));
					$html_msg = ob_get_clean();
					
					$this->email->set_mailtype('html');					
				
					$this->email->to($username);
					$this->email->from('info@hosthunters.com.au');//PIlmXIgXv6Qc
					$this->email->subject('Welcome to Hosthunters');
					$this->email->message($html_msg);
					$this->email->send();
					
			
			
			$user = $this->common_model->login_user($username, $this->input->post('password'));
		    $this->auth->user_login($username, $this->input->post('password'),$user);
		    // assign free package
		    $subscription_id=	$this->common_model->subscribe_free_package($this->session->userdata('s_user_id'));
			$this->session->set_userdata('s_subscription_id',$subscription_id);
			return "success";
			}		
		
	    }
		
	}