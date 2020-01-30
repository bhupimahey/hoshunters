<?php
$header = array('title' => 'Forgot Password');
$this->load->view('includes/header', $header);
?>
<body>
<?php $this->load->view('includes/pages_inner_header'); ?>

<div class="page-banner bg-gray">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="breadcrumbs color-secondery">
					<ul>
						<li class="hover_gray"><a href="<?php echo base_url();?>">Home</a></li>
						<li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
						<li class="color-default">Forgot Password</li>
					</ul>
				</div>
				<div class="float-right color-primary">
					<h3 class="banner-title font-weight-bold">Forgot Password</h3>
				</div>
			</div>
		</div>
	</div>
</div>
<section class="full-row">
	<div class="container">
		<div class="row">
			<div class="col-md-7 col-md-7">
				<div class="login_massage pb_60">
					<h4 class="pb_20 color-primary">Welcome</h4>
					<p>Adipiscing lacinia pede proin vulputate habitasse donec adipiscing. Cubilia Interdum hac turpis et dignissim vehicula porta nostra dictum nostra semper. Dictumst congue dictum. Nam massa id, netus interdum amet Metus turpis scelerisque aptent sapien penatibus potenti. </p>
				</div>
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
						<li class="active"><a href="#" class="color-primary">Forgot Password</a></li>
						<li><a href="<?php echo base_url();?>login" class="color-primary">Login</a></li>
					</ul>
                    <?php $this->message_output->run(); ?>
					<?php  $attributes = array('class'=>'form9','id' => 'forgotfrm','name' => 'forgotfrm','autocomplete' => 'off','method'=>'post');
		        	 echo form_open(base_url()."forgot_password/submit", $attributes);
			         ?>    
					  <div class="form-group user">
					    <label for="exampleInputEmail1">Email</label>
					    <?php $data = array('class' =>'form-control bg-gray', 'type'=>'email','name'=> 'email_id', 'placeholder'=>"Email", 'id'=> 'email_id',"required"=>"true","value"=>set_value("email_id"));
                    	echo form_input($data); ?>
					  </div>
					  <button type="submit" class="btn btn-default1 mt_15">Submit</button>
					  
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
$below_app_js = array('js/jquery.validate.min.js','js/login.js');
$this->load->view('includes/footer', array(
	'below_app_js' => $below_app_js)); ?>
