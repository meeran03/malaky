<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Api'], function () {

    Route::get('countries', 'CountryController@index');
    Route::get('cities/{id}', 'CityController@index');
    Route::get('nationalities', 'NationalityController@index');
    Route::get('conditions', 'ConditionController@index');
    Route::get('pages/{id}', 'PageController@index');
    Route::get('services', 'ServiceController@index');
    Route::post('deliveries', 'DeliveryController@create');
    Route::get('sliders', 'PageController@sliders');

    Route::post('register', 'UserController@register');
    Route::post('login', 'UserController@login');
    Route::post('code', 'UserController@code');
    Route::post('check', 'UserController@check');
    Route::post('forget', 'UserController@forget');
    Route::post('logout', 'UserController@logoutApi');
    Route::post('contact_us', 'PageController@contactUs');
    Route::post('seeks', 'SeekController@index');
    Route::post('sitters', 'UserController@sitters');
    Route::post('sitters/{id}', 'UserController@sittersShow');
    Route::post('search', 'UserController@search');


    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('reset', 'UserController@reset');
        Route::post('profile', 'UserController@profile');
        Route::post('update', 'UserController@update');
        Route::post('location', 'UserController@location');
        Route::post('upload_image', 'UserController@UploadImage');
        Route::post('upload_cv', 'UserController@UploadCv');
        Route::post('logout', 'UserController@logoutApi');
        Route::post('update_phone', 'UserController@updatePhone');
        Route::post('update_phone_check', 'UserController@updatePhoneCheck');
        Route::post('images', 'UserController@images');
        Route::post('images/delete', 'UserController@imagesDelete');
        Route::post('update_device_token', 'UserController@updateDeviceToken');

        Route::post('children', 'ChildrenController@index');
        Route::post('children/add', 'ChildrenController@add');
        Route::post('children/delete', 'ChildrenController@delete');

        Route::post('notifications', 'UserController@notifications');
        Route::post('notifications/{id}/delete', 'UserController@deleteNotifications');

        Route::post('users/{id}', 'UserController@show');

        Route::post('packages', 'PackageController@index');
        Route::post('packages/subscribe', 'PackageController@subscribe');

        Route::post('orders','OrderController@index');
        Route::post('orders/show','OrderController@show');
        Route::post('orders/add','OrderController@add');
        Route::post('orders/children','OrderController@children');
        Route::post('orders/status','OrderController@status');
        Route::post('orders/rate','OrderController@rate');
        Route::post('orders/current','OrderController@current');

        Route::post('coupon','OrderController@coupon');

        Route::post('chats', 'ChatController@index');
        Route::post('send_message', 'ChatController@sendMessage');
        Route::post('chat_messages', 'ChatController@chatMessages');

        Route::post('apprates','AppRateController@index');
    });
    Route::fallback('PageController@fallBack' );
});
