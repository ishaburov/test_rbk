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

Route::group(['namespace' => 'Api', 'prefix' => 'v1'], function () {
    Route::group(['prefix' => 'rbc'], function () {
        Route::get('/articles', 'ArticleController@index');
        Route::get('/articles/{id}', 'ArticleController@show');
    });
});
