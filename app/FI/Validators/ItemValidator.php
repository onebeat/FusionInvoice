<?php namespace FI\Validators;

class ItemValidator extends Validator {
	
	static $rules = array(
		'item_name'     => 'required',
		'item_quantity' => 'required|numeric',
		'item_price'    => 'required|numeric'
	);

}