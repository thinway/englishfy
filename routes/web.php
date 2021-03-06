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

Route::get('/references', 'ReferencesController@index');
Route::get('/references/{reference}', 'ReferencesController@show');
Route::post('/references', 'ReferencesController@store')->middleware('auth');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
