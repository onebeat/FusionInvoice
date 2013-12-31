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

class ItemLookupValidator extends Validator {
	
	static $rules = array(
		'name'        => 'required',
		'description' => 'required|numeric',
		'price'       => 'required|numeric'
	);

}