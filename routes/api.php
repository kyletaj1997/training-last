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


Route::get('login', 'Youtube@viewLogin');
Route::post('login', 'Youtube@login');
Route::post('register', 'Youtube@register');
Route::group(['middleware' => 'auth:api'], function(){
Route::post('details', 'Youtuber@details');
});