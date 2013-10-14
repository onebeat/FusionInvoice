<?php

Route::get('login', array('uses' => 'SessionController@login', 'as' => 'session.login'));
Route::post('login', array('uses' => 'SessionController@attempt', 'as' => 'session.attempt'));
Route::get('logout', array('uses' => 'SessionController@logout', 'as' => 'session.logout'));

Route::group(array('before' => 'auth'), function()
{
	/*
	|--------------------------------------------------------------------------
	| Routes: Dashboard
	|--------------------------------------------------------------------------
	*/
	Route::get('/', 'DashboardController@index');
	Route::get('dashboard', array('uses' => 'DashboardController@index', 'as' => 'dashboard.index'));

	/*
	|--------------------------------------------------------------------------
	| Routes: Clients
	|--------------------------------------------------------------------------
	*/
	Route::get('clients/status/{status?}', array('uses' => 'ClientController@index', 'as' => 'clients.index'));
	Route::get('clients/create', array('uses' => 'ClientController@create', 'as' => 'clients.create'));
	Route::get('clients/{client}/edit', array('uses' => 'ClientController@edit', 'as' => 'clients.edit'));
	Route::get('clients/{client}', array('uses' => 'ClientController@show', 'as' => 'clients.show'));
	Route::get('clients/{client}/delete', array('uses' => 'ClientController@delete', 'as' => 'clients.delete'));

	Route::post('clients/ajax/save_note', array('uses' => 'ClientController@ajaxSaveNote', 'as' => 'clients.ajax.saveNote'));
	Route::post('clients/ajax/load_notes', array('uses' => 'ClientController@ajaxLoadNotes', 'as' => 'clients.ajax.loadNotes'));
	Route::post('clients', array('uses' => 'ClientController@store', 'as' => 'clients.store'));
	Route::post('clients/{client}', array('uses' => 'ClientController@update', 'as' => 'clients.update'));

	/*
	|--------------------------------------------------------------------------
	| Routes: Invoices
	|--------------------------------------------------------------------------
	*/
	Route::get('invoices', array('uses' => 'InvoiceController@index', 'as' => 'invoices.index'));
	Route::get('invoices/recurring', array('uses' => 'RecurringInvoiceController@index', 'as' => 'invoices.recurring.index'));
	Route::get('invoices/modal/create', array('uses' => 'InvoiceController@modalCreate', 'as' => 'invoices.ajax.modalCreate'));
	Route::get('invoices/modal/copy', array('uses' => 'InvoiceController@modalCopy', 'as' => 'invoices.ajax.modalCopy'));
	Route::get('invoices/modal/create/client', array('uses' => 'InvoiceController@modalCreateByClient', 'as' => 'invoices.ajax.modalCreateByClient'));

	/*
	|--------------------------------------------------------------------------
	| Routes: Quotes
	|--------------------------------------------------------------------------
	*/
	Route::get('quotes', array('uses' => 'QuoteController@index', 'as' => 'quotes.index'));
	Route::get('quotes/modal/create', array('uses' => 'QuoteController@modalCreate', 'as' => 'quotes.ajax.modalCreate'));
	Route::get('quotes/modal/invoice', array('uses' => 'QuoteController@modalQuoteToInvoice', 'as' => 'quotes.ajax.modalQuoteToInvoice'));
	Route::get('quotes/modal/copy', array('uses' => 'QuoteController@modalCopy', 'as' => 'quotes.ajax.modalCopy'));
	Route::get('quotes/modal/create/client', array('uses' => 'QuoteController@modalCreateByClient', 'as' => 'quotes.ajax.modalCreateByClient'));

	/*
	|--------------------------------------------------------------------------
	| Routes: Payments
	|--------------------------------------------------------------------------
	*/
	Route::get('payments', array('uses' => 'PaymentController@index', 'as' => 'payments.index'));
	Route::get('payments/create', array('uses' => 'PaymentController@create', 'as' => 'payments.create'));
	Route::get('payments/modal/create', array('uses' => 'PaymentController@modalCreate', 'as' => 'payments.ajax.modalCreate'));

	/*
	|--------------------------------------------------------------------------
	| Routes: Reports
	|--------------------------------------------------------------------------
	*/
	Route::get('reports/invoice_aging', array('uses' => 'ReportController@invoiceAging', 'as' => 'reports.invoiceAging'));
	Route::get('reports/sales_by_client', array('uses' => 'ReportController@salesByClient', 'as' => 'reports.salesByClient'));
	Route::get('reports/payment_history', array('uses' => 'ReportController@paymentHistory', 'as' => 'reports.paymentHistory'));

	/*
	|--------------------------------------------------------------------------
	| Routes: Custom Fields
	|--------------------------------------------------------------------------
	*/
	Route::get('custom_fields', array('uses' => 'CustomFieldController@index', 'as' => 'customFields.index'));

	/*
	|--------------------------------------------------------------------------
	| Routes: Email Templates
	|--------------------------------------------------------------------------
	*/
	Route::get('email_templates', array('uses' => 'EmailTemplateController@index', 'as' => 'emailTemplates.index'));

	/*
	|--------------------------------------------------------------------------
	| Routes: Import
	|--------------------------------------------------------------------------
	*/
	Route::get('import', array('uses' => 'ImportController@index', 'as' => 'import.index'));

	/*
	|--------------------------------------------------------------------------
	| Routes: Invoice Groups
	|--------------------------------------------------------------------------
	*/
	Route::get('invoice_groups', array('uses' => 'InvoiceGroupController@index', 'as' => 'invoiceGroups.index'));

	/*
	|--------------------------------------------------------------------------
	| Routes: Item Lookups
	|--------------------------------------------------------------------------
	*/
	Route::get('item_lookups', array('uses' => 'ItemLookupController@index', 'as' => 'itemLookups.index'));

	/*
	|--------------------------------------------------------------------------
	| Routes: Payment Methods
	|--------------------------------------------------------------------------
	*/
	Route::get('payment_methods', array('uses' => 'PaymentMethodController@index', 'as' => 'paymentMethods.index'));

	/*
	|--------------------------------------------------------------------------
	| Routes: Settings
	|--------------------------------------------------------------------------
	*/
	Route::get('settings', array('uses' => 'SettingController@index', 'as' => 'settings.index'));

	/*
	|--------------------------------------------------------------------------
	| Routes: Tax Rates
	|--------------------------------------------------------------------------
	*/
	Route::get('tax_rates', array('uses' => 'TaxRateController@index', 'as' => 'taxRates.index'));
	Route::get('tax_rates/create', array('uses' => 'TaxRateController@create', 'as' => 'taxRates.create'));
	Route::get('tax_rates/{taxRate}/edit', array('uses' => 'TaxRateController@edit', 'as' => 'taxRates.edit'));
	Route::get('tax_rates/{id}/delete', array('uses' => 'TaxRateController@delete', 'as' => 'taxRates.delete'));

	Route::post('tax_rates', array('uses' => 'TaxRateController@store', 'as' => 'taxRates.store'));
	Route::post('tax_rates/{taxRate}', array('uses' => 'TaxRateController@update', 'as' => 'taxRates.update'));

	/*
	|--------------------------------------------------------------------------
	| Routes: Users
	|--------------------------------------------------------------------------
	*/
	Route::get('users', array('uses' => 'UserController@index', 'as' => 'users.index'));
});