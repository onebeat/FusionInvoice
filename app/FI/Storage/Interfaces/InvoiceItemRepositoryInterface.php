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
	 * Get a list of records by invoice date range
	 * @param  string $from
	 * @param  string $to
	 * @return InvoiceItem
	 */
	public function getByDateRange($from, $to);
	
	/**
	 * Create a record
	 * @param  array $input
	 * @return int
	 */
	public function create($input);

	/**
	 * Update a record
	 * @param  array $input
	 * @param  int $id
	 * @return void
	 */
	public function update($input, $id);

	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */	
	public function delete($id);

}