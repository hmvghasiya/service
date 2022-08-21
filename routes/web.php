<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::prefix('/admin')->group(function() {

Route::get('/', 'UserController@index')->middleware('guest')->name('mylogin');

Route::group(['prefix' => 'auth'], function() {
    Route::post('check', 'UserController@login')->name('authCheck');
    Route::get('logout', 'UserController@logout')->name('logout');
    Route::post('register', 'UserController@registration')->name('register');
    Route::post('reset', 'UserController@passwordReset')->name('authReset');
   Route::post('getotp', 'UserController@getotp')->name('getotp');
    Route::post('setpin', 'UserController@setpin')->name('setpin');
});
 

Route::get('/dashboard', 'HomeController@index')->name('home');
Route::post('wallet/balance', 'HomeController@getbalance')->name('getbalance');
Route::get('setpermissions', 'HomeController@setpermissions');
Route::get('setscheme', 'HomeController@setscheme');
Route::get('getmyip', 'HomeController@getmysendip');
Route::get('balance', 'HomeController@getbalance')->name('getbalance');
Route::get('mydata', 'HomeController@mydata');

Route::get('comingsoon', 'HomeController@comingsoon')->name('comingsoon');

Route::group(['prefix'=> 'tools', 'middleware' => ['auth', 'company','checkrole:admin']], function() {
    Route::get('{type}', 'RoleController@index')->name('tools');
    Route::post('{type}/store', 'RoleController@store')->name('toolsstore');
    Route::post('setpermissions','RoleController@assignPermissions')->name('toolssetpermission');
    Route::post('get/permission/{id}', 'RoleController@getpermissions')->name('permissions');
    Route::post('getdefault/permission/{id}', 'RoleController@getdefaultpermissions')->name('defaultpermissions');
});

Route::group(['prefix' => 'statement', 'middleware' => ['auth', 'company']], function() {    
    Route::get("export/{type}", 'StatementController@export')->name('export');
    Route::get('{type}/{id?}', 'StatementController@index')->name('statement');
    Route::post('fetch/{type}/{id?}/{returntype?}', 'CommonController@fetchData');
    Route::post('update', 'CommonController@update')->name('statementUpdate');
    Route::post('status', 'CommonController@status')->name('statementStatus');
});

Route::group(['prefix'=> 'member', 'middleware' => ['auth', 'company']], function() {
	Route::get('{type}/{action?}', 'MemberController@index')->name('member');
    Route::post('store', 'MemberController@create')->name('memberstore');
    Route::post('commission/update', 'MemberController@commissionUpdate')->name('commissionUpdate');
    Route::post('getcommission', 'MemberController@getCommission')->name('getMemberCommission');
    Route::post('getScheme', 'MemberController@getScheme')->name('getScheme');
});

Route::group(['prefix'=> 'reporting-charges', 'middleware' => ['auth', 'company']], function() {
    Route::any('store', 'ReportingController@store')->name('reporting_charge.store');
    Route::any('/', 'ReportingController@create')->name('reporting_charge.index');

});

Route::group(['prefix'=> 'ration-card', 'middleware' => ['auth', 'company']], function() {
    Route::any('store', 'RationCardController@store')->name('ration_card.store');
    Route::any('/', 'RationCardController@index')->name('ration_card.index');
    Route::any('/user', 'RationCardController@user_index')->name('ration_card.user_index');
    Route::any('/single_status_change', 'RationCardController@single_status_change')->name('ration_card.single_status_change');
    Route::any('/reason', 'RationCardController@reason')->name('ration_card.reason');
    Route::any('/view/{id}', 'RationCardController@view')->name('ration_card.view');
    Route::any('any_data', 'RationCardController@any_data')->name('ration_card.any_data');
    Route::any('user_any_data', 'RationCardController@user_any_data')->name('ration_card.user_any_data');
    Route::any('user/create', 'RationCardController@create')->name('ration_card.create');
    Route::any('loan_data', 'RationCardController@loan_data')->name('ration_card.loan_data');
});

Route::group(['prefix'=> 'e-sharm', 'middleware' => ['auth', 'company']], function() {
    Route::any('store', 'ESharmController@store')->name('e_sharm.store');
    Route::any('/', 'ESharmController@index')->name('e_sharm.index');
    Route::any('/user', 'ESharmController@user_index')->name('e_sharm.user_index');
    Route::any('/single_status_change', 'ESharmController@single_status_change')->name('e_sharm.single_status_change');
    Route::any('/reason', 'ESharmController@reason')->name('e_sharm.reason');
    Route::any('/view/{id}', 'ESharmController@view')->name('e_sharm.view');
    Route::any('any_data', 'ESharmController@any_data')->name('e_sharm.any_data');
    Route::any('user_any_data', 'ESharmController@user_any_data')->name('e_sharm.user_any_data');
    Route::any('user/create', 'ESharmController@create')->name('e_sharm.create');
    Route::any('loan_data', 'ESharmController@loan_data')->name('e_sharm.loan_data');
});

Route::group(['prefix'=> 'prepaid-card-load', 'middleware' => ['auth', 'company']], function() {
    Route::any('store', 'PrepaidCardLoadController@store')->name('prepaidcard_load.store');
    Route::any('/', 'PrepaidCardLoadController@index')->name('prepaidcard_load.index');
    Route::any('/user', 'PrepaidCardLoadController@user_index')->name('prepaidcard_load.user_index');
    Route::any('/single_status_change', 'PrepaidCardLoadController@single_status_change')->name('prepaidcard_load.single_status_change');
    Route::any('/reason', 'PrepaidCardLoadController@reason')->name('prepaidcard_load.reason');
    Route::any('/view/{id}', 'PrepaidCardLoadController@view')->name('prepaidcard_load.view');
    Route::any('any_data', 'PrepaidCardLoadController@any_data')->name('prepaidcard_load.any_data');
    Route::any('user_any_data', 'PrepaidCardLoadController@user_any_data')->name('prepaidcard_load.user_any_data');
    Route::any('user/create', 'PrepaidCardLoadController@create')->name('prepaidcard_load.create');
    Route::any('loan_data', 'PrepaidCardLoadController@loan_data')->name('prepaidcard_load.loan_data');
});

Route::group(['prefix'=> 'loan', 'middleware' => ['auth', 'company']], function() {
    Route::any('store', 'LoanController@store')->name('loan.store');
    Route::any('/', 'LoanController@index')->name('loan.index');
    Route::any('/user', 'LoanController@user_index')->name('loan.user_index');
    Route::any('/single_status_change', 'LoanController@single_status_change')->name('loan.single_status_change');
    Route::any('/reason', 'LoanController@reason')->name('loan.reason');
    Route::any('/view/{id}', 'LoanController@view')->name('loan.view');
    Route::any('any_data', 'LoanController@any_data')->name('loan.any_data');
    Route::any('user_any_data', 'LoanController@user_any_data')->name('loan.user_any_data');
    Route::any('user/create', 'LoanController@create')->name('loan.create');
    Route::any('loan_data', 'LoanController@loan_data')->name('loan.loan_data');
});

Route::group(['prefix'=> 'digital-signature', 'middleware' => ['auth', 'company']], function() {
    Route::any('store', 'DigitalSignatureController@store')->name('digital_signature.store');
    Route::any('/', 'DigitalSignatureController@index')->name('digital_signature.index');
    Route::any('/user', 'DigitalSignatureController@user_index')->name('digital_signature.user_index');
    Route::any('/single_status_change', 'DigitalSignatureController@single_status_change')->name('digital_signature.single_status_change');
    Route::any('/reason', 'DigitalSignatureController@reason')->name('digital_signature.reason');
    Route::any('/view/{id}', 'DigitalSignatureController@view')->name('digital_signature.view');
    Route::any('any_data', 'DigitalSignatureController@any_data')->name('digital_signature.any_data');
    Route::any('user_any_data', 'DigitalSignatureController@user_any_data')->name('digital_signature.user_any_data');
    Route::any('user/create', 'DigitalSignatureController@create')->name('digital_signature.create');
    Route::any('loan_data', 'DigitalSignatureController@loan_data')->name('digital_signature.loan_data');
});

Route::group(['prefix'=> 'gst-registration', 'middleware' => ['auth', 'company']], function() {
    Route::any('store', 'GstRegController@store')->name('gst_reg.store');
    Route::any('/', 'GstRegController@index')->name('gst_reg.index');
    Route::any('/user', 'GstRegController@user_index')->name('gst_reg.user_index');
    Route::any('/single_status_change', 'GstRegController@single_status_change')->name('gst_reg.single_status_change');
    Route::any('/reason', 'GstRegController@reason')->name('gst_reg.reason');
    Route::any('/view/{id}', 'GstRegController@view')->name('gst_reg.view');
    Route::any('any_data', 'GstRegController@any_data')->name('gst_reg.any_data');
    Route::any('user_any_data', 'GstRegController@user_any_data')->name('gst_reg.user_any_data');
    Route::any('user/create', 'GstRegController@create')->name('gst_reg.create');
    Route::any('loan_data', 'GstRegController@loan_data')->name('gst_reg.loan_data');
});


Route::group(['prefix'=> 'itr-registration', 'middleware' => ['auth', 'company']], function() {
    Route::any('store', 'ItrRegController@store')->name('itr_reg.store');
    Route::any('/', 'ItrRegController@index')->name('itr_reg.index');
    Route::any('/user', 'ItrRegController@user_index')->name('itr_reg.user_index');
    Route::any('/single_status_change', 'ItrRegController@single_status_change')->name('itr_reg.single_status_change');
    Route::any('/reason', 'ItrRegController@reason')->name('itr_reg.reason');
    Route::any('/view/{id}', 'ItrRegController@view')->name('itr_reg.view');
    Route::any('any_data', 'ItrRegController@any_data')->name('itr_reg.any_data');
    Route::any('user_any_data', 'ItrRegController@user_any_data')->name('itr_reg.user_any_data');
    Route::any('user/create', 'ItrRegController@create')->name('itr_reg.create');
    Route::any('loan_data', 'ItrRegController@loan_data')->name('itr_reg.loan_data');
});

Route::group(['prefix'=> 'prepaidcard-kyc', 'middleware' => ['auth', 'company']], function() {
    Route::any('store', 'PrepaidCardKycController@store')->name('prepaidcard_kyc.store');
    Route::any('/', 'PrepaidCardKycController@index')->name('prepaidcard_kyc.index');
    Route::any('/user', 'PrepaidCardKycController@user_index')->name('prepaidcard_kyc.user_index');
    Route::any('/single_status_change', 'PrepaidCardKycController@single_status_change')->name('prepaidcard_kyc.single_status_change');
    Route::any('/reason', 'PrepaidCardKycController@reason')->name('prepaidcard_kyc.reason');
    Route::any('/view/{id}', 'PrepaidCardKycController@view')->name('prepaidcard_kyc.view');
    Route::any('any_data', 'PrepaidCardKycController@any_data')->name('prepaidcard_kyc.any_data');
    Route::any('user_any_data', 'PrepaidCardKycController@user_any_data')->name('prepaidcard_kyc.user_any_data');
    Route::any('user/create', 'PrepaidCardKycController@create')->name('prepaidcard_kyc.create');
    Route::any('loan_data', 'PrepaidCardKycController@loan_data')->name('prepaidcard_kyc.loan_data');
});

Route::group(['prefix'=> 'nsdl-pancard', 'middleware' => ['auth', 'company']], function() {
    Route::any('store', 'NsdlPancardController@store')->name('nsdl_pancard.store');
    Route::any('/', 'NsdlPancardController@index')->name('nsdl_pancard.index');
    Route::any('/user', 'NsdlPancardController@user_index')->name('nsdl_pancard.user_index');
    Route::any('/single_status_change', 'NsdlPancardController@single_status_change')->name('nsdl_pancard.single_status_change');
    Route::any('/reason', 'NsdlPancardController@reason')->name('nsdl_pancard.reason');
    Route::any('/view/{id}', 'NsdlPancardController@view')->name('nsdl_pancard.view');
    Route::any('any_data', 'NsdlPancardController@any_data')->name('nsdl_pancard.any_data');
    Route::any('user_any_data', 'NsdlPancardController@user_any_data')->name('nsdl_pancard.user_any_data');
    Route::any('user/create', 'NsdlPancardController@create')->name('nsdl_pancard.create');
    Route::any('nsdl_data', 'NsdlPancardController@nsdl_data')->name('nsdl_pancard.nsdl_data');
});


Route::group(['prefix'=> 'portal', 'middleware' => ['auth', 'company']], function() {
	Route::get('{type}', 'PortalController@index')->name('portal');
    Route::post('store', 'PortalController@create')->name('portalstore');
});

Route::group(['prefix'=> 'fund', 'middleware' => ['auth', 'company']], function() {
	Route::get('{type}/{action?}', 'FundController@index')->name('fund');
    Route::post('transaction', 'FundController@transaction')->name('fundtransaction');
});

Route::group(['prefix' => 'profile', 'middleware' => ['auth']], function() {
    Route::get('/view/{id?}', 'SettingController@index')->name('profile');
    Route::get('certificate', 'SettingController@certificate')->name('certificate');
    Route::post('update', 'SettingController@profileUpdate')->name('profileUpdate');
});

Route::group(['prefix' => 'setup', 'middleware' => ['auth', 'company']], function() {
    Route::get('{type}', 'SetupController@index')->name('setup');
    Route::post('update', 'SetupController@update')->name('setupupdate');
});

Route::group(['prefix' => 'resources', 'middleware' => ['auth', 'company']], function() {
    Route::get('{type}', 'ResourceController@index')->name('resource');
    Route::post('update', 'ResourceController@update')->name('resourceupdate');
    Route::post('get/{type}/commission', 'ResourceController@getCommission');
});

Route::group(['prefix' => 'recharge', 'middleware' => ['auth', 'company']], function() {
    Route::get('{type}', 'RechargeController@index')->name('recharge');
    Route::get('bbps/{type}', 'BillpayController@bbps')->name('bbps');
    Route::post('payment', 'RechargeController@payment')->name('rechargepay');
    Route::post('getplan', 'RechargeController@getplan')->name('getplan');
    Route::post('getprovider', 'RechargeController@operatorinfo')->name('getproviderInfo');
});

Route::group(['prefix' => 'billpay', 'middleware' => ['auth', 'company']], function() {
    Route::get('{type}', 'BillpayController@index')->name('bill');
    Route::post('payment', 'BillpayController@payment')->name('billpay');
    Route::post('getprovider', 'BillpayController@getprovider')->name('getprovider');
});

Route::group(['prefix' => 'pancard', 'middleware' => ['auth', 'company']], function() {
    Route::get('{type}', 'PancardController@index')->name('pancard');
    Route::post('payment', 'PancardController@payment')->name('pancardpay');
});

Route::group(['prefix' => 'dmt', 'middleware' => ['auth', 'company']], function() {
    Route::get('/', 'DmtController@index')->name('dmt1');
    Route::post('transaction', 'DmtController@payment')->name('dmt1pay');
    Route::get('/xpress', 'XpressdmtController@index')->name('dmt2');
    Route::post('xpress/transaction', 'XpressdmtController@payment')->name('dmt2pay');
});

Route::group(['prefix' => 'aeps', 'middleware' => ['auth', 'company']], function() {
    Route::any('initiate', 'AepsController@index')->name('aeps');
    Route::any('transaction', 'AepsController@transaction')->name('aepstransaction');
});

Route::group(['prefix' => 'complaint', 'middleware' => ['auth', 'company']], function() {
    Route::get('/', 'ComplaintController@index')->name('complaint');
    Route::post('store', 'ComplaintController@store')->name('complaintstore');
});

Route::group(['prefix' => 'travel', 'middleware' => ['auth', 'company']], function() {
    Route::get('{type}', 'TravelController@index')->name('travel');
});

Route::get('insurance', 'ComingsoonController@insurance')->name('insurance');
Route::get('prepaidcard', 'ComingsoonController@prepaidcard')->name('prepaidcard');
Route::get('cms', 'ComingsoonController@cms')->name('cms');
Route::get('qrcode', 'ComingsoonController@qrcode')->name('qrcode');
Route::get('virtualaccount', 'ComingsoonController@virtualaccount')->name('virtualaccount');

});