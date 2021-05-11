<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\WithdrawalController;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin/login', 'Admin\LoginController@showLoginForm')->name('admin.login.page');
Route::post('/admin/login', 'Admin\LoginController@login')->name('admin.login');

Route::group(['prefix' => 'admin', 'middleware' => ['HasAdminPermission'], 'as' => 'admin.', 'namespace' => 'Admin'], function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::post('/search', [DashboardController::class, 'search']);

    Route::get('settings', [SettingController::class, 'index']);
    Route::post('settings', [SettingController::class, 'store'])->name('settings.store');
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::post('reports', [ReportController::class, 'index'])->name('reports.search');

    Route::resource('withdrawals', 'WithdrawalController');

    Route::resource('statistics', 'StatisticsController');
    Route::resource('cities', 'CityController');
    Route::resource('users', 'UserController');
    Route::resource('packages', 'PackageController');
    Route::resource('subscriptions', 'SubscriptionController');
    Route::resource('notifications', 'NotificationController');
    Route::get('markallasread', 'NotificationController@markAllAsRead')->name('markAllAsRead');
    Route::get('deleteall', 'NotificationController@destroyAll')->name('destroyAll');
    Route::resource('roles', 'RoleController');
    Route::resource('pages', 'PageController');
    Route::resource('chats', 'ChatController');
    Route::resource('contacts', 'ContactController');
    Route::resource('applications', 'ApplicationController');
    Route::resource('deliveries', 'DeliveryController');
    Route::resource('staticpages', 'StaticpageController');
    Route::resource('conditions', 'ConditionController');
    Route::resource('services', 'ServiceController');
    Route::resource('sliders', 'SliderController');
    Route::resource('statuses', 'StatusController');
    Route::resource('orders', 'OrderController');
    Route::resource('coupons', 'CouponController');
    Route::resource('activations', 'ActivationController');
    Route::resource('apprates', 'ApprateController');
    Route::resource('seeks', 'SeekController');


    Route::get('logout', 'LoginController@logout');

});

/*
|--------------------------------------------------------------------------
| WebSite Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/applications', 'Website\ApplicationController@index');
Route::post('/applications', 'Website\ApplicationController@store');
Route::get('/applications_sent', 'Website\ApplicationController@sent');

Route::get('/pages/{slug}', 'Website\PageController@show');

// Route::get('lang/{locale}', 'HomeController@lang')->middleware('SetLocale');
Route::get('lang/{locale}', 'HomeController@lang');

Route::get('/pay', 'Website\PayController@pay');
Route::get('/pay/result', 'Website\PayController@result');
Route::get('/pay/success', 'Website\PayController@finish');
Route::get('/pay/error', 'Website\PayController@finish');

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('homepage');
