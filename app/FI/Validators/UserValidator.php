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

	static $createRules = array(
		'email'    => 'required|email',
		'password' => 'required|confirmed',
		'name'     => 'required'
	);

	static $updateRules = array(
		'email'    => 'required|email',
		'name'     => 'required'
	);

}