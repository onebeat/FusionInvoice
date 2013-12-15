<?php namespace FI\Storage\Interfaces;

interface InvoiceTaxRateRepositoryInterface {

	/**
	 * Get a single record
	 * @param  int $id
	 * @return InvoiceTaxRate
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
	 * @param  int $taxRateId
	 * @return void
	 */
	public function update($input, $invoiceId, $taxRateId);

	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */	
	public function delete($id);

}