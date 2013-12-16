<?php namespace FI\Validators;

class ClientNoteValidator extends Validator {

	static $rules = array(
		'client_id' => 'required',
		'note'      => 'required'
	);

}