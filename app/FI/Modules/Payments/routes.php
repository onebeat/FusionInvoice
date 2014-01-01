<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::group(array('before' => 'auth'), function()
{
	Route::get('payments', array('uses' => 'PaymentController@index', 'as' => 'payments.index'));
	Route::get('payments/{payment}/invoice/{invoice}', array('uses' => 'PaymentController@edit', 'as' => 'payments.edit'));
	Route::get('payments/{payment}/invoice/{invoice}/delete', array('uses' => 'PaymentController@delete', 'as' => 'payments.delete'));

	Route::post('payments/modal/enter_payment', array('uses' => 'PaymentController@modalEnterPayment', 'as' => 'payments.ajax.modalEnterPayment'));
	Route::post('payments/modal/mail', array('uses' => 'PaymentController@modalMailPayment', 'as' => 'payments.ajax.modalMailPayment'));
	Route::post('payments/mail', array('uses' => 'PaymentController@mailPayment', 'as' => 'payments.ajax.mailPayment'));
	Route::post('payments/ajax/create', array('uses' => 'PaymentController@ajaxStore', 'as' => 'payments.ajax.store'));
	Route::post('payments/{payment}/invoice/{invoice}/update', array('uses' => 'PaymentController@update', 'as' => 'payments.update'));
});