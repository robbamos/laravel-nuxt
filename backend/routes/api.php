<?php

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

Route::group(['namespace' => 'Api'], function () {
    Route::post('login', 'Auth@login');
    Route::post('register', 'Auth@register');
});

Route::group(['middleware' => 'auth:api', 'namespace' => 'Api'], function () {
    Route::get('me', 'Auth@me');
    Route::post('logout', 'Auth@logout');
});
