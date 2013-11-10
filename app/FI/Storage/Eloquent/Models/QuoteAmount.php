<?php namespace FI\Storage\Eloquent\Models;

use FI\Classes\Currency;

class QuoteAmount extends \Eloquent {

	protected $guarded = array('id');

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

	public function getItemSubtotalAttribute($value)
	{
		return Currency::format($value);
	}

	public function getItemTaxTotalAttribute($value)
	{
		return Currency::format($value);
	}

	public function getTaxTotalAttribute($value)
	{
		return Currency::format($value);
	}

	public function getTotalAttribute($value)
	{
		return Currency::format($value);
	}

}