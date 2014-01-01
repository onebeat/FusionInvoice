<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Invoices\Models;

use FI\Classes\Date;

class Invoice extends \Eloquent {

    /**
     * Guarded properties
     * @var array
     */
	protected $guarded = array('id');

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function client()
    {
        return $this->belongsTo('FI\Modules\Clients\Models\Client');
    }

    public function custom()
    {
        return $this->hasOne('FI\Modules\CustomFields\Models\InvoiceCustom');
    }

    public function amount()
    {
        return $this->hasOne('FI\Modules\Invoices\Models\InvoiceAmount');
    }

    public function items()
    {
        return $this->hasMany('FI\Modules\Invoices\Models\InvoiceItem')
        ->orderBy('display_order');
    }

    public function taxRates()
    {
        return $this->hasMany('FI\Modules\Invoices\Models\InvoiceTaxRate');
    }

    public function user()
    {
        return $this->belongsTo('FI\Modules\Users\Models\User');
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