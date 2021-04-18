<?php
Route::group(['namespace' => 'Madsis\Alliances\Http\Controllers','middleware' => ['web','auth']], function ($router) {
    Route::name('consultarafiliado_path')->get('/Isspol/consultar/afiliado', 'IsspolController@index');
    Route::name('consultarafiliado_method')->post('/Isspol/consulta/afiliado', 'IsspolController@getConsultarAfiliado');
    Route::name('consultarcreditos_method')->post('/Isspol/consultar/creditos', 'IsspolController@getConsultarCreditos');
    Route::name('consultargarante_method')->post('/Isspol/consultar/garante', 'IsspolController@getConsultarGarante');
    Route::name('verificarcredito_method')->post('/Isspol/verificar/credito', 'IsspolController@getVerificarCredito');
    Route::name('anularcredito_method')->post('/Isspol/anular/credito', 'IsspolController@getAnularCredito');

    Route::name('fcme_path')->get('/Fcme/ws/fcme', 'FcmeController@index');
    Route::name('fmceGetDocCredito_method')->post('/Fcme/consulta/credito', 'FcmeController@getDocCredito');
    Route::name('fmceGetPermiteCredito_method')->post('/Fcme/permite/credito', 'FcmeController@getPermiteCredito');
    Route::name('fmceSetEliminaCredito_method')->post('/Fcme/elimina/credito', 'FcmeController@SetEliminaCredito');
});