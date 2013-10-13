<?php namespace FI\Validators;

class SessionValidator extends Validator {

	static $rules = [
		'email'	=> 'required',
		'password' => 'required'
	];

}