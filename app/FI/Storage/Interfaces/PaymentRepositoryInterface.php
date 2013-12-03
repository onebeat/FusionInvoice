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
	 * Get a single record
	 * @param  int $id
	 * @return Payment
	 */	
	public function find($id);
	
	/**
	 * Create a record
	 * @param  int $invoiceId
	 * @param  float $amount
	 * @param  string $paidAt
	 * @param  int $paymentMethodId
	 * @param  string $note
	 * @return void
	 */
	public function create($invoiceId, $amount, $paidAt, $paymentMethodId, $note);
	
	/**
	 * Update a record
	 * @param  int $id
	 * @param  float $amount
	 * @param  string $paidAt
	 * @param  int $paymentMethodId
	 * @param  string $note
	 * @return void
	 */
	public function update($id, $amount, $paidAt, $paymentMethodId, $note);
	
	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */
	public function delete($id);

}