<?php
  $page = $this->uri->segment(2);
  $page1 = $this->uri->segment(1);
  
  $pages_menu = $this->common_model->pages_menu();
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
                  <li><i class="fa fa-phone" aria-hidden="true"></i>(012) 345 678 102</li>
                  <li><i class="fa fa-envelope" aria-hidden="true"></i>office@example.com</li>
                  <li>
                    <div class="dropdown hover_white"> <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Help and Support</a>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="<?php echo base_url();?>faq">Faq</a>
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
                    <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>messages" role="button" aria-haspopup="true" aria-expanded="false">Messages</a> </li>
                  </ul>
				  
				  <!--<ul class="navbar-nav ml-auto">
                    <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>list_my_place" role="button" aria-haspopup="true" aria-expanded="false">List my place</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>find_place" role="button" aria-haspopup="true" aria-expanded="false">Find a place</a> </li>
                    <li class="nav-item"><a class="btn btn-default1 d-none d-lg-block top-search-btn" href="#"> <i class="fa fa-search" aria-hidden="true"></i> </a> </li>
                  </ul>-->
				  
				  
				  
				    
					
					
				  
                  <?php if(is_customer_logged_in()){?>
                  <div class="user_name color-primary-a float-lg-right p-3 dropdown"> <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <?php echo ucwords(customer_name()); ?></a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"> <a class="dropdown-item" href="<?php echo customer_path();?>profile_information">Profile</a> <a class="dropdown-item" href="<?php echo customer_path();?>dashboard">Dashboard</a> <a class="dropdown-item" href="<?php echo customer_path();?>logout">Logout</a> </div>
                  </div>
                  <?php } else{ ?>
                  <div class="user_name color-primary-a-new float-lg-right p-3"> 
				  <a href="<?php echo base_url();?>login">Login / Register</a> </div>
                  <?php } ?>
                  <a class="btn btn-default1 d-none d-lg-block mr-1" href="<?php echo base_url();?>list_my_place">List my place</a> 
				  <a class="btn btn-default1 d-none d-lg-block mr-1" href="<?php echo base_url();?>find_place">Find a place</a> 
				  <a class="btn btn-default1 d-none d-lg-block top-search-btn" href="#"> <i class="fa fa-search" aria-hidden="true"></i> </a>
                  <div class="top_search">
                    <div class="container">
                      <form class="form1 formicon" method="post" name="srchfrm" id="srchfrm" action="<?php echo base_url();?>search/submit">
                        <input type="hidden" name="street" id="street" value=''>
                        <input type="hidden" name="country" id="country" value=''>
                        <input type="hidden" name="latitude" id="latitude" value=''>
                        <input type="hidden" name="longitude" id="longitude" value=''>
                        <input type="hidden" name="state" id="state" value=''>
                        <input type="hidden" name="city" id="city" value=''>
                        <input type="hidden" name="postal_code" id="postal_code" value=''>
                        <input type="hidden" name="suburb" id="suburb" value=''>
                        <div class="row">
                          <div class="col-12">
                            <div class="form-group">
                              <input type="text" class="form-control" id="searchsuburb" name="searchsuburb" placeholder="Start typing a suburb, city, station or uni" required>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="form-group">
                              <select class="form-control" name="status_type" id="status_type">
                                <option value="1">Rooms</option>
                                <option value="2">Flatmates</option>
                                <option value="3">Teamups</option>
                              </select>
                            </div>
                          </div>
                          <div id="rooms_div" class="col-12">
                            <div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="min_rent" name="min_rent" placeholder="Min rent">
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="max_rent" name="max_rent" placeholder="Max rent">
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group">
                                  <?php $home_searchby_list = $this->config->item('home_searchby_list');
                                                                      echo  form_dropdown('search_by', $home_searchby_list, set_value('search_by'),' id="search_by" class="form-control" ');
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
                                                                  echo  form_dropdown('flatmatespref_status', $flatmatespref_status, set_value('flatmatespref_status'),' id="flatmatespref_status" class="form-control" ');
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
                            <div class="form-group">
                              <button type="submit" class="btn btn-default1 w-100">Search Property</button>
                            </div>
                          </div>
                        </div>
                        <div  class="row" style="display:none;">
                          <div class="col-md-4 col-lg-4">
                            <div class="form-group" style="margin-left:85px;"> </div>
                          </div>
                          <div class="col-md-8 col-lg-8">
                            <div class="form-group"> <a href="#" class="btn btn-default1" id="advancedfilter">Advanced filter</a> </div>
                          </div>
                        </div>
                        <div id="rooms_advanced_div" class="row" style="display:none;">
                          <div class="col-md-4 col-lg-4">
                            <div class="form-group" style="margin-left:85px;"> </div>
                          </div>
                          <div class="col-md-8 col-lg-8">
                            <div  class="row">
                              <div class="col-md-12 col-lg-12">
                                <div class="col-md-6 col-lg-6">
                                  <div class="form-group">
                                    <input type="text" class="form-control" id="available_from" name="available_from" placeholder="Available From">
                                  </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                  <div class="form-group">
                                    <?php $home_searchby_list = $this->config->item('home_searchby_list');
                                                          echo  form_dropdown('search_by', $home_searchby_list, set_value('search_by'),' id="search_by" class="form-control" ');
                                                     ?>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
