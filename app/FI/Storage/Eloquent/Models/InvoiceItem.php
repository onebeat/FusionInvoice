<?php namespace FI\Storage\Eloquent\Models;

use FI\Classes\CurrencyFormatter;
use FI\Classes\NumberFormatter;

class InvoiceItem extends \Eloquent {

	protected $guarded = array('id');

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
   
    public function amount()
    {
        return $this->hasOne('FI\Storage\Eloquent\Models\InvoiceItemAmount', 'item_id');
    }

    public function invoice()
    {
        return $this->belongsTo('FI\Storage\Eloquent\Models\Invoice');
    }

    public function taxRate()
    {
        return $this->belongsTo('FI\Storage\Eloquent\Models\TaxRate');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getFormattedQuantityAttribute()
    {
    	return NumberFormatter::format($this->attributes['quantity']);
    }

    public function getFormattedNumericPriceAttribute()
    {
    	return NumberFormatter::format($this->attributes['price']);
    }

    public function getFormattedPriceAttribute()
    {
    	return CurrencyFormatter::format($this->attributes['price']);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeByDateRange($query, $from, $to)
    {
        return $query->whereIn('invoice_id', function($query) use ($from, $to) {
            $query->select('id')
            ->from('invoices')
            ->where('created_at', '>=', $from)
            ->where('created_at', '<=', $to);
        });
    } 

}