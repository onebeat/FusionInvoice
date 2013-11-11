<?php namespace FI\Storage\Eloquent\Models;

use FI\Classes\Currency;

class QuoteTaxRate extends \Eloquent {

	protected $guarded = array('id');

	public function taxRate()
	{
		return $this->belongsTo('\FI\Storage\Eloquent\Models\TaxRate');
	}

	public function getFormattedTaxTotalAttribute()
	{
		return Currency::format($this->attributes['tax_total']);
	}

}