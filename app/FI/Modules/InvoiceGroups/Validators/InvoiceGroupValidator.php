<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\InvoiceGroups\Validators;

class InvoiceGroupValidator extends \FI\Validators\Validator {

	/**
	 * The validation rules
	 * @var array
	 */
	static $rules = array(
		'name'     => 'required',
		'next_id'  => 'required|integer',
		'left_pad' => 'required|numeric'
	);

}