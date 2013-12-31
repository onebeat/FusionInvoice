<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Validators;

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

	public function validateMulti($inputs, $rulesVar = 'rules')
	{
		$inputs = (array) $inputs;
		foreach ($inputs as $input)
		{
			$input = (array) $input;
			$validator = \Validator::make($input, static::$$rulesVar);
			
			if ($validator->fails())
			{
				$this->errors = $validator->messages();

				return false;
			}
		}

		return true;
	}

	public function errors()
	{
		return $this->errors;
	}
	
}