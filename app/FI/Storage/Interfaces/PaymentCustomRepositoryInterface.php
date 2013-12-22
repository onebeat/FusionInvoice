<?php namespace FI\Storage\Interfaces;

interface PaymentCustomRepositoryInterface {

	/**
	 * Saves input to the custom table
	 * @param  array $input
	 * @param  int $paymentId
	 * @return void
	 */
	public function save($input, $paymentId);
	
}