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

class InvoiceCustom extends \Eloquent {

	protected $table      = 'invoices_custom';
	protected $primaryKey = 'invoice_id';
	protected $guarded    = array();

}