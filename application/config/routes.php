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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'UserController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['register'] = 'UserController/register';
$route['login'] = 'UserController/login';
$route['profile'] = 'UserController/profile';
$route['user/update']= 'UserController/edit_user';
$route['user/update/password']= 'UserController/change_password';
$route['car_view/(:any)'] = 'UserController/car_view/$1';
$route['rental-history'] = 'UserController/rental_history';

$route['book'] = 'BookingController/book_rental';

$route['get_booked_dates'] = 'UserController/get_booked_dates';

$route['paymongo/webhook'] = 'PaymentController/webhook';


$route['auth/store'] = 'AuthController/store';
$route['auth/verify'] = 'AuthController/verify';
$route['auth/verify/(:any)'] = 'AuthController/verify/$1';
$route['auth/logout'] = 'AuthController/logout';

$route['admin'] = 'AdminController';
$route['admin/login'] = 'AdminController/login';

$route['admin/cars_list'] = 'AdminController/cars_list';
$route['admin/cars_add'] = 'AdminController/cars_add';
$route['admin/cars_store'] = 'AdminController/cars_store';
$route['admin/car_view/(:any)'] = 'AdminController/car_view/$1';
$route['admin/car_view/(:any)/edit'] = 'AdminController/car_update/$1';
$route['admin/car_view/(:any)/delete'] = 'AdminController/car_delete/$1';

$route['admin/users_list'] = 'AdminController/users_list';
$route['admin/user_view/(:any)'] = 'AdminController/user_view/$1';
$route['admin/users_add'] = 'AdminController/users_add';
$route['admin/store_user'] = 'AuthController/store';
$route['admin/set_active/(:any)'] = 'AdminController/set_active/$1';

$route['admin/sales_view'] = 'AdminController/sales_view';
$route['admin/get_transaction'] = 'AdminController/get_transaction';