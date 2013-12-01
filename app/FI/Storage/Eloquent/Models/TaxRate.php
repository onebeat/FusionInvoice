<?php namespace FI\Storage\Eloquent\Models;

use FI\Classes\NumberFormatter;

class TaxRate extends \Eloquent {

	protected $guarded = array('id');

	public function getFormattedPercentAttribute()
	{
		return NumberFormatter::format($this->attributes['percent']);
	}

}