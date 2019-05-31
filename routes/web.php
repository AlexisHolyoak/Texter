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
    return view('index');
})->name('index');
Route::post('store','NotesController@store')->name('note.store');
Route::get('list','NotesController@index')->name('note.index');
Route::get('edit/{note}','NotesController@edit')->name('note.edit');
route::put('update/{note}','NotesController@update')->name('note.update');
