<?php namespace FI\Validators;

class EmailTemplateValidator extends Validator {

	static $rules = [
		'name'	=> 'required',
		'subject' => 'required',
		'body' => 'required'
	];

}