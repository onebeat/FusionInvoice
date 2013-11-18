<?php namespace FI\Validators;

class InvoiceValidator extends Validator {

	static $createRules = array(
		'created_at'       => 'required',
		'client_name'      => 'required',
		'invoice_group_id' => 'required'
	);

	static $updateRules = array(
		'created_at'        => 'required',
		'due_at'            => 'required',
		'number'            => 'required',
		'invoice_status_id' => 'required'
	);

}