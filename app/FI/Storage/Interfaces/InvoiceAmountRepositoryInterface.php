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
	 * @param  int $invoiceId
	 * @param  float $itemSubtotal
	 * @param  float $itemTaxTotal
	 * @param  float $taxTotal
	 * @param  float $total
	 * @param  float $paid
	 * @param  float $balance
	 * @return void
	 */
	public function create($invoiceId, $itemSubtotal, $itemTaxTotal, $taxTotal, $total, $paid, $balance);
	
	/**
	 * Update a record
	 * @param  int $invoiceId
	 * @param  float $itemSubtotal
	 * @param  float $itemTaxTotal
	 * @param  float $taxTotal
	 * @param  float $total
	 * @param  float $paid
	 * @param  float $balance
	 * @return void
	 */
	public function update($invoiceId, $itemSubtotal, $itemTaxTotal, $taxTotal, $total, $paid, $balance);

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