<?php
   $header = array('title' => 'Admin Login');   
   $this->load->view('includes/'.admin_folder.'header', $header);
?>

<body>

<div class="page-banner bg-gray">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="breadcrumbs color-secondery">
					
				</div>
				<div class="float-right color-primary">
					<h3 class="banner-title font-weight-bold">Admin Login</h3>
				</div>
			</div>
		</div>
	</div>
</div>
<section class="full-row">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-xl-6 row offset-md-3">
				<div class="full-row w-100 mb-5">
					<div class="submit_form color-secondery icon_primary">
						<?php 
					  	     $attributes = array('id' => 'loginfrm', 'autocomplete'=>'off','class' =>'');
						     echo form_open(admin_path().'login/submit', $attributes);
					        ?>	
                    		
							<div class="description">
								<h5 class="color-primary">Login Information</h5>
								<hr>
                                <?php $this->message_output->run(); ?>
								<div class="row">
									<div class="col-lg-12 col-md-12">
										<div class="form-group">
											<label>Username</label>
                                            <?php $data = array('class' =>'form-control', 'name'=> 'username','required'=>'true',  'id'=> 'username','value'=>set_value('username'),' placeholder' =>'Username');
										echo form_input($data); 
									?>										
										</div>
									</div>
                                    <div class="col-lg-12 col-md-12">
										<div class="form-group">
											<label>Password</label>
											<?php $data = array('class' =>'form-control', 'name'=> 'password', 'required'=>'true', 'id'=> 'password','value'=>'',' placeholder' =>'Password');
										  echo form_password($data); 
							     ?>
										</div>
									</div>
								    <div class="col-lg-12 col-md-12">
										<div class="form-group">
                                        <?php
										echo form_submit('loginSubmit', 'Login',"class='btn btn-default1'");
										?>									
										</div>
									</div>
                                </div>
							</div>
						
						<?php echo form_close();?>
					</div>
				</div>
				<div class="dashboard_copyright bg-white py-4 color-secondery text-center">© 2019 Homex All right reserved</div>
			</div>
		</div>
	</div>
</section>
<?php  $this->load->view('includes/' . admin_folder . 'inner_footer');?>
<?php 
$below_app_js=array('js/jquery.validate.min.js','js/c.js');
$this->load->view('includes/'.admin_folder.'footer',array('below_app_js'=>$below_app_js)); ?>