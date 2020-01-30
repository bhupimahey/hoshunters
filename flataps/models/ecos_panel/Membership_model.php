<?php
class Membership_model extends CI_Model
	{
	function ajax_plans_list()
		{
		$planvaliditylist = $this->config->item('planvaliditylist');	
		if(isset($_GET['start'])){	
		$search_text = $_GET['search'];
		$length      = $_GET['length'];
		}
		else{
		$search_text='';			
		$length=10;
		}
		$start=($this->uri->segment(3)) ? $this->uri->segment(3) : 0;;
		$sql = "SELECT * FROM packages WHERE package_id >0 ";
		if (!empty($search_text)) {
			$sql .= " AND package_name LIKE '%" . $search_text . "%'";
		}		
		$sql .= " ORDER BY package_name";
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
			$del_path = admin_path() . 'membership_plans/delete/' . $values->package_id;
			$user_actions = '<div class="message_action color-default-a mt-2">													
													<a href="' . admin_path() . 'membership_plans/edit/' . $values->package_id . '" class="" title="Edit Plan"><i class="icofont icofont-ui-edit"></i>Edit | </a>
													<a href="' . admin_path() . 'membership_plans/delete/' . $values->package_id . '" class="delete_record" title="Delete Plan"><i class="icofont icofont-delete-alt"></i>Delete</a>
												</div>';
			$records["data"][] = array(
				'package_id'=>$values->package_id,
				'package_name'=>ucwords($values->package_name),
                'package_features'=>$values->package_features,
                'package_price'=>$values->package_price,				
				'info_actions'=>$user_actions,
				'package_validity'=>$planvaliditylist[$values->package_validity],
				'info_status' =>$values->status,
				'entry_date'=>date('d M, Y',strtotime($values->entry_time))
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

	 function addPlanInformation() {
		$plan_name     = $this->input->post('plan_name');
		$plan_features = $this->input->post('plan_features');
		$plan_cost     = $this->input->post('plan_cost');
		$status        = $this->input->post('status');
		$plan_validity = $this->input->post('plan_validity');	
		$plan_roles    = $this->input->post('package_roles');
		
		$highligh_package = $this->input->post('highligh_package');
		$special_notes    = $this->input->post('special_notes');
		
		if($highligh_package)
		  $show_highligh_package=1;
		else
		 $show_highligh_package=0;
		
		if($plan_roles){
		    $plan_roles = implode(",",$plan_roles);
		    $plan_roles = rtrim($plan_roles,",");
		}
		else
	    	$plan_roles = '';
				
		$this->db->query("INSERT INTO packages SET special_notes = '" . $special_notes . "',package_name = '" . $plan_name . "', package_features = '" . $plan_features . "', highligh_package='" . $show_highligh_package . "', package_price = '" . $plan_cost . "', package_validity = '" . $plan_validity . "', roles = '" . $plan_roles . "',status = '" . (int)$status . "',entry_time = '" . date('Y-m-d H:i:s') . "',ip_address = '" .ip_address(). "'");
		$plan_id = $this->db->insert_id();
		return $plan_id;
		
		$this->db->where('package_id !=',$plan_id);
		$this->db->update('packages',array('highligh_package'=>'0'));
		
	}

	 function editPlanInformation($plan_id) {	 
		 
		$plan_name     = $this->input->post('plan_name');
		$plan_features = $this->input->post('plan_features');
		$plan_cost     = $this->input->post('plan_cost');
		$status        = $this->input->post('status');
		$plan_validity = $this->input->post('plan_validity');
		$plan_roles    = $this->input->post('package_roles');
		
		$highligh_package = $this->input->post('highligh_package');
		$special_notes    = $this->input->post('special_notes');
		
		if($highligh_package)
		  $show_highligh_package=1;
		else
		 $show_highligh_package=0;
		 
		 
		if($plan_roles){
		    $plan_roles = implode(",",$plan_roles);
		    $plan_roles = rtrim($plan_roles,",");
		}
		else
	    	$plan_roles = '';
	    	
		    
		$this->db->query("UPDATE packages SET highligh_package='" . $show_highligh_package . "',special_notes = '" . $special_notes . "',package_name = '" . $plan_name . "', package_features = '" . $plan_features . "', package_price = '" . $plan_cost . "', package_validity = '" . $plan_validity . "', roles = '" . $plan_roles . "',status = '" . (int)$status . "' WHERE package_id = '" . (int)$plan_id . "'");
	    $this->db->where('package_id !=',$plan_id);
		$this->db->update('packages',array('highligh_package'=>'0'));	 
		return TRUE;
	}

	 function deletePlanInformation($plan_id) {
		$this->db->query("DELETE FROM packages WHERE package_id = '" . (int)$plan_id . "'");
        return TRUE;		
	}

	 function getPlanInformation($plan_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM packages WHERE package_id = '" . (int)$plan_id . "'");
		return $query->row();
	}

		
	}