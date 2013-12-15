<?php namespace FI\Storage\Interfaces;

interface TaxRateRepositoryInterface {

	/**
	 * Get a list of all records
	 * @return TaxRate
	 */	
	public function all();

	/**
	 * Get a paged list of records
	 * @param  int $page
	 * @param  int  $numPerPage
	 * @return TaxRate
	 */
	public function getPaged($page, $numPerPage);

	/**
	 * Get a single record
	 * @param  int $id
	 * @return TaxRate
	 */	
	public function find($id);

	/**
	 * Create a record
	 * @param  array $input
	 * @return void
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