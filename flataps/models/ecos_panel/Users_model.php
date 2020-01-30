<?php
class Users_model extends CI_Model
	{		
	function ajax_users_list()
		{
			
		if(isset($_GET['start'])){	
		$search_text = $_GET['search'];
		$length      = $_GET['length'];
		}
		else{
		$search_text='';			
		$length=10;
		}
		$start=($this->uri->segment(3)) ? $this->uri->segment(3) : 0;;
		$sql = "SELECT * FROM users WHERE account_id >0 ";
		if (!empty($search_text)) {
			$sql .= " AND (username LIKE '%" . $search_text . "%' OR full_name LIKE '%" . $search_text . "%' OR mobile_no LIKE '%" . $search_text . "%')";
		}		
		$sql .= " ORDER BY entry_time";
		$sql .= " DESC";		
		$counter_query = $this->db->query($sql);
		$iTotalRecords = $counter_query->num_rows();
		
		if (isset($start) || isset($length)) {
			$sql .= " LIMIT " . (int)$start . "," . (int)$length;
		}

		$query = $this->db->query($sql);
		$records = array();
		$records["data"] = array();
		$id = 0;
		$result = $query->result();
		foreach($result as $values)
			{
			$id = ($id + 1);
			$user_actions = '';
			$del_path = admin_path() . 'users/delete/' . $values->account_id;
			
			$user_profiles = $this->common_model->countUserProfiles($values->account_id);
			
			$user_actions = '<div class="message_action color-default-a mt-2">													
													<a href="' . admin_path() . 'users/edit/' . $values->account_id . '"  title="Edit User">Edit</a><br><a href="' . admin_path() . 'users/profiles/' . $values->account_id . '" title="View User Profiles">Profiles('.$user_profiles.')</a>
												</div>';
			$records["data"][] = array(
				'account_id'=>$values->account_id,
				'full_name'=>ucwords($values->full_name),
                'email_id'=>$values->email_id,
                'mobile_no'=>$values->mobile_no,				
				'info_actions'=>$user_actions,
				'username'=>$values->username,
				'account_status' =>$values->account_status,
				'entry_date'=>date('d M, Y',strtotime($values->entry_time))
			   );
			}

		$config = array();
        $config["base_url"] = admin_path() . "users";
        $config["total_rows"] = $iTotalRecords;
        $config["per_page"] = $length;
        $config["uri_segment"] = 3;
        $config['full_tag_open'] = '<ul class="pagination">';	
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link active" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tagl_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tagl_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item disabled">';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tagl_close'] = '</a></li>';
		$config['prev_link'] = 'Previous';
		$config['next_link'] = 'Next';
		$config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
        $config['attributes'] = array('class' => 'page-link');
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		$records["recordsTotal"] = $iTotalRecords;
		$records["links"] = $this->pagination->create_links();
		return $records;
		}
		
	function addUserInformation($user_id)
		{
			$insert_data = array(
			    'full_name'     => $this->input->post('full_name'),
				'email_id'      => $this->input->post('email_id'),
				'mobile_no'     => $this->input->post('mobile_no'),
				'password'      => salted_hash($this->input->post('password')),				
				'modify_time'   => date('Y-m-d H:i:s'),
				'entry_time'    => date('Y-m-d H:i:s'),
				'account_status' =>'1',
				'ip_address'    => ip_address()
			);		
			$this->db->insert('users', $insert_data);
			return TRUE;
		}

	function ediUserInformation($user_id)
		{
			$update_data = array(
			    'full_name'     => $this->input->post('full_name'),
				'email_id'      => $this->input->post('email_id'),
				'mobile_no'     => $this->input->post('mobile_no'),
				'account_status'=> $this->input->post('status'),				
				'modify_time'   => date('Y-m-d H:i:s')
			);		
			$this->db->where('account_id',$user_id);
			$this->db->update('users', $update_data);
			
			if($this->input->post('password')!=''){
			   $update_data = array(
				   'password'  =>salted_hash($this->input->post('password')),				  							   
				   'modified_time' => date('Y-m-d H:i:s') 							
			    );	
			$this->db->where('account_id',$user_id);
			$this->db->update('users', $update_data);
			}
			return TRUE;
		}

	function getUserInformation($user_id){
		$this->db->where('account_id',$user_id);
	    $query =  $this->db->get('users');
	    $result = $query->row();
	    return $result;
	 }
	
	function delete_user_photo($photo_id){
		$this->db->where('photo_id',$photo_id);
	    $this->db->delete('users_photos');
	}

	 
 
	}