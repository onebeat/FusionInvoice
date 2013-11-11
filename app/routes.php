<?php

// @TODO - Yeah this doesn't belong here either but come on
App::before(function($request)
{
	$settings = App::make('FI\Storage\Interfaces\SettingRepositoryInterface');
	$settings->setAll();
});

/*
|--------------------------------------------------------------------------
| Routes: Sessions
|--------------------------------------------------------------------------
*/

Route::get('login', array('uses' => 'SessionController@login', 'as' => 'session.login'));
Route::post('login', array('uses' => 'SessionController@attempt', 'as' => 'session.attempt'));
Route::get('logout', array('uses' => 'SessionController@logout', 'as' => 'session.logout'));

/*
|--------------------------------------------------------------------------
| Routes: Public Document Routes
|--------------------------------------------------------------------------
*/

Route::get('public/quote/{quoteKey}', array('uses' => 'PublicQuoteController@show', 'as' => 'public.quote.show'));

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

	Route::post('clients/ajax/name_lookup', array('uses' => 'ClientController@ajaxNameLookup', 'as' => 'clients.ajax.nameLookup'));

	Route::post('clients/ajax/save_note', array('uses' => 'ClientController@ajaxSaveNote', 'as' => 'clients.ajax.saveNote'));
	Route::post('clients/ajax/load_notes', array('uses' => 'ClientController@ajaxLoadNotes', 'as' => 'clients.ajax.loadNotes'));
	Route::post('clients', array('uses' => 'ClientController@store', 'as' => 'clients.store'));
	Route::post('clients/{client}', array('uses' => 'ClientController@update', 'as' => 'clients.update'));

	/*
	|--------------------------------------------------------------------------
	| Routes: Quotes
	|--------------------------------------------------------------------------
	*/

	Route::get('quotes/status/{status?}', array('uses' => 'QuoteController@index', 'as' => 'quotes.index'));
	Route::get('quotes/modal/create', array('uses' => 'QuoteController@modalCreate', 'as' => 'quotes.ajax.modalCreate'));
	Route::get('quotes/modal/lookup_item', array('uses' => 'QuoteController@modalAddLookupItem', 'as' => 'quotes.ajax.modalAddLookupItem'));
	Route::get('quotes/{quote}', array('uses' => 'QuoteController@show', 'as' => 'quotes.show'));
	Route::get('quotes/{quote}/preview', array('uses' => 'QuoteController@preview', 'as' => 'quotes.preview'));
	Route::get('quotes/{quote}/tax_rates/{tax_rate}/delete', array('uses' => 'QuoteController@deleteQuoteTax', 'as' => 'quotes.ajax.deleteQuoteTax'));
	Route::get('quotes/{quote}/items/{item}/delete', array('uses' => 'QuoteController@deleteItem', 'as' => 'quotes.items.delete'));
	Route::get('quotes/{quote}/delete', array('uses' => 'QuoteController@delete', 'as' => 'quotes.delete'));

	Route::post('quotes/modal/add_quote_tax', array('uses' => 'QuoteController@modalAddQuoteTax', 'as' => 'quotes.ajax.modalAddQuoteTax'));
	Route::post('quotes/modal/save_quote_tax', array('uses' => 'QuoteController@saveQuoteTax', 'as' => 'quotes.ajax.saveQuoteTax'));
	Route::post('quotes/create', array('uses' => 'QuoteController@store', 'as' => 'quotes.store'));
	Route::post('quotes/{quote}/update', array('uses' => 'QuoteController@update', 'as' => 'quotes.update'));

	/*
	|--------------------------------------------------------------------------
	| Routes: Email Templates
	|--------------------------------------------------------------------------
	*/

	Route::get('email_templates', array('uses' => 'EmailTemplateController@index', 'as' => 'emailTemplates.index'));
	Route::get('email_templates/create', array('uses' => 'EmailTemplateController@create', 'as' => 'emailTemplates.create'));
	Route::get('email_templates/{emailTemplate}/edit', array('uses' => 'EmailTemplateController@edit', 'as' => 'emailTemplates.edit'));
	Route::get('email_templates/{emailTemplate}/delete', array('uses' => 'EmailTemplateController@delete', 'as' => 'emailTemplates.delete'));

	Route::post('email_templates', array('uses' => 'EmailTemplateController@store', 'as' => 'emailTemplates.store'));
	Route::post('email_templates/{emailTemplate}', array('uses' => 'EmailTemplateController@update', 'as' => 'emailTemplates.update'));

	/*
	|--------------------------------------------------------------------------
	| Routes: Invoice Groups
	|--------------------------------------------------------------------------
	*/

	Route::get('invoice_groups', array('uses' => 'InvoiceGroupController@index', 'as' => 'invoiceGroups.index'));
	Route::get('invoice_groups/create', array('uses' => 'InvoiceGroupController@create', 'as' => 'invoiceGroups.create'));
	Route::get('invoice_groups/{invoiceGroup}/edit', array('uses' => 'InvoiceGroupController@edit', 'as' => 'invoiceGroups.edit'));
	Route::get('invoice_groups/{invoiceGroup}/delete', array('uses' => 'InvoiceGroupController@delete', 'as' => 'invoiceGroups.delete'));

	Route::post('invoice_groups', array('uses' => 'InvoiceGroupController@store', 'as' => 'invoiceGroups.store'));
	Route::post('invoice_groups/{invoiceGroup}', array('uses' => 'InvoiceGroupController@update', 'as' => 'invoiceGroups.update'));

	/*
	|--------------------------------------------------------------------------
	| Routes: Payment Methods
	|--------------------------------------------------------------------------
	*/

	Route::get('payment_methods', array('uses' => 'PaymentMethodController@index', 'as' => 'paymentMethods.index'));
	Route::get('payment_methods/create', array('uses' => 'PaymentMethodController@create', 'as' => 'paymentMethods.create'));
	Route::get('payment_methods/{paymentMethod}/edit', array('uses' => 'PaymentMethodController@edit', 'as' => 'paymentMethods.edit'));
	Route::get('payment_methods/{paymentMethod}/delete', array('uses' => 'PaymentMethodController@delete', 'as' => 'paymentMethods.delete'));

	Route::post('payment_methods', array('uses' => 'PaymentMethodController@store', 'as' => 'paymentMethods.store'));
	Route::post('payment_methods/{paymentMethod}', array('uses' => 'PaymentMethodController@update', 'as' => 'paymentMethods.update'));

	/*
	|--------------------------------------------------------------------------
	| Routes: Settings
	|--------------------------------------------------------------------------
	*/

	Route::get('settings', array('uses' => 'SettingController@index', 'as' => 'settings.index'));
	Route::post('settings', array('uses' => 'SettingController@update', 'as' => 'settings.update'));

	/*
	|--------------------------------------------------------------------------
	| Routes: Tax Rates
	|--------------------------------------------------------------------------
	*/

	Route::get('tax_rates', array('uses' => 'TaxRateController@index', 'as' => 'taxRates.index'));
	Route::get('tax_rates/create', array('uses' => 'TaxRateController@create', 'as' => 'taxRates.create'));
	Route::get('tax_rates/{taxRate}/edit', array('uses' => 'TaxRateController@edit', 'as' => 'taxRates.edit'));
	Route::get('tax_rates/{taxRate}/delete', array('uses' => 'TaxRateController@delete', 'as' => 'taxRates.delete'));

	Route::post('tax_rates', array('uses' => 'TaxRateController@store', 'as' => 'taxRates.store'));
	Route::post('tax_rates/{taxRate}', array('uses' => 'TaxRateController@update', 'as' => 'taxRates.update'));

});