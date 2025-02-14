<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Config_data extends CI_Config
{

	function Config_data()
	{
		parent::__construct();
		
		$CI =& get_instance();
		
	} //Controller End
	
  function db_config_fetch()
    {
		//Create Codeigniter object
        $CI =& get_instance();
		
		//Condition - Get System Related Variables
		$CI->db->where('setting_type', 'S');		
		$CI->db->select('code,value_type,int_value,string_value,text_value');		
		$query = $CI->db->get('settings');
		
        foreach ($query->result() as $row)
        {
		// Conditions based on value type field
		    if($row->value_type =='I' )
		    {
		         $this->set_item(strtolower($row->code),$row->int_value);
		    }//if End
		    if($row->value_type =='T' )
		    {
				$this->set_item(strtolower($row->code),$row->text_value);
			        
		    }//if End
		    if($row->value_type =='S' )
		    {
		         $this->set_item(strtolower($row->code),$row->string_value);
		    } //if End 
        }// Foreach End
		
		$social_site_settings_query = $CI->db->get('settings');
		
		$social_site_settings=$social_site_settings_query->result();
		
		//var_dump($social_site_settings); exit;
		
		foreach($social_site_settings[0] as $key=>$social_site_setting)
		{
			$this->set_item(strtolower($key),$social_site_setting);
		}
		

    } //Function end db_config_fetch	

} //Class 
?>
