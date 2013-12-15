<?php namespace FI\Storage\Interfaces;

interface QuoteItemAmountRepositoryInterface {

	/**
	 * Find a record
	 * @param  int $id
	 * @return QuoteItemAmount
	 */	
	public function find($id);

	/**
	 * Find all records by quote id
	 * @param  int $quoteId [description]
	 * @return QuoteItemAmount
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