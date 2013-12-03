<?php namespace FI\Storage\Interfaces;

interface InvoiceItemRepositoryInterface {

	/**
	 * Get a single record
	 * @param  int $id
	 * @return InvoiceItem
	 */	
	public function find($id);

	/**
	 * Get a list of records by invoice id
	 * @param  int $invoiceId
	 * @return InvoiceItem
	 */
	public function findByInvoiceId($invoiceId);
	
	/**
	 * Create a record
	 * @param  int $invoiceId
	 * @param  string $name
	 * @param  string $description
	 * @param  float $quantity
	 * @param  float $price
	 * @param  int $taxRateId
	 * @param  int $displayOrder
	 * @return int
	 */
	public function create($invoiceId, $name, $description, $quantity, $price, $taxRateId, $displayOrder);
	
	/**
	 * Update a record
	 * @param  int $invoiceItemId
	 * @param  string $name
	 * @param  string $description
	 * @param  float $quantity
	 * @param  float $price
	 * @param  int $taxRateId
	 * @param  int $displayOrder
	 * @return void
	 */
	public function update($invoiceItemId, $name, $description, $quantity, $price, $taxRateId, $displayOrder);

	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */	
	public function delete($id);

}