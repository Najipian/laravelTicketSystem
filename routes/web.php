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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'landlord', 'middleware' => 'is_landlord'], function () {
        Route::get('/', 'HomeController@landlord');
        Route::get('/ticket/statistics' , 'TicketController@statistics');
        Route::resource('ticket', 'TicketController')->only(['show' , 'update' , 'index']);
        Route::post('ticket/status/{ticket}' , 'TicketController@changeTicketStatus');
        Route::post('ticket/reassign/{ticket}' , 'TicketController@reassignTicketToUser');
    });

    Route::group(['prefix' => 'tenant'], function () {
        Route::get('/', 'HomeController@index');
        Route::get('ticket/statistics' , 'TicketController@statistics');
        Route::resource('ticket', 'TicketController')->except(['delete' , 'edit']);
    });
});

Route::get("notlandlord" , function(){
   echo "Landlord permission needed";
});

Auth::routes();

Route::get('landlord/login', 'Auth\LoginController@showLandlordLoginForm')->name('landlord.login');
Route::post('landlord/login', 'Auth\LoginController@landlordLogin');

