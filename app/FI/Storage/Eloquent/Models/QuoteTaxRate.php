<?php namespace FI\Storage\Eloquent\Models;

use FI\Classes\CurrencyFormatter;

class QuoteTaxRate extends \Eloquent {

	protected $guarded = array('id');

	public function taxRate()
	{
		return $this->belongsTo('\FI\Storage\Eloquent\Models\TaxRate');
	}

	public function getFormattedTaxTotalAttribute()
	{
		return CurrencyFormatter::format($this->attributes['tax_total']);
	}

}