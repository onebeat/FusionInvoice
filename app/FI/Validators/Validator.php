<?php namespace FI\Validators;

abstract class Validator {
	
	protected $errors;
	
	public function validate($input, $rulesVar = 'rules')
	{
		$validator = \Validator::make($input, static::$$rulesVar);
		
		if ($validator->fails())
		{
			$this->errors = $validator->messages();

			return false;
		}

		return true;
	}

	public function errors()
	{
		return $this->errors;
	}
	
}