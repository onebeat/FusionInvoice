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

	/**
	 * The validation create rules
	 * @var array
	 */
	static $rules = array(
		'table_name'  => 'required',
		'field_label' => 'required',
		'field_type'  => 'required'
	);

	/**
	 * The validation update rules
	 * @var array
	 */
	static $updateRules = array(
		'field_label' => 'required',
		'field_type'  => 'required'
	);

}