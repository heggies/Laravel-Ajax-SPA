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

Route::group(['prefix' => 'ajax-route'], function() {
  Route::get('{id}', 'AjaxRouteController@route');
});

Route::get('/', 'MyController@index');
Route::delete('/', 'MyController@drop');

Route::get('tambah', 'MyController@form_tambah');
Route::post('tambah', 'MyController@store');

Route::get('ubah', 'MyController@edit');
Route::post('ubah', 'MyController@update');

Route::get('cari', 'MyController@search');
