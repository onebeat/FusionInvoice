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
	 * @param  string $name
	 * @param  int $nextId
	 * @param  int $leftPad
	 * @param  string $prefix
	 * @param  bool $prefixYear
	 * @param  bool $prefixMonth
	 * @return void
	 */
	public function create($name, $nextId, $leftPad, $prefix, $prefixYear, $prefixMonth);
	
	/**
	 * Update a record
	 * @param  int $id
	 * @param  string $name
	 * @param  int $nextId
	 * @param  int $leftPad
	 * @param  string $prefix
	 * @param  bool $prefixYear
	 * @param  bool $prefixMonth
	 * @return void
	 */
	public function update($id, $name, $nextId, $leftPad, $prefix, $prefixYear, $prefixMonth);

	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */	
	public function delete($id);

}