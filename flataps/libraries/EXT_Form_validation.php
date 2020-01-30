<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Form Validation Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Validation
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/form_validation.html
 */

class EXT_Form_validation extends CI_Form_validation {
	
	var $_check_field = array();
	
	/**
	 * Set Rules
	 *
	 * This function takes an array of field names and validation
	 * rules as input, validates the info, and stores it
	 *
	 * @access	public
	 * @param	mixed
	 * @param	string
	 * @return	void
	 */
	function set_rules($field, $label = '', $rules = '',$errors='')
	{
		// No reason to set rules if we have no POST data
		if (count($_POST) == 0)
		{
			return;
		}
	
		// If an array was passed via the first parameter instead of indidual string
		// values we cycle through it and recursively call this function.
		if (is_array($field))
		{
			foreach ($field as $row)
			{
				// Houston, we have a problem...
				if ( ! isset($row['field']) OR ! isset($row['rules']))
				{
					if(is_array($row) && $this->_config_rules == array()) $this->_config_rules = $field;
					continue;
				}

				// If the field label wasn't passed we use the field name
				$label = ( ! isset($row['label'])) ? $row['field'] : $row['label'];

				// Here we go!
				$this->set_rules($row['field'], $label, $row['rules']);
			}
			return;
		}
		
		// No fields? Nothing to do...
		if ( ! is_string($field) OR  ! is_string($rules) OR $field == '')
		{
			return;
		}

		// If the field label wasn't passed we use the field name
		$label = ($label == '') ? $field : $label;

		// Is the field name an array?  We test for the existence of a bracket "[" in
		// the field name to determine this.  If it is an array, we break it apart
		// into its components so that we can fetch the corresponding POST data later		
		if (strpos($field, '[') !== FALSE AND preg_match_all('/\[(.*?)\]/', $field, $matches))
		{	
			// Note: Due to a bug in current() that affects some versions
			// of PHP we can not pass function call directly into it
			$x = explode('[', $field);
			$indexes[] = current($x);

			for ($i = 0; $i < count($matches['0']); $i++)
			{
				if ($matches['1'][$i] != '')
				{
					$indexes[] = $matches['1'][$i];
				}
			}
			
			$is_array = TRUE;
		}
		else
		{
			$indexes 	= array();
			$is_array	= FALSE;		
		}
		
		// Build our master array		
		$this->_field_data[$field] = array(
											'field'				=> $field, 
											'label'				=> $label, 
											'rules'				=> $rules,
											'is_array'			=> $is_array,
											'keys'				=> $indexes,
											'postdata'			=> NULL,
											'error'				=> ''
											);
	}

	// --------------------------------------------------------------------
	
	/**
	 * Run the Validator
	 *
	 * This function does all the work.
	 *
	 * @access	public
	 * @return	bool
	 */		
	function run($group = '')
	{
		// Do we even have any data to process?  Mm?
		if (count($_POST) == 0)
		{
			return FALSE;
		}
		
		if($group != '') $this->_field_data = array();
		// Does the _field_data array containing the validation rules exist?
		// If not, we look to see if they were assigned via a config file
		if (count($this->_field_data) == 0)
		{
			// No validation rules?  We're done...
			if (count($this->_config_rules) == 0)
			{
				return FALSE;
			}
			
			// Is there a validation rule for the particular URI being accessed?
			$uri = ($group == '') ? trim($this->CI->uri->ruri_string(), '/') : $group;
			
			if ($uri != '' AND isset($this->_config_rules[$uri]))
			{
				$this->set_rules($this->_config_rules[$uri]);
			}
			else
			{
				$this->set_rules($this->_config_rules);
			}
	
			// We're we able to set the rules correctly?
			if (count($this->_field_data) == 0)
			{
				log_message('debug', "Unable to find validation rules");
				return FALSE;
			}
		}
	
		// Load the language file containing error messages
		$this->CI->lang->load('form_validation');
							
		// Cycle through the rules for each field, match the 
		// corresponding $_POST item and test for errors
		foreach ($this->_field_data as $field => $row)
		{		
			// Fetch the data from the corresponding $_POST array and cache it in the _field_data array.
			// Depending on whether the field name is an array or a string will determine where we get it from.
			
			if ($row['is_array'] == TRUE)
			{
				$this->_field_data[$field]['postdata'] = $this->_reduce_array($_POST, $row['keys']);
			}
			else
			{
				if (isset($_POST[$field]) AND $_POST[$field] != "")
				{
					$this->_field_data[$field]['postdata'] = $_POST[$field];
				}
			}
			
			$this->_execute($row, explode('|', $row['rules']), $this->_field_data[$field]['postdata']);		
		}

		// Did we end up with any errors?
		$total_errors = count($this->_error_array);

		if ($total_errors > 0)
		{
			$this->_safe_form_data = TRUE;
		}

		// Now we need to re-set the POST data with the new, processed data
		$this->_reset_post_array();
		
		// No errors, validation passes!
		if ($total_errors == 0)
		{
			return TRUE;
		}

		// Validation fails
		return FALSE;
	}
	
	function set_value($field = '', $default = '')
	{
		if ( ! isset($this->_field_data[$field]))
		{
			return $default;
		}
		
		$postdata = $this->_field_data[$field]['postdata'];
		
		if (is_array($postdata))
		{
			if(!isset($this->_check_field[$field])){
				$this->_check_field[$field] = array('postdata' => array(), 'found' => FALSE);
			}
			$check = array_slice($postdata, count($this->_check_field[$field]['postdata']));
			$val = current($check);	
			$this->_check_field[$field]['postdata'][] = $val;
			$this->_check_field[$field]['found'] = $val;
			return $val;
		}
		return $this->_field_data[$field]['postdata'];
	}
	
	function set_checkbox($field = '', $value = '', $default = FALSE)
	{
		if ( ! isset($this->_field_data[$field]) OR ! isset($this->_field_data[$field]['postdata']))
		{
			if ($default === TRUE AND count($this->_field_data) === 0)
			{
				return ' checked="checked"';
			}
			return '';
		}
	
		$postdata = $this->_field_data[$field]['postdata'];
		
		if (is_array($postdata))
		{
			if(!isset($this->_check_field[$field])){
				$this->_check_field[$field] = array('postdata' => array(), 'found' => FALSE);
			}
			
			$check = array_slice($postdata, count($this->_check_field[$field]['postdata']));
			$val = current($check);
			if((string)$val == (string)$value){
				$this->_check_field[$field]['postdata'][] = $val;
				$this->_check_field[$field]['found'] = $val;
				return ' checked="checked"';
			}
			return ''; 
		}
		else
		{
			if (($field == '' OR $value == '') OR ($field != $value))
			{
				return '';
			}
		}
			
		return ' checked="checked"';
	}
	
	function set_select($field = '', $value = '', $default = FALSE)
	{	
		if ( ! isset($this->_field_data[$field]) OR ! isset($this->_field_data[$field]['postdata']))
		{
			if ($default === TRUE AND count($this->_field_data) === 0)
			{
				return ' selected="selected"';
			}
			return '';
		}
		
		$postdata = $this->_field_data[$field]['postdata'];
		
		
		
		if (is_array($postdata))
		{
			if ( ! in_array($value, $postdata))
			{
				return '';
			}
			
			
			
			if(!isset($this->_check_field[$field])){
				$this->_check_field[$field] = array('postdata' => array(), 'found' => FALSE);
			}
			if($this->_check_field[$field]['found'] === FALSE){
				$check = array_slice($postdata, count($this->_check_field[$field]['postdata']));
				$val = current($check);	
				if($value == $val){
					$this->_check_field[$field]['postdata'][] = $val;
					$this->_check_field[$field]['found'] = $val;
					return ' selected="selected"';
				}
			}
			return '';
			
		}
		else
		{
			if (($postdata == '' OR $value == '') OR ($postdata != $value))
			{
				return '';
			}
		}
		return ' selected="selected"';
	}
	
	function next_select($field){
		if(isset($this->_check_field[$field])){			
			$this->_check_field[$field]['found'] = FALSE;
		}
	}
	
	function output_errors(){
		return $this->_error_array;
	}
	
	function not_matches($str, $field){
		$field = $_POST[$field];
		return ($str !== $field) ? TRUE : FALSE;
	}

}
// END Form Validation Class

/* End of file Form_validation.php */
/* Location: ./system/libraries/Form_validation.php */