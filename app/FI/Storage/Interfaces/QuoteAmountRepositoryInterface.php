<?php namespace FI\Storage\Interfaces;

interface QuoteAmountRepositoryInterface {

	/**
	 * Get a single record
	 * @param  int $id
	 * @return QuoteAmount
	 */	
	public function find($id);

	/**
	 * Create a record
	 * @param  int $quoteId
	 * @param  float $itemSubtotal
	 * @param  float $itemTaxTotal
	 * @param  float $taxTotal
	 * @param  float $total
	 * @return void
	 */
	public function create($quoteId, $itemSubtotal, $itemTaxTotal, $taxTotal, $total);
	
	/**
	 * Update a record
	 * @param  int $quoteId
	 * @param  float $itemSubtotal
	 * @param  float $itemTaxTotal
	 * @param  float $taxTotal
	 * @param  float $total
	 * @return void
	 */
	public function update($quoteId, $itemSubtotal, $itemTaxTotal, $taxTotal, $total);

	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */
	public function delete($id);

}