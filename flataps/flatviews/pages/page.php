<?php
$header = array('title' => $page_info->title);
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
						<li class="color-default"><?php echo ucwords($page_info->title);?></li>
					</ul>
				</div>
				<div class="float-right color-primary">
					<h3 class="banner-title font-weight-bold"><?php echo ucwords($page_info->title);?></h3>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Banner Section End -->


<!-- FAQ Section Start -->
<section class="full_row py_80">
	<div class="container">
		<div class="row">
			
			<div class="col-lg-12">
				<div class="info-pages bg-gray p-4">
					<div class="faq_item mb_30">
						
						<div class="faq_answer d-table">
							<h5 class="mb-2 color-primary"><?php echo ucwords($page_info->title);?></h5>
						    <?php echo $page_info->description;?>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- FAQ Section End -->

<?php
$below_app_js = array('js/jquery.validate.min.js','js/contact.js');
$this->load->view('includes/footer', array(
	'below_app_js' => $below_app_js)); ?>
