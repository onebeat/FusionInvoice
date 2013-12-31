<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Storage\Eloquent\Models;

class PaymentCustom extends \Eloquent {

	protected $table      = 'payments_custom';
	protected $primaryKey = 'payment_id';
	protected $guarded    = array();

}