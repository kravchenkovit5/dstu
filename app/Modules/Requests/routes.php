<?php
Route::group(['middleware' => ['web']], function () {
    Route::resource('reqs','App\Modules\Requests\Controllers\ReqController');
    Route::get('/select_requests','App\Modules\Requests\Controllers\ReqController@selectRequests');
    Route::get('/show_requests', 'App\Modules\Requests\Controllers\ReqController@showList' );

});

//Route::get('/create_request','ReqController@create');
