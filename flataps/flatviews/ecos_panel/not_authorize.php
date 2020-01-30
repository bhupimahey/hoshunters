<?php
$header = array('title' => 'Not Authorized!!!! ');
$this->load->view('includes/' . admin_folder . 'header', $header);
?>
<body>
	<?php  $this->load->view('includes/' . admin_folder . 'inner_header');?>
	<div class="full-row deshbord">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-1 col-xl-2 bg-primary">
					<?php $this->load->view('includes/' . admin_folder . 'sidebar');?>
				</div>
				<div class="col-md-11 col-xl-10 bg-gray">
					<div class="row">
						<div class="full-row deshbord_panel w-100 mb-5">
							<h4 class="color-primary mb-4">Not Authorized!!!!</h4>
							
							<div class="submit_form color-secondery icon_primary p-5 bg-white">
								<form>
									<div class="description">
										<p>
										<i class="fa fa-globe"></i>&nbsp;Your are not authorize to access this page 									</p>
									</div>
								
								</form>
							</div>
						</div>
						<div class="dashboard_copyright bg-white py-4 color-secondery text-center">© 2019 Homex All right reserved</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php  $this->load->view('includes/' . admin_folder . 'inner_footer');?>
<?php 
$below_app_js=array();
$this->load->view('includes/'.admin_folder.'footer',array('below_app_js'=>$below_app_js)); ?>