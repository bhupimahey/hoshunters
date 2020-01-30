<?php
$header = array('title' => 'List my place');
$this->external->set_css(array(base_url().'css/steps.css',base_url().'fonts/material-design-iconic-font/css/material-design-iconic-font.css',base_url().'jsupload/js/jquery.plupload.queue/css/jquery.plupload.queue.css'));
$this->load->view('includes/header', $header);

?>
<body>
<style>
[type="radio"] {
display:inline-block;
}
/* This parent can be any width and height */
#loading {
  text-align: center;
    background:#ccc;
    opacity: 0.85;
    margin-bottom:10px;
    height: 100%;
    width: 100%;
    top: 0;
    left: 0;
    position:absolute;
    display:none;
    z-index: 999999;
}
 
/* The ghost, nudged to maintain perfect centering */
#loading:before {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
  margin-right: -0.25em; /* Adjusts for spacing */
}

/* The element to be centered, can
   also be of any width and height */ 
#loading > div {
  display: inline-block;
  vertical-align: middle;
  color: white;
}
</style>
</style>
<?php $this->load->view('includes/pages_inner_header'); ?>
<div class="page-banner bg-gray">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-12">
        <div class="breadcrumbs color-secondery">
          <ul>
            <li class="hover_gray"><a href="<?php echo base_url();?>">Home</a></li>
            <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
            <li class="color-default">List my place</li>
          </ul>
        </div>
        <div class="float-right color-primary">
          <h3 class="banner-title font-weight-bold">List my place</h3>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="wrapper container cust-wrap">
    <div class="step_wrap">
   <?php  $attributes = array('id' => 'wizard','name' => 'listmyplacefrm','role' => 'form','autocomplete' => 'off');
	     echo form_open_multipart(customer_path().'listings/list_my_place/submit', $attributes);
	     echo form_hidden('rmcntr','');
	     echo form_hidden('plcid','');
	     echo form_hidden('deleted_file_ids');
    ?>
     <input type="hidden" name="street" id="street" value=''>
		        <input type="hidden" name="country" id="country" value=''>
		        <input type="hidden" name="latitude" id="latitude" value=''>
		        <input type="hidden" name="longitude" id="longitude" value=''>
		        <input type="hidden" name="state" id="state" value=''>
		        <input type="hidden" name="city" id="city" value=''>
		        <input type="hidden" name="postal_code" id="postal_code" value=''>        
                        
    <!-- SECTION 1 -->
    <h2></h2>
    <section>
      <div class="inner">
        <div class="image-holder" style="background-image:url(<?php echo base_url();?>images/form-wizard-1.jpg)"> <!--<img src="" alt="" style="width:100%;">--> </div>
        <div class="form-content" >
          <div class="form-header">
            <h3>Describe your place</h3>
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
                <div class="form-holder" style="align-self: flex-end; transform: translateY(4px);">
                  <ul class="radio_submit cust-radio">
                    <li>
                      <input type="radio" name="accommodation_offering" class="hide accofer" id="accommodation_offering1" value="1" checked>
                      <label for="accommodation_offering1">
                      <span>
					  	<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 480 480" style="enable-background:new 0 0 480 480;" xml:space="preserve">
							<g>
								<g>
									<path d="M304,304.808V232c0-13.232-10.768-24-24-24H56c-13.232,0-24,10.768-24,24v72.808C13.768,308.528,0,324.688,0,344v48v80
										c0,4.416,3.584,8,8,8h32c4.416,0,8-3.584,8-8v-24h240v24c0,4.416,3.584,8,8,8h32c4.416,0,8-3.584,8-8v-80v-48
										C336,324.688,322.232,308.528,304,304.808z M48,232c0-4.408,3.592-8,8-8h224c4.408,0,8,3.592,8,8v72h-16v-32
										c0-13.232-10.768-24-24-24h-48c-13.232,0-24,10.768-24,24v32h-16v-32c0-13.232-10.768-24-24-24H88c-13.232,0-24,10.768-24,24v32
										H48V232z M256,272v32h-64v-32c0-4.408,3.592-8,8-8h48C252.408,264,256,267.592,256,272z M144,272v32H80v-32c0-4.408,3.592-8,8-8
										h48C140.408,264,144,267.592,144,272z M320,464h-16v-24c0-4.416-3.584-8-8-8H40c-4.416,0-8,3.584-8,8v24H16v-64h304V464z M320,384
										H16v-40c0-13.232,10.768-24,24-24h32h80h32h80h32c13.232,0,24,10.768,24,24V384z"/>
								</g>
							</g>
							<g>
								<g>
									<path d="M472,304H360c-4.416,0-8,3.584-8,8v64v56h16v-48h96v48h16v-56v-64C480,307.584,476.416,304,472,304z M464,368h-96v-48h96
										V368z"/>
								</g>
							</g>
							<g>
								<g>
									<rect x="400" y="336" width="32" height="16"/>
								</g>
							</g>
							<g>
								<g>
									<path d="M455.592,237.464l-16-48C438.496,186.2,435.448,184,432,184h-32c-3.448,0-6.496,2.2-7.592,5.472l-16,48
										c-0.816,2.44-0.4,5.12,1.104,7.208c1.504,2.088,3.92,3.32,6.488,3.32h24v24h-16v16h48v-16h-16v-24h24
										c2.568,0,4.984-1.232,6.488-3.328C455.992,242.584,456.4,239.904,455.592,237.464z M395.096,232l10.672-32h20.472l10.664,32
										H395.096z"/>
								</g>
							</g>
							<g>
								<g>
									<path d="M475.272,104.696l-232-104c-2.088-0.928-4.464-0.928-6.544,0l-232,104C1.848,105.992,0,108.848,0,112v96h16v-90.824
										L240,16.768l224,100.416V208h16v-96C480,108.848,478.152,105.992,475.272,104.696z"/>
								</g>
							</g>
							<g>
								<g>
									<path d="M295.224,110.672l-15.784,2.656c0.376,2.184,0.56,4.424,0.56,6.672c0,22.056-17.944,40-40,40c-22.056,0-40-17.944-40-40
										c0-22.056,17.944-40,40-40c4.576,0,9.072,0.768,13.344,2.28l5.328-15.088C252.68,65.072,246.4,64,240,64c-30.88,0-56,25.12-56,56
										s25.12,56,56,56s56-25.12,56-56C296,116.864,295.736,113.728,295.224,110.672z"/>
								</g>
							</g>
							<g>
								<g>
									<path d="M290.344,66.344L240,116.688l-10.344-10.344l-11.312,11.312l16,16c1.56,1.56,3.608,2.344,5.656,2.344
										c2.048,0,4.096-0.784,5.656-2.344l56-56L290.344,66.344z"/>
								</g>
							</g>
							</svg>
                         </span>
                      	Room(s) in an existing sharehouse
                      </label>
                    </li>
                    <li>
                      <input type="radio" name="accommodation_offering" class="hide accofer" id="accommodation_offering2" value="2">
                      <label for="accommodation_offering2">
                      	<span>
                        	<svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m452 120c-33.085938 0-60-26.914062-60-60s26.914062-60 60-60 60 26.914062 60 60-26.914062 60-60 60zm0-100c-22.054688 0-40 17.945312-40 40s17.945312 40 40 40 40-17.945312 40-40-17.945312-40-40-40zm0 0"/><path d="m267.773438 110.390625h-257.773438c-5.523438 0-10-4.480469-10-10 0-34.566406 28.644531-62.621094 63.417969-61.558594 14.65625-24.117187 40.570312-38.832031 69.15625-38.832031 23.421875 0 45.75 10.277344 61.054687 27.804688 5.347656-1.328126 10.847656-1.996094 16.429688-1.996094 37.542968 0 68.085937 30.542968 68.085937 68.082031 0 2.472656-.148437 5.03125-.433593 7.605469-.566407 5.066406-4.84375 8.894531-9.9375 8.894531zm-246.558594-20h236.800781c-1.800781-24.886719-22.621094-44.582031-47.957031-44.582031-5.699219 0-11.273438.984375-16.566406 2.925781-4.195313 1.542969-8.910157.105469-11.535157-3.511719-11.460937-15.792968-29.921875-25.222656-49.382812-25.222656-23.273438 0-44.191407 12.957031-54.597657 33.8125-1.925781 3.859375-6.113281 6.046875-10.378906 5.433594-2.015625-.292969-4.039062-.441406-6.011718-.441406-19.484376 0-35.882813 13.46875-40.371094 31.585937zm0 0"/><path d="m447.488281 468.601562c-.648437 0-1.296875-.070312-1.949219-.203124-.640624-.117188-1.269531-.308594-1.867187-.558594-.601563-.25-1.183594-.558594-1.722656-.917969-.550781-.371094-1.058594-.792969-1.519531-1.25-.46875-.460937-.878907-.972656-1.25-1.523437-.359376-.539063-.667969-1.117188-.917969-1.71875-.25-.609376-.441407-1.238282-.570313-1.871094-.132812-.648438-.191406-1.308594-.191406-1.957032 0-.652343.058594-1.3125.191406-1.953124.128906-.636719.320313-1.269532.570313-1.867188.25-.609375.558593-1.191406.917969-1.730469.359374-.550781.78125-1.058593 1.242187-1.519531.457031-.460938.976563-.882812 1.519531-1.242188.546875-.359374 1.128906-.667968 1.730469-.917968.597656-.25 1.226563-.441406 1.867187-.570313 1.289063-.261719 2.621094-.261719 3.910157 0 .640625.128907 1.269531.320313 1.871093.570313.601563.25 1.179688.558594 1.730469.917968.539063.359376 1.058594.78125 1.519531 1.242188.460938.460938.878907.96875 1.238282 1.519531.363281.539063.671875 1.121094.921875 1.730469.25.601562.441406 1.230469.570312 1.867188.128907.640624.199219 1.300781.199219 1.953124 0 .648438-.070312 1.308594-.199219 1.957032-.128906.632812-.320312 1.261718-.570312 1.871094-.25.601562-.558594 1.179687-.921875 1.71875-.359375.550781-.777344 1.0625-1.238282 1.523437-.460937.457031-.980468.878906-1.519531 1.25-.550781.359375-1.128906.667969-1.730469.917969-.601562.25-1.230468.441406-1.871093.558594-.648438.132812-1.300781.203124-1.960938.203124zm0 0"/><path d="m502 405.207031h-18.527344v-111.378906l2.996094 2.199219c1.75 1.285156 3.828125 1.941406 5.921875 1.941406 1.539063 0 3.089844-.355469 4.515625-1.078125 3.363281-1.703125 5.484375-5.152344 5.484375-8.921875v-54.757812c0-3.183594-1.515625-6.175782-4.082031-8.0625l-136.753906-100.460938c-3.523438-2.585938-8.320313-2.585938-11.84375 0l-60.085938 44.140625-27.703125-20.351563c-3.523437-2.589843-8.320313-2.589843-11.84375 0l-27.707031 20.351563-60.085938-44.140625c-3.519531-2.585938-8.316406-2.585938-11.839844 0l-136.757812 100.464844c-2.5625 1.882812-4.078125 4.875-4.078125 8.058594v54.757812c0 3.769531 2.121094 7.222656 5.484375 8.921875 1.425781.722656 2.972656 1.078125 4.515625 1.078125 2.089844 0 4.171875-.652344 5.917969-1.9375l3-2.203125v111.378906h-18.527344c-5.523438 0-10 4.476563-10 10v86.792969c0 5.523438 4.476562 10 10 10h492c5.523438 0 10-4.476562 10-10v-86.792969c0-5.523437-4.476562-10-10-10zm-38.527344-126.070312.003906 126.070312h-79.632812l-.003906-87.59375 3 2.203125c.050781.039063.101562.074219.152344.113282.019531.011718.035156.019531.050781.03125.035156.027343.070312.050781.109375.074218.019531.015625.039062.027344.058594.042969.03125.019531.0625.042969.097656.0625.019531.015625.042968.03125.066406.042969.03125.023437.066406.042968.101562.066406.015626.011719.035157.023438.054688.03125.035156.023438.074219.046875.113281.070312.015625.007813.035157.019532.050781.03125.046876.023438.089844.050782.136719.078126.007813.003906.019531.011718.027344.015624.113281.0625.226563.125.34375.183594.007813.003906.011719.003906.019531.007813.046875.027343.097656.050781.148438.074219.011718.007812.027344.015624.039062.019531.042969.023437.089844.042969.136719.0625.011719.007812.023437.011719.035156.019531.050781.019531.097657.042969.144531.066406.011719.003906.019532.007813.027344.011719 2.296875 1.003906 4.902344 1.109375 7.285156.28125.007813-.003906.007813-.003906.011719-.003906.171875-.0625.339844-.125.507813-.195313.015625-.007812.03125-.011718.046875-.019531.03125-.011719.0625-.023437.09375-.039063.019531-.007812.039062-.015624.058593-.023437.027344-.011719.050782-.023437.078126-.035156.027343-.011719.050781-.023438.078124-.035157.023438-.007812.046876-.019531.070313-.03125.027344-.011718.058594-.027343.089844-.042968.019531-.007813.035156-.015625.054687-.027344.050782-.023438.097656-.046875.144532-.070312 3.363281-1.703126 5.484374-5.152344 5.484374-8.921876v-54.761718c0-3.183594-1.515624-6.175782-4.078124-8.058594l-54.890626-40.320312 11.84375-8.699219zm-184.800781 169.464843h-45.34375v-59.652343h45.34375zm10-79.652343h-65.34375c-5.519531 0-10 4.480469-10 10v69.652343h-65.167969v-145.679687l107.839844-79.21875 107.839844 79.21875.003906 145.679687h-65.171875v-69.652343c0-5.519531-4.480469-10-10-10zm66.960937-223.792969 126.757813 93.117188v29.941406l-120.835937-88.769532c-3.246094-2.382812-7.578126-2.570312-10.992188-.558593-.292969.171875-.574219.359375-.847656.558593l-22.816406 16.761719-20.378907-14.972656zm-99.632812 23.785156 126.757812 93.117188v29.941406l-2.996093-2.203125-117.839844-86.5625c-.277344-.203125-.558594-.390625-.847656-.558594-3.128907-1.84375-7.019531-1.84375-10.144531 0-.292969.171875-.574219.355469-.851563.558594l-117.839844 86.5625-2.996093 2.203125v-29.941406zm-226.390625 69.332032 126.757813-93.117188 49.113281 36.078125-20.378907 14.972656-22.816406-16.757812c-3.519531-2.589844-8.316406-2.589844-11.839844 0l-120.835937 88.765625zm18.917969 40.863281 107.839844-79.222657 11.84375 8.703126-54.890626 40.320312c-.039062.027344-.078124.058594-.117187.085938-2.058594 1.5625-3.417969 3.839843-3.828125 6.351562-.015625.097656-.03125.195312-.042969.292969-.011719.097656-.023437.195312-.035156.292969-.035156.339843-.054687.6875-.054687 1.035156v54.761718c0 3.769532 2.121093 7.21875 5.484374 8.921876.050782.023437.105469.050781.15625.078124 1.136719.546876 2.339844.867188 3.558594.964844 2.355469.191406 4.75-.457031 6.722656-1.90625l2.996094-2.203125v87.59375h-79.628906zm79.632812 146.070312v23.394531h-108.160156v-23.394531zm363.839844 66.792969h-472v-23.398438h387c5.523438 0 10-4.476562 10-10 0-5.519531-4.476562-10-10-10h-23.15625v-23.394531h108.15625zm0 0"/><path d="m256 347.96875c-23.859375 0-43.273438-19.410156-43.273438-43.273438 0-23.859374 19.414063-43.269531 43.273438-43.269531s43.273438 19.410157 43.273438 43.269531c0 23.863282-19.414063 43.273438-43.273438 43.273438zm0-66.546875c-12.832031 0-23.273438 10.441406-23.273438 23.273437 0 12.832032 10.441407 23.273438 23.273438 23.273438s23.273438-10.441406 23.273438-23.273438c0-12.832031-10.441407-23.273437-23.273438-23.273437zm0 0"/></svg>
                        </span>
                      	Whole property for rent
                      </label>
                    </li>
                    <li>
                      <input type="radio" name="accommodation_offering" class="hide accofer" id="accommodation_offering3" value="3">
                      <label for="accommodation_offering3">
                      	<span>
                      		<svg viewBox="0 0 480 480" xmlns="http://www.w3.org/2000/svg"><path d="m472 208h-9.441406l-14.71875-73.601562c-.761719-3.722657-4.039063-6.398438-7.839844-6.398438h-96c-.265625 0-.496094.144531-.761719.167969-.742187.058593-1.46875.222656-2.167969.488281-.324218.136719-.644531.289062-.949218.464844-.65625.378906-1.257813.851562-1.785156 1.398437-.152344.160157-.375.234375-.519532.410157-.144531.175781-.097656.230468-.167968.335937-.46875.652344-.835938 1.375-1.082032 2.140625-.125.261719-.238281.527344-.335937.800781-.027344.0625-.050781.128907-.070313.191407l-14.71875 73.601562h-113.441406v-8c0-13.253906-10.746094-24-24-24v-16h64c13.253906 0 24-10.746094 24-24v-112c0-13.253906-10.746094-24-24-24h-192c-13.253906 0-24 10.746094-24 24v112c0 13.253906 10.746094 24 24 24h64v16c-13.253906 0-24 10.746094-24 24v8h-88c-4.417969 0-8 3.582031-8 8v256c0 4.417969 3.582031 8 8 8h32c4.417969 0 8-3.582031 8-8v-56h384v56c0 4.417969 3.582031 8 8 8h32c4.417969 0 8-3.582031 8-8v-256c0-4.417969-3.582031-8-8-8zm-38.558594-64 12.796875 64h-79.679687l-12.796875-64zm-90.351562 37.34375 6.664062 26.65625h-12zm-295.089844-157.34375c0-4.417969 3.582031-8 8-8h192c4.417969 0 8 3.582031 8 8v88h-208zm0 112v-8h208v8c0 4.417969-3.582031 8-8 8h-192c-4.417969 0-8-3.582031-8-8zm88 24h32v16h-32zm-24 40c0-4.417969 3.582031-8 8-8h64c4.417969 0 8 3.582031 8 8v8h-80zm-64 200v-144h384v144zm416 64h-16v-216c0-4.417969-3.582031-8-8-8h-400c-4.417969 0-8 3.582031-8 8v216h-16v-240h448zm0 0"/></svg>
                        </span>
                        Student accommodation
                      </label>
                    </li>
                    <li>
                      <input type="radio" name="accommodation_offering" class="hide accofer" id="accommodation_offering4" value="4">
                      <label for="accommodation_offering4">
                      	<span>
                        	<svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 463 463" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 463 463">
							  <g>
								<path d="m450.858,191.216c1.349,1.063 2.989,1.609 4.643,1.609 1.114,0 2.233-0.248 3.273-0.752 2.585-1.254 4.226-3.875 4.226-6.748v-40c0-2.298-1.053-4.469-2.858-5.891l-122.099-96.199c-8.563-6.747-20.524-6.746-29.087,0l-45.956,36.208v-14.118c0-4.142-3.358-7.5-7.5-7.5h-32c-4.142,0-7.5,3.358-7.5,7.5v51.149l-29.142,22.96c-1.805,1.422-2.858,3.593-2.858,5.891v40c0,2.873 1.641,5.494 4.226,6.748 2.584,1.254 5.659,0.922 7.916-0.856l3.858-3.04v73.086l-69.957-55.117c-8.563-6.747-20.524-6.747-29.087,0l-98.098,77.288c-1.805,1.421-2.858,3.593-2.858,5.891v40c0,2.873 1.641,5.494 4.226,6.748 1.04,0.505 2.159,0.752 3.273,0.752 1.653,0 3.294-0.546 4.643-1.609l3.858-3.04v77.649h-8.5c-4.142,0-7.5,3.358-7.5,7.5s3.358,7.5 7.5,7.5h448c4.142,0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5h-8.5v-221.649l3.858,3.04zm-219.858-118.391h17v18.437l-17,13.394v-31.831zm-32,76.139l119.24-93.946c3.097-2.44 7.424-2.44 10.521,0l119.239,93.946v20.903l-119.858-94.433c-1.361-1.073-3.001-1.609-4.642-1.609s-3.28,0.536-4.642,1.609l-119.858,94.433v-20.903zm-184,144l95.24-75.037c3.097-2.44 7.424-2.44 10.521,0l79.239,62.431v20.904l-79.858-62.919c-2.723-2.146-6.561-2.146-9.283,0l-95.859,75.525v-20.904zm16,27.394l84.5-66.575 84.5,66.576v89.467h-33v-88.5c0-4.142-3.358-7.5-7.5-7.5h-88c-4.142,0-7.5,3.358-7.5,7.5v88.5h-33v-89.468zm48,40.467h73v17h-73v-17zm73-15h-73v-17h73v17zm-73,47h73v17h-73v-17zm217-38.975c-0.166-0.011-0.333-0.025-0.5-0.025-1.97,0-3.91,0.8-5.3,2.2-1.4,1.39-2.2,3.33-2.2,5.3 0,1.97 0.8,3.91 2.2,5.3 1.39,1.4 3.33,2.2 5.3,2.2 0.167,0 0.334-0.014 0.5-0.025v41.025h-33v-97h33v41.025zm136,55.975h-121v-104.5c0-4.142-3.358-7.5-7.5-7.5h-48c-4.142,0-7.5,3.358-7.5,7.5v104.5h-33v-233.467l108.5-85.485 108.5,85.485v233.467z"/>
								<path d="m343.5,376.825h48c4.142,0 7.5-3.358 7.5-7.5v-64c0-4.142-3.358-7.5-7.5-7.5h-48c-4.142,0-7.5,3.358-7.5,7.5v64c0,4.142 3.358,7.5 7.5,7.5zm7.5-15v-25h33v25h-33zm33-49v9h-33v-9h33z"/>
								<path d="m343.5,264.825h48c4.142,0 7.5-3.358 7.5-7.5v-64c0-4.142-3.358-7.5-7.5-7.5h-48c-4.142,0-7.5,3.358-7.5,7.5v64c0,4.142 3.358,7.5 7.5,7.5zm7.5-15v-25h33v25h-33zm33-49v9h-33v-9h33z"/>
								<path d="m303.5,185.825h-48c-4.142,0-7.5,3.358-7.5,7.5v64c0,4.142 3.358,7.5 7.5,7.5h48c4.142,0 7.5-3.358 7.5-7.5v-64c0-4.142-3.358-7.5-7.5-7.5zm-7.5,15v9h-33v-9h33zm-33,49v-25h33v25h-33z"/>
							  </g>
							</svg>
                        </span>
                      	Homestay
                      </label>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-12 col-md-12" id="property_type_div">
              <div class="form-group">
                <label>Type of property</label>
                <?php				
			    $property_type = $this->config->item('property_type');									
				echo form_dropdown('property_type', $property_type,set_value('property_type'),'class="form-control" ');
				?>
              </div>
            </div>
          </div>
          
          
           <div class="form-header" id="type_of_property1_div" style="display:none;">
            <h3>What type of property is this?</h3>
          </div>
          <div class="row" id="type_of_property2_div" style="display:none;">            
            <div class="col-lg-12 col-md-12">
              <div class="form-group">               
                <?php				
			    $type_of_property = $this->config->item('type_of_property');									
				echo form_dropdown('type_of_property', $type_of_property,set_value('type_of_property'),'class="form-control" ');
				?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <!-- SECTION 2 -->
    <h2></h2>
    <section id="about_property_section">
      <div class="inner">
        <div class="image-holder" style="background-image:url(<?php echo base_url();?>images/form-wizard-2.jpg)"> <!--<img src="" alt="" style="width:100%;">--> </div>
        <div class="form-content">
          <div class="form-header">
            <h3>About the property</h3>
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
                <label>Property Address</label>
                <?php $data = array('class' =>'form-control', 'name'=> 'property_address', 'id'=> 'property_address',"required"=>"true","value"=>set_value("property_address"));
                    	echo form_input($data); ?>
                        
               
              </div>
            </div>
            <div class="col-lg-6 col-md-12">
              <div class="form-group">
                <label>Total bedrooms<br></label>
                <?php				
			    $total_bedrooms = $this->config->item('total_bedrooms');									
				echo form_dropdown('total_bedrooms', $total_bedrooms,set_value('total_bedrooms'),'class="form-control" ');
				?>
              </div>
            </div>
            <div class="col-lg-6 col-md-12">
              <div class="form-group">
                <label>Total bathrooms</label>
                <?php				
			    $total_bathrooms = $this->config->item('total_bathrooms');									
				echo form_dropdown('total_bathrooms', $total_bathrooms,set_value('total_bathrooms'),'class="form-control" ');
				?>
              </div>
            </div>
            <div class="col-lg-6 col-md-12">
              <div class="form-group">
                <label>Parking</label>
                <?php				
			    $parking_status = $this->config->item('parking_status');									
				echo form_dropdown('parking', $parking_status,set_value('parking'),'class="form-control" ');
				?>
              </div>
            </div>
            <div class="col-lg-6 col-md-12">
              <div class="form-group">
                <label>Internet</label>
                <?php				
			    $internet_status = $this->config->item('internet_status');									
				echo form_dropdown('internet', $internet_status,set_value('internet'),'class="form-control" ');
				?>
              </div>
            </div>
            <div class="col-lg-6 col-md-12" id="aboutprop_laststep">
              <!--<div class="form-group">
                <label>Total number of flatmates<br>
                  <span class="help">Once all rooms are rented</span></label>
                <?php				
			   // $total_flatmates = $this->config->item('total_flatmates');									
				//echo form_dropdown('total_flatmates', $total_flatmates,set_value('total_flatmates'),'class="form-control" ');
				?>
              </div>-->
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <!-- SECTION 3 -->
    <h2></h2>
    <section id="about_room_section">
      <div class="inner">
        <div class="image-holder" style="background-image:url(<?php echo base_url();?>images/form-wizard-3.jpg)"> <!--<img src="" alt="" style="width:100%;">--> </div>
        <div class="form-content">
          <div class="form-header">
            <h3>About the room(s)</h3>
          </div>
          <div class="row" id="mainrow">
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label>Room Name</label>
                <?php $data = array('class' =>'form-control', 'name'=> 'room_name[]', 'id'=> 'room_name1',"required"=>"true","value"=>'Room1');
                    	echo form_input($data); ?>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label>Room Type<br>
                  <span class="help">Including the one you're offering</span></label>
                <?php				
			    $roomtypes_status = $this->config->item('roomtypes_status');									
				echo form_dropdown('room_type[]', $roomtypes_status,set_value('room_type'),'class="form-control" id="room_type1"');
				?>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label>Room Furnishings</label>
                <?php				
			    $roomfurnishings_status = $this->config->item('roomfurnishings_status');									
				echo form_dropdown('room_furnishings[]', $roomfurnishings_status,set_value('room_furnishings'),'class="form-control" id="room_furnishings1" ');
				?>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="form-group">
                <label>Bathoom</label>
                <?php				
			    $bathrooms_status = $this->config->item('bathrooms_status');									
				echo form_dropdown('bathroom[]', $bathrooms_status,set_value('bathroom'),'class="form-control" id="bathroom1" ');
				?>
              </div>
            </div>
          </div>
          
          <div class="row" id="other_rooms">
            <div class="col-lg-12 col-md-12"> <a href="javascript:void(0);" class="btn btn-default1" id="addmorerooms">Add another room</a> </div>
          </div>
        </div>
      </div>
    </section>
    
    <!-- SECTION 4 -->
    <h2></h2>
    <section id="about_roomfeatures_section">
      <div class="inner">
        <div class="image-holder" style="background-image:url(<?php echo base_url();?>images/form-wizard-4.jpg)"> <!--<img src="" alt="" style="width:100%;">--> </div>
        <div class="form-content">
             <div class="row" id="extra_room_features_div"></div>
             
         
          
        </div>
      </div>
    </section>
    
    <!-- SECTION 5 -->
    <h2></h2>
    <section id="about_rentbondbills_section">
      <div class="inner">
        <div class="image-holder" style="background-image:url(<?php echo base_url();?>images/form-wizard-5.jpg)"><!-- <img src="" alt="" style="width:100%;">--> </div>
        <div class="form-content">
            <div class="row" id="extra_rentbondbills_div"></div>
            
         
          
        </div>
      </div>
    </section>
    <!-- SECTION 6 -->
    <h2></h2>
    <section id="about_roomavailability_section">
      <div class="inner">
        <div class="image-holder" style="background-image:url(<?php echo base_url();?>images/form-wizard-2.jpg)"> <!--<img src="" alt="" style="width:100%;">--> </div>
        <div class="form-content">
            <div class="row" id="extra_room_availability_div"></div>
            
        
        </div>
      </div>
    </section>
    
    <!-- SECTION 7 -->
    <h2></h2>
    <section>
      <div class="inner">
        <div class="image-holder" style="background-image:url(<?php echo base_url();?>images/form-wizard-4.jpg)"> <!--<img src="" alt="" style="width:100%;">--> </div>
        <div class="form-content">
          <div class="form-header">
            <h3>Property and room images</h3>
          </div>
          <div class="row">
            <div class="col-md-12">
              
                  <div class="row">
                 <div class="col-lg-12 col-md-12">
                   
                       <style id="compiled-css" type="text/css">  </style>
                        <div id="uploader" class="btn btn-cyan btn-lg float-left waves-effect waves-light" style="width:100%;">
                            
                          <!--<input type="file" name="files" id="propertyfiles1" class="filestyle" data-icon="true" multiple />-->
                         </div>
                       
                        
                   <!--<a href="javascript:void(0);" class="btn btn-default1" id="newphoto">Add Photo</a>-->
                </div></div>
                 
              
            </div>
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
                <div class="">
                  <div class="thumbnails_box col-12 cust-img-wrap"> </div>
                </div>
                 
              </div>
            </div>
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
                <p>Listings with images appear higher in search results than those without. You can also add or change images later.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
      <!-- SECTION 8 -->
    <h2></h2>
    <section id="about_flatmatepreference_section">
    <p>Your Ideal Flatemate(s)</p>
      <div class="inner">
        <div class="image-holder" style="background-image:url(<?php echo base_url();?>images/form-wizard-5.jpg)"> <!--<img src="" alt="" style="width:100%;">--> </div>
        <div class="form-content">
            <div id="extra_flatmatepreference_div"></div>
        
          
        </div>
      </div>
    </section>
     
      <!-- SECTION 9 -->
    <h2></h2>
    <section>
      <div class="inner">
       <div class="image-holder" style="background-image:url(<?php echo base_url();?>images/form-wizard-3.jpg)"> <!--<img src="" alt="" style="width:100%;">--> </div>
        <div class="form-content">
            
         <div class="form-header">
            <h3>Preferred Language</h3>
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
               <?php				
			    $preferred_language_list = $this->config->item('preferred_language_list');									
				echo form_dropdown('preferred_language', $preferred_language_list,set_value('preferred_language'),'class="form-control" id="preferred_language" ');
				?>
              </div>
            </div>
            
          </div>   
               
            
          <div class="form-header">
            <h3>Tell us about you and your flatmates</h3>
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
                <?php $data = array('class' =>'form-control', 'name'=> 'about_flatmates', 'id'=> 'about_flatmates',"required"=>"true","value"=>set_value("about_flatmates"));
                 echo form_textarea($data); ?>
                 
                 
                 <small>Tell your potential flatmate a little about yourself and the other flatmates living in the home. Describe what you do for work, where you're all from and what you do for fun.</small>                        
              </div>
            </div>
            
          </div>
          
          
          <div class="form-header">
            <h3>What's great about living at this property?</h3>
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="form-group">
                <?php $data = array('class' =>'form-control', 'name'=> 'great_live_with_text', 'id'=> 'great_live_with_text',"required"=>"true","value"=>set_value("great_live_with_text"));
                 echo form_textarea($data); ?>
                 
                 
                 <small>Include features like Netflix, a pool, air conditioning, great views or anything that will attract room seekers.</small>                        
              </div>
            </div>
            
          </div>
          
        </div>
      </div>
    </section>
  </form>
</div>
</div>
<style>
.imageThumb {
  max-height: 112px;
  border: 2px solid;
  padding: 1px;
  cursor: pointer;
}
.pip {
  display: inline-block;
  margin: 10px 10px 0 0;
}
.remove {
  display: block;
  background: #444;
  border: 1px solid black;
  color: white;
  text-align: center;
  cursor: pointer;
}
.remove:hover {
  background: white;
  color: black;
}
</style>

 <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
<?php
$below_app_js = array('js/jquery.steps.js','js/list_myplace_property.js','jsupload/js/plupload.full.min.js','jsupload/js/jquery.plupload.queue/jquery.plupload.queue.min.js','js/steps.js');
$this->load->view('includes/footer', array(
	'below_app_js' => $below_app_js)); ?>
