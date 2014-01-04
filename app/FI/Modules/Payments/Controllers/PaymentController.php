<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Payments\Controllers;

use App;
use Config;
use Input;
use Mail;
use Redirect;
use View;

use FI\Classes\Date;
use FI\Classes\NumberFormatter;
use FI\Classes\CustomFields;

class PaymentController extends \BaseController {

	/**
	 * Payment repository
	 * @var PaymentRepository
	 */
	protected $payment;

	/**
	 * Payment validator
	 * @var PaymentValidator
	 */
	protected $validator;
	
	/**
	 * Dependency injection
	 * @param PaymentRepository $payment
	 * @param PaymentValidator $validator
	 */
	public function __construct($payment, $validator)
	{
		$this->payment       = $payment;
		$this->validator     = $validator;
	}

	/**
	 * Display paginated list
	 * @return View
	 */
	public function index()
	{
		$payments = $this->payment->getPaged(Input::get('page'));

		return View::make('payments.index')
		->with('payments', $payments);
	}

	/**
	 * Display form for existing record
	 * @param  int $paymentId
	 * @param  int $invoiceId
	 * @return View
	 */
	public function edit($paymentId, $invoiceId)
	{
		$invoice = App::make('InvoiceRepository');

		$payment = $this->payment->find($paymentId);
		$invoice = $invoice->find($invoiceId);
		
		return View::make('payments.form')
		->with('editMode', true)
		->with('payment', $payment)
		->with('paymentMethods', App::make('PaymentMethodRepository')->lists())
		->with('invoice', $invoice)
		->with('customFields', App::make('CustomFieldRepository')->getByTable('payments'));;
	}

	/**
	 * Validate and handle existing record form submission
	 * @param  int $paymentId
	 * @param  int $invoiceId
	 * @return RedirectResponse
	 */
	public function update($paymentId, $invoiceId)
	{
		$input = Input::all();

		if (Input::has('custom'))
		{
			$custom = $input['custom'];
			unset($input['custom']);
		}

		if (!$this->validator->validate($input))
		{
			return Redirect::route('payments.edit', array($paymentId, $invoiceId))
			->with('editMode', true)
			->withErrors($this->validator->errors())
			->withInput();
		}

		$input['paid_at'] = Date::unformat($input['paid_at']);
		$input['amount']  = NumberFormatter::unformat($input['amount']);

		$this->payment->update($input, $paymentId);

		if (Input::has('custom'))
		{
			App::make('PaymentCustomRepository')->save($custom, $paymentId);
		}

		return Redirect::route('payments.index')
		->with('alertInfo', trans('fi.record_successfully_updated'));
	}

	/**
	 * Delete a record
	 * @param  int $paymentId
	 * @param  int $invoiceId
	 * @return RedirectResponse
	 */
	public function delete($paymentId, $invoiceId)
	{
		$this->payment->delete($paymentId);

		return Redirect::route('payments.index')
		->with('alert', trans('fi.record_successfully_deleted'));
	}

	/**
	 * Display the enter payment modal form
	 * @return View
	 */
	public function modalEnterPayment()
	{
		$date = Date::format();
		
		return View::make('payments._modal_enter_payment')
		->with('invoice_id', Input::get('invoice_id'))
		->with('balance', Input::get('balance'))
		->with('date', $date)
		->with('paymentMethods', App::make('PaymentMethodRepository')->all())
		->with('redirectTo', Input::get('redirectTo'));
	}

	/**
	 * Attempt to save payment from modal
	 * @return json
	 */
	public function ajaxStore()
	{
		$input = Input::all();

		if (!$this->validator->validate($input))
		{
			return json_encode(array('success' => 0, 'message' => $this->validator->errors()->first()));
		}

		$input['paid_at'] = Date::unformat($input['paid_at']);
		$input['amount']  = NumberFormatter::unformat($input['amount']);

		$this->payment->create($input);

		return json_encode(array('success' => 1));
	}

	/**
	 * Display the modal to send mail
	 * @return View
	 */
	public function modalMailPayment()
	{
		$payment = $this->payment->find(Input::get('payment_id'));

		return View::make('payments._modal_mail')
		->with('paymentId', $payment->id)
		->with('redirectTo', Input::get('redirectTo'))
		->with('to', $payment->invoice->client->email)
		->with('cc', \Config::get('fi.mailCcDefault'))
		->with('subject', trans('fi.payment_receipt_for_invoice', array('invoiceNumber' => $payment->invoice->number)));
	}

	/**
	 * Attempt to send the mail
	 * @return json
	 */
	public function mailPayment()
	{
		$payment = $this->payment->find(Input::get('payment_id'));

		try
		{
			Mail::send('templates.emails.payment_receipt', array('payment' => $payment), function($message) use ($payment)
			{
				$message->from($payment->invoice->user->email)
				->to(Input::get('to'), $payment->invoice->client->name)
				->subject(Input::get('subject'));
			});

			return json_encode(array('success' => 1));
		}
		catch (Exception $e)
		{
			return json_encode(array('success' => 0, 'message' => $e->getMessage()));
		}
	}

}