<?php namespace FI\Storage\Eloquent\Models;

use FI\Classes\Currency;

class InvoiceItemAmount extends \Eloquent {

	protected $guarded = array('id');

	public function getFormattedSubtotalAttribute()
	{
		return Currency::format($this->attributes['subtotal']);
	}

	public function getFormattedTaxTotalAttribute()
	{
		return Currency::format($this->attributes['tax_total']);
	}

	public function getFormattedTotalAttribute()
	{
		return Currency::format($this->attributes['total']);
	}

}