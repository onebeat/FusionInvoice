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
use FI\Classes\NumberFormatter;

class QuoteItem extends \Eloquent {

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
   
    public function amount()
    {
        return $this->hasOne('FI\Modules\Quotes\Models\QuoteItemAmount', 'item_id');
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
   
    public function getFormattedQuantityAttribute()
    {
    	return NumberFormatter::format($this->attributes['quantity']);
    }

    public function getFormattedNumericPriceAttribute()
    {
    	return NumberFormatter::format($this->attributes['price']);
    }

    public function getFormattedPriceAttribute()
    {
    	return CurrencyFormatter::format($this->attributes['price']);
    }

}