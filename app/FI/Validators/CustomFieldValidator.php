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

class CustomFieldValidator extends Validator {

	static $rules = array(
		'table_name'  => 'required',
		'field_label' => 'required',
		'field_type'  => 'required'
	);

	static $updateRules = array(
		'field_label' => 'required',
		'field_type'  => 'required'
	);

}