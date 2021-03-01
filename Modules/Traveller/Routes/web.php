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

Route::prefix('traveller')->as('traveller.')->middleware(['auth'])->group(function() { // , 'verified'
    Route::get('/', 'TravellerController@index')->name('index');
    Route::get('profile/change-password', 'ProfileController@change_password')->name('profile.change-password');
    Route::post('profile/update-password', 'ProfileController@update_password')->name('profile.update-password');
    Route::resource('profile', 'ProfileController');
    Route::get('journey/complete', 'JourneyController@complete')->name('journey.complete');
    Route::get('journey/orders/{id}', 'JourneyController@orders')->name('journey.orders');
    Route::resource('journey', 'JourneyController');
});
