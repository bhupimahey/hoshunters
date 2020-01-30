<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = 'not_authorize/index';
$route['not_authorize'] = 'not_authorize/index';

$route['ecos_panel'] = admin_folder.'/dashboard';

$route[admin_folder.'logout']   			     = admin_folder . 'dashboard/logout';
$route[admin_folder.'change_password']    		 = admin_folder . 'dashboard/change_password';
$route[admin_folder.'change_password/(:any)']    = admin_folder . 'dashboard/change_password/$1';
$route[admin_folder.'listing/delete/(:num)']     = admin_folder . 'listings/delete_listing/$1';
$route[admin_folder.'information/(:num)']        = admin_folder . 'information/index/$1';
$route[admin_folder.'listing/filter/(:num)']     = admin_folder . 'listings/edit_homeprefereces_info/$1';
$route[admin_folder.'listings/locations/(:num)/(:num)']  = admin_folder . 'listings/edit_location_info/$1/$2';

$route[admin_folder.'listings/update_locations/(num)/(:any)']  = admin_folder . 'listings/update_locations/$1/$2';
$route[admin_folder.'information/(:num)']        = admin_folder . 'information/index/$1';

$route[admin_folder.'listings/(:num)']  = admin_folder . 'listings/index/$1';

$route[admin_folder.'listings/home_photos/(:num)']  = admin_folder . 'listings/home_photos/$1';
$route[admin_folder.'listings/home_photos/(:num)/(:any)'] = admin_folder . 'listings/home_photos/$1/$2';
$route[admin_folder.'profile_photo/delete/(:num)']     = admin_folder . 'users/delete_photo/$1';
$route[admin_folder.'listings/photo/delete/(:num)/(:num)']     = admin_folder . 'listings/delete_photo/$1/$2';

$route[customer_folder.'listing/preview/(:num)'] = customer_folder . 'listings/view_listing/$1';
$route[customer_folder.'logout'] = customer_folder . 'dashboard/logout';

$route[customer_folder.'upgrade_account'] = customer_folder . 'dashboard/upgrade_account';

$route[customer_folder.'email_setting']    		 = customer_folder . 'dashboard/update_email_settings';
$route[customer_folder.'email_setting/(:any)']    = customer_folder . 'dashboard/update_email_settings/$1';

$route[customer_folder.'profile_information']    		 = customer_folder . 'dashboard/update_profile';
$route[customer_folder.'profile_information/(:any)']    = customer_folder . 'dashboard/update_profile/$1';
$route[customer_folder.'delete_photo']    		 = customer_folder . 'dashboard/delete_photo';

$route[customer_folder.'profile/deactivate']    		 = customer_folder . 'dashboard/deactivate_profile';


$route[customer_folder.'change_password']    		 = customer_folder . 'dashboard/change_password';
$route[customer_folder.'change_password/(:any)']    = customer_folder . 'dashboard/change_password/$1';
$route[customer_folder.'send_message/(:any)']    = customer_folder . 'dashboard/send_message/$1';
$route[customer_folder.'report_listing/(:any)']    = customer_folder . 'dashboard/report_property/$1';

$route[customer_folder.'messages/reply/(:num)/(:num)/(:any)']    = customer_folder . 'messages/reply_message/$1/$2/$3';
$route[customer_folder.'messages/read/(:num)']    = customer_folder . 'messages/read_message/$1';
$route[customer_folder.'messages/detail/(:num)/(:num)']    = customer_folder . 'messages/index/$1/$2';

$route[customer_folder.'listings/locations/(:num)/(:num)']  = customer_folder . 'listings/edit_location_info/$1/$2';
$route[customer_folder.'listings/update_locations/(num)/(:any)']  = customer_folder . 'listings/update_locations/$1/$2';


$route[customer_folder.'listings/(:num)']  = customer_folder . 'listings/index/$1';


$route[customer_folder.'listings/home_photos/(:num)']  = customer_folder . 'listings/home_photos/$1';
$route[customer_folder.'listings/home_photos/(:num)/(:any)'] = customer_folder . 'listings/home_photos/$1/$2';
$route[customer_folder.'listings/photo/delete/(:num)/(:num)']     = customer_folder . 'listings/delete_photo/$1/$2';

$route['verify_mobile']    = customer_folder . 'listings/verify_mobile';
$route['send_mobile_code']    = customer_folder . 'listings/send_mobile_code';
$route['ajax/listings/steps']    = 'ajax/get_listing_steps';

$route[customer_folder.'upgrade_package/payment']    = customer_folder . 'dashboard/make_payment';
$route[customer_folder.'order/payment']    = customer_folder . 'order/index';

$route['payment/success?(:any)'] = customer_folder . 'order/paypal_success';
$route['payment/error?(:any)'] = customer_folder . 'order/paypal_error';


$route['ajax/subscribe/newsletter']    = 'ajax/subscribeNewsletter';

$route['dashboard'] = customer_folder . 'dashboard';

$route['messages'] = customer_folder . 'messages';
$route['forgot_password']    		 = 'home/forgot_password';
$route['forgot_password/(:any)']    =  'home/forgot_password/$1';
$route['pages/about_us'] = 'home/about_us';
$route['pages/contact'] = 'home/contact_us';
$route['register/submit'] = 'register/index/$1';
$route['login/submit'] = 'login/submit';
$route['list_my_place'] = 'home/list_my_place';
$route['find_place'] = 'home/find_place';
$route['list_my_place/(:any)'] = 'home/list_my_place/$1';
$route['find_place/(:any)'] = 'home/find_place/$1';


$route['listings/(:num)'] = 'home/index/$1';
$route['listings'] = 'home/index';

$route['search'] = 'home/search_property';
$route['search/(:any)'] = 'home/search_property/$1';

$route['shortlists'] = 'home/viewShortList';
$route['shortlists/(:num)'] = 'home/viewShortList/$1';
$route['listings/shortlist'] = 'ajax/addShortList';
$route['F([a-zA-Z0-9]{6})(:num)'] = 'preview/index/$1/$2';

$route['contact'] = 'home/contact_us';
$route['contact/(:any)'] = 'home/contact_us/$1';

$route['faq'] = 'home/faq';
$route['pages/(:any)'] = 'pages/index/$1';

$route['ajax/images/upload'] = 'ajax/upload_cache_image';
$route['ajax/images/remove'] = 'ajax/remove_cache_image';


$route[customer_folder .'profile/change/mobile']    = customer_folder . 'dashboard/change_profile_number';
$route[customer_folder .'profile/verify/mobile']    = customer_folder . 'dashboard/verify_profile_number';

$route[customer_folder .'profile/send/code']    = 'ajax/send_verify_change_code';
