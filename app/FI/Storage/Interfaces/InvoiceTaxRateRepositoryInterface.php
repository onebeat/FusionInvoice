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
	 * @param  int $invoiceId
	 * @param  int $taxRateId
	 * @param  bool $includeItemTax
	 * @param  float $taxTotal
	 * @return void
	 */
	public function create($invoiceId, $taxRateId, $includeItemTax, $taxTotal);
	
	/**
	 * Update a record
	 * @param  int $invoiceId
	 * @param  int $taxRateId
	 * @param  bool $includeItemTax
	 * @param  float $taxTotal
	 * @return void
	 */
	public function update($invoiceId, $taxRateId, $includeItemTax, $taxTotal);

	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */	
	public function delete($id);

}