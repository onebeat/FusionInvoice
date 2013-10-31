<?php namespace FI\Storage\Eloquent\Models;

class QuoteItem extends \Eloquent {

	protected $guarded = array('id');

    public function amount()
    {
        return $this->hasOne('FI\Storage\Eloquent\Models\QuoteItemAmount', 'item_id');
    }

}