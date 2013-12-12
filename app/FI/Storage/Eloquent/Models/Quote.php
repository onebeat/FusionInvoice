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
        return Date::format($this->attributes['created_at']);
    }

    public function getFormattedUpdatedAtAttribute()
    {
        return Date::format($this->attributes['updated_at']);
    }

    public function getFormattedExpiresAtAttribute($value)
    {
        return Date::format($this->attributes['expires_at']);
    }

    public function getStatusTextAttribute()
    {
        switch ($this->attributes['quote_status_id'])
        {
            case 1:
                return 'draft';
                break;
            case 2:
                return 'sent';
                break;
            case 3:
                return 'viewed';
                break;
            case 4:
                return 'approved';
                break;
            case 5:
                return 'rejected';
                break;
            case 6:
                return 'canceled';
                break;
            default:
                return 'unknown';
        }
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

    public function scopeViewed($query)
    {
        return $query->where('quote_status_id', '=', 3);
    }

    public function scopeApproved($query)
    {
        return $query->where('quote_status_id', '=', 4);
    }

    public function scopeRejected($query)
    {
        return $query->where('quote_status_id', '=', 5);
    }

    public function scopeCanceled($query)
    {
        return $query->where('quote_status_id', '=', 6);
    }
}