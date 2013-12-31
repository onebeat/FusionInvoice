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

class PaymentValidator extends Validator {
	
	static $rules = array(
		'invoice_id'        => 'required',
		'paid_at'           => 'required',
		'amount'            => 'required|numeric',
		'payment_method_id' => 'required'
	);

	public function validate($input, $rulesVar = 'rules')
	{
		$input['amount'] = NumberFormatter::unformat($input['amount']);

		return parent::validate($input, $rulesVar);
	}

}