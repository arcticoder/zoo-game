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

Route::get('animal/index', 'AnimalController@index');
Route::get('animal/hungrier', 'AnimalController@incrementHunger')->middleware('throttle:999999');
Route::get('animal/revive', 'AnimalController@revive');
Route::get('animal/feed', 'AnimalController@feed');