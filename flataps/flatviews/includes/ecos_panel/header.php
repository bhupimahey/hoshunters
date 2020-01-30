<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo (isset($title) ? $title." | " : "").$this->config->item('site_title_info')?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<!-- Meta Tags -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Homex template">
	<meta name="keywords" content="">
	<meta name="author" content="Unicoder">
	
	<link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.ico">
	
	<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap-slider.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/layerslider.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/color.css" id="color-change">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/responsive.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>fonts/flaticon/flaticon.css">
    <?php  $this->external->run();  ?>  
    <script type="text/javascript" charset="utf-8">
	 var base_url = "<?php echo base_url();?>";
	 var admin_path = '<?php echo admin_path();?>';
	</script> 
</head>