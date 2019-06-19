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

Route::get('/','NotesController@load')->name('index');
Route::post('store','NotesController@store');
Route::get('list','NotesController@index');
Route::get('edit/{note}','NotesController@edit');
route::put('update/{note}','NotesController@update');
route::put('delete/{id}','NotesController@destroy');
