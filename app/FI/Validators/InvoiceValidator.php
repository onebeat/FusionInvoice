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