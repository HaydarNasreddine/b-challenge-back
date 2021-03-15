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

Route::prefix('v1.0')->group(function () {

    Route::get('version', function () {
        return 'API v1.0';
    });

    Route::post("login", 'UserController@login');
    Route::post("logout", 'UserController@logout');

    Route::prefix('users')->group(function () {
        Route::post("", 'UserController@create');
        Route::group(['middleware' => ['auth:api', 'admin']], function () {
            Route::get("", "UserController@getAll");
            Route::get('filter', 'UserController@filter');
            Route::get('average', 'UserController@average');
        });
    });
});
