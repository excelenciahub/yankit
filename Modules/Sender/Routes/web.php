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

Route::prefix('sender')->as('sender.')->middleware(['auth'])->group(function() { // , 'verified'
    Route::get('/', 'SenderController@index');
    Route::get('profile/change-password', 'ProfileController@change_password')->name('profile.change-password');
    Route::post('profile/update-password', 'ProfileController@update_password')->name('profile.update-password');
    Route::resource('profile', 'ProfileController');
    Route::post('order/payment', 'OrderController@payment')->name('order.payment');
    Route::get('order/complete', 'OrderController@complete')->name('order.complete');
    Route::resource('order', 'OrderController');
    Route::resource('cart', 'CartController');
});
