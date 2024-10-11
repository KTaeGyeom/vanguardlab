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
$route['default_controller'] = 'home_controller/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* Common */
$route['home'] = 'home_controller/index';
$route['login'] = 'users_controller/login';
$route['login/validate_credentials'] = 'users_controller/validate_credentials';
$route['logout'] = 'users_controller/logout';
$route['users/theme']  = 'users_controller/changeTheme';

/* Party (Client + Partner) */
$route['party'] = 'party_controller/index';
$route['party/create'] = 'party_controller/create';
$route['party/delete'] = 'party_controller/delete';
$route['party/update'] = 'party_controller/update';
$route['party/list_json'] = 'party_controller/get_json_data';

/* Client */
$route['client'] = 'client_controller/index';
$route['client/create'] = 'client_controller/create';
$route['client/delete'] = 'client_controller/delete';
$route['client/update'] = 'client_controller/update';
$route['client/list_json'] = 'client_controller/get_json_data';

/* Partner */
$route['partner'] = 'partner_controller/index';
$route['partner/create'] = 'partner_controller/create';
$route['partner/delete'] = 'partner_controller/delete';
$route['partner/update'] = 'partner_controller/update';
$route['partner/list_json'] = 'partner_controller/get_json_data';

/* Reference */
$route['reference'] = 'reference_controller/index';
$route['reference/create'] = 'reference_controller/create';
$route['reference/delete'] = 'reference_controller/delete';
$route['reference/update'] = 'reference_controller/update';
$route['reference/list_json'] = 'reference_controller/get_json_data';

/* Image */
$route['image'] = 'image_controller/index';
$route['image/list_json'] = 'image_controller/get_json_data';
$route['image/create'] = 'image_controller/create';
$route['image/delete'] = 'image_controller/delete';

/* Setting */
$route['setting'] = 'setting_controller/index';
$route['setting/create'] = 'setting_controller/create';
$route['setting/delete'] = 'setting_controller/delete';
$route['setting/update'] = 'setting_controller/update';
$route['setting/list_json'] = 'setting_controller/get_json_data';

/* Users */
$route['users'] = 'users_controller/index';
$route['users/create'] = 'users_controller/create';
$route['users/delete'] = 'users_controller/delete';
$route['users/update'] = 'users_controller/update';
$route['users/theme']  = 'users_controller/changeTheme';
$route['users/list_json'] = 'users_controller/get_json_data';

/* Test */
$route['test'] = 'test_controller/index';
$route['test/create'] = 'test_controller/create';
$route['test/delete'] = 'test_controller/delete';
$route['test/update'] = 'test_controller/update';
$route['test/list_json'] = 'test_controller/get_json_data';

/* Monitoring */
$route['monitoring'] = 'monitoring_controller/index';
$route['monitoring/monitoring_json'] = 'monitoring_controller/monitoring_json';
$route['monitoring/monitoring_detail_json'] = 'monitoring_controller/monitoring_detail_json';
$route['monitoring/monitoring_detail_json/(:any)'] = 'monitoring_controller/monitoring_detail_json/$1';
$route['monitoring/purge'] = 'monitoring_controller/purge';
$route['monitoring/purge/(:any)/(:any)'] = 'monitoring_controller/purge/$1/$2';

/* System */
$route['systemlog'] = 'systemlog_controller/index';
$route['systemlog/systemlog_json'] = 'systemlog_controller/systemlog_json';
$route['systemlog/systemlog_detail_json'] = 'systemlog_controller/systemlog_detail_json';
$route['systemlog/systemlog_detail_json/(:any)'] = 'systemlog_controller/systemlog_detail_json/$1';

/* Etcs */
$route['home/info'] = 'home_controller/info';
$route['home/test'] = 'home_controller/test';



/* End of file routes.php */
/* Location: ./application/config/routes.php */