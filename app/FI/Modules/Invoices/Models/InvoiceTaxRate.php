<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Invoices\Models;

use FI\Classes\CurrencyFormatter;

class InvoiceTaxRate extends \Eloquent {

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
   
   	public function invoice()
   	{
   		return $this->belongsTo('FI\Modules\Invoices\Models\Invoice');
   	}

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

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeByInvoiceDateRange($query, $from, $to)
    {
        return $query->whereIn('invoice_id', function($query) use ($from, $to) {
            $query->select('id')
            ->from('invoices')
            ->where('created_at', '>=', $from)
            ->where('created_at', '<=', $to);
        });
    }

}