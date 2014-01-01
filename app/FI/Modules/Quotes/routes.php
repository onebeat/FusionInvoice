<?php

Route::get('public/quote/{quoteKey}', array('uses' => 'PublicQuoteController@show', 'as' => 'public.quote.show'));

Route::group(array('before' => 'auth'), function()
{
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
});