<?php namespace FI\Storage\Interfaces;

interface InvoiceAmountRepositoryInterface {

	/**
	 * Get a single record
	 * @param  int $id
	 * @return InvoiceAmount
	 */
	public function find($id);
	
	/**
	 * Create a record
	 * @param  array $input
	 * @return int
	 */
	public function create($input);
	
	/**
	 * Update a record
	 * @param  array $input
	 * @param  int $invoiceId
	 * @return void
	 */
	public function update($input, $invoiceId);

	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */
	public function delete($id);

	/**
	 * Get a grouped list of amounts by status
	 * @param  array $statuses
	 * @return array
	 */
	public function getTotalsByStatus($statuses);

}