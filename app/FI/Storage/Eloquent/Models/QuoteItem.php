<?php namespace FI\Storage\Eloquent\Models;

use FI\Classes\Currency;

class QuoteItem extends \Eloquent {

	protected $guarded = array('id');

    public function amount()
    {
        return $this->hasOne('FI\Storage\Eloquent\Models\QuoteItemAmount', 'item_id');
    }

    public function getFormattedPriceAttribute()
    {
    	return Currency::format($this->attributes['price']);
    }

}