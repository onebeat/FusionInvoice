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
	 * @param  array $input
	 * @return int
	 */
	public function create($input);

	/**
	 * Update a record
	 * @param  array $input
	 * @param  int $itemId
	 * @return void
	 */
	public function update($input, $itemId);

	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */	
	public function delete($id);

}