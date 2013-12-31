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

use FI\Classes\NumberFormatter;

class ItemValidator extends Validator {

	/**
	 * The validation rules
	 * @var array
	 */
	static $rules = array(
		'item_quantity' => 'numeric',
		'item_price'    => 'numeric'
	);

	/**
	 * Allow multiple validations
	 * @param  array $inputs
	 * @param  string $rulesVar
	 * @return bool
	 */
	public function validateMulti($inputs, $rulesVar = 'rules')
	{
		$inputs = (array) $inputs;

		foreach ($inputs as $input)
		{
			$input = (array) $input;

			$input['item_price'] = NumberFormatter::unformat($input['item_price']);
			$input['item_quantity'] = NumberFormatter::unformat($input['item_quantity']);

			$validator = \Validator::make($input, static::$$rulesVar);

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