<?php
class Faq_model extends CI_Model
	{
	function ajax_information_list()
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
		$sql = "SELECT * FROM faq WHERE faqid >0 ";
		if (!empty($search_text)) {
			$sql .= " AND faq_title LIKE '%" . $search_text . "%'";
		}		
		$sql .= " ORDER BY faq_title";
		$sql .= " ASC";		
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
			$del_path = admin_path() . 'faq/delete/' . $values->faqid;
			$user_actions = '<div class="message_action color-default-a mt-2">													
													<a href="' . admin_path() . 'faq/edit/' . $values->faqid . '" class="" title="Edit Faq"><i class="icofont icofont-ui-edit"></i>Edit | </a>
													<a href="' . admin_path() . 'faq/delete/' . $values->faqid . '" class="delete_record" title="Delete Faq"><i class="icofont icofont-delete-alt"></i>Delete</a>
												</div>';
			$records["data"][] = array(
				'info_id'=>$id,
				'info_title'=>ucwords($values->faq_title),										
				'info_actions'=>$user_actions,
				'entry_date'=>date('d M, Y',strtotime($values->entry_time)),
				'entry_time'=>date('h:i A',strtotime($values->entry_time))
			   );
			}

		$config = array();
        $config["base_url"] = admin_path() . "information";
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



	 function addInformation() {
		$information_url_title   = url_title(strtolower($this->input->post('faq_title')), "_", TRUE);
		$information_name = $this->input->post('faq_title');
		$info_desc = $this->input->post('faq_desc');
		$this->db->query("INSERT INTO faq SET faq_url = '" . $information_url_title . "', faq_title = '" . $information_name . "', faq_desc = '" . $info_desc . "', entry_time = '" . date('Y-m-d H:i:s') . "'");
		$information_id = $this->db->insert_id();
	
		
		return $information_id;
	}

	 function editInformation($information_id) {
		 
		 
		$information_url_title   = url_title(strtolower($this->input->post('faq_title')), "_", TRUE);
		$information_name = $this->input->post('faq_title');
		$info_desc = $this->input->post('faq_desc');
	
		$this->db->query("UPDATE faq SET faq_url = '" . $information_url_title . "', faq_title = '" . $information_name . "', faq_desc = '" . $info_desc . "' WHERE faqid = '" . (int)$information_id . "'");
		 
		
	}

	 function deleteInformation($information_id) {
		$this->db->query("DELETE FROM faq WHERE faqid = '" . (int)$information_id . "'");		
	}

	 function getInformation($information_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM faq WHERE faqid = '" . (int)$information_id . "'");

		return $query->row();
	}

		
	}