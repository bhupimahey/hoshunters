<?php
$header = array('title' => 'Contact Us');
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
						<li class="color-default">Contact</li>
					</ul>
				</div>
				<div class="float-right color-primary">
					<h3 class="banner-title font-weight-bold">Contact</h3>
				</div>
			</div>
		</div>
	</div>
</div>

<section class="full-row">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-4">
				<div class="contact_info">
					<h3 class="mb-4 color-primary">Support</h3>
					<div class="d-flex">
						<div class="circle mr-4"><img src="<?php echo base_url();?>images/team/01.jpg" alt=""></div>
						<div class="contact_details">
							<h5 class="d-table">Lawrance Kyle</h5>
							<span class="d-table color-secondery">Support Member</span>
							<a class="color-default" href="#">info@hosthunters.com.au</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12 col-lg-4">
				<div class="contact_info">
					<h3 class="mb-4 color-primary">Contacts</h3>
					<ul class="icon_default">
						<li class="d-flex mb-4">
							<span class="fa-1x mr-4 w-25-px"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
							<div class="contact_address">
								<h5 class="color-primary">Address</h5>
								<span>1 Horwood place, Parramatta, 2150, Australia</span>
							</div>
						</li>
						<li class="d-flex mb-4">
							<span class="fa-1x mr-4 w-25-px"><i class="fa fa-phone" aria-hidden="true"></i></span>
							<div class="contact_address">
								<h5 class="color-primary">Call Us</h5>
								<span class="d-table">0450281525 (or)</span>
								<span>0416432156</span>
							</div>
						</li>
						<li class="d-flex mb-4">
							<span class="fa-1x mr-4 w-25-px"><i class="fa fa-envelope" aria-hidden="true"></i></span>
							<div class="contact_address">
								<h5 class="color-primary">Address</h5>
								<span>info@hosthunters.com.au</span>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-md-12 col-lg-4">
				<div class="contact_info">
					<h3 class="mb-4 color-primary">Social</h3>
					<div class="social_media pt-3 hover_primary">
						<ul>
							<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!--	Get In Touch
===============================================================-->
<section class="full-row pt-0">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="main-title-one">
					<h2 class="title color-primary">Get In Touch</h2>
					<p class="sub-title color-secondery py_60">Nullam dapibus nullam aliquet maecenas pede dignissim Felis porta risus sociis.</p>
				</div>
			</div>
			
			<div class="col-md-12">
			    
					<?php  $attributes = array('class'=>'"w-100','id' => 'contactfrm','name' => 'contactfrm','autocomplete' => 'off','method'=>'post');
		        	 echo form_open(base_url()."contact/submit", $attributes);
			         ?>
			         
					<div class="row">
						<div class="col-md-12 col-lg-6">
							<div class="form-group">
							    <?php $data = array('class' =>'form-control bg-gray', 'name'=> 'firstname', 'placeholder'=>"Your Name*", 'id'=> 'firstname',"required"=>"true","value"=>set_value("firstname"));
                    	         echo form_input($data);
                    	        ?>
                    	
							</div>
							<div class="form-group">
							     <?php $data = array('class' =>'form-control bg-gray','type'=>'email', 'name'=> 'email', 'placeholder'=>"Email Address*", 'id'=> 'email',"required"=>"true","value"=>set_value("email"));
                    	         echo form_input($data);
                    	        ?>
							</div>
							<div class="form-group">
							     <?php $data = array('class' =>'form-control bg-gray', 'name'=> 'site-link', 'placeholder'=>"Website", 'id'=> 'site-link');
                    	         echo form_input($data);
                    	        ?>
							</div>
							<div class="form-group">
							     <?php $data = array('class' =>'form-control bg-gray', 'name'=> 'subject', 'placeholder'=>"Subject", 'id'=> 'subject');
                    	         echo form_input($data);
                    	        ?>
							</div>
						</div>
						<div class="col-md-12 col-lg-6">
							<div class="form-group">
							     <?php $data = array('class' =>'form-control bg-gray', 'name'=> 'message','rows'=>'7', 'placeholder'=>"Type Comments", 'id'=> 'message');
                    	         echo form_textarea($data);
                    	        ?>
							</div>
							<button type="submit" id="send" value="send message" class="btn btn-default1">Send Message</button>
						</div>
						<div class="col-md-12">
							<div class="error-handel">
							    <?php $this->message_output->run(); ?>
								
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

<!--	Map
===============================================================-->
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="row">
				<div id="map" class="contact-location"></div>
			</div>
		</div>
	</div>
</div>


<?php
$below_app_js = array('js/jquery.validate.min.js','js/contact.js');
$this->load->view('includes/footer', array(
	'below_app_js' => $below_app_js)); ?>
