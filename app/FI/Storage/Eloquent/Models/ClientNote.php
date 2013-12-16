<?php namespace FI\Storage\Eloquent\Models;

use FI\Classes\Date;

class ClientNote extends \Eloquent {
	
	protected $guarded = array('id');

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getFormattedCreatedAtAttribute()
    {
    	return Date::format($this->attributes['created_at']);
    }

    public function getFormattedNoteAttribute()
    {
    	return nl2br($this->attributes['note']);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeForClient($query, $clientId)
    {
    	return $query->where('client_id', '=', $clientId);
    }

}