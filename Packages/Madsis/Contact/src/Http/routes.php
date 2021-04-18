<?php

Route::group(['namespace' => 'Madsis\Contact\Http\Controllers','middleware' => ['web','auth']], function ($router) {
    Route::name('Contacts_path')->get('/Contact/List/contacts', 'ContactController@index');
    Route::name('ContactsInfo')->get('/Contact/contacts', 'ContactController@getContacts');
    Route::name('ContactInfo')->get('/Contact/{contacto}', 'ContactController@getContact');
    Route::name('StoreContact')->post('/Contact/store', 'ContactController@store');
    Route::get('/Customers/Validate', 'ContactController@ValidateCustomers');

});