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

Route::get('/','HomeController@index');
Route::post('add','HomeController@add')->name('add');
Route::post('add_by_command','HomeController@add_by_command')->name('add_by_command');
Route::post('remove','HomeController@remove')->name('remove');
Route::post('remove_by_command','HomeController@remove_by_command')->name('remove_by_command');
Route::get('history', 'HomeController@history')->name('history');
Route::post('move', 'HomeController@move')->name('move');
Route::post('move_by_command', 'HomeController@move_by_command')->name('move_by_command');
