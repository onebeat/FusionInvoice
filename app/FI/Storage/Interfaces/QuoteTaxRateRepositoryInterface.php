<?php namespace FI\Storage\Interfaces;

interface QuoteTaxRateRepositoryInterface {

	/**
	 * Get a single record
	 * @param  int $id
	 * @return QuoteTaxRate
	 */	
	public function find($id);

	/**
	 * Get a list of tax rates by quote id
	 * @param  int $quoteId
	 * @return QutoeTaxRate
	 */
	public function findByQuoteId($quoteId);

	/**
	 * Create a record
	 * @param  array $input
	 * @return int
	 */
	public function create($input);

	/**
	 * Update a record
	 * @param  array $input
	 * @param  int $quoteId
	 * @param  int $taxRateId
	 * @return void
	 */
	public function update($input, $quoteId, $taxRateId);

	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */
	public function delete($id);

}