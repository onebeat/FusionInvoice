<?php namespace FI\Storage\Interfaces;

interface InvoiceCustomRepositoryInterface {

	/**
	 * Saves input to the custom table
	 * @param  array $input
	 * @param  int $invoiceId
	 * @return void
	 */
	public function save($input, $invoiceId);
	
}