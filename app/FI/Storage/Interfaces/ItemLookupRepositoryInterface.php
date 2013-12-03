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
	 * @param  string $name
	 * @param  string $description
	 * @param  float $price
	 * @return void
	 */
	public function create($name, $description, $price);
	
	/**
	 * Update a record
	 * @param  int $itemLookupId
	 * @param  string $name
	 * @param  string $description
	 * @param  float $price
	 * @return void
	 */
	public function update($itemLookupId, $name, $description, $price);

	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */	
	public function delete($id);

}