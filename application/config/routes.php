<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'auth';
$route['404_override'] = 'dashboard/error_page';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'auth';
$route['admin'] = 'auth';

$route['admin/dashboard'] = 'dashboard/index';
$route['admin/blotter'] = 'blotter/index';
$route['admin/business'] = 'business/index';
$route['admin/certificates'] = 'certificates/index';
$route['admin/chairmanship'] = 'chairmanship/index';
$route['admin/officials'] = 'officials/index';
$route['admin/payments'] = 'payments/index';
$route['admin/position'] = 'position/index';
$route['admin/precinct'] = 'precinct/index';
$route['admin/purok'] = 'purok/index';
$route['admin/resident'] = 'resident/index';
$route['admin/user'] = 'auth/users';

$route['admin/covid-status'] = 'covid/index';

$route['brgy_info_save'] = 'settings/save_brgy_info';
$route['backup'] = 'settings/backup';
$route['restore'] = 'settings/restore';


$route['admin/support'] = 'settings/support';

$route['admin/create_resident'] = 'resident/create_resident';
$route['admin/edit_resident/(:num)'] = 'resident/edit_resident/$1';
$route['admin/resident_certification'] = 'resident/brgy_cert';
$route['admin/generate_profile/(:num)'] = 'resident/generate_profile/$1';
$route['admin/generate_brgy_cert/(:num)'] = 'resident/generate_brgy_cert/$1';
$route['admin/generate_indi_cert/(:num)'] = 'resident/generate_indi_cert/$1';
$route['admin/generate_resi_cert/(:num)'] = 'resident/generate_resi_cert/$1';
$route['admin/generate_brgy_cert/(:num)/(:num)'] = 'resident/generate_brgy_cert/$1/$2';
$route['admin/generate_indi_cert/(:num)/(:num)'] = 'resident/generate_indi_cert/$1/$2';
$route['admin/generate_resi_cert/(:num)/(:num)'] = 'resident/generate_resi_cert/$1/$2';
$route['admin/generate_id/(:num)'] = 'resident/generate_id/$1';

$route['admin/generate_business_permit/(:num)'] = 'business/generate_b_permit/$1';

$route['admin/summon/(:any)'] = 'blotter/summon/$1';
$route['admin/generate_settlement_report/(:any)'] = 'blotter/generate_settlement_report/$1';
$route['admin/generate_dismissed_report/(:any)'] = 'blotter/generate_dismissed_report/$1';
$route['admin/generate_endorsed_report/(:any)'] = 'blotter/generate_endorsed_report/$1';
$route['admin/generate_summon/(:any)/(:num)'] = 'blotter/generate_summon/$1/$2';

$route['admin/create_certificates'] = 'certificates/create_certificates';
$route['admin/edit_certificate/(:num)'] = 'certificates/edit_certificate/$1';
$route['admin/generate_cert/(:num)'] = 'certificates/generate_cert/$1';
$route['admin/view_cert/(:num)'] = 'certificates/view_cert/$1';

$route['admin/dashboard'] = 'dashboard/index';
$route['admin/resident_info/(:any)'] = 'dashboard/resident_info/$1';
$route['admin/population'] = 'dashboard/population';

$route['admin/purok_info'] = 'dashboard/purok_info';
$route['admin/precinct_info'] = 'dashboard/precinct_info';
$route['admin/houses'] = 'dashboard/houses';
$route['admin/house_info/(:any)'] = 'dashboard/house_info/$1';

$route['admin/create_blotter'] = 'blotter/create_blotter';
$route['admin/edit_blotter/(:any)'] = 'blotter/edit_blotter/$1';

$route['admin/covidstatus'] = 'dashboard/covidstatus';
$route['admin/covid-deaths'] = 'dashboard/covid_death';

$route['admin/calendar'] = 'calendar/index';

$route['admin/projects'] = 'project/index';
$route['admin/projects/details/(:num)'] = 'project/details/$1';

$route['admin/reports/(:any)/(:any)'] = 'reports/index/$1/$2';

$route['admin/occupation'] = 'reports/occupation';

$route['admin/search'] = 'resident/search_page';

$route['admin/services'] = 'services/index';

$route['kiosk'] = 'kiosk/index';
$route['kiosk/home'] = 'kiosk/index';
$route['kiosk/about-us'] = 'kiosk/about';
$route['kiosk/services'] = 'kiosk/services';
$route['kiosk/services_info/(:num)'] = 'kiosk/service_info/$1';

$route['admin/request'] = 'request/index';

$route['admin/attempts'] = 'settings/login_attempts';
$route['admin/history'] = 'settings/history';

$route['admin/resident_age'] = 'resident/search_age';

$route['admin/occupation'] = 'occupation/index';
$route['admin/occupation_info'] = 'occupation/occupation';
