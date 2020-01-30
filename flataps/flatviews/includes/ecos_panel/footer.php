<script src="<?php echo base_url();?>js/jquery.min.js"></script>
<!--jQuery Layer Slider -->
<script src="<?php echo base_url();?>js/greensock.js"></script>
<script src="<?php echo base_url();?>js/layerslider.transitions.js"></script>
<script src="<?php echo base_url();?>js/layerslider.kreaturamedia.jquery.js"></script>
<!--jQuery Layer Slider -->
<script src="<?php echo base_url();?>js/popper.min.js"></script>
<script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>js/owl.carousel.min.js"></script>
<script src="<?php echo base_url();?>js/tmpl.js"></script>
<script src="<?php echo base_url();?>js/jquery.dependClass-0.1.js"></script>
<script src="<?php echo base_url();?>js/draggable-0.1.js"></script>  
<script src="<?php echo base_url();?>js/jquery.slider.js"></script>
<script src="<?php echo base_url();?>js/wow.js"></script>
<script src="<?php echo base_url();?>js/YouTubePopUp.jquery.js"></script>
<script src="<?php echo base_url();?>js/validate.js"></script>
<script src="<?php echo base_url();?>js/custom.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

<?php
if(isset($below_app_js)){
  foreach($below_app_js as $below_jsfiles){
	  if($below_jsfiles!=''){ ?>
<script type="text/javascript" src="<?php echo base_url().$below_jsfiles;?>"></script>
<?php
	  }
    }
 }
?>
<script>

$(document).on("click",".delete_record", function (e) {
 	 var delete_link = $(this).attr("href");
	
 $.confirm({
    title: 'Are you sure to delete ?',
    content: '',
    type: 'red',
    typeAnimated: true,
    buttons: {
        tryAgain: {
            text: 'Yes',
            btnClass: 'btn-red',
            action: function(){
				window.location.href=delete_link
            }
        },
		
        close: function () {
        }
    } });			
return false;
}); </script>
<div class="modal" id="contact-edit" tabindex="-1" role="dialog" aria-hidden="true"></div>

<div class="modal" id="request-edit" tabindex="-1" role="dialog" aria-hidden="true"></div>

<div class="modal" id="about-persion-edit" tabindex="-1" role="dialog" aria-hidden="true"></div>

<div class="modal" id="about-personalquality-edit" tabindex="-1" role="dialog" aria-hidden="true"></div>

<div class="modal" id="about-foodsharing-edit" tabindex="-1" role="dialog" aria-hidden="true"></div>



<div class="modal fade" id="confirm" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" >
      <div class="modal-header">
        <h4 class="modal-title"> Are you sure?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">Delete</button>
        <button type="button" data-dismiss="modal" class="btn">Cancel</button>
      </div>
    </div>
  </div> 
</div>
</body>
</html>