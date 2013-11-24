<?php

use FI\Storage\Interfaces\PaymentRepositoryInterface;
use FI\Validators\PaymentValidator;
use FI\Classes\NumberFormatter;

class PaymentController extends BaseController {

	protected $payment;
	protected $validator;
	
	public function __construct(PaymentRepositoryInterface $payment, PaymentValidator $validator)
	{
		$this->payment   = $payment;
		$this->validator = $validator;
	}

	/**
	 * Display the enter payment modal form
	 * @return View
	 */
	public function modalEnterPayment()
	{
		$paymentMethod = App::make('FI\Storage\Interfaces\PaymentMethodRepositoryInterface');

		$date = FI\Classes\Date::format();
		
		return View::make('payments._modal_enter_payment')
		->with('invoice_id', Input::get('invoice_id'))
		->with('balance', Input::get('balance'))
		->with('date', $date)
		->with('paymentMethods', $paymentMethod->all())
		->with('redirectTo', Input::get('redirectTo'));
	}

	public function ajaxStore()
	{
		$input = Input::all();

		if (!$this->validator->validate($input))
		{
			return json_encode(array('success' => 0, 'message' => $this->validator->errors()->first()));
		}

		$this->payment->create($input);

		\Event::fire('invoice.payment.created', array(\FI\Classes\NumberFormatter::unformat($input['amount']), $input['invoice_id']));

		return json_encode(array('success' => 1));

	}

}