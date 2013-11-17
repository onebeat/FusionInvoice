<?php namespace FI\Validators;

class UserValidator extends Validator {

	static $createRules = array(
		'email'    => 'required|email',
		'password' => 'required|confirmed',
		'name'     => 'required'
	);

	static $updateRules = array(
		'email'    => 'required|email',
		'name'     => 'required'
	);

}