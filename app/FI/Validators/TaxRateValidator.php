<?php namespace FI\Validators;

class TaxRateValidator extends Validator {

	static $rules = array(
		'name'    => 'required',
		'percent' => 'required|numeric'
	);

}