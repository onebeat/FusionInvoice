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

class TaxRateValidator extends Validator {

	/**
	 * The validation rules
	 * @var array
	 */
	static $rules = array(
		'name'    => 'required',
		'percent' => 'required|numeric'
	);

	// @TODO - This doesn't belong here
	public function validate($input, $rulesVar = 'rules')
	{
		$input['percent'] = NumberFormatter::unformat($input['percent']);

		return parent::validate($input, $rulesVar);
	}

}