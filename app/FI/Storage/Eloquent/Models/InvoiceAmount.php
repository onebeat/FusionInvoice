<?php namespace FI\Storage\Eloquent\Models;

use FI\Classes\Currency;

class InvoiceAmount extends \Eloquent {

	protected $guarded = array('id');

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

	public function getFormattedItemSubtotalAttribute()
	{
		return Currency::format($this->attributes['item_subtotal']);
	}

	public function getFormattedItemTaxTotalAttribute()
	{
		return Currency::format($this->attributes['item_tax_total']);
	}

	public function getFormattedTaxTotalAttribute()
	{
		return Currency::format($this->attributes['tax_total']);
	}

	public function getFormattedTotalAttribute()
	{
		return Currency::format($this->attributes['total']);
	}

	public function getFormattedPaidAttribute()
	{
		return Currency::format($this->attributes['paid']);
	}

	public function getFormattedBalanceAttribute()
	{
		return Currency::format($this->attributes['balance']);
	}

}