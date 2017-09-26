<?php

Route::group(['middleware' => 'web'], function () {
    Route::resource('docs', 'App\Modules\Documents\Controllers\DocController');
    Route::get('/selectdocs', 'App\Modules\Documents\Controllers\DocController@selectDocs');
});