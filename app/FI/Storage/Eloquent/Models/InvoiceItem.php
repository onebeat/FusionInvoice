<?php namespace FI\Storage\Eloquent\Models;

use FI\Classes\CurrencyFormatter;
use FI\Classes\NumberFormatter;

class InvoiceItem extends \Eloquent {

	protected $guarded = array('id');

    public function amount()
    {
        return $this->hasOne('FI\Storage\Eloquent\Models\InvoiceItemAmount', 'item_id');
    }

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