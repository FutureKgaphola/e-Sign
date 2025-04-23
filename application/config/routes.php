<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['employeeform'] = 'AddEmployees';
$route['dashboard'] = 'Dashboard';

$route['auth'] = 'Auth/login';
$route['logout'] = 'Logout/logout';
$route['sign']='SignRegister/sign';
$route['user'] = 'User/get_user';
$route['update'] = 'User/update_user';
$route['delete'] = 'User/delete_user';
$route['openmodal'] = 'User/open_delete_user';
$route['adduser'] = 'User/add_user';
$route['adduser'] = 'User/update_attendence';




