<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'checkaeps'], function() {
    Route::any('icici/initiate', 'AepsController@iciciaepslog');
    Route::any('icici/update', 'AepsController@iciciaepslogupdate');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('getbal/{token}', 'Api\ApiController@getbalance');
Route::any('getip', 'Api\ApiController@getip');


// Callbacks
Route::any('callback/update','CallbackController@update');
//Route::any('callback/payoutdmt','CallbackController@payoutdmt');

Route::group(['prefix'=> 'callback/update'], function() {
    Route::any('{api}', 'CallbackController@callback');
});

/*Uti Pan Api*/
Route::any('pancard/create', 'Api\PancardController@create');
Route::any('pancard/status/{type?}', 'Api\PancardController@status');
Route::any('pancard/request', 'Api\PancardController@transaction');
Route::any('pancard/request/status', 'Api\PancardController@transactionStatus');
Route::any('pancard/reset', 'Api\PancardController@PanReset');

/*Recharge Api*/
Route::any('getprovider', 'Api\RechargeController@getProvider');
Route::any('recharge/pay', 'Api\RechargeController@payment');
Route::any('recharge/status', 'Api\RechargeController@status');

Route::any('android/billpay/getprovider', 'Android\BillpayController@getprovider');
/*Bill Api*/
Route::any('bill/{type}', 'Api\BillpayController@payment');

/*Mahagra, DMT Api*/
Route::any('dmt/registration', 'Api\DmtController@registration');
Route::any('dmt/transaction', 'Api\DmtController@transaction');

/*Aeps Api*/
Route::any('aeps/registration', 'Api\AepsController@registration');
Route::any('aeps/initiate', 'Api\AepsController@initiate');

/*Android App Apis*/
Route::any('android/auth', 'Android\UserController@login');
Route::any('android/auth/user/register', 'Android\UserController@registration');
Route::any('android/getbalance', 'Android\UserController@getbalance');
Route::any('android/aeps/initiate', 'Android\UserController@aepsInitiate');
Route::any('android/transaction', 'Android\TransactionController@transaction');
Route::any('android/fundrequest', 'Android\FundController@transaction');
Route::any('android/auth/password/change', 'Android\UserController@changepassword');
Route::any('android/secure/microatm/initiate', 'Android\UserController@microatmInitiate');
Route::any('android/secure/microatm/update', 'Android\UserController@microatmUpdate');
Route::any('android/auth/reset/request', 'Android\UserController@passwordResetRequest');
Route::any('android/auth/reset', 'Android\UserController@passwordReset');

/*Recharge Android Api*/

Route::any('android/recharge/providers', 'Android\RechargeController@providersList');
Route::any('android/recharge/pay', 'Android\RechargeController@transaction');
Route::any('android/recharge/status', 'Android\RechargeController@status');
Route::any('android/recharge/getplan', 'Android\RechargeController@getplan');
Route::any('android/transaction/status', 'Android\TransactionController@transactionStatus');

/*Bill Android Api*/

Route::any('android/billpay/providers', 'Android\BillpayController@providersList');
Route::any('android/billpay/transaction', 'Android\BillpayController@transaction');
Route::any('android/billpay/status', 'Android\BillpayController@status');

/*Bill Android Api*/

Route::any('android/pancard/transaction', 'Android\PancardController@transaction');
Route::any('android/pancard/status', 'Android\PancardController@status');

/*Bill Android Api*/

Route::any('android/dmt/transaction', 'Android\MoneyController@transaction');

Route::any('android/xpressdmt/transaction', 'Android\XpressController@transaction');

Route::any('android/aepsregistration', 'Android\UserController@aepskyc');
Route::any('android/GetState', 'Android\UserController@GetState');
Route::any('android/GetDistrictByState', 'Android\UserController@GetDistrictByState');

Route::any('android/tpin/getotp', 'Android\UserController@getotp');
Route::any('android/tpin/generate', 'Android\UserController@setpin');