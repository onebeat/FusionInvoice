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

use FI\Classes\NumberFormatter;

class TaxRate extends \Eloquent {

	protected $guarded = array('id');

	public function getFormattedPercentAttribute()
	{
		return NumberFormatter::format($this->attributes['percent']) . '%';
	}

	public function getFormattedNumericPercentAttribute()
	{
		return NumberFormatter::format($this->attributes['percent']);
	}

}