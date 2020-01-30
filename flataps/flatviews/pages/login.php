<?php
$header = array('title' => 'Login');
$this->load->view('includes/header', $header);
$captcha_contact_info = generate_captcha();
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
						<li class="color-default">Login</li>
					</ul>
				</div>
				<div class="float-right color-primary">
					<h3 class="banner-title font-weight-bold">Login</h3>
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
					<h5 class="pb_20 color-primary">Keep in a mind a few basic password rules :</h5>
					<div class="row">
						<div class="col-md-6 col-lg-4">
							<ul class="flat_small">
								<li><span class="color-default"><i class="flaticon-checked"></i></span>Change your passwords periodically</li>
								<li><span class="color-default"><i class="flaticon-checked"></i></span>Avoid re-using password for multiple sites</li>
								<li><span class="color-default"><i class="flaticon-checked"></i></span>Use complex characters including uppercase and number</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-5 col-lg-5">
				<div class="login_form">
					<ul class="d-inline-block mb_30">
						<li class="active"><a href="#" class="color-primary">Login</a></li>
						<li><a href="<?php echo base_url();?>register" class="color-primary">Register</a></li>
					</ul>
                    <?php $this->message_output->run(); ?>
					<?php  $attributes = array('class'=>'form9','id' => 'loginfrm','name' => 'loginfrm','autocomplete' => 'off','method'=>'post');
		        	 echo form_open(base_url()."login/submit", $attributes);
			         ?>    
					  <div class="form-group user">
					    <label for="exampleInputEmail1">Username</label>
					    <?php $data = array('class' =>'form-control bg-gray', 'name'=> 'username', 'placeholder'=>"Email", 'id'=> 'username',"required"=>"true","value"=>set_value("username"));
                    	echo form_input($data); ?>
					  </div>
					  <div class="form-group password">
					    <label for="exampleInputPassword1">Password</label>
					    <?php $data = array('class' =>'form-control bg-gray', 'name'=> 'password', 'placeholder'=>"Password", 'id'=> 'password',"required"=>"true","value"=>set_value("password"));
                    	echo form_password($data); ?>
					  </div>
					  <div class="form-group">
					   <center><img src="<?php echo $captcha_contact_info['image_src'];?>" alt="Captcha" class="form-control bg-gray" style="height:69px;" /> </center>
					  </div>
					     <div class="form-group password">
					    <label for="exampleInputPassword1">Captcha</label>
					    <?php $data = array('class' =>'form-control bg-gray', 'name'=> 'login_captcha_code',  'id'=> 'login_captcha_code',"value"=>set_value("login_captcha_code"),"placeholder"=>"Captcha","required"=>"true");
		echo form_input($data); ?>
					  </div>
					  
					  
					  
					  <div class="form-group form-check">
					    <input type="checkbox" class="form-check-input" id="exampleCheck1">
					    <label class="form-check-label" for="exampleCheck1">Remember Me</label>
					  </div>
					  <button type="submit" class="btn btn-default1 mt_15">Login</button>
					  <a  class="color-primary d-block mt_30" href="<?php echo base_url();?>forgot_password">I forgot my password !</a>
					  <div class="from_socalmedia d-block mt_60">
				  		<a href="<?php echo urldecode($facebook_login_url);?>" class="btn facebook w-100">Login With Facebook</a>
				  		<p></p>
				  		<a href="<?php echo urldecode($google_login_url);?>" class="btn googleplus w-100">Login With Google Plus</a>
				  	
					  </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '729370800440427',
      cookie     : true,
      xfbml      : true,
      version    : '1.1'
    });
      
    FB.AppEvents.logPageView();   
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>    

<?php
$below_app_js = array('js/jquery.validate.min.js','js/login.js');
$this->load->view('includes/footer', array(
	'below_app_js' => $below_app_js)); ?>
