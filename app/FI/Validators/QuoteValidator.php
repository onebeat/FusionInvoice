<?php namespace FI\Validators;

class QuoteValidator extends Validator {

	static $createRules = array(
		'created_at'       => 'required',
		'client_name'      => 'required',
		'invoice_group_id' => 'required'
	);

	static $updateRules = array(
		'created_at'      => 'required',
		'expires_at'      => 'required',
		'number'          => 'required',
		'quote_status_id' => 'required'
	);

}