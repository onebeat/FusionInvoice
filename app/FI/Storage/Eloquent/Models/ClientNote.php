<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Storage\Eloquent\Models;

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