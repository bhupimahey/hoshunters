<footer class="full-row bg-gray">
	<div class="container">
		<div class="newsletter py_80 borber_b">
			<div class="row">
				<div class="col-md-12 col-lg-12">
				    <form name="subscriptionfrm" id="subscriptionfrm" method="post">
					<div class="row">
						<div class="col-md-6 col-lg-6">
							<div class="news_text color-primary">
								<h4>Enter your email for subscribe to get monthly newslatter</h4>
							</div>
						</div>
						<div class="col-md-6 col-lg-6">
							<div class="subscribe">
								<div class="input-group">
							         <input type="email" class="form-control" name="subscribe_email" id="subscribe_email" placeholder="Enter your email" required="true">
							         	<button class="btn btn-default1" type="submit">Subscribe</button>
						        </div>
							</div>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
		<div class="footer_area py_80 borber_b">
			<div class="row">
				<div class="col-md-12 col-lg-4">
					<div class="footer-widget">
						<div class="footer_logo pb_30">
							<a href="#"><img class="logo-bottom" src="<?php echo base_url();?>images/logo/logo.png" alt="image"></a>
						</div>
						<p class="pb_20">Risus commodo congue augue phasellus morbi hymenaeos ante tincidunt eu orci dictum bibendum lacus platea primis mi lacinia felis gravida natoque bibendum cubilia montes tristique et arcu blandit risus. Lobortis dignissim nam.</p>
						<a class="btn btn-default1" href="<?php echo base_url();?>login">Register Now</a>
					</div>
				</div>
				<div class="col-md-12 col-lg-8">
					<div class="row">
						<div class="col-md-4 col-lg-4">
							<div class="footer-widget">
								<div class="ft-widget-title color-primary">
									<h4>Support</h4>
								</div>
								<div class="help_links pt_50 hover_gray">
									<ul>
										<?php if(is_page('terms_and_conditions')){ ?>
										<li class="pb_20"><a href="<?php echo base_url();?>pages/terms_and_conditions">Terms and Condition</a></li>
										<?php } ?>
										<li class="pb_20"><a href="<?php echo base_url();?>faq">Freequenly Ask Question</a></li>
										<li class="pb_20"><a href="<?php echo base_url();?>contact">Contact</a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-lg-4">
							<div class="footer-widget">
								<div class="ft-widget-title color-primary">
									<h4>Quick Links</h4>
								</div>
								<div class="help_links pt_50 hover_gray">
									<ul>
									    <?php
									      $pages_menu = $this->common_model->pages_menu();
									    if($pages_menu) {
									 foreach($pages_menu as $page_info){
									?>
									<li class="pb_20"><a href="<?php echo base_url();?>pages/<?php echo $page_info->name_url;?>"><?php echo ucwords($page_info->title);?></a></li>
									
									<?php } }  ?>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-lg-4">
							<div class="footer-widget">
								<div class="ft-widget-title color-primary">
									<h4>Contact Us</h4>
								</div>
								<div class="help_links pt_50 pb_30 color-secondery">
									<ul>
										<li class="pb_20">1 Horwood Place North Parramatta 2150</li>
										<li class="pb_20">+1 246-345-0695</li>
										<li class="pb_20">helpline@hosthunters.com.au</li>
									</ul>
								</div>
								<div class="social_media hover_primary">
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
			</div>
		</div>
		<div class="copyright py_30">	
			<div class="copy_text color-secondery d-inline">&copy; 2019 Athithi All right reserved</div>
			<div class="policy hover_gray">
				<ul>
				    <?php if(is_page('privacy_policy')){ ?>
					<li><a href="<?php echo base_url();?>pages/privacy_policy">Privacy & Policy</a></li>
					<?php } ?>
					<li><a href="#"> Site Map</a></li>
				</ul>
			</div>
		</div>
	</div>
</footer>
<!-- Scroll to top -->
	<a href="#" class="bg-default color-white" id="scroll"><i class="fa fa-angle-up"></i></a>
<!-- End Scroll To top -->
</div>
</div>
<!-- Wrapper End -->

<!--	Js Link
============================================================-->
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
<script src="<?php echo base_url();?>js/jquery.validate.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAtLfFXXmIptDnSQURNRGjVSfAwZl-v6Vo"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?php
	if(isset($below_app_js)){
		foreach($below_app_js as $below_jsfiles){
		?>
<script type="text/javascript" src="<?php echo base_url().$below_jsfiles;?>"></script>
<?php
		}
	}
?>
<script>
$(document).ready(function(){
    
	$('.single_slide').owlCarousel({
    loop:true,
    margin:0,
    nav:false,
	autoplay:true,
    autoplayTimeout:2000,
    autoplayHoverPause:true,
	smartSpeed: 500,
    responsive:{
        0:{
            items:1
        },
		480:{
            items:2
        },
        600:{
            items:3
        },
		980:{
            items:4
        },
        1200:{
            items:5
        }
    }
})
	
    $(".autofillcity").on("click",function(){
        var cityname=$(this).attr("data-title");
        $("#searchsuburb").val(cityname);
        $("#city").val(cityname);
     });
    
    
    $("#subscriptionfrm").on("submit",function(){
        var subscribe_email = $("#subscribe_email").val();
        var action = base_url+'ajax/subscribe/newsletter'; 
           $.ajax({
        	url:action,
        	method:"POST",
        	dataType: "json",	
        	data:{action:action,emailid:subscribe_email},
        	success:function(email_data){
        	if(email_data){
        	    $("#subscribe_email").val('');
        	   	 $.confirm({
                    title: 'Thanks for your monthly subscription',
                    content: '',
                    type: 'green',
                    typeAnimated: true,
                    });
              }
           }  
        });
        return false;
    });  
        
    
    
var $newAddressInput = $("input[name='searchsuburb']");
    $newAddressInput.focus();
    applySearchAddress_search($newAddressInput);
    
    
  $("#srchfrm").validate({
    rules: {
      searchsuburb: {
        required: true
      },
	  min_rent: {
        number:true
      },
	  max_rent: {
		number:true
	   },
	 flatmatespref_status :{	required: true}  
	 },  
	   submitHandler: function (form) {
		    return true;
            }
		});

$("#searchsuburb").bind("paste", function(e){
    $("#search_p_street").val('');
    $("#search_p_country").val('');
    $("#search_p_latitude").val('');
    $("#search_p_longitude").val('');
    $("#search_p_state").val('');
    $("#search_p_city").val('');
    $("#search_p_postal_code").val('');
    $("#search_p_suburb").val(''); 
});
    
$(document).on("keyup","#searchsuburb", function (e) {
    $("#search_p_street").val('');
    $("#search_p_country").val('');
    $("#search_p_latitude").val('');
    $("#search_p_longitude").val('');
    $("#search_p_state").val('');
    $("#search_p_city").val('');
    $("#search_p_postal_code").val('');
    $("#search_p_suburb").val('');
});

$(document).on("change","#status_type", function (e) {
    var statustype = $(this).val();
    if(statustype==1){ 
     
     $("#rooms_div").show(); 
     $("#flatmates_div").hide();
     
       $(".filterdiv").html('<a href="javascript:void(0);" onclick="show_filters();"  class="small">+ Advanced filters</a>');
       $("#rooms_advanced_filter").hide();
       $("#others_advanced_filter").hide();
        
     
     
    } 
    else if(statustype==2){ 
     $(".filterdiv").html('<a href="javascript:void(0);" onclick="show_filters();"  class="small">+ Advanced filters</a>');
       $("#rooms_advanced_filter").hide();
       $("#others_advanced_filter").hide();
     $("#rooms_div").hide(); 
     $("#flatmates_div").show();
    } 
  else if(statustype==3){ 
    $(".filterdiv").html('<a href="javascript:void(0);" onclick="show_filters();"  class="small">+ Advanced filters</a>');
       $("#rooms_advanced_filter").hide();
       $("#others_advanced_filter").hide();
     $("#rooms_div").hide(); 
     $("#flatmates_div").show();
    }  
});
  


		
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
}); 


});

$(document).on("click", "#send_sms_upgrade", function () {
$.confirm({
    title: 'Message not sent, upgrade required!',
    content: '<p>The listing you are messaging is an Early Bird listing. To message Early Bird listings you need to upgrade your account.</p><p>Upgrading allows you to message anyone, gives you to access mobile numbers and increases the response rate you receive to your own listing.</p>',
    type: 'red',
     columnClass: 'medium',
    typeAnimated: true,
    buttons: {
        tryAgain: {
            text: 'View upgrade options',
            btnClass: 'btn-green',
            action: function(){
                	window.location.href=base_url+'customers/upgrade_account'
            }
        },
        close: function () {
        }
    }
});

});

$(document).on("click", "#show_mobile_upgrade", function () {
$.confirm({
    title: 'Upgrade Required!',
    content: '<p>To access mobile numbers you need to be an upgraded member.</p><p>If you choose not to upgrade then you can contact Free to Message listings through the messaging system</p>',
    type: 'red',
     columnClass: 'medium',
    typeAnimated: true,
    buttons: {
        tryAgain: {
            text: 'View all plans',
            btnClass: 'btn-green',
            action: function(){
                	window.location.href=base_url+'customers/upgrade_account'
            }
        },
        close: function () {
        }
    }
});

});


function applySearchAddress_search($input) {

  if (google.maps.places.PlacesServiceStatus.OK != "OK") {
    console.warn(google.maps.places.PlacesServiceStatus)
    return false;
  }
 var options = {
    // componentRestrictions: {
    //   country: "en"
    // }
  };

  var autocomplete = new google.maps.places.Autocomplete($input.get(0), options);

  autocomplete.addListener('place_changed', function() {

    var place = autocomplete.getPlace();
 
    if (place.length == 0) {
      return;
    }

    var address = '';
   if (place.address_components) {
		             var lat = autocomplete.getPlace().geometry.location.lat();
					var lng = autocomplete.getPlace().geometry.location.lng();
			        
			        
			        //console.log(lat+"==="+lng);
			       	$('#search_p_latitude').val(lat);
					$('#search_p_longitude').val(lng);
				
		    	    if (place.address_components) {
				    	  var component_form = {
						    'street_number': 'short_name',
						    'route': 'long_name',
						    'locality': 'long_name',
						    'administrative_area_level_1': 'short_name',
						    'country': 'long_name',
						    'postal_code': 'short_name'
						  };
						  //alert(place.address_components);
						  $street_number='';
						  $country='';
						  $city_id='';
						  $state_id='';
						  var show_street_number=''
						  var show_country_name=''
						  var show_postalcode_name='';
						  var show_state_name='';
						  var show_city_name='';
						  for(var i = 0; i < place.address_components.length; i += 1) {
							  var addressObj = place.address_components[i];
							 // alert(addressObj.short_name);
							  for(var j = 0; j < addressObj.types.length; j += 1) {
							      
							     if (addressObj.types[j] === 'street_number') {
							         $("#search_p_street").val('');
							         show_street_number = $("#search_p_street").val()+addressObj.long_name+','
									 }
                                 
							      
							   else  if (addressObj.types[j] === 'country') {
									 var country_value=addressObj.long_name;
									 $("#search_p_country").val('');
									 show_country_name = $("#search_p_country").val()+addressObj.long_name+','
										
					              }
	                             else if(addressObj.types[j] === 'administrative_area_level_1') {
	                              var regions_value=addressObj.long_name;	 
	                              $("#search_p_state").val('');
			                	   show_state_name = $("#search_p_state").val()+addressObj.long_name+','
				
                                 }	  
	                             else if (addressObj.types[j] === 'locality') {
	                              var city_value=addressObj.long_name;
	                              $("#search_p_city").val('');
			                	    show_city_name = $("#search_p_city").val()+addressObj.long_name+','
       	         
			                   }
    			    	         else if (addressObj.types[j] === 'postal_code') {
    			    	             $("#search_p_postal_code").val('');
 			                	  show_postalcode_name = $("#search_p_postal_code").val()+addressObj.long_name+','
 				  
    		                    	}
                                }
						}			
						
					
						
				/*-----------New code Abhi */
				addressObj.street_number ? $('#search_p_street').val(addressObj.street_number + ' ' + addressObj.route) : $('#search_p_street').val(addressObj.route);
				$('#search_p_suburb').val(addressObj.locality);
				
				/*-----------New code Abhi */
	   
	   
     				}
					else {
      // set an error - the user didn't provide a complete address
    }

	  
			  
		      address = [
		        (place.address_components[0] && place.address_components[0].short_name || ''),
		        (place.address_components[1] && place.address_components[1].short_name || ''),
		        (place.address_components[2] && place.address_components[2].short_name || ''),
		      ].join(' ');
		      	      		      
		    
		          $("#search_p_country").val(show_country_name);
		          $("#search_p_street").val(show_street_number);
		          $("#search_p_postal_code").val(show_postalcode_name);
		          $("#search_p_state").val(show_state_name);
		          $("#search_p_city").val(show_city_name);
			
		     
		    }
		    
		    
		    
    $input.val(address);
    
             
  });

  // set attr id to the predictions list
  setTimeout(function() {
    var rowId = $input.closest("div").attr("id");
    $(".pac-container:last").attr("id", "predictions_" + rowId);
  }, 100);

};  


</script>

<script src="<?php echo base_url();?>js/common.js"></script>

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