<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Clients\Validators;

class ClientValidator extends \FI\Validators\Validator {

	/**
	 * The validation rules
	 * @var array
	 */
	static $rules = array(
		'name'	=> 'required'
	);

}