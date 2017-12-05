<?php

// all these routes are with namespace App\Controllers\Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function() {
    Route::get('/', [
        'uses'  => 'DashboardController@index',
        'as'    => 'dashboard'
    ]);

    Route::get('post/create', [
        'uses'  => 'PostController@create',
        'as'    => 'post.create'
    ]);
});