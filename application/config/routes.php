<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'auth';
$route['404_override'] = 'settings/error_page';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'auth';
$route['admin'] = 'auth';

$route['admin/dashboard'] = 'dashboard/index';
$route['admin/officials'] = 'officials/index';
$route['admin/position'] = 'position/index';
$route['admin/resident'] = 'resident/index';
$route['admin/user'] = 'auth/users';
$route['admin/roles'] = 'roles/index';

$route['backup'] = 'settings/backup';
$route['restore'] = 'settings/restore';
$route['admin/attempts'] = 'settings/login_attempts';
$route['admin/history'] = 'settings/history';
$route['404_override'] = 'settings/error_forbidden';