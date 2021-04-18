<?php

Route::group(['middleware' => ['web']], function () {

    /**
     * Register Route(s)
     */
    Route::get('register', 'Madsis\User\Http\Controllers\RegisterController@index')->defaults('_config', [
        'view' => 'user::account.register'
    ]);
    Route::post('register', 'Madsis\User\Http\Controllers\RegisterController@register')->name('user.account.register');
    /**
     * Password Reset Route(S)
     */
    Route::get('password/reset', 'Madsis\User\Http\Controllers\ForgotPasswordController@showLinkRequestForm')->defaults('_config', [
        'view' => 'user::account.passwords.email'
    ])->name('password.request');
    Route::post('password/email', 'Madsis\User\Http\Controllers\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

    Route::get('password/reset/{token}', 'Madsis\User\Http\Controllers\ResetPasswordController@showResetForm')->defaults('_config', [
        'view' => 'user::account.passwords.reset'
    ])->name('password.reset');
    Route::post('password/reset', 'Madsis\User\Http\Controllers\ResetPasswordController@reset')->name('password.update');
    /**
     * Email Verification Route(s)
     */
    //Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
    //Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
    //Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
});

Route::group(['middleware' => ['web','auth']], function () {
    Route::get('/users', 'Madsis\User\Http\Controllers\UserController@index')->name('ShowUsersPath');
    Route::get('/getUsuarios', 'Madsis\User\Http\Controllers\UserController@getUsuarios')->name('usuarios');
    Route::get('/user', 'Madsis\User\Http\Controllers\UserController@getAuthInfoById')->name('user');
    Route::get('/user/{user}', 'Madsis\User\Http\Controllers\UserController@getUserInfoById')->name('UserInfo');
    Route::get('/User/getUserSons', 'Madsis\User\Http\Controllers\UserController@getUserSons')->name('UserSons');
    Route::get('/User/getSons', 'Madsis\User\Http\Controllers\UserController@getSons')->name('Sons');
    Route::get('/User/search', 'Madsis\User\Http\Controllers\UserController@Search')->name('UserSearch');
    Route::get('/User/View/ProfileUpdate', 'Madsis\User\Http\Controllers\UserController@index')->name('UserProfileUpdate');
    Route::post('/User/Profile/Update/{user}', 'Madsis\User\Http\Controllers\UserController@UpdateUserProfile')->name('UserProfileUpdate');
    Route::get('/Contacto/Create', 'Madsis\User\Http\Controllers\UserController@index')->name('ContactCreatePath');
    Route::post('/user/store', 'Madsis\User\Http\Controllers\UserController@store')->name('store_user');
    Route::post('/User/Update', 'Madsis\User\Http\Controllers\UserController@Update')->name('UserUpdate');
    Route::post('/User/Eliminar/{id}', 'Madsis\User\Http\Controllers\UserController@Eliminar');
    Route::name('ShowTeamPath')->get('/Team', 'Madsis\User\Http\Controllers\TeamController@index');
    Route::name('ShowTeam')->get('/Team/Descendants', 'Madsis\User\Http\Controllers\TeamController@descendants');
    Route::name('UniqueTeam')->get('/Team/Unique', 'Madsis\User\Http\Controllers\TeamController@migrate');

    Route::get('/Remove/User', 'Madsis\User\Http\Controllers\UserController@deleteUser');
});
Route::group(['prefix'=>'api/v1',['middleware' => 'cors']], function() {
    Route::get('me', 'Madsis\User\Http\Controllers\UserController@me');
});
