<?php namespace FI\Storage\Interfaces;

interface InvoiceGroupRepositoryInterface {

	/**
	 * Get all records
	 * @return InvoiceGroup
	 */	
	public function all();

	/**
	 * Get a paged list of records
	 * @param  int $page
	 * @param  int  $numPerPage
	 * @return InvoiceGroup
	 */
	public function getPaged($page, $numPerPage);

	/**
	 * Get a single record
	 * @param  int $id
	 * @return InvoiceGroup
	 */	
	public function find($id);

	/**
	 * Generate an invoice number
	 * @param  int $id
	 * @return string
	 */
	public function generateNumber($id);

	/**
	 * Increment the next id after an invoice is created
	 * @param  int $id
	 * @return void
	 */
	public function incrementNextId($id);
	
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