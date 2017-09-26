<?php

Route::group(['middleware' => ['web']], function () {
    Route::get('/', 'App\Modules\Pages\Controllers\PageController@showHome');
    Route::get('/viewer/{id}', 'App\Modules\Pages\Controllers\PageController@viewDoc');
    Route::get('/setuser', 'App\Modules\Pages\Controllers\PageController@setuser');
    Route::get('/check', 'App\Modules\Pages\Controllers\PageController@check');
    Route::get('/test', 'App\Modules\Pages\Controllers\PageController@test');
});
