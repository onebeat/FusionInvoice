<?php

Route::group(array('before' => 'auth'), function()
{
	Route::get('clients/status/{status?}', array('uses' => 'ClientController@index', 'as' => 'clients.index'));
	Route::get('clients/create', array('uses' => 'ClientController@create', 'as' => 'clients.create'));
	Route::get('clients/{client}/edit', array('uses' => 'ClientController@edit', 'as' => 'clients.edit'));
	Route::get('clients/{client}', array('uses' => 'ClientController@show', 'as' => 'clients.show'));
	Route::get('clients/{client}/delete', array('uses' => 'ClientController@delete', 'as' => 'clients.delete'));

	Route::post('clients/ajax/name_lookup', array('uses' => 'ClientController@ajaxNameLookup', 'as' => 'clients.ajax.nameLookup'));
	Route::post('clients/ajax/save_note', array('uses' => 'ClientController@ajaxSaveNote', 'as' => 'clients.ajax.saveNote'));
	Route::post('clients/ajax/load_notes', array('uses' => 'ClientController@ajaxLoadNotes', 'as' => 'clients.ajax.loadNotes'));
	Route::post('clients', array('uses' => 'ClientController@store', 'as' => 'clients.store'));
	Route::post('clients/{client}', array('uses' => 'ClientController@update', 'as' => 'clients.update'));
});