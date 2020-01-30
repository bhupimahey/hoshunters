<?php
  $page = $this->uri->segment(2);
  $page1 = $this->uri->segment(1);
  
  $pages_menu = $this->common_model->pages_menu();
  
$s_search_parametrs = $this->session->userdata('s_search_parametrs');
if(isset($s_search_parametrs['status_type']))
	$s_status_type = $s_search_parametrs['status_type'];
   else
	$s_status_type ='';
	
  if(isset($s_search_parametrs['spreferred_language']))
	$spreferred_language = $s_search_parametrs['spreferred_language'];
   else
	$spreferred_language ='0';
	
  
if(isset($s_search_parametrs['searchsuburb']))
	$s_searchsuburb = $s_search_parametrs['searchsuburb'];
   else
	$s_searchsuburb ='';
	
if(isset($s_search_parametrs['min_rent']))
	$s_min_rent = $s_search_parametrs['min_rent'];
   else
	$s_min_rent ='';	          
	
if(isset($s_search_parametrs['max_rent']))
	$s_max_rent = $s_search_parametrs['max_rent'];
   else
	$s_max_rent ='';
	
if(isset($s_search_parametrs['postal_code']))
	$s_postal_code = $s_search_parametrs['postal_code'];
   else
	$s_postal_code ='';
	
	
if(isset($s_search_parametrs['search_by']))
	$s_search_by = $s_search_parametrs['search_by'];
   else
	$s_search_by ='';	    
	
if(isset($s_search_parametrs['flatmatespref_status']))
	$s_flatmatespref_status = $s_search_parametrs['flatmatespref_status'];
   else
	$s_flatmatespref_status ='';
	
	
if(isset($s_search_parametrs['country']))
	$s_country = $s_search_parametrs['country'];
   else
	$s_country ='';
	
if(isset($s_search_parametrs['state']))
	$s_state = $s_search_parametrs['state'];
   else
	$s_state =''; 
	
 
if(isset($s_search_parametrs['city']))
	$s_city = $s_search_parametrs['city'];
   else
	$s_city ='';    

if(isset($s_search_parametrs['street']))
	$s_street = $s_search_parametrs['street'];
   else
	$s_street ='';  

if(isset($s_search_parametrs['latitude']))
	$s_latitude = $s_search_parametrs['latitude'];
   else
	$s_latitude =''; 
	
if(isset($s_search_parametrs['longitude']))
	$s_longitude = $s_search_parametrs['longitude'];
   else
	$s_longitude =''; 
	
	
			
	
if(isset($s_search_parametrs['available_from']))
	$s_available_from = $s_search_parametrs['available_from'];
   else
	$s_available_from ='';  

if(isset($s_search_parametrs['any_gender']))
	$s_any_gender = $s_search_parametrs['any_gender'];
   else
	$s_any_gender ='0';   


  if(isset($s_search_parametrs['rooms_types']))
	$s_rooms_types = $s_search_parametrs['rooms_types'];
   else
	$s_rooms_types ='0';   
	

if(isset($s_search_parametrs['bathrooms_types']))
	$s_bathrooms_types = $s_search_parametrs['bathrooms_types'];
   else
	$s_bathrooms_types ='0';   
  
if(isset($s_search_parametrs['room_furnishing']))
	$s_room_furnishing = $s_search_parametrs['room_furnishing'];
   else
	$s_room_furnishing ='0';   
	
if(isset($s_search_parametrs['staylength']))
	$s_staylength = $s_search_parametrs['staylength'];
   else
	$s_staylength='0';   
	
if(isset($s_search_parametrs['anyparking']))
	$s_anyparking = $s_search_parametrs['anyparking'];
   else
	$s_anyparking='0';   		   
 

if(isset($s_search_parametrs['avail_bedroom']))
	$s_avail_bedroom = $s_search_parametrs['avail_bedroom'];
   else
	$s_avail_bedroom='0';   


if(isset($s_search_parametrs['omin_age']))
	$s_omin_age = $s_search_parametrs['omin_age'];
   else
	$s_omin_age='';      

if(isset($s_search_parametrs['omax_age']))
	$s_omax_age = $s_search_parametrs['omax_age'];
   else
	$s_omax_age='';   	     

if(isset($s_search_parametrs['omin_rent']))
	$s_omin_rent = $s_search_parametrs['omin_rent'];
   else
	$s_omin_rent='';  
	
if(isset($s_search_parametrs['omax_rent']))
	$s_omax_rent = $s_search_parametrs['omax_rent'];
   else
	$s_omax_rent='';  
	

if(isset($s_search_parametrs['oavailable_from']))
	$s_oavailable_from = $s_search_parametrs['oavailable_from'];
   else
	$s_oavailable_from='';  
	
if(isset($s_search_parametrs['opeoplelookingfor']))
	$s_opeoplelookingfor = $s_search_parametrs['opeoplelookingfor'];
   else
	$s_opeoplelookingfor='0';  
	
if(isset($s_search_parametrs['omin_stay']))
	$s_omin_stay = $s_search_parametrs['omin_stay'];
   else
	$s_omin_stay='';  		    
 
if(isset($s_search_parametrs['omax_stay']))
	$s_omax_stay = $s_search_parametrs['omax_stay'];
   else
	$s_omax_stay='';  	
	
if(isset($s_search_parametrs['peoplethatare']))
	$s_peoplethatare = $s_search_parametrs['peoplethatare'];
   else
	$s_peoplethatare='0';  
	

if(isset($s_search_parametrs['oprofessionals']))
	$s_oprofessionals = $s_search_parametrs['oprofessionals'];
   else
	$s_oprofessionals='8';
?>

<header id="header" class="nav-on-banner header_one">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-12">
        <div class="top_header">
          <div class="row">
            <div class="col-md-7 col-xl-6 offset-md-2">
              <div class="top_left icon_default color-white">
                <ul>
                  <li><i class="fa fa-phone" aria-hidden="true"></i>0450281525</li>
                  <li><i class="fa fa-envelope" aria-hidden="true"></i>info@hosthunters.com.au</li>
                  <li>
                    <div class="dropdown hover_white"> <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Help and Support</a>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="<?php echo base_url();?>faq">FAQ</a>
                        <?php if($pages_menu) {
            									 foreach($pages_menu as $page_info){
            									?>
                        <a class="dropdown-item" href="<?php echo base_url();?>pages/<?php echo $page_info->name_url;?>"><?php echo ucwords($page_info->title);?></a>
                        <?php } }  ?>
                        <a class="dropdown-item" href="<?php echo base_url();?>contact">Contact</a> </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="navbar_one">
          <div class="row">
            <div class="col-md-12 col-lg-12">
              <nav class="navbar navbar-expand-lg navbar-light"> <a class="navbar-brand" href="<?php echo base_url();?>"><img src="<?php echo base_url();?>images/logo/logo1.jpg" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">
                    <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>" role="button" aria-haspopup="true" aria-expanded="false">Home</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>shortlists" role="button" aria-haspopup="true" aria-expanded="false">Shortlist</a> </li>
                    <?php if(is_customer_logged_in()){?>
                    <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>messages" role="button" aria-haspopup="true" aria-expanded="false">Messages</a> </li>
                    <?php } ?>
                  </ul>
                  <?php if(is_customer_logged_in()){?>
                  <div class="user_name color-primary-a-new float-lg-right p-3 dropdown"> <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <?php echo ucwords(customer_name()); ?></a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="<?php echo customer_path();?>profile_information">Profile</a> <a class="dropdown-item" href="<?php echo customer_path();?>dashboard">Dashboard</a> <a class="dropdown-item" href="<?php echo customer_path();?>logout">Logout</a> </div>
                  </div>
                  <?php } else{ ?>
                  <div class="user_name color-primary-a-new float-lg-right p-3"> <a href="<?php echo base_url();?>login">Login</a> / <a href="<?php echo base_url();?>register">Register</a> </div>
                  <?php } ?>
                  <ul class="navbar-nav ml-auto">
                    <li class="nav-item"> <a class="nav-link active" href="<?php echo base_url();?>list_my_place" role="button" aria-haspopup="true" aria-expanded="false">List my place</a> </li>
                    <li class="nav-item"> <a class="nav-link active" href="<?php echo base_url();?>find_place" role="button" aria-haspopup="true" aria-expanded="false">Find a place</a> </li>
                    <li class="nav-item"><a class="nav-link active top-search-btn" href="#"> <i class="fa fa-search" aria-hidden="true"></i> </a> <span class="btn btn-sm btn-default1 close_menu"><i class="fa fa-times" aria-hidden="true"></i></span>
                      <div class="top_search">
                        <div class="container">
                          <form class="form1 formicon" method="post" name="srchfrm" id="srchfrm" action="<?php echo base_url();?>search/submit">
                            <input type="hidden" name="search_p_street" id="search_p_street" value='<?php echo $s_street;?>'>
                            <input type="hidden" name="search_p_country" id="search_p_country" value='<?php echo $s_country;?>'>
                            <input type="hidden" name="search_p_latitude" id="search_p_latitude" value='<?php echo $s_latitude;?>'>
                            <input type="hidden" name="search_p_longitude" id="search_p_longitude" value='<?php echo $s_longitude;?>'>
                            <input type="hidden" name="search_p_state" id="search_p_state" value='<?php echo $s_state;?>'>
                            <input type="hidden" name="search_p_city" id="search_p_city" value='<?php echo $s_city;?>'>
                            <input type="hidden" name="search_p_postal_code" id="search_p_postal_code" value=''>
                            <input type="hidden" name="search_p_suburb" id="search_p_suburb" value=''>
                            WHERE ARE YOU LOOKING?
                            <div class="row" style="max-height: 450px;overflow-y: auto; overflow-x: hidden;">
                              <div class="col-12">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="searchsuburb" name="searchsuburb" placeholder="Start typing a suburb, city, station or uni" value="<?php echo $s_searchsuburb;?>" required>
                                </div>
                                <div class="form-group" style="font-size:13px;"><a href="javascript:void(0);" style="color:#000;" data-title="New South Wales" class="autofillcity"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;New South Wales</a>&nbsp;&nbsp; <a href="javascript:void(0);" style="color:#000;" data-title="Sydney" class="autofillcity"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;Sydney</a>&nbsp;&nbsp; <a href="javascript:void(0);" style="color:#000;" data-title="Melbourne" class="autofillcity"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;Melbourne</a>&nbsp;&nbsp; <a href="javascript:void(0);" style="color:#000;" data-title="Brisbane" class="autofillcity"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;Brisbane</a>&nbsp;&nbsp; <a href="javascript:void(0);" style="color:#000;" data-title="Perth" class="autofillcity"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;Perth</a>&nbsp;&nbsp; <a href="javascript:void(0);" style="color:#000;" data-title="Gold Coast" class="autofillcity"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;Gold Coast</a>&nbsp;&nbsp; <a href="javascript:void(0);" style="color:#000;" data-title="Adelaide" class="autofillcity"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;Adelaide</a> </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group">
                                  <?php  $status_type_list =array('1'=>'Rooms','2'=>'Flatmates','3'=>'Teamups');
                                             echo  form_dropdown('status_type', $status_type_list, $s_status_type,' id="status_type" class="form-control" ');
                                        ?>
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group">
                                  <?php  $preferred_language_list =$this->config->item('preferred_language_list');
                                             echo  form_dropdown('preferred_language', $preferred_language_list, $spreferred_language,' id="preferred_language" class="form-control" ');
                                        ?>
                                </div>
                              </div>
                              <div id="rooms_div" class="col-12">
                                <div class="row">
                                  <div class="col-6">
                                    <div class="form-group">
                                      <input type="text" class="form-control" id="min_rent" name="min_rent" placeholder="Min rent" value="<?php echo $s_min_rent;?>">
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="form-group">
                                      <input type="text" class="form-control" id="max_rent" name="max_rent" placeholder="Max rent" value="<?php echo $s_max_rent;?>">
                                    </div>
                                  </div>
                                  <div class="col-12">
                                    <div class="form-group">
                                      <?php $home_searchby_list = $this->config->item('home_searchby_list');
                                                                              echo  form_dropdown('search_by', $home_searchby_list, $s_search_by,' id="search_by" class="form-control" ');
                                                                         ?>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div id="flatmates_div" class="col-12" style="display:none;">
                                <div class="row">
                                  <div class="col-6">
                                    <div class="form-group">
                                      <?php $flatmatespref_status = $this->config->item('flatmatespref_status');
                                                                          echo  form_dropdown('flatmatespref_status', $flatmatespref_status, $s_flatmatespref_status,' id="flatmatespref_status" class="form-control" ');
                                                                     ?>
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="form-group">
                                      <?php $home_searchflats_list = $this->config->item('home_searchflats_list');
                                                                          echo  form_dropdown('home_searchflats_list', $home_searchflats_list, set_value('home_searchflats_list'),' id="home_searchflats_list" class="form-control" ');
                                                                     ?>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="p-3 text-center filterdiv"> <a href="javascript:void(0);" onclick="show_filters(0);" class="small">+ Advanced filters</a> </div>
                                <div class="row" id="rooms_advanced_filter" style="display:none;">
                                  <div class="col-6">
                                    <div class="form-group">
                                      <input type="date" class="form-control" name="available_from" title="Available from" value="<?php echo $s_available_from;?>"  placeholder="Available from">
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="form-group">
                                      <?php
                                      $genderarray = array();
                                      $genderarray['0']='Any Gender';
                                      $genderarray['1']='Places Accepting Females';
                                      $genderarray['2']='Places Accepting Males';
                                      $genderarray['3']='Places Accepting Couples';
                                     echo  form_dropdown('any_gender',$genderarray,$s_any_gender,' class="form-control" id="any_gender"' );
                                      ?>
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="form-group">
                                      <?php
                                      $roomsarray = array();
                                      $roomsarray['0']='All Rooms';
                                      $roomsarray['1']='Private Room';
                                      $roomsarray['2']='Room Shared With Other';
                                     echo  form_dropdown('room',$roomsarray,$s_rooms_types,' class="form-control" id="room"' );
                                      ?>
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="form-group">
                                      <?php
                                      $bathroomstypesarray = array();
                                      $bathroomstypesarray['0']='All Bathrooms Types';
                                      $bathroomstypesarray['1']='Ensuite Bathroom';
                                      $bathroomstypesarray['2']='Own Bathroom';
                                     echo  form_dropdown('bathrooms_types',$bathroomstypesarray,$s_bathrooms_types,' class="form-control" id="bathrooms_types"' );
                                      ?>
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="form-group">
                                      <?php
                                      $roomfurnishingsarray = array();
                                      $roomfurnishingsarray['0']='Any Furnishing';
                                      $roomfurnishingsarray['1']='Furnished Room';
                                      $roomfurnishingsarray['2']='Unfurnished Room';
                                     echo  form_dropdown('room_furnishing',$roomfurnishingsarray,$s_room_furnishing,' class="form-control" id="room_furnishing"' );
                                      ?>
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="form-group">
                                      <?php
                                      $staylengtharray = array();
                                      $staylengtharray['0']='All Stay Lengths';
                                      $staylengtharray['1']='1 Week';
                                      $staylengtharray['2']='2 Weeks';
                                      $staylengtharray['3']='4 Week';
                                      $staylengtharray['4']='6 Weeks';
                                      $staylengtharray['5']='2 Months';
                                      $staylengtharray['6']='3 Months';
                                      $staylengtharray['7']='4 Months';
                                      $staylengtharray['8']='6 Months';
                                      $staylengtharray['9']='9 Months';
                                      $staylengtharray['10']='1 Year';
                                      
                                     echo  form_dropdown('staylength',$staylengtharray,$s_staylength,' class="form-control" id="staylength"' );
                                      ?>
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="form-group">
                                      <?php
                                      $anyparkingarray = array();
                                      $anyparkingarray['0']='Any Parking';
                                      $anyparkingarray['1']='No Parking';
                                      $anyparkingarray['2']='Off Street Parking';
                                      $anyparkingarray['3']='On Street Parking';
                                     echo  form_dropdown('anyparking',$anyparkingarray,$s_anyparking,' class="form-control" id="anyparking"' );
                                      ?>
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="form-group">
                                      <?php
                                      $availbedrromarray = array();
                                      $availbedrromarray['0']='Available Bedrooms';
                                      $availbedrromarray['1']='1 Bedroom';
                                      $availbedrromarray['2']='2 Bedrooms';
                                      $availbedrromarray['3']='3 Bedrooms';
                                      $availbedrromarray['4']='4 Bedrooms';
                                      $availbedrromarray['5']='5 Bedrooms';
                                      $availbedrromarray['6']='6 Bedrooms';
                                      
                                     echo  form_dropdown('avail_bedroom',$availbedrromarray,$s_avail_bedroom,' class="form-control" id="avail_bedroom"' );
                                      ?>
                                    </div>
                                  </div>
                                </div>
                                <div class="row" id="others_advanced_filter" style="display:none;">
                                  <div class="col-3">
                                    <div class="form-group">
                                      <input type="text" class="form-control" name="omin_age" placeholder="Min age" value="<?php echo $s_omin_age;?>">
                                    </div>
                                  </div>
                                  <div class="col-3">
                                    <div class="form-group">
                                      <input type="text" class="form-control" name="omax_age" placeholder="Max age" value="<?php echo $s_omax_age;?>">
                                    </div>
                                  </div>
                                  <div class="col-3">
                                    <div class="form-group">
                                      <input type="text" class="form-control" name="omin_rent" placeholder="Min rent" value="<?php echo $s_omin_rent;?>">
                                    </div>
                                  </div>
                                  <div class="col-3">
                                    <div class="form-group">
                                      <input type="text" class="form-control" name="omax_rent" placeholder="Max rent" value="<?php echo $s_omax_rent;?>">
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="form-group">
                                      <input type="date" class="form-control" name="oavailable_from" placeholder="Available from" value="<?php echo $s_oavailable_from;?>">
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="form-group">
                                      <?php
                                      $peoplelookingforarray = array();
                                      $peoplelookingforarray['0']='People looking for';
                                      $peoplelookingforarray['1']='Room(s) in share houses';
                                      $peoplelookingforarray['2']='Whole properties for sharing';
                                      $peoplelookingforarray['3']='Studios';
                                      $peoplelookingforarray['5']='1 bed flats';
                                      $peoplelookingforarray['4']='Granny flats';
                                      $peoplelookingforarray['8']='Student accommodation';
                                      $peoplelookingforarray['6']='Homestays';
                                      $peoplelookingforarray['7']='Shared rooms';
                                     echo  form_dropdown('opeoplelookingfor',$peoplelookingforarray,$s_opeoplelookingfor,' class="form-control" id="opeoplelookingfor"' );
                                      ?>
                                    </div>
                                  </div>
                                  <div class="col-3">
                                    <div class="form-group">
                                      <input type="text" class="form-control" name="omin_stay" placeholder="Min stay" value="<?php echo $s_omin_stay;?>">
                                    </div>
                                  </div>
                                  <div class="col-3">
                                    <div class="form-group">
                                      <input type="text" class="form-control" name="omax_stay" placeholder="Max stay" value="<?php echo $s_omax_stay;?>">
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="form-group">
                                      <?php
                                      $peoplethatarearray = array();
                                      $peoplethatarearray['0']='People that are';
                                      $peoplethatarearray['2']='LGBT+';
                                      $peoplethatarearray['4']='No kids';
                                      $peoplethatarearray['3']='No pets';
                                      $peoplethatarearray['5']='Non-smoker';
                                      $peoplethatarearray['1']='Smoker';
                                     echo  form_dropdown('peoplethatare',$peoplethatarearray,$s_peoplethatare,' class="form-control" id="peoplethatare"' );
                                      ?>
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="form-group">
                                      <?php
                                      $professionalsarray = array();
                                      $professionalsarray['8']='Professionals';
                                      $professionalsarray['1']='Working full-time';
                                      $professionalsarray['2']='Working part-time';
                                      $professionalsarray['7']='Student';
                                      $professionalsarray['6']='Backpacker';
                                      $professionalsarray['4']='Retired';
                                      $professionalsarray['5']='Unemployed/Welfare';
                                      $professionalsarray['3']='Working holiday';
                                     echo  form_dropdown('oprofessionals',$professionalsarray,$s_oprofessionals,' class="form-control" id="oprofessionals"' );
                                      ?>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group">
                                  <button type="submit" class="btn btn-default1 w-100">Search Property</button>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
