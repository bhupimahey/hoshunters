<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Order extends CI_Controller
{    
    public function __construct()
    {
        parent::__construct();  
       $this->config->load('paypal');	
       $config = array(
			'Sandbox' => $this->config->item('Sandbox'),            // Sandbox / testing mode option.
			'APIUsername' => $this->config->item('APIUsername'),    // PayPal API username of the API caller
			'APIPassword' => $this->config->item('APIPassword'),    // PayPal API password of the API caller
			'APISignature' => $this->config->item('APISignature'),    // PayPal API signature of the API caller
			'APISubject' => '',                                    // PayPal API subject (email address of 3rd party user that has granted API permission for your app)
			'APIVersion' => $this->config->item('APIVersion'),        // API version you'd like to use for your call.  You can set a default version in the class and leave this blank if you want.
			'DeviceID' => $this->config->item('DeviceID'),
			'ApplicationID' => $this->config->item('ApplicationID'),
			'DeveloperEmailAccount' => $this->config->item('DeveloperEmailAccount')
		);
		// Show Errors
		if ($config['Sandbox']) {
			error_reporting(E_ALL);
			ini_set('display_errors', '1');
		}
		// Load PayPal library
		$this->load->library('paypal/paypal_pro', $config);	   
    }
 
  function index()
	{
	  $refer_path =   customer_path().'upgrade_account';
	  if($_SERVER['HTTP_REFERER'] ==$refer_path){
	  				
		// Clear PayPalResult from session userdata
		$this->session->unset_userdata('PayPalResult');
		
	    $package_id = $this->session->userdata('order_package_id');
	    $package_info = $this->common_model->package_info($package_id);
	   
	    $grand_total = $package_info->package_price;

		

		/**
		 * Here we are setting up the parameters for a basic Express Checkout flow.
		 *
		 * The template provided at /vendor/angelleye/paypal-php-library/templates/SetExpressCheckout.php
		 * contains a lot more parameters that we aren't using here, so I've removed them to keep this clean.
		 *
		 * $domain used here is set in the config file.
		 */
		$SECFields = array(
			'maxamt' => round($grand_total,2), 					// The expected maximum total amount the order will be, including S&H and sales tax.
			'returnurl' => site_url('payment/success'), 							    // Required.  URL to which the customer will be returned after returning from PayPal.  2048 char max.
			'cancelurl' => site_url('payment/error'), 							    // Required.  URL to which the customer will be returned if they cancel payment on PayPal's site.
			'hdrimg' => 'https://www.angelleye.com/images/angelleye-paypal-header-750x90.jpg', 			// URL for the image displayed as the header during checkout.  Max size of 750x90.  Should be stored on an https:// server or you'll get a warning message in the browser.
			'logoimg' => 'https://www.angelleye.com/images/angelleye-logo-190x60.jpg', 					// A URL to your logo image.  Formats:  .gif, .jpg, .png.  190x60.  PayPal places your logo image at the top of the cart review area.  This logo needs to be stored on a https:// server.
			'brandname' => 'Athithi Flatmates', 							                                // A label that overrides the business name in the PayPal account on the PayPal hosted checkout pages.  127 char max.
			'customerservicenumber' => '816-555-5555', 				                                // Merchant Customer Service number displayed on the PayPal Review page. 16 char max.
		);

		/**
		 * Now we begin setting up our payment(s).
		 *
		 * Express Checkout includes the ability to setup parallel payments,
		 * so we have to populate our $Payments array here accordingly.
		 *
		 * For this sample (and in most use cases) we only need a single payment,
		 * but we still have to populate $Payments with a single $Payment array.
		 *
		 * Once again, the template file includes a lot more available parameters,
		 * but for this basic sample we've removed everything that we're not using,
		 * so all we have is an amount.
		 */
		$Payments = array();
		$Payment = array(
			'amt' => $grand_total, 	// Required.  The total cost of the transaction to the customer.  If shipping cost and tax charges are known, include them in this value.  If not, this value should be the current sub-total of the order.
		);

		/**
		 * Here we push our single $Payment into our $Payments array.
		 */
		array_push($Payments, $Payment);

		/**
		 * Now we gather all of the arrays above into a single array.
		 */
		$PayPalRequestData = array(
			'SECFields' => $SECFields,
			'Payments' => $Payments,
		);

		/**
		 * Here we are making the call to the SetExpressCheckout function in the library,
		 * and we're passing in our $PayPalRequestData that we just set above.
		 */
		$PayPalResult = $this->paypal_pro->SetExpressCheckout($PayPalRequestData);


		/**
		 * Now we'll check for any errors returned by PayPal, and if we get an error,
		 * we'll save the error details to a session and redirect the user to an
		 * error page to display it accordingly.
		 *
		 * If all goes well, we save our token in a session variable so that it's
		 * readily available for us later, and then redirect the user to PayPal
		 * using the REDIRECTURL returned by the SetExpressCheckout() function.
		 */
		 
		


		if(!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK']))
		{
			$errors = array('Errors'=>$PayPalResult['ERRORS']);
			
			echo json_encode(array("errors"=>PayPalResult['ERRORS']));
			// Load errors to variable
			//$this->load->vars('errors', $errors);

			//$this->load->view('paypal_error');
		}
		else
		{
			// Successful call.

			// Set PayPalResult into session userdata (so we can grab data from it later on a 'payment complete' page)
			$this->session->set_userdata('PayPalResult', $PayPalResult);

			// In most cases you would automatically redirect to the returned 'RedirectURL' by using: redirect($PayPalResult['REDIRECTURL'],'Location');
			// Move to PayPal checkout
			
			redirect($PayPalResult['REDIRECTURL']);
		//	echo json_encode(array("location_path"=>$PayPalResult['REDIRECTURL'],"errors"=>"NULL"));
		  }
		}
		else
		redirect(customer_path().'dashboard');
		
	}
  
   
  function paypal_error(){
    if($_GET['token']!=''){
          $this->message_output->set_error('Payment failure (Token:'.$_GET['token'].').', TRUE); 
	      redirect(customer_path().'dashboard');	
      }
     else
	 redirect(customer_path().'dashboard');	 
  }
  
   function paypal_success(){
	 
	 if($_GET['token']!='' && $_GET['PayerID']!=''){
	     $token_id = $_GET['token'];
	     $payer_id = $_GET['PayerID'];
	     $this->common_model->upgrade_customer_package($this->session->userdata('s_user_id'),$token_id,$payer_id);
	     $this->message_output->set_success('Package has been upgraded.', TRUE); 
	     redirect(customer_path().'dashboard');
	 }else
	 redirect(customer_path().'dashboard');	
	
  }  
   
} 