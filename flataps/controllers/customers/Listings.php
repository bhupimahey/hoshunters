<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Listings extends CI_Controller
{    
	var $home_main_photo;
	var $home_thumb_photo;
	var $contact_main_photo;
	var $contact_thumb_photo;
	var $contact_mini_photo;

    public function __construct()
    {
        parent::__construct();	
		$this->auth->customer_restrict();
		$this->load->library(array('form_validation','pagination','upload','image_lib'));
		$this->load->model(array('common_model','listings_model'));	
	    $this->home_main_photo  = realpath(HMEPHT);
		$this->home_thumb_photo = realpath(HMEPHT_THUMB);
		
		$this->contact_main_photo  = realpath(CNTPHT);
		$this->contact_thumb_photo = realpath(CNTPHT_THUMB);
		$this->contact_mini_photo = realpath(CNTPHT_MINI);
    }
    
   public	function index($pageno=NULL)
		{			
	
		hasPageAccess(2);    
		$user_id = $this->session->userdata('s_user_id');    
		$listings_list = $this->listings_model->ajax_listings_list($user_id);		
		$data = array('listings_list'=>$listings_list);
		$this->load->view(customer_folder() . 'view_profiles',$data);
		}   
 
   public	function verify_mobile()
		{			
	    if($this->session->userdata('u_l_list_id')){	    
		$user_id = $this->session->userdata('s_user_id');    
		$this->load->view(customer_folder() . 'verify_mobile');
	    }
	    else{
	       redirect(customer_path().'listings'); 
	      }
		}   
 
    
    public function find_a_place($submit=NULL)
     {  
        hasPageAccess(1);  
	    if($submit!=NULL){
		 $listing_id = $this->listings_model->update_request_info();
		 redirect(customer_path().'listing/preview/'.$listing_id);
	   }	     
	   $this->load->view('customers/listings/create_find_a_place');	   
	 }	 

   function edit_location_info($profile_id,$request_type){
       hasPageAccess(1); 
        $listing_info     = 	$this->listings_model->getListingInformation($profile_id);
		$data = array('request_type'=>$request_type,'listing_info'=>$listing_info,"profile_id"=>$profile_id 	);
		$this->load->view('customers/listings/edit_listing_location',$data);
    
   }

  function edit_about_info($profile_id,$request_type){
        hasPageAccess(1); 
        $listing_info     = 	$this->listings_model->getListingInformation($profile_id);
        $customer_couple_info = $this->common_model->get_couple_info($profile_id);
		 $customer_group_info = $this->common_model->get_group_info($profile_id);
		      
		$data = array('request_type'=>$request_type,'listing_info'=>$listing_info,"profile_id"=>$profile_id,
		'customer_couple_info'=>$customer_couple_info ,'customer_group_info'=>$customer_group_info 	);
		$this->load->view('customers/listings/edit_listing_about',$data);
    
   }

   function update_locations($profile_id,$submit=NULL){
       hasPageAccess(1); 
       if($submit!=NULL){
          $this->listings_model->updateLocations($profile_id); 
          $this->message_output->set_success('Location information has been updated.', TRUE);			
		  redirect(customer_path() . 'listing/preview/'.$profile_id);    
       }
       
   }
   
      function update_about($profile_id,$submit=NULL){
          hasPageAccess(1); 
       if($submit!=NULL){
          $this->listings_model->updateAboutInfo($profile_id); 
          $this->message_output->set_success('About information has been updated.', TRUE);			
		  redirect(customer_path() . 'listing/preview/'.$profile_id);    
       }
       
   }
   
    public function list_my_place($submit=NULL)
     {      
         hasPageAccess(1); 
  
	   if($submit!=NULL){
	      
		 $listing_id = $this->listings_model->update_home_request_info();
		
		 $this->session->unset_userdata('u_l_list_id');
		 if($this->session->userdata('s_temp_images')){
         $cache_images = $this->session->userdata('s_temp_images');
         foreach($cache_images as $key => $value){	 
        	 $temp_img_path=realpath(CACHEIMGPATH).$value;
        	// unlink($temp_img_path);
           }
          $this->session->unset_userdata('s_temp_images');    		
          }	
          
		 $this->session->set_userdata('u_l_list_id',$listing_id);
		 redirect(customer_path().'listing/preview/'.$listing_id);
	   }
	   else{
	    if($this->session->userdata('s_temp_images')){
         $cache_images = $this->session->userdata('s_temp_images');
         foreach($cache_images as $key => $value){	 
        	 $temp_img_path=realpath(CACHEIMGPATH).$value;
        	 //unlink($temp_img_path);
           }
          $this->session->unset_userdata('s_temp_images');    		
          }	   
	  
	   }
	   $this->load->view('customers/listings/create_list_my_place');	   
	 }	 

    public function view_listing($listing_id)
     {      
         hasPageAccess(2); 
       $this->session->unset_userdata('u_l_list_id');
       $this->session->set_userdata('u_l_list_id',$listing_id);
           
	   $listing_info          = $this->listings_model->getListingInformation($listing_id);
	   $listing_type          = $listing_info->profile_type;
	   $listing_preferences   = $this->listings_model->getPreferencesInformation($listing_id);
	   $flatmates_preferences = $this->listings_model->getFlatmatesPreferences($listing_id);
	   $users_flatmates_preferences = $this->listings_model->getUsersFlatmatesPreferences($listing_id);
	   $length_of_stay        = $this->config->item("length_of_stay");	
	   if($listing_type ==1 ){
	        $photos               = $this->listings_model->getPhotos($listing_id);
	         $customer_photo_info = $this->common_model->get_user_photo($listing_id);
		     $customer_couple_info = $this->common_model->get_couple_info($listing_id);
		      $customer_group_info = $this->common_model->get_group_info($listing_id);
		    
		    $data = array(
                      'ListingInfo'=>$listing_info,
					  'length_of_stay'=>$length_of_stay,
					  'listing_preferences'=>$listing_preferences,
					  'customer_photo_info' =>$customer_photo_info,
					   'listing_id'=>$listing_id,'photos'=>$photos,
					  'flatmatepreferrences'=>$users_flatmates_preferences
					   );
	   $this->load->view('customers/listings/view_find_place',$data);	       
	       
	   }
	  else if($listing_type ==2 ){
	   $photos                = $this->listings_model->getPhotos($listing_id);
	   $about_property        = $this->listings_model->getAboutProperty($listing_id);
	   $about_rooms           = $this->listings_model->getRooms($listing_id);	
	   $room_features         = $this->listings_model->getRoomFeatures($listing_id);
	   $room_rentbills        = $this->listings_model->getRoomRentBills($listing_id); 
	   $room_availability     = $this->listings_model->getRoomAvailability($listing_id);
	   $locaton ='';
	   if($about_property->property_address){
		$suburb =  json_decode($about_property->property_address);
		if($suburb){
			foreach($suburb as $suburb_key => $suburb_val){
				$locaton =  $suburb_val->location;
			 }											    
		   }
		}

	   $data = array(
                       'ListingInfo'=>$listing_info,
					   'listing_id'=>$listing_id,
					   'about_property'=>$about_property,
					   'about_rooms'=>$about_rooms,'room_features'=>$room_features,
					   'room_rentbills'=>$room_rentbills,'room_availability'=>$room_availability,
					   'flatmates_preferences'=>$flatmates_preferences,'photos'=>$photos,
					   'locaton'=>$locaton	
					   );					   
	   $this->load->view('customers/listings/view_list_my_place',$data); 
	       
	   } 
	   
	   
	   
	 }	 
	 
    function home_photos($profile_id,$submit=NULL){
	   hasPageAccess(2); 
	   if($submit!=NULL){
		   $this->listings_model->upload_home_photos($profile_id);
		  
		   redirect(customer_path().'listing/preview/'.$profile_id);
	   }
	   $photos         = $this->listings_model->getPhotos($profile_id);
	   $data = array('profile_id'=>$profile_id,'photos'=>$photos);
	   $this->load->view('customers/listings/edit_listing_home_photos',$data);  
	   
   }
   function delete_photo($photo_id,$profile_id){
     hasPageAccess(2);   
	 $this->listings_model->deleteListingPhoto($photo_id,$profile_id);	
			$this->message_output->set_success('Photo information has been deleted.', TRUE);			
			redirect('customers/listings/home_photos/'.$profile_id);  
	   
   }
   
    function edit_looking_home($profile_id,$request_type){
       hasPageAccess(2); 
		$listing_info     = 	$this->listings_model->getListingInformation($profile_id);
		$preferences_info =     $this->listings_model->getPreferencesInformation($profile_id);
		$flatmatepreferrences  =  $this->listings_model->getUsersFlatmatesPreferences($profile_id);
	   		
		$data = array('request_type'=>$request_type,'listing_info'=>$listing_info,"profile_id"=>$profile_id,
					  'preferences_info'=>$preferences_info,'flatmatepreferrences'=>$flatmatepreferrences	);

		$this->load->view(customer_folder() . 'listings/looking_home/edit',$data);
		}
		
   function edit_home_request_info($profile_id,$request_type){
       hasPageAccess(2); 
		$listing_info     = 	$this->listings_model->getListingInformation($profile_id);
		$about_property   =     $this->listings_model->getAboutProperty($profile_id);
		$about_rooms      =     $this->listings_model->getRooms($profile_id);     	
		$room_features    =     $this->listings_model->getRoomFeatures($profile_id);     	
		$room_rentbills   =     $this->listings_model->getRoomRentBills($profile_id); 	
		$room_availability       =     $this->listings_model->getRoomAvailability($profile_id);
		$flatmates_preferences   =     $this->listings_model->getFlatmatesPreferences($profile_id);
		
		$data = array('request_type'=>$request_type,'listing_info'=>$listing_info,"profile_id"=>$profile_id,
					  'about_property'=>$about_property,'about_rooms'=>$about_rooms,
					  'room_features'=>$room_features,'room_rentbills'=>$room_rentbills,
					  'room_availability'=>$room_availability,'flatmates_preferences'=>$flatmates_preferences	);
		$this->load->view(customer_folder() . 'listings/offer_home/edit',$data);
		}
} 