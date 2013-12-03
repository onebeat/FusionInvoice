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
	 * @param  string $name
	 * @param  float $percent
	 * @return void
	 */	
	public function create($name, $percent);

	/**
	 * Update a record
	 * @param  int $id
	 * @param  string $name
	 * @param  float $percent
	 * @return void
	 */	
	public function update($id, $name, $percent);

	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */	
	public function delete($id);

}