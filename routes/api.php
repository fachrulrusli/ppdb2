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

// Route::middleware('auth:api')->group( function () {
// 	Route::resource('test', 'Api\ApiController@showdata');
// });

Route::group(['prefix' => 'v1'], function () {
    Route::get('test', function ()    {
        return 'test';
    });
    // apites
    Route::get('/tes','Api\ApiController@showdata');

});