<?php namespace FI\Storage\Interfaces;

interface PaymentRepositoryInterface {

	/**
	 * Get a list of all records
	 * @return Payment
	 */	
	public function all();

	/**
	 * Get a paged list of records
	 * @param  int $page
	 * @param  int  $numPerPage
	 * @return Payment
	 */
	public function getPaged($page, $numPerPage);

	/**
	 * Get the total amount paid by invoice id
	 * @param  int $invoiceId
	 * @return Payment
	 */
	public function getTotalPaidByInvoiceId($invoiceId);

	/**
	 * Get a list of records by date range
	 * @param  string $from
	 * @param  string $to
	 * @return Payment
	 */
	public function getByDateRange($from, $to);

	/**
	 * Get a single record
	 * @param  int $id
	 * @return Payment
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
	 * @param  int $id
	 * @return void
	 */
	public function update($input, $id);
	
	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */
	public function delete($id);

}