<?php namespace FI\Storage\Eloquent\Models;

class Quote extends \Eloquent {

	protected $guarded = array('id');

	public function client()
	{
		return $this->hasOne('FI\Storage\Eloquent\Models\Client');
	}

	public function amount()
	{
		return $this->hasOne('FI\Storage\Eloquent\Models\QuoteAmount');
	}

	public function items()
	{
		return $this->hasMany('FI\Storage\Eloquent\Models\QuoteItem');
	}

}