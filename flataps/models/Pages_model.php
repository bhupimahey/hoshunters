<?php
class Pages_model extends CI_Model
	{

    public	function page_info($page_url)
		{
		$this->db->where('name_url', $page_url);
		$query = $this->db->get('information_pages');
		$result = $query->row();
		return $result;
		}

	}