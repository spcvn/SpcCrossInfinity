<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['login'] = 'account/login';
$route['logout'] = 'account/logout';
$route['reset-password'] = 'account/reset_password';
$route['new-password'] = 'account/new_password';

/* back-end */
$route['create-account'] = 'account/create_test_account';
$route['company/registration'] = 'company/create_account';
$route['company/confirm'] = 'company/show_confirm';
$route['company/success'] = 'company/regist_account';
$route['company/detail'] = 'company/show_detail';
$route['company/edit'] = 'company/update_company_info';
$route['company/support'] = 'company/update_support';
$route['company/support-empty'] = 'company/update_support_empty';
$route['company'] = 'company/show_detail';
$route['company/regist-purchase'] = 'company/show_regist_support_service';
/*
* Update router regist-purchase/param/
* By Unotrung - 21-03-2017
*/
$route['company/regist-purchase(/[a-zA-Z0-9]+)'] = 'company/show_regist_support_service';
$route['company/confirm-purchase'] = 'company/show_confirm_regist_support_service';
$route['company/success-purchase'] = 'company/show_complete_regist_support_service';
//$route['company/billing-history-by-day'] = 'company/billing_history_by_day';
$route['company/billing-history-by-day(/[0-9]+)?'] = 'company/billing_history_by_day';
$route['company/billing-history-by-month(/[0-9]+)?'] = 'company/billing_history_by_month';
$route['company/billing-history-month(/[0-9]+)?'] = 'company/billing_history_where_month';
$route['company/detail-billing-history-by-day(/[0-9]+)?'] = 'company/detail_billing_history_by_day';


$route['user/registration'] = 'user/registration';
$route['user/confirm'] = 'user/confirm';
$route['user/success'] = 'user/success';
$route['user/detail'] = 'user/detail';
$route['user/edit'] = 'user/edit';
$route['user'] = 'user/detail';
$route['user/point-detail'] = 'user/point_detail';
$route['user/point-detail(/[0-9]+)?'] = 'user/point_detail';
$route['user/service'] = 'user/enterprise_support_service_list';
$route['user/service(/[0-9]+)?'] = 'user/enterprise_support_service_list';
$route['user/service/detail(/[0-9]+)?'] = 'user/enterprise_support_service_detail';

$route['cross-infinity-information'] = 'home/get_cross_infinity';

$route['contruction'] = 'home/contruction_page';
$route['batch'] = 'daily_batch/run';
$route['test'] = 'company/test';

$route['/(:any)'] = 'home/index';

$route['not-allow'] = 'account/not_allow';
$route['404_override'] = 'home/index';
$route['translate_uri_dashes'] = FALSE;
$route['default_controller'] = 'home/index';


