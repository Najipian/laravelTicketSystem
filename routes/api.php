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

Route::post('login', 'UserController@login');

Route::group(['prefix' => 'v1'],function(){
    Route::group(['middleware' => 'auth:api'], function () {
        Route::group(['prefix' => 'landlord', 'middleware' => 'is_landlord'], function () {
            Route::get('ticket/statistics' , 'TicketController@statistics');
        });
        Route::group(['prefix' => 'tenant'], function () {
            Route::get('ticket/statistics' , 'TicketController@statistics');
        });
    });
});
