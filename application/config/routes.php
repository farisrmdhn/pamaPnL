<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//PermitsAndLicenses
$route['permitsAndLicenses'] = 'permitsAndLicenses/index';

//Users
$route['dashboard/(:any)'] = 'users/dashboard/$1';
$route['admin_dashboard'] = 'users/admin_dashboard';
$route['login'] = 'users/login';
$route['sitelist'] = 'users/sitelist';

$route['default_controller'] = 'users/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
