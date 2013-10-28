<?php namespace FI\Storage\Eloquent\Models;

use FI\Libraries\Currency;

class QuoteAmount extends \Eloquent {

	protected $guarded = array('id');

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

	public function getSubtotalAttribute($value)
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