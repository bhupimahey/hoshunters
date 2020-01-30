<?php
class Messages_model extends CI_Model
	{		
	function ajax_messages_list()
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
		$sql = "SELECT * FROM messages WHERE message_id >0 ";
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
			$send_from_info  = $this->common_model->get_user_info($values->send_from);
			$send_from_name  = ucwords($send_from_info->full_name);
			
			$send_to_info  = $this->common_model->get_user_info($values->send_to);
			$send_to_name  = ucwords($send_to_info->full_name);
			
			if($values->message_status==0)
			 $message_status='Unread';
			elseif($values->message_status==1)
			 $message_status='Read';
			else
			$message_status='N/A';
			$records["data"][] = array(
				'send_from'=>$send_from_name,
                'send_to'=>$send_to_name,
                'message_body'=>$values->message_body,				
				'message_status' =>$message_status,
				'entry_date'=>date('d M, Y h:i A',strtotime($values->entry_time))
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
	}