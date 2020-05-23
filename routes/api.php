<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('login', 'API\Auth\LoginController@login');
Route::post('register', 'API\Auth\RegisterController@register');
Route::get('email/verify/{id}', 'API\Auth\RegisterVerificationController@verify')->name('verificationapi.verify');
Route::post('password/email', 'API\Auth\ForgotPasswordController@forgotPassword');
Route::get('password/reset/{token}', 'API\Auth\ResetPasswordController@resetForm')->name('forgotpassword.reset');
Route::post('password/reset', 'API\Auth\ResetPasswordController@reset');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('email/resend', 'API\Auth\RegisterVerificationController@resend')->name('verificationapi.resend');
    Route::post('logout', 'API\Auth\LogoutController@logout');
    Route::group(['middleware' => 'verified'], function () {
        Route::get('users/{id}', 'API\UserController@show');
    });
});
