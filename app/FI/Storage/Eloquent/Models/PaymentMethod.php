<?php namespace FI\Storage\Eloquent\Models;

class PaymentMethod extends \Eloquent {
	
	protected $table = 'fi_payment_methods';

	protected $guarded = array('id');

}