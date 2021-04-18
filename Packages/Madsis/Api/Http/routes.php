<?php
Route::group(['namespace' => 'Madsis\Api\Http\Controllers','middleware' => ['web']], function ($router) {
    Route::name('provincias')->get('provincias','UbicacionController@getAllProvincias');
    Route::name('cantones')->get('cantones/{id?}','UbicacionController@getCantones');
    Route::name('parroquias')->get('parroquias/{id?}','UbicacionController@getParroquias');

    Route::get('nacionalidades','AdministrativoController@getNacionalidades');
    Route::get('genero','AdministrativoController@getGeneros');
    Route::get('estado_civil','AdministrativoController@getEstadoCivil');
    Route::get('tipos_documentos','AdministrativoController@getTiposDocumentos');
});

Route::group(['namespace' => 'Madsis\Api\Http\Controllers','middleware' => ['web','auth']], function ($router) {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/storage/{file}','FileController@getImage')->where(['file' => '.*']);
    Route::get('Administrativo/convenios','AdministrativoController@getConvenios');
    Route::get('perfiles','AdministrativoController@getPerfiles');
    Route::get('obsusuarios','AdministrativoController@getObsUsuarios');
    Route::get('Administrativo/EntidadesFinancieras','AdministrativoController@getEntidadesFinancieras');
    Route::get('parentezco','AdministrativoController@getParentezco');
    Route::get('Administrativo/convenios','AdministrativoController@getConvenios');
    Route::get('Administrativo/OrdenEstados','AdministrativoController@getOrdenEstados');
    Route::get('Administrativo/RutasAngular','AdministrativoController@getRoutesAngular');
    Route::get('Administrativo/Despachos','AdministrativoController@getDespachos');


    
});

Route::group(['prefix'=>'api/v1',['middleware' => 'cors']], function() {

    // Location
    Route::post('login', 'Madsis\Api\Http\Controllers\ApiController@login');
    Route::get('provincias','Madsis\Api\Http\Controllers\UbicacionController@getAllProvincias');
    Route::get('cantones/{id}','Madsis\Api\Http\Controllers\UbicacionController@getCantones');
    Route::get('parroquias/{id}','Madsis\Api\Http\Controllers\UbicacionController@getParroquias');
    Route::get('estadocivil','Madsis\Api\Http\Controllers\AdministrativoController@getEstadoCivil');
    Route::get('genero','Madsis\Api\Http\Controllers\AdministrativoController@getGeneros');


    Route::group(['middleware' => ['jwt.verify','cors']], function () {

        // Authentication
        Route::get('logout', 'Madsis\Api\Http\Controllers\ApiController@logout');
        Route::post('refresh', 'Madsis\Api\Http\Controllers\ApiController@refresh');
        Route::get('loggedIn', 'Madsis\Api\Http\Controllers\ApiController@loggedIn');
        Route::post('sendPasswordResetLink', 'Madsis\Api\Http\Controllers\ResetPasswordController@sendEmail');
        Route::post('resetPassword', 'Madsis\Api\Http\Controllers\ChangePasswordController@process');
        Route::get('AuthorizedPaths','Madsis\Api\Http\Controllers\AdministrativoController@AuthorizedPaths');

        Route::get('/Team/Descendants', 'Madsis\User\Http\Controllers\TeamController@descendants');
        //Route::get('/Ventas/getUserSales', 'Madsis\Sales\Http\Controllers\VentasController@getLoginUserSalesApi');

        
            Route::get('perfiles','Madsis\Api\Http\Controllers\AdministrativoController@getPerfiles');
        
        //Route::post('/user', 'Madsis\Api\Http\Controllers\UserController@getLoginUserSalesApi');
    });
});

Route::get('/demo', function () {
    return new Madsis\Core\Mail\GunsNRosesWelcome();
});
