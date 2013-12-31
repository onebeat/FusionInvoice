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

class ClientCustom extends \Eloquent {

	protected $table      = 'clients_custom';
	protected $primaryKey = 'client_id';
	protected $guarded    = array();

}