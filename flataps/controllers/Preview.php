<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Preview extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array(
			'common_model','listings_model'
		));	
    }
 
    public function index($listingcode=NULL,$listing_id=NULL)
     {
         $final_code = $listingcode.$listing_id;
         if($listing_id!=NULL){
            $profile_info        =  $this->common_model->getProfileInfo($listing_id);
            if($profile_info){
                $check_access = $this->common_model->hasAccess('3');
                $check_mobile_access = $this->common_model->hasAccess('4');
                $sms_to_all_access = $this->common_model->hasAccess('6');
                
                $profile_type = $profile_info->profile_type;
                
                
                $total_bedrooms_config       = $this->config->item('total_bedrooms');
                 $total_bathrooms_config       = $this->config->item('total_bathrooms');
                
                if( $profile_type=='1'){
                  $length_of_stay_config            = $this->config->item('length_of_stay');
                  $gender_you_identify              = $this->config->item('gender_you_identify');
                  $lifestyle_status_config          = $this->config->item('lifestyle_status');
                  $property_reference_rooms         = $this->config->item('property_reference_rooms');
                  $property_reference_internet      = $this->config->item('property_reference_internet');
                  $property_reference_bathroom      = $this->config->item('property_reference_bathroom');
                  $property_reference_parking       = $this->config->item('property_reference_parking');
                  $property_reference_maxflatmates  = $this->config->item('property_reference_maxflatmates');
                  $place_looking_for_config         = $this->config->item('place_looking_for');
                  $get_user_info                    = $this->common_model->get_user_info($profile_info->account_id);  
                  $profile_photo_info               = $this->common_model->get_user_photo($listing_id);
                  $listing_preferences              = $this->listings_model->getPreferencesInformation($listing_id);
                  
                  
                   $location_info = json_decode($profile_info->suburb);
                   if($location_info[0])
                    $location = $location_info[0]->location;    
                    
                    $full_name        = $get_user_info->full_name;
                    $mobile_no        = $get_user_info->mobile_no;
                    
                    $age              = $profile_info->me_age;   
                    $gender           = $gender_you_identify[$profile_info->me_gender];   
                    $weekly_budget    = $profile_info->weekly_budget;
                    $move_date        = $profile_info->preferred_move_date;
                    $length_of_stay   = $length_of_stay_config[$profile_info->length_of_stay];
                    $about_me         = $profile_info->great_live_with_text;
                    $life_style       = $profile_info->life_style;
                    $place_looking_for= $profile_info->place_looking_for;
                    $teamups          = $profile_info->teamups;
                    $locations        = $profile_info->suburb;
                    
                    $life_style_list=array();
                    if($life_style){
                        
                        $life_style = explode(",",$life_style);
                        foreach($life_style as $styles){
                            if($styles)
                                $life_style_list[]= $lifestyle_status_config[$styles];
                            
                        }
                    }
                    
                    if($profile_photo_info){
			            $photo ='<img src="'.base_url().CNTPHT.$profile_photo_info->photo.'" alt="#"/>'; 
			            $thumb_photo='<img src="'.base_url().CNTPHT_MINI.$profile_photo_info->photo.'" alt="#"/>'; 
                    }
		            
		           else{
			            $photo=''; 
			            $thumb_photo='';
		           }
                    
                   $data = array("profile_info"=> $profile_info,'location'=>$location,'full_name'=>$full_name,'photo'=>$photo,
                                'age'=>$age,'gender'=>$gender,'weekly_budget'=>$weekly_budget,'move_date'=>$move_date,'length_of_stay'=>$length_of_stay,
                                'final_code'=>$final_code,'about_me'=>$about_me,'life_style_list'=>$life_style_list,'thumb_photo'=>$thumb_photo,
                                'mobile_no'=>$mobile_no,'listing_id'=>$listing_id,'property_reference_rooms'=>$property_reference_rooms,
                                'listing_preferences'=>$listing_preferences,'property_reference_internet'=>$property_reference_internet,
                                'property_reference_bathroom'=>$property_reference_bathroom,'property_reference_parking'=>$property_reference_parking,
                                'property_reference_maxflatmates'=>$property_reference_maxflatmates,'place_looking_for_config'=>$place_looking_for_config,
                                'place_looking_for'=>$place_looking_for,'teamups'=>$teamups,'locations'=>$locations,'check_access'=>$check_access,
                                 'check_mobile_access'=>$check_mobile_access,'sms_to_all_access'=>$sms_to_all_access);
	               $this->load->view('pages/looking_home_fullview',$data);	  
                 }
                else if( $profile_type=='2'){
                 $roomtypes_status_config  = $this->config->item('roomtypes_status');
                 $bathrooms_status_config  = $this->config->item('bathrooms_status');
                 $flatmatespref_accepting  = $this->config->item('flatmatespref_accepting');
                 $bond_status_config       = $this->config->item('bond_status');
                 $bills_status_config      = $this->config->item('bills_status');
                 $internet_status_config   = $this->config->item('internet_status');
                 $report_property_list     =  $this->config->item('report_property_list');
                 
                 $flatmatespref_status_config     =  $this->config->item('flatmatespref_status');
                 $roomfurnishings_status_config   =  $this->config->item('roomfurnishings_status');
                 $parking_status_config           =  $this->config->item('parking_status');
                 $room_furnishing_features        =   $this->config->item('room_furnishing_features');
                 
                  
                   $get_user_info     = $this->common_model->get_user_info($profile_info->account_id);  
                   $home_photos_info  = $this->listings_model->getPhotos($listing_id);
                   $profile_photo_info    = $this->common_model->get_home_owner_photo($profile_info->account_id);
                   
                   $total_home_rooms  = $this->common_model->total_home_rooms($listing_id);
                 
                   $homedes_single_rooms     = $this->common_model->homedes_rooms($listing_id);
                   $homedes_all_rooms     = $this->common_model->homedes_all_rooms($listing_id);  
                       
                               
                           
                   $homedes_rentbondbills = $this->common_model->homedes_rentbondbills($listing_id);
                   $property_flatmates_preferences = $this->common_model->property_flatmates_preferences($listing_id);
                   $property_address     =  $this->common_model->property_address_info($listing_id);
                   $property_address_info     = json_decode($property_address->property_address);
                   if($property_address_info[0])
                    $location = $property_address_info[0]->location;  
                    else
                    $location='';
                    
                    $full_name        =  $get_user_info->full_name;
                    $mobile_no        =  $get_user_info->mobile_no;
                    $weekly_rent      =  $homedes_rentbondbills->weekly_rent;
                    $bond_amount      =  $weekly_rent*(int)$bond_status_config[$homedes_rentbondbills->bond];
                    $total_bedrooms   =  $total_bedrooms_config[$property_address->total_bedrooms];
                    $total_bathrooms  =  $total_bathrooms_config[$property_address->total_bathrooms];
                    $total_flatmates  =  $property_address->total_flatmates;
                    $internet         =  $internet_status_config[$property_address->internet];
                    $bills_included   =  $bills_status_config[$homedes_rentbondbills->bills];
                    $parking          =  $parking_status_config[$property_address->parking];
                    $about_me         = $profile_info->great_live_with_text;
                    
                    $flatmates_preferences_list=array();
                    if($property_flatmates_preferences){
                        $about_flatmates_preferences = $property_flatmates_preferences->about_flatmates;
                        $accepting_preferences = explode(",",$property_flatmates_preferences->accepting);
                        foreach($accepting_preferences as $accepting_preferences_val){
                            if($accepting_preferences_val)
                                $flatmates_preferences_list[]= $flatmatespref_accepting[$accepting_preferences_val];
                            
                        }
                    }
                    else
                    $about_flatmates_preferences='';
                    
                     if($profile_photo_info && $profile_photo_info->photo_path!=''){
			            $photo ='<img src="'.base_url().CNTPHT.$profile_photo_info->photo_path.'" alt="#"/>'; 
			            $thumb_photo='<img src="'.base_url().CNTPHT_THUMB.$profile_photo_info->photo_path.'" alt="#"/>'; 
                    }
		            
		           else{
			            $photo=''; 
			            $thumb_photo='';
		           }
                    
                   if($total_home_rooms >1){
                       $page_title = $total_home_rooms. ' Room for Rent in -'.$location.'';
                       
                   }  
                   else{
                      $page_title = 'Room for Rent in -'.$location.'';
                       
                   }
                   $data = array("profile_info"=> $profile_info,'location'=>$location,'full_name'=>$full_name,'home_photos_info'=>$home_photos_info,
                                'roomtypes_status_config'=>$roomtypes_status_config,'homedes_rooms'=>$homedes_single_rooms,'final_code'=>$final_code,
                                'bathrooms_status_config'=>$bathrooms_status_config,'weekly_rent'=>$weekly_rent,'total_bedrooms'=>$total_bedrooms,
                                'total_bathrooms'=>$total_bathrooms,'total_flatmates'=>$total_flatmates,'about_me'=>$about_me,'bond_amount'=>$bond_amount,
                                'flatmates_preferences_list'=>$flatmates_preferences_list,'listing_id'=>$listing_id,'photo'=>$photo,'thumb_photo'=>$thumb_photo,
                                'bills_status_config'=>$bills_status_config,'internet'=>$internet,'bills_included'=>$bills_included,
                                'report_property_list'=>$report_property_list,'total_home_rooms'=>$total_home_rooms,'page_title'=>$page_title,
                                'homedes_all_rooms'=>$homedes_all_rooms,'flatmatespref_status_config'=>$flatmatespref_status_config,
                                'roomfurnishings_status_config'=>$roomfurnishings_status_config,'parking'=>$parking,
                                'room_furnishing_features'=>$room_furnishing_features,'bond_status_config'=>$bond_status_config,'mobile_no'=>$mobile_no,
                                'about_flatmates_preferences'=>$about_flatmates_preferences,'check_access'=>$check_access,
                                'check_mobile_access'=>$check_mobile_access,'sms_to_all_access'=>$sms_to_all_access);
	               $this->load->view('pages/offer_home_fullview',$data);	  
                 }  
            }
            
         }
         else{
             redirtect(base_url());
         }
         
	 }

  
   
} 