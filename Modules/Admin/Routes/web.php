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

Route::prefix(ADMIN_PATH)->as('admin.')->group(function() {
    Route::get('/', function(){
        return redirect()->to(route('admin.login'));
    });
    Auth::routes(['register' => false]);
    Route::group(['middleware' => 'auth.admin'], function () {
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('profile/change-password', 'ProfileController@change_password')->name('profile.change-password');
        Route::post('profile/update-password', 'ProfileController@update_password')->name('profile.update-password');
        Route::resource('profile', 'ProfileController');
        Route::resource('airport', 'AirportController');
        Route::resource('package', 'PackageController');
        Route::resource('sender', 'SenderController');
        Route::resource('traveller', 'TravellerController');
        Route::get('order/assign-order/{id}', 'OrderController@assign_order')->name('order.assign-order');
        Route::patch('order/assign-order/{id}', 'OrderController@update_journey')->name('order.assign-order');
        // Route::get('order/view-order', 'OrderController@view_order')->name('order.view-order');
        Route::resource('order', 'OrderController');
        Route::get('journey/orders/{id}', 'JourneyController@orders')->name('journey.orders');
        Route::resource('journey', 'JourneyController');
    });
});
