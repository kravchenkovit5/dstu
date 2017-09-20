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
Route::get('/show_requests', 'PageController@showRequests' );

Route::get('/viewer/{name}','PageController@viewDoc');
Route::get('/setuser','PageController@setuser');
Route::get('/check','PageController@check');

Route::resource('docs', 'DocController');
Route::resource('reqs','ReqController');
Route::get('/selectdocs','DocController@selectDocs');

Route::get('/select_requests','ReqController@selectRequests');
//Route::get('/create_request','ReqController@create');

Route::get('/test','PageController@test');
Route::get('/messages', 'PageController@showMessages');
Route::get('/select_all_mess', 'MessageController@selectAllMess');
Route::get('/select_user_mess', 'MessageController@selectUserMess');
Route::get('/select_not_read_mess', 'MessageController@selectNotReadMess');

