<?php namespace FI\Validators;

class SessionValidator extends Validator {

	static $rules = array(
		'email'    => 'required',
		'password' => 'required'
	);

}