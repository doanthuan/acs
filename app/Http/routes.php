<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'LendingController@index');

Route::controller('lending', 'LendingController');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::group(['prefix' => 'admin'], function()
{
	Route::controller('device', 'Admin\DeviceController');

	Route::controller('device-type', 'Admin\DeviceTypeController');

	Route::controller('visit-log', 'Admin\VisitLogController');

	Route::controller('device-lending', 'Admin\DeviceLendingController');
});

