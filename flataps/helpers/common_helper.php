<?php

function hasPageAccess($role_id){
    $CI = & get_instance();
	$CI->load->model('common_model');
    $hasAccess = $CI->common_model->hasAccess($role_id);
    if(!$hasAccess)
      redirect(base_url().'404_override');
}



function is_page($page_url){
    $CI = & get_instance();
	$CI->load->model('common_model');
    $is_page = $CI->common_model->is_page_exists($page_url);
    return $is_page;
}




function is_customer_logged_in(){
	$CI = & get_instance();
	$CI->load->library('session');
	if($CI->session->userdata('s_user_id'))
	 return TRUE;
	 else
	 return FALSE;	 
}

function customer_name(){
	$CI = & get_instance();
	$CI->load->library('session');
	if($CI->session->userdata('s_user_id'))
	 return $CI->session->userdata('s_user_name');
	 else
	 return FALSE;	 
}

function send_sms_international($mobile=NULL,$SMS_Body)
{  	
$mob_final="'".$mobile."'";
$rest = substr($mobile,0,2);



$ch = curl_init();
$gateway_url ='http://rest-api.d7networks.com/secure/sendbatch';
$ch = curl_init($gateway_url);
$headers = array(
    'Content-Type:application/json',
    'Authorization: Basic '. base64_encode("abhi6919:p8VKRJm4") // <---
);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$data = array(
'messages' => [
[
   //'to' => ['+12016157414','+15512082749','+14252838073','+18062838541'],
//'to' => ['+919464516140'],
'to' => [$mobile],
   'from' => 'sample',
   'content' => $SMS_Body,
   //'content' => 'Hi this'
]
]
  );
 
$payload = json_encode($data);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
if($result){
// do what ever what to doo 




}
return $result;
}



function distance($lat1, $lon1, $lat2, $lon2, $unit) {
  if (($lat1 == $lat2) && ($lon1 == $lon2)) {
    return 0;
  }
  else {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
      return ($miles * 1.609344);
    } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
      return $miles;
    }
  }
}



 function makeurl($url, $scheme = 'http://')
  {
    return parse_url($url, PHP_URL_SCHEME) === null ?
    $scheme . $url : $url;
   }

  function uorder_id(){
	
	$stamp = date("sYshd");
    $ip = $_SERVER['REMOTE_ADDR'];
    $orderid = "$stamp";
    $orderid = str_replace(".", "", "$orderid");
	return $orderid;
  }
  	
  function generate_captcha(){
	$CI = & get_instance();
	$CI->load->library('session');
    $captcha = $CI->captcha->main();
	$CI->session->set_userdata('captcha_info', $captcha);
	return $captcha;
	}
	
	

 function generateNumericOTP($n)
 {          
		$iDigits = "02154219865321587496451325796153147896132833257925548721986542157714197837534678513202480348420680"; 
	  
		$iOtp = ""; 
	  
		for ($i = 1; $i <= $n; $i++) { 
			$iOtp .= substr($iDigits, (rand()%(strlen($iDigits))), 1); 
		} 	 
		return $iOtp; 
   }  
   
   function split_name($name) {
    $parts = array();

    while ( strlen( trim($name)) > 0 ) {
        $name = trim($name);
        $string = preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $parts[] = $string;
        $name = trim( preg_replace('#'.$string.'#', '', $name ) );
    }

    if (empty($parts)) {
        return false;
    }

    $parts = array_reverse($parts);
    $name = array();
    $name['first_name'] = $parts[0];
    $name['middle_name'] = (isset($parts[2])) ? $parts[1] : '';
    $name['last_name'] = (isset($parts[2])) ? $parts[2] : ( isset($parts[1]) ? $parts[1] : '');

    return $name;
}
   



function uri_parse_str($str) {
  $arr = array();  
  $pairs = explode('&', $str);  
  foreach ($pairs as $i) {   
  
    @list($name,$value) = explode('=', $i, 2);      
    if( isset($arr[$name]) ) {     
      if( is_array($arr[$name]) ) {
        $arr[$name][] = $value;
      }
      else {
        $arr[$name] = array($arr[$name], $value);
      }
    }   
    else {
      $arr[$name] = $value;
    }
  } 
  return $arr;
}




function dateDiff($entry_time, $today)
	{
	$date1 = new DateTime($entry_time);
	$date2 = new DateTime($today);
	$interval = $date1->diff($date2);
	if ($interval->y > 0) $post_time = $interval->y." years ago";
	elseif ($interval->m > 0) $post_time = $interval->m." months ago";
	elseif ($interval->d > 0) $post_time = $interval->d." days ago";
	elseif ($interval->h > 0) $post_time = $interval->h." hours ago";
	elseif ($interval->i > 0) $post_time = $interval->i." minutes ago";
	elseif ($interval->s > 0) $post_time = $interval->s." seconds ago";
	else $post_time = "just now";
	return $post_time;
	}



function site_title_info()
	{
	$CI = & get_instance();
	$CI->load->model('common_model');
	$CI->load->library('session');
	$title_info = $CI->common_model->site_title_info();
	return $title_info;
	}

function ip_address()
	{
	if (!empty($_SERVER['HTTP_CLIENT_IP']))
		{
		$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
	  else
		{
		$ip = $_SERVER['REMOTE_ADDR'];
		}

	return $ip;
	}

	
if (!function_exists('salted_hash'))
	{
	function salted_hash($plainText, $salt = NULL)
		{
		if ($salt === NULL) $salt = md5(rand());
		$salt = substr($salt, 0, 8);
		return ($salt . sha1($salt . $plainText));
		}
	}

if (!function_exists('obfuscate_link'))
	{
	function obfuscate_link($file_id, $type = 'documents')
		{
		$temp = array(
			date("jmY") ,
			$file_id,
			$type
		); // using date("jmY") ensures download links are specific to each day
		$temp = serialize($temp);
		$temp = base64_encode($temp);
		$link = rawurlencode($temp);
		return $link;
		}
	}

if (!function_exists('unobfuscate_link'))
	{
	function unobfuscate_link($link)
		{
		$temp = rawurldecode($link);
		$temp = base64_decode($temp);
		if (!@unserialize($temp))
			{

			// Call our custom 404 function

			redirect('404', 'refresh');
			exit();
			}
		  else
			{
			$download_array = unserialize($temp);
			return $download_array;
			}
		}
	}

if (!function_exists('uuid'))
	{
	function uuid()
		{
		$uuid = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 0xffff) , mt_rand(0, 0xffff) , mt_rand(0, 0xffff) , mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff) , mt_rand(0, 0xffff) , mt_rand(0, 0xffff));
		return $uuid;
		}
	}

if (!function_exists('escape_mysql_wildcards'))
	{
	function escape_mysql_wildcards($str)
		{
		$xfer = array(
			'%' => '\%',
			'_' => '\_',
			'*' => '%',
			'?' => '_',
		);
		return strtr($str, $xfer);
		}
	}

if (!function_exists('var_default'))
	{
	function var_default(&$arg, $default = NULL)
		{
		return (isset($arg) ? $arg : $default);
		}
	}

if (!function_exists('set_default'))
	{
	function set_default(&$arg, $default = NULL)
		{
		return (isset($arg) && $arg != '' ? $arg : $default);
		}
	}

if (!function_exists('mkdir_r'))
	{
	function mkdir_r($path, $mode = 0777)
		{
		if (!is_dir(dirname($path))) mkdir_r(dirname($path) , $mode);
		if (!is_dir($path)) return @mkdir($path, $mode);
		return true;
		}
	}

if (!function_exists('file_extension'))
	{
	function file_extension($filename)
		{
		return strtolower(end(explode('.', $filename)));
		}
	}

if (!function_exists('str_chop'))
	{
	function str_chop($str, $len)
		{
		if (strlen($str) <= $len) return $str;
		return substr($str, 0, $len - 3) . '...';
		}
	}

if (!function_exists('pagination'))
	{
	function pagination($fmtUrl, $numPages, $curPage)
		{
		$numLinks = 7;
		$offset = floor($numLinks / 2);
		$start = max(1, $curPage - $offset);
		$end = min($numPages, $curPage + $offset);
?>



		<ul class="pagination">



			<li>Page</li>



		<?php
		if ($curPage != 1)
			{
			echo ('<li><a href="' . sprintf($fmtUrl, 1) . '">First</a></li>');
			}
		  else
			{
			echo ('<li class="sel">First</li>');
			}

		for ($i = $start; $i <= $end; $i++)
			{
			if ($i != $curPage)
				{
				echo ('<li><a href="' . sprintf($fmtUrl, $i) . '">' . $i . '</a></li>');
				}
			  else
				{
				echo ('<li class="sel">' . $i . '</li>');
				}
			}

		if ($curPage != $numPages)
			{
			echo ('<li><a href="' . sprintf($fmtUrl, $numPages) . '">Last</a></li>');
			}
		  else
			{
			echo ('<li class="sel">Last</li>');
			}

?>



		</ul>



	<?php
		}
	}

if (!function_exists('success_error'))
	{
	function success_error(&$success, &$error)
		{
		if (isset($success) && $success)
			{
			echo '<div class="success">', $success, '</div>';
			}

		if (isset($error) && $error)
			{
			echo '<div class="error">', $error, '</div>';
			}
		}
	}

function isAdmin($id)
	{
	return $id == '999999' ? TRUE : FALSE;
	}

function is_user_loggedin($type)
	{
	$CI = & get_instance();
	$CI->load->library('session');
	if ($CI->session->userdata('suser_type') == $type) return TRUE;
	  else return FALSE;
	}


function random_password() 
{
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $password = array(); 
    $alpha_length = strlen($alphabet) - 1; 
    for ($i = 0; $i < 8; $i++) 
    {
        $n = rand(0, $alpha_length);
        $password[] = $alphabet[$n];
    }
    return implode($password); 
}

