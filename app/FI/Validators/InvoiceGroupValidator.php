<?php namespace FI\Validators;

class InvoiceGroupValidator extends Validator {

	static $rules = [
		'name'	=> 'required',
		'next_id' => 'required|integer',
		'left_pad' => 'required|numeric'
	];

}