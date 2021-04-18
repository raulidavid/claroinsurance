<?php
Route::group(['namespace' => 'Madsis\Postulant\Http\Controllers','middleware' => ['web','auth']], function ($router) {
    Route::name('PostulantsInfo')->get('/getPostulantsInfo', 'PostulantController@getPostulantsInfo');
    Route::name('PostulantInfo')->get('/Postulant/{postulant}', 'PostulantController@getPostulantInfoById');
    Route::name('show_postulants_path')->get('/Postulant/View/Postulants', 'PostulantController@index');
    Route::name('show_postulant_path')->get('/Postulant/View/{postulant}/show', 'PostulantController@index');
    Route::name('Approve_Postulant')->post('/Postulant', 'PostulantController@Approve');
    Route::name('ContactedPostulant')->post('/Postulant/Contacted', 'PostulantController@ContactedUpdate');
    
});