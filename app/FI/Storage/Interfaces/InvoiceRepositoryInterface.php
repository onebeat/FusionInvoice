<?php namespace FI\Storage\Interfaces;

interface InvoiceRepositoryInterface {

	/**
	 * Get all records
	 * @return Invoice
	 */	
	public function all();

	/**
	 * Get a list of records by status
	 * @param  int $page
	 * @param  int  $numPerPage
	 * @param  string  $status
	 * @return Invoice
	 */
	public function getPagedByStatus($page, $numPerPage, $status);

	/**
	 * Get a limited list of all invoices
	 * @param  int $limit
	 * @return Invoice
	 */
	public function getRecent($limit);

	/**
	 * Get a limited list of overdue records
	 * @param  int $limit
	 * @return Invoice
	 */
	public function getRecentOverdue($limit);
	
	/**
	 * Get a single record
	 * @param  int $id
	 * @return Invoice
	 */
	public function find($id);
	
	/**
	 * Create a record
	 * @param  int $clientId
	 * @param  string $createdAt
	 * @param  int $invoiceGroupId
	 * @param  int $userId
	 * @param  int $invoiceStatusId
	 * @return int
	 */
	public function create($clientId, $createdAt, $invoiceGroupId, $userId, $invoiceStatusId, $terms);
	
	/**
	 * Update a record
	 * @param  int $invoiceId
	 * @param  string $createdAt
	 * @param  string $dueAt
	 * @param  string $number
	 * @param  int $invoiceStatusId
	 * @return void
	 */
	public function update($invoiceId, $createdAt, $dueAt, $number, $invoiceStatusId, $terms);

	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */	
	public function delete($id);

}