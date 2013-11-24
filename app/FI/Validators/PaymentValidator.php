<?php namespace FI\Validators;

use FI\Classes\NumberFormatter;

class PaymentValidator extends Validator {
	
	static $rules = array(
		'invoice_id'        => 'required',
		'amount'            => 'required|numeric',
		'payment_method_id' => 'required'
	);

	public function validate($input, $rulesVar = 'rules')
	{
		$input['amount'] = NumberFormatter::unformat($input['amount']);

		return parent::validate($input, $rulesVar);
	}

}