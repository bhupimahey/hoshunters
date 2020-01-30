<?php
$header = array('title' => 'Dashboard');
$this->load->view('includes/header', $header);
?>
<body>
	<?php  $this->load->view('includes/pages_inner_header');?>
	<div class="full-row deshbord">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-1 col-xl-2 bg-primary">
					<?php $this->load->view('includes/sidebar');?>
				</div>
				<div class="col-md-11 col-xl-10 bg-gray">
				<div class="row">
						<div class="full-row deshbord_panel w-100 mb-5">
							<h4 class="color-primary mb-4">Dashboard</h4>
							
						
						<?php $this->message_output->run(); ?>	
							
						</div>
						
					</div>
				
				
					
				</div>
			
			
						
					</div>
				</div>
			</div>
		</div>
	</div>
 
   
<?php 
$above_app_js = array();
$below_app_js=array('');
$this->load->view('includes/footer',array('below_app_js'=>$below_app_js,'above_app_js' => $above_app_js)); ?>