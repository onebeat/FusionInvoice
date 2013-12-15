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