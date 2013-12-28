<?php namespace FI\Storage\Eloquent\Models;

use FI\Classes\CurrencyFormatter;

class InvoiceTaxRate extends \Eloquent {

	protected $guarded = array('id');

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
   
   	public function invoice()
   	{
   		return $this->belongsTo('\FI\Storage\Eloquent\Models\Invoice');
   	}

	public function taxRate()
	{
		return $this->belongsTo('\FI\Storage\Eloquent\Models\TaxRate');
	}

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

	public function getFormattedTaxTotalAttribute()
	{
		return CurrencyFormatter::format($this->attributes['tax_total']);
	}

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeByInvoiceDateRange($query, $from, $to)
    {
        return $query->whereIn('invoice_id', function($query) use ($from, $to) {
            $query->select('id')
            ->from('invoices')
            ->where('created_at', '>=', $from)
            ->where('created_at', '<=', $to);
        });
    }

}