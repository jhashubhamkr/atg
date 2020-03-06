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

Route::get('/', function(){
	return redirect()->route('atg.index');
});

//routes mapped to their respective controller methods
Route::get('/deliverables/tasks','ATGController@index')->name('atg.index');
Route::post('/deliverables/tasks','ATGController@store')->name('atg.store');
Route::get('/deliverables/tasks/create','ATGController@create')->name('atg.create');

Route::get('/deliverables/tasks/createAjax','ATGController@createAjax')->name('atg.createAjax');
