<?php namespace FI\Storage\Eloquent\Models;

use FI\Classes\CurrencyFormatter;

class QuoteItemAmount extends \Eloquent {

	protected $guarded = array('id');

	public function getFormattedSubtotalAttribute()
	{
		return CurrencyFormatter::format($this->attributes['subtotal']);
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