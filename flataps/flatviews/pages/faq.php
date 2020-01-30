<?php
$header = array('title' => 'FAQ');
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
						<li class="color-default">FAQ</li>
					</ul>
				</div>
				<div class="float-right color-primary">
					<h3 class="banner-title font-weight-bold">FAQ</h3>
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
				    <?php
				    if($faq_list['recordsTotal'] >0){ foreach($faq_list['data'] as $list){ 
				    
				    ?>
					<div class="faq_item mb_30">
						<span class="faq_question bg-default color-white">Q</span>
						<div class="faq_answer d-table">
							<h5 class="mb-2 color-primary"><?php echo $list['faq_title'];?></h5>
							<?php echo $list['faq_desc'];?>
							<a class="float-right color-default" href="<?php echo base_url();?>contact">Contact Us</a>
						</div>
					</div>
					<?php } } ?>
				
					<div class="row">
						<div class="col-md-12">
							<?php echo $faq_list['links'];?>
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
