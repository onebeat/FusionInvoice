<?php namespace FI\Validators;

class TaxRateValidator extends Validator {

	static $rules = [
		'name'	=> 'required',
		'percent' => 'required|numeric'
	];

}