<?php
$header = array('title' => 'Upload Photos');
	
$this->load->view('includes/' . admin_folder . 'header', $header);
?>
<body>
<?php  $this->load->view('includes/' . admin_folder . 'inner_header');?>
<?php echo form_hidden("profile_id",$profile_id);?>
<div class="full-row deshbord">
  <div class="container-fluid">
    <?php  $attributes = array('id' => 'photos_frm','name' => 'photos_frm','role' => 'form','autocomplete' => 'off');
		 echo form_open_multipart(admin_path().'listings/home_photos/'.$profile_id.'/submit', $attributes);
		echo form_hidden('profile_id',$profile_id);					 
     ?>
    <div class="row">
      <div class="col-md-1 col-xl-2 bg-primary">
        <?php $this->load->view('includes/' . admin_folder . 'sidebar');?>
      </div>
      <div class="col-md-11 col-xl-10 bg-gray">
        <div class="row">
          <div class="full-row deshbord_panel w-100 mb-5">
            <h4 class="color-primary mb-4">MAKE YOUR PROFILE STAND OUT</h4>
           
              <div class="row massanger">
              <div class="col-md-12 col-xl-12">
                <div class="edit-list-box edit-third">
                  <div class="row">
                    <div class="col-lg-12 lower-section">
                    
                    
                    
                     <div class="row fileupload-buttonbar">
      				    <div class="col-lg-7">
            <!-- The fileinput-button span is used to style the file input field as button -->
            <span class="btn btn-success fileinput-button">
              <i class="glyphicon glyphicon-plus"></i>
              <span>Add files...</span>
             <input type="file" name="files" id="propertyfiles" class="filestyle" data-icon="true" multiple />
            </span>
           
          </div>
          
       				 </div>
       
      				</div>
      				
      					<div class="col-lg-12 col-md-12">
              <div class="form-group">
                <div class="">
                  <div class="thumbnails_box col-12 cust-img-wrap"> </div>
                </div>
                 
              </div>
            </div>
            
                  </div>
                  
                  <div class="row">
                  <?php $this->message_output->run(); ?>
                    <div class="col-lg-12 lower-section">
                    <br><br><br>
                    <div class="property_thumbnails mt-5">
                              <div class="row">
                              <?php if($photos){
								  foreach($photos as $sub_img_val){
									  if($sub_img_val->photo!=''){ ?>
                                <div class="mb_30 col-lg-3 col-md-4 col-4"> <img src="<?php echo base_url().HMEPHT_THUMB.$sub_img_val->photo;?>" alt="" ><a class="delete_record" href="<?php echo admin_path();?>listings/photo/delete/<?php echo $sub_img_val->photo_id;?>/<?php echo $profile_id;?>"><i class="fa fa-window-close"></i></a></div>
                              <?php } } } ?>
                              
                              </div>
                            </div>
                    </div>
                  </div>
                </div>
              </div>
              </div>
              <div class="row massanger">
              <div class="col-md-12 col-xl-12">
                <div class="1">
                  <div class="row">
                    <div class="col-lg-6 lower-section">
                      <table class="w-100">
                        <tbody>
                          <tr>
                            <td><br>
                              <br>
                              <br>
                              <a href="<?php echo admin_path();?>listings/view/<?php echo $profile_id;?>" class="btn btn-default btn-info btn-block">Back</a></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-lg-6 lower-section">
                      <table class="w-100">
                        <tbody>
                          <tr>
                            <td><br>
                              <br>
                              <br>
                              <button type="submit"  class="btn btn-default btn-success btn-block">Submit</button></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <?php  $this->load->view('includes/' . admin_folder . 'inner_copyright'); ?>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php  $this->load->view('includes/' . admin_folder . 'inner_footer');?>

<?php 
$below_app_js=array('js/jquery.validate.min.js','js/list_myplace_photos.js');
$this->load->view('includes/'.admin_folder.'footer',array('below_app_js'=>$below_app_js)); ?>

