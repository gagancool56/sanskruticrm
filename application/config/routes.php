<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'CRMController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// SDK START.
$route['dashboard'] = 'CRMController';
$route['report'] = 'CRMController/report';
$route['logout'] = 'CRMController/logout';
$route['crmreport/(:num)/(:any)'] = 'CRMController/crmreport/$1/$2';
$route['crmform/(:num)/(:num)'] = 'CRMController/crmform/$1/$2';
// SDK END.

// Print START
$route['print/(:any)/(:any)'] = 'PrintController/showprint/$1/$2';
// Print END.