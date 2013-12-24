<?php namespace FI\Storage\Eloquent\Models;

use FI\Classes\Date;

class Invoice extends \Eloquent {

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

    public function custom()
    {
        return $this->hasOne('FI\Storage\Eloquent\Models\InvoiceCustom');
    }

    public function amount()
    {
        return $this->hasOne('FI\Storage\Eloquent\Models\InvoiceAmount');
    }

    public function items()
    {
        return $this->hasMany('FI\Storage\Eloquent\Models\InvoiceItem')
        ->orderBy('display_order');
    }

    public function taxRates()
    {
        return $this->hasMany('FI\Storage\Eloquent\Models\InvoiceTaxRate');
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

    public function getFormattedDueAtAttribute()
    {
        return Date::format($this->attributes['due_at']);
    }

    public function getFormattedTermsAttribute()
    {
        return nl2br($this->attributes['terms']);
    }

    public function getStatusTextAttribute()
    {
        switch ($this->attributes['invoice_status_id'])
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
                return 'paid';
                break;
            case 5:
                return 'canceled';
                break;
            default:
                return 'unknown';
        }
    }

    public function getIsOverdueAttribute()
    {
        if ($this->attributes['due_at'] < date('Y-m-d') and $this->attributes['invoice_status_id'] <> 4)
            return 1;

        return 0;
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeDraft($query)
    {
        return $query->where('invoice_status_id', '=', 1);
    }

    public function scopeSent($query)
    {
        return $query->where('invoice_status_id', '=', 2);
    }

    public function scopeViewed($query)
    {
        return $query->where('invoice_status_id', '=', 3);
    }

    public function scopePaid($query)
    {
        return $query->where('invoice_status_id', '=', 4);
    }

    public function scopeCanceled($query)
    {
        return $query->where('invoice_status_id', '=', 5);
    }

    public function scopeOverdue($query)
    {
        return $query->where('invoice_status_id', '<>', 4)->where('due_at', '<', \DB::raw('now()'));
    }
}