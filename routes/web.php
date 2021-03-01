<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('dashboard');

Route::get('login/{social}','Auth\LoginController@socialLogin')->where('social','facebook|google')->name('social-login');
Route::get('login/{social}/callback','Auth\LoginController@handleProviderCallback')->where('social','facebook|google')->name('social-login-callback');
Auth::routes(['verify'=>true]);

Route::get('home', 'HomeController@index')->name('home');

Route::get('about-us', 'PageController@about_us')->name('about-us');
Route::resource('contact-us', 'ContactUsController');
Route::get('terms-condition', 'PageController@terms_condition')->name('terms-condition');
Route::get('privacy-policy', 'PageController@privacy_policy')->name('privacy-policy');

Route::post('customer_request', 'HomeController@customer_request')->name('customer-request');
