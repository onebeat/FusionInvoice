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

class UserValidator extends Validator {

	/**
	 * The validation create rules
	 * @var array
	 */
	static $createRules = array(
		'email'    => 'required|email',
		'password' => 'required|confirmed',
		'name'     => 'required'
	);

	/**
	 * The validation update rules
	 * @var array
	 */
	static $updateRules = array(
		'email'    => 'required|email',
		'name'     => 'required'
	);

}