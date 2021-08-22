<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


/************
 * 
 * 
 * Authentication
 * 
 * *********/
$route['login'] = 'auth/login';
$route['register'] = 'auth/register';
$route['save_registration'] = 'auth/register/register_user';
$route['save_login'] = 'auth/login/login';
$route['validate_registration'] = 'auth/register/validate_register_form';
$route['change_captcha'] = 'auth/login/refresh_captcha';

$route['logout'] = 'auth/login/logout';



$route['adminhome'] = 'admin/home';


$route['profile'] = 'admin/profile';
$route['login_history'] = 'admin/profile/login_history';
$route['list_logs'] = 'admin/profile/list_logs';
$route['list_logs_json'] = 'admin/profile/list_logs_json';

$route['profile_image_store']['post'] = 'admin/profile/update_profile_image';

$route['update_profile'] = 'admin/profile/update_profile';
$route['change_password'] = 'admin/profile/change_password';

$route['permissions'] = 'admin/permissions';
$route['permission_json'] = 'admin/permissions/permission_json';
$route['list_permissions/(:any)'] = 'admin/permissions/list_permissions/$1';
$route['change_module_permission'] = 'admin/permissions/change_module_permission';
$route['website'] = 'admin/website';


$route['feedbacks'] = 'admin/feedbacks';
$route['add_backlog'] = 'admin/feedbacks/add_backlog';
$route['list_backlogs'] = 'admin/feedbacks/list_backlogs';
$route['change_feedback_status'] = 'admin/feedbacks/change_feedback_status';

$route['export'] = 'admin/export';

$route['upload_files'] = 'admin/uploadfiles';
$route['add_file_upload'] = 'admin/uploadfiles/add_file_upload';
$route['save_zip_file'] = 'admin/uploadfiles/save_zip_file';
$route['file_details'] = 'admin/uploadfiles/file_details';
$route['view_uploaded_images'] = 'admin/uploadfiles/view_uploaded_images';

//$route['user'] = 'home/home/user_home/2';


require_once 'routes_user.php';
