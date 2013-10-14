<?php namespace FI\Storage\Eloquent\Models;

class Client extends \Eloquent {
	
	protected $table = 'fi_clients';
	
	protected $guarded = array('id');
	
	public function invoices()
	{
		return $this->hasMany('FI\Storage\Eloquent\Models\Invoice');
	}
	
}