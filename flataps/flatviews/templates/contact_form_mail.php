<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<title>Cardionova</title>
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
<link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" media="all" />
<style>
  @import url('https://fonts.googleapis.com/css?family=Source+Sans+Pro');
    body
    {
      background: #eee;
    }
    body h4
    {
      font-weight: bolder;  
      font-family: 'Source Sans Pro', sans-serif;
      color:#000;
      margin-bottom:5px;
      background-color: #fec708;
      padding:5px 15px;
      font-size: 16px;
    }
   .logo {
    text-align: center;
    padding: 25px 0px 5px 0px;
}
    .logo img{
      width: 260px;
    }
    .email_inner h3{
      font-size: 34px;
      margin-bottom: 30px;
      padding:15px;
      color: #000;
      text-align: center;
      background: #F8E4E4;
      font-family: 'Source Sans Pro', sans-serif;
    }
    .table tbody tr th{
      width: 30%;
      padding:12px;
      background: rgba(255,255,255,0.5);
    }
    .table tbody tr td{
      padding:12px;
      background: rgba(255,255,255,0.5);
    }
    .copyright_sec{
    padding: 14px 0px;
    background: #F8E4E4;
    margin-top: 40px;
}
.copyright_sec p{
    text-align: center;
    color: #000;
    margin:0px;
}
.copyright_sec p span{
    color: #000;
} 
@media screen and (max-width:540px) {
  .email_inner h3 {
    font-size: 24px;
    padding: 10px;
}
.logo img {
    width: 210px;
}
}
</style>
</head>
<body>

<section class="email_form">
  <div class="container">
  <div class="logo">
    <a href="#"><img src="<?php echo base_url();?>/images/logo_c.png" alt="#"></a>
  </div>
  <div class="email_inner">
    <h3>ENQUIRE NOW DETAILS</h3>
    <div class="table-responsive">
    <table class="table table-bordered">
    <tbody>
      <tr>
        <th>Name:</th>
        <td><?php echo $contact_name;?></td>
      </tr>
      <tr>
        <th>Contact Number</th>
        <td><?php echo $contact_no;?></td>
      </tr>
      <tr>
        <th>Email</th>
        <td><?php echo $contact_email;?></td>
      </tr>
      
       <tr>
        <th>Query</th>
        <td><?php echo $contact_query;?></td>
      </tr>
      <tr>
        <th>IP Address:</th>
        <td><?php echo ip_address();?></td>
      </tr>
      <tr>
        <th>Request Date/Time:</th>
        <td><?php echo date('d M, Y h:i A');?></td>
      </tr>
    </tbody>
  </table>
</div>

  </div>
</div>
</section>
<section class="copyright_sec">
  <div class="container">
    <p>© 2018 <span>Cardionova</span> All Rights Reserved </p>
  </div>
</section>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script> 
</body>
</html>