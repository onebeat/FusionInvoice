<?php namespace FI\Storage\Eloquent\Models;

use FI\Classes\Currency;

class InvoiceItem extends \Eloquent {

	protected $guarded = array('id');

    public function amount()
    {
        return $this->hasOne('FI\Storage\Eloquent\Models\InvoiceItemAmount', 'item_id');
    }

    public function getFormattedPriceAttribute()
    {
    	return Currency::format($this->attributes['price']);
    }

}