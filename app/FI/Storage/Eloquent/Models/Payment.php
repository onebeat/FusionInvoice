<?php namespace FI\Storage\Eloquent\Models;

use FI\Classes\Date;
use FI\Classes\CurrencyFormatter;
use FI\Classes\NumberFormatter;

class Payment extends \Eloquent {

	protected $guarded = array('id');

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
   
    public function custom()
    {
        return $this->hasOne('FI\Storage\Eloquent\Models\PaymentCustom');
    }

    public function invoice()
    {
    	return $this->belongsTo('FI\Storage\Eloquent\Models\Invoice');
    }

    public function paymentMethod()
    {
    	return $this->belongsTo('FI\Storage\Eloquent\Models\PaymentMethod');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getFormattedPaidAtAttribute()
    {
    	return Date::format($this->attributes['paid_at']);
    }

    public function getFormattedAmountAttribute()
    {
    	return CurrencyFormatter::format($this->attributes['amount']);
    }

    public function getFormattedNumericAmountAttribute()
    {
        return NumberFormatter::format($this->attributes['amount']);
    }

}