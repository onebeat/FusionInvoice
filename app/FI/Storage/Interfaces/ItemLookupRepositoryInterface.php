<?php namespace FI\Storage\Interfaces;

interface ItemLookupRepositoryInterface {

	/**
	 * Get a list of all records
	 * @return ItemLookup
	 */	
	public function all();

	/**
	 * Get a paged list of records
	 * @param  int $page
	 * @param  int  $numPerPage
	 * @return ItemLookup
	 */
	public function getPaged($page, $numPerPage);

	/**
	 * Get a list of records by id
	 * @param  array $ids
	 * @return ItemLookup
	 */
	public function getByIds($ids);
	
	/**
	 * Get a single record
	 * @param  int $id
	 * @return ItemLookup
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