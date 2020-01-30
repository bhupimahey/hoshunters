<?php
$page1 = $this->uri->segment('2');
$page2 = $this->uri->segment('3');
?>
<style>
.fa-question-circle:before {
    content: "\f059";
    font-size: 24px;
}   
</style>
<div class="theme-loader">
  <div class="ball-scale">
    <div class="contain">
      <div class="ring">
        <div class="frame"></div>
      </div>
      <div class="ring">
        <div class="frame"></div>
      </div>
      <div class="ring">
        <div class="frame"></div>
      </div>
      <div class="ring">
        <div class="frame"></div>
      </div>
      <div class="ring">
        <div class="frame"></div>
      </div>
      <div class="ring">
        <div class="frame"></div>
      </div>
      <div class="ring">
        <div class="frame"></div>
      </div>
      <div class="ring">
        <div class="frame"></div>
      </div>
      <div class="ring">
        <div class="frame"></div>
      </div>
      <div class="ring">
        <div class="frame"></div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="full-row deshbord_sidebar flat_small py_30 w-100">
    <h6 class="color-default border_gray pb_15 m-0 px_15"><span>Overview</span></h6>
    <ul class="mt_10">
      <li class="<?php echo ($page1=='dashboard' || $page1=='')?'active':'';?>" ><a href="<?php echo customer_path();?>dashboard"><i class="flaticon-dashboard"></i><span>Dashboard</span></a></li>
      <li class="<?php echo ($page1=='messages')?'active':'';?>"><a href="<?php echo customer_path();?>messages"><i class="flaticon-contact-1"></i><span>Messages</span></a></li>
      <li class="<?php echo ($page1=='listings')?'active':'';?>"><a href="<?php echo customer_path();?>listings"><i class="flaticon-house-1"></i><span>Manage Listings</span></a></li>
    </ul>
  
    <h6 class="color-default border_gray pb_15 pt_50 m-0 px_15"><span>Your Details</span></h6>
    <ul class="mt_10">
     <li class="<?php echo ($page1=='profile_information')?'active':'';?>"><a href="<?php echo customer_path();?>profile_information"><i class="flaticon-seller"></i><span>Personal Information</span></a></li>   
        
        
      <li class="<?php echo ($page1=='email_setting')?'active':'';?>"><a href="<?php echo customer_path();?>email_setting"><i class="flaticon-resume"></i><span>Email Alerts Settings</span></a></li>
      <li><a href="<?php echo base_url();?>faq"><i class="fa fa-question-circle"></i><span>Faq</span></a></li>
      <?php if($this->session->userdata('s_is_social_login')==0){ ?>
      <li class="<?php echo ($page1=='change_password')?'active':'';?>"><a href="<?php echo customer_path();?>change_password"><i class="flaticon-lock"></i><span>Change Password</span></a></li>
      <?php } ?>
    </ul>
    
  </div>
</div>
