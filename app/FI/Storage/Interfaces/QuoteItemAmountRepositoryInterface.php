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
	 * @param  int $itemId
	 * @param  float $subtotal
	 * @param  float $taxTotal
	 * @param  float $total
	 * @return void
	 */
	public function create($itemId, $subtotal, $taxTotal, $total);
	
	/**
	 * Update a record
	 * @param  int $itemId
	 * @param  float $subtotal
	 * @param  float $taxTotal
	 * @param  float $total
	 * @return void
	 */
	public function update($itemId, $subtotal, $taxTotal, $total);

	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */
	public function delete($id);
	
}