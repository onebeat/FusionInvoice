<?php

/*
|--------------------------------------------------------------------------
| Sessions
|--------------------------------------------------------------------------
*/

Route::get('login', array('uses' => 'SessionController@login', 'as' => 'session.login'));
Route::post('login', array('uses' => 'SessionController@attempt', 'as' => 'session.attempt'));
Route::get('logout', array('uses' => 'SessionController@logout', 'as' => 'session.logout'));

/*
|--------------------------------------------------------------------------
| Public Document Routes
|--------------------------------------------------------------------------
*/

Route::get('public/quote/{quoteKey}', array('uses' => 'PublicQuoteController@show', 'as' => 'public.quote.show'));
Route::get('public/invoice/{invoiceKey}', array('uses' => 'PublicInvoiceController@show', 'as' => 'public.invoice.show'));

Route::group(array('before' => 'auth'), function()
{
	/*
	|--------------------------------------------------------------------------
	| Clients
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
	| Custom Fields
	|--------------------------------------------------------------------------
	*/

	Route::get('custom_fields', array('uses' => 'CustomFieldController@index', 'as' => 'customFields.index'));
	Route::get('custom_fields/create', array('uses' => 'CustomFieldController@create', 'as' => 'customFields.create'));
	Route::get('custom_fields/{customField}/edit', array('uses' => 'CustomFieldController@edit', 'as' => 'customFields.edit'));
	Route::get('custom_fields/{customField}/delete', array('uses' => 'CustomFieldController@delete', 'as' => 'customFields.delete'));

	Route::post('custom_fields', array('uses' => 'CustomFieldController@store', 'as' => 'customFields.store'));
	Route::post('custom_fields/{customField}', array('uses' => 'CustomFieldController@update', 'as' => 'customFields.update'));

	/*
	|--------------------------------------------------------------------------
	| Dashboard
	|--------------------------------------------------------------------------
	*/

	Route::get('/', 'DashboardController@index');
	Route::get('dashboard', array('uses' => 'DashboardController@index', 'as' => 'dashboard.index'));

	/*
	|--------------------------------------------------------------------------
	| Invoice Groups
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
	| Invoices
	|--------------------------------------------------------------------------
	*/

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

	/*
	|--------------------------------------------------------------------------
	| Item Lookups
	|--------------------------------------------------------------------------
	*/
	Route::get('item_lookups', array('uses' => 'ItemLookupController@index', 'as' => 'itemLookups.index'));
	Route::get('item_lookups/create', array('uses' => 'ItemLookupController@create', 'as' => 'itemLookups.create'));
	Route::get('item_lookups/{itemLookup}/edit', array('uses' => 'ItemLookupController@edit', 'as' => 'itemLookups.edit'));
	Route::get('item_lookups/{itemLookup}/delete', array('uses' => 'ItemLookupController@delete', 'as' => 'itemLookups.delete'));
	Route::get('item_lookups/modal/add_lookup_item', array('uses' => 'ItemLookupController@modalAddLookupItem', 'as' => 'itemLookups.ajax.modalAddLookupItem'));

	Route::post('item_lookups', array('uses' => 'ItemLookupController@store', 'as' => 'itemLookups.store'));
	Route::post('item_lookups/{itemLookup}', array('uses' => 'ItemLookupController@update', 'as' => 'itemLookups.update'));
	Route::post('item_lookups/ajax/process', array('uses' => 'ItemLookupController@process', 'as' => 'itemLookups.ajax.process'));

	/*
	|--------------------------------------------------------------------------
	| Payment Methods
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
	| Payments
	|--------------------------------------------------------------------------
	*/

	Route::get('payments', array('uses' => 'PaymentController@index', 'as' => 'payments.index'));
	Route::get('payments/{payment}/invoice/{invoice}', array('uses' => 'PaymentController@edit', 'as' => 'payments.edit'));
	Route::get('payments/{payment}/invoice/{invoice}/delete', array('uses' => 'PaymentController@delete', 'as' => 'payments.delete'));

	Route::post('payments/modal/enter_payment', array('uses' => 'PaymentController@modalEnterPayment', 'as' => 'payments.ajax.modalEnterPayment'));
	Route::post('payments/modal/mail', array('uses' => 'PaymentController@modalMailPayment', 'as' => 'payments.ajax.modalMailPayment'));
	Route::post('payments/mail', array('uses' => 'PaymentController@mailPayment', 'as' => 'payments.ajax.mailPayment'));
	Route::post('payments/ajax/create', array('uses' => 'PaymentController@ajaxStore', 'as' => 'payments.ajax.store'));
	Route::post('payments/{payment}/invoice/{invoice}/update', array('uses' => 'PaymentController@update', 'as' => 'payments.update'));

	/*
	|--------------------------------------------------------------------------
	| Quotes
	|--------------------------------------------------------------------------
	*/

	Route::get('quotes/status/{status?}', array('uses' => 'QuoteController@index', 'as' => 'quotes.index'));
	Route::get('quotes/modal/create', array('uses' => 'QuoteController@modalCreate', 'as' => 'quotes.ajax.modalCreate'));
	Route::get('quotes/{quote}', array('uses' => 'QuoteController@show', 'as' => 'quotes.show'));
	Route::get('quotes/{quote}/preview', array('uses' => 'QuoteController@preview', 'as' => 'quotes.preview'));
	Route::get('quotes/{quote}/tax_rates/{tax_rate}/delete', array('uses' => 'QuoteController@deleteQuoteTax', 'as' => 'quotes.ajax.deleteQuoteTax'));
	Route::get('quotes/{quote}/items/{item}/delete', array('uses' => 'QuoteController@deleteItem', 'as' => 'quotes.items.delete'));
	Route::get('quotes/{quote}/delete', array('uses' => 'QuoteController@delete', 'as' => 'quotes.delete'));

	Route::post('quotes/modal/add_quote_tax', array('uses' => 'QuoteController@modalAddQuoteTax', 'as' => 'quotes.ajax.modalAddQuoteTax'));
	Route::post('quotes/modal/save_quote_tax', array('uses' => 'QuoteController@saveQuoteTax', 'as' => 'quotes.ajax.saveQuoteTax'));
	Route::post('quotes/modal/quote_to_invoice', array('uses' => 'QuoteController@modalQuoteToInvoice', 'as' => 'quotes.ajax.modalQuoteToInvoice'));
	Route::post('quotes/quote_to_invoice', array('uses' => 'QuoteController@quoteToInvoice', 'as' => 'quotes.ajax.quoteToInvoice'));
	Route::post('quotes/modal/copy_quote', array('uses' => 'QuoteController@modalCopyQuote', 'as' => 'quotes.ajax.modalCopyQuote'));
	Route::post('quotes/modal/mail', array('uses' => 'QuoteController@modalMailQuote', 'as' => 'quotes.ajax.modalMailQuote'));
	Route::post('quotes/mail', array('uses' => 'QuoteController@mailQuote', 'as' => 'quotes.ajax.mailQuote'));
	Route::post('quotes/ajax/copy_quote', array('uses' => 'QuoteController@copyQuote', 'as' => 'quotes.ajax.copyQuote'));
	Route::post('quotes/create', array('uses' => 'QuoteController@store', 'as' => 'quotes.store'));
	Route::post('quotes/{quote}/update', array('uses' => 'QuoteController@update', 'as' => 'quotes.update'));

	/*
	|--------------------------------------------------------------------------
	| Reports
	|--------------------------------------------------------------------------
	*/

	Route::get('reports/item_sales', array('uses' => 'ItemSalesReportController@index', 'as' => 'reports.itemSales'));
	Route::post('reports/item_sales', array('uses' => 'ItemSalesReportController@ajaxRunReport', 'as' => 'reports.itemSales.ajax.run'));
	Route::get('reports/payments_collected', array('uses' => 'PaymentsCollectedReportController@index', 'as' => 'reports.paymentsCollected'));
	Route::post('reports/payments_collected', array('uses' => 'PaymentsCollectedReportController@ajaxRunReport', 'as' => 'reports.paymentsCollected.ajax.run'));
	Route::get('reports/revenue_by_client', array('uses' => 'RevenueByClientReportController@index', 'as' => 'reports.revenueByClient'));
	Route::post('reports/revenue_by_client', array('uses' => 'RevenueByClientReportController@ajaxRunReport', 'as' => 'reports.revenueByClient.ajax.run'));
	Route::get('reports/tax_summary', array('uses' => 'TaxSummaryReportController@index', 'as' => 'reports.taxSummary'));
	Route::post('reports/tax_summary', array('uses' => 'TaxSummaryReportController@ajaxRunReport', 'as' => 'reports.taxSummary.ajax.run'));

	/*
	|--------------------------------------------------------------------------
	| Settings
	|--------------------------------------------------------------------------
	*/

	Route::get('settings', array('uses' => 'SettingController@index', 'as' => 'settings.index'));
	Route::post('settings', array('uses' => 'SettingController@update', 'as' => 'settings.update'));

	/*
	|--------------------------------------------------------------------------
	| Tax Rates
	|--------------------------------------------------------------------------
	*/

	Route::get('tax_rates', array('uses' => 'TaxRateController@index', 'as' => 'taxRates.index'));
	Route::get('tax_rates/create', array('uses' => 'TaxRateController@create', 'as' => 'taxRates.create'));
	Route::get('tax_rates/{taxRate}/edit', array('uses' => 'TaxRateController@edit', 'as' => 'taxRates.edit'));
	Route::get('tax_rates/{taxRate}/delete', array('uses' => 'TaxRateController@delete', 'as' => 'taxRates.delete'));

	Route::post('tax_rates', array('uses' => 'TaxRateController@store', 'as' => 'taxRates.store'));
	Route::post('tax_rates/{taxRate}', array('uses' => 'TaxRateController@update', 'as' => 'taxRates.update'));

	/*
	|--------------------------------------------------------------------------
	| Users
	|--------------------------------------------------------------------------
	*/

	Route::get('users', array('uses' => 'UserController@index', 'as' => 'users.index'));
	Route::get('users/create', array('uses' => 'UserController@create', 'as' => 'users.create'));
	Route::get('users/{user}/edit', array('uses' => 'UserController@edit', 'as' => 'users.edit'));
	Route::get('users/{user}', array('uses' => 'UserController@show', 'as' => 'users.show'));
	Route::get('users/{user}/delete', array('uses' => 'UserController@delete', 'as' => 'users.delete'));

	Route::post('users', array('uses' => 'UserController@store', 'as' => 'users.store'));
	Route::post('users/{user}', array('uses' => 'UserController@update', 'as' => 'users.update'));

});