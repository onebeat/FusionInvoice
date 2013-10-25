<?php namespace FI\Storage\Eloquent\Models;

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
	
}