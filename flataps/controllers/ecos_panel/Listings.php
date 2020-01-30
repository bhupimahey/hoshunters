<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Listings extends CI_Controller
	{
	var $home_main_photo;
	var $home_thumb_photo;
	var $contact_main_photo;
	var $contact_thumb_photo;
	var $contact_mini_photo;
	public
	function __construct()
		{
		parent::__construct();
		$this->auth->admin_restrict();
		$this->load->library(array('form_validation','pagination','upload','image_lib'));
		$this->load->model(array(admin_folder . 'listings_model','common_model'));
		
		$this->home_main_photo  = realpath(HMEPHT);
		$this->home_thumb_photo = realpath(HMEPHT_THUMB);
		
		$this->contact_main_photo  = realpath(CNTPHT);
		$this->contact_thumb_photo = realpath(CNTPHT_THUMB);		
        $this->contact_mini_photo = realpath(CNTPHT_MINI);
		}

	function index($page_no=1)
		{			
		$listings_list = $this->listings_model->ajax_listings_list();		
		$data = array('listings_list'=>$listings_list);
		$this->load->view(admin_folder() . 'listings/view',$data);
		}

	function profile_photos($profile_id)
		{			
		$photos_list = $this->listings_model->ajax_profilephoto_list($profile_id);		
		$data = array('photos_list'=>$photos_list);		
		$this->load->view(admin_folder() . 'listings/profile_photos',$data);
		}

	function view($listing_id, $submit = NULL)
		{
	      $roomtypes_status    = $this->config->item('roomtypes_status');
		  $roomfurnishings_status    = $this->config->item('roomfurnishings_status');
		  $property_type  = $this->config->item('property_type');
		  
		$listing_info   = 	$this->listings_model->getListingInformation($listing_id);
		$photos         = $this->listings_model->getPhotos($listing_id);
		
		
		if($listing_info){
		  $listing_type  = $listing_info->profile_type;	
		  $listing_preferences = $this->listings_model->getPreferencesInformation($listing_id);
		  
		  $length_of_stay = $this->config->item("length_of_stay");	
		   
					   
		if($listing_type=='1'){	
		    $customer_photo_info = $this->common_model->get_user_photo($listing_id);
		    $customer_info = $this->common_model->get_user_info($listing_info->account_id);
		     $customer_couple_info = $this->common_model->get_couple_info($listing_id);
		      $customer_group_info = $this->common_model->get_group_info($listing_id);
		      $users_flatmates_preferences = $this->listings_model->getUsersFlatmatesPreferences($listing_id);
		      
		      	if($customer_info){
			   $full_name  = ucwords($customer_info->full_name);
			   $mobile_no  = $customer_info->mobile_no;
			}
			else{
				$full_name  = '';
			    $mobile_no  = '';
			 }
			 
			 
		       $location = $listing_info->suburb;
			      $location = json_decode( $location);
			       $location_info='';
			      if($location){
			          foreach($location as $location_values){
			                $location_info .=  $location_values->location.'<br>';
			          }
			      
			      }
		      
		      
		     $profile_property_type= $full_name.' Looking in '.$location_info;
		    $data = array(
                      'ListingInfo'=>$listing_info,
					  'length_of_stay'=>$length_of_stay,
					  'profile_property_type'=>$profile_property_type,
					  'listing_preferences'=>$listing_preferences,
					  'customer_photo_info' =>$customer_photo_info,
					   'listing_id'=>$listing_id,'photos'=>$photos,
					   'flatmatepreferrences'=>$users_flatmates_preferences
					   
					   
					   );
		   $this->load->view(admin_folder() . 'listings/view_listing_lookinghome',$data);
		}
		elseif($listing_type=='2'){				
		$about_property   =     $this->listings_model->getAboutProperty($listing_id);
		$about_rooms      =     $this->listings_model->getRooms($listing_id);	
		$room_features    =     $this->listings_model->getRoomFeatures($listing_id);
		$room_rentbills   =     $this->listings_model->getRoomRentBills($listing_id); 
		$room_availability   =     $this->listings_model->getRoomAvailability($listing_id);
		$flatmates_preferences   =     $this->listings_model->getFlatmatesPreferences($listing_id);
		$homedes_rooms         = $this->common_model->homedes_rooms($listing_info->profile_id);
		
		if($homedes_rooms){
             $room_type = $roomtypes_status[$homedes_rooms->room_type];
              if(isset($roomfurnishings_status[$homedes_rooms->room_furnishings]))
                    $room_furnishings = $roomfurnishings_status[$homedes_rooms->room_furnishings];
               else
                    $room_furnishings ='';
                }
            else{
                $room_furnishings='';
                $room_type='';
                }
		     
		if(isset($property_type[$listing_info->property_type]))     
		$profile_property_type= $room_furnishings.' room in a '.$room_type.' '.$property_type[$listing_info->property_type];     
		else
		$profile_property_type = $room_furnishings.' '.$room_type.' room ';
		
		$data = array(
                       'ListingInfo'=>$listing_info,
					   'listing_id'=>$listing_id,
					    'profile_property_type'=>$profile_property_type,
					   'about_property'=>$about_property,
					   'about_rooms'=>$about_rooms,'room_features'=>$room_features,
					   'room_rentbills'=>$room_rentbills,'room_availability'=>$room_availability,
					   'flatmates_preferences'=>$flatmates_preferences,'photos'=>$photos	
					   );
           
		   $this->load->view(admin_folder() . 'listings/view_listing_offerhome',$data);
		}
			
		}
		else
		 redirect(admin_path() . 'listings');	
		}

   function edit_location_info($profile_id,$request_type){
        $listing_info     = 	$this->listings_model->getListingInformation($profile_id);
		$data = array('request_type'=>$request_type,'listing_info'=>$listing_info,"profile_id"=>$profile_id 	);
		$this->load->view(admin_folder() . 'listings/edit_listing_location',$data);
    
   }

  function edit_about_info($profile_id,$request_type){
        $listing_info     = 	$this->listings_model->getListingInformation($profile_id);
        $customer_couple_info = $this->common_model->get_couple_info($profile_id);
		 $customer_group_info = $this->common_model->get_group_info($profile_id);
		      
		$data = array('request_type'=>$request_type,'listing_info'=>$listing_info,"profile_id"=>$profile_id,
		'customer_couple_info'=>$customer_couple_info ,'customer_group_info'=>$customer_group_info 	);
		$this->load->view(admin_folder() . 'listings/edit_listing_about',$data);
    
   }



   function edit_looking_home($profile_id,$request_type){
		$listing_info     = 	$this->listings_model->getListingInformation($profile_id);
		$preferences_info =     $this->listings_model->getPreferencesInformation($profile_id);
		$users_flatmates_preferences = $this->listings_model->getUsersFlatmatesPreferences($profile_id);
		$flatmates_preferences   =     $this->listings_model->getFlatmatesPreferences($profile_id);
       		
		$data = array('request_type'=>$request_type,'listing_info'=>$listing_info,"profile_id"=>$profile_id,
					  'preferences_info'=>$preferences_info	,'flatmatepreferrences'=>$users_flatmates_preferences,
					  'flatmates_preferences'=>$flatmates_preferences);
		$this->load->view(admin_folder() . 'listings/edit_looking_home',$data);
		}
		
   function edit_home_request_info($profile_id,$request_type){
		$listing_info     = 	$this->listings_model->getListingInformation($profile_id);
		$about_property   =     $this->listings_model->getAboutProperty($profile_id);
		$about_rooms      =     $this->listings_model->getRooms($profile_id);     	
		$room_features    =     $this->listings_model->getRoomFeatures($profile_id);     	
		$room_rentbills   =     $this->listings_model->getRoomRentBills($profile_id); 	
		$room_availability   =     $this->listings_model->getRoomAvailability($profile_id);
		$flatmates_preferences   =     $this->listings_model->getFlatmatesPreferences($profile_id);
		
		$data = array('request_type'=>$request_type,'listing_info'=>$listing_info,"profile_id"=>$profile_id,
					  'about_property'=>$about_property,'about_rooms'=>$about_rooms,
					  'room_features'=>$room_features,'room_rentbills'=>$room_rentbills,
					  'room_availability'=>$room_availability,'flatmates_preferences'=>$flatmates_preferences	);
		$this->load->view(admin_folder() . 'listings/edit_offer_home',$data);
		}

   function home_photos($profile_id,$submit=NULL){
	   
	   if($submit!=NULL){
		   $this->listings_model->upload_home_photos($profile_id);
		  
		   redirect(admin_path().'listings/view/'.$profile_id);
	   }
	   $photos         = $this->listings_model->getPhotos($profile_id);
	   $data = array('profile_id'=>$profile_id,'photos'=>$photos);
	   $this->load->view(admin_folder() . 'listings/listing_home_photos_info',$data);  
	   
   }
   function delete_photo($photo_id,$profile_id){
	 $this->listings_model->deleteListingPhoto($photo_id,$profile_id);	
			$this->message_output->set_success('Photo information has been deleted.', TRUE);			
			redirect(admin_path() . 'listings/home_photos/'.$profile_id);  
	   
   }
  
     function confirm_listing($profile_id){
	 $this->listings_model->confirmListing($profile_id);	
			$this->message_output->set_success('Listing  has been Confirmed.', TRUE);			
			redirect(admin_path() . 'listings');  
	   
   }
   
   function update_locations($profile_id,$submit=NULL){
       if($submit!=NULL){
          $this->listings_model->updateLocations($profile_id); 
          $this->message_output->set_success('Location information has been updated.', TRUE);			
		  redirect(admin_path() . 'listings/view/'.$profile_id);    
       }
       
   }
   
      function update_about($profile_id,$submit=NULL){
       if($submit!=NULL){
          $this->listings_model->updateAboutInfo($profile_id); 
          $this->message_output->set_success('About information has been updated.', TRUE);			
		  redirect(admin_path() . 'listings/view/'.$profile_id);    
       }
       
   }
   
   
   function delete($listing_id)
		{
			if ($listing_id)
			{
			$this->listings_model->deleteListingInformation($listing_id);	
			$this->message_output->set_success('Listing information has been deleted.', TRUE);			
			redirect(admin_path() . 'listings');
			}
		  else
			{
			redirect(admin_path() . 'listings');
			}
		}

	}