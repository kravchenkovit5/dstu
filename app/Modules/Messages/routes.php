<?php
Route::group(['middleware' => ['web']], function () {
    Route::get('/select_all_mess', 'App\Modules\Messages\Controllers\MessageController@selectAllMess');
    Route::get('/select_user_mess', 'App\Modules\Messages\Controllers\MessageController@selectUserMess');
    Route::get('/select_not_read_mess/{username}', 'App\Modules\Messages\Controllers\MessageController@selectNotReadMess');
    Route::get('/set_status_mess/{num}', 'App\Modules\Messages\Controllers\MessageController@setStatusMess');
    Route::get('/messages', 'App\Modules\Messages\Controllers\MessageController@showList');
});