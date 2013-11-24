<?php namespace FI\Validators;

use FI\Classes\NumberFormatter;

class ItemValidator extends Validator {
	
	static $rules = array(
		'item_quantity' => 'numeric',
		'item_price'    => 'numeric'
	);

	public function validateMulti($inputs, $rulesVar = 'rules')
	{
		$validateInputs = array();

		foreach ($inputs as $input)
		{
			$input = (array) $input;
			$input['item_price']    = NumberFormatter::unformat($input['item_price']);
			$input['item_quantity'] = NumberFormatter::unformat($input['item_quantity']);

			$validateInputs[] = $input;
		}

		return parent::validateMulti($validateInputs, $rulesVar);
	}

}