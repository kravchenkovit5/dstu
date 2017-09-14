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
//маршруты
Route::get('/', 'PageController@showHome' );
Route::get('/requests', 'PageController@showRequests' );

Route::get('/viewer/{name}','PageController@viewDoc');
Route::get('/setuser','PageController@setuser');
Route::get('/check','PageController@check');

Route::resource('docs', 'DocController');
Route::resource('reqs','ReqController');
Route::get('/selectdocs','DocController@selectdocs');

