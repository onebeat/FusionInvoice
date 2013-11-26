<?php namespace FI\Storage\Eloquent\Models;

use FI\Classes\CurrencyFormatter;

class Client extends \Eloquent {
	
	protected $guarded = array('id');
	
	public function invoices()
	{
		return $this->hasMany('FI\Storage\Eloquent\Models\Invoice');
	}

	public function quotes()
	{
		return $this->hasMany('Fi\Storage\Eloquent\Models\Quote');
	}

	public function notes()
	{
		return $this->hasMany('FI\Storage\Eloquent\Models\ClientNote');
	}

	public function getBalanceAttribute($value)
	{
		return CurrencyFormatter::format($value);
	}
	
}