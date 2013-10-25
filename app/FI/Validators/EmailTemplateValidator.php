<?php namespace FI\Validators;

class EmailTemplateValidator extends Validator {

	static $rules = array(
		'name'    => 'required',
		'subject' => 'required',
		'body'    => 'required'
	);

}