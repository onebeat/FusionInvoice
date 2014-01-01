<?php

Route::group(array('before' => 'auth'), function()
{
	Route::get('tax_rates', array('uses' => 'TaxRateController@index', 'as' => 'taxRates.index'));
	Route::get('tax_rates/create', array('uses' => 'TaxRateController@create', 'as' => 'taxRates.create'));
	Route::get('tax_rates/{taxRate}/edit', array('uses' => 'TaxRateController@edit', 'as' => 'taxRates.edit'));
	Route::get('tax_rates/{taxRate}/delete', array('uses' => 'TaxRateController@delete', 'as' => 'taxRates.delete'));

	Route::post('tax_rates', array('uses' => 'TaxRateController@store', 'as' => 'taxRates.store'));
	Route::post('tax_rates/{taxRate}', array('uses' => 'TaxRateController@update', 'as' => 'taxRates.update'));
});