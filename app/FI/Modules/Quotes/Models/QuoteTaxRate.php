<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Quotes\Models;

use FI\Classes\CurrencyFormatter;

class QuoteTaxRate extends \Eloquent {

	/**
	 * Guarded properties
	 * @var array
	 */
	protected $guarded = array('id');

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
   
	public function taxRate()
	{
		return $this->belongsTo('FI\Modules\TaxRates\Models\TaxRate');
	}

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */
   
	public function getFormattedTaxTotalAttribute()
	{
		return CurrencyFormatter::format($this->attributes['tax_total']);
	}

}