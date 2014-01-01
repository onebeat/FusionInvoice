<?php

Route::group(array('before' => 'auth'), function()
{
	Route::get('payment_methods', array('uses' => 'PaymentMethodController@index', 'as' => 'paymentMethods.index'));
	Route::get('payment_methods/create', array('uses' => 'PaymentMethodController@create', 'as' => 'paymentMethods.create'));
	Route::get('payment_methods/{paymentMethod}/edit', array('uses' => 'PaymentMethodController@edit', 'as' => 'paymentMethods.edit'));
	Route::get('payment_methods/{paymentMethod}/delete', array('uses' => 'PaymentMethodController@delete', 'as' => 'paymentMethods.delete'));

	Route::post('payment_methods', array('uses' => 'PaymentMethodController@store', 'as' => 'paymentMethods.store'));
	Route::post('payment_methods/{paymentMethod}', array('uses' => 'PaymentMethodController@update', 'as' => 'paymentMethods.update'));
});