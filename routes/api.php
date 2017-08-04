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


Route::get('reset/{resetcode}','Api\UserController@reset');
Route::post('register','Api\Auth\RegisterController@register');
Route::post('login','Api\Auth\LoginController@login');
Route::post('refresh','Api\Auth\LoginController@refresh');
Route::post('social_auth', 'Api\Auth\SocialAuthController@socialAuth');
Route::post('forgot_password', 'Api\UserController@forgotPassowrd');




Route::middleware('auth:api')->group(function() {



Route::post('modify_user','Api\UserController@modifyUser');


Route::post('modify_user_first_login','Api\UserController@modifyUserLogin');

Route::get('get_user_first_login','Api\UserController@getFirstLogin');


Route::post('logout','Api\Auth\LoginController@logout');
Route::get('posts','Api\PostController@index');

Route::get('user','Api\UserController@index');

//route for all insurances 

Route::get('get_assurances','Api\InsuranceController@index');

//route for agences (based on the selected insurances)
Route::post('get_agences','Api\AgencyController@getAgences');

//route for agences (based on the selected insurances)
Route::post('create_police','Api\PoliceController@createPolice');


Route::post('insertVh','Api\PoliceController@insertVehicleData');

Route::post('get_police_info','Api\PoliceController@getPoliceInfo');

Route::post('post_constat','Api\ConstatController@postConstat');

Route::post('modify_constat','Api\ConstatController@modifyConstat');





});
