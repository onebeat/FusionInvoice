<?php namespace FI\Storage\Eloquent\Models;

use FI\Classes\CurrencyFormatter;

class QuoteAmount extends \Eloquent {

	protected $guarded = array('id');

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

	public function getFormattedItemSubtotalAttribute()
	{
		return CurrencyFormatter::format($this->attributes['item_subtotal']);
	}

	public function getFormattedItemTaxTotalAttribute()
	{
		return CurrencyFormatter::format($this->attributes['item_tax_total']);
	}

	public function getFormattedTaxTotalAttribute()
	{
		return CurrencyFormatter::format($this->attributes['tax_total']);
	}

	public function getFormattedTotalAttribute()
	{
		return CurrencyFormatter::format($this->attributes['total']);
	}

}