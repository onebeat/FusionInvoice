<?php namespace FI\Storage\Eloquent\Models;

class Invoice extends \Eloquent {
	
	protected $table = 'fi_invoices';
	
	protected $guarded = array('id');
	
	public function client()
	{
		return $this->hasOne('FI\Storage\Eloquent\Models\Client');
	}
	
}