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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::group( [ 'namespace' => 'api', 'middleware' => [  'auth:api' ] ], function () {

    Route::get('/auth/login', ['as' => 'backend', 'uses' => 'AdminController@index']);
    Route::get('/auth/register', ['as' => 'api_register', 'uses' => 'AuthController@register']);
});