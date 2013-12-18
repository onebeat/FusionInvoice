<?php namespace FI\Storage\Eloquent\Models;

class CustomField extends \Eloquent {
	
	protected $guarded = array('id');

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeForTable($query, $table)
    {
    	return $query->where('table_name', '=', $table);
    }

}