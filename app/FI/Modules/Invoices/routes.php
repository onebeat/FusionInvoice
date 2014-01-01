<?php

Route::get('public/invoice/{invoiceKey}', array('uses' => 'PublicInvoiceController@show', 'as' => 'public.invoice.show'));

Route::group(array('before' => 'auth'), function()
{
	Route::get('invoices/status/{status?}', array('uses' => 'InvoiceController@index', 'as' => 'invoices.index'));
	Route::get('invoices/modal/create', array('uses' => 'InvoiceController@modalCreate', 'as' => 'invoices.ajax.modalCreate'));
	Route::get('invoices/{invoice}', array('uses' => 'InvoiceController@show', 'as' => 'invoices.show'));
	Route::get('invoices/{invoice}/preview', array('uses' => 'InvoiceController@preview', 'as' => 'invoices.preview'));
	Route::get('invoices/{invoice}/tax_rates/{tax_rate}/delete', array('uses' => 'InvoiceController@deleteInvoiceTax', 'as' => 'invoices.ajax.deleteInvoiceTax'));
	Route::get('invoices/{invoice}/items/{item}/delete', array('uses' => 'InvoiceController@deleteItem', 'as' => 'invoices.items.delete'));
	Route::get('invoices/{invoice}/delete', array('uses' => 'InvoiceController@delete', 'as' => 'invoices.delete'));

	Route::post('invoices/modal/add_invoice_tax', array('uses' => 'InvoiceController@modalAddInvoiceTax', 'as' => 'invoices.ajax.modalAddInvoiceTax'));
	Route::post('invoices/modal/save_invoice_tax', array('uses' => 'InvoiceController@saveInvoiceTax', 'as' => 'invoices.ajax.saveInvoiceTax'));
	Route::post('invoices/modal/copy_invoice', array('uses' => 'InvoiceController@modalCopyInvoice', 'as' => 'invoices.ajax.modalCopyInvoice'));
	Route::post('invoices/modal/mail', array('uses' => 'InvoiceController@modalMailInvoice', 'as' => 'invoices.ajax.modalMailInvoice'));
	Route::post('invoices/mail', array('uses' => 'InvoiceController@mailInvoice', 'as' => 'invoices.ajax.mailInvoice'));
	Route::post('invoices/ajax/copy_invoice', array('uses' => 'InvoiceController@copyInvoice', 'as' => 'invoices.ajax.copyInvoice'));
	Route::post('invoices/create', array('uses' => 'InvoiceController@store', 'as' => 'invoices.store'));
	Route::post('invoices/{invoice}/update', array('uses' => 'InvoiceController@update', 'as' => 'invoices.update'));
});