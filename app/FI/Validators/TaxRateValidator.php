<?php namespace FI\Validators;

use FI\Classes\NumberFormatter;

class TaxRateValidator extends Validator {

	static $rules = array(
		'name'    => 'required',
		'percent' => 'required|numeric'
	);

	public function validate($input, $rulesVar = 'rules')
	{
		$input['percent'] = NumberFormatter::unformat($input['percent']);

		return parent::validate($input, $rulesVar);
	}

}