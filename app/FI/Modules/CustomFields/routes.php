<?php

Route::group(array('before' => 'auth'), function()
{
	Route::get('custom_fields', array('uses' => 'CustomFieldController@index', 'as' => 'customFields.index'));
	Route::get('custom_fields/create', array('uses' => 'CustomFieldController@create', 'as' => 'customFields.create'));
	Route::get('custom_fields/{customField}/edit', array('uses' => 'CustomFieldController@edit', 'as' => 'customFields.edit'));
	Route::get('custom_fields/{customField}/delete', array('uses' => 'CustomFieldController@delete', 'as' => 'customFields.delete'));

	Route::post('custom_fields', array('uses' => 'CustomFieldController@store', 'as' => 'customFields.store'));
	Route::post('custom_fields/{customField}', array('uses' => 'CustomFieldController@update', 'as' => 'customFields.update'));
});