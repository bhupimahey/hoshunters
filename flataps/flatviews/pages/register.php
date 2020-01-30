<?php
$header = array('title' => 'Register');
$this->load->view('includes/header', $header);
?>
<?php $this->load->view('includes/pages_inner_header'); ?>

<div class="page-banner bg-gray">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="breadcrumbs color-secondery">
					<ul>
						<li class="hover_gray"><a href="<?php echo base_url();?>">Home</a></li>
						<li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
						<li class="color-default">Register</li>
					</ul>
				</div>
				<div class="float-right color-primary">
					<h3 class="banner-title font-weight-bold">Register</h3>
				</div>
			</div>
		</div>
	</div>
</div>
<section class="full-row">
	<div class="container">
		<div class="row">
			<div class="col-md-7 col-md-7">
			
				<div class="login_list">
					<h5 class="pb_20 color-primary">Keep in a mind a few basic password roules :</h5>
					<div class="row">
						<div class="col-md-6 col-lg-4">
							<ul class="flat_small">
								<li><span class="color-default"><i class="flaticon-checked"></i></span>Change your passwords periodically</li>
								<li><span class="color-default"><i class="flaticon-checked"></i></span>Avoid re-using password for multiple site</li>
								<li><span class="color-default"><i class="flaticon-checked"></i></span>Use complex characters including uppercase and number</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-5 col-lg-5">
				<div class="login_form">
					<ul class="d-inline-block mb_30">
						<li><a href="<?php echo base_url();?>login" class="color-primary">Login</a></li>
						<li class="active"><a href="#" class="color-primary">Register</a></li>
					</ul>
                    <?php $this->message_output->run(); ?>
					<?php  $attributes = array('class'=>'form9','id' => 'registerfrm','name' => 'registerfrm','autocomplete' => 'off','method'=>'post');
		        	 echo form_open(base_url()."register/submit", $attributes);
			         ?>  
                     <div class="form-group user">
					    <label for="fullname">Full Name</label>
					    <?php $data = array('class' =>'form-control bg-gray', 'name'=> 'fullname', 'id'=> 'fullname',"required"=>"true","value"=>set_value("fullname"));
                    	echo form_input($data); ?>
					  </div>
					 
					   <div class="form-group email">
					    <label for="email_id">Email address</label>
					    <?php $data = array('class' =>'form-control bg-gray','type'=>'email', 'name'=> 'username', 'id'=> 'username',"required"=>"true","value"=>set_value("username"));
                    	echo form_input($data); ?>
					    
					  </div>
					  <div class="form-group password">
					    <label for="password">Password</label>
					    <?php $data = array('class' =>'form-control bg-gray', 'name'=> 'password',  'id'=> 'password',"required"=>"true","value"=>set_value("password"));
                    	echo form_password($data); ?>
					  </div>
					  <div class="form-group form-check">
					    <input type="checkbox" class="form-check-input" name="termsCheck1" id="termsCheck1" value="1" required="true">
					    <label class="form-check-label" for="termsCheck1"><a href="#" id="accept_conditions"  data-toggle="modal" data-target="#termconditions_modal">Accept Terms and Condition</a></label>
					  </div>
					  
					  <button type="submit" class="btn btn-default1 mt_15">Register</button>
					  
					   <div class="from_socalmedia d-block mt_60">
				  		<a href="<?php echo urldecode($facebook_login_url);?>" class="btn facebook w-100">Register With Facebook</a>
				  		<p></p>
				  		<a href="<?php echo urldecode($google_login_url);?>" class="btn googleplus w-100">Register With Google Plus</a>
				  	
					  </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<?php if($terms_condition_info){ ?>
<div class="modal fade" id="termconditions_modal" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" >
      <div class="modal-header">
        <h4 class="modal-title">Accept Terms and Condition ?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body"><?php echo $terms_condition_info->description;?></div>
     
    </div>
  </div> 
</div>
<style>.modal{top:80px !important;}.modal-body{height:400px !important; overflow:scroll;}</style>
<?php } ?>
<?php
$below_app_js = array('js/jquery.validate.min.js','js/register.js');
$this->load->view('includes/footer', array(
	'below_app_js' => $below_app_js)); ?>
