<?php namespace FI\Validators;

class ItemLookupValidator extends Validator {
	
	static $rules = array(
		'name'        => 'required',
		'description' => 'required|numeric',
		'price'       => 'required|numeric'
	);

}