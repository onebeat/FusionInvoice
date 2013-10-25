<?php namespace FI\Storage\Eloquent\Models;

class Quote extends \Eloquent {

	protected $guarded = array('id');

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

	public function client()
	{
		return $this->hasOne('FI\Storage\Eloquent\Models\Client');
	}

	public function amount()
	{
		return $this->hasOne('FI\Storage\Eloquent\Models\QuoteAmount');
	}

	public function items()
	{
		return $this->hasMany('FI\Storage\Eloquent\Models\QuoteItem');
	}

}