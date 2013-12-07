<?php namespace FI\Storage\Interfaces;

interface QuoteRepositoryInterface {

	/**
	 * Get a list of all records
	 * @return Quote
	 */	
	public function all();

	/**
	 * Get a paged list of records
	 * @param  int $page
	 * @param  int  $numPerPage
	 * @param  string $status
	 * @return Quote
	 */
	public function getPagedByStatus($page, $numPerPage, $status);

	/**
	 * Get a limited list of all records
	 * @param  int $limit
	 * @return Quote
	 */
	public function getRecent($limit);

	/**
	 * Get a single record
	 * @param  int $id
	 * @return Quote
	 */	
	public function find($id);
	
	/**
	 * Create a record
	 * @param  int $clientId
	 * @param  string $createdAt
	 * @param  int $invoiceGroupId
	 * @param  int $userId
	 * @param  int $quoteStatusId
	 * @return int
	 */
	public function create($clientId, $createdAt, $invoiceGroupId, $userId, $quoteStatusId);
	
	/**
	 * Update a record
	 * @param  int $quoteId
	 * @param  string $createdAt
	 * @param  string $expiresAt
	 * @param  string $number
	 * @param  int $quoteStatusId
	 * @return void
	 */
	public function update($quoteId, $createdAt, $expiresAt, $number, $quoteStatusId);

	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */	
	public function delete($id);
	
}