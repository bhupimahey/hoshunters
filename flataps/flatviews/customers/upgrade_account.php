<?php
$header = array('title' => 'Upgrade Account');
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
						<li class="hover_gray"><a href="#">Home</a></li>
						<li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
						<li class="color-default">Upgrade Account</li>
					</ul>
				</div>
				<div class="float-right color-primary">
					<h3 class="banner-title font-weight-bold">Upgrade Account</h3>
				</div>
			</div>
		</div>
	</div>
</div>
<section class="full-row">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="main-title-one">
					<h2 class="title color-primary">Listing Plans</h2>
					<p class="sub-title color-secondery py_60">We listed our oppertunity and servies as a real estate company</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="price_table1 py_80">
					<div class="row">
					    <?php if($package_lists){ 
					     foreach($package_lists as $packages){?>
						    <div class="col-md-12 col-lg-3">
						    <?php if($packages->highligh_package==1){?>
						    	<div class="pricing1 active text-center bg-white">
								<div class="price_top bg-default color-white">
									<h4><?php echo ucwords($packages->package_name);?></h4>
									<h3 class="color-white">$<?php echo $packages->package_price;?></h3>
									<p>Standard listing active for <?php echo $planvaliditylist[$packages->package_validity];?></p>
								</div>
								<div class="price_list color-secondery pb_30">
									<?php echo $packages->package_features;?>
								</div>
								<?php if($current_package->package_id==$packages->package_id){?>
								<a class="btn btn-default1 mb_30" href="#">Current</a>
								<?php } else { ?>
								<a class="btn btn-default1 mb_30 selpackage" href="#" data-id="<?php echo $packages->package_id;?>" data-title="<?php echo ucwords($packages->package_name);?>">Select</a>
								
								<?php } ?>
								
								<div class="free bg-default color-white"><?php echo $packages->special_notes;?></div>
							</div>
						    <?php } else { ?>
						    <div class="pricing1 text-center color-secondery">
								<div class="price_top bg-gray">
									<h4 class="color-primary"><?php echo ucwords($packages->package_name);?></h4>
									<h3 class="color-default">$<?php echo $packages->package_price;?></h3>
									<p>Standard listing active for <?php echo $planvaliditylist[$packages->package_validity];?></p>
								</div>
								<div class="price_list pb_30">
								    <?php echo $packages->package_features;?>
								</div>
								<?php if($current_package->package_id==$packages->package_id){?>
								<a class="btn btn-default1 mb_30" href="javascript:void(0);">Current</a>
						        	<?php } else { ?>
						        <a class="btn btn-default1 mb_30 selpackage" href="javascript:void(0);" data-id="<?php echo $packages->package_id;?>" data-title="<?php echo ucwords($packages->package_name);?>">Select</a>	
						        	<?php } ?>
							</div>
							
						    <?php } ?>
						</div>
						<?php } } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--	Footer
============================================================-->
<script>
    var customer_path='<?php echo customer_path();?>';
</script>
<?php
$below_app_js = array('js/upgrade_packages.js');
$this->load->view('includes/footer', array(
	'below_app_js' => $below_app_js)); ?>
