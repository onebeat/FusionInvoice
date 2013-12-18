<?php namespace FI\Validators;

class CustomFieldValidator extends Validator {

	static $rules = array(
		'table_name'  => 'required',
		'field_label' => 'required',
		'field_type'  => 'required'
	);

}