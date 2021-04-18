<?php

Route::group(['middleware' => ['web']], function () {

    Route::get('/', 'Madsis\Auth\Http\Controllers\LoginController@showLoginForm')->defaults('_config', [
        'view' => 'auth::login.index'
    ]);
    Route::get('login', 'Madsis\Auth\Http\Controllers\LoginController@showLoginForm')->defaults('_config', [
        'view' => 'auth::login.index'
    ])->name('login');

    Route::post('login', 'Madsis\Auth\Http\Controllers\LoginController@login')->name('login');
    Route::post('logout', 'Madsis\Auth\Http\Controllers\LoginController@logout')->name('logout');

});
