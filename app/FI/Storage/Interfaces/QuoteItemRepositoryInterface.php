<?php namespace FI\Storage\Interfaces;

interface QuoteItemRepositoryInterface {

	/**
	 * Get a single record
	 * @param  int $id
	 * @return QuoteItem
	 */	
	public function find($id);

	/**
	 * Get a list of records by quote id
	 * @param  int $quoteId
	 * @return QuoteItem
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
	 * @param  int $id
	 * @return void
	 */
	public function update($input, $id);

	/**
	 * Delete a record
	 * @param  int $id
	 * @return string
	 */	
	public function delete($id);

}