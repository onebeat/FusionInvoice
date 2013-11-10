<?php namespace FI\Storage\Eloquent\Models;

use FI\Classes\Currency;

class QuoteItemAmount extends \Eloquent {

	protected $guarded = array('id');

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