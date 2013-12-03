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
	 * @param  int $quoteId
	 * @param  string $name
	 * @param  string $description
	 * @param  float $quantity
	 * @param  float $price
	 * @param  int $taxRateId
	 * @param  int $displayOrder
	 * @return int
	 */
	public function create($quoteId, $name, $description, $quantity, $price, $taxRateId, $displayOrder);
	
	/**
	 * Update a record
	 * @param  int $quoteItemId
	 * @param  string $name
	 * @param  string $description
	 * @param  float $quantity
	 * @param  float $price
	 * @param  int $taxRateId
	 * @param  int $displayOrder
	 * @return void
	 */
	public function update($quoteItemId, $name, $description, $quantity, $price, $taxRateId, $displayOrder);

	/**
	 * Delete a record
	 * @param  int $id
	 * @return string
	 */	
	public function delete($id);

}