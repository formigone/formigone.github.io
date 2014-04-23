<?php  if ( ! defined("BASEPATH")) exit("No direct script access allowed");
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route["default_controller"] = "welcome";
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route["404_override"] = "errors/page_missing";
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route["default_controller"] = "formigone";
$route["404_override"] = "formigone/page_not_found";

$route["omikuji-fortune-cookie"] = "formigone/omikuji_fortune_cookie";
$route["omikuji-android"] = "formigone/omikuji_fortune_cookie";
$route["fortune-cookie"] = "formigone/omikuji_fortune_cookie";

$route["speedreadingtrainer"]   = "formigone/speed_reading_trainer_chrome_app_store";
$route["speed-reading-trainer"] = "formigone/speed_reading_trainer_chrome_app_store";
$route["speed_reading_trainer"] = "formigone/speed_reading_trainer_chrome_app_store";
$route["speedreadingtrainner"]  = "formigone/speed_reading_trainer_chrome_app_store";
$route["speedreadertrainner"]   = "formigone/speed_reading_trainer_chrome_app_store";
$route["speedreadertrainer"]    = "formigone/speed_reading_trainer_chrome_app_store";

$route["the-digital-agency"] = "formigone/about";
$route["web-services"] = "formigone/services";
$route["web-apps"] = "formigone/products";
$route["contact"] = "formigone/contact";
$route["email"] = "formigone/email";

/* End of file routes.php */
/* Location: ./application/config/routes.php */