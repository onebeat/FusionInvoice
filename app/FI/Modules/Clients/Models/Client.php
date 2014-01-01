<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Clients\Models;

use FI\Classes\CurrencyFormatter;

class Client extends \Eloquent {
	
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

	public function invoices()
	{
		return $this->hasMany('FI\Modules\Invoices\Models\Invoice');
	}

	public function quotes()
	{
		return $this->hasMany('FI\Modules\Quotes\Models\Quote');
	}

	public function notes()
	{
		return $this->hasMany('FI\Modules\Clients\Models\ClientNote')->orderBy('created_at', 'DESC');
	}

	public function custom()
	{
		return $this->hasOne('FI\Modules\CustomFields\Models\ClientCustom');
	}

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

	public function getFormattedBalanceAttribute()
	{
		return CurrencyFormatter::format($this->attributes['balance']);
	}

	public function getFormattedPaidAttribute()
	{
		return CurrencyFormatter::format($this->attributes['paid']);
	}

	public function getFormattedTotalAttribute()
	{
		return CurrencyFormatter::format($this->attributes['total']);
	}
	
}