<?php namespace FI\Storage\Interfaces;

interface InvoiceItemAmountRepositoryInterface {

	/**
	 * Get a single record
	 * @param  int $id
	 * @return InvoiceItemAmount
	 */	
	public function find($id);

	/**
	 * Get a list of records by invoice id
	 * @param  int $invoiceId
	 * @return InvoiceItemAmount
	 */
	public function findByInvoiceId($invoiceId);

	/**
	 * Create a record
	 * @param  int $itemId
	 * @param  float $subtotal
	 * @param  float $taxTotal
	 * @param  float $total
	 * @return void
	 */	
	public function create($itemId, $subtotal, $taxTotal, $total);

	/**
	 * Update a record
	 * @param  int $itemId
	 * @param  float $subtotal
	 * @param  float $taxTotal
	 * @param  float $total
	 * @return void
	 */	
	public function update($itemId, $subtotal, $taxTotal, $total);

	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */	
	public function delete($id);

}