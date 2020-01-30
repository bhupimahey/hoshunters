<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Ajax extends CI_Controller
{    
    public function __construct()
    {
        parent::__construct();	
        	    $this->load->helper(array('cookie'));
    }

	public function addShortList() {
		if($_POST){
			$this->load->model('shortlist_model');			
			$this->shortlist_model->addShortlist();
		}
		return true;
	}


function upload_cache_image()
 {   

      $output='';
      $cache_images=array();
      
     @set_time_limit(5 * 60);
     $targetDir = CACHEIMGPATH;
     $cleanupTargetDir = false; 
     $maxFileAge = 5 * 3600; 
     
   
    if (isset($_REQUEST["name"])) {
    	$fileName = $_REQUEST["name"];
    } elseif (!empty($_FILES)) {
    	$fileName = $_FILES["file"]["name"];
    } else {
    	$fileName = uniqid("file_");
    }
    
   $filename = @basename($_FILES['file']['name']);
   $file_ext = $ext = pathinfo($filename, PATHINFO_EXTENSION);
   $dest_filename = md5(uniqid(rand(), true)) . '.' . $file_ext;

    
    $filePath = $targetDir . DIRECTORY_SEPARATOR . $dest_filename;
    
    // Chunking might be enabled
    $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
    $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;

// Remove old temp files	
if ($cleanupTargetDir) {
	if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
		die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
	}

	while (($file = readdir($dir)) !== false) {
		$tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

		// If temp file is current file proceed to the next
		if ($tmpfilePath == "{$filePath}.part") {
			continue;
		}

		// Remove temp file if it is older than the max age and is not the current file
		if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
			@unlink($tmpfilePath);
		}
	}
	closedir($dir);
}	


// Open temp file
if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
	die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
}

if (!empty($_FILES)) {
	if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
		die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
	}

	// Read binary input stream and append it to temp file
	if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
		die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
	}
} else {	
	if (!$in = @fopen("php://input", "rb")) {
		die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
	}
}

while ($buff = fread($in, 4096)) {
	fwrite($out, $buff);
}

@fclose($out);
@fclose($in);

// Check if file has been uploaded
if (!$chunks || $chunk == $chunks - 1) {
	// Strip the temp .part suffix off 
	rename("{$filePath}.part", $filePath);


 if(!$this->session->userdata('s_temp_images')){
     $cache_images[$dest_filename]= $dest_filename;
     $this->session->set_userdata('s_temp_images',$cache_images);  
 }
else{
    $other_images=array();
    $other_images[$dest_filename]= $dest_filename;
    $session_images=$this->session->userdata('s_temp_images');
    foreach($session_images as $sessimg_key => $sessionimgval){
      $other_images[$sessionimgval]= $sessionimgval;
    }
  $this->session->set_userdata('s_temp_images',$other_images);    
}

}
// Return Success JSON-RPC response
die('{"jsonrpc" : "done", "result" :done, "id" : "id"}');

     

  //sleep(1);
  //$this->session->unset_userdata('s_temp_images');
  //die();
  /*
  $output = '';
  $cache_images=array();
  
  if(isset($_FILES["files"]["name"]))
  {  
  
   $config["upload_path"]   = CACHEIMGPATH;
   $config["allowed_types"] = 'gif|jpg|png';
   $config['max_size']      = '2048000';
   $config['min_width']     = '400';
   $config['min_height']    = '400';
   $config['remove_spaces'] = TRUE;
   $config['encrypt_name']  = TRUE;
   
   $this->load->library('upload', $config);
   $this->upload->initialize($config);
   for($count = 0; $count<count($_FILES["files"]["name"]); $count++)
   {
    $_FILES["file"]["name"] = $_FILES["files"]["name"][$count];
    $_FILES["file"]["type"] = $_FILES["files"]["type"][$count];
    $_FILES["file"]["tmp_name"] = $_FILES["files"]["tmp_name"][$count];
    $_FILES["file"]["error"] = $_FILES["files"]["error"][$count];
    $_FILES["file"]["size"] = $_FILES["files"]["size"][$count];
	/*if($this->session->userdata('s_temp_images')){
      $s_temp_images = $this->session->userdata('s_temp_images');
       foreach($s_temp_images as $imglkey => $imgv){
         $output .= '
     <div class="col-md-4" data-id="'.$imglkey.'">
      <img src="'.base_url().CACHEIMGPATH.$imgv.'" class="img-responsive img-thumbnail" />
	  <a href="javascript:void(0);" class="removeimg" data-id="'.$imglkey.'">Remove-1</a>
     </div>
     ';  
           
       }
       
       
   }
  ************
	
    if($this->upload->do_upload('file'))
    {
     $data = $this->upload->data();
	 
	 $cache_images[$data['raw_name']]=$data["file_name"];
	 $output .= '
     <div class="col-md-4" data-id="'.$data['raw_name'].'">
      <img src="'.base_url().CACHEIMGPATH.$data["file_name"].'" class="img-responsive img-thumbnail" />
	  <a href="javascript:void(0);" class="removeimg" data-id="'.$data['raw_name'].'">Remove</a>
     </div>
     ';
    }
    
   
  
     $this->session->set_userdata('s_temp_images',$cache_images);   
       
  
		  
   }
  
   
   
     
  }
  
 
 
 */
 
 }


 function remove_cache_image(){  
	if($_POST){
	  sleep(1);
	  $imgid = $_POST['imgid']; 
	  if($this->session->userdata('s_temp_images')){
		 $cache_images = $this->session->userdata('s_temp_images');
		 $cache_aft_rm=array();
		 $output='';
 		foreach($cache_images as $key => $value){	
		     if($imgid ==$key){					
					 $temp_img_path=CACHEIMGPATH.$cache_images[$imgid];
					 unlink($temp_img_path);
					 unset($cache_images[$imgid]); 
			   		 
			  }
			 else{
				$cache_aft_rm[$key]= $value;
				$this->session->set_userdata('s_temp_images',$cache_aft_rm);
				$output .= '
     <div class="col-md-4" data-id="'.$key.'">
      <img src="'.base_url().CACHEIMGPATH.$value.'" class="img-responsive img-thumbnail" />
	  <a href="javascript:void(0);" class="removeimg" data-id="'.$key.'">Remove</a>
     </div>'; 
			 }		 
			  
  		 } 		     		 
     }
	   echo $output;
	  }
	 else
	  echo'';
 }
	public function subscribeNewsletter() {
		if($_POST){
			$this->common_model->addSubscriptionEmail();
		}
		return true;
	}

    public	function send_verify_change_code()
		{			
		 if($_POST && ($this->session->userdata('s_user_id'))){    
		    $user_id = $this->session->userdata('s_user_id');
		    $response = $this->common_model->send_verify_change_code($user_id);		
		    echo json_encode(array('html'=>$response));
	    	}
	      else{
	        echo json_encode(array('html'=>'error'));
	      }	
		}
		
	
    public	function send_mobile_code()
		{			
		 if($_POST && ($this->session->userdata('u_l_list_id'))){    
		    $this->load->model('listings_model');	   
		    $user_id  = $this->session->userdata('s_user_id');    
		    $response = $this->listings_model->send_mobile_code($user_id);		
		    echo json_encode(array('html'=>$response));
	    	}
	      else{
	        echo json_encode(array('html'=>'error'));
	      }	
		}
		
    public	function confirm_listing()
		{			
		 if($_POST){    
		   $this->load->model('listings_model');	   
		   $user_id  = $this->session->userdata('s_user_id');    
		    $response = $this->listings_model->confirm_listing($user_id);		
		   echo json_encode(array('html'=>$response));
	    	}
		}
		
    public	function verify_change_mobile()
		{			
		 if($_POST){    
		    $user_id  = $this->session->userdata('s_user_id');    
		    $response = $this->common_model->confirm_mobile_code($user_id);		
		   echo json_encode(array('html'=>$response));
	    	}
		}		
		
		
	public function get_listing_steps() {
		if($_POST){
			$this->load->model('listings_model');			
		    $data =	$this->listings_model->get_listing_steps();
		 	echo json_encode($data);
		}
	
	}
	 
} 