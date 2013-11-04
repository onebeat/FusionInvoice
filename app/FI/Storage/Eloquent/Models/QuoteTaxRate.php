<?php namespace FI\Storage\Eloquent\Models;

class QuoteTaxRate extends \Eloquent {

	protected $guarded = array('id');

	public function taxRate()
	{
		return $this->belongsTo('\FI\Storage\Eloquent\Models\TaxRate');
	}

}