<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Home extends CI_Controller
{    
    public function __construct()
    {
        parent::__construct();	
		$this->load->model(array('common_model','listings_model'));	
		$this->load->helper(array('string'));
    }
    public function index($page=NULL)
     {
	   $data = array('listings_list'=>$this->listings_model->getListingResult(9)); 	 
	   $this->load->view('pages/home',$data);	   
	 }	 

	 
    public function find_place()
     {      
	  if ($this->auth->user_logged_in())
	       redirect(customer_path().'listings/find_a_place'); 
              
      else	      		
		  redirect(base_url().'login'); 
	 }	 

	public function search_property($submit=NULL)
     {
	    if($submit!=NULL){
	      
	      $this->session->unset_userdata('s_search_parametrs');     
	      $status_type        = $this->input->post('status_type');
	      $preferred_language = $this->input->post('preferred_language');
	      $searchsuburb       =  $this->input->post('searchsuburb');
	      $country_by         = rtrim($this->input->post('search_p_country'),',');
		  $state_by           = rtrim($this->input->post('search_p_state'),',');
		  $city_by            = rtrim($this->input->post('search_p_city'),',');
		  $street_by          = rtrim($this->input->post('search_p_street'),',');
		  $postalcode_by      = rtrim($this->input->post('search_p_postal_code'),',');
	      
	      if($status_type=='1'){
	        $min_rent         = $this->input->post('min_rent');
		    $max_rent         = $this->input->post('max_rent');
		    $search_by        = $this->input->post('search_by');
		    $available_from   = $this->input->post('available_from');
		    $any_gender       = $this->input->post('any_gender');
		     $rooms_types     = $this->input->post('room');
		    $bathrooms_types  = $this->input->post('bathrooms_types');
		    $room_furnishing  = $this->input->post('room_furnishing');
		    $staylength       = $this->input->post('staylength');
		    $anyparking       = $this->input->post('anyparking');
		    $avail_bedroom    = $this->input->post('avail_bedroom');
		    $this->session->unset_userdata('s_search_parametrs');
		    $search_parametrs = array('status_type'=> $status_type,'min_rent'=>$min_rent,'max_rent'=>$max_rent,'search_by'=>$search_by,
	                                  'flatmatespref_status'=>'','searchsuburb'=>$searchsuburb,
	                                  'country'=>$country_by,'state'=>$state_by,'city'=>$city_by,'street'=>$street_by,'postal_code'=>$postalcode_by,
	                                  'available_from'=>$available_from,'any_gender'=>$any_gender,'rooms_types'=>$rooms_types,'bathrooms_types'=>$bathrooms_types,
	                                  'room_furnishing'=>$room_furnishing,'staylength'=>$staylength,'anyparking'=>$anyparking,'avail_bedroom'=>$avail_bedroom,
	                                  'omin_age'=>'','omax_age'=>'','omin_rent'=>'','omax_rent'=>'',
	                                  'oavailable_from'=>'','omin_stay'=>'','omax_stay'=>'',
	                                  'peoplethatare'=>'','oprofessionals'=>'','spreferred_language'=>$preferred_language );
	  	    $this->session->set_userdata('s_search_parametrs',$search_parametrs);
	      }
	      
	      elseif($status_type=='2' || $status_type=='3'){
	        $this->session->unset_userdata('s_search_parametrs');  
	        $flatmatespref_status  = $this->input->post('flatmatespref_status');
		    $search_by             =  $this->input->post('search_by');
		    $omin_age              = $this->input->post('omin_age');
		    $omax_age              = $this->input->post('omax_age');
		    $omin_rent             = $this->input->post('omin_rent');
		    $omax_rent             = $this->input->post('omax_rent');
		    $oavailable_from       = $this->input->post('oavailable_from');
		    $opeoplelookingfor     = $this->input->post('opeoplelookingfor');
		    $omin_stay             = $this->input->post('omin_stay');
		    $omax_stay             = $this->input->post('omax_stay');
		    $peoplethatare         = $this->input->post('peoplethatare');
		    $oprofessionals        = $this->input->post('oprofessionals');
		    
		    
		    $search_parametrs =array('status_type'=> $status_type,'min_rent'=>'','max_rent'=>'','search_by'=>$search_by,
	                               'flatmatespref_status'=>$flatmatespref_status,'searchsuburb'=>$searchsuburb,
	                               'country'=>$country_by,'state'=>$state_by,'city'=>$city_by,'street'=>$street_by,'postal_code'=>$postalcode_by,
	                               'omin_age'=>$omin_age,'omax_age'=>$omax_age,'omin_rent'=>$omin_rent,'omax_rent'=>$omax_rent,
	                               'opeoplelookingfor'=>$opeoplelookingfor,
	                               'oavailable_from'=>$oavailable_from,'omin_stay'=>$omin_stay,'omax_stay'=>$omax_stay,
	                               'peoplethatare'=>$peoplethatare,'oprofessionals'=>$oprofessionals,'available_from'=>'','any_gender'=>'','rooms_types'=>'','bathrooms_types'=>'',
	                                  'room_furnishing'=>'','staylength'=>'','anyparking'=>'','avail_bedroom'=>'','spreferred_language'=>$preferred_language
	                               );
	  	    $this->session->set_userdata('s_search_parametrs',$search_parametrs);
	      }
	      redirect(base_url().'search');
	        
	    }	
	    else{
	        $s_search_parametrs = $this->session->userdata('s_search_parametrs');
	       
	        
	      if(isset($s_search_parametrs['status_type']))
	          $status_type = $s_search_parametrs['status_type'];
	         else
	          $status_type ='';
	     
        if(isset($s_search_parametrs['spreferred_language']))
        	$spreferred_language = $s_search_parametrs['spreferred_language'];
           else
        	$spreferred_language ='';
	     
	        
	      if(isset($s_search_parametrs['searchsuburb']))
	          $searchsuburb = $s_search_parametrs['searchsuburb'];
	         else
	          $searchsuburb ='';
	          
	      if(isset($s_search_parametrs['min_rent']))
	          $min_rent = $s_search_parametrs['min_rent'];
	         else
	          $min_rent ='';	          
	          
	      if(isset($s_search_parametrs['max_rent']))
	          $max_rent = $s_search_parametrs['max_rent'];
	         else
	          $max_rent ='';
	          
	      if(isset($s_search_parametrs['postal_code']))
	          $postal_code = $s_search_parametrs['postal_code'];
	         else
	          $postal_code ='';
	          
	          
	      if(isset($s_search_parametrs['search_by']))
	          $search_by = $s_search_parametrs['search_by'];
	         else
	          $search_by ='';	    
	          
	      if(isset($s_search_parametrs['flatmatespref_status']))
	          $flatmatespref_status = $s_search_parametrs['flatmatespref_status'];
	         else
	          $flatmatespref_status ='';
	          
	          
	      if(isset($s_search_parametrs['country']))
	          $country = $s_search_parametrs['country'];
	         else
	          $country ='';
	          
	      if(isset($s_search_parametrs['state']))
	          $state = $s_search_parametrs['state'];
	         else
	          $state =''; 
	          
	       
	      if(isset($s_search_parametrs['city']))
	          $city = $s_search_parametrs['city'];
	         else
	          $city ='';    
	   
	   	  if(isset($s_search_parametrs['street']))
	          $street = $s_search_parametrs['street'];
	         else
	          $street ='';  
	   
	    if(isset($s_search_parametrs['street']))
	          $street = $s_search_parametrs['street'];
	         else
	          $street ='';  
	          
	          
	     if(isset($s_search_parametrs['available_from']))
	          $available_from = $s_search_parametrs['available_from'];
	         else
	          $available_from ='';  
	   
	     if(isset($s_search_parametrs['any_gender']))
	          $any_gender = $s_search_parametrs['any_gender'];
	         else
	          $any_gender ='';   
	
	
		    if(isset($s_search_parametrs['rooms_types']))
	          $rooms_types = $s_search_parametrs['rooms_types'];
	         else
	          $rooms_types ='';   
	          
	     
	    if(isset($s_search_parametrs['bathrooms_types']))
	          $bathrooms_types = $s_search_parametrs['bathrooms_types'];
	         else
	          $bathrooms_types ='';   
		    
	  if(isset($s_search_parametrs['room_furnishing']))
	          $room_furnishing = $s_search_parametrs['room_furnishing'];
	         else
	          $room_furnishing ='';   
	          
	  if(isset($s_search_parametrs['staylength']))
	          $staylength = $s_search_parametrs['staylength'];
	         else
	          $staylength='';   
	          
	  if(isset($s_search_parametrs['anyparking']))
	          $anyparking = $s_search_parametrs['anyparking'];
	         else
	          $anyparking='';   		   
		   

	  if(isset($s_search_parametrs['avail_bedroom']))
	          $avail_bedroom = $s_search_parametrs['avail_bedroom'];
	         else
	          $avail_bedroom='';   

	     
	 	  if(isset($s_search_parametrs['omin_age']))
	          $omin_age = $s_search_parametrs['omin_age'];
	         else
	          $omin_age='';      
	     
	 	  if(isset($s_search_parametrs['omax_age']))
	          $omax_age = $s_search_parametrs['omax_age'];
	         else
	          $omax_age='';   	     
	
	 	  if(isset($s_search_parametrs['omin_rent']))
	          $omin_rent = $s_search_parametrs['omin_rent'];
	         else
	          $omin_rent='';  
	          
	 	  if(isset($s_search_parametrs['omax_rent']))
	          $omax_rent = $s_search_parametrs['omax_rent'];
	         else
	          $omax_rent='';  
	          

	 	  if(isset($s_search_parametrs['oavailable_from']))
	          $oavailable_from = $s_search_parametrs['oavailable_from'];
	         else
	          $oavailable_from='';  
	          
	 	  if(isset($s_search_parametrs['opeoplelookingfor']))
	          $opeoplelookingfor = $s_search_parametrs['opeoplelookingfor'];
	         else
	          $opeoplelookingfor='';  
	          
	 	  if(isset($s_search_parametrs['omin_stay']))
	          $omin_stay = $s_search_parametrs['omin_stay'];
	         else
	          $omin_stay='';  		    
		   
	 	  if(isset($s_search_parametrs['omax_stay']))
	          $omax_stay = $s_search_parametrs['omax_stay'];
	         else
	          $omax_stay='';  	
	          
	 	  if(isset($s_search_parametrs['peoplethatare']))
	          $peoplethatare = $s_search_parametrs['peoplethatare'];
	         else
	          $peoplethatare='';  
	          

	 	  if(isset($s_search_parametrs['oprofessionals']))
	          $oprofessionals = $s_search_parametrs['oprofessionals'];
	         else
	          $oprofessionals=''; 

	     
	          
	        $data = array('listings_list'=>$this->listings_model->searchListingResult(9),'status_type'=>$status_type,'searchsuburb'=>$searchsuburb,'min_rent'=>$min_rent,
	                     'max_rent'=>$max_rent,'search_by'=>$search_by,'flatmatespref_status'=>$flatmatespref_status,
	                     'country'=>$country,'state'=>$state,'city'=>$city,'street'=>$street,'postal_code'=>$postal_code,
	                     'available_from'=>$available_from,'any_gender'=>$any_gender,'bathrooms_types'=>$bathrooms_types,
	                     'room_furnishing'=>$room_furnishing,'staylength'=>$staylength,'anyparking'=>$anyparking,
	                     'avail_bedroom'=>$avail_bedroom,'omin_age'=>$omin_age,'omax_age'=>$omax_age,'omin_rent'=>$omin_rent,'omax_rent'=>$omax_rent,
	                     'oavailable_from'=>$oavailable_from,'opeoplelookingfor'=>$opeoplelookingfor,'omin_stay'=>$omin_stay,'omax_stay'=>$omax_stay,
	                     'peoplethatare'=>$peoplethatare,'oprofessionals'=>$oprofessionals,'rooms_types'=>$rooms_types
	                     ); 
	        $this->load->view('pages/search_result',$data); 
	       }
	    
	 }

	

	public function removeShortList($listing_id)
     {
		$this->load->model('shortlist_model'); 
	    $this->shortlist_model->deleteShortlist($listing_id); 	 
	 }

    public function viewShortList()
     {  //dumper('');
		$this->load->model('shortlist_model'); 
	    $data = array('short_list'=>$this->shortlist_model->getShortlist()); 	 
	    $this->load->view('pages/shortlists',$data);	   
	 }

	 
    public function list_my_place()
     {      
	  if ($this->auth->user_logged_in())	  
		  redirect(customer_path().'listings/list_my_place');  
      else	      		
		  redirect(base_url().'login'); 
	   
	 }
	 
	 
	public function contact_us()
     { 
	  	 
	   $this->load->view('pages/contact_us');	   
	 }
	 
	public function faq()
     { 
          
	    $data = array('faq_list'=>$this->common_model->getFaqList());	 
	   $this->load->view('pages/faq',$data);	   
	 }
	 	 
	 
     public function forgot_password($submit=FALSE){
		if($submit !== FALSE){
			$rules = array(
				array('field' => 'email_id', 'label' => 'Email address', 'rules' => 'trim|required|valid_email')
			);
			$this->form_validation->set_rules($rules);			
			if($this->form_validation->run()){
				
				$user = $this->common_model->get_user_pass_email($this->input->post('email_id'));
				if($user){
					$temp_pass = random_string('alnum', 8);
					$this->common_model->update_password($user->account_id, $temp_pass);

					////////////////////////////////////////
					// Send an HTML email
					////////////////////////////////////////				
					$base_url = base_url();
					$msg = "<p>Your password has been reset.  You can change it after logging in at <a href=\"{$base_url}login\">{$base_url}login</a>.<br/><br/>";
					$msg .= "Your username is: {$user->username}<br>Your new password is: {$temp_pass} <br></p>";
					
					$this->load->library('email');
				
					ob_start();
					$this->load->view('templates/forgot_password', array('message' => $msg));
					$html_msg = ob_get_clean();
					
					$this->email->set_mailtype('html');					
				
					$this->email->to($user->username);
					$this->email->from('info@hosthunters.com.au');
					$this->email->subject('Password reset');
					$this->email->message($html_msg);
					$this->email->send();
					
					$this->message_output->set_success('Your password has been reset and sent to your email address.', TRUE);
					redirect('login');
				} else {
					$this->message_output->set_error('User not found.');
				}
				
			}
			
		}
		$this->message_output->set_error($this->form_validation->output_errors());
		$this->load->view('pages/forgot_password');
	}	 
} 