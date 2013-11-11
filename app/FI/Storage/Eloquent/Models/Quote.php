<?php namespace FI\Storage\Eloquent\Models;

use FI\Classes\Date;

class Quote extends \Eloquent {

	protected $guarded = array('id');

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function client()
    {
        return $this->belongsTo('FI\Storage\Eloquent\Models\Client');
    }

    public function amount()
    {
        return $this->hasOne('FI\Storage\Eloquent\Models\QuoteAmount');
    }

    public function items()
    {
        return $this->hasMany('FI\Storage\Eloquent\Models\QuoteItem')
        ->orderBy('display_order');
    }

    public function taxRates()
    {
        return $this->hasMany('FI\Storage\Eloquent\Models\QuoteTaxRate');
    }

    public function user()
    {
        return $this->belongsTo('FI\Storage\Eloquent\Models\User');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */
   
    public function getFormattedCreatedAtAttribute()
    {
        return Date::customizeDate($this->attributes['created_at']);
    }

    public function getFormattedUpdatedAtAttribute()
    {
        return Date::customizeDate($this->attributes['updated_at']);
    }

    public function getFormattedExpiresAtAttribute($value)
    {
        return Date::customizeDate($this->attributes['expires_at']);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeDraft($query)
    {
        return $query->where('quote_status_id', '=', 1);
    }

    public function scopeSent($query)
    {
        return $query->where('quote_status_id', '=', 2);
    }

    public function scopeCanceled($query)
    {
        return $query->where('quote_status_id', '=', 4);
    }
}