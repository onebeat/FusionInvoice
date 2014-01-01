<?php

Route::group(array('before' => 'auth'), function()
{
	Route::get('invoice_groups', array('uses' => 'InvoiceGroupController@index', 'as' => 'invoiceGroups.index'));
	Route::get('invoice_groups/create', array('uses' => 'InvoiceGroupController@create', 'as' => 'invoiceGroups.create'));
	Route::get('invoice_groups/{invoiceGroup}/edit', array('uses' => 'InvoiceGroupController@edit', 'as' => 'invoiceGroups.edit'));
	Route::get('invoice_groups/{invoiceGroup}/delete', array('uses' => 'InvoiceGroupController@delete', 'as' => 'invoiceGroups.delete'));

	Route::post('invoice_groups', array('uses' => 'InvoiceGroupController@store', 'as' => 'invoiceGroups.store'));
	Route::post('invoice_groups/{invoiceGroup}', array('uses' => 'InvoiceGroupController@update', 'as' => 'invoiceGroups.update'));
});