<?php namespace FI\Validators;

class InvoiceGroupValidator extends Validator {

	static $rules = array(
		'name'     => 'required',
		'next_id'  => 'required|integer',
		'left_pad' => 'required|numeric'
	);

}