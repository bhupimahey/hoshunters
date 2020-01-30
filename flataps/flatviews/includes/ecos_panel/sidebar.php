<?php
$page1 = $this->uri->segment('2');
$page2 = $this->uri->segment('3');
?>
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
      <li class="<?php echo ($page1=='dashboard' || $page1=='')?'active':'';?>" ><a href="<?php echo admin_path();?>dashboard"><i class="flaticon-dashboard"></i><span>Dashboard</span></a></li>
      <li class="<?php echo ($page1=='messages')?'active':'';?>"><a href="<?php echo admin_path();?>messages"><i class="flaticon-contact-1"></i><span>Messages</span></a></li>
      <li class="<?php echo ($page1=='information')?'active':'';?>" ><a href="<?php echo admin_path();?>information"><i class="flaticon-chat-comment-oval-speech-bubble-with-text-lines"></i><span>Information Pages</span> </a></li>
      <li class="<?php echo ($page1=='membership_plans')?'active':'';?>"><a href="<?php echo admin_path();?>membership_plans"><i class="flaticon-bill"></i><span>Membership Plans</span></a></li>
      
      <li class="<?php echo ($page1=='listings')?'active':'';?>"><a href="<?php echo admin_path();?>listings"><i class="flaticon-house-1"></i><span>Manage Listings</span></a></li>
      
      
       <li class="<?php echo ($page1=='users')?'active':'';?>"><a href="<?php echo admin_path();?>users"><i class="flaticon-seller-1"></i><span>Manage Users</span></a></li>
       
        <li class="<?php echo ($page1=='faq')?'active':'';?>" ><a href="<?php echo admin_path();?>faq"><i class="flaticon-chat-comment-oval-speech-bubble-with-text-lines"></i><span>Faq Information</span> </a></li>
     
    </ul> 
  
    <h6 class="color-default border_gray pb_15 pt_50 m-0 px_15"><span>Your Details</span></h6>
    <ul class="mt_10">
      <li class="<?php echo ($page1=='change_password')?'active':'';?>"><a href="<?php echo admin_path();?>change_password"><i class="flaticon-lock"></i><span>Change Password</span></a></li>
      
    </ul>

  </div>
</div>
