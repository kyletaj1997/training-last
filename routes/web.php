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
Route::get('/blog', 'PracticeController@getData');
Route::get('/', 'PracticeController@index');
Route::get('/blog/create', 'PracticeController@create');
Route::post('/blog/store', 'PracticeController@store');  
Route::get('/blog/edit/{id}', 'PracticeController@edit'); 
Route::get('/blog/delete/{id}', 'PracticeController@destroy'); 
Route::post('/blog/update', 'PracticeController@update');     

Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');
