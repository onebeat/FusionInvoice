<?php namespace FI\Validators;

class ItemValidator extends Validator {
	
	static $rules = array(
		'item_quantity' => 'numeric',
		'item_price'    => 'numeric'
	);

	public function validateMulti($inputs, $rulesVar = 'rules')
	{
		$inputs = (array) $inputs;
		foreach ($inputs as $input)
		{
			$input = (array) $input;
			$validator = \Validator::make($input, static::$$rulesVar);

			// @TODO - revisit these later to come up with a better way...
			$validator->sometimes('item_name', 'required', function($input)
			{
				if ($input['item_quantity'] or $input['item_price'])
				{
					return true;
				}
			});

			$validator->sometimes('item_price', 'required', function($input)
			{
				if ($input['item_quantity'] or $input['item_name'])
				{
					return true;
				}
			});

			$validator->sometimes('item_quantity', 'required', function($input)
			{
				if ($input['item_name'] or $input['item_price'])
				{
					return true;
				}
			});
			
			if ($validator->fails())
			{
				$this->errors = $validator->messages();

				return false;
			}
		}

		return true;
	}

}